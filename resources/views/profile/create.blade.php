@extends('layouts.profile')

@section('title', 'マイプロフィール')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール編集画面</h2>
                <form action="{{ action('ProfileController@create') }}" method="post" enctype="multipart/form-data">
                    
                    @if (count($errors) > 0)
                    <ul>
                    @foreach($errors ->all() as $e)
                        
                    <li>{{ $e }}</li>
                    @endforeach
                    </ul>
                    @endif
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="body">ユーザー名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">趣味</label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" name="hobby" value="{{ old('hobby') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2" for="title">自己紹介欄</label>
                      <div class="col-md-10">
                         <textarea class="form-control" name="introduction" rows="20">{{ old('introduction') }}</textarea>
                      </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="終了">
                </form>
            </div>
        </div>
    </div>
@endsection