<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/blog/article/new', 'ArticleController@create');

    Route::get('/blog/article/edit/{id}', function($id) {
        return view('dashboard.blog.article.edit', ['article'=>\App\Article::where('id','=',$id)->first()]);
    });

    Route::post('/blog/article/edit/{id}', 'ArticleController@update');

    Route::get('/blog/article/{id}', 'ArticleController@show');

    Route::post('/blog/categories/new', 'CategoriesController@create');

    Route::get('/blog', function() {
        return view('dashboard.blog.main')->with(['cat'=>0,'page'=>1]);
    });

    Route::get('/blog/{cat_id}/', function ($cat_id) {
        return view('dashboard.blog.main')->with(['cat'=>$cat_id,'page'=>1]);
    });

    Route::get('/blog/{cat_id}/{page}/', function ($cat_id, $page_id) {
        return view('dashboard.blog.main')->with(['cat'=>$cat_id,'page'=>$page_id]);
    });

    Route::post('/blog/article/new', 'ArticleController@store');

    Route::get('/home', 'HomeController@index');
});
