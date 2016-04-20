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
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
		<th width="80px">id</th>
		<th width="100px" align="center">链接名称</th>
		<th width="100px" align="center">链接类型</th>
		<th width="" align="center">链接图片</th>
		<th width="" align="center">链接文字</th>
		<th width="30%" align="center">操作</th>
		</tr>
    </thead>
    <tbody>
		<?php foreach($linkres as $v){ ?>
		<tr>
			<td align="center"><?php echo $v['id']; ?></td>
			<td align="center"><?php echo $v['name'];?></td>
			<td align="center"><?php echo ($v['type']==1) ? "文字" : "<font color='red'>图片</font>";?></td>
			<td align="center"><?php echo _strcut($v['logo'],30);?></td>
			<td align="center"><?php echo $v['url'];?></td>
			<td align="center">
				<a href="<?php echo G_ADMIN_PATH; ?>/link/modifiylink/<?php echo $v['id'];?>">修改</a>
                <span class='span_fenge lr5'>|</span>
				<a href="<?php echo G_ADMIN_PATH; ?>/link/dellink/<?php echo $v['id'];?>" onClick="return confirm('是否真的删除！');">删除</a>
			</td>	
		</tr>
		<?php } ?>
  	</tbody>
</table>
</div><!--table-list end-->

<script>
</script>
</body>
</html> 