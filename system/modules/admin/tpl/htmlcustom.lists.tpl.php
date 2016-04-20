<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<style>
td,th{text-indent:10px;}
th{ border-left:1px solid #d5dfe8}
.btn_a{
	border: 1px solid #ccc;
	display: inline-block;
	background: #eee;
	padding: 2px 8px;
	text-indent: 0px;
}
</style>
</head>
<body>
<div class="header-title lr10">
	<b>自定义标签</b>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
 <form action="<?php echo G_MODULE_PATH; ?>/htmlcustom/updatades" method="post" >
	<table width="100%" cellspacing="0">
			<thead>
					<tr>
					<th align='left'>标签名</th>  
					<th align='left'>模板调用方式</th>  					
					<th align='left'>标签说明</th>
					<th align='left'>操作</th>
					</tr>
			</thead>
			<tbody>
				<?php foreach($TAG as $key=>$val){ ?>
				 <tr>			
					<td align='left' width="30%"><?php echo $key; ?></td>
					<td align='left' width="30%">{wc:block name="<?php echo $key; ?>"}</td>
					<td align='left' width="30%"><?php echo $val; ?></td>
					<td align='left' width="10%">
						<a class="btn_a" href="<?php echo G_MODULE_PATH; ?>/htmlcustom/edit/<?php echo $key; ?>">修改</a>
						<a class="btn_a" onclick="del('<?php echo $key; ?>',this);" href="javascript:;">删除</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
	</table>
		<div class="btn_paixu">        		
                <a href="<?php echo G_MODULE_PATH; ?>/htmlcustom/create"><input type="button"  class='button' value="新建标签"/></a>
		</div>
 </form>
</div><!--table-list end-->
<script>
function del(key,T){
	var url = "<?php echo G_MODULE_PATH; ?>/htmlcustom/";
	window.parent.layer.confirm("是否删除`"+key+"` 标签",function(){
		window.parent.message("点击了确定"+key,8,2);	
		$.post(url+"del",{"key":key},function(data){
			window.parent.message(data,8,2);
			if(data == "yes"){
				window.parent.message("删除成功",2,2);
				$(T).parents("tr").remove();
			}else{
				window.parent.message(data,1,2);
			}
		})
	},"是否确定",function(){
		
	});	
}
</script>
</body>
</html>