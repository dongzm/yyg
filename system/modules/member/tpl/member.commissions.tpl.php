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
            <th width="100px" align="center">申请时间</th>
            <th width="100px" align="center">开  户 人</th>
            <th width="100px" align="center">银行账户信息</th>
            <th width="100px" align="center">提现金额(元)</th>
            <th width="100px" align="center">手续费(元)</th>
            <th width="100px" align="center">审核状态</th>       
            <th width="100px" align="center">管理</th>       
		</tr>
    </thead>
    <tbody>
    	<?php foreach($commissions as $key=>$v){ ?>
		<tr>
			<td align="center"><?php echo $v['id']; ?></td>
			<td align="center"><?php echo $user[$key]['username']; ?></td>	
			<td align="center"><?php echo date('Y-m-d',$v['time']); ?></td>	
			<td align="center"><?php echo $v['username']; ?></td>	
			<td align="left"><?php echo $v['bankname']."".$v['branch']."".$v['banknumber']; ?></td>	
			<td align="center"><?php echo $v['money']; ?></td>	
			<td align="center"><?php echo $fufen['fufen_yongjintx']; ?></td>	
			<td align="center"><?php if($v['auditstatus']==1){echo "审核通过";}else{echo "未通过";} ?></td>	
			  
            <td align="center">
			   <?php if($v['auditstatus']!=1){?>
				 <a href="<?php echo G_MODULE_PATH; ?>/member/commreview/<?php echo $v['id'];?>">审核</a><?php
				}?> 
		   </td>            	
		</tr>
       <?php } ?>
	
  	</tbody>
	
</table>
</div><!--table-list end-->
<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>
<script>
</script>
</body>
</html> 