<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="<?php if(isset($keywords)): ?><?php echo $keywords; ?><?php  else: ?><?php echo _cfg("web_key"); ?><?php endif; ?>" />
    <meta name="description" content="<?php if(isset($description)): ?><?php echo $description; ?><?php  else: ?><?php echo _cfg("web_des"); ?><?php endif; ?>" />
    <title><?php if(isset($title)): ?><?php echo $title; ?><?php  else: ?><?php echo _cfg("web_name"); ?><?php endif; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/header.css" />
    <link href="<?php echo G_TEMPLATES_STYLE; ?>/css/register.css" rel="stylesheet" type="text/css" />
   <!--[if IE 6]>
       <script type="text/javascript" src="/iepng.js"></script>
       <script type="text/javascript">
       EvPNG.fix('.search a.seaIcon i,.m-menu-all h3 em,.nav-cart-btn i.f-cart-icon,a.u-cart s,.u-mui-tab a.u-menus s,.u-mui-tab li.f-cart a.u-menus i,.u-mui-tab li.f-both-top a.u-menus,.u-mui-tab li.f-both-bottom a.u-menus,.F_goods_rq, .F_goods_xp, .F_goods_tj,.i-ctrl a s,.g-list li cite,.f-list-sorts li.m-value s');
       </script>
   <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/index2.css?date=20140731">
     <link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/Comm1.css?date=20140731">
    <script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/jquery.cookie.js"></script>
    
</head>
<body>
<style>
.g-nav a {
font-size: 16px;
}
.g-toolbar {width: 100%;height: 36px;border-bottom: 1px solid #ddd;position: relative;z-index: 99;background: #fff;-moz-box-shadow: 1px 1px 1px #f7f7f7;-webkit-box-shadow: 1px 1px 1px #f7f7f7;box-shadow: 1px 1px 1px #f7f7f7;}
.g-toolbar .w1190 {margin: 0 auto;}
.fl, .fl-img {float: left;}
ol, ul {list-style: none;}
div, ul, li, dl, dt, dd, table, td, input {font-size: 12px;}
.g-toolbar li {float: left;height: 36px;position: relative;z-index: 0;}
li {list-style: none;}
.g-toolbar li .u-menu-hd {float: left;height: 20px;line-height: 18px;padding: 8px 17px;position: relative;z-index: 93;}
.g-toolbar li a {color: #666;}
a:focus, a:link {outline: none;}
a:link, a:visited {text-decoration: none;}
a {text-decoration: none;color: #666;margin: 0;padding: 0;word-break: break-all;}
.g-toolbar li.u-arr, .g-toolbar li.u-arr-1yyg, .g-toolbar li.u-arr-news {position: relative;}
.g-toolbar li.u-arr .u-menu-hd {width: 79px;padding: 8px 17px 8px;_padding: 9px 17px 7px;}
.g-toolbar li .u-menu-hd {float: left;height: 20px;line-height: 18px;padding: 8px 17px;position: relative;z-index: 93;}
.g-toolbar li a {color: #666;}

.g-toolbar li.u-arr .u-select {width: 91px;height: 93px;padding: 7px 0 3px;text-align: center;}
.g-toolbar li .u-select {background: #fff;position: absolute;top: 36px;left: 0;z-index: 90;border: 1px solid #ddd;border-top: 0 none;display: none;overflow: hidden;}
* {padding: 0;margin: 0;}
.g-toolbar li.u-arr .u-select a {line-height: 20px;text-align: center;}
.g-toolbar li.u-arr .u-select img {display: block;width: 66px;height: 66px;margin: 0 auto 3px;}
.g-toolbar li.f-gap s {width: 0;height: 12px;font-size: 0;display: inline-block;border-left: 1px solid #ddd;overflow: hidden;margin: 12px 0;}
.g-toolbar li {float: left;height: 36px;position: relative;z-index: 0;}
.fr {float: right;}
.g-toolbar li {float: left;height: 36px;position: relative;z-index: 0;}
.g-toolbar li .u-select span {display: block;padding-left: 17px;text-align: left;margin-bottom: 7px;}
.g-toolbar li.u-arr .u-select a {text-align: center;}
h1, h2, h3, h4, h5, h6 {font-size: 100%;}
a.u-service-off i {background: url(/statics/templates/quyu-1yygkuan/images/service-off-2014.gif) no-repeat;}
a.u-service i {display: block;float: left;width: 24px;height: 24px;cursor: pointer;}
.g-toolbar li i {display: block;float: left;background-position: 0 0;position: relative;top: -2px;left: -2px;_left: 0;}
.g-header {clear: both;height: 110px;}
.g-header .w1190 {position: relative;}
.logo_1yyg {width: 260px;height: 110px;background-repeat: no-repeat;}
.logo_1yyg a.logo {float: left;display: block;width: 122px;height: 74px;margin: 18px 0;}
a:hover {color: #f60;}
fieldset, img {border: 0;}
.search_cart_wrap {width: 930px;position: relative;z-index: 0;}
.number {width: 380px;height: 29px;margin-left: 115px;text-align: center;padding-top: 59px;}
.number ul {float: left;position: relative;}
.number li.gray6 {width: 56px;font-size: 14px;line-height: 29px;_line-height: 31px;}
.number li.nobor {width: 10px;border: 0 none;}
.number a li {display: block;width: 21px;color: #f60;position: relative;}
.number li {float: left;display: block;font-size: 24px;height: 27px;line-height: 27px;text-align: center;margin: 0 2px;border-radius: 1px;border: 1px solid #ddd;overflow: hidden;}
.gray6, a.gray6:link, a.gray6:visited {color: #666;}
.gray6, a.gray6:link, a.gray6:visited {color: #666;}
.gray6 {color: #666!important;}
.number li cite {display: block;width: 21px;position: absolute;top: 0;left: 0;z-index: 1;}
.number li em {display: block;width: 21px;}
.number li i {width: 196px;height: 0;border-top: 1px solid #ededed;position: absolute;top: 13px;left: 0;z-index: 0;}
.number li.nobor {width: 10px;border: 0 none;}
.number li.u-secondary {width: 40px;position: relative;text-align: left;}
.number li.u-secondary b {border-style: solid;border-width: 4px 0 4px;border-color: #fff;border-left: 4px solid rgb(102,102,102);width: 0;height: 0;font-size: 0;line-height: 0;position: absolute;left: 33px;top: 11px;}
.number li.u-secondary b s {border-style: solid;_border-style: dashed;border-width: 3px;border-color: transparent;border-left-width: 0;border-left: 3px solid #fff;width: 0;height: 0;font-size: 0;line-height: 0;position: absolute;top: -3px;left: -5px;}
s, strike, del {text-decoration: line-through;}
.search {width: 320px;position: absolute;top: 50px;right: 0;}
.search .form {float: left;border: 1px solid #ccc;border-right: 0 none;width: 280px;height: 36px;position: relative;}
.search .form input {position: absolute;left: 0;top: 0;z-index: 0;color: #bbb;width: 145px;height: 18px;line-height: 18px;border: 0 none;padding: 9px 130px 9px 5px;font: 12px/150% "\5FAE\8F6F\96C5\9ED1",Arial;outline: 0;}
body, button, input, select, textarea {margin: 0 auto;font: 12px tahoma,arial,'Hiragino Sans GB',\5b8b\4f53,sans-serif;}
.search .form span {height: 36px;position: absolute;top: 0;right: 0;z-index: 10;}
.search .form span a {display: block;float: left;width: 35px;height: 20px;line-height: 20px;background: #eee;color: #666;margin: 8px 7px 0 0;display: inline;text-align: center;cursor: pointer;}
.search a.seaIcon {display: block;float: left;width: 39px;height: 30px;background: #f60;padding-top: 8px;cursor: pointer;}
.search a.seaIcon i {display: block;width: 21px;height: 21px;background-position: 0 0;margin: 0 auto;}
.search a.seaIcon i, .m-menu-all h3 em, .nav-cart-btn i.f-cart-icon, a.u-cart s, .u-mui-tab li.f-cart a.u-menus i {display: block;background-image: url(/statics/templates/quyu-1yygkuan/images/head-2014.png?v=141124);background-repeat: no-repeat;}
.g-nav {width: 1190px;height: 40px;line-height: 40px;margin: 0 auto;background: #f60;color: #fff;}
.g-nav .w1190 {position: relative;z-index: 20;}
.w1190 {clear: both;width: 1190px;margin: 0 auto;}
.m-menu {width: 240px;height: 40px;float: left;background: #2af;position: relative;z-index: 60;}
.m-menu-all {width: 240px;position: absolute;left: 0;top: 0;z-index: 20;}
.m-menu-all h3 a {display: block;width: 222px;height: 40px;padding-left: 18px;position: relative;z-index: 5;color: #fff;}
.m-menu-all h3 em {display: block;width: 16px;height: 10px;background-position: -27px 0;position: absolute;right: 16px;top: 15px;}
.m-all-sort {display: block;}
.m-all-sort {width: 238px;height: 438px;background: #fff;border: 1px solid #21a5f7;border-top: 0 none;position: absolute;left: 0;top: 40px;z-index: 200;overflow: hidden;}
.m-all-sort dl.hover {background: #fffdf0;width: 238px;height: 42px;padding: 13px 0 18px;position: relative;z-index: 10;}
.m-all-sort dl {clear: both;border-top: 1px solid #e6e6e6;margin-top: -1px;padding: 13px 0 18px;height: 42px;line-height: 25px;overflow: hidden;}
.m-all-sort dl.hover dt a {color: #f60;}
.m-all-sort dl a {margin-left: 15px;color: #666;}
.m-all-sort dt a {font-size: 15px;color: #333;}
.m-all-sort dl {clear: both;border-top: 1px solid #e6e6e6;margin-top: -1px;padding: 13px 0 18px;height: 42px;line-height: 20px;overflow: hidden;}
body.home .nav-main li.f-nav-home, body.lottery .nav-main li.f-nav-lottery, body.share .nav-main li.f-nav-share, body.group .nav-main li.f-nav-group, body.cooperation .nav-main li.f-nav-invite, body.helper .nav-main li.f-nav-guide {background: #f04900;line-height: 40px;}
.nav-main li {float: left;}
.nav-main li a {display: block;padding: 0 30px;color: #fff;}
.nav-cart {width: 135px;height: 40px;background: #2af;position: relative;z-index: 20;}
.nav-cart-con {width: 239px;background: #fff;border: 1px solid #2af;position: absolute;right: 0;_right: -1px;z-index: 20;font-size: 2px;display: none;overflow: hidden;}
.nav-cart-con .m-loading-2014 {height: 100px;position: relative;display: none;}
.nav-cart-con .m-loading-2014 em {background: url(/statics/templates/quyu-1yygkuan/images/goods_loading2.gif) no-repeat;width: 50px;height: 50px;position: absolute;top: 25px;left: 94px;}
.nav-car-cartEmpty {text-align: center;font-size: 14px;height: 100px;padding: 30px 0;line-height: 50px;position: relative;display: none;color: #666;text-align: center;}
.nav-car-cartEmpty i {display: block;width: 54px;height: 53px;background-position: 0 -30px;margin: 0 auto;}
.m-ser li .u-icons, .g-special li em, .nav-car-cartEmpty i, .u-cartEmpty i {display: block;background-image: url(/statics/templates/quyu-1yygkuan/images/comm-2014.gif?v=1411112);background-repeat: no-repeat;}
.nav-cart-select {clear: both;width: 239px;overflow: hidden;}
.nav-cart-pay {clear: both;}
.nav-cart-btn i.f-cart-icon {display: block;width: 21px;height: 20px;float: left;background-position: 0 -34px;position: absolute;top: 10px;left: 17px;display: inline;}
.nav-cart-btn a {display: block;color: #fff;height: 40px;line-height: 40px;padding-left: 42px;position: relative;cursor: pointer;}




toubu  yishang

.g-content {
clear: both;
}.home-banner {
width: 710px;
margin-left: 240px;
display: inline;
float: left;
}
.what-1yyg a {
display: block;
width: 208px;
height: 108px;
padding: 5px 15px;
}
.slide-scroll {
width: 709px;
height: 300px;
position: relative;
overflow: hidden;
border-right: 1px solid #ddd;
}.m-guide-con {
width: 709px;
height: 300px;
position: absolute;
left: 0;
top: 0;
z-index: 5;
}.m-guideBg {
width: 709px;
height: 300px;
background: #000;
filter: alpha(opacity=80);
-moz-opacity: 0.8;
-khtml-opacity: 0.8;
opacity: 0.8;
position: absolute;
top: 0;
left: 0;
z-index: 0;
}.m-guide {
width: 709px;
height: 300px;
position: absolute;
top: 0;
left: 0;
z-index: 10;
}.m-guide li {
width: 618px;
height: 300px;
margin: 0 auto;
}.m-guide li.f-step1 a {
width: 170px;
height: 55px;
top: 190px;
left: 433px;
}.m-guide li a {
display: block;
position: absolute;
background: #fff;
opacity: 0;
filter: alpha(opacity=0);
}.m-guide li img {
width: 618px;
}.m-guide li.f-step2 a {
width: 146px;
height: 56px;
top: 217px;
left: 518px;
}.m-guide li.f-step3 a {
width: 150px;
height: 56px;
top: 214px;
left: 497px;
}.m-guide li.f-step4 a {
width: 170px;
height: 56px;
top: 215px;
left: 473px;
}.m-guide li.f-step5 a {
width: 150px;
height: 55px;
top: 123px;
left: 470px;
z-index: 12;
}.m-guide li.f-step6 a {
width: 228px;
height: 54px;
top: 191px;
left: 360px;
}.m-guide a.m-guide-close {
background: url(/statics/templates/quyu-1yygkuan/images/step-close.gif?v=141111) no-repeat;
width: 30px;
height: 30px;
display: block;
position: absolute;
right: 0;
top: 0;
}.u-guide-arrow a.u-guide-prev {
left: 0;
}.u-guide-arrow a.u-guide-prev s {
background-position: 0 0;
}.u-guide-arrow a s {
display: block;
background-image: url(/statics/templates/quyu-1yygkuan/images/guide-arrow-2014.gif?v=141111);
background-repeat: no-repeat;
width: 14px;
height: 39px;
}.u-guide-arrow a.u-guide-next {
right: 0;
}.u-guide-arrow a.u-guide-next s {
background-position: -28px -40px;
}.u-guide-arrow a s {
display: block;
background-image: url(/statics/templates/quyu-1yygkuan/images/guide-arrow-2014.gif?v=141111);
background-repeat: no-repeat;
width: 14px;
height: 39px;
}
.m-slides {
width: 750px;
height: 298px;
overflow: hidden;
position: relative;
}.rslides_nav.next {
right: 0;
left: auto;
}.rslides_tabs {
clear: both;
text-align: center;
position: absolute;
bottom: 18px;
z-index: 99;
float: left;
left: 50%;
}.rslides_tabs li {
margin: 0 3px;
float: left;
right: 50%;
position: relative;
}.rslides_tabs .rslides_here a {
background: #f60;
width: 20px;
opacity: 1;
}.rslides_tabs a {
text-indent: -9999px;
overflow: hidden;
-webkit-border-radius: 15px;
-moz-border-radius: 15px;
border-radius: 15px;
background: #000;
display: inline-block;
_display: block;
width: 12px;
height: 12px;
filter: alpha(opacity=50);
-moz-opacity: 0.5;
-khtml-opacity: 0.5;
opacity: 0.5;
cursor: pointer;
}.slide-comd {
clear: both;
width: 710px;
height: 137px;
}.slide-comd .commodity {
width: 315px;
height: 111px;
float: left;
margin-left: -1px;
border: 1px solid #ddd;
border-left: 0 none;
padding: 13px 20px;
overflow: hidden;
}.commodity li.comm-info {
width: 170px;
padding-top: 10px;
}.commodity li.comm-info span {
font-size: 14px;
line-height: 21px;
height: 43px;
overflow: hidden;
display: block;
word-break: break-all;
}.commodity li.comm-info a {
color: #333;
}.commodity li.comm-info p {
display: block;
padding-top: 6px;
}.commodity li.comm-info p em {
margin: 0 3px;
}.orange, a.orange:link, a.orange:visited {
color: #F60;
}.commodity li.comm-pic {
width: 110px;
height: 110px;
position: relative;
}.commodity li {
height: 110px;
}address, cite, dfn, em, var {
font-style: normal;
}.commodity li.comm-pic span.F_goods_xp {
background-position: -119px 0;
}.commodity li.comm-pic a span {
width: 39px;
height: 39px;
position: absolute;
top: -7px;
left: -7px;
text-align: center;
line-height: 39px;
}.F_goods_rq, .F_goods_xp, .F_goods_tj {
background-image: url(/statics/templates/quyu-1yygkuan/images/index-2014.png?v=141118);
background-repeat: no-repeat;
}.commodity li.comm-pic a span i {
color: #fff;
font-size: 12px;
width: 39px;
height: 39px;
text-align: center;
line-height: 39px;
position: absolute;
top: 0;
left: 0;
z-index: 5;
overflow: hidden;
}
.home-event {
width: 239px;
border-right: 1px solid #ddd;
}.what-1yyg {
height: 118px;
border-top: 1px solid #ddd;
border-bottom: 1px solid #ddd;
overflow: hidden;
}.honesty {
float: left;
height: 169px;
padding-top: 11px;
}.honesty ul {
display: inline-block;
}.honesty li {
float: left;
width: 70px;
text-align: center;
margin: 8px 0 8px 7px;
display: inline;
}.honesty li a {
color: #666;
height: 65px;
display: block;
cursor: pointer;
}.honesty li i.i1 {
background-position: 0 0;
}.honesty li i {
display: block;
width: 37px;
height: 37px;
margin: 0 auto 5px;
-webkit-transition: all .3s ease-in-out;
-moz-transition: all .3s ease-in-out;
-o-transition: all .3s ease-in-out;
-ms-transition: all .3s ease-in-out;
transition: all .3s ease-in-out;
}.honesty li i, .index_news b, .m-other a.u-more {
background-image: url(/statics/templates/quyu-1yygkuan/images/index_honesty-2014.gif?v=141124);
background-repeat: no-repeat;
}
.honesty li i.i2 {
background-position: -39px 0;
}.honesty li i.i3 {
background-position: -80px 0;
}.honesty li i.i4 {
background-position: 0 -40px;
}.honesty li i.i5 {
background-position: -39px -40px;
}.honesty li i.i6 {
background-position: -79px -40px;
}.index_news {
clear: both;
height: 122px;
border-top: 1px solid #ddd;
border-bottom: 1px solid #ddd;
padding: 15px 5px 0 15px;
}.index_news dt {
font-size: 18px;
color: #333;
}.index_news dd {
display: block;
height: 22px;
line-height: 22px;
margin-top: 6px;
overflow: hidden;
word-break: break-all;
}.index_news dd b {
float: left;
display: block;
background-position: -123px 0;
width: 3px;
height: 3px;
position: relative;
top: 10px;
margin-left: 2px;
display: inline;
}.index_news dd a {
color: #666;
font-size: 14px;
word-break: break-all;
height: 22px;
line-height: 22px;
display: block;
margin-left: 10px;
}.g-title {
clear: both;
height: 36px;
line-height: 36px;
padding: 10px 0;
}.g-title h3 {
font-size: 22px;
color: #333;
}.g-title h3 span {
display: inline-block;
color: #999;
font-size: 14px;
position: relative;
top: 2px;
_top: 0;
padding-left: 5px;
}.g-title h3 span em {
margin: 0 3px;
}.orange, a.orange:link, a.orange:visited {
color: #F60;
}.m-other cite {
display: block;
padding-top: 4px;
}.m-other a {
float: left;
color: #f60;
font-size: 14px;

}.m-other a.u-more {
display: block;
width: 36px;
height: 36px;
line-height: 36px;
background-position: -132px 0;
font-size: 12px;
color: #999;
text-align: center;
margin-left: 5px;
display: inline;
}.honesty li i, .index_news b, .m-other a.u-more {
background-image: url(/statics/templates/quyu-1yygkuan/images/index_honesty-2014.gif?v=141124);
background-repeat: no-repeat;
}
.m-other a.u-more:hover{background-position:-132px -40px;text-decoration:none;color:#f60;}
.g-hot {
position: relative;
}.g-hot {
clear: both;
width: 1190px;
height: 713px;
overflow: hidden;
}.g-hotL {
width: 948px;
height: 713px;
position: relative;
z-index: 5;
}.g-hotL-list:hover {
position: relative;
z-index: 2;
}.g-hotL-list {
float: left;
width: 236px;
height: 356px;
margin-bottom: -1px;
position: relative;
z-index: 0;
display: inline-block;
}.g-hotL-list:hover .g-hotL-con {
border: 1px solid #f60;
position: absolute;
top: 0;
left: 0;
-moz-box-shadow: 3px 3px 3px #d8d8d8;
-webkit-box-shadow: 3px 3px 3px #d8d8d8;
box-shadow: 3px 3px 3px #d8d8d8;
}.g-hotL-con {
width: 216px;
height: 325px;
border: 1px solid #ddd;
border-right: 0 none;
padding: 15px 10px;
position: absolute;
z-index: 1;
display: inline-block;
overflow: hidden;
}.g-hotL-list li.g-hot-pic {
float: left;
width: 178px;
height: 178px;
margin: 0 19px;
display: inline;
}.g-hotL-list li {
font-size: 14px;
}.g-hotL-list li a {
clear: both;
color: #333;
}.g-hotL-list li img {
display: block;
width: 178px;
height: 178px;
}.g-hotL-list li.g-hot-name {
clear: both;
width: 216px;
height: 20px;
line-height: 20px;
padding-top: 12px;
overflow: hidden;
word-break: break-all;
}.g-hotL-list li.gray {
line-height: 18px;
font-size: 12px;
}.g-hotL-list li.g-progress {
float: left;
height: 48px;
margin: 7px 0;
overflow: hidden;
}.g-progress dl.m-progress {
width: 216px;
overflow: hidden;
}dl.m-progress {
width: 216px;
font-size: 12px;
overflow: hidden;
}.g-progress dl.m-progress dt {
width: 216px;
height: 6px;
overflow: hidden;
background: #ddd;
margin-bottom: 5px;
}dl.m-progress dt {
width: 216px;
height: 6px;
overflow: hidden;
background: #ddd;
margin-bottom: 5px;
}.g-progress dl.m-progress dt b {
display: block;
height: 6px;
filter: progid:DXImageTransform.Microsoft.Gradient(startColorStr='#ff934b',endColorStr='#ff6601',gradientType='1');
background: -moz-linear-gradient(0deg,#ff934b,#ff6601);
background: -webkit-gradient(linear,0% 0,100% 0,from(#ff934b),to(#ff6601));
background: -ms-linear-gradient(left,#ff934b 0,#ff6601 100%);
background: -o-linear-gradient(0deg,#ff934b,#ff6601);
}
.g-progress dl.m-progress dd span.orange {
width: 33%;
}.g-progress dl.m-progress dd span {
height: 36px;
color: #bbb!important;
line-height: 16px;
}.m-progress dd span.orange {
width: 33%;
}.m-progress dd span {
height: 36px;
color: #bbb!important;
line-height: 16px;
}.g-progress dl.m-progress dd span.orange em {
color: #f60;
}.g-progress dl.m-progress dd span em {
display: block;
font-size: 14px;
}.g-progress dl.m-progress dd span.gray6 {
width: 34%;
text-align: center;
}.g-progress dl.m-progress dd span.blue em {
color: #2af;
}.g-hotL-list li a.u-imm {
clear: both;
display: block;
width: 136px;
height: 35px;
line-height: 35px;
border-radius: 3px;
background: #f60;
color: #fff;
font-size: 16px;
text-align: center;
margin: 0 auto;
border-radius: 2px;
}.g-hotR {
width: 240px;
height: 711px;
overflow: hidden;
border: 1px solid #ddd;
position: relative;
}.g-hotR .u-are {
height: 25px;
padding: 15px 0 0 10px;
font-size: 18px;
overflow: hidden;
background: #fff;
position: relative;
top: 0;
right: 0;
z-index: 4;
color: #333;
}.g-hotR .g-zzyging {
clear: both;
width: 220px;
height: 623px;
margin: 0 auto;
padding: 0 10px;
overflow: hidden;
position: absolute;
right: 0;
top: 40px;
margin-top: -1px;
}
ul#buyList {
margin: 0 auto;
font: 12px tahoma,arial,'Hiragino Sans GB',\5b8b\4f53,sans-serif;
}.g-zzyging li {
float: left;
height: 58px;
padding: 15px 0;
border-top: 1px dotted #ddd;
overflow: hidden;
position: relative;
}.g-zzyging span {
width: 50px;
height: 50px;
position: absolute;
left: 0;
top: 19px;
}.g-zzyging p {
float: left;
margin-left: 60px;
display: inline;
height: 58px;
overflow: hidden;
}.blue, a.blue:link, a.blue:visited {
color: #2af;
}.g-zzyging a.u-ongoing {
display: inline-block;
color: #333;
width: 160px;
height: 36px;
overflow: hidden;
word-break: break-all;
position: relative;
top: -4px;
}.g-zzyging span img {
width: 50px;
height: 50px;
border-radius: 50px;
}.g-zzyging a.blue {
color: #2aff;
font-size: 14px;
max-width: 160px;
height: 20px;
word-break: break-all;
overflow: hidden;
display: inline-block;
}.g-hotR .u-see100 {
clear: both;
border-top: 1px dotted #ddd;
position: absolute;
top: 663px;
right: 0;
width: 240px;
height: 47px;
line-height: 47px;
text-align: center;
}.g-hotR .u-see100 a {
display: block;
height: 47px;
line-height: 47px;
color: #333;
font-size: 14px;
}.m-sort {
padding: 13px 0;
}.g-title {
clear: both;
height: 36px;
line-height: 36px;
padding: 10px 0;
}.g-title h3 {
font-size: 22px;
color: #333;
}.m-sort .fr a {
float: left;
display: block;
border: 1px solid #ddd;
height: 32px;
line-height: 32px;
padding: 0 17px;
margin: 1px 0 0 10px;
display: inline;
color: #333;
font-size: 14px;
}.m-sort .fr a:hover{color:#f60;border:1px solid #f60;}
.announced-soon {
width: 1188px;
border-left: 1px solid #ddd;
border-right: 1px solid #ddd;
border-top: 1px solid #ddd;
}
.clear, .clrfix {
zoom: 1;
}.soon-list-con:hover {
position: relative;
z-index: 2;
}.soon-list-con {
float: left;
width: 297px;
height: 398px;
position: relative;
z-index: 1;
}.soon-list li.g-soon-pic {
float: left;
width: 200px;
margin: 10px 33px 0;
display: inline;
}.soon-list li.g-soon-pic img {
display: block;
width: 200px;
height: 200px;
}.soon-list li.soon-list-name {
clear: both;
height: 20px;
line-height: 20px;
overflow: hidden;
padding-top: 20px;
word-break: break-all;
}.soon-list li.soon-list-name a {
color: #333;
font-size: 14px;
}.soon-list li.gray {
height: 20px;
line-height: 20px;
font-size: 12px;
}.soon-list li.g-progress {
float: left;
width: 266px;
height: 48px;
margin: 7px 0;
overflow: hidden;
}.g-progress {
height: 48px;
margin: 0 auto;
overflow: hidden;
}.soon-list li dl.m-progress {
width: 266px;
}.g-progress dl.m-progress {
width: 216px;
overflow: hidden;
}dl.m-progress {
width: 216px;
font-size: 12px;
overflow: hidden;
}.soon-list li dl.m-progress dt {
width: 266px;
}.g-progress dl.m-progress dt {
width: 216px;
height: 6px;
overflow: hidden;
background: #ddd;
margin-bottom: 5px;
}dl.m-progress dt {
width: 216px;
height: 6px;
overflow: hidden;
background: #ddd;
margin-bottom: 5px;
}.g-progress dl.m-progress dt b {
display: block;
height: 6px;
filter: progid:DXImageTransform.Microsoft.Gradient(startColorStr='#ff934b',endColorStr='#ff6601',gradientType='1');
background: -moz-linear-gradient(0deg,#ff934b,#ff6601);
background: -webkit-gradient(linear,0% 0,100% 0,from(#ff934b),to(#ff6601));
background: -ms-linear-gradient(left,#ff934b 0,#ff6601 100%);
background: -o-linear-gradient(0deg,#ff934b,#ff6601);
}dl.m-progress dt b {
display: block;
height: 6px;
filter: progid:DXImageTransform.Microsoft.Gradient(startColorStr='#ff934b',endColorStr='#ff6601',gradientType='1');
background: -moz-linear-gradient(0deg,#ff934b,#ff6601);
background: -webkit-gradient(linear,0% 0,100% 0,from(#ff934b),to(#ff6601));
background: -ms-linear-gradient(left,#ff934b 0,#ff6601 100%);
background: -o-linear-gradient(0deg,#ff934b,#ff6601);
}.soon-list li dl.m-progress dd {
width: 266px;
}.g-progress dl.m-progress dd {
font-size: 12px;
}
.g-progress dl.m-progress dd span.gray6 em {
color: #666;
}.soon-list li a.u-now:hover {
background: #f40;
}.soon-list li a.u-now {
float: left;
width: 136px;
background: #f60;
color: #fff;
font-size: 16px;
margin: 0 7px 0 58px;
display: inline;
}.soon-list li a.u-now, .soon-list li a.u-cart {
float: left;
display: block;
height: 35px;
line-height: 35px;
text-align: center;
border-radius: 2px;
cursor: pointer;
}a.u-now:hover {
background: #f40;
}.soon-list-con:hover .soon-list {
width: 266px;
position: absolute;
left: 0;
top: -1px;
border: 1px solid #f60;
overflow: hidden;
-moz-box-shadow: 3px 3px 3px #d8d8d8;
-webkit-box-shadow: 3px 3px 3px #d8d8d8;
box-shadow: 3px 3px 3px #d8d8d8;
}.soon-list {
width: 267px;
height: 367px;
padding: 15px;
border-left: 1px solid #ddd;
border-bottom: 1px solid #ddd;
margin-left: -1px;
margin-bottom: -1px;
overflow: hidden;
position: relative;
}
.clear:after, .clrfix:after {
content: ' ';
display: block;
clear: both;
height: 0;
visibility: hidden;
}.g-single-sun {
clear: both;
height: 503px;
}.singleL {
width: 294px;
height: 509px;
border: 1px solid #ddd;
font-size: 14px;
overflow: hidden;
}.singleL dt {
padding-top: 13px;
height: 340px;
}.singleL dt img {
width: 270px;
height: 340px;
display: block;
}.singleL dt, .singleL dd.u-user {
padding: 0 12px;
}.singleL dd {
float: left;
}.singleL dd p.u-head {
width: 50px;
height: 50px;
position: relative;
margin-right: 10px;
}.singleL dd p {
float: left;
}.singleL dd p.u-head img {
width: 50px;
height: 50px;
border-radius: 50px;
display: block;
}fieldset, img {
border: 0;

}.singleL dd p.u-head i {
background: url(/statics/templates/quyu-1yygkuan/images/index08-2014.png) no-repeat;
width: 50px;
height: 50px;
position: absolute;
left: 0;
top: 0;
}.singleL dd p.u-info {
width: 210px;
padding-top: 5px;
overflow: hidden;
}.singleL dd p {
float: left;
}.singleL dd span {
display: block;
height: 20px;
overflow: hidden;
}.singleL dd span a {
color: #2af;
max-width: 100px;
height: 20px;
overflow: hidden;
display: block;
float: left;
word-break: break-all;
}.singleL dd p em {
font-size: 12px;
color: #bbb;
margin-left: 3px;
}.singleL dd p cite {
display: block;
width: 210px;
height: 20px;
overflow: hidden;
}.singleL dd.m-summary {
display: block;
clear: both;
width: 274px;
height: 61px;
_height: 56px;
background: #f2f2f2;
padding: 11px 10px 13px;
position: relative;
border-top: 1px solid #ddd;
line-height: 21px;
}.singleL dd {
float: left;
}.singleL dd.m-summary cite {
display: block;
height: 61px;
overflow: hidden;
}.singleL dd.m-summary a {
color: #999;
}.singleL dd.m-summary b {
border-style: solid;
border-width: 0 6px 6px;
border-color: #fff;
border-bottom: 6px solid rgb(221,221,221);
width: 0;
height: 0;
font-size: 0;
line-height: 0;
position: absolute;
left: 32px;
top: -7px;
}.singleL dd.m-summary b s {
border-style: solid;
_border-style: dashed;
border-width: 6px;
border-color: transparent;
border-top-width: 0;
border-bottom: 6px solid #f2f2f2;
width: 0;
height: 0;
font-size: 0;
line-height: 0;
position: absolute;
top: 1px;
left: -6px;
}.singleR {
width: 894px;
border-top: 1px solid #ddd;
}.singleR li {
float: left;
border: 1px solid #ddd;
border-top: 0 none;
text-align: center;
margin-left: -1px;
display: inline;
width: 270px;
height: 222px;
padding: 14px 13px 18px 14px;
overflow: hidden;
}.singleR img {
width: 270px;
height: 195px;
display: block;
}.singleR a p {
display: block;
color: #333;
font-size: 14px;
}
.singleR a:hover p, .singleR a p:hover {
color: #f60!important;
text-decoration: underline!important;
cursor: pointer;
}
.g-zzyging a.blue:hover {
text-decoration: underline;
}.g-hotR a.u-ongoing:hover, .g-hotR .u-see100 a:hover {
color: #f60;
text-decoration: underline;
}.g-hotL-list li.g-hot-name a:hover {
color: #f60;
text-decoration: underline;
}.g-hotL-list li a.u-imm:hover {
background: #f40;
}
.m-all-sort dl a:hover {
color: #f60;
text-decoration: underline;
}
.honesty li a:hover i.i1{background-position:0 -80px;}.honesty li a:hover i.i2{background-position:-39px -79px;}.honesty li a:hover i.i3{background-position:-80px -80px;}.honesty li a:hover i.i4{background-position:0 -121px;}.honesty li a:hover i.i5{background-position:-39px -121px;}.honesty li a:hover i.i6{background-position:-79px -121px;}
.honesty li a:hover {
color: #f60;
}.search .form a:hover {
background: #ddd;
color: #666;
}.g-toolbar li a:hover {
color: #f60;
text-decoration: underline;
}.nav-main li a:hover {
background: #f04900;
color: #fff;
}.nav-cart-btn a:hover {
color: #fff;
text-decoration: underline;
}.commodity li.comm-info a:hover {
color: #f60;
text-decoration: underline;
}.index_news dd a:hover {
color: #f60;
text-decoration: underline;
}.m-other a:hover {
text-decoration: underline;

}.soon-list li.soon-list-name a:hover {
color: #f60;
text-decoration: underline;
}.singleR p {
padding-top: 10px;
height: 20px;
line-height: 20px;
overflow: hidden;
}.singleL dd span a:hover, .singleL dd p cite a:hover {
text-decoration: underline;
}
.singleL dd.u-user {
height: 50px;
padding: 10px 0 10px 13px;
}.singleL dt {
padding-top: 13px;
height: 340px;
}.g-wrap {
margin: 0 auto;
padding-bottom: 35px;
}




.g-frame-footer {border-top: 2px solid #ededed;padding: 35px 0 10px;margin: 0 auto;margin-top: 10px;}
.g-frame-top, .g-frame-head, .g-frame-content, .g-frame-footer {width: 100%;min-width: 1190px;background: #FFF;}
.g-frame-footer .g-width {width: 1190px;height: 350px;margin: 0 auto;overflow: hidden;background: #FFF;}
.M-guide {width: 100%;display: block;overflow: hidden;padding-bottom: 25px;text-align: left;text-indent: 40px;position: relative;}
.M-guide dl {float: left;width: 16.6%;}
.M-guide dt {font-family: "微软雅黑";font-size: 18px;color: #333;padding-bottom: 10px;}
.M-guide dd a {font-size: 12px;color: #999;line-height: 1.8;text-align: left;}
.service-promise {height: 101px;}
.service-promise li {width: 228px;float: left;height: 98px;position: relative;border: 1px solid #e6e6e6;border-bottom: 2px solid #eaeaea;margin-right: 10px;}
.service-promise li.M-android .F-bg {width: 68px;height: 79px;background-position: 0 -109px;top: 11px;left: 9px;}
.service-promise li.M-android .F-txt {left: 95px;top: 11px;}
.service-promise li .F-txt b {display: block;font-size: 14px;font-family: 微软雅黑;font-weight: normal;margin-bottom: 3px;}
.service-promise li.M-android .orange_btn {width: 110px;line-height: 10px;font-family: 微软雅黑;font-size: 14px;text-align: center;}
.service-promise li.M-wx .F-wxm {width: 75px;height: 75px;position: absolute;top: 11px;left: 9px;}
.service-promise li.M-wx .F-txt {left: 95px;top: 16px;}
.service-promise li.M-time .F-bg {width: 69px;height: 79px;background-position: 0 -189px;overflow: hidden;}
.service-promise li .F-txt {position: absolute;}
.service-promise li.M-time .F-txt {left: 85px;top: 11px;}
.service-promise li.M-time .F-txt b {margin-bottom: 8px;}
.service-promise li.M-time .F-txt-dig {font-size: 24px;font-family: Arial,"微软雅黑";line-height: 24px;padding: 10px 5px 6px 3px;float: left;background: #f60;color: #fff;text-align: center;display: block;border-bottom: 2px solid #e45b00;border-radius: 2px;vertical-align: middle;overflow: hidden;}
.service-promise li.M-fund .F-bg {width: 71px;height: 78px;background-position: -150px -189px;overflow: hidden;}
.service-promise li.M-fund .F-txt {left: 85px;top: 11px;}
.service-promise li.M-fund .F-fund-buy {background: #94D45A;font-family: "Arial";border-bottom: 2px solid #79C13B;text-align: center;color: #fff;font-size: 18px;border-radius: 2px;padding: 8px 6px 8px 4px;display: block;}
.service-promise li.M-tel {margin-right: 0;}
.M-security {border: 1px solid #e6e6e6;border-bottom: 2px solid #eaeaea;padding: 11px 100px 11px 128px;display: block;overflow: hidden;zoom: 1;margin-top: 10px;}
.Fb {font-weight: bold;}
.M-guide dd a:hover {color: #f60;text-decoration: underline;}
.Hicon, .F-msg-close, .U_sina s, .U_qq s, .U_wx s, .F-icon-guest s, .F-icon-gray s, .M-nav-help a s, .search_submit, .search_submit_hover, .m-app-dow-img, .u-banner-close, .F-number-l, .F-number-r, .F-bg, .F-android-img, .F-wx-img, .M-wx .F-txt b i, .F-security-img, .F-goods-img, .F-goods-arrow, .m-popup-close a, .u-popup-Tip s, .u-popup-Tip i, u-popup-Tip b, .f-user-qq, .f-pay-succeed, .f-pay-fail, .roll_close a {background: url(/statics/templates/quyu-1yygkuan/images/header-icon.png);}
.service-promise li .F-bg {display: inline-block;position: absolute;bottom: 0;left: 0;}
.service-promise li.M-wx .F-wx-img {width: 117px;height: 42px;display: inline-block;background-position: -71px -128px;margin-bottom: 0;overflow: hidden;}
.gray9, a.gray9:link, a.gray9:visited {color: #999;}
.service-promise li.M-fund .F-txt b {margin-bottom: 8px;}
.service-promise li.M-tel .F-bg {width: 79px;height: 78px;background-position: -70px -189px;overflow: hidden;}
.service-promise li.M-tel .F-txt {left: 85px;top: 14px;}
.service-promise li.M-tel .F-txt b {margin-bottom: 8px;}
.service-promise li.M-tel .F-tel-img {width: 134px;font-size: 20px;height: 22px;line-height: 22px;overflow: hidden;font-family: Arial;margin-bottom: 5px;color: #f60;font-weight: bold;display: block;}
.service-promise li.M-tel a.F-icon-guest {color: #f60;}
.service-promise li.M-tel .F-icon-guest s, .service-promise li.M-tel .F-icon-gray s {vertical-align: middle;margin: 0;margin-right: 5px;}
.F-icon-guest s {background-position: -30px -20px;_background-position: -29px -19px;}
.F-icon-guest s, .F-icon-gray s {width: 20px;height: 17px;display: inline-block;float: left;margin-top: 6px;margin-right: 2px;}
.F-txt .F-icon-guest:hover {text-decoration: underline;}
.fam-y {font-family: 微软雅黑;}
.M-security .U-fair .F-security-img {background-position: 0 -53px;_background-position: 0 -52px;}
.M-security .F-security-img {width: 50px;height: 50px;display: inline-block;float: left;margin-right: 5px;}
.M-security .F-security-T {font-size: 18px;font-family: "微软雅黑";color: #333;height: 30px;line-height: 30px;text-align: left;}
.M-security .F-security-C {font-size: 12px;color: #bbb;text-align: left;float: left;_padding-left: 5px;width: 205px;height: 16px;overflow: hidden;line-height: 16px;}
.M-security .U-security .F-security-img {background-position: -53px -53px;_background-position: -52px -52px;}
.M-security .U-free .F-security-img {background-position: -106px -53px;_background-position: -105px -52px;}
.M-security .U-security {margin: 0 70px;}
.g-frame-top:after, .g-frame-content:after, .g-frame-footer:after, .g-width:after {content: "";display: table;clear: both;}
.U-fair, .U-security, .U-free {float: left;display: block;height: 50px;display: inline-block;cursor: pointer;display: inline;width: 270px;overflow: hidden;}
.copyright {text-align: center;font-size: 12px;color: #999;background: #fff;}
.footer_links {text-align: center;padding: 10px 0 10px;background: #fff;font-family: "宋体";}
.copyright {text-align: center;font-size: 12px;color: #999;background: #fff;}
.footer_icon {width: 570px;margin: 0 auto;padding: 15px 0 15px 5px;overflow: hidden;background: #fff;}
.footer_icon .fi_ectrustchina {background-position: 0 0;}
.footer_icon a {background: url(/statics/templates/quyu-1yygkuan/images/icon.png?v=140508) center no-repeat;width: 90px;height: 30px;margin-right: 5px;text-align: center;display: block;overflow: hidden;float: left;border-radius: 2px;}
.footer_icon .fi_315online {background-position: 0 -32px;}
.footer_icon .fi_qh {background-position: 0 -96px;}
.footer_icon .fi_cnnic {background-position: 0 -64px;}
.footer_icon .fi_anxibao {background-position: -1px -128px;}
.footer_icon .fi_pingan {background-position: 0 -160px;}




.quickBack {
position: fixed;
_position: absolute;
bottom: 60px;
right: 0;
_right: -1px;
width: 60px;
z-index: 98;
background: #FFF;
}.quickBack .quick_But dd a.quick_cartA, .quickBack .quick_But dd a.quick_serviceA, .quickBack .quick_But dd a.quick_CollectionA, .quickBack .quick_But dd a.quick_ReturnA, .quick_publish_bottom a.quick_publishA {
width: 58px;
height: 58px;
position: relative;
display: block;
border: 1px solid #E4E4E4;
border-bottom: none;
z-index: 11;
}.quick_But dd a b {
width: 58px;
text-align: center;
font-weight: normal;
position: absolute;
top: 32px;
left: 0;
display: inline-block;
font-family: 微软雅黑;
cursor: pointer;
z-index: 10;
color: #BBB;
}.quick_But dd a s {
cursor: pointer;
height: 58px;
left: 0;
position: absolute;
top: 0;
width: 58px;
}.quick_cart s, .quick_service s, .quick_Collection s, .quick_Return s, .quick_publish s, .Close, .Roll_mycart li a.Close:hover, .quick_triangle {
background: url(/statics/templates/quyu-1yygkuan/images/quickBack-v2.png?v=140718) no-repeat;
display: block;
}
.quick_cart em, .quick_publish em {
width: 18px;
height: 18px;
line-height: 18px;
font-size: 10px;
font-family: Arial;
text-align: center;
color: #fff;
position: absolute;
top: 2px;
right: 3px;
border: 2px solid #fff;
background: #f60;
border-radius: 50%;
}.Roll_mycart {
width: 290px;
height: 235px;
border: 1px solid #5BC0FF;
position: absolute;
right: 59px;
top: 0;
background: #fff;
z-index: 95;
}.quickBack .quick_But a:hover b, .quickBack .quick_But a.f-Cur-shop b {
color: #fff;
}.quickBack .quick_But dd a.quick_cartA:hover, .quickBack .quick_But dd a.f-Cur-shop, .quickBack .quick_But dd a.quick_serviceA:hover, .quickBack .quick_But dd a.quick_CollectionA:hover, .quickBack .quick_But dd a.quick_ReturnA:hover {
border: 1px solid #2AF;
border-bottom: none;
}.quick_Collection s {
background-position: 0 -118px;
}.quick_Return s {
background-position: 0 -177px;
}.quick_service s {
background-position: 0 -59px;
}.quickBack .quick_But dd a.quick_ReturnA {
border-bottom: 1px solid #E4E4E4;
}.quickBack .quick_But dd a.quick_ReturnA:hover {
border-bottom: 1px solid #2AF;
}.quick_Return a:hover s {
background-position: -58px -177px;
}.quick_Collection a:hover s {
background-position: -58px -118px;
}.quick_service a:hover s {
background-position: -58px -59px;
}.quick_cart a:hover s, .quick_cart a.f-Cur-shop s {
background-position: -58px 0;
}.Roll_mycart ul {
width: 282px;
padding-left: 8px;
border-bottom: 1px solid #EFEFEF;
height: 171px;
float: left;
}.Roll_mycart .quick_goods_loding {
font-size: 18px;
color: #666;
font-family: 微软雅黑,宋体;
height: 111px;
min-height: 111px;
text-align: center;
vertical-align: middle;
padding: 60px 0 0 0;
}.Roll_mycart .quick_goods_loding img {
margin-right: 5px;
vertical-align: middle;
}.Roll_mycart p {
width: 100%;
text-align: center;
color: #999;
height: 20px;
line-height: 20px;
overflow: hidden;
padding-top: 5px;
margin-bottom: 5px;
}.Roll_mycart p span {
color: #f60;
}.rmbgray {
background-position: 0 -3px;
background-repeat: no-repeat;
padding-left: 10px;
}.rmbred, .rmbgray, .rmbwhite {
background: url(http://skin.1yyg.com/images/PublicIcon.png?v=1301241) no-repeat;
}.Roll_mycart h3 {
width: 100%;
height: 26px;
text-align: center;
}.Roll_mycart h3 a {
height: 26px;
padding: 0 35px;
line-height: 26px;
margin: 0 auto;
text-align: center;
font-weight: normal;
font-family: "宋体";
font-size: 14px;
}.orange_btn:hover {
color: #fff;
background: #f60;
}.orange_btn, .orange_bg_btn {
background: #ff7010;
font-family: "宋体";
display: inline-block;
color: #fff;
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
-ms-border-radius: 2px;
-o-border-radius: 2px;
border-radius: 2px;
-webkit-box-shadow: #E84C01 0 1px 0;
-moz-box-shadow: #E84C01 0 1px 0;
box-shadow: #E84C01 0 1px 0;
background-image: -moz-linear-gradient(top,#ff822e,#ff6701);
}
</style>
<body id="loadingPicBlock" class="home" rf="1" >
<SCRIPT language=javascript>
<!--
window.onerror=function(){return true;}
// -->
</SCRIPT>



<style>  
 .g-snow-con {
position: relative;
top: 130px;
z-index: 1001;
margin-bottom: -30px;
}
.g-snow {
background: url(<?php echo G_UPLOAD_PATH; ?>/banner/snow.png?v=141217) center no-repeat;
height: 30px;
_width: 1211px;
_margin: 0 auto;
}
.g-snow2 {
background: url(<?php echo G_UPLOAD_PATH; ?>/banner/snow2.png?v=141217) center no-repeat;
height: 30px;
_width: 1012px;
_margin: 0 auto;
display: none;
} 
    .d {
 
 top: 0px;
 margin-top: 0px;
 padding-top:0px;
 margin-right: auto;
 margin-bottom: 0;
 margin-left: auto;
 background-image: url(<?php echo G_UPLOAD_PATH; ?>/banner/bg_2015.gif);
 background-repeat: no-repeat;
 background-position: center top; 
} </style>

<div id="divSnow" class="g-snow-con clrfix">
        <div class="g-snow"></div>
        <div class="g-snow2"></div>
    </div><div class="d"><div>
    <div class="wrapper">
        <!--头部-->
        <!--顶部-->
 <div class="g-toolbar">
     <div class="w1190">
         <ul class="fl">
             <li>
                 <div class="u-menu-hd">
                     <a id="addSiteFavorite" href="javascript:;" title="收藏">收藏<?php echo _cfg("web_name_two"); ?></a>
                 </div>
             </li>
             <li class="f-gap"><s></s></li>
             <li id="liMobile" class="u-arr">
                 <div class="u-menu-hd">
                     <a href="<?php echo G_WEB_PATH; ?>/?/go/index/app" title="手机版">手机<?php echo _cfg('web_name_two'); ?></a>
                     <div class="f-top-arrow"><cite>◆</cite><b>◆</b></div>
                 </div>
               <div class="u-select u-select-weix">
                     <p>
                         <a href="<?php echo G_WEB_PATH; ?>/?/go/index/app" target="_blank">
                             <img src="<?php echo G_WEB_PATH; ?>/statics/templates/quyu-1yygkuan/images/sjb.png" />
                             下载客户端
                         </a>
                     </p>
                 </div>
             </li>
             <li class="f-gap"><s></s></li>
             <li>
                 <div class="u-menu-hd">
                     <a href="<?php echo WEB_PATH; ?>/group_qq" target="_blank" title="官方QQ群">官方QQ群</a>
                 </div>
             </li>
                   <li class="f-gap"><s></s></li>
              <li>
                 
             </li>
             
              <li class="f-gap"><s></s></li>
             <li>
                 <div class="u-menu-hd">
                    
                 </div>
             </li>
         </ul>
         <ul id="ulTopRight" class="fr">
         <?php if(get_user_arr()): ?>
<li>
<div class="u-menu-hd u-menu-login">
<a class="blue" title="<?php echo get_user_name(get_user_arr(),'username'); ?>" href="<?php echo WEB_PATH; ?>/member/home"><?php echo get_user_name(get_user_arr(),'username'); ?></a>
<a title="退出" href="<?php echo WEB_PATH; ?>/member/user/cook_end">[退出]</a>
</div>
</li>
<li class="f-gap">
<s></s>
</li>

<?php  else: ?>
<li id="logininfo">
<div class="u-menu-hd">
<a title="登录" href="<?php echo WEB_PATH; ?>/login">登录</a>
</div>
</li>
<li class="f-gap">
<s></s>
</li>
<li>
<div class="u-menu-hd">
<a title="注册" href="<?php echo WEB_PATH; ?>/register">注册</a>
</div>
</li>
<li class="f-gap">
<s></s>
</li>
<?php endif; ?>
<li id="liMember" class="u-arr">
<div class="u-menu-hd">
<a href="<?php echo WEB_PATH; ?>/member/home">我的<?php echo _cfg('web_name_two'); ?></a>
                     <div class="f-top-arrow"><cite>◆</cite><b>◆</b></div>
                 </div>
                 <div class="u-select u-select-my">
                     <span><a href="<?php echo WEB_PATH; ?>/member/home/userbuylist" title="购买记录"><?php echo _cfg('web_name_two'); ?>记录</a></span>
                     <span><a href="<?php echo WEB_PATH; ?>/member/home/orderlist" title="获得的商品">获得的商品</a></span>
                     <span><a href="<?php echo WEB_PATH; ?>/member/home/modify" title="个人设置">个人设置</a></span>
                 </div>
             </li>
             <li class="f-gap"><s></s></li>
             <li id="liTopUMsg" class="u-arr" style="display: none;">
                 <div class="u-menu-hd">
                     <a href="#" title="消息">消息</a>
                     <h3 style="display: none;"></h3>
                     <div class="f-top-arrow"><cite>◆</cite><b>◆</b></div>
                 </div>
                 <div class="u-select u-select-my">
                     <span><a href="#" title="好友请求">好友请求</a></span>
                     <span><a href="#" title="系统消息">系统消息</a></span>
                     <span><a href="#" title="私信" class="f-msg">私信</a></span>
                 </div>
             </li>
             <li class="f-gap" style="display: none;"><s></s></li>
             <li>
                 <div class="u-menu-hd">
                     <a href="<?php echo WEB_PATH; ?>/member/home/userrecharge" title="帮助">快速冲值</a>
                 </div>
             </li>
             <li>
                 <div class="u-menu-hd">
                     <a href="#" title="帮助">帮助</a>
                 </div>
             </li>
             <li class="f-gap"><s></s></li>
             <li>
                 <div class="u-menu-hd">
                     <a id="btnTopQQ" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cfg('qq'); ?>&site=qq&menu=yes" title="在线客服" class="u-service-off u-service"><i></i>在线客服</a>
                 </div>
             </li>
         </ul>
     </div>
 </div><!--头部-->
 <div class="g-header" >
     <div class="w1190">
     
         <div id="topLogoAd" class="logo_1yyg fl">
			  <a class="logo" href="<?php echo G_WEB_PATH; ?>/" title="<?php echo _cfg('web_name'); ?>">
					<img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getlogo(); ?>"/>
				</a>
         </div>
         <div class="search_cart_wrap fr">
             <div class="number">
                 <a href="<?php echo WEB_PATH; ?>/buyrecord" target="_blank">
                      <ul id="ulHTotalBuy">
      <li class="nobor gray6" style="width: 56px;">累计参与</li>

                       <li class="num" style="display: none;"><cite><em>0</em></cite><i></i></li>
                <li class="num" style="display: none;"><cite><em>0</em></cite><i></i></li>
                <li class="num"><cite><em>0</em></cite><i></i></li>
                <li class="nobor">,</li>
				<li class="num"><cite><em>0</em></cite><i></i></li>
                <li class="num"><cite><em>0</em></cite><i></i></li>
                <li class="num"><cite><em>0</em></cite><i></i></li>
                <li class="nobor">,</li>
                <li class="num"><cite><em>0</em></cite><i></i></li>
                <li class="num"><cite><em>0</em></cite><i></i></li>
                <li class="num"><cite><em>0</em></cite><i></i></li>
                <li class="nobor gray6 u-secondary">人次<b><s></s></b></li>
			</ul>
                 </a>
             </div>

             <div class="search">
                 <div class="form">
                      <input id="txtSearch" type="text" value=""输入手机试试"" />
                     <span>
                         <a href="<?php echo WEB_PATH; ?>/s_tag/苹果" target="_blank">苹果</a>
                         <a href="<?php echo WEB_PATH; ?>/s_tag/电脑" target="_blank">电脑</a>
                         <a href="<?php echo WEB_PATH; ?>/s_tag/手机" target="_blank">手机</a>
                     </span>
                 </div>
                 <a id="butSearch" href="javascript:;" class="seaIcon"><i></i></a>
             </div>
         </div>
     </div>
 </div>

  



 <!--导航-->
 <?php 
		if($this->db){
			$cmodel=$this->db;
		}else{
			$cmodel=$mysql_model;
		}

		$two_cate_list = $cmodel->GetList("select cateid,parentid,name from `@#_category` where `model` = '1' and `parentid` = '0' order by `order` DESC");
	 ?>
 <div class="g-nav">
     <div class="w1190">
         <div id="divGoodsSort" class="m-menu fl">
             <div class="m-menu-all">
                 <h3><a href="<?php echo WEB_PATH; ?>/goods_list">全部商品分类</a><em></em></h3>
             </div>
             <div id="divSortList" class="m-all-sort" >
                 <?php $ln=1; if(is_array($two_cate_list)) foreach($two_cate_list AS $key => $catelist): ?>
						<?php 
							//$brand=$this->db->GetList("select id,cateid,name from `@#_brand` where `cateid` LIKE '%$catelist[cateid]%' order by `order` DESC");

								$cate2 = $cmodel->GetList("select cateid,parentid,name from `@#_category` where `parentid` = '$catelist[cateid]' order by `order` DESC");
								//echo "select cateid,parentid,name from `@#_category` where `parentid` = '$catelist[cateid]' order by `order` DESC";


 							$i=$key+1;
						 ?>

							<dl>
								<dt class="U-goods-<?php echo $i; ?>">
									<a href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $catelist['cateid']; ?>_0_0"> <i
										class="F-goods-img"></i><?php echo $catelist['name']; ?><i class="F-goods-arrow"></i>
									</a>
								</dt>

								<?php 

									if(is_array($cate2)){
									   foreach($cate2 AS $bval){
								 ?>
								<dd>
									<a href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $bval['cateid']; ?>_0_0"><?php echo $bval['name']; ?></a>
								</dd>
								<?php 
									 }}
								 ?>

							</dl>

							<?php  endforeach; $ln++; unset($ln); ?>
             </div>

         </div>
         <div class="nav-main fl">
             <ul>
                 <li class="f-nav-home"><a href="/">首页</a></li>
                	<?php echo Getheader('index'); ?>
             </ul>
         </div>
         <div id="divHCart" class="nav-cart fr">
             <div class="nav-cart-btn">
                 <a href="<?php echo WEB_PATH; ?>/member/cart/cartlist" target="_blank"><i class="f-cart-icon"></i>购物车<span id="sCartTotal">(0)</span></a>
             </div>
             <div class="nav-cart-con">
                 <div class="m-loading-2014"><em></em></div>
                 <div class="nav-car-cartEmpty"><i></i>您的购物车为空 !</div>
                 <div class="nav-cart-select"></div>
                 <div class="nav-cart-pay"></div>
             </div>
         </div>

     </div>
 </div>
 <!--所有商品下拉特效-->
   <script language="javascript" type="text/javascript">
     var Base = { head: document.getElementsByTagName("head")[0] || document.documentElement, Myload: function (B, A) { this.done = false; B.onload = B.onreadystatechange = function () { if (!this.done && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) { this.done = true; A(); B.onload = B.onreadystatechange = null; if (this.head && B.parentNode) { this.head.removeChild(B) } } } }, getScript: function (A, C) { var B = function () { }; if (C != undefined) { B = C } var D = document.createElement("script"); D.setAttribute("language", "javascript"); D.setAttribute("type", "text/javascript"); D.setAttribute("src", A); this.head.appendChild(D); this.Myload(D, B) }, getStyle: function (A, CB) { var B = function () { }; if (CB != undefined) { B = CB } var C = document.createElement("link"); C.setAttribute("type", "text/css"); C.setAttribute("rel", "stylesheet"); C.setAttribute("href", A); this.head.appendChild(C); this.Myload(C, B) } }
     function GetVerNum() { var D = new Date(); return D.getFullYear().toString().substring(2, 4) + '.' + (D.getMonth() + 1) + '.' + D.getDate() + '.' + D.getHours() + '.' + (D.getMinutes() < 10 ? '0' : D.getMinutes().toString().substring(0, 1)) }
     Base.getScript('/statics/templates/quyu-1yygkuan/js/Bottom2.js?v=' + GetVerNum());
 </script>
    <script>
        $(document).ready(function(){
                $("#divGoodsSortList").hover(function() {
                $(this).addClass("U-goods-hover").children("div.U-goods-class").show().prev().find("b").addClass("b_Triangle")
                }
                ,function() {
                    $(this).removeClass("U-goods-hover").children("div.U-goods-class").hide().prev().find("b").removeClass("b_Triangle")
                }
                ).find("dl").each(function() {
                    $(this).hover(function() {
                    $(this).addClass("U-list-hover")
                }
                ,function() {
                    $(this).removeClass("U-list-hover")
                }
                )});

        });
    </script>
    <script>
$(function(){
    $("#sCart,#liTopCart").hover(
        function(){
            $("#sCartlist,#sCartLoading").show();
            $("#sCartlist p,#sCartlist h3").hide();
            $("#sCart .mycartcur").remove();
            $("#sCartTotal2").html("");
            $("#sCartTotalM").html("");
            $.getJSON("<?php echo WEB_PATH; ?>/member/cart/cartheader/="+ new Date().getTime(),function(data){
                $("#sCart .mycartcur").remove();
                $("#sCartLoading").before(data.li);
                $("#sCartTotal2").html(data.num);
                $("#sCartTotalM").html(data.sum);

                $("#sCartLoading").hide();
                $("#sCartlist p,#sCartlist h3").show();
            });
        },
        function(){
            $("#sCartlist").hide();
        }
    );
    $("#sGotoCart").click(function(){
        window.location.href="<?php echo WEB_PATH; ?>/member/cart/cartlist";
    });
})
function delheader(id){
    var Cartlist = $.cookie('Cartlist');
    var info = $.evalJSON(Cartlist);
    var num=$("#sCartTotal2").html()-1;
    var sum=$("#sCartTotalM").html();
    info['MoenyCount'] = sum-info[id]['money']*info[id]['num'];

    delete info[id];
    //$.cookie('Cartlist','',{path:'/'});
    $.cookie('Cartlist',$.toJSON(info),{expires:30,path:'/'});
    $("#sCartTotalM").html(info['MoenyCount']);
    $('#sCartTotal2').html(num);
    $('#sCartTotal').text(num);
    $('#btnMyCart em').text(num);
    $("#mycartcur"+id).remove();
}
$(function(){
    $(".M-my-1yyg").mouseover(function(){
        $(this).addClass("menu-hd-hover");
    });
    $(".M-shop").mouseover(function(){
        $(this).addClass("menu-hd-hover");
    });
    $(".M-my-1yyg").mouseout(function(){
        $(this).removeClass("menu-hd-hover");
    });
    $(".M-shop").mouseout(function(){
        $(this).removeClass("menu-hd-hover");
    });
});
$(function(){
	$("#txtSearch").focus(function(){
		$("#txtSearch").css({background:"#FFFFCC"});
		var va1=$("#txtSearch").val();
		if(va1=='输入"汽车"试试'){
			$("#txtSearch").val("");
		}
	});
	$("#txtSearch").blur(function(){
		$("#txtSearch").css({background:"#FFF"});
		var va2=$("#txtSearch").val();
		if(va2==""){
			$("#txtSearch").val('输入"汽车"试试');
		}
	});
	$("#butSearch").click(function(){
		window.location.href="<?php echo WEB_PATH; ?>/s_tag/"+$("#txtSearch").val();
	});
});

var getAllNum = function(){
    var a = $("#spBuyCount");
    var b = a.text();
    $.ajax({
        url: "<?php echo WEB_PATH; ?>/api/wrenciajax/get",
        type:"POST",
        success: function(data){
            if(b == data){

            }else{
                a.css({
                    color:"white",background:"red"
                }).html(data);
                a.animate({
                    opacity:0.1
                }
                ,{
                    queue:false,duration:1000,complete:function(){
                        a.show().css({
                            color:"#22AAFF",background:"#F5F5F5",opacity:1
                        })
                    }
                })

            }
        }
    });
    //setTimeout(getAllNum,3000);
};
getAllNum();
</script>
 <script language="javascript" type="text/javascript">
     var Base = { head: document.getElementsByTagName("head")[0] || document.documentElement, Myload: function (B, A) { this.done = false; B.onload = B.onreadystatechange = function () { if (!this.done && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) { this.done = true; A(); B.onload = B.onreadystatechange = null; if (this.head && B.parentNode) { this.head.removeChild(B) } } } }, getScript: function (A, C) { var B = function () { }; if (C != undefined) { B = C } var D = document.createElement("script"); D.setAttribute("language", "javascript"); D.setAttribute("type", "text/javascript"); D.setAttribute("src", A); this.head.appendChild(D); this.Myload(D, B) }, getStyle: function (A, CB) { var B = function () { }; if (CB != undefined) { B = CB } var C = document.createElement("link"); C.setAttribute("type", "text/css"); C.setAttribute("rel", "stylesheet"); C.setAttribute("href", A); this.head.appendChild(C); this.Myload(C, B) } }
     function GetVerNum() { var D = new Date(); return D.getFullYear().toString().substring(2, 4) + '.' + (D.getMonth() + 1) + '.' + D.getDate() + '.' + D.getHours() + '.' + (D.getMinutes() < 10 ? '0' : D.getMinutes().toString().substring(0, 1)) }
     Base.getScript('<?php echo G_TEMPLATES_JS; ?>/Bottom.js?v=' + GetVerNum());
 </script>
<!--end所有商品下拉特效-->
