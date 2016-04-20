<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header");?>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/Help.css"/>
<div class="help-main">
	<div id="ltlContents" class="help-right-part">
		<div class="help-right-part">
			<div class="help-in-rihgt-part">
				<h2><?php echo $article['title']; ?></h2>
				<style>
				.help-nav ul li a.cur<?php echo $article['id']; ?>{color:#f60;  position:relative; font-weight:bold;}
				.help-nav ul li a.cur<?php echo $article['id']; ?> b{width:4px; height:4px; overflow:hidden; background:#f60; display:inline-block; position:absolute; left:-10px; top:5px;}
				</style>
				<div class="help-content">
					<?php echo $article['content']; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="help-left-part">
		<div class="help-nav">
			<h3>帮助中心</h3>			
            <?php $category=$this->DB()->GetList("select * from `@#_category` where `parentid`='1'",array("type"=>1,"key"=>'',"cache"=>0)); ?>
			<?php $ln=1;if(is_array($category)) foreach($category AS $help): ?>
			<h4><?php echo $help['name']; ?></h4>
			<ul>
				<?php echo help($help['cateid']); ?>
			</ul>
			<div class="hackbox"></div>
			<?php  endforeach; $ln++; unset($ln); ?>
            <?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
		</div>
		<div class="help-contact">
			<p>如果不能在帮助内容中找到答案，或者您有其他建议、投诉，您还可以：</p>
			<ul>
				<li class="CustomerCon"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cfg('qq'); ?>&site=qq&menu=yes" target="_blank" class="Customer"><b></b>在线客服</a></li>
				<li>电话客服热线(免长途费)</li>
				<li class="tel"><span><?php echo _cfg('cell'); ?></span></li>
			</ul>
		</div>
	</div>
</div>
<?php include templates("index","footer");?>