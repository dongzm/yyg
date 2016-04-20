<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin','','no');
class shop extends admin {
	private $db;
	public function __construct(){
		parent::__construct();
		$this->db=$this->DB();
        echo ROUTE_M.'/'.ROUTE_C."/lists";
		$this->ment=array(
						array("lists","商品管理",ROUTE_M.'/'.ROUTE_C."/lists"),
						array("insert","添加商品",ROUTE_M.'/'.ROUTE_C."/insert"),
		);
	}

	//商品图片上传到磁盘
	public function shop_img_insert(){
	
		if(is_array($_FILES['Filedata'])){		
			System::load_sys_class('upload','sys','no');
			upload::upload_config(array('png','jpg','jpeg','gif'),500000,'shopimg');
			upload::go_upload($_FILES['Filedata']);
			$msg=array();
			if(!upload::$ok){
				$msg['ok']='no';
				$msg['text']=upload::$error;
			}else{
				$msg['ok']='yes';
				$msg['text']=upload::$filedir."/".upload::$filename;				
			}	
			echo json_encode($msg);	
		}
		
	}
	//商品展示图片从磁盘删除
	public function shop_img_del(){		
		$action=isset($_GET['action']) ? $_GET['action'] : null; 
		$filename=isset($_GET['filename']) ? $_GET['filename'] : null;
		if($action=='del' && !empty($filename)){
			$filename=G_UPLOAD.'shopimg/'.$filename;			
			$size=getimagesize($filename);			
			$filetype=explode('/',$size['mime']);			
			if($filetype[0]!='image'){
				return false;
				exit;
			}
			unlink($filename);
			exit;
		}
	}
}

?>