<?php

namespace App\Http\Controllers\Auth;

use App\Classes\Mailer;
use App\Pocket;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:users|without_spaces',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'reffer_id' => 'min:1'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        if(!is_null($data['reffer_id'])) {
            $refer = User::where('name',$data['reffer_id'])->first();
        }
        if(is_null($refer)) {
            $refer = 1;
        } else {
            $refer = $refer->id;
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'reffer_id' => $refer,
        ]);

        $pocket = Pocket::create();
        $user->pocket_id = $pocket->id;
        $user->save();
        // TODO: DELETE AFTER TEST WEEK
        $user->pocket->add_balance(10);
        // DELETE AFTER TEST WEEK
        Mailer::send_email_registred($user);

        return $user;
    }
}
