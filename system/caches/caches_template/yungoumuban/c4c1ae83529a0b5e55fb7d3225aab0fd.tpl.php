<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>﻿<?php include templates("index","headerindex");?>

    <link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/index3.css?date=20140731">
<script type="text/javascript" src="<?php echo G_WEB_PATH; ?>/statics/plugin/style/global/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo G_WEB_PATH; ?>/statics/templates/quyu-1yygkuan/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/layer/layer.min.js"></script>



<div id="index_desc" class="hide layer_pageContent" style="display: none;"><img src="<?php echo G_UPLOAD_PATH; ?>/banner/indexad.jpg"></div>
<script>
$(function(){
	var index_show = $.cookie('index_show');
	if(!index_show){
		$.layer({
	        type : 1,
	        title : false,
	        // time: 3,
	        fix : false,
	        offset:['50px' , ''],
	        border: [0],
	        area : ['580px','754px'],
	        page : {dom : '#index_desc'}
	    });
	    $.cookie('index_show','1',{expires: 7});
	}
});
</script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/gdjs.js"></script>
        <!--banner-->
        <div class="g-content">
            <div class="w1190">
                <div class="home-banner fl">
                    <div id="div_slide" class="slide-scroll">
                        <div id="div_guide" class="m-guide-con" style="display: none;">
                            <div class="m-guideBg"></div>
                            <div class="m-guide">
                               <ul id="ul_guide">
										<li class="f-step1" style="display: list-item;"><a
											href="javascript:;" title="30秒了解"></a> <img
											src="<?php echo G_UPLOAD_PATH; ?>/banner/step_01.gif?v=141113"></li>
										<li class="f-step2" style="display: none;"><a
											href="javascript:;" title="下一步"></a> <img
											src="<?php echo G_UPLOAD_PATH; ?>/banner/step_02.gif?v=141113"></li>
										<li class="f-step3" style="display: none;"><a
											href="javascript:;" title="下一步"></a> <img
											src="<?php echo G_UPLOAD_PATH; ?>/banner/step_03.gif?v=141113"></li>
										<li class="f-step4" style="display: none;"><a
											href="javascript:;" title="下一步"></a> <img
											src="<?php echo G_UPLOAD_PATH; ?>/banner/step_04.gif?v=141113"></li>
										<li class="f-step5" style="display: none;"><a
											href="javascript:;" title="下一步"></a> <img
											src="<?php echo G_UPLOAD_PATH; ?>/banner/step_05.gif?v=141113"></li>
										<li class="f-step6" style="display: none;"><a
											href="/?/single/newbie" target="_blank"
											title="继续了解详情"></a> <img
											src="<?php echo G_UPLOAD_PATH; ?>/banner/step_06.gif?v=141113"></li>
									</ul>
                                <a id="guide_close" href="javascript:;" class="m-guide-close" title="关闭"></a>
                            </div>
                            <div class="u-guide-arrow">
                                <a id="guide_pre" href="javascript:;" class="u-guide-prev"><s></s></a>
                                <a id="guide_next" href="javascript:;" class="u-guide-next"><s></s></a>
                            </div>
                        </div>
                       <?php $slides=$this->DB()->GetList("select * from `@#_slide` where 1",array("type"=>1,"key"=>'',"cache"=>0)); ?>
		<div class="m-slides">					
			 <ul id="slideul">	
            	<?php $ln=1;if(is_array($slides)) foreach($slides AS $slide): ?>
                <?php if($ln == 1): ?>
            	<li style="display:list-item;"><a href="<?php echo $slide['link']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $slide['img']; ?>"></a></li>
             	<?php  else: ?>
            <li style="display:none;"><a href="<?php echo $slide['link']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $slide['img']; ?>"></a></li>
                <?php endif; ?>
                <?php  endforeach; $ln++; unset($ln); ?>
            </ul>
			 <div id="posterBanner" style="display: none;"></div>
          <a class="rslides_nav rslides1_nav pre" href="javascript:;" style="display: none;">Previous</a> <a class="rslides_nav rslides1_nav next" href="javascript:;" style="display: none;">Next</a>
			 <ul class="rslides_tabs">
            <?php 					
            for($i=1;$i<=count($slides);$i++){
            echo '
            <li class=""><a href="javascript:;">'.$i.'</a></li>
            ' ;
            }
             ?>
          </ul>
			<?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
		</div>
                    </div>

                    <!--广告位下方推荐-->
                    <div class="slide-comd">
                        
                        <?php $ln=1;if(is_array($shoplistone)) foreach($shoplistone AS $renqi): ?>
                                <div class="commodity">
                                    <ul>
                                        <li class="comm-info fl">
                                            <span><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" target="_blank" title="<?php echo $renqi['title']; ?>"><?php echo $renqi['title']; ?></a></span>
                                            <p class="gray">已参与<em class="orange"><?php echo $renqi['canyurenshu']; ?></em>人次</p>
                                        </li>
                                        <li class="comm-pic fr"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" target="_blank" title="<?php echo $renqi['title']; ?>" rel="nofollow">
                                            <cite>
                                                <img alt="<?php echo $renqi['title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $renqi['thumb']; ?>" border="0"  width="100" height="100"></cite>
                                            <span class="F_goods_xp"><i>新品</i></span>
                                        </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            <?php  endforeach; $ln++; unset($ln); ?>
                            
                    </div>
                </div>
               <div class="home-event fr">
                    <div class="what-1yyg">
                        <a id="what_1yyg" href="<?php echo G_WEB_PATH; ?>/?/single/newbie" title="什么是1元云购？30秒了解" >
                            <img src="<?php echo G_WEB_PATH; ?>/statics/templates/quyu-1yygkuan/images/index-come.gif" alt=""></a>
                    </div>
                    <div class="honesty">
                        <ul>
                            <li><a href="<?php echo G_WEB_PATH; ?>/?/go/index/qualification#rz1" target="_blank" title="诚信网站"><i class="i1"></i>诚信网站</a></li>
                            <li><a href="<?php echo G_WEB_PATH; ?>/?/go/index/qualification#rz2" target="_blank" rel="nofollow" title="可信网站"><i class="i2"></i>可信网站</a></li>
                            <li><a href="<?php echo G_WEB_PATH; ?>/?/go/index/qualification#rz3" target="_blank" rel="nofollow" title="电商诚信"><i class="i3"></i>电商诚信</a></li>
                            <li><a href="<?php echo G_WEB_PATH; ?>/?/go/index/qualification#rz4" target="_blank" rel="nofollow" title="安信宝"><i class="i4"></i>安信宝</a></li>
                            <li><a href="<?php echo G_WEB_PATH; ?>/?/go/index/qualification#rz5" target="_blank" rel="nofollow" title="监督管理局"><i class="i5"></i>监督管理局</a></li>
                            <li><a href="<?php echo G_WEB_PATH; ?>/?/go/index/qualification#rz6" target="_blank" rel="nofollow" title="更多"><i class="i6"></i>更多</a></li>
                        </ul>
                    </div>
                    <div class="index_news">
                        <dl>
                            <dt>新闻公告</dt>
                                         			<?php $mod_group_group = System::load_app_model('group','group');$datas = $mod_group_group->get_group_tiezi(3); ?>	
            <?php $ln=1;if(is_array($datas)) foreach($datas AS $row): ?>         
                            
                                    <dd><b></b><a href="<?php echo WEB_PATH; ?>/group/nei/<?php echo $row['id']; ?>" target="_blank" title="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></a></dd>
                                
                                <?php  endforeach; $ln++; unset($ln); ?>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
<div class="g-wrap w1190">
       <!--最新揭晓-->
            <div class="g-title">
                <h3 class="fl">最新揭晓<span>截至目前共揭晓商品<em class="orange" id="em_lotcount"><?php echo $NN; ?></em>个</span></h3>
                <div class="m-other fr"><cite><a href="<?php echo WEB_PATH; ?>/goods_lottery" target="_blank" title="看看附近都有谁获得了商品？">看看附近都有谁获得了商品？</a></cite></div>
            </div>
            <div class="g-list">
                <ul id="ulNewAwary">
				<?php $ln=1;if(is_array($shopqishu)) foreach($shopqishu AS $qishu): ?>
				<?php 
					$qishu['q_user'] = unserialize($qishu['q_user']);
				 ?>
					<li>
						<dl>
							<dt><a href="<?php echo WEB_PATH; ?>/dataserver/<?php echo $qishu['id']; ?>" target="_blank" class="pic"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $qishu['thumb']; ?>" height="200px" width="200px"></a></dt>
						  <dd class="f-gx"><div class="f-gx-user"><span>恭喜</span><span class="blue"><a rel="nofollow" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($qishu['q_uid']); ?>" target="_blank"><?php echo get_user_name($qishu['q_user']); ?></a></span><span>获得</span></div></dd><br>
							<dd class="u-name"><a href="<?php echo WEB_PATH; ?>/dataserver/<?php echo $qishu['id']; ?>" target="_blank" class="name"><?php echo $qishu['title']; ?></a></dd>
						</dl>
						<cite style="display: inline;"></cite>
					</li>
					<?php  endforeach; $ln++; unset($ln); ?>
					<script type="text/javascript" src="<?php echo G_WEB_PATH; ?>/statics/templates/quyu-1yygkuan/js/GLotteryFun.js"></script>
					<script type="text/javascript">
						$(document).ready(function(){gg_show_time_init("ulNewAwary",'<?php echo WEB_PATH; ?>',0);});					
					</script> 
                </ul>
            </div>
            <!--热门推荐-->
            <div class="g-title">
                <h3 class="fl">热门推荐</h3>
                <div class="m-other fr"><a href="<?php echo WEB_PATH; ?>/goods_list/" target="_blank" title="更多" class="u-more">更多</a></div>
            </div>
            <div class="g-hot clrfix">
                <div class="g-hotL fl" id="divHotGoodsList">
				<?php $ln=1;if(is_array($shoplistrenqi)) foreach($shoplistrenqi AS $renqi): ?>
					<div class="g-hotL-list">
						<div class="g-hotL-con">
							<ul>
								<li class="g-hot-pic"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" target="_blank" title="<?php echo $renqi['title']; ?>"><img alt="<?php echo $renqi['title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $renqi['thumb']; ?>"></a></li>
								<li class="g-hot-name"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" target="_blank" title="<?php echo $renqi['title']; ?>"><?php echo $renqi['title']; ?></a></li>
								<li class="gray">价值：￥<?php echo $renqi['money']; ?></li>
								<li class="g-progress"><dl class="m-progress"><dt><b style="width:<?php echo width($renqi['canyurenshu'],$renqi['zongrenshu'],216); ?>0px;"></b></dt><dd><span class="orange fl"><em><?php echo $renqi['canyurenshu']; ?></em>已参与</span><span class="gray6 fl"><em><?php echo $renqi['zongrenshu']; ?></em>总需人次</span><span class="blue fr"><em><?php echo $renqi['zongrenshu']-$renqi['canyurenshu']; ?></em>剩余</span></dd></dl></li>
								<li><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" class="u-imm" target="_blank" title="只要1元，即可购买">立即<?php echo _cfg('web_name_two'); ?></a></li>
							</ul>
						</div>
					</div>
					<?php  endforeach; $ln++; unset($ln); ?>
				</div>
                <div class="g-hotR fr">
                    <div class="u-are">正在<?php echo _cfg('web_name_two'); ?></div>
                    <div class="g-zzyging">
                        <ul id="UserBuyNewList" style="margin-top: 0px;">
							<?php $ln=1;if(is_array($go_record)) foreach($go_record AS $gorecord): ?>
							<li><span class="fl"><a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($gorecord['uid']); ?>" target="_blank" title="<?php echo get_user_name($gorecord); ?>"><img alt="<?php echo get_user_name($gorecord); ?>" width="40" height="40" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($gorecord['uid'],'img','8080'); ?>"><i></i></a></span><p><a target="_blank" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($gorecord['uid']); ?>" title="<?php echo get_user_name($gorecord); ?>" class="blue"><?php echo get_user_name($gorecord); ?></a><br><a target="_blank" href="<?php echo WEB_PATH; ?>/goods/<?php echo $gorecord['shopid']; ?>" title="<?php echo $gorecord['shopname']; ?>" class="u-ongoing"><?php echo $gorecord['shopname']; ?></a></p></li>
							<?php  endforeach; $ln++; unset($ln); ?>
						</ul>
					</div>
					<script> 
						function autoScroll(obj){  
							$(obj).find("#UserBuyNewList").animate({  
								marginTop : "-89px"  
							},500,function(){  
								$(this).css({marginTop : "0px"}).find("li:first").appendTo(this);  
							})  
						}  
						$(function(){  
							setInterval('autoScroll(".g-zzyging")',3000)  
						})  
					</script>
                    <div class="u-see100">看一看谁的运气最好！</div>
                </div>
            </div>

            <!--即将揭晓-->
            <div class="g-title m-sort">
                <h3 class="fl">即将揭晓</h3>
                <div class="fr">
					<?php $data=$this->DB()->GetList("select * from `@#_category` where `model`='1' and `parentid` = '0' order by `order` DESC",array("type"=>1,"key"=>'',"cache"=>0)); ?>
					<?php $ln=1;if(is_array($data)) foreach($data AS $categoryx): ?>
					<a href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $categoryx['cateid']; ?>" target="_blank"><?php echo $categoryx['name']; ?></a>
					<?php  endforeach; $ln++; unset($ln); ?>
					<?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
                </div>
            </div>
            <div class="announced-soon clrfix" id="divSoonGoodsList">
				<?php $ln=1;if(is_array($shoplist)) foreach($shoplist AS $shop): ?>
				<div class="soon-list-con">
					<div class="soon-list">
						<ul id="ulGoodsList">
							<li class="g-soon-pic"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?>"><img alt="<?php echo $shop['title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['thumb']; ?>"></a></li>
							<li class="soon-list-name"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?>"><?php echo $shop['title']; ?></a></li>
							<li class="gray">价值：￥<?php echo $shop['money']; ?></li>
							<li class="g-progress"><dl class="m-progress"><dt><b style="width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],266); ?>0px"></"></b></dt><dd><span class="orange fl"><em><?php echo $shop['canyurenshu']; ?></em>已参与</span><span class="gray6 fl"><em><?php echo $shop['zongrenshu']; ?></em>总需人次</span><span class="blue fr"><em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余</span></dd></dl></li>
							<li><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" class="u-now">立即<?php echo _cfg('web_name_two'); ?></a><a href="javascript:;" title="加入到购物车" class="u-cart"><s></s></a></li>
							<div class="Curbor_id" style="display:none;"><?php echo $shop['id']; ?></div>
							<div class="Curbor_yunjiage" style="display:none;"><?php echo $shop['yunjiage']; ?></div>
							<div class="Curbor_shenyu" style="display:none;"><?php echo $shop['shenyurenshu']; ?></div>
						</ul>
					</div>
				</div>
				<?php  endforeach; $ln++; unset($ln); ?>
			</div>
            <div class="check-out"><a href="<?php echo WEB_PATH; ?>/goods_list/" target="_blank" title="查看所有商品">查看所有商品</a></div>
            <!--晒单分享-->
            <div class="g-title">
                <h3 class="fl">晒单分享</h3>
                <div class="m-other fr"><a href="<?php echo WEB_PATH; ?>/go/shaidan/" target="_blank" title="更多" class="u-more">更多</a></div>
            </div>
            <div class="g-single-sun">
                <div class="singleL fl" id="divPostRec">
				<?php $ln=1;if(is_array($shaidan)) foreach($shaidan AS $sd): ?>
					<dl>
						<dt><a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank" title="<?php echo $sd['sd_title']; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['sd_thumbs']; ?>"></a></dt>
						<dd class="u-user">
							<p class="u-head"><a href="<?php echo WEB_PATH; ?>/uname/<?php echo $sd['sd_userid']; ?>" target="_blank" title="<?php echo get_user_name($sd['sd_userid']); ?>"><img alt="<?php echo $sd['sd_title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($sd['sd_userid'],'img','8080'); ?>" width="40" height="40"><i></i></a></p>
							<p class="u-info"><span><a href="<?php echo WEB_PATH; ?>/uname/<?php echo $sd['sd_userid']; ?>" target="_blank" title="<?php echo get_user_name($sd['sd_userid']); ?>"><?php echo get_user_name($sd['sd_userid']); ?></a><em><?php echo date("Y-m-d",$sd['sd_time']); ?></em></span><cite><a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank" title="<?php echo $sd['sd_title']; ?>"><?php echo $sd['sd_title']; ?></a></cite></p>
						</dd>
						<dd class="m-summary"><cite><a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><?php echo _strcut($sd['sd_content'],100); ?></a></cite><b><s></s></b></dd>
					</dl>
					<?php  endforeach; $ln++; unset($ln); ?>
				</div>
                <div class="singleR fl">
                    <ul id="ul_PostList">
					<?php $ln=1;if(is_array($shaidan_two)) foreach($shaidan_two AS $sd): ?>
						<li><a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank" title="<?php echo $sd['sd_title']; ?>"><img alt="<?php echo $sd['sd_title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['sd_thumbs']; ?>"><p title="<?php echo $sd['sd_title']; ?>"><?php echo $sd['sd_title']; ?></p></a></li>
					<?php  endforeach; $ln++; unset($ln); ?>
					</ul>
                </div>
            </div>
        </div>
    </div>
	
<script type="text/javascript">
$(function(){
        $("body1").attr('class','index');
	var sw = 0;
	$(".m-slides .rslides_tabs li a").mouseover(function(){
		sw = $(".rslides_tabs a").index(this);
		myShow(sw);
	});
	function myShow(i){
		$(".m-slides .rslides_tabs li").eq(i).addClass("rslides_here").siblings("li").removeClass("rslides_here");
		$("#slideul li").eq(i).stop(true,true).fadeIn(600).siblings("li").fadeOut(600);
	}
	//滑入停止动画，滑出开始动画
	$("#slideImg,.rslides_nav").hover(function(){
		if(myTime){
		   clearInterval(myTime);
		}
	},function(){
		myTime = setInterval(function(){
		  myShow(sw)
		  sw++;
		  if(sw==<?php echo count($slides); ?>){sw=0;}
		} , 3000);
	});
	//自动开始
	var myTime = setInterval(function(){
	   myShow(sw)
	   sw++;
	   if(sw==<?php echo count($slides); ?>){sw=0;}
	} , 3000);
	$(".next").click(function(){
		myShow(sw)
		sw++;
 		if(sw==<?php echo count($slides); ?>){sw=0;}
	});
	$(".pre").click(function(){
		myShow(sw)
 		if(sw==0){sw=<?php echo count($slides); ?>;}
 		sw--;
	});

})
 var l = $("#myTab_Content0");
        $("#myTab").children().each(function(A, z) {
            var B = $(this);
            B.hover(function() {
                if (A == 0) {
                    B.attr("class", "f-notice-hover").next().attr("class", "");
                    l.show().next().hide()
                } else {
                    B.attr("class", "f-notice-hover").prev().attr("class", "");
                    l.hide().next().show()
                }
            }, function() {})
        });
</script>

<script type="text/javascript">
$(document).ready(function(){
	
	var timer = {};

	$('#m_btn').delegate('li', 'mouseenter', function(){
		var self = $(this);
		var tp = self.attr('data-type');
		clearTimeout(timer[tp]);
		timer[tp] = setTimeout(function(){
			self.addClass('text-d-on');
			$('div[data-panel=' + tp + ']').removeClass('hide');
		},100);
	}).delegate('li', 'mouseleave', function(){
		var self = $(this);
		var tp = self.attr('data-type');
		clearTimeout(timer[tp])
		timer[tp] = setTimeout(function(){
			self.removeClass('text-d-on');
			$('div[data-panel=' + tp + ']').addClass('hide');
		},100);
	});
	
	$(document.body).delegate('div.m_content', 'mouseenter', function(){
		clearTimeout(timer[$(this).attr('data-panel')]);
	}).delegate('div.m_content', 'mouseleave', function(){
		$(this).addClass('hide');
		$('span[data-type='+ $(this).attr('data-panel') +']').removeClass('text-d-on');
	});
	
});
</script>
<script type="text/javascript">
$(function(){
	$("#ulGoodsList a.u-cart").click(function(){ 
		var sw = $("#ulGoodsList a.u-cart").index(this);
		var src = $("#ulGoodsList .g-soon-pic a img").eq(sw).attr('src');				
		var $shadow = $('<img id="cart_dh" style="display:none; border:1px solid #aaa; z-index:99999;" width="200" height="200" src="'+src+'" />').prependTo("body");  			
		var $img = $("#ulGoodsList .g-soon-pic").eq(sw);
		$shadow.css({ 
			'width' : 200, 
			'height': 200, 
			'position' : 'absolute',      
			"left":$img.offset().left+16, 
			"top":$img.offset().top+9,
			'opacity' : 1    
		}).show();
		var $cart = $("#btnMyCart");
		$shadow.animate({   
			width: 1, 
			height: 1, 
			top: $cart.offset().top,    
			left: $cart.offset().left, 
			opacity: 0
		},500,function(){
			Cartcookie(sw,false);
		});	
		
	});
	$("#ulGoodsList a.go_Shopping").click(function(){	
		var sw = $("#ulGoodsList a.go_Shopping").index(this);

		Cartcookie(sw,true); 
	});	
});
//存到COOKIE
function Cartcookie(sw,cook){
	var shopid = $(".Curbor_id").eq(sw).text(),
		shenyu = $(".Curbor_yunjiage").eq(sw).text(),
		money = $(".Curbor_shenyu").eq(sw).text();
	var Cartlist = $.cookie('Cartlist');
	if(!Cartlist){
		var info = {};
	}else{
		var info = $.evalJSON(Cartlist);
	}
	if(!info[shopid]){
		var CartTotal=$("#sCartTotal").text();
			$("#sCartTotal").text(parseInt(CartTotal)+1);
			$("#btnMyCart em").text(parseInt(CartTotal)+1);
	}	
	info[shopid]={};
	info[shopid]['num']=1;
	info[shopid]['shenyu']=shenyu;
	info[shopid]['money']=money;
	info['MoenyCount']='0.00';
	$.cookie('Cartlist',$.toJSON(info),{expires:30,path:'/'});
	if(cook){
		window.location.href="<?php echo WEB_PATH; ?>/member/cart/cartlist";
	}
}
</script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/IndexFun.js"></script>   
<?php include templates("index","footer");?>