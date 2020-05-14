@extends('layouts.admin')

@section('title', 'ユーザー登録')

@section('content')

<html lang="ja">
    <head>
        
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">ログイン</div>
                    <div class="card-body">
                        <form method="POST" action="https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com/admin/game/create">
                            @csrf
                            <input type="hidden" name="_token" value="HD7MLoCXN7xxX28qymB0fzvPwISKGnHkYCFx8ZUY">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-lavel text-md-right">名前</label>
                                <div class="col-md-6">
                                     <input id="name" type="name" class="form-control " name="name" value="" required autocomplete="name" autofocus>
                                </div>
                            </div>
                                <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password">

                                                            </div>
                        </div>
                        <div class="form-group-row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">
                                        次回から入力を省略
                                    </label> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group-row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    ログイン
                                </button>
                            </div>
                        </div>
                                 </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
     <footer>
        <div align="center">
            <font size="4" color="#F8F8FF">
    <p>&copy; 2020 Legacy System</p>
    </font>
    </div>
       </footer>
</html>
@endsection