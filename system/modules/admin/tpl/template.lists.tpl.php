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
	<b>模板管理</b> 
    <span style="color:#f60; padding-left:30px;">谨防模板被盗,建议修改html目录地址</span>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
		<th width="100px" align="center">模板名称</th>
        <th width="100px" align="center">模板目录</th>
        <th width="100px" align="center">html目录</th>
        <th width="100px" align="center">模板作者</th>
        <th width="100px" align="center">状态</th>
        <th width="100px" align="center">操作</th>
		</tr>
    </thead>
    <tbody>
	
	<?php 
		//templates
		foreach($templates as $temp){
	?>
		<tr>
			<td width="100px" align="center"><?php echo $temp['name']; ?></td>
        	<td width="100px" align="center"><?php echo $temp['dir']; ?></td>
       		<td width="100px" align="center"><?php echo $temp['html']; ?></td>
       		<td width="100px" align="center"><?php echo $temp['author']; ?></td>       
            <td width="100px" align="center">
            <?php 
				if($temp['dir']==$thistemp){echo "<font color=\"#0c0\">已启用</font>";}
				else{
			?>
            <a style="color:#F60" href="<?php echo G_MODULE_PATH; ?>/template/off/<?php echo $temp['dir']; ?>">
			<?php echo ($temp['html'] == '未填写') ? "未添加" : "启用"; ?>
			</a>		
            <?php } ?>
            </td>   
              <td width="100px" align="center">
				 [<a  href="<?php echo G_MODULE_PATH; ?>/template/edit/<?php echo $temp['dir']; ?>"><?php echo ($temp['html'] == '未填写') ? "添加" : "修改"; ?></a>]
				 [<a  href="<?php echo G_MODULE_PATH; ?>/template/see/<?php echo $temp['dir']."/".$temp['html']; ?>">查看模板</a>]
            </td>             	
		</tr>
	<?php 
		}
	?>
  	</tbody>
</table>
</div><!--table-list end-->

<script>
</script>
</body>
</html> 