<?php

namespace App\Http\Controllers;

use App\ExternalTransaction;
use App\InternalTransaction;
use App\Position;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class PaymentController extends Controller
{
    public function index() {
        return view('dashboard.payment.pay')->with(['message'=>'You must pay for subscription']);
    }

    public function payFailed() {
        return view('dashboard.payment.pay')->with(['message'=>'Error, when process payment. Please repeat.']);
    }

    public function pay(Request $request) {

        $all = $request->all();

        $user = User::where(['pocket_id','=',$all['POC']])->first();

        if(!$user->hash_validate($all['HASH'])) {
            Log::emergency("HASH ERROR! ",$all);
            return redirect('/blog');
        };

        ($user->reffer_id) ? $reffer = User::find($user->reffer_id) : $reffer = false;

        $data = [
            'amount' => $all['PAYMENT_AMOUNT'],
            'vallet_from' => $all['PAYEE_ACCOUNT'],
            'vallet_to' => 1,
            'pocket_id' => $user->pocket_id,
            'status' => 'success',
            'type' => 'put'
        ];

        $transaction = ExternalTransaction::createNew($data);

        if($user->status == 2 && $user->pocket->frizzed_value >= Config::get('const.month_price')) {

            $user->status = 1;
            if(is_null($user->position_id)) {
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
            }

        }
        return redirect('/blog');

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
                'status' => 'success',
                'type' => 'withdraw'
            ];

            $transaction = ExternalTransaction::createNew($data);

            return redirect('/blog')->with(['message'=>'Your money sended']);
        } else {
            return redirect('/blog')->with(['message'=>'You cant withdraw this amount']);
        }

    }

    public static function monthPayment($user_id, $lucky_week=false) {

        $user = User::find($user_id);
        $algorithm = Config::get('const.algorithm');

        $data = [
            'pocket_from_id' => $user->pocket->id,
        ];

        return PaymentController::monthPaymentRecursive($user, $user, $data, $algorithm, 0, 0, $lucky_week);
    }

    private static function monthPaymentRecursive(User $user, User $user_to, $info, $algorithm, $step, $left_money, $lucky_week) {
        $month_price = Config::get('const.month_price');
        if($left_money == 0 && $step == 0) $left_money = $month_price;

        if($user_to->position->level_id == 1 || count($algorithm) == $step) {

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
        $process = InternalTransaction::createNew($data);

        $step++;

        return PaymentController::monthPaymentRecursive($user, $user_to, $info, $algorithm, $step, $left_money, $lucky_week);
    }

    public static function checkLuckyWeek(User $user) {
        if(!is_null($user->reffer)) {

            $lucker = Config::get('const.lucky_steps');
            $fulltime = 0;
            $steps = 0;

            foreach ($lucker as $lucky) {
                $fulltime += $lucky[0];
                $steps++;
            }

            if($fulltime == 0) { return false;
            } else {
                $now = Carbon::now();
                $reseter = ''.$fulltime.' seconds';
                $date = $now->modify($reseter);

                if($user->reffer->created_at > $date) return false;

                return true;
            }

        } else {
            return false;
        }
    }

    public static function processLuckyWeek($user, $value) {
        $lucker = Config::get('const.lucky_steps');
        $now = Carbon::now();

        foreach ($lucker as $lucky) {
            $reseter = ''.$lucky[0].' seconds';
            $date = $now->modify($reseter);

            if($user->reffer->created_at < $date) {
                $mult = $lucky[1]/100;
                $data = [
                    'pocket_from_id'=>$user->pocket->id,
                    'pocket_to_id'=>$user->reffer->pocket->id,
                    'value'=>$value*$mult
                ];
                $process = InternalTransaction::createNew($data);

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
        $process = InternalTransaction::createNew($data);
    }

    public static function setLastPayment($user) {
        $user->pocket->last_payment = Carbon::now();
        $user->save();
        return true;
    }

}
