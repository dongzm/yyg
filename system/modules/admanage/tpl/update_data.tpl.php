<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css"> 
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
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
			<td><input type="text" name="title" class="input-text" value="<?php echo $adlist[0]['title'] ;?>"></td>
	</tr>
		<tr>
			<td width="120" align="right">广告类型：</td>
			<td>
				<select name="type" class="selecttype">
					<option <?php echo $adlist[0]['type']=="text"?'selected="selected"':'';?> value="text">文字</option>
					<option <?php echo $adlist[0]['type']=="img"?'selected="selected"':'';?> value="img">图片</option>
					<option <?php echo $adlist[0]['type']=="code"?'selected="selected"':'';?> value="code">代码</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="120" align="right">广告位置：</td>
			<td>
				<select name="adarea">
				<?php foreach($arealist as $v){ ?>
					<option value="<?php echo $v['id']; ?>" <?php echo $adlist[0]['aid']==$v['id']?'selected="selected"':'';?>><?php echo _strcut($v['title'],30); ?></option>
				<?php } ?>
				</select>
			</td>
		</tr>
        <tr>
			<td width="120" align="right">开始日期：</td>
			<td><input name="addtime" type="text" id="posttime" value="<?php echo date("Y-m-d",$adlist[0]['addtime']) ;?>" class="input-text posttime"  readonly="readonly" />
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
			<td><input name="endtime" type="text" id="posttimeend"  value="<?php echo date("Y-m-d",$adlist[0]['endtime']) ;?>" class="input-text posttime"  readonly="readonly" />
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
        
        
        
        <tr <?php if ($adlist[0]['type']=="img"){
			echo 'class="adimg"';
		}elseif($adlist[0]['type']=="text"){
			echo 'class="adtext"';
		}else{
			echo 'class="adcode"';
		}?>>
        	<td width="120" align="right">广告<?php if($adlist[0]['type']=="img"){
				echo '图片';
			}elseif($adlist[0]['type']=="text"){
				echo "文字";
			}else{
				echo '代码';
			}?>:</td>
            <td>
				<?php if($adlist[0]['type']=="img"){ ?>							
                        <input type="text" name="adphoto" id="imagetext" class="input-text wid300">
                        <input type="button" class="button"
                         onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','缩略图上传','image','admanage',1,500000,'imagetext')" value="上传图片"/>         
                         <img style="height:50px; margin-left:100px;" src="<?php echo G_UPLOAD_PATH.'/'.$adlist[0]['content'] ;?>" />	    				
				<?php }elseif($adlist[0]['type']=="text"){ ?>
					<textarea name="text" style="width:400px;height:100px;"><?php echo $adlist[0]['content'] ;?></textarea>
				<?php }else{ ?>
					<textarea name="code" style="width:400px;height:100px;"><?php echo $adlist[0]['content'] ;?></textarea>
				<?php } ?>
            </td>
        </tr>
		<?php if($adlist[0]['type']=="img"){ ?>
		<tr class="adtext" style="display:none">
        	<td width="120" align="right">广告文字:</td>
            <td>
           	<textarea name="text" style="width:400px;height:100px;"></textarea>
            </td>
        </tr>
		<tr class="adcode" style="display:none">
        	<td width="120" align="right">广告代码:</td>
            <td>
           	<textarea name="code" style="width:400px;height:100px;"></textarea>
            </td>
        </tr>
		<?php } ?>
		<?php if($adlist[0]['type']=="text"){ ?>
		<tr class="adimg" style="display:none">
        	<td width="120" align="right">广告图片:</td>
            <td>
			 <input type="text" name="adphoto" id="imagetext" class="input-text wid300">
                        <input type="button" class="button"
                         onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','缩略图上传','image','admanage',1,500000,'imagetext')" value="上传图片"/>         
            </td>
        </tr>
		<tr class="adcode" style="display:none">
        	<td width="120" align="right">广告代码:</td>
            <td>
           	<textarea name="code" style="width:400px;height:100px;"></textarea>
            </td>
        </tr>
		<?php } ?>
		<?php if($adlist[0]['type']=="code"){ ?>
		<tr class="adtext" style="display:none">
        	<td width="120" align="right">广告文字:</td>
            <td>
           	<textarea name="text" style="width:400px;height:100px;"></textarea>
            </td>
        </tr>
		<tr class="adimg" style="display:none">
        	<td width="120" align="right">广告图片:</td>
            <td>
				 <input type="text" name="adphoto" id="imagetext" class="input-text wid300">
                        <input type="button" class="button"
                         onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','缩略图上传','image','admanage',1,500000,'imagetext')" value="上传图片"/>         
            </td>
        </tr>
		<?php } ?>
		
		<tr>
			<td width="120" align="right">是否开启：</td>
			<td>
				<input type="radio" name="checked" <?php echo $adlist[0]['checked']=='1'?'checked':''; ?> class="input-text" value="1">开启
				<input type="radio" name="checked" <?php echo $adlist[0]['checked']=='0'?'checked':''; ?> class="input-text" value="0">关闭
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