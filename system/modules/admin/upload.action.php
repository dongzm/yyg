<?php 
defined('G_IN_SYSTEM')or exit('');
System::load_app_class('admin','','no');
class upload extends admin {
	public function __construct(){
		parent::__construct();
		$this->db=$this->DB();
		$this->ment=array(
						array("file","上传文件管理",ROUTE_M.'/'.ROUTE_C."/lists"),
		);
	}
	
	//文件读取
	public function lists(){		
		if($this->segment(4)){
			 $dir=trim($this->segment(4),'-');
			 $dir=str_replace("-",DIRECTORY_SEPARATOR,$dir);
			 $dirpath = G_UPLOAD.$dir;
			 $ipath=G_MODULE_PATH.'/upload/lists/'.$this->segment(4);
			 $opath=G_UPLOAD_PATH.'/'.$dir;
		}else{
			$dirpath = G_UPLOAD;
			$ipath=G_MODULE_PATH.'/upload/lists/';	
			$opath=G_UPLOAD_PATH;
		}		
	
		$arr=array();
		if(file_exists($dirpath)){
			if ($dh = opendir($dirpath)){
				while (($file = readdir($dh)) !== false){					
					$file=mb_convert_encoding ($file,'UTF-8','GBK');
					if($file!="." && $file!=".."){						
						if(is_dir($dirpath.DIRECTORY_SEPARATOR.$file)){							
							$arr[]=array("type"=>"目录","name"=>$file,"url"=>$ipath.$file.'-');
						}else{
							$arr[]=array("type"=>"文件","name"=>$file,"url"=>$opath.'/'.$file);					
						}						
					}
				}
				closedir($dh);
			}
		}		
		include $this->tpl(ROUTE_M,'upload.lists');	
	}
	
}//

?>