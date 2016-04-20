<?php

defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base',null,'no');
System::load_app_fun('user','go');
System::load_app_fun('my','go');
class finduser extends SystemAction {
	public function __construct(){
		$this->db = System::load_sys_class("model");
	}
	//找回密码
	public function findpassword(){
		if(isset($_POST['submit'])){
			$name=isset($_POST['name']) ? $_POST['name'] : "";
			$txtRegSN=strtoupper($_POST['txtRegSN']);
			if(md5($txtRegSN)!=_getcookie('checkcode')){
				_message("验证码错误");
			}
			$regtype=null;
			if(_checkmobile($name)){
				$regtype='mobile';
			}
			if(_checkemail($name)){
				$regtype='email';
			}
			if($regtype==null)_message("帐号类型不正确!",null,3);
			$info=$this->DB()->GetOne("SELECT * FROM `@#_member` WHERE $regtype = '$name' LIMIT 1");
			if(!$info)_message("帐号不存在");
			header("location:".WEB_PATH."/member/finduser/find".$regtype."check"."/"._encrypt($name));
		}
		$title="找回密码";
		include templates("user","findpassword");
	}
	//手机重置密码
	public function findsendmobile(){
		$name=_encrypt($this->segment(4),"DECODE");
		$member=$this->DB()->GetOne("SELECT * FROM `@#_member` WHERE `mobile` = '$name' LIMIT 1");
		if(!$member)_message("参数不正确!");
		$checkcode=explode("|",$member['mobilecode']);
		$times=time()-$checkcode[1];
		if($times > 120){
			//重发验证码
			$mobile_code=rand(100000,999999);
			$mobile_time=time();
			$mobilecodes=$mobile_code.'|'.$mobile_time;//验证码
			$this->DB()->Query("UPDATE `@#_member` SET passcode='$mobilecodes' where `uid`='$member[uid]'");
            //2014-11-24 lq
            $temp_m_pwd = $this->DB()->GetOne("select value from `@#_caches` where `key` = 'template_mobile_pwd' LIMIT 1");
            $text=str_replace("000000",$mobile_code,$temp_m_pwd['value']);

            $sendok=_sendmobile($name,$text);
			if($sendok[0]!=1){
				_message($sendok[1]);
			}
			_message("正在重新发送...",WEB_PATH."/member/finduser/findmobilecheck/"._encrypt($member['mobile']),2);
		}else{
			_message("重发时间间隔不能小于2分钟!",WEB_PATH."/member/finduser/findmobilecheck/"._encrypt($member['mobile']));
		}
	}
	public function findmobilecheck(){

		$title="手机找回密码";
		$time=120;
		$namestr=$this->segment(4);
		$name=_encrypt($namestr,"DECODE");
		if(strlen($name)!=11)_message("参数错误！");
		$member=$this->DB()->GetOne("SELECT * FROM `@#_member` WHERE `mobile` = '$name' LIMIT 1");
		if(!$member)_message("参数不正确!");

		if($member['passcode']==-1){
			//更新验证码
			$randcode=rand(100000,999999);
			$checkcodes=$randcode.'|'.time();//验证码
			$this->DB()->Query("UPDATE `@#_member` SET passcode='$checkcodes' where `uid`='$member[uid]'");
            //2014-11-24 lq
            $temp_m_pwd = $this->DB()->GetOne("select value from `@#_caches` where `key` = 'template_mobile_pwd' LIMIT 1");
            $text=str_replace("000000",$randcode,$temp_m_pwd['value']);

			$sendok=_sendmobile($name,$text);
			if($sendok[0]!=1){
				_message($sendok[1]);
			}
			header("location:".WEB_PATH."/member/finduser/findmobilecheck/"._encrypt($member['mobile']));
			exit;
		}
		if(isset($_POST['submit'])){
			$checkcodes=isset($_POST['checkcode']) ? $_POST['checkcode'] : _message("参数不正确!");
			if(strlen($checkcodes)!=6)_message("验证码输入不正确!");
			$usercode=explode("|",$member['passcode']);
			if($checkcodes!=$usercode[0])_message("验证码输入不正确!");
			$urlcheckcode=_encrypt($member['mobile']."|".$member['passcode']);
			_setcookie("uid",_encrypt($member['uid']));
			_setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])));
			_message("手机验证成功",WEB_PATH."/member/finduser/findok/".$urlcheckcode,2);
		}

		$enname=substr($name,0,3).'****'.substr($name,7,10);
		$time=120;
		include templates("user","findmobilecheck");
	}
	//邮箱找回密码
	public function findsendemail(){
		$name=_encrypt($this->segment(4),"DECODE");
		$member=$this->DB()->GetOne("SELECT * FROM `@#_member` WHERE `email` = '$name' LIMIT 1");
		if(!$member)_message("参数错误!");
		$this->DB()->Query("UPDATE `@#_member` SET passcode='-1' where `uid`='$member[uid]'");
		_message("正在重新发送...",WEB_PATH."/member/finduser/findemailcheck/".$this->segment(4),2);
		exit;
	}
	public function findemailcheck(){
		$title="通过邮箱找回密码";
		$enname=$this->segment(4);
		$name=_encrypt($this->segment(4),"DECODE");
		$info=$this->DB()->GetOne("SELECT * FROM `@#_member` WHERE `email` = '$name' LIMIT 1");
		if(!$info)_message("未知错误!");
		$emailurl=explode("@",$info['email']);

		if($info['passcode']==-1){
			$passcode=_getcode(10);
			$passcode=$passcode['code'].'|'.$passcode['time'];//验证码
			$urlcheckcode=_encrypt($info['email']."|".$passcode);
			$url=WEB_PATH.'/member/finduser/findok/'.$urlcheckcode;
			$this->DB()->Query("UPDATE `@#_member` SET `passcode`='$passcode' where `uid`='$info[uid]'");
			$tit=_cfg("web_name")."邮箱找回密码";
            $con='<a href="'.WEB_PATH.'/member/finduser/findok/'.$urlcheckcode.'">';
            $con.=$url;
            $con.='</a>';
            $temp_e_pwd = $this->DB()->GetOne("select value from `@#_caches` where `key` = 'template_email_pwd' LIMIT 1");

            $content=str_replace("{地址}",$con,$temp_e_pwd['value']);

			_sendemail($info['email'],'',$tit,$content);
		}
		include templates("user","findemailcheck");
	}
	public function findok(){
		$key_find=$this->segment(4);
		if(empty($key_find)){
			_message("未知错误");
		}else{
			$key_find = $this->segment(4);
		}

		$checkcode=explode("|",_encrypt($key_find,"DECODE"));
		if(count($checkcode)!=3)_message("未知错误",NULL,3);
		$emailurl=explode("@",$checkcode[0]);
		if($emailurl[1]){
			$sql="select * from `@#_member` where `email`='$checkcode[0]' AND `passcode`= '$checkcode[1]|$checkcode[2]' LIMIT 1";
		}else{
			$sql="select * from `@#_member` where `mobile`='$checkcode[0]' AND `passcode`= '$checkcode[1]|$checkcode[2]' LIMIT 1";
		}
		$member=$this->DB()->GetOne($sql);
		if(!$member)_message("帐号或验证码错误",NULL,2);
		$usercheck=explode("|",$member['passcode']);
		$timec=time()-$usercheck[1];
		if($timec<(3600*24)){
			$title="重置密码";
			include templates("user","findok");
		}else{
			$title="验证失败";
			include templates("user","finderror");
		}
	}
	public function resetpassword(){
		if(isset($_POST['submit'])){
			$key=$_POST["hidKey"];
			$password=md5($_POST["userpassword"]);
			$checkcode=explode("|",_encrypt($key,"DECODE"));
			if(count($checkcode)!=3)_message("未知错误",NULL,3);
			$emailurl=explode("@",$checkcode[0]);
			if($emailurl[1]){
				$sql="select * from `@#_member` where `email`='$checkcode[0]' AND `passcode`= '$checkcode[1]|$checkcode[2]' LIMIT 1";
			}else{
				$sql="select * from `@#_member` where `mobile`='$checkcode[0]' AND `passcode`= '$checkcode[1]|$checkcode[2]' LIMIT 1";
			}
			$member=$this->DB()->GetOne($sql);
			if(!$member)_message("未知错误!");
			$this->DB()->Query("UPDATE `@#_member` SET `password`='$password',`passcode`='-1' where `uid`='$member[uid]'");
			_message("密码重置成功",WEB_PATH."/member/user/login");
		}
	}

}

?>