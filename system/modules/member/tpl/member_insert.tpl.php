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
			<td width="120" align="right">昵称：</td>
			<td><input type="text" name="username" value="" class="input-text"></td>
		</tr>
		<tr>
			<td width="120" align="right">邮箱：</td>
			<td><input type="text" name="email" value="" class="input-text"></td>
		</tr>
		<tr>
			<td width="120" align="right">手机：</td>
			<td><input type="text" name="mobile" value="" class="input-text"></td>
		</tr>
		<tr>
			<td width="120" align="right">密码：</td>
			<td><input type="text" name="password" value="" class="input-text">(不填写默认为原密码)</td>
		</tr>
		<tr>
			<td width="120" align="right">账户金额</td>
			<td><input type="text" name="money" value="" class="input-text">元</td>
		</tr>
		<tr>
			<td width="120" align="right">经验值</td>
			<td><input type="text" name="jingyan" value="" class="input-text"></td>
		</tr>	
		<tr>
			<td width="120" align="right">积&nbsp;&nbsp;分</td>
			<td><input type="text" name="score" value="" class="input-text"></td>
		</tr>
		<tr>
			<td width="120" align="right">邮箱验证：</td>
			<td>
				<input type="radio" name="emailcode" value="1"  class="input-text">已验证
				<input type="radio" name="emailcode" value="-1" checked class="input-text">未验证
			</td>
		</tr>
		<tr>
			<td width="120" align="right">手机验证：</td>
			<td>
				<input type="radio" name="mobilecode" value="1"  class="input-text">已验证
				<input type="radio" name="mobilecode" value="-1" checked class="input-text">未验证
			</td>
		</tr>
		<tr>
			<td width="120" align="right">头像：</td>
			<td>				
				<img src="<?php echo G_UPLOAD_PATH.'/photo/member.jpg';?>" style="height:80px;width:80px;border:1px solid #eee;padding:1px">			
				<input type="text" id="imagetext" name="thumb" value="photo/member.jpg" class="input-text wid300">
				<input type="button" class="button" onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','头像上传','image','touimg',1,500000,'imagetext')" value="上传头像" />
			</td>
		</tr>
		<tr>
			<td width="120" align="right">签名：</td>
			<td><textarea style="width:400px;height:100px;" name="qianming"></textarea></td>
		</tr>
		<tr>
			<td width="120" align="right">用户权限组：</td>
			<td>
				<select name="membergroup">
				<?php foreach($member_allgroup as $v){?>
					<option value="<?php echo $v['groupid'];?>"><?php echo $v['name'];?></option>
				<?php } ?>
				</select>
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