<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
.div{ margin-bottom:10px;height:20px; font-size:16px; color:#CC6633; }
#shopid{ color:#9933CC; font-size:12px;}
.text{width:60px; height:20px; border:1px solid #CCCC99;}
.tr td{ width:30px; height:30px; background:#C5D9EB;}
#table{ border:1px solid #D7DEE1; cursor:default; text-align:center;}
</style>
</head>
<body>
<div style="width:100%; height:800px;">

	<div class="div" >
	指定间隔时间段(秒)：
	<input class="text" id="times" type="text"   value="<?php echo $times; ?>" />
	——
	<input class="text" id="endtimes" type="text" value="<?php echo $endtimes;?>" />
	<label style="font-size:12px; color:#F53D38;">开始时间:大于等于1的正整数,结束时间：大于开始时间的正整数。</label>
	</div>
	<div class="div">
		指定用户id段：
		<input class="text" id="f_userid" type="text"  value="<?php echo $userid[0];?>"  />——
		<input class="text" id="l_userid" type="text"  value="<?php echo $userid[1];?>"  />
	</div>
	<div >
		<span style="color:#FF0000;">*</span> <span style="color:#CC6633;">指定购买小时段：</span><span><?php echo $timeperiod; ?></span>
		<table id="table">
		<?php for($i=0;$i<24;$i++){ ?>
				<?php if($i%6 ==0){ ?>	
						<tr class="tr">
				<?php } ?>	
				
				<?php $x = -1; ?>	
				<?php foreach($tp as $k=>$v){?>	
						<?php if($v == $i){ ?>
							<?php $x = 1; break; ?>
						<?php }?>
				<?php }?>
				
				<?php if($x == 1){?>
						<td class="td" style="background:#0066FF;"><?php echo $i;?></td>
				<?php }else{?>
					<td class="td"><?php echo $i;?></td>
				<?php }?>
				
				<?php if(($i+1)%6 ==0){ ?>	
						</tr>
				<?php } ?>		
		<?php }?>
		
		</table>
	</div>
	
	<div class="div">是否自动进入下一期：<input id="autoadd" type="checkbox"<?php if($autoadd == 1 ){ ?> checked="checked"<?php }?>/>
		<input type="hidden" id="autoadd_value" value="<?php echo $autoadd; ?>"/>
	</div>
	<div class="div">
		是否随机购买多个商品：<input id="m_shop" type="checkbox" <?php if($mshop ==1){ ?>checked="checked"<?php } ?>/>
		<input type="hidden" id="m_shop_value" value="<?php echo $mshop; ?>"/>
	</div>
	<div class="div">指定购买商品：<label id="shopid"><?php echo $shopid; ?></label></div>
	
	<div style="width:100%; ">
		<div style="width:100%; height:30px; border-bottom:1px solid #FFFFFF;">
			<table style=" background:#E1ECEC; border-left:10px solid #FFFFFF; text-align:center;">
				<tr>
					<td width="30"><input id="cb_all" type="checkbox" /></td>
					<td width="60">ID</td>
					<td width="260">商品标题</td>
					<td width="130">所属栏目</td>
					<td width="120">已参与/总需</td>
					<td width="115">单价/元</td>
					<td width="120">期数/最大期数</td>
				</tr>
			</table>
		</div>
		<div style="width:100%;">
			<table style=" border-left:10px solid #FFFFFF; text-align:center;">
			
				<?php foreach($shoplist as $shop){?>
				<tr>
					<td width="30"><input class="cb" type="checkbox" <?php 
					$tem = -1;
					for($i=0;$i<count($shopidarray );$i++){
						if($shopidarray[$i] == $shop['id'] ){
							$tem =1;
						}
					}
					
					?><?php if($tem ==1) {?>checked="checked" <?php }?>/>
					<input class="cb_value" type="hidden" value="<?php echo $shop['id'] ?>"/></td>
					<td width="60"><?php echo $shop['id'] ?></td>
					<td width="260" title="<?php echo $shop['title']?>"><?php echo $shop['title']?></td>
					<td width="130"><?php echo $this->categorys[$shop['cateid']]['name']; ?></td>
					<td width="120"><?php echo $shop['canyurenshu'] ?>/<?php echo $shop['zongrenshu'] ?></td>
					<td width="115"><?php echo $shop['yunjiage']?></td>
					<td width="120"><?php echo $shop['qishu']?>/<?php echo $shop['maxqishu'] ?></td>
				</tr>
				<?php }?>
			</table>
		</div>
		<div style="width:100%;">
	 
			
	
			<a href="<?php echo WEB_PATH.'/auto/auto_p/show/'.$o_p;?>">
				<input type="button" value="上一页" />
			</a>&nbsp;
			<a href="<?php  echo WEB_PATH.'/auto/auto_p/show/'.$n_p;?>">
			<input type="button" value="下一页" />
			</a>
		
		 </div>
		<div style="width:100%; margin-top:10px;  ">
		<input id="start_auto_p" type="button" value="保存配置并开启"/> &nbsp;
		<input id="stop_auto_p" type="button" value="关闭"/> </div>
	</div>
	<div style=" color:#FF0000;">
			注：<br/>
			&nbsp;	1、点击关闭后,如果想再次开起,需至少等待上次设置的间隔时间段(秒)的最大秒数<br/>
			&nbsp;  2、请不要更改本插件的源代码及文件名、否则后果自负<br/>
			&nbsp;  3、请确保有批量注册用户后方可开启
			
	</div>
</div>
</body>
</html> 
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/css/jquery.min.js" type="text/javascript"></script>
<script>
var timeperiod = "<?php echo $timeperiod; ?>";
$(function(){
	$("#start_auto_p").click(function(){
		var times = $("#times").val();
		var endtimes = $("#endtimes").val();
		var f_userid = $("#f_userid").val();
		var l_userid = $("#l_userid").val();
		var shopid = $("#shopid").html();
		var autoadd = $("#autoadd_value").val();
		var m_shop_value = $("#m_shop_value").val();
		if(timeperiod == ""){
			alert("请设置购买时段");
		}
		$.ajax({
			url:"<?php echo WEB_PATH.'/auto/auto_p/ajaxaction';?>",
			type:"POST",
			data:{times:times,f_userid:f_userid,l_userid:l_userid,shopid:shopid,autoadd:autoadd,endtimes:endtimes,m_shop_value:m_shop_value,timeperiod:timeperiod},
			success:function(data){
				alert(data);
			}
		});
		alert("成功开起");
	});
	
	$("#stop_auto_p").click(function(){
		$.ajax({
			url:"<?php echo WEB_PATH.'/auto/auto_p/stop';?>",
			type:"POST",
			success:function(data){
				//alert(data);
			}
		});
		alert("已关闭");
	});
	
	$("#cb_all").click(function(){
		var checked =  $(this).attr("checked");
		if(checked =="checked"){
			//var aa = $(".cb_value").val();
			var shopid = null;
			$(".cb_value").each(function(){
				if(shopid == null){
					shopid = $(this).val();
				}else{
					shopid = shopid+"-"+$(this).val();
				}
			  });
			$("#shopid").html(shopid);
			$(".cb").attr("checked","checked");
		}else{
			$("#shopid").html('');
			$(".cb").attr("checked",false);
		}
	});
	
	$(".cb").click(function(){
		var c = $(this).attr("checked");
		var shopid = $.trim($("#shopid").html());
		var id = $(this).next().val();
		if(c == "checked" )
		{
			var sarray = shopid.split("-");
			if($.trim(shopid) == '' || $.trim(shopid) ==null  ){
				$("#shopid").html(id);
			}else{
				//判断里面是否有相同的值
				var tem = null;
				for(var i=0;i<sarray.length;i++){
					if(sarray[i] == id){
						tem = i;
					}
				}
				if(tem == null ){
					$("#shopid").html(shopid+"-"+id);
				}else{
					$("#shopid").html(shopid);
				}
			}
		}else{
			var sarray = shopid.split("-");
			var newsarray = new  Array();
			for(var i=0;i<sarray.length;i++){
				if(sarray[i] != id){
					newsarray[newsarray.length] = sarray[i];
				}
			}
			var aaa = newsarray.join("-");
			$("#shopid").html(aaa);
		}
		
	});
	//是否自动进入下一期
	$("#autoadd").click(function(){
		var checked =  $(this).attr("checked");
		if(checked =="checked"){
			$("#autoadd_value").val(1);
		}else{
			$("#autoadd_value").val(0);
		}
	});
	
	//程序是否运行正常
	var isstop = <?php echo $isstop;  ?>;
	if(isstop == 0){
		$.ajax({
			url:"<?php echo WEB_PATH.'/auto/auto_p/errorrestart/';?>",
			type:"POST",
			success:function(data){
			}
		});
		alert("重启成功");
	}
	//是否随机购买多个商品
	$("#m_shop").click(function(){
		var checked =  $(this).attr("checked");
		if(checked =="checked"){
			$("#m_shop_value").val(1);
		}else{
			$("#m_shop_value").val(0);
		}
	});
	
	
	//时间段点击
	$(".td").click(function(){
		var t = $(this).html();
		if(timeperiod == ""){
			timeperiod = timeperiod+t;
			$(this).css("background","#0066FF");
		}else{
			var tparray = timeperiod.split("-");
			var newtparray = new Array();
			//判断已有数组是否有这个值,有就删除，并且改变颜色
			var iin = -1;
			var tdcss = 0;
			for(var i = 0;i<tparray.length;i++){
				if(t == tparray[i]){
					iin = i;
					tdcss = 1;
					 break;
				}
			}
			if(iin == -1){//没有相同的需要添加
				tparray[tparray.length] = t;
				timeperiod = tparray.join("-");
			}else{//有相同的  需要删除
				var s = 0;
				for(var x = 0;x<tparray.length;x++){
					if(iin != x){
						newtparray[s] = tparray[x];
						s++;
					}
				}
				timeperiod = newtparray.join("-");
			}
			if(tdcss == 0){
				$(this).css("background","#0066FF");
			}else{
				$(this).css("background","#C5D9EB");
			}
		}

	});
});
</script>