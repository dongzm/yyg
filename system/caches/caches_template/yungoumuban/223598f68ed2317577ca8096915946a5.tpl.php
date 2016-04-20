<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>官方微信_<?php echo _cfg('web_name_two'); ?></title>
<meta name="keywords" content="<?php if(isset($keywords)): ?><?php echo $keywords; ?><?php  else: ?><?php echo _cfg("web_key"); ?><?php endif; ?>" />
<meta name="description" content="<?php if(isset($description)): ?><?php echo $description; ?><?php  else: ?><?php echo _cfg("web_des"); ?><?php endif; ?>" />
  
    <link rel="stylesheet" type="text/css" href="<?php echo G_WEB_PATH; ?>/app/css/Comm.css?date=20140731" />
<!--[if IE 6]>
    <script type="text/javascript" src="http://skin.1yyg.com/js/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('span.Hicon,a.F-icon-guest s,a.F-icon-gray s,s.u-banner-close,.F-number-l,.F-number-r,.M-nav-help a s,.g-good-faith li s,a.pre,a.next,.u-topic-icon i,.u-topic-icon s,.M-security a s,.roll_close a');
    </script>
<![endif]-->
  <link rel="stylesheet" type="text/css" href="<?php echo G_WEB_PATH; ?>/app/css/layout.css?date=20141013" />
    <script language="javascript" type="text/javascript" src="<?php echo G_WEB_PATH; ?>/app/js/JQuery132.js"></script>
</head>
<body>
    <div class="tContent">
        <div class="tMain">
            <div class="tHead">
                <ul>
                    <li class="tLogo"><a href="<?php echo G_WEB_PATH; ?>" class="tHome"><img src="<?php echo G_UPLOAD_PATH; ?>/logo2.png" /></a><img src="app/images/line.gif" class="line" /><a href="/?/go/index/weixin" title="官方微信" class="txt">官方微信</a></li>
                    <li class="tNav">
                        <a href="<?php echo G_WEB_PATH; ?>" title="首页" class="tReturn">首页</a>
                       <a href="<?php echo G_WEB_PATH; ?>/?/go/index/touch" title="触屏版" >触屏版</a>
                        <a href="<?php echo G_WEB_PATH; ?>/?/go/index/app" title="手机版">手机版</a>
                        <a href="<?php echo G_WEB_PATH; ?>/?/go/index/desktop" title="桌面版">桌面版</a>
                        <a href="<?php echo G_WEB_PATH; ?>/?/go/index/weixin" title="微信关注" class="current">微信关注</a>
                    </li>
                </ul>
            </div>
      </div>
         <div class="mPic2">
         	<div class="mPic">
                <ul>
                    <li class="pic1"></li>
                    <li class="pic2"></li>
                    <li class="pic3">没有安装微信？ <a href="http://weixin.qq.com/" title="点击这里下载安装" target="_blank">点击这里下载安装>></a></li>
                </ul>
            </div>
         </div>
         <div class="tMain">
            <div class="mMode">
                <div class="tTitle">关注方式</div>
                <ul>
                    <li>
                        <dd><img src="app/images/pic_23.jpg" /></dd>
                        <dd class="mt60"><img src="app/images/pic_24.jpg" /></dd>
                    </li>
                    <li>
                        <dd class="mt60"><img src="app/images/pic_25.jpg" /></dd>
                        <dd><img src="app/images/pic_26.jpg" /></dd>
                    </li>
                    <li>
                        <dd><img src="app/images/pic_27.jpg" /></dd>
                        <dd class="mt60"><img src="app/images/pic_28.jpg" /></dd>
                    </li>
                </ul>
            </div>
      </div>
</div>
   
<?php include templates("index","footer");?>
