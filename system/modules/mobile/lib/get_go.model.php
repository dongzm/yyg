<?php 

System::load_sys_class('model','sys','no');
class get_go extends model {
	public function __construct() {		
		parent::__construct();
	}
	
	public function get_record($s1='',$s2=''){
		$sql="select * from `@#_member_go_record`,`@#_member` where `@#_member`.uid = `@#_member_go_record`.uid  and  `status` = '%已付款%'  order by  `id` DESC";		
		return $this->GetList($sql);	
	}
}


?>