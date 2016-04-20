<?php

/* 后台函数，更新配置文件 */
function EditConfig($file='',$name='',$value='',$daxiao='xiao'){
		static $content=array();		
		if(!isset($content[$file])){
			$content[$file]=file_get_contents(G_CONFIG.$file.'.inc.php');
			if(!is_writable(G_CONFIG.$file.'.inc.php')) _message('Please chmod  "'.$file.'"  to 0777 !');
		}
		if(empty($name))return false;
		if($daxiao=='xiao'){
			$value=strtolower(new_addslashes($value));			
		}
		if($daxiao=='da'){
			$value=strtoupper(new_addslashes($value));
		}
		if($daxiao=='no'){
			$value=new_addslashes($value);
		}
			
		$pat =	"/\'$name\'\s*=>\s*([']?)[^']*([']?)(\s*),/is";				
		$content[$file]=preg_replace($pat,"'$name' => \${1}".$value."\${2}\${3},",$content[$file]);
		file_put_contents(G_CONFIG.$file.'.inc.php',$content[$file]);
}
	
/*	获取系统信息  */
function GetSysInfo() {
		$sys_info['os']             = PHP_OS;
		$sys_info['zlib']           = function_exists('gzclose');//zlib
		$sys_info['safe_mode']      = (boolean) ini_get('safe_mode');//safe_mode = Off
		$sys_info['safe_mode_gid']  = (boolean) ini_get('safe_mode_gid');//safe_mode_gid = Off
		$sys_info['timezone']       = function_exists("date_default_timezone_get") ? date_default_timezone_get() : "no_timezone";
		$sys_info['socket']         = function_exists('fsockopen') ;
		
		$web=explode(' ',$_SERVER['SERVER_SOFTWARE']);		
		$sys_info['web_server']     = $web[0];
		$sys_info['phpv']           = phpversion();	
		$sys_info['fileupload']     = @ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown';
		$sys_info['set_time_limit'] = function_exists("set_time_limit") ? true : false;
		$sys_info['fsockopen'] = function_exists("fsockopen") ? true : false;
		
		return $sys_info;
}

/* 函数支持 */
function showResult($str=''){
	if(function_exists($str)){
		return '<font color="#1194be">支持</font>';
	}else{
		return '<font color="#f17564">不支持</font>';
	}
}


/* 栏目类型 */
function cattype($n=0){
	if($n>0){
		return '<font>内部栏目</font>';
	}
	if($n==-1){
		return '<font color="#ff0000">单网页</font>';
	}
	if($n==-2){
		return '<font color="#09f">链接</font>';
	}
}


/* 正则模板 */
function indexTemplate($zhengze=''){
	$html_root=G_TEMPLATES.DIRECTORY_SEPARATOR.G_STYLE.DIRECTORY_SEPARATOR.G_STYLE_HTML;
	$html_arr=scandir($html_root);
	if(!is_array($html_arr))return array();	
	//single.web.xxxx.html		
	$html=array();
	if(!$zhengze)return array();
	$zhengzes=$zhengze;
	foreach($html_arr as $html_path){
		//preg_match_all($zhengzes,$html_path,$matches,PREG_SET_ORDER);
		//print_r($matches);
		preg_match($zhengzes,$html_path,$matches);
		if($matches!=NULL)$html[]=$matches;
	}	
	if(!count($html)){
		return array();
	}return $html;

}

/**
*   正则文件
*	zhengze @传进规则
*	dir	    @传进路径
**/
function Preg_Files($zhengze='',$dir=''){
	if(empty($dir) || empty($zhengze) || !is_dir($dir)){
		return array();
	}	
	$html_arr=scandir($dir);
	if(!is_array($html_arr))return array();	
	$html=array();
	if(!$zhengze)return array();
	$zhengzes=$zhengze;
	foreach($html_arr as $html_path){
		preg_match($zhengzes,$html_path,$matches);
		if($matches!=NULL)$html[]=$matches;
	}	
	if(!count($html)){
		return array();
	}return $html;

}


/* 百度编辑器过滤 */
function editor_safe_replace($content){
    $tags = array(
        "'<iframe[^>]*?>.*?</iframe>'is",
        "'<frame[^>]*?>.*?</frame>'is",
        "'<script[^>]*?>.*?</script>'is",
        "'<head[^>]*?>.*?</head>'is",
        "'<title[^>]*?>.*?</title>'is",
        "'<meta[^>]*?>'is",
        "'<link[^>]*?>'is",
    );
    return preg_replace($tags, "", $content);
}


?>