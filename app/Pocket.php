<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Pocket extends Model
{
    public function user() {
        return $this->hasOne(User::class, 'pocket_id', 'id');
    }

    public function withdraw() {
        return $this->hasMany(ExternalTransaction::class, 'pocket_id', 'id');
    }

    /**
     * @return mixed
     */
    public function full_ballance() {
        return $this->frizzed_value + $this->value;
    }

    /**
     * Add $amount to balance
     * @param $amount
     * @return bool
     */
    public function add_balance($amount) {
        $this->value += $amount;
        $this->earned_all_time += $amount;

        $this->save();
        return $this->balance_pocket();
    }

    /**
     * Spend $amount from balance
     * @param $amount
     * @return bool
     */
    public function spend_balance($amount) {
        $this->value += $this->frizzed_value;
        $this->frizzed_value -= $this->frizzed_value;
        if(($this->value - $amount) < 0)
            return false;

        $this->value -= $amount;
        $this->save();
        return $this->balance_pocket();
    }

    /**
     * Check balance. If cant pay FRIZZ
     * @return bool
     */
    public function check_balance() {
        $month_payment = Config::get('const.month_price');
        if($this->frizzed_value == $month_payment) {
            return true;
        } else {
            if($this->balance_pocket()) {
                return true;
            } else {
                $this->user->frizz_user();
                return false;
            }
        }
    }

    /**
     * Balancing Frizzed Value and normal value
     * @return bool
     */
    public function balance_pocket() {
        $month_payment = Config::get('const.month_price');

        /**
         *  1. Если замороженый больше месячной оплаты
         *  2. Если замороженый меньше месячной оплаты и полный баланс больше месячной оплаты
         *  3. Если полный баланс меньше месячной оплаты
         */
        if($this->frizzed_value == $month_payment) {

            return true;

        } elseif ($this->frizzed_value > $month_payment) { //1

            $need = $this->frizzed_value - $month_payment;
            $this->frizzed_value -= $need;
            $this->value += $need;
            $this->save();
            return true;

        } elseif ($this->frizzed_value < $month_payment
            && $this->value + $this->frizzed_value >= $month_payment) { // 2

            $need = $month_payment - $this->frizzed_value;
            $this->value -= $need;
            $this->frizzed_value += $need;
            $this->save();
            return true;

        } else { // 3

            $this->frizzed_value += $this->value;
            $this->save();
            return false;

        }
    }

    /**
     * @param $amount
     * @param User $user_to
     * @return bool
     */
    public function sendTo($amount, User $user_to) {
        if($this->user->status != 1) return false;

        $ballance = $this->value + $this->frizzed_value;

        if($ballance >= $amount) {
            $data = [
                'pocket_from_id' => $this->id,
                'pocket_to_id' => $user_to->pocket->id,
                'value' => $amount
            ];
            $transaction = InternalTransaction::createNew($data);
            return true;
        }
        return false;
    }
}
