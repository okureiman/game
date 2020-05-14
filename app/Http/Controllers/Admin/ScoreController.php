<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScoreController extends Controller
{
    public function id()
    {
        return view('admin.score.id');
    }
    public function name()
    {
        return view('admin.score.name');
    }
    
    public function delete(Request $request)
    {
        // 該当するScore Modelを取得
        $score = Score::find($request->id);
        // 削除する
        $score->delete();
        return redirect('admin/score/');
    }
}
