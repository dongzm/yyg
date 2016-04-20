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
		<th width="80px">ID</th>
		<th width="10%" align="center">QQ群号</th>
		<th width="15%" align="center">QQ群名称</th>
        <th width="5%" align="center">类型</th>
        <th width="5%" align="center">群状态</th>
        <th width="15%" align="center">加群代码</th>
		<th width="" align="center">所属地址</th>
		<th width="10%" align="center">操作</th>
		</tr>
    </thead>
    <tbody>
		<?php foreach($lists as $v){ ?>
		<tr>
		    <td align="center"><?php echo $v['id']; ?></td>
			<td align="center"><?php echo $v['qq']; ?></td>
			
			<td align="center"><?php echo $v['name']; ?></td>
			<td align="center"><?php echo $v['type']; ?></td>
			<td align="center"><?php if($v['full']=='已满')echo '<font color="red">'.$v['full'].'</font>';else echo '<font color="#2A8BBB">'.$v['full'].'</font>'; ?></td>
			<td align="left"><?php echo wordwrap($v['qqurl'],38,"<br />\n",TRUE); ?></td>
			<td align="center"><?php echo $v['address']; ?></td>           
			<td align="center">
				<a  href="<?php echo G_ADMIN_PATH; ?>/qq_admin/update/<?php echo $v['id'];?>">修改</a>
			 	<a  href="<?php echo G_ADMIN_PATH; ?>/qq_admin/delete/<?php echo $v['id'];?>">删除</a> 
			</td>	
		</tr>
		<?php } ?>
  	</tbody>
</table>
	<div class="btn_paixu"></div>
</div><!--table-list end-->

<script>
</script>
</body>
</html> 