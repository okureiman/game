<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth'); 変更
        // $this->middleware('auth:user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function battle()
    {
        return view('game.battle');
    }
    
    public function json(Request $request)
    {
        return response()->json([
            'player' =>[
                'name' => $request->player??'ななし',
                'lv' => 30,
                'mp' => 20,
                'maxHP' => 100,
                'speed' => 100,
                'sprit' => 100,
                'skill' => 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス',
                'atk' => 100,
                'def' => 100, ],
                "monster" => [
                    'id' => 1,
                    'name' => 'ミツクビ',
                    'max_hp' => 100,
                    'skill' => 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス',
                    'atk' => 200,
                    'def' => 120,
                    'weaknessType1' => 0, // 0~4
                    'weaknessType2' => 1, // 0~4
                    'weaknessType3' => 1,// 0~4
                    ],
                    "weapon" => [ 'atk' => 100, 'def' => 50, ],
                    "armor" => [ 'atk' => 100, 'def' => 50, ],
                    "shield" => [ 'atk' => 100, 'def' => 50, ],
                    "useitem" => [ "len" => 4, ],
            ]);
    }
}
