<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonsterController extends Controller
{
    public function __construct()
    {
    }
    
    
    public function create(Request $request)
    {
        // varidationを行う
        $this->validate($request, Mosnter::$rules);

        $monster = new Monster;
        $form = $request->all();
      
        // フォームから画像が送信されたら保存して$monster->image_pathに画像のパスを保存する
        if (isset($form['image'])) {
            $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
            $monster->image_path = Storage::disk('s3')->url($path);
        } else {
            $monster->image_path = null;
        }
    
        // フォームから送信された_tokenを削除する
        unset($form['_token']);
        // フォームから送信されたimegeを削除する
        unset($form['image']);
    
        // データベースに保存する
        $monster->fill($form);
        $monster->save();
    
        // admin/monster/createにリダイレクトする
        return redirect('admin/monster/create');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Monster::where('title', $cond_title)->get();
        } else {
            // それ以外を取得する
            $posts = Monster::all();
        }
        return view('admin.monster.index', ['posts' => $posts,'cond_title' => $cond_title]);
    }
    
    public function edit(Request $request)
    {
        // Monster Modelからデータを取得する
        $Monster = Monster::find($request->id);
        if (empty($monster)) {
            abort(404);
        }
        return view('admin.monster.edit', ['monster_form' => $monster]);
    }
    
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Monster::$rules);
        // Monster Modelからデータを取得する
        $monster = Monster::find($request->id);
        // 送信されてきたフォームデータを格納する
        $monster_form = $request->all();
        if (isset($monster_form['image'])) {
            $path = $request->file('image')->store('public/image');
            $monster->image_path = basename($path);
            unset($monster_form['image']);
        } elseif (isset($request->remove)) {
            $monster->image_path = null;
            unset($monster_form['remove']);
        }
        unset($monster_form['_token']);
        // 該当するデータを上書きして保存する
        $monster->fill($monster_form)->save();

        return redirect('admin/monster');
    }
    
    public function show()
    {
        return view('admin.monster.show');
    }
}
