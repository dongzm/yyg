<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo G_ADMIN_STYLE; ?>/css/style.css" type="text/css">
<style>
body{ background-color:#fff}
</style>
</head>
<body>
<div class="mgr_header"> <span class="title">帖子留言管理</span><span class="reload"><a href="<?php echo WEB_PATH; ?>/admin/quanzi/insert">添加帖子留言</a></span> </div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mgr_table">
	<tr class="thead" align="center">
		<td width="5%" height="30">ID</td>
		<td width="10%">圈子名</td>
		<td width="20%">简介</td>
		<td width="20%">公告</td>
		<td width="5%">成员</td>
		<td width="10%">帖子数</td>
		<td width="10%">创建圈子权限</td>
		<td width="10%">管理员</td>
		<td width="10%">管理</td>
	</tr>
	<?php $ln=1;if(is_array($quanzi)) foreach($quanzi AS $v) { ?>
	<tr align="center" class="mgr_tr">
		<td height="30"><?php echo $v['id'];?></td>
		<td><?php echo $v['title'];?></td>
		<td><?php echo str_cut($v['jianjie'],25);?></td>
		<td class="number"><?php echo str_cut($v['gongao'],25);?></td>
		<td><?php echo $v['chengyuan'];?></td>
		<td><?php echo $v['tiezi'];?></td>
		<td><?php if($v['glfatie']='N'){
			echo "管理员";
		}else{
			echo "会员";
		}		
		?></td>
		<td><?php echo $v['guanli'];?></td>
		<td class="action"><span>[<a href="admin_save.php?id=1&action=check&checkadmin=true" title="点击进行审核与未审操作">已审</a>]</span><span>[<a href="admin_update.php?id=1">修改</a>]</span><span>[删除]</span></td>		
	</tr>
	<?php $ln++;}unset($ln); ?> 
</table>
<div class="page_area"><div class="page_info">共<span>1</span>页<span>1</span>条记录</div></div>
</body>
</html> 
