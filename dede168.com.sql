-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 09 月 06 日 17:11
-- 服务器版本: 5.5.40
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `ceshi`
--

-- --------------------------------------------------------

--
-- 表的结构 `go_admin`
--

CREATE TABLE IF NOT EXISTS `go_admin` (
  `uid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `mid` tinyint(3) unsigned NOT NULL,
  `username` char(15) NOT NULL,
  `userpass` char(32) NOT NULL,
  `useremail` varchar(100) DEFAULT NULL,
  `addtime` int(10) unsigned DEFAULT NULL,
  `logintime` int(10) unsigned DEFAULT NULL,
  `loginip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `go_admin`
--

INSERT INTO `go_admin` (`uid`, `mid`, `username`, `userpass`, `useremail`, `addtime`, `logintime`, `loginip`) VALUES
(1, 0, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 1441526349, '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `go_ad_area`
--

CREATE TABLE IF NOT EXISTS `go_ad_area` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `width` smallint(6) unsigned DEFAULT NULL,
  `height` smallint(6) unsigned DEFAULT NULL,
  `des` varchar(255) DEFAULT NULL,
  `checked` tinyint(1) DEFAULT '0' COMMENT '1表示通过',
  PRIMARY KEY (`id`),
  KEY `checked` (`checked`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='广告位' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `go_ad_area`
--

INSERT INTO `go_ad_area` (`id`, `title`, `width`, `height`, `des`, `checked`) VALUES
(1, '首页750*60', 750, 60, '图片广告', 1),
(2, '&lt;div&gt;1&lt;/div&gt;', 750, 60, 'sd', 1);

-- --------------------------------------------------------

--
-- 表的结构 `go_ad_data`
--

CREATE TABLE IF NOT EXISTS `go_ad_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` char(10) DEFAULT NULL COMMENT 'code,text,img',
  `content` text,
  `checked` tinyint(1) DEFAULT '0' COMMENT '1表示通过',
  `addtime` int(10) unsigned NOT NULL,
  `endtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='广告' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_article`
--

CREATE TABLE IF NOT EXISTS `go_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `cateid` char(30) NOT NULL COMMENT '文章父ID',
  `author` char(20) DEFAULT NULL,
  `title` char(100) NOT NULL COMMENT '标题',
  `title_style` varchar(100) DEFAULT NULL,
  `thumb` varchar(3) DEFAULT NULL,
  `picarr` text,
  `keywords` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` mediumtext COMMENT '内容',
  `hit` int(10) unsigned DEFAULT '0',
  `order` tinyint(3) unsigned DEFAULT NULL,
  `posttime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cateid` (`cateid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `go_article`
--

INSERT INTO `go_article` (`id`, `cateid`, `author`, `title`, `title_style`, `thumb`, `picarr`, `keywords`, `description`, `content`, `hit`, `order`, `posttime`, `url`) VALUES
(1, '2', 'Frozen', '了解网站', '', '', 'a:2:{i:0;s:33:"photo/20130902/41484375056924.jpg";i:1;s:33:"photo/20130902/26578125056924.jpg";}', '', '', '<p>	</p><p><br/></p><p><br/></p><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">极光闪购是一种新型的网购模式，只需1元就有可能买到一件商品。极光闪购网把一件商品平分成若干“等份”出售，每份1元，当一件商品所有“等份”售出后抽出一名幸运者，该幸运者即可获得此商品。</span></p><h3 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">规则：</span></h3><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">1、每件商品参考市场价平分成相应“等份”，每份1元，1份对应1个闪购码。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; height: 10px;"><br/></p><p><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">2、同一件商品可以购买多次或一次购买多份。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; height: 10px;"><br/></p><p><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">3、当一件商品所有“等份”全部售出后计算出“幸运闪购码”，拥有“幸运闪购码”者即可获得此商品。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; height: 10px;"><br/></p><p><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">4、幸运闪购码计算方式：</span></p><p><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><br/></span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; height: 10px;"><br/></p><p style="padding: 0px 0px 0px 36px; margin-top: 0px; margin-bottom: 0px; text-indent: -1em;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp;1.取该商品最后购买时间前网站所有商品100条购买时间记录</span></p><p style="padding: 0px 0px 0px 36px; margin-top: 0px; margin-bottom: 0px; text-indent: -1em;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;（限时揭晓商品取截止时间前网站所有商品100条购买时间记录）</span></p><p style="padding: 0px 0px 0px 36px; margin-top: 0px; margin-bottom: 0px; text-indent: -1em;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><br/></span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 1.6em;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">2.时间按时、分、秒、毫秒依次排列组成一组数值。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 1.6em;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><br/></span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 1.6em;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">3.将这100组数值之和除以商品总需参与人次后取余数，余数加上10,000,001即为“幸运闪购码”</span></p><h3 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><strong><span style="font-size: 24px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">流程：</span></strong></h3><p><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><strong style="padding: 0px; margin: 0px;">1、挑选商品</strong></span></p><p style="padding: 0px; margin-bottom: 15px;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;分类浏览或直接搜索商品，点击“立即1元闪购”。</span></p><p><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><strong style="padding: 0px; margin: 0px;">2、支付1元</strong></span></p><p style="padding: 0px; margin-bottom: 10px;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;通过在线支付平台，支付1元即购买1人次，获得1个“闪购码”。同一件商品可购买多次或一次购买多份，购买的“闪购码”越多，获得商品的几率越大。</span></p><p><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><strong style="padding: 0px; margin: 0px;">3、揭晓获得者</strong></span></p><p style="padding: 0px; margin-bottom: 15px;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;当一件商品达到总参与人次，抽出1名商品获得者，极光闪购网会通过手机短信或邮件通知您领取商品。</span></p><h3 style="padding: 0px 0px 0px 22px; margin: 0px; font-size: 14px;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">注：</span></h3><p style="padding: 0px; margin-bottom: 10px; text-indent: 1.6em;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">1）商品揭晓后您可登录&quot;我的闪购&quot;查询详情，未获得商品的用户不会收到短信或邮件通知；</span></p><p style="padding: 0px; margin-bottom: 10px; text-indent: 1.6em;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">2）商品揭晓后，请及时登录&quot;我的闪购&quot;完善个人资料，以便我们能够准确无误地为您配送商品。</span></p><p style="padding: 0px; margin-bottom: 10px; text-indent: 1.6em;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">3）所有已揭晓商品均不给予退款</span></p><p><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><strong style="padding: 0px; margin: 0px;">4、晒单分享</strong></span></p><p style="padding: 0px; margin-bottom: 0px;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;晒出您收到的商品实物图片甚至您的靓照，说出您的闪购心得，让大家一起分享您的快乐。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;在您收到商品后，您只需登录网站完成晒单，并通过审核，即可获得一定的积分奖励。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px;"><span style="font-size: 16px; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;在您成功晒单后，您的晒单会出现在网站&quot;晒单分享&quot;区，与大家分享喜悦。</span></p><p><br/></p>', 50, 1, 1375862513, NULL),
(2, '2', 'Frozen', '常见问题', '', '', 'a:0:{}', '', '', '<p>	</p><p><br/></p><h4 class="mat0" style="padding: 0px; margin: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">1、怎样查看我参与的商品有没有中奖？</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp; &nbsp; 每件商品开奖结果公布之后，登录网站，进入&quot;我的用户中心&quot;，在&quot;我中奖的商品&quot;中即可查询中奖情况。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">2、我获得了商品，我还需要支付其他费用吗？</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>不需要支付其他任何费用。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">3、当我获得商品以后我该做什么？</span></h4><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp;在您获得商品后您会收到站内信、短信和电子邮件的通知。在这之后，您必须在“我的闪购”正确填写、真实的收货地址，完善或确认您的个人信息。我们会在您获得商品后3个工作日内通过电话方式与您取得联系。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">4、商品是正品吗？怎么保证？</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>我们承诺，所有商品100%正品，可享受厂家所提供的全国联保服务，享受商品的保修、换货和退货的义务（国家三包政策）。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">5、如何晒单分享？</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>在您收到商品后，登录网站，进入&quot;我的闪购&quot;，在“晒单分享”区发布晒单信息，通过审核后，您还可获得一定的积分奖励。在您成功晒单后，您的晒单会出现在网站“晒单分享”区，与大家分享喜悦。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">6、我收到的商品可以换货或者退货吗？</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>非质量问题，不在三包范围内，不给予退换货。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">7、参与极光闪购需要注意什么？</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>请务必正确填写真实有效的联系电话、收货地址以便在您中奖时能及时与您取得联系。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">8、网上银行充值未及时到帐怎么办？</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>网上支付未及时到帐可能有以下几个原因造成：</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>第一，由于网速或者支付接口等问题，支付数据没有及时传送到支付系统造成的；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>第二，网速过慢，数据传输超时，使银行后台支付信息不能成功对接，导致银行交易成功而支付后台显示失败；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>第三，在网上支付如果使用某些防火墙软件，有时会屏蔽银行接口的弹出窗口，这时会造成在银行那边被扣费，但在我们网站上显示尚没支付。但请您放心，每天我们都会根据银行系统的帐务明细清单对前一天的订单进行逐笔核对，如遇问题订单，我们会做手工添加。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><strong>&nbsp; &nbsp; &nbsp; &nbsp;如您对我们“帮助中心”的说明有任何疑问或建议请</strong></span><a href="http://help.1yyg.com/htm-contactus.html" style="padding: 0px; margin: 0px; text-decoration: underline; color: rgb(102, 102, 102); word-break: break-all; outline: none; font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><strong>告诉我们</strong></span></a></p><p><br/></p>', 56, 3, 1375862591, NULL);
INSERT INTO `go_article` (`id`, `cateid`, `author`, `title`, `title_style`, `thumb`, `picarr`, `keywords`, `description`, `content`, `hit`, `order`, `posttime`, `url`) VALUES
(3, '2', 'Frozen', '服务协议', '', '', 'a:0:{}', '', '', '<p>	</p><p><br/></p><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">欢迎您访问并使用充满互动乐趣的购物网站-极光闪购，作为为用户提供全新、有趣购物模式的互联网公司，极光闪购通过在线网站为您提供各项相关服务。当使用极光闪购的各项具体服务时，您和<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>都将受到本服务协议所产生的制约，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>会不断推出新的服务，因此所有服务都将受此服务条款的制约。请您在注册前务必认真阅读此服务协议的内容并确认，如有任何疑问，应向<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>咨询。一旦您确认本服务协议后，本服务协议即在用户和<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>之间产生法律效力。您在注册过程中点击“同意以下条款提交注册信息”按钮即表示您完全接受本协议中的全部条款。随后按照页面给予的提示完成全部的注册步骤。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>将可能不定期的修改本服务协议的有关条款，并保留在必要时对此协议中的所有条款进行随时修改的权利。一旦协议内容有所修改，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>将会在网站重要页面或社区的醒目位置第一时间给予通知。如果您继续使用<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>的服务，则视为您受协议的改动内容。如果不同意本站对协议内容所做的修改，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>会及时取消您的服务使用权限。本站保留随时修改或中断服务而不需告知用户的权利。本站行使修改或中断服务的权利，不需对用户或第三方负责。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">一、用户注册</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;1、用户注册是指用户登录<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>，按要求填写相关信息并确认同意本服务协议的过程。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;2、<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>用户必须是具有完全民事行为能力的自然人，或者是具有合法经营资格的实体组织。无民事行为能力人、限制民事行为能力人以及无经营或特定经营资格的组织不得注册为<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>用户或超过其民事权利或行为能力范围与<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>进行交易，如与<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>进行交易的，则服务协议自始无效，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>有权立即停止与该用户的交易、注销该用户账户，并有权要求其承担相应法律责任。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">二、用户的帐号，密码和安全性</span></h4><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">用户一旦注册成功，成为本站的合法用户。用户将对用户名和密码安全负全部责任。此外，每个用户都要对以其用户名进行的所有活动和事件负全责。用户若发现任何非法使用用户帐号或存在安全漏洞的情况，请立即通告本站。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">三、<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>原则</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">1、释义</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;闪购码：指<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>用户成功参与闪购之后获得的随机分配编码。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;幸运闪购码：指某件商品所有编码售出后，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网根据规则计算出的一个编码，持有该编码的用户即可获得该商品。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">2、<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网承诺遵循以下的原则运营网站，确保所有用户在<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网中享受同等的权利与义务。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;平等原则：用户和<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>在交易过程中具有同等的法律地位。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;自由原则：用户享有自愿向<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>参与购买商品的权利，任何人不得非法干预。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;公平原则：用户和<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>行使权利、履行义务应当遵循公平原则。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;诚实信用原则：用户和<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>行使权利、履行义务应当遵循诚实信用原则。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;履行义务原则：用户向<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>参与商品分享购买时，</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;用户和<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>皆有有义务根据本服务协议的约定完成该等交易（法律或本协议禁止的交易除外）。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">3、用户知悉，除本协议另有约定外，用户无论是否获得商品，参与云购的资金均用于帮助他人，不能退回；用户完全了解参与<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>存在的风险，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网无法保证用户参与云购一定会获得商品。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">四、用户的权利和义务</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;1、用户有权拥有其在<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>的用户名及密码，并用该用户名和密码登录<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>参与商品购买。用户不得以任何形式转让或授权他人使用自己的<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>用户名。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;2、用户有权根据本协议的规定以及<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网站上发布的相关规则在<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>上查询商品信息、发表使用体验、参与商品讨论、邀请关注好友、上传商品图片、参加<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>的有关活动，以及享受<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>提供的其它信息服务</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;3、用户有义务在注册时提供自己的真实资料，并保证诸如电子邮件地址、联系电话、联系地址、邮政编码等内容的有效性及真实性，保证<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>可以通过上述联系方式与用户本人进行联系。同时，用户也有义务在相关资料发生变更时及时更新有关注册资料。用户保证不以他人资料在<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>进行注册和参与商品分享购买。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;4、用户应当保证在<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>参与商品分享购买时遵守诚实信用原则，不扰乱网上交易的正常秩序。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;5、用户在成为<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>的会员后，可按<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>的积分规则享受福分获得。累积福分可用于积分商城中的相应积分分商品兑换。积分规则连同与规则相关的条款和条件，构成用户与<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>之间的完整协议。接受本协议，即表明接受积分规则中的条款和条件。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;6、用户享有言论自由权利；并拥有适度修改、删除自己发表的文章的权利用户不得在<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>发表包含以下内容的言论：</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;1) 反对宪法所确定的基本原则，煽动、抗拒、破坏宪法和法律、行政法规实施的；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;2) 煽动颠覆国家政权，推翻社会主义制度，煽动、分裂国家，破坏国家统一的；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>3) 损害国家荣誉和利益的；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>4) 煽动民族仇恨、民族歧视，破坏民族团结的；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>5) 任何包含对种族、性别、宗教、地域内容等歧视的；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>6) 捏造或者歪曲事实，散布谣言，扰乱社会秩序的；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>7) 宣扬封建迷信、邪教、淫秽、色情、赌博、暴力、凶杀、恐怖、教唆犯罪的；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>8) 公然侮辱他人或者捏造事实诽谤他人的，或者进行其他恶意攻击的；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>9) 损害国家机关信誉的；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>10) 其他违反宪法和法律行政法规的。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;7、用户在发表使用体验、讨论图片等，除遵守本条款外，还应遵守该讨论区的相关规定。</span><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;8、未经<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>同意，禁止用户在网站发布任何形式的广告。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">五、<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>的权利和义务</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;1、<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>有义务在现有技术上维护整个网上交易平台的正常运行，并努力提升和改进技术，使用户网上交易活动得以顺利进行；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;2、对用户在注册和使用<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网上交易平台中所遇到的与交易或注册有关的问题及反映的情况，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>应及时作出回复；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;3、对于用户在<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网站上作出下列行为的，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>有权作出删除相关信息、终止提供服务等处理，而无须征得用户的同意：</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>1)</span><span style="text-indent: 28px;">极光闪购</span><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">有权对用户的注册信息及购买行为进行查阅，发现注册信息或购买行为中存在任何问题的，有权向用户发出询问及要求改正的通</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><br/></span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><br/></span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">或者作出删除等处理；</span><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><br/></span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>2) 用户违反本协议规定或有</span><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">违反法律法规和地方规章的行为的，</span><span style="text-indent: 28px;">极光闪购</span><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">有权停止传输并删除其信息，禁止用户发言，注销用户账户并按照相关法律规定向相关主管部门进行披露。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>3) 对于用户在<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>进行的下列行为，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>有权对用户采取删除其信息、禁止用户发言、注销用户账户等限制性措施：包括发布或以电子邮件或以其他方式传送存在恶意、虚假和侵犯他人人身财产权利内容的信息，进行与分享购物无关或不是以分享购物为目的的活动，恶意注册、签到、评论等方式试图扰乱正常购物秩序，将有关干扰、破坏或限制任何计算机软件、硬件或通讯设备功能的软件病毒或其他计算机代码、档案和程序之资料，加以上载、发布、发送电子邮件或以其他方式传送，干扰或破坏<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网站和服务或与<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网站和服务相连的服务器和网络，或发布其他违反公共利益或可能严重损害<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>和其它用户合法利益的信息。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;4、用户在此免费授予<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>永久性的独家使用权(并有权对该权利进行再授权)，使1元云购有权在全球范围内(全部或部分地)使用、复制、修订、改写、发布、翻译和展示用户公示于<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网站的各类信息，或制作其派生作品，和或以现在已知或日后开发的任何形式、媒体或技术，将上述信息纳入其它作品内。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;5、对于<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网络平台已上架商品，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>有权根据市场变动修改商品价格，而无需提前通知客户。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;6、<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>分享购物模式，秉着双方自愿原则，分享购物存在风险，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>不对抽取的“幸运编号”结果承担责任，望所有用户谨慎参与。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;7、90天未达到“总需参与人次”的商品，用户可通过客服申请退款，所退款项将在3个工作日内，退还至闪购账户中。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">六、配送及费用</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp;</span>极光闪购</span>将会把产品送到您所指定的送货地址。全国免费配送（港澳台地区除外）。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;请清楚准确地填写您的真实姓名、送货地址及联系方式。因如下情况造成配送延迟或无法配送等，本站将不承担责任：</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;1、客户提供错误信息和不详细的地址；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;2、货物送达无人签收，由此造成的重复配送所产生的费用及相关的后果。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;3、不可抗力，例如：自然灾害、交通戒严、突发战争等。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">七、商品缺货规则</span></h4><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">由于市场变化及各种以合理商业努力难以控制的因素的影响，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网无法承诺用户所获得的商品都会有货；用户获得的商品或服务如果发生缺货，协议双方均无权取消该交易，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网将通过有效方式通知用户进行换货，用户可选择换购本商城同等价位的商品（一件或多件），或选择补差价换购高价位商品。</span></p><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>可对即将上市的商品或服务进行预售登记，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网会在商品或者服务正式上市之后尽最大努力在最快时间内给商品获得者安排发货，预售登记并不做交易处理，不构成要约。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">八、责任限制</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;1、用户理解并同意，在使用<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网服务的过程中，可能会遇到不可抗力等风险因素使<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网服务发生中断。不可抗力是指不能预见、不能克服并不能避免且对一方或双方造成重大影响的客观事件，包括但不限于自然灾害如洪水、地震、瘟疫流行和风暴等以及社会事件如战争、动乱、政府行为等。出现上述情况时，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网将努力在第一时间与相关单位配合，及时进行修复，但是由此给用户造成的损失，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网将在法律允许的范围内免责。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;2、用户理解并同意，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网不能随时预见和防范法律、技术以及其他不可控的风险，对以下情形之一导致的服务中断或受阻，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网不承担责任：</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>（1）大规模病毒、木马或其他恶意程序、黑客攻击的破坏；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>（2）用户或<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网的电脑软件、系统、硬件和通信线路出现故障；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>（3）用户操作不当；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>（4）用户通过非<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网授权的方式使用服务；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>（5）政府管制等原因可能导致的服务中断、数据丢失以及其他的损失和风险。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>（6）其他<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>网无法控制或合理预见的情形。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;3、在法律法规所允许的限度内，因使用<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>服务而引起的任何损害或经济损失，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>承担的全部责任均不超过用户所购买的与该索赔有关的商品价格。这些责任限制条款将在法律所允许的最大限度内适用，并在用户资格被撤销或终止后仍继续有效。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">九、网络服务内容的所有权</span></h4><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">本站定义的网络服务内容包括：文字、软件、声音、图片、录象、图表、广告中的全部内容；电子邮件的全部内容；本站为用户提供的其他信息。所有这些内容受版权、商标、标签和其它财产所有权法律的保护。所以，用户只能在本站和广告商授权下才能使用这些内容，而不能擅自复制、再造这些内容、或创造与内容有关的派生产品。本站所有的文章版权归原文作者和本站共同所有，任何人需要转载本站的文章，必须征得原文作者或本站授权。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">十、用户隐私制度</span></h4><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">我们不会向任何第三方提供，出售，出租，分享和交易用户的个人信息。当在以下情况下，用户的个人信息将部分或全部被善意披露：</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;1、经用户同意，向第三方披露；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp;</span>2、如用户是合资格的知识产权投诉人并已提起投诉，应被投诉人要求，向被投诉人披露，以便双方处理可能的权利纠纷；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp;</span>3、根据法律的有关规定，或者行政或司法机构的要求，向第三方或者行政、司法机构披露；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp;</span>4、如果用户出现违反中国有关法律或者网站政策的情况，需要向第三方披露；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp;</span>5、为提供你所要求的产品和服务，而必须和第三方分享用户的个人信息；</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp;</span>6、其它本站根据法律或者网站政策认为合适的披露。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">十一、法律管辖和适用</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp;</span>1、本协议的订立、执行和解释及争议的解决均应适用中国法律。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp;</span>2、如发生本站服务条款与中国法律相抵触时，则这些条款将完全按法律规定重新解释，而其它合法条款则依旧保持对用户产生法律效力和影响。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp;</span>3、本协议的规定是可分割的，如本协议任何规定被裁定为无效或不可执行，该规定可被删除而其余条款应予以执行。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp;</span>4、如双方就本协议内容或其执行发生任何争议，双方应尽力友好协商解决；协商不成时，任何一方均可向本站所在地的人民法院提起诉讼。</span></p><p><br/></p>', 98, 0, 1375862644, NULL);
INSERT INTO `go_article` (`id`, `cateid`, `author`, `title`, `title_style`, `thumb`, `picarr`, `keywords`, `description`, `content`, `hit`, `order`, `posttime`, `url`) VALUES
(4, '3', 'Frozen', '购保障体系', '', '', 'a:0:{}', '', '', '<p>	</p><p><br/></p><p><br/></p><h4 class="mat0" style="padding: 0px; margin: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">100%正品保证</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>精心挑选优质服务品牌商家，保障全场商品100%品牌正品。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">100%公平公正</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">整个过程是完全透明，您可以随时查看每件商品参与人数，参与次数，参与名单及中奖信息等记录。</span></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">全国免费快递</span></h4><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>承诺全场所有商品全国免费快递。（港澳台地区除外）</span></p><p><br/></p>', 77, 0, 1375862690, NULL),
(5, '3', 'Frozen', '正品保障', '', '', 'a:0:{}', '', '', '<p>	</p><p><br/></p><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>严格控制供应渠道，全部商品均从品牌官方以及品牌经销商直接采购供货，并取得品牌官方网络销售授权书，如果您认为闪购的商品是假货，并能提供国家相关质检机构的证明文件，经确认后，在返还商品金额的同时并提供假一赔十服务保障。为了保障您的利益，对闪购的商品，做如下说明：</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p class="bottom-space16px" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">1、<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>对所有商品均保证正品行货，正规渠道发货，所有商品都可以享受生产厂家的全国联保服务，按照国家三包政策，针对所售商品履行保修、换货和退货的义务。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p class="bottom-space16px" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">2、出现国家三包所规定的功能性故障时，经由生产厂家指定或特约售后服务中心检测确认故障属实，您可以选择换货或者维修；超过15日且在保修期内，您只能在保修期内享受免费维修服务。为了不耽误您使用，缩短故障商品的维修时间，我们建议您直接联系生产厂家售后服务中心进行处理。您也可以直接在商品的保修卡中查找该商品对应的全国各地生产厂家售后服务中心联系处理。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p class="bottom-space16px" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">3、<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>真诚提醒广大幸运者在您收到商品的时候，请尽量亲自签收并当面拆箱验货，如果有问题(运输途中的损坏)请不要签收! 与快递员交涉，拒签，退回!</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p class="bottom-space16px" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">4、在收到商品后发现有质量问题，请您不要私自处理，妥善保留好原包装，第一时间联系<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>客服人员，由<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>同发货商城协商在48小时内解决。如有破损或丢失，我们将无法为您办理退货。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">如对协商处理结果存在异议，请您自行到当地生产厂家售后服务中心进行检测，并开据正规检测报告（对于有些生产厂家售后服务中心无法提供检测报告的，需提供维修检验单据），如果检测报告确认属于质量问题，然后将检测报告、问题商品及完整包装附件，一并返还发货商城办理换货手续，产生的相关费用由<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>追究相关责任方承担。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>上的电子产品及配件因为生成工艺或仓储物流原因，可能会存在收到或使用过程中出现故障的几率，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>不能保证所有的商品都没有故障，但我们保证所售商品都是全新正品行货，能够提供正规的售后保障。我们保证商品的正规进货渠道和质量，如果您对收到的商品质量表示怀疑，请提供生产厂家或官方出具的书面鉴定，我们会按照国家法律规定予以处理。但对于任何欺诈性行为，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>将保留依法追究法律责任的权利。本规则最终解释权由<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>所有。</span></p><p><br/></p>', 63, 0, 1375862702, NULL),
(6, '3', 'Frozen', '安全支付', '', '', 'a:0:{}', '', '', '<p>	</p><p><br/></p><p><br/></p><p><br/></p><p><span style="font-size: 18px; color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; line-height: 30px; text-indent: 28px;">极光闪购&nbsp;</span><span style="font-size: 16px; color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; line-height: 30px; text-indent: 28px;">作为联在线支付、支付宝等的认证商家，严格遵循网络购物的安全准则，充分保证您在线支付的安全性。</span></p>', 45, 0, 1375862712, NULL),
(7, '4', 'Frozen', '商品配送', '', '', 'a:0:{}', '', '', '<p>	</p><p><br/></p><p><br/></p><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">在您获得商品后，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>将在第一时间内免费为你寄出，一般采用签约快递，均为服务好，覆盖网点非常广泛的全国性快递公司或者邮政的EMS，以最大限度保证商品安全。如快递公司无法达到的地方，则使用邮政EMS为您寄送商品。</span></p><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">若遇商品暂时缺货或者是有其他方面的问题，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>客服将会及时与您沟通处理。</span></p><p><br/></p>', 56, 0, 1375862725, NULL),
(8, '4', 'Frozen', '配送费用', '', '', 'a:0:{}', '', '', '<p>	</p><p><br/></p><p><br/></p><p><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">所有商品全国免费配送。（港澳地区除外）</span></p>', 30, 0, 1375862737, NULL),
(9, '4', 'Frozen', '商品验货与签收', '', '', 'a:0:{}', '', '', '<p>	</p><p><br/></p><p><br/></p><p class="bottom-space16px" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp;</span>1、您在签收商品时请慎重，请尽量不要让人代签，并务必先仔细检查商品（外包装是否被开封、商品是否破损、配件是否缺失、功能是否正常），确保无误后再签收，以免产生不必要的纠纷。若有任何疑问，请及时拨打客服电话反馈信息。若因用户未仔细检查商品即签收后产生的纠纷，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>概不负责，仅承担协调处理的义务。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p class="bottom-space16px" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp;</span>2、若因您的地址填写错误、联系方式填写有误等情况造成商品无法完成投递或被退回，所产生的额外费用及后果由用户负责。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 30px;">&nbsp; &nbsp; &nbsp;</span>3、如因不可抗拒的自然原因（地震、洪水等等）所造成的商品配送延迟，<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px; text-indent: 28px;">极光闪购</span>不承担责任。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px;"><br/></p><h4 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp;温馨提醒：</span><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; text-indent: 2em;">若您或您的委托人已签收，则说明订单商品正确无误且不存在影响使用的因素，</span><span style="text-indent: 28px;">极光闪购</span><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; text-indent: 2em;">有权不受理因包装或商品破损、商品错漏发、商品表面质量问题、商品附带品及赠品少发为由的换货申请。</span></h4><p><br/></p>', 74, 0, 1375862747, NULL),
(10, '4', 'Frozen', '长时间未收到商品', '', '', 'a:0:{}', '', '', '<p>	</p><p><br/></p><p><br/></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">长时间未收到商品可能出现的问题：</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">1、请您确保您的收货地址、邮编、电话、Email地址等各项信息的准确性，以便商品及时、准确地发出。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">2、配送过程中如果我们联络您的时间超过7天未得到回复，此商品将被默认为您已经放弃。</span></p><p><br/></p>', 98, 0, 1375862760, NULL),
(13, '2', 'Frozen', '联系我们', '', '', 'a:0:{}', '', '', '<p>	</p><p><br/></p><h3 class="mat0" style="padding: 0px; margin: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">联系我们</span></h3><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">热 线：18672393060</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">邮 箱：33634420@qq.com</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">地 址：湖北省武汉市青山区建设五路</span></p><p class="bottom-space20px" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">邮 编：430080</span></p><h3 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">商务合作</span></h3><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">极光闪购拥有国内庞大的消费群体及专业高效的电子商务平台，</span></p><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">诚意邀请各品牌供应商与我们达成商务合作，共同创造中国电子商务的美好明天。</span></p><h3 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">市场推广</span></h3><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">随着极光闪购发展壮大以及全国各地市场的开拓，</span></p><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">欢迎拥有市场推广、广告合作资源的您与我们携手共进，共同发展。 携手共进。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;电 话：18672393060</span></p><p class="bottom-space20px" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;邮 箱：<span style="font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; color: rgb(102, 102, 102); font-size: 14px; line-height: 30px;">33634420@qq.com</span></span></p><h3 style="padding: 0px; margin: 30px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">媒体关注</span></h3><p class="textindent" style="padding: 0px; margin-top: 0px; margin-bottom: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;;">随着极光闪购的发展，欢迎各类媒体前来沟通指导，同时欢迎各类内容合作策划传播，你们的关注和支持，采访以及报道，将成为极光闪购成长历程不可或缺的一部分。</span></p><p style="padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal;"><br/></p><p><br/></p>', 61, 1, 1408798466, NULL),
(14, '16', 'Frozen', '购物公益', '', '', 'a:0:{}', '', '', '<p>	</p><p><br/></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">一、闪购基金是极光闪购创始人发起成立的以公益事业为主要方向的爱心基金。闪购基金本着“我为人人，人人为我”的社会责任，向需要帮助的困难人们提供爱心捐助。</span></p><p><br/></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">二、每位在极光闪购进行分享购物的朋友，您的每次参与都将是为我们的公益事业做出一份贡献。当您每参与1人次闪购，将由极光闪购出资为闪购基金筹款0.01元，所筹款项将全部用于闪购基金。</span></p><p><br/></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">三、闪购基金将会以第1种途径或第2种途径进行使用：<br/>1、极光闪购全体员工将组织向身边的公益事业进行捐赠与关怀活动。活动内容包括：资金、所需用品以及探望与协助等，每次捐赠与关怀活动结束后闪购基金将公布活动详情以及基金详细使用报告。<br/>2、闪购基金通过腾讯公益或壹基金等公益组织进行爱心捐赠。</span></p><p><br/></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">四、包括闪购基金的捐赠活动，我们不定期开展内部全体员工对身边更多公益事业或实时公益事业进行爱心捐赠的社会活动。</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">&nbsp; &nbsp;</span></p><p><span style="font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 14px;">&nbsp; &nbsp; 我们还将不定期邀请幸运者参与并见证我们的基金社会活动，共同为我们的社会责任付出一份爱心与力量。当活动启动前我们会将活动进行公告，您可自愿或自行组织参与，组成闪购大家庭，共同开启活动之行。凡参与社会活动的幸运者均能获得极光闪购为您精心准备的公益爱心礼品一份。</span></p><p><br/></p>', 63, 1, 1414361199, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `go_brand`
--

CREATE TABLE IF NOT EXISTS `go_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` varchar(255) DEFAULT NULL COMMENT '所属栏目ID',
  `status` varchar(255) DEFAULT 'Y' COMMENT '显示隐藏',
  `name` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT '1',
  `thumb` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `order` (`order`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='品牌表' AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `go_brand`
--

INSERT INTO `go_brand` (`id`, `cateid`, `status`, `name`, `order`, `thumb`, `url`) VALUES
(15, '6,24', 'Y', '移动/联通/电信', 1, NULL, NULL),
(2, '5', 'Y', '诺基亚', 1, NULL, NULL),
(3, '5', 'Y', '苹果', 1, NULL, NULL),
(4, '5', 'Y', '三星', 14, NULL, NULL),
(6, '5', 'Y', '小米', 1, NULL, NULL),
(14, '23,6', 'Y', 'QQ', 1, NULL, NULL),
(10, '13', 'Y', '苹果', 1, NULL, NULL),
(11, '5', 'Y', '三星', 1, NULL, NULL),
(16, '31,6', 'Y', '极光闪购', 1, NULL, NULL),
(17, '12,25', 'Y', '旺旺', 1, NULL, NULL),
(18, '12,26', 'Y', '加多宝', 1, NULL, NULL),
(19, '12,27', 'Y', '蓝罐', 1, NULL, NULL),
(20, '18,5', 'Y', '红米', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `go_caches`
--

CREATE TABLE IF NOT EXISTS `go_caches` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `key` (`key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `go_caches`
--

INSERT INTO `go_caches` (`id`, `key`, `value`) VALUES
(1, 'member_name_key', 'admin,administrator,云购官方'),
(2, 'shopcodes_table', '1'),
(3, 'goods_count_num', '25'),
(4, 'template_mobile_reg', '你好,你的注册验证码是:000000如非本人操作，可不用理会！'),
(5, 'template_mobile_shop', '恭喜你云购用户！您在极光闪购够买的商品已揭晓,获得的幸运码为：00000000请登陆网站查看详情！请尽快联系管理员发货！'),
(6, 'template_email_reg', '<table width="600" cellpadding="0" cellspacing="0" style="border: #dddddd 1px solid; padding: 20px 0;">\n<tbody>\n<tr>\n<td>\n<table width="100%" align="center" cellpadding="0" cellspacing="0" style="border-bottom: #ff6600 2px solid; padding-bottom: 12px;">\n<tbody>\n<tr>\n<td style="line-height:22px; padding-left:20px;">\n<a href="http://www.1yyg.com/" target="_blank" style=" font-size:32px;color:#ff7700; text-decoration:none;"><b>极光闪购</b></a></td>\n<td align="right" style="font-size: 12px; padding-right: 20px; padding-top: 30px;">\n<a href="http://www.1yyg.com/" target="_blank" style="color: #2AF; text-decoration: none;">首页</a>\n<b style="width: 1px; height: 10px; vertical-align: -1px; font-size: 1px; background: #CACACA; display: inline-block; margin: 0 5px;"></b>\n<a href="http://www.1yyg.com/?/member/home" target="_blank" style="color: #22aaff; text-decoration: none;">我的1元云购</a>\n<b style="width: 1px; height: 10px; vertical-align: -1px; font-size: 1px; background: #CACACA; display: inline-block; margin: 0 5px;"></b>\n<a href="http://www.1yyg.com/?/help/1" target="_blank" style="color: #22aaff; text-decoration: none;">帮助中心</a></td>\n</tr>\n</tbody>\n</table>\n<table width="100%" align="center" cellpadding="0" cellspacing="0" style="padding: 0 20px;">\n<tbody>\n<tr>\n<td style="font-size: 14px; color: #333333; height: 40px; line-height: 40px; padding-top: 10px;">\n<b style="color: #333333; font-family: Arial;"> </b></td>\n</tr>\n<tr>\n<td style="font-size: 12px; color: #333333; line-height: 22px;">\n<p style="text-indent: 2em; padding: 0; margin: 0;">亲爱的用户您好！感谢您注册极光闪购。</p></td>\n</tr>\n<tr>\n<td style="font-size: 12px; color: #333333; line-height: 22px;">\n<p style="text-indent: 2em; padding: 0; margin: 0;">请在24小时内激活注册邮件，点击连接激活邮件：</p></td>\n</tr>\n<tr>\n</tr>\n<tr>\n<td width="525" style="font-size: 12px; padding-top: 5px; word-break: break-all; word-wrap: break-word;">\n<a href="#" target="_blank" style="font-family: Arial; color: #22aaff;">{地址}</a></td>\n</tr>\n</tbody>\n</table>\n<table width="100%" align="center" cellpadding="0" cellspacing="0" style="margin-top: 60px;">\n<tbody>\n<tr>\n<td style="font-size: 12px; color: #777777; line-height: 22px; border-bottom: #22aaff 2px solid; padding-bottom: 8px; padding-left: 20px;">此邮件由系统自动发出，请勿回复！</td>\n</tr>\n<tr>\n<td style="font-size: 12px; color: #333333; line-height: 22px; padding: 8px 20px 0;">感谢您对1元云购网（<a href="#" target="_blank" style="color: #22aaff; font-family: Arial;">http://www.1yyg.com</a>）的支持，祝您好运！</td>\n</tr>\n<tr>\n<td style="font-size: 12px; color: #333333; line-height: 22px; padding: 0 20px;">客服热线：<b style="color: #ff6600; font-family: Arial;">4000900710</b></td>\n</tr>\n</tbody>\n</table>\n</td>\n</tr>\n</tbody>\n</table>\n<table cellpadding="0" cellspacing="0" width="600"> <tbody> <tr> <td align="center" style="font-size:12px; color:#999; line-height:30px">Copyright © 2013 - 2015, 版权所有 1yyg.com 黔ICP备14004275号-3</td>\n</tr>\n</tbody>\n</table>'),
(7, 'template_email_shop', '<table width="600" cellpadding="0" cellspacing="0" style="border:#dddddd 1px solid; padding:20px 0;">\n<tbody>\n<tr>\n<td>\n<table width="100%" align="center" cellpadding="0" cellspacing="0" style="border-bottom:#ff6600 2px solid; padding-bottom:12px;">\n<tbody>\n<tr>\n<td style="line-height:22px; padding-left:20px;">\n<a href="http://www.banggouw.com/" target="_blank" style=" font-size:32px;color:#ff7700; text-decoration:none;"><b>极光闪购</b></a></td>\n<td align="right" style="font-size:12px; padding-right:20px; padding-top:30px;">\n<a href="http://www.banggouw.com/" target="_blank" style=" color:#22aaff; text-decoration:none;">首页</a>\n<b style="width:1px; height:10px; vertical-align:-1px; font-size:1px; background:#CACACA; display:inline-block; margin:0 5px;"></b>\n<a href="http://www.banggouw.com/?/member/home" target="_blank" style=" color:#22aaff; text-decoration:none;">我的1元帮购</a>\n<b style="width:1px; height:10px; vertical-align:-1px; font-size:1px; background:#CACACA; display:inline-block; margin:0 5px;"></b>\n<a href="http://www.banggouw.com/?/help/1" target="_blank" style=" color:#22aaff; text-decoration:none;">帮助中心</a></td>\n</tr>\n</tbody>\n</table>\n<table width="100%" align="center" cellpadding="0" cellspacing="0" style="padding:0 20px;">\n<tbody>\n<tr>\n<td style="font-size:14px; color:#333333; height:40px; line-height:40px; padding-top:10px;">亲爱的 <b style="color:#333333; font-family:Arial;">{用户名}</b>：</td> </tr>\n<tr>\n<td style="font-size:12px; color:#333333; line-height:22px;">\n<p style="text-indent:2em; padding:0; margin:0;">您好！恭喜您获得“<a target="_blank" style="color:#22aaff;">{商品名称}</a>”商品，幸运码是:<b style="color:#ff6600; font-family:Arial;">{中奖码}</b>，请您及时登录“我的闪购”-“获得的商品”填写收货地址。</p>\n</td>\n</tr>\n<tr>\n<td style="padding-top:15px;">\n<a href="http://www.banggouw.com/?/member/home/address" target="_blank" style="display:inline-block; padding:0 25px; height:28px; line-height:28px; text-align:center; color:#ffffff; background:#ff7700; font-size:12px; cursor:pointer; border-radius: 2px; text-decoration:none;" title="立即填写收货地址">立即填写收货地址</a></td>\n</tr>\n<tr>\n<td style="font-size:12px; color:#333333; line-height:22px; padding-top:15px;">如果您有任何疑问，请与我们联系。 </td>\n</tr>\n<tr>\n<td style="font-size:12px; color:#333333; line-height:22px;">客服热线：xxxx-xxx-xxx（周一至周五 9:00-18:00） </td>\n</tr>\n<tr>\n<td style="font-size:12px; color:#333333; line-height:22px;">客服邮箱：<a href="mailto:service@xxxx.com" target="_blank" style="color:#22aaff;">service@xxx.com</a> </td>\n</tr>\n</tbody>\n</table>\n<table width="100%" align="center" cellpadding="0" cellspacing="0" style="margin-top:60px;"> <tbody>\n<tr>\n<td style="font-size:12px; color:#777777; line-height:22px; border-bottom:#22aaff 2px solid; padding-bottom:8px; padding-left:20px;">此邮件由系统自动发出，请勿回复！</td>\n</tr>\n<tr>\n<td style="font-size:12px; color:#333333; line-height:22px; padding:8px 20px 0;">感谢您对1元云购（<a href="http://www.xxxx.com" target="_blank" style="color:#22aaff; font-family:Arial;">http://www.xxxx.com</a>）的支持，祝您好运！</td> </tr>\n<tr>\n<td style="font-size:12px; color:#333333; line-height:22px; padding:0 20px;">客服热线：<b style="color:#ff6600; font-family:Arial;">xxxx-xxx-xxx</b></td>\n</tr>\n</tbody>\n</table>\n</td>\n</tr>\n</tbody>\n</table>\n<table cellpadding="0" cellspacing="0" width="600"> <tbody> <tr> <td align="center" style="font-size:12px; color:#999; line-height:30px">Copyright © 2013 - 2014, 版权所有xxxx.com ICP备xxxxxxxxx号</td> </tr> </tbody>\n</table>'),
(8, 'pay_bank_type', 'yeepay'),
(9, 'template_mobile_pwd', '你现在正在找回密码，你的验证码是【000000】。'),
(10, 'template_email_pwd', '请在24小时内激活邮件，点击连接激活邮件：{地址}');

-- --------------------------------------------------------

--
-- 表的结构 `go_category`
--

CREATE TABLE IF NOT EXISTS `go_category` (
  `cateid` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '栏目id',
  `parentid` smallint(6) DEFAULT NULL COMMENT '父ID',
  `channel` tinyint(4) NOT NULL DEFAULT '0',
  `model` tinyint(1) DEFAULT NULL COMMENT '栏目模型',
  `name` varchar(255) DEFAULT NULL COMMENT '栏目名称',
  `catdir` char(20) DEFAULT NULL COMMENT '英文名',
  `url` varchar(255) DEFAULT NULL,
  `info` text,
  `order` smallint(6) unsigned DEFAULT '1' COMMENT '排序',
  `cids` varchar(100) DEFAULT NULL,
  `html` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cateid`),
  KEY `name` (`name`),
  KEY `order` (`order`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='栏目表' AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `go_category`
--

INSERT INTO `go_category` (`cateid`, `parentid`, `channel`, `model`, `name`, `catdir`, `url`, `info`, `order`, `cids`, `html`) VALUES
(1, 0, 0, 2, '帮助', 'help', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";N;s:7:"content";N;s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1, NULL, 0),
(2, 1, 0, 2, '新手指南', 'xinshouzhinan', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:22:"article_list.list.html";s:13:"template_show";s:22:"article_show.help.html";}', 1, NULL, 0),
(3, 1, 0, 2, '购物保障', 'yunbaozhang', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:22:"article_list.list.html";s:13:"template_show";s:22:"article_show.help.html";}', 1, NULL, 0),
(4, 1, 0, 2, '商品配送', 'peisong', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:22:"article_list.list.html";s:13:"template_show";s:22:"article_show.help.html";}', 1, NULL, 0),
(5, 0, 0, 1, '手机数码', 'shoujishuma', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 6, NULL, 0),
(6, 0, 0, 1, '虚拟产品', 'XVNiv', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 4, NULL, 0),
(7, 0, 0, -1, '新手指南', 'newbie', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:22:"single_web.newbie.html";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1, NULL, 0),
(8, 0, 0, -1, '合作专区', 'business', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:24:"single_web.business.html";s:7:"content";s:34:"<p>输入栏目内容...567678</p>";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1, NULL, 0),
(9, 0, 0, -1, '公益基金', 'fund', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:20:"single_web.fund.html";s:7:"content";s:28:"<p>输入栏目内容...</p>";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1, NULL, 0),
(10, 0, 0, -1, '网站QQ群', 'qqgroup', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:23:"single_web.qqgroup.html";s:7:"content";s:40:"PHA+6L6T5YWl5qCP55uu5YaF5a65Li4uPC9wPg==";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1, NULL, 0),
(11, 0, 0, -1, '邀请注册', 'pleasereg', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:25:"single_web.pleasereg.html";s:7:"content";s:28:"<p>输入栏目内容...</p>";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1, NULL, 0),
(12, 0, 0, 1, '食品饮料', 'food', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 3, NULL, 0),
(13, 0, 0, 1, '电脑办公', 'diannaobangong', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 5, NULL, 0),
(14, 0, 0, 1, '爱生活Life', 'life', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 2, NULL, 0),
(15, 0, 0, 1, '奖品发放说明', 'notice', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(16, 1, 0, 2, '闪购公益', 'fund', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:22:"article_list.list.html";s:13:"template_show";s:22:"article_show.help.html";}', 1, NULL, 0),
(17, 5, 0, 1, 'iPhone', 'shouji', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(18, 5, 0, 1, '小米', 'XiaoMi', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(19, 5, 0, 1, '华为', 'HUAWEI', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(20, 13, 0, 1, 'MacBook', 'diannao', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(21, 13, 0, 1, '路由器', 'waishechanpin', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(22, 13, 0, 1, '存储设备', 'USB', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(23, 6, 0, 1, '腾讯专区', 'QQ', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(24, 6, 0, 1, '话费充值', 'cz', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(25, 12, 0, 1, '牛奶', 'milk', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(26, 12, 0, 1, '凉茶', 'tea', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(27, 12, 0, 1, '曲奇饼干', 'cookie', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(28, 14, 0, 1, 'swatch', 'watch', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(29, 14, 0, 1, '小玩意', 'good', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(30, 15, 0, 1, '请联系客服QQ278869155', 'qq', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";s:0:"";s:13:"template_show";s:0:"";}', 1, NULL, 0),
(31, 6, 0, 1, '红包', 'mon', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";N;s:13:"template_show";N;}', 1, NULL, 0),
(32, 5, 0, 1, '三星', 'Samsung', '', 'a:9:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:13:"template_list";N;s:13:"template_show";N;}', 1, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `go_config`
--

CREATE TABLE IF NOT EXISTS `go_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `value` mediumtext,
  `zhushi` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `go_config`
--

INSERT INTO `go_config` (`id`, `name`, `value`, `zhushi`) VALUES
(1, 'web_name', '一元云购 — 惊喜无线', '网站名'),
(2, 'web_key', '是一个云购系统', '网站关键字'),
(3, 'web_des', '是一个云购系统', '网站介绍'),
(4, 'web_path', '', '网站地址'),
(5, 'templates_edit', '1', '是否允许在线编辑模板'),
(6, 'templates_name', 'quyu-1yygkuan', '当前模板方案'),
(7, 'charset', 'utf-8', '网站字符集'),
(8, 'timezone', 'Asia/Shanghai', '网站时区'),
(9, 'error', '1', '1、保存错误日志到 cache/error_log.php | 0、在页面直接显示'),
(10, 'gzip', '0', '是否Gzip压缩后输出,服务器没有gzip请不要启用'),
(11, 'lang', 'zh-cn', '网站语言包'),
(12, 'cache', '3600', '默认缓存时间'),
(13, 'web_off', '1', '网站是否开启'),
(14, 'web_off_text', '网站关闭。升级中....', '关闭原因'),
(15, 'tablepre', 'QCNf', NULL),
(16, 'index_name', '?', '隐藏首页文件名'),
(17, 'expstr', '/', 'url分隔符号'),
(18, 'admindir', 'admin', '后台管理文件夹'),
(19, 'qq', '33634420', 'qq'),
(20, 'cell', '13275045727', '联系电话'),
(21, 'web_logo', 'banner/logo-2014.png', 'logo'),
(22, 'web_copyright', 'Copyright © 2011 - 2015, 版权所有 dede168.com', '版权'),
(23, 'web_name_two', '一元云购', '短网站名'),
(24, 'qq_qun', '8248130', 'QQ群'),
(25, 'goods_end_time', '180', '开奖动画秒数(单位秒)');

-- --------------------------------------------------------

--
-- 表的结构 `go_czk`
--

CREATE TABLE IF NOT EXISTS `go_czk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `czknum` varchar(12) NOT NULL COMMENT '充值卡号码',
  `password` varchar(12) NOT NULL COMMENT '充值卡密码',
  `mianzhi` int(11) NOT NULL COMMENT '面值',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '使用状态',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '充值类型 1一次性 2永久',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_egglotter_award`
--

CREATE TABLE IF NOT EXISTS `go_egglotter_award` (
  `award_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `user_name` varchar(11) DEFAULT NULL COMMENT '用户名字',
  `rule_id` int(11) DEFAULT NULL COMMENT '活动ID',
  `subtime` int(11) DEFAULT NULL COMMENT '中奖时间',
  `spoil_id` int(11) DEFAULT NULL COMMENT '奖品等级',
  PRIMARY KEY (`award_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_egglotter_rule`
--

CREATE TABLE IF NOT EXISTS `go_egglotter_rule` (
  `rule_id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_name` varchar(200) DEFAULT NULL,
  `starttime` int(11) DEFAULT NULL COMMENT '活动开始时间',
  `endtime` int(11) DEFAULT NULL COMMENT '活动结束时间',
  `subtime` int(11) DEFAULT NULL COMMENT '活动编辑时间',
  `lotterytype` int(11) DEFAULT NULL COMMENT '抽奖按币分类',
  `lotterjb` int(11) DEFAULT NULL COMMENT '每一次抽奖使用的金币',
  `ruledesc` text COMMENT '规则介绍',
  `startusing` tinyint(4) DEFAULT NULL COMMENT '启用',
  PRIMARY KEY (`rule_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_egglotter_spoil`
--

CREATE TABLE IF NOT EXISTS `go_egglotter_spoil` (
  `spoil_id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) DEFAULT NULL,
  `spoil_name` text COMMENT '名称',
  `spoil_jl` int(11) DEFAULT NULL COMMENT '机率',
  `spoil_dj` int(11) DEFAULT NULL,
  `urlimg` varchar(200) DEFAULT NULL,
  `subtime` int(11) DEFAULT NULL COMMENT '提交时间',
  PRIMARY KEY (`spoil_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_fund`
--

CREATE TABLE IF NOT EXISTS `go_fund` (
  `id` int(10) unsigned NOT NULL,
  `fund_off` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `fund_money` decimal(10,2) unsigned NOT NULL,
  `fund_count_money` decimal(12,2) DEFAULT NULL COMMENT '云购基金',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `go_fund`
--

INSERT INTO `go_fund` (`id`, `fund_off`, `fund_money`, `fund_count_money`) VALUES
(1, 0, '0.01', '0.13');

-- --------------------------------------------------------

--
-- 表的结构 `go_link`
--

CREATE TABLE IF NOT EXISTS `go_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '友情链接ID',
  `type` tinyint(1) unsigned NOT NULL COMMENT '链接类型',
  `name` char(20) NOT NULL COMMENT '名称',
  `logo` varchar(250) NOT NULL COMMENT '图片',
  `url` varchar(50) NOT NULL COMMENT '地址',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_member`
--

CREATE TABLE IF NOT EXISTS `go_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL COMMENT '用户名',
  `email` varchar(50) DEFAULT NULL COMMENT '用户邮箱',
  `mobile` char(11) DEFAULT NULL COMMENT '用户手机',
  `password` char(32) DEFAULT NULL COMMENT '密码',
  `user_ip` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL COMMENT '用户头像',
  `qianming` varchar(255) DEFAULT NULL COMMENT '用户签名',
  `groupid` tinyint(4) unsigned DEFAULT '0' COMMENT '用户权限组',
  `addgroup` varchar(255) DEFAULT NULL COMMENT '用户加入的圈子组1|2|3',
  `money` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '账户金额',
  `emailcode` char(21) DEFAULT '-1' COMMENT '邮箱认证码',
  `mobilecode` char(21) DEFAULT '-1' COMMENT '手机认证码',
  `passcode` char(21) DEFAULT '-1' COMMENT '找会密码认证码-1,1,码',
  `reg_key` varchar(100) DEFAULT NULL COMMENT '注册参数',
  `score` int(10) unsigned NOT NULL DEFAULT '0',
  `jingyan` int(10) unsigned DEFAULT '0',
  `yaoqing` int(10) unsigned DEFAULT NULL,
  `band` varchar(255) DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  `login_time` int(10) unsigned DEFAULT '0',
  `sign_in_time` mediumint(8) NOT NULL DEFAULT '0' COMMENT '连续签到天数',
  `sign_in_date` char(10) NOT NULL DEFAULT '' COMMENT '上次签到日期',
  `sign_in_time_all` mediumint(8) NOT NULL DEFAULT '0' COMMENT '总签到次数',
  `auto_user` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员表' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `go_member`
--

INSERT INTO `go_member` (`uid`, `username`, `email`, `mobile`, `password`, `user_ip`, `img`, `qianming`, `groupid`, `addgroup`, `money`, `emailcode`, `mobilecode`, `passcode`, `reg_key`, `score`, `jingyan`, `yaoqing`, `band`, `time`, `login_time`, `sign_in_time`, `sign_in_date`, `sign_in_time_all`, `auto_user`) VALUES
(12, 'admin', '', '18672393060', '343b1c4a3ea721b2d640fc8700db0f36', '福建省厦门市,211.97.129.199', 'photo/member.jpg', '', 1, NULL, '9988.00', '1', '1', '-1', NULL, 1300, 20, NULL, NULL, 1434702649, 1437577292, 1, '2015-06-19', 1, 0),
(15, '', '', '13827777608', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'photo/member.jpg', '', 1, NULL, '0.00', '-1', '1', '-1', NULL, 0, 0, 0, NULL, 1437530485, 0, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `go_member_account`
--

CREATE TABLE IF NOT EXISTS `go_member_account` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(1) DEFAULT NULL COMMENT '充值1/消费-1',
  `pay` char(20) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL COMMENT '详情',
  `money` mediumint(8) NOT NULL DEFAULT '0' COMMENT '金额',
  `time` char(20) NOT NULL,
  KEY `uid` (`uid`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员账户明细';

--
-- 转存表中的数据 `go_member_account`
--

INSERT INTO `go_member_account` (`uid`, `type`, `pay`, `content`, `money`, `time`) VALUES
(1, -1, '账户', '购买了商品', 1, '1427209158'),
(1, 1, '福分', '购买了1人次商品', 20, '1427209158'),
(1, -1, '账户', '购买了商品', 1, '1427210971'),
(1, 1, '福分', '购买了1人次商品', 20, '1427210971'),
(1, -1, '账户', '管理员修改金额', 11109, '1427259968'),
(2, -1, '账户', '购买了商品', 1, '1427268501'),
(2, 1, '福分', '购买了1人次商品', 20, '1427268501'),
(2, -1, '账户', '购买了商品', 1, '1427268514'),
(2, 1, '福分', '购买了1人次商品', 20, '1427268514'),
(2, -1, '账户', '购买了商品', 1, '1427268531'),
(2, 1, '福分', '购买了1人次商品', 20, '1427268531'),
(2, -1, '账户', '管理员修改金额', 97, '1427268548'),
(1, 1, '福分', '每日签到', 100, '1427272128'),
(1, 1, '福分', '每日签到', 100, '1427381972'),
(1, 1, '账户', '充值卡', 100, '1427434558'),
(1, -1, '账户', '管理员修改金额', 100, '1428563209'),
(9, 1, '福分', '每日签到', 100, '1428574915'),
(9, -1, '账户', '购买了商品', 1, '1428575356'),
(9, 1, '福分', '购买了1人次商品', 20, '1428575356'),
(9, -1, '账户', '购买了商品', 1, '1428575367'),
(9, 1, '福分', '购买了1人次商品', 20, '1428575367'),
(9, -1, '账户', '购买了商品', 1, '1428575382'),
(9, 1, '福分', '购买了1人次商品', 20, '1428575382'),
(9, -1, '账户', '购买了商品', 1, '1428578398'),
(9, 1, '福分', '购买了1人次商品', 20, '1428578398'),
(1, 1, '账户', '充值', 1, '1428735650'),
(1, 1, '账户', '充值', 1, '1428736156'),
(10, 1, '账户', '充值', 10, '1431586565'),
(10, 1, '账户', '充值', 10, '1431586640'),
(1, 1, '账户', '充值', 1, '1431586986'),
(1, -1, '账户', '购买了商品', 1, '1431587043'),
(1, 1, '福分', '购买了1人次商品', 20, '1431587043'),
(1, -1, '账户', '购买了商品', 1, '1431587059'),
(1, 1, '福分', '购买了1人次商品', 20, '1431587059'),
(1, -1, '账户', '购买了商品', 1, '1431587090'),
(1, 1, '福分', '购买了1人次商品', 20, '1431587090'),
(1, 1, '账户', '充值', 1, '1431587136'),
(1, -1, '账户', '购买了商品', 1, '1431587136'),
(1, 1, '福分', '购买了1人次商品', 20, '1431587136'),
(12, 1, '福分', '每日签到', 100, '1434708630'),
(12, -1, '账户', '购买了商品', 12, '1434712742'),
(12, 1, '福分', '购买了12人次商品', 1200, '1434712742');

-- --------------------------------------------------------

--
-- 表的结构 `go_member_addmoney_record`
--

CREATE TABLE IF NOT EXISTS `go_member_addmoney_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `code` char(20) NOT NULL,
  `money` decimal(10,2) unsigned NOT NULL,
  `pay_type` char(10) NOT NULL,
  `status` char(20) NOT NULL,
  `time` int(10) NOT NULL,
  `score` int(10) unsigned DEFAULT NULL,
  `scookies` text COMMENT '购物车cookie',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- 转存表中的数据 `go_member_addmoney_record`
--

INSERT INTO `go_member_addmoney_record` (`id`, `uid`, `code`, `money`, `pay_type`, `status`, `time`, `score`, `scookies`) VALUES
(1, 13560, 'C14053686015468758', '10.00', '', '未付款', 1405368601, 0, '0'),
(2, 13564, 'C14054303345308861', '10.00', '', '未付款', 1405430334, 0, '0'),
(3, 13564, 'C14054303552350702', '10.00', '易宝支付', '未付款', 1405430355, 0, '0'),
(4, 1, 'C14272601348281357', '10.00', '支付宝', '未付款', 1427260134, 0, '0'),
(5, 2, 'C14272687021161801', '1.00', '支付宝', '未付款', 1427268702, 0, 'a:2:{s:10:"MoenyCount";i:1;i:1;a:3:{s:6:"shenyu";i:6;s:3:"num";i:1;s:5:"money";i:1;}}'),
(6, 1, 'C14272721095815149', '10.00', '支付宝', '未付款', 1427272109, 0, '0'),
(7, 1, 'C14272721568314843', '1.00', '支付宝', '未付款', 1427272156, 0, 'a:2:{s:10:"MoenyCount";i:1;i:1;a:3:{s:6:"shenyu";i:6;s:3:"num";i:1;s:5:"money";i:1;}}'),
(8, 1, 'C14272751563538795', '1.00', '支付宝', '未付款', 1427275156, 0, 'a:2:{s:10:"MoenyCount";i:1;i:1;a:3:{s:6:"shenyu";i:6;s:3:"num";i:1;s:5:"money";i:1;}}'),
(9, 1, 'C14285577489778619', '10.00', '支付宝', '未付款', 1428557748, 0, '0'),
(10, 1, 'C14285579418098644', '10.00', '支付宝', '未付款', 1428557941, 0, '0'),
(11, 1, 'C14285579534915375', '10.00', '支付宝', '未付款', 1428557953, 0, '0'),
(12, 1, 'C14285584013812779', '10.00', '支付宝', '未付款', 1428558401, 0, '0'),
(13, 1, 'C14285584422922929', '10.00', '支付宝', '未付款', 1428558442, 0, '0'),
(14, 1, 'C14285587683654591', '10.00', '支付宝', '未付款', 1428558768, 0, '0'),
(15, 1, 'C14285589067974866', '1.00', '支付宝', '未付款', 1428558906, 0, '0'),
(16, 1, 'C14285590198512068', '10.00', '支付宝', '未付款', 1428559019, 0, '0'),
(17, 1, 'C14285592651428218', '10.00', '支付宝', '未付款', 1428559265, 0, '0'),
(18, 1, 'C14285593969570221', '10.00', '支付宝', '未付款', 1428559396, 0, '0'),
(19, 1, 'C14285595248487956', '10.00', '支付宝', '未付款', 1428559524, 0, '0'),
(20, 1, 'C14285597705848259', '10.00', '支付宝', '未付款', 1428559770, 0, '0'),
(21, 1, 'C14285600025881300', '10.00', '支付宝', '未付款', 1428560002, 0, '0'),
(22, 1, 'C14285602697813828', '10.00', '支付宝', '未付款', 1428560269, 0, '0'),
(23, 1, 'C14285631107911183', '10.00', '支付宝', '未付款', 1428563110, 0, '0'),
(24, 1, 'C14285631195888353', '50.00', '支付宝', '未付款', 1428563119, 0, '0'),
(25, 1, 'C14285632134415826', '1.00', '支付宝', '未付款', 1428563213, 0, 'a:2:{s:10:"MoenyCount";i:1;i:1;a:3:{s:6:"shenyu";i:6;s:3:"num";i:1;s:5:"money";i:1;}}'),
(26, 1, 'C14285724672523533', '10.00', '支付宝', '未付款', 1428572467, 0, '0'),
(27, 1, 'C14285724882268412', '10.00', '支付宝', '未付款', 1428572488, 0, '0'),
(28, 1, 'C14285725547910513', '10.00', '支付宝', '未付款', 1428572554, 0, '0'),
(29, 1, 'C14285725644683635', '10.00', '支付宝', '未付款', 1428572564, 0, '0'),
(30, 1, 'C14285727485811079', '10.00', '支付宝', '未付款', 1428572748, 0, '0'),
(31, 1, 'C14285732935933917', '10.00', '支付宝', '未付款', 1428573293, 0, '0'),
(32, 1, 'C14285733067456783', '10.00', '支付宝', '未付款', 1428573306, 0, '0'),
(33, 1, 'C14285733456921225', '10.00', '支付宝', '未付款', 1428573345, 0, '0'),
(34, 1, 'C14285736218916490', '10.00', '支付宝', '未付款', 1428573621, 0, '0'),
(35, 1, 'C14285738036807386', '10.00', '支付宝', '未付款', 1428573803, 0, '0'),
(36, 1, 'C14285738112806623', '10.00', '支付宝', '未付款', 1428573811, 0, '0'),
(37, 9, 'C14285749320460237', '200.00', '支付宝', '未付款', 1428574932, 0, '0'),
(38, 1, 'C14285766722742548', '10.00', '支付宝', '未付款', 1428576672, 0, '0'),
(39, 1, 'C14285773240277410', '10.00', '支付宝', '未付款', 1428577324, 0, '0'),
(40, 1, 'C14287339677451479', '0.00', '支付宝', '未付款', 1428733967, 0, '0'),
(41, 1, 'C14287339761631843', '1.00', '支付宝', '未付款', 1428733976, 0, '0'),
(42, 1, 'C14287348010207947', '1.00', '支付宝', '未付款', 1428734801, 0, '0'),
(43, 1, 'C14287348838744498', '1.00', '支付宝', '未付款', 1428734883, 0, '0'),
(44, 1, 'C14287349547719097', '0.00', '支付宝', '未付款', 1428734954, 0, '0'),
(45, 1, 'C14287349643922507', '1.00', '支付宝', '未付款', 1428734964, 0, '0'),
(46, 1, 'C14287355154852427', '1.00', '支付宝', '未付款', 1428735515, 0, '0'),
(47, 1, 'C14287356153474436', '1.00', '支付宝', '已付款', 1428735615, 0, '0'),
(48, 1, 'C14287360895921616', '1.00', '支付宝', '未付款', 1428736089, 0, '0'),
(49, 1, 'C14287361216729575', '1.00', '支付宝', '已付款', 1428736121, 0, '0'),
(50, 1, 'C14299810018065442', '10.00', '支付宝', '未付款', 1429981001, 0, '0'),
(51, 1, 'C14315737713074345', '10.00', '支付宝', '未付款', 1431573771, 0, '0'),
(52, 10, 'C14315849028013743', '10.00', '支付宝', '未付款', 1431584902, 0, '0'),
(53, 10, 'C14315849612313455', '10.00', '支付宝', '未付款', 1431584961, 0, '0'),
(54, 10, 'C14315850253063708', '10.00', '支付宝', '未付款', 1431585025, 0, '0'),
(55, 1, 'C14315850369117191', '10.00', '支付宝', '未付款', 1431585036, 0, '0'),
(56, 1, 'C14315850551214508', '10.00', '支付宝', '未付款', 1431585055, 0, '0'),
(57, 1, 'C14315852461718966', '10.00', '支付宝', '未付款', 1431585246, 0, '0'),
(58, 10, 'C14315854007484059', '10.00', '支付宝', '未付款', 1431585400, 0, '0'),
(59, 10, 'C14315855044524518', '10.00', '支付宝', '未付款', 1431585504, 0, '0'),
(60, 10, 'C14315855758551478', '10.00', '支付宝', '未付款', 1431585575, 0, '0'),
(61, 10, 'C14315858285828666', '10.00', '支付宝', '未付款', 1431585828, 0, '0'),
(62, 10, 'C14315858658818551', '10.00', '支付宝', '已付款', 1431585865, 0, '0'),
(63, 1, 'C14315859062656620', '10.00', '支付宝', '未付款', 1431585906, 0, '0'),
(64, 1, 'C14315859478058602', '10.00', '支付宝', '未付款', 1431585947, 0, '0'),
(65, 1, 'C14315860045143169', '10.00', '支付宝', '未付款', 1431586004, 0, '0'),
(66, 1, 'C14315862076905518', '10.00', '支付宝', '未付款', 1431586207, 0, '0'),
(67, 1, 'C14315862683515902', '10.00', '支付宝', '未付款', 1431586268, 0, '0'),
(68, 1, 'C14315863306162440', '10.00', '支付宝', '未付款', 1431586330, 0, '0'),
(69, 1, 'C14315863732306879', '10.00', '支付宝', '未付款', 1431586373, 0, '0'),
(70, 1, 'C14315864227314794', '10.00', '支付宝', '未付款', 1431586422, 0, '0'),
(71, 10, 'C14315865879156971', '10.00', '支付宝', '未付款', 1431586587, 0, '0'),
(72, 10, 'C14315866113533447', '10.00', '支付宝', '已付款', 1431586611, 0, '0'),
(73, 10, 'C14315867147601207', '10.00', '支付宝', '未付款', 1431586714, 0, '0'),
(74, 1, 'C14315867151522409', '10.00', '支付宝', '未付款', 1431586715, 0, '0'),
(75, 1, 'C14315867339344055', '10.00', '支付宝', '未付款', 1431586733, 0, '0'),
(76, 1, 'C14315867510088651', '10.00', '支付宝', '未付款', 1431586751, 0, '0'),
(77, 1, 'C14315868108910445', '10.00', '支付宝', '未付款', 1431586810, 0, '0'),
(78, 10, 'C14315868842843802', '10.00', '支付宝', '未付款', 1431586884, 0, '0'),
(79, 1, 'C14315869244631580', '1.00', '支付宝', '已付款', 1431586924, 0, '0'),
(80, 1, 'C14315870999088067', '1.00', '支付宝', '已付款', 1431587099, 0, '1'),
(81, 12, 'C14347027270734253', '10.00', '支付宝', '未付款', 1434702727, 0, '0'),
(82, 15, 'C14375479183986824', '10.00', '支付宝', '未付款', 1437547918, 0, '0'),
(83, 12, 'C14375773169491054', '10.00', '微信扫码支付', '未付款', 1437577316, 0, '0'),
(84, 12, 'C14375773304910780', '10.00', '微信支付微信端', '未付款', 1437577330, 0, '0'),
(85, 12, 'C14375776386824200', '10.00', '微信扫码支付', '未付款', 1437577638, 0, '0');

-- --------------------------------------------------------

--
-- 表的结构 `go_member_band`
--

CREATE TABLE IF NOT EXISTS `go_member_band` (
  `b_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `b_uid` int(10) DEFAULT NULL COMMENT '用户ID',
  `b_type` char(10) DEFAULT NULL COMMENT '绑定登陆类型',
  `b_code` varchar(100) DEFAULT NULL COMMENT '返回数据1',
  `b_data` varchar(100) DEFAULT NULL COMMENT '返回数据2',
  `b_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`b_id`),
  KEY `b_uid` (`b_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_member_cashout`
--

CREATE TABLE IF NOT EXISTS `go_member_cashout` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `username` varchar(20) NOT NULL COMMENT '开户人',
  `bankname` varchar(255) NOT NULL COMMENT '银行名称',
  `branch` varchar(255) NOT NULL COMMENT '支行',
  `money` decimal(8,0) NOT NULL DEFAULT '0' COMMENT '申请提现金额',
  `time` char(20) NOT NULL COMMENT '申请时间',
  `banknumber` varchar(50) NOT NULL COMMENT '银行帐号',
  `linkphone` varchar(100) NOT NULL COMMENT '联系电话',
  `auditstatus` tinyint(4) NOT NULL COMMENT '1审核通过',
  `procefees` decimal(8,2) NOT NULL COMMENT '手续费',
  `reviewtime` char(20) NOT NULL COMMENT '审核通过时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `type` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员账户明细' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_member_del`
--

CREATE TABLE IF NOT EXISTS `go_member_del` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL COMMENT '用户名',
  `email` varchar(50) DEFAULT NULL COMMENT '用户邮箱',
  `mobile` char(11) DEFAULT NULL COMMENT '用户手机',
  `password` char(32) DEFAULT NULL COMMENT '密码',
  `user_ip` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL COMMENT '用户头像',
  `qianming` varchar(255) DEFAULT NULL COMMENT '用户签名',
  `groupid` tinyint(4) unsigned DEFAULT '0' COMMENT '用户权限组',
  `addgroup` varchar(255) DEFAULT NULL COMMENT '用户加入的圈子组1|2|3',
  `money` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '账户金额',
  `emailcode` char(21) DEFAULT '-1' COMMENT '邮箱认证码',
  `mobilecode` char(21) DEFAULT '-1' COMMENT '手机认证码',
  `passcode` char(21) DEFAULT '-1' COMMENT '找会密码认证码-1,1,码',
  `reg_key` varchar(100) DEFAULT NULL COMMENT '注册参数',
  `score` int(10) unsigned NOT NULL DEFAULT '0',
  `jingyan` int(10) unsigned DEFAULT '0',
  `yaoqing` int(10) unsigned DEFAULT NULL,
  `band` varchar(255) DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  `login_time` int(10) unsigned DEFAULT '0',
  `sign_in_time` mediumint(8) NOT NULL DEFAULT '0' COMMENT '连续签到天数',
  `sign_in_date` char(10) NOT NULL DEFAULT '' COMMENT '上次签到日期',
  `sign_in_time_all` mediumint(8) NOT NULL DEFAULT '0' COMMENT '总签到次数',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员表' AUTO_INCREMENT=13565 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_member_dizhi`
--

CREATE TABLE IF NOT EXISTS `go_member_dizhi` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(10) NOT NULL COMMENT '用户id',
  `sheng` varchar(15) DEFAULT NULL COMMENT '省',
  `shi` varchar(15) DEFAULT NULL COMMENT '市',
  `xian` varchar(15) DEFAULT NULL COMMENT '县',
  `jiedao` varchar(255) DEFAULT NULL COMMENT '街道地址',
  `youbian` mediumint(8) DEFAULT NULL COMMENT '邮编',
  `shouhuoren` varchar(15) DEFAULT NULL COMMENT '收货人',
  `mobile` char(11) DEFAULT NULL COMMENT '手机',
  `qq` char(11) DEFAULT NULL COMMENT 'QQ',
  `tell` varchar(15) DEFAULT NULL COMMENT '座机号',
  `default` char(1) DEFAULT 'N' COMMENT '是否默认',
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员地址表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_member_go_record`
--

CREATE TABLE IF NOT EXISTS `go_member_go_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(20) DEFAULT NULL COMMENT '订单号',
  `code_tmp` tinyint(3) unsigned DEFAULT NULL COMMENT '相同订单',
  `username` varchar(30) NOT NULL,
  `uphoto` varchar(255) DEFAULT NULL,
  `uid` int(10) unsigned NOT NULL COMMENT '会员id',
  `shopid` int(6) unsigned NOT NULL COMMENT '商品id',
  `shopname` varchar(255) NOT NULL COMMENT '商品名',
  `shopqishu` smallint(6) NOT NULL DEFAULT '0' COMMENT '期数',
  `gonumber` smallint(5) unsigned DEFAULT NULL COMMENT '购买次数',
  `goucode` longtext NOT NULL COMMENT '云购码',
  `moneycount` decimal(10,2) NOT NULL,
  `huode` char(50) NOT NULL DEFAULT '0' COMMENT '中奖码',
  `pay_type` char(10) DEFAULT NULL COMMENT '付款方式',
  `ip` varchar(255) DEFAULT NULL,
  `status` char(30) DEFAULT NULL COMMENT '订单状态',
  `company_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `company_code` char(20) DEFAULT NULL,
  `company` char(10) DEFAULT NULL,
  `time` char(21) NOT NULL COMMENT '购买时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `shopid` (`shopid`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='云购记录表' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `go_member_go_record`
--

INSERT INTO `go_member_go_record` (`id`, `code`, `code_tmp`, `username`, `uphoto`, `uid`, `shopid`, `shopname`, `shopqishu`, `gonumber`, `goucode`, `moneycount`, `huode`, `pay_type`, `ip`, `status`, `company_money`, `company_code`, `company`, `time`) VALUES
(14, 'A14347127424186487', 0, 'admin', 'photo/member.jpg', 12, 5, 'Q币充值-10', 1, 12, '10000002,10000004,10000012,10000011,10000005,10000007,10000006,10000009,10000010,10000008,10000003,10000001', '12.00', '10000005', '账户', '湖北省武汉市,59.175.38.162', '已付款,未发货,未完成', '0.00', NULL, NULL, '1434712742.593');

-- --------------------------------------------------------

--
-- 表的结构 `go_member_group`
--

CREATE TABLE IF NOT EXISTS `go_member_group` (
  `groupid` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(15) NOT NULL COMMENT '会员组名',
  `jingyan_start` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '需要的经验值',
  `jingyan_end` int(10) NOT NULL,
  `icon` varchar(255) DEFAULT NULL COMMENT '图标',
  `type` char(1) NOT NULL DEFAULT 'N' COMMENT '是否是系统组',
  PRIMARY KEY (`groupid`),
  KEY `jingyan` (`jingyan_start`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员权限组' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `go_member_group`
--

INSERT INTO `go_member_group` (`groupid`, `name`, `jingyan_start`, `jingyan_end`, `icon`, `type`) VALUES
(1, '闪购新手', 1, 500, NULL, 'N'),
(2, '闪购小将', 501, 1000, NULL, 'N'),
(3, '闪购中将', 1001, 3000, NULL, 'N'),
(4, '闪购上将', 3001, 6000, NULL, 'N'),
(5, '闪购大将', 6001, 20000, NULL, 'N'),
(6, '闪购将军', 20001, 40000, NULL, 'N');

-- --------------------------------------------------------

--
-- 表的结构 `go_member_message`
--

CREATE TABLE IF NOT EXISTS `go_member_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(1) DEFAULT '0' COMMENT '消息来源,0系统,1私信',
  `sendid` int(10) unsigned DEFAULT '0' COMMENT '发送人ID',
  `sendname` char(20) DEFAULT NULL COMMENT '发送人名',
  `content` varchar(255) DEFAULT NULL COMMENT '发送内容',
  `time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员消息表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_member_recodes`
--

CREATE TABLE IF NOT EXISTS `go_member_recodes` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(1) NOT NULL COMMENT '收取1//充值-2/提现-3',
  `content` varchar(255) NOT NULL COMMENT '详情',
  `shopid` int(11) DEFAULT NULL COMMENT '商品id',
  `money` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '佣金',
  `time` char(20) NOT NULL,
  `ygmoney` decimal(8,2) NOT NULL COMMENT '云购金额',
  `cashoutid` int(11) DEFAULT NULL COMMENT '申请提现记录表id',
  KEY `uid` (`uid`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员账户明细';

-- --------------------------------------------------------

--
-- 表的结构 `go_model`
--

CREATE TABLE IF NOT EXISTS `go_model` (
  `modelid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL,
  `table` char(20) NOT NULL,
  PRIMARY KEY (`modelid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='模型表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `go_model`
--

INSERT INTO `go_model` (`modelid`, `name`, `table`) VALUES
(1, '云购模型', 'shoplist'),
(2, '文章模型', 'article');

-- --------------------------------------------------------

--
-- 表的结构 `go_navigation`
--

CREATE TABLE IF NOT EXISTS `go_navigation` (
  `cid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(6) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` char(10) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` char(1) DEFAULT 'Y' COMMENT '显示/隐藏',
  `order` smallint(6) unsigned DEFAULT '1',
  PRIMARY KEY (`cid`),
  KEY `status` (`status`),
  KEY `order` (`order`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `go_navigation`
--

INSERT INTO `go_navigation` (`cid`, `parentid`, `name`, `type`, `url`, `status`, `order`) VALUES
(1, 0, '所有商品', 'index', '/goods_list', 'N', 2),
(2, 0, '新手指南', 'index', '/single/newbie', 'N', 2),
(3, 0, '圈子社区', 'index', '/group', 'Y', 2),
(4, 0, '关于我们', 'foot', '/help/1', 'Y', 1),
(5, 0, '隐私声明', 'foot', '/help/12', 'Y', 1),
(6, 0, '合作专区', 'foot', '/single/business', 'Y', 1),
(7, 0, '友情链接', 'foot', '/link', 'Y', 1),
(8, 0, '联系我们', 'foot', '/help/13', 'Y', 1),
(10, 0, '晒单分享', 'index', '/go/shaidan/', 'Y', 1),
(13, 0, '邀请有奖', 'index', '/single/pleasereg', 'Y', 1),
(14, 0, '限时揭晓', 'index', '/go/autolottery', 'Y', 1),
(16, 0, '最新揭晓', 'index', '/goods_lottery', 'Y', 1);

-- --------------------------------------------------------

--
-- 表的结构 `go_pay`
--

CREATE TABLE IF NOT EXISTS `go_pay` (
  `pay_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pay_name` char(20) NOT NULL,
  `pay_class` char(20) NOT NULL,
  `pay_type` tinyint(3) NOT NULL,
  `pay_thumb` varchar(255) DEFAULT NULL,
  `pay_des` text,
  `pay_start` tinyint(4) NOT NULL,
  `pay_key` text,
  `pay_mobile` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `go_pay`
--

INSERT INTO `go_pay` (`pay_id`, `pay_name`, `pay_class`, `pay_type`, `pay_thumb`, `pay_des`, `pay_start`, `pay_key`, `pay_mobile`) VALUES
(1, '财付通', 'tenpay', 1, 'photo/cft.gif', '腾讯财付通	', 1, 'a:2:{s:2:"id";a:2:{s:4:"name";s:19:"财付通商户号:";s:3:"val";s:0:"";}s:3:"key";a:2:{s:4:"name";s:16:"财付通密钥:";s:3:"val";s:0:"";}}', 0),
(2, '易宝支付', 'yeepay', 1, 'photo/20130929/93656812450898.jpg', '易宝支付', 1, 'a:2:{s:2:"id";a:2:{s:4:"name";s:16:"易宝商户号:";s:3:"val";s:0:"";}s:3:"key";a:2:{s:4:"name";s:13:"易宝密钥:";s:3:"val";s:0:"";}}', 0),
(3, '汇潮支付', 'ecpss', 1, 'photo/20130929/ecpss.jpg', '汇潮支付', 0, 'a:2:{s:2:"id";a:2:{s:4:"name";s:16:"汇潮商户号:";s:3:"val";s:0:"";}s:3:"key";a:2:{s:4:"name";s:13:"汇潮密钥:";s:3:"val";s:0:"";}}', 0),
(4, '支付宝', 'alipay', 1, 'photo/20130929/82028078450752.jpg', '支付宝支付', 1, 'a:3:{s:2:"id";a:2:{s:4:"name";s:19:"支付宝商户号:";s:3:"val";s:0:"";}s:3:"key";a:2:{s:4:"name";s:16:"支付宝密钥:";s:3:"val";s:0:"";}s:4:"user";a:2:{s:4:"name";s:16:"支付宝账号:";s:3:"val";s:0:"";}}', 0),
(5, '手机支付宝', 'wapalipay', 1, 'photo/20130929/82028078450752.jpg', '手机支付宝支付\n', 0, 'a:3:{s:2:"id";a:2:{s:4:"name";s:19:"支付宝商户号:";s:3:"val";s:0:"";}s:3:"key";a:2:{s:4:"name";s:16:"支付宝密钥:";s:3:"val";s:0:"";}s:4:"user";a:2:{s:4:"name";s:16:"支付宝账号:";s:3:"val";s:0:"";}}', 1),
(8, '微信扫码支付', 'weixin', 0, 'photo/weixin.gif', '微信扫码支付', 1, 'a:2:{s:2:"id";a:2:{s:4:"name";s:9:"商户号";s:3:"val";s:10:"1232295302";}s:3:"key";a:2:{s:4:"name";s:6:"密匙";s:3:"val";s:32:"wx764ef3cwx764ef3cwx764ef3cwx764";}}', 0),
(9, '微信支付微信端', 'wxpay_web', 0, 'photo/weixin.gif', '微信支付微信端', 0, 'a:4:{s:5:"APPID";a:2:{s:4:"name";s:5:"APPID";s:3:"val";s:18:"wx24aaa3a3ab1d4ba0";}s:5:"MCHID";a:2:{s:4:"name";s:11:"受理商ID";s:3:"val";s:10:"1224689602";}s:3:"KEY";a:2:{s:4:"name";s:9:"密钥Key";s:3:"val";s:32:"CNT20150518cainiaotuan8888911119";}s:9:"APPSECRET";a:2:{s:4:"name";s:9:"APPSECRET";s:3:"val";s:32:"39ffb3a9b2e349c0790c68ece0a25e28";}}', 1);

-- --------------------------------------------------------

--
-- 表的结构 `go_position`
--

CREATE TABLE IF NOT EXISTS `go_position` (
  `pos_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pos_model` tinyint(3) unsigned NOT NULL,
  `pos_name` varchar(30) NOT NULL,
  `pos_num` tinyint(3) unsigned NOT NULL,
  `pos_maxnum` tinyint(3) unsigned NOT NULL,
  `pos_this_num` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `pos_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pos_id`),
  KEY `pos_id` (`pos_id`),
  KEY `pos_model` (`pos_model`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_position_data`
--

CREATE TABLE IF NOT EXISTS `go_position_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `con_id` int(10) unsigned NOT NULL,
  `mod_id` tinyint(3) unsigned NOT NULL,
  `mod_name` char(20) NOT NULL,
  `pos_id` int(10) unsigned NOT NULL,
  `pos_data` mediumtext NOT NULL,
  `pos_order` int(10) unsigned NOT NULL DEFAULT '1',
  `pos_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_qqset`
--

CREATE TABLE IF NOT EXISTS `go_qqset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qq` varchar(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `county` varchar(50) DEFAULT NULL,
  `qqurl` varchar(250) DEFAULT NULL,
  `full` varchar(6) DEFAULT NULL COMMENT '是否已满',
  `subtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `go_qqset`
--

INSERT INTO `go_qqset` (`id`, `qq`, `name`, `type`, `province`, `city`, `county`, `qqurl`, `full`, `subtime`) VALUES
(18, '97206582', '网站源码交流群', '直属群', '省份', '地级市', '市、县级市', 'http://jq.qq.com/?_wv=1027&k=XdR3jm', '未满', 1441525391);

-- --------------------------------------------------------

--
-- 表的结构 `go_quanzi`
--

CREATE TABLE IF NOT EXISTS `go_quanzi` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` char(15) NOT NULL COMMENT '标题',
  `img` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `chengyuan` mediumint(8) unsigned DEFAULT '0' COMMENT '成员数',
  `tiezi` mediumint(8) unsigned DEFAULT '0' COMMENT '帖子数',
  `guanli` mediumint(8) unsigned NOT NULL COMMENT '管理员',
  `jinhua` smallint(5) unsigned DEFAULT NULL COMMENT '精华帖',
  `jianjie` varchar(255) DEFAULT '暂无介绍' COMMENT '简介',
  `gongao` varchar(255) DEFAULT '暂无' COMMENT '公告',
  `jiaru` char(1) DEFAULT 'Y' COMMENT '申请加入',
  `glfatie` char(1) DEFAULT 'N' COMMENT '发帖权限',
  `time` int(11) NOT NULL COMMENT '时间',
  `huifu` char(1) NOT NULL DEFAULT 'Y',
  `shenhe` char(1) DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_quanzi_hueifu`
--

CREATE TABLE IF NOT EXISTS `go_quanzi_hueifu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `tzid` int(11) DEFAULT NULL COMMENT '帖子ID匹配',
  `hueifu` text COMMENT '回复内容',
  `hueiyuan` varchar(255) DEFAULT NULL COMMENT '会员',
  `hftime` int(11) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_quanzi_tiezi`
--

CREATE TABLE IF NOT EXISTS `go_quanzi_tiezi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `qzid` int(10) unsigned DEFAULT NULL COMMENT '圈子ID匹配',
  `hueiyuan` varchar(255) DEFAULT NULL COMMENT '会员信息',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `neirong` text COMMENT '内容',
  `hueifu` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '回复',
  `dianji` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `zhiding` char(1) DEFAULT 'N' COMMENT '置顶',
  `jinghua` char(1) DEFAULT 'N' COMMENT '精华',
  `zuihou` varchar(255) DEFAULT NULL COMMENT '最后回复',
  `time` int(10) unsigned DEFAULT NULL COMMENT '时间',
  `tiezi` int(10) unsigned NOT NULL DEFAULT '0',
  `shenhe` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_recom`
--

CREATE TABLE IF NOT EXISTS `go_recom` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '推荐位id',
  `img` varchar(50) DEFAULT NULL COMMENT '推荐位图片',
  `title` varchar(30) DEFAULT NULL COMMENT '推荐位标题',
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_send`
--

CREATE TABLE IF NOT EXISTS `go_send` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `gid` int(10) unsigned NOT NULL,
  `username` varchar(30) NOT NULL,
  `shoptitle` varchar(200) NOT NULL,
  `send_type` tinyint(4) NOT NULL,
  `send_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `gid` (`gid`),
  KEY `send_type` (`send_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `go_send`
--

INSERT INTO `go_send` (`id`, `uid`, `gid`, `username`, `shoptitle`, `send_type`, `send_time`) VALUES
(1, 1, 1, 'admin', '商品测试！', -1, 1431587065),
(2, 12, 5, 'admin', 'Q币充值-10', 3, 1434712744);

-- --------------------------------------------------------

--
-- 表的结构 `go_shaidan`
--

CREATE TABLE IF NOT EXISTS `go_shaidan` (
  `sd_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '晒单id',
  `sd_userid` int(10) unsigned DEFAULT NULL COMMENT '用户ID',
  `sd_shopid` int(10) unsigned DEFAULT NULL COMMENT '商品ID',
  `sd_qishu` int(10) DEFAULT NULL COMMENT '商品期数',
  `sd_ip` varchar(255) DEFAULT NULL,
  `sd_title` varchar(255) DEFAULT NULL COMMENT '晒单标题',
  `sd_thumbs` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `sd_content` text COMMENT '晒单内容',
  `sd_photolist` text COMMENT '晒单图片',
  `sd_zhan` int(10) unsigned DEFAULT '0' COMMENT '点赞',
  `sd_ping` int(10) unsigned DEFAULT '0' COMMENT '评论',
  `sd_time` int(10) unsigned DEFAULT NULL COMMENT '晒单时间',
  `sd_shopsid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`sd_id`),
  KEY `sd_userid` (`sd_userid`),
  KEY `sd_shopid` (`sd_shopid`),
  KEY `sd_zhan` (`sd_zhan`),
  KEY `sd_ping` (`sd_ping`),
  KEY `sd_time` (`sd_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='晒单' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_shaidan_hueifu`
--

CREATE TABLE IF NOT EXISTS `go_shaidan_hueifu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sdhf_id` int(11) NOT NULL COMMENT '晒单ID',
  `sdhf_userid` int(11) DEFAULT NULL COMMENT '晒单回复会员ID',
  `sdhf_content` text COMMENT '晒单回复内容',
  `sdhf_time` int(11) DEFAULT NULL,
  `sdhf_username` char(20) DEFAULT NULL,
  `sdhf_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_shopcodes_1`
--

CREATE TABLE IF NOT EXISTS `go_shopcodes_1` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_id` int(10) unsigned NOT NULL,
  `s_cid` smallint(5) unsigned NOT NULL,
  `s_len` smallint(5) DEFAULT NULL,
  `s_codes` text,
  `s_codes_tmp` text,
  PRIMARY KEY (`id`),
  KEY `s_id` (`s_id`),
  KEY `s_cid` (`s_cid`),
  KEY `s_len` (`s_len`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `go_shopcodes_1`
--

INSERT INTO `go_shopcodes_1` (`id`, `s_id`, `s_cid`, `s_len`, `s_codes`, `s_codes_tmp`) VALUES
(8, 8, 1, 55, 'a:55:{i:0;i:10000052;i:1;i:10000033;i:2;i:10000017;i:3;i:10000003;i:4;i:10000028;i:5;i:10000011;i:6;i:10000048;i:7;i:10000045;i:8;i:10000020;i:9;i:10000012;i:10;i:10000030;i:11;i:10000037;i:12;i:10000040;i:13;i:10000043;i:14;i:10000047;i:15;i:10000041;i:16;i:10000006;i:17;i:10000044;i:18;i:10000053;i:19;i:10000018;i:20;i:10000051;i:21;i:10000022;i:22;i:10000029;i:23;i:10000005;i:24;i:10000042;i:25;i:10000025;i:26;i:10000035;i:27;i:10000019;i:28;i:10000032;i:29;i:10000007;i:30;i:10000049;i:31;i:10000054;i:32;i:10000002;i:33;i:10000004;i:34;i:10000039;i:35;i:10000027;i:36;i:10000050;i:37;i:10000008;i:38;i:10000015;i:39;i:10000001;i:40;i:10000038;i:41;i:10000046;i:42;i:10000013;i:43;i:10000023;i:44;i:10000026;i:45;i:10000031;i:46;i:10000016;i:47;i:10000021;i:48;i:10000009;i:49;i:10000010;i:50;i:10000014;i:51;i:10000024;i:52;i:10000034;i:53;i:10000055;i:54;i:10000036;}', 'a:55:{i:0;i:10000052;i:1;i:10000033;i:2;i:10000017;i:3;i:10000003;i:4;i:10000028;i:5;i:10000011;i:6;i:10000048;i:7;i:10000045;i:8;i:10000020;i:9;i:10000012;i:10;i:10000030;i:11;i:10000037;i:12;i:10000040;i:13;i:10000043;i:14;i:10000047;i:15;i:10000041;i:16;i:10000006;i:17;i:10000044;i:18;i:10000053;i:19;i:10000018;i:20;i:10000051;i:21;i:10000022;i:22;i:10000029;i:23;i:10000005;i:24;i:10000042;i:25;i:10000025;i:26;i:10000035;i:27;i:10000019;i:28;i:10000032;i:29;i:10000007;i:30;i:10000049;i:31;i:10000054;i:32;i:10000002;i:33;i:10000004;i:34;i:10000039;i:35;i:10000027;i:36;i:10000050;i:37;i:10000008;i:38;i:10000015;i:39;i:10000001;i:40;i:10000038;i:41;i:10000046;i:42;i:10000013;i:43;i:10000023;i:44;i:10000026;i:45;i:10000031;i:46;i:10000016;i:47;i:10000021;i:48;i:10000009;i:49;i:10000010;i:50;i:10000014;i:51;i:10000024;i:52;i:10000034;i:53;i:10000055;i:54;i:10000036;}'),
(3, 3, 1, 529, 'a:529:{i:0;i:10000483;i:1;i:10000072;i:2;i:10000192;i:3;i:10000120;i:4;i:10000097;i:5;i:10000064;i:6;i:10000409;i:7;i:10000358;i:8;i:10000020;i:9;i:10000096;i:10;i:10000005;i:11;i:10000467;i:12;i:10000193;i:13;i:10000218;i:14;i:10000402;i:15;i:10000245;i:16;i:10000408;i:17;i:10000126;i:18;i:10000054;i:19;i:10000377;i:20;i:10000037;i:21;i:10000065;i:22;i:10000165;i:23;i:10000271;i:24;i:10000223;i:25;i:10000472;i:26;i:10000431;i:27;i:10000089;i:28;i:10000222;i:29;i:10000232;i:30;i:10000314;i:31;i:10000379;i:32;i:10000504;i:33;i:10000307;i:34;i:10000235;i:35;i:10000348;i:36;i:10000393;i:37;i:10000175;i:38;i:10000499;i:39;i:10000501;i:40;i:10000478;i:41;i:10000321;i:42;i:10000273;i:43;i:10000248;i:44;i:10000464;i:45;i:10000059;i:46;i:10000290;i:47;i:10000026;i:48;i:10000247;i:49;i:10000142;i:50;i:10000137;i:51;i:10000226;i:52;i:10000405;i:53;i:10000229;i:54;i:10000047;i:55;i:10000468;i:56;i:10000173;i:57;i:10000182;i:58;i:10000181;i:59;i:10000507;i:60;i:10000033;i:61;i:10000076;i:62;i:10000102;i:63;i:10000345;i:64;i:10000424;i:65;i:10000418;i:66;i:10000087;i:67;i:10000012;i:68;i:10000215;i:69;i:10000281;i:70;i:10000376;i:71;i:10000058;i:72;i:10000103;i:73;i:10000427;i:74;i:10000317;i:75;i:10000002;i:76;i:10000195;i:77;i:10000163;i:78;i:10000304;i:79;i:10000415;i:80;i:10000073;i:81;i:10000497;i:82;i:10000166;i:83;i:10000274;i:84;i:10000455;i:85;i:10000346;i:86;i:10000158;i:87;i:10000475;i:88;i:10000154;i:89;i:10000439;i:90;i:10000123;i:91;i:10000093;i:92;i:10000022;i:93;i:10000144;i:94;i:10000127;i:95;i:10000241;i:96;i:10000404;i:97;i:10000009;i:98;i:10000325;i:99;i:10000001;i:100;i:10000094;i:101;i:10000060;i:102;i:10000164;i:103;i:10000374;i:104;i:10000252;i:105;i:10000367;i:106;i:10000343;i:107;i:10000383;i:108;i:10000492;i:109;i:10000008;i:110;i:10000449;i:111;i:10000136;i:112;i:10000315;i:113;i:10000119;i:114;i:10000459;i:115;i:10000320;i:116;i:10000152;i:117;i:10000015;i:118;i:10000045;i:119;i:10000462;i:120;i:10000242;i:121;i:10000506;i:122;i:10000378;i:123;i:10000316;i:124;i:10000088;i:125;i:10000454;i:126;i:10000169;i:127;i:10000330;i:128;i:10000511;i:129;i:10000266;i:130;i:10000436;i:131;i:10000239;i:132;i:10000328;i:133;i:10000441;i:134;i:10000416;i:135;i:10000391;i:136;i:10000098;i:137;i:10000299;i:138;i:10000109;i:139;i:10000237;i:140;i:10000332;i:141;i:10000083;i:142;i:10000205;i:143;i:10000267;i:144;i:10000396;i:145;i:10000489;i:146;i:10000474;i:147;i:10000227;i:148;i:10000100;i:149;i:10000291;i:150;i:10000485;i:151;i:10000131;i:152;i:10000170;i:153;i:10000207;i:154;i:10000134;i:155;i:10000155;i:156;i:10000523;i:157;i:10000071;i:158;i:10000225;i:159;i:10000082;i:160;i:10000385;i:161;i:10000323;i:162;i:10000394;i:163;i:10000106;i:164;i:10000051;i:165;i:10000282;i:166;i:10000473;i:167;i:10000113;i:168;i:10000362;i:169;i:10000513;i:170;i:10000425;i:171;i:10000525;i:172;i:10000420;i:173;i:10000512;i:174;i:10000085;i:175;i:10000084;i:176;i:10000034;i:177;i:10000061;i:178;i:10000400;i:179;i:10000146;i:180;i:10000298;i:181;i:10000351;i:182;i:10000183;i:183;i:10000043;i:184;i:10000359;i:185;i:10000077;i:186;i:10000075;i:187;i:10000327;i:188;i:10000296;i:189;i:10000210;i:190;i:10000095;i:191;i:10000201;i:192;i:10000461;i:193;i:10000187;i:194;i:10000066;i:195;i:10000355;i:196;i:10000209;i:197;i:10000023;i:198;i:10000331;i:199;i:10000116;i:200;i:10000318;i:201;i:10000322;i:202;i:10000280;i:203;i:10000234;i:204;i:10000019;i:205;i:10000030;i:206;i:10000167;i:207;i:10000079;i:208;i:10000024;i:209;i:10000434;i:210;i:10000172;i:211;i:10000387;i:212;i:10000036;i:213;i:10000521;i:214;i:10000179;i:215;i:10000283;i:216;i:10000115;i:217;i:10000198;i:218;i:10000341;i:219;i:10000491;i:220;i:10000305;i:221;i:10000364;i:222;i:10000287;i:223;i:10000035;i:224;i:10000190;i:225;i:10000520;i:226;i:10000200;i:227;i:10000124;i:228;i:10000055;i:229;i:10000368;i:230;i:10000451;i:231;i:10000334;i:232;i:10000392;i:233;i:10000257;i:234;i:10000447;i:235;i:10000168;i:236;i:10000007;i:237;i:10000476;i:238;i:10000517;i:239;i:10000308;i:240;i:10000384;i:241;i:10000260;i:242;i:10000312;i:243;i:10000263;i:244;i:10000014;i:245;i:10000228;i:246;i:10000444;i:247;i:10000481;i:248;i:10000366;i:249;i:10000375;i:250;i:10000099;i:251;i:10000141;i:252;i:10000174;i:253;i:10000092;i:254;i:10000297;i:255;i:10000527;i:256;i:10000253;i:257;i:10000196;i:258;i:10000264;i:259;i:10000500;i:260;i:10000150;i:261;i:10000401;i:262;i:10000498;i:263;i:10000288;i:264;i:10000189;i:265;i:10000039;i:266;i:10000040;i:267;i:10000437;i:268;i:10000428;i:269;i:10000090;i:270;i:10000272;i:271;i:10000435;i:272;i:10000275;i:273;i:10000300;i:274;i:10000301;i:275;i:10000138;i:276;i:10000399;i:277;i:10000487;i:278;i:10000046;i:279;i:10000389;i:280;i:10000147;i:281;i:10000422;i:282;i:10000080;i:283;i:10000413;i:284;i:10000480;i:285;i:10000149;i:286;i:10000130;i:287;i:10000414;i:288;i:10000053;i:289;i:10000261;i:290;i:10000068;i:291;i:10000216;i:292;i:10000338;i:293;i:10000246;i:294;i:10000488;i:295;i:10000442;i:296;i:10000293;i:297;i:10000243;i:298;i:10000292;i:299;i:10000067;i:300;i:10000463;i:301;i:10000371;i:302;i:10000233;i:303;i:10000313;i:304;i:10000157;i:305;i:10000230;i:306;i:10000104;i:307;i:10000028;i:308;i:10000279;i:309;i:10000041;i:310;i:10000410;i:311;i:10000514;i:312;i:10000206;i:313;i:10000240;i:314;i:10000508;i:315;i:10000353;i:316;i:10000470;i:317;i:10000176;i:318;i:10000171;i:319;i:10000324;i:320;i:10000448;i:321;i:10000129;i:322;i:10000446;i:323;i:10000336;i:324;i:10000277;i:325;i:10000285;i:326;i:10000269;i:327;i:10000251;i:328;i:10000217;i:329;i:10000528;i:330;i:10000151;i:331;i:10000372;i:332;i:10000354;i:333;i:10000006;i:334;i:10000114;i:335;i:10000143;i:336;i:10000479;i:337;i:10000070;i:338;i:10000249;i:339;i:10000262;i:340;i:10000162;i:341;i:10000204;i:342;i:10000482;i:343;i:10000016;i:344;i:10000432;i:345;i:10000133;i:346;i:10000386;i:347;i:10000349;i:348;i:10000493;i:349;i:10000048;i:350;i:10000140;i:351;i:10000494;i:352;i:10000452;i:353;i:10000062;i:354;i:10000398;i:355;i:10000031;i:356;i:10000078;i:357;i:10000443;i:358;i:10000111;i:359;i:10000365;i:360;i:10000032;i:361;i:10000159;i:362;i:10000471;i:363;i:10000278;i:364;i:10000373;i:365;i:10000049;i:366;i:10000458;i:367;i:10000395;i:368;i:10000270;i:369;i:10000412;i:370;i:10000212;i:371;i:10000496;i:372;i:10000063;i:373;i:10000306;i:374;i:10000363;i:375;i:10000202;i:376;i:10000186;i:377;i:10000356;i:378;i:10000403;i:379;i:10000421;i:380;i:10000224;i:381;i:10000086;i:382;i:10000456;i:383;i:10000509;i:384;i:10000486;i:385;i:10000450;i:386;i:10000302;i:387;i:10000017;i:388;i:10000180;i:389;i:10000438;i:390;i:10000013;i:391;i:10000128;i:392;i:10000105;i:393;i:10000419;i:394;i:10000029;i:395;i:10000038;i:396;i:10000160;i:397;i:10000529;i:398;i:10000203;i:399;i:10000121;i:400;i:10000390;i:401;i:10000303;i:402;i:10000453;i:403;i:10000417;i:404;i:10000132;i:405;i:10000011;i:406;i:10000018;i:407;i:10000337;i:408;i:10000145;i:409;i:10000519;i:410;i:10000027;i:411;i:10000516;i:412;i:10000460;i:413;i:10000490;i:414;i:10000522;i:415;i:10000382;i:416;i:10000255;i:417;i:10000381;i:418;i:10000004;i:419;i:10000502;i:420;i:10000254;i:421;i:10000010;i:422;i:10000108;i:423;i:10000074;i:424;i:10000259;i:425;i:10000221;i:426;i:10000457;i:427;i:10000044;i:428;i:10000250;i:429;i:10000326;i:430;i:10000361;i:431;i:10000148;i:432;i:10000185;i:433;i:10000191;i:434;i:10000256;i:435;i:10000219;i:436;i:10000294;i:437;i:10000339;i:438;i:10000333;i:439;i:10000101;i:440;i:10000003;i:441;i:10000236;i:442;i:10000197;i:443;i:10000156;i:444;i:10000411;i:445;i:10000515;i:446;i:10000406;i:447;i:10000213;i:448;i:10000139;i:449;i:10000445;i:450;i:10000397;i:451;i:10000518;i:452;i:10000188;i:453;i:10000335;i:454;i:10000268;i:455;i:10000510;i:456;i:10000429;i:457;i:10000466;i:458;i:10000122;i:459;i:10000110;i:460;i:10000153;i:461;i:10000184;i:462;i:10000526;i:463;i:10000430;i:464;i:10000357;i:465;i:10000380;i:466;i:10000347;i:467;i:10000208;i:468;i:10000360;i:469;i:10000503;i:470;i:10000370;i:471;i:10000310;i:472;i:10000289;i:473;i:10000319;i:474;i:10000211;i:475;i:10000214;i:476;i:10000220;i:477;i:10000484;i:478;i:10000286;i:479;i:10000423;i:480;i:10000276;i:481;i:10000069;i:482;i:10000407;i:483;i:10000440;i:484;i:10000388;i:485;i:10000369;i:486;i:10000118;i:487;i:10000342;i:488;i:10000244;i:489;i:10000426;i:490;i:10000238;i:491;i:10000199;i:492;i:10000311;i:493;i:10000465;i:494;i:10000091;i:495;i:10000524;i:496;i:10000025;i:497;i:10000258;i:498;i:10000329;i:499;i:10000056;i:500;i:10000309;i:501;i:10000057;i:502;i:10000505;i:503;i:10000081;i:504;i:10000107;i:505;i:10000265;i:506;i:10000433;i:507;i:10000295;i:508;i:10000178;i:509;i:10000231;i:510;i:10000021;i:511;i:10000340;i:512;i:10000177;i:513;i:10000042;i:514;i:10000344;i:515;i:10000052;i:516;i:10000135;i:517;i:10000194;i:518;i:10000112;i:519;i:10000050;i:520;i:10000125;i:521;i:10000284;i:522;i:10000117;i:523;i:10000161;i:524;i:10000469;i:525;i:10000350;i:526;i:10000352;i:527;i:10000495;i:528;i:10000477;}', 'a:529:{i:0;i:10000483;i:1;i:10000072;i:2;i:10000192;i:3;i:10000120;i:4;i:10000097;i:5;i:10000064;i:6;i:10000409;i:7;i:10000358;i:8;i:10000020;i:9;i:10000096;i:10;i:10000005;i:11;i:10000467;i:12;i:10000193;i:13;i:10000218;i:14;i:10000402;i:15;i:10000245;i:16;i:10000408;i:17;i:10000126;i:18;i:10000054;i:19;i:10000377;i:20;i:10000037;i:21;i:10000065;i:22;i:10000165;i:23;i:10000271;i:24;i:10000223;i:25;i:10000472;i:26;i:10000431;i:27;i:10000089;i:28;i:10000222;i:29;i:10000232;i:30;i:10000314;i:31;i:10000379;i:32;i:10000504;i:33;i:10000307;i:34;i:10000235;i:35;i:10000348;i:36;i:10000393;i:37;i:10000175;i:38;i:10000499;i:39;i:10000501;i:40;i:10000478;i:41;i:10000321;i:42;i:10000273;i:43;i:10000248;i:44;i:10000464;i:45;i:10000059;i:46;i:10000290;i:47;i:10000026;i:48;i:10000247;i:49;i:10000142;i:50;i:10000137;i:51;i:10000226;i:52;i:10000405;i:53;i:10000229;i:54;i:10000047;i:55;i:10000468;i:56;i:10000173;i:57;i:10000182;i:58;i:10000181;i:59;i:10000507;i:60;i:10000033;i:61;i:10000076;i:62;i:10000102;i:63;i:10000345;i:64;i:10000424;i:65;i:10000418;i:66;i:10000087;i:67;i:10000012;i:68;i:10000215;i:69;i:10000281;i:70;i:10000376;i:71;i:10000058;i:72;i:10000103;i:73;i:10000427;i:74;i:10000317;i:75;i:10000002;i:76;i:10000195;i:77;i:10000163;i:78;i:10000304;i:79;i:10000415;i:80;i:10000073;i:81;i:10000497;i:82;i:10000166;i:83;i:10000274;i:84;i:10000455;i:85;i:10000346;i:86;i:10000158;i:87;i:10000475;i:88;i:10000154;i:89;i:10000439;i:90;i:10000123;i:91;i:10000093;i:92;i:10000022;i:93;i:10000144;i:94;i:10000127;i:95;i:10000241;i:96;i:10000404;i:97;i:10000009;i:98;i:10000325;i:99;i:10000001;i:100;i:10000094;i:101;i:10000060;i:102;i:10000164;i:103;i:10000374;i:104;i:10000252;i:105;i:10000367;i:106;i:10000343;i:107;i:10000383;i:108;i:10000492;i:109;i:10000008;i:110;i:10000449;i:111;i:10000136;i:112;i:10000315;i:113;i:10000119;i:114;i:10000459;i:115;i:10000320;i:116;i:10000152;i:117;i:10000015;i:118;i:10000045;i:119;i:10000462;i:120;i:10000242;i:121;i:10000506;i:122;i:10000378;i:123;i:10000316;i:124;i:10000088;i:125;i:10000454;i:126;i:10000169;i:127;i:10000330;i:128;i:10000511;i:129;i:10000266;i:130;i:10000436;i:131;i:10000239;i:132;i:10000328;i:133;i:10000441;i:134;i:10000416;i:135;i:10000391;i:136;i:10000098;i:137;i:10000299;i:138;i:10000109;i:139;i:10000237;i:140;i:10000332;i:141;i:10000083;i:142;i:10000205;i:143;i:10000267;i:144;i:10000396;i:145;i:10000489;i:146;i:10000474;i:147;i:10000227;i:148;i:10000100;i:149;i:10000291;i:150;i:10000485;i:151;i:10000131;i:152;i:10000170;i:153;i:10000207;i:154;i:10000134;i:155;i:10000155;i:156;i:10000523;i:157;i:10000071;i:158;i:10000225;i:159;i:10000082;i:160;i:10000385;i:161;i:10000323;i:162;i:10000394;i:163;i:10000106;i:164;i:10000051;i:165;i:10000282;i:166;i:10000473;i:167;i:10000113;i:168;i:10000362;i:169;i:10000513;i:170;i:10000425;i:171;i:10000525;i:172;i:10000420;i:173;i:10000512;i:174;i:10000085;i:175;i:10000084;i:176;i:10000034;i:177;i:10000061;i:178;i:10000400;i:179;i:10000146;i:180;i:10000298;i:181;i:10000351;i:182;i:10000183;i:183;i:10000043;i:184;i:10000359;i:185;i:10000077;i:186;i:10000075;i:187;i:10000327;i:188;i:10000296;i:189;i:10000210;i:190;i:10000095;i:191;i:10000201;i:192;i:10000461;i:193;i:10000187;i:194;i:10000066;i:195;i:10000355;i:196;i:10000209;i:197;i:10000023;i:198;i:10000331;i:199;i:10000116;i:200;i:10000318;i:201;i:10000322;i:202;i:10000280;i:203;i:10000234;i:204;i:10000019;i:205;i:10000030;i:206;i:10000167;i:207;i:10000079;i:208;i:10000024;i:209;i:10000434;i:210;i:10000172;i:211;i:10000387;i:212;i:10000036;i:213;i:10000521;i:214;i:10000179;i:215;i:10000283;i:216;i:10000115;i:217;i:10000198;i:218;i:10000341;i:219;i:10000491;i:220;i:10000305;i:221;i:10000364;i:222;i:10000287;i:223;i:10000035;i:224;i:10000190;i:225;i:10000520;i:226;i:10000200;i:227;i:10000124;i:228;i:10000055;i:229;i:10000368;i:230;i:10000451;i:231;i:10000334;i:232;i:10000392;i:233;i:10000257;i:234;i:10000447;i:235;i:10000168;i:236;i:10000007;i:237;i:10000476;i:238;i:10000517;i:239;i:10000308;i:240;i:10000384;i:241;i:10000260;i:242;i:10000312;i:243;i:10000263;i:244;i:10000014;i:245;i:10000228;i:246;i:10000444;i:247;i:10000481;i:248;i:10000366;i:249;i:10000375;i:250;i:10000099;i:251;i:10000141;i:252;i:10000174;i:253;i:10000092;i:254;i:10000297;i:255;i:10000527;i:256;i:10000253;i:257;i:10000196;i:258;i:10000264;i:259;i:10000500;i:260;i:10000150;i:261;i:10000401;i:262;i:10000498;i:263;i:10000288;i:264;i:10000189;i:265;i:10000039;i:266;i:10000040;i:267;i:10000437;i:268;i:10000428;i:269;i:10000090;i:270;i:10000272;i:271;i:10000435;i:272;i:10000275;i:273;i:10000300;i:274;i:10000301;i:275;i:10000138;i:276;i:10000399;i:277;i:10000487;i:278;i:10000046;i:279;i:10000389;i:280;i:10000147;i:281;i:10000422;i:282;i:10000080;i:283;i:10000413;i:284;i:10000480;i:285;i:10000149;i:286;i:10000130;i:287;i:10000414;i:288;i:10000053;i:289;i:10000261;i:290;i:10000068;i:291;i:10000216;i:292;i:10000338;i:293;i:10000246;i:294;i:10000488;i:295;i:10000442;i:296;i:10000293;i:297;i:10000243;i:298;i:10000292;i:299;i:10000067;i:300;i:10000463;i:301;i:10000371;i:302;i:10000233;i:303;i:10000313;i:304;i:10000157;i:305;i:10000230;i:306;i:10000104;i:307;i:10000028;i:308;i:10000279;i:309;i:10000041;i:310;i:10000410;i:311;i:10000514;i:312;i:10000206;i:313;i:10000240;i:314;i:10000508;i:315;i:10000353;i:316;i:10000470;i:317;i:10000176;i:318;i:10000171;i:319;i:10000324;i:320;i:10000448;i:321;i:10000129;i:322;i:10000446;i:323;i:10000336;i:324;i:10000277;i:325;i:10000285;i:326;i:10000269;i:327;i:10000251;i:328;i:10000217;i:329;i:10000528;i:330;i:10000151;i:331;i:10000372;i:332;i:10000354;i:333;i:10000006;i:334;i:10000114;i:335;i:10000143;i:336;i:10000479;i:337;i:10000070;i:338;i:10000249;i:339;i:10000262;i:340;i:10000162;i:341;i:10000204;i:342;i:10000482;i:343;i:10000016;i:344;i:10000432;i:345;i:10000133;i:346;i:10000386;i:347;i:10000349;i:348;i:10000493;i:349;i:10000048;i:350;i:10000140;i:351;i:10000494;i:352;i:10000452;i:353;i:10000062;i:354;i:10000398;i:355;i:10000031;i:356;i:10000078;i:357;i:10000443;i:358;i:10000111;i:359;i:10000365;i:360;i:10000032;i:361;i:10000159;i:362;i:10000471;i:363;i:10000278;i:364;i:10000373;i:365;i:10000049;i:366;i:10000458;i:367;i:10000395;i:368;i:10000270;i:369;i:10000412;i:370;i:10000212;i:371;i:10000496;i:372;i:10000063;i:373;i:10000306;i:374;i:10000363;i:375;i:10000202;i:376;i:10000186;i:377;i:10000356;i:378;i:10000403;i:379;i:10000421;i:380;i:10000224;i:381;i:10000086;i:382;i:10000456;i:383;i:10000509;i:384;i:10000486;i:385;i:10000450;i:386;i:10000302;i:387;i:10000017;i:388;i:10000180;i:389;i:10000438;i:390;i:10000013;i:391;i:10000128;i:392;i:10000105;i:393;i:10000419;i:394;i:10000029;i:395;i:10000038;i:396;i:10000160;i:397;i:10000529;i:398;i:10000203;i:399;i:10000121;i:400;i:10000390;i:401;i:10000303;i:402;i:10000453;i:403;i:10000417;i:404;i:10000132;i:405;i:10000011;i:406;i:10000018;i:407;i:10000337;i:408;i:10000145;i:409;i:10000519;i:410;i:10000027;i:411;i:10000516;i:412;i:10000460;i:413;i:10000490;i:414;i:10000522;i:415;i:10000382;i:416;i:10000255;i:417;i:10000381;i:418;i:10000004;i:419;i:10000502;i:420;i:10000254;i:421;i:10000010;i:422;i:10000108;i:423;i:10000074;i:424;i:10000259;i:425;i:10000221;i:426;i:10000457;i:427;i:10000044;i:428;i:10000250;i:429;i:10000326;i:430;i:10000361;i:431;i:10000148;i:432;i:10000185;i:433;i:10000191;i:434;i:10000256;i:435;i:10000219;i:436;i:10000294;i:437;i:10000339;i:438;i:10000333;i:439;i:10000101;i:440;i:10000003;i:441;i:10000236;i:442;i:10000197;i:443;i:10000156;i:444;i:10000411;i:445;i:10000515;i:446;i:10000406;i:447;i:10000213;i:448;i:10000139;i:449;i:10000445;i:450;i:10000397;i:451;i:10000518;i:452;i:10000188;i:453;i:10000335;i:454;i:10000268;i:455;i:10000510;i:456;i:10000429;i:457;i:10000466;i:458;i:10000122;i:459;i:10000110;i:460;i:10000153;i:461;i:10000184;i:462;i:10000526;i:463;i:10000430;i:464;i:10000357;i:465;i:10000380;i:466;i:10000347;i:467;i:10000208;i:468;i:10000360;i:469;i:10000503;i:470;i:10000370;i:471;i:10000310;i:472;i:10000289;i:473;i:10000319;i:474;i:10000211;i:475;i:10000214;i:476;i:10000220;i:477;i:10000484;i:478;i:10000286;i:479;i:10000423;i:480;i:10000276;i:481;i:10000069;i:482;i:10000407;i:483;i:10000440;i:484;i:10000388;i:485;i:10000369;i:486;i:10000118;i:487;i:10000342;i:488;i:10000244;i:489;i:10000426;i:490;i:10000238;i:491;i:10000199;i:492;i:10000311;i:493;i:10000465;i:494;i:10000091;i:495;i:10000524;i:496;i:10000025;i:497;i:10000258;i:498;i:10000329;i:499;i:10000056;i:500;i:10000309;i:501;i:10000057;i:502;i:10000505;i:503;i:10000081;i:504;i:10000107;i:505;i:10000265;i:506;i:10000433;i:507;i:10000295;i:508;i:10000178;i:509;i:10000231;i:510;i:10000021;i:511;i:10000340;i:512;i:10000177;i:513;i:10000042;i:514;i:10000344;i:515;i:10000052;i:516;i:10000135;i:517;i:10000194;i:518;i:10000112;i:519;i:10000050;i:520;i:10000125;i:521;i:10000284;i:522;i:10000117;i:523;i:10000161;i:524;i:10000469;i:525;i:10000350;i:526;i:10000352;i:527;i:10000495;i:528;i:10000477;}'),
(11, 11, 1, 599, 'a:599:{i:0;i:10000269;i:1;i:10000076;i:2;i:10000528;i:3;i:10000241;i:4;i:10000332;i:5;i:10000086;i:6;i:10000274;i:7;i:10000098;i:8;i:10000484;i:9;i:10000237;i:10;i:10000395;i:11;i:10000051;i:12;i:10000549;i:13;i:10000374;i:14;i:10000243;i:15;i:10000525;i:16;i:10000539;i:17;i:10000214;i:18;i:10000162;i:19;i:10000504;i:20;i:10000481;i:21;i:10000434;i:22;i:10000598;i:23;i:10000535;i:24;i:10000575;i:25;i:10000517;i:26;i:10000495;i:27;i:10000208;i:28;i:10000317;i:29;i:10000071;i:30;i:10000593;i:31;i:10000584;i:32;i:10000258;i:33;i:10000555;i:34;i:10000179;i:35;i:10000546;i:36;i:10000181;i:37;i:10000401;i:38;i:10000164;i:39;i:10000429;i:40;i:10000590;i:41;i:10000473;i:42;i:10000542;i:43;i:10000313;i:44;i:10000136;i:45;i:10000319;i:46;i:10000084;i:47;i:10000090;i:48;i:10000459;i:49;i:10000576;i:50;i:10000413;i:51;i:10000220;i:52;i:10000251;i:53;i:10000314;i:54;i:10000408;i:55;i:10000456;i:56;i:10000212;i:57;i:10000448;i:58;i:10000394;i:59;i:10000074;i:60;i:10000545;i:61;i:10000365;i:62;i:10000286;i:63;i:10000137;i:64;i:10000240;i:65;i:10000318;i:66;i:10000361;i:67;i:10000145;i:68;i:10000531;i:69;i:10000579;i:70;i:10000499;i:71;i:10000174;i:72;i:10000155;i:73;i:10000256;i:74;i:10000329;i:75;i:10000552;i:76;i:10000263;i:77;i:10000048;i:78;i:10000462;i:79;i:10000221;i:80;i:10000564;i:81;i:10000290;i:82;i:10000037;i:83;i:10000342;i:84;i:10000512;i:85;i:10000082;i:86;i:10000223;i:87;i:10000599;i:88;i:10000219;i:89;i:10000425;i:90;i:10000595;i:91;i:10000421;i:92;i:10000069;i:93;i:10000202;i:94;i:10000460;i:95;i:10000004;i:96;i:10000562;i:97;i:10000409;i:98;i:10000168;i:99;i:10000081;i:100;i:10000235;i:101;i:10000016;i:102;i:10000033;i:103;i:10000513;i:104;i:10000257;i:105;i:10000001;i:106;i:10000072;i:107;i:10000501;i:108;i:10000105;i:109;i:10000199;i:110;i:10000020;i:111;i:10000445;i:112;i:10000279;i:113;i:10000200;i:114;i:10000550;i:115;i:10000485;i:116;i:10000475;i:117;i:10000410;i:118;i:10000133;i:119;i:10000092;i:120;i:10000184;i:121;i:10000482;i:122;i:10000152;i:123;i:10000253;i:124;i:10000121;i:125;i:10000185;i:126;i:10000064;i:127;i:10000465;i:128;i:10000357;i:129;i:10000050;i:130;i:10000345;i:131;i:10000330;i:132;i:10000226;i:133;i:10000547;i:134;i:10000106;i:135;i:10000193;i:136;i:10000372;i:137;i:10000178;i:138;i:10000322;i:139;i:10000514;i:140;i:10000087;i:141;i:10000278;i:142;i:10000255;i:143;i:10000109;i:144;i:10000356;i:145;i:10000247;i:146;i:10000516;i:147;i:10000571;i:148;i:10000588;i:149;i:10000194;i:150;i:10000122;i:151;i:10000207;i:152;i:10000120;i:153;i:10000153;i:154;i:10000259;i:155;i:10000522;i:156;i:10000275;i:157;i:10000292;i:158;i:10000548;i:159;i:10000284;i:160;i:10000455;i:161;i:10000312;i:162;i:10000382;i:163;i:10000099;i:164;i:10000045;i:165;i:10000544;i:166;i:10000205;i:167;i:10000054;i:168;i:10000570;i:169;i:10000065;i:170;i:10000392;i:171;i:10000211;i:172;i:10000043;i:173;i:10000067;i:174;i:10000472;i:175;i:10000443;i:176;i:10000379;i:177;i:10000104;i:178;i:10000268;i:179;i:10000244;i:180;i:10000060;i:181;i:10000474;i:182;i:10000123;i:183;i:10000407;i:184;i:10000524;i:185;i:10000362;i:186;i:10000025;i:187;i:10000036;i:188;i:10000311;i:189;i:10000377;i:190;i:10000307;i:191;i:10000487;i:192;i:10000364;i:193;i:10000230;i:194;i:10000096;i:195;i:10000452;i:196;i:10000328;i:197;i:10000486;i:198;i:10000553;i:199;i:10000057;i:200;i:10000302;i:201;i:10000489;i:202;i:10000519;i:203;i:10000510;i:204;i:10000019;i:205;i:10000469;i:206;i:10000591;i:207;i:10000192;i:208;i:10000239;i:209;i:10000144;i:210;i:10000148;i:211;i:10000479;i:212;i:10000398;i:213;i:10000128;i:214;i:10000350;i:215;i:10000146;i:216;i:10000125;i:217;i:10000483;i:218;i:10000334;i:219;i:10000323;i:220;i:10000130;i:221;i:10000393;i:222;i:10000117;i:223;i:10000417;i:224;i:10000277;i:225;i:10000508;i:226;i:10000102;i:227;i:10000385;i:228;i:10000491;i:229;i:10000017;i:230;i:10000480;i:231;i:10000294;i:232;i:10000306;i:233;i:10000507;i:234;i:10000113;i:235;i:10000454;i:236;i:10000451;i:237;i:10000308;i:238;i:10000384;i:239;i:10000217;i:240;i:10000177;i:241;i:10000026;i:242;i:10000272;i:243;i:10000068;i:244;i:10000431;i:245;i:10000538;i:246;i:10000381;i:247;i:10000502;i:248;i:10000013;i:249;i:10000581;i:250;i:10000497;i:251;i:10000159;i:252;i:10000327;i:253;i:10000196;i:254;i:10000435;i:255;i:10000303;i:256;i:10000041;i:257;i:10000097;i:258;i:10000030;i:259;i:10000419;i:260;i:10000191;i:261;i:10000583;i:262;i:10000143;i:263;i:10000046;i:264;i:10000021;i:265;i:10000348;i:266;i:10000559;i:267;i:10000089;i:268;i:10000061;i:269;i:10000526;i:270;i:10000107;i:271;i:10000124;i:272;i:10000022;i:273;i:10000567;i:274;i:10000321;i:275;i:10000260;i:276;i:10000305;i:277;i:10000490;i:278;i:10000406;i:279;i:10000119;i:280;i:10000018;i:281;i:10000055;i:282;i:10000543;i:283;i:10000276;i:284;i:10000596;i:285;i:10000039;i:286;i:10000135;i:287;i:10000167;i:288;i:10000430;i:289;i:10000494;i:290;i:10000577;i:291;i:10000163;i:292;i:10000031;i:293;i:10000005;i:294;i:10000066;i:295;i:10000557;i:296;i:10000331;i:297;i:10000529;i:298;i:10000281;i:299;i:10000231;i:300;i:10000367;i:301;i:10000028;i:302;i:10000150;i:303;i:10000370;i:304;i:10000560;i:305;i:10000503;i:306;i:10000511;i:307;i:10000227;i:308;i:10000198;i:309;i:10000288;i:310;i:10000496;i:311;i:10000320;i:312;i:10000427;i:313;i:10000424;i:314;i:10000366;i:315;i:10000476;i:316;i:10000156;i:317;i:10000441;i:318;i:10000173;i:319;i:10000412;i:320;i:10000464;i:321;i:10000008;i:322;i:10000423;i:323;i:10000116;i:324;i:10000232;i:325;i:10000391;i:326;i:10000351;i:327;i:10000176;i:328;i:10000438;i:329;i:10000280;i:330;i:10000091;i:331;i:10000439;i:332;i:10000316;i:333;i:10000079;i:334;i:10000108;i:335;i:10000437;i:336;i:10000523;i:337;i:10000400;i:338;i:10000147;i:339;i:10000187;i:340;i:10000118;i:341;i:10000110;i:342;i:10000203;i:343;i:10000190;i:344;i:10000170;i:345;i:10000333;i:346;i:10000171;i:347;i:10000414;i:348;i:10000537;i:349;i:10000182;i:350;i:10000388;i:351;i:10000442;i:352;i:10000111;i:353;i:10000336;i:354;i:10000195;i:355;i:10000478;i:356;i:10000363;i:357;i:10000346;i:358;i:10000095;i:359;i:10000325;i:360;i:10000324;i:361;i:10000493;i:362;i:10000532;i:363;i:10000197;i:364;i:10000386;i:365;i:10000158;i:366;i:10000358;i:367;i:10000461;i:368;i:10000201;i:369;i:10000042;i:370;i:10000355;i:371;i:10000296;i:372;i:10000536;i:373;i:10000432;i:374;i:10000023;i:375;i:10000034;i:376;i:10000521;i:377;i:10000369;i:378;i:10000589;i:379;i:10000556;i:380;i:10000078;i:381;i:10000310;i:382;i:10000353;i:383;i:10000053;i:384;i:10000139;i:385;i:10000563;i:386;i:10000354;i:387;i:10000266;i:388;i:10000027;i:389;i:10000574;i:390;i:10000127;i:391;i:10000140;i:392;i:10000506;i:393;i:10000428;i:394;i:10000224;i:395;i:10000216;i:396;i:10000352;i:397;i:10000343;i:398;i:10000488;i:399;i:10000301;i:400;i:10000115;i:401;i:10000132;i:402;i:10000594;i:403;i:10000558;i:404;i:10000154;i:405;i:10000035;i:406;i:10000180;i:407;i:10000498;i:408;i:10000315;i:409;i:10000534;i:410;i:10000492;i:411;i:10000029;i:412;i:10000186;i:413;i:10000447;i:414;i:10000541;i:415;i:10000282;i:416;i:10000215;i:417;i:10000289;i:418;i:10000151;i:419;i:10000426;i:420;i:10000338;i:421;i:10000075;i:422;i:10000335;i:423;i:10000373;i:424;i:10000573;i:425;i:10000300;i:426;i:10000183;i:427;i:10000457;i:428;i:10000248;i:429;i:10000340;i:430;i:10000007;i:431;i:10000236;i:432;i:10000411;i:433;i:10000578;i:434;i:10000131;i:435;i:10000165;i:436;i:10000138;i:437;i:10000264;i:438;i:10000299;i:439;i:10000477;i:440;i:10000172;i:441;i:10000436;i:442;i:10000375;i:443;i:10000586;i:444;i:10000368;i:445;i:10000238;i:446;i:10000141;i:447;i:10000360;i:448;i:10000399;i:449;i:10000083;i:450;i:10000416;i:451;i:10000418;i:452;i:10000415;i:453;i:10000040;i:454;i:10000206;i:455;i:10000058;i:456;i:10000059;i:457;i:10000554;i:458;i:10000580;i:459;i:10000015;i:460;i:10000389;i:461;i:10000169;i:462;i:10000530;i:463;i:10000265;i:464;i:10000157;i:465;i:10000467;i:466;i:10000470;i:467;i:10000287;i:468;i:10000100;i:469;i:10000326;i:470;i:10000404;i:471;i:10000291;i:472;i:10000585;i:473;i:10000149;i:474;i:10000218;i:475;i:10000011;i:476;i:10000309;i:477;i:10000063;i:478;i:10000422;i:479;i:10000463;i:480;i:10000518;i:481;i:10000403;i:482;i:10000228;i:483;i:10000383;i:484;i:10000466;i:485;i:10000396;i:486;i:10000003;i:487;i:10000047;i:488;i:10000390;i:489;i:10000371;i:490;i:10000387;i:491;i:10000134;i:492;i:10000014;i:493;i:10000270;i:494;i:10000433;i:495;i:10000359;i:496;i:10000242;i:497;i:10000002;i:498;i:10000378;i:499;i:10000298;i:500;i:10000267;i:501;i:10000520;i:502;i:10000080;i:503;i:10000551;i:504;i:10000337;i:505;i:10000166;i:506;i:10000073;i:507;i:10000347;i:508;i:10000440;i:509;i:10000024;i:510;i:10000252;i:511;i:10000245;i:512;i:10000449;i:513;i:10000339;i:514;i:10000405;i:515;i:10000446;i:516;i:10000010;i:517;i:10000129;i:518;i:10000161;i:519;i:10000273;i:520;i:10000380;i:521;i:10000126;i:522;i:10000540;i:523;i:10000160;i:524;i:10000032;i:525;i:10000458;i:526;i:10000566;i:527;i:10000471;i:528;i:10000250;i:529;i:10000114;i:530;i:10000233;i:531;i:10000210;i:532;i:10000468;i:533;i:10000444;i:534;i:10000533;i:535;i:10000569;i:536;i:10000249;i:537;i:10000052;i:538;i:10000103;i:539;i:10000565;i:540;i:10000572;i:541;i:10000453;i:542;i:10000376;i:543;i:10000006;i:544;i:10000597;i:545;i:10000295;i:546;i:10000304;i:547;i:10000271;i:548;i:10000285;i:549;i:10000038;i:550;i:10000070;i:551;i:10000234;i:552;i:10000101;i:553;i:10000293;i:554;i:10000561;i:555;i:10000094;i:556;i:10000222;i:557;i:10000587;i:558;i:10000254;i:559;i:10000568;i:560;i:10000189;i:561;i:10000341;i:562;i:10000225;i:563;i:10000505;i:564;i:10000209;i:565;i:10000509;i:566;i:10000450;i:567;i:10000044;i:568;i:10000527;i:569;i:10000204;i:570;i:10000397;i:571;i:10000093;i:572;i:10000112;i:573;i:10000088;i:574;i:10000592;i:575;i:10000085;i:576;i:10000012;i:577;i:10000283;i:578;i:10000213;i:579;i:10000056;i:580;i:10000515;i:581;i:10000349;i:582;i:10000049;i:583;i:10000009;i:584;i:10000077;i:585;i:10000344;i:586;i:10000420;i:587;i:10000188;i:588;i:10000246;i:589;i:10000500;i:590;i:10000402;i:591;i:10000262;i:592;i:10000142;i:593;i:10000297;i:594;i:10000062;i:595;i:10000175;i:596;i:10000582;i:597;i:10000261;i:598;i:10000229;}', 'a:599:{i:0;i:10000269;i:1;i:10000076;i:2;i:10000528;i:3;i:10000241;i:4;i:10000332;i:5;i:10000086;i:6;i:10000274;i:7;i:10000098;i:8;i:10000484;i:9;i:10000237;i:10;i:10000395;i:11;i:10000051;i:12;i:10000549;i:13;i:10000374;i:14;i:10000243;i:15;i:10000525;i:16;i:10000539;i:17;i:10000214;i:18;i:10000162;i:19;i:10000504;i:20;i:10000481;i:21;i:10000434;i:22;i:10000598;i:23;i:10000535;i:24;i:10000575;i:25;i:10000517;i:26;i:10000495;i:27;i:10000208;i:28;i:10000317;i:29;i:10000071;i:30;i:10000593;i:31;i:10000584;i:32;i:10000258;i:33;i:10000555;i:34;i:10000179;i:35;i:10000546;i:36;i:10000181;i:37;i:10000401;i:38;i:10000164;i:39;i:10000429;i:40;i:10000590;i:41;i:10000473;i:42;i:10000542;i:43;i:10000313;i:44;i:10000136;i:45;i:10000319;i:46;i:10000084;i:47;i:10000090;i:48;i:10000459;i:49;i:10000576;i:50;i:10000413;i:51;i:10000220;i:52;i:10000251;i:53;i:10000314;i:54;i:10000408;i:55;i:10000456;i:56;i:10000212;i:57;i:10000448;i:58;i:10000394;i:59;i:10000074;i:60;i:10000545;i:61;i:10000365;i:62;i:10000286;i:63;i:10000137;i:64;i:10000240;i:65;i:10000318;i:66;i:10000361;i:67;i:10000145;i:68;i:10000531;i:69;i:10000579;i:70;i:10000499;i:71;i:10000174;i:72;i:10000155;i:73;i:10000256;i:74;i:10000329;i:75;i:10000552;i:76;i:10000263;i:77;i:10000048;i:78;i:10000462;i:79;i:10000221;i:80;i:10000564;i:81;i:10000290;i:82;i:10000037;i:83;i:10000342;i:84;i:10000512;i:85;i:10000082;i:86;i:10000223;i:87;i:10000599;i:88;i:10000219;i:89;i:10000425;i:90;i:10000595;i:91;i:10000421;i:92;i:10000069;i:93;i:10000202;i:94;i:10000460;i:95;i:10000004;i:96;i:10000562;i:97;i:10000409;i:98;i:10000168;i:99;i:10000081;i:100;i:10000235;i:101;i:10000016;i:102;i:10000033;i:103;i:10000513;i:104;i:10000257;i:105;i:10000001;i:106;i:10000072;i:107;i:10000501;i:108;i:10000105;i:109;i:10000199;i:110;i:10000020;i:111;i:10000445;i:112;i:10000279;i:113;i:10000200;i:114;i:10000550;i:115;i:10000485;i:116;i:10000475;i:117;i:10000410;i:118;i:10000133;i:119;i:10000092;i:120;i:10000184;i:121;i:10000482;i:122;i:10000152;i:123;i:10000253;i:124;i:10000121;i:125;i:10000185;i:126;i:10000064;i:127;i:10000465;i:128;i:10000357;i:129;i:10000050;i:130;i:10000345;i:131;i:10000330;i:132;i:10000226;i:133;i:10000547;i:134;i:10000106;i:135;i:10000193;i:136;i:10000372;i:137;i:10000178;i:138;i:10000322;i:139;i:10000514;i:140;i:10000087;i:141;i:10000278;i:142;i:10000255;i:143;i:10000109;i:144;i:10000356;i:145;i:10000247;i:146;i:10000516;i:147;i:10000571;i:148;i:10000588;i:149;i:10000194;i:150;i:10000122;i:151;i:10000207;i:152;i:10000120;i:153;i:10000153;i:154;i:10000259;i:155;i:10000522;i:156;i:10000275;i:157;i:10000292;i:158;i:10000548;i:159;i:10000284;i:160;i:10000455;i:161;i:10000312;i:162;i:10000382;i:163;i:10000099;i:164;i:10000045;i:165;i:10000544;i:166;i:10000205;i:167;i:10000054;i:168;i:10000570;i:169;i:10000065;i:170;i:10000392;i:171;i:10000211;i:172;i:10000043;i:173;i:10000067;i:174;i:10000472;i:175;i:10000443;i:176;i:10000379;i:177;i:10000104;i:178;i:10000268;i:179;i:10000244;i:180;i:10000060;i:181;i:10000474;i:182;i:10000123;i:183;i:10000407;i:184;i:10000524;i:185;i:10000362;i:186;i:10000025;i:187;i:10000036;i:188;i:10000311;i:189;i:10000377;i:190;i:10000307;i:191;i:10000487;i:192;i:10000364;i:193;i:10000230;i:194;i:10000096;i:195;i:10000452;i:196;i:10000328;i:197;i:10000486;i:198;i:10000553;i:199;i:10000057;i:200;i:10000302;i:201;i:10000489;i:202;i:10000519;i:203;i:10000510;i:204;i:10000019;i:205;i:10000469;i:206;i:10000591;i:207;i:10000192;i:208;i:10000239;i:209;i:10000144;i:210;i:10000148;i:211;i:10000479;i:212;i:10000398;i:213;i:10000128;i:214;i:10000350;i:215;i:10000146;i:216;i:10000125;i:217;i:10000483;i:218;i:10000334;i:219;i:10000323;i:220;i:10000130;i:221;i:10000393;i:222;i:10000117;i:223;i:10000417;i:224;i:10000277;i:225;i:10000508;i:226;i:10000102;i:227;i:10000385;i:228;i:10000491;i:229;i:10000017;i:230;i:10000480;i:231;i:10000294;i:232;i:10000306;i:233;i:10000507;i:234;i:10000113;i:235;i:10000454;i:236;i:10000451;i:237;i:10000308;i:238;i:10000384;i:239;i:10000217;i:240;i:10000177;i:241;i:10000026;i:242;i:10000272;i:243;i:10000068;i:244;i:10000431;i:245;i:10000538;i:246;i:10000381;i:247;i:10000502;i:248;i:10000013;i:249;i:10000581;i:250;i:10000497;i:251;i:10000159;i:252;i:10000327;i:253;i:10000196;i:254;i:10000435;i:255;i:10000303;i:256;i:10000041;i:257;i:10000097;i:258;i:10000030;i:259;i:10000419;i:260;i:10000191;i:261;i:10000583;i:262;i:10000143;i:263;i:10000046;i:264;i:10000021;i:265;i:10000348;i:266;i:10000559;i:267;i:10000089;i:268;i:10000061;i:269;i:10000526;i:270;i:10000107;i:271;i:10000124;i:272;i:10000022;i:273;i:10000567;i:274;i:10000321;i:275;i:10000260;i:276;i:10000305;i:277;i:10000490;i:278;i:10000406;i:279;i:10000119;i:280;i:10000018;i:281;i:10000055;i:282;i:10000543;i:283;i:10000276;i:284;i:10000596;i:285;i:10000039;i:286;i:10000135;i:287;i:10000167;i:288;i:10000430;i:289;i:10000494;i:290;i:10000577;i:291;i:10000163;i:292;i:10000031;i:293;i:10000005;i:294;i:10000066;i:295;i:10000557;i:296;i:10000331;i:297;i:10000529;i:298;i:10000281;i:299;i:10000231;i:300;i:10000367;i:301;i:10000028;i:302;i:10000150;i:303;i:10000370;i:304;i:10000560;i:305;i:10000503;i:306;i:10000511;i:307;i:10000227;i:308;i:10000198;i:309;i:10000288;i:310;i:10000496;i:311;i:10000320;i:312;i:10000427;i:313;i:10000424;i:314;i:10000366;i:315;i:10000476;i:316;i:10000156;i:317;i:10000441;i:318;i:10000173;i:319;i:10000412;i:320;i:10000464;i:321;i:10000008;i:322;i:10000423;i:323;i:10000116;i:324;i:10000232;i:325;i:10000391;i:326;i:10000351;i:327;i:10000176;i:328;i:10000438;i:329;i:10000280;i:330;i:10000091;i:331;i:10000439;i:332;i:10000316;i:333;i:10000079;i:334;i:10000108;i:335;i:10000437;i:336;i:10000523;i:337;i:10000400;i:338;i:10000147;i:339;i:10000187;i:340;i:10000118;i:341;i:10000110;i:342;i:10000203;i:343;i:10000190;i:344;i:10000170;i:345;i:10000333;i:346;i:10000171;i:347;i:10000414;i:348;i:10000537;i:349;i:10000182;i:350;i:10000388;i:351;i:10000442;i:352;i:10000111;i:353;i:10000336;i:354;i:10000195;i:355;i:10000478;i:356;i:10000363;i:357;i:10000346;i:358;i:10000095;i:359;i:10000325;i:360;i:10000324;i:361;i:10000493;i:362;i:10000532;i:363;i:10000197;i:364;i:10000386;i:365;i:10000158;i:366;i:10000358;i:367;i:10000461;i:368;i:10000201;i:369;i:10000042;i:370;i:10000355;i:371;i:10000296;i:372;i:10000536;i:373;i:10000432;i:374;i:10000023;i:375;i:10000034;i:376;i:10000521;i:377;i:10000369;i:378;i:10000589;i:379;i:10000556;i:380;i:10000078;i:381;i:10000310;i:382;i:10000353;i:383;i:10000053;i:384;i:10000139;i:385;i:10000563;i:386;i:10000354;i:387;i:10000266;i:388;i:10000027;i:389;i:10000574;i:390;i:10000127;i:391;i:10000140;i:392;i:10000506;i:393;i:10000428;i:394;i:10000224;i:395;i:10000216;i:396;i:10000352;i:397;i:10000343;i:398;i:10000488;i:399;i:10000301;i:400;i:10000115;i:401;i:10000132;i:402;i:10000594;i:403;i:10000558;i:404;i:10000154;i:405;i:10000035;i:406;i:10000180;i:407;i:10000498;i:408;i:10000315;i:409;i:10000534;i:410;i:10000492;i:411;i:10000029;i:412;i:10000186;i:413;i:10000447;i:414;i:10000541;i:415;i:10000282;i:416;i:10000215;i:417;i:10000289;i:418;i:10000151;i:419;i:10000426;i:420;i:10000338;i:421;i:10000075;i:422;i:10000335;i:423;i:10000373;i:424;i:10000573;i:425;i:10000300;i:426;i:10000183;i:427;i:10000457;i:428;i:10000248;i:429;i:10000340;i:430;i:10000007;i:431;i:10000236;i:432;i:10000411;i:433;i:10000578;i:434;i:10000131;i:435;i:10000165;i:436;i:10000138;i:437;i:10000264;i:438;i:10000299;i:439;i:10000477;i:440;i:10000172;i:441;i:10000436;i:442;i:10000375;i:443;i:10000586;i:444;i:10000368;i:445;i:10000238;i:446;i:10000141;i:447;i:10000360;i:448;i:10000399;i:449;i:10000083;i:450;i:10000416;i:451;i:10000418;i:452;i:10000415;i:453;i:10000040;i:454;i:10000206;i:455;i:10000058;i:456;i:10000059;i:457;i:10000554;i:458;i:10000580;i:459;i:10000015;i:460;i:10000389;i:461;i:10000169;i:462;i:10000530;i:463;i:10000265;i:464;i:10000157;i:465;i:10000467;i:466;i:10000470;i:467;i:10000287;i:468;i:10000100;i:469;i:10000326;i:470;i:10000404;i:471;i:10000291;i:472;i:10000585;i:473;i:10000149;i:474;i:10000218;i:475;i:10000011;i:476;i:10000309;i:477;i:10000063;i:478;i:10000422;i:479;i:10000463;i:480;i:10000518;i:481;i:10000403;i:482;i:10000228;i:483;i:10000383;i:484;i:10000466;i:485;i:10000396;i:486;i:10000003;i:487;i:10000047;i:488;i:10000390;i:489;i:10000371;i:490;i:10000387;i:491;i:10000134;i:492;i:10000014;i:493;i:10000270;i:494;i:10000433;i:495;i:10000359;i:496;i:10000242;i:497;i:10000002;i:498;i:10000378;i:499;i:10000298;i:500;i:10000267;i:501;i:10000520;i:502;i:10000080;i:503;i:10000551;i:504;i:10000337;i:505;i:10000166;i:506;i:10000073;i:507;i:10000347;i:508;i:10000440;i:509;i:10000024;i:510;i:10000252;i:511;i:10000245;i:512;i:10000449;i:513;i:10000339;i:514;i:10000405;i:515;i:10000446;i:516;i:10000010;i:517;i:10000129;i:518;i:10000161;i:519;i:10000273;i:520;i:10000380;i:521;i:10000126;i:522;i:10000540;i:523;i:10000160;i:524;i:10000032;i:525;i:10000458;i:526;i:10000566;i:527;i:10000471;i:528;i:10000250;i:529;i:10000114;i:530;i:10000233;i:531;i:10000210;i:532;i:10000468;i:533;i:10000444;i:534;i:10000533;i:535;i:10000569;i:536;i:10000249;i:537;i:10000052;i:538;i:10000103;i:539;i:10000565;i:540;i:10000572;i:541;i:10000453;i:542;i:10000376;i:543;i:10000006;i:544;i:10000597;i:545;i:10000295;i:546;i:10000304;i:547;i:10000271;i:548;i:10000285;i:549;i:10000038;i:550;i:10000070;i:551;i:10000234;i:552;i:10000101;i:553;i:10000293;i:554;i:10000561;i:555;i:10000094;i:556;i:10000222;i:557;i:10000587;i:558;i:10000254;i:559;i:10000568;i:560;i:10000189;i:561;i:10000341;i:562;i:10000225;i:563;i:10000505;i:564;i:10000209;i:565;i:10000509;i:566;i:10000450;i:567;i:10000044;i:568;i:10000527;i:569;i:10000204;i:570;i:10000397;i:571;i:10000093;i:572;i:10000112;i:573;i:10000088;i:574;i:10000592;i:575;i:10000085;i:576;i:10000012;i:577;i:10000283;i:578;i:10000213;i:579;i:10000056;i:580;i:10000515;i:581;i:10000349;i:582;i:10000049;i:583;i:10000009;i:584;i:10000077;i:585;i:10000344;i:586;i:10000420;i:587;i:10000188;i:588;i:10000246;i:589;i:10000500;i:590;i:10000402;i:591;i:10000262;i:592;i:10000142;i:593;i:10000297;i:594;i:10000062;i:595;i:10000175;i:596;i:10000582;i:597;i:10000261;i:598;i:10000229;}'),
(5, 5, 0, 0, 'a:0:{}', 'a:12:{i:0;i:10000002;i:1;i:10000004;i:2;i:10000012;i:3;i:10000011;i:4;i:10000005;i:5;i:10000007;i:6;i:10000006;i:7;i:10000009;i:8;i:10000010;i:9;i:10000008;i:10;i:10000003;i:11;i:10000001;}'),
(12, 12, 1, 12, 'a:12:{i:0;i:10000002;i:1;i:10000006;i:2;i:10000004;i:3;i:10000007;i:4;i:10000008;i:5;i:10000010;i:6;i:10000005;i:7;i:10000009;i:8;i:10000001;i:9;i:10000003;i:10;i:10000012;i:11;i:10000011;}', 'a:12:{i:0;i:10000002;i:1;i:10000006;i:2;i:10000004;i:3;i:10000007;i:4;i:10000008;i:5;i:10000010;i:6;i:10000005;i:7;i:10000009;i:8;i:10000001;i:9;i:10000003;i:10;i:10000012;i:11;i:10000011;}'),
(6, 6, 1, 25, 'a:25:{i:0;i:10000002;i:1;i:10000017;i:2;i:10000012;i:3;i:10000019;i:4;i:10000010;i:5;i:10000013;i:6;i:10000025;i:7;i:10000004;i:8;i:10000008;i:9;i:10000007;i:10;i:10000018;i:11;i:10000009;i:12;i:10000015;i:13;i:10000014;i:14;i:10000016;i:15;i:10000023;i:16;i:10000011;i:17;i:10000020;i:18;i:10000024;i:19;i:10000022;i:20;i:10000021;i:21;i:10000005;i:22;i:10000006;i:23;i:10000003;i:24;i:10000001;}', 'a:25:{i:0;i:10000002;i:1;i:10000017;i:2;i:10000012;i:3;i:10000019;i:4;i:10000010;i:5;i:10000013;i:6;i:10000025;i:7;i:10000004;i:8;i:10000008;i:9;i:10000007;i:10;i:10000018;i:11;i:10000009;i:12;i:10000015;i:13;i:10000014;i:14;i:10000016;i:15;i:10000023;i:16;i:10000011;i:17;i:10000020;i:18;i:10000024;i:19;i:10000022;i:20;i:10000021;i:21;i:10000005;i:22;i:10000006;i:23;i:10000003;i:24;i:10000001;}'),
(7, 7, 1, 58, 'a:58:{i:0;i:10000037;i:1;i:10000030;i:2;i:10000014;i:3;i:10000058;i:4;i:10000035;i:5;i:10000027;i:6;i:10000039;i:7;i:10000023;i:8;i:10000041;i:9;i:10000007;i:10;i:10000028;i:11;i:10000002;i:12;i:10000021;i:13;i:10000005;i:14;i:10000032;i:15;i:10000024;i:16;i:10000001;i:17;i:10000004;i:18;i:10000042;i:19;i:10000008;i:20;i:10000038;i:21;i:10000056;i:22;i:10000010;i:23;i:10000012;i:24;i:10000052;i:25;i:10000045;i:26;i:10000044;i:27;i:10000019;i:28;i:10000046;i:29;i:10000009;i:30;i:10000016;i:31;i:10000051;i:32;i:10000057;i:33;i:10000020;i:34;i:10000048;i:35;i:10000022;i:36;i:10000003;i:37;i:10000015;i:38;i:10000047;i:39;i:10000029;i:40;i:10000034;i:41;i:10000033;i:42;i:10000055;i:43;i:10000054;i:44;i:10000013;i:45;i:10000026;i:46;i:10000040;i:47;i:10000031;i:48;i:10000025;i:49;i:10000006;i:50;i:10000049;i:51;i:10000011;i:52;i:10000018;i:53;i:10000050;i:54;i:10000017;i:55;i:10000043;i:56;i:10000036;i:57;i:10000053;}', 'a:58:{i:0;i:10000037;i:1;i:10000030;i:2;i:10000014;i:3;i:10000058;i:4;i:10000035;i:5;i:10000027;i:6;i:10000039;i:7;i:10000023;i:8;i:10000041;i:9;i:10000007;i:10;i:10000028;i:11;i:10000002;i:12;i:10000021;i:13;i:10000005;i:14;i:10000032;i:15;i:10000024;i:16;i:10000001;i:17;i:10000004;i:18;i:10000042;i:19;i:10000008;i:20;i:10000038;i:21;i:10000056;i:22;i:10000010;i:23;i:10000012;i:24;i:10000052;i:25;i:10000045;i:26;i:10000044;i:27;i:10000019;i:28;i:10000046;i:29;i:10000009;i:30;i:10000016;i:31;i:10000051;i:32;i:10000057;i:33;i:10000020;i:34;i:10000048;i:35;i:10000022;i:36;i:10000003;i:37;i:10000015;i:38;i:10000047;i:39;i:10000029;i:40;i:10000034;i:41;i:10000033;i:42;i:10000055;i:43;i:10000054;i:44;i:10000013;i:45;i:10000026;i:46;i:10000040;i:47;i:10000031;i:48;i:10000025;i:49;i:10000006;i:50;i:10000049;i:51;i:10000011;i:52;i:10000018;i:53;i:10000050;i:54;i:10000017;i:55;i:10000043;i:56;i:10000036;i:57;i:10000053;}'),
(9, 9, 1, 85, 'a:85:{i:0;i:10000064;i:1;i:10000084;i:2;i:10000025;i:3;i:10000012;i:4;i:10000015;i:5;i:10000016;i:6;i:10000019;i:7;i:10000001;i:8;i:10000055;i:9;i:10000080;i:10;i:10000002;i:11;i:10000078;i:12;i:10000063;i:13;i:10000049;i:14;i:10000052;i:15;i:10000004;i:16;i:10000022;i:17;i:10000043;i:18;i:10000085;i:19;i:10000073;i:20;i:10000009;i:21;i:10000005;i:22;i:10000051;i:23;i:10000066;i:24;i:10000070;i:25;i:10000038;i:26;i:10000024;i:27;i:10000003;i:28;i:10000031;i:29;i:10000044;i:30;i:10000017;i:31;i:10000013;i:32;i:10000036;i:33;i:10000028;i:34;i:10000081;i:35;i:10000058;i:36;i:10000033;i:37;i:10000060;i:38;i:10000037;i:39;i:10000040;i:40;i:10000041;i:41;i:10000008;i:42;i:10000020;i:43;i:10000053;i:44;i:10000067;i:45;i:10000072;i:46;i:10000071;i:47;i:10000030;i:48;i:10000014;i:49;i:10000076;i:50;i:10000046;i:51;i:10000023;i:52;i:10000077;i:53;i:10000018;i:54;i:10000007;i:55;i:10000035;i:56;i:10000082;i:57;i:10000079;i:58;i:10000034;i:59;i:10000011;i:60;i:10000065;i:61;i:10000045;i:62;i:10000026;i:63;i:10000006;i:64;i:10000068;i:65;i:10000047;i:66;i:10000075;i:67;i:10000061;i:68;i:10000021;i:69;i:10000054;i:70;i:10000039;i:71;i:10000029;i:72;i:10000032;i:73;i:10000062;i:74;i:10000059;i:75;i:10000010;i:76;i:10000083;i:77;i:10000050;i:78;i:10000057;i:79;i:10000069;i:80;i:10000056;i:81;i:10000048;i:82;i:10000027;i:83;i:10000074;i:84;i:10000042;}', 'a:85:{i:0;i:10000064;i:1;i:10000084;i:2;i:10000025;i:3;i:10000012;i:4;i:10000015;i:5;i:10000016;i:6;i:10000019;i:7;i:10000001;i:8;i:10000055;i:9;i:10000080;i:10;i:10000002;i:11;i:10000078;i:12;i:10000063;i:13;i:10000049;i:14;i:10000052;i:15;i:10000004;i:16;i:10000022;i:17;i:10000043;i:18;i:10000085;i:19;i:10000073;i:20;i:10000009;i:21;i:10000005;i:22;i:10000051;i:23;i:10000066;i:24;i:10000070;i:25;i:10000038;i:26;i:10000024;i:27;i:10000003;i:28;i:10000031;i:29;i:10000044;i:30;i:10000017;i:31;i:10000013;i:32;i:10000036;i:33;i:10000028;i:34;i:10000081;i:35;i:10000058;i:36;i:10000033;i:37;i:10000060;i:38;i:10000037;i:39;i:10000040;i:40;i:10000041;i:41;i:10000008;i:42;i:10000020;i:43;i:10000053;i:44;i:10000067;i:45;i:10000072;i:46;i:10000071;i:47;i:10000030;i:48;i:10000014;i:49;i:10000076;i:50;i:10000046;i:51;i:10000023;i:52;i:10000077;i:53;i:10000018;i:54;i:10000007;i:55;i:10000035;i:56;i:10000082;i:57;i:10000079;i:58;i:10000034;i:59;i:10000011;i:60;i:10000065;i:61;i:10000045;i:62;i:10000026;i:63;i:10000006;i:64;i:10000068;i:65;i:10000047;i:66;i:10000075;i:67;i:10000061;i:68;i:10000021;i:69;i:10000054;i:70;i:10000039;i:71;i:10000029;i:72;i:10000032;i:73;i:10000062;i:74;i:10000059;i:75;i:10000010;i:76;i:10000083;i:77;i:10000050;i:78;i:10000057;i:79;i:10000069;i:80;i:10000056;i:81;i:10000048;i:82;i:10000027;i:83;i:10000074;i:84;i:10000042;}'),
(10, 10, 1, 20, 'a:20:{i:0;i:10000005;i:1;i:10000002;i:2;i:10000004;i:3;i:10000015;i:4;i:10000018;i:5;i:10000003;i:6;i:10000012;i:7;i:10000007;i:8;i:10000013;i:9;i:10000017;i:10;i:10000008;i:11;i:10000010;i:12;i:10000020;i:13;i:10000014;i:14;i:10000016;i:15;i:10000001;i:16;i:10000009;i:17;i:10000019;i:18;i:10000011;i:19;i:10000006;}', 'a:20:{i:0;i:10000005;i:1;i:10000002;i:2;i:10000004;i:3;i:10000015;i:4;i:10000018;i:5;i:10000003;i:6;i:10000012;i:7;i:10000007;i:8;i:10000013;i:9;i:10000017;i:10;i:10000008;i:11;i:10000010;i:12;i:10000020;i:13;i:10000014;i:14;i:10000016;i:15;i:10000001;i:16;i:10000009;i:17;i:10000019;i:18;i:10000011;i:19;i:10000006;}');

-- --------------------------------------------------------

--
-- 表的结构 `go_shoplist`
--

CREATE TABLE IF NOT EXISTS `go_shoplist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `sid` int(10) unsigned NOT NULL COMMENT '同一个商品',
  `cateid` smallint(6) unsigned DEFAULT NULL COMMENT '所属栏目ID',
  `brandid` smallint(6) unsigned DEFAULT NULL COMMENT '所属品牌ID',
  `title` varchar(100) DEFAULT NULL COMMENT '商品标题',
  `title_style` varchar(100) DEFAULT NULL,
  `title2` varchar(100) DEFAULT NULL COMMENT '副标题',
  `keywords` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '金额',
  `yunjiage` decimal(4,2) unsigned DEFAULT '1.00' COMMENT '云购人次价格',
  `zongrenshu` int(10) unsigned DEFAULT '0' COMMENT '总需人数',
  `canyurenshu` int(10) unsigned DEFAULT '0' COMMENT '已参与人数',
  `shenyurenshu` int(10) unsigned DEFAULT NULL,
  `def_renshu` int(10) unsigned DEFAULT '0',
  `qishu` smallint(6) unsigned DEFAULT '0' COMMENT '期数',
  `maxqishu` smallint(5) unsigned DEFAULT '1' COMMENT ' 最大期数',
  `thumb` varchar(255) DEFAULT NULL,
  `picarr` text COMMENT '商品图片',
  `content` mediumtext COMMENT '商品内容详情',
  `codes_table` char(20) DEFAULT NULL,
  `xsjx_time` int(10) unsigned DEFAULT NULL,
  `pos` tinyint(4) unsigned DEFAULT NULL COMMENT '是否推荐',
  `renqi` tinyint(4) unsigned DEFAULT '0' COMMENT '是否人气商品0否1是',
  `time` int(10) unsigned DEFAULT NULL COMMENT '时间',
  `order` int(10) unsigned DEFAULT '1',
  `q_uid` int(10) unsigned DEFAULT NULL COMMENT '中奖人ID',
  `q_user` text COMMENT '中奖人信息',
  `q_user_code` char(20) DEFAULT NULL COMMENT '中奖码',
  `q_content` mediumtext COMMENT '揭晓内容',
  `q_counttime` char(20) DEFAULT NULL COMMENT '总时间相加',
  `q_end_time` char(20) DEFAULT NULL COMMENT '揭晓时间',
  `q_showtime` char(1) DEFAULT 'N' COMMENT 'Y/N揭晓动画',
  `renqipos` tinyint(4) unsigned DEFAULT '0',
  `newpos` tinyint(4) unsigned DEFAULT NULL,
  `bannershop` tinyint(4) unsigned DEFAULT NULL,
  `posthumb` varchar(255) DEFAULT NULL,
  `quyu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `renqi` (`renqi`),
  KEY `order` (`yunjiage`),
  KEY `q_uid` (`q_uid`),
  KEY `sid` (`sid`),
  KEY `shenyurenshu` (`shenyurenshu`),
  KEY `q_showtime` (`q_showtime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `go_shoplist`
--

INSERT INTO `go_shoplist` (`id`, `sid`, `cateid`, `brandid`, `title`, `title_style`, `title2`, `keywords`, `description`, `money`, `yunjiage`, `zongrenshu`, `canyurenshu`, `shenyurenshu`, `def_renshu`, `qishu`, `maxqishu`, `thumb`, `picarr`, `content`, `codes_table`, `xsjx_time`, `pos`, `renqi`, `time`, `order`, `q_uid`, `q_user`, `q_user_code`, `q_content`, `q_counttime`, `q_end_time`, `q_showtime`, `renqipos`, `newpos`, `bannershop`, `posthumb`, `quyu`) VALUES
(8, 8, 25, 17, '旺旺 旺仔牛奶 原味 礼盒装 125ml*20', '', '（由 京东 发货并提供售后服务）', '牛奶', '请商品获得者于48小时内添加客服QQ：5404630 为好友并提交收货地址', '55.00', '1.00', 55, 0, 55, 0, 1, 100, 'shopimg/20150619/36489660710656.jpg', 'a:0:{}', '<ul style="list-style-type: square;" class=" list-paddingleft-2"><li><p style="margin: 5px 0px;"><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;">请商品获得者于48小时内添加客服QQ：5404630 为好友并提交收货地址</span></p></li></ul><p style="font: 16px/normal sans-serif; margin: 5px 0px; color: rgb(0, 0, 0); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;">&nbsp;</p><p style="font: 16px/normal sans-serif; margin: 5px 0px; color: rgb(0, 0, 0); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;"><span style="margin: 0px; padding: 12px 0px 0px 2px; color: rgb(201, 0, 20); line-height: 25px; font-family: 微软雅黑; font-size: 18px; float: left;">产品信息</span><span style="margin: 0px; padding: 16px 0px 0px 10px; line-height: 25px; font-family: 微软雅黑; font-size: 12px; float: left;" class="s2">Product Information</span></p><table style="font: 12px/18px Arial, Verdana, 宋体; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; empty-cells: show; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;" border="0" cellspacing="6" cellpadding="0" width="750" align="center"><tbody><tr><td><img style="margin: 0px; padding: 0px; vertical-align: middle;" src="http://img20.360buyimg.com/vc/jfs/t931/78/183190/62366/eb04d7c1/54d89122N3dadfe84.jpg" data-lazyload="done"/></td><td><p style="margin: 0px; padding: 0px; line-height: 25px; font-size: 14px; font-weight: 700;" class="formwork_titleleft">　商品名称：旺旺 旺仔牛奶 (原味礼盒装) 125ml*20</p><p style="margin: 0px; padding: 0px; line-height: 25px; font-size: 14px;" class="formwork_titleleft2">　商品产地：中国大陆 　保质期限：9个月 　商品规格：每罐125毫升、共20包 　储存方式：存放于干燥阴凉处、避免阳光直射 　配料：复原乳（82%）（水、全脂乳粉、炼乳）、水、白砂糖、食品添加剂（蔗糖脂肪酸脂、单硬脂酸甘油酯）、食用香精</p></td></tr></tbody></table><p><br class="Apple-interchange-newline"/>&nbsp;</p><style>%23J8F5760bgjSTips%20%7B%20position%3A%20absolute%3B%20left%3A%209999999999em%3B%20z-index%3A999999999%3Bwidth%3A56px%3B%20height%3A24px%7D%20%26nbsp%3B%20%23J8F5760bgjSTips%20a%20%7B%20background%3A%20url(http%3A%2F%2Fmat1.gtimg.com%2Fwww%2Fsogou%2Fsogou_tips_v1.png)%20no-repeat%200%200%3B%20display%3A%20block%3B%20width%3A%20auto%3B%20height%3A%2024px%3B%20line-height%3A%2024px%3B%20padding-left%3A%2023px%3B%20color%3A%20%23000%3B%20font-size%3A%2012px%3B%20text-decoration%3A%20none%3B%20_position%3Arelative%3B%20margin%3A%20-32px%200%200%3B%20%7D%20%26nbsp%3B%20%23J8F5760bgjSTips%20a%3Ahover%20%7B%20color%3A%2345a1ea%3B%20background-position%3A%200%20-34px%20%7D</style><p><a href="http://www.sogou.com/tx?pid=sogou-clse-250dd56814ad7c50&amp;ie=utf8&amp;query=%E6%AC%A2%E8%BF%8E%E4%BD%BF%E7%94%A8%E4%BA%91%E8%B4%AD%E7%B3%BB%E7%BB%9F!" target="_blank" query="%E6%AC%A2%E8%BF%8E%E4%BD%BF%E7%94%A8%E4%BA%91%E8%B4%AD%E7%B3%BB%E7%BB%9F!">搜索</a></p>', 'shopcodes_1', 0, 1, 1, 1434710686, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 0, 0, 0, 'photo/goods.jpg', 0),
(3, 3, 17, 3, '苹果（Apple）iPhone 6 A1586 16G版 4G手机', '', '4.7 英寸LED 背光宽，Retina HD 高清显示屏，Multi-Touch 显示屏，具有 IPS 技术 ，133', 'iPhone', '', '5288.00', '10.00', 529, 0, 529, 0, 1, 100, 'shopimg/20150619/25892079709302.png', 'a:0:{}', '<p style="padding: 30px 0px 0px; text-align: center; line-height: 65px; letter-spacing: 2px; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif; font-size: 60px; margin-top: 0px; margin-bottom: 0px; background-color: rgb(255, 255, 255);"><span style="margin: 0px; padding: 0px; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;">请商品获得者于48小时内添加客服QQ：5404630 为好友并提交收货地址</span></p><p style="padding: 30px 0px 0px; line-height: 65px; letter-spacing: 2px; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif; font-size: 60px; margin-top: 0px; margin-bottom: 0px; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="margin: 0px; padding: 0px; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;"></span>iPhone6</p><p style="padding: 0px; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif; font-size: 12px; margin-top: 0px; margin-bottom: 0px; background-color: rgb(255, 255, 255);">&nbsp;</p><p style="padding: 20px 0px 0px; text-align: center; color: rgb(51, 51, 51); line-height: 38px; letter-spacing: 5px; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif; font-size: 38px; margin-top: 0px; margin-bottom: 0px; background-color: rgb(255, 255, 255);">比更大还更大</p><p style="padding: 0px; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif; font-size: 12px; margin-top: 0px; margin-bottom: 0px; background-color: rgb(255, 255, 255);">&nbsp;</p><p style="padding: 20px 20px 0px; text-align: center; line-height: 28px; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif; font-size: 12px; margin-top: 0px; margin-bottom: 0px; background-color: rgb(255, 255, 255);">iPhone 6 之大，不只是简简单单地放大，而是方方面面都大有提升。<br style="margin: 0px; padding: 0px;"/>它尺寸更大，却纤薄得不可思议；性能更强，却效能非凡。光滑圆润的金属机身，<br style="margin: 0px; padding: 0px;"/>与全新 Retina HD 高清显示屏精准契合，浑然一体。而软硬件间的搭配，更是默契得宛如天作之合。<br style="margin: 0px; padding: 0px;"/>无论以何种尺度衡量，这一切，都让 iPhone 新一代的至大之作，成为至为出众之作。</p><p style="padding: 10px 0px; text-align: center; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif; font-size: 12px; margin-top: 0px; margin-bottom: 0px; background-color: rgb(255, 255, 255);"><img style="margin: 0px; padding: 0px; border: 0px currentColor;" src="http://goodsimg.1yyg.com/GoodsInfo/20140910143950500.jpg"/><br/></p>', 'shopcodes_1', 0, 1, 1, 1434709308, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 0, 0, 0, 'photo/goods.jpg', 0),
(11, 11, 5, 6, '小米&nbsp;红米2A&nbsp;白色&nbsp;移动4G手机&nbsp;双卡双待', '', '（由&nbsp;京东&nbsp;发货并提供售后服务）', '', '', '599.00', '1.00', 599, 0, 599, 0, 1, 100, 'shopimg/20150619/64816526711891.jpg', 'a:0:{}', '<p><span style="margin: 0px; padding: 0px; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;">请商品获得者于48小时内添加客服QQ：5404630 为好友并提交收货地址</span></p><p>&nbsp;</p><p><img title="55750d7eN513a34b4.jpg" src="http://test.yungou6.com/statics/uploads/shopimg/20150619/83606925711919.jpg"/></p>', 'shopcodes_1', 0, 1, 1, 1434711930, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 0, 0, 0, '', 0),
(12, 5, 23, 14, 'Q币充值-10', '', '请商品获得者24小时内添加客服QQ：5404630 发送充值账号', '充值', '本商品为虚拟商品，腾讯Q币充值面值10，请商品获得者24小时内添加客服QQ：5404630 发送充值账号', '12.00', '1.00', 12, 0, 12, 0, 2, 100, 'shopimg/20150619/66631848709821.jpg', 'a:0:{}', '<ul style="list-style-type: square;" class=" list-paddingleft-2"><li><p style="margin: 5px 0px;"><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;">本商品为虚拟商品，腾讯Q币充值面值10</span></p></li></ul><p style="font: 16px/normal sans-serif; margin: 5px 0px; color: rgb(0, 0, 0); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;"><br/></p><ul style="list-style-type: square;" class=" list-paddingleft-2"><li><p style="margin: 5px 0px;"><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;">请商品获得者24小时内添加客服QQ：5404630 发送充值账号</span></p></li></ul><p></p>', 'shopcodes_1', 0, 1, 1, 1434712744, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 0, 0, 0, '', 0),
(5, 5, 23, 14, 'Q币充值-10', '', '请商品获得者24小时内添加客服QQ：5404630 发送充值账号', '充值', '本商品为虚拟商品，腾讯Q币充值面值10，请商品获得者24小时内添加客服QQ：5404630 发送充值账号', '12.00', '1.00', 12, 12, 0, 0, 1, 100, 'shopimg/20150619/66631848709821.jpg', 'a:0:{}', '<ul style="list-style-type: square;" class=" list-paddingleft-2"><li><p style="margin: 5px 0px;"><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;">本商品为虚拟商品，腾讯Q币充值面值10</span></p></li></ul><p style="font: 16px/normal sans-serif; margin: 5px 0px; color: rgb(0, 0, 0); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;"><br/></p><ul style="list-style-type: square;" class=" list-paddingleft-2"><li><p style="margin: 5px 0px;"><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;">请商品获得者24小时内添加客服QQ：5404630 发送充值账号</span></p></li></ul><p></p>', 'shopcodes_1', 0, 1, 1, 1434709865, 1, 12, 'a:5:{s:3:"uid";s:2:"12";s:8:"username";s:5:"admin";s:5:"email";s:0:"";s:6:"mobile";s:11:"18672393060";s:3:"img";s:16:"photo/member.jpg";}', '10000005', '', '', '1434712922.597', 'N', 0, 0, 0, '', 0),
(6, 6, 23, 14, '腾讯QQ超级会员-1个月', '', '本商品为虚拟商品，腾讯QQ超级会员一个月，请商品获得者24小时内添加客服QQ：5404630 发送充值账号', '充值', '腾讯QQ超级会员一个月', '25.00', '1.00', 25, 0, 25, 0, 1, 100, 'shopimg/20150619/13678839709987.jpg', 'a:0:{}', '<ul style="list-style-type: square;" class=" list-paddingleft-2"><li><p style="margin: 5px 0px;"><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;">本商品为虚拟商品，腾讯QQ超级会员一个月</span></p><p style="margin: 5px 0px;"><br/></p></li><li><p style="margin: 5px 0px;"><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;">请商品获得者24小时内添加客服QQ：5404630 &nbsp;发送充值账号</span></p></li></ul><p></p>', 'shopcodes_1', 0, 1, 1, 1434710025, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 0, 0, 0, '', 0),
(7, 7, 24, 15, '移动/联通/电信 话费充值-50元', '', '本商品为虚拟商品，请商品获得者24小时内添加客服QQ：5404630 提交充值手机号', '充值', '本商品为虚拟商品，请商品获得者24小时内添加客服QQ：5404630 提交充值手机号', '58.00', '1.00', 58, 0, 58, 0, 1, 100, 'shopimg/20150619/42731643710496.jpg', 'a:1:{i:0;s:35:"shopimg/20150619/70817262710174.jpg";}', '<ul style="list-style-type: square;" class=" list-paddingleft-2"><li><p style="margin: 5px 0px;"><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;">本商品为虚拟商品</span><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;"><br/></span></p></li><li><p style="margin: 5px 0px;"><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;">请商品获得者24小时内添加客服QQ：5404630 提交充值手机号</span></p></li></ul><p>&nbsp;</p>', 'shopcodes_1', 0, 1, 1, 1434710221, 3, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 0, 0, 0, 'photo/goods.jpg', 0),
(9, 9, 26, 18, '加多宝&nbsp;凉茶310ml*20罐&nbsp;整箱', '', '（由&nbsp;京东&nbsp;发货并提供售后服务）', '加多宝', '', '85.00', '1.00', 85, 0, 85, 0, 1, 100, 'shopimg/20150619/31454959710837.jpg', 'a:0:{}', '<ul style="list-style-type: square;" class=" list-paddingleft-2"><li><p style="margin: 0px; padding: 0px;"><span style="margin: 0px; padding: 0px; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;">请商品获得者于48小时内添加客服QQ：5404630 为好友并提交收货地址</span><br/></p></li></ul><p style="font: 16px/normal sans-serif; margin: 5px 0px; color: rgb(0, 0, 0); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;"><img src="http://img20.360buyimg.com/vc/jfs/t1159/199/649781383/423225/1b25275b/55373ed0N524d5320.jpg"/></p><p></p>', 'shopcodes_1', 0, 1, 1, 1434710866, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 0, 0, 0, '', 0),
(10, 10, 27, 19, '包邮！丹麦进口&nbsp;Kjeldsens&nbsp;蓝罐&nbsp;朱古力&nbsp;曲奇&nbsp;125g&nbsp;盒装', '', '（由&nbsp;京东&nbsp;发货并提供售后服务）', '曲奇', '', '20.00', '1.00', 20, 0, 20, 0, 1, 100, 'shopimg/20150619/47653506711405.jpg', 'a:0:{}', '<p><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;">请商品获得者于48小时内添加客服QQ：5404630 为好友并提交收货地址</span></p><p><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;"></span>&nbsp;</p><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;"><p><span style="font: 18px/25px 微软雅黑; margin: 0px; padding: 12px 0px 0px 2px; text-align: left; color: rgb(201, 0, 20); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; float: left; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;">产品信息</span><span style="font: 12px/25px 微软雅黑; margin: 0px; padding: 16px 0px 0px 10px; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; float: left; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;" class="s2">Product Information</span></p></span><span style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; float: none; display: inline !important; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;"></span><p><span style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; float: none; display: inline !important; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;">Kjeldsens丹麦蓝罐朱古力曲奇</span><br style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;"/><br style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;"/><span style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; float: none; display: inline !important; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;">配料：面粉、牛油、白砂糖、椰蓉、巧克力、食盐、膨松剂（碳酸氢胺）、香草。</span><br style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;"/><span style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; float: none; display: inline !important; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;">净含量：125g&nbsp;</span><br style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;"/><span style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; float: none; display: inline !important; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;">食用方法：开装即食&nbsp;<span class="Apple-converted-space">&nbsp;</span></span><br style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;"/><span style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; float: none; display: inline !important; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;">保质期：18个月</span><br style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;"/><span style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; float: none; display: inline !important; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;">保存方法：阴凉干燥处保存</span></p><p><span style="font: bold 14px/25px Arial, Helvetica, sans-serif; text-align: left; color: rgb(102, 102, 102); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; float: none; display: inline !important; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: rgb(255, 255, 255); -webkit-text-stroke-width: 0px;"></span><br/><img alt="" src="http://img30.360buyimg.com/jgsq-productsoa/g2/M05/00/16/rBEGEU-XrkgIAAAAAAETMDz5WcoAAAI0AEFy_EAARNI616.jpg" data-lazyload="done"/><br/></p><p><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 20px;"></span>&nbsp;</p>', 'shopcodes_1', 0, 1, 1, 1434711441, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `go_shoplist_del`
--

CREATE TABLE IF NOT EXISTS `go_shoplist_del` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sid` int(10) NOT NULL COMMENT '同一个商品',
  `cateid` smallint(6) unsigned DEFAULT NULL,
  `brandid` smallint(6) unsigned DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `title_style` varchar(100) DEFAULT NULL,
  `title2` varchar(100) DEFAULT NULL,
  `keywords` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `money` decimal(10,2) DEFAULT '0.00',
  `yunjiage` decimal(4,2) unsigned DEFAULT '1.00',
  `zongrenshu` int(10) unsigned DEFAULT '0',
  `canyurenshu` int(10) unsigned DEFAULT '0',
  `shenyurenshu` int(10) unsigned DEFAULT NULL,
  `def_renshu` int(10) unsigned DEFAULT '0',
  `qishu` smallint(6) unsigned DEFAULT '0',
  `maxqishu` smallint(5) unsigned DEFAULT '1',
  `thumb` varchar(255) DEFAULT NULL,
  `picarr` text,
  `content` mediumtext,
  `codes_table` char(20) DEFAULT NULL,
  `xsjx_time` int(10) unsigned DEFAULT NULL,
  `pos` tinyint(4) unsigned DEFAULT NULL,
  `renqi` tinyint(4) unsigned DEFAULT '0',
  `time` int(10) unsigned DEFAULT NULL,
  `order` int(10) unsigned DEFAULT '1',
  `q_uid` int(10) unsigned DEFAULT NULL,
  `q_user` text COMMENT '中奖人信息',
  `q_user_code` char(20) DEFAULT NULL,
  `q_content` mediumtext,
  `q_counttime` char(20) DEFAULT NULL,
  `q_end_time` char(20) DEFAULT NULL,
  `q_showtime` char(1) DEFAULT 'N' COMMENT 'Y/N揭晓动画',
  PRIMARY KEY (`id`),
  KEY `renqi` (`renqi`),
  KEY `order` (`yunjiage`),
  KEY `q_uid` (`q_uid`),
  KEY `sid` (`sid`),
  KEY `shenyurenshu` (`shenyurenshu`),
  KEY `q_showtime` (`q_showtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_slide`
--

CREATE TABLE IF NOT EXISTS `go_slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(50) DEFAULT NULL COMMENT '幻灯片',
  `title` varchar(30) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `img` (`img`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='幻灯片表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `go_slide`
--

INSERT INTO `go_slide` (`id`, `img`, `title`, `link`) VALUES
(1, 'banner/20150619/74292991703365.jpg', '', ''),
(3, 'banner/20150619/11352608703710.jpg', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `go_template`
--

CREATE TABLE IF NOT EXISTS `go_template` (
  `template_name` char(25) NOT NULL,
  `template` char(25) NOT NULL,
  `des` varchar(100) DEFAULT NULL,
  KEY `template` (`template`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `go_template`
--

INSERT INTO `go_template` (`template_name`, `template`, `des`) VALUES
('cart.cartlist.html', 'yungou', '购物车列表'),
('cart.pay.html', 'yungou', '购物车付款'),
('cart.paysuccess.html', 'yungou', '购物车支付成功页面'),
('group.index.html', 'yungou', '圈子首页'),
('group.list.html', 'yungou', '圈子列表页'),
('group.nei.html', 'yungou', '圈子内容'),
('group.right.html', 'yungou', '圈子右边'),
('help.help.html', 'yungou', '帮助页面'),
('index.autolottery.html', 'yungou', '限时揭晓'),
('index.buyrecord.html', 'yungou', '云购记录'),
('index.buyrecordbai.html', 'yungou', '最新云购记录'),
('index.dataserver.html', 'yungou', '已揭晓商品'),
('index.detail.html', 'yungou', '晒单详情'),
('index.footer.html', 'yungou', '底部'),
('index.glist.html', 'yungou', '所有商品'),
('index.header.html', 'yungou', '头部'),
('index.index.html', 'yungou', '首页'),
('index.item.html', 'yungou', '商品展示页'),
('index.lottery.html', 'yungou', '最新揭晓'),
('index.shaidan.html', 'yungou', '晒单页面'),
('link.link.html', 'yungou', '友情链接'),
('member.address.html', 'yungou', '会员地址添加'),
('member.cashout.html', 'yungou', '提现申请'),
('member.commissions.html', 'yungou', '佣金明细'),
('member.index.html', 'yungou', '会员首页'),
('member.invitefriends.html', 'yungou', '邀请好友'),
('member.joingroup.html', 'yungou', '加入的圈子'),
('member.left.html', 'yungou', '会员中心左边页面'),
('member.mailchecking.html', 'yungou', '邮箱认证'),
('member.mobilechecking.htm', 'yungou', '手机认证'),
('member.mobilesuccess.html', 'yungou', '手机认证成功'),
('member.modify.html', 'yungou', '会员'),
('member.orderlist.html', 'yungou', '会员资料'),
('member.password.html', 'yungou', '会员修改密码'),
('member.photo.html', 'yungou', '会员修改头像'),
('member.qqclock.html', 'yungou', '会员QQ绑定'),
('member.record.html', 'yungou', '提现记录'),
('member.sendsuccess.html', 'yungou', '邮箱验证发送'),
('member.sendsuccess2.html', 'yungou', '邮箱验证发送2'),
('member.shezhi.html', 'yungou', '资料选项卡'),
('member.singleinsert.html', 'yungou', '会员添加晒单'),
('member.singlelist.html', 'yungou', '会员晒单'),
('member.singleupdate.html', 'yungou', '晒单修改'),
('member.topic.html', 'yungou', '圈子话题'),
('member.userbalance.html', 'yungou', '账户明细'),
('member.userbuydetail.html', 'yungou', '云购记录'),
('member.userbuylist.html', 'yungou', '云购记录'),
('member.userfufen.html', 'yungou', '会员福分'),
('member.userrecharge.html', 'yungou', '账户充值'),
('search.search.html', 'yungou', '搜索'),
('single_web.business.html', 'yungou', '单页_合作专区'),
('single_web.fund.html', 'yungou', '单页_云购基金'),
('single_web.newbie.html', 'yungou', '单页_新手指南'),
('single_web.pleasereg.html', 'yungou', '单页_邀请'),
('single_web.qqgroup.html', 'yungou', '单页_QQ'),
('system.message.html', 'yungou', '系统消息提示'),
('us.index.html', 'yungou', '个人主页'),
('us.left.html', 'yungou', '个人主页左边'),
('us.tab.html', 'yungou', '个人主页选项'),
('us.userbuy.html', 'yungou', '个人主页云购记录'),
('us.userpost.html', 'yungou', '个人主页云购记录'),
('us.userraffle.html', 'yungou', '个人主页云购记录'),
('user.emailcheck.html', 'yungou', '邮箱验证'),
('user.emailok.html', 'yungou', '邮箱验证成功'),
('user.findemailcheck.html', 'yungou', '找回密码'),
('user.finderror.html', 'yungou', '邮箱验证已过期'),
('user.findmobilecheck.html', 'yungou', '手机验证'),
('user.findok.html', 'yungou', '手机验证成功'),
('user.findpassword.html', 'yungou', '重置密码'),
('user.login.html', 'yungou', '会员登录'),
('user.mobilecheck.html', 'yungou', '手机验证'),
('user.register.html', 'yungou', '会员注册'),
('vote.show.html', 'yungou', '投票内容页'),
('vote.show_total.html', 'yungou', '投票列表'),
('vote.vote.html', 'yungou', '投票主页');

-- --------------------------------------------------------

--
-- 表的结构 `go_vote_activer`
--

CREATE TABLE IF NOT EXISTS `go_vote_activer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `vote_id` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `ip` char(20) DEFAULT NULL,
  `subtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_vote_option`
--

CREATE TABLE IF NOT EXISTS `go_vote_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_id` int(11) DEFAULT NULL,
  `option_title` varchar(100) DEFAULT NULL,
  `option_number` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_vote_subject`
--

CREATE TABLE IF NOT EXISTS `go_vote_subject` (
  `vote_id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_title` varchar(100) DEFAULT NULL,
  `vote_starttime` int(11) DEFAULT NULL,
  `vote_endtime` int(11) DEFAULT NULL,
  `vote_sendtime` int(11) DEFAULT NULL,
  `vote_description` text,
  `vote_allowview` tinyint(1) DEFAULT NULL,
  `vote_allowguest` tinyint(1) DEFAULT NULL,
  `vote_interval` int(11) DEFAULT '0',
  `vote_enabled` tinyint(1) DEFAULT NULL,
  `vote_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`vote_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `go_wap`
--

CREATE TABLE IF NOT EXISTS `go_wap` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `color` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `go_wap`
--

INSERT INTO `go_wap` (`id`, `img`, `title`, `link`, `color`) VALUES
(1, 'banner/20140715/46594684432883.jpg', '小米平板', '', '#CCCCCC');

-- --------------------------------------------------------

--
-- 表的结构 `ke_order`
--

CREATE TABLE IF NOT EXISTS `ke_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `out_trade_no` char(30) NOT NULL,
  `statu` tinyint(1) NOT NULL,
  `mktime` char(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
