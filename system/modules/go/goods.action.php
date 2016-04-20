<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_sys_fun('user');
System::load_app_fun('user');
System::load_app_fun('my');
class goods extends SystemAction {
	private $db;
	public function __construct(){
		$this->db=System::load_sys_class('model');
	}
	public function init(){}
	
	
	/*所有参与记录*/
	public function go_record_ifram(){
	
		$gid = (int)$this->segment(4);
		$len = (int)$this->segment(5);
		if($len < 10){
			$len = 10;
		}
		
		$page=System::load_sys_class('page');		
		$total=$this->db->GetCount("SELECT * FROM `@#_member_go_record` WHERE `shopid` = '$gid'");
	
		if(isset($_GET['p'])){
			$pagenum=(int)$_GET['p'];
		}else{
			$pagenum=1;
		}
		$num=$len;
		$page->config($total,$num,$pagenum,"0");
		$go_record_list=$this->db->GetPage("SELECT * FROM `@#_member_go_record` WHERE `shopid` = '$gid' order by id DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));	
		
		include templates("index","go_record_ifram");
	}
	
}/*类结束*/