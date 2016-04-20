<?php
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_sys_class('model','sys','no');
class group extends model {
	public function __construct() {

	}
	
	public function xxx($uid){
		$mysql_model=System::load_sys_class('model');
		$member=$mysql_model->GetOne("select * from `@#_member` where `uid`=".$uid."");	
		return $member;
	}
	
}
?>