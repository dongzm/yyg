<?php

/**
 * System.class.php
 *
 * @copyright			(C) 2005-2010 战线
 * @license				V3.1.2
 * @lastmodify			2014-05-21
 */
 
final class System {

	/***************************************************************/
	/***************************************************************/
	/***************************************************************/
	//调用系统类文件	new 是否实例化 module 是模块还是系统
	public static function load_sys_class($class_name='',$module='sys',$new='yes'){
			
			//数组
			static $classes = array();
			//获取php文件夹路径
			$path=self::load_class_file_name($class_name,$module);
			$key=md5($class_name.$path.$new);		
			if (isset($classes[$key])) {
				return $classes[$key];  //已经存在直接返回
			}
			if(file_exists($path)){ //文件夹存在
				include_once $path;//导入文件
				if($new=='yes'){
					$classes[$key] = new $class_name; //实例化对象		
				}else{					
					$classes[$key]=true;	
				}				
				return $classes[$key];			
			}else{ //文件夹不存在
				_error('load system class file: '.$module." / ".$class_name,'The file does not exist');
			}
				
	}
	
	/***************************************************************/
	/***************************************************************/
	/***************************************************************/
	//调用模块应用类
	public static function load_app_class($class_name='',$module='',$new='yes'){
			if(empty($module)){
				$module=ROUTE_M;
			}
			return self::load_sys_class($class_name,$module,$new);
	}

	/***************************************************************/
	/***************************************************************/
	/***************************************************************/	
	public static function load_class_file_name($class_name='',$module='sys'){		
		static $filename = array();
		//如果存在$filename[$module.$class_name])，直接返回
		if(isset($filename[$module.$class_name])) return $filename[$module.$class_name];
		//$module==sys，获取对应的system模块下的$class_name.'.class.php'的品php文件
		if($module=='sys'){
		 	$filename[$module.$class_name]=G_SYSTEM.'libs'.DIRECTORY_SEPARATOR.$class_name.'.class.php';
		 	//获取system/modules/模块名称/lib/$class_name.'.class.php'
		}else if($module!='sys'){
			$filename[$module.$class_name]=G_SYSTEM.'modules'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR.$class_name.'.class.php';
		}else{
			return $filename[$module.$class_name];
		}
		//返回对应的php文件夹
		return $filename[$module.$class_name];
	}
		
	
	/***************************************************************/
	/***************************************************************/
	/***************************************************************/	
	/*获取数组*/
	public static function load_sys_config($filename,$keys=''){
		static $configs = array();
		if(isset($configs[$filename])){
			if (empty($keys)) {
				return $configs[$filename];
			} else if (isset($configs[$filename][$keys])) {
				return $configs[$filename][$keys];
			}else{
				return $configs[$filename];
			}
		}			
		if (file_exists(G_CONFIG.$filename.'.inc.php')){
				$configs[$filename]=include G_CONFIG.$filename.'.inc.php';
				if(empty($keys)){
					return $configs[$filename];
				}else{
					return $configs[$filename][$keys];
				}
		}
		
		_error('load system config file: '.$filename,'The file does not exist+');	
	}
		
	/***************************************************************/
	/***************************************************************/
	/***************************************************************/	
	public static function load_app_config($filename,$keys='',$module=''){
		static $configs = array();	
		if(isset($configs[$filename])){
			if (empty($keys)) {
				return $configs[$filename];
			} else if (isset($configs[$filename][$keys])) {
				return $configs[$filename][$keys];
			}else{
				return $configs[$filename];
			}
		}
		if(empty($module))$module=ROUTE_M;
		$path=G_SYSTEM.'modules'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.$filename.'.ini.php';		
		if (file_exists($path)){
				$configs[$filename]=include $path;
				if(empty($keys)){
					return $configs[$filename];
				}else{
					return $configs[$filename][$keys];
				}
		}	
		_error('load app config file: '.$module." / ".$filename,'The file does not exist');			
	}
	/***************************************************************/
	/***************************************************************/
	/***************************************************************/
	//函数文件名和所在模块
	public static function load_sys_fun($fun_name){
		static $funcs = array();
		$path=G_SYSTEM.'funcs'.DIRECTORY_SEPARATOR.$fun_name.'.fun.php';	
		$key = md5($path);
		if (isset($funcs[$key])) return true;
		if (file_exists($path)){
			$funcs[$key] = true;
			return include $path;
		}else{
			$funcs[$key] = false;
			_error('load system function file: '.$fun_name,'The file does not exist');
		}
	
	}
	
	
	/***************************************************************/
	/***************************************************************/
	/***************************************************************/
	//函数文件名和所在模块
	public static function load_app_fun($fun_name,$module=null){
		static $funcs = array();		
		if(empty($module)){
			$module=ROUTE_M;
		}
		$path=G_SYSTEM.'modules'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.$fun_name.'.fun.php';	
		$key = md5($path);
		if (isset($funcs[$key])) return true;
		if (file_exists($path)){
			$funcs[$key] = true;
			return include $path;
		}else{			
			_error('load app function file: '.$module." / ".$fun_name,'The file does not exist');
		}	
	}
	
	/***************************************************************/
	/***************************************************************/
	/***************************************************************/
	//数据模块操作类	
	public static function load_app_model($model_name='',$module='',$new='yes'){			
		static $models=array();
		if(empty($module)){
				$module=ROUTE_M;
		}
		$key=md5($module.$model_name.$new);
		if(isset($models[$key])){
			return $models[$key];
		}		
		$path=G_SYSTEM.'modules'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.$model_name.'.model.php';
		if (file_exists($path)){
			include $path;
			if($new=='yes'){			
				$models[$key]=new $model_name;				
			}else if($new=='no'){				
				$models[$key]=true;
			}
			return $models[$key];
		}
		_error('load app model file: '.$module." / ".$model_name,'The file does not exist');
		
	}
	/***************************************************************/
	
	public static function CreateApp(){
		return self::load_sys_class('application');
	}
}

?>