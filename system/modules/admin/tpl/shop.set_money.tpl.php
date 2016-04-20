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
	.bg{background:#fff url(<?php echo G_GLOBAL_STYLE; ?>/global/image/ruler.gif) repeat-x scroll 0 9px }
	.color_window_td a{ float:left; margin:0px 10px;}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>    
</div>
<div class="bk10"></div>
<div class="header-data lr10">
	<b>提示:</b> <font color="red">重置本期商品的【价格】 会导致已经生成的交易记录清空！ （已参与人数为【0】的商品不受影响）</font>
	<br/>
	<b>提示:</b> <font color="red">下一期商品的价格也会是本次设置的新价格！</font>
</div>

<div class="bk10"></div>
<div class="table_form lr10">
<form method="post" action="#" id="form_post">
	<table width="100%"  cellspacing="0" cellpadding="0">
		<tr>
			<td align="right" style="width:120px">商品标题：</td>
			<td>
            	<a target="_blank" href="<?php echo WEB_PATH;?>/goods/<?php echo $shopinfo['id'];?>"><b>第(<font color="red"><?php echo $shopinfo['qishu']; ?></font>)期  <?php echo $shopinfo['title']; ?></b></a>
            </td>			
		</tr>
		<tr>
			<td align="right" style="width:120px">商品单次售价：</td>
			<td><b style="color:red"><?php echo $shopinfo['yunjiage']; ?></b> <b>元</b></td>			
		</tr>
		<tr>
			<td align="right" style="width:120px">商品总售价：</td>
			<td><b style="color:red"><?php echo $shopinfo['money']; ?></b> <b>元</b></td>			
		</tr>
		<tr>
			<td align="right" style="width:120px">已参与人数：</td>
			<td><b style="color:red"><?php echo $shopinfo['canyurenshu']; ?></b> <b>人</b></td>			
		</tr>
		<tr>
			<td align="right" style="width:120px">总需要人数：</td>
			<td><b style="color:red"><?php echo $shopinfo['zongrenshu']; ?></b> <b>人</b> 　　　向上取整(<?php echo $shopinfo['money']; ?> / <?php echo $shopinfo['yunjiage']; ?>) = <?php echo $shopinfo['zongrenshu']; ?></td>			
		</tr>
		
		<tr>
			<td align="right" style="width:120px;color:red">新单次售价：</td>
			<td><input type="text" id="yunjiage"  name="yunjiage" onKeyUp="value=value.replace(/\D/g,'')" style="width:65px; padding-left:0px; text-align:center" value="1" class="input-text"> 元</td>			
		</tr>
		<tr>
			<td align="right" style="width:120px;color:red">新总售价：</td>
			<td><input type="text" name="money" id="money" onKeyUp="value=value.replace(/\D/g,'')" style="width:65px;padding-left:0px;text-align:center" class="input-text"> 元</td>			
		</tr>
       
      

        <tr height="60px">
			<td align="right" style="width:120px"></td>
			<td><input type="submit" name="dosubmit" class="button" value=" 确认更改 " /></td>
		</tr>
	</table>
</form>
</div>
<!--JS-->
<script type="text/javascript">
$("#form_post").submit(function(){
								
	var canyurenshu = <?php echo $shopinfo['canyurenshu']; ?>;
	var zongrenshu = <?php echo $shopinfo['zongrenshu']; ?>;
	var y_money = <?php echo $shopinfo['money']; ?>;
	var y_yunjiage = <?php echo $shopinfo['yunjiage']; ?>;
	
	var money = parseInt($("#money").val());	
	var yunjiage = parseInt($("#yunjiage").val());
	
	if((y_money == money) && (y_yunjiage == yunjiage)){
		window.parent.message("商品价格没有改变!",8,2);
		return false;
	}
	
	if(!money || !yunjiage){
		window.parent.message("商品价格输入不正确!",8,2);
		return false;
	}
	if(yunjiage > money){
		window.parent.message("单次价格不能大于总价格",8,2);
		return false;
	}
	if(canyurenshu>0){
		var s = confirm("参与人数不为0,将会清空会员购买记录，是否继续");
		if(!s){
			return false;			
		}
	}
	return true;
		
	
});
</script>
<!--JS-->
</body>
</html> 