<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('isset_in_categories', function($attribute, $value, $parameters, $validator) {
            $cat = Category::where('id','=',$value)->first();
            return ($cat != null);
        });
        Validator::extend('isset_in_countries', function($attribute, $value, $parameters, $validator) {
            $cat = DB::table('countries')->where('code','=',$value)->count();
            return ($cat != 0);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
