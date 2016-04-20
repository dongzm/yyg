<?php 

class wxpay {
	
	private $config;
	private $url;
	//主入口
	public function config($config=null){
	include_once dirname(__FILE__)."/wxpay/WxPayPubHelper.php";//引入文件需求
		/*echo "<pre/>";
		print_r($config);exit;*/


        $config['pay_type_data']['id']['val']=WxPayConf_pub::$APPID;
        $config['pay_type_data']['user']['val']=WxPayConf_pub::$MCHID;
        $config['pay_type_data']['key']['val']=WxPayConf_pub::$KEY;
        $config['NotifyUrl']=WxPayConf_pub::$NOTIFY_URL;
        $this->config=$config;
        /*
		WxPayConf_pub::$APPID=$config['pay_type_data']['id']['val'];
		WxPayConf_pub::$MCHID=$config['pay_type_data']['user']['val'];
		WxPayConf_pub::$KEY=$config['pay_type_data']['key']['val'];
		WxPayConf_pub::$NOTIFY_URL=$config['NotifyUrl'];
        */
		if($config['type'] == 1){
			$this->config_jsdz();
		}
		if($config['type'] == 2){
			$this->config_dbjy();
		}
		
	}
	
	//及时到账
	private function config_jsdz(){
		$config = $this->config;    
		$unifiedOrder = new UnifiedOrder_pub();
			//设置统一支付接口参数
			//设置必填参数
			//appid已填,商户无需重复填写
			//mch_id已填,商户无需重复填写
			//noncestr已填,商户无需重复填写
			//spbill_create_ip已填,商户无需重复填写
			//sign已填,商户无需重复填写
			$unifiedOrder->setParameter("body","云购商品");//商品描述
			//自定义订单号，此处仅作举例
			$total_fee=$config['money']*100;
			$out_trade_no=$config['code'];
			//$total_fee=1;
			$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
			$unifiedOrder->setParameter("total_fee",$total_fee);//总金额
			$unifiedOrder->setParameter("notify_url",WxPayConf_pub::$NOTIFY_URL);//通知地址 
			$unifiedOrder->setParameter("trade_type","NATIVE");//交易类型
			//非必填参数，商户可根据实际情况选填
			//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号  
			//$unifiedOrder->setParameter("device_info","XXXX");//设备号 
			//$unifiedOrder->setParameter("attach","XXXX");//附加数据 
			//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
			//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
			//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
			//$unifiedOrder->setParameter("openid","XXXX");//用户标识
			//$unifiedOrder->setParameter("product_id","XXXX");//商品ID
			
			//获取统一支付接口结果
			$unifiedOrderResult = $unifiedOrder->getResult();
            //print_r($unifiedOrderResult);
            //exit;
			//商户根据实际情况设置相应的处理流程
			if ($unifiedOrderResult["return_code"] == "FAIL") 
			{
				//商户自行增加处理流程
				echo "通信出错：".$unifiedOrderResult['return_msg']."<br>";
			}
			elseif($unifiedOrderResult["result_code"] == "FAIL")
			{
				//商户自行增加处理流程
				echo "错误代码：".$unifiedOrderResult['err_code']."<br>";
				echo "错误代码描述：".$unifiedOrderResult['err_code_des']."<br>";
			}
			elseif($unifiedOrderResult["code_url"] != NULL)
			{
			
				//从统一支付接口获取到code_url
				 $code_url = $unifiedOrderResult["code_url"];
                $this->url=$code_url;
                //echo 'xx';
                 //header("location:".$code_url);
                //echo $code_url;
				// print_r($config);
				// print_r($unifiedOrderResult);exit;
				 include('native_dynamic_qrcode.php');
				//商户自行增加处理流程
				//......
			}
			
	}
	
	//担保交易
	private function config_dbjy(){				
	}
	
	//发送
	public function send_pay(){
        //echo 'aaa';
		 echo  $this->url;
		 //exit;
		//header("Location:".$this->url);
	}
}

?>
