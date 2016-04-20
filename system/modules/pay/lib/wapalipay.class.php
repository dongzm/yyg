<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('PRC');
include dirname(__FILE__).DIRECTORY_SEPARATOR."wapalipay".DIRECTORY_SEPARATOR."alipay_submit.class.php";

class wapalipay {



	private $config;

	private $url;

	//主入口

	public function config($config=null){

		$format = "xml";

		$req_id = date('Ymdhis');

		$merchant_url = "";

        $notify_url = $config['NotifyUrl'];

        $return_url = $config['ReturnUrl'];

        $seller_email = $config['pay_type_data']['user']['val'];

        $out_trade_no = $config['code'];

        $subject = $config['title'];

        $total_fee = $config['money'];

		$wapalipay_config_id = trim($config['id']);

		$wapalipay_config_key = trim($config['key']);

		$wapalipay_config_input_charset = strtolower('utf-8');

		$wapalipay_config_sign_type = strtoupper('MD5');

		$wapalipay_config_input_charset = strtolower('utf-8');

		$wapalipay_config_cacert =  dirname(__FILE__).DIRECTORY_SEPARATOR."wapalipay".DIRECTORY_SEPARATOR."cacert.pem";

		$wapalipay_config_private_key_path = '.'.DIRECTORY_SEPARATOR.'wapalipay'.DIRECTORY_SEPARATOR.'rsa_private_key.pem';

		$wapalipay_config_ali_public_key_path = '.'.DIRECTORY_SEPARATOR.'wapalipay'.DIRECTORY_SEPARATOR.'alipay_public_key.pem';

		$wapalipay_config_transport   = 'http';

		$wapalipay_config=array(

			"partner"      =>$wapalipay_config_id,

			"key"          =>$wapalipay_config_key,

			"private_key_path" =>$wapalipay_config_private_key_path,

			"ali_public_key_path" =>$wapalipay_config_ali_public_key_path,

			"sign_type"    =>$wapalipay_config_sign_type,

			"input_charset"=>$wapalipay_config_input_charset,

			"cacert"       =>$wapalipay_config_cacert,

			"transport"    =>$wapalipay_config_transport

		);



		$req_data = '<direct_trade_create_req><notify_url>' . $notify_url . '</notify_url><call_back_url>' . $return_url . '</call_back_url><seller_account_name>' . $seller_email . '</seller_account_name><out_trade_no>' . $out_trade_no . '</out_trade_no><subject>' . $subject . '</subject><total_fee>' . $total_fee . '</total_fee><merchant_url>' . $merchant_url . '</merchant_url></direct_trade_create_req>';

		$para_token = array(

				"service" => "alipay.wap.trade.create.direct",

				"partner" => trim($config['id']),

				"sec_id" => $wapalipay_config_sign_type,

				"format"	=> $format,

				"v"	=> "2.0",

				"req_id"	=> $req_id,

				"req_data"	=> $req_data,

				"_input_charset"	=> $wapalipay_config_input_charset

		);

		$wapalipaySubmit = new AlipaySubmit($wapalipay_config);

		$html_text = $wapalipaySubmit->buildRequestHttp($para_token);

		$html_text = urldecode($html_text);

		$para_html_text = $wapalipaySubmit->parseResponse($html_text);

		$request_token = $para_html_text['request_token'];

		$req_data = '<auth_and_execute_req><request_token>' . $request_token . '</request_token></auth_and_execute_req>';

		$parameter = array(

				"service" => "alipay.wap.auth.authAndExecute",

				"partner" => trim($config['id']),

				"sec_id" => $wapalipay_config_sign_type,

				"format"	=> $format,

				"v"	=> "2.0",

				"req_id"	=> $req_id,

				"req_data"	=> $req_data,

				"_input_charset"	=> $wapalipay_config_input_charset

		);

		$wapalipaySubmit = new AlipaySubmit($wapalipay_config);

		$this->url = $wapalipaySubmit->buildRequestForm($parameter, 'get', '确认');

	}



	//发送

	public function send_pay(){

		 echo  $this->url;

		 exit;

		//header("Location: $url");

	}

}



?>

