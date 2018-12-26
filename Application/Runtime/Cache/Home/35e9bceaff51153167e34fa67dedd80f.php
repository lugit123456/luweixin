<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
<title>大家来找茬手机微信小游戏</title>
<style type="text/css">
	*{
		margin: 0;
		padding: 0;
		list-style: none;
		text-decoration: none;
	}
	#back{
		width: 300px;
		height: 500px;
		background: #000;
		margin: 100px auto;
		padding: 50px 50px 0;
		position: absolute;
		z-index: 1000;
		top: 0;
		left: 0;
		right: 0;
		opacity: 0.8;
		display: none;
	}
	h1{
		text-align: center;
		padding-top: 200px;
		font-size: 50px;
	}
	h1 a{
		color: #fff;
	}
	.container{
		position: relative;
		width: 300px;
		height: 500px;
		background: #aeaeae;
		margin: 100px auto;
		padding: 50px 50px 0;
	}
	.left{
		float: left;
	}
	.right{
		float: right;
	}
	.main{
		width: 300px;
		margin: 80px auto 20px;
		background: orange;
		text-align: center;
	}
	.list1{
		width: 100%;
	}
	.list1>img{
		width: 100%;
		display: block;
	}
	button{
		width: 200px;
		margin: 0 auto;
		height: 40px;
		border: 0;
		border-radius: 10px;
		background: linear-gradient(#59AD42,#319428);
		color: #fff;
		font-size: 20px;
		position: relative;
		left: 50%;
		transform: translateX(-50%);
	}
	button:hover{
		background: linear-gradient(#319428,#59AD42);
	}
	#turnOff{
		width: 80px;
		height: 40px;
		display: block;
		position: absolute;
		background: transparent;
	}
</style>

</head>
<body>
<!--1.两张图片 预加载好;
2.布局-->
<div class="Sharing" STYLE="float: right;">
    <div class="bdsharebuttonbox bdshare-button-style0-16" data-bd-bind="1441079683326"><a href="#" class="bds_more" data-cmd="more">分享到：</a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
    <script>
        window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{"bdSize":16},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
    </script>
</div>
<div id="back">
	<h1><a href="<?php echo U('Home/lu/zhaocha');?>">重新开始</a></h1>
</div>
<div class="container">
	<div class="left"><span>剩余时间: </span><span id="sec"> 30 </span> s </div>
	<div class="right"><span>分数: </span><span id="score">0</span></div>
	<div class="main">
		<ul>
			<li class="list1"><img src="/Public/home/images/img/2.png"></li>
		</ul>
	</div>
	<button>点 击 开 始 游 戏</button>
	<button id="turnOff">护眼模式</button>
</div>

<script type="text/javascript" charset="utf-8">
	var btn=document.querySelector('button');
	var z=30.00;
	var sec=document.getElementById('sec');
	var uls=document.querySelector('ul');
	var li_1=document.getElementsByClassName('list1')[0];
	var score=document.getElementById('score');
	var level=1;
	var n=0;
	var turnOff=document.getElementById('turnOff');
	turnOff.onclick=function(){
		document.body.style.background='rgb(199,237,204)';
		turnOff.innerHTML='普通模式';
			turn();	
	}
	function turn(){
		turnOff.onclick=function(){
			document.body.style.background='';
			turnOff.innerHTML='护眼模式';
			turnOff.onclick=function(){
				document.body.style.background='rgb(199,237,204)';
				turnOff.innerHTML='普通模式';
				turn();	
			}
		}
	}
	var back=document.getElementById('back');
	btn.onclick=function(){
		// 1.计时器
		var timer=setInterval(function(){
			z-=0.01;
			z=z.toFixed(2);
			sec.innerHTML=z;
			if (z<=0) {
				clearInterval(timer);
				if (n<8) {
					alert('GAME OVER!'+'  '+'等级:睁眼瞎');
				}else if (n>=20) {
					alert('GAME OVER!'+'  '+'等级:超神');
				}else if (n>=12) {
					alert('GAME OVER!'+'  '+'等级:火眼金睛');
				}else{
					alert('GAME OVER!'+'  '+'等级:高度近视');
				}
				back.style.display='block';
			}
		},10)
		// 2.点击按钮消失,第一个li消失
		btn.remove();
		li_1.remove();
		turnOff.remove();
		// 3.添加4个li>img
		app();
		function app(){
			level+=1;
			for (var i=0;i<level*level;i++) {
				var newLi=document.createElement('li');
				uls.appendChild(newLi);
				var newImg=document.createElement('img');
				newLi.appendChild(newImg);
				newLi.style.width=100/level+'%';
				newLi.style.float='left';
				newImg.style.display='block';
				newImg.style.width=100+'%';
				newImg.src='/Public/home/images/img/1.png';
				newLi.style.backgroundColor='rgb('+rand(50,255)+','+rand(50,255)+','+rand(50,255)+')';
			}
			var x=rand(0,level*level-1);		// 赋予一个随机房祖名下标
			var imgs1=document.querySelectorAll('img');
			imgs1[x].src='/Public/home/images/img/2.png';	// 随机一张图片变成房祖名
			var li=document.querySelectorAll('li');
			li[x].onclick=function(){
				for (var i=0;i<level*level;i++) {
					li[i].remove(this);
				}
				n+=1;
				score.innerHTML=n;
				/*if (level>10) {
					level=10;
				}*/
				app();
			}
		}
	}
	// 随机函数
	function rand(min,max){
		return Math.round(Math.random()*(max-min)+min);
	}
</script>
</body>
</html>