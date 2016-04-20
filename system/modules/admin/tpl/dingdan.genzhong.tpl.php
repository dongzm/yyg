<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
tbody tr{ line-height:30px; height:30px;} 
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
	<span class="lr10"> </span><span class="lr10"> </span>
    <form action="" method="post" style="display:inline-block; ">
	<select name="paixu">
    	<option value="time1"> 按购买时间倒序 </option>
        <option value="time2"> 按购买时间正序 </option>
		<option value="num1"> 按购买次数倒序 </option>
        <option value="num2"> 按购买次数正序 </option>
        <option value="money1"> 按购买总价倒序 </option>
        <option value="money2"> 按购买总价正序 </option>
        
	</select>    
	<input type ="submit" value=" 排序 " name="paixu_submit" class="button"/>
    </form>
</div>
<div class="bk10"></div>
<div class="lr10">
<iframe name="kuaidi100" src="http://www.kuaidi100.com/frame/910.html" width="910" height="700" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>	
</div>
</body>
</html> 