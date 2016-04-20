<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css"> 
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
<style>
body{ background-color:#fff}
tr{ text-align:center}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
    <a style="float:right; margin-right:10px;" href="http://127.0.0.2/yungou/admin/content/goods_del_all"><b style="color:#ff0000">清空商品回收站</b></a>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
        <table width="100%" cellspacing="0">
     	<thead>
        		<tr>
                    <th width="5%">ID</th>        
                    <th width="25%">商品标题</th>             
                    <th width="10%">已参与/总需</th>
                    <th width="5%">单价/元</th>
                    <th width="10%">期数/最大期数</th>
                    <th width="10%">人气商品</th>
                    <th width="10%">限时商品</th>
                    <th width="15%">管理</th>
				</tr>
        </thead>
        <tbody>				
        	<?php foreach($shoplist as $v) {  ?>
            <tr>
                <td><?php echo $v['id'];?></td>
                <td><span style="<?php echo $v['title_style']; ?>"><?php echo _strcut($v['title'],0,25);?></span></td>
                <td><font color="#ff0000"><?php echo $v['canyurenshu'];?></font> / <?php echo $v['zongrenshu'];?></td>
                <td><?php echo $v['yunjiage'];?></td>
                <td><?php echo $v['qishu'];?>/<?php echo $v['maxqishu'];?></td>
                <td><?php
					if($v['renqi']==1){
						echo '<font color="#ff0000">人气</font>';
					}else{
						echo "否";	
					}
					?>
				</td>
                <td><?php
					if($v['xsjx_time']){
						echo '<font color="#ff0000">限时</font>';
					}else{
						echo "否";	
					}
					?>
				</td>
                <td class="action">
                [<a href="<?php echo G_MODULE_PATH; ?>/content/goods_del_key/<?php echo $v['id'];?>/yes/<?php echo $v['qishu'];?>">撤销删除</a>] 
                [<a href="<?php echo G_MODULE_PATH; ?>/content/goods_del_key/<?php echo $v['id'];?>/no/<?php echo $v['qishu'];?>">彻底删除</a>]
				</td>
            </tr>
            <?php } ?>
        </tbody>
     </table>
    	<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>
</div>

</body>
</html> 