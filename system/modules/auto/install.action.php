<?php
defined('G_IN_SYSTEM')or exit('');
class install extends SystemAction{
	public function __construct(){
		$this->db = System::load_sys_class("model");
	}
	public function init(){
		$q = $this->db->Query("
		alter TABLE `@#_member` add auto_user tinyint(4) default 0
		");
		if($q){
			//unset(__FILE__);
			//_message("安装成功!");
			echo "OK";
		}
	}
}
?>