<?php 

defined('G_IN_SYSTEM')or exit('No permission resources.');
ini_set("display_errors","OFF");
include dirname(__FILE__).'/lib/yeepay/yeepayCommon.class.php';
class yeepay_url extends SystemAction {
	private $out_trade_no;
	public function __construct(){			
		$this->db=System::load_sys_class('model');		
	} 	
	
	/*
	private function qiantai(){	
		if(_is_mobile()){
			$message = '_messagemobile';
		}else{
			$message = '_message';
		}
		
		$out_trade_no = $this->out_trade_no;
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
	*/
	
		
		    //考虑手机版本返回
		private function qiantai(){	
			sleep(2);
			$out_trade_no = $this->out_trade_no;
			$dingdaninfo = $this->db->GetOne("select * from `@#_member_addmoney_record` where `code` = '$out_trade_no'");		
			$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
			$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile)/i";

			if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap')){
			if(!$dingdaninfo || $dingdaninfo['status'] == '未付款'){
				_messagemobile("支付失败");			
			}else{
			if(empty($dingdaninfo['scookies'])){
				_messagemobile("充值成功!<a href=".WEB_PATH."/mobile/home/userbalance>查看账户明细</a>");
			}else{
				if($dingdaninfo['scookies'] == '1'){					 
					header("location: ".WEB_PATH."/mobile/cart/paysuccess");
				}else{
					_messagemobile("商品还未购买,请!<a href=".WEB_PATH."/member/cart/cartlist>返回购物车</a>重新购买商品");
				}					
			}
		}
	  
	  }else{
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


	}
	
	public function houtai(){
	
		$pay_type =$this->db->GetOne("SELECT * from `@#_pay` where `pay_class` = 'yeepay' and `pay_start` = '1'");
		$pay_type_key = unserialize($pay_type['pay_key']);
		$key =  $pay_type_key['key']['val'];		//支付KEY
		$id =  $pay_type_key['id']['val'];		//支付商号ID
		
		$config = array("id"=>$id,"key"=>$key,"error_log"=>'YeePay_HTML.log');
		$yeepayCommon = new yeepayCommon();
		$yeepayCommon->config = $config;
		
				
		//解析返回参数.
		$return = $yeepayCommon->getCallBackValue($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
		//判断返回签名是否正确（True/False）
		$bRet = $yeepayCommon->CheckHmac($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
								
		$out_trade_no = $r6_Order;
		$this->out_trade_no = $out_trade_no;	
		if(!$out_trade_no){
			echo "返回参数错误";exit;	
		}
		//校验码正确.
		if($bRet){
			if($r1_Code=="1"){				
				//需要比较返回的金额与商家数据库中订单的金额是否相等，只有相等的情况下才认为是交易成功.
				//并且需要对返回的处理进行事务控制，进行记录的排它性处理，在接收到支付结果通知后，判断是否进行过业务逻辑处理，不要重复进行业务逻辑处理，防止对同一条交易重复发货的情况发生.      	  	
				if($r9_BType=="1"){		
					$ret = $this->yeepay_chuli();					
					$this->qiantai();
					exit;
				}elseif($r9_BType=="2"){
					//如果需要应答机制则必须回写流,以success开头,大小写不敏感.	
					$ret = $this->yeepay_chuli();
					if($ret == '已付款' || $ret == '充值完成' || $ret == '商品购买成功'){
						echo 'success';exit;
					}
					if($ret == '充值失败' || $ret == '商品购买失败'){
						echo $ret;exit;
					}
				}
			}
						
		}else{
			echo "交易信息被篡改";
		}
	
		

	}
	
	private function yeepay_chuli(){
		$pay_type =$this->db->GetOne("SELECT * from `@#_pay` where `pay_class` = 'yeepay' and `pay_start` = '1'");
		$out_trade_no = $this->out_trade_no;
		$this->db->Autocommit_start();
		$dingdaninfo = $this->db->GetOne("select * from `@#_member_addmoney_record` where `code` = '$out_trade_no' for update");
		if(!$dingdaninfo){ return false;}	//没有该订单,失败
		if($dingdaninfo['status'] == '已付款'){
			return '已付款';
		}
		$c_money = intval($dingdaninfo['money']);
		$uid = $dingdaninfo['uid'];
		$time = time();		
		
		$up_q1 = $this->db->Query("UPDATE `@#_member_addmoney_record` SET `pay_type` = '易宝支付', `status` = '已付款' where `id` = '$dingdaninfo[id]' and `code` = '$dingdaninfo[code]'");
		$up_q2 = $this->db->Query("UPDATE `@#_member` SET `money` = `money` + $c_money where (`uid` = '$uid')");			
		$up_q3 = $this->db->Query("INSERT INTO `@#_member_account` (`uid`, `type`, `pay`, `content`, `money`, `time`) VALUES ('$uid', '1', '账户', '充值', '$c_money', '$time')");
		
		if($up_q1 && $up_q2 && $up_q3){			
			$this->db->Autocommit_commit();
		}else{
			$this->db->Autocommit_rollback();
			return '充值失败';
		}			
		if(empty($dingdaninfo['scookies'])){					
			return "充值完成";	//充值完成	
		}
		
		$scookies = unserialize($dingdaninfo['scookies']);			
		$pay = System::load_app_class('pay','pay');		
		$pay->scookie = $scookies;
		$ok = $pay->init($uid,$pay_type['pay_id'],'go_record');	//云购商品	
		if($ok != 'ok'){
			$_COOKIE['Cartlist'] = '';_setcookie('Cartlist',NULL);			
			return '商品购买失败';	//商品购买失败			
		}		

		$check = $pay->go_pay(1);
		if($check){
			$this->db->Query("UPDATE `@#_member_addmoney_record` SET `scookies` = '1' where `code` = '$out_trade_no' and `status` = '已付款'");
			$_COOKIE['Cartlist'] = '';_setcookie('Cartlist',NULL);
			return "商品购买成功";
		}else{
			return '商品购买失败';
		}			

	}
	
}//

?>