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
<div class="table-list lr10">
<!--start-->
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
        	<th align="center">订单号</th>
            <th align="center">商品标题</th>
            <th align="center">购买用户</th>
            <th align="center">购买次数</th>
            <th align="center">购买总价</th>
            <th align="center">购买日期</th>
            <th align="center">中奖</th>
            <th align="center">订单状态</th>
            <th align="center">管理</th>
		</tr>
    </thead>
    <tbody>
		<?php foreach($recordlist AS $v) {	?>		
            <tr>
                <td align="center"><?php echo $v['code'];?> <?php if($v['code_tmp'])echo " <font color='#ff0000'>[多]</font>"; ?></td>
                <td align="center">
                <a  target="_blank" href="<?php echo WEB_PATH.'/goods/'.$v['shopid']; ?>">
                第(<?php echo $v['shopqishu'];?>)期<?php echo _strcut($v['shopname'],0,25);?></a>
                </td>              
                 <td align="center"><?php echo $v['username']; ?></td>
                <td align="center"><?php echo $v['gonumber']; ?>人次</td>
                <td align="center">￥<?php echo $v['moneycount']; ?>元</td>
                <td align="center"><?php echo date("Y-m-d H:i:s",$v['time']);?></td>
                 <td align="center"><?php  echo $v['huode'] ? "中奖" : '未中奖';?></td>
                <td align="center"><?php echo $v['status'];?></td>
                <td align="center"><a href="<?php echo G_MODULE_PATH;?>/dingdan/get_dingdan/<?php echo $v['id']; ?>">详细</a></td>
            </tr>
            <?php } ?>
  	</tbody>
</table>
<div class="btn_paixu"></div>
<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>
</div><!--table-list end-->

<script>
</script>
</body>
</html> 