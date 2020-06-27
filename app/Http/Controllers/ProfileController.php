<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function add()
    {
        return view('profile.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);
    
        $profile = new profile;
        $form = $request->all();
    
        unset($form['_token']);
        unset($form['image']);
    
        $profile->fill($form);
        $profile->save();
     
        return redirect('profile/create');
    }

    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('profile.edit', ['profile_form' => $profile]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile=Profile::find($request->id);
        $profile_form=$request->all();
        
        unset($profile_form['token']);
        unset($profile_form['remove']);
        $profile->fill($profile_form)->save();
        
        $profile_history=new ProfileHistory;
        $profile_history->profile_id=$profile->id;
        $profile_history->edited_at=Carbon::now();
        $profile_history->save();
        
        return redirect('profile/');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Profile::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのプロフィールを取得する
            $posts = Profile::all();
        }
        return view('profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function delete(Request $request)
    {
        // 該当するProfile Modelを取得
        $profile = Profile::find($request->id);
        // 削除する
        $profile->delete();
        return redirect('profile/');
    }
}
