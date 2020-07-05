'use strict';
(function(global) {
  var document = global.document;
  function battle() {
    var commendBox = document.querySelector('.commend'),
        commandLi = document.querySelector('.commendLi'),
		commandItem = document.querySelectorAll('.commendLi > li'), //コマンドリスト（たたかう、にげる、じゅもん、どうぐ）
        messageView = document.querySelector('.message > p'), //
        monsterLi = document.querySelector('.monsterLi > li'),
		magicLi = document.querySelector('.magicLi'),
        magicLiItem = "",
        itemLi = document.querySelector('.itemLi'),
        itemLiItem = "",
        battleViewElem = document.querySelector('.dqArea'),
        playerStatusLi = document.querySelectorAll('.player01Li > li'),
        endWindow = document.querySelector('.endWindow'),
        battleMode = "command",
        battleDate = {},
        messageTime = 900, // ? 
        monsterImgPath = "",
        monster,player = {};
				
		var AjaxPath = {
	    requestFile: "api/battle",
	    sendBattleData: "player=getパラメータ"
	  };
		//乱数テーブル
		var Random = {};
		Random.table = [
		7, 182, 240, 31, 85, 91, 55, 227, 174, 79, 178, 94, 153, 246, 119, 203, 96, 143, 67, 62, 167, 76, 45, 136, 199, 104, 215, 209, 194, 242, 193, 221,170, 147, 22, 247, 38, 4, 54, 161, 70, 78, 86, 190, 108, 110, 128, 213, 181, 142, 164, 158, 231, 202, 206, 33, 255, 15, 212, 140, 230, 211, 152, 71, 244, 13, 21, 237, 196, 228, 53, 120, 186, 218, 39, 97, 171, 185, 195, 125, 133, 252, 149, 107, 48, 173, 134, 0, 141, 205, 126, 159, 229, 239, 219, 89, 235, 5, 20, 201, 36, 44, 160, 60, 68, 105, 64, 113, 100, 58, 116, 124, 132, 19, 148, 156, 150, 172, 180, 188, 3, 222, 84, 220, 197, 216, 12, 183, 37, 11, 1, 28, 35, 43, 51, 59, 151, 27, 98, 47, 176, 224, 115, 204, 2, 74, 254, 155, 163, 109, 25, 56, 117, 189, 102, 135, 63, 175, 243, 251, 131, 10, 18, 26, 34, 83, 144, 207, 122, 139, 82, 90, 73, 106, 114, 40, 88, 138, 191, 14, 6, 162, 253, 250, 65, 101, 210, 77, 226, 92, 29, 69, 30, 9, 17, 179, 95, 41, 121, 57, 46, 42, 81, 217, 93, 166, 234, 49, 129, 137, 16, 103, 245, 169, 66, 130, 112, 157, 146, 87, 225, 61, 241, 249, 238, 8, 145, 24, 32, 177, 165, 187, 198, 72, 80, 154, 214, 127, 123, 233, 118, 223, 50, 111, 52, 168, 208, 184, 99, 200, 192, 236, 75, 232, 23, 248
		];

    Random.pos = Math.floor(Math.random() * 255) % 256;    //Math.floor(Math.random() * 255) ← 0から254のランダムな値　
    Random.getValue = function(range) {
      var v = Random.table[Random.pos];
      Random.pos = Math.floor(Random.pos + Math.random() * 255) % 256;
      if(range == null) {
        return v;
      }
      for(var i = 0; i < range.length; i++) {
        if (range[i].l <= v && v < range[i].g) {
          return i;
        }
      }
      return i - 1;
    }	
		//battle constructor
    var battleController = function() {};
		battleController.prototype = {
		  init: function() {
		    var that = this,
		    monsterImg =  document.querySelector('.monsterLi > li img'); // .クラス　li リスト　>〇〇　子要素
		    battleDate.turnLength = 2; //turnLengthが0になると終了？　→１ターンが終了する //空のbattleDateの中身を定義している
		    
		    
		    //モンスターの画像
		    // monsterImg.src = "https://news.walkerplus.com/article/205022/1259246_615.jpg";
		    // monsterImg.src = "https://i.pinimg.com/236x/36/15/26/361526ea77ef05d8746fc07a75c5f4ab--dragon-quest-limo.jpg";
		    monsterImg.src = "https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com/image/teki.jpg";
		    
			//skill
			//じゅもんを表示している箇所
		    if(player.skill !== "なし" && player.skill !== null) {
			    for(var i = 0, il = player.skill.length; i < il; i++) {
			      var liItem = document.createElement('li');
			      magicLi.appendChild(liItem);
			      liItem.innerHTML = player.skill[i];
			    }
			    magicLiItem = document.querySelectorAll('.magicLi > li');
				magicLiItem[0].classList.add("cur"); //カーソル初期表示
				//　マウスオーバーした時にカーソルを表示する
			    for(var i = 0, il = magicLiItem.length; i < il; i++) {
			      magicLiItem[i].addEventListener("mouseover", function() {
			        for(var n = 0, nl = magicLiItem.length; n < nl; n++) {
				        magicLiItem[n].classList.remove("cur");
				      }
				      this.classList.add("cur");
				    }, false);
				    (function(arg) {
					  //じゅもんにマウスオーバーして、クリックしてじゅもんを唱える時
				      magicLiItem[arg].addEventListener("click", function() {
				        player.turn = BattleLogic.turn(); //プレーヤーのターンかどうか
				        monster.battleVal = BattleLogic.statusCheck();
				        player.battleVal = BattleLogic.magic(player.skill[arg]); //magic()　呼び出し箇所。
				        messageView.style.display = "block";
				        magicLi.style.display = "none";
				        that.mode();
				      }, false);
				    })(i);
			    }
		    }
		    
		    //item
		    if(player.item) {
			    for(var i = 0, il = player.item.length; i < il; i++) {
			      var li = document.createElement('li');
			      itemLi.appendChild(li);
			      li.innerHTML = player.item[i];
			    }
			    itemLiItem = document.querySelectorAll('.itemLi > li');
			    itemLiItem[0].classList.add("cur");
			    for(var i = 0, il = itemLiItem.length; i < il; i++) {
			      itemLiItem[i].addEventListener("mouseover", function() {
			        for(var n = 0, nl = itemLiItem.length; n < nl; n++) {
				        itemLiItem[n].classList.remove("cur");
				      }
				      this.classList.add("cur");
				    }, false);
				    (function(arg) {
				      itemLiItem[arg].addEventListener("click", function() {
				        player.turn = BattleLogic.turn();
				        monster.battleVal = BattleLogic.statusCheck();
				        player.battleVal = BattleLogic.item(player.item[arg], arg);				            
				        messageView.style.display = "block";
				        itemLi.style.display = "none";
				        that.mode();
				      }, false);
				    })(i);
			    }
		    }
		    
		    for(var i = 0, il = commandItem.length; i < il; i++) {
		      commandItem[i].addEventListener("mouseover", function() {
		        for(var n = 0, nl = commandItem.length; n < nl; n++) {
		          commandItem[n].classList.remove("cur");
		        }
		        if(battleMode == "command") {
		          this.classList.add("cur");
		        }
			  }, false);
			  //　コマンド選択
		      commandItem[i].addEventListener("click", function() {
				// たたかうを選択
		        if(this.classList.contains("battle") && battleMode == "command") {				            
			        monster.battleVal = BattleLogic.statusCheck();
			        player.battleVal = BattleLogic.attack();
			        player.turn = BattleLogic.turn();
			        battleMode = "battle";
			        that.mode();
				}
				 //　にげるを選択
		        if(this.classList.contains("escape") && battleMode == "command") {
		          player.escape = BattleLogic.escape();			          
		          monster.battleVal = BattleLogic.statusCheck();
		          player.turn = BattleLogic.turn();
		          battleMode = "escape";
		          that.mode();
				}
			    // じゅもんを選択　（選択できるじゅもんがない時の処理も含まれている？）
		        if(this.classList.contains("magic")) {
			        if(battleMode == "command") {
			          battleMode = "magic";
			          setTimeout(function() {
			            messageView.style.display = "none";
		              magicLi.style.display = "block";
		            },80);
		          }
		          if(battleMode == "magic" && magicLi.style.display == "block") {
		            messageView.style.display = "block";
		            magicLi.style.display = "none";
			          battleMode = "command";
			          messageView.innerHTML = "どうする?";
		          }
				}
				//  どうぐを選択
		        if(this.classList.contains("item")) {
			        if(battleMode == "command") {
			          battleMode = "item";
			          setTimeout(function() {
			            messageView.style.display = "none";
					  itemLi.style.display = "block";
					  //どうぐがない時
		              if(!itemLi.querySelector("li")) {
			              messageView.innerHTML = "どうぐを もっていない。";
			              messageView.style.display = "block";
				            itemLi.style.display = "none";
					          battleMode = "command";
		              }
		            },80);
				  }
				  // どうぐがある時
		          if(battleMode == "item" && itemLi.style.display == "block") {
		            messageView.style.display = "block";
		            itemLi.style.display = "none";
			          battleMode = "command";
		          }
		        }
		      }, false);
		    }
		  },
		  
		  mode: function() {
			messageView.innerHTML = "";
			// コマンド選択時に、カーソルを非表示にしている?
		    for(var i = 0, il = commandItem.length; i < il; i++) {
			    commandItem[i].classList.remove("cur");
			  }
			  if(battleMode == "battle" || battleMode == "escape" || battleMode == "magic" || battleMode == "item") {
			    if(player.turn) {
				    BattleView.playerMessage(battleMode);
			    } else {
				    BattleView.monsterMessage();
			    }
			  }
			  if(battleMode == "command") {
			    battleDate.turnLength = 2;
			    battleDate.nextTurn = "";
			    messageView.innerHTML = "どうする？";
			    commandItem[0].classList.add("cur");
			  }
			  if(battleMode == "end") {
			    // audioList["sound00"].pause();
			    // audioList["sound01"].pause();
			    // global.dq.Sound.dead();
				  messageView.innerHTML = "あなたは しにました。";
				  commendBox.style.display = "none";
				  //endWindow.classList.add("show");
				  //ゲームオーバー画面に移動させる
				  onLoad=setTimeout("location.href='https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com/game/gameover'",1000)
			  }
			  if(battleMode == "finish") {
			    commendBox.style.display = "none";
			    monsterLi.style.display = "none";
			    
			    // audioList["sound00"].pause();
			    // audioList["sound01"].pause();
			    if(monster.hp <= 0) {
			    //   global.dq.Sound.win();
			      messageView.innerHTML = monster.name + "を たおした。";
			      //endWindow.classList.add("show");
			        //クリア画面に移動させる
				  onLoad=setTimeout("location.href='https://cd6656c516b04052a08d8359f18eface.vfs.cloud9.us-east-2.amazonaws.com/game/clear'",1000)
			    }
			  }
			  if(battleMode == "escapeEnd") {
			    commendBox.style.display = "none";
			    monsterLi.style.display = "none";
			    messageView.innerHTML = player.name + "は にげだした。";
			    endWindow.classList.add("show");
			  }
		  },
		  
		  // プレーヤーのアクションかモンスターのアクションかどちらのターンであるかチェックして、表示する
		  nextTurnCheck: function() {
		    battleViewElem.classList.remove("shock");　//?
			  monsterLi.classList.remove("damage"); //?
			  monsterLi.classList.remove("attck"); //?
		    if(battleDate.nextTurn == "player" && battleDate.turnLength > 0) {
		      BattleView.playerMessage(battleMode);
			  } else if(battleDate.nextTurn == "monster" && battleDate.turnLength > 0) {
				  BattleView.monsterMessage();
			  } else {
				  battleMode = "command";
				  this.mode();
			  }
		  },
		  
		  playerStatusCheck: function() {
		    var that = this;
  		  if(player.status == "ねむり") {
			    messageView.innerHTML = player.name + "は ねむっている。";
			    setTimeout(function() { that.nextTurnCheck(); }, messageTime);
		      return "ねむり";
		    } else if(player.status == "めざめ") {
		      player.status = "";
			    messageView.innerHTML = player.name + "は めをさました！";
			    setTimeout(function() { that.nextTurnCheck(); }, messageTime);
		      return "めざめ";
		    }
		    return false;
		  }
		};
		
		//battle View　戦闘画面に表示するもの
		var battleView = function() {};
		battleView.prototype = {
		  init: function() {
		    playerStatusLi[0].innerHTML = player.name;
		    playerStatusLi[1].innerHTML = player.lv;
			playerStatusLi[2].innerHTML = player.hp;
			playerStatusLi[3].innerHTML = player.mp;
		  },
		  //モンスターが起こすアクションの表示
		  monsterMessage: function() {
		    var that = this;
		    battleDate.nextTurn = "player";
			  battleDate.turnLength -= 1;
			  if(monster.status == "ねむり") {
				  messageView.innerHTML = monster.name + "は ねむっている。";				    
				  setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
				  return;
		    }
		    if(monster.status == "めざめ") {
		      messageView.innerHTML = monster.name + "は めを さました。";
			    setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
			    monster.status == "こうげき"
					return;
		    }
		    if(monster.status == "こうげき") {
		      //回復呪文
		      if(monster.effectType == 0) {
		        // global.dq.Sound.magic();
			      messageView.innerHTML = monster.name + "は" + monster.useEffect + "を となえた。";
			      setTimeout(function() {
			        if(monster.disableMagic == true) {
			          messageView.innerHTML = monster.name + "の じゅもんは ふうじこまれている。"
			          monster.effectType = null;
			          setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
					      return;
			        } else {
				        messageView.innerHTML = monster.name + "は " + monster.battleVal + "の HPがかいふく。";
				        monster.hp += monster.battleVal;
				        monster.effectType = null;
				        setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
					      return;
				      };
			      }, messageTime);
		      } else if(monster.effectType == 1) {
		        //攻撃呪文
		        // global.dq.Sound.magic();
		        messageView.innerHTML = monster.name + "は " + monster.useEffect + "を となえた。";
			      setTimeout(function() {
			        if(monster.disableMagic == true) {
			          messageView.innerHTML = monster.name + "の じゅもんは ふうじこまれている。"
			          monster.effectType = null;
			          setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
					      return;
			        } else {
			        //   global.dq.Sound.damage();
				        battleViewElem.classList.add("shock");
				        messageView.innerHTML = player.name + "は" + monster.battleVal + "の ダメージを うけた。";
				        player.hp = player.hp - monster.battleVal;
				        monster.effectType = null;
				        that.statusChange();
				        setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
					      return;
				      };
			      }, messageTime);
		      } else if(monster.effectType == 2) {
			      //ラリホー
			    //   global.dq.Sound.magic();
			      messageView.innerHTML = monster.name + "は " + monster.useEffect + "を となえた。";
			      setTimeout(function() {
			        if(monster.disableMagic == true) {
			          messageView.innerHTML = monster.name + "の じゅもんは ふうじこまれている。";
			          monster.effectType = null;				          
			          setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
					      return;
			        } else {
				        messageView.innerHTML = player.name + "は ねむってしまった！";
				        player.status = "ねむり";
				        monster.effectType = null;
				        that.statusChange();
				        setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
					      return;
				      };
			      }, messageTime);
		      } else if(monster.effectType == 3) {
		        //マホトーン
		        // global.dq.Sound.magic();
			      messageView.innerHTML = monster.name + "は " + monster.useEffect + "をとなえた。";
			      if(monster.disableMagic == true) {
		          setTimeout(function() {
			          messageView.innerHTML = monster.name + "の じゅもんは ふうじこまれている。";
			          monster.effectSuccess = false;
			          monster.effectType = null;
			          setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
					      return;
				      }, messageTime);
			      } else {
		          setTimeout(function() {
			          if(monster.effectSuccess == true) {
			            messageView.innerHTML = player.name + "の じゅもんは ふうじこまれてしまった！";
			            player.disableMagic = true;
			            monster.effectSuccess = false;
			          } else {
			            messageView.innerHTML = "しかし " + player.name + "には きかなかった。";
			          }
				        monster.effectType = null;
				        that.statusChange();
				        setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
					      return;
			        }, messageTime);
			      }
		      } else if(monster.effectType == 4) {
		        // global.dq.Sound.fire();
		        messageView.innerHTML = monster.name + "は " + monster.useEffect + "を はい���������。";
			      setTimeout(function() {
			        // global.dq.Sound.damage();
					    battleViewElem.classList.add("shock");
					    messageView.innerHTML = player.name + "は " + monster.battleVal + "の ダメージを うけた。";
					    player.hp = player.hp - monster.battleVal;
					    that.statusChange();
					    if(battleMode !== "end") {
					      setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
					      return;
					    } else {
						    BattleCtrl.mode();
					    }
					  }, messageTime); 
		      } else {
		        // global.dq.Sound.attack();
			      messageView.innerHTML = monster.name + "の こうげき。";
					  setTimeout(function() {
					    // global.dq.Sound.damage();
					    battleViewElem.classList.add("shock");
					    monsterLi.classList.add("attck");
					    messageView.innerHTML = player.name + "は " + monster.battleVal + "の ダメージを うけた。";
					    player.hp = player.hp - monster.battleVal;
					    that.statusChange();
					    if(battleMode !== "end") {
					      setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
					      return;
					    } else {
						    BattleCtrl.mode();
					    }
					  }, messageTime);  
		      }
		    }
		  },
		  
		  //　プレーヤーが起こすアクション
		  playerMessage: function(messageMode) {
  		  var that = this;
		    battleDate.nextTurn = "monster";
		    battleDate.turnLength -= 1;
		    if(player.status == "ねむり") { player.escape = false; }
			  var statusCheck = BattleCtrl.playerStatusCheck();				  
			  if(statusCheck == "ねむり" || statusCheck == "めざめ") {
				  return;
			  }
			  // たたかうを選択して攻撃した場合
			  if(messageMode == "battle") {
			    // global.dq.Sound.attack();
  			  messageView.innerHTML = player.name + "の こうげき。";
  			  setTimeout(function() {
  			    // global.dq.Sound.damage();
  			    monsterLi.classList.add("damage"); //?
  			    messageView.innerHTML = monster.name + "に " + player.battleVal[0] + "の ダメージを あたえた。";
  			    monster.hp = monster.hp - player.battleVal[0];
  			    setTimeout(function() {
					// モンスターのHPが0になった時
  			      if(monster.hp <= 0) {
  				      battleMode = "finish";
  				      BattleCtrl.mode();
  				      return;
					}
					// ターン交代　
					// ターンが一巡したらコマンド選択画面を表示
  			      if(battleDate.turnLength > 0) {
  			        that.monsterMessage();
  			      } else {
  				      battleMode = "command";
  				      BattleCtrl.mode();
  			      }
  			    }, messageTime);
  			  }, messageTime);
			  }
			  //　にげるを選択した時
			  if(messageMode == "escape") {
			    if(player.escape){
  			    messageView.innerHTML = player.name + "は にげだした！";
  			    battleMode = "escapeEnd";
  			    battleDate.turnLength = 0;
  			    BattleCtrl.mode();
  		    } else {
  			    messageView.innerHTML = player.name + "は にげだした！";
  			    setTimeout(function() {
  			      messageView.innerHTML = player.name + "は にげだした！" +"<br>"+"しかし " + monster.name + "に まわりこまれてしまった。";
  			      setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
  			    }, messageTime);
  		    }
			}
			//　じゅもんをリストから選択してとなえた時
			// player.battlVal=[値、じゅもん名、消費MP]
			  if(messageMode == "magic") {
			    // global.dq.Sound.magic();
			    messageView.innerHTML = player.name + "は " + player.battleVal[1] + "を となえた。";
  		    setTimeout(function() {
  		      if((player.mp - player.battleVal[2]) < 0){
  			      messageView.innerHTML = "MPが たりない！";
  		      } else if(player.disableMagic == true) {
  			      messageView.innerHTML = "しかし " + "じゅもんは ふうじこめられている。";
  		      } else {
  			      if(player.effectType == 0) { //effectType 0=回復系,1=ダメージ系,2=眠り系,3=じゅもん封じ込め系,4=無効
  				      player.hp += player.battleVal[0];
  				      if(player.hp > player.maxHP) {
  					      player.hp = player.maxHP;
  				      }
  				      messageView.innerHTML = player.name + "の HPが " + player.battleVal[0] + " かいふくした。";
  			      }
  			      if(player.effectType == 1) {
  			        // global.dq.Sound.damage();
  			        monsterLi.classList.add("damage"); //?
  			        messageView.innerHTML = monster.name + "に " + player.battleVal[0] + "の ダメージをあたえた。";
  			        monster.hp = monster.hp - player.battleVal[0];
  			      }
  			      if(player.effectType == 2) {
  			        if(player.effectSuccess == true) {
  				        messageView.innerHTML = monster.name + "を ねむらせた！";
  				        monster.status = "ねむり";
  			        } else {
  				        messageView.innerHTML = "しかし " + monster.name + "には きかなかった。";
  			        }
  			      }
  			      if(player.effectType == 3) {
  			        if(monster.magic == true) {
  			          monster.disableMagic = true;
  			          messageView.innerHTML = monster.name + "の じゅもんを ふうじこめた！"; 
  			        } else {
  				        messageView.innerHTML = "しかし " + monster.name + "には きかなかった。";
  			        }
  			      }
  			      if(player.effectType == 4) {
  			        messageView.innerHTML = "しかし なにも おこらなかった。";
  			      }
  			      player.mp -= player.battleVal[2];
  			      that.statusChange();
  		      }
  		      setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
  		    }, messageTime);
			  }
			  if(messageMode == "item") {
  			  messageView.innerHTML = player.name + "は " + player.battleVal[1] + "を つかった。";
  		    itemLi.removeChild(itemLiItem[player.useItemNum]); //使用したどうぐを表示から消す
  		    setTimeout(function() {
  		      if(player.effectType == 10) {
  			      player.hp += player.battleVal[0];
  			      if(player.hp > player.maxHP) {
  				      player.hp = player.maxHP;
  			      }
  			      messageView.innerHTML = player.name + "の HPが " + player.battleVal[0] + " かいふくした。";
  		      }
  		      that.statusChange();
  		      setTimeout(function() { BattleCtrl.nextTurnCheck(); }, messageTime);
  		    }, messageTime);
			  }
		  },
						
		  //ステータスチェンジ（HP減少時、画面にHPとMPを表示する関数。）　　
		  statusChange: function() {
			  // HPが少なくなった時に、画面の表示を変化させる？
		    if(player.hp <= (player.maxHP / 4)) {
			    battleViewElem.classList.add("badCndtn");
		    } else {
			    battleViewElem.classList.remove("badCndtn");
		    }
		    if(player.hp <= 0) {
			    playerStatusLi[2].innerHTML = 0; //HPを0にする
			    battleViewElem.classList.remove("badCndtn");
			    battleViewElem.classList.add("die");　//死んだ時の画面の表示にする
			    battleMode = "end";
		    } else {
			    playerStatusLi[2].innerHTML = player.hp;
			    playerStatusLi[3].innerHTML = player.mp;  
		    }
		  }
		};
		
		
		//battle logic　バトルロジック
    var battleLogic = function() {};
		battleLogic.prototype = {
		  init: function() {
		    messageView.innerHTML = monster.name + "が あらわれた！";
		  },
		  // たたかうで与えるダメージの計算ロジック
		  attack: function() {
		    var playerAtkVal = Math.round((player.atk - monster.def) / 2),
			      randomNum = Random.getValue();
			      this.playerStatusCheck(); //眠り状態かチェック
		    if(playerAtkVal < 2) { //なぜ2なのか？
		      playerAtkVal = this.getStandardRandom(1,2); //乱数テーブルと値を掛け合わせてダメージ数を計算している？
		    } else {
			    playerAtkVal = Math.round((playerAtkVal + (playerAtkVal + 1) * (randomNum /256)) / 2);
		    }
		    return [playerAtkVal, null, null];
		  },
		  //　モンスターの攻撃ダメージの計算ロジック
		  monsterAttack: function() {
			  var monsterAtkVal = Math.round((monster.atk * 2 - player.def) / 2),
			      randomNum = Random.getValue();
			  if(monsterAtkVal <= 0) {
				  monsterAtkVal = this.getStandardRandom(1,2);
			  } else if(monsterAtkVal < (monster.atk / 2 + 1)) {
				  monsterAtkVal = Math.round((2 + (monster.atk / 2 + 1) * (randomNum / 256)) / 3);
			  } else if(monsterAtkVal > (monster.atk / 2 + 1)) {
			    monsterAtkVal = Math.round((monsterAtkVal + (monsterAtkVal + 1) * (randomNum / 256)) / 2);
			  }
				monster.status = "こうげき";
			  return monsterAtkVal;
		  },
		  //プレーヤーがねむり状態かどうか。ねむり状態かつrandomNumが0ではない時、返り値が何もないがどうなるのか
		  playerStatusCheck: function() {	
		    if(player.status == "ねむり") {
				  var randomNum = Random.getValue([{l:0, g: 126},{l:126, g: 256}]);
			    if(randomNum == 0) {
				    player.status = "めざめ";
			    }
			    return;
			  }
		  },
		  //モンスターのステータスをチェック
		  statusCheck: function() {			  
			  if(monster.status == "ねむり") {
			    var randomNum = Random.getValue([{l:0, g: 86},{l:86, g: 192},{l:192, g: 256}]);
			    if(randomNum == 0) {
				    monster.status = "めざめ";
			    }
			    return 0;
			  } else if(monster.skill) {
				  return this.monsterMagic(); 
			  } else {
				  return this.monsterAttack();
			  }
		  },
		  //モンスターが唱えるじゅもんの値設定ロジック
		  monsterMagic: function() {　
		    var monsterAtkVal,randomNum;		    		    
		    for (var name in monster.skill) {
		      //if(monster.effect.hasOwnProperty("ベホイミ")) {
			      if((monster.skill[name] == "ベホイミ") && monster.hp < (monster.maxHP/3)) {
				      randomNum = Random.getValue([{l:0, g: 86},{l:86, g: 192},{l:192, g: 256}]);
					    if(randomNum == 0) {
						    monsterAtkVal = recover("ベホイミ");
						    return monsterAtkVal;
					    } else {
					      monsterAtkVal = this.monsterAttack();
					      return monsterAtkVal;
					    }
				    }  
		      //} else {
			      if((monster.skill[name] == "ホイミ") && monster.hp < (monster.maxHP/3)) {
				      randomNum = Random.getValue([{l:0, g: 86},{l:86, g: 192},{l:192, g: 256}]);
					    if(randomNum == 0) {
						    monsterAtkVal = recover("ホイミ");
						    return monsterAtkVal;
					    } else {
					      monsterAtkVal = this.monsterAttack();
					      return monsterAtkVal;
					    }
				    }  
		      //}
			    if(monster.skill[name] == "���ラ") {
				    randomNum = Random.getValue([{l:0, g: 106},{l:106, g: 192},{l:192, g: 256}]);
					  if(randomNum == 0) {
						  monsterAtkVal = magicAttack("ギラ");
						  return monsterAtkVal;
					  } else {
					    monsterAtkVal = this.monsterAttack();
					    return monsterAtkVal;
					  }
			    }
			    if(monster.skill[name] == "ベキラマ") {
				    randomNum = Random.getValue([{l:0, g: 86},{l:86, g: 192},{l:192, g: 256}]);
					  if(randomNum == 0) {
						  monsterAtkVal = magicAttack("ベキラマ");
						  return monsterAtkVal;
					  } else {
					    monsterAtkVal = this.monsterAttack();
					    return monsterAtkVal;
					  }
			    }
		      if(monster.skill[name] == "ラリホー") {
		        randomNum = Random.getValue([{l:0, g: 86},{l:86, g: 192},{l:192, g: 256}]);
					  if(randomNum == 0) {
						  monsterAtkVal = magicSleep();
						  return monsterAtkVal;
					  } else {
					    monsterAtkVal = this.monsterAttack();
					    return monsterAtkVal;
					  }
			      //monster.effectType = 2; 
		      }
		      if(monster.skill[name] == "マホトーン") {
		        if(player.disableMagic == true ) {
			        randomNum = Random.getValue([{l:0, g: 43},{l:43, g: 72},{l:72, g: 192},{l:192, g: 256}]);
		        } else {
			        randomNum = Random.getValue([{l:0, g: 86},{l:86, g: 192},{l:192, g: 256}]); 
		        }
					  if(randomNum == 0) {
						  monsterAtkVal = disableMagic();
						  return monsterAtkVal;
					  } else {
					    monsterAtkVal = this.monsterAttack();
					    return monsterAtkVal;
					  }
		      }
		      if(monster.skill[name] == "ひのいき") {
		        randomNum = Random.getValue([{l:0, g: 136},{l:136, g: 192},{l:192, g: 256}]);
					  if(randomNum == 0) {
						  monsterAtkVal = fireAttack("ひのいき");
						  return monsterAtkVal;
					  } else {
					    monsterAtkVal = this.monsterAttack();
					    return monsterAtkVal;
					  }
		      }
		      if(monster.skill[name] == "はげしいほのお") {
		        randomNum = Random.getValue([{l:0, g: 136},{l:136, g: 192},{l:192, g: 256}]);
					  if(randomNum == 0) {
						  monsterAtkVal = fireAttack("はげしいほのお");
						  return monsterAtkVal;
					  } else {
					    monsterAtkVal = this.monsterAttack();
					    return monsterAtkVal;
					  }
		      }
		      monsterAtkVal = this.monsterAttack();
			}
			
			//monter.effectType 0=回復系,1=ダメージ系,2=眠り系,3=じゅもん封じ込め系,4=ボスのじゅもん？
			
			//モンスターが回復呪文を唱えた時
		    function recover(effect) {
			    var effectVal,
			        randomNum;
			    monster.effectType = 0;
			    if(effect == "ベホイミ") {
			      randomNum = Random.getValue([{l:0, g: 26},{l:26, g: 52},{l:52, g: 106},{l:106, g: 176},{l:176, g: 210},{l:210, g: 236},{l:236, g: 256}]);
				    effectVal = 80;
				    monster.useEffect = "ベホイミ";
			    }
			    if(effect == "ホイミ") {
			      randomNum = Random.getValue([{l:0, g: 16},{l:16, g: 52},{l:52, g: 116},{l:116, g: 176},{l:176, g: 210},{l:210, g: 236},{l:236, g: 256}]);
				    effectVal = 30 + randomNum;
				    monster.useEffect = "ホイミ";
			    }
			    return effectVal;
		    }
			
			//モンスターが攻撃呪文を唱えた時
		    function magicAttack(effect) {
			    var effectVal,
			        randomNum;
			    monster.effectType = 1;
			    if(effect == "ギラ") {
			      randomNum = Random.getValue([{l:0, g: 16},{l:16, g: 52},{l:52, g: 116},{l:116, g: 176},{l:176, g: 210},{l:210, g: 236},{l:236, g: 256}]);
				    effectVal = 3 + randomNum;
				    monster.useEffect = "ギラ";
			    }
			    if(effect == "ベキラマ") {
			      randomNum = Random.getValue([{l:0, g: 16},{l:16, g: 52},{l:52, g: 116},{l:116, g: 176},{l:176, g: 210},{l:210, g: 236},{l:236, g: 256}]);
				    effectVal = 30 + randomNum;
				    monster.useEffect = "ベキラマ";
			    }
			    return effectVal;
		    }
			
			
		    function magicSleep() {
		      monster.effectType = 2;
		      monster.useEffect = "ラリホー";
		      return 0;
		    }
		    
		    function disableMagic() {
		      monster.effectType = 3;
		      monster.effectSuccess = false;
		      randomNum = Random.getValue([{l:0, g: 126},{l:126, g: 256}]);
		      if(randomNum == 0 || player.disableMagic == true) {
		        monster.effectSuccess = true;
		      }
		      monster.useEffect = "マホトーン";
		      return 0;
		    }
		    
		    function fireAttack(effect) {
			    var effectVal,
			        randomNum;
			    monster.effectType = 4;
			    if(effect == "ひのいき") {
			      randomNum = Random.getValue([{l:0, g: 16},{l:16, g: 52},{l:52, g: 116},{l:116, g: 176},{l:176, g: 210},{l:210, g: 236},{l:236, g: 256}]);
				    effectVal = 65 + randomNum;
				    monster.useEffect = "ひのいき";
			    }
			    if(effect == "はげしいほのお") {
			      randomNum = Random.getValue([{l:0, g: 16},{l:16, g: 42},{l:42, g: 96},{l:96, g: 116},{l:116, g: 136},{l:136, g: 146},{l:146, g: 156},{l:156, g: 166},{l:166, g: 176},{l:176, g: 186},{l:186, g: 196},{l:196, g: 206},{l:206, g: 226},{l:226, g: 236},{l:236, g: 256}]);
				    effectVal = 85 + randomNum;
				    monster.useEffect = "はげしいほのお";
			    }
			    return effectVal;
		    }
		    return monsterAtkVal;
		  },
		  
		  //プレーヤーがじゅもんを唱えた時の関数
		  //　返り値は[effectVal,effect,UseMp]  effectValは、(じゅもん固有の数値 + rabdumNum )　effectがじゅもん名
		  //player.effectTypeを書き変える effectType 0=回復系,1=ダメージ系,2=眠り系,3=じゅもん封じ込め系,4=無効
		  magic: function(effect) {
		    var effectVal, //実際にHPから差し引かれるダメージの値がこれ
		        useMp,
		        randomNum;
		    this.playerStatusCheck();
		    if(effect == "ホイミ") {
			    player.effectType = 0;
			    useMp = 3;
			    randomNum = this.getStandardRandom(0,7);
			    effectVal = 10 + randomNum;
		    }
		    if(effect == "ベホイミ") {
		      player.effectType = 0;
			    useMp = 8;
			    randomNum = this.getStandardRandom(0,15);
			    effectVal = 85 + randomNum;
			    
		    }
		    if(effect == "ギラ") {
			    player.effectType = 1;
			    useMp = 2;
			    randomNum = this.getStandardRandom(0,7);
			    effectVal = 5 + randomNum;
		    }
		    if(effect == "ベギラマ") {
			    player.effectType = 1;
			    useMp = 5;
			    randomNum = this.getStandardRandom(0,7);
			    effectVal = 58 + randomNum;
		    }
		    if(effect == "ラリホー") {
			    var successPer;			    
			    player.effectSuccess = false;
			    player.effectType = 2;
			    useMp = 2;
			    randomNum = this.getStandardRandom(0,16);			    
			    switch (monster.weaknessType2) {
			      case 0: successPer = 0;
			        break;
			      case 1: successPer = 2;
			        break;
			      case 2: successPer = 4;
			        break;
			      case 3: successPer = 8;
			        break;
			      case 4: successPer = 16;
			        break;
			    }
			    if(randomNum >= 0 && randomNum > successPer || monster.status == "ねむり") {
				    player.effectSuccess = true;
				    //monster.status = "ねむり"; 
			    }
		    }
		    if(effect == "マホトーン") {
		      var successPer;
			    player.effectType = 3;
			    useMp = 2;
			    randomNum = this.getStandardRandom(0,16);			    
			    switch (monster.weaknessType3) {
			      case 0: successPer = 0;
			        break;
			      case 1: successPer = 2;
			        break;
			      case 2: successPer = 4;
			        break;
			      case 3: successPer = 8;
			        break;
			      case 4: successPer = 16;
			        break;
			    }
			    if(randomNum >= 0 && randomNum > successPer || monster.magic == true) {
				   monster.magic = true;
			    }
		    }
		    if(effect == "レミーラ") { useMp = 2; }
		    if(effect == "リレミト") { useMp = 6; }
		    if(effect == "ルーラ") { useMp = 8; }
		    if(effect == "トヘロス") { useMp = 2; }
		    if(effect == "レミーラ" || effect == "リレミト" || effect == "ルーラ" || effect == "トヘロス") {
		      player.effectType = 4;
		    }
		    return [effectVal, effect, useMp];
		  },
		  
		  //にげるのパラメータ計算ロジック
		  escape: function() {
		    var randomNum = Random.getValue(),
		        escapeVal;
		    if(monster.id <= 21) {
			    escapeVal = 64;
		    }
		    if(monster.id > 21 && monster.id <= 31) {
		      escapeVal = 96;
		    }
		    if(monster.id > 31 && monster.id <= 36) {
		      escapeVal = 128;
		    }
		    if(monster.id > 36 && monster.id <= 40) {
		      escapeVal = 256;
		    }
		    if(player.speed * randomNum - escapeVal  * monster.def * 2 > 0) {
			    player.escape = true;
		    } else {
			    player.escape = false;
		    }
		    return player.escape;
		  },
		  //どうぐを使った時の値を設定するロジック
		  item: function(itemVal, arg) {
			  var effectVal,
			      itemNum,
			      effect,
		        randomNum;
		    this.playerStatusCheck();
		    if(itemVal == "やくそう" && player.status !== "ねむり") {
		      effect = "やくそう";
		      player.useItemNum = arg;
		      player.effectType = 10;
		      randomNum = this.getStandardRandom(0,7);
		      effectVal = 23 + randomNum;
		    } else {
			    effectVal = 0;
			    effect = null;
		    }
		    return [effectVal,effect,0];;
		  },
		  
		  // タ���� turn()　先攻/後攻を決めている？
		  turn: function() {
		    var randomNum = Random.getValue(),
		        standardRandomNum = Math.round(this.getStandardRandom(0,63));		    
			  if(0 > (player.speed * randomNum) - (standardRandomNum * monster.def * 2)) {
				  player.turn = false;
			  } else {
				  player.turn = true;
			  }
			  return player.turn;
		  },
		  
		  // 乱数テーブル
		  getStandardRandom: function(nMin,nMax) {
			  var randomNum = Math.floor(Math.random()*(nMax-nMin+1))+nMin;
			  return randomNum;
		  }
		};
		
		//Ajax Controller
		var AjaxConttoller = function(){};
		AjaxConttoller.prototype = {
		  createHttpRequest: function() {
        try {
          return new XMLHttpRequest();
        } catch(e) { }
      },
	 
	//GETパラメータを取得
     getQueryString: function() {
		   if( 1 < window.location.search.length ) {
			   var query = window.location.search.substring( 1 ),
			       parameters = query.split( '&' ),
			       result = new Object();
			   for(var i = 0; i < parameters.length; i++ ) {
			     var element = parameters[i].split('='),
			         paramName = decodeURIComponent(element[0]),
			         paramValue = decodeURIComponent(element[1]);
			         
			     result[paramName] = decodeURIComponent(paramValue);   
			   }
			   console.log(result);
			   this.requestFile(result);
			 }
			 return null; //?
		 },

     requestFile: function(result) {
        var httpObj = AjaxConttoller.prototype.createHttpRequest(),
            jsonDataObj, weapon, shield, armor, useitem,
            commendTtl = document.querySelector('.commend .commendTtl');
        var timeout = false,
            timer = setTimeout(function() {
              timeout = true;
              httpObj.abort();
             }, 10000);
             console.log(result);
        httpObj.open("GET", AjaxPath.requestFile+"?monster=" + result["monster"] + "&lv=" + result["lv"] + "&weapon=" + result["weapon"] + "&armor=" + result["armor"] + "&shield=" + result["shield"] + "&useItem=" + result["useitem"] + "&player=" + result["player"], true);
        httpObj.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded');
        httpObj.onreadystatechange = function() {
          if(httpObj.readyState !== 4) {
            return;
          }
          if(timeout) return;
          clearTimeout(timer);
          console.log(httpObj.status);
          if(httpObj.status == 200) {
            jsonDataObj = JSON.parse(this.responseText);
            player = jsonDataObj.player;　//homecontroller　function jsonのplayer部分
            monster = jsonDataObj.monster;
            weapon = jsonDataObj.weapon;
            shield = jsonDataObj.shield;
            armor = jsonDataObj.armor;
            useitem = jsonDataObj.useitem;
            console.log(useitem);
            
            player.hp = parseInt(player.maxHP, 10);
            player.speed = parseInt(player.speed, 10);
            player.sprit = parseInt(player.sprit, 10);
            player.effectSuccess = false;
            if(player.skill !== null) {
	            player.skill = player.skill.split(","); //split() = explode() カンマ区切りの文字列を配列に直してる。jsonで渡す時点で配列じゃダメだったのか
			}
            player.atk = parseInt((player.atk),10) + parseInt((weapon.atk),10);
            player.def = parseInt((player.def),10) + parseInt((armor.def),10) + parseInt((shield.def),10); 
            if(player.skill !== null && player.skill !== "なし") {
	            monster.skill = monster.skill.split(",");  //split() = explode() カンマ区切りの文字列を配列に直してる。jsonで渡す時点で配列じゃダメだったのか
            }
            commendTtl.innerHTML = player.name;
            
            monster.id = parseInt(monster.id, 10);
            monster.hp = parseInt(monster.max_hp, 10);
            monster.atk = parseInt(monster.atk, 10);
            monster.def = parseInt(monster.def, 10);
            
            monster.weaknessType1 = parseInt(monster.weaknessType1,10);
            monster.weaknessType2 = parseInt(monster.weaknessType2,10);
            monster.weaknessType3 = parseInt(monster.weaknessType3,10);
 
            if(useitem.len > 0 ) {
	            player.item = [];
	            for(var i = 0, il = useitem.len; i < il; i++) {
	              player.item[i] = "やくそう"; 
	            }
            }
            
            battleViewElem.style.display = "block";        
            BattleCtrl.init();
            BattleLogic.init();
            BattleView.init();
          }
        }        
        httpObj.send("?monster=" + result["monster"] + "&lv=" + result["lv"] + "&weapon=" + result["weapon"] + "&armor=" + result["armor"] + "&shield=" + result["shield"] + "&useItem=" + result["useitem"] + "&player=" + result["player"]);
        // httpObj.send(null);
        return;
      }
		};
		
		var AjaxCtrl = new AjaxConttoller();
		    AjaxCtrl.getQueryString();
		
		var BattleCtrl = new battleController(),
		    BattleLogic = new battleLogic(),
		    BattleView = new battleView();
  };
document.addEventListener("DOMContentLoaded", battle, false);
})(this);