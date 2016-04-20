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
a.tag_bl{ margin-left:10px;line-height:30px; color:#666; border:1px dashed #ccc; padding:4px}
</style>
</head>
<body>
<div class="header-title lr10">
	<b>新建标签</b> 	
    <span style="color:#f60; padding-left:30px;">调用方式: 在您的模板里面插入 <strong>{wc:block name="你的标签名"}</strong> 即可调用</span>
</div>
<div class="bk10"></div>
<div class="bk10"></div>
<div class="table-form lr10">
	<form name="form" action="#" method="post">
    <?php if (ROUTE_A == 'create'): ?>    	
    	<span style="color:#f60; padding-left:30px;"><strong>标签名:　　</strong></span>
		<input type="text" name="tag_name" onkeyup="value=value.replace(/[\W]/g,'')"  maxlength=15 class="input-text wid200" />
        <div class="bk10"></div>	
		
		<!--<span style="color:#f60; padding-left:30px;"><strong>可用变量:</strong></span>
			<a class="tag_bl" href="#"><font color="red">{tag:time}</font> 作用:当前时间</a>		
		<div class="bk"></div>
		-->
		<span style="color:#f60; padding-left:30px; line-height:30px;"><strong>标签内容:　</strong></span>
		<textarea style="width:60%;height:250px;" name="tag_val">
		<!---------------------------------------------------------------------
		
				可以写入 HTML 代码.	和 javascript 代码			
				
		---------------------------------------------------------------------->		
		</textarea>
		<div class="bk20"></div>
		<span style="color:#f60; padding-left:30px; line-height:30px;"><strong>标签说明:　</strong></span>
		<input type="text" name="tag_des" maxlength=30 class="input-text wid500" />
		
    <?php endif; ?>

	
	<!----------------------------------------->
	<!----------------------------------------->
	
	
    <?php if (!empty($upkey)): ?>
		<span style="color:#f60; padding-left:30px;"><strong>标签名:　　</strong></span><input type="text" value="<?php echo $TAG['key']; ?>" name="tag_name" onkeyup="value=value.replace(/[\W]/g,'')"  maxlength=15 class="input-text wid200" /> 
        <div class="bk20"></div>
		<span style="color:#f60; padding-left:30px; line-height:30px;"><strong>标签内容:　</strong></span><textarea style="width:60%;height:250px;" name="tag_val"><?php echo $TAG['content']; ?></textarea>
		<div class="bk20"></div>
		<span style="color:#f60; padding-left:30px; line-height:30px;"><strong>标签说明:　</strong></span><input type="text" value="<?php echo $TAG['des']; ?>" name="tag_des" maxlength=30 class="input-text wid500" />
		
    <?php endif; ?>	
	
	
    <div class="btn_paixu">        		
		<span style="color:#f60; padding-left:30px; line-height:30px;">　　　</span>
		<input type ="submit" name="submit" class='button' value=" 提 交 " style="margin-left:10px"/>
	</div>
</form>


<script>

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
</script>
</body>
</html>