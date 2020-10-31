<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share([
            'errors' => function () {
                return \Session::get('errors')
                    ? \Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
            'status' => function () {
                return \Session::get('status')
                    ? \Session::get('status')
                    : '';
            },
            'auth_admin' => function(){
                return \Auth::user();
            }
        ]);
    }
}
