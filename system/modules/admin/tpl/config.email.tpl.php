<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
</head>
<body>
<div class="header-title lr10">
	<b>邮箱接口设置</b>
    <!---
	<span class="lr10"> | </span>
	<b><a href="<?php echo G_MODULE_PATH; ?>/template/email_temp">邮件发送模板配置</a><b>--->
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<form action="" method="post" id="myform">
<table width="100%" class="lr10">
  <tr>
    <td width="100">邮件发送模式</td>
    <td>
     <input checkbox="mail_type" value="1" onClick="showsmtp(this)" type="radio"  checked> SMTP 函数发送    		     
	</td>
  </tr>
  <tr>
    <td>邮件服务器</td>
    <td><input type="text" class="input-text" name="server" size="30" value="<?php echo $info['stmp_host'];?>"/></td>
  </tr>  
  <tr>
    <td>发件人地址</td>
    <td><input type="text" class="input-text" name="email" size="30" value="<?php echo $info['from'];?>"/></td>
  </tr> 
  <tr>
    <td>发件人姓名</td>
    <td><input type="text" class="input-text wid80" name="name" size="30" value="<?php echo $info['fromName'];?>"/></td>
  </tr>
   <tr>
    <td>发送编码</td>
    <td><input type="text" class="input-text wid80" name="big"  value="<?php echo $info['big'];?>"/></td>
  </tr> 
  <tr>
	 <td>验证用户名</td>
	 <td><input type="text" class="input-text" name="user" size="30" value="<?php echo $info['user'];?>"/></td>
  </tr> 
  <tr>
	 <td>验证密码</td>
	 <td><input type="password" class="input-text" name="pass" size="30" value="<?php echo $info['pass'];?>"/></td>
  </tr>  
  <tr>
	 <td>测试邮件</td>
	 <td>
     <input type="text" id="ceshi" class="input-text"  size="30" value="输入测试邮箱地址..."/>
     <input type="button" value=" 测试邮件 " onClick="sendemail();" class="button">
     </td>
  </tr> 
	<tr>
    	<td width="100"></td> 
   		<td> <input type="submit" value=" 提交 " name="dosubmit" class="button"></td>
    </tr>
</table>

</form>
</div><!--table-list end-->
<script>
function sendemail(){
	var dizhi=document.getElementById('ceshi');
	var email=dizhi.value;
	var	xinemail=email.replace('.',"|");
	$.post("<?php echo G_MODULE_PATH; ?>/setting/email/cesi/"+xinemail,function(data){
		alert(data);
	});	
}
</script>
</body>
</html> 