<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>phpcms V9 - 后台管理中心</title>
 
<link href="<?php echo G_TEMPLATES_CSS; ?>/vote/1.css" rel="stylesheet" type="text/css" />  
<link href="<?php echo G_TEMPLATES_CSS; ?>/vote/table_form.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
 
 

 
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
 
<div class="col-tab">
<ul class="tabBut cu-li">
 
<li class="on"> 投票结果 </li>

</ul>
<div class="content pad-10" style="height:auto">
<form name="myform" action="" method="post">

<table width="80%" align="center"cellspacing="0" class="table-list">
	<thead>
		<tr>
			<th>投票选项</th>
			<th width="10%" align="center">投票数</th>
			<th width='30%' align="center">图示</th>
		</tr>
	</thead>
<tbody>
	<?php for($i=0;$i<count($vote_option);$i++){?>
	<tr>
		<td> <?php echo $vote_option[$i]['option_title'] ;?></td>
		<td align="center"><?php echo $vote_option[$i]['option_number'] ;?></td>
		<td align="center">
		<div class="vote_bar">
        	<div style="width:100%"><span><?php echo  $vote_number_total[$i]?>%</span> </div>
        </div>
		</td>		
		</tr>
		<?php  }?>
 
	</tbody>
	 
</table>

</form>
</div>
</div>
</div>
<div>
<li style="float:right;margin-right:200px"><b> 投票总数  <?php echo $vote_total;?> </b></li>

</div>
</body>
</html>

<script type="text/javascript">
function edit(id, name) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'修改 '+name+' ',id:'edit',iframe:'?m=vote&c=vote&a=edit&subjectid='+id,width:'700',height:'450'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}
</script>
