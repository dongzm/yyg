<?php 


/*
*	取得用户的收货地址
*	@uid  用户ID
*	@key  返回类型, bool 真假值,array 返回地址数组
*/
function member_get_dizhi($uid='',$key='bool'){
	$uid = abs(intval($uid));
	if(!$uid)return false;
	$db = System::load_sys_class("model");
	$info = $db->GetOne("SELECT * FROM `@#_member_dizhi` WHERE `uid` = '$uid' and `default` = 'Y'");
	if($info){
		return $info;
	}else{
		return false;
	}
}