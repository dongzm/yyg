<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>
	<?php echo $key; ?>
</title><meta content="app-id=518966501" name="apple-itunes-app" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" /><meta content="yes" name="apple-mobile-web-app-capable" /><meta content="black" name="apple-mobile-web-app-status-bar-style" /><meta content="telephone=no" name="format-detection" />
<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css" rel="stylesheet" type="text/css" />
<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/goods.css" rel="stylesheet" type="text/css" />
<script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
<?php if($shopitem=='itemfun'): ?>
	<script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/goodsInfo.js" language="javascript" type="text/javascript"></script>
<?php  else: ?>
<script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/LotteryDetail.js" language="javascript" type="text/javascript"></script>
<?php endif; ?>
</head>
<body>
<div class="h5-1yyg-v1" id="loadingPicBlock">
    
<!-- 栏目页面顶部 -->


<!-- 内页顶部 -->

<?php include templates("mobile/index","top");?>
<!-- 内页顶部 -->

    <input name="hidGoodsID" type="hidden" id="hidGoodsID" value="<?php echo $itemlist['0']['q_uid']; ?>"/>   <!--上期获奖者id-->
    <input name="hidCodeID" type="hidden" id="hidCodeID" value="<?php echo $item['id']; ?>"/>     <!--本期商品id-->
    <section class="goodsCon pCon">
	    <!-- 导航 -->
        <div id="divPeriod" class="pNav">
            <div class="loading"><b></b>正在加载</div>
    	    <ul class="slides">
    	       <?php echo $loopqishu; ?>
            </ul>
        </div>
		
		<?php 
            $sysj=$item['xsjx_time']-time();
         ?>
        
        <!-- 揭晓信息 -->
        <?php if($item['q_end_time']!=''): ?>
        <div class="pProcess pProcess2">
    	    <div class="pResults">
        	    <div class="pResultsL" onclick="location.href='<?php echo WEB_PATH; ?>/mobile/mobile/userindex/<?php echo $item['q_uid']; ?>'">
            	    <a>
            	        <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($item['q_uid'],'img'); ?>">
            	        <span><?php echo get_user_name($item['q_uid']); ?></span>
            	    </a>
                    <s></s>
                </div>
        	    <div class="pResultsR">
                    <div class="g-snav">
                        <div class="g-snav-lst">总共<?php echo _cfg('web_name_two'); ?><br><dd><b class="orange"><?php echo $gorecode['gonumber']; ?></b><br>人次</dd></div>
                        <div class="g-snav-lst">揭晓时间<br><dd class="gray9"><span><?php echo microt($item['q_end_time']); ?></span></dd></div>
                        <div class="g-snav-lst"><?php echo _cfg('web_name_two'); ?>时间<br><dd class="gray9"><span><?php echo microt($gorecode['time']); ?></span></dd></div>
                    </div>
                </div>
        	    <p><a href="<?php echo WEB_PATH; ?>/mobile/mobile/calResult/<?php echo $item['id']; ?>" class="fr">查看计算结果</a>幸运<?php echo _cfg('web_name_two'); ?>码：<b class="orange"><?php echo $item['q_user_code']; ?></b></p>
            </div>
        </div>
        <?php endif; ?>

        <!-- 产品图 -->
        <div class="pPic pPicBor">
            <div class="pPic2">
    	        <div id="sliderBox" class="pImg">
                    <div class="loading"><b></b>正在加载</div>
                    <ul class="slides">
					<?php $ln=1;if(is_array($item['picarr'])) foreach($item['picarr'] AS $imgtu): ?>  
					<li><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $imgtu; ?>" /></li>
					<?php  endforeach; $ln++; unset($ln); ?> 
                    </ul>
                </div>
            </div>
			<?php if($item['q_end_time']=='' && $item['xsjx_time']!=0): ?>
            <span id="spAutoFlag" class="z-limit-tips">限时揭晓</span>
			 <?php endif; ?>
        </div>
    
        <!-- 条码信息 -->
		
		 
        <div class="pDetails <?php if($item['q_end_time']!=''): ?>pDetails-end<?php endif; ?>">
                <b>(第<?php echo $item['qishu']; ?>期)<?php echo $item['title']; ?> <span></span></b>
                <p class="price">价值：<em class="arial gray">￥<?php echo $item['money']; ?></em></p>
				<div class="Progress-bar">
					<p class="u-progress" title="已完成<?php echo percent($item['canyurenshu'],$item['zongrenshu']); ?>">
						<span class="pgbar" style="width:<?php echo $item['canyurenshu']/$item['zongrenshu']*100; ?>%;">
							<span class="pging"></span>
						</span>
					</p>
					<ul class="Pro-bar-li">
						<li class="P-bar01"><em><?php echo $item['canyurenshu']; ?></em>已参与</li>
						<li class="P-bar02"><em><?php echo $item['zongrenshu']; ?></em>总需人次</li>
						<li class="P-bar03"><em><?php echo $item['zongrenshu']-$item['canyurenshu']; ?></em>剩余</li>
					</ul>
				</div>
			<?php if($item['q_end_time'] !=''): ?>
                <div class="pClosed">本期已揭晓</div>
				<?php if($itemxq==1): ?>
				<div class="pOngoing" codeid="<?php echo $itemzx['id']; ?>">第<em class="arial"><?php echo $itemzx['qishu']; ?></em>期 正在进行中……<span class="fr">查看详情</span></div>
				<?php endif; ?>
           	<?php elseif ($item['zongrenshu']==$item['canyurenshu']): ?>
			  <?php if($item['xsjx_time']!=0): ?>
               <div id="divAutoRTime" class="pSurplus" time="<?php echo $sysj; ?>" timeAlt="<?php echo date('Y-m-d-H',$item['xsjx_time']); ?>"><p><span>限时揭晓</span>剩余时间：<em>00</em>时<em>00</em>分<em>00</em>秒</p></div>
			   <?php endif; ?>
               <div class="pClosed">下手慢了！！ 被抢光啦！！</div>
		    <?php  else: ?>
               <?php if($item['xsjx_time']!=0): ?>			
			  <div id="divAutoRTime" class="pSurplus" time="<?php echo $sysj; ?>" timeAlt="<?php echo date('Y-m-d-H',$item['xsjx_time']); ?>"><p><span>限时揭晓</span>剩余时间：<em>00</em>时<em>00</em>分<em>00</em>秒</p></div>
			  <?php endif; ?>
              <div id="btnBuyBox" class="pBtn" codeid="<?php echo $item['id']; ?>">
				<a href="javascript:;" class="fl buyBtn">立即<?php echo _cfg('web_name_two'); ?></a>
				<a href="javascript:;" class="fr addBtn">加入购物车</a>
			  </div>
			<?php endif; ?>
        </div>
        <!-- 参与记录，商品详细，晒单导航 -->
        <div class="joinAndGet">
    	    <dl>
    	        <a href="<?php echo WEB_PATH; ?>/mobile/mobile/buyrecords/<?php echo $item['id']; ?>"><b class="fr z-arrow"></b>所有<?php echo _cfg('web_name_two'); ?>记录</a>
				<a href="<?php echo WEB_PATH; ?>/mobile/mobile/goodsdesc/<?php echo $item['id']; ?>"><b class="fr z-arrow"></b>图文详情<em>（建议WIFI下使用）</em> </a>
				 
				<a href="<?php echo WEB_PATH; ?>/mobile/mobile/goodspost/<?php echo $item['sid']; ?>"><b class="fr z-arrow"></b>已有<span class="orange arial"><?php echo count($shaidan); ?></span>个幸运者晒单<strong class="orange arial"><?php echo $sum; ?></strong>条评论</a>
				 
            </dl>
            <!-- 上期获得者 -->
			<?php if($item['q_end_time'] =='' and $item['qishu']>1): ?>
			<ul id="prevPeriod" class="m-round" codeid="<?php echo $gorecode['shopid']; ?>" uweb="<?php echo $gorecode['uid']; ?>">
        	    <li class="fl"><s></s><img src="<?php echo G_TEMPLATES_IMAGE; ?>/mobile/loading.gif" src2="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($itemlist[0]['q_uid'],'img'); ?>"/></li>
                <li class="fr"><b class="z-arrow"></b></li>
                <li class="getInfo">
            	    <dd>
					<em class="blue"><?php echo get_user_name($itemlist[0]['q_uid']); ?></em>(<?php echo get_ip($gorecode['id'],'ipcity'); ?>) 
					</dd>
                    <dd>总共<?php echo _cfg('web_name_two'); ?>：<em class="orange arial"><?php echo $gorecode['gonumber']; ?></em>人次</dd>
                    <dd>幸运<?php echo _cfg('web_name_two'); ?>码：<em class="orange arial"><?php echo $gorecode['huode']; ?></em></dd>
                    <dd>揭晓时间：<?php echo microt($itemlist[0]['q_end_time']); ?></dd>								   
                    <dd><?php echo _cfg('web_name_two'); ?>时间：<?php echo microt($gorecode['time']); ?></dd>
                </li>
            </ul>
			<?php endif; ?>
            
        </div>
    </section>
    
<?php include templates("mobile/index","footer");?>
<script language="javascript" type="text/javascript">
  var Path = new Object();
  Path.Skin="<?php echo G_TEMPLATES_STYLE; ?>";  
  Path.Webpath = "<?php echo WEB_PATH; ?>";
  
var Base = {
    head: document.getElementsByTagName("head")[0] || document.documentElement,
    Myload: function(B, A) {
        this.done = false;
        B.onload = B.onreadystatechange = function() {
            if (!this.done && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) {
                this.done = true;
                A();
                B.onload = B.onreadystatechange = null;
                if (this.head && B.parentNode) {
                    this.head.removeChild(B)
                }
            }
        }
    },
    getScript: function(A, C) {
        var B = function() {};
        if (C != undefined) {
            B = C
        }
        var D = document.createElement("script");
        D.setAttribute("language", "javascript");
        D.setAttribute("type", "text/javascript");
        D.setAttribute("src", A);
        this.head.appendChild(D);
        this.Myload(D, B)
    },
    getStyle: function(A, B) {
        var B = function() {};
        if (callBack != undefined) {
            B = callBack
        }
        var C = document.createElement("link");
        C.setAttribute("type", "text/css");
        C.setAttribute("rel", "stylesheet");
        C.setAttribute("href", A);
        this.head.appendChild(C);
        this.Myload(C, B)
    }
}
function GetVerNum() {
    var D = new Date();
    return D.getFullYear().toString().substring(2, 4) + '.' + (D.getMonth() + 1) + '.' + D.getDate() + '.' + D.getHours() + '.' + (D.getMinutes() < 10 ? '0': D.getMinutes().toString().substring(0, 1))
}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js');


</script>
<script>
$(function(){
  $(".blue").click(function(){
   
     url="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($itemlist[0]['q_uid']); ?>";
	 window.location.href=url;
  
  });
  
  $(".orange.arial").click(function(){
     url="<?php echo WEB_PATH; ?>/mobile/mobile/dataserver/<?php echo $itemlist['0']['id']; ?>";
	 window.location.href=url;
  
  });

})

</script>
</div>
</body>
</html>
