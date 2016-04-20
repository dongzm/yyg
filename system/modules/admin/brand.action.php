<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin','','no');
class brand extends admin {
	private $db;
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class("model");
		$this->ment=array(
						array("lists","品牌管理",ROUTE_M.'/'.ROUTE_C."/lists"),
						array("insert","添加品牌",ROUTE_M.'/'.ROUTE_C."/insert"),					
		);
		
	}
	
	//品牌管理
	public function lists(){
		$page=System::load_sys_class("page");
		$num=20;
		$total=$this->db->GetCount("select * from `@#_brand` where 1");
		if(isset($_GET['p'])){
			$pagenum=intval($_GET['p']);
		}else{
			$pagenum=1;
		}
		$page->config($total,$num,$pagenum);
		$brands=$this->db->GetPage("select * from `@#_brand` where 1 order by `order` DESC",array('key'=>'id','num'=>$num,"page"=>$pagenum));
		$categorys=$this->db->GetList("SELECT * FROM `@#_category` WHERE 1 order by `parentid` ASC,`cateid` ASC",array('key'=>'cateid'));
		
		include $this->tpl(ROUTE_M,'brand.list');
	}

	//品牌管理入库
	public function insert(){
		$categorys=$this->db->GetList("SELECT * FROM `@#_category` WHERE `model` = '1' order by `parentid` ASC,`cateid` ASC",array('key'=>'cateid'));
		$tree=System::load_sys_class('tree');
		$tree->icon = array('│ ','├─ ','└─ ');
		$tree->nbsp = '&nbsp;';
		$categoryshtml="<option value='\$cateid'>\$spacer\$name</option>";		
		$tree->init($categorys);
		$categoryshtml=$tree->get_tree(0,$categoryshtml);	
		if(isset($_POST['dosubmit'])){
		
			if(!isset($_POST['cateid'])){
				_message("请选择所属栏目");
			}
			if(!isset($_POST['name'])){
				_message("请填写品牌名称");
			}
			$cateidsty = '';
			
			foreach($_POST['cateid'] as $cateid){
				$cateidsty .= intval($cateid).",";	
			}
			$cateidsty = trim($cateidsty,",");
			
		
			$name=htmlspecialchars($_POST['name']);
			$order=intval($_POST['order']) ? intval($_POST['order']) : 1;
			$sql="INSERT INTO `@#_brand` (`cateid`, `name`,`order`) VALUES ('$cateidsty', '$name','$order')";			
			$this->db->Query($sql);
			if($this->db->affected_rows()){			
				_message("操作成功!",WEB_PATH.'/'.ROUTE_M.'/brand/lists');
			}else{
				_message("操作失败!");
			}
		}
		
		include $this->tpl(ROUTE_M,'brand.edit');
	}
	//修改品牌
	public function edit(){
		$brandid=intval($this->segment(4));		
		$brands=$this->DB()->Getone("select * from `@#_brand` where id='$brandid'");
		if(!$brands)_message("参数错误!");
		$categorys=$this->db->GetList("SELECT * FROM `@#_category` WHERE `model` = '1' order by `parentid` ASC,`cateid` ASC",array('key'=>'cateid'));		
		$tree=System::load_sys_class('tree');
		$tree->icon = array('│ ','├─ ','└─ ');
		$tree->nbsp = '&nbsp;';
		$categoryshtml="<option value='\$cateid'>\$spacer\$name</option>";		
		$tree->init($categorys);
		$categoryshtml=$tree->get_tree(0,$categoryshtml);	
		
		
		
		if(isset($_POST['dosubmit'])){
			$info=array();
			
			if(!isset($_POST['cateid'])){
				_message("请选择所属栏目");
			}			
			$cateidsty = '';
			
			foreach($_POST['cateid'] as $cateid){
				$cateidsty .= intval($cateid).",";
			}
			$cateidsty = trim($cateidsty,",");
									
			
			$info['name']=htmlspecialchars($_POST['name']);
			$info['order']=intval($_POST['order']) ? intval($_POST['order']) : 1;
			$sql="UPDATE `@#_brand` SET `cateid`='$cateidsty', `name`='$info[name]', `order`='$info[order]' WHERE (`id`='$brandid') LIMIT 1";			
			$this->db->Query($sql);
			if($this->db->affected_rows()){			
				_message("操作成功!",WEB_PATH.'/'.ROUTE_M.'/brand/lists');
			}else{
				_message("操作失败!");
			}
		}		
		
		
		$cateid_arr =  explode(",",$brands['cateid']);	
		
		include $this->tpl(ROUTE_M,'brand.edit');	
	}

	//删除品牌管理
	public function del(){
		$brandid=intval($this->segment(4));
		if(!$brandid)_message("参数错误!");		
		$this->db->Query("delete from `@#_brand` where id='$brandid' LIMIT 1");
		if($this->db->affected_rows()){			
				_message("操作成功!",WEB_PATH.'/'.ROUTE_M.'/brand/lists');
		}else{
				_message("操作失败!");
		}
	}
	
	
	/*
	*	品牌排序
	*/	
	public function listorder(){		
		if($this->segment(4)=='dosubmit'){
			foreach($_POST['listorders'] as $id => $listorder){
				$this->db->Query("UPDATE `@#_brand` SET `order` = '$listorder' where `id` = '$id'");		
			}				
			_message("排序更新成功");
		}else{
			_message("请排序");
		}		
	}//
		
	
}

?>