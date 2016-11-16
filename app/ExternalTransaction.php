<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalTransaction extends Model
{
    protected $fillable = [
        'value', 'vallet_from', 'vallet_to', 'pocket_id', 'status', 'type'
    ];

    public function pocket() {
        return $this->hasOne(Pocket::class, 'id', 'pocket_id');
    }

    public static function createNew($data) {
        $payment = ExternalTransaction::create($data);
        $pocket = $payment->user->pocket;

        if($payment->status == 'success' && $payment->type == 'put') {

            $pocket->add_balance($payment->value);

        } elseif($payment->type == 'withdraw') {

            $pocket->spend_balance($payment->value);

        }
    }
    public function user() {
        return $this->hasOne(User::class, 'pocket_id', 'pocket_id');
    }
}
