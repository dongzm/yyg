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
  	<tr  style="background:#f8f8f8">
		<td width="100"  align="right">中奖通知设置：　　</td>
		<td>
			<input type="radio" name="s_type" value="0" <?php echo ($type==0 ? 'checked' : ''); ?> /> <font color="#f00">中奖不通知</font> <br/>
			<input type="radio" name="s_type" value="1" <?php echo ($type==1 ? 'checked' : ''); ?> /> <font color="#f60">只发邮件通知</font> <br/>
			<input type="radio" name="s_type" value="2" <?php echo ($type==2 ? 'checked' : ''); ?> /> <font color="#0c0">只发短信通知</font> <br/>
			<input type="radio" name="s_type" value="3" <?php echo ($type==3 ? 'checked' : ''); ?> /> <font color="#09c">短信和邮件通知</font> <br/>
		</td>
	</tr>
 	
    <tr  style="background:#eee">
        	<td width="100" align="right"></td>
            <td><input type="submit" class="button" name="dosubmit"  value=" 提交 " ></td>
   </tr>
</table>
</form>

</div><!--table-list end-->

<script>
	
</script>
</body>
</html> 