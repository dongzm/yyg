<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo G_PLUGIN_PATH; ?>/uploadify/api-uploadify.js" type="text/javascript"></script> 
<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css"> 
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
<script type="text/javascript">
var editurl=Array();
editurl['editurl']='<?php echo G_PLUGIN_PATH; ?>/ueditor/';
editurl['imageupurl']='<?php echo G_ADMIN_PATH; ?>/ueditor/upimage/';
editurl['imageManager']='<?php echo G_ADMIN_PATH; ?>/ueditor/imagemanager';
</script>
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/ueditor/ueditor.all.min.js"></script>
<style>
	.bg{background:#fff url(<?php echo G_GLOBAL_STYLE; ?>/global/image/ruler.gif) repeat-x scroll 0 9px }
	.color_window_td a{ float:left; margin:0px 10px;}
</style>
</head>
<body>
<script>
$(function(){
	$("#category").change(function(){ 
	var parentId=$("#category").val(); 
	if(null!= parentId && ""!=parentId){ 
		$.getJSON("<?php echo WEB_PATH; ?>/api/brand/json_brand/"+parentId,{cid:parentId},function(myJSON){
		var options="";
		if(myJSON.length>0){ 			
			//options+='<option value="0">≡ 请选择品牌 ≡</option>'; 
			for(var i=0;i<myJSON.length;i++){ 
				options+="<option value="+myJSON[i].id+">"+myJSON[i].name+"</option>"; 
			} 
			$("#brand").html(options);		} 
		}); 
	}  
	}); 	
}); 

function CheckForm(){
	var money = parseInt($("#money").val());
		if(money >= 100000){
			window.parent.message("价格大于10万，商品添加会很慢,请耐心等待，不要关闭窗口!",1,5);
		}	
		return true;
}
</script>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<form method="post" action="" onSubmit="return CheckForm()">
	<table width="100%"  cellspacing="0" cellpadding="0">
		<tr>
			<td align="right" style="width:120px"><font color="red">*</font>所属分类：</td>
			<td>
            <select id="category" name="cateid">           
                <?php echo $categoryshtml; ?>                
             </select> 
            </td>
		</tr>
        <tr>
			<td align="right" style="width:120px"><font color="red">*</font>所属品牌：</td>
			<td>
            	<select id="brand" name="brand">
                	<option value="0">≡ 请选择品牌 ≡</option>
				</select>
			</td>
		</tr> 
               
        <tr>
			<td align="right" style="width:120px"><font color="red">*</font>商品标题：</td>
			<td>
            <input  type="text" id="title"  name="title" onKeyUp="return gbcount(this,100,'texttitle');"  class="input-text wid400 bg">

            <span style="margin-left:10px">还能输入<b id="texttitle">100</b>个字符</span>
           
            </td>
		</tr>
        <tr>
			<td align="right" style="width:120px">副标题：</td>
			<td><input  type="text" id="title2" name="title2" onKeyUp="return gbcount(this,100,'texttitle2');"  class="input-text wid400">
			<input type="hidden" name="title_style_color" id="title_style_color"/>
            <input type="hidden" name="title_style_bold" id="title_style_bold"/>
            <script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/colorpicker.js"></script>
            <img src="<?php echo G_GLOBAL_STYLE; ?>/global/image/colour.png" width="15" height="16" onClick="colorpicker('title_colorpanel','set_title_color');" style="cursor:hand"/>
             <img src="<?php echo G_GLOBAL_STYLE; ?>/global/image/bold.png" onClick="set_title_bold();" style="cursor:hand"/>
            <span class="lr10">还能输入<b id="texttitle2">100</b>个字符</span>
            </td>
		</tr>
        <tr>
			<td align="right" style="width:120px">关键字：</td>
			<td><input type="text" name="keywords"  name="title"  class="input-text wid300" />
            <span class="lr10">多个关键字请用   ,  号分割开</span>
            </td>
		</tr>
        <tr>
			<td align="right" style="width:120px">商品描述：</td>
			<td><textarea name="description" class="wid400" onKeyUp="gbcount(this,250,'textdescription');" style="height:60px"></textarea><br /> <span>还能输入<b id="textdescription">250</b>个字符</span>
            </td>
		</tr>      
		<tr style="background-color:#FFC">
			<td style="width:120px"></td>
			<td>
				<b>提示：</b> <font color="red">商品总价格请不要填写100，2300,5000这样的整数,整数价格计算出的幸运码可能就为10000001</font><br />
				<b>提示：</b> 商品价格过大，添加商品会变慢，请耐心等待！
			</td>
		</tr>
		<tr>
			<td align="right" style="width:120px"><font color="red">*</font>商品总价格：</td>
			<td><input type="text" id="money"  name="money" onKeyUp="value=value.replace(/\D/g,'')" style="width:65px; padding-left:0px; text-align:center" class="input-text">元</td>
		</tr>
		<tr>
			<td align="right" style="width:120px"><font color="red">*</font>单次价格：</td>
			<td><input type="text" name="yunjiage" onKeyUp="value=value.replace(/\D/g,'')" style="width:65px;padding-left:0px;text-align:center" class="input-text" value="1">元</td>
		</tr>
        <tr>      
			<td align="right" style="width:120px"><font color="red">*</font>最大期数：</td>     
            <td><input type="text" name="maxqishu" value="100" class="input-text" style="width:65px; padding-left:0px; text-align:center" onKeyUp="value=value.replace(/\D/g,'')">期,	&nbsp;&nbsp;&nbsp;期数上限为65535期,每期揭晓后会根据此值自动添加新一期商品！</td>
		</tr>	
        
        <tr>
         <td align="right" style="width:120px"><font color="red">*</font>缩略图：</td>
        <td>
        	<img src="<?php echo G_UPLOAD_PATH; ?>/photo/goods.jpg" style="border:1px solid #eee; padding:1px; width:50px; height:50px;">
           	<input type="text" id="imagetext" name="thumb" value="photo/goods.jpg" class="input-text wid300">
			<input type="button" class="button"
             onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','缩略图上传','image','shopimg',1,500000,'imagetext')" 
             value="上传图片"/>
			
        </td>
      </tr>
        <tr>
			<td align="right" style="width:120px">展示图片：</td>            
			<td><fieldset class="uploadpicarr">
					<legend>列表</legend>
					<div class="picarr-title">最多可以上传<strong>10</strong> 张图片 <a onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','缩略图上传','image','shopimg',10,500000,'uppicarr')" style="color:#ff0000; padding:10px;">  <input type="button" class="button" value="开始上传" /></a>
                    </div>
					<ul id="uppicarr" class="upload-img-list"></ul>
				</fieldset>
             </td>           
		</tr>        
		<tr>
        	<td height="300" style="width:120px"  align="right"><font color="red">*</font>商品内容详情：</td>
			<td><script name="content" id="myeditor" type="text/plain"></script>
            	<style>
				.content_attr {
					border: 1px solid #CCC;
					padding: 5px 8px;
					background: #FFC;
					margin-top: 6px;
					width:915px;
				}
				</style>
                <div class="content_attr">
                <label><input name="sub_text_des" type="checkbox"  value="off" checked>是否截取内容</label>
                <input type="text" name="sub_text_len" class="input-text" value="250" size="3">字符至内容摘要<label>         
            	</div>
            </td>        
		</tr> 
        <tr>
        	<td align="right" style="width:120px">商品属性：</td>
            <td width="900">
			 <input name="goods_key[pos]" value="1" type="checkbox" />&nbsp;推荐&nbsp;&nbsp;
			 <input name="goods_key[renqi]" value="1" type="checkbox" />&nbsp;人气&nbsp;&nbsp; 
			 
            </td>          
        </tr>    

		
       	<tr>
			<td align="right" style="width:120px">限时揭晓：</td>
			<td>
            
             选择日期：
              <input name="xsjx_time" type="text" id="xsjx_time" class="input-text posttime"  readonly="readonly" />
				<script type="text/javascript">
				date = new Date();
				Calendar.setup({
					inputField     :    "xsjx_time",
					ifFormat       :    "%Y-%m-%d",
					showsTime      :    true,
					timeFormat     :    "24"
				});
				</script>
             <label><input name="xsjx_time_h" type="radio" value="36000" checked> 上午10点 </label>           
             <label><input name="xsjx_time_h" type="radio" value="54000"> 下午3点 </label>
             <label><input name="xsjx_time_h" type="radio" value="79200"> 晚上10点 </label>  
              <span class="lr10">&nbsp;</span>	<b>不选择时间则不参与限时揭晓, 本期揭晓后自动添加的下一期不是限时揭晓商品！</b>         
            </td>        
		</tr>
        <tr height="60px">
			<td align="right" style="width:120px"></td>
			<td><input type="submit" name="dosubmit" class="button" value="添加商品" /></td>
		</tr>
	</table>
</form>
</div>
 <span id="title_colorpanel" style="position:absolute; left:568px; top:155px" class="colorpanel"></span>
<script type="text/javascript">
    //实例化编辑器
    var ue = UE.getEditor('myeditor');

    ue.addListener('ready',function(){
        this.focus()
    });
    function getContent() {
        var arr = [];
        arr.push( "使用editor.getContent()方法可以获得编辑器的内容" );
        arr.push( "内容为：" );
        arr.push(  UE.getEditor('myeditor').getContent() );
        alert( arr.join( "\n" ) );
    }
    function hasContent() {
        var arr = [];
        arr.push( "使用editor.hasContents()方法判断编辑器里是否有内容" );
        arr.push( "判断结果为：" );
        arr.push(  UE.getEditor('myeditor').hasContents() );
        alert( arr.join( "\n" ) );
    }
	
	var info=new Array();
    function gbcount(message,maxlen,id){
		
		if(!info[id]){
			info[id]=document.getElementById(id);
		}			
        var lenE = message.value.length;
        var lenC = 0;
        var enter = message.value.match(/\r/g);
        var CJK = message.value.match(/[^\x00-\xff]/g);//计算中文
        if (CJK != null) lenC += CJK.length;
        if (enter != null) lenC -= enter.length;		
		var lenZ=lenE+lenC;		
		if(lenZ > maxlen){
			info[id].innerHTML=''+0+'';
			return false;
		}
		info[id].innerHTML=''+(maxlen-lenZ)+'';
    }
	
function set_title_color(color) {
	$('#title2').css('color',color);
	$('#title_style_color').val(color);
}
function set_title_bold(){
	if($('#title_style_bold').val()=='bold'){
		$('#title_style_bold').val('');	
		$('#title2').css('font-weight','');
	}else{
		$('#title2').css('font-weight','bold');
		$('#title_style_bold').val('bold');
	}
}

//API JS
//window.parent.api_off_on_open('open');
</script>
</body>
</html> 