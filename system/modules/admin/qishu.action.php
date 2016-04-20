<?php 

defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin',NULL,'no');
System::load_app_fun('global');
System::load_sys_fun('user');
class qishu extends admin {
	private $db;
	public function __construct(){		
		parent::__construct();		
		$this->db=System::load_app_model('admin_model');
		$this->ment=array(
						array("lists","商品列表",ROUTE_M."/content/goods_list"),						
		);	
	} 	
	
	//期数列表
	public function qishu_list(){	
		$shopid=intval($this->segment(4));	
		$info = $this->db->GetOne("select * from `@#_shoplist` where `id` = '$shopid' LIMIT 1");		
		$num=20;
		$total=$this->db->GetCount("select * from `@#_shoplist` where `sid` = '$info[sid]'");		
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){
			$pagenum=$_GET['p'];
		}else{$pagenum=1;}		
		$page->config($total,$num,$pagenum,"0"); 
		if($pagenum>$page->page){
			$pagenum=$page->page;
		}		
		$qishu=$this->db->GetPage("select * from `@#_shoplist` where `sid` = '$info[sid]' order by `qishu` DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));		
		$cateid = $qishu[0]['cateid'];
		$cate_name = $this->db->GetOne("select * from `@#_category` where `cateid` = '$cateid' LIMIT 1");
		$cate_name = $cate_name['name'];
		include $this->tpl(ROUTE_M,'qishu.list');
	}
}
?>