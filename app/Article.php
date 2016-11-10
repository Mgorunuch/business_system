<?php

namespace App;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ['text','short', 'author', 'comments', 'title', 'status', 'preview'];

    protected $dates = ['deleted_at'];

    public function cat() {
        return $this->belongsToMany(Category::class, 'category_article');
    }

    public function likes() {
        return $this->belongsToMany(User::class, 'article_user_rating');
    }

    public function author() {
        return User::find($this->author);
    }

    public static function user_articles($page = false, $perPage = 10) {
        if(!$page)
            return Auth::user()->articles()->get();
        return Auth::user()->articles()
            ->orderBy('updated_at', 'desc')->skip(($page-1)*$perPage)
            ->take($perPage)->get();
    }

    public function checkRatingAction(User $user) {
        $action = DB::table('article_user_rating')->where([
            'article_id'=>$this->id,
            'user_id'=>$user->id
        ])->first();
        if(!empty($action)) {
            return $action->action;
        }
        return 0;
    }

    public function addLike(User $user) {
        $action_history = $this->checkRatingAction($user);

        if($action_history == '2') {
            $this->disableRating($user);
            $this->addLike($user);
        } elseif($action_history == '1') {
            $this->disableRating($user);
        } else {
            $this->rating++;
            DB::table('article_user_rating')->insert([
                'article_id'=>$this->id,
                'user_id'=>$user->id,
                'action'=>1
            ]);
            $this->save();
        }
    }

    public function addDislike(User $user) {
        $action = $this->checkRatingAction($user);

        if($action == '1') {
            $this->disableRating($user);
            $this->addDislike($user);
        } elseif($action == '2') {
            $this->disableRating($user);
        } else {
            $this->rating--;
            DB::table('article_user_rating')->insert([
                'article_id'=>$this->id,
                'user_id'=>$user->id,
                'action'=>2
            ]);
            $this->save();
        }
    }

    public function disableRating(User $user) {
        $action = $this->checkRatingAction($user);
        if($action == 2) {
            $this->rating++;
            DB::table('article_user_rating')->where([
                ['article_id', '=', $this->id],
                ['user_id', '=', $user->id],
                ['action', '=', 2]
            ])->delete();
        } elseif ($action == 1) {
            $this->rating--;
            DB::table('article_user_rating')->where([
                ['article_id', '=', $this->id],
                ['user_id', '=', $user->id],
                ['action', '=', 1]
            ])->delete();
        }
        $this->save();
    }
}
