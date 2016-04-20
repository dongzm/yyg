<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
</head>
<body>
<div class="header-title lr10">
	<b>模板管理</b> 
    <span style="color:#f60; padding-left:30px;">谨防模板被盗,建议修改html目录地址</span>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
 <form action="<?php echo G_MODULE_PATH; ?>/template/updatades" method="post" >
	<table width="100%" cellspacing="0">
			<thead>
					<tr>
					<th align='center'>模版名</th>     
					<th align='center'>说明</th>
					<th align='center'>管理操作</th>
					</tr>
			</thead>
			<tbody>
				<?php 
				if($temps){
					foreach($temps as $row){ 
				
				?>
				  <tr>			
					<td align='center'><?php echo $row['template_name']; ?></td>
					<td align='center'><input type='text' name="<?php echo base64_encode($row['template_name']); ?>" class="input-text wid200" value="<?php echo $row['des']; ?>"></td>
					<td align='center'> <a href="<?php echo G_MODULE_PATH; ?>/template/update/<?php  echo base64_encode($row['template_name']);?>">修改</a><span class="span_fenge lr5"></td>
				</tr>
				<?php 
					}
					}else{
				?>
				<tr>
					<td>
					<h3 class="lr10">该目录下没有找到模板文件!</h3>
					</td>
				</tr>
				<?php } ?>
			</tbody>
	</table>
		<div class="btn_paixu">        		
				<input type ="submit" name="submit" class='button' value="更新" style="margin-left:130px"/>
                <span class="lr5"></span>
                <a href="<?php echo G_MODULE_PATH; ?>/template/insert"><input type="button"  class='button' value="新建模板"/></a>
		</div>
 </form>
</div><!--table-list end-->
</body>
</html>