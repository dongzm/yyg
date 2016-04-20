<?php 


defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin',G_ADMIN_DIR,'no');
class dingdan extends admin {
	private $db;
	public function __construct(){		
		parent::__construct();		
		$this->db=System::load_sys_class('model');		
		$this->ment=array(
						array("lists","订单列表",ROUTE_M.'/'.ROUTE_C."/lists"),					
						array("lists","中奖订单",ROUTE_M.'/'.ROUTE_C."/lists/zj"),					
						array("lists","已发货",ROUTE_M.'/'.ROUTE_C."/lists/sendok"),
						array("lists","未发货",ROUTE_M.'/'.ROUTE_C."/lists/notsend"),						
						array("insert","已完成",ROUTE_M.'/'.ROUTE_C."/lists/ok"),
						array("insert","已作废",ROUTE_M.'/'.ROUTE_C."/lists/del"),
						array("insert","待收货",ROUTE_M.'/'.ROUTE_C."/lists/shouhuo"),
						array("genzhong","<b>快递跟踪</b>",ROUTE_M.'/'.ROUTE_C."/genzhong"),
		);
	}
	
	public function genzhong(){	
		include $this->tpl(ROUTE_M,'dingdan.genzhong');	
	}
	public function lists(){	
		
		/*
			已付款,未发货,已完成
			未付款,已发货,已作废
			已付款,未发货,待收货
		*/
		$where = $this->segment(4);
		if(!$where){
			$list_where = "where `status` LIKE  '%已付款%'";
		}elseif($where == 'zj'){
			//中奖		
			$list_where = "where `huode` != '0'";
		}elseif($where == 'sendok'){
			//已发货订单
			$list_where = "where `huode` != '0' and  `status` LIKE  '%已发货%'";
		}elseif($where == 'notsend'){
			//未发货订单
			$list_where = "where `huode` != '0' and `status` LIKE  '%未发货%'";
		}elseif($where == 'ok'){
			//已完成
			$list_where = "where `huode` != '0' and  `status` LIKE  '%已完成%'";
		}elseif($where == 'del'){
			//已作废		
			$list_where = "where `status` LIKE  '%已作废%'";
		}elseif($where == 'gaisend'){
			//该发货			
			$list_where = "where `huode` != '0' and `status` LIKE  '%未发货%'";
		}elseif($where == 'shouhuo'){
			//该发货			
			$list_where = "where `status` LIKE  '%待收货%'";
		}
		
		if(isset($_POST['paixu_submit'])){
			$paixu = $_POST['paixu'];
			if($paixu == 'time1'){
				$list_where.=" order by `time` DESC";
			}
			if($paixu == 'time2'){
				$list_where.=" order by `time` ASC";
			}
			if($paixu == 'num1'){
				$list_where.=" order by `gonumber` DESC";
			}
			if($paixu == 'num2'){
				$list_where.=" order by `gonumber` ASC";
			}
			if($paixu == 'money1'){
				$list_where.=" order by `moneycount` DESC";
			}
			if($paixu == 'money2'){
				$list_where.=" order by `moneycount` ASC";
			}
		
		}else{
			$list_where.=" order by `time` DESC";
			$paixu = 'time1';
		}
			
		$num=20;
	
		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_member_go_record` $list_where");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,$num,$pagenum,"0");
		$recordlist=$this->db->GetPage("SELECT * FROM `@#_member_go_record` $list_where",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));	
		
		
		include $this->tpl(ROUTE_M,'dingdan.list');	
	}
	
	//订单详细
	public function get_dingdan(){
		$code=abs(intval($this->segment(4)));
		$record=$this->db->GetOne("SELECT * FROM `@#_member_go_record` where `id`='$code'");
		if(!$record)_message("参数不正确!");
		
		if(isset($_POST['submit'])){
			$record_code =explode(",",$record['status']);
			$status = $_POST['status'];
			$company = $_POST['company'];
			$company_code = $_POST['company_code'];
			$company_money = floatval($_POST['company_money']);
			$code = abs(intval($_POST['code']));
			if(!$company_money){
				$company_money = '0.00';
			}else{
				$company_money = sprintf("%.2f",$company_money);
			}
		
			if($status == '未完成'){
				$status = $record_code[0].','.$record_code[1].','.'未完成';		
			}
			if($status == '已发货'){
				$status = '已付款,已发货,待收货';
			}
			if($status == '未发货'){
				$status = '已付款,未发货,未完成';
			}
			if($status == '已完成'){
				$status = '已付款,已发货,已完成';	
			}
			if($status == '已作废'){
				$status = $record_code[0].','.$record_code[1].','.'已作废';				
			}			
	
			$ret = $this->db->Query("UPDATE `@#_member_go_record` SET `status`='$status',`company` = '$company',`company_code` = '$company_code',`company_money` = '$company_money' where id='$code'");
			if($ret){
				_message("更新成功");
			}else{
				_message("更新失败");
			}
		}
		
		System::load_sys_fun("user");
		$uid= $record['uid'];
		$user = $this->db->GetOne("select * from `@#_member` where `uid` = '$uid'");
		$user_dizhi = $this->db->GetOne("select * from `@#_member_dizhi` where `uid` = '$uid' and `default` = 'Y'");
		$go_time = $record['time'];
		include $this->tpl(ROUTE_M,'dingdan.code');	
	}
	
	//订单搜索
	public function select(){
		$record = '';
		if(isset($_POST['codesubmit'])){
			$code = htmlspecialchars($_POST['text']);		
			$record = $this->db->GetList("SELECT * FROM `@#_member_go_record` where `code` = '$code'");			
		}
		if(isset($_POST['usersubmit'])){	
			if($_POST['user'] == 'uid'){
				$uid = intval($_POST['text']);
				$record = $this->db->GetList("SELECT * FROM `@#_member_go_record` where `uid` = '$uid'");	
			}
		}
		if(isset($_POST['shopsubmit'])){
			if($_POST['shop'] == 'sid'){
				$sid = intval($_POST['text']);
				$record = $this->db->GetList("SELECT * FROM `@#_member_go_record` where `shopid` = '$sid'");	
			}
			if($_POST['shop'] == 'sname'){
				$sname= htmlspecialchars($_POST['text']);
				$record = $this->db->GetList("SELECT * FROM `@#_member_go_record` where `shopname` = '$sname'");	
			}
		}
		
		if(isset($_POST['timesubmit'])){
				$start_time = strtotime($_POST['posttime1']) ? strtotime($_POST['posttime1']) : time();				
				$end_time   = strtotime($_POST['posttime2']) ? strtotime($_POST['posttime2']) : time();
				$record = $this->db->GetList("SELECT * FROM `@#_member_go_record` where `time` > '$start_time' and `time` < '$end_time'");				
		}
		
		
		include $this->tpl(ROUTE_M,'dingdan.soso');	
	}
	
}
?>