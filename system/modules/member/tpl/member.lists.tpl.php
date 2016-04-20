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

<div class="header-data lr10">

	<span class="lr5"></span><input class="button" type="button" onclick="window.location.href='<?php echo $this_path; ?>/day_new'" value=" 今日新增 ">	
	<span class="lr5"></span><input class="button" type="button" onclick="window.location.href='<?php echo $this_path; ?>/day_shop'" value=" 今日消费 ">
	<span class="lr5"></span><input class="button" type="button" onclick="window.location.href='<?php echo $this_path; ?>/noreg'" value=" 未认证 ">
	<span class="lr5"></span><input class="button" type="button" onclick="window.location.href='<?php echo $this_path; ?>/del'" value=" 已删除 ">	
	<span class="lr5"></span>
	账号绑定:
	<select name="sousuo">
					<option value="b_qq">绑定QQ账户</option>					
	</select>
	<input class="button" type="button" onclick="window.location.href='<?php echo $this_path; ?>/b_qq'"  value="查看">
	
	<span class="lr10"></span>
	排序:
	<select id="user_paixu">
					<option value="uid">会员uid</option>
					<option value="money" >账户金额</option>
					<option value="score">会员福分</option>
					<option value="jingyan">会员经验</option>
                    <option value="login_time">登陆时间</option>
					<option value="time">注册时间</option>
	</select>
	<input class="button" type="button" onclick="order_fun_sub('desc')" value="倒序">
	<input class="button" type="button" onclick="order_fun_sub('asc')" value="正序">
	
	<script>
		var user_paixu_value = 'uid';
		function order_fun_sub(type){		
			window.location.href='<?php echo $this_path.'/'.$user_type."/"; ?>'+user_paixu_value+"/"+type;	
		}
		document.getElementById("user_paixu").onchange=function(){		
			user_paixu_value = this.value;		
		}
	</script>	
	
	<div class="lr10" style="display:inline-block;margin-left:20px;">
		共有会员: <font color="#0c0"> <?php echo $this->member_count_num; ?> </font>人
		<span class="lr10"></span>
		今日注册: <font color="#f60"> <?php echo $this->member_del_num; ?> </font>人
		<span class="lr10"></span>
		删除会员: <font color="red"> <?php echo $this->member_new_num; ?> </font>人
	</div>
</div>

<div class="lr10" style="line-height:30px;color:#f60">
	<b>会员列表:</b> <?php echo $select_where; ?> &nbsp;&nbsp;&nbsp; 共找到 <?php echo $total; ?> 个会员
</div>
<div class="table-list lr10">        
  <!--start-->
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
            <th align="center">UID</th>
            <th align="center">用户名</th>
            <th align="center">邮箱</th>
            <th align="center">手机</th>
            <th align="center">金额</th>
			<th align="center">福分</th> 
			<th align="center">经验值</th>			
			<th align="center">登陆时间,地址,IP</th>
			<th align="center">注册时间</th>		
			<th align="center">账户绑定</th>
            <th align="center">管理</th>
		</tr>
    </thead>
    <tbody>
    	<?php foreach($members as $v){ ?>
			<tr>
				<td align="center"><?php echo $v['uid']; ?></td>
				<td align="center"><?php echo $v['username']; ?></td>	
				<td align="center"><?php echo $v['email']; ?> <?php if($v['emailcode']==1){?><span style="color:#0c0">√</span><?php }else{ ?><span style="color:red">×</span><?php } ?></td>	
				<td align="center"><?php echo $v['mobile']; ?> <?php if($v['mobilecode']==1){?><span style="color:#0c0">√</span><?php }else{ ?><span style="color:red">×</span><?php } ?></td>	
				<td align="center"><?php echo $v['money']; ?></td>
				<td align="center"><?php echo $v['score']; ?></td>
				<td align="center"><?php echo $v['jingyan']; ?></td>				
				<td align="center"><?php echo _put_time($v['login_time'],"未登录"); ?>,<?php echo trim($v['user_ip'],","); ?></td>	
				<td align="center"><?php echo _put_time($v['time']); ?></td>
				<td align="center"><?php echo trim($v['band'],","); ?></td>
				<td align="center">
					<?php if($table=='@#_member_del'): ?>
					<a href="<?php echo G_MODULE_PATH; ?>/member/huifu/<?php echo $v['uid'];?>">恢复</a>				
					<a href="<?php echo G_MODULE_PATH; ?>/member/del_true/<?php echo $v['uid'];?>" onClick="return confirm('是否真的删除！');">删除</a>
					<?php else: ?>
					[<a href="<?php echo G_MODULE_PATH; ?>/member/modify/<?php echo $v['uid'];?>">改</a>]					
					[<a href="<?php echo G_MODULE_PATH; ?>/member/del/<?php echo $v['uid'];?>" onClick="return confirm('是否真的删除！');">删</a>]
					<?php endif; ?>
			   </td>            	
			</tr>
            <?php } ?>
  	</tbody>
</table>
</div><!--table-list end-->

<div id="pages" style="margin:10px 10px">		
	<ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul>
</div>
<script>
</script>
</body>
</html> 