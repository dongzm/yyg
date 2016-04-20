<?php



/*
*   生成购买的云购码
*	user_num 		@生成个数
*	shopinfo		@商品信息
*	ret_data		@返回信息
*/
function pay_get_shop_codes($user_num=1,$shopinfo=null,&$ret_data=null){

		$db = System::load_sys_class("model");
		$ret_data['query'] = true;
		$table = '@#_'.$shopinfo['codes_table'];
		$codes_arr = array();
		$codes_one = $db->GetOne("select id,s_id,s_cid,s_len,s_codes from `$table` where `s_id` = '$shopinfo[id]' order by `s_cid` DESC  LIMIT 1 for update");
		$codes_arr[$codes_one['s_cid']] = $codes_one;
		$codes_count_len = $codes_arr[$codes_one['s_cid']]['s_len'];

		if($codes_count_len < $user_num && $codes_one['s_cid'] > 1){
			for($i=$codes_one['s_cid']-1;$i>=1;$i--):
				$codes_arr[$i] = $db->GetOne("select id,s_id,s_cid,s_len,s_codes from `$table` where `s_id` = '$shopinfo[id]' and `s_cid` = '$i'  LIMIT 1 for update");
				$codes_count_len += $codes_arr[$i]['s_len'];
				if($codes_count_len > $user_num)  break;
			endfor;
		}

		if($codes_count_len < $user_num) $user_num = $codes_count_len;

		$ret_data['user_code'] = '';
		$ret_data['user_code_len'] = 0;

		foreach($codes_arr as $icodes){
			$u_num = $user_num;
			$icodes['s_codes'] = unserialize($icodes['s_codes']);
			$code_tmp_arr = array_slice($icodes['s_codes'],0,$u_num);
			$ret_data['user_code'] .= implode(',',$code_tmp_arr);
			$code_tmp_arr_len = count($code_tmp_arr);

			if($code_tmp_arr_len < $u_num){
				$ret_data['user_code'] .= ',';
			}

			$icodes['s_codes'] = array_slice($icodes['s_codes'],$u_num,count($icodes['s_codes']));
			$icode_sub = count($icodes['s_codes']);
			$icodes['s_codes'] = serialize($icodes['s_codes']);

			if(!$icode_sub){
				$query = $db->Query("UPDATE `$table` SET `s_cid` = '0',`s_codes` = '$icodes[s_codes]',`s_len` = '$icode_sub' where `id` = '$icodes[id]'");
				if(!$query)$ret_data['query'] = false;
			}else{
				$query = $db->Query("UPDATE `$table` SET `s_codes` = '$icodes[s_codes]',`s_len` = '$icode_sub' where `id` = '$icodes[id]'");
				if(!$query)$ret_data['query'] = false;
			}
			$ret_data['user_code_len'] += $code_tmp_arr_len;
			$user_num  = $user_num - $code_tmp_arr_len;


		}

}


//生成订单号
function pay_get_dingdan_code($dingdanzhui=''){
	return $dingdanzhui.time().substr(microtime(),2,6).rand(0,9);
}


/*
	揭晓与插入商品
	@shop   商品数据
*/

function pay_insert_shop_x($shop='',$type=''){

	$g_c_x = System::load_app_config("get_code_x",'',"pay");
	if(is_array($g_c_x) && isset($g_c_x['class'])){
		$gcx_db = System::load_app_class($g_c_x['class'],"pay");
	}else{
		$g_c_x = array("class"=>"tocode");
		$gcx_db = System::load_app_class($g_c_x['class'],"pay");
	}

	$gcx_db->config($shop,$type);
	$gcx_db->get_run_tocode();
	$ret_data = $gcx_db->returns();



}

/*
	揭晓与插入商品
	@shop   商品数据
*/
function pay_insert_shop($shop='',$type=''){

	$time=sprintf("%.3f",microtime(true)+(int)System::load_sys_config('system','goods_end_time'));
	$db = System::load_sys_class("model");
	if($shop['xsjx_time'] != '0'){
		return $db->Query("UPDATE `@#_shoplist` SET `canyurenshu`=`zongrenshu`,	`shenyurenshu` = '0' where `id` = '$shop[id]'");
	}
	$tocode = System::load_app_class("tocode","pay");
	$tocode->shop = $shop;
	$tocode->run_tocode($time,100,$shop['canyurenshu'],$shop);

	$code =$tocode->go_code;

	$content = addslashes($tocode->go_content);
	$counttime = $tocode->count_time;
	//20140901新增，判断是否指定中奖//
	if($shop['zhiding']){
		$ex_info=$db->GetOne("select * from `@#_member_go_record` where `shopid` = '$shop[id]' and `shopqishu` = '$shop[qishu]' and `uid`='{$shop['zhiding']}'");
	    $ex_code=explode(",",$ex_info['goucode']);
		$ex_count=count($ex_code);
		$ex_rand=rand(0,$ex_count-1);
		if($ex_code[$ex_rand]){
			$chazhi=$ex_code[$ex_rand]-$code;
			if($chazhi>0)$counttime=$counttime+$chazhi;
			else $counttime=$counttime-abs($chazhi);
			$code=$ex_code[$ex_rand];
			/*
			$tempinfo = $db->GetOne("select * from `@#_member_go_record` where `shopid` = '$shop[id]' and `shopqishu` = '$shop[qishu]' and `goucode` LIKE  '%$code%'");
			//本来的中奖码对应的记录
			$str=str_replace($code,$ex_code[0],$tempinfo['goucode']);
			$db->Query("update `@#_member_go_record` set goucode='$str' where id='{$tempinfo['id']}'");
			//将系统原来的中奖吗对应的购买记录换成指定中奖会员购买的code
			$str2=str_replace($ex_code[0],$code,$ex_info['goucode']);
			$db->Query("update `@#_member_go_record` set goucode='$str2' where id='{$ex_info['id']}'");
			//将指定中奖会员的购买记录中的code换成系统计算出来的中奖吗
			*/

			//添加时间校准
			if(!empty($chazhi)){
				$last_info=$db->GetOne("select * from `@#_member_go_record` where `shopid` = '$shop[id]' and `shopqishu` = '$shop[qishu]' order by id desc limit 1");
				$time_t_str = str_replace('.','',$last_info['time']);
				$time_str = bcadd($time_t_str,$chazhi);
				$time_arr = str_split($time_str,10);
				$str_t_time = $time_arr[0].'.'.$time_arr[1];
				$db->Query("UPDATE `@#_member_go_record` SET `time`='$str_t_time' where `id` = '{$last_info['id']}'");

				$tocode = System::load_app_class("tocode","pay");
				$tocode->shop = $shop;
				$tocode->run_tocode($time,100,$shop['canyurenshu'],$shop);
				$content = addslashes($tocode->go_content);
			}
		}
	}
	/////////////////

	$u_go_info = $db->GetOne("select * from `@#_member_go_record` where `shopid` = '$shop[id]' and `shopqishu` = '$shop[qishu]' and `goucode` LIKE  '%$code%'");
	$u_info = $db->GetOne("select uid,username,email,mobile,img from `@#_member` where `uid` = '$u_go_info[uid]'");


	//更新商品
	$query = true;
	if($u_info){
		$u_info['username'] = _htmtocode($u_info['username']);
		$q_user = serialize($u_info);
		$gtimes = (int)System::load_sys_config('system','goods_end_time');
		if($gtimes == 0 || $gtimes == 1){
			$q_showtime = 'N';
		}else{
			$q_showtime = 'Y';
		}
		$sqlss = "UPDATE `@#_shoplist` SET
							`canyurenshu`=`zongrenshu`,
							`shenyurenshu` = '0',
							`q_uid` = '$u_info[uid]',
							`q_user` = '$q_user',
							`q_user_code` = '$code',
							`q_content`	= '$content',
							`q_counttime` ='$counttime',
							`q_end_time` = '$time',
							`q_showtime` = '$q_showtime'
							 where `id` = '$shop[id]'";


		file_put_contents("asasas.sql",$sqlss);

		$q = $db->Query($sqlss);

		if(!$q)$query = false;

		if($q){
			$q = $db->Query("UPDATE `@#_member_go_record` SET `huode` = '$code' where `id` = '$u_go_info[id]' and `code` = '$u_go_info[code]' and `uid` = '$u_go_info[uid]' and `shopid` = '$shop[id]' and `shopqishu` = '$shop[qishu]'");
			if(!$q) {
				$query = false;
			}else{
				$post_arr= array("uid"=>$u_info['uid'],"gid"=>$shop['id'],"send"=>1);
				_g_triggerRequest(WEB_PATH.'/api/send/send_shop_code',false,$post_arr);
			}
		}else{
			$query =  false;
		}
	}else{
		$query =  false;
	}

	/******************************/


	/*新建*/
	if($query){
		if($shop['qishu'] < $shop['maxqishu']){
			$maxinfo = $db->GetOne("select * from `@#_shoplist` where `sid` = '$shop[sid]' order by `qishu` DESC LIMIT 1");
			if(!$maxinfo){
				$maxinfo=array("qishu"=>$shop['qishu']);
			}
			System::load_app_fun("content",G_ADMIN_DIR);
			$intall = content_add_shop_install($maxinfo,false);
			if(!$intall) return $query;
		}
	}
	return $query;
}


/*
	云购基金
	go_number @云购人次
*/
function pay_go_fund($go_number=null){
	if(!$go_number)return true;
	$db = System::load_sys_class("model");
	$fund = $db->GetOne("select * from `@#_fund` where 1");
	if($fund && $fund['fund_off']){
		$money = $fund['fund_money'] * $go_number + $fund['fund_count_money'];
		return $db->Query("UPDATE `@#_fund` SET `fund_count_money` = '$money'");
	}else{
		return true;
	}
}


/*
	用户佣金
	uid 		用户id
	dingdancode	@订单号
*/
function pay_go_yongjin($uid=null,$dingdancode=null){
	if(!$uid || !$dingdancode)return true;
	$db = System::load_sys_class("model");$time=time();
	$config = System::load_app_config("user_fufen",'','member');//福分/经验/佣金
	$yesyaoqing=$db->GetOne("SELECT `yaoqing` FROM `@#_member` WHERE `uid`='$uid'");
	if($yesyaoqing['yaoqing']){
		$yongjin=$config['fufen_yongjin']; //每一元返回的佣金
	}else{
		return true;
	}
	$yongjin = floatval(substr(sprintf("%.3f",$yongjin), 0, -1));
	$gorecode=$db->GetList("SELECT * FROM `@#_member_go_record` WHERE `code`='$dingdancode'");
	foreach($gorecode as $val){
		$y_money=$val['moneycount'] * $yongjin;
		$content="(第".$val['shopqishu']."期)".$val['shopname'];
		$db->Query("INSERT INTO `@#_member_recodes`(`uid`,`type`,`content`,`shopid`,`money`,`ygmoney`,`time`)VALUES('$uid','1','$content','$val[shopid]','$y_money','$val[moneycount]','$time' )");
	}

}

?>

