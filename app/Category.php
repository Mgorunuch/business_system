<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function articles() {
        return $this->belongsToMany(Article::class, 'category_article');
    }

    public static function check($id) {
        return !(empty(Category::find($id)->get()));
    }

    public function parse_articles() {
        return $this->articles();
    }

    public function getArticles($page = 1, $all = false, $perPage = 10) {
        if($all) {

            return Article::where([['status','=','1']])->orderBy('updated_at', 'asc')->skip(($page-1)*$perPage)->take($perPage)->get();

        } else {

            return $this
                ->articles()
                ->where('status','=','1')
                ->latest()
                ->skip(($page-1)*$perPage)
                ->take($perPage)
                ->get();

        }
    }

    public function getPaginate($all = false, $perPage = 10) {

        $count = $this
            ->articles()
            ->where('status','=','1')
            ->count();

        $pages = ceil($count/$perPage);

        return $pages;
    }

}
