<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function add()
    {
        return view('game.create');
    }
    public function method()
    {
        return view('game.method');
    }
    public function start()
    {
        return view('game.start');
    }
    public function gameover()
    {
        return view('game.gameover');
    }
    public function clear()
    {
        return view('game.clear');
    }
    public function register()
    {
        return view('game.register');
    }
    public function login()
    {
        return view('game.login');
    }
}
