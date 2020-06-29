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


Route::prefix('article')->group(function () {

    Route::get('', 'ArticleController@list')->name('article.list');
    Route::get('detail/{article}', 'ArticleController@detail')->name('article.detail');

});

// Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// // Password Reset Routes...
// if ($options['reset'] ?? true) {
//     $this->resetPassword();
// }
//
// // Password Confirmation Routes...
// if ($options['confirm'] ??
//     class_exists($this->prependGroupNamespace('Auth\ConfirmPasswordController'))) {
//     $this->confirmPassword();
// }
//
// // Email Verification Routes...
// if ($options['verify'] ?? false) {
//     $this->emailVerification();
// }

Route::get('/home', 'HomeController@index')->name('home');


// ログイン領域
Route::group([
    'middleware' => [
        'auth'
    ]
], function () {
    Route::prefix('admin')->group(function () {

        Route::get('test', function () {
            dd('test');
        });


        Route::prefix('article')->group(function () {
            Route::get('', 'Admin\ArticleController@list')->name('admin.article.list');
            Route::get('create', 'Admin\ArticleController@create')->name('admin.article.create');
            Route::post('store', 'Admin\ArticleController@store')->name('admin.article.store');
            Route::get('edit/{article}', 'Admin\ArticleController@edit')->name('admin.article.edit');
            Route::post('update/{article}', 'Admin\ArticleController@update')->name('admin.article.update');
            Route::post('destroy/{article}', 'Admin\ArticleController@destroy')->name('admin.article.destroy');
        });


    });
});

