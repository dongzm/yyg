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
            <th width="100px" align="center">推荐位ID</th>
            <th width="100px" align="center">推荐位名</th>   
            <th width="100px" align="center">显示条数</th>
            <th width="100px" align="center">当前条数/最大条数</th>
            <th width="100px" align="center">推荐位模型</th>
            <th width="100px" align="center">添加时间</th>
            <th width="100px" align="center">管理</th>
		</tr>
    </thead>
    <tbody>
    	<?php foreach($positions as $pos): ?>
		<tr>
			<td align="center"><?php echo $pos['pos_id']; ?></td>	
			<td align="center"><?php echo $pos['pos_name']; ?></td>	    
			<td align="center"><?php echo $pos['pos_num']; ?></td>	
			<td align="center"><?php echo $pos['pos_this_num'].'/'.$pos['pos_maxnum']; ?></td>	
			<td align="center"><?php echo $models[$pos['pos_model']]['name']; ?></td>
			<td align="center"><?php echo date('Y-m-d H:i:s',$pos['pos_time']); ?></td>
			<td align="center">
            <a href="<?php echo G_MODULE_PATH.'/position/get/'.$pos['pos_id']; ?>">[查看]</a>&nbsp;
            <a href="<?php echo G_MODULE_PATH.'/position/edit/'.$pos['pos_id']; ?>">[修改]</a>&nbsp;
            <a href="<?php echo G_MODULE_PATH.'/position/del/'.$pos['pos_id']; ?>">[删除]</a>
            </td>
		</tr>
        <?php endforeach; ?>
  	</tbody>
</table>
<div class="btn_paixu"></div>
</div><!--table-list end-->
<script>
</script>
</body>
</html> 