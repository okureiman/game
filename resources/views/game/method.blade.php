@extends('layouts.admin')

@section('content')
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>遊び方</title>
    </head>
    <body>
        <h1 sytle="text-align: center"><font color="#F8F8FF">遊び方</h1>
        <ul class="rule">
            <p>
                
            </p>
            <font color="#F8F8FF">
            <li>
                ゲーム開始： 「ゲーム開始」ボタンをクリック
            </li>
            <p>
                
            </p>
            <li>
                説明仮
            </li>
            <p>
                
            </p>
            <li>
                説明仮2
            </li>
        </ul>
         <input type="button" onclick="location.href='https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com'" value="タイトルに戻る">
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