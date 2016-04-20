<?php


/**
 *      [taolong!] (C)2010-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: index.php  2013-06-30 05:34:47Z boobusy $
 *      email: booobusy@gmail.com
 */

 /*
 *---------------------------------------------------------------
 * SYSTEM BAN BEN TYPE 常量
 *---------------------------------------------------------------
 */

 define('G_BANBEN_TYPE',"9aabCQkBVlQABwcEU1wDD1NWUVcCClBaAwcAC1GK3fvfn5besLlKgbis04z5gr+wSoSF3Nmz09657BTWi+KC263Wu7EV19Pv2Jii0+rt");

 /*
 *---------------------------------------------------------------
 * SYSTEM FOLDER NAME  系统文件夹名称
 *---------------------------------------------------------------
 */
$system_path = 'system';

 /*
 *---------------------------------------------------------------
 * STATICS FOLDER NAME 系统文件夹名称
 *---------------------------------------------------------------
 */
$statics_path = 'statics';


 /*
 *---------------------------------------------------------------
 * APP START PATH 程序根目录
 *---------------------------------------------------------------
 */
define('G_APP_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR);



/*
 * --------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE 导入global.php
 * --------------------------------------------------------------
 */

include  G_APP_PATH.$system_path.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'global.php';



/*
 * --------------------------------------------------------------
 * APP START 开始程序，如果$plugin_app变量不存在，运行CreateApp()方法
 * --------------------------------------------------------------
 */
 
if(!isset($plugin_app)){
	System::CreateApp();
}