<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ExternalTransaction extends Model
{
    protected $fillable = [
        'value', 'vallet_from', 'vallet_to', 'pocket_id', 'status', 'type', 'PAYMENT_BATCH_NUM'
    ];

    public function pocket() {
        return $this->hasOne(Pocket::class, 'id', 'pocket_id');
    }

    public static function checkAllowed($type) {
        if($type == 'withdraw') {
            $reffs_need = config('const.external_active_reffers.withdraw');
        } elseif($type == 'put') {
            $reffs_need = config('const.external_active_reffers.put');
        }
        $reffs_have = Auth::user()->getReferalByType('working');
        if($reffs_need > $reffs_have) {
            abort(403, 'Not allowed for this user.');
        }
    }

    public static function createNew($data) {
        self::checkAllowed($data['type']);

        $transactions_count = ExternalTransaction::where([['PAYMENT_BATCH_NUM','=',$data['PAYMENT_BATCH_NUM']]])->count();
        if($transactions_count > 0) {
            //abort(403, 'Very funny, msfc.');
            return false;
        }

        $value_with_fee = self::calculate_with_fee($data['value']);

        $payment = ExternalTransaction::create($data);
        $pocket = $payment->user->pocket;

        if($payment->status == 'success' && $payment->type == 'put') {
            $pocket->add_balance($payment->value);
        } elseif($payment->type == 'withdraw') {
            $pocket->spend_balance($value_with_fee);
        }

        return $payment;
    }
    public function user() {
        return $this->hasOne(User::class, 'pocket_id', 'pocket_id');
    }

    public static function calculate_with_fee($value) {
        $fees = config('const.fees.external_active_reffers.withdraw');
        $active_reffers = Auth::user()->getReferalByType('working');
        $calculated_fee = false;

        foreach($fees as $fee) {
            if($active_reffers >= $fee[0]) {
                $calculated_fee = $fee[1];
                break;
            }
        }

        return $value + (($value / 100) * $calculated_fee);
    }
}
