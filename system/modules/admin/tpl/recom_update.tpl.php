<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo G_PLUGIN_PATH; ?>/uploadify/api-uploadify.js" type="text/javascript"></script> 
<style>
table th{ border-bottom:1px solid #eee; font-size:12px; font-weight:100; text-align:right; width:200px;}
table td{ padding-left:10px;}
input.button{ display:inline-block}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<!--start-->
<form name="myform" action="" method="post" enctype="multipart/form-data">
  <table width="100%" cellspacing="0">
		<tr>
			<td width="120" align="right">推荐名称:</td>
			<td>
				<input type="text" name="title" value="<?php echo $recomone['title'];?>" class="input-text wid300" />
			</td>
		</tr>
		<tr>
			<td width="120" align="right">链接地址:</td>
			<td>
				<input type="text" name="link" value="<?php echo $recomone['link'];?>" class="input-text wid300"/>默认http://
			</td>
		</tr>
		   <tr>
        	<td width="120" align="right">图片:</td>
            <td>	
            <img height="50px" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $recomone['img']; ?>"/>
            <input type="text" name="image" id="imagetext" value="<?php echo $recomone['img'];?>" id="imagetext" class="input-text wid300">
			<input type="button" class="button"
             onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','缩略图上传','image','banner',1,500000,'imagetext')" 
             value="上传图片"/>
            </td>
        </tr>

		<tr>
        	<td width="120" align="right"></td>
            <td>		
            <input type="submit" class="button" name="submit" value="提交" >
            </td>
		</tr>
</table>
</form>
</div><!--table-list end-->

<script>
function upImage(){
	return document.getElementById('imgfield').click();
}
</script>
</body>
</html> 