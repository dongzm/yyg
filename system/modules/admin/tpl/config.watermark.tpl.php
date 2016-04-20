<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo G_PLUGIN_PATH; ?>/uploadify/api-uploadify.js" type="text/javascript"></script> 
<style>
td{height:40px;line-height:40px; padding-left:20px;}
.span_1{
	float:left;
	margin-left:0px;
	height:130px;
	line-height:130px;
}
ul{
}
li{
	border:1px solid #CCC;
	height:40px;
	padding:0px 10px;
	margin-left:-1px;
	margin-top:-1px;
	line-height:40px;
}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment(); ?>
</div>
<div class="bk10"></div>
<div class="table-list lr10 lr10">
<!--start-->
<form name="myform" action="" method="post">
  <table width="100%" cellspacing="0" >	
		<tr>
			<td width="120">开启水印:</td>
			<td>
            	<?php if($upload_set['watermark_off']): ?>
				<input type="radio" name="watermark_off" value="1" checked="checked" /><span> 启用</span>
				<input type="radio" name="watermark_off" value="0" /><span> 关闭</span>
                <?php else: ?>
                <input type="radio" name="watermark_off" value="1" /><span> 启用</span>
				<input type="radio" name="watermark_off" value="0" checked="checked" /><span> 关闭</span>
                <?php endif; ?>
			</td>
		</tr>	
        <tr>
			<td width="120">水印类型:</td>
			<td>
            	<?php if($upload_set['watermark_type'] == 'text'): ?>
				<input type="radio" name="watermark_type" onClick="show_div('text')" value="text" checked="checked" /><span> 文字水印</span>
				<input type="radio" name="watermark_type" onClick="show_div('image')" value="image" /><span> 图片水印</span>
                <?php else: ?>
                <input type="radio" name="watermark_type" onClick="show_div('text')"  value="text" /><span> 文字水印</span>
				<input type="radio" name="watermark_type" onClick="show_div('image')" value="image" checked="checked" /><span> 图片水印</span>
                <?php endif; ?>
			</td>
		</tr>
        <tr class="watermark_text">
			<td width="120">水印文字:</td>
			<td>
            <input type="text" name="text" value="<?php echo $upload_set['watermark_text']['text']; ?>"  class="input-text wid200"><br/>
            </td>
		</tr>
        <tr class="watermark_text">
			<td width="120">文字颜色:</td>
			<td>
            <input type="text" name="color" value="<?php echo $upload_set['watermark_text']['color']; ?>"  class="input-text">
            	<span> 填写如: #ff0000 的颜色值</span>
            </td>
		</tr>
        <tr class="watermark_text">
			<td width="120">文字字号:</td>
			<td>
            <input type="text" name="size" value="<?php echo $upload_set['watermark_text']['size']; ?>"  class="input-text"><br/>
            </td>
		</tr>
		<tr class="watermark_text">
			<td width="120">ttf字体:</td>
			<td>
            <input type="text" name="font" value="<?php echo $upload_set['watermark_text']['font']; ?>"  class="input-text wid300"><br/>
            </td>
		</tr>
        </div>
		<tr class="watermark_image">
			<td width="120">水印添加条件:</td>
			<td>
            <input type="text" name="width" value="<?php echo $upload_set['watermark_condition']['width']; ?>"  class="input-text">图片宽度 单位像素(px)<br/>
            <input type="text" name="height" value="<?php echo $upload_set['watermark_condition']['height']; ?>"  class="input-text">图片高度 单位像素(px)
            </td>
		</tr>	 
<tr class="watermark_image">
			<td width="120">水印图片:</td>
			<td>    
           	<input type="text" id="imagetext" value="<?php echo $upload_set['watermark_image']; ?>" name="image" class="input-text wid300">
			<input type="button" class="button"
             onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','缩略图上传','image','banner',1,500000,'imagetext')" 
             value="上传图片"/>		      
            </td>           
		</tr>	
		<tr class="watermark_image">
			<td width="120">水印透明度:</td>
			<td><input type="text" name="apache" value="<?php echo $upload_set['watermark_apache'];?>"  class="input-text"><span> 请设置为0-100之间的数字，0代表完全透明，100代表不透明</span></td>
		</tr>	
		<tr class="watermark_image">
			<td width="120">JPEG 水印质量:</td>
			<td><input type="text" name="good" value="<?php echo $upload_set['watermark_good'];?>"  class="input-text"><span> 水印质量请设置为0-100之间的数字,决定 jpg 格式图片的质量</span></td>
		</tr>		
		<tr class="watermark_image">
			
			<td width="120" height="120">水印位置:</td>
			
			<td>
			<div style="width:400px;height:124px; background:#fff">
			<div style="line-height:122px;float:left; 
            margin-left:10px; 
            height:120px; width:100px;">
				<input type="radio" id="sel_s" name="sel" value="s" >&nbsp;随机位置
			</div>
		
					<span class="span_1" >
						<ul style="list-style:nome;">
							<li><input type="radio" id="sel_lt" name="sel" value="lt" >&nbsp;顶部居左</li>
							<li><input type="radio" id="sel_lc" name="sel" value="lc" >&nbsp;中部居左</li>
							<li><input type="radio" id="sel_lb" name="sel" value="lb" >&nbsp;底部居左</li>
						</ul>	
					</span>	
					<span class="span_1">
						<ul style="list-style:nome;">
							<li><input type="radio" id="sel_t" name="sel" value="t" >&nbsp;顶部居中</li>
							<li><input type="radio" id="sel_c" name="sel" value="c" >&nbsp;中部居中</li>
							<li><input type="radio" id="sel_b" name="sel" value="b" >&nbsp;底部居中</li>
						</ul>	
					</span>	
					<span class="span_1">
						<ul style="list-style:nome;">
							<li><input type="radio" id="sel_rt" name="sel" value="rt" >&nbsp;顶部居右</li>
							<li><input type="radio" id="sel_rc" name="sel" value="rc" >&nbsp;中部居右</li>
							<li><input type="radio" id="sel_rb" name="sel" value="rb" >&nbsp;底部居右</li>
						</ul>	
					</span>	
					<div style="clear:both;"></div>
			</div>
			</td>
		</tr>
		<tr>
        	<td width="120"></td>
            <td>
            <input type="submit" class="button" name="dosubmit"  value=" 提交 " >
            </td>
		</tr>
</table>
</form>
<div clear="clear:both;"></div>
</div><!--table-list end-->
<script type="text/javascript">

function show_div(t){
	if(t=='text'){
		$(".watermark_text").show();
		$(".watermark_image").hide();
	}else{
		$(".watermark_text").hide();
		$(".watermark_image").show();
	}
}

$(function(){
	$("#sel_<?php echo $upload_set['watermark_position']; ?>").attr("checked","checked");  
		   
});
<?php if($upload_set['watermark_type'] == 'text'): ?>
	show_div('text');
<?php else: ?>
	show_div('image');
<?php endif; ?>
</script>
</body>
</html> 