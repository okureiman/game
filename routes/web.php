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
    // Route::get('game/login', 'GameController@add');
    Route::post('game/login', 'GameController@login');
    Route::get('game/register', 'GameController@register');
    Route::post('game/register', 'GameController@register');
    Route::get('game/gameover', 'GameController@gameover');
    Route::get('game/clear', 'GameController@clear');
    // Route::post('/', 'HomeController@index');
    
    Route::get('game/battle', 'HomeController@battle')->name('battle');
    Route::get('/api/battle', 'HomeController@json');

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
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login');
    
    Route::get('/', 'Admin\HomeController@index')->name('admin.home');
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
});

// 問い合わせフォーム
Route::get('BBS/add', 'PagesController@add');
Route::get('BBS/question', 'PagesController@question');
Route::post('BBS/regist', 'PagesController@regist');
