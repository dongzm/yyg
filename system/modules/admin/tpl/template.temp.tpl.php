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
	<b>通知模板配置</b><span style=" padding-left:30px;"></span>
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<form action="" method="post" id="myform">
<table width="100%" class="lr10">
    <tr>
    	<td width="150">用户邮件验证模板：</td> 
   		<td><textarea name="e_reg_temp" style=" height:50px; width:450px" class="input-text"><?php echo $temp_e_reg['value']; ?></textarea>
        <font color="red">{地址}</font> 是发送的地址！</font>
    </tr>
    <tr>
    	<td width="150">用户云购获奖邮件模板：</td> 
   		<td><textarea name="e_shop_temp" style=" height:50px; width:450px" class="input-text"><?php echo $temp_e_shop['value']; ?></textarea>
        <font color="red">{用户名}</font> 是用户名称！<font color="red">{中奖码}</font> 是云购码！
        <font color="red">{商品名称}</font> 是云购的商品名称！ 
        </td>
    </tr>
    <tr>
        <td width="150">用户找回密码邮件模板：</td>
        <td><textarea name="e_pwd_temp" style=" height:50px; width:450px" class="input-text"><?php echo $temp_e_pwd['value']; ?></textarea>
            <font color="red">{地址}</font> 是发送的地址！</font>

        </td>
    </tr>

    <tr>
        <td width="150">用户短信验证短信模板：</td>
        <td><textarea name="m_reg_temp" style=" height:50px; width:450px" class="input-text"><?php echo $temp_m_reg['value']; ?></textarea>
            <font color="red">000000</font> 是发送的验证码！请不要超过75个字,超过按照2条短信发送</td>
    </tr>
    <tr>
        <td width="150">用户云购获奖短信模板：</td>
        <td><textarea name="m_shop_temp" style=" height:50px; width:450px" class="input-text"><?php echo $temp_m_shop['value']; ?></textarea>
            <font color="red">00000000</font> 是发送的云购码！,请不要超过75个字,超过按照2条短信发送
        </td>
    </tr>
    <tr>
        <td width="150">用户找回密码短信模板：</td>
        <td><textarea name="m_pwd_temp" style=" height:50px; width:450px" class="input-text"><?php echo $temp_m_pwd['value']; ?></textarea>
            <font color="red">000000</font> 是发送的云购码！,请不要超过75个字,超过按照2条短信发送
        </td>
    </tr>
      <tr>
    	<td width="100"></td> 
   		<td> <input type="submit" value=" 提交 " name="dosubmit" class="button"></td>
   	 </tr>
</table>
</form>
</div><!--table-list end-->
</body>
</html> 