@extends('layouts.admin')

@section('title', 'スタート画面')

@section('content')
<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
<meta name="description" content="Legacy SystemはJavaScriptのドラクエ風の戦闘シュミレーターです。"><!--contentの説明文は120字まで-->

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <img src="{{ asset ('/image/title_convert_20200430121826.jpg') }}" class="start">
                　<div align="center">
               <input type="button" onclick="location.href='https://young-coast-18447.herokuapp.com/game/method'" value="遊び方">
               <input type="button" onclick="location.href='https://young-coast-18447.herokuapp.com/game/battle?monster=&lv=&weapon=&armor=&shield=&useItem=&player='" value="ゲーム開始">
               <div align="right">
               <audio src="{{ asset('/bgm/game_maoudamashii_3_theme01.mp3') }}" controls></audio>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div align="center">
            <font size="4" color="#F8F8FF">
    <p>&copy; 2020 Legacy System</p>
    </font>
    </div>
       </footer>
@endsection
