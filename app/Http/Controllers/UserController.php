<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function changePassword(Request $request) {
        $all = $request->all();

        Validator::make($all, [
            'password' => 'required|min:6|confirmed'
        ])->validate();

        if(Hash::check($all['current_password'], Auth::user()->password)) {
            Auth::user()->password = bcrypt($all['password']);
            Auth::user()->save();
        };
        return back()->with(['message'=>'Password Changed']);
    }

    public function changeInfo(Request $request) {
        $all = $request->all();

        if($all['country'] == '0') unset($all['country']);
        if($all['sex'] == '0') unset($all['sex']);

        Validator::make($all,[
            'country'           => 'isset_in_countries',
            'city'              => 'string|max:255|min:2',
            'name'              => 'string|max:255|min:3',
            'sex'               => 'in:man,woman',
            'status_message'    => 'string:,max:255'
        ])->validate();

        if(isset($all['country']))
            Auth::user()->country_code = $all['country'];

        if(isset($all['sex']))
            Auth::user()->sex = $all['sex'];

        if(isset($all['status_message']))
            Auth::user()->status_message = $all['status_message'];

        if(!empty($all['name']))
            Auth::user()->full_name = $all['name'];

        if(!empty($all['city']))
            Auth::user()->city = $all['city'];

        Auth::user()->save();
        return back()->with(['message'=>'Information Changed']);
    }

    public function image_change(Request $request) {

        $all = $request->all();

        Validator::make($all, [
            'profile_image' => 'required|image|dimensions:min_width=100,min_height=100,max_width=200,max_height=200',
        ])->validate();

        $date = date('d.m.y');
        $root = $_SERVER['DOCUMENT_ROOT']."/images/profile/";
        if(!file_exists($root.$date)) File::makeDirectory($root.$date, 0700, true);

        $f_name = $request->file('profile_image')->getClientOriginalName();
        $server_filename = Carbon::now()->timestamp.rand(1,10).'.'.$request->file('profile_image')->getClientOriginalExtension();

        $request->file('profile_image')->move($root.$date,$server_filename);
        $all['preview'] = '/images/profile/'.$date.'/'.$server_filename;

        Auth::user()->profile_image = $all['preview'];
        Auth::user()->save();

        return back()->with(['message'=>'Image changed']);

    }
}
