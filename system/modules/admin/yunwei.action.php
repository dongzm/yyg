<?php 


defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin',G_ADMIN_DIR,'no');
class yunwei extends admin {
	private $db;
	public function __construct(){		
		parent::__construct();		
		$this->db=System::load_sys_class('model');
		$this->ment=array(
						array("websubmit","网站提交",ROUTE_M.'/'.ROUTE_C."/websubmit"),
						array("webtongji","网站统计",ROUTE_M.'/'.ROUTE_C."/webtongji"),
						array("sitemap","站点地图",ROUTE_M.'/'.ROUTE_C."/websitemap"),
		);
	}
	
	function init(){}	
	
	//网站提交
	public function websubmit(){	
		include $this->tpl(ROUTE_M,"yunwei.websubmit");
	}
	//网站统计
	public function webtongji(){	
		include $this->tpl(ROUTE_M,"yunwei.tongji");
	}
	
	//sitemap
	public function websitemap(){	
		include $this->tpl(ROUTE_M,"yunwei.sitemap");
	}
	
	
	
}
?>