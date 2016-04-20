<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
body{ background-color:#fff}
</style>
</head>
<body>
<script>
function vote(id){
	 
	if(confirm("确定删除该投票")){
		
		window.location.href="<?php echo G_MODULE_PATH;?>/vote_admin/del?id="+id;
	}
}
</script>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
 <table width="100%" cellspacing="0">
 	<thead>
	<tr align="center">
		<th width="5%" height="30">ID</th>
		<th width="30%">标题</th>
		<th width="10%">投票数</th>
		<th width="10%">开始时间</th>
		<th width="10%">结束时间</th>
		<th width="10%">发表时间</th>		  
		<th width="30%">管理操作</th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($vote as $v) { ?>
	<tr align="center" class="mgr_tr">
		<td ><?php echo $v['vote_id'];?></td>
		<td><?php echo $v['vote_title'];?></td>
		<td><?php echo _strcut($v['vote_number'],25);?></td>
		<td class="number"><?php echo date('Y-m-d',$v['vote_starttime']);?></td>
		<td><?php echo date('Y-m-d',$v['vote_endtime']);?></td>
		<td><?php echo date('Y-m-d',$v['vote_sendtime']);?></td>
		 
		 
		<td class="action">
		<span>[<a href="<?php echo G_MODULE_PATH;?>/vote_admin/vote_total/<?php echo $v['vote_id'];?>">统计</a>]</span>
		<span>[<a href="<?php echo G_MODULE_PATH;?>/vote_admin/vote_update/<?php echo $v['vote_id'];?>">修改</a>]</span>
		<span>[<a href="<?php echo G_MODULE_PATH;?>/vote_admin/del/<?php echo $v['vote_id'];?>">删除</a>]</span></td>		
	</tr>
	<?php } ?> 
    </tbody>
</table>


</div><!--table_list end-->

</body>
</html> 
