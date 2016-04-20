<?php 

defined('G_IN_SYSTEM')or exit('');
System::load_app_class('admin',G_ADMIN_DIR,'no');
class quanzi extends admin {
	
	public function __construct(){
		parent::__construct();
		$this->ment=array(
			array("lists","圈子管理",ROUTE_M.'/'.ROUTE_C.""),
			array("addcate","添加圈子",ROUTE_M.'/'.ROUTE_C."/insert"),
			array("addcate","帖子查看",ROUTE_M.'/'.ROUTE_C."/tiezi"),
			array("addcate","帖子回复查看",ROUTE_M.'/'.ROUTE_C."/liuyan"),
		);
		$this->db=$this->DB();
	} 
	//显示全部圈子
	public function init(){	
		$quanzi=$this->db->GetList("select * from `@#_quanzi` where 1");		
		include $this->tpl(ROUTE_M,'quanzi.list');		
	}
	//显示添加圈子
	public function insert(){
		if(isset($_POST["submit"]))
		{
			if($_POST['title']==null)_message("圈子名不能为空",null,3);
			$title= htmlspecialchars($_POST['title']);
			$guanli= intval($_POST['guanli']);
			$jiaru= $_POST['jiaru'];
			$jianjie=htmlspecialchars($_POST['jianjie']);
			$gongao=htmlspecialchars($_POST['gongao']);
			$time= time();			
			System::load_sys_class('upload','sys','no');
			upload::upload_config(array('png','jpg','jpeg','gif'),500000,'quanzi');
			upload::go_upload($_FILES['img']);			
			if(!upload::$ok){
				 _message(upload::$error,null,3);
			}else{
				$img=upload::$filedir."/".upload::$filename;					
				$size=getimagesize(G_UPLOAD_PATH."/quanzi/".$img);
				$max=120;$w=$size[0];$h=$size[1];
				if($w>120 or $h>120){
					if($w>$h){
						$w2=$max;
						$h2=$h*($max/$w);
						upload::thumbs($w2,$h2,1);						
					}else{
						$h2=$max;
						$w2=$w*($max/$h);
						upload::thumbs($w2,$h2,1);
					}
				}				
			}			
			$this->db->Query("INSERT INTO `@#_quanzi`(title,img,guanli,jianjie,gongao,jiaru,time)VALUES('$title','$img','$guanli','$jianjie','$gongao','$jiaru','$time')");
			_message("添加成功");
		}
		include $this->tpl(ROUTE_M,'quanzi.insert');
	}
	public function quanzi_update(){
		$id=intval($this->segment(4));
		$quanzi=$this->db->GetOne("select * from `@#_quanzi` where `id`='$id'");
		if(!$quanzi)_message("参数错误");
		if(isset($_POST["submit"])){
			if($_POST['title']==null)_message("圈子名不能为空");
			$title= htmlspecialchars($_POST['title']);
			$guanli= intval($_POST['guanli']);
			$jiaru= $_POST['jiaru'];
			$jianjie=htmlspecialchars($_POST['jianjie']);
			$gongao=htmlspecialchars($_POST['gongao']);
			$time= time();
			if(isset($_FILES['img'])){
				System::load_sys_class('upload','sys','no');
				upload::upload_config(array('png','jpg','jpeg','gif'),500000,'quanzi');
				upload::go_upload($_FILES['img']);
				if(!upload::$ok){
					 _message(upload::$error,null,3);				
				}else{
					$img=upload::$filedir."/".upload::$filename;					
					$size=getimagesize(G_UPLOAD_PATH."/quanzi/".$img);
					$max=120;$w=$size[0];$h=$size[1];
					if($w>120 or $h>120){
						if($w>$h){
							$w2=$max;
							$h2=$h*($max/$w);
							upload::thumbs($w2,$h2,1);						
						}else{
							$h2=$max;
							$w2=$w*($max/$h);
							upload::thumbs($w2,$h2,1);
						}
					}				
				}			
			}else{
				$img=$_POST['imgold'];
			}			
			$this->db->Query("UPDATE `@#_quanzi` SET title='$title',img='$img',guanli='$guanli',jianjie='$jianjie',gongao='$gongao',jiaru='$jiaru',time='$time' where`id`='$id'");
			_message("修改成功",WEB_PATH."/admin/quanzi");
		}		
				
		include $this->tpl(ROUTE_M,'quanzi.update');
	}
	//显示全部帖子
	public function tiezi(){
		$quanzi=$this->db->getlist("select * from `@#_quanzi` ");
		$num=20;
		$total=$this->db->GetCount("select * from `@#_quanzi_tiezi`"); 
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){
			$pagenum=$_GET['p'];
		}else{$pagenum=1;}		
		$page->config($total,$num,$pagenum,"0"); 
		if($pagenum>$page->page){
			$pagenum=$page->page;
		}	
		$tiezi=$this->db->GetPage("select * from `@#_quanzi_tiezi`",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));		
		include $this->tpl(ROUTE_M,'quanzi.tiezi');
	}
	public function tiezi_update(){
		$id=intval($_GET['id']);
		if(isset($_POST["submit"])){
			$title= $_POST['title'];
			$neirong= $_POST['neirong'];
			$zhiding= $_POST['zhiding'];
			if($title==null || $neirong==null){
				_message("不能为空");
			}
			$this->db->Query("UPDATE `@#_quanzi_tiezi` SET `title`='$title',`neirong`='$neirong',`zhiding`='$zhiding' where`id`='$id'");
			_message("修改成功",WEB_PATH."/admin/quanzi/tiezi");
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
	public function del(){
		$quanzi=$_GET['quanzi'];
		$id=intval($_GET['id']);
		if($quanzi=='quanzi' or $quanzi=='quanzi_tiezi' or $quanzi=='quanzi_hueifu'){
			$quanzix=$this->db->getlist("select * from `@#_$quanzi`  where `id`='$id' limit 1 ");
			if($quanzix){
				$this->db->Query("DELETE FROM `@#_$quanzi` where `id`='$id' ");
				_message("删除成功");
			}else{
				_message("参数错误");
			}
		}else{
			_message("参数错误");
		}		
	}
}

?>