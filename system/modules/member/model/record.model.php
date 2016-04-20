<?php 
System::load_sys_class('model','sys','no');
class record extends model {

	public function __construct() {		
		parent::__construct();
		
	}
	
	/*获取最新购买记录数组*/
	public function get_new_record($num=''){
		if(!$num){
			$num = 10;
		}
		$sql="select * from `@#_member_go_record`,`@#_member` where `@#_member`.uid = `@#_member_go_record`.uid  order by  `id` DESC limit $num";		
		return $this->GetList($sql);
	
	}

}