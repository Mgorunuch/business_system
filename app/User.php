<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles() {
        return $this->hasMany(Article::class, 'author', 'id');
    }

    public function pocket() {
        return $this->hasOne(Pocket::class, 'id', 'pocket_id');
    }

    public function achievements() {
        return $this->belongsToMany(Achievement::class, 'user_achievement');
    }

    public function position() {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }

    public function parent() {
        return $this->position->parent()->user;
    }

    public function reffer() {
        return $this->hasOne(User::class, 'id', 'reffer_id');
    }

    public function add_achievement($id) {
        if(!empty($this->achievements()->find($id))) return false;
        $this->achievements()->attach($id);
    }

    public function remove_achievement($id) {
        if(empty($this->achievements()->find($id))) return false;
        $this->achievements()->detach($id);
    }

    public function frizz_user() {
        $this->status = 2;
        $this->save();
    }

    public function get_payment_hash() {
        return password_hash($this->id.'_'.$this->pocket->id.'_'.Config::get('PerfectMoney.HASH'),PASSWORD_DEFAULT);
    }

    public function hash_validate($hash) {
        return password_verify($this->id.'_'.$this->pocket->id.'_'.Config::get('PerfectMoney.HASH'), $hash);
    }
}
