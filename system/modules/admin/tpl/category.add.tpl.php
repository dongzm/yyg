<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo G_PLUGIN_PATH; ?>/uploadify/api-uploadify.js" type="text/javascript"></script>
<style>
iframe{ font-size:36px;}
.con-tab{ margin:10px; color:#444}
.con-tab #tab-i{ margin-left:20px; overflow:hidden; height:27px; _height:28px; }
.con-tab #tab-i li{
	float:left;background:#eaeef4;
	padding:0 8px;border:1px solid #dce3ed;
	height:25px;_height:26px;line-height:26px;
	margin-right:5px;cursor: pointer; position:relative;z-index:0;
}
.con-tab div.con-tabv{
	clear:both; border:1px solid #dce3ed;
	width:100%;
	margin-top:-1px; padding-top:30px;
	background-color:#fff; position:relative; z-index:1;}

#tab-i li.on{ background-color:#fff;color:#444; font-weight:bold; border-bottom:1px solid #fff;  position:relative;z-index:2;}

table th{ border-bottom:1px solid #eee; font-size:12px; font-weight:100; text-align:right; width:200px;}
table td{ padding-left:10px;}
.con-tabv tr{ text-align:left}
input.button{ display:inline-block}
</style>
<script>
var CONFIG = {};
	<?php 
			$goods_list_html  = indexTemplate('/^goods_list\.(.*)\.html/i');
			$article_list_html= indexTemplate('/^article_list\.(.*)\.html/i');			
			$goods_list_htmls = $article_list_htmls = "'";		
			foreach($goods_list_html as $file){
				$goods_list_htmls .= "<option value=\"".$file[0]."\">".$file[0]."</option>";
			}
			foreach($article_list_html as $file){
				$article_list_htmls .= "<option value=\"".$file[0]."\">".$file[0]."</option>";
			}			
			$goods_show_html  = indexTemplate('/^goods_show\.(.*)\.html/i');		
			$article_show_html= indexTemplate('/^article_show\.(.*)\.html/i');			
			$goods_show_htmls = $article_show_htmls = "'";
			foreach($goods_show_html as $file){
				$goods_show_htmls .= "<option value=\"".$file[0]."\">".$file[0]."</option>";
			}
			foreach($article_show_html as $file){
				$article_show_htmls .= "<option value=\"".$file[0]."\">".$file[0]."</option>";
			}		
			echo "CONFIG.goods_list_htmls = ".$goods_list_htmls."';\n";
			echo "CONFIG.article_list_htmls = ".$article_list_htmls."';\n";
			echo "CONFIG.goods_show_htmls = ".$goods_show_htmls."';\n";
			echo "CONFIG.article_show_htmls = ".$article_show_htmls."';\n";
		
	?>
function select_model(T){
	CONFIG.model={};
	CONFIG.model.id = $(T).find("option:selected").val();
	CONFIG.model.name = $(T).find("option:selected").text();
	
	if(CONFIG.model.id=='1'){
		$(".write_template").eq(0).html(CONFIG.goods_list_htmls);
		$(".write_template").eq(1).html(CONFIG.goods_show_htmls);
		$(".write_template_text").eq(0).html(CONFIG.model.name+"列表页模板命名方式　　　<font color=\"red\">goods_list.任意字符.html</font>");
		$(".write_template_text").eq(1).html(CONFIG.model.name+"内容页模板命名方式　　　<font color=\"red\">goods_show.任意字符.html</font>");
	}
	if(CONFIG.model.id=='2'){
		$(".write_template").eq(0).html(CONFIG.article_list_htmls);
		$(".write_template").eq(1).html(CONFIG.article_show_htmls);
		$(".write_template_text").eq(0).html(CONFIG.model.name+"列表页模板命名方式　　　<font color=\"red\">article_list.任意字符.html</font>");
		$(".write_template_text").eq(1).html(CONFIG.model.name+"内容页模板命名方式　　　<font color=\"red\">article_show.任意字符.html</font>");
	}
					
}
</script>


</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table-list con-tab lr10" id="con-tab">
<?php if($catetype=='def'){ ?>
	<ul id="tab-i"><li name="con-tabk">基本选项</li><li name="con-tabk">SEO 设置</li><li name="con-tabk">模板设置</li></ul>
<div name='con-tabv' class="con-tabv">
 <form action="" id="form" method="post" enctype="multipart/form-data">
 <table width="100%" class="table_form">
 <tbody>
		<tr>
        <th width="200">请选择模型：</th>
        <td>		
		 <select name="info[modelid]" class="wid150" onchange="return select_model(this)">
         <option value="">≡ 请选择模型 ≡</option>
         <?php foreach($models as $model){ ?>
         <option value="<?php echo $model['modelid']; ?>"><?php echo $model['name']; ?></option>
         <?php } ?>
         <?php echo $topmodel; ?>
         </select>
         <span><font color="#0c0">※ </font>请选择栏目模型</span>
      </tr>
      <tr>
        <th width="200">上级栏目：</th>
        <td>
		<select name="info[parentid]" class="wid150">
        <option value="">≡ 作为一级栏目 ≡</option>
        <?php echo $categoryshtml; ?>
        </select>
        </td>
      </tr>     
      <tr>
        <th>栏目名称：</th>
        <td><input type="text" name="info[name]" class="input-text wid140" onKeyUp="value=value.replace(/[^\a-\z\A-\Z0-9\u4E00-\u9FA5\_]/g,'')">
        	<span><font color="#0c0">※ </font>请输入栏目名称</span>
		</td>
      </tr>
	<tr>
      <th>英文名称：</th>
        <td><input type="text" name="info[catdir]"  onKeyUp="value=value.replace(/[^\w]/ig,'')" class="input-text wid140">
        <span><font color="#0c0">※ </font>请输入英文名称,请保证唯一性</span> 
      </tr>
      
	<tr>
      <th>栏目图片：</th>
        <td>           
            <input type="text" id="imagetext" name="thumb" class="input-text wid300">
			<input type="button" class="button"
             onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','栏目图片上传','image','cateimg',1,500000,'imagetext')" 
             value="上传图片"/>
        </td>
      </tr>
	<tr>
   	 	<th style="border-bottom:0px;">描述：</th>
   	 	<td style="border-bottom:0px;">
        <textarea name="info[description]"  maxlength="255" class="overflow" style="width:300px;height:60px;"></textarea></td>
    </tr>
</tbody>
</table>
  </div>
    <div name='con-tabv' class="con-tabv">
  	<table width="100%" class="table_form ">
	<tbody><tr>
      <th width="200">META Title（栏目标题）<br>针对搜索引擎设置的标题</th>
      <td><input name="setting[meta_title]" type="text" id="meta_title" value="" size="60" maxlength="60" class="input-text"></td>
    </tr>
    <tr>
      <th>META Keywords（栏目关键词）<br>关键字中间用半角逗号,隔开</th>
      <td><textarea name="setting[meta_keywords]" id="meta_keywords" style="width:90%;height:40px"></textarea></td>
    </tr>
    <tr>
      <th>META Description（栏目描述）<br>针对搜索引擎设置的网页描述</th>
      <td><textarea name="setting[meta_description]" id="meta_description" style="width:90%;height:50px"></textarea></td>
    </tr>
</tbody></table>
    </div>
	<!-- 模板选择 -->
	    <div name='con-tabv' class="con-tabv">
  	<table width="100%" class="table_form ">
	<tbody>
      <th width="200">选择栏目列表页模板：</th>
      <td style="margin:10px;">
        <select name="info[template_list]" class="write_template"></select>	
      </td>
	  <td>
	  <b style="margin-left:20px" class="write_template_text"></b>
	  </td>
    </tr>
	    <tr>
      <th width="200">选择栏目内容页模板：</th>
      <td style="margin:10px;">
        <select name="info[template_show]" class="write_template"></select>
      </td>
	  <td>
		<b style="margin-left:20px" class="write_template_text"></b>
	  </td>
    </tr>	
    </tbody></table>
    </div> 
	<!-- /模板选择 -->
<?php } ?>
<?php if($catetype=='danweb'){ ?>
	<ul id="tab-i">
    <li name="con-tabk">单网页选项</li>
    <li name="con-tabk">SEO 设置</li>
    <li name="con-tabk">选择模板</li>
    <li name="con-tabk">网页内容</li>
    </ul>
<div name='con-tabv' class="con-tabv"> 
<form id="form" method="post" enctype="multipart/form-data">
 <table width="100%" class="table_form">
 <tbody>
      <tr>
        <th width="200">上级栏目：</th>
        <td>
		<select name="info[parentid]" id="parentid">
        <option value="0">≡ 作为一级栏目 ≡</option>
        <?php echo $categoryshtml; ?>
        </select></td>
      </tr>     
      <tr>
        <th>栏目名称：</th>
        <td><input type="text" name="info[name]" class="input-text" 
        onKeyUp="value=value.replace(/[^\a-\z\A-\Z0-9\u4E00-\u9FA5\_]/g,'')">
        	<span><font color="#0c0" size="">※ </font>请输入栏目名称</span>
		</td>
      </tr>
	<tr id="catdir_tr">
      <th>英文目录：</th>
        <td><input type="text" name="info[catdir]" onKeyUp="value=value.replace(/[^\w]/ig,'')" class="input-text">
        <span><font color="#0c0" size="">※ </font>请输入英文名称,请保证唯一性</span> 
      </tr>
      
	<tr>
      <th>栏目图片：</th>
        <td>
           	 <input type="text" id="imagetext" name="thumb" class="input-text wid300">
			<input type="button" class="button"
             onClick="GetUploadify('<?php echo WEB_PATH; ?>','uploadify','栏目图片上传','image','cateimg',1,500000,'imagetext')" 
             value="上传图片"/>
        </td>
      </tr>
	<tr>
   	 	<th style="border-bottom:0px;">描述：</th>
   	 	<td style="border-bottom:0px;"><textarea name="info[description]"  maxlength="255" style="width:300px;height:60px;"></textarea></td>
    </tr>
</tbody>
</table>
</div>
    <div name='con-tabv' class="con-tabv">
  	<table width="100%" class="table_form ">
	<tbody><tr>
      <th width="200">META Title（栏目标题）<br>针对搜索引擎设置的标题</th>
      <td><input name="setting[meta_title]" type="text" id="meta_title" value="" size="60" maxlength="60" class="input-text"></td>
    </tr>
    <tr>
      <th>META Keywords（栏目关键词）<br>关键字中间用半角逗号,隔开</th>
      <td><textarea name="setting[meta_keywords]" id="meta_keywords" style="width:90%;height:40px"></textarea></td>
    </tr>
    <tr>
      <th>META Description（栏目描述）<br>针对搜索引擎设置的网页描述</th>
      <td><textarea name="setting[meta_description]" id="meta_description" style="width:90%;height:50px"></textarea></td>
    </tr>
</tbody></table>
    </div>
    <div name='con-tabv' class="con-tabv">
  	<table width="100%" class="table_form ">
	<tbody>
    <tr>
      <th width="200">选择单网页模板：</th>
      <td style="margin:10px;">
      <select name="info[template]">
           <?php 
		   		if($htmlarr=indexTemplate('/single_web\.(.*)\.html/i')){
					foreach($htmlarr as $html){
			?>
            <option value="<?php echo $html[0]; ?>"><?php echo $html[0]; ?></option>
            <?php }} ?>	

        </select>
      </td>
    </tr>
    </tbody></table>
    </div> 
    <div name='con-tabv' class="con-tabv">
		<div style="display:block; position:relative; margin-top:-31px; margin-bottom:-1px; margin-left:-1px;">		
            <script id="myeditor" type="text/plain"></script>
            <textarea name="setting[content]" id="settingcontent" style="display:none"></textarea>
        </div>
    </div> 
<?php } ?>

<?php if($catetype=='link'){ ?>
	<ul id="tab-i"><li name="con-tabk">外部链接</li></ul>
	<div name='con-tabv' class="con-tabv">
    <form id="form" method="post">
 	<table width="100%" class="table_form">
	 <tbody>
         <tr>
        <th width="200">上级栏目：</th>
        <td>
		<select name="info[parentid]" id="parentid">
        <option value="0">≡ 作为一级栏目 ≡</option>
        <?php echo $categoryshtml; ?>
        </select></td>
      </tr>     
      <tr>
        <th>栏目名称：</th>
        <td><input type="text" name="info[name]" class="input-text" 
        onKeyUp="value=value.replace(/[^\a-\z\A-\Z0-9\u4E00-\u9FA5\_]/g,'')">
        	<span><font color="#0c0" size="">※ </font>请输入栏目名称</span>
		</td>
      </tr>
	<tr id="catdir_tr">
      <th>链接地址：</th>
        <td><input type="text" name="info[url]" class="input-text wid300">
        <span><font color="#0c0" size="">※ </font>请输入链接地址,如：http://www.qq.com/</span> 
      </tr>      
	</table>
    </div>
<?php } ?>
</div>
<!--table-list end-->

   <div class="table-button lr10">
    	  <input type="button" value=" 提交 " onClick="checkform();" class="button">
    	</form>
   </div>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/GgTab.js"></script>
<script type="text/javascript">
Gg.Tab({i:"li con-tabk ~on",o:"div con-tabv",events:"click",num:1});

function upImage(){
	return document.getElementById('imgfield').click();
}
<?php if($catetype=='def'){ ?>
function checkform(){
	var form=document.getElementById('form');
	var error=null;	
	if(form.elements[0].value==''){error='请选择栏目模型!';}
	if(form.elements[2].value==''){error='请输入栏目名称!';}
	if(form.elements[3].value==''){error='请输入英文目录名称!';}
	if(error!=null){window.parent.message(error,8,2);return false;}
	form.submit();	
}
<?php } ?>
<?php if($catetype=='danweb'){ ?>
function checkform(){
	var form=document.getElementById('form');
	var error=null;	
	if(form.elements[0].value==''){error='请选择栏目模型!';}
	if(form.elements[1].value==''){error='请输入栏目名称!';}
	if(form.elements[2].value==''){error='请输入英文目录名称!';}
	if(form.elements[9].value==''){error='请选择栏目模板!';}
	if(error!=null){window.parent.message(error,8,2);return false;}
	var Content=getContent();
	document.getElementById('settingcontent').value=Content;
	form.submit();	
}
<?php } ?>
<?php if($catetype=='link'){ ?>
function checkform(){
	var form=document.getElementById('form');
	var error=null;	
	if(form.elements[1].value==''){error='请输入栏目名称!';}
	if(form.elements[2].value==''){error='请输入链接地址!';}
	if(error!=null){window.parent.message(error,8,2);return false;}
	form.submit();	
}
<?php } ?>

</script>
<?php if($catetype=='danweb'){ ?>
<script type="text/javascript">
var editurl=Array();
editurl['editurl']='<?php echo G_PLUGIN_PATH; ?>/ueditor/';
editurl['imageupurl']='<?php echo G_ADMIN_PATH; ?>/ueditor/upimage/';
editurl['imageManager']='<?php echo G_ADMIN_PATH; ?>/ueditor/imagemanager';
</script>
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript">
window.UEDITOR_CONFIG.initialContent="输入栏目内容...";
window.UEDITOR_CONFIG.initialFrameWidth='';
window.UEDITOR_CONFIG.initialFrameHeight=450;
</script>
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript">
    //实例化编辑器
    var ue = UE.getEditor('myeditor');
    ue.addListener('ready',function(){
        this.focus()
    });
    function getContent() {
        return ue.getContent();
    }
    function hasContent() {
        var arr = [];
        arr.push( "使用editor.hasContents()方法判断编辑器里是否有内容" );
        arr.push( "判断结果为：" );
        arr.push(  UE.getEditor('myeditor').hasContents() );
        alert( arr.join( "\n" ) );
    }
</script>
<?php } ?>
</body>
</html> 