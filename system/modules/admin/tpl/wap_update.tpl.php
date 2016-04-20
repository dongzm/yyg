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
.bg{background:#fff url(<?php echo G_GLOBAL_STYLE; ?>/global/image/ruler.gif) repeat-x scroll 0 9px }
.color_window_td a{ float:left; margin:0px 10px;}
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
			<td width="120" align="right">幻灯名称:</td>
			<td>
				<input type="text" name="title" value="<?php echo $wapone['title'];?>" class="input-text wid300" />
			</td>
		</tr>
		<tr>
			<td width="120" align="right">幻灯链接:</td>
			<td>
				<input type="text" name="link" value="<?php echo $wapone['link'];?>" class="input-text wid300"/>
				 地址前,系统会默认添加 <?php echo WEB_PATH; ?>/   
			</td>
		</tr>
		<tr>
			<td align="right" width="120">背景颜色：</td>
			<td><input  type="text" id="title_style_color" name="title2" value="<?php echo $wapone['color']?>" onKeyUp="return gbcount(this,100,'texttitle2');"  class="input-text wid300">
            <script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/colorpicker.js"></script>
            <img src="<?php echo G_GLOBAL_STYLE; ?>/global/image/colour.png" width="15" height="16" onClick="colorpicker('title_colorpanel','set_title_color');" style="cursor:hand"/>
             <img src="<?php echo G_GLOBAL_STYLE; ?>/global/image/bold.png" onClick="set_title_bold();" style="cursor:hand"/>
            <span class="lr10">还能输入<b id="texttitle2">100</b>个字符</span>
            </td>
		</tr>
		   <tr>
        	<td width="120" align="right">图asdff片:</td>
            <td>	
            <img height="50px" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $wapone['img']; ?>"/>
            <input type="text" name="image" id="imagetext" value="<?php echo $wapone['img'];?>" id="imagetext" class="input-text wid300">
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
<span id="title_colorpanel" style="position:absolute; left:568px; top:155px" class="colorpanel"></span>
<script>
function upImage(){
	return document.getElementById('imgfield').click();
}
</script>
<script type="text/javascript">
function set_title_color(color) {
	$('#title2').css('color',color);
	$('#title_style_color').val(color);
}
function set_title_bold(){
	if($('#title_style_bold').val()=='bold'){
		$('#title_style_bold').val('');	
		$('#title2').css('font-weight','');
	}else{
		$('#title2').css('font-weight','bold');
		$('#title_style_bold').val('bold');
	}
}

//API JS
//window.parent.api_off_on_open('open');
</script>
</body>
</html> 