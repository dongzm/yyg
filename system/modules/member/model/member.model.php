<?php 
System::load_sys_class('model','sys','no');
class member extends model {

	public function __construct() {		
		/*
			调用其他数据库配置文件,操作其他数据库
			$this->db_config = System::load_sys_config('database');
			$this->db_setting = 'two';	
		*/		
		parent::__construct();
		
	}
	
	/*获取购买记录数组*/
	public function get_record($uid=0,$gid=0,$num=0){
		if(!$uid || !$gid || !$num){
			return array();
		}
		if(!$num){
			$num = 1;
		}
		return $this->GetList("SELECT * FROM `@#_member_go_record` where `shopid`='$gid' and `uid` = '$uid' ORDER BY id DESC limit $num");	
	} 
}