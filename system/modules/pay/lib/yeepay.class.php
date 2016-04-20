<?php 

class yeepay {
 
	private $config;
	/**
	*	支付入口
	**/
	
	public function config($config=null){
			$this->config = $config;
	}
	
	public function send_pay(){
			$config = $this->config;
			$p1_MerId		= $config['id']; //"10001126856";												
			$merchantKey	= $config['key']; //"69cl522AV6q613Ii4W6u8K6XuW8vM1N6bFgyv769220IuYe9u37N4y7rI4Pl";
			$logName		= $config['error_log'] = "YeePay_HTML.log";
			
			$reqURL_onLine = "https://www.yeepay.com/app-merchant-proxy/node";				 //产品通用接口请求地址

			$p0_Cmd = "Buy";	//支付请求，固定值"Buy" .
			$p9_SAF = "0";		//送货地址,默认为0
			
			//	商家设置用户购买商品的支付信息.
			//易宝支付平台统一使用GBK/GB2312编码方式,参数如用到中文，请注意转码

			//	商户订单号,选填.
			//若不为""，提交的订单号必须在自身账户交易中唯一;为""时，易宝支付会自动生成随机的商户订单号.
			$p2_Order					=	$config['code'];

			//	支付金额,必填.
			//单位:元，精确到分.
			$p3_Amt						=   $config['money'];

			//	交易币种,固定值"CNY".
			$p4_Cur						= "CNY";

			//	商品名称
			//用于支付时显示在易宝支付网关左侧的订单产品信息.
			$p5_Pid						= 	htmlspecialchars(trim($config['title']));//iconv("UTF-8","GBK","你妹xxxx")
		
			//	商品种类
			$p6_Pcat					= '';

			//	商品描述
			$p7_Pdesc					= '';

			//	商户接收支付成功数据的地址,支付成功后易宝支付会向该地址发送两次成功通知.
			$p8_Url						= 	$config['NotifyUrl'];

			//	商户扩展信息
			//商户可以任意填写1K 的字符串,支付成功时将原样返回.												
			$pa_MP						= '';

			//	支付通道编码
			//默认为""，到易宝支付网关.若不需显示易宝支付的页面，直接跳转到各银行、神州行支付、骏网一卡通等支付页面，该字段可依照附录:银行列表设置参数值.			
			
			if($config['pay_bank'] == 'DEFAULT'){
				$pd_FrpId = '';
			}else{
				$pd_FrpId = $config['pay_bank'];
			}
			//	应答机制
			//默认为"1": 需要应答机制;
			$pr_NeedResponse	= "1";

			//调用签名函数生成签名串
			
			iconv_set_encoding("internal_encoding", "UTF-8");
			iconv_set_encoding("output_encoding", "GBK");
			// 开始缓存
			ob_start("ob_iconv_handler");
		
			include dirname(__FILE__).'/yeepay/yeepayCommon.class.php';
			
			$yeepayCommon = new yeepayCommon();
			$yeepayCommon->config = $config;			
			$hmac = $yeepayCommon->getReqHmacString($p2_Order,$p3_Amt,$p4_Cur,$p5_Pid,$p6_Pcat,$p7_Pdesc,$p8_Url,$pa_MP,$pd_FrpId,$pr_NeedResponse);			
			include dirname(__FILE__).'/yeepay/yeepay_send.tpl.php';

			ob_end_flush();
			exit;
	
	}

 }

?>