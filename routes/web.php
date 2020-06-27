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
Route::get('/', 'HomeController@index')->name('home');
    

//ゲーム機能 画面

    Route::get('game', 'GameController@add'); //スタート画面
    Route::get('game/method', 'GameController@method');
    Route::get('game/gameover', 'GameController@gameover');
    Route::get('game/clear', 'GameController@clear');
    
    Route::get('game/battle', 'HomeController@battle')->name('battle');
    Route::get('game/api/battle', 'HomeController@json');

//プロフィール

   Route::get('profile/create', 'ProfileController@add')->middleware('auth');
   Route::post('profile/create', 'ProfileController@create')->middleware('auth');
   Route::get('profile/edit', 'ProfileController@edit')->middleware('auth');
   Route::post('profile/edit', 'ProfileController@update')->middleware('auth');
   Route::get('profile', 'ProfileController@index')->middleware('auth');
   Route::get('profile/delete', 'ProfileController@delete')->middleware('auth');

// ゲーム機能　モンスター

Route::group(['prefix' => 'admin'], function () {
    Route::get('monster/create', 'Admin\MonsterController@create')->middleware('auth');
    Route::get('monster/index', 'Admin\MonsterController@index')->middleware('auth');
    Route::get('monster/edit', 'Admin\MonsterController@edit')->middleware('auth');
    Route::post('monster/edit', 'Admin\MonsterController@update')->middleware('auth');
    Route::get('monster/show', 'Admin\MonsterController@show')->middleware('auth');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// マルチ認証
Route::group(['prefix' => 'admin'], function () {
    // AdminHome
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login');
    
    Route::get('/home', 'Admin\HomeController@index')->name('admin.home');
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
});

// 問い合わせフォーム
Route::get('BBS/add', 'PagesController@add');
Route::get('BBS/question', 'PagesController@question');
Route::post('BBS/regist', 'PagesController@regist');

//別アプリからのログイン

// google

Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

//Voyager

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
