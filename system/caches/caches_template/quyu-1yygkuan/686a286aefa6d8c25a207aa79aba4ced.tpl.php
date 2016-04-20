<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>注册 - <?php echo $webname; ?>触屏版</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/login.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
	<script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/Register.js" language="javascript" type="text/javascript"></script>
</head>
<body>
    <div class="h5-1yyg-v1" id="content">
        
<!-- 栏目页面顶部 -->


<!-- 内页顶部 -->

    <header class="g-header">
        <div class="head-l">
	        <a href="javascript:;" onClick="history.go(-1)" class="z-HReturn"><s></s><b>返回</b></a>
        </div>
        <h2>注册</h2>
        <div class="head-r">
	        <a href="<?php echo WEB_PATH; ?>/mobile/mobile" class="z-Home"></a>
        </div>
    </header>

        <section>
        <div class="registerCon">
	        <ul>
    	        <li><input id="userMobile" type="tel" placeholder="请输入您的手机号码" class="rText"><s class="rs1"></s>
				</li>
				<li><input type="password" id="txtPassword" placeholder="密码" class="rText"><s class="rs3"></s>
				</li>
                <li><input type="text" id="txtVerify" placeholder="验证码" class="rVerify"><span class="fog"><img id="checkcode" src="<?php echo WEB_PATH; ?>/api/checkcode/image/85_27/"/></span><s class="rs3"></s>
                </li>
                <li><a id="btnNext" class="nextBtn  orgBtn">下一步</a></li>
                <li><span id="isCheck"><em></em>我已阅读并同意</span><a href="<?php echo WEB_PATH; ?>/mobile/mobile/terms"><?php echo $webname; ?>用户服务协议</a></li>
            </ul>
        </div>
        </section>
        
<?php include templates("mobile/index","footer");?>
<script language="javascript" type="text/javascript">

  var Path = new Object();
  Path.Skin="<?php echo G_WEB_PATH; ?>/statics/templates/<?php echo _cfg('templates_name'); ?>";
  Path.Webpath = "<?php echo WEB_PATH; ?>";
  
var Base={head:document.getElementsByTagName("head")[0]||document.documentElement,Myload:function(B,A){this.done=false;B.onload=B.onreadystatechange=function(){if(!this.done&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){this.done=true;A();B.onload=B.onreadystatechange=null;if(this.head&&B.parentNode){this.head.removeChild(B)}}}},getScript:function(A,C){var B=function(){};if(C!=undefined){B=C}var D=document.createElement("script");D.setAttribute("language","javascript");D.setAttribute("type","text/javascript");D.setAttribute("src",A);this.head.appendChild(D);this.Myload(D,B)},getStyle:function(A,B){var B=function(){};if(callBack!=undefined){B=callBack}var C=document.createElement("link");C.setAttribute("type","text/css");C.setAttribute("rel","stylesheet");C.setAttribute("href",A);this.head.appendChild(C);this.Myload(C,B)}}
function GetVerNum(){var D=new Date();return D.getFullYear().toString().substring(2,4)+'.'+(D.getMonth()+1)+'.'+D.getDate()+'.'+D.getHours()+'.'+(D.getMinutes()<10?'0':D.getMinutes().toString().substring(0,1))}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js');
  var checkcode=document.getElementById('checkcode');
  checkcode.src = checkcode.src + new Date().getTime();
  var src=checkcode.src;
  checkcode.onclick=function(){
      this.src=src+'/'+new Date().getTime();
  }
</script>
 
    </div>
</body>
</html>