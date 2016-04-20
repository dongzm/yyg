<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
tbody tr{ line-height:30px; height:30px;} 
</style>
</head>
<body>
<div class="header-title lr10">
	<b>支付方式</b> 
	<span class="lr10"> | </span> 
	<a href="<?php echo WEB_PATH; ?>/pay/pay/pay_bank" style="color:#ff0000; font-weight:bold"> 支付银行选择 </a> 
	<span class="lr10"> | </span>
	<!--<a href="<?php echo WEB_PATH; ?>/pay/pay/pay_install" style="color:#0c0; font-weight:bold"> 安装新的支付方式 </a> -->
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
            <th width="100px" align="center">支付名称</th>
            <th width="100px" align="center">图片</th>
			<th width="100px" align="center">是否启用</th>
            <th width="100px" align="center">支付方式</th>
            <th width="100px" align="center">管理</th>
		</tr>
    </thead>
    <tbody>
		<?php foreach($paylist as $pay): ?>
		<tr>
			<td align="center"><?php echo $pay['pay_name']; ?></td>	
			<td align="center"><img height="40px" width="80px" src="<?php echo G_UPLOAD_PATH.'/'.$pay['pay_thumb']; ?>"/></td>
			<td align="center">
				<?php if($pay['pay_start'] == 1){ ?>
				<font color='#0c0'>启用</font>
				<?php }else{ ?>
				<font color='#ff0000'>关闭</font>
				<?php } ?>
			</td>	
			<td align="center">
				<?php if($pay['pay_type'] == 1){ ?>
				及时到账
				<?php }elseif($pay['pay_type'] == 2){ ?>
				担保交易
				<?php }elseif($pay['pay_type'] == 3){ ?>
				双接口
				<?php } ?>			
			</td>	
			<td align="center"><a href="<?php echo G_MODULE_PATH; ?>/pay/pay_set/<?php echo $pay['pay_id']; ?>">设置</a></td>
		</tr>
		<?php endforeach; ?>
  	</tbody>
</table>
</div><!--table-list end-->

<script>

</script>
</body>
</html> 