<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_fun('my','home');
System::load_app_fun('user','home');
class ad extends SystemAction{
	public function __construct() {	
		
	}
	public function get_ad(){
		//$mysql_model=System::load_sys_class('model');
		echo 'test';
	}

}

?>