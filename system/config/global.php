<?php

/*
 *	global.inc.php 框架主配置文件
*/

global $_cfg;  //声明全局变量$_cfg

 /*
 *---------------------------------------------------------------
 * START PATH
 *---------------------------------------------------------------
 */
define('G_IN_SYSTEM', true);

 /*
 *---------------------------------------------------------------
 * RUN TIME   返回当前 Unix 时间戳和微秒数
 *---------------------------------------------------------------
 */
define('G_START_TIME', microtime());



 /*
 *---------------------------------------------------------------
 * HOST PATH  服务器host名称
 *---------------------------------------------------------------
 */
define('G_HTTP_HOST', (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ''));

 /*
 *---------------------------------------------------------------
 * The visiting PATH 引导用户代理到当前页的前一页的地址（如果存在）
 *---------------------------------------------------------------
 */
define('G_HTTP_REFERER', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');

 /*
 *---------------------------------------------------------------
 * HTTP and HTTPS  根据端口选择http协议
 *---------------------------------------------------------------
 *
 *	80 and 443
 */
define('G_HTTP',isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://');


 /*
 *---------------------------------------------------------------
 * G_APP_PATH
 *---------------------------------------------------------------
 */
if(!defined('G_APP_PATH')){define('G_APP_PATH', dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR);}

/*
if(!file_exists(G_APP_PATH.'install/ok.lock')){
    header("location:install/");
}
*/

/*
*	
*	THIS FILE  本文件
**/
define('G_SELF', pathinfo(__FILE__, PATHINFO_BASENAME));


 /*
 *---------------------------------------------------------------
 * SYSTEM PATH  定位系统文件夹
 *---------------------------------------------------------------
 *
 */
define("G_SYSTEM",G_APP_PATH.$system_path.DIRECTORY_SEPARATOR);	$_cfg['system_dir'] =  $system_path;


 /*
 *---------------------------------------------------------------
 * STATICS PATH  定位静态文件夹
 *---------------------------------------------------------------
 *
 */
define("G_STATICS",G_APP_PATH.$statics_path.DIRECTORY_SEPARATOR); $_cfg['sstatics_dir'] =  $statics_path;



 /*
 *---------------------------------------------------------------
 * UPLOADS PATH  定位静态文件夹下的uploads文件夹
 *---------------------------------------------------------------
 *
 */
define("G_UPLOAD",G_STATICS.'uploads'.DIRECTORY_SEPARATOR);

 /*
 *---------------------------------------------------------------
 * CONFIG PATH   定位系统文件夹下的config文件夹
 *---------------------------------------------------------------
 *
 */
define("G_CONFIG",G_SYSTEM.'config'.DIRECTORY_SEPARATOR);


 /*
 *---------------------------------------------------------------
 * CACHES PATH  缓存文件夹
 *---------------------------------------------------------------
 *
 */
define("G_CACHES",G_SYSTEM.'caches'.DIRECTORY_SEPARATOR);

 /*
 *---------------------------------------------------------------
 * PLUGIN PATH  插件文件夹
 *---------------------------------------------------------------
 *
 */
define("G_PLUGIN",G_SYSTEM.'plugin'.DIRECTORY_SEPARATOR);


 /*
 *---------------------------------------------------------------
 * TEMPLATES PATH  模板文件夹
 *---------------------------------------------------------------
 *
 */
define("G_TEMPLATES",G_STATICS.'templates'.DIRECTORY_SEPARATOR);


 /*
 *---------------------------------------------------------------
 * WEB_APP URL http(s)://ip:端口/yungou（当前路径文件夹名称）
 *---------------------------------------------------------------
 *
 */
define("G_WEB_PATH",dirname(G_HTTP.G_HTTP_HOST.$_SERVER['SCRIPT_NAME']));


//导入 system/libs/system.class.php
require G_SYSTEM.'libs/system.class.php';
if(System::load_sys_config('system','index_name') == NULL){
	define("WEB_PATH",G_WEB_PATH);
}else{
	define("WEB_PATH",G_WEB_PATH.'/'.System::load_sys_config('system','index_name'));
}


/**
*
*
**/


 /*
 *---------------------------------------------------------------
 * UPLOAD URL
 *---------------------------------------------------------------
 *
 */
define("G_UPLOAD_PATH",G_WEB_PATH.'/'.$statics_path.'/uploads');


 /*
 *---------------------------------------------------------------
 * PLUGIN URL
 *---------------------------------------------------------------
 *
 */
define("G_PLUGIN_PATH",G_WEB_PATH.'/'.$statics_path.'/plugin');

 /*
 *---------------------------------------------------------------
 * APP_PLUGIN URL
 *---------------------------------------------------------------
 *
 */
define("G_PLUGIN_APP",G_SYSTEM.'plugin'.DIRECTORY_SEPARATOR);


 /*
 *---------------------------------------------------------------
 * PLUGIN STYLE URL
 *---------------------------------------------------------------
 *
 */
define('G_GLOBAL_STYLE',G_PLUGIN_PATH.'/style');


 /*
 *---------------------------------------------------------------
 *	TEMPLATES URL PATH
 *---------------------------------------------------------------
 *
 */
$templates=System::load_sys_config('templates',System::load_sys_config('system','templates_name'));
define("G_STYLE",$templates['dir']);
define("G_STYLE_HTML",$templates['html']);
define("G_TEMPLATES_PATH",G_WEB_PATH.'/'.$statics_path.'/templates');
define("G_TEMPLATES_STYLE",G_TEMPLATES_PATH.'/'.G_STYLE);				
define("G_TEMPLATES_CSS",G_TEMPLATES_PATH.'/'.G_STYLE.'/css');		
define("G_TEMPLATES_JS",G_TEMPLATES_PATH.'/'.G_STYLE.'/js');				
define("G_TEMPLATES_IMAGE",G_TEMPLATES_PATH.'/'.G_STYLE.'/images');




 /*
 *---------------------------------------------------------------
 *	INCLUDE GLOBAL FUNCTION
 *---------------------------------------------------------------
 *
 */
System::load_sys_fun('global');


 /*
 *---------------------------------------------------------------
 *	error set
 *---------------------------------------------------------------
 *
 */
if(System::load_sys_config('system','error')){_error_handler();}


/*
 *---------------------------------------------------------------
 *	timezone set
 *---------------------------------------------------------------
 *
 */
function_exists('date_default_timezone_set') && date_default_timezone_set(System::load_sys_config('system','timezone'));


/**
*
*
*
*/



/**
*		WEB_INFO
*/
	
$_cfg = System::load_sys_config("system");




/*
 *---------------------------------------------------------------
 *	admin set
 *---------------------------------------------------------------
 *
 */
 
define('G_ADMIN_DIR',System::load_sys_config("system",'admindir'));



/**
 * Wc Version
 *
 * @var string
 *
 */
define('WC_VERSION', System::load_sys_config("version",'version'));



if(!is_php('5.3'))
{
	//@忽略警告，
	@set_magic_quotes_runtime(0);
}


define('G_BANBEN_NUMBER',3);	


/*
 * ------------------------------------------------------
 *  Set a liberal script execution time limit
 * ------------------------------------------------------
 */
if (function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0)
{
	//脚本执行最大时间设置
	@set_time_limit(100);
}


/*
 *---------------------------------------------------------------
 *	CHARSET set
 *---------------------------------------------------------------
 *
 */

define('G_CHARSET',System::load_sys_config('system','charset'));
header('Content-type: text/html; charset='.G_CHARSET);
unset($templates);

if(System::load_sys_config('system','gzip') && function_exists('ob_gzhandler')) {	
	ob_start('ob_gzhandler'); //ob_gzhandler()目的是用在ob_start()中作回调函数，以方便将gz 编码的数据发送到支持压缩页面的浏览器
} else {	
	ob_start();  //打开输出控制缓冲
}