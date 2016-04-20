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
.tiezi{ background-color:#f8f8f8; border:1px solid #eee; padding:10px;}
.tiezi h5{ line-height:30px; margin-right:20px;}
.tiezi .info span{ padding:0px 10px;}
.tiezi .content{ width:650px; background:#eee; padding:10px; }
.tiezi .ajax{ padding-top:10px;}

.this{ font-weight:bold; text-decoration:underline}

</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="header lr10">
	 <a style="color:#f60" <?php echo ($types=='tiezi')?'class="this"' :''; ?> href="<?php echo G_MODULE_PATH; ?>/quanzi/shenhe_list/tiezi">未审核的帖子</a>
	 <span class="span_fenge lr5">|</span>
	 <a style="color:#f60" <?php echo ($types=='huifu')?'class="this"' :''; ?> href="<?php echo G_MODULE_PATH; ?>/quanzi/shenhe_list/huifu">未审核的回复</a>
</div>

<?php 
	foreach($glist as $v){
?>
<div class="bk20"></div>
<div class="tiezi lr10">
	<div class="info"><h5><?php echo $v['title']; ?></h5>
    发布人:<span><a href="#"><?php echo get_user_name($v['hueiyuan']); ?></a></span>发布时间:<span><?php echo date("Y-m-d H:i:s",$v['time']); ?></span>
    </div>
    <div class="content">
    	<?php echo $v['neirong']; ?>
    </div>
    <div class="ajax">
    	<input type="submit" value=" 通过审核 "  onClick="shenheok(<?php echo $v['id']; ?>)" class="button">
        <input type="submit" value=" 删除 "  onClick="shenhedel(<?php echo $v['id']; ?>)" class="button">
    </div>
</div>
<?php }

	if(empty($glist)){
		echo "<h3 class=\"lr10\" style=\"color:#999;line-height:40px\">没有找到需要审核的数据!</h3>";
	}

 ?>

<div class="bk20"></div>
<div class="lr10">

</div>
<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>
<div style="width:100%;height:30px;background-color: #eef3f7;"></div>
<script>

	function shenheok(id){
		if(confirm("确定审核通过这帖子?")){
			window.location.href="<?php echo G_MODULE_PATH;?>/quanzi/shenhe/"+id;
		}
	}
	function shenhedel(id){
		if(confirm("确定删除帖子")){
			window.location.href="<?php echo G_MODULE_PATH;?>/quanzi/del/quanzi_tiezi/"+id;
		}		
	}
</script>
</body>
</html> 
