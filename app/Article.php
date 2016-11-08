<?php

namespace App;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $fillable = ['text','short', 'author', 'comments', 'title', 'status', 'preview', 'category'];

    public static function getArticles($page = 1, $category_id = false, $perPage = 10) {
        if(!$category_id) {

            return Article::where([['status','=','1']])->latest()->skip(($page-1)*$perPage)->take($perPage)->get();

        } elseif ($category_id == 'my-articles') {

            return Article::where([['author','=',Auth::user()->id]])->latest()->skip(($page-1)*$perPage)->take($perPage)->get();

        } else {

            return Article::where([
                ['status','=','1'],
                ['category','=',$category_id]
            ])->latest()->skip(($page-1)*$perPage)->take($perPage)->get();

        }
    }

    public static function getPaginate($category_id = false, $perPage = 10) {
        if(!$category_id) {
            $count = Article::all()->count();
        } else {
            $count = Article::where([
                ['status','=','1'],
                ['category','=',$category_id]
            ])->count();
        }
        $pages = ceil($count/$perPage);
        return $pages;
    }
}
