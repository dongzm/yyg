<?php
class wxpay_web {

	private $config;

	public function config($config=null){
		if ( empty($_SERVER['HTTP_USER_AGENT']) || strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') === false && strpos($_SERVER['HTTP_USER_AGENT'],'Windows Phone') === false ) {
			header('Location: '.WEB_PATH.'/pay/wxpay_web_url/payinfo/nowechat');
			die;
		}

		include_once dirname(__FILE__)."/wxpay/WxPayPubHelper.php";

		if ( !$config ) {
			$pay = $this->db->GetOne("SELECT * from `@#_pay` where `pay_class` = 'wxpay_web'");
			$config = array();
			$config['pay_type_data'] = unserialize($pay['pay_key']);
		}

		WxPayConf_pub::$APPID = $config['pay_type_data']['APPID']['val'];
		WxPayConf_pub::$MCHID = $config['pay_type_data']['MCHID']['val'];
		WxPayConf_pub::$KEY = $config['pay_type_data']['KEY']['val'];
		WxPayConf_pub::$APPSECRET = $config['pay_type_data']['APPSECRET']['val'];

		$jsApi = new JsApi_pub();

		if (!isset($_GET['code'])){
			$url = G_WEB_PATH.'/index.php/pay/wxpay_web_url/?money='.$config['money'].'&out_trade_no='.$config['code'];
			$url = $jsApi->createOauthUrlForCode(urlencode($url));
			header("Location: $url");
			die;
		}else{
			die('444');
			var_dump($pay);var_dump($config);die;

			$jsApi->setCode($_GET['code']);
			$openid = $jsApi->getOpenId();
		}
//		var_dump($_GET);
//		echo $openid;die;

		WxPayConf_pub::$SSLCERT_PATH = dirname(__FILE__).'/cacert/apiclient_cert.pem';
		WxPayConf_pub::$SSLKEY_PATH = dirname(__FILE__).'/cacert/apiclient_key.pem';

		//=========步骤2：使用统一支付接口，获取prepay_id============
		//使用统一支付接口
		$unifiedOrder = new UnifiedOrder_pub();

		//设置统一支付接口参数
		//设置必填参数
		//appid已填,商户无需重复填写
		//mch_id已填,商户无需重复填写
		//noncestr已填,商户无需重复填写
		//spbill_create_ip已填,商户无需重复填写
		//sign已填,商户无需重复填写
		$unifiedOrder->setParameter("openid",$openid);
		$unifiedOrder->setParameter("body","购买商品");//商品描述
		$unifiedOrder->setParameter("out_trade_no",$config['code']);//商户订单号
		$unifiedOrder->setParameter("total_fee",$config['money']*100);//总金额
		$unifiedOrder->setParameter("notify_url",$config['NotifyUrl']);//通知地址
		$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型


		$prepay_id = $unifiedOrder->getPrepayId();
		//=========步骤3：使用jsapi调起支付============
		$jsApi->setPrepayId($prepay_id);

		$jsApiParameters = $jsApi->getParameters();

		include('wxpay_web.html.php');
	}

	public function send_pay(){


	}
}
