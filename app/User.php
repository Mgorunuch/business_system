<?php

namespace App;

use App\Http\Controllers\PaymentController;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'reffer_id'
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

    public function getReferals($count=false) {
        if(!$count) {
            return DB::table('users')->where('reffer_id',$this->id)->select(['id','name','email','status'])->orderBy('created_at','asc')->get()->all();
        } else {
            return DB::table('users')->where('reffer_id',$this->id)->limit($count)->select(['id','name','email','status'])->orderBy('created_at','asc')->get()->all();
        }
    }

    public function getBanTimeDays($html=false) {
        $now = Carbon::today();
        $days_ban = Config::get('const.ban_after_frizz');
        $ban_day = Carbon::parse($this->updated_at);
        $ban_day->day += $days_ban;

        $diff = $ban_day->diffInDays($now);
        if(!$html) {
            return $diff;
        } else {
            if($diff == 1) return "<span class='text-danger'>Banned this night</span>";
            return $diff;
        }
    }

    public function getReferalByType($type, $action = 'count') {
        if($type == 'working') {
            $return = DB::table('users')->where([
                ['reffer_id', '=', $this->id],
                ['status', '=', 1]
            ]);
        } elseif($type == 'frizzed') {
            $return = DB::table('users')->where([
                ['reffer_id', '=', $this->id],
                ['status', '=', 2]
            ]);
        } elseif($type == 'banned') {
            $return = DB::table('users')->where([
                ['reffer_id', '=', $this->id],
                ['status', '=', 0]
            ]);
        }

        if(is_null($return)) return false;

        if($action == 'models') {
            return $return->get()->all();
        } else {
            return $return->count();
        }
    }

    public function getReferalCounts() {
        $counts = [];
        $counts['working'] = $this->getReferalByType('working');
        $counts['frizzed'] = $this->getReferalByType('frizzed');
        $counts['banned'] = $this->getReferalByType('banned');
        $counts['all'] = $counts['working'] + $counts['frizzed'] + $counts['banned'];
        return $counts;
    }

    public function getReferalWeek() {
        $counts = [];
        $today = Carbon::today();
        $i = 0;

        do {
            if($i == 0) {
                $counts[] = DB::table('users')->where([
                    ['reffer_id','=',$this->id],
                    ['created_at','>',$today]
                ])->count();
            } else {
                $day = Carbon::parse($today);
                $day->day -= $i;

                $day2 = Carbon::parse($day);
                $day2->day += 1;

                $counts[] = DB::table('users')->where([
                    ['reffer_id','=',$this->id],
                    ['created_at','>=',$day],
                    ['created_at','<=',$day2]
                ])->count();
            }
            $i++;
        } while($i < 7);

        return $counts;
    }

    public function getReferalTreeWeek() {
        $counts = [];

        $pos_ids = [];
        $pos = [[$this->position],[],[],[],[],[],[],[],[]];
        $itterations = 9;
        for($j = 0; $j < $itterations; $j++) {
            for($l = 0; $l < count($pos[$j]); $l++) {
                if($j != ($itterations-1)) {
                    $pos[] = $pos[$j][$l]->childrens();
                }
                foreach ($pos[$j][$l]->childrens(['id']) as $p) {
                    $pos_ids[] = $p['id'];
                }
            }
        }

        $today = Carbon::today();
        $i = 0;
        do {
            if($i == 0) {
                $counts[] = DB::table('positions')
                    ->whereIn('id',$pos_ids)
                    ->where([
                        ['created_at','>',$today]
                    ])->count();
            } else {
                $day = Carbon::parse($today);
                $day->day -= $i;

                $day2 = Carbon::parse($day);
                $day2->day += 1;

                $counts[] = DB::table('positions')
                    ->whereIn('id',$pos_ids)
                    ->where([
                        ['created_at','>=',$day],
                        ['created_at','<=',$day2]
                    ])->count();
            }
            $i++;
        } while($i < 7);

        return $counts;
    }

    public function getLuckyStep() {
        $now = Carbon::now();
        $lucky_steps = Config::get('const.lucky_steps');

        $created = Carbon::parse($this->position->created_at);
        if(PaymentController::checkLuckyWeek($this)) {
            foreach ($lucky_steps as $step) {
                $step_time = $created->addSecond($step[0]);
                if($step_time > $now) {
                    $diff = $step_time->diffInSeconds($now);
                    return [
                        'left_time' => $diff,
                        'mult' => $step[1],
                        'step' => $step[2]
                    ];
                }
            }
        };
        return false;
    }

    public function getPaymentLeft() {
        $now = Carbon::now();
        $payment = Carbon::parse($this->pocket->last_payment);
        $payment_period_seconds = Config::get('const.payment_period_seconds');

        if(!is_null($payment)) {
            $payment->addSecond($payment_period_seconds);
            return $payment->diffInSeconds($now);
        }
        return 00;
    }

    public function get_users_count() {
        $refers_count = Config::get('const.refers_count');
        $levels = [];
        $range = [];

        $pos = $this->position->level_position;
        $level = $this->position->level_id;

        $range['max'] = $pos;
        $range['min'] = $pos;
        $i = 0;
        do {
            $levels[$i] = [];

            $level++;
            $range['max'] = $range['max'] * $refers_count;
            $range['min'] = ($range['min'] * $refers_count) - $refers_count + 1;

            $lev = Level::checkCountRange($level, $range);
            if($lev == false) {
                $levels[$i]['id'] = $i+1;
                $levels[$i]['count'] = 0;
                $levels[$i]['full'] = 0;
            } else {
                $levels[$i]['id'] = $i+1;
                $levels[$i]['count'] = $lev['count'];
                $levels[$i]['full'] = $lev['full'];
            }
            $i++;
        } while($i < 9);

        return $levels;
    }

    public function add_achievement($id, $level) {
        $achievement = $this->achievements()->where('user_id',$id)->first();

        if(is_null($achievement)) {
            $this->achievements()->attach($id);
            $this->achievements()->find($id)->setAchievementLevel($this->id, $level);
        } elseif($achievement->getAchievementLevel($this->id) != $level) {
            $achievement->setAchievementLevel($this->id, $level);
        } else {
            return false;
        }
    }

    public function remove_achievement($id) {
        if(empty($this->achievements()->find($id))) return false;
        $this->achievements()->detach($id);
    }

    public function frizz_user() {
        $this->status = 2;
        $this->save();
    }

    public function activate_user() {
        $this->status = 1;
        $this->save();
    }

    public function ban_user() {
        $this->position->deletePosition();
        $refers = User::where('refer_id', $this->id)->get()->all();
        foreach($refers as $ref) {
            $ref->reffer_id = 1;
            $ref->save();
        }
        $this->status = 0;
        $this->save();
    }

    public function get_payment_hash() {
        return password_hash($this->id.'_'.$this->pocket->id.'_'.Config::get('PerfectMoney.HASH'),PASSWORD_DEFAULT);
    }

    public function hash_validate($hash) {
        return password_verify($this->id.'_'.$this->pocket->id.'_'.Config::get('PerfectMoney.HASH'), $hash);
    }
}
