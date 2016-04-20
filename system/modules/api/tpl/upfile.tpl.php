<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
tbody tr{ line-height:30px; height:30px; clear:} 
</style>
</head>
<body>
<div class="header-title lr10">
	<b>在线升级</b> <span class="lr10"> <font color="red">升级前请做好数据备份,如果你自己修改了模板文件请手动下载补丁更新：
	地址 http://download.yungoucms.com/yungou/newpatch/utf8/
	</font> </span>
</div>
<div class="bk10"></div>
<div class="header-data lr10">
	系统版本: <?php echo $v_version; ?>
	<span class="lr10">&nbsp;</span>
	升级时间: <?php echo $v_time; ?>
	<span class="lr10">&nbsp;</span>
	<?php if($stauts == -1){?>获取升级列表失败<?php } ?>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
            <th width="100px" align="center">可升级文件</th>
			<th width="100px" align="center">升级说明</th>
			<th width="100px" align="center">编码方式</th>
            <th width="100px" align="center">状态</th>
		</tr>
    </thead>
    <tbody>
		<?php if($pathlist){foreach ($pathlist as $v): ?>
		<tr>
            <td width="100px" align="center"><?php echo $v; ?></td>
			<td width="100px" align="center"><a href="http://download.yungoucms.com/yungou/newpatch/utf8/<?php echo $v; ?>.txt" target="_blank">查看说明</></td>
			<td align="center"><?php echo G_CHARSET; ?></td>
            <td align="center"><font color="#0c0">可升级</font></td>
		</tr>
		<?php endforeach; }?>
  	</tbody>
</table>
<div class="btn_paixu">
	<form action="" method="post">
	<?php if($pathlist): ?>
	<input type="submit" class="button" name="submit" value=" 开始升级 " />
	<?php endif; ?>
</div>
</div><!--table-list end-->
<script>
</script>
</body>
</html> 