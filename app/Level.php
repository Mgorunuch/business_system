<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Level extends Model {

    public static function newLevel() {
        $level = Level::create();
        $level->max_users = $level->set_max_users();
        $level->last_empty = 1;
        $level->save();
        return $level;
    }

    public function positions() {
        $this->hasMany(Position::class, 'level_id', 'id');
    }

    public static function findOrCreate($id) {
        $obj = static::find($id);
        return $obj ?: Level::newLevel();
    }

    public function set_max_users($count=false) {
        if(!$count) $count = Config::get('const.refers_count');
        if ($this->id == 1) return 1;
        return pow($count, ($this->id-1));
    }

    public function emptyPosition() {
        $refers_count = Config::get('const.refers_count');

        if(is_null($this->positionStatus($this->last_empty))) {
            $this->users_count++;
            $empty = $this->last_empty;
            $this->setLastEmpty($this->last_empty);
            $this->save();

            return [
                'position'          => $empty,
                'level'             => $this->id,
                'parent_position'   => ceil($this->last_empty/$refers_count)
            ];
        } else {
            $position = $this->last_empty+1;

            while(!is_null($this->positionStatus($position)) && $position <= $this->max_users) {
                $position++;
            }

            if(is_null($this->positionStatus($position)) && $position <= $this->max_users) {
                $this->users_count++;
                $this->setLastEmpty($position);
                $this->save();

                return [
                    'position'          => $position,
                    'level'             => $this->id,
                    'parent_position'   => ceil($position/$refers_count)
                ];
            } else {
                $this->full = 1;
                $level = Level::findOrCreate($this->id+1);
                return $level->emptyPosition();
            }
        }
    }

    public function emptyPositionUnder(Position $position) {
        $refers_count = Config::get('const.refers_count');

        $level_id = $position->level_id+1;
        $range = ['min'=>0,'max'=>0];
        $range['max'] = $position->level_position * $refers_count;
        $range['min'] = $range['max'] - $refers_count + 1;

        while( Level::findOrCreate($level_id)->full == 1 || !$this->checkRange($level_id, $range) ) {

            $level_id++;
            $range['max'] = $range['max'] * $refers_count;
            $range['min'] = ($range['min'] * $refers_count) - $refers_count + 1;

        }

        if($refers_count == ($range['max']-$range['min']+1)) {
            return $this->emptyInRange($level_id, $range);
        } else {
            return $this->findEmptyRecursiveInLevel($level_id, $range);
        }
    }

    public function findEmptyRecursiveInLevel($level_id, $range) {
        $refers_count = Config::get('const.refers_count');
        $step = ($range['max']-$range['min']+1)/$refers_count;

        for ($i = 0; $i < $refers_count; $i++) {

            $local_range['min'] = $range['min']+$step*$i;
            $local_range['max'] = $local_range['min']+$step-1;

            if($this->checkRange($level_id, $local_range)) {

                if($refers_count == ($local_range['max']-$local_range['min']+1)) {
                    return $this->emptyInRange($level_id, $local_range);
                }

                return $this->findEmptyRecursiveInLevel($level_id, $local_range);

            };

        }
        return false;
    }

    public function emptyInRange($level_id, $range) {
        $refers_count = Config::get('const.refers_count');

        for($i = $range['min']; $i <= $range['max']; $i++) {

            if( empty(Level::find($level_id)->positionStatus($i)) ) {
                $level = Level::find($level_id);
                $level->users_count++;
                $level->save();
                return [
                    'position'          => $i,
                    'level'             => $level_id,
                    'parent_position'   => ceil($i/$refers_count)
                ];
            }

        }
        return false;
    }

    public function checkRange($level_id, $range) {
        $count = Position::where([
            ['level_id', '=', $level_id],
            ['level_position', '>=', $range['min']],
            ['level_position', '<=', $range['max']]
        ])->count();

        if($count == ($range['max'] - $range['min']+1)) return false;
        return true;
    }

    public static function checkCountRange($level_id, $range) {
        $count = Position::where([
            ['level_id', '=', $level_id],
            ['level_position', '>=', $range['min']],
            ['level_position', '<=', $range['max']]
        ])->count();

        if(empty($count)) return false;
        if($count == ($range['max'] - $range['min']+1)) $full = 1;
        else $full = 0;
        return ['level_id'=>$level_id, 'count'=>$count, 'full'=>$full];
    }

    public function positionStatus($position) {
        return Position::where([
            ['level_id',       '=', $this->id],
            ['level_position', '=', $position]
        ])->first();
    }

    public function setLastEmpty($position) {
        if($position >= $this->max_users) {
            $this->last_empty = $position;
            $this->full = 1;
        } else {
            $this->last_empty = $position+1;
        }
    }
}
