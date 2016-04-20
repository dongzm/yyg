<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_sys_fun("user");

class us extends base{
	public function __construct() {	
		$uid = abs(intval($this->segment(4)));
		if(!$uid)_message("参数不正确!");	
		if($uid > 1000000000)$uid = $uid-1000000000;		
		$this->uid = $uid;
	}
	public function uname(){
		$mysql_model=System::load_sys_class('model');
		$title="个人主页";
		$index = $this->uid;	
		$tab=$this->segment(3);
		$member=$mysql_model->GetOne("select * from `@#_member` where uid='$index'");
			
		if($member){
			$membergo=$mysql_model->GetList("select * from `@#_member_go_record` where uid='$index' order by `id` DESC limit 0,10 ");	
			include templates("us","index");
		}else{
			_message("页面错误",WEB_PATH,3);
		}
	}
	public function userbuy(){
		$mysql_model=System::load_sys_class('model');
		$title="购买记录";
		$index = $this->uid;		
		$tab=$this->segment(3);
		$member=$mysql_model->GetOne("select * from `@#_member` where uid='$index'");
		
		if($member){
			$membergo=$mysql_model->GetList("select * from `@#_member_go_record` where uid='$index' order by `id` DESC limit 0,10");		
			include templates("us","userbuy");
		}else{
			_message("页面错误",WEB_PATH,3);
		}
	}
	public function userraffle(){
		$mysql_model=System::load_sys_class('model');
		$title="获得的商品";
		$index = $this->uid;		
		$tab=$this->segment(3);
		$member=$mysql_model->GetOne("select * from `@#_member` where uid='$index'");
		$memberhuode=$mysql_model->GetList("select * from `@#_member_go_record` where uid='$index' and `huode` > '10000000' order by `id` DESC limit 0,10");		
		if($member){
			include templates("us","userraffle");
		}else{
			_message("页面错误",WEB_PATH,3);
		}
	}
}

?>