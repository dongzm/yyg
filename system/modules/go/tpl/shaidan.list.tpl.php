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
function shaidan(id){
	if(confirm("确定删除该晒单")){
		window.location.href="<?php echo G_MODULE_PATH;?>/shaidan_admin/sd_del/"+id;
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
		<th width="15%">晒单标题</th>
		<th width="10%">缩略图</th>
		<th width="40%">晒单内容</th>
		<th width="10%">羡慕嫉妒恨</th>
		<th width="10%">评论</th>
		<th width="10%">管理</th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($shaidan as $v) { ?>
	<tr align="center" class="mgr_tr">
		<td height="30"><?php echo $v['sd_id'];?></td>
		<td><?php echo _strcut($v['sd_title'],30);?></td>
		<td><img height="30" src="<?php echo G_UPLOAD_PATH.'/'.$v['sd_thumbs'];?>"></td>
		<td><?php echo _strcut($v['sd_content'],50);?></td>
		<td><?php echo $v['sd_zhan'];?></td>
		<td><?php echo $v['sd_ping'];?></td>
		<td class="action"><span>[<a onClick="shaidan(<?php echo $v['sd_id'];?>)" href="javascript:;">删除</a>]</span></td>		
	</tr>
	<?php } ?> 
    </tbody>
</table>
<?php if($total>$num) {?> 

<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>

<?php } ?> 	

</div><!--table_list end-->

</body>
</html> 
