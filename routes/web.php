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
Route::group(['middleware' => 'auth.admin'], function() {

    Route::get('/dashboard/moderate/articles', 'ArticleController@moderate');
    Route::get('/dashboard/moderate/articles/allow/{id}', 'ArticleController@activate');
    Route::post('/dashboard/moderate/articles/decline/{id}', 'ArticleController@decline');

    Route::get('/dashboard/moderate/categories', 'CategoriesController@moderate');
    Route::post('/dashboard/moderate/categories/edit/{id}', 'CategoriesController@edit');

    Route::get('/dashboard/moderate/payments', 'PaymentController@moderate');
    Route::post('/dashboard/moderate/payments/change_status', 'PaymentController@change_status');

});
Route::group(['middleware' => 'auth.activated'], function () {

    Route::post('/payments/withdraw', 'PaymentController@withdraw');

    Route::get('/settings', function (){
        return view('dashboard.user.settings',['user'=>\Illuminate\Support\Facades\Auth::user()]);
    });
    Route::get('/achievements', function (){
        return view('dashboard.user.achievements',['user'=>\Illuminate\Support\Facades\Auth::user()]);
    });
    Route::get('/referal', function (){
        return view('dashboard.user.referal',[
            'user'=>\Illuminate\Support\Facades\Auth::user(),
            'withdraw_processing' => \App\Http\Controllers\PaymentController::getWithdraw(),
            'config'=>\Illuminate\Support\Facades\Config::get('PerfectMoney'),
            'levels'=>\Illuminate\Support\Facades\Auth::user()->get_users_count(),
            'referals'=>\Illuminate\Support\Facades\Auth::user()->getReferals(10),
            'referal_counts'=>\Illuminate\Support\Facades\Auth::user()->getReferalCounts(),
            'referal_week'=>\Illuminate\Support\Facades\Auth::user()->getReferalWeek(),
            'referal_tree_week'=>\Illuminate\Support\Facades\Auth::user()->getReferalTreeWeek(),
            'left_time_lucky'=>\Illuminate\Support\Facades\Auth::user()->getLuckyStep(),
            'payment_left_time'=>\Illuminate\Support\Facades\Auth::user()->getPaymentLeft()
        ]);
    });

    Route::post('/user/password_change', 'UserController@changePassword');
    Route::post('/user/info_change', 'UserController@changeInfo');
    Route::post('/user/image_change', 'UserController@image_change');

    Route::get('/blog', function() {
        return view('dashboard.blog.main', [
            'articles'=>
                [
                    'pool'=>\App\Category::find(1)->getArticles(1),
                    'cat'=>1,
                    'page'=>1,
                    'pages'=>\App\Category::find(1)->getPaginate()
                ]
        ]);
    });

    Route::get('/blog/article/new', 'ArticleController@create');
    Route::post('/blog/article/new', 'ArticleController@store');
    Route::post('/blog/article/destroy/{id}', 'ArticleController@destroy');
    Route::post('/blog/article/addLike/{id}', 'ArticleController@addLike');
    Route::post('/blog/article/addDislike/{id}', 'ArticleController@addDislike');

    Route::get('/blog/my-articles', function() {
        return view('dashboard.blog.main', [
            'articles'=>[
                'pool'=>\App\Article::user_articles(1,10),
                'page'=>1,
                'cat'=>'my-articles',
                'pages'=>ceil(\Illuminate\Support\Facades\Auth::user()->articles()->count() / 10)
            ]
        ]);
    });
    Route::get('/blog/my-articles/{page_id}', function($page_id) {
        return view('dashboard.blog.main', [
            'articles'=>[
                'pool'=>\App\Article::user_articles($page_id,10),
                'page'=>$page_id,
                'cat'=>'my-articles',
                'pages'=>ceil(\Illuminate\Support\Facades\Auth::user()->articles()->count() / 10)
            ]
        ]);
    });

    Route::get('/blog/article/edit/{id}', 'ArticleController@edit');
    Route::post('/blog/article/edit/{id}', 'ArticleController@update');

    Route::get('/blog/article/{id}', 'ArticleController@show');

    Route::post('/blog/categories/new', 'CategoriesController@create');

    Route::get('/blog/{cat_id}/', function ($cat_id) {
        return view('dashboard.blog.main')->with([
            'articles'=>[
                'pool'=>\App\Category::find($cat_id)->getArticles(1),
                'page'=>1,
                'cat'=>$cat_id,
                'pages'=>\App\Category::find(1)->getPaginate()
            ]
        ]);
    });
    Route::get('/blog/{cat_id}/{page}/', function ($cat_id, $page_id) {
        return view('dashboard.blog.main')->with([
            'articles'=>[
                'pool'=>\App\Category::find($cat_id)->getArticles($page_id),
                'page'=>$page_id,
                'cat'=>$cat_id,
                'pages'=>\App\Category::find($page_id)->getPaginate()
            ]
        ]);
    });
    Route::get('/home', function (){
        return redirect('/referal');
    });
});
Route::group(['middleware' => 'auth.frizzed'], function () {
    Route::get('/home', function (){
        return redirect('/payments/pay');
    });
    Route::get('/payments/pay', 'PaymentController@index');
});
