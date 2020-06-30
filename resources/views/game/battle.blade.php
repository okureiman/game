@extends('layouts.battleapp')

@section('content')
<div id="bodyArea">
<header id="demoHeader">
	  <!-- <p class="logo"><a href="http://www.webcyou.com/" class="homeLnk"><img src="http://www.webcyou.com/wp-content/themes/webchou/favicon.ico" alt=""></a></p> -->
	 <title>バトルゲーム</title>
	  <h1>Legacy System</h1>
	  <div class="configView">
		    <p class="sttngIco"></p>
		    <ul class="configLi">
				    <li class="top cur">TOPへ</li>
				    <li class="name">なまえをへんこう</li>
				    <li class="close">とじる</li>
		    </ul>
	  </div>
</header>
<div id="container">
	  <div class="dqArea">
		    <div class="status">
			      <ul class="statusTitLi">
				       <li class="plyrNm">なまえ</li>
				       <li class="lv num">LV</li>
				       <li class="hp num">HP</li>
				       <li class="mp num">MP</li>
			      </ul>
			      <ul class="player01Li">
				       <li class="plyrNm">だいだい</li>
				       <li class="lv num">999</li>
				       <li class="hp num">999</li>
				       <li class="mp num">999</li>
			      </ul>
		    </div>
		    <div class="monster">
		        <ul class="monsterLi">
		             <li class=""><img src="{{ asset ('/image/teki.jpg') }}"></li>
			      </ul>
			  </div>
			  <div class="commend">
		        <p class="commendTtl">だいだい</p>
		        <ul class="commendLi player01Li">
		            <li class="battle cur"><a href="javascript:void(0)">たたかう</a></li>
		            <li class="escape"><a href="javascript:void(0)">にげる</a></li>
		            <li class="magic"><a href="javascript:void(0)">じゅもん</a></li>
		            <li class="item"><a href="javascript:void(0)">どうぐ</a></li>
		        </ul>
		    </div>
		    <div class="message">
			      <p>testがあらわれた！</p>
			      <ul class="magicLi">
			      </ul>
			      <ul class="itemLi">
			      </ul>
		    </div>
      </div>
      <div class="endWindow">
	      <div class="socialView">
	          
	          <div class="socialTopView">
			          <div class="twitterBtn"><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://www.webcyou.com/" data-text="web帳｜WEBデザイナーの、WEBデザイナーによる、WEBデザイナーの為のサイト" data-via="webcyou" data-count="vertical" data-lang="ja">Tweet</a>
		              </div>
		              
		              <div class="slackBtn"><a href="https://app.slack.com/client/T014A3DSFPF/C0144NGV92A/details/top" class="slack-share-button" data-url="http://www.webcyou.com/" data-text="web帳｜WEBデザイナーの、WEBデザイナーによる、WEBデザイナーの為のサイト" data-via="webcyou" data-count="vertical" data-lang="ja">Slack</a>
		              </div>
		              
		              
		              <div class="fb-like" data-href="http://www.webcyou.com/" data-send="false" data-layout="box_count" data-width="70" data-show-faces="true"></div>
		          
		          
			        <!--  <div class="hatena">-->
			        <!--    <a href="http://b.hatena.ne.jp/entry/http://www.webcyou.com/" class="hatena-bookmark-button" data-hatena-bookmark-title="web帳" data-hatena-bookmark-layout="vertical" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only.gif" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>-->
			        <!--  </div>-->
			          
			        <!--  <div class="mixi"><div data-plugins-type="mixi-favorite" data-service-key="6dcff99fefe315599ca55b5b4bb1d0fb1ab85865" data-size="large" data-href="http//www.webcyou.com/" data-show-faces="false" data-show-count="true" data-show-comment="false" data-width=""></div><script type="text/javascript">(function(d) {var s = d.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//static.mixi.jp/js/plugins.js#lang=ja';d.getElementsByTagName('head')[0].appendChild(s);})(document);</script></div>-->
			        
			        <!--<div class="twitterFollow">-->
			        <!--    <div class="btn"><a href="https://twitter.com/webcyou" class="twitter-follow-button" data-show-count="false" data-lang="ja">@webcyouをフォロー</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>-->
			        <!--    </div>-->
		         <!--  </div>-->
              </div><!-- /socialTopView -->
             
	          <div class="facebookView">
			          <div id="fb-root"></div>
					      <div id="fcbk">
						        <div class="fb-like" data-href="http://webcyou.com/demo/dq/" data-send="true" data-layout="button_count" data-width="180" data-show-faces="true"></div>
					      </div>
					      <div class="fbLikeBox">
						        <fb:like-box href="http://www.facebook.com/webcyou" width="520" show_faces="true" stream="false" header="true"></fb:like-box>
					      </div>
			      </div>
	      </div><!-- .socialView -->
		    <ul class="btnLi">
			      <li><a href="https://young-coast-18447.herokuapp.com/game/battle?monster=&lv=&weapon=&armor=&shield=&useItem=&player=">再戦</a></li>
			      <li><a href="https://young-coast-18447.herokuapp.com/">TOPへ戻る</a></li>
		    </ul>
	  </div>
	    <div align="right">
        <audio src="{{ asset('/bgm/game_maoudamashii_1_battle36.mp3') }}" controls></audio>
        </div>
</div>
@endsection


     