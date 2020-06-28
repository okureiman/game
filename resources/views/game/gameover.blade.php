<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ゲームオーバー</title>
    </head>
    <body>
        <img src="{{ asset ('/image/gameover.jpg') }}" class="gameover">
         <div class="socialTopView">
			          <div class="twitterBtn"><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://www.webcyou.com/" data-text="web帳｜WEBデザイナーの、WEBデザイナーによる、WEBデザイナーの為のサイト" data-via="webcyou" data-count="vertical" data-lang="ja">Tweet</a>
		              </div>
		              
		              <div class="slackBtn"><a href="https://app.slack.com/client/T014A3DSFPF/C0144NGV92A/details/top" class="slack-share-button" data-url="http://www.webcyou.com/" data-text="web帳｜WEBデザイナーの、WEBデザイナーによる、WEBデザイナーの為のサイト" data-via="webcyou" data-count="vertical" data-lang="ja">Slack</a>
		              </div>
            <ul class="btnLi">
			      <li><a href="https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com/game/battle?monster=&lv=&weapon=&armor=&shield=&useItem=&player=">再戦</a></li>
			      <li><a href="https://young-coast-18447.herokuapp.com">TOPへ戻る</a></li>
		    </ul>
        <audio src="{{ asset('/bgm/bgm_maoudamashii_healing06.mp3') }}" controls></audio>
        </div>
    </body>
</html>
