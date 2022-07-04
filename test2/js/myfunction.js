var imgs = document.getElementById('ul1').children;
var leftbotton = document.getElementById('left-botton');
var rightbotton = document.getElementById('right-botton');
var botton = document.getElementById('ul2').children;
var index = 0;
var dingshiqi;
var all = document.getElementsByClassName('box')[0];

chongqi();
 //定时器函数
 function chongqi(){
	dingshiqi=setInterval(function(){
		index++;
		if(index==imgs.length){
			index=0;
		}
		for (var i = 0;i<imgs.length; i++){
		imgs[i].style.cssText="opacity: 0;";
		botton[i].style.cssText="background-color:#fff;color:#000;";
	}
	imgs[index].style.cssText="opacity:1;";
	botton[index].style.cssText="background-color:red;color:#fff;";
	},5000);
}

//绑定按钮事件
leftbotton.onclick = function(){
	clearInterval(dingshiqi);
	index--;
	if(index<0){
		index=imgs.length-1;
	}
	for (var i = 0;i<imgs.length; i++){
		imgs[i].style.cssText="opacity: 0;";
		botton[i].style.cssText="background-color:#fff;color:#000;";
	}
	imgs[index].style.cssText="opacity:1;";
	botton[index].style.cssText="background-color:red;color:#fff;";
	chongqi();
}

rightbotton.onclick = function(){
	clearInterval(dingshiqi);
	index++;
	if(index>=imgs.length){
		index=0;
	}
	for (var i = 0;i<imgs.length; i++){
		imgs[i].style.cssText="opacity: 0;";
		botton[i].style.cssText="background-color:#fff;color:#000;";
	}
	imgs[index].style.cssText="opacity:1;";
	botton[index].style.cssText="background-color:red;color:#fff;";
	chongqi();
}

//底部按钮绑定

/* jquery 方法绑定底部按钮
$("#ul2>li").click(function() {
	clearInterval(dingshiqi);
	$(this).css({"background-color":"red","color":"#fff"}).siblings("li").css({"background-color":"#fff","color":"#000"});
	$("#ul1>li").eq($(this).index()).css("opacity",1).siblings("li").css("opacity",0);
	chongqi();
});
*/

botton[0].onclick = function(){
	clearInterval(dingshiqi);
	index=0;
	for (var i = 0;i<imgs.length; i++){
		imgs[i].style.cssText="opacity: 0;";
		botton[i].style.cssText="background-color:#fff;color:#000;";
	}
	imgs[index].style.cssText="opacity:1;";
	botton[index].style.cssText="background-color:red;color:#fff;";
	chongqi();
}

botton[1].onclick = function(){
	clearInterval(dingshiqi);
	index=1;
	for (var i = 0;i<imgs.length; i++){
		imgs[i].style.cssText="opacity: 0;";
		botton[i].style.cssText="background-color:#fff;color:#000;";
	}
	imgs[index].style.cssText="opacity:1;";
	botton[index].style.cssText="background-color:red;color:#fff;";
	chongqi();
}
botton[2].onclick = function(){
	clearInterval(dingshiqi);
	index=2;
	for (var i = 0;i<imgs.length; i++){
		imgs[i].style.cssText="opacity: 0;";
		botton[i].style.cssText="background-color:#fff;color:#000;";
	}
	imgs[index].style.cssText="opacity:1;";
	botton[index].style.cssText="background-color:red;color:#fff";
	chongqi();
}
botton[3].onclick = function(){
	clearInterval(dingshiqi);
	index=3;
	for (var i = 0;i<imgs.length; i++){
		imgs[i].style.cssText="opacity: 0;";
		botton[i].style.cssText="background-color:#fff;color:#000;";
	}
	imgs[index].style.cssText="opacity:1;";
	botton[index].style.cssText="background-color:red;color:#fff;";
	chongqi();
}

all.onmouseover = function(){
	
	leftbotton.style.display = "block";
	rightbotton.style.display = "block";
}
all.onmouseout = function(){
	leftbotton.style.display="none";
	rightbotton.style.display="none";
	
}


