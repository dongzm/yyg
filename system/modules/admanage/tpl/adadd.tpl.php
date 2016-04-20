<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css"> 
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
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
<table width="100%" class="lr10">
  	 <tr>
			<td width="120" align="right">广告名称：</td>
			<td><input type="text" name="title" class="input-text"></td>
	</tr>
		<tr>
			<td width="120" align="right">广告类型：</td>
			<td>
				<select name="type" class="selecttype">
					<option value="text">文字</option>
					<option value="img">图片</option>
					<option value="code">代码</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="120" align="right">广告位置：</td>
			<td>
				<select name="adarea">
				<?php foreach($arr as $v){ ?>
					<option value="<?php echo $v['id']; ?>"><?php echo _strcut($v['title'],30); ?></option>
				<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="120" align="right">开始日期：</td>
			<td><input name="addtime" type="text" id="posttime" class="input-text posttime"  readonly="readonly" />
				<script type="text/javascript">
				date = new Date();
				Calendar.setup({
					inputField     :    "posttime",
					ifFormat       :    "%Y-%m-%d",
					showsTime      :    true,
					timeFormat     :    "24"
				});
				</script>
             </td>    
		</tr>
		<tr>
			<td width="120" align="right">结束日期：</td>
			<td><input name="endtime" type="text" id="posttimeend" class="input-text posttime"  readonly="readonly" />
				<script type="text/javascript">
				date = new Date();
				Calendar.setup({
					inputField     :    "posttimeend",
					ifFormat       :    "%Y-%m-%d",
					showsTime      :    true,
					timeFormat     :    "24"
				});
				</script>
             </td> 
		</tr>
        <tr class="adtext">
        	<td width="120" align="right">广告位描述:</td>
            <td>
           	<textarea name="text" style="width:400px;height:100px;"></textarea>
            </td>
        </tr>
		<tr class="adimg" style="display:none">                
        <td align="right">广告位图片：</td>
        <td>
           	<input type="text" name="adphoto" id="imagetext" class="input-text wid300">
			<input type="button" class="button"
             onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','缩略图上传','image','admanage',1,500000,'imagetext')" 
             value="上传图片"/>
			
        </td>
        </tr>
		<tr class="adcode" style="display:none">
        	<td width="120" align="right">广告位代码:</td>
            <td>
           	<textarea name="code" style="width:400px;height:100px;"></textarea>
            </td>
        </tr>
		<tr>
			<td width="120" align="right">是否开启：</td>
			<td>
				<input type="radio" name="checked" checked class="input-text" value="1">开启
				<input type="radio" name="checked" class="input-text" value="0">关闭
			</td>
		</tr>
		<tr>
        	<td width="120" align="right"></td>
            <td><input type="submit" class="button" name="submit"  value=" 提交 " ></td>
		</tr>
</table>
</form>
</div><!--table-list end-->
<script type="text/javascript">
	$(document).ready(function(){
	  $(".selecttype").change(function(){
		var values=this.value;
		if(values=="text"){
			$(".adtext").show();
			$(".adimg").hide();
			$(".adcode").hide();
		}else if(values=="img"){
			$(".adtext").hide();
			$(".adimg").show();
			$(".adcode").hide();
		}else if(values=="code"){
			$(".adtext").hide();
			$(".adimg").hide();
			$(".adcode").show();
		}
	  });
	});
</script>
<script>
function upImage(){
return document.getElementById('imgfield').click();
}
</script>
</body>
</html> 