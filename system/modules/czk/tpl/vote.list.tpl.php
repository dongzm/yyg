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
	 
	if(confirm("确定删除该吗")){
		
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
		<th width="10%">充值卡号码</th>
		<th width="10%">充值卡密码</th>
		<th width="10%">冲值卡面值</th>
		<th width="10%">冲值卡类型</th>
		<th width="10%">使用状态</th>
		<th width="10%">操作</th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($vote as $v) { ?>
	<tr align="center" class="mgr_tr">
		<td ><?php echo $v['id'];?></td>
		<td ><?php echo $v['czknum'];?></td>
		<td ><?php echo $v['password'];?></td>
		<td ><?php echo $v['mianzhi'];?></td>
		<td ><?php if($v['type']==1){echo '一次性';}elseif($v['type']==2){echo '体验';}?></td>
                <td ><?php if($v['status']==1){echo '未使用';}else{echo '已使用';};?></td>
		 
		 
		<td class="action">
		<!--<span>[<a href="<?php echo G_MODULE_PATH;?>/vote_admin/vote_total/<?php echo $v['vote_id'];?>">统计</a>]</span>
		<span>[<a href="<?php echo G_MODULE_PATH;?>/vote_admin/vote_update/<?php echo $v['vote_id'];?>">修改</a>]</span>-->
		<span>[<a href="<?php echo G_MODULE_PATH;?>/vote_admin/del/id/<?php echo $v['id'];?>">删除</a>]</span></td>
	</tr>
	<?php } ?> 
    </tbody>
</table>


</div><!--table_list end-->

</body>
</html> 
