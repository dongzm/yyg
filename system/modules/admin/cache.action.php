<?php 

defined('G_IN_SYSTEM')or exit('');
System::load_app_class('admin','','no');
System::load_app_fun('global');
set_time_limit(0);
class cache extends admin {
	
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class('model');
	}
	
	public function init(){
		if(isset($_POST['dosubmit'])){
			$c_ok ='';
			if(isset($_POST['cache']['template'])){
				$c_ok .= $this->tempcache();					
			}
			if(isset($_POST['cache']['file_cache'])){			
				$c_ok .= $this->upfulecache();				
			}
			if(isset($_POST['cache']['logs_cache'])){			
				$c_ok .= $this->uplogscache();				
			}
			if(isset($_POST['cache']['admin_log_cache'])){			
				$c_ok .= $this->admin_log_cache();				
			}
			
			_message($c_ok);
			
		}

		include $this->tpl(ROUTE_M,'cache');
	}
	
	private function admin_log_cache(){
		$this_day_file = "admin.log.".date("Y-m-d").".php";
		$path = G_CACHES.'caches_log'.DIRECTORY_SEPARATOR;
		$logs = Preg_Files('/^admin\.log\.(.*)\.php/i',$path);
		
		foreach($logs as $log){
			if($log[0] != $this_day_file){
				unlink($path.$log[0]);
			}
		}
		$text = "\n".date("Y-m-d H:i:s")."更新了全站缓存"."\n";
		
		file_put_contents($path.$this_day_file,$text,FILE_APPEND);	
		return "管理员操作日志缓存更新成功!<br/>";
	
	}
	private function uplogscache(){
		$path = G_CACHES;
		$errors  = Preg_Files('/^error(.*)\.logs/i',$path);
		
		foreach($errors as $f){
			if(!is_dir($path.$f[0])){
				unlink($path.$f[0]);
			}
		}
		


		return "错误日志缓存更新成功!<br/>";
	
	}
	
	private function upfulecache(){
		$path = G_CACHES.'caches_upfile'.DIRECTORY_SEPARATOR;
		if(file_exists($path)){
			$ret = $this->tempdeldir($path);
			if($ret){
				mkdir($path,0777, true)or die("Not Dir");		
				chmod($path,0777);
				return "文件缓存更新成功!<br/>";
			}else{
				return "文件缓存更新失败!<br/>";
			}
		}
		
	}	
	
	
	private function tempcache(){
		$path = G_CACHES.'caches_template'.DIRECTORY_SEPARATOR.G_STYLE.DIRECTORY_SEPARATOR;
		if(file_exists($path)){
			$ret = $this->tempdeldir($path);
			if($ret){
				return "模板缓存更新成功!<br/>";
			}else{
				return "模板缓存更新失败!<br/>";
			}
		}
		
	}	
	
	//删除目录
	private function tempdeldir($dir){
		$dh = opendir($dir);
		while ($file = readdir($dh)){
			if ($file != "." && $file != ".."){
				 $fullpath = $dir . "/" . $file;
				 if (!is_dir($fullpath)){
					unlink($fullpath);
				 }else{
					$this->tempdeldir($fullpath);
				 }
			  }
		}
		closedir($dh);
		if(@rmdir($dir)){
			  return true;
		}else{
			  return false;
		}
	}
	
	
}