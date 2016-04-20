<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
 <style>
 	th{ border:0px solid #000;}
 </style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>

<div class="bk10"></div>
<div class="table-list lr10">
 <table width="100%" cellspacing="0">
    <thead>
            <tr>
            <th width="90">排序</th>
            <th width="60">catid</th>
            <th align='center'>栏目名称</th>
            <th align='center' width='70'>栏目类型</th>
            <th align='center' width="70">所属模型</th>
            <th align='center'>访问地址</th>
			<th align='center'>管理操作</th>
            </tr>
    </thead>
    <tbody>
    	  <form action="#" method="post" name="myform">
          <?php echo $html; ?>
          </form>
    </tbody>
  </table>
  <div class="btn_paixu">
  	<div style="width:80px; text-align:center;">
        <input type="button" class="button" value=" 排序 "
        onclick="myform.action='<?php echo G_MODULE_PATH; ?>/category/listorder/dosubmit';myform.submit();"/>
    </div>
  </div>
</div><!--table-list end-->
<script>
//window.parent.message("3443",8,20);
</script>
</body>
</html> 