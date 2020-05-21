@extends('layouts.admin')

@section('title', 'スタート画面')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <img src="{{ asset ('/image/title_convert_20200430121826.jpg') }}" class="start">
                　<div align="center">
               <input type="button" onclick="location.href='https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com/game/method'" value="遊び方">
               <input type="button" onclick="location.href='https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com/game/battle'" value="ゲーム開始">
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
