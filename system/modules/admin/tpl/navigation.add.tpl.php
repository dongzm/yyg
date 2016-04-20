<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<style>
table th{ border-bottom:1px solid #eee; font-size:12px; font-weight:100; text-align:right; width:100px;}
table td{ padding-left:10px;}
input.button{ display:inline-block}
</style>

<div class="bk10"></div>

<?php if(ROUTE_A=='addnav'){ ?>
 <form action="#" id="form" method="post">
 <table width="100%" class="table_form">
 <tbody>
  		<tr>
        <th>导航名称：</th>
        <td><input type="text" name="name" id="catname" class="input-text">
		</td>
      </tr>   
		<tr>
	  <th width="200">类别：</th>
        <td>
		 <select name="type" id="modelid" onChange="">
         <option value="index" selected="">≡ 头部导航 ≡</option>
         <option value="foot" >≡ 脚部导航 ≡</option>
         </select>  
      </tr>
      <tr>
       <th>导航URL：</th>
        <td><input type="text" name="url" style="width:350px;" id="catname" class="input-text">
         <span><font color="#0c0" size="">※ </font>前面默认会加上: <?php echo WEB_PATH; ?></span>
		</td>
      </tr>      
		<tr>
        <th width="200">是否显示：</th>
        <td>
		 <select name="status" id="modelid" onChange="">
         <option value="Y" selected="">≡ 显示 ≡</option>
         <option value="N">≡ 隐藏 ≡</option>
         </select>
      </tr>
         <tr> 
       <th>排序：</th>
        <td><input type="text" name="order" id="catname" class="input-text" onKeyUp="value=value.replace(/[^0-9]/g,'')">
        	<span><font color="#0c0" size="">※ </font>数值越大越靠前显示</span>
		</td>
      </tr>   
        <tr>
       <th></th>
        <td><input type="submit" class="button" name="dosubmit"  value="添加导航"></td>
      </tr>     
</tbody>
</table>
</form>
<?php } ?>
<?php if(ROUTE_A=='editnav'){ ?>
 <form action="#" id="form" method="post">
 <table width="100%" class="table_form">
 <tbody>
  		<tr>
        <th>导航名称：</th>
        <td><input type="text" value="<?php echo $info['name']; ?>" name="name" id="catname" class="input-text">
		</td>
      </tr>  
		<tr>
	  <th width="200">类别：</th>
        <td>
		 <select name="type" id="modelid" onChange="">
         <option value="index" <?php if($info['type']=='index'){ ?> selected=""<?php } ?>>≡ 头部导航 ≡</option>
         <option value="foot"  <?php if($info['type']=='foot'){ ?> selected=""<?php } ?>> ≡ 脚部导航 ≡</option>
         </select>  
      </tr>	  
      <tr>
       <th>导航URL：</th>
        <td><input type="text" name="url" value="<?php echo $info['url']; ?>" style="width:350px;" id="catname" class="input-text">
        <span><font color="#0c0" size="">※ </font>前面默认会加上: <?php echo WEB_PATH; ?></span>
		</td>        
      </tr>      
		<tr>
        <th width="200">是否显示：</th>
        <td>
		 <select name="status" id="modelid" onChange="">
         <option value="Y" <?php if($info['status']=='Y'){ ?> selected="" <?php } ?>>≡ 显示 ≡</option>
         <option value="N" <?php if($info['status']=='N'){ ?> selected="" <?php } ?>>≡ 隐藏 ≡</option>
         </select>
      </tr>
         <tr>
       <th>排序：</th>
        <td><input type="text" name="order" value="<?php echo $info['order']; ?>" id="catname" class="input-text" onKeyUp=					"value=value.replace(/[^0-9]/g,'')">
        	<span><font color="#0c0" size="">※ </font>数值越大越靠前显示</span>
		</td>
      </tr>   
        <tr>
       <th></th>
        <td><input type="submit" class="button" name="dosubmit"  value="修改导航"></td>
      </tr>     
</tbody>
</table>
</form>
<?php } ?>
</body>
</html> 