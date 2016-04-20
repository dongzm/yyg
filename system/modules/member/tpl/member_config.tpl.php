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
	<?php echo $this->headerment(); ?>
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<!--start-->
<form name="myform" action="" method="post" enctype="multipart/form-data">
  <table width="100%" cellspacing="0">
  		<tr>
			<td width="120" align="right">不允许注册昵称:</td>
			<td><textarea name="nickname" class="input-text" style="width:400px; height:80px"><?php echo $nickname; ?></textarea>
             <span> 用户不可以使用的昵称,多个用,号分割</span></td>
		</tr>
        <tr>
			<td width="120" align="right">注册类型:</td>
			<td>
            	        <label><input name="reg_email" type="checkbox" value="1" <?php echo (($regtype['reg_email']) ? 'checked' : ''); ?> /> 邮箱注册 </label><br/>
                        <label><input name="reg_mobile" type="checkbox" value="1" <?php echo (($regtype['reg_mobile']) ? 'checked' : ''); ?> /> 手机注册 </label><br/>                  
             </td>
		</tr>
        <tr>
			<td width="120" align="right">单IP每日注册:</td>
			<td>
            	  <input name="reg_num" type="text" class="input-text" value="<?php echo $regtype['reg_num']; ?>" /> 个<br/>                              
             </td>
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