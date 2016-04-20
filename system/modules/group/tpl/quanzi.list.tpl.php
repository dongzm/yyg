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
function quanzi(id){
	if(confirm("确定删除该圈子并删除圈子下的帖子")){
		window.location.href="<?php echo G_MODULE_PATH;?>/quanzi/del/quanzi/"+id;
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
		<th>ID</th>
		<th>圈子名</th>
		<th>管理员</th>
		<th>简介</th>
		<th>公告</th>
		<th>成员</th>
		<th>帖子数</th>
        <th>可加入</th>
		<th>可发帖</th>
        <th>可回复</th>
		<th>管理</th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($quanzi as $v) { ?>
	<tr align="center" class="mgr_tr">
		<td height="30"><?php echo $v['id'];?></td>
		<td><?php echo $v['title'];?></td>
		<td><?php echo get_user_name($v['guanli']);?></td>
		<td><?php echo _strcut($v['jianjie'],25);?></td>
		<td class="number"><?php echo _strcut($v['gongao'],25);?></td>
		<td><?php echo $v['chengyuan'];?></td>
		<td><?php echo $v['tiezi'];?></td>
        <td><?php echo $v['jiaru']=='Y'?'会员可加入':'会员不可加入';?></td>
		<td><?php echo $v['glfatie']=='Y'?'会员可发帖':'会员不可发帖';?></td>
        <td><?php echo $v['huifu']=='Y'?'帖子可回复':'帖子不可回复';?></td>
		<td>        
        <span>[<a href="<?php echo G_MODULE_PATH;?>/quanzi/tiezi/<?php echo $v['id'];?>">查看帖子</a>]</span>
		<span>[<a href="<?php echo G_MODULE_PATH;?>/quanzi/quanzi_update/<?php echo $v['id'];?>">修改</a>]</span>
		<span>[<a onClick="quanzi(<?php echo $v['id'];?>)" href="javascript:;">删除</a>]</span>
		</td>	
	</tr>
	<?php } ?> 
    </tbody>
</table>
<div style="width:100%;height:30px;background-color: #eef3f7;"></div>

</div><!--table_list end-->

</body>
</html> 
