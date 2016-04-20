<?php
function idjia($id){
	return $id+1000000000;
}
function expimage($imgstr,$n=1){
	$s=explode(',',$imgstr);
	if($n==1){
		return $s[0];
	}else{
		return $s;
	}
}
function expimage_jpg($imgstr){
	$xx=explode(',',$imgstr);
	$s=explode('.',$xx[0]);
	return $s[1];
}
function percent($p,$t){
	return sprintf('%.2f%%',$p/$t*100);
}
function width($p,$t,$w){
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
	$img=explode(',',$shop['img']);
	if($n==1){
		return $img[0];
	}else{
		return $img;
	}
}
function microt($time,$x=null){
	$list=explode(" ",$time);
	if($x=="l"){		
		return date("His",$list[1]).substr($list[0],2,2);
	}else if($x=="r"){
		return date("Y年m月d日 H:i",$list[1]);
	}else{
		return date("Y-m-d H:i:s",$list[1]).".".substr($list[0],2,2);
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
function yunma($ma){
	$list=explode(",",$ma);
	$st="";
	foreach($list as $list2){
		$st.="<span>".$list2."</span>";
	}
	return $st;
}
function jiexiao($id){
	$mysql_model=System::load_sys_class('model');
	$record=$mysql_model->GetList("select * from `@#_member_go_record` where `id`='".$id."'");
	foreach($record as $record2){
		if($record2['huode']>10000000){
			return $record2['huode'];
		}	
	}	
}
function toujpg($uid){
	$mysql_model=System::load_sys_class('model');
	$member=$mysql_model->GetOne("select * from `@#_member` where `uid`='".$uid."'");
	if($member['img']!=null){
		$s=explode('.',$member['img']);
		$url=G_WEB_PATH."upload/touimg/".$member['img']."_30.".$s[1];
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