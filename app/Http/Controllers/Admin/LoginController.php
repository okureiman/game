<?php

namespace App\Http\Controllers\Admin;	//変更

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;	//追加
use App\User; // 追加
use Socialite; //追加

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/home';	// 変更

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');	//変更
    }
    // 以下を追記
    public function showLoginForm()
    {
        return view('admin.login');
    }

    protected function guard()
    {
        return \Auth::guard('admin');
    }

    public function logout(Request $request)
    {
        \Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
