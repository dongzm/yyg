<?php
function hueisd_id($sd_id,$leixin=null){
	$mysql_model=System::load_sys_class('model');
	$sdhf=$mysql_model->GetOne("select * from `@#_shaidan_hueifu` where `sdhf_id`='$sd_id' ");
	if($leixin="content"){
		return $sdhf['sdhf_content'];
	}else{
		return $sdhf['sdhf_userid'];
	}
}
function shopimg($shopid){
	$mysql_model=System::load_sys_class('model');
	$shop=$mysql_model->GetOne("select * from `@#_shoplist` where `id`='$shopid'");
	return $shop['thumb'];
}
function shoplisext($id,$zd){
	$mysql_model=System::load_sys_class('model');
	$shop=$mysql_model->GetOne("select * from `@#_shoplist` where `id`='$id'");
	return $shop[$zd];

}
function huodemem($shopuserid){
	$mysql_model=System::load_sys_class('model');
	$userid=$mysql_model->GetOne("select * from `@#_member` where `uid`='$shopuserid'");
	if($userid['username']){
		return $userid['username'];
	}else if($userid['mobile']){
		return _strcut($userid['mobile'],7);
	}else{
		return _strcut($userid['email'],7);
	}
}

function idjia($id){
	return $id+1000000000;
}
function expimage($imgstr,$n=0){
	if($imgstr!=NULL){
		$imgstr=String2Array($imgstr);
		return $imgstr[$n];
	}
	return '';
}
function expimage_jpg($imgstr){
	$imgstr=String2Array($imgstr);
	$s=explode('.',$imgstr[0]);
	return $s[1]; 
}
function percent($p,$t){
	if($p<=0){return false;}
	return sprintf('%.2f%%',$p/$t*100);
}
function width($p,$t,$w){
	if($p<=0){return false;}
	return $p/$t*$w;
}
function coo($id){
	$code= _getcookie('CODE');
	$cook=explode(",",$code);
	$count=count($cook)-1;
	for($i=0;$i<$count;$i++){
		if($id==$cook[$i]){
			return true;
		}
	}
}
function yunjl($id,$n=1){
	$mysql_model=System::load_sys_class('model');
	$shop=$mysql_model->GetOne("select * from `@#_shoplist` where `id`='".$id."'");
	return $shop['thumb'];
}
function microt($time,$x=null){
	$len=strlen($time);
	if($len<13){
		$time=$time."0";
	}
	$list=explode(".",$time);	
	if($x=="L"){		
		return date("His",$list[0]).substr($list[1],0,3);
	}else if($x=="Y"){
		return date("Y-m-d",$list[0]);
	}else if($x=="H"){
		return date("H:i:s",$list[0]).".".substr($list[1],0,3);
	}else if($x=="r"){
		return date("Y年m月d日 H:i",$list[0]);
	}else{
		return date("Y-m-d H:i:s",$list[0]).".".substr($list[1],0,3);
	}
}

function yunci($uid,$shopid,$shopqishu){
	$mysql_model=System::load_sys_class('model');
	$record2=$mysql_model->GetList("select * from `@#_member_go_record` where `uid`='".$uid."' and `shopid`='".$shopid."' and `shopqishu`='".$shopqishu."'");
	$cord="";
	foreach($record2 as $record){
		$cord.=$record['goucode'];
	}
	$list=explode(",",$cord);
	return count($list)-1;
}
function yuncifen($cord){
	$list=explode(",",$cord);
	return count($list)-1;
}
function yunma($ma,$html="span"){
	$list=explode(",",$ma);
	$st="";
	foreach($list as $list2){
		$st.="<".$html.">".$list2."</".$html.">";
	}
	return $st;
}

//判断商品是否揭晓
function get_shop_if_jiexiao($shopid=null){
	$db=System::load_sys_class('model');
	$record=$db->GetOne("select * from `@#_shoplist` where `id`='$shopid' LIMIT 1");
	if(!$record) return false;
	if($record['q_user']){
		$record['q_user'] = unserialize($record['q_user']);
		return $record;		
	}else{
		return $record;
	}
}


function huodez($shopid,$shopqishu,$canshu=null){
	$mysql_model=System::load_sys_class('model');
	$record=$mysql_model->GetOne("select * from `@#_member_go_record` where `shopid`='$shopid' and `shopqishu`='$shopqishu' and `huode`>'10000000'");
	return $record[$canshu];
}
function toujpg($uid){
	$mysql_model=System::load_sys_class('model');
	$member=$mysql_model->GetOne("select * from `@#_member` where `uid`='".$uid."'");
	if($member['img']!=null){
		$s=explode('.',$member['img']);
		$url=G_UPLOAD_PATH."/".$member['img']."_30.".$s[1];
		return $url;
	}else{
		$url=G_TEMPLATES_STYLE."/images/prmimg.jpg";
		return $url;
	}
}
function qztitle($id){
	$mysql_model=System::load_sys_class('model');
	$qztit=$mysql_model->GetOne("select * from `@#_quanzi` where `id`='".$id."'");
	return $qztit['title'];
}
function tiezi($id){
	$mysql_model=System::load_sys_class('model');
	$tiezi=$mysql_model->GetList("select * from `@#_quanzi_hueifu` where `tzid`='".$id."'");
	return count($tiezi);
}
?>