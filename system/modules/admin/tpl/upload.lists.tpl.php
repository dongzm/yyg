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
    <a href="<?php echo G_MODULE_PATH; ?>/upload/lists">根目录</a>
    <span class="span_fenge lr5">|</span>
    <a href="javascript:history.go(-1);">返回上一页</a>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
		<th width="100px" align="center">名称</th>
        <th width="100px" align="center">类型</th>
		</tr>
    </thead>
    <tbody>

	<?php foreach($arr as $v){?>
		<tr>
			<td align="center"><a href="<?php echo $v['url']; ?>"><?php echo $v['name']; ?></a></td>
			<td align="center">
				<?php echo $v['type']; ?>
			</td>                     	
		</tr>
	<?php }?>
  	</tbody>
</table>
</div><!--table-list end-->

<script>
</script>
</body>
</html> 