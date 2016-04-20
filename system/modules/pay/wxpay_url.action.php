<?php 

defined('G_IN_SYSTEM')or exit('No permission resources.');
class wxpay_url extends SystemAction {
	public function __construct(){			
		$this->db=System::load_sys_class('model');
	} 	
    public function houtai(){	
	      $this->db=System::load_sys_class('model');
          include_once dirname(__FILE__)."/lib/wxpay/WxPayPubHelper.php";//引入文件需求
			if (!isset($_POST["out_trade_no"]))
			{
				$out_trade_no = " ";
			}else{
				$out_trade_no = $_POST["out_trade_no"];

				//使用订单查询接口
				$orderQuery = new OrderQuery_pub();
				//设置必填参数
				//appid已填,商户无需重复填写
				//mch_id已填,商户无需重复填写
				//noncestr已填,商户无需重复填写
				//sign已填,商户无需重复填写
				$orderQuery->setParameter("out_trade_no","$out_trade_no");//商户订单号 
				$time=time();
				//file_put_contents("111.txt",$out_trade_no."----".$time."\n",FILE_APPEND);
				//非必填参数，商户可根据实际情况选填
				//$orderQuery->setParameter("sub_mch_id","XXXX");//子商户号  
				//$orderQuery->setParameter("transaction_id","XXXX");//微信订单号
				
				//获取订单查询结果
				$orderQueryResult = $orderQuery->getResult();
				//商户根据实际情况设置相应的处理流程,此处仅作举例
				if ($orderQueryResult["return_code"] == "FAIL") {
				 echo "通信出错：".$orderQueryResult['return_msg']."<br>";
				//file_put_contents("ccc.txt","通信出错：".$orderQueryResult['return_msg']."\n",FILE_APPEND);
				}
				elseif($orderQueryResult["result_code"] == "FAIL"){
					echo "错误代码：".$orderQueryResult['err_code']."<br>";
					echo "错误代码描述：".$orderQueryResult['err_code_des']."<br>";
				//file_put_contents("ccc.txt","错误代码：".$orderQueryResult['err_code']."\n",FILE_APPEND);				
				//file_put_contents("ccc.txt","错误代码描述：".$orderQueryResult['err_code_des']."\n",FILE_APPEND);				
				}
				else{
				//file_put_contents("ccc.txt","交易状态：".$orderQueryResult['trade_state']."\n",FILE_APPEND);	
				$total_fee_t = $orderQueryResult['total_fee']/100;					
				$out_trade_no=$orderQueryResult['out_trade_no']; 		
				$this->db->Autocommit_start();
				$dingdaninfo = $this->db->GetOne("select * from `@#_member_addmoney_record` where `code` = '$out_trade_no' and `money` = '$total_fee_t' and `status` = '未付款' for update");
				if(!$dingdaninfo){
					echo "fail";exit;
				}				
				$time = time();				
				$up_q1 = $this->db->Query("UPDATE `@#_member_addmoney_record` SET `pay_type` = '微信支付', `status` = '已付款' where `id` = '$dingdaninfo[id]' and `code` = '$dingdaninfo[code]'");
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
				}
				
			}	
	}
	
}//


?>