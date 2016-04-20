<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
	 body{ background-color:#fefeff; font:12px/1.5 arial,微软雅黑b8b\4f53,sans-serif;}
	.width30{ width:25%; font-size:12px; border-radius:5px 2px 20px 2px;  }
	
	.title{ font-size:15px; font-weight:bold; color:#444; line-height:30px; border-bottom:1px solid #ccc;}
	.div-news{ height:50px; background-color:#fff}
	.div-user span{ display:block; font-size:12px; font: 12px/1.5 arial,宋体b8b\4f53,sans-serif; line-height:20px; color:#999}
	.div-user{ background-color:#fff; padding:20px;width:30%;float:left;  border-bottom:1px solid #eee }
	.div-button{ float:left;background-color:#fff; float:left; padding:20px; margin:0 10px; width:55%;border-radius:5px 5px 5px 5px;}
	.div-button ul li{ float:left; margin:0px 25px;}
	.div-button li a{  cursor:pointer; text-decoration:none}
	.div-button li span{ display:block; width:60px; text-align:center; line-height:32px;} 
	
	.div-system{background-color:#fff; float:left; padding:20px; margin:0 10px;border-right:1px solid #eee}
	.div-webinfo{background-color:#fff; float:left; padding:20px; margin:0 10px; width:27%;border-right:1px solid #eee }
	.div-about{background-color:#fff; float:left; padding:20px; margin:0 10px; overflow:hidden}
	
	
	
	 li{font:12px/1.5 arial,宋体b8b\4f53,sans-serif;}
	.div-system ul li{height:30px; line-height:30px;color:#333;border-bottom:1px dotted #ddd;}
	.div-system ul li i{width:90px;height:30px; line-height:30px; display:inline-block; color:#666;}
	
		
	.div-about ul li{height:30px; line-height:30px;color:#333;border-bottom:1px dotted #ddd;}
	.div-about ul li i{width:90px;height:30px; line-height:30px; display:inline-block; color:#666;}
	
	.div-webinfo ul li{height:30px; line-height:30px;color:#333;border-bottom:1px dotted #ddd;}
	.div-webinfo ul li i{width:90px;height:30px; line-height:30px; display:inline-block; color:#666;}
	
	.CMS_message{background-color: #eef3f7;border: 1px solid #d5dfe8; height:20px; padding:5px 0px; overflow:hidden}
	.CMS_message li{ text-indent:50px; height:25px; line-height:25px; color:#09c;font-size:12px; font-weight:bold;}
	
</style>
</head>
<body>

<div class="bk30"></div>
<div class="div-user lr10">
	<h1>Hello, <font color="#4c95b6"><?php echo $info['username'] ;?></font><h1>
    <span>所属角色: 超级管理员</span>
    <span>上次登录时间: <?php echo date("Y-m-d H:i:s",$info['logintime']); ?></span>
    <span>上次登录IP: <?php echo $info['loginip']; ?></span>
</div>
<div class="div-button">
<div class="bk15"></div>
	<ul>
    	<li><a  href="<?php echo G_MODULE_PATH; ?>/content/article_add"><img src="<?php echo G_GLOBAL_STYLE; ?>/global/image/btn_60_60_t.png"><span>添加文章</span></a></li>
        <li><a href="<?php echo G_MODULE_PATH; ?>/content/goods_add"><img src="<?php echo G_GLOBAL_STYLE; ?>/global/image/btn_60_60_g.png"><span>添加商品</span></a></li>
        <li><a href="<?php echo WEB_PATH; ?>/member/member/list"><img src="<?php echo G_GLOBAL_STYLE; ?>/global/image/btn_60_60_m.png"><span>会员管理</span></a></li>
        <li><a href="<?php echo G_MODULE_PATH; ?>/setting/webcfg"><img src="<?php echo G_GLOBAL_STYLE; ?>/global/image/btn_60_60_s.png"><span>系统设置</span></a></li>
        <li><a href="<?php echo G_WEB_PATH; ?>"><img src="<?php echo G_GLOBAL_STYLE; ?>/global/image/btn_60_60_i.png"><span>网站首页</span></a></li>
    </ul>
</div>


<div class="bk10"></div>
<div class="lr10 CMS_message" id="roll">
     


	<li>如果您还在使用 IE8 的版本就out了，操作后台请升级浏览器内核至IE8或使用谷歌,火狐,opera,浏览器！</li>
    <li>请勿修改任何插件相关文件，否则后果自负！</li>
    <li>尊敬的用户您好，若使用中出现问题，请联系客服处理</li>
    
</div>
<div class="bk10"></div>
<script type="text/javascript">
(function(A){
   function _ROLL(obj){
      this.ele = document.getElementById(obj);
	  this.interval = false;
	  this.currentNode = 0;
	  this.passNode = 0;
	  this.speed = 100;
	  this.childs = _childs(this.ele);
	  this.childHeight = parseInt(_style(this.childs[0])['height']);
	      addEvent(this.ele,'mouseover',function(){
				                               window._loveYR.pause();
											});
		  addEvent(this.ele,'mouseout',function(){
				                               window._loveYR.start(_loveYR.speed);
											});
   }
   function _style(obj){
     return obj.currentStyle || document.defaultView.getComputedStyle(obj,null);
   }
   function _childs(obj){
	  var childs = [];
	  for(var i=0;i<obj.childNodes.length;i++){
		 var _this = obj.childNodes[i];
		 if(_this.nodeType===1){
			childs.push(_this);
		 }
	  }   
	  return childs;
   }
	function addEvent(elem,evt,func){
	   if(-[1,]){
		   elem.addEventListener(evt,func,false);   
	   }else{
		   elem.attachEvent('on'+evt,func);
	   };
	}
	function innerest(elem){
      var c = elem;
	  while(c.childNodes.item(0).nodeType==1){
	      c = c.childNodes.item(0);
	  }
	  return c;
	}
   _ROLL.prototype = {
      start:function(s,v){
	          var _this = this;
			  
			  _this.hh=v;
			  _this.speed = s || 100;//速度
		      _this.interval = setInterval(function(){
									
						    _this.ele.scrollTop += 1;							
							if(_this.ele.scrollTop==_this.hh){								
								//clearInterval(_this.interval);
							}
							
							_this.passNode++;
							if(_this.passNode%_this.childHeight==0){
								  var o = _this.childs[_this.currentNode] || _this.childs[0];
								  _this.currentNode<(_this.childs.length-1)?_this.currentNode++:_this.currentNode=0;
								  _this.passNode = 0;
								  _this.ele.scrollTop = 0;
								  _this.ele.appendChild(o);
							}
						  },_this.speed);
	  },
	
	  pause:function(){
		 var _this = this;
	     clearInterval(_this.interval);
	  }
   }
    A.marqueen = function(obj){A._loveYR = new _ROLL(obj); return A._loveYR;}
})(window);

marqueen('roll').start(50,30);
</script>

<div style="overflow:hidden">
<!------------>
    <div class="div-system width30">
        <div class="title">系统信息</div>
        	<div class="bk10"></div>
            <ul>        
                <li><i>操作系统: </i><?php echo $SysInfo['os'];?></li>
                <li><i>服务器版本: </i><?php echo $SysInfo['web_server'];?></li>
                <li><i>PHP版本: </i><?php echo $SysInfo['phpv'];?></li>
                <li><i>MYSQL版本: </i><?php echo $SysInfo['MysqlVersion'];?></li>
                <li><i>上传限制: </i><?php echo $SysInfo['fileupload'];?></li>
                <li><i>时区: </i><?php echo $SysInfo['timezone'];?></li>
                <li><i>GD库: </i><?php echo showResult('imageline');?></li>
                <li><i>POST限制: </i><?php echo get_cfg_var('post_max_size'); ?></li>
                <li><i>脚本超时时间: </i><?php echo ini_get('max_execution_time').'秒'; ?></li>
				<li><i>set_time_limit: </i><?php echo showResult('set_time_limit'); ?></li>
				<li><i>fsockopen: </i><?php echo showResult('fsockopen'); ?></li>
                <li style="border-bottom:none;"><i>ZEND支持: </i><?php echo showResult('zend_version'); ?> </li>
      
            </ul>      
    </div>
	<?php
	$tj_category=$this->db->GetList("SELECT cateid FROM `@#_category` WHERE `model` = '1'");
	$tj_brand=$this->db->GetList("SELECT id FROM `@#_brand`");
	$tj_article=$this->db->GetList("SELECT * FROM `@#_article`");
	$tj_shoplist=$this->db->GetList("SELECT id FROM `@#_shoplist`");	
	$time=time();
	$tj_shoplist_xsjx=$this->db->GetList("SELECT id FROM `@#_shoplist` where `xsjx_time`>'$time'");
	$tj_member=$this->db->GetList("SELECT uid FROM `@#_member`");
	
	$tm=time()-24*3600;
	$tj_member_new=$this->db->GetList("SELECT uid FROM `@#_member` where `time`>'$tm' ");
	$tj_shoplist_new=$this->db->GetList("SELECT id FROM `@#_shoplist` where `time`>'$tm' ");
	$tj_member_account=$this->db->GetList("SELECT money FROM `@#_member_account` where `pay`='账户' and `type`=1 and `time`>'$tm'");
	$today_money=0;
	foreach ($tj_member_account as $account){
		$today_money=$account['money']+$today_money;
	}
	?>
    <div class="div-webinfo width30">
        <div class="title">网站信息统计</div>
        <div class="bk10"></div>
        <ul>
           <li><i>栏目:</i><?php echo count($tj_category); ?></li>
           <li><i>品牌:</i><?php echo count($tj_brand); ?></li>
           <li><i>文章:</i><?php echo count($tj_article); ?></li>
           <li><i>商品数量:</i><?php echo count($tj_shoplist); ?></li>
           <li><i>限时揭晓:</i><?php echo count($tj_shoplist_xsjx); ?></li>
           <li style="border-bottom:none;"><i>会员人数:</i><?php echo count($tj_member); ?></li>
           <li class="bk30"></li>
           <li><i>今日新增会员:</i><?php echo count($tj_member_new); ?></li>
           <li><i>今日新增商品:</i><?php echo count($tj_shoplist_new); ?></li>
           <li style="border-bottom:none;"><i>今日账户收入:</i><?php echo $today_money; ?></li>
        </ul>
    </div>
    
    <div class="div-about width30">
        <div class="title">关于我们</div>
        <div class="bk10"></div>
        <ul>
        	<li><i>程序版本:</i>V4.0.2</li>
			<li><i>更新时间:</i>2015/7/25</li>
            <li><i>程序开发:</i>Frozen</li>
             
                  
        </ul>
            <p style="color:#666; padding:20px;font: 12px/1.5 tahoma,arial,宋体b8b\4f53,sans-serif;">
            	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;此系统为专业云购网站程序，有多种实用插件，并可集成支付宝免签即时到帐接口，功能强大。www.dede168.com进行交流</p> 
    </div>
<!------------>
</div>
</body>
</html> 
