<?php

System::load_sys_class("model","sys","no");
class position extends model {

	public function __construct(){	
		$this->db_setting = 'default';		
		parent::__construct();
		$this->models=$this->GetList("SELECT * FROM `@#_model` where 1",array('key'=>'modelid'));
	}
	
	public function pos_insert($pos_id_arr=null,$pos_content=null){
	
		if(is_array($pos_id_arr)){
			$models=$this->models;
			$sql = 'INSERT INTO `@#_position_data` (`con_id`,`mod_id`, `mod_name`, `pos_id`, `pos_data`, `pos_order`,`pos_time`) VALUES ';
			$con_id = $pos_content['id'];
			$pos_content = serialize($pos_content);			
			$len = count($pos_id_arr);			
			$id= '';
			$true = 0;
			foreach($pos_id_arr as $pos){
				$id .= $pos.',';
			}
			$id = trim($id,',');
			$info = $this->GetList("select * from `@#_position` where `pos_id` in($id)",array("key"=>'pos_id'));			
			$datainfo = $this->GetList("select * from `@#_position_data` where `pos_id` in($id)",array("key"=>'pos_id'));			
			foreach($pos_id_arr as $pos){				
				if(isset($info[$pos])){					
					$ky_len=$info[$pos]['pos_maxnum'] - $info[$pos]['pos_this_num'];
					$time = time();
					$modelid = $info[$pos]['pos_model'];
					$modelname = $models[$modelid]['table'];						
					if($ky_len >= $len){	//可以插入
						$time = time();					
						if($datainfo[$pos]['con_id'] == $con_id){
							$this->Query("UPDATE `@#_position_data` SET  `pos_data`= '$pos_content'  where `pos_id` = '$pos' and `con_id` = '$con_id'");
						}else{
							$sql.="('$con_id','$modelid','$modelname','$pos', '$pos_content', '1','$time'),";
							$true = 1;
							$this->Query("UPDATE `@#_position` SET `pos_this_num` = `pos_this_num` + 1 where `pos_id` = '$pos'");
						}		

					}else{				//删除多余的						
						if($datainfo[$pos]['con_id'] == $con_id){
							$this->Query("UPDATE `@#_position_data` SET  `pos_data`= '$pos_content'  where `pos_id` = '$pos' and `con_id` = '$con_id'");
						}else{
							$true = 1;
							$this->Query("DELETE FROM `@#_position_data` WHERE (`pos_id`='$pos') order by `id` DESC limit $len");
							$sql.="('$con_id','$modelid','$modelname','$pos', '$pos_content', '1','$time'),";
						}	
						
					}
				}				
			}		
			if($true){
				$sql = trim($sql,',');			
				return $this->Query($sql);
			}else{
				return false;
			}
		}		
	}

}//
?>