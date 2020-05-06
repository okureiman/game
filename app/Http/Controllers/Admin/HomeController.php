<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;	//追記

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin'); //変更
    }

    public function index()
    {
        return view('admin.home');	//変更
    }
}
