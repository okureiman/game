<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ゲームオーバー</title>
    </head>
    <body>
        <img src="{{ asset ('/image/gameover.jpg') }}" class="gameover">
        <input type="button" onclick="location.href='https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com/admin/game/create'" value="タイトルに戻る">
        <div align="right">
        <audio src="{{ asset('/bgm/bgm_maoudamashii_healing06.mp3') }}" controls></audio>
        </div>
    </body>
</html>
