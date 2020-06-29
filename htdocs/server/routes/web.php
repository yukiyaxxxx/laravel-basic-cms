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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
