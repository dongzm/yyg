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
#category_select span{
	border:1px solid #ccc;
	background:#eee;
	padding:3px;
}
#category_select b{
 color:#f00;cursor:pointer;
}
#category_select input{
	width:0px;border:0px;
}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>

<div class="table_form lr10">
<?php if(ROUTE_A=='edit'){ ?>
<form name="form" action="" method="post">
<table width="100%"  cellspacing="0" cellpadding="0">
	<tr>
    		<td align="right" class="wid100">所属栏目：</td>
			<td>	
				<div id="category_select" style="float:left">	
					<?php 
						foreach($cateid_arr as $cateid){
							$cateid_name = get_category($cateid);
							echo "<span><input name='cateid[]' value='{$cateid}'/>{$cateid_name}<b>&nbsp;×</b></span>&nbsp;";
						}					
					?>
				</div>
				<a style="color:#f00;float:left;"  class="pay_window_show"> 【继续添加所属栏目】 </a>    		
    		</td>
    </tr>
    <tr>
			<td align="right">品牌名称：</td>
			<td><input type="text"  name="name" class="input-text wid100" value="<?php echo $brands['name'] ; ?>"></td>
	</tr>
    <tr>
			<td align="right">排序：</td>
			<td><input type="text"  name="order" onKeyUp="value=value.replace(/[^\d]/ig,'')" class="input-text wid100" value="<?php echo $brands['order'] ; ?>">
            <span>数值越大,排序越靠前</span>
            </td>
	</tr>
    <tr height="60px">
			<td align="right"></td>
			<td><input class="button" type="submit" name="dosubmit" value=" 修改 " /></td>
	</tr>
</form>
</table>
<?php } ?>
<?php if(ROUTE_A=='insert'){ ?>
<form name="form" action="" method="post">
<table width="100%"  cellspacing="0" cellpadding="0">
	<tr>
    		<td align="right" class="wid100">所属栏目：</td>
			<td>
	
				<div id="category_select" style="float:left">					
				</div>
				<a style="color:#f00;float:left;"  class="pay_window_show"> 【添加所属栏目】 </a>
    		</td>			
			
    </tr>
    <tr>
			<td align="right">品牌名称：</td>
			<td><input type="text"  name="name" class="input-text wid100"></td>
	</tr>
    <tr>
			<td align="right">排序：</td>
			<td><input type="text"  name="order" onKeyUp="value=value.replace(/[^\d]/ig,'')" class="input-text wid100">
            <span>数值越大,排序越靠前</span>
            </td>
	</tr>
    <tr height="60px">
			<td align="right"></td>
			<td><input class="button" type="submit" name="dosubmit" value=" 添加 " /></td>
	</tr>
</form>
</table>
<?php } ?>
</div>

<!--期数修改弹出框-->
<style>
#paywindow{position:absolute;z-index:999; display:none}
#paywindow_b{width:372px;height:160px;background:#2a8aba; filter:alpha(opacity=60);opacity: 0.6;position:absolute;left:0px;top:0px; display:block}
#paywindow_c{width:360px;height:138px;background:#fff;display:block;position:absolute;left:6px;top:6px;}
.p_win_title{ line-height:40px;height:40px;background:#f8f8f8;}
.p_win_title b{float:left}
.p_win_title a{float:right;padding:0px 10px;color:#f60}
.p_win_content h1{font-size:25px;font-weight:bold;}
.p_win_but,.p_win_mes,.p_win_ctitle,.p_win_text{ margin:10px 20px;}
.p_win_mes{border-bottom:1px solid #eee;line-height:35px;}
.p_win_mes span{margin-left:10px;}
.p_win_ctitle{overflow:hidden;}
.p_win_x_b{float:left; width:73px;height:68px;background-repeat:no-repeat;}
.p_win_x_t{ font-size:18px; font-weight:bold;font-family: "Helvetica Neue",\5FAE\8F6F\96C5\9ED1,Tohoma;color:#f00; text-align:center}
.p_win_but{ height:40px; line-height:40px;}
.p_win_but a{ padding:8px 15px; background:#f60; color:#fff;border:1px solid #f50; margin:0px 15px;font-family: "Helvetica Neue",\5FAE\8F6F\96C5\9ED1,Tohoma; font-size:15px; }
.p_win_but a:hover{ background:#f50}
.p_win_text a{ font-size:13px; color:#f60}
.pay_window_quit:hover{ color:#f00}
</style>
<div id="paywindow">
	<div id="paywindow_b"></div>
	<div id="paywindow_c">
		<div class="p_win_title"><a href="javascript:void();" class="pay_window_quit">[关闭]</a><b>：：：选择所属分类栏目</b></div>
		<div class="p_win_content">	
			
			<div class="p_win_mes">
            	 <b>选择栏目:</b>
				 　<select id="selectcateid">
					<option value="-1">≡ 请选择分类 ≡</option>
					<?php echo $categoryshtml; ?>
    			</select>	
            </div>
		
            <div class="p_win_mes">    	    	
    			 	 <b>　　　　　</b><input type="button" value=" 确定 " class="button" id="set_select_cateid">          
            </div>	
		</div>
	</div>
</div>


<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script>
$(function(){
	var width = ($(window).width()-572)/2;
	var height = ($(window).height()-460)/2;
	$("#paywindow").css("left",width);
	$("#paywindow").css("top",height);
		
	$(".pay_window_quit").click(function(){
		$("#paywindow").hide();								 
	});
		
	$(".pay_window_show").click(function(){
		$("#paywindow").show();	
	});
		
		
	$("#category_select b").click(function(){			
			$(this).parent().remove();			
	});
	
	var sid_arr = [];
	$("#set_select_cateid").click(function(){
		var select = $("#selectcateid option:selected");	
		var a_html = '<span>&nbsp;<input name="cateid[]" value="'+select.val()+'"/>'+select.text()+'<b>&nbsp;×</b></span>&nbsp;';
	
		if(select.val() == '-1'){
			return false;
		}
		if(sid_arr[select.val()]){
			alert("已经添加");
			return false;
		}
		sid_arr[select.val()] = true;
		$("#category_select").append(a_html);
			
		$("#category_select b").click(function(){
			$(this).parent().remove();
			sid_arr[select.val()] = false;
		});
	
	});
});
</script>
<!--期数修改弹出框-->

</body>
</html> 
