<?php 

defined('G_IN_SYSTEM')or exit('');
System::load_app_class('admin',G_ADMIN_DIR,'no');
System::load_sys_fun("user");
class quanzi extends admin {
	
	public function __construct(){
		parent::__construct();
		$this->ment=array(
			array("lists","圈子管理",ROUTE_M.'/'.ROUTE_C.""),
			array("addcate","添加圈子",ROUTE_M.'/'.ROUTE_C."/insert"),	
			array("addcate","待审核",ROUTE_M.'/'.ROUTE_C."/shenhe_list/tiezi"),	
			//array("addcate","帖子回复查看",ROUTE_M.'/'.ROUTE_C."/liuyan"),
		);
		$this->db=System::load_sys_class("model");
	} 
	
	
	
	/*审核帖子*/	
	public function shenhe_list(){
	
		$types = $this->segment(4);
		
		if($types == 'tiezi'){
			$sql1 = "SELECT COUNT(id) FROM `@#_quanzi_tiezi` WHERE `tiezi` = '0' and `shenhe` = 'N'";
			$sql2 = "SELECT * FROM `@#_quanzi_tiezi` WHERE `tiezi` = '0' and `shenhe` = 'N'";
		}else{
			$sql1 = "SELECT COUNT(id) FROM `@#_quanzi_tiezi` WHERE `tiezi` != '0' and `shenhe` = 'N'";
			$sql2 = "SELECT * FROM `@#_quanzi_tiezi` WHERE `tiezi` != '0' and `shenhe` = 'N'";
		}
		
	
		$num=20;
		$total=$this->db->GetCount($sql1);
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,$num,$pagenum,"0");
		$glist=$this->db->GetPage($sql2,array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));

		include $this->tpl(ROUTE_M,'quanzi.shenhe');
	}
	
	/*显示全部圈子*/
	public function init(){	
		$quanzi=$this->db->GetList("select * from `@#_quanzi` where 1");
		include $this->tpl(ROUTE_M,'quanzi.list');
	}
	
	/*显示添加圈子*/
	public function insert(){
		if(isset($_POST["submit"]))
		{
			if($_POST['title']==null)_message("圈子名不能为空",null,3);
			$title= htmlspecialchars($_POST['title']);
			
			$guanli= htmlspecialchars($_POST['guanli']);
			$glfatie= htmlspecialchars($_POST['glfatie']);
			$huifu= htmlspecialchars($_POST['huifu']);
			$shenhe= htmlspecialchars($_POST['shenhe']);
			
			$checkemail=_checkemail($guanli);
			$checkemobile=_checkmobile($guanli);
			if($checkemail===false && $checkemobile===false){
				_message("圈子管理员信息填写错误");
			}
			$res=$this->db->GetOne("SELECT uid FROM `@#_member` WHERE `email`='$guanli' or `mobile`='$guanli'");
			if(empty($res)){
				_message("圈子管理员不存在");
			}else{
				$guanli=$res['uid'];
			}
			
			$jiaru= $_POST['jiaru'];
			$jianjie=htmlspecialchars($_POST['jianjie']);
			$gongao=htmlspecialchars($_POST['gongao']);
			$time= time();			
			$img = htmlspecialchars($_POST['img']);
			$this->db->Query("INSERT INTO `@#_quanzi`(title,img,guanli,jianjie,gongao,jiaru,time,glfatie,huifu,shenhe)VALUES('$title','$img','$guanli','$jianjie','$gongao','$jiaru','$time','$glfatie','$huifu','$shenhe')");
			_message("添加成功");
		}
		include $this->tpl(ROUTE_M,'quanzi.insert');
	}
	
	/*圈子修改*/
	public function quanzi_update(){
		$id=intval($this->segment(4));
		$quanzi=$this->db->GetOne("select * from `@#_quanzi` where `id`='$id'");
		$member=$this->db->GetOne("select email,mobile from `@#_member` where `uid`='$quanzi[guanli]'");
		if(!$quanzi)_message("参数错误");
		
		if(isset($_POST["submit"])){
			if($_POST['title']==null)_message("圈子名不能为空");
			$title= htmlspecialchars($_POST['title']);
			$glfatie= htmlspecialchars($_POST['glfatie']);
			$huifu= htmlspecialchars($_POST['huifu']);
			$guanli= htmlspecialchars($_POST['guanli']);
			$shenhe= htmlspecialchars($_POST['shenhe']);
			
			$checkemail=_checkemail($guanli);
			$checkemobile=_checkmobile($guanli);
			if($checkemail===false && $checkemobile===false){
				_message("圈子管理员信息填写错误");
			}
			$res=$this->db->GetOne("SELECT uid FROM `@#_member` WHERE `email`='$guanli' or `mobile`='$guanli'");
			if(empty($res)){
				_message("圈子管理员不存在");
			}else{
				$guanli=$res['uid'];
			}
			
			$jiaru= $_POST['jiaru'];
			$jianjie=htmlspecialchars($_POST['jianjie']);
			$gongao=htmlspecialchars($_POST['gongao']);
			$time= time();
			$img = htmlspecialchars($_POST['img']);				
			$this->db->Query("UPDATE `@#_quanzi` SET title='$title',img='$img',glfatie='$glfatie',huifu='$huifu',shenhe='$shenhe',guanli='$guanli',jianjie='$jianjie',gongao='$gongao',jiaru='$jiaru',time='$time' where`id`='$id'");
			_message("修改成功");
		}		
				
		include $this->tpl(ROUTE_M,'quanzi.update');
	}
	
	/*显示圈子里面全部帖子*/
	public function tiezi(){
		$qzid = intval($this->segment(4));	
		if(!$qzid)_message("参数错误");
		$num=20;
		$total=$this->db->GetCount("select * from `@#_quanzi_tiezi` where `qzid`= '$qzid'"); 
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){
			$pagenum=$_GET['p'];
		}else{$pagenum=1;}		
		$page->config($total,$num,$pagenum,"0"); 
		if($pagenum>$page->page){
			$pagenum=$page->page;
		}	
		$tiezi=$this->db->GetPage("select * from `@#_quanzi_tiezi` where `qzid`= '$qzid'",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));		
		include $this->tpl(ROUTE_M,'quanzi.tiezi');
	}
	
	/*帖子修改*/
	public function tiezi_update(){
		$id=$this->segment(4);
		if(isset($_POST["submit"])){
			$title= $_POST['title'];
			$neirong= $_POST['neirong'];
			$zhiding= $_POST['zhiding'];
			if($title==null || $neirong==null){
				_message("不能为空");
			}
			$this->db->Query("UPDATE `@#_quanzi_tiezi` SET `title`='$title',`neirong`='$neirong',`zhiding`='$zhiding' where`id`='$id'");
			_message("修改成功",WEB_PATH."/group/quanzi/");
		}
		$tiezi=$this->db->GetOne("select * from `@#_quanzi_tiezi` where `id`='$id'");
		
		include $this->tpl(ROUTE_M,'quanzi.tiezi.update');
	}
	
	//显示全部留言
	public function liuyan(){
		
		$tiezi=$this->db->getlist("select * from `@#_quanzi_tiezi` ");
		$num=20;
		$total=$this->db->GetCount("select * from `@#_quanzi_hueifu`"); 
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){
			$pagenum=$_GET['p'];
		}else{$pagenum=1;}		
		$page->config($total,$num,$pagenum,"0"); 
		if($pagenum>$page->page){
			$pagenum=$page->page;			
		}	
		$hueifu=$this->db->GetPage("select * from `@#_quanzi_hueifu`",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));		
		include $this->tpl(ROUTE_M,'quanzi.liuyan');
	}
	
	
	
	/*删除圈子或者帖子或者回复*/
	public function del(){
		$deltype = $this->segment(4);	
		$id=intval($this->segment(5));
		if(!in_array($deltype,array("quanzi","quanzi_tiezi","quanzi_hueifu")) || !$id){
			_message("参数错误!");		
		}
		if($deltype == 'quanzi'){
			$q = $this->db->Query("DELETE FROM `@#_quanzi` where `id`='$id'");
			$q = $this->db->Query("DELETE FROM `@#_quanzi_tiezi` where `qzid`='$id'");	
			//$q = $this->db->Query("DELETE FROM `@#_quanzi_hueifu` where `qzid`='$id'");
		}
		if($deltype == 'quanzi_tiezi'){	
			$this->db->Query("DELETE FROM `@#_quanzi_tiezi` where `id`='$id'");	
			//$this->db->Query("DELETE FROM `@#_quanzi_hueifu` where `tzid`='$id'");
		}
		if($deltype == 'quanzi_hueifu'){		
			$this->db->Query("DELETE FROM `@#_quanzi_hueifu` where `id`='$id'");
		}
		_message("删除成功");
	}
	
	/*帖子或者回复审核*/
	public function shenhe(){
		$id=intval($this->segment(4));
		$q = $this->db->Query("UPDATE `@#_quanzi_tiezi` SET `shenhe` = 'Y' WHERE `id` = '$id'");
		_message("审核成功");
	
	}
}

?>