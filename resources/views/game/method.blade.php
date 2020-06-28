@extends('layouts.admin')

@section('content')
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>遊び方</title>
    </head>
    <body>
        <h1 sytle="text-align: center"><font color="#F8F8FF">遊び方</h1>
        <div style="background: #CCCCFF; width:630px; border: 1px solid #D3D3D3; height:100％; padding-left:10px; padding-right:10px; padding-top:10px; padding-bottom:10px;">
        <ul class="rule">
            <p>
           
            </p>
                 <font color=#000000>
            <li>
                ゲーム開始： 「ゲーム開始」ボタンをクリック。ボタンクリック後、敵モンスターを倒すゲームが始まります。
            </li>
            <li>
            <p>「たたかう」をクリックすると、敵モンスターに攻撃できます。</p>
          　<p>「にげる」をクリックすると、戦闘を終了します。</p>
            <p>「じゅもん」をクリックすると、回復呪文や攻撃呪文を使用できます。</p>
            <p>「どうぐ」をクリックすると、やくそうを使用できます。</p>
               　
            </li>
            <li>
                敵モンスターを倒せばゲームクリアです。
            </li>
            <li>
                敵モンスターに倒されるとゲームオーバーです。
            </li>
        </ul>
        </div>
         <input type="button" onclick="https://young-coast-18447.herokuapp.com/" value="タイトルに戻る">
         <div align="right">
                <audio src="{{ asset('/bgm/bgm_maoudamashii_healing13.mp3') }}" controls></audio>
                </div>
    </body>
        <footer>
    <div align="center">
    <font size="4" color="#F8F8FF">
    <p>&copy; 2020 Legacy System</p>
    </div>
    </footer>
</html>
@endsection