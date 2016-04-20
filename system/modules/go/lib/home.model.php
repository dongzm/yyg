<?php

System::load_sys_class("model","sys","no");
class home extends model {

	public function __construct(){	
		$this->db_setting = 'default';
		parent::__construct();
	}
	
	public function getcode(){
	
		$data=$this->GetList("SELECT * FROM `@#_member_go_record` WHERE 1");
		$codes='';
		foreach($data as $v){
			$codes.=$v['goucode'];
		}
		return $codes;
	
	}

}
?>