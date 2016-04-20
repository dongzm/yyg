<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/header1.css"/>
	<!--新闻列表-->
		<div class="g-frame-footer">
			<div class="g-width footer">
				<div class="M-guide">
				<?php $category=$this->DB()->GetList("select * from `@#_category` where `parentid`='1'",array("type"=>1,"key"=>'',"cache"=>0)); ?>
			<?php $ln=1;if(is_array($category)) foreach($category AS $help): ?>
   			<dl class="ft-newbie">
   				<dt><span><?php echo $help['name']; ?></span></dt>
				<?php $article=$this->DB()->GetList("select * from `@#_article` where `cateid`='$help[cateid]'",array("type"=>1,"key"=>'',"cache"=>0)); ?>
				<?php 
					foreach($article as $art){
						echo "<dd><b></b><a href='".WEB_PATH.'/help/'.$art['id']."' target='_blank'>".$art['title'].'</a></dd>';
					}
				 ?>				
   			</dl>   			
			<?php  endforeach; $ln++; unset($ln); ?>
            <?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?> 			
															
					
					<dl class="ft-fwrx">
						<dt><span>社交媒体</span></dt>
					<dd>
							<a href="<?php echo WEB_PATH; ?>/vote/vote.action" target="_blank">参与投票</a>
						</dd>
						<dd>
							<a href="<?php echo WEB_PATH; ?>/go/index/weixin" target="_blank">官方微信</a>
						</dd>
																
					</dl> 
                    
				<dl>
						<dt>携手<?php echo _cfg('web_name_two'); ?></dt>
						<dd>
							<a href="<?php echo WEB_PATH; ?>/single/business"
								target="_blank">商务合作</a>
						</dd>
						<dd>
							<a href="<?php echo WEB_PATH; ?>/link" target="_blank">友情链接</a>
						</dd>
						
					</dl>
				</div>

				<div class="service-promise">
					<ul>
						<li class="M-android "><s class="F-bg"></s>
						<p class="F-txt">
							 <b class="gray9">下载手机客户端</b>
							 <s class="F-android-img"></s>
							 <a class="orange_btn" href="<?php echo G_WEB_PATH; ?>/?/go/index/app" target="_blank">立即下载</a>
						 </p>
						 
						<li class="M-wx"><a target="_blank">
								<s class="F-wxm"> <img
									src="<?php echo G_UPLOAD_PATH; ?>/banner/wx.jpg" border="0" alt=""
									width="75" height="75"></s>
						</a>
							<p class="F-txt">
								<a target="_blank"> </a><a	target="_blank"> <b class="gray9"><i></i>关注官方微信</b> <s
									class="F-wx-img"></s>
								</a>
							</p></li>
						<li class="M-time"><s class="F-bg"></s>
							<p class="F-txt" id="pServerTime">
								<b class="gray9">服务器时间</b><span id="sp_ServerTime" class="F-txt-dig"></span>
							</p></li>
							<?php $mysql_model=System::load_sys_class('model'); ?><?php $fund_data=$this->DB()->GetOne("select * from `@#_fund` limit 1",array("cache"=>0)); ?>
						<?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
						<?php if($fund_data['fund_off']): ?>	
						<li class="M-fund"><s class="F-bg"></s>
							<p class="F-txt">
								<b class="gray9">网站公益基金</b> <a href="<?php echo WEB_PATH; ?>/single/fund"
									target="_blank"><span class="F-fund-buy fam-y"
									id="spanFundTotal"><i class="rmbf">￥</i>0000000.00</span></a>
					  </p></li>	
						<?php endif; ?>	
						<li class="M-tel"><s class="F-bg"></s>
							<p class="F-txt">
								<b class="gray9">服务热线</b> <i class="F-tel-img"><?php echo _cfg("cell"); ?></i> <a
									href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cfg("qq"); ?>&site=qq&menu=yes" id="btnBtmQQ" class="F-icon-guest" target="_blank"><s></s>在线客服</a>
							</p></li>
					</ul>
				</div>
				<div class="M-security">
					<a href="<?php echo WEB_PATH; ?>/help/4" class="U-fair"
						target="_blank"> <s class="F-security-img"></s>
						<p class="F-security-T">100%公平公正</p>
						<p class="F-security-C">参与过程公开透明，用户可随时查看</p>
					</a> <a href="<?php echo WEB_PATH; ?>/help/5" class="U-security"
						target="_blank"> <s class="F-security-img"></s>
						<p class="F-security-T">100%正品保证</p>
						<p class="F-security-C">精心挑选优质商家，100%品牌正品</p>
					</a> <a href="<?php echo WEB_PATH; ?>/help/7" class="U-free"
						target="_blank"> <s class="F-security-img"></s>
						<p class="F-security-T">全国免运费</p>
						<p class="F-security-C">全场商品全国包邮（港澳台地区除外）</p>
					</a>
				</div>
			</div>
		</div>		
	<!--end 新闻列表-->

	<!-- 底部版权 -->
		<div class="g-frame copyright">
			<div class="footer_links">
				<?php echo Getheader('foot'); ?><script language="javascript" type="text/javascript" src="http://js.users.51.la/17397566.js"></script>
<noscript><a href="http://www.51.la/?17397566" target="_blank"><img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/17397566.asp" style="border:none" /></a></noscript>
				</div>
			<div class="copyright"><?php echo _cfg('web_copyright'); ?></div>
			<div class="footer_icon">
			<img src="<?php echo G_TEMPLATES_STYLE; ?>/images/a1.jpg"alt="备案">
				<a target="_blank" class="fi_ectrustchina"></a>
				<a target="_blank" class="fi_315online"></a>
				<a target="_blank" class="fi_cnnic"></a>
				<a target="_blank" class="fi_anxibao"></a>
				<a target="_blank" class="fi_qh"></a>
			</div>
		</div>
	<!--end 底部版权 -->
	
	<!--右侧导航-->
		<div id="divRighTool" class="quickBack" style="display: block;bottom: 60px;right: 0px;">
			<dl class="quick_But">
				<dd id="divRigCart" class="quick_cart" style="">
					<a id="btnMyCart" href="<?php echo WEB_PATH; ?>/member/cart/cartlist"
						target="_blank" class="quick_cartA"><b>购物车</b><s></s><em>0</em></a>
					<div style="display: none;" id="rCartlist" class="Roll_mycart">
						<ul style="display: none;"></ul>
						<div class="quick_goods_loding" id="rCartLoading">
							<img border="0" alt="" src="<?php echo G_TEMPLATES_STYLE; ?>/images/goods_loading.gif">正在加载......
						</div>
						<p id="p1" style="display: none;">共计<span id="rCartTotal2">0</span> 件商品 金额总计：<span class="rmbgray" id="rCartTotalM">0</span></p>
						<h3 style="display: none;">
							<a target="_blank" href="<?php echo WEB_PATH; ?>/member/cart/cartlist"
								class="orange_btn">去购物车结算</a>
						</h3>
					</div>
				</dd>
				<dd class="quick_service">
					<a id="btnRigQQ" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cfg("qq"); ?>&site=qq&menu=yes" class="quick_serviceA " target="_blank"><b>在线客服</b><s></s></a>
				</dd>
				<dd class="quick_Collection">
					<a id="btnFavorite" href="javascript:void();"
						class="quick_CollectionA"><b>收藏本站</b><s></s></a>
				</dd>
				<dd class="quick_Return">
					<a id="btnGotoTop" href="javascript:void()" class="quick_ReturnA"><b>返回顶部</b><s></s></a>
				</dd>
			</dl>
		</div>
	<!--end右侧导航-->
	
	<!--右下角揭晓-->
		
	<!--end右下角揭晓-->
	<script type="text/javascript">
(function(){				
		var week = '日一二三四五六';
		var innerHtml = '{0}:{1}:{2}';
		var dateHtml = "{0}月{1}日 &nbsp;周{2}";
		var timer = 0;
		var beijingTimeZone = 8;				
				function format(str, json){
					return str.replace(/{(\d)}/g, function(a, key) {
						return json[key];
					});
				}				
				function p(s) {
					return s < 10 ? '0' + s : s;
				}			

				function showTime(time){
					var timeOffset = ((-1 * (new Date()).getTimezoneOffset()) - (beijingTimeZone * 60)) * 60000;
					var now = new Date(time - timeOffset);
					document.getElementById('sp_ServerTime').innerHTML = format(innerHtml, [p(now.getHours()), p(now.getMinutes()), p(now.getSeconds())]);				
					//document.getElementById('date').innerHTML = format(dateHtml, [ p((now.getMonth()+1)), p(now.getDate()), week.charAt(now.getDay())]);
				}				
				
				window.yungou_time = 	function(time){						
					showTime(time);
					timer = setInterval(function(){
						time += 1000;
						showTime(time);
					}, 1000);					
				}
	window.yungou_time(<?php echo time(); ?>*1000);
				
})();
				
				
				
$(document).ready(function(){
	try{  
       if(typeof(eval(pleasereg_initx))=="function"){
            pleasereg_initx();
	   }
    }catch(e){
       //alert("not function"); 
    }  
})
</script>
<script>
$(function(){
	$(".quick_cart").hover(
		function(){			
			$("#rCartlist,#rCartLoading").show();
			$("#rCartlist p,#rCartlist h3").hide(); 
			$("#rCartlist li").remove();
			$("#rCartTotal2").html("");
			$("#rCartTotalM").html("");
			$.getJSON("<?php echo WEB_PATH; ?>/member/cart/cartshop/"+ new Date().getTime(),function(data){
				$("#rCartlist ul").append(data.li);
				$("#rCartTotal2").html(data.num);
				$("#rCartTotalM").html(data.sum);
				$("#rCartLoading").hide();
				$("#rCartlist ul,#rCartlist p,#rCartlist h3").show();				
			});
		},
		function(){
			$("#rCartlist,#rCartlist ul,#rCartlist p,#rCartlist h3").hide();
		}
	);
});
function delshop(id){
	var Cartlist = $.cookie('Cartlist');
	var info = $.evalJSON(Cartlist);
	var num=$("#rCartTotal2").html()-1;
	var sum=$("#rCartTotalM").html();
	info['MoenyCount'] = sum-info[id]['money']*info[id]['num'];
		
	delete info[id];
	//$.cookie('Cartlist','',{path:'/'});
	$.cookie('Cartlist',$.toJSON(info),{expires:30,path:'/'});
	$("#rCartTotalM").html(info['MoenyCount']);
	$('#rCartTotal2').html(num);
	$('#sCartTotal').text(num);											
	$('#btnMyCart em').text(num);
	$("#shopid"+id).remove();
}
$(document).ready(function(){
	$.get("<?php echo WEB_PATH; ?>/member/cart/getnumber/"+ new Date().getTime(),function(data){
		$("#sCartTotal").text(data);											
		$("#btnMyCart em").text(data);											
	});
});
</script>
<script>

$(function(){

	$("#btnGotoTop").click(function(){
		$("html,body").animate({scrollTop:0},1500);
	});
	$("#btnFavorite,#addSiteFavorite").click(function(){
		var ctrl=(navigator.userAgent.toLowerCase()).indexOf('mac')!=-1?'Command/Cmd': 'CTRL';
		if(document.all){
	 
			window.external.addFavorite('<?php echo G_WEB_PATH; ?>','<?php echo _cfg("web_name"); ?>');
		}
		else if(window.sidebar){
		   window.sidebar.addPanel('<?php echo _cfg("web_name"); ?>','<?php echo G_WEB_PATH; ?>', "");
		}else{ 
			alert('您可以通过快捷键' + ctrl + ' + D 加入到收藏夹');
		}
    });
	$("#divRighTool a").hover(		
		function(){
			$(this).addClass("Current");
		},
		function(){
			$(this).removeClass("Current");
		}
	)	
	
 
});
	//云购基金
	$.ajax({
		url:"<?php echo WEB_PATH; ?>/api/fund/get",
		success:function(msg){
		var str='<i class="rmbf">￥</i>'+msg;
			$("#spanFundTotal").html(str);
		}
	});
</script>

 </body>
</html>