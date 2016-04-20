<?php
define('G_IN_ADMIN',true);
define('G_ADMIN_PATH',WEB_PATH.'/'.G_ADMIN_DIR);
class admin extends SystemAction {	
	protected $AdminInfo;
	private $db;
	public function __construct(){		
		$this->CheckAdmin();
	}

	//判断用户是否登陆
	final protected function CheckAdmin(){
		if(ROUTE_A != 'login'){
			$check = $this->CheckAdminInfo();
			if(!$check)_message("请登录后在查看页面",WEB_PATH.'/'.G_ADMIN_DIR.'/user/login');
			
		}
	}
	
	final protected function tpl($module = 'admin', $template = 'index'){	
		$file =  G_SYSTEM.'modules/'.$module.'/tpl/'.$template.'.tpl.php';
		if(file_exists($file))return $file;
		elseif(defined("G_IN_ADMIN")){
			_message("没有找到<font color='red'>".$module."</font>模块下的<font color='red'>".$template.".tpl.php</font>文件!");
		}else{
			_error('template message','The "'.$module.'.'.$template .'" template file does not exist');
		}
	}
	//判断用户
	final protected function CheckAdminInfo($uid=null,$ashell=null){
		$this->db=System::load_app_model('admin_model',G_ADMIN_DIR);
		if($uid && $ashell){
			$CheckId = _encrypt($uid,'DECODE');
			$CheckAshell =  _encrypt($ashell,'DECODE');
		}else{			
			$CheckId=_encrypt(_getcookie("AID"),'DECODE');
			$CheckAshell=_encrypt(_getcookie("ASHELL"),'DECODE');
		}
		if(!$CheckId || !$CheckAshell){			
			return false;
		}		
		$info=$this->db->GetOne("SELECT * FROM `@#_admin` WHERE `uid` = '$CheckId'");		
		if(!$info)return false;
		
		$infoshell = md5($info['username'].$info['userpass']).md5($_SERVER['HTTP_USER_AGENT']);
		if($infoshell!=$CheckAshell)return false;
		$this->AdminInfo=$info;
		return true;
	}
	
		//判断用户
	final static function StaticCheckAdminInfo($uid=null,$ashell=null){
		$db=System::load_app_model('admin_model',G_ADMIN_DIR);
		if($uid && $ashell){
			$CheckId = _encrypt($uid,'DECODE');
			$CheckAshell =  _encrypt($ashell,'DECODE');
		}else{			
			$CheckId=_encrypt(_getcookie("AID"),'DECODE');
			$CheckAshell=_encrypt(_getcookie("ASHELL"),'DECODE');
		}
		if(!$CheckId || !$CheckAshell){			
			return false;
		}		
		$info=$db->GetOne("SELECT * FROM `@#_admin` WHERE `uid` = '$CheckId'");		
		if(!$info)return false;
		
		$infoshell = md5($info['username'].$info['userpass']).md5($_SERVER['HTTP_USER_AGENT']);
		if($infoshell!=$CheckAshell)return false;
		return $info;
	}
		
		
	final protected function headerment($ments=null){
		$html='';
		$html_l='';
		$URL=trim(get_web_url(),'/');
		if(is_array($ments)){
			$ment=$ments;
		}else{
			if(!isset($this->ment))return false;
			$ment=$this->ment;
		}		
		foreach($ment as $k=>$v){			
			if(WEB_PATH.'/'.$v[2]==$URL){
				$html_l='<h3 class="nav_icon">'.$v[1].'</h3><span class="span_fenge lr10"></span>';
			}
			if(!isset($v[3])){				
				$html.='<a href="'.WEB_PATH.'/'.$v[2].'">'.$v[1].'</a>';	
				$html.='<span class="span_fenge lr5">|</span>';
			}			
		}
		
		return $html_l.$html;
	}
	
	public function __destruct(){
		$this->admin_log();
	}
	
	private function admin_log(){
		$db = System::load_sys_class("model");
		if(empty($db->sql_log)){
			return;
		}
		$date = date("Y-m-d");		
		$path = G_CACHES.'caches_log'.'/admin.log.'.$date.'.php';
		if(!file_exists($path)){
			$html = "<?php exit; ?> \n\n\n\n";
			file_put_contents($path,$html);
		}		
		if(!is_writable($path)) exit("admin.log.{$date}.php 没有写入权限");	
		$date = date("Y-m-d H:i:s");		
		$html = "$date"."------>".var_export($db->sql_log,true);
		$html .=" \n\n\n\n";
		file_put_contents($path,$html,FILE_APPEND);
	}
}
?>
