<?php 



/*
	计算云购码表
*/
function content_get_codes_table(){
	$db = System::load_sys_class("model");
	$num = $db->GetOne("SELECT * from `@#_caches` where `key` = 'shopcodes_table' LIMIT 1");
	$table = 'shopcodes_'.$num['value'];	
	$shopcodes_table = $db->GetOne("SHOW TABLE STATUS LIKE '@#_$table'");
	
	if(!$shopcodes_table || !$num) return false;
	if($shopcodes_table['Auto_increment'] >=99999){
		$num = intval($num['value'])+1;
		$shopcodes_table = 'shopcodes_'.$num;
		$q1 = $db->Query("		
				CREATE TABLE `@#_$shopcodes_table` (
				  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
				  `s_id` int(10) unsigned NOT NULL,
				  `s_cid` smallint(5) unsigned NOT NULL,
				  `s_len` smallint(5) DEFAULT NULL,
				  `s_codes` text,
				  `s_codes_tmp` text,
				  PRIMARY KEY (`id`),
				  KEY `s_id` (`s_id`),
				  KEY `s_cid` (`s_cid`),
				  KEY `s_len` (`s_len`)
				) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
		");
		$q2 = $db->Query("UPDATE `@#_caches` SET `value` = '$num' where `key` = 'shopcodes_table'");
		if(!$q1 || !$q2)return false;
	}else{
		$num = intval($num['value']);
		$shopcodes_table = 'shopcodes_'.$num;
	}
	return $shopcodes_table;

}

/*
   生成云购码 
   CountNum @ 生成个数
   len 	    @ 生成长度
   sid	    @ 商品ID
*/
function content_get_go_codes($CountNum=null,$len=null,$sid=null){	
	$db = System::load_sys_class("model");
	//$db->Query("set global max_allowed_packet = 2*1024*1024*10");
	$table = $db->GetOne("SELECT * from `@#_caches` where `key` = 'shopcodes_table' LIMIT 1");
	$table = '@#_shopcodes_'.$table['value'];
	
	$num = ceil($CountNum/$len);
	$code_i = $CountNum;
	if($num == 1){
		$codes=array();
		for($i=1;$i<=$CountNum;$i++){
			$codes[$i]=10000000+$i;
		}shuffle($codes);$codes=serialize($codes);
		$query = $db->Query("INSERT INTO `$table` (`s_id`, `s_cid`, `s_len`, `s_codes`,`s_codes_tmp`) VALUES ('$sid', '1','$CountNum','$codes','$codes')");
		unset($codes);
		return $query;
	}
	$query_1 = true;
	for($k=1;$k<$num;$k++){
		$codes=array();
		for($i=1;$i<=$len;$i++){
			$codes[$i]=10000000+$code_i;
			$code_i--;
		}shuffle($codes);$codes=serialize($codes);
		$query_1 = $db->Query("INSERT INTO `$table` (`s_id`, `s_cid`, `s_len`, `s_codes`,`s_codes_tmp`) VALUES ('$sid', '$k','$len','$codes','$codes')");
		unset($codes);
	}
	$CountNum = $CountNum - (($num-1)*$len);
	$codes=array();	
	for($i=1;$i<=$CountNum;$i++){
			$codes[$i]=10000000+$code_i;	
			$code_i--;
	}shuffle($codes);$codes=serialize($codes);
	$query_2 = $db->Query("INSERT INTO `$table` (`s_id`, `s_cid`,`s_len`, `s_codes`,`s_codes_tmp`) VALUES ('$sid', '$num','$CountNum','$codes','$codes')");
	unset($codes);
	return $query_1 && $query_2;
}

//content_get_go_codes(ceil($zongrenshu/3000),3000,$shopid);


/*
	 添加推荐位
*/
function content_add_position(){}

/*
 新建一期商品
 info 	 商品的ID 或者 商品的数组
 使用此函数注意传进来的的商品期数不等于最大期数
 autocommit @是否开启事物
*/
function content_add_shop_install($info=null,$autocommit=true){
	
	$db = System::load_sys_class("model");
	if($autocommit){
		$db->Autocommit_start();
	}
	
	unset($info['id']);
	unset($info['q_uid']);
	unset($info['q_user']);
	unset($info['q_user_code']);
	unset($info['q_content']);
	unset($info['q_counttime']);
	unset($info['q_end_time']);		
	
	
	$info['xsjx_time']=0;
	$info['time'] = time();
	$info['qishu'] = intval($info['qishu']);
	$info['qishu']++;
	$info['canyurenshu'] = '0';
	$info['shenyurenshu'] = $info['zongrenshu'];
	$info['codes_table'] = content_get_codes_table();
	$info['q_showtime']= 'N';
	$info['title'] = _htmtocode($info['title']);
	$info['title2'] = _htmtocode($info['title2']);

	$keys  = $vals = '(';
	foreach($info as $key=>$val){
		$keys.="`$key`,";
		$vals.="'$val',";
	}
	$keys = rtrim($keys,',');
	$vals = rtrim($vals,',');
	$keys.= ')';
	$vals.= ')';
	
	$sql = "INSERT INTO `@#_shoplist` ".$keys." VALUES ".$vals;
	$q1 = $db->Query($sql);
	$id = $db->insert_id();	
	$q2 = content_get_go_codes($info['zongrenshu'],3000,$id);
	
	if($autocommit){
		if($q1 && $q2){
			$db->Autocommit_commit();
			return true;
		}else{
			$db->Autocommit_rollback();
			return false;
		}			
	}else{
		if($q1 && $q2){			
			return true;
		}else{		
			return false;
		}
	}
	
}//




?>