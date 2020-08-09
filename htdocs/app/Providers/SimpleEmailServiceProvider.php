<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Validator;

class SimpleEmailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('simple_email', function ($attribute, $value, $parameters, $validator) {

            $fixedEmail = preg_replace('/(?<!:)\.{2,}/', '.', $value);  // 連続したドット（.）をひとつにする
            $fixedEmail = str_replace('.@', '@', $fixedEmail);                    // アットマーク（@）直前のドット（.）を取り除く

            return filter_var($fixedEmail, FILTER_VALIDATE_EMAIL) !== false;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
