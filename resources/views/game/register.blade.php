@extends('layouts.admin')

@section('title', 'ユーザー登録')

@section('content')
<html lang="ja">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー登録</div>

                <div class="card-body">
                    <form method="POST" action="https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com">
                        @csrf
                        <input type="hidden" name="_token" value="kg8UV9eLT55EH19kTEUHXzCoDlNnjeNJW144pNTy">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="name" value="" required autocomplete="name" autofocus>

                                                            </div>
                        </div>
                        <!-- 以下、Eメールアドレスのログインフォーム -->
                        <!-- <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Eメールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" value="" required autocomplete="email">

                                                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " name="password" required autocomplete="new-password">

                                                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">パスワードの確認</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    登録
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        </main>
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