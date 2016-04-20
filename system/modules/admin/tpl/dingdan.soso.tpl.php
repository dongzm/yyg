<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css"> 
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
<style>
tbody tr{ line-height:30px; height:30px;} 
.header-data li{ line-height:40px;}
.soso_message{ text-align:center; height:80px; line-height:80px;  border-top:5px solid #FFBE7A;border-bottom:5px solid #FFBE7A;}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="header-data lr10">
	<form action="" method="post" style="display:inline-block; ">
	<li>订单号查询：<input type="type" style="width:308px" name="text" class="input-text" /> <input type="submit" name="codesubmit" class="button" value=" 查 询 " /></li>
    </form>    
    <br />
    <form action="" method="post" style="display:inline-block; ">
    <li>用户查询&nbsp;&nbsp;&nbsp;：
    <select name="user" style="width:100px">
    	<option value="uid"> 用户UID </option>
	</select>    
    <input type="type" name="text" class="input-text wid200" /> <input type="submit" name="usersubmit" class="button" value=" 查 询 " />
    </li>
    </form>
    <br />
    <form action="" method="post" style="display:inline-block; ">
    <li>商品查询&nbsp;&nbsp;&nbsp;：
    <select name="shop" style="width:100px">
    	<option value="sid"> 商品 ID </option>
        <option value="sname"> 商品标题 </option>     
	</select>    
    <input type="type"  name="text" class="input-text wid200" /> <input type="submit" name="shopsubmit" class="button" value=" 查 询 " />
    </li>
    </form>
</div>
<div class="bk10"></div>
<div class="header-data lr10">
<form action="" method="post" style="display:inline-block; ">
	添加时间:
    	  <input name="posttime1" type="text" id="posttime1" class="input-text posttime"  readonly="readonly" />
          &nbsp; <===> &nbsp; 
 		  <input name="posttime2" type="text" id="posttime2" class="input-text posttime"  readonly="readonly" />
<script type="text/javascript">
		date = new Date();
		Calendar.setup({
					inputField     :    "posttime1",
					ifFormat       :    "%Y-%m-%d %H:%M:%S",
					showsTime      :    true,
					timeFormat     :    "24"
		});
		Calendar.setup({
					inputField     :    "posttime2",
					ifFormat       :    "%Y-%m-%d %H:%M:%S",
					showsTime      :    true,
					timeFormat     :    "24"
		});
				
</script>
<input class="button" type="submit" name="timesubmit" value=" 搜 索 ">
</form>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<?php if(is_array($record)): ?>
<!--start-->
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
        	<th align="center">订单号</th>
            <th align="center">商品标题</th>
            <th align="center">购买次数</th>
            <th align="center">购买总价</th>
            <th align="center">购买日期</th>
            <th align="center">订单状态</th>
            <th align="center">管理</th>
		</tr>
    </thead>
    <tbody>
    	<?php foreach($record as $v): ?>
        	<tr>
                <td align="center"><?php echo $v['code'];?> <?php if($v['code_tmp'])echo " <font color='#ff0000'>[多]</font>"; ?></td>
                <td align="center"><?php echo _strcut($v['shopname'],0,25);?></td>              
                <td align="center"><?php echo $v['gonumber']; ?>人次</td>
                <td align="center">￥<?php echo $v['moneycount']; ?>元</td>
                <td align="center"><?php echo date("Y-m-d H:i:s",$v['time']);?></td>
                <td align="center"><?php echo $v['status'];?></td>
                <td align="center"><a href="<?php echo G_MODULE_PATH;?>/dingdan/get_dingdan/<?php echo $v['id']; ?>">详细</a></td>
            </tr>
        <?php endforeach; ?>
  	</tbody>
</table>
 <?php endif; ?>
<?php if(!$record): ?>
	<div class="soso_message">
    	未搜索到信息.....
    </div>
<?php endif; ?>
<div class="btn_paixu"></div>
<div id="pages"></div>
</div><!--table-list end-->

<script>
</script>
</body>
</html> 