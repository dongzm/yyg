<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>

<script src="<?php echo G_PLUGIN_PATH; ?>/uploadify/api-uploadify.js" type="text/javascript"></script> 

<script type="text/javascript" charset="utf-8" src="<?php echo G_TEMPLATES_JS; ?>/area_city.js"></script>

<script type="text/javascript">
var opt0 =["省份","地级市","市、县级市"];//初始值
</script>

<style>
table th{ border-bottom:1px solid #eee; font-size:12px; font-weight:100; text-align:right; width:200px;}
table td{ padding-left:10px;}
input.button{ display:inline-block}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<!--start-->
<form name="myform" action="" method="post" enctype="multipart/form-data">
  <table width="100%" cellspacing="0">
		<tr>
			<td width="120" align="right">QQ群号:</td>
			<td>
				<input type="text" id="qq" name="qq" value="" class="input-text wid300" />
			</td>
		</tr>
		<tr>
			<td width="120" align="right">加群代码:</td>
			<td>
				<textarea id="qqurl" name="qqurl" class="input-text wid300" style="height:70px;"></textarea><br>(请填写QQ群推广代码里面的href 链接，如：http://shang.qq.com/wpa/qunwpa?idkey=123456789g4gregrekgeogjjnf3ekfjejfjfoefjefeffe)
			</td>
		</tr>
		 <tr>
			<td width="120" align="right">QQ群名称:</td>
			<td>
				<input type="text" id="name" name="name" value="" class="input-text wid300" />
			</td>
		</tr>		

		<tr>
			<td width="120" align="right">QQ群是否已满:</td>
			<td>
				<input type="radio" id="full" name="full" value="已满">已满
				<input type="radio" id="full" name="full" value="未满" checked="checked">未满
			</td>
		</tr>
		<tr>
			<td width="120" align="right">类&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;型:</td>
			<td>
			  <select id="qqtype" name="qqtype" STYLE="width:100px;" >
			    <option value="直属群">直属群</option>
				<option value="地方群">地方群</option>
				</select>				
			</td>
		</tr>
		<tr id="cityarea"  style="display:none">
			<td width="120" align="right">所属地址:</td>
			<td>
			   <select id="s_province" name="s_province" STYLE="width:100px;">
			   
				</select>省	
				<select id="s_city" name="s_city" STYLE="width:100px;">
			   
				</select>市

				<select id="s_county" name="s_county" STYLE="width:100px;">
			    
				</select>区  
				<script class="" src="<?php echo G_TEMPLATES_JS; ?>/area_city.js" type="text/javascript"></script>		
				<script type="text/javascript">_init_area(opt0);</script>
			</td>
		</tr>
		
		   <!-- <tr>
        	<td width="120" align="right">图片:</td>
            <td>	
            <img height="50px" src=""/>
            <input type="text" name="image" id="imagetext" value="" id="imagetext" class="input-text wid300">
			<input type="button" class="button"
             onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','缩略图上传','image','banner',1,500000,'imagetext')" 
             value="上传图片"/>
            </td>
        </tr> -->

		<tr>
        	<td width="120" align="right"></td>
            <td>		
            <input type="submit" class="button" name="submit" value="提交" >
            </td>
		</tr>
</table>
</form>
</div><!--table-list end-->

<script>
function upImage(){
	return document.getElementById('imgfield').click();
}


//选择区域
$(function(){
var a=$("#qqtype").val();
  $("#qqtype").click(function(){
     var v=$(this).val();
	 	 a=v;
	 if(v=='直属群'){
	    $("#cityarea").hide();
	 }else{
	    $("#cityarea").show();
	 }
	 $(this).val(v);
  });
  
  var b=$("#s_province").val();
  var c=$("#s_city").val();
  var d=$("#s_county").val();
  $("#s_province").click(function(){
    var v=$(this).val();
	 b=v;
  });  
  
  $("#s_city").click(function(){
    var v=$(this).val();
	 c=v;
  });  
  
  $("#s_county").click(function(){
    var v=$(this).val();
	 d=v;
  });
 $(".button").click(function(){
    if(a=='地方群'){
	   if(b=='省份'){
	     alert("请选择省份！");
		  return false;	   
	   }else if(c=='地级市'){
	     alert("请选择地级市！");
		  return false;	
	   }else if(d=='市、县级市'){
	     alert("请选择市、县级市！");
		  return false;	
	   }
	}
 });


})

</script>
</body>
</html> 