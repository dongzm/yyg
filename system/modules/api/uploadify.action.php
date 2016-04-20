<?php

defined('G_IN_SYSTEM')or exit('No permission resources.');
//AJAX uploadify 上传
class uploadify extends SystemAction {



	/*
	*	@上传图片
	*	@参数1 	$title	标题
	*	@参数2 	$type	上传类型
	*	缩略图上传/image/image/1/500000/uploadify/picurl/undefined
	*/	
	public function upload(){
		
		$getinfo=$this->segment_array();		
		//var_dump($getinfo);		
		$title=isset($getinfo[4]) ? htmlspecialchars($getinfo[4]) : '';		//标题
		$type=isset($getinfo[5]) ? htmlspecialchars($getinfo[5]) : '';		//上传类型
		$path=isset($getinfo[6]) ? htmlspecialchars($getinfo[6]) : '';		//上传的文件夹
		$num=isset($getinfo[7]) ? intval($getinfo[7]) : 0;					//上传个数
		$size=isset($getinfo[8]) ? intval($getinfo[8]) : 0;					//最大size大小
		$frame=isset($getinfo[9]) ? htmlspecialchars($getinfo[9]) : '';		//iframe的ID
		$input=isset($getinfo[10]) ? htmlspecialchars($getinfo[10]) : '';	//父框架保存图片地址的input的id
		$func=isset($getinfo[11]) ? htmlspecialchars($getinfo[11]) : '';	//父框架保存图片地址的input的id
		
		$desc=$type;														//类型描述
		
		$title = urldecode($title);		
		if(!_is_utf8($title)){
			$title =  iconv("GBK", "UTF-8", $title);
		}	
		
		$size_str=$this->getsize($size,false);
		$uptype=$this->getUPtype($type,false);
		$check=_getcookie("AID").'&'._getcookie("ASHELL");
		
		
		System::load_app_class("admin",G_ADMIN_DIR,"no");
		$admincheck = admin::StaticCheckAdminInfo() ? 1 : 0;
		
		include $this->tpl(ROUTE_M,'uploadify');
	}
	
	public function insert(){
	
		$msg=array();
		$path=isset($_POST['path']) ? _encrypt($_POST['path'],'DECODE') : '';
		$size=isset($_POST['size']) ? _encrypt($_POST['size'],'DECODE') : 0;
		$type=isset($_POST['type']) ? _encrypt($_POST['type'],'DECODE') : 'image';
		$type=explode(',',$this->getUPtype($type,true));		
		$watermark = ($_POST['iswatermark'] == "true") ? "yes" : "no";
	
				
		if(!is_dir(G_UPLOAD.$path)){
			$msg['ok']='no';
			$msg['text']=$path."文件夹不存在";
			echo json_encode($msg);
			exit;
		}
		
		System::load_app_class("admin",G_ADMIN_DIR,"no");
		$admincheck = admin::StaticCheckAdminInfo() ? 1 : 0;
		
		if(is_array($_FILES['Filedata'])){		
			System::load_sys_class('upload','sys','no');
			upload::upload_config($type,$size,$path);
			upload::go_upload($_FILES['Filedata'],$watermark);		
			if(!upload::$ok){
				$msg['ok']='no';
				$msg['text']=upload::$error;			
			}else{
				$msg['ok']='yes';
				$msg['text']=$path.'/'.upload::$filedir."/".upload::$filename;				
			}	
			echo json_encode($msg);	
		}
	}	
	/*
		删除上传的图片
	*/
	public function delupload(){
		$action=isset($_GET['action']) ? $_GET['action'] : null; 
		$filename=isset($_GET['filename']) ? $_GET['filename'] : null;
		$filename=str_replace('../','',$filename);
		$filename=trim($filename,'.');
		$filename=trim($filename,'/');		
		if($action=='del' && !empty($filename)){
			$filename=G_UPLOAD.$filename;			
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
	/*
		获取上传类型
		@type 类型	imgage ,soft , media
		@arr  是否返回数组
	*/
	private function getUPtype($type,$arr=false){
		$typearr=array('up_image_type','up_soft_type','up_media_type');
		if($type == 'image')
			$uptype = System::load_sys_config('upload','up_image_type');
		if($type == 'soft')
			$uptype  =System::load_sys_config('upload','up_soft_type');
		if($type == 'media')
			$uptype  =System::load_sys_config('upload','up_media_type');
		if(!$uptype)
			$uptype =System::load_sys_config('upload','up_image_type');
		if($arr){
			return $uptype;
		}	
		
		$uptype = explode(',',$uptype);
		$html='';
		foreach($uptype as $v){
			$html.="*.".$v.';';
		}
		return $html;
	}	
	/*
		@计算上传大小
		@size 数据大小
		@xi	  是否返回详细
	*/
	private function getsize($size=0,$xi=false){
		$maxsize=System::load_sys_config('upload','upsize');		
		if($size > $maxsize || $size < 1) $size=$maxsize;			
		$units = array(3=>'G',2=>'M',1=>'KB',0=>'B');//单位字符,可类推添加更多字符.
		$str='';
		foreach($units as $i => $unit){
			if($i>0){
                $n = $size / pow(1024,$i) % pow(1024,$i);			   
			}else{
                $n = $size;
			}                
			if($n!=0){
                $str.=" $n{$unit} ";
				if(!$xi)
					return $str;
			}			
		}
		return  $str;
	}	
	
}

?>