@extends('layouts.admin')

@section('title', 'スタート画面')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                 <ul class="site link">
             <li class="prelink">
                 <a title="問い合わせ" href="https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com/BBS/add">問い合わせ</a>
             </li>
         </ul>
                <img src="{{ asset ('/image/title_convert_20200430121826.jpg') }}" class="start">
                　<div align="center">
               <input type="button" onclick="location.href='https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com/admin/game/method'" value="遊び方">
               <input type="button" onclick="location.href='https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com/admin/game/start'" value="ゲーム開始">
                </div>
            </div>
        </div>
    </div>
@endsection