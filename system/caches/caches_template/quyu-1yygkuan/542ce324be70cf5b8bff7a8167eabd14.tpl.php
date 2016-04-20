<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header");?>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/GoodsDetail.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/header.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/js/cloud-zoom.css"/>
<script type="text/javascript" src="<?php echo G_TEMPLATES_STYLE; ?>/js/cloud-zoom.min.js"></script>
<script type="text/javascript">
$.fn.CloudZoom.defaults = {
	zoomWidth: '400',
	zoomHeight: '310',
	position: 'right',
	tint: false,
	tintOpacity: 0.5,
	lensOpacity: 0.5,
	softFocus: false,
	smoothMove: 7,
	showTitle: false,
	titleOpacity: 0.5,
	adjustX: 0,
	adjustY: 0
};
</script>
<style type="text/css">
.zoom-section{clear:both;margin-top:20px;}
.zoom-small-image{border:2px solid #dedede;float:left;margin-bottom:20px; width:400px; height:400px;}
.zoom-small-image img{ width:400px; height:400px;}
.zoom-desc{float:left;width:404px; height:52px;margin-bottom:20px; overflow:hidden;}
.zoom-desc p{ width:10000px; height:52px; float:left; display:block; position:absolute; top:0; z-index:3; overflow:hidden;}
.zoom-desc label{ width:50px; height:52px; margin:0 5px 0 0; _margin-right:4px; display:block; float:left; overflow:hidden;}
.zoom-tiny-image{border:1px solid #CCC;margin:0px; width:48px; height:50px;}
.zoom-tiny-image:hover{border:1px solid #C00;}
</style>
<div class="Current_nav">
	<a href="<?php echo WEB_PATH; ?>">首页</a> <span>&gt;</span> 
	<a href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $item['cateid']; ?>">
	<?php echo $category['name']; ?>
	</a><span>&gt;</span> 
	<a href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $item['cateid']; ?>e<?php echo $item['brandid']; ?>">
	<?php echo $brand['name']; ?>
	</a> <span>&gt;</span>商品详情
</div>
<div class="show_content">
	<!-- 商品期数 -->
	<div id="divPeriodList" class="show_Period" style="max-height:99px;">		
		<div class="period_Open"><a class="gray02" click="off" id="btnOpenPeriod" href="javascript:void(0);">展开<i></i></a></div>
		<?php echo $loopqishu; ?>
	</div>
	<script>
		$("#btnOpenPeriod").click(function(){
				var ui_obj = $("#divPeriodList > ul");
				if($(this).attr("click")=='off'){
					$("#divPeriodList").css("max-height",ui_obj.length*33+"px");	
					$(this).attr("click","on");
					$(this).html("收起<s></s>");
					
				}else{
					$("#divPeriodList").css("max-height","99px");	
					$(this).attr("click","off");
					$(this).html("展开<i></i>");
				}			
		});
	</script>	
	<!-- 商品信息 -->
	<div class="Pro_Details">
		<h1><span>(第<?php echo $item['qishu']; ?>期)</span><span ><?php echo $item['title']; ?></span><span style="<?php echo $item['title_style']; ?>"><?php echo $item['title2']; ?></span></h1>
		<div class="Pro_Detleft">
			<div class="zoom-small-image">
				<span href="<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>" class = 'cloud-zoom' id='zoom1' rel="adjustX:10, adjustY:-2">
                <img width="80px" height="80px" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>" /></span>
			</div>

			<div class="zoom-desc"> 
				<div class="jcarousel-prev jcarousel-prev-disabled"></div>
				<div class="jcarousel-clip" style="height:55px;width:384px;">
				<p>
					<?php $ln=1;if(is_array($item['picarr'])) foreach($item['picarr'] AS $imgtu): ?>                  
					<label href="<?php echo G_UPLOAD_PATH; ?>/<?php echo $imgtu; ?>" class='cloud-zoom-gallery'  rel="useZoom: 'zoom1', smallImage: '<?php echo G_UPLOAD_PATH; ?>/<?php echo $imgtu; ?>'">
					<img class="zoom-tiny-image" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $imgtu; ?>" /></label>			
					<?php  endforeach; $ln++; unset($ln); ?> 
				</p>
				</div>
				<div class="jcarousel-next jcarousel-next-disabled"></div>
			</div>
			<script>
				var si=$(".jcarousel-clip label").size();
				var label=si*55;
				$(".jcarousel-clip p").css({width:label,left:"0"});
				if(label>395){
					$(".jcarousel-prev,.jcarousel-next").show();
				}else{
					$(".jcarousel-prev,.jcarousel-next").hide();
				}
				$(".jcarousel-prev").click(function(){
					var le=$(".jcarousel-clip p").css("left");
					var le2=le.replace(/px/,"");
					if(le!='0px'){
						$(".jcarousel-clip p").css({left:le2*1+55});
					}						
				})
				$(".jcarousel-next").click(function(){
					var le=$(".jcarousel-clip p").css("left");
					var le2=le.replace(/px/,"");
					var max_next=-(si-7)*55+"px";
					if(le!=max_next){						
						$(".jcarousel-clip p").css({left:le2*1-55});
					}
				})
			</script>			
			
			<?php if($sid_code): ?>			
			<?php if($sid_code['q_showtime']=='N'): ?>
			<div class="Pro_GetPrize">				
				<h2>上期获得者</h2>
				<div class="GetPrize">				    
					<dl>
						<dt><a rel="nofollow" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sid_code['q_uid']); ?>" target="_blank"><img width="80" height="80" alt="" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($sid_code['q_uid'],'img'); ?>"></a></dt>
						<dd class="gray02">
							<p>恭喜 <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sid_code['q_uid']); ?>" target="_blank" class="blue"><?php echo get_user_name($sid_code['q_uid']); ?></a>获得了本商品</p>
							<?php if($sid_go_record['ip']): ?>
							<?php echo get_ip($sid_go_record['id'],'ipcity'); ?>
							<?php endif; ?>
							<p>揭晓时间：<?php echo microt($sid_code['q_end_time']); ?></p>
							<p><?php echo _cfg('web_name_two'); ?>时间：<?php echo microt($sid_go_record['time']); ?></p>
							<p>幸运<?php echo _cfg('web_name_two'); ?>码：<em class="orange Fb"><?php echo $sid_code['q_user_code']; ?></em></p>
						</dd>
					</dl>				
				</div>
			</div>
			<?php endif; ?>
			<?php endif; ?>
		</div>
		<div class="Pro_Detright">
			<p class="Det_money">价值：<span class="rmbgray"><?php echo $item['money']; ?></span></p>
			<!--显示揭晓动画 start-->
			<?php if(($q_showtime=='Y')): ?>
				<?php include templates("index","item_animation");?>
			<?php  else: ?>
				<?php include templates("index","item_contents");?>
			<?php endif; ?>	
			<!--显示揭晓动画 end-->		
			<div class="Security">
				<ul>
					<li><a href="<?php echo WEB_PATH; ?>/help/4" target="_blank"><i></i>100%公平公正</a></li>
					<li><a href="<?php echo WEB_PATH; ?>/help/5" target="_blank"><s></s>100%正品保证</a></li>
					<li><a href="<?php echo WEB_PATH; ?>/help/7" target="_blank"><b></b>全国免费配送</a></li>
				</ul>
			</div>			
			<div class="Pro_Record">
				<ul id="ulRecordTab" class="Record_tit">
					<li class="NewestRec Record_titCur">最新<?php echo _cfg('web_name_two'); ?>记录</li>
					<li class="MytRec">我的<?php echo _cfg('web_name_two'); ?>记录</li>
					<li class="Explain orange">什么是<?php echo _cfg('web_name_two'); ?>？</li>
				</ul>
				<div class="Newest_Con hide">
					<ul>
						<?php $ln=1;if(is_array($us)) foreach($us AS $user): ?>
						<li>
						<a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($user['uid']); ?>" target="_blank">
						<?php if(!empty($user['uphoto'])): ?>
							<img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $user['uphoto']; ?>" border="0" alt="" width="20" height="20">
						<?php  else: ?>
							<img src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg" border="0" alt="" width="20" height="20">
						<?php endif; ?>
						</a>					
						<a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($user['uid']); ?>" target="_blank" class="blue"><?php echo $user['username']; ?></a>
						<?php if($user['ip']): ?>
						(<?php echo get_ip($user['id'],'ipcity'); ?>) 
						<?php endif; ?>				
						<?php echo _put_time($user['time']); ?> <?php echo _cfg('web_name_two'); ?>了
						<em class="Fb gray01"><?php echo $user['gonumber']; ?></em>人次</li>
						<?php  endforeach; $ln++; unset($ln); ?>
					</ul>
					<p style=""><a id="btnUserBuyMore" href="javascript:;" class="gray01">查看更多</a></p>					
				</div>
				
				<!--我的云购记录-->
				<div class="My_Record hide" style="display:none;">
					<?php if(get_user_uid()): ?>				
					<ul>				
									<?php $mod_member_member = System::load_app_model('member','member');$datas = $mod_member_member->get_record(get_user_uid(),$item['id'],9); ?>	
						<?php $ln=1;if(is_array($datas)) foreach($datas AS $row): ?>									
						<li><?php echo _put_time($user['time']); ?>  <?php echo _cfg('web_name_two'); ?>了  <?php echo $user['gonumber']; ?>  个<?php echo _cfg('web_name_two'); ?>码</li>						
						<?php  endforeach; $ln++; unset($ln); ?> 
					</ul>
					<?php  else: ?>					
					<div class="My_RecordReg">
						<b class="gray01">看不到？是不是没登录或是没注册？ 登录后看看</b>
						<a href="<?php echo WEB_PATH; ?>/member/user/login" class="My_Signbut">登录</a><a href="<?php echo WEB_PATH; ?>/member/user/register" class="My_Regbut">注册</a>
					</div>
					<?php endif; ?>
				</div>
				<!--/我的云购记录-->
				
				<div class="Newest_Con hide" style="display:none;">
					<p class="MsgIntro"><?php echo _cfg("web_name_two"); ?>购是指只需1元就有机会买到想要的商品。即每件商品被平分成若干“等份”出售，每份1元，当一件商品所有“等份”售出后，根据<?php echo _cfg('web_name_two'); ?>规则产生一名幸运者，该幸运者即可获得此商品。</p>
					<p class="MsgIntro1"><?php echo _cfg("web_name_two"); ?>以“快乐网购，惊喜无限”为宗旨，力求打造一个100%公平公正、100%正品保障、寄娱乐与购物一体化的新型购物网站。<a href="<?php echo WEB_PATH; ?>/help/1" class="blue" target="_blank">查看详情&gt;&gt;</a></p>
				</div>
			</div>			
		</div>
	</div>
</div>
<!-- 商品信息导航 -->
<div class="ProductTabNav">
	<div id="divProductNav" class="DetailsT_Tit">
		<div class="DetailsT_TitP">
			<ul>
				<li class="Product_DetT DetailsTCur"><span class="DetailsTCur">商品详情</span></li>
				<li id="liUserBuyAll" class="All_RecordT"><span class="">所有参与记录</span></li>
				<li class="Single_ConT"><span class="">晒单</span></li>
			</ul>
			<!-- <p><a id="btnAdd2Cart" href="javascript:;" class="white DetailsT_Cart"><s></s>加入购物车</a></p> -->
		</div>
	</div>
</div>

<!--补丁3.1.6_b.0.1-->
<div id="divContent" class="Product_Content">
	<!-- 商品内容 -->
	<div class="Product_Con"><?php echo $item['content']; ?></div>
    <!-- 商品内容 -->
    
    <!-- 购买记录20条 -->
	<div id="bitem" class="AllRecordCon">
		<iframe id="iframea_bitem" g_src="<?php echo WEB_PATH; ?>/go/goods/go_record_ifram/<?php echo $itemid; ?>/20" style="width:978px; border:none;height:100%" frameborder="0" scrolling="no"></iframe>		
	</div>	
   <!-- /购买记录20条 -->
    
	<!-- 晒单 -->
	<div id="divPost" class="Single_Content">
		<iframe id="iframea_divPost" g_src="<?php echo WEB_PATH; ?>/go/shaidan/itmeifram/<?php echo $itemid; ?>" style="width:978px; border:none;height:100%" frameborder="0" scrolling="no"></iframe>
	</div>
    <!-- 晒单 -->	
</div>
<!--补丁3.1.6_b.0.1-->


<script type="text/javascript">
<!--补丁3.1.6_b.0.2-->
function set_iframe_height(fid,did,height){	
	$("#"+fid).css("height",height);	
}

$(function(){
	$("#ulRecordTab li").click(function(){
		var add=$("#ulRecordTab li").index(this);
		$("#ulRecordTab li").removeClass("Record_titCur").eq(add).addClass("Record_titCur");
		$(".Pro_Record .hide").hide().eq(add).show();
	});
	
	var DetailsT_TitP = $(".DetailsT_TitP ul li");
	var divContent    = $("#divContent div");	
	DetailsT_TitP.click(function(){
		var index = $(this).index();
			DetailsT_TitP.removeClass("DetailsTCur").eq(index).addClass("DetailsTCur");
	
			var iframe = divContent.hide().eq(index).find("iframe");
			if (typeof(iframe.attr("g_src")) != "undefined") {
			  	 iframe.attr("src",iframe.attr("g_src"));
				 iframe.removeAttr("g_src");
			}
			divContent.hide().eq(index).show();
	});
	<!--补丁3.1.6_b.0.2-->
	
	
	<!--补丁查看更多-->
	$("#btnUserBuyMore").click(function(){
		$("#liUserBuyAll").click();
		$("html,body").animate({scrollTop:941},1500);
	});
	$(window).scroll(function(){
		if($(window).scrollTop()>=941){
			$("#divProductNav").addClass("nav-fixed");
		}else if($(window).scrollTop()<941){
			$("#divProductNav").removeClass("nav-fixed");
		}
	});
})
var shopinfo={'shopid':<?php echo $item['id']; ?>,'money':<?php echo $item['yunjiage']; ?>,'shenyu':<?php echo $syrs; ?>};
<!--补丁查看更多-->
	
$(function(){
	function baifenshua(aa,n){
	n = n || 2;
	return ( Math.round( aa * Math.pow( 10, n + 2 ) ) / Math.pow( 10, n ) ).toFixed( n ) + '%';
}
	var shopnum = $("#num_dig");
		var ten_per = Math.floor(parseInt(<?php echo $item['zongrenshu']; ?>)) || 1;
	var max_num = (ten_per > parseInt(shopinfo['shenyu'])) ? parseInt(shopinfo['shenyu']) : ten_per;
	shopnum.keyup(function(){
		if(shopnum.val()>=max_num){
			shopnum.val(max_num);
		}
		var numshop=shopnum.val();
		if(numshop==<?php echo $item['zongrenshu']; ?>){
			var baifenbi='100%';
		}else{
			var showbaifen=numshop/<?php echo $item['zongrenshu']; ?>;
			var baifenbi=baifenshua(showbaifen,2);
		}
		$("#chance").html("<span style='color:red'>获得机率"+baifenbi+"</span>");
	});
	
	$("#shopadd").click(function(){
		var shopnum = $("#num_dig");
			var resshopnump='';
			var ten_per = Math.floor(parseInt(<?php echo $item['zongrenshu']; ?>)) || 1;
			var max_num = (ten_per > parseInt(shopinfo['shenyu'])) ? parseInt(shopinfo['shenyu']) : ten_per;
			var num = parseInt(shopnum.val());
			if(num >= max_num){
				shopnum.val(max_num);
				resshopnump = max_num;
			}else{
				resshopnump=parseInt(shopnum.val())+1;
				shopnum.val(resshopnump);
			}
			if(resshopnump==<?php echo $item['zongrenshu']; ?>){
				var baifenbi='100%';
			}else{
				var showbaifen=resshopnump/<?php echo $item['zongrenshu']; ?>;
				var baifenbi=baifenshua(showbaifen,2);
			}
			$("#chance").html("<span style='color:red'>获得机率"+baifenbi+"</span>");
	});
	
	
	$("#shopsub").click(function(){
		var shopnum = $("#num_dig");
		var num = parseInt(shopnum.val());
		if(num<2){
			shopnum.val(1);			
		}else{
			shopnum.val(parseInt(shopnum.val())-1);
		}
		var shopnums=parseInt(shopnum.val());
		if(shopnums==<?php echo $item['zongrenshu']; ?>){
				var baifenbi='100%';
			}else{
				var showbaifen=shopnums/<?php echo $item['zongrenshu']; ?>;
				var baifenbi=baifenshua(showbaifen,2);
			}
			$("#chance").html("<span style='color:red'>获得机率"+baifenbi+"</span>");
	});
});

$(function(){
$(".Det_Cart").click(function(){ 
	//添加到购物车动画
	var src=$("#zoom1 img").attr('src');  
	var $shadow = $('<img id="cart_dh" style="display: none; border:1px solid #aaa; z-index: 99999;" width="400" height="400" src="'+src+'" />').prependTo("body"); 
	var $img = $(".mousetrap").first("img");
	$shadow.css({ 
	   'width' : $img.css('width'), 
	   'height': $img.css('height'),
	   'position' : 'absolute',      
	   'top' : $img.offset().top,
	   'left' : $img.offset().left, 
	   'opacity' :1    
	}).show();
	var $cart =$("#btnMyCart");
	var numdig=$(".num_dig").val();
	$shadow.animate({   
		width: 1, 
		height: 1, 
		top: $cart.offset().top, 
		left: $cart.offset().left,
		opacity: 0
	},500,function(){
		Cartcookie(false);
	});		
});
	$(".Det_Shopbut").click(function(){	
		Cartcookie(true);
	});	
});



function Cartcookie(cook){
	var shopid=shopinfo['shopid'];
	var number=parseInt($("#num_dig").val());
	if(number<=1){number=1;}
	var Cartlist = $.cookie('Cartlist');
	if(!Cartlist){
		var info = {};
	}else{
		var info = $.evalJSON(Cartlist);
		if((typeof info) !== 'object'){
			var info = {};
		}
	}		
	if(!info[shopid]){
		var CartTotal=$("#sCartTotal").text();
			$("#sCartTotal").text(parseInt(CartTotal)+1);
			$("#btnMyCart em").text(parseInt(CartTotal)+1);
	}	
	info[shopid]={};
	info[shopid]['num']=number;
	info[shopid]['shenyu']=shopinfo['shenyu'];
	info[shopid]['money']=shopinfo['money'];
	info['MoenyCount']='0.00';	
	$.cookie('Cartlist',$.toJSON(info),{expires:7,path:'/'});
	if(cook){
		window.location.href="<?php echo WEB_PATH; ?>/member/cart/cartlist/"+new Date().getTime();//+new Date().getTime()
	}
}  
</script> 

<?php include templates("index","footer");?>