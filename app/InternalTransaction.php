<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternalTransaction extends Model
{
    protected $fillable = [
        'value', 'pocket_from_id', 'pocket_to_id'
    ];

    public static function createNew($data) {
        $payment = InternalTransaction::create($data);
        $payment->to->pocket->add_balance($payment->value);
        $payment->from->pocket->spend_balance($payment->value);
    }
    public function from() {
        return $this->hasOne(User::class, 'pocket_id', 'pocket_from_id');
    }
    public function to() {
        return $this->hasOne(User::class, 'pocket_id', 'pocket_to_id');
    }
}
