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
<div class="header-title lr10">
	<b>内容管理</b>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
 <style>
 	tr{ border:0px solid #000; line-height:30px;}
 </style>
 <table width="100%" cellspacing="0">
    <thead>
            <tr>
            <th width="100">catid</th>
            <th align='center'>栏目名称</th>
            <th align='center' width='100'>栏目类型</th>
            <th align='center' width="100">所属模型</th>
            <th align='center'>访问地址</th>
			<th align='center'>管理操作</th>
            </tr>
    </thead>
    <tbody>
          <?php echo $html; ?>
    </tbody>
  </table>
  <div class="btn_paixu">  	
  </div>
</div>
<!--table-list end-->
</body>
</html> 