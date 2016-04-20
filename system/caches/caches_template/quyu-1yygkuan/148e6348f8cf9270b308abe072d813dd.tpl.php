<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>登录-<?php echo _cfg("web_name"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/Comm.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/login.css"/>
<script type="text/javascript" src="<?php echo G_TEMPLATES_STYLE; ?>/js/JQuery.js"></script>
<link href="<?php echo G_TEMPLATES_STYLE; ?>/js/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo G_TEMPLATES_STYLE; ?>/js/demo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo G_TEMPLATES_STYLE; ?>/js/jquery.Validform.min.js"></script>
</head>
<body>
 <script type="text/javascript">
$(function(){		
	var demo=$(".registerform").Validform({
		tiptype:2,
	});	
})
</script>
<div class="login">

	<div class="login_top">
		<h1><a rel="nofollow" href="<?php echo G_WEB_PATH; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getlogo(); ?>"></a></h1>
		<p><a rel="nofollow" href="<?php echo G_WEB_PATH; ?>" class="back_home">返回首页</a><a href="<?php echo WEB_PATH; ?>/help/1" target="_blank" class="help">帮助中心</a></p>
	</div>
	<div class="login_bg">
		<div id="loadingPicBlock" class="login_banner"><img src="<?php echo G_TEMPLATES_STYLE; ?>/images/20120628180933540.jpg" width="542" height="360"></div>
		<div class="login_box" id="LoginForm">
		<form class="registerform" method="post" action="">
			<h3>用户登录</h3>
			<ul>				
				<li class="click">
					<span>账号：</span>
					<input class="text_password" name="username" type="text"  datatype="m | e" nullmsg="请填写帐号！" errormsg="手机号/邮箱！" />
				</li>
				<li class="ts"><div class="Validform_checktip">手机号/邮箱！</div></li>
				<li>
					<span>密码：</span>					
					<input class="text_password" name="password" type="password"  datatype="*6-20" nullmsg="请设置密码！" errormsg="密码范围在6~20位之间！"/>
					<span class="fog"><a href="<?php echo WEB_PATH; ?>/member/finduser/findpassword">忘记密码？</a></span> 
				</li>								
				<li class="ts" id="pwd_ts"><div class="Validform_checktip">请输入登录密码</div></li>
                
                <li>
                    <span>验证：</span>
                    <input class="text_verify" name="verify" type="text"  datatype="*6-6" nullmsg="请输入验证码！" errormsg="请输入正确的验证码！"/>
                    <span class="fog"><img id="checkcode" src="<?php echo WEB_PATH; ?>/api/checkcode/image/80_27/"/></span>
                </li>
                <li class="ts" id="pwd_ts"><div class="Validform_checktip">&nbsp;&nbsp;  请输入验证码</div></li>
				<li class="end"><input name="submit" type="submit" value="登录" class="login_init" ></li>
                
			</ul>
			<?php 
				$conn_cfg = System::load_app_config("connect",'','api');
             ?>
            <?php if($conn_cfg['qq']['off']): ?>
 			<div class="loginQQ">使用合作帐号登录:<span id="qq_login_btn"><a href="<?php echo WEB_PATH; ?>/api/qqlogin/"><img src="<?php echo G_TEMPLATES_STYLE; ?>/images/qqlogin.png" /></a></span></div>  
            <?php endif; ?>			
			<input value="<?php echo G_HTTP_REFERER; ?>" name="hidurl" type="hidden">

			
			<h4>
				<a id="hylinkRegisterPage" tabindex="4" class="reg" href="<?php echo WEB_PATH; ?>/register">立即注册</a></h4>
		</form>
		</div>
	</div>
</div>
<!--login 结束-->
<div class="footer">
	<div class="footer_links">
		<a href="<?php echo WEB_PATH; ?>">首页</a>
		<b></b>
		<?php echo Getheader('foot'); ?>
  	</div>
	<div class="copyright"><?php echo _cfg("web_copyright"); ?></div>
</div>
</body>
</html>