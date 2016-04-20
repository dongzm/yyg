<?php
function tubimg($src,$width,$height){
	$url=G_UPLOAD_PATH."/".$src;
	$size=getimagesize($url);
	$name=rand(10,99).substr(microtime(),2,6).substr(time(),4,6);
	$filetype=explode("/",$src);
	$img = imagecreatefromjpeg($url);
	$dst = ImageCreateTrueColor( $width,$height);
	imagecopyresampled($dst,$img,0,0,0,0,$width,$height,$size[0],$size[1]);
	imagejpeg($dst,"statics/uploads/".$filetype[0]."/".$filetype[1]."/".$name.".jpg");
	return $filetype[1]."/".$name.".jpg";
}


function get_ip($id,$ipmac=null){
	$db=System::load_sys_class('model');
	$record=$db->GetOne("select * from `@#_member_go_record` where `id`='$id'");
	$ip=explode(',',$record['ip']);
	if($ipmac=='ipmac'){
		return $ip[1];
	}elseif($ipmac=='ipcity'){
		return $ip[0];
	}
	return $ip[0].'IP:'.$ip[1];
}


function sdimg($sd_id){
	$mysql_model=System::load_sys_class('model');
	$shaidan=$mysql_model->GetOne("select * from `@#_shaidan` where `sd_id`='$sd_id'");
	$img=explode(";",$shaidan['sd_photolist']);
	$ul_li="";
	for($i=0;$i<count($img)-1;$i++){
		$ul_li.='<li id="ulli_'.$i.'"><img src="'.G_UPLOAD_PATH.'/'.$img[$i].'" width="100" height="100"><input type="hidden" value="'.$img[$i].'"><a href="javascript:;" rel="ulli_'.$i.'">删除</a></li>';
	}
	return $ul_li;
}
function img($img){
	$img=explode(".",$img);
	return $img[1];
}
function Getlogo(){
	$mysql_model=System::load_sys_class('model');
	$web_logo=$mysql_model->GetOne("select * from `@#_config` where `name`='web_logo'");
	return $web_logo['value'];
}

function Getheader($type='index'){
	$mysql_model=System::load_sys_class('model');
	$navigation=$mysql_model->GetList("select * from `@#_navigation` where `status`='Y'  and `type` = '$type' order by `order` DESC");
	$url="";
	if($type=='foot'){
		foreach($navigation as $v){
			$url.='<a  href="'.WEB_PATH.$v['url'].'">'.$v['name'].'</a><b></b>';
		}
		return $url;
	}
	foreach($navigation as $v){
		$url.='<li><a  href="'.WEB_PATH.$v['url'].'">'.$v['name'].'</a></li>';
	}
	return $url;
}


function uidcookie($get_name=null){
	$member = System::load_app_class("base","member");
	$member = $member->get_user_info();
	if(!$member)return false;
	if(isset($member[$get_name])){
		return $member[$get_name];
	}else{
		return null;
	}
}

//总云购人次
function go_count_renci(){
	$mysql_model=System::load_sys_class('model');
	$recordx=$mysql_model->GetOne("select * from `@#_caches` where `key` = 'goods_count_num'");
	return $recordx['value'];
}

//总云购人次
function go_count_renci1(){
	$mysql_model=System::load_sys_class('model');
	$recordx=$mysql_model->GetOne("select * from `@#_caches` where `key` = 'goods_count_num'");
	if(substr($recordx['value'],-1)==0){
		echo 0;
	}else
	{
	return substr($recordx['value'],-1);
	}
}
function go_count_renci2(){
	$mysql_model=System::load_sys_class('model');
	$recordx=$mysql_model->GetOne("select * from `@#_caches` where `key` = 'goods_count_num'");
	if(substr($recordx['value'],-2)==0){
		echo 0;
	}else
	{
	return substr($recordx['value'],-2);
	}
}
function go_count_renci3(){
	$mysql_model=System::load_sys_class('model');
	$recordx=$mysql_model->GetOne("select * from `@#_caches` where `key` = 'goods_count_num'");
	if(substr($recordx['value'],-3)==0){
		echo 0;
	}else
	{
	return substr($recordx['value'],-3);
	}
}
function go_count_renci4(){
	$mysql_model=System::load_sys_class('model');
	$recordx=$mysql_model->GetOne("select * from `@#_caches` where `key` = 'goods_count_num'");
	if(substr($recordx['value'],-4)==0){
		echo 0;
	}else
	{
	return substr($recordx['value'],-4);
	}
}
function go_count_renci5(){
	$mysql_model=System::load_sys_class('model');
	$recordx=$mysql_model->GetOne("select * from `@#_caches` where `key` = 'goods_count_num'");
	if(substr($recordx['value'],-5)==0){
		echo 0;
	}else
	{
	return substr($recordx['value'],-5);
	}
}
function go_count_renci6(){
	$mysql_model=System::load_sys_class('model');
	$recordx=$mysql_model->GetOne("select * from `@#_caches` where `key` = 'goods_count_num'");
	if(substr($recordx['value'],-6)==0){
		echo 0;
	}else
	{
	return substr($recordx['value'],-6);
	}
}
function go_count_renci7(){
	$mysql_model=System::load_sys_class('model');
	$recordx=$mysql_model->GetOne("select * from `@#_caches` where `key` = 'goods_count_num'");
	if(substr($recordx['value'],-9)==0){
		echo 0;
	}else
	{
	return substr($recordx['value'],-7);
	}
}
function go_count_renci8(){
	$mysql_model=System::load_sys_class('model');
	$recordx=$mysql_model->GetOne("select * from `@#_caches` where `key` = 'goods_count_num'");
	if(substr($recordx['value'],-8)==0){
		echo 0;
	}else
	{
	return substr($recordx['value'],-8);
	}
}
function go_count_renci9(){
	$mysql_model=System::load_sys_class('model');
	$recordx=$mysql_model->GetOne("select * from `@#_caches` where `key` = 'goods_count_num'");
	if(substr($recordx['value'],-9)==0){
		echo 0;
	}else
	{
	return substr($recordx['value'],-9);
	}
}



function userid($uid,$zhi){
	$mysql_model=System::load_sys_class('model');
	$member=$mysql_model->GetOne("select * from `@#_member` where `uid`='$uid'");
	if($zhi=='username'){
		if($member['username']!=null){
			return _strcut($member['username'],8,"");
		}else if($member['mobile']!=null){
			return _strcut($member['mobile'],7,"");
		}else{
			return _strcut($member['email'],7,"");
		}
	}else{
		return $member[$zhi];
	}
}
function quanzid($qzid){
	$mysql_model=System::load_sys_class('model');
	$quanzi=$mysql_model->GetOne("select * from `@#_quanzi` where `id`='$qzid'");
	return $quanzi['title'];
}
function huifu($tzid){
	$mysql_model=System::load_sys_class('model');
	$quanzi=$mysql_model->GetList("select * from `@#_quanzi_hueifu` where `tzid`='$tzid'");
	return count($quanzi);
}
function huati($lex){
	$mysql_model=System::load_sys_class('model');
	$uid=_encrypt(_getcookie('uid'),'DECODE');
	if($lex=='tiezi'){
		$tiezi=$mysql_model->GetList("select * from `@#_quanzi_tiezi` where `hueiyuan`='$uid'");
		return count($tiezi);
	}if($lex=='hueifu'){
		$hueifu=$mysql_model->GetList("select * from `@#_quanzi_hueifu` where `hueiyuan`='$uid'");
		return count($hueifu);
	}
}
function qznum(){
	$mysql_model=System::load_sys_class('model');
	$uid=_encrypt(_getcookie('uid'),'DECODE');
	$member=$mysql_model->GetOne("select * from `@#_member` where `uid`='$uid'");
	$addgroup=rtrim($member['addgroup'],",");
	if($addgroup){
		$group=$mysql_model->GetList("select * from `@#_quanzi` where `id` in ($addgroup)");
		return count($group);
	}else{
		$group=null;
		return false;
	}
}
function tztitle($tzid){
	$mysql_model=System::load_sys_class('model');
	$tiezi=$mysql_model->GetOne("select * from `@#_quanzi_tiezi` where `id`='$tzid'");
	return $tiezi['title'];
}



function help($cateid){
	$mysql_model=System::load_sys_class('model');
	$bangzhu=$mysql_model->GetList("select * from `@#_article` where `cateid`='$cateid'");
	$li="";
	foreach($bangzhu as $bangzhutu){
		$li.='<li><a href="'.WEB_PATH.'/help/'.$bangzhutu['id'].'" class="cur'.$bangzhutu['id'].'"><b></b>'.$bangzhutu['title'].'</a></li>';
	}
	return $li;
}

?>