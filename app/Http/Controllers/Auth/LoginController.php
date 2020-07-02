<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;	// 追記
use App\User; // 追加
use Socialite; //追加

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
        $this->middleware('guest:user')->except('logout');	// 変更
    }
    
    //以下を追記
    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function guard()
    {
        return \Auth::guard('user');
    }

    public function logout(Request $request)
    {
        \Auth::guard('user')->logout();
        return redirect('/login');
    }
}
