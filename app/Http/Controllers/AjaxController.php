<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class AjaxController extends Controller
{

    public function getReffers(Request $request) {
        $from = $request->from;
    	$users = DB::table('users')->where('reffer_id',Auth::user()->id)->select(['id','name','email','status'])->orderBy('created_at','asc')->skip($from)->limit(10)->get()->all();
        $answer = [];
        foreach($users as $user) {
            $answer[] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'reffers_invited' => User::where('reffer_id',$user->id)->count()
            ];
        }
        return response()->json($answer);
    }

    public function getBallance(Request $request) {
        return Auth::user()->pocket->full_ballance();
    }

    public function gainedAllTime() {
        return Auth::user()->pocket->earned_all_time;
    }

}
