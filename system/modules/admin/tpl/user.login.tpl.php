<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>云购系统后台管理</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/login.css" type="text/css">
<style>
.login_index{ position:absolute; width:512px; height:344px;left:50%; top:220px; margin-left:-256px;}
.footer{ position:absolute; bottom:10px; width:100%; text-align:center; color:#ccc}
.login { 

	background-color:#ecebeb; position:absolute; width:451px; height:300px;opacity:1;filter:alpha(opacity=100);
	box-shadow:0px 0px 0px #b4641c; left:31px; top:23px;
}
.login_header{background-color:#9dcc5a;width:451px; height:25px;}
.login_header span{ display:inline-block; width:112px; height:25px;float:left;}
.login_header_span1{ background-color:#f17564;}
.login_header_span2{ background-color:#8ccfb3; border-right:3px solid #8ccfb3}
.login_header_span3{ background-color:#7298a6}
.login_header_span4{ background-color:#9dcc5a}

.login_title{ height:50px; line-height:50px; font-size:22px; color:#809eaa; text-align:center}

.login_form{width:451px; height:220px;}
.login_form li{ height:40px; line-height:40px; position:relative;}
.login_form span{margin:0px; display:inline-block; width:85px;line-height:40px; padding-left:40px; text-align:left;font-size:15px; color:#809eaa;}
.textinput{ border:1px solid #809eaa;font-size:15px; position:absolute;top:5px;width:160px; height:25px; color:#db9140;
			padding:0px 10px;background-color:#fff; line-height:25px;}
#form_but{ width:183px; height:44px; margin-top:10px; border:0px; overflow:hidden; cursor:pointer; line-height:44px; 
		 font-size:18px; color:#f17564;font-family: "微软雅黑",Arial,"宋体";
}
#checkcode{display:inline-block; position:absolute;right:145px; top:5px; cursor:pointer}

</style>
</head>
<body>
<div class="login_index">
    <div class="login">
        <div class="login_header">
            <span class="login_header_span1"></span>
            <span class="login_header_span2"></span>
            <span class="login_header_span3"></span>
            <span class="login_header_span4"></span>
        </div> 
   		<!--[if !IE]><!--><div class="login_yun1"></div><!--<![endif]-->
        <!--[if gte IE 8]><div class="login_yun1"></div><![endif]-->
        <div class="login_title">欢迎登陆 YunGouCMS </div>
        <div class="login_form">
        <ul>
        <form action="#" method="post" id="form">
        <li><span>管理账号:</span><input type="text" id="input-u" name="username" style="color:#f17564;" class="textinput" value="用户名" /></li>
        <li><span>管理密码:</span><input type="password" id="input-p" name="password" style="color:#8ccfb3;" class="textinput"  value="********" /></li>
		<?php if(_cfg("web_off")){ ?>
        <li><span>验证码:</span><input type="text" id="input-c" name="code" style="color:#9dcc5a;width:60px;text-transform:uppercase;" class="textinput" value="code" />
        <img id="checkcode" src="<?php echo WEB_PATH; ?>/api/checkcode/image/80_27/"/>
        </li>
		<?php } ?>
        <li><span></span><input type="button" id="form_but"  value="登录" /></li>
        </form>
        </ul>
        </div>
    </div><!--login end-->
</div><!--index end-->
<div class="footer">
Copyright (c)2015 韬龙网络
</div>

<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/global.js"></script>
<script src="<?php echo G_PLUGIN_PATH; ?>/layer/layer.min.js"></script>

<script type="text/javascript">
var loading;
var form_but;
window.onload=function(){
	
	 document.onkeydown=function(){
		if(event.keyCode == 13){
             ajaxsubmit();
        }          
	}
	form_but=document.getElementById('form_but');
	form_but.onclick=ajaxsubmit;	
	<?php if(_cfg("web_off")){ ?>
	var checkcode=document.getElementById('checkcode');	
	checkcode.src = checkcode.src + new Date().getTime();	
	var src=checkcode.src;
		checkcode.onclick=function(){
				this.src=src+'/'+new Date().getTime();
	}
   <?php } ?>
		
}

$(document).ready(function(){$.focusblur("#input-u");$.focusblur("#input-p");$.focusblur("#input-c");});

function ajaxsubmit(){
		var name=document.getElementById('form').username.value;
		var pass=document.getElementById('form').password.value;
		<?php if(_cfg("web_off")){ ?>
		var codes=document.getElementById('form').code.value;
	    <?php }else{ ?>
		var codes = '';
		<?php } ?>
		//document.getElementById('form').submit();
		$.ajaxSetup({
			async : false
		});				
		$.ajax({
			   "url":window.location.href,
			   "type": "POST",
			   "data": ({username:name,password:pass,code:codes,ajax:true}),
			   "beforeSend":beforeSend, //添加loading信息
			   "success":success//清掉loading信息
		});
	
}
function beforeSend(){
	 form_but.value="登录中...";
	 loading=$.layer({
		type : 3,
		time : 0,
		shade : [0.5 , '#000' , true],
		border : [5 , 0.5 , '#7298a6', true],
		loading : {type : 4}
	});
}

function success(data){
	layer.close(loading);
	form_but.value="登录";
	var obj = jQuery.parseJSON(data);
	if(!obj.error){	
		window.location.href=obj.text;
	}else{
		$.layer({
			type :0,
			area : ['auto','auto'],
			title : ['信息',true],
			border : [5 , 0.5 , '#7298a6', true],
			dialog:{msg:obj.text}
		});
		var checkcode=document.getElementById('checkcode');
		var src=checkcode.src;
			checkcode.src='';
			checkcode.src=src;
		}
}
</script>
</body>
</html> 
