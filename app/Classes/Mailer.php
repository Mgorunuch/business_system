<?php

namespace App\Classes;

use Mail;
use App\User;

class Mailer
{
    public static function send_email_registred(User $user) {
        Mail::send('emails.ru.new_register', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Вы успешно зарегистрированы!');
        });
    }
}