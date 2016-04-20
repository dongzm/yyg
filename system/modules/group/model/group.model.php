<?php 
System::load_sys_class('model','sys','no');
class group extends model {

	public function __construct() {		
		parent::__construct();
		
	}
	
	/*获取圈子最新帖子*/
	public function get_group_tiezi($num = 5,$qzid=null,$order = "`id` DESC"){
		if(!$num){
			$num = 5;
		}
		if($qzid){
			return $this->GetList("SELECT * FROM `@#_quanzi_tiezi` where `qzid` = '$qzid' and `shenhe`='Y' and `tiezi` = '0' and `title` is not null  ORDER BY $order limit $num");	
		}
		return $this->GetList("SELECT * FROM `@#_quanzi_tiezi` where `shenhe`='Y' and `tiezi` = '0' and `title` is not null  ORDER BY $order limit $num");
	} 
	
	/*获取圈子列表*/
	public function get_group($order = "`id` DESC"){	
		return $this->GetList("SELECT * FROM `@#_quanzi` where 1 ORDER BY $order limit $num");		
	}
	
	
}