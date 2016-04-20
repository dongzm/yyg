<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
table th{ border-bottom:1px solid #eee; font-size:12px; font-weight:100; text-align:right; width:200px;}
table td{ padding-left:10px;}
input.button{ display:inline-block}
</style>
</head>
<body>
<div class="header lr10">
	<a href="<?php echo WEB_PATH;?>/admin/member/add_membergroup">增加会员组</a>
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<!--start-->
<form name="myform" action="" method="post" enctype="multipart/form-data">
  <table width="100%" cellspacing="0">
  	 <tr>
			<td width="120" align="right">会员组名：</td>
			<td><input type="text" name="name" value="" class="input-text"></td>
		</tr>
		<tr>
			<td width="120" align="right">开始经验：</td>
			<td><input type="text" name="jingyan_start" value="" class="input-text"></td>
		</tr>
		<tr>
			<td width="120" align="right">结束经验：</td>
			<td><input type="text" name="jingyan_end" value="" class="input-text"></td>
		</tr>
		<tr>
        	<td width="120" align="right"></td>
            <td>		
            <input type="submit" class="button" name="submit" value="提交" >
            </td>
		</tr>
</table>
</form>
</div><!--table-list end-->
<script>
function upImage(){
	return document.getElementById('imgfield').click();
}
</script>
</body>
</html> 