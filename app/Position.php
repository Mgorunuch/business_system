<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['user_id', 'level_id', 'level_position', 'parent_position'];

    public static function createNewPosition($user_id, $refer_id=false) {
        if ($refer_id != false) {
            $refer = User::find($refer_id);
            $position = Level::find($refer->position->level_id)->emptyPositionUnder($refer->position);
        } else {
            $level = Level::where('full','=',0)->first();
            if(is_null($level)) $level = Level::newLevel();
            $position = $level->emptyPosition();
        }

        $attributes = [
            'user_id'           => $user_id,
            'level_id'          => $position['level'],
            'level_position'    => $position['position'],
            'parent_position'   => $position['parent_position']
        ];
        return Position::create($attributes);
    }

    public function level() {
        return $this->hasOne(Level::class, 'id', 'level_id');
    }

    public function parent() {
        $level = $this->level_id-1;
        return Position::where([
            ['level_id', '=', $level],
            ['level_position', '=', $this->parent_position]
        ])->first();
    }

    public function childrens() {
        $level = $this->level_id+1;
        return Position::where([
            ['level_id', '=', $level],
            ['parent_position', '=', $this->level_position]
        ])->first();
    }

    public function user() {
        return $this->hasOne(User::class, 'position_id', 'id');
    }
}
