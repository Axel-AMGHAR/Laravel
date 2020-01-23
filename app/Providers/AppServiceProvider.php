<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::if('isClient', function (){
            return \Auth::check() && \Auth::user()->role == 1;
        });
        $pro_users_count = Cache::remember('pro_users_count', 60*60,function() {
            return \App\User::where('role', 2)->count();
        });
        View::share('pro_users_count', $pro_users_count);
    }
}
