<?php 

defined('G_IN_SYSTEM')or exit('No permission resources.');

class base extends SystemAction {
	public function __construct(){
	
	}
	public function cook(){
		$mysql_model=System::load_sys_class('model');
		$uid=_encrypt(_getcookie('uid'),'DECODE');
		$member=$mysql_model->GetOne("select * from `@#_member` where `uid`='".$uid."'");
		if(!$member){
			$lei=$this->segment(2);
			$funct=$this->segment(3);
			//echo $lei;
			header("location:".WEB_PATH."home/user/login?lei=".$lei."&funct=".$funct);
			exit;
		}else{
			return $member;
		}
	}
	// public function spcook(){
		// $mysql_model=System::load_sys_class('model');
		// $uid=_encrypt(_getcookie('uid'),'DECODE');
		// $member=$mysql_model->GetOne("select * from `@#_member` where `uid`='".$uid."'");	
		// return $member;
	// }
}
?>