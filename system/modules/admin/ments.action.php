<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin',G_ADMIN_DIR,'no');
class ments extends admin {
	
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class('model');
		$this->ment=array(
						array("navigation","导航条管理",ROUTE_M.'/'.ROUTE_C."/navigation"),
						array("addnavigation","添加导航条",ROUTE_M.'/'.ROUTE_C."/addnav"),
		);
		
	}
	//导航条管理
	public function navigation(){	
		$lists=array();
		$lists=$this->db->GetList("SELECT * FROM `@#_navigation` where 1 order by `order` DESC");		
		include $this->tpl(ROUTE_M,'navigation.list');
	}
	//添加
	public function addnav(){
		if(isset($_POST['dosubmit'])){		
			
			$name=htmlspecialchars($_POST['name']);
			$url=htmlspecialchars($_POST['url']);
			$status=$_POST['status']=='Y' ? 'Y' : 'N';
			$type = htmlspecialchars($_POST['type']);
			$order=intval($_POST['order']) ? intval($_POST['order']) : 1;		
			$this->db->Query("INSERT INTO `@#_navigation` (`name`, `type`, `url`, `status`,`order`) VALUES ('$name','$type','$url','$status','$order')");			
			_message("操作成功",WEB_PATH.'/admin/ments/navigation');			
		}
		include $this->tpl(ROUTE_M,'navigation.add');
	}
	
	//修改
	public function editnav(){
		$cid=$this->segment(4);
		if(intval($cid)<=0){
			_message("参数错误");
		}
		$info=$this->db->GetOne("SELECT * FROM `@#_navigation` WHERE `cid`='$cid'");
		if(!$info)_message("参数错误");
		if(isset($_POST['dosubmit'])){
			$name=htmlspecialchars($_POST['name']);
			$url=htmlspecialchars($_POST['url']);
			$type = htmlspecialchars($_POST['type']);
			$status=$_POST['status']=='Y' ? 'Y' : 'N';
			$order=intval($_POST['order']) ? intval($_POST['order']) : 1;
			$this->db->Query("UPDATE `@#_navigation` SET `name`='$name',
													  `url`='$url',
													  `status`='$status',
													  `type` = '$type',
													  `order`='$order'
			WHERE (`cid`='$cid')");
			_message("修改成功",WEB_PATH.'/'.ROUTE_M.'/ments/navigation');
			
		}
		include $this->tpl(ROUTE_M,'navigation.add');
	}
	//navdel
	public function navdel(){
		$cid=$this->segment(4);
		if(intval($cid)<=0){
			_message("参数错误");
		}
		$this->db->Query("DELETE FROM `@#_navigation` WHERE (`cid`='$cid')");
		if($this->db->affected_rows()){
			_message("操作成功",WEB_PATH.'/'.ROUTE_M.'/ments/navigation');
		}else
			_message("删除失败");
	}
		
}

?>