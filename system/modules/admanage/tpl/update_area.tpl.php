<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
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
			<td width="120" align="right">广告位名称：</td>
			<td><input type="text" name="title" class="input-text" value="<?php echo $list['title']; ?>"></td>
	</tr>
		<tr>
			<td width="120" align="right">广告位宽度：</td>
			<td><input type="text" name="width"  class="input-text" value="<?php echo $list['width']; ?>">(px)</td>
		</tr>
		<tr>
			<td width="120" align="right">广告位高度：</td>
			<td><input type="text" name="height"  class="input-text" value="<?php echo $list['height']; ?>">(px)</td>
		</tr>
        <tr>
        	<td width="120" align="right">广告位描述:</td>
            <td>
           	<textarea name="des" style="width:400px;height:100px;"><?php echo $list['des']; ?></textarea>
            </td>
        </tr>
		<tr>
			<td width="120" align="right">广告位审核：</td>
			<td>
				<input <?php echo $list['checked']=='1'?'checked':''; ?> type="radio" name="checked" value="1" class="input-text">开启
				<input <?php echo $list['checked']=='0'?'checked':''; ?> type="radio" name="checked" value="0" class="input-text">关闭
			</td>
		</tr>
		<tr>
        	<td width="120" align="right"></td>
            <td><input type="submit" class="button" name="submit"  value=" 提交 " ></td>
		</tr>
</table>
</form>
</div><!--table-list end-->
</body>
</html> 