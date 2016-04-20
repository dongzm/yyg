<?php 


class dingdan extends SystemAction {

	private $db;
	public function __construct(){
		$this->db = System::load_sys_class("model");
	}
	
	/*
	*	设置发货
	**/
	public function set(){
		
		
		if(!isset($_POST['uid']) || !isset($_POST['oid'])){exit;}
		$uid = abs(intval($_POST['uid']));
		$oid = abs(intval($_POST['oid']));
		if(!$oid || !$uid){
			echo "0";
			exit;
		}
		$info = $this->db->GetOne("SELECT uid,status FROM `@#_member_go_record` WHERE `id` = '$oid' and `uid` = '$uid' limit 1");
		if(!$info)_message("参数错误");
		$status = @explode(",",$info['status']);
		if(is_array($status) &&  $status[1]=='已发货'){
			$status = '已付款,已发货,已完成';
			$q = $this->db->Query("UPDATE `@#_member_go_record` SET `status` = '$status' WHERE `id` = '$oid'");
			echo $q ? '1' : '0';
		}else{
			echo "0";
		}	
		
		
	}

}

?>