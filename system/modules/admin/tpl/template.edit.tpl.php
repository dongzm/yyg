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
	<b>模板管理</b> 
    <span style="color:#f60; padding-left:30px;">谨防模板被盗,建议修改html目录地址</span>
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<form action="" method="post" id="myform">
<table width="100%" class="lr10">
    <tr>
    	<td width="80">模板名称</td> 
   		<td><input type="text" name="name" class="input-text"  value="<?php echo $template['name']; ?>"></td>
    </tr>
    <tr>
    	<td width="80">模板目录</td> 
   		<td><input type="text" name="dir" class="input-text"  value="<?php echo $template['dir']; ?>">
		<span> 可以自定义模板目录,确保不和其他模板目录名称不重复!</span>
		</td>
    </tr>
    <tr>
    	<td width="80">HTML目录</td> 
   		<td><input type="text" name="html" class="input-text"  value="<?php echo $template['html']; ?>">
		<span> 防止模板被盗,请尽快修改!</span>
		</td>
    </tr>
    <tr>
    	<td width="80">模板作者</td> 
   		<td><input type="text" name="author" class="input-text"  value="<?php echo $template['author']; ?>"></td>
    </tr>
</table>
   	<div class="bk15"></div>
    <input type="submit" value=" 提交 " name="dosubmit" class="button">
</form>
</div><!--table-list end-->
</body>
</html> 