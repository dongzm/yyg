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
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
<form name="myform" action="" method="post">
  <table width="100%" cellspacing="0">	
		<tr>
			<td width="220" align="right">网站字符集：</td>
			<td><input type="text" name="charset" value="<?php echo $web['charset']; ?>"  class="input-text"></td>
		</tr>
		<tr>
			<td width="220" align="right">网站时区：</td>
			<td><input type="text" name="timezone" value="<?php echo $web['timezone']; ?>" class="input-text">
			<span>上海时间: Asia/Shanghai  重庆时间: Asia/Chongqing</span>
			</td>
		</tr>		
		<tr>
			<td width="220" align="right">开奖动画分钟数:</td>
			<td><input type="text" name="goods_end_time" value="<?php echo $web['goods_end_time']; ?>"  class="input-text">
			<span>单位(秒),不低于30秒，不大于300秒</span>
			</td>
		</tr>
		<tr>
			<td width="220" align="right">保存错误日志：</td>
			<td>
				<?php if($web['error']){ ?>
				<input type="radio" name="error" value="1" checked="checked" />是
				<input type="radio" name="error" value="0" />否
				<?php }else{ ?>
				<input type="radio" name="error" value="1"/>是
				<input type="radio" name="error" value="0" checked="checked" />否
				<?php } ?>
				<span class="lr10">错误信息输出到页面还是保存到日志</span>
			</td>
		</tr>		<tr>
			<td width="220" align="right">Gzip压缩：</td>
			<td>
				<?php if($web['gzip']){ ?>
				<input type="radio" name="gzip" value="1" checked="checked" />是
				<input type="radio" name="gzip" value="0" />否
				<?php }else{ ?>
				<input type="radio" name="gzip" value="1"/>是
				<input type="radio" name="gzip" value="0" checked="checked" />否
				<?php } ?>
				<span class="lr10">请先确定服务器是否支持gzip，在开启</span>
			</td>
		</tr>				
		<tr>
			<td width="220" align="right">隐藏index.php：</td>
			<td><input type="text" name="index_name" value="<?php echo $web['index_name']; ?>"  class="input-text">
				<span>如果写了伪静态请<font color="red">留空</font>，支持pathinfo模式填写:<font color="red">index.php</font> 不支持填写: <font color="red">?</font></span>
			</td>
		</tr>
		<tr>
			<td width="220" align="right">客服QQ：</td>
			<td><input type="text" name="qq" value="<?php echo $web['qq']; ?>"  class="input-text"></td>
		</tr>	
		<tr>
			<td width="220" align="right">QQ群：</td>
			<td><textarea name="qq_qun" class="wid300" style="height:80px"><?php echo $web['qq_qun']; ?></textarea>
			多个QQ群请用 | 号分割开</td>
		</tr>
		<tr>
			<td width="220" align="right">联系电话:</td>
			<td><input type="text" name="cell" value="<?php echo $web['cell']; ?>"  class="input-text"></td>
		</tr>			
		<tr>
			<td width="220" align="right">url分隔符号：</td>
			<td><input type="text" name="expstr" value="<?php echo $web['expstr']; ?>" class="input-text"></td>
		</tr>		<tr>
			<td width="220" align="right">后台管理文件夹：</td>
			<td><input type="text" name="admindir" value="<?php echo $web['admindir']; ?>"  class="input-text"></td>
		</tr>
		<tr>
			<td width="220" align="right">网站是否开启：</td>
			<td>
				<input type="radio" name="web_off" value="1" checked="checked" />是
				<input type="radio" name="web_off" value="0" />否
			</td>
		</tr>	
		<tr>
			<td width="220" align="right">关闭原因：</td>
			<td><textarea name="web_off_text" class="wid300" style="height:80px"><?php echo $web['web_off_text']; ?></textarea></td>
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