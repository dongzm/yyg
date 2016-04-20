<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
body{ background-color:#fff}
</style>
</head>
<body>
<script>
function qishu(id){
	if(confirm("确定删除该晒单")){
		window.location.href="<?php echo G_MODULE_PATH;?>/qishu/qishu_del/qishu/"+id;
	}
}
</script>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
 <table width="100%" cellspacing="0">
     	<thead>
        		<tr>
                    <th width="5%">ID</th>        
                    <th width="20%">商品标题</th>    
                    <th width="4%">所属栏目</th>             
                    <th width="10%">已参与/总需</th>
                    <th width="5%">单价/元</th>
                    <th width="5%">期数</th>
                    <th width="5%">人气</th>
                    <th width="5%">限时</th>
                    <th width="10%">揭晓状态</th>
                    <th width="15%">管理</th>
				</tr>
        </thead>
        <tbody style="text-align:center">				
        	<?php foreach($qishu as $v) { ?>
            <tr>
                <td><?php echo $v['id'];?></td>
                <td>第(<?php echo $v['qishu']; ?>)期 <span style="<?php echo $v['title_style']; ?>">
                <a target="_blank" href="<?php echo WEB_PATH; ?>/goods/<?php echo $v['id'];?>"><?php echo _strcut($v['title'],30);?></a></span></td>
                <td><a href="<?php echo G_ADMIN_PATH; ?>/content/goods_list/<?php echo $v['cateid']; ?>"><?php echo $cate_name; ?></a></td>
                <td><font color="#ff0000"><?php echo $v['canyurenshu'];?></font>/<?php echo $v['zongrenshu'];?></td>
                <td><?php echo $v['yunjiage'];?></td>
                <td><?php echo $v['qishu'];?>/<?php echo $v['maxqishu'];?></td>
                <td><?php	if($v['renqi']==1){	echo '<font color="#ff0000">人气</font>';}else{echo "未设置";}?></td>
                <td><?php	if($v['xsjx_time']){echo '<font color="#ff0000">限时</font>';}else{echo "未设置";	}?></td>
                <td><?php
					if($v['q_end_time']){
						$v['q_user'] = unserialize($v['q_user']);
						echo '<font color="#0c0">已揭晓</font>';
						echo "<br>";
						echo "<a href='".WEB_PATH.'/uname/'.$v['q_uid']."'".get_user_name($v['q_user'])."</a>";
					}else{
						echo "未揭晓";
					}
					?>
				</td>
                <td class="action">
                [<a href="<?php echo G_ADMIN_PATH; ?>/content/goods_edit/<?php echo $v['id'];?>">修改</a>] 
                [  <a href="javascript:window.parent.Del('<?php echo G_ADMIN_PATH.'/content/goods_del/'.$v['id'].'/'.$v['qishu'];?>', '确认删除这个商品吗？');">删除</a>]
                [<a href="<?php echo G_ADMIN_PATH; ?>/content/goods_go_one/<?php echo $v['id'];?>">购买详细</a>]
				</td>
            </tr>
            <?php } ?>
        </tbody>
     </table>     


<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>


</div><!--table_list end-->

</body>
</html> 
