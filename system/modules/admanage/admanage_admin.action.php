<?php

defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('admin',G_ADMIN_DIR,'no');
class admanage_admin extends admin {
	private $db;
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class("model");
		$this->ment=array(
						array("lists","广告位管理",ROUTE_M.'/'.ROUTE_C."/adarea"),
						array("doadarea","广告位添加",ROUTE_M.'/'.ROUTE_C."/doadarea"),
						array("admanage","广告管理",ROUTE_M.'/'.ROUTE_C."/admanage"),
						array("adadd","广告添加",ROUTE_M.'/'.ROUTE_C."/adadd"),
		);
		
	}
	public function init(){
		$arr=$this->db->Getlist("select a.*,b.title name from `@#_ad_data` a left join `@#_ad_area` b on a.aid=b.id");

		include $this->tpl(ROUTE_M,'admanage');
	}
	
	public function adarea(){
		$arr=$this->db->Getlist("select * from `@#_ad_area` where 1");
		include $this->tpl(ROUTE_M,'adarea');
	}
	
	public function admanage(){
		$arr=$this->db->Getlist("select a.*,b.title name from `@#_ad_data` a left join `@#_ad_area` b on a.aid=b.id");
		include $this->tpl(ROUTE_M,'admanage');
	}
	//添加广告
	public function adadd(){
		$arr=$this->db->Getlist("select id,title from `@#_ad_area` where 1");
		if(isset($_POST['submit'])){
			$title=htmlspecialchars(trim($_POST['title']));
			$type=htmlspecialchars(trim($_POST['type']));
			$adarea=htmlspecialchars(trim($_POST['adarea']));
			$addtime=htmlspecialchars(trim($_POST['addtime']));
			$addtime=strtotime($addtime);
			$endtime=htmlspecialchars(trim($_POST['endtime']));
			$endtime=strtotime($endtime);
			$checked=htmlspecialchars(trim($_POST['checked']));
			if(empty($title) || empty($type) || empty($adarea)){
				_message("插入失败");
			}
			if($type=="text"){
				$des=htmlspecialchars(trim($_POST['text']));
			}elseif($type=="code"){
				$des=trim($_POST['code']);
			}elseif($type=="img"){			
				$des=isset($_POST['adphoto']) ? $_POST['adphoto'] : '';	
				$des=trim($des,'.');			
			}
			$this->db->Query("INSERT INTO `@#_ad_data`(aid,title,type,content,checked,addtime,endtime)VALUES('$adarea','$title','$type','$des','$checked','$addtime','$endtime')");
			if($this->db->affected_rows()){
					_message("插入成功");
			}else{
					_message("插入失败");
			}
			
		}
		include $this->tpl(ROUTE_M,'adadd');
	}
	
	//添加广告位
	public function doadarea(){
		if(isset($_POST['submit'])){
			$name=htmlspecialchars(trim($_POST['name']));
			if(empty($name)){
				_message("广告位名称不能为空！");
				exit;
			}
			$width=htmlspecialchars(trim($_POST['width']));
			$height=htmlspecialchars(trim($_POST['height']));
			if(!is_numeric($width)){
				_message("请输入数字");
				exit;
			}
			if(!is_numeric($height)){
				_message("请输入数字");
				exit;
			}
			$des=htmlspecialchars(trim($_POST['des']));
			$checked=htmlspecialchars(trim($_POST['checked']));
			
			$this->db->Query("INSERT INTO `@#_ad_area`(title,width,height,des,checked)VALUES('$name','$width','$height','$des','$checked')");
			if($this->db->affected_rows()){
					_message("插入成功");
			}else{
					_message("插入失败");
			}
		}include $this->tpl(ROUTE_M,'adareaadd');
		
	}
	//修改广告位
	public function update_area(){
		$id=intval($this->segment(4));
		$list=$this->db->GetOne("SELECT * FROM `@#_ad_area` where `id`='$id'");
		if(!$list) _message("参数不正确");
	
		if(isset($_POST['submit'])){
			$title=htmlspecialchars($_POST['title']);
			$width=htmlspecialchars($_POST['width']);
			$height=htmlspecialchars($_POST['height']);
			$des=htmlspecialchars($_POST['des']);
			$checked=htmlspecialchars($_POST['checked']);
			$this->db->Query("UPDATE `@#_ad_area` SET `title`='$title',`width`='$width',`height`='$height',`des`='$des',`checked`='$checked' WHERE `id`='$id'");
			if($this->db->affected_rows()){
				_message("修改成功");
			}else{
				_message("修改失败");
			}
		}
		
		include $this->tpl(ROUTE_M,'update_area');
	}
	//删除广告位
	public function del_area(){
		$delid=intval($this->segment(4));
		if($delid){
			$this->db->Query("DELETE FROM `@#_ad_area` WHERE `id`='$delid'");
			if($this->db->affected_rows()){
				_message("删除成功");
			}else{
				_message("删除失败");
			}
		}
	}
	
	//删除广告
	public function del_data(){
		$delid=intval($this->segment(4));
		if($delid){
			$this->db->Query("DELETE FROM `@#_ad_data` WHERE `id`='$delid'");
			if($this->db->affected_rows()){
				_message("删除成功");
			}else{
				_message("删除失败");
			}
		}
	
	}
	
	//修改广告
	public function update_data(){
		$id=intval($this->segment(4));
		$adlist=$this->db->Getlist("SELECT a.*,b.title name FROM `@#_ad_data` a left join `@#_ad_area` b on a.aid=b.id where a.id='$id'");
		if(!$adlist) _message("参数不正确");
		$arealist=$this->db->Getlist("SELECT id,title FROM `@#_ad_area` where 1");
		
		if(isset($_POST['submit'])){
			$title=htmlspecialchars(trim($_POST['title']));
			$type=htmlspecialchars(trim($_POST['type']));
			$adarea=htmlspecialchars(trim($_POST['adarea']));
			//echo $adarea;exit;
			$addtime=htmlspecialchars(trim($_POST['addtime']));
			$addtime=strtotime($addtime);
			//echo $addtime;exit;
			$endtime=htmlspecialchars(trim($_POST['endtime']));
			$endtime=strtotime($endtime);
			$checked=htmlspecialchars(trim($_POST['checked']));
			if(empty($title) || empty($type) || empty($adarea)){_message("插入失败");}
			
			if($type=="text"){
				$des=htmlspecialchars(trim($_POST['text']));
			}elseif($type=="code"){
				$des=trim($_POST['code']);
			}elseif($type=="img"){
				$des=isset($_POST['adphoto']) ? $_POST['adphoto'] : '';	
				$des=trim($des,'.');	
			}else{
				$des=$adlist[0]['content'];
			}
			
			$this->db->Query("UPDATE `@#_ad_data` SET `aid`='$adarea',`title`='$title',`type`='$type',`content`='$des',`checked`='$checked',`addtime`='$addtime',`endtime`='$endtime' WHERE `id`='$id'");
			if($this->db->affected_rows()){
					_message("修改成功");
			}else{
					_message("修改失败");
			}
			
		}
		include $this->tpl(ROUTE_M,'update_data');
	}
}











?>