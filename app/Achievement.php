<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Achievement extends Model
{
    protected $fillable = ['name', 'description'];
    public function users() {
        return $this->belongsToMany(User::class, 'user_achievement');
    }
    public function getAchievementLevel($user_id) {
        return DB::table('user_achievement')
            ->where([['user_id','=',$user_id],['achievement_id','=',$this->id]])
            ->first()->level;
    }
    public function setAchievementLevel($user_id, $level) {
        return DB::table('user_achievement')
            ->where([['user_id','=',$user_id],['achievement_id','=',$this->id]])
            ->update(['level'=>$level]);
    }
}
