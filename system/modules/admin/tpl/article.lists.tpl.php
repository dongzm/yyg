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
.header-data{
	border: 1px solid #FFBE7A;
	zoom: 1;
	background: #FFFCED;
	padding: 8px 10px;
	line-height: 20px;
}
.table-list  tr {
	text-align:center;
}

</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="header-data lr10">
<form action="#" method="post">
 添加时间: <input name="posttime1" type="text" id="posttime1" class="input-text posttime"  readonly="readonly" /> -  
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

<select name="sotype">
<option value="cateid">栏目id</option>
<option value="catename">栏目名称</option>
<option value="title">文章标题</option>
<option value="id">文章ID</option>
</select>
<input type="text" name="sosotext" class="input-text wid100"/>
<input class="button" type="submit" name="sososubmit" value="搜索">
</form>
</div>
<div class="bk10"></div>
<form action="#" method="post" name="myform">
<div class="table-list lr10">
	 <table width="100%" cellspacing="0">
     	<thead>
        		<tr>
					<th>排序</th>  
					<th>ID</th>  
					<th>所属栏目</th>  
                    <th>文章标题</th>
                    <th>发布人</th>
                     <th>点击量</th>
                    <th>添加时间</th>        
                    <th>管理</th>
				</tr>
        </thead>
        <tbody>				
        	<?php foreach($articlelist AS $v) { ?>
            <tr>
              <td align='center'><input name='listorders[<?php echo $v['id']; ?>]' type='text' size='3' value='<?php echo $v['order']; ?>' class='input-text-c'></td>
                <td><?php echo $v['id'];?></td>
				<td><a href="<?php echo G_MODULE_PATH; ?>/content/article_list/<?php echo $v['cateid']; ?>"><?php echo $this->categorys[$v['cateid']]['name'];?></a></td>
                <td><?php echo _strcut($v['title'],0,25);?></td>
                <td><?php echo $v['author']; ?></td>
                <td><?php echo $v['hit']; ?></td>
                <td><?php echo date("Y-m-d H:i:s",$v['posttime']);?></td>
                <td class="action">
                <a href="<?php echo G_ADMIN_PATH; ?>/content/article_edit/<?php echo $v['id'];?>">修改</a>
                <span class='span_fenge lr5'>|</span>    
                <a href="javascript:window.parent.Del('<?php echo G_ADMIN_PATH.'/content/article_del/'.$v['id'];?>', '确认删除这篇文章吗？');">删除</a>
				</td>
            </tr>
            <?php } ?>
        </tbody>
     </table>
     </form>
   <div class="btn_paixu">
  	<div style="width:80px; text-align:center;">
          <input type="button" class="button" value=" 排序 "
        onclick="myform.action='<?php echo G_MODULE_PATH; ?>/content/article_listorder/dosubmit';myform.submit();"/>
    </div>
  </div>
<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>
</div>

</body>
</html>