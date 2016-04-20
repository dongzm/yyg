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
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<!--start-->
<form name="myform" action="" method="post" enctype="multipart/form-data">
<table width="100%" class="lr10">
  	 <tr>
			<td width="120" align="right">链接名称：</td>
			<td><input type="text" name="name" class="input-text"></td>
	</tr>
		<tr>
			<td width="120" align="right">链接地址：</td>
			<td><input type="text" name="url"  class="input-text"></td>
		</tr>
        <tr>
        	<td width="120" align="right">链接图片:</td>
            <td>
           	<input type="text" id="imagetext"  class="input-text wid300">
            <input type="button" class="button" onClick="upImage()" value="选择图片"/>          
			<input type="file" id="imgfield" name="image" class="button" 
            onchange="document.getElementById('imagetext').value=this.value"
            style=" display:none;" /> 
            </td>
        </tr>
		<tr>
        	<td width="120" align="right"></td>
            <td><input type="submit" class="button" name="submit"  value=" 提交 " ></td>
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