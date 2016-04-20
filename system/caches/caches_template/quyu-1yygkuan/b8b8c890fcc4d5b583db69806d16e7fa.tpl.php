<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>﻿<footer class="footer">
	<div class="u-ft-nav" id="fLoginInfo">
	    <span><a href="<?php echo WEB_PATH; ?>/mobile/mobile/">首页</a><b></b></span>
		<span><a href="<?php echo WEB_PATH; ?>/mobile/mobile/about">新手指南</a><b></b></span>
		<span><a href="<?php echo WEB_PATH; ?>/mobile/user/login">登录</a><b></b></span>
		<span><a href="<?php echo WEB_PATH; ?>/mobile/user/register">注册</a></span>
	</div>
	<p class="m-ftA"><a href="<?php echo WEB_PATH; ?>/mobile/mobile">触屏版</a><a href="<?php echo G_WEB_PATH; ?>" target="_blank">电脑版</a></p>
	<p class="grayc">客服热线<span class="orange"><?php echo _cfg("cell"); ?></span><?php echo _cfg('web_copyright'); ?></p>
	<a id="btnTop" href="javascript:;" class="z-top" style="display:none;"><b class="z-arrow"></b></a>
	<!--APP导航开始-->
    <nav class="appnavs">
	    <div class="wrapapps">
	    	<div id="appnavautos1">
					<a href="<?php echo WEB_PATH; ?>/mobile/mobile/"><img src="<?php echo G_TEMPLATES_IMAGE; ?>/wap_img/appnava1.png"></a>
			</div>
	    </div>
	    <div class="wrapapps">
	    	<div id="appnavautos2">
					<a href="<?php echo WEB_PATH; ?>/mobile/mobile/glist"><img src="<?php echo G_TEMPLATES_IMAGE; ?>/wap_img/appnava2.png"></a>
			</div>
	    </div>
	    <div class="wrapapps">
	    	<div id="appnavautos3">
					<a href="<?php echo WEB_PATH; ?>/mobile/mobile/lottery"><img src="<?php echo G_TEMPLATES_IMAGE; ?>/wap_img/appnava3.png"></a>
			</div>
	    </div>
	    <div class="wrapapps">
	    	<div id="appnavautos4">
					<a href="<?php echo WEB_PATH; ?>/mobile/cart/cartlist"><img src="<?php echo G_TEMPLATES_IMAGE; ?>/wap_img/appnava4.png"></a>
			</div>
	    </div>
	    <div class="wrapapps">
	    	<div id="appnavautos5">
					<a href="<?php echo WEB_PATH; ?>/mobile/user/login"><img src="<?php echo G_TEMPLATES_IMAGE; ?>/wap_img/appnava5.png"></a>
			</div>
	    </div>
    </nav>
</footer>