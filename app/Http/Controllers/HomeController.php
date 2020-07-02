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
    
    /**
     * 初回バトル画面読み込み時にサーバー側から画面へ渡すデータ
     * /api/battle
     * @return json
     */
    public function json(Request $request)
    {
        /**
         * モンスターデータ
         * 簡易的に配列にしている
         * この形式でMonstersテーブルを作成し、データベースから取得する形が望ましい
         *
         */
        $monsters = [
            [
                //$monsters[0]
                'id' => 1,
                'name' => 'モンスターA',
                'max_hp' => 10,
                'skill' => 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス',
                'atk' => 20,
                'def' => 20,
                'weaknessType1' => 0, // 0~4
                'weaknessType2' => 1, // 0~4
                'weaknessType3' => 1, // 0~4
                'image' => "https://i.pinimg.com/236x/36/15/26/361526ea77ef05d8746fc07a75c5f4ab--dragon-quest-limo.jpg",
                // 'exp' => 15,
            ],
            [
                //$monsters[1]
                'id' => 2,
                'name' => 'モンスターB',
                'max_hp' => 150,
                'skill' => 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス',
                'atk' => 50,
                'def' => 50,
                'weaknessType1' => 0, // 0~4
                'weaknessType2' => 1, // 0~4
                'weaknessType3' => 1, // 0~4
                'image' => "https://images-na.ssl-images-amazon.com/images/I/515-oq9FZ8L._AC_SL1000_.jpg",
                // 'exp' => 25,

            ],
            [
                //2
                'id' => 3,
                'name' => 'モンスターC',
                'max_hp' => 200,
                'skill' => 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス',
                'atk' => 100,
                'def' => 100,
                'weaknessType1' => 0, // 0~4
                'weaknessType2' => 1, // 0~4
                'weaknessType3' => 1, // 0~4
                'image' => "https://res.booklive.jp/50004072/001/thumbnail/2L.jpg",
                // 'exp' => 40,
            ],
            [
                //3
                'id' => 4,
                'name' => 'モンスターD',
                'max_hp' => 300,
                'skill' => 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス',
                'atk' => 200,
                'def' => 200,
                'weaknessType1' => 0, // 0~4
                'weaknessType2' => 1, // 0~4
                'weaknessType3' => 1, // 0~4
                'image' => "https://www.pokemon.co.jp/ex/sword_shield/assets/pokemon/pokemon_190605_03.png",
                // 'exp' => 50,

            ],
            [
                //4
                'id' => 5,
                'name' => 'モンスターE',
                'max_hp' => 500,
                'skill' => 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス',
                'atk' => 300,
                'def' => 300,
                'weaknessType1' => 0, // 0~4
                'weaknessType2' => 1, // 0~4
                'weaknessType3' => 1, // 0~4
                'image' => "http://www.ksd-co.jp/wp-content/uploads/2016/04/6509fe52128a3c9fedb5899fc0f15800.jpg",
                // 'exp' => 80,
            ]
        ];
        

        $skills = 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス';

        return response()->json([
            'player' => [
                'name'  => $request->player_name??'ななし',
                'lv'    => 30,
                'mp'    => 30,
                'maxHP' => 300,
                'speed' => 100,
                'sprit' => 100,
                'skill' => 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス',
                'atk' => 100,
                'def' => 100,
            ],
            // "monster" => $monsters[rand(0,4)],
            "monster" => $monsters[0],
            "weapon" => [
                'atk' => 100,
                'def' => 50,
            ],
            "armor" => [
                'atk' => 100,
                'def' => 50,
            ],
            "shield" => [
                'atk' => 100,
                'def' => 50,
            ],
            "useitem" => [
                "len" => 4,
            ],
            // "json_response" => ""
        ]);
    }

    /**
     * ２体目以降のサーバー側から画面へ渡すデータ
     * /api/json_again
     * @return json
     */
    public function json_again(Request $request)
    {
        Log::debug($request->all()); //logを記録する

        
        //モンスターが使用するスキルをランダムに設定。ここをレベルや何かステータス値などを基準に設定できると良い
        $skills = [
            'ギラ',
            'ベギラマ',
            'ホイミ',
            'ベホイミ',
            'ラリホー',
            'マホトーン',
            'レミーラ',
            'リレミト',
            'ルーラ',
            'トヘロス',
        ];
        shuffle($skills);
        $skill = implode(',', $skills);
        
        /**
         * モンスターデータ
         */
        $monsters = [
            [
                //0
                'id' => 1,
                'name' => 'モンスターA',
                'max_hp' => 10,
                'skill' => $skill,
                'atk' => 1,
                'def' => 1,
                'weaknessType1' => 0, // 0~4
                'weaknessType2' => 1, // 0~4
                'weaknessType3' => 1, // 0~4
                'image' => "https://i.pinimg.com/236x/36/15/26/361526ea77ef05d8746fc07a75c5f4ab--dragon-quest-limo.jpg",
            ],
            [
                //1
                'id' => 2,
                'name' => 'モンスターB',
                'max_hp' => 150,
                // 'skill' => 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス',
                'skill' => $skill,
                'atk' => 10,
                'def' => 10,
                'weaknessType1' => 0, // 0~4
                'weaknessType2' => 1, // 0~4
                'weaknessType3' => 1, // 0~4
                'image' => "https://images-na.ssl-images-amazon.com/images/I/515-oq9FZ8L._AC_SL1000_.jpg",
            ],
            [
                //2
                'id' => 3,
                'name' => 'モンスターC',
                'max_hp' => 200,
                // 'skill' => 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス',
                'skill' => $skill,
                'atk' => 300,
                'def' => 20,
                'weaknessType1' => 0, // 0~4
                'weaknessType2' => 1, // 0~4
                'weaknessType3' => 1, // 0~4
                'image' => "https://res.booklive.jp/50004072/001/thumbnail/2L.jpg",
            ],
            [
                //3
                'id' => 4,
                'name' => 'モンスターD',
                'max_hp' => 300,
                // 'skill' => 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス,
                'skill' => $skill,
                'atk' => 400,
                'def' => 400,
                'weaknessType1' => 0, // 0~4
                'weaknessType2' => 1, // 0~4
                'weaknessType3' => 1, // 0~4
                'image' => "https://www.pokemon.co.jp/ex/sword_shield/assets/pokemon/pokemon_190605_03.png",
            ],
            [
                //4
                'id' => 5,
                'name' => 'モンスターE',
                'max_hp' => 500,
                // 'skill' => 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス',
                'skill' => $skill,
                'atk' => 500,
                'def' => 500,
                'weaknessType1' => 0, // 0~4
                'weaknessType2' => 1, // 0~4
                'weaknessType3' => 1, // 0~4
                'image' => "http://www.ksd-co.jp/wp-content/uploads/2016/04/6509fe52128a3c9fedb5899fc0f15800.jpg",
                ]
            ];
            
        //何体目かを取得
        //この数字に合わせてモンスターを指定してレスポンスを返すようにするのも良い
        //例:10体目の時、モンスターEを登場させる
        if ($request->count==10) {
            $monster = $monsters[4];
        } else {
            $monster = $monsters[rand(0, 4)];
        }
            
        /**
         * モンスターを倒した時点でのプレーヤーのステータスが$requestで取得できる。
         * この$requestで取り出したものをテーブルに保存できると良い
         */
        return response()->json([
            'player' => [
                'name'  => $request->player_name??'ななし',
                'lv'    => $request->lv,
                'mp'    => $request->mp,
                'maxHP' => $request->hp,
                'speed' => $request->speed,
                'sprit' => $request->split??100,
                'skill' => 'ギラ,ベギラマ,ホイミ,ベホイミ,ラリホー,マホトーン,レミーラ,リレミト,ルーラ,トヘロス',
                'atk'   => $request->atk,
                'def'   => $request->def,
            ],

            //次のモンスターを設定している。単純にランダムで設定しているが、基準になるものがあって登場するモンスターが選ばれるのが望ましい
            "monster" => $monster,
            
            //武器、防具など。この辺りは検証不足です、、
            //２体目以降、プレイヤーモンスター共に攻撃力の揺らぎが大きい
            "weapon" => [
                'atk' => 100,
                'def' => 50,
            ],
            "armor" => [
                'atk' => 100,
                'def' => 50,
            ],
            "shield" => [
                'atk' => 100,
                'def' => 50,
            ],

            //やくそうしか設定されていない為、単純に個数を決めている。やくそう以外のアイテムを設定する場合、skillのように設定する形になるかと思う
            "useitem" => [
                "len" => 4,
            ],
        ]);
    }
}
