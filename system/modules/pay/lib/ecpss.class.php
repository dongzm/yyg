<?php 

class ecpss {
 
	private $config;
	/**
	*	支付入口
	**/
	
	public function config($config=null){
			$this->config = $config;
	}
	
	public function send_pay(){
			$config = $this->config;
			$logName = $config['error_log'] = "ecpss.log";
			$MD5key = $config['key'];		//MD5私钥
			$MerNo = $config['id'];					//商户号
			$BillNo = $config['code'];		//[必填]订单号(商户自己产生：要求不重复)
			$Amount = $config['money'];				//[必填]订单金额
			$ReturnURL = "http://".$_SERVER['HTTP_HOST']."/index.php/pay/ecpss_url/qiantai/";//[必填]返回数据给商户的地址
			$Remark = "http://".$_SERVER['HTTP_HOST']."/index.php/pay/ecpss_url/houtai/";  //[选填]升级。
			$md5src = $MerNo.$BillNo.$Amount.$ReturnURL.$MD5key;		//校验源字符串
			$MD5info = strtoupper(md5($md5src));		//MD5检验结果
		    $AdviceURL = $config['NotifyUrl'];   //[必填]支付完成后，后台接收支付结果，可用来更新数据库值
			$products=htmlspecialchars(trim($config['title']));// '------------------物品信息
			?>
			<html>
			<head>
			<title>Payment By CreditCard online</title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			</head>
			<body>
			<form action="https://pay.ecpss.com/sslpayment" method="post" name="E_FORM">
			<input type="hidden" name="MerNo" value="<?=$MerNo?>">
			<input type="hidden" name="BillNo" value="<?=$BillNo?>">
			<input type="hidden" name="Amount" value="<?=$Amount?>">
			<input type="hidden" name="ReturnURL" value="<?=$ReturnURL?>" >
			<input type="hidden" name="AdviceURL" value="<?=$AdviceURL?>" >
			<input type="hidden" name="MD5info" value="<?=$MD5info?>">
			<input type="hidden" name="Remark" value="<?=$Remark?>">
			<input type="hidden" name="products" value="<?=$products?>">
			</form>
			<script>
			document.forms[0].submit();
			</script>
			</body>
			</html>
			<?php
		ob_end_flush();
		exit;
	
	}

 }

?>