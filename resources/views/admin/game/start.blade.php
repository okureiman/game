<html>
<head><meta charset="UTF-8"><title>ゲーム</title></head>
<body>
<script>
var menu_id = 0;

//キー入力による分岐処理
function game_keydown()
{
	switch (event.keyCode) {
		case 37: //カーソルキーの左
			document.getElementById("game_control").value = "←";
			break;
		case 38: //カーソルキーの上
			document.getElementById("game_control").value = "↑";
			if (menu_id <= 1) {
				activeMenu(4);
			} else {
				activeMenu(menu_id - 1);
			}
			break;
		case 39: //カーソルキーの右
			document.getElementById("game_control").value = "→";
			break;
		case 40: //カーソルキーの下
			document.getElementById("game_control").value = "↓";
			if (menu_id >= 4) {
				activeMenu(1);
			} else {
				activeMenu(menu_id + 1);
			}
			break;
		case 13: //エンターキー
			doCommand(menu_id);
			break;
		default: //その他の場合はキーコードを表示
			document.getElementById("game_control").value = "キーコード:" + event.keyCode;
			break;
	}
}

function activeMenu(id)
{
	if (menu_id == id) {
		//前回と同じメニューが選ばれた場合はコマンドを実行
		doCommand(id);
	} else {
		if (menu_id != 0) {
			//現在のメニューのカーソルを消す
			document.getElementById('menu' + menu_id).className = 'menu';
		}
		//今回選ばれたメニューにカーソルを表示
		document.getElementById('menu' + id).className = 'menu menu-active';
		menu_id = id;
	}
}
//コマンドの実行
function doCommand(command_id)
{
	document.getElementById("game_control").value = "コマンド番号:" + command_id;
	switch (command_id) {
		case 1: //たたかう
			message("ああああの こうげき！");
			message("ミス！　ダメージをあたえられない！");
			break;
		case 2: //ぼうぎょ
			message("ああああは みをまもっている！")
			message("オロチは　ようすをみている。")
			break;
		case 3: //どうぐ
			message("しかし　なにももっていなかった。")
			break;
		case 4: //にげる
			message("ああああは　にげだした！")
			message("しかし　まわりこまれてしまった！")
			break;
		default:
			break;
	}
}

function main(){
	
}

var msg_buff = '';
function message(msg)
{
	if (msg_buff == '') {
		msg_buff += msg + "\n";
		message_char();
	} else {
		msg_buff += msg + "\n";
	}

}
function message_char()
{
	if (msg_buff == '') {
		//メッセージバッファに文字がなければ何もしない
		return;
	}
	//メッセージバッファの先頭1文字を取得
	var c = msg_buff.slice(0, 1)
	if (c == "\n") {
		c = '<br>';//改行の場合はタグへ変換
		var obj = document.getElementById('message_window');
		obj.scrollTop = obj.scrollHeight;
	}
	document.getElementById('message_window').innerHTML += c;
	//メッセージバッファから先頭1文字を削除
	msg_buff = msg_buff.slice(1);
	//
	setTimeout('message_char()', 30);
}

</script>

<div class="game_window">
	<div class="game_menu">
		<div id="menu1" onclick="activeMenu(1);" class="menu">たたかう</div>
		<div id="menu2" onclick="activeMenu(2);" class="menu">ぼうぎょ</div>
		<div id="menu3" onclick="activeMenu(3);" class="menu">どうぐ</div>
		<div id="menu4" onclick="activeMenu(4);" class="menu">にげる</div>
	</div>

	<div class="game_enemy">
	    <img src="{{ asset ('/image/teki.jpg') }}" class="start">
	</div>

	<div id="message_window"></div>
</div>

<input type="text" id="game_control" onkeydown="game_keydown();"></div>

<style>
/* ゲーム画面全体のデザイン */
.game_window {
	width:100%;
	height:650px;
	background-color:black;
	color:white;
}
/* メニュー */
.game_menu {
	width:100px;
	border:3px solid white;
	border-radius:6px;
	margin:1em;
	padding:1em;
	float:left;
}
.game_enemy {
	width:300px;
	text-align:center;
	margin:1em;
	padding:1em;
	float:left;
}
#message_window {
	width:300px;
	border:3px solid white;
	border-radius:6px;
	margin-left: auto;

}
/* メニュー用 */
.menu {
	cursor:pointer;
}
.menu:before {
	cursor:pointer;
	content: '　';
}
/* メニュー選択状態 */
.menu-active:before {
	content: '▶';
}
</style>

<script>
activeMenu(1);
message('オロチ が あらわれた');
</script>

</body>
</html>