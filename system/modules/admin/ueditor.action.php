<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin',G_ADMIN_DIR,'no');
class ueditor extends admin {
	
	public function __construct(){
		parent::__construct();
		
	}
	
	public function upimage(){

		//System::load_app_class('Uploader','','no');
		//上传图片框中的描述表单名称，
		//$title = htmlspecialchars($_POST['pictitle'], ENT_QUOTES);
		//$path = htmlspecialchars($_POST['dir'], ENT_QUOTES);
		
		if(!isset($_POST['pictitle']) && !isset($_FILES['upfile'])){
			exit;
		}
		$title = $_POST['pictitle'];
		$path=G_UPLOAD.'shopimg/';
		System::load_sys_class('upload','sys','no');
		upload::upload_config(array('png','jpg','jpeg','gif'),500000,'shopimg');
		upload::go_upload($_FILES['upfile']);
		
		if(!upload::$ok){
			$url='';
			$title=$title;
			$originalName='';
			$state=upload::$error;
		}else{
			$url=G_UPLOAD_PATH.'/shopimg/'.upload::$filedir."/".upload::$filename;
			$title=$title;
			$originalName='';
			$state='SUCCESS';
		}			
		echo "{'url':'".$url."','title':'".$title."','original':'".$originalName."','state':'".$state ."'}";
		//{'url':'upload/20130728/13749880933714.jpg','title':'梨花.jpg','original':'梨花.jpg','state':'SUCCESS'}
		
	}
	
}

?>