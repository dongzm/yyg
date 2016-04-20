<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
class index extends SystemAction {
	
	public function tag(){		
		
		$search =$this->segment_array();
		array_shift($search);
		array_shift($search);
		array_shift($search);
		$search = implode('/',$search);
	
		if(!$search)_message("输入搜索关键字");
		$search = urldecode($search);
		$search = safe_replace($search);	
		if(!_is_utf8($search)){
			$search =  iconv("GBK", "UTF-8", $search); 
		}
		$mysql_model=System::load_sys_class('model');	
	
		$search = str_ireplace("union",'',$search);
		$search = str_ireplace("select",'',$search);
		$search = str_ireplace("delete",'',$search);
		$search = str_ireplace("update",'',$search);
		$search = str_ireplace("/**/",'',$search);
		
		$title=$search.' - '._cfg('web_name');
		
		$shoplist=$mysql_model->GetList("select title,thumb,id,sid,zongrenshu,canyurenshu,shenyurenshu,money from `@#_shoplist` WHERE `title` LIKE '%".$search."%'");
		$list=count($shoplist);
		include templates("search","search");
		
	}

}

?>