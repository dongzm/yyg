<?php
function spcook($me){
	$mysql_model=System::load_sys_class('model');
	$uid=_encrypt(_getcookie('uid'),'DECODE');
	$member=$mysql_model->GetOne("select * from `@#_member` where `uid`='".$uid."'");		
	if($me=="pic"){
		$img=explode(".",$member['img']);
		return $img[1];
	}else{
		return $member[$me];
	}
}
function renci(){
	$mysql_model=System::load_sys_class('model');	
	$recordx=$mysql_model->GetList("select * from `@#_member_go_record`");
	$s=0;
	foreach($recordx as $record){
		$ma=explode(",",$record['goucode']);
		$s=$s+count($ma)-1;
	}
	return $s;
}
?>