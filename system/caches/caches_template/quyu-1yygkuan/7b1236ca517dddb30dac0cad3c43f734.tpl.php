<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>    <header class="g-header">
        <div class="head-l">
	        <a href="javascript:;" onclick="history.go(-1)" class="z-HReturn"><s></s><b>返回</b></a>
        </div>
		<?php if($item['q_end_time']!=''): ?>
        <h2>揭晓结果</h2>
		<div class="head-r">
	        <a href="<?php echo WEB_PATH; ?>/mobile/mobile" class="z-Home"></a>
        </div>
		<?php  else: ?>
		<h2>商品详情</h2>
		<?php include templates("mobile/index","headertop");?>
		<?php endif; ?>
    </header>