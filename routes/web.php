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

//ゲーム機能 画面

Route::group(['prefix' => 'admin'], function () {
    Route::get('game/create', 'Admin\GameController@add')->middleware('auth'); //スタート画面
    Route::get('game/method', 'Admin\GameController@method')->middleware('auth'); //操作説明
    Route::get('game/start', 'Admin\GameController@start')->middleware('auth');
    Route::get('game/gameover', 'Admin\GameController@gameover')->middleware('auth');
    Route::get('game/clear', 'Admin\GameController@clear')->middleware('auth');
});

    Route::get('game/register', 'Admin\GameController@register')->middleware('auth');//ユーザー登録
    Route::get('game/login', 'Admin\GameController@login')->middleware('auth');//ログイン画面

// ゲーム機能　ステータス

Route::group(['prefix' => 'admin'], function () {
    Route::get('status/id', 'Admin\StatusController@id')->middleware('auth');
    Route::get('status/name', 'Admin\StatusController@name')->middleware('auth');
    Route::get('status/hp', 'Admin\StatusController@hp')->middleware('auth');
    Route::get('status/atk', 'Admin\StatusController@atk')->middleware('auth');
    Route::get('status/def', 'Admin\StatusController@def')->middleware('auth');
});


// ゲーム機能　モンスター

Route::group(['prefix' => 'admin'], function () {
    Route::get('monster/create', 'Admin\MonsterController@create')->middleware('auth');
    Route::get('monster/index', 'Admin\MonsterController@index')->middleware('auth');
    Route::get('monster/edit', 'Admin\MonsterController@edit')->middleware('auth');
    Route::post('monster/edit', 'Admin\MonsterController@update')->middleware('auth');
    Route::get('monster/show', 'Admin\MonsterController@show')->middleware('auth');
});


// ゲーム機能　スコア

Route::group(['prefix' => 'admin'], function () {
    Route::get('score/id', 'Admin\ScoreController@id')->middleware('auth');
    Route::get('score/name', 'Admin\ScoreController@name')->middleware('auth');
    Route::get('score/delete', 'Admin\ScoreController@delete')->middleware('auth');
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
Route::get('BBS/add', 'PagesController@add')->middleware('auth');
Route::post('BBS/regist', 'PagesController@regist')->middleware('auth');
