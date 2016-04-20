<?php

/**
 *  application.class.php 应用程序创建类
 * 
 */
 class application {
	private $param;
	public function __construct() {
		global $_cfg;
		$this->param =System::load_sys_class('param');
		define('ROUTE_M', $this->param->route_m());
		define('ROUTE_C', $this->param->route_c());
		define('ROUTE_A', $this->param->route_a());
		$_cfg['route_m'] = ROUTE_M;  //go
		$_cfg['route_c'] = ROUTE_C;  //index
		$_cfg['route_a'] = ROUTE_A;	 //init
		$this->global_start();
		$this->global_init();
		$this->global_end();
	}
	
	
	private function global_init(){
		
		//system/modules/go/index.action.php
		$FilePath=G_SYSTEM.'modules'.DIRECTORY_SEPARATOR.ROUTE_M.DIRECTORY_SEPARATOR.ROUTE_C.".action.php";		
		global $_cfg;$controller=$this->global_controller($FilePath);$controller->_cfg=&$_cfg;	
		if(method_exists($controller,ROUTE_A)){	
				call_user_func(array($controller,ROUTE_A));
		}else{
			_error('Action does not exist.','...');
			exit();
		}
	}

	private function global_controller($filepath){	
		if(file_exists($filepath)){					
			include $filepath;
			$incname=ROUTE_C;
			if (class_exists($incname)) {
				return new $incname;
			}else{
				_error('The "'.$incname.'" class does not exist.','...');
				exit();	
			}			
		}else{
			_error('Module or Controller does not exist.','Please verify that the path is correct.');
			exit();	
		}
	 }
	 
	 private function global_start(){
		 if(!System::load_sys_config('system','web_off')){
			$admin_dir = System::load_sys_config('system','admindir');
			if($admin_dir !== ROUTE_M){
				echo htmlspecialchars_decode(System::load_sys_config('system','web_off_text'));
				exit;
			}
		}	
		
	 }
	 
	 private function  global_end(){			
			if(defined("G_BANBEN_ERROR")){
				$content = ob_get_contents();ob_end_clean();
				preg_match_all("/<title>(.*)<\/title>/",$content,$rusult,PREG_PATTERN_ORDER);		
				if(!empty($rusult[1])){
					echo str_ireplace("</html>","",$content).base64_decode(G_BANBEN_ERROR)."</html>";
				}else{
					echo $content;
				}
			}
	 }	 
	
 }