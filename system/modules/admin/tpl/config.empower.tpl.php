<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
tr{height:40px;line-height:40px}
</style>
</head>
<body>
<div class="header-title lr10">
	<b>绑定授权码</b>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
<form name="myform" action="" method="post">
  <table width="100%" cellspacing="0">	
		<tr>
			<td width="100" align="right">授权码：</td>
			<td><input type="text" name="code" value=""  class="input-text wid300">
			<input type="submit" class="button" name="dosubmit"  value=" 绑定 " >
			</td>
		</tr>
</table>
</form>

</div><!--table-list end-->
<script>
	
</script>
</body>
</html> 