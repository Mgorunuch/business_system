<?php

namespace App\Http\Controllers;

use App\ExternalTransaction;
use App\InternalTransaction;
use App\Pocket;
use App\Position;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Classes\PerfectMoney;

class PaymentController extends Controller
{
    public function index() {
        return view('dashboard.payment.pay')->with(['message'=>'You must pay for subscription'])->with([
            'user'=>\Illuminate\Support\Facades\Auth::user(),
            'config'=>\Illuminate\Support\Facades\Config::get('PerfectMoney')
        ]);
    }

    public function banned() {
        return view('dashboard.payment.banned')->with(['message'=>'You banned'])->with([
            'user'=>\Illuminate\Support\Facades\Auth::user()
        ]);
    }

    public function activate() {
        $user = Auth::user();
        ($user->reffer_id) ? $reffer = User::find($user->reffer_id) : $reffer = false;

        if($user->pocket->check_balance()) {
            if($user->status == 2 && $user->pocket->frizzed_value >= Config::get('const.month_price')) {
                $user->status = 1;
                if(is_null($user->position)) {
                    if($reffer) {
                        $position = Position::createNewPosition($user->id, $reffer->id);
                        $user->position_id = $position->id;
                        $user->save();
                        PaymentController::monthPayment($user->id, true);
                    } else {
                        $position = Position::createNewPosition($user->id);
                        $user->position_id = $position->id;
                        $user->save();
                        PaymentController::monthPayment($user->id);
                    }
                } else {
                    if($reffer) {
                        PaymentController::monthPayment($user->id, true);
                    } else {
                        PaymentController::monthPayment($user->id);
                    }
                }
            }
            return redirect('/blog');
        } else {
            return redirect('/referal');
        }
    }

    public function moderate() {
        $external = ExternalTransaction::where([
            ['status','=','waiting'],
            ['type','=','withdraw'],
        ])->get()->all();

        $pockets = [];
        foreach ($external as $ext) {
            $pockets[] = Pocket::find($ext->pocket_id);
        }
        return view('dashboard.moderate.payments')->with(['external'=>$external, 'pockets'=>$pockets]);
    }

    public function change_status(Request $request) {

        $all = $request->all();

        $transaction = ExternalTransaction::find($all['id']);
        if($all['status'] == 'accept') {
            $transaction->status = 'success';

            // TODO: MAKE PAYMENT HERE
        } elseif ($all['status'] == 'decline') {
            $transaction->status = 'failed';

            $pocket = $transaction->pocket;
            $pocket->add_balance($all['value']);
            $pocket->save();
        }
        $transaction->save();

        return $this->moderate();
    }

    public function payFailed() {
        return view('dashboard.payment.pay')->with(['message'=>'Error, when process payment. Please repeat.']);
    }

    public function pay(Request $request) {

        $all = $request->all();

        $PM = new PerfectMoney($all);

        if($PM = 'OK') {
            $user = User::where([['pocket_id','=',$all['POC']]])->first();

            if(!$user->hash_validate($all['HASH'])) {
                Log::emergency("HASH ERROR! ",$all);
                return redirect('/referal');
            };

            ($user->reffer_id) ? $reffer = User::find($user->reffer_id) : $reffer = false;

            $data = [
                'value' => $all['PAYMENT_AMOUNT'],
                'vallet_from' => $all['PAYEE_ACCOUNT'],
                'vallet_to' => 1,
                'pocket_id' => $user->pocket_id,
                'status' => 'success',
                'type' => 'put',
                'PAYMENT_BATCH_NUM' => $all['PAYMENT_BATCH_NUM']
            ];

            $transaction = ExternalTransaction::createNew($data);
            if($transaction == false) { return redirect('/referal'); }

            if(Auth::user()->status == 2)
                PaymentController::activate();
            else
                return back();

        }
        return redirect('/referal');
    }

    public function internal(Request $request) {

        $to_user = User::where('name',$request->to_username)->first();

        if(!is_null($to_user)) {
            $user = Auth::user();
            $all = $request->all();
            $amount = $all['internal_amount'];

            if($user->pocket->sendTo($amount, $to_user)) {
                return back();
            }
        }
        return back();

    }

    public function withdraw(Request $request) {

        $user = Auth::user();
        $all = $request->all();

        if($user->status != 1) return redirect('/blog');

        $ballance = $user->pocket->value+$user->pocket->frizzed_value; // Баланс
        $withdraw = Config::get('const.month_price')+$all['withdraw_amount']; // Сумма снятия + месячная оплата

        if($ballance >= $withdraw) {
            $data = [
                'value' => $all['withdraw_amount'],
                'vallet_from' => 1,
                'vallet_to' => $all['account_to'],
                'pocket_id' => $user->pocket_id,
                'type' => 'withdraw',
            ];

            $transaction = ExternalTransaction::createNew($data);

            return back();
        } else {
            return back();
        }

    }

    public static function getWithdraw() {

        $user = Auth::user();
        return ExternalTransaction::where([
            ['pocket_id', '=', $user->pocket->id]
        ])->orderBy('updated_at','desc')->get()->all();

    }

    public static function monthPayment($user_id, $lucky_week=false) {

        $user = User::find($user_id);
        $algorithm = Config::get('const.algorithm');
        $month_price = Config::get('const.month_price');
        if(!$user->pocket->check_balance()) return false;

        $data = [
            'pocket_from_id' => $user->pocket->id,
        ];

        return PaymentController::monthPaymentRecursive($user, $user, $data, $algorithm, 0, 0, $lucky_week);
    }

    private static function monthPaymentRecursive(User $user, User $user_to, $info, $algorithm, $step, $left_money, $lucky_week) {
        $month_price = Config::get('const.month_price');
        if($left_money == 0 && $step == 0) $left_money = $month_price;

        if($user_to->position->level_id == 1 || count($algorithm) == $step) {

            // Start money % to refer
            $to_refer = Config::get('const.to_refer');
            $to_refer = $month_price/100*$to_refer;
            $data = [
                'pocket_from_id' => $user->pocket->id,
                'pocket_to_id' => $user->reffer->pocket->id,
                'value' => $to_refer
            ];
            $transaction = InternalTransaction::createNew($data, true);
            $left_money -= $to_refer;
            // End money % to refer

            if($lucky_week && PaymentController::checkLuckyWeek($user)) {
                PaymentController::processLuckyWeek($user, $left_money);
            } else {
                PaymentController::toAdmin($info['pocket_from_id'], $left_money);
                PaymentController::setLastPayment($user);
            }

            return true;

        }

        $user_to = $user_to->parent();
        $data = [
            'pocket_to_id' => $user_to->pocket->id,
            'pocket_from_id' => $user->pocket->id,
            'value' => $month_price/100*$algorithm[$step]
        ];
        $left_money -= $data['value'];
        $process = InternalTransaction::createNew($data, true);

        $step++;

        return PaymentController::monthPaymentRecursive($user, $user_to, $info, $algorithm, $step, $left_money, $lucky_week);
    }

    public static function checkLuckyWeek(User $user) {
        $lucky_steps = Config::get('const.lucky_steps');
        $now = Carbon::now();

        $created = $user->created_at;

        $timeSec = 0;
        foreach ($lucky_steps as $step) {
            $timeSec += $step[0];
        }

        $created->addSeconds($timeSec);

        if($created > $now)
            return true;
        return false;
    }

    public static function processLuckyWeek($user, $value) {
        $lucker = Config::get('const.lucky_steps');
        $month_payment = Config::get('const.month_price');
        $now = Carbon::now();

        foreach ($lucker as $lucky) {
            $reseter = ''.$lucky[0].' seconds';
            $date = $now->modify($reseter);

            if($user->reffer->created_at < $date) {
                $money = $month_payment / 100 * $lucky[1];
                $data = [
                    'pocket_from_id'=>$user->pocket->id,
                    'pocket_to_id'=>$user->reffer->pocket->id,
                    'value'=>$money
                ];
                $process = InternalTransaction::createNew($data, true);

                $value -= $data['value'];

                if($value != 0) {
                    PaymentController::toAdmin($user->pocket->id ,$value);
                }
                PaymentController::setLastPayment($user);
                break;
            }
        }

    }

    public static function toAdmin($pocket_id, $value) {
        $data = [
            'pocket_from_id' => $pocket_id,
            'pocket_to_id' => 1,
            'value' => $value
        ];
        $process = InternalTransaction::createNew($data, true);
    }

    public static function setLastPayment($user) {
        $user->pocket->last_payment = Carbon::now();
        $user->pocket->save();
        $user->status = 1;
        $user->save();
        return true;
    }

}
