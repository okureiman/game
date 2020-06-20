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
    
    // GitHub の認証ページへ遷移
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback()
    {
        $socialUser = Socialite::driver('github')->stateless()->user();
        $user = User::where([ 'email' => $socialUser->getEmail() ])->first();

        if ($user) {
            Auth::login($user);
            return redirect('/home');
        } else {
            $user = User::create([
              'name' => $socialUser->getNickname(),
              'email' => $socialUser->getEmail(),
              'password' => Hash::make($socialUser->getNickname()),
          ]);
            Auth::login($user);
            return redirect('/home');
        }
    }
    
    public function redirectToGoogle()
    {
        // googleへのリダイレクト
        return socialite::driver('google')->redirect;
    }
    
    public function handleGoogleCallback()
    {
        // google認証後の処理
        $gUser = Socialite::driver('google')->stateless()->user();
        // email が合致するユーザーを取得
        $user = User::where('email', $gUser->email)->first();
        // 見つからなければ新しくユーザーを作成
        if ($user == null) {
            $user = $this->createUserByGoogle($gUser);
        }
        // ログイン処理
        \Auth::login($user, true);
        return redirect('/home');
    }
    
    public function createUserByGoogle()
    {
        $User = User::create([
            'name'=> $gUser->name,
            'email'=>$gUser->email,
            'password'=>\Hash::make(uniqid()),
            ]);
        return $user;
    }
}
