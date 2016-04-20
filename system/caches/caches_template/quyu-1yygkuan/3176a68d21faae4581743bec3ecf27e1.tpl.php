<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!-- 栏目页面顶部 -->

    <header class="header">
        <h1 class="fl"><span><?php echo $webname; ?></span><a href="<?php echo WEB_PATH; ?>/mobile/mobile"><img src="/images/logo.png"/></a></h1>
        <div class="fl u-slogan"></div>
        <div class="fr head-r">
            <a href="<?php echo WEB_PATH; ?>/mobile/user/login" class="z-Member"></a>
            <a id="btnCart" href="<?php echo WEB_PATH; ?>/mobile/cart/cartlist" class="z-shop"></a>
        </div>
    </header> 
    <!-- 栏目导航 -->
    <!--
    <nav class="g-snav u-nav">
	    <div class="g-snav-lst"><a href="<?php echo WEB_PATH; ?>/mobile/mobile/" <?php if($key=="首页" ): ?>class="nav-crt"<?php endif; ?>>首页</a> <?php if($key=="首页" ): ?><s class="z-arrowh"></s><?php endif; ?></div>
		
	    <div class="g-snav-lst"><a href="<?php echo WEB_PATH; ?>/mobile/mobile/glist" <?php if($key=="所有商品" ): ?>class="nav-crt"<?php endif; ?>>所有商品</a><?php if($key=="所有商品" ): ?><s class="z-arrowh"></s><?php endif; ?></div>
		
	    <div class="g-snav-lst"><a href="<?php echo WEB_PATH; ?>/mobile/mobile/lottery" <?php if($key=="最新揭晓" ): ?>class="nav-crt"<?php endif; ?>>最新揭晓</a><?php if($key=="最新揭晓" ): ?><s class="z-arrowh"></s><?php endif; ?></div>
		
	    <div class="g-snav-lst"><a href="<?php echo WEB_PATH; ?>/mobile/shaidan/" <?php if($key=="晒单" ): ?>class="nav-crt"<?php endif; ?>>晒单</a><?php if($key=="晒单" ): ?><s class="z-arrowh"></s><?php endif; ?></div>
		
	       <div class="g-snav-lst"><a href="<?php echo WEB_PATH; ?>/mobile/autolottery" <?php if($key=="限时" ): ?>class="nav-crt"<?php endif; ?>>充值</a><?php if($key=="限时" ): ?><s class="z-arrowh"></s><?php endif; ?></div>
    </nav>
    -->
    <!--APP导航开始-->
      <!--
    <nav class="appnavs">
	    <div class="wrapapps">
	    	<div id="appnavautos1">
					<a href="<?php echo WEB_PATH; ?>/?/mobile/mobile/"><img src="/images/appnava1.png"></a>
			</div>
	    </div>
	    <div class="wrapapps">
	    	<div id="appnavautos2">
					<a href="<?php echo WEB_PATH; ?>/?/mobile/mobile/glist"><img src="/images/appnava2.png"></a>
			</div>
	    </div>
	    <div class="wrapapps">
	    	<div id="appnavautos3">
					<a href="<?php echo WEB_PATH; ?>/?/mobile/mobile/lottery"><img src="/images/appnava3.png"></a>
			</div>
	    </div>
	    <div class="wrapapps">
	    	<div id="appnavautos4">
					<a href="<?php echo WEB_PATH; ?>/?/mobile/cart/cartlist"><img src="/images/appnava4.png"></a>
			</div>
	    </div>
	    <div class="wrapapps">
	    	<div id="appnavautos5">
					<a href="<?php echo WEB_PATH; ?>/?/mobile/user/login"><img src="/images/appnava5.png"></a>
			</div>
	    </div>
    </nav>
    -->