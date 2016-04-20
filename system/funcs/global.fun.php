<?php

/*
*   所有公共函数文件
*/

/*
*	序列化
*/
function _serialize($obj){
   return base64_encode(gzcompress(serialize($obj)));
}

/*
*	反序列化
*/
function _unserialize($txt){
   return unserialize(gzuncompress(base64_decode($txt)));
}

/**
*	PHP 版本判断
*
**/
function is_php($version = '5.0.0'){
		static $_is_php;
		$version = (string)$version;

		if ( ! isset($_is_php[$version]))
		{
			$_is_php[$version] = (version_compare(PHP_VERSION, $version) < 0) ? FALSE : TRUE;
		}

		return $_is_php[$version];
}

/**
 * 返回经addslashes处理过的字符串或数组
 * @param $string 需要处理的字符串或数组
 * @return mixed
 */
function new_addslashes($string){

	if(!is_array($string)) return addslashes($string);
	foreach($string as $key => $val) $string[$key] = new_addslashes($val);
	return $string;
}
/*数组转字符串*/function Array2String($Array){
		if(!$Array)return false;
		$Return='';
		$NullValue="^^^";
		foreach ($Array as $Key => $Value) {
			if(is_array($Value))
				$ReturnValue='^^array^'.Array2String($Value);
			else
				$ReturnValue=(strlen($Value)>0)?$Value:$NullValue;
			$Return.=urlencode(base64_encode($Key)) . '|' . urlencode(base64_encode($ReturnValue)).'||';
		}
		return urlencode(substr($Return,0,-2));
}

/*字符串转数组*/
function String2Array($String){
	if(NULL==$String)return false;
    $Return=array();
    $String=urldecode($String);
    $TempArray=explode('||',$String);
    $NullValue=urlencode(base64_encode("^^^"));
    foreach ($TempArray as $TempValue) {
        list($Key,$Value)=explode('|',$TempValue);
        $DecodedKey=base64_decode(urldecode($Key));
        if($Value!=$NullValue) {
            $ReturnValue=base64_decode(urldecode($Value));
            if(substr($ReturnValue,0,8)=='^^array^')
                $ReturnValue=String2Array(substr($ReturnValue,8));
            $Return[$DecodedKey]=$ReturnValue;
        }
        else
        $Return[$DecodedKey]=NULL;
    }
    return $Return;
}

/*字符过滤url*/
function safe_replace($string) {
	$string = str_replace('%20','',$string);
	$string = str_replace('%27','',$string);
	$string = str_replace('%2527','',$string);
	$string = str_replace('*','',$string);
	$string = str_replace('"','&quot;',$string);
	$string = str_replace("'",'',$string);
	$string = str_replace('"','',$string);
	$string = str_replace(';','',$string);
	$string = str_replace('<','&lt;',$string);
	$string = str_replace('>','&gt;',$string);
	$string = str_replace("{",'',$string);
	$string = str_replace('}','',$string);
	$string = str_replace('\\','',$string);
	return $string;
}
/*获取页面完整url*/
function get_web_url() {
	$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	$php_self = $_SERVER['PHP_SELF'] ? safe_replace($_SERVER['PHP_SELF']) : safe_replace($_SERVER['SCRIPT_NAME']);
	$path_info = isset($_SERVER['PATH_INFO']) ? safe_replace($_SERVER['PATH_INFO']) : '';
	$relate_url = isset($_SERVER['REQUEST_URI']) ? safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.safe_replace($_SERVER['QUERY_STRING']) : $path_info);
	return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}

/*获取网站当前地址*/
function get_home_url() {
	$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	$path=explode('/',safe_replace($_SERVER['SCRIPT_NAME']));
	if(count($path)==3){
		return $sys_protocal.$_SERVER['HTTP_HOST'].'/'.$path[1];
	}
	if(count($path)==2){
		return $sys_protocal.$_SERVER['HTTP_HOST'];
	}
}


/*HTML安全过滤*/
function _htmtocode($content) {
		$content = str_replace('%','%&lrm;',$content);
		$content = str_replace("<", "&lt;", $content);
		$content = str_replace(">", "&gt;", $content);
		$content = str_replace("\n", "<br/>", $content);
		$content = str_replace(" ", "&nbsp;", $content);
		$content = str_replace('"', "&quot;", $content);
		$content = str_replace("'", "&#039;", $content);
		$content = str_replace("$", "&#36;", $content);
		$content = str_replace('}','&rlm;}',$content);
		return $content;
}

/*手机号码验证*/
function _checkmobile($mobilephone=''){
	if(strlen($mobilephone)!=11){	return false;	}
	if(preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",$mobilephone)){
		return true;
	}else{
		return false;
	}
}

/*邮箱验证*/
function _checkemail($email=''){
		if(mb_strlen($email)<5){
			return false;
		}
		$res="/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/";
		if(preg_match($res,$email)){
			return true;
		}else{
			return false;
		}
}
/*加密解密 ENCODE 加密   DECODE 解密*/
function _encrypt($string, $operation = 'ENCODE', $key = '', $expiry = 0){
	if($operation == 'DECODE') {
		$string =  str_replace('_', '/', $string);
	}
	$key_length = 4;
	if(defined("G_BANBEN_NUMBER")){
			$key = md5($key != '' ? $key : System::load_sys_config("code","code"));
	}else{
			$key = md5($key != '' ? $key : G_WEB_PATH);
	}
	$fixedkey = md5($key);
	$egiskeys = md5(substr($fixedkey, 16, 16));
	$runtokey = $key_length ? ($operation == 'ENCODE' ? substr(md5(microtime(true)), -$key_length) : substr($string, 0, $key_length)) : '';
	$keys = md5(substr($runtokey, 0, 16) . substr($fixedkey, 0, 16) . substr($runtokey, 16) . substr($fixedkey, 16));
	$string = $operation == 'ENCODE' ? sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$egiskeys), 0, 16) . $string : base64_decode(substr($string, $key_length));

	$i = 0; $result = '';
	$string_length = strlen($string);
	for ($i = 0; $i < $string_length; $i++){
		$result .= chr(ord($string{$i}) ^ ord($keys{$i % 32}));
	}
	if($operation == 'ENCODE') {
		$retstrs =  str_replace('=', '', base64_encode($result));
		$retstrs =  str_replace('/', '_', $retstrs);
		return $runtokey.$retstrs;
	} else {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$egiskeys), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	}
}


function _getcookie($name){
	if(empty($name)){return false;}
	if(isset($_COOKIE[$name])){
		return $_COOKIE[$name];
	}else{
		return false;
	}
}

function _setcookie($name,$value,$time=0,$path='/',$domain=''){
	if(empty($name)){return false;}
	$_COOKIE[$name]=$value;				//及时生效
	$s = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
	if(!$time){
		return setcookie($name,$value,0,$path,$domain,$s);
	}else{
		return setcookie($name,$value,time()+$time,$path,$domain,$s);
	}
}


/*
*获取字符串长度
*一个汉字2个字节,字符1个字节
*/
function _strlen($str=''){
	if(empty($str)){
		return 0;
	}
	if(!_is_utf8($str)){
		$str=iconv("GBK","UTF-8",$str);
	}
	return ceil((strlen($str)+mb_strlen($str,'utf-8'))/2);
}


 	/*
	* 调用模板函数
	* $module   模板目录
	* $template 模板文件名,
	* $StyleTheme    模板方案目录,为空为默认目录
	*/

function templates($module = '', $template = '',$StyleTheme=''){
		if(empty($StyleTheme)){$style=G_STYLE.DIRECTORY_SEPARATOR.G_STYLE_HTML;}
		else{
			$templates=System::load_sys_config('templates',$style);
			$style=$templates['dir'].DIRECTORY_SEPARATOR.$templates['html'];
		}
		$FileTpl = G_CACHES.'caches_template'.DIRECTORY_SEPARATOR.dirname($style).DIRECTORY_SEPARATOR.md5($module.'.'.$template).'.tpl.php';
		$FileHtml = G_TEMPLATES.$style.DIRECTORY_SEPARATOR.$module.'.'.$template.'.html';
		if(file_exists($FileHtml)){
			if (file_exists($FileTpl) && @filemtime($FileTpl) >= @filemtime($FileHtml)) {
				return $FileTpl;
			} else {
				$template_cache=&System::load_sys_class('template_cache');
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
					return $FileTpl;
				else
					_error('template message','The "'.$module.'.'.$template .'" template file does not exist');
			}
		}
		_error('template message','The "'.$module.'.'.$template .'" template file does not exist');

	}

/**
 * 字符截取 支持UTF8/GBK
 * @param $string
 * @param $length
 * @param $dot
 */
function _strcut($string, $length,$dot = '...') {
        $string = trim($string);
        if($length && strlen($string) > $length) {
            //截断字符
            $wordscut = '';
			if(strtolower(G_CHARSET) == 'utf-8') {
                //utf8编码
                $n = 0;
                $tn = 0;
                $noc = 0;
                while ($n < strlen($string)) {
                    $t = ord($string[$n]);
                    if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                        $tn = 1;
                        $n++;
                        $noc++;
                    } elseif(194 <= $t && $t <= 223) {
                        $tn = 2;
                        $n += 2;
                        $noc += 2;
                    } elseif(224 <= $t && $t < 239) {
                        $tn = 3;
                        $n += 3;
                        $noc += 2;
                    } elseif(240 <= $t && $t <= 247) {
                        $tn = 4;
                        $n += 4;
                        $noc += 2;
                    } elseif(248 <= $t && $t <= 251) {
                        $tn = 5;
                        $n += 5;
                        $noc += 2;
                    } elseif($t == 252 || $t == 253) {
                        $tn = 6;
                        $n += 6;
                        $noc += 2;
                    } else {
                        $n++;
                    }
                    if ($noc >= $length) {
                        break;
                    }
                }
                if ($noc > $length) {
                    $n -= $tn;
                }
                $wordscut = substr($string, 0, $n);
            } else {
                for($i = 0; $i < $length - 1; $i++) {
                    if(ord($string[$i]) > 127) {
                        $wordscut .= $string[$i].$string[$i + 1];
                        $i++;
                    } else {
                        $wordscut .= $string[$i];
                    }
                }
            }
            $string = $wordscut.$dot;
        }
        return trim($string);
}


/*获取客户端ip*/
function _get_ip(){
		if (isset($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], "unknown"))
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], "unknown"))
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if (isset($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
			$ip = $_SERVER['REMOTE_ADDR'];
		else if (isset($_SERVER['REMOTE_ADDR']) && isset($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
			$ip = $_SERVER['REMOTE_ADDR'];
		else $ip = "";
		return ($ip);
}


/* 获取ip + 地址*/
function _get_ip_dizhi($ip=null){
		$opts = array(
			'http'=>array(
			'method'=>"GET",
			'timeout'=>5,)
		);
		$context = stream_context_create($opts);


		if($ip){
			$ipmac = $ip;
		}else{
			$ipmac=_get_ip();
			if(strpos($ipmac,"127.0.0.") === true)return '';
		}

		$url_ip='http://ip.taobao.com/service/getIpInfo.php?ip='.$ipmac;
		$str = @file_get_contents($url_ip, false, $context);
		if(!$str) return "";
		$json=json_decode($str,true);
		if($json['code']==0){

			$json['data']['region'] = addslashes(_htmtocode($json['data']['region']));
			$json['data']['city'] = addslashes(_htmtocode($json['data']['city']));

			$ipcity= $json['data']['region'].$json['data']['city'];
			$ip= $ipcity.','.$ipmac;
		}else{
			$ip="";
		}
		return $ip;
}


/**
 * 判断字符串是否为utf8编码，英文和半角字符返回ture
 * @param $string
 * @return bool
 */
function _is_utf8($string) {
	return preg_match('%^(?:
					[\x09\x0A\x0D\x20-\x7E] # ASCII
					| [\xC2-\xDF][\x80-\xBF] # non-overlong 2-byte
					| \xE0[\xA0-\xBF][\x80-\xBF] # excluding overlongs
					| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
					| \xED[\x80-\x9F][\x80-\xBF] # excluding surrogates
					| \xF0[\x90-\xBF][\x80-\xBF]{2} # planes 1-3
					| [\xF1-\xF3][\x80-\xBF]{3} # planes 4-15
					| \xF4[\x80-\x8F][\x80-\xBF]{2} # plane 16
					)*$%xs', $string);
}


/**
*	发送电子邮件
*	@email 也可以是一个二维数组，包含邮件和用户名信息
**/
function _sendemail($email,$username=null,$title='',$content='',$yes='',$no=''){
	System::load_sys_class("email",'sys',"no");
	$config=System::load_sys_config('email');
	if(!$username)$username="";
	if(!$yes)$yes="发送成功,如果没有收到，请到垃圾箱查看,\n请把".$config['fromName']."设置为信任,方便以后接收邮件";
	if(!$no)$no="发送失败，请重新点击发送";
	if(!_checkemail($email)){return false;}
	email::config($config);
	if(is_array($email)){
		email::adduser($email);
	}else{
		email::adduser($email,$username);
	}
	$if=email::send($title,$content);
	if($if){
			return $yes;
	}else{
			return $no;
	}
}


/*
*	发送短信
**/
function _sendmobile($mobiles='',$content=''){
	file_put_contents("m.txt", json_encode($config)."\r\n\n\r",FILE_APPEND);
	$mobiles=str_replace("，",',',$mobiles);
	$mobiles=str_replace(" ",'',$mobiles);
	$mobiles=trim($mobiles," ");
	$mobiles=trim($mobiles,",");
	$sends=System::load_sys_class('sendmobile');
	$config=array();
	$config['mobile']=$mobiles;
	$config['content']= $content;
	$config['ext']='';
	$config['stime']='';
	$config['rrid']='';
	$cok=$sends->init($config);

	if(!$cok){
		return array('-1','配置不正确!');
	}
	$sends->send();
	$sendarr=array($sends->error,$sends->v);
	return $sendarr;
}

/**
*
*	页面执行时间统计
*
*/
function get_end_time(){

	$EndTime=explode(" ",microtime());
	$StartTime=explode(" ",G_START_TIME);
	return intval($EndTime[1]-$StartTime[1])+($EndTime[0]-$StartTime[0]).'/S';
}
/*
*
* 页面内存消耗统计
*/
function get_end_memory(){
	$memory=memory_get_usage();
	$memory=$memory/1024;
	return round($memory,2).'/KB';
}

/**
*	message 输出自定义错误页面
*	$str 错误信息
*	$url 返回页面的地址, 默认返回上一页
*	$time 返回时间，默认3秒后返回
*   $config 其他参数配置.类型为数组 $config['titlebg']='#549bd9',$config['title']='#fff',
*/


/*
*	系统消息提示
**/
function _message($string=null,$defurl=null,$time=2,$config=null){

	if(empty($defurl)){
		//$defurl=G_HTTP_REFERER;
		$defurl = ":js:";
		//if(empty($defurl))$defurl=WEB_PATH;
	}
	if(defined("G_IN_ADMIN")){
		if(empty($config)){
			$config = array("titlebg"=>"#549bd9","title"=>"#fff");
		}
		$str_url_two=array("url"=>WEB_PATH.'/'.G_ADMIN_DIR,"text"=>"返回后台首页");
	}else{
		$str_url_two=array("url"=>G_WEB_PATH,"text"=>"返回首页");
	}
	$time=intval($time);if($time<2){$time=2;}
	include templates("system","message");
	exit;
}


/*
*	手机消息提示
**/
function _messagemobile($string=null,$defurl=null,$time=2,$config=null){
	if(empty($defurl)){
		$defurl=G_HTTP_REFERER;
		if(empty($defurl))$defurl=WEB_PATH;
	}
	if(empty($config)){
		if(ROUTE_M==System::load_sys_config("system","admindir")){
			$config=array();
			$config['titlebg']='#549bd9';$config['title']='#fff';
		}
	}
	$time=intval($time);if($time<2){$time=2;}
	include templates("mobile/system","message");
	exit;
}

/**
*	message 输出自定义错误页面
*	$str 错误信息
*	$url 返回页面的地址, 默认返回上一页
*	$time 返回时间，默认3秒后返回
*/

function _error($title,$content){
	if(empty($title)){$title='404 Page Not Found';}
	if(empty($content)){$content='The page you requested was not found.';}
	echo '<!DOCTYPE html><html lang="en"><head><title>'.$title.'</title><style type="text/css">::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }::webkit-selection{ background-color: #E13300; color: white; }
body {	background-color: #fff;	margin: 40px;	font: 13px/20px normal Helvetica, Arial, sans-serif;	color: #4F5155;}
a {	color: #003399;	background-color: transparent;	font-weight: normal;}
h1 {	color: #444;	background-color: transparent;	border-bottom: 1px solid #D0D0D0;	font-size: 19px;	font-weight: normal;
	margin: 0 0 14px 0;	padding: 14px 15px 10px 15px;}
code {	font-family: Consolas, Monaco, Courier New, Courier, monospace;	font-size: 12px;
	background-color: #f9f9f9;	border: 1px solid #D0D0D0;	color: #002166;	display: block;	margin: 14px 0 14px 0;	padding: 12px 10px 12px 10px;}
#container {	margin: 10px;	border: 1px solid #D0D0D0;	-webkit-box-shadow: 0 0 8px #D0D0D0;}
p {	margin: 12px 15px 12px 15px;}</style><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>	<div id="container">		<h1>'.$title.'</h1>		<p>'.$content.'</p></div></body></html>';
	exit;
}

/**
 * IE浏览器判断
 */
function _is_ie() {
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if((strpos($useragent, 'opera') !== false) || (strpos($useragent, 'konqueror') !== false)) return false;
	if(strpos($useragent, 'msie ') !== false) return true;
	return false;
}

function _is_mobile() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
    $is_mobile = false;
    foreach ($mobile_agents as $device) {
        if (stristr($user_agent, $device)) {
            $is_mobile = true;
            break;
        }
    }
    return $is_mobile;
}


/* PHP解析错误处理 */
function _error_handler(){
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	ini_set("display_errors","OFF");					 				//错误报告提示关闭
	ini_set("error_log",G_CACHES."error.".date("Y-m-d").".logs");	    //写错误日志的地址

}

/* $n 字符串长度,返回一个数组*/
function _getcode($n=10){
	$num=intval($n) ? intval($n) : 10;
	if($num>44)
		$codestr=base64_encode(md5(time()).md5(time()));
	else
		$codestr=base64_encode(md5(time()));
	$temp=array();
	$temp['code']=substr($codestr,0,$num);
	$temp['time']=time();
	return $temp;
}


/* 获取系统变量 */
function _cfg($name=''){
	return System::load_sys_config('system',$name);
}


/* 安装系统函数 */
function hook_mysql_install($message=''){
	if(file_exists(G_APP_PATH.'install')){
		echo "<script>";
		echo "window.location.href='".G_WEB_PATH."/install'";
		echo "</script>";
	}else{
		_error("数据库连接不成功,请检查配置！",$message);
	}
	exit;
}

/* 网络操作函数 */
function _g_triggerRequest($url,$io=false,$post_data = array(), $cookie = array()){
		$method = empty($post_data) ? 'GET' : 'POST';

        $url_array = parse_url($url);
        $port = isset($url_array['port'])? $url_array['port'] : 80;

		if(function_exists('fsockopen')){
			$fp = @fsockopen($url_array['host'], $port, $errno, $errstr, 30);
		}elseif(function_exists('pfsockopen')){
			$fp = @pfsockopen($url_array['host'], $port, $errno, $errstr, 30);
		}elseif(function_exists('stream_socket_client')){
			$fp = @stream_socket_client($url_array['host'].':'.$port,$errno,$errstr,30);
		} else {
			$fp = false;
		}

        if(!$fp){
             return false;
        }



		$url_array['query'] =  isset($url_array['query']) ? $url_array['query'] : '';
        $getPath = $url_array['path'] ."?". $url_array['query'];

        $header  = $method . " " . $getPath." ";
        $header .= "HTTP/1.1\r\n";
        $header .= "Host: ".$url_array['host']."\r\n"; //HTTP 1.1 Host域不能省略
		$header .= "Pragma: no-cache\r\n";

        /*
			//以下头信息域可以省略
			$header .= "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13 \r\n";
			$header .= "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,q=0.5 \r\n";
			$header .= "Accept-Language: en-us,en;q=0.5 ";
			$header .= "Accept-Encoding: gzip,deflate\r\n";
        */


        if(!empty($cookie)){
                $_cookie_s = strval(NULL);
                foreach($cookie as $k => $v){
                        $_cookie_s .= $k."=".$v."; ";
                }
				$_cookie_s = rtrim($_cookie_s,"; ");
                $cookie_str =  "Cookie: " . base64_encode($_cookie_s) ." \r\n";	   //传递Cookie
                $header .= $cookie_str;
        }
		$post_str = '';
         if(!empty($post_data)){
                $_post = strval(NULL);
                foreach($post_data as $k => $v){
                        $_post .= $k."=".urlencode($v)."&";
                }
				$_post = rtrim($_post,"&");
                $header .= "Content-Type: application/x-www-form-urlencoded\r\n";//POST数据
                $header .= "Content-Length: ". strlen($_post) ." \r\n";//POST数据的长度

                $post_str = $_post."\r\n"; //传递POST数据
        }
		$header .= "Connection: Close\r\n\r\n";
		$header .= $post_str;

        fwrite($fp,$header);
		if($io){
			 while (!feof($fp)){
                   echo fgets($fp,1024);
			 }
		}
        fclose($fp);
		//echo $header;
        return true;
}


/**
*	短时间显示, 几分钟前,几秒前...
**/


function _put_time($time = 0,$test=''){
	if(empty($time)){return $test;}
	$time = substr($time,0,10);
	$ttime = time() - $time;
	if($ttime <= 0 || $ttime < 60){
		return '几秒前';
	}
	if($ttime > 60 && $ttime <120){
		return '1分钟前';
	}

	$i = floor($ttime / 60);							//分
	$h = floor($ttime / 60 / 60);						//时
	$d = floor($ttime / 86400);							//天
	$m = floor($ttime / 2592000);						//月
	$y = floor($ttime / 60 / 60 / 24 / 365);			//年
	if($i < 30){
		return $i.'分钟前';
	}
	if($i > 30 && $i < 60){
		return '一小时内';
	}
	if($h>=1 && $h < 24){
		return $h.'小时前';
	}
	if($d>=1 && $d < 30){
		return $d.'天前';
	}
	if($m>=1 && $m < 12){
		return $m.'个月前';
	}
	if($y){
		return $y.'年前';
	}
	return "";

}


/*
	获取栏目信息
*/
function get_category($cid){
	if(empty($cid)){
		return '';
	}
	$db = System::load_sys_class("model");
	$info = $db->GetOne("SELECT name FROM `@#_category` where `cateid` = '$cid' limit 1");
	if($info){
		return $info['name'];
	}else{
		return '';
	}

}

/*
	_session_start
*/
function _session_start(){
	if(!isset($_SESSION)){ session_start();}
}

/*
	_session_destroy
*/
function _session_destroy(){
	if(isset($_SESSION)){session_destroy();}
}


/*
	xml to array
*/

function _xml_to_array($xml){
	$reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
	if(preg_match_all($reg, $xml, $matches)){
	$count = count($matches[0]);
		for($i = 0; $i < $count; $i++){
			$subxml= $matches[2][$i];
			$key = $matches[1][$i];
				if(preg_match( $reg, $subxml )){
					$arr[$key] = _xml_to_array( $subxml );
				}else{
					$arr[$key] = $subxml;
				}
			}
		}
	return $arr;
}