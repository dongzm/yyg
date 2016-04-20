<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin','','no');
class qq_admin extends admin {
	
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class('model');
		$this->ment=array(
						array("navigation","qq群列表",ROUTE_M.'/'.ROUTE_C), 
			            array("navigation","qq群添加",ROUTE_M.'/'.ROUTE_C.'/add'), 
						
		);	 
		
	}
	
	//QQ群设置
   public function init(){
     $lists=$this->db->GetList("SELECT * FROM `@#_qqset` where 1  ");    
	 if(!empty($lists)){
		foreach($lists as $key=>$val){
	      $lists[$key]['address']=$val['province'].'&nbsp;'.$val['city'].'&nbsp;'.$val['county'];			
		}
	 }
     include $this->tpl(ROUTE_M,'qq_list');
   }

	public function add(){
		if(isset($_POST['submit'])){
          $qq=htmlspecialchars(trim($_POST['qq']));
		  $name=htmlspecialchars(trim($_POST['name']));
		  $type=htmlspecialchars(trim($_POST['qqtype']));		
		  $qqurl=htmlspecialchars(trim($_POST['qqurl']));		
		  $full=htmlspecialchars(trim($_POST['full']));	 		  
		  $province=htmlspecialchars(trim($_POST['s_province']));
		  $city=htmlspecialchars(trim($_POST['s_city']));
		  $county=htmlspecialchars(trim($_POST['s_county']));
          $subtime=time(); 			 
		  $this->db->Query("insert into `@#_qqset`(`qq`,`name`,`type`,`qqurl`,`full`,`province`,`city`,`county`,`subtime`) values('$qq','$name','$type','$qqurl','$full','$province','$city','$county','$subtime') ");	
			if($this->db->affected_rows()){
					_message("添加成功",WEB_PATH.'/'.ROUTE_M.'/'.ROUTE_C."/init");
			}else{
					_message("添加失败");
			}
		}
		include $this->tpl(ROUTE_M,'qq_add');
	}
	
	public function delete(){
		$id=intval($this->segment(4)); 
			$this->db->Query("DELETE FROM `@#_qqset` WHERE (`id`='$id')");
			if($this->db->affected_rows()){			
					_message("删除成功",WEB_PATH.'/'.ROUTE_M.'/'.ROUTE_C."/init");
			}else{
					_message("删除失败");
			}  
	}
	
	public function update(){
		$id=intval($this->segment(4));
		$recomone=$this->db->Getone("SELECT * FROM `@#_qqset` where `id`='$id'");	
		
		if(isset($_POST['submit'])){
          $qq=htmlspecialchars(trim($_POST['qq']));
		  $name=htmlspecialchars(trim($_POST['name']));
		  $type=htmlspecialchars(trim($_POST['qqtype']));		
		  $qqurl=trim($_POST['qqurl']);
		  $full=htmlspecialchars(trim($_POST['full']));
		  $province=htmlspecialchars(trim($_POST['s_province']));
		  $city=htmlspecialchars(trim($_POST['s_city']));
		  $county=htmlspecialchars(trim($_POST['s_county']));
          $subtime=time();
		  					
		$this->db->Query("UPDATE `@#_qqset` SET qq='$qq',name='$name',type='$type',`qqurl`='$qqurl',`full`='$full',province='$province',city='$city',county='$county' ,`subtime`='$subtime' WHERE `id`=$id");
			if($this->db->affected_rows()){
					_message("修改成功",WEB_PATH.'/'.ROUTE_M.'/'.ROUTE_C."/init");
			}else{
					_message("修改失败");
			}
		}
		include $this->tpl(ROUTE_M,'qq_update');
	}
	
}
?>