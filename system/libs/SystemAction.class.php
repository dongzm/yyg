<?php 

/**
 *		action.class.php  基础操作动作类
 *
 */
 class SystemAction {
	static  private $route_url;
	
	final protected function DB($model='model',$module='sys'){
		static $classes = array();
		if(isset($classes[$model.$module]))return $classes[$model.$module];
		if($module=='sys'){
			return $classes[$model.$module]=System::load_sys_class($model);
		}else{		
			return $classes[$model.$module]=System::load_app_model($model,$module);
		}
		
	}
	
	/*
	* 调用模板函数
	* $module   模板目录
	* $template 模板文件名,
	* $StyleTheme    模板方案目录,为空为默认目录
	*/	
	final protected function view($module = '', $template = '',$StyleTheme=''){	
		if(empty($StyleTheme)){$style=G_STYLE.DIRECTORY_SEPARATOR.G_STYLE_HTML;}
		else{
			$templates=System::load_sys_config('templates',$style);
			$style=$templates['dir'].DIRECTORY_SEPARATOR.$templates['html'];
		}
		$FileTpl = G_CACHES.'caches_template'.DIRECTORY_SEPARATOR.dirname($style).DIRECTORY_SEPARATOR.md5($module.'.'.$template).'.tpl.php';	
		$FileHtml = G_TEMPLATES.$style.DIRECTORY_SEPARATOR.$module.'.'.$template.'.html';	
		if(file_exists($FileHtml)){		
			if (file_exists($FileTpl) && @filemtime($FileTpl) >= @filemtime($FileHtml)) {					
				return include  $FileTpl;			
			} else {			
				$template_cache=System::load_sys_class('template_cache');	
				if(!is_dir(dirname(dirname($FileTpl)))){
					mkdir(dirname(dirname($FileTpl)),0777, true)or die("Not Dir");		
				    chmod(dirname(dirname($FileTpl)),0777);
				}
				if(!is_dir(dirname($FileTpl))){		
					mkdir(dirname($FileTpl), 0777, true)or die("Not Dir");
					chmod(dirname($FileTpl),0777);
				}	
				$PutFileTpl=$template_cache->template_init($FileTpl,$FileHtml,$module,$template);
				if($PutFileTpl)
					return include  $FileTpl;					
				else				
					_error('template message','The "'.$module.'.'.$template .'" template file does not exist');
			}
		}
		_error('template message','The "'.$module.'.'.$template .'" template file does not exist');
		
	}
	
	protected function tpl($module = 'admin', $template = 'index'){	
		$file =  G_SYSTEM.'modules/'.$module.'/tpl/'.$template.'.tpl.php';
		if(file_exists($file))return $file;
		elseif(defined("G_IN_ADMIN")){
			_message("没有找到<font color='red'>".$module."</font>模块下的<font color='red'>".$template.".tpl.php</font>文件!");
		}else{
			_error('template message','The "'.$module.'.'.$template .'" template file does not exist');
		}
	}
	
	final protected function segment($n=1){		
	
		if(!isset(self::$route_url[$n])){
			return false;
		}else{
			if(strpos(self::$route_url[$n],"&p=") !== false){				
				return '';
			}else{
				return self::$route_url[$n];	
			}
		}
	}		
	final protected function segment_array(){
		return self::$route_url;
	}
	final static public function set_route_url($route_urls){	
		self::$route_url=$route_urls;
		
	}
	
 }


?>