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
tr{height:30px;line-height:30px;}
</style>
</head>
<body>
<div class="header-title lr10">
	<b>前台支付银行选择</b>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<form action="#" method="post">
<table width="100%" cellspacing="0">
<tr>
	<td>
    	<input type="radio" name="bank_type" value="tenpay" <?php if($bank['value'] == 'tenpay') echo 'checked';?>> 财付通
		<?php
			if(file_exists(G_SYSTEM.'modules/'.ROUTE_M.'/lib/yeepay.class.php')){
		?>	
        <span class="lr10"> | </span>
        <input type="radio" name="bank_type" value="yeepay" <?php if($bank['value'] == 'yeepay') echo 'checked';?>> 易宝支付
		<?php } ?>
    </td>
</tr>
<tr><td> <input type="submit" value=" 提交 " class="button" name="dosubmit"></td></tr>
</table>
</form>
</div><!--table-list end-->

<script>
	
</script>
</body>
</html> 