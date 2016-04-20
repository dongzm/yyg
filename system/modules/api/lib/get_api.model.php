<?php

System::load_sys_class("model","sys","no");
class get_api extends model {

	public function __construct(){	
		$this->db_setting = 'default';		
		parent::__construct();
		$this->models=$this->GetList("SELECT * FROM `@#_model` where 1",array('key'=>'modelid'));
	}
	
	//获取推荐位
	public function get_position(){
	
		/*
		func_num_args() 返回传递给该函数参数的个数 
		func_get_arg($arg_num) 取得指定位置的参数值，$arg_num位置index从0开始n-1
		func_get_args() 返回包含所有参数的数组 
		*/
		$args = func_get_args();
		if(!isset($args[0]))return false;
		$pos_name = htmlspecialchars($args[0]);
		$pos_info = $this->GetOne("SELECT * FROM `@#_position` where `pos_name` = '$pos_name' LIMIT 1");
		if(!$pos_info)return false;
		$len = $pos_info['pos_num'];			
		if(!isset($args[1])){
			$type = 'arr';
			if(!isset($args[2])){
				$info = $this->GetList("SELECT * FROM `@#_position_data` where `pos_id` = '$pos_info[pos_id]'");
			}else{
				$info = $this->GetList("SELECT * FROM `@#_position_data` where `pos_id` = '$pos_info[pos_id]'");
			}
		}else{			
			$type = 'one';	
			if(!isset($args[2])){
				$info = $this->GetOne("SELECT * FROM `@#_position_data` where `pos_id` = '$pos_info[pos_id]' LIMIT 1");
			}else{
				$info = $this->GetOne("SELECT * FROM `@#_position_data` where `pos_id` = '$pos_info[pos_id]' LIMIT 1");				
				$info = $this->GetOne("SELECT * FROM `@#_shoplist` where `id` = '$info[con_id]' LIMIT 1");	
				//$info = $this->GetOne("SELECT * FROM `@#_$info[mod_name]` where `id` = '$info[con_id]' LIMIT 1");	
			}		
		}
		if($info)
			return $info;
		else
			return false;
		//$posinfo =
	}

}//
?>