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
<div class="header-title lr10">
	<b>支付方式</b>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
<form name="myform" action="" method="post">
  <table width="100%" cellspacing="0">
		<tr>
			<td width="220" align="right">支付名称：</td>
			<td><input type="text" name="pay_name" value="<?php echo $pay['pay_name']; ?>" class="input-text">
			</td>
		</tr>
		<tr>
			<td width="220" align="right">支付方式：</td>
			<?php if($pay['pay_class'] == 'tenpay' || $pay['pay_class'] == 'wapalipay'){ ?>
			<td>
			<input type="radio" name="pay_type" value="1" checked="checked" />及时到帐
			</td>
			<?php } ?>
			<?php if($pay['pay_class'] == 'alipay'){ ?>
			<td>
				<?php if($pay['pay_type']==1): ?>
				<input type="radio" name="pay_type" value="1" checked="checked" />及时到帐
				<input type="radio" name="pay_type" value="2" />担保交易
				<input type="radio" name="pay_type" value="3" />双接口
				<?php elseif($pay['pay_type']==2): ?>
				<input type="radio" name="pay_type" value="1" />及时到帐
				<input type="radio" name="pay_type" value="2" checked="checked" />担保交易
				<input type="radio" name="pay_type" value="3" />双接口
				<?php elseif($pay['pay_type']==3): ?>
				<input type="radio" name="pay_type" value="1" />及时到帐
				<input type="radio" name="pay_type" value="2" />担保交易
				<input type="radio" name="pay_type" value="3" checked="checked" />双接口
				<?php endif; ?>
			</td>
			<?php } ?>

			<?php if($pay['pay_class'] == 'yeepay'){ ?>
			<td>
			<input type="radio" name="pay_type" value="1" checked="checked" />及时到账
			</td>
			<?php } ?>

			<?php if($pay['pay_class'] == 'ecpss'){ ?>
			<td>
			<input type="radio" name="pay_type" value="1" checked="checked" />及时到账
			</td>
			<?php } ?>

		</tr>
		<tr>
			<td width="220" height="80" align="right">图片：</td>
			<td>
			<img height='40xp' src = "<?php echo G_UPLOAD_PATH.'/'.$pay['pay_thumb']; ?>">
			<span class="lr5"></span>
           	<input type="text" id="imagetext" name="pay_thumb" value="<?php echo $pay['pay_thumb']; ?>" class="input-text wid300">
			<input type="button" class="button"
             onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','缩略图上传','image','photo',1,500000,'imagetext')"
             value="上传图片"/>
			</td>
		</tr>

		<tr>
			<td width="220" align="right">简介：</td>
			<td>
				<textarea name="pay_des" style="width:400px;height:100px;"><?php echo $pay['pay_des']; ?></textarea>
			</td>
		</tr>
		<tr>
			<td width="220" align="right">是否开启：</td>
			<td>
			<?php if($pay['pay_start']==1): ?>
			<input type="radio" name="pay_start" value="1" checked="checked" />开启
			<input type="radio" name="pay_start" value="0"/>关闭
			<?php else: ?>
			<input type="radio" name="pay_start" value="1" />开启
			<input type="radio" name="pay_start" value="0" checked="checked" />关闭
			<?php endif; ?>
			</td>
		</tr>
		<?php foreach($pay['pay_key'] as $key=>$val): ?>
		<tr>
			<td width="220" align="right" style="padding-right:5px;"><?php echo $val['name']; ?></td>
			<td><input class="input-text wid300" value="<?php echo $val['val']; ?>" name="pay_key[<?php echo $key; ?>]" /></td>
		</tr>
		<?php endforeach; ?>
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
