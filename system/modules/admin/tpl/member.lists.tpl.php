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
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
            <th width="100px" align="center">ID</th>
            <th width="100px" align="center">用户名</th>
            <th width="100px" align="center">邮箱</th>
            <th width="100px" align="center">手机</th>
            <th width="100px" align="center">账户金额</th>
            <th width="100px" align="center">邮箱认证</th>
            <th width="100px" align="center">手机认证</th>
            <th width="100px" align="center">管理</th>       
		</tr>
    </thead>
    <tbody>
    	<?php foreach($members as $v){ ?>
		<tr>
			<td align="center"><?php echo $v['uid']; ?></td>
			<td align="center"><?php echo $v['username']; ?></td>	
			<td align="center"><?php echo $v['email']; ?></td>	
			<td align="center"><?php echo $v['mobile']; ?></td>	
			<td align="center"><?php echo $v['money']; ?></td>	
			<td align="center"><?php if($v['eamilcode']==1){?>已认证<?php }else{ ?>未认证<?php } ?></td>	
			<td align="center"><?php if($v['mobilecode']==1){?>已认证<?php }else{ ?>未认证<?php } ?></td>
            <td align="center">
            	<a href="#">修改</a>
                <span class="span_fenge lr5">|</span>
                <a href="#">删除</a>
            </td>            	
		</tr>
       <?php } ?>
	
  	</tbody>
</table>
</div><!--table-list end-->

<script>
</script>
</body>
</html> 