<?php 

defined('G_IN_SYSTEM')or exit('No permission resources.');
ini_set("display_errors","ON");
include dirname(__FILE__).'/lib/weixin.class.php';
class weixin_url extends SystemAction {
	private $out_trade_no;
	public function __construct(){			
		$this->db=System::load_sys_class('model');		
	} 	
	
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
	
	
	public function houtai(){

		$pay_type =$this->db->GetOne("SELECT * from `@#_pay` where `pay_class` = 'weixin' and `pay_start` = '1'");
		$pay_type_key = unserialize($pay_type['pay_key']);
		$key =  $pay_type_key['key']['val'];		//支付KEY
		$id =  $pay_type_key['id']['val'];		//支付商号ID
		


 //使用通用通知接口
	$notify = new Notify_pub();

	//存储微信的回调
	$xml = $GLOBALS['HTTP_RAW_POST_DATA'];	
	$notify->saveData($xml);
	
	//验证签名，并回应微信。
	//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
	//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
	//尽可能提高通知的成功率，但微信不保证通知最终能成功。
	if($notify->checkSign() == FALSE){
		$notify->setReturnParameter("return_code","FAIL");//返回状态码
		$notify->setReturnParameter("return_msg","签名失败");//返回信息
	}else{
		$notify->setReturnParameter("return_code","SUCCESS");//设置返回码
	}
	$returnXml = $notify->returnXml();
	echo $returnXml;
	
	
	if($notify->checkSign() == TRUE)
	{
		if ($notify->data["return_code"] == "FAIL") {
			exit();
		}
		elseif($notify->data["result_code"] == "FAIL"){
			exit();
		}
		else{
			$this->out_trade_no=$notify->data["out_trade_no"];
		}	
		$ret = $this->weixin_chuli();					
		$this->qiantai();
	
	}else
	{
	exit();
	}
}
	private function weixin_chuli(){
		$pay_type =$this->db->GetOne("SELECT * from `@#_pay` where `pay_class` = 'weixin' and `pay_start` = '1'");
		$out_trade_no = $this->out_trade_no;
		$dingdaninfo = $this->db->GetOne("select * from `@#_member_addmoney_record` where `code` = '$out_trade_no'");
		if(!$dingdaninfo){ return false;}	//没有该订单,失败
		if($dingdaninfo['status'] == '已付款'){
			return '已付款';
		}
		$c_money = intval($dingdaninfo['money']);
		$uid = $dingdaninfo['uid'];
		$time = time();
		
		$this->db->Autocommit_start();
		$up_q1 = $this->db->Query("UPDATE `@#_member_addmoney_record` SET `pay_type` = '微信支付', `status` = '已付款' where `id` = '$dingdaninfo[id]' and `code` = '$dingdaninfo[code]'");
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