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

//ゲーム機能

Route::group(['prefix' => 'admin'], function () {
    Route::get('game/create', 'Admin\CreateController@add'); //スタート画面
    Route::get('game/method', 'Admin\CreateController@method'); //操作説明
    Route::get('game/start', 'Admin\CreateController@start')->middleware('auth');
    Route::get('game/gameover', 'Admin\CreateController@gameover');
    Route::get('game/clear', 'Admin\CreateController@clear')->middleware('auth');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// マルチ認証
Route::group(['prefix' => 'admin'], function () {
    // AdminHome
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');
    //login&logout
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login');
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
});

// 問い合わせフォーム
Route::get('BBS/add', 'PagesController@add');
Route::post('BBS/regist', 'PagesController@regist')->middleware('auth');
