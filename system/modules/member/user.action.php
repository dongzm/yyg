<?php 

defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base',null,'no');
System::load_app_fun('user','go');
System::load_app_fun('my','go');
System::load_sys_fun('send');
class user extends base {
	public function __construct(){	
		parent::__construct();
		$this->db = System::load_sys_class("model");
	}

	public function cook_end(){
		_setcookie("uid","",time()-3600);
		_setcookie("ushell","",time()-3600);		
		_message("退出成功",WEB_PATH);
	}
	public function login(){	

		$user = $this->userinfo;	
		if($user){
			header("Location:".G_WEB_PATH);exit;
		}else if(!$this->segment(4)){			
			global $_cfg;				
			$url = WEB_PATH.'/'.$_cfg['param_arr']['url'];			
			$url = rtrim($url,'/');	
			$url .= '/'.base64_encode(trim(G_HTTP_REFERER));	
			if($url != get_web_url()){
					header("Location:".$url);exit;
			}
		}
		
		if(isset($_POST['submit'])){		
			$username=$_POST['username'];
			$password=md5($_POST['password']);
			$code=md5(strtoupper($_POST['verify']));
			$logintype='';
            if($code!=_getcookie('checkcode')){
                _message("验证码输入错误!");
            }
			if(strpos($username,'@')==false){
				//手机				
				$logintype='mobile';
				if(!_checkmobile($username)){
					_message("手机格式不正确!");
				}				
			}else{
				//邮箱
				$logintype='email';
				if(!_checkemail($username)){
					_message("邮箱格式不正确!");
				}
			}
		
			$member=$this->db->GetOne("select * from `@#_member` where `$logintype`='$username' and `password`='$password'");
			if(!$member){
				_message("帐号不存在错误!");
			}		
			$check=$logintype.'code';
			if($member[$check] != 1){
				$strcode=_encrypt($member['email']);
				_message("帐号未认证",WEB_PATH."/member/user/".$logintype."check/"._encrypt($member[$logintype]));
			}	
					
			if(!is_array($member)){
				_message("帐号或密码错误",NULL,3);
			}else{
				$time = time();
				$user_ip = _get_ip_dizhi();
				$this->db->GetOne("UPDATE `@#_member` SET `user_ip` = '$user_ip',`login_time` = '$time' where `uid` = '$member[uid]'");
				_setcookie("uid",_encrypt($member['uid']),60*60*24*7);			
				_setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])),60*60*24*7);	
			
			}			
			_message("登录成功",base64_decode($this->segment(4)),2);
				
		}	
		include templates("user","login");
		
	}
	public function register(){
		$config_email = System::load_sys_config("email");
		$config_mobile = System::load_sys_config("mobile");
		$regconfig = System::load_app_config("user_reg_type","",ROUTE_M);
		
		if($this->userinfo){		
			header("Location:".WEB_PATH."/member/home/");exit;
		}
		
		
		if(isset($_POST['submit'])){			
			$name=isset($_POST['name']) ? $_POST['name'] : "";
			$userpassword=isset($_POST['userpassword']) ? $_POST['userpassword'] : "";
			$userpassword2=isset($_POST['userpassword2']) ? $_POST['userpassword2'] : "";
			
			if($name==null or $userpassword==null or $userpassword2==null){
				 _message("帐号密码不能为空",null,3);
			}
			if(!(_checkmobile($name) or _checkemail($name))){
				_message("帐号不是手机或邮箱",null,3);
			}
			if(strlen($userpassword)<6 || strlen($userpassword)>20){
				 _message("密码小于6位或大于20位",null,3);
			}
			if($userpassword!=$userpassword2){
				_message("两次密码不一致",null,3);
			}		

			
			$regtype=null;
			if(_checkmobile($name)){
				$regtype='mobile';
				$cfg_mobile_type  = 'cfg_mobile_'.$config_mobile['cfg_mobile_on'];
				$config_mobile = $config_mobile[$cfg_mobile_type];
				if(empty($config_mobile['mid']) && empty($config_email['mpass'])){
					_message("系统短信配置不正确!");
				}		
			}
			if(_checkemail($name)){
				$regtype='email';
				if(empty($config_email['user']) && empty($config_email['pass'])){
					_message("系统邮箱配置不正确!");
				}				
			}		

			//验证注册类型
			$regtype_arr = System::load_app_config("user_reg_type","",ROUTE_M);	
			$regtypes = 'reg_'.$regtype;	
 			if(empty($regtype) || $regtype_arr[$regtypes] == 0){
				if($regtype == 'email'){
					_message("网站未开启邮箱注册!",null,3);
				}
				if($regtype == 'mobile'){
					_message("网站未开启手机注册!",null,3);
				}
				_message("您注册的类型不正确!",null,3);
			}
			
			
			$member=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `$regtype` = '$name' or `reg_key` = '$name' LIMIT 1");
			
			
			if(is_array($member) && $member[$regtype] == $name){
				_message("该账号已被注册!",WEB_PATH.'/register');
			}
			
			$register_type = 'def';
			if(is_array($member) && $member['reg_key'] == $name){
				$b_uid = $member['uid'];
				$b_user=$this->db->GetOne("SELECT * FROM `@#_member_band` WHERE `b_uid` = '$b_uid' LIMIT 1");
				if(is_array($b_user)){
					_message("该账号已被注册!",WEB_PATH.'/register');
				}
				$register_type = 'for';	//未注册成功在次注册
			}
			
		
			$time=time();
			$userpassword=md5($userpassword);
			$codetype=$regtype.'code';
			$regcode = $this->segment(4);
			$regcode=!empty($regcode) ? $regcode : $_COOKIE['regcode'];
			$decode=_encrypt($regcode,"DECODE");
			$decode = intval($decode);
			
			//邮箱验证 -1 代表未验证， 1 验证成功 都不等代表等待验证
			
			if($register_type == 'def'){

				$ip = _get_ip();
				$day_time = strtotime(date("Y-m-d"));	
				$member_reg_num = $this->db->GetNum("SELECT uid FROM `@#_member` where `time` > '$day_time' and `user_ip` LIKE '%$ip%'");								
				if($member_reg_num >= $regconfig['reg_num']){
					_message("您今日注册会员数已经达到上限！");
				}
			
				$user_ip = _get_ip_dizhi();
				$sql="INSERT INTO `@#_member`(password,user_ip,img,emailcode,mobilecode,reg_key,yaoqing,time)VALUES('$userpassword','$user_ip','photo/member.jpg','-1','-1','$name','$decode','$time')";
				$sqlreg = $this->db->Query($sql);
				$check_code  = serialize(array("name"=>$name,"time"=>$time));
				$check_code  = _encrypt($check_code,"ENCODE",'',3600*24);			
				
			}elseif($register_type == 'for'){	
				$sqlreg = true;
				$check_code  = serialize(array("name"=>$name,"time"=>$member['time']));
				$check_code  = _encrypt($check_code,"ENCODE",'',3600*24);
			}
			if($sqlreg){		
				header("location:".WEB_PATH."/member/user/".$regtype."check"."/".$check_code);
				exit;
			}else{
				_message("注册失败!",WEB_PATH.'/register');
			}
		}
		
		$p_c = $this->segment(4);
		if(!empty($p_c)){
			setcookie("regcode",$p_c,time()+3600*24*7);
		}
		$title="注册"._cfg("web_name");
		include templates("user","register");
	}
	
	/* 用户注册邮箱注册验证邮件发送 */
	public function emailcheck(){
	
		$title="邮箱验证 -"._cfg("web_name");
		$check_code = _encrypt($this->segment(4),"DECODE");
		$check_code = @unserialize($check_code);
		
		if(!$check_code || !isset($check_code['name']) || !isset($check_code['time'])){
			_message("参数不正确或者验证已过期!",WEB_PATH.'/register');
		}				
				
		$info=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `reg_key` = '$check_code[name]' and `time` = '$check_code[time]' LIMIT 1");
		if(!$info)_message("错误的来源!",WEB_PATH.'/register');
		$emailurl = explode("@",$info['reg_key']);
		$name = $info['reg_key'];
		$enname = $this->segment(4);
		
		$reg_message = '';
		if($info['emailcode']=='1')_message("恭喜您,验证成功!",WEB_PATH."/login");
		if($info['emailcode']=='-1'){	
			$reg_message = send_email_reg($info['reg_key'],$info['uid']);
		}elseif((time() - $check_code['time']) > 3600){
			//未验证时间大于1小时 重发邮件
			$reg_message = send_email_reg($info['reg_key'],$info['uid']);
		}
		
		include templates("user","emailcheck");
	}
	
	
	/*
	*	重发验证邮件
	*/
	public function sendemail(){
		$check_code = _encrypt($this->segment(4),"DECODE");
		$check_code = @unserialize($check_code);
		if(!$check_code || !isset($check_code['name']) || !isset($check_code['time'])){
			_message("参数不正确或者验证已过期1!",WEB_PATH.'/register');
		}		
		$member=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `reg_key` = '$check_code[name]' and `time` = '$check_code[time]' LIMIT 1");
		if(!$member)_message("错误的来源!",WEB_PATH.'/register');
		
		if($member['emailcode']=='1')_message("邮箱已验证",WEB_PATH.'/member/home');
		$this->db->Query("UPDATE `@#_member` SET emailcode='-1' where `uid`='$member[uid]'");
		_message("正在重新发送...",WEB_PATH."/member/user/emailcheck/".$this->segment(4));	
		exit;
	}
	
	/*
		邮箱验证成功页面
	*/
	public function emailok(){	
	
		$check_code = _encrypt($this->segment(4),"DECODE");
		$check_code = @unserialize($check_code);
		
		
		if(!isset($check_code['email']) || !isset($check_code['code']) || !isset($check_code['time'])){
			_message("未知的来源!",WEB_PATH,'/register');
		}	
		$sql_code = $check_code['code'].'|'.$check_code['time'];
		
		$member=$this->db->GetOne("select * from `@#_member` where `reg_key`='$check_code[email]' AND `emailcode`= '$sql_code' LIMIT 1");
		if($info['emailcode']=='1')_message("恭喜您,验证成功!",WEB_PATH."/login");
		
		$timec=time() - $check_code['time'];		
		if($timec < (3600*24)){	
				$title="邮件激活成功";
				$tiebu="完成注册";
				$success="邮件激活成功";					
				$fili_cfg = System::load_app_config("user_fufen");		
				if($member['yaoqing']){
							$time = time();
							$yaoqinguid = $member['yaoqing'];
							//福分			
							if($fili_cfg['f_visituser']){							
								$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$yaoqinguid','1','福分','邀请好友奖励','$fili_cfg[f_visituser]','$time')");
							}						
							$this->db->Query("UPDATE `@#_member` SET `score`=`score`+'$fili_cfg[f_visituser]',`jingyan`=`jingyan`+'$fili_cfg[z_visituser]' where uid='$yaoqinguid'");
				}
				$this->db->Query("UPDATE `@#_member` SET emailcode='1',email = '$member[reg_key]' where `uid`='$member[uid]'");				
				
				_setcookie("uid",_encrypt($member['uid']),60*60*24*7);	
				_setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['reg_key'])),60*60*24*7);	
				
				include templates("user","emailok");
				
			}else{
					$title="邮箱验证失败";
					$tiebu="验证失败,请重发验证邮件";
					$guoqi="对不起，验证码已过期或不正确！";
					$this->db->Query("UPDATE `@#_member` SET emailcode='-1' where `uid`='$member[uid]'");					
					$name = array("name"=>$member['reg_key'],"time"=>$member['time']);
					$name = _encrypt(serialize($name),"ENCODE");
					include templates("user","emailok");
			}			
	}
	
	//重发手机验证码
	public function sendmobile(){
			$check_code = _encrypt($this->segment(4),"DECODE");
			$check_code = @unserialize($check_code);
			if(!$check_code || !isset($check_code['name']) || !isset($check_code['time'])){
				_message("参数不正确或者验证已过期!",WEB_PATH.'/register');
			}	
			$name = $check_code['name'];
		
			$member=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `reg_key` = '$check_code[name]' and `time` = '$check_code[time]' LIMIT 1");
			if(!$member)_message("参数不正确!");
			if($member['mobilecode']=='1'){_message("该账号验证成功,请直接登录！",WEB_PATH."/login");}	
			$checkcode=explode("|",$member['mobilecode']);
			$times=time()-$checkcode[1];		
			if($times > 120){
				$sendok = send_mobile_reg_code($member['reg_key'],$member['uid']);			
				if($sendok[0]!=1){
					_message("短信发送失败,代码:".$sendok[1]);exit;			
				}
				_message("正在重新发送...",WEB_PATH."/member/user/mobilecheck/".$this->segment(4));				
			}else{
				_message("重发时间间隔不能小于2分钟!",WEB_PATH."/member/user/mobilecheck/".$this->segment(4));
			}
		
	}
	public function mobilecheck(){
		$title="手机认证 - "._cfg("web_name");	
		$check_code = _encrypt($this->segment(4),"DECODE");
		$check_code = @unserialize($check_code);
		if(!$check_code || !isset($check_code['name']) || !isset($check_code['time'])){
			_message("参数不正确或者验证已过期!",WEB_PATH.'/register');
		}	
		$name = $check_code['name'];
		$member=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `reg_key` = '$check_code[name]' and `time` = '$check_code[time]' LIMIT 1");
		if(!$member)_message("未知的来源!",WEB_PATH.'/register');		
		if($member['mobilecode'] == '1'){
			_message("该账号验证成功",WEB_PATH."/login");
		}
		
		if($member['mobilecode'] == '-1'){
			$sendok = send_mobile_reg_code($member['reg_key'],$member['uid']);		
			if($sendok[0]!=1){
					_message($sendok[1]);
			}
			header("location:".WEB_PATH."/member/user/mobilecheck/".$this->segment(4));
			exit;
		}
		
		if(isset($_POST['submit'])){
			$checkcodes=isset($_POST['checkcode']) ? $_POST['checkcode'] : _message("参数不正确!");
			if(strlen($checkcodes)!=6)_message("验证码输入不正确!");
			$usercode=explode("|",$member['mobilecode']);
			if($checkcodes!=$usercode[0])_message("验证码输入不正确!");
			
			$fili_cfg = System::load_app_config("user_fufen");
			if($member['yaoqing']){
				$time = time();
				$yaoqinguid = $member['yaoqing'];
				//福分、经验添加
				if($fili_cfg['f_visituser']){
					$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$yaoqinguid','1','福分','邀请好友奖励','$fili_cfg[f_visituser]','$time')");
				}				
				$this->db->Query("UPDATE `@#_member` SET `score`=`score`+'$fili_cfg[f_visituser]',`jingyan`=`jingyan`+'$fili_cfg[z_visituser]' where uid='$yaoqinguid'");
			}			
			$check = $this->db->Query("UPDATE `@#_member` SET mobilecode='1',mobile='$member[reg_key]' where `uid`='$member[uid]'");	
			_setcookie("uid",_encrypt($member['uid']),60*60*24*7);	
			_setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['reg_key'].$member['email'])),60*60*24*7);	
				
			_message("验证成功",WEB_PATH."/login");
		}
	
		$enname=substr($name,0,3).'****'.substr($name,7,10);
		$time=120;
		$namestr = $this->segment(4);
		include templates("user","mobilecheck");
	}
}//

?>