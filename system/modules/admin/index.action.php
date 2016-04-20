<?php 

defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin',G_ADMIN_DIR,'no');
System::load_app_fun('global',G_ADMIN_DIR);
class index extends admin {
	private $db;
	public function __construct(){		
		parent::__construct();		
		$this->db=System::load_app_model('admin_model');		
	}
	
	public function init(){	
	
		$info=$this->AdminInfo;
		$path = "www.baidu.com";
		if(G_CHARSET=='utf-8'){
				$path.= 'utf8/';
		}elseif(G_CHARSET=='gbk'){
				$path.= 'gbk/';
		}
			$stauts = 1;
			$version = System::load_sys_config('version');	
			$v_time = $version['release'];
			$v_version = $version['version'];
			
			$upfile_url = $path;
			$version = System::load_sys_config('version','release');	
			//获取压缩包			
			$content = @file_get_contents($upfile_url);
			$pathlist = false ;
			if(!$content){
				$stauts = -1;
			}else{			
				//数组的位置
				$key = -1;
				$allpathlist = $pathlist =  array();
				preg_match_all("/>(patch_[\w_]+\.zip)</", $content, $allpathlist);
				$allpathlist = $allpathlist[1];
				
				//获取可供当前版本升级的压缩包
				foreach($allpathlist as $k=>$v) {
					if(strstr($v, 'patch_'.$version)) {
						$key = $k;
						break;
					}
				}
				$key = $key < 0 ? 9999 : $key;
				foreach($allpathlist as $k=>$v) {
					if($k >= $key) {
						$pathlist[$k] = $v;
					}
				}
			}
			
		$upfile_num = count($pathlist);		
		include $this->tpl(ROUTE_M,'admin.index');
	}
	public function Tdefault(){
		
		$info=$this->AdminInfo;
		$SysInfo=GetSysInfo();		
		$SysInfo['MysqlVersion']=$this->db->GetVersion();		
				
		$versions = System::load_sys_config("version");
		
		
		$banben_arr = explode(",",_encrypt(G_BANBEN_TYPE,"DECODE","G_BANBEN_TYPE"));
		$banben_num = G_BANBEN_NUMBER;
		
		if(isset($banben_arr[$banben_num])){
			$banben_txt = $banben_arr[$banben_num];
		}else{
			if(G_BANBEN_NUMBER == -1){
				$banben_txt  = base64_decode("5pyq5o6I5p2D");
			}else if(G_BANBEN_NUMBER == -2){
				$banben_txt  = base64_decode("5o6I5p2D5Yiw5pyf");
			}else{
				$banben_txt  = base64_decode("5pyq5o6I5p2D");
			}
			
		}
        $yungou_alert=file_get_contents("http://www.baidu.com");

		$text = $banben_txt;
		//$catelen = $this->db->count();	
		include $this->tpl(ROUTE_M,'admin.default');
	}
	public function map(){			
		$info=$this->AdminInfo;
		include $this->tpl(ROUTE_M,'admin.map');
	}
	
}
?>