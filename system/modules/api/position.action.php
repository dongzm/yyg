<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin',G_ADMIN_DIR,'no');
class position extends admin {
	
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class('model');
		$this->ment=array(
						array("lists","推荐位管理",ROUTE_M.'/'.ROUTE_C."/lists"),
						array("add","推荐位添加",ROUTE_M.'/'.ROUTE_C."/add"),
		);
		$this->models=$this->db->GetList("SELECT * FROM `@#_model` where 1",array('key'=>'modelid'));
	}
	
	public function lists(){
		
		$models=$this->models;
		$positions = $this->db->GetList("SELECT * FROM `@#_position` where 1");
		
		include $this->tpl(ROUTE_M,"position.lists");
	}
	
	public function add(){
		if(isset($_POST['dosubmit'])){
			
			$model = intval($_POST['pos_model']);
			$name = htmlspecialchars($_POST['pos_name']);	
			$num = intval($_POST['pos_num']);
			$maxnum = intval($_POST['pos_maxnum']);
			
			if(!$model)_message("请选择模型");
			if(!$name)_message("请输入推荐位名称");		
			if(!$num)_message("请输入显示条数,不能少于1条");
			if(!$maxnum || $maxnum >=251 )_message("请输入最大显示条数,并不能超过250");				
			if($num > $maxnum)_message("显示条数不能大于最大保存条数");			
			$time=time();
			$this->db->Query("INSERT INTO `@#_position` (`pos_model`, `pos_name`, `pos_num`, `pos_maxnum`,`pos_time`) VALUES ('$model', '$name', '$num', '$maxnum','$time')");
			
			if($this->db->affected_rows()){			
				_message("添加成功",WEB_PATH.'/'.ROUTE_M.'/'.ROUTE_C."/lists");
			}else{
				_message("添加失败");
			}
			
			header("Cache-control: private");
		}		
		$models=$this->models;
		include $this->tpl(ROUTE_M,"position.add");
	}
	
	public function edit(){
		$posid = intval($this->segment(4));
		$posinfo = $this->db->GetOne("SELECT * FROM `@#_position` where `pos_id` = '$posid' LIMIT 1");
		if(!$posinfo)_message("参数错误");		
		$models=$this->models;		
		if(isset($_POST['dosubmit'])){
			
			$model = intval($_POST['pos_model']);
			$name = htmlspecialchars($_POST['pos_name']);
			$num = intval($_POST['pos_num']);
			$maxnum = intval($_POST['pos_maxnum']);
			
			if(!$model)_message("请选择模型");
			if(!$name)_message("请输入推荐位名称");
			if(!$num)_message("请输入显示条数,不能少于1条");
			if(!$maxnum || $maxnum >=251 )_message("请输入最大显示条数,并不能超过250");				
			if($num > $maxnum)_message("显示条数不能大于最大保存条数");		
			$this->db->Query("UPDATE `@#_position` SET `pos_model`='$model',`pos_name`='$name',`pos_num`='$num', `pos_maxnum`='$maxnum' WHERE (`pos_id`='$posid')");
			if($this->db->affected_rows()){			
				_message("修改成功",WEB_PATH.'/'.ROUTE_M.'/'.ROUTE_C."/lists");
			}else{
				_message("修改失败");
			}
			
			header("Cache-control: private");
		}		
		
		include $this->tpl(ROUTE_M,"position.add");
	}
	
	
	public function get(){
		$posid=intval($this->segment(4));
		$posinfo = $this->db->GetOne("SELECT * FROM `@#_position` WHERE `pos_id` = '$posid' LIMIT 1");
		if(!$posinfo)_message("参数错误");		
		$num=20;		
		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_position_data` WHERE `pos_id` = '$posid'");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,$num,$pagenum,"0");
		$pos_list=$this->db->GetPage("SELECT * FROM `@#_position_data` WHERE `pos_id` = '$posid'",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
		if($posinfo['pos_model'] == 1){
			$path = WEB_PATH.'/go/glist/imte/';	
			$editpath = WEB_PATH.'/'.G_ADMIN_DIR.'/content/goods_edit/';
		}	
		if($posinfo['pos_model'] == 2){
			$path = WEB_PATH.'/go/article/show/';
			$editpath = WEB_PATH.'/'.G_ADMIN_DIR.'/content/article_edit/';
		}
		
			
		include $this->tpl(ROUTE_M,"position.con_list");
	}
	
	public function del(){
		$posid=intval($this->segment(4));		
		$this->db->Query("DELETE FROM `@#_position` WHERE (`pos_id`='$posid')");
		$this->db->Query("DELETE FROM `@#_position_data` WHERE (`pos_id`='$posid')");
		_message("删除成功",WEB_PATH.'/'.ROUTE_M.'/'.ROUTE_C."/lists");
	}	
		
	//推荐位里面的内容删除
	public function con_del(){
		$id=intval($this->segment(4));
		$posid=intval($this->segment(5));
		$this->db->Query("DELETE FROM `@#_position_data` WHERE (`id`='$id')");
		$this->Query("UPDATE `@#_position` SET `pos_this_num` = `pos_this_num` - 1 where `pos_id` = '$posid'");
		_message("移除成功");
	}
}//



?>