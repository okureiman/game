<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function add()
    {
        return view('admin.game.create');
    }
    public function method()
    {
        return view('admin.game.method');
    }
    public function start()
    {
        return view('admin.game.start');
    }
    public function gameover()
    {
        return view('admin.game.gameover');
    }
    public function clear()
    {
        return view('admin.game.clear');
    }
    public function register()
    {
        return view('admin.game.register');
    }
    public function login()
    {
        return view('admin.game.login');
    }
}
