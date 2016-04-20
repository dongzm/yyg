<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo G_PLUGIN_PATH; ?>/uploadify/api-uploadify.js" type="text/javascript"></script> 
<style>
tr{height:40px;line-height:40px}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
<form name="myform" action="" method="post">
  <table width="100%" cellspacing="0">
  	<tr>
		<td width="220" align="right">网站地址：</td>
		<td><input type="text" name="web_path" value="<?php echo $web['web_path']; ?>"  class="input-text wid200"></td>
	</tr>
    <tr>
		<td width="220" align="right">网站logo：</td>
		<td>
           	<input type="text" id="imagetext" value="<?php echo $web['web_logo']; ?>" name="web_logo" class="input-text wid300">
			<input type="button" class="button"
             onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','LOGO上传','image','banner',1,500000,'imagetext')" 
             value="上传LOGO"/>
			图片大小：105*63
        </td>
	</tr>
  	 <tr>
			<td width="220" align="right">网站名称：</td>
			<td><input type="text" value="<?php echo $web['web_name']; ?>" name="web_name" class="input-text wid200"></td>
	</tr>
	<tr>
			<td width="220" align="right">网站短名称：</td>
			<td><input type="text" value="<?php echo $web['web_name_two']; ?>" name="web_name_two" class="input-text wid200"></td>
	</tr>
     <tr>
			<td width="220" align="right">网站关键字：</td>
			<td><input type="text" value="<?php echo $web['web_key']; ?>" name="web_key" class="input-text wid300"></td>
	</tr>
     <tr>
			<td width="220" align="right">网站描述：</td>
			<td><textarea name="web_des" class="wid300" style="height:80px"><?php echo $web['web_des']; ?></textarea>
            </td>
	</tr>	

     <tr>
			<td width="220" align="right">版权信息：</td>
			<td><textarea name="web_copyright" class="wid300" style="height:80px"><?php echo $web['web_copyright']; ?></textarea>
            </td>
	</tr>	
    <tr>
        	<td width="220" align="right"></td>
            <td><input type="submit" class="button" name="dosubmit"  value=" 提交 " ></td>
   </tr>
</table>
</form>

</div><!--table-list end-->

<script>
	
</script>
</body>
</html> 