<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin','','no');
class slide extends admin {
	
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class('model');
		$this->ment=array(
						array("navigation","幻灯管理",ROUTE_M.'/'.ROUTE_C),
						array("navigation","添加幻灯片",ROUTE_M.'/'.ROUTE_C."/add"), 
		);
		
	}
	public function init(){
		$lists=$this->db->GetList("SELECT * FROM `@#_slide` where 1");		
		include $this->tpl(ROUTE_M,'slide_list');
	}
	
	public function add(){
		if(isset($_POST['submit'])){
		$title=htmlspecialchars(trim($_POST['title']));
		
		$link=htmlspecialchars(trim($_POST['link']));
		if(isset($_POST['image'])){
				$img=$_POST['image'];
			}else{
				$img=$slideone['img'];
			}
			 
		$this->db->Query("insert into `@#_slide`(`title`,`link`,`img`) values('$title','$link','$img') ");	
			if($this->db->affected_rows()){
					_message("添加成功",WEB_PATH.'/'.ROUTE_M.'/'.ROUTE_C."/init");
			}else{
					_message("添加失败");
			}
		}
		include $this->tpl(ROUTE_M,'slide_add');
	}
	
	public function delete(){
		$id=intval($this->segment(4)); 
			$this->db->Query("DELETE FROM `go_slide` WHERE (`id`='$id')");
			if($this->db->affected_rows()){
			
					_message("删除成功",WEB_PATH.'/'.ROUTE_M.'/'.ROUTE_C."/init");
			}else{
					_message("删除失败");
			}  
	}
	
	public function update(){
		$id=intval($this->segment(4));
		$slideone=$this->db->Getone("SELECT * FROM `@#_slide` where `id`='$id'");	
		
		if(isset($_POST['submit'])){
			$title=htmlspecialchars(trim($_POST['title']));	
			$link=htmlspecialchars(trim($_POST['link']));	
			if(isset($_POST['image'])){
				$img=$_POST['image'];
			}else{
				$img=$slideone['img'];
			}		
			$this->db->Query("UPDATE `@#_slide` SET `img`='$img',`title`='$title',`link`='$link' WHERE `id`=$id");
			if($this->db->affected_rows()){
					_message("修改成功",WEB_PATH.'/'.ROUTE_M.'/'.ROUTE_C."/init");
			}else{
					_message("修改失败");
			}
		}
		include $this->tpl(ROUTE_M,'slide_update');
	}
	
	
}



?>