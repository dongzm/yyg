<?php

/**
 *  param.calss.php 	路由参数处理类
 *
 * @copyright			(C) 2005-2010 BUSY
 * @license				
 * @lastmodify			2012-6-1
 */

class param {				

	private $route_config;
	private $domain;
	private $expstr = '/';
	private $route_url=array();
	private $route=array();	
	private $param_url = '';
	public function __construct() {			
			$this->route_config = System::load_sys_config('param');		
			$this->domain = System::load_sys_config('domain');		
			$this->expstr = System::load_sys_config('system','expstr');		
			$this->prourl();		
			$this->sub_addslashes();
			System::load_sys_class('SystemAction','sys','no');
			SystemAction::set_route_url($this->route_url);
			global $_cfg;
			$_cfg['param_arr'] = $this->route_url;
			$_cfg['param_arr']['url'] = $this->param_url;
			
	}
		
	private function prourl(){		
		
		
		if(isset($_SERVER['PATH_INFO']) && ($_SERVER['PATH_INFO']!='/') && !empty($_SERVER['PATH_INFO'])){			
			$this->prourlexp('pathinfo');		
			return;
		}
		if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])){		
			$this->prourlexp('query');			
			if(!empty($this->route_url[1])){
				return;
			}
		}		
			
		if(isset($this->domain[$_SERVER['HTTP_HOST']])){			
			$this->route_url[1] = $this->domain[$_SERVER['HTTP_HOST']]['m'];
			$this->route_url[2] = $this->domain[$_SERVER['HTTP_HOST']]['c'];
			$this->route_url[3] = $this->domain[$_SERVER['HTTP_HOST']]['a'];			
			return;
		}
		
		if($this->isMobile() && !isset($_GET['PC_SEE'])){			
			foreach($this->domain as $key=>$v){
				if(isset($v['m']) &&  $v['m'] == 'mobile'){					
					header("location: ".dirname(G_HTTP.$key.$_SERVER['SCRIPT_NAME']));		
					exit;
				}
			}		
		}		
		return;
	}
	
		
	private function prourlexp($type){
		
		switch($type){
			case 'pathinfo' :
				$path = ltrim($_SERVER['PATH_INFO'],'/');
				$path = preg_replace("/^index.php\//i",'',$path);
				$path = rtrim($path,$this->expstr);				
			break;
			case 'query' :
				$path = $_SERVER['QUERY_STRING'];
				$path = ltrim($path,'/');
				$path = rtrim($path,$this->expstr);	
				
				if(stripos($path,$this->expstr)===false){				
					if(stripos($path,'=') !== false){	
						$this->route_url[1] = null;
						$this->route_url[2] = null;
						$this->route_url[3] = null;						
						return;
					}						
				}				
				
			break;
			default :
			break;
		}				
		
		$this->param_url= $path;
		if(isset($this->route_config['routes'])){		
			if(isset($this->route_config['routes'][$path])){				
				$path=$this->route_config['routes'][$path];
			}else{
				foreach ($this->route_config['routes'] as $key => $val){			
					$key = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $key));	
					if (preg_match('#^'.$key.'$#', $path)){
						if (strpos($val, '$') !== FALSE AND strpos($key, '(') !== FALSE){
							$val = preg_replace('#^'.$key.'$#', $val, $path);
						}
						$path=$val;
					}
				}				
			}
		}	
			
		$this->route_url=explode($this->expstr,trim($path,$this->expstr));
		array_unshift($this->route_url,NULL);	
		unset($this->route_url[0]);	
		
		
		$end=end($this->route_url);		
		if(stripos($end,'.')!==false){
			$end=explode('.',$end);
			$this->route_url[count($this->route_url)]=$end[0];
				
		}
				
		
		/*
			preg_match_all("/p(.*)/i", $path,$matches,PREG_SET_ORDER);	
			$this->route_url['p']=$matches[0][1];	
		*/

	}
	
	private function sub_addslashes(){	
		if(!get_magic_quotes_gpc()) {
				$_POST = new_addslashes($_POST);
				$_GET = new_addslashes($_GET);			
				$_REQUEST = new_addslashes($_REQUEST);
				$_COOKIE = new_addslashes($_COOKIE);
				$this->route_url = new_addslashes($this->route_url);
		}else{
			$this->route_url = new_addslashes($this->route_url);
		}
		
	}
	
	/**
	 * 获取模型
	 */
	public function route_m() {		
	
		if(empty($this->route_url[1])){		
			$this->route_url[1]=$this->route_config['default']['m'];  //go
		}		
		define('G_MODULE_PATH',WEB_PATH.'/'.$this->route_url[1]);		
		return $this->route_url[1];
	}

	/**
	 * 获取控制器
	 */
	public function route_c() {
		if(empty($this->route_url[2])){		
			$this->route_url[2]=$this->route_config['default']['c'];//index
			return $this->route_config['default']['c'];
		}return $this->route_url[2];
	
	}

	/**
	 * 获取事件
	 */
	public function route_a() {
		if(empty($this->route_url[3])){
			$this->route_url[3]=$this->route_config['default']['a'];//init
			return $this->route_config['default']['a'];
		}return $this->route_url[3];
	
	}

	/** 
	 *	是否移动设备
	 **/
	public function isMobile(){ 
	// 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])){
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA'])){ 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])){
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))){
            return true;
        } 
    } 
	// 协议法，因为有可能不准确，放到最后判断
	if (isset ($_SERVER['HTTP_ACCEPT'])){ 
			// 如果只支持wml并且不支持html那一定是移动设备
			// 如果支持wml和html但是wml在html之前则是移动设备
			if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
			{
				return true;
			} 
		} 
		return false;
	} 
}