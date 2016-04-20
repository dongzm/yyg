<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?><a
href="javascript:void(0)" onClick="remove()()">删除</a>
</div>

<div class="bk10"></div>

<div class="table-list lr10">
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
        <th width="20%">绑定的域名</th>
		<th width="20%">绑定的模块</th>
        <th width="20%">绑定的控制器</th>
        <th width="20%">绑定的函数</th>
		<th width="20%">管理操作</th>
		</tr>
    </thead>
  	<tbody id="trlist">
    	<?php foreach($domain_cfg as $key=>$do){ ?>
        <tr>
        <td width="20%" align="center"><?php echo $key; ?></td>
        <td width="20%" align="center"><?php echo $do['m']; ?></td>
        <td width="20%" align="center"><?php echo $do['c']; ?></td>
        <td width="20%" align="center"><?php echo $do['a']; ?></td>
        <td width="20%" align="center">
        	<a href="javascript:void(0)" onclick="updata(this)">修改</a>
            <span class="lr10">|</span>
            <a href="javascript:void(0)" onclick="removes(this)">删除</a>	        									
        </td>
        </tr>
        <?php } ?>
	</tbody>
</table>
</div><!--table-list end-->
<div class="bk10"></div>
<div class="header lr10">
	<input type="button" class="button" style=" margin-top:8px; margin-left:20px;" onClick="add_band()" name="install" value=" 添加新的绑定 " />
</div>

<script>

function input_to_string(obj,A,t){
	if(t == 'string'){
		obj.each(function(i){ 
			$(this).parent().text($(this).val());
		});
		$(A).text("修改");
	}
	
	/************************************************************/
	
	if(t == 'input'){
		
		var tds = obj.find("td");
		var upkey = $(tds[0]).text();
		
		tds.each(function(i){	
			if(i < 4)
			$(this).html('<input class="input-text" type="text" style="width:70%" value="'+$(this).text()+'">');
		});
		$(A).text("确定");
		$(A).attr("onclick","install(this,'"+upkey+"')");
	}
}


function updata(T){
	var tr = $($(T).parent().parent());	
			 input_to_string(tr,T,'input');	
}
function install(T,y){
	var domain = '';
	var module = '';
	var action = '';
	var func   = '';
	var values = new Array();
    var regex  = /^[A-Za-z0-9]*[a-z0-9_.]*$/ ;
	var ret    = false;	
	
	var tr = $($(T).parent().parent());
	var input = tr.find("input");
	
	input.each(function(i){
		ret = regex.test($(this).val());
		if(!ret){
			window.parent.message("格式不正确,只能输入字母,下划线,和点!");
			$(this).css("border","1px solid #ff0000");
			return;
		}
		$(this).css("border","1px solid #0c0");
		values[i] =  $(this).val();
    });
	
	
	var submit_name = '';
	if(y != '' && y != null){
		y = y;
	}else{
		y = 'install';
	}
	
	if(ret){			
		$.post("<?php echo G_MODULE_PATH; ?>/setting/domain/",{'domain':values[0],'module':values[1],'action':values[2],'func':values[3],'dosubmit':y},function(data){
				if(data == 'ok'){
					window.parent.message("绑定成功！",1);
					input_to_string(input,T,'string');
				}else{
					window.parent.message(data,8);
				}
		});
	}
	
}

function removes(T){
	var tr = $(T).parent().parent();
	var domain = $(tr.find("td")[0]).text();	
	$.post("<?php echo G_MODULE_PATH; ?>/setting/domain/",{'domain':domain,'dosubmit':'del'},function(data){
				if(data == 'ok'){
					window.parent.message("删除成功！",1);
					tr.remove();
				}else{
					window.parent.message(data,8);
				}
	});	
}

function add_band(){
	if(!this.n){
		this.n = 0;
	}
	this.n++;

	var html = '';
		html+='<tr>';
		html+='<td width="20%" align="center"><input class="input-text" style="width:70%" value="输入域名..." type="text"></td>';
		html+='<td width="20%" align="center"><input class="input-text" style="width:70%" value="输入模块名..." type="text"></td>';
		html+='<td width="20%" align="center"><input class="input-text" style="width:70%" value="输入控制器名..." type="text"></td>';
		html+='<td width="20%" align="center"><input class="input-text" style="width:70%" value="输入函数名..." type="text"></td>';
		html+='<td width="20%" align="center">';
		html+='<a href="javascript:void(0)" onclick="install(this)">添加</a>';
		html+='<span class="lr10">|</span>';
		html+='<a href="javascript:void(0)" onclick="removes(this)">删除</a>';
		html+='</td>';
		html+='</tr>';
	
	$("#trlist").append(html);
}	
</script>
</body>
</html> 