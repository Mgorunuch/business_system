<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class InternalTransaction extends Model
{
    protected $fillable = [
        'value', 'pocket_from_id', 'pocket_to_id'
    ];

    public static function checkAllowed($bool=false) {
        $reffs_need = config('const.internal_active_reffers');
        $reffs_have = Auth::user()->getReferalByType('working');
        if($reffs_need > $reffs_have && $bool == false) {
            abort(403, 'Not allowed for this user.');
        } else {
            if($reffs_need > $reffs_have) {
                return false;
            } else {
                return true;
            }
        }
    }

    public static function createNew($data, $month=false) {
        if($month) {
            $value_with_fee = $data['value'];
        } else {
            self::checkAllowed();
            $value_with_fee = self::calculate_with_fee($data['value']);
        }
        
        $payment = InternalTransaction::create($data);
        $payment->to
            ->pocket
            ->add_balance($payment->value);
        $payment->from
            ->pocket
            ->spend_balance($value_with_fee);
            
        return $payment;
    }
    public function from() {
        return $this->hasOne(User::class, 'pocket_id', 'pocket_from_id');
    }
    public function to() {
        return $this->hasOne(User::class, 'pocket_id', 'pocket_to_id');
    }

    public static function calculate_with_fee($value) {
        $fees = config('const.fees.internal_active_reffers');
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
