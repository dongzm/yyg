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
<div class="table-form lr10">
	<form name="form" action="#" method="post">
    <?php if (ROUTE_A == 'insert'): ?>    	
    	<span style="color:#09c; line-height:25px;"><b>模块名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文件名</b></span><br />
        <input type="type" name="modulename" onkeyup="value=value.replace(/[\W]/g,'')"  class="input-text wid80" />.
        <input type="type" name="filename" onkeyup="value=value.replace(/[\W]/g,'')" class="input-text wid80" />.
         <input type="type" class="input-text wid40" value="html" readonly />
        <span style="color:#ccc">如: demo.index  不需要添加后缀，系统默认会加上" .html "</span>
        <div class="bk10"></div>
		<span style="color:#09c; line-height:25px;"><b>内容</b></span><br /><textarea style="width:100%;height:400px;" name="content"><?php echo $htmlcontent;?></textarea>
    <?php endif; ?>
    <?php if (ROUTE_A == 'update'): ?>
		<textarea style="width:100%;height:400px;" name="content"><?php echo $files;?></textarea>
    <?php endif; ?>
    <div class="btn_paixu">        		
		<input type ="submit" name="submit" class='button' value="保存模板" style="margin-left:10px"/>
	</div>
</form>
</body>
</html>