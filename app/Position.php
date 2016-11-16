<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Position extends Model
{
    protected $fillable = ['user_id', 'level_id', 'level_position', 'parent_position'];

    public static function createNewPosition($user_id) {
        $refer_id = User::find($user_id)->reffer_id;

        if (!is_null($refer_id) && $refer_id != 1) {
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

    public function childrens($select=false) {
        $level = $this->level_id+1;
        if(!$select) {
            return Position::where([
                ['level_id', '=', $level],
                ['parent_position', '=', $this->level_position]
            ])->get();
        } else {
            return Position::where([
                ['level_id', '=', $level],
                ['parent_position', '=', $this->level_position]
            ])->select($select)->get()->all();
        }
    }

    public function user() {
        return $this->hasOne(User::class, 'position_id', 'id');
    }

    public function deletePosition() {
        $this_level = $this->level_id;
        $this_level_position = $this->level_position;
        $this_parent_position = $this->parent_position;

        if($this->automatic_top_bias($this_level, $this_level_position, $this_parent_position)) {
            $this->delete();
        };
    }
    public function automatic_top_bias($new_level, $new_level_position, $new_parent_position) {
        $refers_count = Config::get('const.refers_count');

        $next_level_position = $new_level_position * $refers_count - ($refers_count - 1);
        $position = Position::where([
            ['level_position','=',$next_level_position],
            ['level_id','=',$new_level+1]
        ])->first();
        if(is_null($position)) {
            return true;
        }
        $this_level = $position->level_id;
        $this_level_position = $position->level_position;
        $this_parent_position = $position->parent_position;

        $position->level_id = $new_level;
        $position->level_position = $new_level_position;
        $position->parent_position = $new_parent_position;
        $position->save();

        return $this->automatic_top_bias($this_level, $this_level_position, $this_parent_position);
    }
}
