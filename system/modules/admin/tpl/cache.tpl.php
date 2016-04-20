<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
.t-cache{padding:20px;}
.t-cache li{ border-bottom:1px solid #eee; line-height:35px;}
</style>
</head>
<body>
<div class="bk10"></div>
<div class="header-data lr10">
	<b>清空缓存</b> 
</div>
<div class="bk10"></div>

<div class="t-cache">
<form method="post" action="">
	<li><input name="cache[template]" value="template" type="checkbox">&nbsp;模板缓存 </li>
	<li><input name="cache[file_cache]" value="file_cache" type="checkbox">&nbsp;文件缓存 （一些升级文件缓存）</li>
	<li><input name="cache[logs_cache]" value="logs_cache" type="checkbox">&nbsp;错误日志缓存</li>
	<li><input name="cache[admin_log_cache]" value="admin_log_cache" type="checkbox">&nbsp;管理员日志</li>
    <div class="bk10"></div>
	<input name="dosubmit" value="开始清除" type="submit" class="button" style="width:60px; text-align:center" />
</form>
</div>

<div class="bk30"></div>
<script>
	
</script>
</body>
</html>