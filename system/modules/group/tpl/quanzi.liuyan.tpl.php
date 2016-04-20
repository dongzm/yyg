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
function hueifu(id){
	if(confirm("您确认要删除该条留言")){
		window.location.href="<?php echo WEB_PATH.'/'.ROUTE_M;?>/quanzi/del/quanzi_hueifu/"+id;
	}
}
</script>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mgr_table">
	<tr class="thead" align="center">
		<td width="5%" height="30">ID</td>
		<td width="10%">帖子名称</td>
		<td width="40%">回复内容</td>
		<td width="10%">会员</td>
		<td width="10%">管理</td>
	</tr>
	<?php foreach($hueifu AS $v) { ?>
	<tr align="center" class="mgr_tr">
		<td height="30"><?php echo $v['id'];?></td>
		<td><?php 
		foreach($tiezi AS $tz) {
			if($v['tzid']==$tz['id']){	
				echo $tz['title'];
			}
		}
		?></td>
		<td><?php echo $v['hueifu'];?></td>
		<td><?php echo $v['hueiyuan'];?></td>
		<td class="action">
			<span>[<a onclick="hueifu(<?php echo $v['id'];?>)" href="javascript:;">删除</a>]</span>
		</td>		
	</tr>
	<?php } ?> 
</table>

<?php if($total>$num) {?> 

<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>

<?php } ?> 	

</body>
</html> 
