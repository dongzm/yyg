<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $string; ?></title>
    <meta name="robots" content="noindex, nofollow" />
<style type="text/css">
	*{margin:0;padding:0;}
	html,body{ overflow:hidden}
	body{color:#333;font:12px/1.5 Tahoma,Arial,"宋体",Helvetica,sans-serif;height:auto;width:100%; background-color:#f9f9f9}
	div{margin:0 auto;}
	ul{list-style-type:none;}
	.box{ border:5px solid #eee; width:480px; background-color:#fff;
		  margin-top:15%;erflow:hidden;		
	}
	.box-b{ border:1px solid #dfdbdb;width:478px;erflow:hidden;}
	.box-title{ background:<?php if(isset($config['titlebg'])): ?><?php echo $config['titlebg']; ?><?php  else: ?>#f60<?php endif; ?>;height:30px;line-height:33px;_line-height:30px;font-size: 14px;color:<?php if(isset($config['title'])): ?><?php echo $config['title']; ?><?php  else: ?>#fff<?php endif; ?>; padding:0 10px;}
	.box-text{font:12px/1.5 "微软雅黑",Arial,"宋体",Helvetica,sans-serif; font-size:18px;color:#73787b;width:438px;		
			  text-align:center; border:0px solid #000; padding:20px; height:auto;word-wrap:break-word;
			  }
	.box-button{overflow:hidden; text-align:right;}
	.box-button a{  display: inline-block;					
					height:25px;line-height:23px;_line-height:25px;
					text-align: center;
					font-family:"微软雅黑";
					font-size: 14px;
					text-decoration: none;
					padding:0px 5px;
					margin:0px 10px;
					
    }
	.a-1{ background-color:#eee; color:#666; border:1px solid #dfdbdb;}
	.a-2{ background-color:#eee; color:#666;border:1px solid #dfdbdb;}	
</style>
<script>

function locahost(){
	<?php if($defurl == ':js:'): ?>window.history.back();<?php  else: ?>location.href="<?php echo $defurl; ?>";<?php endif; ?>
}

	function closeWindow(){window.open('', '_self', '');window.close();}

var i = <?php echo $time; ?>;	if(i!=0){window.close_id = setInterval(function() {if (i > 0) {document.getElementById('time').innerHTML = i;i = i - 1;} else {
		locahost();clearInterval(window.close_id);}}, 1000);}</script>

</script>
</head>
<body>
<div class="box">
	<div class="box-b">
		<div class="box-title">消息提示</div>
        <div class="box-text">
        	<?php echo $string; ?>
        </div>
        <div class="box-button"><a class="a-2" href="javascript:;" onclick="locahost()"><font id="time" style="color:red;"><?php echo $time; ?></font>秒后返回上一页面</a><a class="a-1" href="<?php echo $str_url_two['url']; ?>"><?php echo $str_url_two['text']; ?></a></div> 
        <div style="height:10px; overflow:hidden; width:100%; clear:both"></div>
    </div>
</div>
 
</body>
</html>
