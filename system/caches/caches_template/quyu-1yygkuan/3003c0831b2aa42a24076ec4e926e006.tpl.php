<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header");?>   
<!--内容 开始-->
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/qqhelp.css"/>
<script type="text/javascript" charset="utf-8" src="<?php echo G_TEMPLATES_JS; ?>/area_city.js"></script>
<script type="text/javascript">
var opt0 =["----请选择----","----请选择----","----请选择----"];//初始值
</script>

<div class="help-main">
	<div class="qqGroup">
		<div class="qqTitle">
			<span class="groupt"><?php echo _cfg('web_name_two'); ?><b>QQ</b>群</span>
			<span>为打造更具公平、透明的<?php echo _cfg('web_name_two'); ?>平台，<?php echo _cfg('web_name_two'); ?>特成立各地QQ交流群（可在选择框查找本地群），欢迎广大云友加入。<br>另外，<?php echo _cfg('web_name_two'); ?>正在招募各地群主加盟，也可自建群，具体待遇和要求请咨询客服QQ:<?php echo _cfg("qq"); ?></span>
		</div>
		<div id="listTopContents" class="qqList"><p>直属群</p>
		<ul>
		<?php $ln=1;if(is_array($lists2)) foreach($lists2 AS $v): ?>
		<li><dt><img border="0" alt="<?php echo $v['name']; ?>" src="<?php echo G_TEMPLATES_IMAGE; ?>/logo.jpg"></dt><dt><?php echo $v['name']; ?><?php if($v['full']=='已满'): ?><img src="<?php echo G_TEMPLATES_IMAGE; ?>/qqhot.gif"/><?php endif; ?></dt><dd><a href="<?php echo $v['qqurl']; ?>" style="color:#82CD4C"><?php echo $v['qq']; ?></a></dd></li>
		<?php  endforeach; $ln++; unset($ln); ?>
		</ul></div>	
		
		<div class="qsearch">			
			<ul>
				<li>
					<label>筛选：</label>
				</li>
				<li>				
				 <select id="s_province"  name="s_province" STYLE="height:30px;width:130px;background:url((G_TEMPLATES_IMAGE)/select.gif);"></select>&nbsp;&nbsp;省	   
				 <select id="s_city" name="s_city" STYLE="height:30px;width:130px;"></select>&nbsp;&nbsp;县 
				 <select id="s_county"  name="s_county" STYLE="height:30px;width:130px;"></select>&nbsp;&nbsp;区 					 
				</li>			
                <script type="text/javascript">_init_area(opt0);</script>
			</ul>
			<span>地方群</span>
		</div>		
		<div id="listContents" class="qqList">
		<ul>
		<?php $ln=1;if(is_array($lists1)) foreach($lists1 AS $v): ?>
		<li ><dt><img border="0" alt="<?php echo $v['name']; ?>" src="<?php echo G_TEMPLATES_IMAGE; ?>/logo.jpg"></dt><dt><?php echo $v['name']; ?><?php if($v['full']=='已满'): ?><img src="<?php echo G_TEMPLATES_IMAGE; ?>/qqhot.gif"/><?php endif; ?></dt><dd><a href="<?php echo $v['qqurl']; ?>"><?php echo $v['qq']; ?></a></dd></li>
		<?php  endforeach; $ln++; unset($ln); ?>
		</ul></div>		
	</div>
	</div>
    
    	<script type="text/javascript">
	$(function(){	
	 var str='----请选择----';
       $("#s_province").change(function(){	   
	     var  prov = $("#s_province").val(); 
		 var cityv = $("#s_city").val();
		 var  couv = $("#s_county").val();
		$.ajax({
			type: "get",
			url: "<?php echo WEB_PATH; ?>/go/qq_qun/get_cityqq/"+prov+'/'+cityv+'/'+couv,
			success: function(data){				
			$("#listContents").html(data);
			}
		});

		$("#s_city").change(function(){	  
	     var  prov = $("#s_province").val(); 
		 var cityv = $("#s_city").val();
		 var  couv = $("#s_county").val();
		 $.ajax({
			type: "get",
			url: "<?php echo WEB_PATH; ?>/go/qq_qun/get_cityqq/"+prov+'/'+cityv+'/'+couv,
			success: function(data){
			$("#listContents").html(data);
			}
		});

		 $("#s_county").change(function(){	  
	     var  prov = $("#s_province").val(); 
		 var cityv = $("#s_city").val();
		 var  couv = $("#s_county").val();
		 $.ajax({
			type: "get",
			url: "<?php echo WEB_PATH; ?>/go/qq_qun/get_cityqq/"+prov+'/'+cityv+'/'+couv,
			success: function(data){
			$("#listContents").html(data);
			}
		});
	   });
		   
	   });
		   
	   });
	});
	</script>
	<?php include templates("index","footer");?>