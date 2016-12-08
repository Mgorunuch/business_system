<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pocket;
use Carbon\Carbon;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Input;

class SuperadminController extends Controller
{
    public function index() {
        return view('superadmin.index');
    }

    public function money_send(Request $request) {
        $all = $request->all();
        $user = User::where('name',$all['username'])->first();
        $user->pocket->add_balance($all['amount']);
        return back();
    }

    public function money_spend(Request $request) {
        $all = $request->all();
        $user = User::where('name',$all['username'])->first();
        $user->pocket->spend_balance($all['amount']);
        return back();
    }

    public function ban_user(Request $request) {
        $all = $request->all();
        $user = User::where('name', $all['username'])->first();
        $user->ban_user();
        return back();
    }

    public function frizz_user(Request $request) {
        $all = $request->all();
        $user = User::where('name', $all['username'])->first();
        $user->frizz_user();
        return back();
    }

    public function activate_user(Request $request) {
        $all = $request->all();
        $user = User::where('name', $all['username'])->first();
        $user->activate_user();
        return back();
    }

    public function get_user_info(Request $request) {
        $all = $request->all();
        $user = User::where('name', $all['username'])->first();
        $user_refers = $user->getReferalCounts();
        $next_payment = Carbon::parse($user->pocket->last_payment)->addMonth()->formatLocalized('%d %B %Y');
        $return = [
            'username' => $user->name,
            'status' => $user->status,
            'email' => $user->email,
            'refers' => $user_refers,
            'next_payment' => $next_payment,
            'tree' => $next_payment,
            'balance' => $user->pocket->full_ballance()
        ];
        return response()->json($return);
    }

    public function delete_banned_user(Request $request) {
        $all = $request->all();
        $user = User::where('name', $all['username'])->first();
        if(!$user) $request = ['error'=>"Can`t find user ".$all["username"]];
        else {
            if($user->status == 0) {
                $username = $user->name;
                $user->delete();
                $request = ['message'=>"$username deleted!"];
            } else {
                $request = ['error'=>"User not banned! user status = $user->status"];
            }
        }
        return response()->json($request);
    }

    public function set_last_payment(Request $request) {
        $all = $request->all();
        $user = User::where('name', $all['username'])->first();
        $user->pocket->last_payment = \Carbon\Carbon::now();
        return back();
    }

    public function reset_lucky_week(Request $request) {
        $all = $request->all();
        $user = User::where('name', $all['username'])->first();
        $user->position->created_at = \Carbon\Carbon::now();
        return back();
    }
}
