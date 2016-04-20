<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo G_PLUGIN_PATH; ?>/uploadify/api-uploadify.js" type="text/javascript"></script> 
<style>
body{ background-color:#fff}
.textarea{width:400px;height:100px;}
input.button{ display:inline-block}
</style>
</head>
<body>
<script language="JavaScript">
function upImage(){
	return document.getElementById('imgfield').click();
}
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
<form action="" method="post" enctype="multipart/form-data" id="myform">
<table width="100%" >
    <tr>
    	<td width="120" align="right">圈子名：</td> 
   		<td><input type="text" name="title"  class="input-text" id="title"></input></td>
    </tr>
    <tr>
    	<td width="120" align="right">圈子管理员：</td>
    	<td>
			<input type="text" name="guanli" value="" class="input-text">(请填写邮箱/手机)
		</td>
    </tr>
	<tr>
    	<td width="120" align="right">申请加入圈子：</td>
    	<td>
		<input type="radio" name="jiaru" checked="checked" class="input-text" value="Y">是
		<input type="radio" name="jiaru" class="input-text" value="N">否
		<span style=" padding-left:30px">普通会员是否可以加入圈子</span></td>
	</tr>
	<tr>
    	<td width="120" align="right">发帖权限：</td>
    	<td>
		<input type="radio" name="glfatie" class="input-text" checked="checked" value="Y">是
		<input type="radio" name="glfatie" class="input-text" value="N">否
		<span style=" padding-left:30px">普通会员是否可以发帖</span></td>
	</tr>
	<tr>
    	<td width="120" align="right">帖子是否可回复：</td>
    	<td>
		<input type="radio" name="huifu" class="input-text" checked="checked" value="Y">是
		<input type="radio" name="huifu" class="input-text" value="N">否
		<span style=" padding-left:30px">圈子里面的帖子是否可回复</span></td>
	</tr>
	<tr>
    	<td width="120" align="right">帖子回复审核：</td>
    	<td>
		<input type="radio" name="shenhe" class="input-text" value="Y">是
		<input type="radio" name="shenhe" class="input-text" checked="checked" value="N">否
		<span style=" padding-left:30px">帖子和回复是否需要审核才能显示</span></td>
	</tr>
	
    <tr>
    	<td width="120" align="right">圈子头像：</td>
    	<td>
           	<input type="text" id="imagetext" name="img" value="" class="input-text wid300">
			<input type="button" class="button"
             onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','圈子头像','image','quanzi',1,500000,'imagetext')" 
             value="上传图片"/>			
        </td>
    </tr>
    <tr>
    	<td width="120" align="right">圈子介绍：</td>
    	<td><textarea  name="jianjie" class="textarea">暂无介绍</textarea></td>
	</tr>
	<tr>
    	<td width="120" align="right">圈子公告：</td>
    	<td><textarea  name="gongao" class="textarea">暂无公告</textarea></td>
	</tr>
</table>
   	<div class="bk15"></div>
	<input class="button" type="submit" name="submit" value="提交" />
</form>
</div>
</body>
</html> 
