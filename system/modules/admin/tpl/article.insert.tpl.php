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
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo G_PLUGIN_PATH; ?>/uploadify/api-uploadify.js" type="text/javascript"></script> 
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
</style>
</head>
<body>
<div class="header-title lr10">
	<?php //echo $this->headerment();?>
    <b>添加文章</b>
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<form method="post" action="">
	<table width="100%"  cellspacing="0" cellpadding="0">
		<tr>
			<td align="right" width="120"><font color="red">*</font>所属分类：</td>
			<td>            
				<select name="cateid">               
                <?php echo $categoryshtml; ?>                
                </select>            	
            </td>
		</tr>        
		<tr>
			<td align="right"><font color="red">*</font>文章标题：</td>
			<td><input  type="text"  name="title" id="title" onKeyUp="return gbcount(this,100,'texttitle');"  class="input-text wid400 bg">
           <input type="hidden" name="title_style_color" id="title_style_color"/>
            <input type="hidden" name="title_style_bold" id="title_style_bold"/>
            <script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/colorpicker.js"></script>
            <img src="<?php echo G_GLOBAL_STYLE; ?>/global/image/colour.png" width="15" height="16" onClick="colorpicker('title_colorpanel','set_title_color');" style="cursor:hand"/>
             <img src="<?php echo G_GLOBAL_STYLE; ?>/global/image/bold.png" onClick="set_title_bold();" style="cursor:hand"/>
            <span style="margin-left:10px">还能输入<b id="texttitle">100</b>个字符</span>
            </td>
		</tr>
        <tr>
			<td align="right">作者：</td>
			<td><input  type="text"  name="zuoze" class="input-text wid100" /></td>
		</tr>
        <tr>
			<td align="right">关键字：</td>
			<td><input type="text" name="keywords"  name="title"  class="input-text wid400">
            <span>多个关键字请用   ,  号分割开</span>
            </td>
		</tr>
        <tr>
			<td align="right">摘要：</td>
			<td><textarea name="description" class="wid400" onKeyUp="gbcount(this,250,'textdescription');" style="height:60px"></textarea><br> <span>还能输入<b id="textdescription">250</b>个字符</span>
            </td>
		</tr>
     <tr>
      <td align="right">缩略图：</td>
        <td>
           	<input type="text" id="imagetext" name="thumb" class="input-text wid300">
			<input type="button" class="button"
             onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','缩略图上传','image','photo',1,500000,'imagetext')" 
             value="上传图片"/>
			
        </td>
      </tr>
		<tr>
			<td height="300"  align="right"><font color="red">*</font>内容详情：</td>
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
                <label><input name="sub_text_des" type="checkbox"  value="off" checked />是否截取内容</label>
                <input type="text" name="sub_text_len" class="input-text" value="250" size="3">字符至内容摘要<label>         
            	</div>
            </td>  
		</tr>        
        <tr>
			<td height="124" align="right">组　图：</td>
			<td><fieldset class="uploadpicarr">
					<legend>列表</legend>
					<div class="picarr-title">最多可以上传<strong>50</strong> 张图片 <a onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','缩略图上传','image','photo',50,500000,'uppicarr')" style="color:#ff0000; padding:10px;">  <input type="button" class="button" value="开始上传" /></a>
                    </div>
					<ul id="uppicarr" class="upload-img-list"></ul>
				</fieldset>
             </td>
		</tr>
       <tr>
			<td align="right">发布时间：</td>
			<td>           
            	<input name="posttime" type="text" id="posttime" value="<?php echo date("Y-m-d H:i:s"); ?>" class="input-text posttime"  readonly="readonly" />
				<script type="text/javascript">
				date = new Date();
				Calendar.setup({
					inputField     :    "posttime",
					ifFormat       :    "%Y-%m-%d %H:%M:%S",
					showsTime      :    true,
					timeFormat     :    "24"
				});
				</script></td>             
		</tr> 
        <tr>
			<td align="right">点击量：</td>
            <td><input type="text" name="hit" class="input-text wid50" value="<?php echo rand(1,100); ?>"/></td>
			<td>
            </td>             
		</tr>         
        <tr height="60px">
			<td align="right"></td>
			<td><input type="submit" name="dosubmit" class="button" value="添加文章" /></td>
		</tr>
	</table>
</form>
</div>
<span id="title_colorpanel" style="position:absolute; left:568px; top:115px" class="colorpanel"></span>
<script type="text/javascript">
    //实例化编辑器
    var ue = UE.getEditor('myeditor');
    ue.addListener('ready',function(){
        this.focus()
    });
	
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
	$('#title').css('color',color);
	$('#title_style_color').val(color);
}

function set_title_bold(){
	if($('#title_style_bold').val()=='bold'){
		$('#title_style_bold').val('');	
		$('#title').css('font-weight','');
	}else{
		$('#title').css('font-weight','bold');
		$('#title_style_bold').val('bold');
	}
}

	//API JS
	//window.parent.api_off_on_open('open');
</script>
</body>
</html> 