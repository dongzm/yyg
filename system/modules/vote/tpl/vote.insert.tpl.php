<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>phpcms V9 - 后台管理中心</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<link href="<?php echo G_TEMPLATES_CSS; ?>/vote/table_form.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css"> 
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>

	
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/vote/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/vote/admin_common.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/vote/styleswitch.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/vote/formvalidator.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/vote/formvalidatorregex.js" charset="UTF-8"></script>

<script language="javascript" type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/selecttime.js" charset="UTF-8"></script>


<script type="text/javascript">
	/* window.focus();
	var pc_hash = 'fyBuOe';
			window.onload = function(){
		var html_a = document.getElementsByTagName('a');
		var num = html_a.length;
		for(var i=0;i<num;i++) {
			var href = html_a[i].href;
			if(href && href.indexOf('javascript:') == -1) {
				if(href.indexOf('?') != -1) {
					html_a[i].href = href+'&pc_hash='+pc_hash;
				} else {
					html_a[i].href = href+'?pc_hash='+pc_hash;
				}
			}
		}

		var html_form = document.forms;
		var num = html_form.length;
		for(var i=0;i<num;i++) {
			var newNode = document.createElement("input");
			newNode.name = 'pc_hash';
			newNode.type = 'hidden';
			newNode.value = pc_hash;
			html_form[i].appendChild(newNode);
		}
	} */



</script>
</head>
<body>
<style type="text/css">
	html{_overflow-y:scroll}
</style><script type="text/javascript">
/*<!--
	$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
	$("#subject_title").formValidator({onshow:"请输入投票标题",onfocus:"请输入投票标题"}).inputValidator({min:1,onerror:"请输入投票标题"}).regexValidator({regexp:"notempty",datatype:"enum",param:'i',onerror:"输入内容请勿带空格"}).ajaxValidator({type : "get",url : "",data :"m=vote&c=vote&a=public_name",datatype : "html",async:'false',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "投票标题已存在。",onwait : "正在连接，请稍候。"});
	$("#option1").formValidator({onshow:"请输入投票选项",onfocus:"请输入投票选项"}).inputValidator({min:1,onerror:"请输入投票选项"}).regexValidator({regexp:"notempty",datatype:"enum",param:'i',onerror:"输入内容请勿带空格"});
	$("#option2").formValidator({onshow:"请输入投票选项",onfocus:"请输入投票选项"}).inputValidator({min:1,onerror:"请输入投票选项"}).regexValidator({regexp:"notempty",datatype:"enum",param:'i',onerror:"输入内容请勿带空格"});
	$("#fromdate").formValidator({onshow:"请选择上线时间",onfocus:"请选择上线时间",oncorrect:"日期合法"}).inputValidator();
	$("#todate").formValidator({onshow:"请选择下线时间",onfocus:"请选择下线时间",oncorrect:"日期合法"}).inputValidator();
	$('#style').formValidator({onshow:"选择风格",onfocus:"选择风格",oncorrect:"选择正确"}).inputValidator({min:1,onerror:"选择风格"});	
	});*/
//-->
function trim(s){
	if(s.length>0){
	if(s.charAt(0)==" ")
	s=s.substring(1,s.length);
	if(s.charAt(s.length-1)==" ")
	s=s.substring(0,s.length-1);
	 
	if(s.charAt(0)==" "||s.charAt(s.length-1)==" ")
	return trim(s);
}
return s;
} 


$(function(){
	$("form").submit(function(){	  
		var title=$("#title").val();
		 
		 trim(title);
		 if(title==false){
		    alert("标题不能为空");
			return false;
		}else{
		   return true;
		}
	}
  );
})
</script>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="pad_10">
<form action="" method="post" enctype="multipart/form-data" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">

	<tr>
		<th width="100">投票标题 :</th>
		<td><input type="text" name="title" id="title"
			size="30" class="input-text"><font color="red"  >*必填*</font></td>
	</tr>

	<tr>
		<th width="20%">投票选项 :</th>
		<td>
		<input type="button" id="addItem" value="增加选项" class="button" onclick="add_option()">

		<div id="option_list_1">
		<div><br> <input type="text"
			name="option[]" id="option1" size="40" require="true"
			id="opt1"/><font color="red">*至少填一项*</font></div>

		<div><br>
		<input type="text"
			name="option[]" id="option2"  size="40"
			id="opt2" /></div>

		</div>
		
		<div id="new_option"></div>


		</td>
	</tr>

    

	<tr>
		<th>上线时间 :</th>
		<td><input type="text" name="starttime" class="input-text posttime" id="starttime" readonly  /> <font color="red">*必选*</font></td>
		<script type="text/javascript">
				date = new Date();
				Calendar.setup({
					inputField     :    "starttime",
					ifFormat       :    "%Y-%m-%d",
					showsTime      :    true,
					timeFormat     :    "24"
});</script>
	</tr>
	<tr>
		<th>下线时间 :</th>
		<td><input type="text" name="endtime" id="endtime" class="input-text posttime" readonly /><font color="red">*必选*</font></td><script type="text/javascript">
				date = new Date();
				Calendar.setup({
					inputField     :    "endtime",
					ifFormat       :    "%Y-%m-%d",
					showsTime      :    true,
					timeFormat     :    "24"
});</script>
	</tr>
	<tr>
		<th>投票介绍：</th>
		<td><textarea name="description" id="description" cols="60"
			rows="6"></textarea></td>
	</tr>


	<tr>
		<th>查看投票结果：</th>
		<td><input name="allowview" type="radio" value="1" checked>&nbsp;允许&nbsp;&nbsp;<input
			name="allowview" type="radio" value="0">&nbsp;不允许</td>
	</tr>
	<tr>
		<th>允许游客投票：</th>
		<td><input name="allowguest" type="radio" value="1" >&nbsp;是&nbsp;&nbsp;<input
			name="allowguest" type="radio" value="0" checked>&nbsp;否</td>
	</tr>
 
	
	<tr>
		<th>投票时间间隔： </th>
		<td> <input type="text" name="interval" value="" size='5' /> N天后可再次投票，<font color=red>0</font> 表示此IP地址只能投一次</td>
	</tr>
	
	 
	<tr>
		<th>是否启用：</th>
		<td><input name="enabled" type="radio" value="1" >&nbsp;是&nbsp;&nbsp;<input
			name="enabled" type="radio" value="0" checked>&nbsp;否</td>
	</tr>

<tr>
		<th></th>
		<td>
 
<input type="submit" name="submit" id="submit" 
		value=" 提交 "></td>
	</tr>

</table>
</form>
</div>
</body>
</html>

<script language="javascript" type="text/javascript">
function AdsType(adstype) {
	$('#SizeFormat').css('display', 'none');
	if(adstype=='0') {
		
	} else if(adstype=='1') {
		$('#SizeFormat').css('display', '');
	}
}
$('#AlignBox').click( function (){
	if($('#AlignBox').attr('checked')) {
		$('#PaddingLeft').attr('disabled', true);
		$('#PaddingTop').attr('disabled', true);
	} else {
		$('#PaddingLeft').attr('disabled', false);
		$('#PaddingTop').attr('disabled', false);
	}
}); 
</script>

<script language="javascript">
var i = 1;
function add_option() {
	//var i = 1;
	var htmloptions = '';
	htmloptions += '<div id='+i+'><span><br><input type="text" name="option[]" size="40" msg="必填" value="" class="input-text"/><input type="button" value="删除"  onclick="del('+i+')" class="button"/><br></span></div>';
	$(htmloptions).appendTo('#new_option'); 
	var htmloptions = '';
	i = i+1;
}
function del(o){
 $("div [id=\'"+o+"\']").remove();	
}

/* function load_file_list(id) {
	$.getJSON('?m=admin&c=category&a=public_tpl_file_list&style='+id+'&module=vote&templates=vote_tp&name=vote_subject&pc_hash='+pc_hash, function(data){$('#show_template').html(data.vote_tp_template);});
} */
</script>