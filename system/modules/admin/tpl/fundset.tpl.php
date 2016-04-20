<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
tr{height:30px;line-height:30px}
</style>
</head>
<body>
<div class="header-title lr10">
	<b>云购基金配置</b>
</div>
<div class="bk10"></div>
<div class="header-data lr10">
	<b>当前云购基金总金额为 : <font color="red"><?php echo $config['fund_count_money']; ?></font> 元</b>
</div>
<div class="bk10"></div>
<div class="table_form lr10">	
<form action="" method="post" id="myform">
<table width="100%" class="lr10">
  <tr>
    <td width="100">开启云购基金</td>
    <td>
     <input name="fund_off" value="1" type="radio" <?php if($config['fund_off'])echo "checked";?>> 开启
	 <input name="fund_off" value="0" type="radio" <?php if(!$config['fund_off'])echo "checked";?>> 关闭 	 
	 <span class="lr10"> </span>
	 <font color="red"></font>
	</td>
  </tr>
  <tr>
    <td>基金出资金额</td>
    <td><input type="text" class="input-text wid150" name="fund_money" value="<?php echo $config['fund_money']; ?>"/>
	当您每参与1人次云购，将出资 <font color="red"><?php echo $config['fund_money']; ?></font> 元为云购基金筹款
	</td>
  </tr>
    <tr>
    <td>基金总金额</td>
    <td><input type="text" class="input-text wid150" style="background:#eee" id="fund_3" name="fund_count_money" disabled="true" value="<?php echo $config['fund_count_money']; ?>"/>
	<a href="javascript:;" onClick="input_set_disabled('fund_3');" style="color:#0c0"> 修改 </a>
	</td>
  </tr>
	<tr>
    	<td width="100"></td> 
   		<td> <input type="submit" value=" 提交 " name="dosubmit" class="button"></td>
    </tr>
</table>
</form>

</div><!--table-form end-->

<script>	
function input_set_disabled(iid){
	var input  = document.getElementById(iid);
	if(this.input_disabled == 'off'){	
		this.input_disabled = 'on';		
		input.disabled = true;
		input.style.background="#eeeeee";
	}else{
		this.input_disabled = 'off';
		input.style.background="#ffffff";
		input.disabled = false;
	}
}
</script>
</body>
</html> 