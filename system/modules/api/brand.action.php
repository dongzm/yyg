<?php

defined('G_IN_SYSTEM')or exit("no");

class brand extends SystemAction {
	//json获取获取栏目
	public function __construct(){		
		$this->db=System::load_sys_class('model');
	}
	public function json_brand(){
		
		$cateid=intval($this->segment(4));
		if($cateid){
			$BrandList=$this->db->GetList("SELECT * FROM `@#_brand` where `cateid` LIKE '%$cateid%'");
			echo json_encode($BrandList);
		}
	}
}

?>