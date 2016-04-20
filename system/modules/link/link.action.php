<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_fun('user','go');
System::load_sys_fun('user');
class link extends SystemAction{
	public function __construct() {	
			
	}	
	public function init(){
		$mysql_model=System::load_sys_class('model');
		$title="友情链接";
		$link_size=$mysql_model->GetList("select * from `@#_link` where `type`='1'");
		$link_img=$mysql_model->GetList("select * from `@#_link` where `type`='2'");
		include templates("link","link");	
	}

}

?>