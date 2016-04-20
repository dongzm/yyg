<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
</head>
<body>
<div class="header-title lr10">
	<b>内容模型管理</b>
</div>

<div class="bk10"></div>

<div class="table-list lr10">
<form name="myform" action="" method="post">
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
		<th width="10%">序号</th>
		<th width="15%" align="left">模型名</th>
		<th width="10%" align="left">数据表</th>
		</tr>
    </thead>
  	<tbody>
    	<?php foreach($models as $model){ ?>
        <tr>
        <td width="10%" align="center"><?php echo $model['modelid']; ?></td>
        <td width="15%"><?php echo $model['name']; ?></td>
        <td width="10%"><?php echo $model['table']; ?></td>
        </tr>
        <?php } ?>
	</tbody>
</table>
</form>
</div><!--table-list end-->

<script>
	
</script>
</body>
</html> 