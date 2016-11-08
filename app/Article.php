<?php

namespace App;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $fillable = ['text','short', 'author', 'comments', 'title', 'status', 'preview'];

    public function cat() {
        return $this->belongsToMany(Category::class, 'category_article');
    }

    public static function user_articles($page = false, $perPage = 10) {
        if(!$page)
            return Auth::user()->articles()->get();
        return Auth::user()->articles()
            ->latest()->skip(($page-1)*$perPage)
            ->take($perPage)->get();
    }
}
