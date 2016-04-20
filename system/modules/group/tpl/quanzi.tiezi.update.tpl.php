<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<style>
body{ background-color:#fff}
.textarea{width:400px;height:100px;}
</style>
</head>
<body>
<script language="JavaScript">
$(function(){
	$("form").submit(function(){
		var title=$("#title").val();
		var img=$("#img").val();
		if(title.length<1){
			alert("圈子名不能为空");
			return false;
		}
		return true;
	});
})
</script>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<form action="" method="post" id="myform">
<table width="100%" >
    <tr>
    	<td width="100">标题：</td> 
   		<td><input type="text" name="title" style="width:300px;" class="input-text" id="title" value="<?php echo $tiezi['title']; ?>"></input></td>
    </tr>	
    <tr>
    	<td>内容：</td>
    	<td><textarea  name="neirong" class="textarea"><?php echo $tiezi['neirong']; ?></textarea></td>
	</tr>
	<tr>
    	<td>置顶：</td>
		<?php if($tiezi['zhiding']=='Y'){ ?>
    	<td>
		<input type="radio" name="zhiding" checked="checked" class="input-text" value="Y">是
		<input type="radio" name="zhiding" class="input-text" value="N">否
		(帖子是否置顶)</td>
		<?php }else{ ?>
		<td>
		<input type="radio" name="zhiding" class="input-text" value="Y">是
		<input type="radio" name="zhiding" checked="checked" class="input-text" value="N">否
		(帖子是否置顶)</td>
		<?php } ?>
	</tr>
</table>
   	<div class="bk15"></div>
	<input class="button" type="submit" name="submit" value="提交" />
</form>
</div>
</body>
</html> 
