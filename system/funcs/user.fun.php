<?php 

/*
* 获取用户昵称
* uid 用户id，或者 用户数组
* type 获取的类型, username,email,mobile
* key  获取完整用户名, sub 截取,all 完整
*/
function get_user_name($uid='',$type='username',$key='sub'){
	if(is_array($uid)){			
			if(isset($uid['username']) && !empty($uid['username'])){
				return $uid['username'];
			}
			if(isset($uid['email']) && !empty($uid['email'])){
				if($key=='sub'){
					$email = explode('@',$uid['email']);				
					return $uid['email'] = substr($uid['email'],0,2).'*'.$email[1];
				}else{
					return $uid['email'];
				}
			}
			if(isset($uid['mobile']) && !empty($uid['mobile'])){	
				if($key=='sub'){
					return $uid['mobile'] = substr($uid['mobile'],0,3).'****'.substr($uid['mobile'],7,4);
				}else{
					return $uid['mobile'];
				}
			}
			return '';
	}else{		
		$db = System::load_sys_class("model");
		$uid = intval($uid);
		$info = $db->GetOne("select username,email,mobile from `@#_member` where `uid` = '$uid' limit 1");	
		if(isset($info['username']) && !empty($info['username'])){	
				return $info['username'];
		} 
		
		if(isset($info['email']) && !empty($info['email'])){	
			 if($key=='sub'){
				$email = explode('@',$info['email']);			
				return $info['email'] = substr($info['email'],0,2).'*'.$email[1];
			 }else{
				return $info['email'];
			 }
		}
		if(isset($info['mobile']) && !empty($info['mobile'])){	
				if($key=='sub'){
					return $info['mobile'] = substr($info['mobile'],0,3).'****'.substr($info['mobile'],7,4);
				}else{
					return $info['mobile'];
				}
		} 
		if(isset($info[$type]) && !empty($info[$type])){				
				return $info[$type];
		}
		return '';
	}
}

/*
* 获取用户信息
*/
function get_user_key($uid='',$type='img',$size=''){
	if(is_array($uid)){
		if(isset($uid[$type])){		
			if($type=='img'){				
				$fk = explode('.',$uid[$type]);
				$h = array_pop($fk);
				if($size){
					return $uid[$type].'_'.$size.'.'.$h;
				}else{
					return $uid[$type];
				}
			}
			return $uid[$type];
		}
		return 'null';
	}else{
		$db = System::load_sys_class("model");
		$uid = intval($uid);
		$info = $db->GetOne("select {$type} from `@#_member` where `uid` = '$uid' limit 1");
		if($type=='img'){				
				$fk = explode('.',$info[$type]);
				$h = array_pop($fk);
				if($size){
					return $info[$type].'_'.$size.'.'.$h;
				}else{
					return $info[$type];
				}
		}
		if(isset($info[$type])){			
			return $info[$type];
		}
		return 'null';
	}
}

/**
*	获取登陆用户UID	
*	
*/
function get_user_uid($type='bool'){
	global $_cfg;
	if(isset($_cfg['userinfo']) && is_array($_cfg['userinfo'])){
		return $_cfg['userinfo']['uid'];
	}else{
		return false;
	}
}

/**
*	获取当前登陆用户头像
*	
*/
function get_user_img($size=''){
	global $_cfg;
	if(isset($_cfg['userinfo'])){
		$fk = explode('.',$_cfg['userinfo']['img']);
		$h = array_pop($fk);
		if($size){
			return $_cfg['userinfo']['img'].'_'.$size.'.'.$h;
		}else{
			return $_cfg['userinfo']['img'];
		}		
	}else{
		return 'photo/member.jpg';
	}
}


/*
*	获取当前登录用户数组
*/
function get_user_arr($key='',$where=''){
		global $_cfg;		
		if(isset($_cfg['userinfo'])){			
			return $_cfg['userinfo'];
		}
		if(empty($where)){
			$where = 'uid,username,password,email,mobile,img';
		}else{
			$where = 'uid,username,password,email,mobile,img,'.$where;
		}		
		$db = System::load_sys_class("model");
		$uid=abs(intval(_encrypt(_getcookie("uid"),'DECODE')));	
		$ushell=_encrypt(_getcookie("ushell"),'DECODE');
		if(!$uid){
			return false;
		}
		
		$_cfg['userinfo']=$db->GetOne("SELECT {$where} FROM `@#_member` WHERE `uid` = '$uid'");
		if(!$_cfg['userinfo']){
			return false;
		}
		$shell=md5($_cfg['userinfo']['uid'].$_cfg['userinfo']['password'].$_cfg['userinfo']['mobile'].$_cfg['userinfo']['email']);		
		if($ushell!=$shell){
			return false;
		}		
		if(empty($key)){
			return $_cfg['userinfo'];
		}elseif(isset($_cfg['userinfo']['key'])){			
			return $_cfg['userinfo']['key'];
		}else{
			return false;
		}
}


/*
	获取用户单个商品的总云购次数
*/

function get_user_goods_num($uid=null,$sid=null){
	if(empty($uid) || empty($sid)){
		return false;
	}
	$db = System::load_sys_class("model");
	$list = $db->GetList("select * from `@#_member_go_record` where `uid` = '$uid' and `shopid` = '$sid' and `status` LIKE '%已付款%'");
	$num=0;
	foreach($list as $v){
		$num+=$v['gonumber'];
	}
	return $num;
	
}


?>