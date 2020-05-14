@extends('layouts.BBSapp')
    @section('title', 'post-page')
    @section('content')
        {!! Form::open(['url' => '/BBS/regist', 'method' => 'post', 'files' => true]) !!}
         <ul class="site link">
             <li class="prelink">
                 <a title="戻る" href="https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com/admin/game/create">戻る</a>
             </li>
         </ul>
            <div class="form-group">
                {!! Form::label('user_label', '投稿者名', ['class' => '']) !!}
                {!! Form::text('username', '', ['class' => 'form-control', 'id' => 'user_label']) !!}
            </div>            
            <div class="form-group">
                {!! Form::label('content_label', '本文', ['class' => '']) !!}
                {!! Form::textarea('content', '', ['class' => 'form-control', 'id' => 'content_label']) !!}
            </div>                      
            <div class="col-sm-2">
                {!! Form::submit('投稿する', ['class' => 'form-control', 'id' => 'btn btn-primary']) !!}
            </div>
            <div class="col-sm-2">
                <button type="reset">リセット</button>
            </div>
        {!! Form::close() !!}
    @endsection
    @section('footer')
    &copy; 2020 Legacy System.
    @endsection