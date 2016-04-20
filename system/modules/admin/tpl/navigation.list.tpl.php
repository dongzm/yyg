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

<div class="bk10"></div>
<div class="table-list lr10">
 <style>
 	th{ border:0px solid #000;}
 </style>
 

 <table width="100%" cellspacing="0">
    <thead>
            <tr>
            <th width="90">排序</th>
            <th align='center'>导航名称</th>
            <th align='center' width="70">显示隐藏</th>
			<th align='center'>类型</th>
			<th align='center'>管理操作</th>
            </tr>

    </thead>
    <tbody>
    	<?php	foreach($lists as $row){	?>
          <tr>
            <td align='center'><input name='listorders[1]' type='text' size='3' value='<?php echo $row['order']; ?>' class='input-text-c'></td>
            <td align='center'><a target="_blank" href="<?php echo WEB_PATH.$row['url']; ?>"><?php echo $row['name']; ?></a></th>
            <td align='center'><?php echo ($row['status']=='Y') ? '显示' : '隐藏'; ?></td>
			<td align='center'><?php if($row['type']=='index'){ echo '头部导航'; }else{echo '脚部导航';}?></td>
			<td align='center'>
              <a href="<?php echo G_ADMIN_PATH; ?>/ments/editnav/<?php echo $row['cid']; ?>">修改</a><span class="span_fenge lr5">|</span>
              <a href="javascript:confirmurl('<?php echo $row['cid']; ?>','确认要删除')">删除</a>
            </td>
          </tr>
          <?php } ?>
	</tbody>
  </table>
  <div class="btn_paixu">
  	<div style="width:80px; text-align:center;">
		<input type="hidden" class="button" name="dosubmit"  value="添加导航">
    </div>
  </div>
</div><!--table-list end-->
<script>
//window.parent.message("3443",8,20);

function confirmurl(id,str){
	if(confirm(str)){
		location.href='<?php echo G_ADMIN_PATH; ?>/ments/navdel/'+id;
	}
}
</script>
</body>
</html> 