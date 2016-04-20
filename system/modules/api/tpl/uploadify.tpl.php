<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Uploadify</title>
<link rel="stylesheet" type="text/css" href="<?php echo G_PLUGIN_PATH; ?>/uploadify/uploadify.css" />
</head>
<body>
<div class="W">
	<div class="Bg"></div>
	<div class="Wrap" id="Wrap">
		<div class="Title">
			<h3 class="MainTit" id="MainTit"><?php echo $title; ?></h3>
			<a href="javascript:Close();" title="关闭" class="Close"></a>
		</div>
		<div class="Cont">
			<p class="Note">最多上传<strong><?php echo $num; ?></strong>个附件,单文件最大<strong><?php echo $size_str; ?></strong>,类型<strong><?php echo $uptype; ?></strong></p>
			<div class="flashWrap">
				<input name="uploadify" id="uploadify" type="file" multiple="true" />
				<span>
                	<?php if($admincheck){ ?>
					<input type="checkbox" name="iswatermark" id="iswatermark" /><label>是否添加水印</label>
					<?php } ?>
                </span>
			</div>
			<div class="fileWarp">
				<fieldset>
					<legend>列表</legend>
					<ul>
					</ul>
					<div id="fileQueue">
					</div>
				</fieldset>
			</div>
			<div class="btnBox">
				<button class="btn" id="SaveBtn">保存</button>
				&nbsp;
				<button class="btn" id="CancelBtn">取消</button>
			</div>
		</div>
		<!--[if IE 6]>
		<iframe frameborder="0" style="width:100%;height:100px;background-color:transparent;position:absolute;top:0;left:0;z-index:-1;"></iframe>
		<![endif]-->
	</div><!--Wrap end-->
</div><!--W end-->

<script src="<?php echo G_PLUGIN_PATH; ?>/uploadify/jquery.min.js" type="text/javascript"></script> 
<!--防止客户端缓存文件，造成uploadify.js不更新，而引起的“喔唷，崩溃啦”-->
<script>document.write("<script type='text/javascript' "
			+ "src='<?php echo G_PLUGIN_PATH; ?>/uploadify/jquery.uploadify.js?" + new Date()
			+ "'></s" + "cript>");
</script>
			
<script src="<?php echo G_PLUGIN_PATH; ?>/uploadify/uploadify-move.js" type="text/javascript"></script> 


<script type="text/javascript">
function Close(){
		$("#<?php echo $frame ;?>", window.parent.document).remove();
}
$("#CancelBtn").click(function(){
		$("#<?php echo $frame ;?>", window.parent.document).remove();
		//$('#uploadify').uploadifyClearQueue();
		//$(".fileWarp ul li").remove();
});

/*实例化上传控件 */
$(function() {
	$('#uploadify').uploadify({
			'formData'        : {
				'timestamp'   : '<?php echo time();?>',
				'token'       : '<?php echo md5('unique_salt'.time()); ?>',
				'type'		  : '<?php echo _encrypt($type); ?>',
				'path'		  : '<?php echo _encrypt($path); ?>',
				'size'		  : '<?php echo _encrypt($size); ?>',
				'check'		  : '<?php echo $check; ?>'
			},
			'auto'			  : true,
			'method'   		  : 'post',
			'multi'   		  : true,
			'swf'      		  : '<?php echo G_PLUGIN_PATH; ?>/uploadify/uploadify.swf',
       		'uploader'        : '<?php echo G_MODULE_PATH; ?>/uploadify/insert',
			'queueSizeLimit'  : '<?php echo $num; ?>',
			'fileSizeLimit'   : '<?php echo $size; ?>',
			'fileTypeExts'    : '<?php echo $uptype; ?>',
			'fileTypeDesc'    : '<?php echo $desc; ?>',
			'buttonImage'     : '<?php echo G_PLUGIN_PATH; ?>/uploadify/select.png',
			'queueID'         : 'fileQueue',
			'onUploadStart'   : function(file){
				$('#uploadify').uploadify('settings', 'formData', {'iswatermark':$("#iswatermark").is(':checked')});				
			},
			'onUploadSuccess' : function(file, data, response){
				$(".fileWarp ul").append(SetImgContent(data));
				SetUploadFile();
			}
		});	

});

//显示上传的图片
function SetImgContent(data){
	
	var obj=eval('('+data+')');  
	if(obj.ok == 'no'){
		//window.parent.message(obj.text,8,2);
		alert(obj.text);
		return;
	}else{
		var sLi = "";
		sLi += '<li class="img">';
		sLi += '<img src="<?php echo G_UPLOAD_PATH; ?>/' + obj.text + '" width="100" height="100" onerror="this.src=\'nopic.png\'">';
		sLi += '<input type="hidden" name="fileurl_tmp[]" value="' + obj.text + '">';
		sLi += '<a href="javascript:void(0);">删除</a>';
		sLi += '</li>';
		return sLi;
	}
}

//删除上传元素DOM并清除目录文件
function SetUploadFile(){
	$("ul li").each(function(l_i){
		$(this).attr("id", "li_" + l_i);
	})
	$("ul li a").each(function(a_i){
		$(this).attr("rel", "li_" + a_i);
	}).click(function(){
		$.get(
			'<?php echo WEB_PATH; ?>/api/uploadify/delupload/',
			{action:"del", filename:$(this).prev().val()},
			function(){}
		);
		$("#" + this.rel).remove();
	})
}
	
	/*点击保存按钮时
	 *判断允许上传数，检测是单一文件上传还是组文件上传
	 *如果是单一文件，上传结束后将地址存入$input元素
	 *如果是组文件上传，则创建input样式，添加到$input后面
	 *隐藏父框架，清空列队，移除已上传文件样式*/
$("#SaveBtn").click(function(){	
 var callback = "<?php echo $func; ?>";
 var num = <?php echo $num; ?>;
 var fileurl_tmp = [];
  
	if(callback != "undefined"){	
		if(num > 1){	
			 $("input[name^='fileurl_tmp']").each(function(index,dom){
				fileurl_tmp[index] = dom.value;
			 });	
		}else{
			fileurl_tmp = $("input[name^='fileurl_tmp']").val();	
		}	
		eval('window.parent.'+callback+'(fileurl_tmp)');
		$(window.parent.document).find("#<?php echo $frame ;?>").remove();
		return;
	}					 
	if(num > 1){
			var fileurl_tmp = "";
			$("input[name^='fileurl_tmp']").each(function(){
				fileurl_tmp += '<li rel="'+ this.value +'"><input class="input-text" type="text" name="<?php echo $input;?>[]" value="'+ this.value +'" /><a href="javascript:void(0);" onclick="ClearPicArr(\''+ this.value +'\',\'<?php echo WEB_PATH; ?>\')">删除</a></li>';	
			});			
			$(window.parent.document).find("#<?php echo $input; ?>").append(fileurl_tmp);
	}else{
			$(window.parent.document).find("#<?php echo $input; ?>").val($("input[name^='fileurl_tmp']").val());
	}

	$(window.parent.document).find("#<?php echo $frame ;?>").remove();
});


</script>
</body>
</html>