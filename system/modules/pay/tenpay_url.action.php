<?php 

defined('G_IN_SYSTEM')or exit('No permission resources.');
include dirname(__FILE__).DIRECTORY_SEPARATOR."lib/tenpay/ResponseHandler.class.php";
include dirname(__FILE__).DIRECTORY_SEPARATOR."lib/tenpay/RequestHandler.class.php";
include dirname(__FILE__).DIRECTORY_SEPARATOR."lib/tenpay/client/ClientResponseHandler.class.php";
include dirname(__FILE__).DIRECTORY_SEPARATOR."lib/tenpay/client/TenpayHttpClient.class.php";
include dirname(__FILE__).DIRECTORY_SEPARATOR."lib/tenpay/function.php";

ini_set("display_errors","OFF");
class tenpay_url extends SystemAction {
	public function __construct(){			
		$this->db=System::load_sys_class('model');
	} 	

	public function qiantai(){				
		sleep(2);
		$out_trade_no = $_GET['out_trade_no'];	//商户订单号
		$dingdaninfo = $this->db->GetOne("select * from `@#_member_addmoney_record` where `code` = '$out_trade_no'");
		if(!$dingdaninfo || $dingdaninfo['status'] == '未付款'){
			_message("支付失败");			
		}else{
			if(empty($dingdaninfo['scookies'])){
				_message("充值成功!",WEB_PATH."/member/home/userbalance");
			}else{
				if($dingdaninfo['scookies'] == '1'){
					_message("支付成功!",WEB_PATH."/member/cart/paysuccess");
				}else{
					_message("商品还未购买,请重新购买商品!",WEB_PATH."/member/cart/cartlist");
				}
					
			}
		}
		
	}

	public function houtai(){
			
		$pay_type =$this->db->GetOne("SELECT * from `@#_pay` where `pay_class` = 'tenpay' and `pay_start` = '1'");
		$pay_type_key = unserialize($pay_type['pay_key']);
		$key =  $pay_type_key['key']['val'];		//支付KEY
		$partner =  $pay_type_key['id']['val'];		//支付商号ID
		

		/* 创建支付应答对象 */
		$resHandler = new ResponseHandler();
		$resHandler->setKey($key);
	
		//判断签名
		if(!$resHandler->isTenpaySign()) {
			echo "认证签名失败";exit;
		}		
		//通知ID
		$notify_id = $resHandler->getParameter("notify_id");
		
		//通过通知ID查询，确保通知来至财付通
		//创建查询请求
		$queryReq = new RequestHandler();
		$queryReq->init();
		$queryReq->setKey($key);
		$queryReq->setGateUrl("https://gw.tenpay.com/gateway/simpleverifynotifyid.xml");
		$queryReq->setParameter("partner", $partner);
		$queryReq->setParameter("notify_id", $notify_id);
		
	
		
		//通信对象
		$httpClient = new TenpayHttpClient();
		$httpClient->setTimeOut(5);
		//设置请求内容
		$httpClient->setReqContent($queryReq->getRequestURL());

		//后台调用
		if($httpClient->call()) {		
			//设置结果参数
			$queryRes = new ClientResponseHandler();
			$queryRes->setContent($httpClient->getResContent());
			$queryRes->setKey($key);	
		}else{			
			echo "通信失败";exit;
		}
	

	
	
		
		//及时到账
		if($resHandler->getParameter("trade_mode") == "1"){
			//只有签名正确,retcode为0，trade_state为0才是支付成功
			if($queryRes->isTenpaySign() && $queryRes->getParameter("retcode") == "0" && $resHandler->getParameter("trade_state") == "0") {
				//log_result("即时到帐验签ID成功");				
				//取结果参数做业务处理
				$out_trade_no = $resHandler->getParameter("out_trade_no");
				//财付通订单号
				$transaction_id = $resHandler->getParameter("transaction_id");
				//金额,以分为单位
				$total_fee = $resHandler->getParameter("total_fee");
				//如果有使用折扣券，discount有值，total_fee+discount=原请求的total_fee
				$discount = $resHandler->getParameter("discount");
				
				//------------------------------
				//处理业务开始
				//------------------------------
				
				//处理数据库逻辑
				//注意交易单不要重复处理
				//注意判断返回金额		
				
				$total_fee_t = $total_fee/100;		
				$this->db->Autocommit_start();
				$dingdaninfo = $this->db->GetOne("select * from `@#_member_addmoney_record` where `code` = '$out_trade_no' and `money` = '$total_fee_t' and `status` = '未付款' for update");
				if(!$dingdaninfo){
					echo "fail";exit;
				}				
				
				$time = time();				
				$up_q1 = $this->db->Query("UPDATE `@#_member_addmoney_record` SET `pay_type` = '财付通', `status` = '已付款' where `id` = '$dingdaninfo[id]' and `code` = '$dingdaninfo[code]'");
				$up_q2 = $this->db->Query("UPDATE `@#_member` SET `money` = `money` + $total_fee_t where (`uid` = '$dingdaninfo[uid]')");				
				$up_q3 = $this->db->Query("INSERT INTO `@#_member_account` (`uid`, `type`, `pay`, `content`, `money`, `time`) VALUES ('$dingdaninfo[uid]', '1', '账户', '充值', '$total_fee_t', '$time')");
				
				if($up_q1 && $up_q2 && $up_q3){
					$this->db->Autocommit_commit();
				}else{
					$this->db->Autocommit_rollback();
					echo "fail";exit;
				}

				if(empty($dingdaninfo['scookies'])){				
					echo "success";exit;
				}					
				
				$uid = $dingdaninfo['uid'];

				$scookies = unserialize($dingdaninfo['scookies']);			
				$pay = System::load_app_class('pay','pay');			
				$pay->scookie = $scookies;
				$ok = $pay->init($uid,$pay_type['pay_id'],'go_record');	//云购商品	
				if($ok != 'ok'){
					_setcookie('Cartlist',NULL);
					echo "fail";exit;	//商品购买失败			
				}			
				$check = $pay->go_pay(1);
				if($check){
					$this->db->Query("UPDATE `@#_member_addmoney_record` SET `scookies` = '1' where `code` = '$out_trade_no' and `status` = '已付款'");
					_setcookie('Cartlist',NULL);
					echo "success";exit;			
				}else{
					echo "fail";exit;
				}			
				//------------------------------
				//处理业务完毕
				//------------------------------
				//log_result("即时到帐后台回调成功");				
			}else{				
				echo "fail";
			}
		}else{			
			//通信失败
			//echo "fail";
			//后台调用通信失败,写日志，方便定位问题
			//echo "<br>call err:" . $httpClient->getResponseCode() ."," . $httpClient->getErrInfo() . "<br>";
		}
				
	}//function end
	
}//


?>