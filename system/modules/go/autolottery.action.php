<?php
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_sys_fun('user');
System::load_app_fun('my');
System::load_app_fun('user');
@ini_set("memory_limit","-1");
class autolottery extends SystemAction {

	public function __construct() {
		$this->db=System::load_sys_class('model');
	}

	//限时揭晓
	public function init(){

		//header("location: ".WEB_PATH);
		System::load_sys_fun('user');
		$title="限时揭晓"."_".$this->_cfg["web_name"];
		$jinri_time=abs(date("m")).'月'.date("d")."日";
		$minri_time=abs(date("m",strtotime("+1 day"))).'月'.date("d",strtotime("+1 day"))."日";

		$w_jinri_time = strtotime(date('Y-m-d'));
		$w_minri_time = strtotime(date('Y-m-d',strtotime("+1 day")));
		$w_hinri_time = strtotime(date('Y-m-d',strtotime("+2 day")));

		$jinri_shoplist = $this->db->GetList("select * from `@#_shoplist` where `xsjx_time` > '$w_jinri_time' and `xsjx_time` < '$w_minri_time' order by id DESC limit 0,3");
		$minri_shoplist = $this->db->GetList("select * from `@#_shoplist` where `xsjx_time` > '$w_minri_time' and `xsjx_time` < '$w_hinri_time' order by id DESC limit 0,3");

		//往期回顾
		$endshoplist = $this->db->GetList("select * from `@#_shoplist` where `xsjx_time` != '0' and `q_uid` != '0' order by `xsjx_time` DESC limit 0,8");

		include templates("index","autolottery");
	}

	//ajax 商品揭晓
	public function autolottery_ret_install(){


		if(!isset($_POST['shopid'])){
			echo '-1';exit;
		}

		$id = intval($_POST['shopid']);
		$this->db->Autocommit_start();
		$shop_info = $this->db->GetOne("select * from `@#_shoplist` where `id` = '$id' for update");

		if(!$shop_info){
			echo '-1'; exit;
		}
		if($shop_info['xsjx_time'] > time()){
			echo "-4";exit;
		}

		if($shop_info['canyurenshu']=='0'){
			//$shop_info['canyurenshu'] = rand(1,$shop_info['zongrenshu']);
			echo '-3';exit;
		}
		if(!empty($shop_info['q_user_code']) && ($shop_info['q_showtime'] == 'Y')){
				echo '-6';exit;
		}
		if(!empty($shop_info['q_user_code']) && ($shop_info['q_showtime'] == 'N')){
			echo $shop_info['q_user_code']; exit;
		}


		$shop_info['xsjx_time']=$shop_info['xsjx_time'].'.000';
		$tocode = System::load_app_class("tocode","pay");

		# 我的修改
		$tocode->run_tocode($shop_info['xsjx_time'],100,$shop_info['canyurenshu'],$shop_info);
		$code =$tocode->go_code;
		$content = addslashes($tocode->go_content);
		$counttime = $tocode->count_time;

		$u_go_info = $this->db->GetOne("select * from `@#_member_go_record` where `shopid` = '$shop_info[id]' and `shopqishu` = '$shop_info[qishu]' and `goucode` LIKE  '%$code%'");
		if($u_go_info){
				$u_info = $this->db->GetOne("select * from `@#_member` where `uid` = '$u_go_info[uid]'");
				$u_info['username'] = _htmtocode($u_info['username']);
				$q_user = serialize($u_info);
				$q_uid = $u_info['uid'];
		}else{
				$reg_code = $this->suan_zd_code($shop_info['id'],$code);
				if(!$reg_code){echo '-2';exit;}
				$u_go_info = $this->db->GetOne("select * from `@#_member_go_record` where `shopid` = '$shop_info[id]' and `shopqishu` = '$shop_info[qishu]' and `goucode` LIKE  '%$reg_code%'");
				$u_info = $this->db->GetOne("select * from `@#_member` where `uid` = '$u_go_info[uid]'");
				$u_info['username'] = addslashes($u_info['username']);
				$q_user = serialize($u_info);
				$q_uid = $u_info['uid'];
		}

		$q_1 = $this->db->Query("UPDATE `@#_shoplist` SET
								`q_uid` = '$q_uid',
								`q_user` = '$q_user',
								`q_user_code` = '$code',
								`q_content`	= '$content',
								`q_counttime` ='$counttime',
								`q_end_time` = '$shop_info[xsjx_time]',
								`q_showtime` = 'Y'
								 where `id` = '$id'");

			if($u_go_info){
					$q_2 = $this->db->Query("UPDATE `@#_member_go_record` SET `huode` = '$code' where `id` = '$u_go_info[id]'");
			}else{
					$q_2 = true;
			}

			$q_3 = $this->autolottery_install($shop_info);
			if($q_1 && $q_2 && $q_3){
					$this->db->Autocommit_commit();
					//echo $code."云购码";exit;
					echo '-6';exit;
			}else{
				$this->db->Autocommit_rollback();
				echo '-2';exit;
			}

	}//

	private function suan_zd_code($gid,$r_code){
		$codes = $this->db->GetList("select goucode from `@#_member_go_record` where `shopid` = '$gid'");
		if(empty($codes))return false;
		$html = '';
		foreach($codes as $cv){
			$html .= $cv['goucode'].',';
		}
		if(empty($codes))return false;
		$codes = explode(',',$html);
		array_pop($codes);
		asort($codes);	//正序
		unset($html);
		$go_code  = $r_code;
		if($go_code > end($codes)){
				$zd_jin_code = end($codes);
		}else{
			$t=90000000;
			foreach($codes as $k=>$v){
					$s = abs($go_code-$v);
					if($s <= $t){
						$t = $s; $zd_jin_code = $v;
					}else{
						break;
					}
			}
		}
		unset($codes);
		return $zd_jin_code;
	}

	private function autolottery_install($shop=null){
		if($shop['qishu'] < $shop['maxqishu']){
			$time = time();
			System::load_app_fun("content",G_ADMIN_DIR);
			$goods = $shop;
			$qishu = $goods['qishu']+1;
			$shenyurenshu = $goods['zongrenshu'] - $goods['def_renshu'];
			$query_table = content_get_codes_table();
			$q_1 = $this->db->Query("INSERT INTO `@#_shoplist` (`sid`,`cateid`, `brandid`, `title`, `title_style`, `title2`, `keywords`, `description`, `money`, `yunjiage`, `zongrenshu`, `canyurenshu`,`shenyurenshu`,`def_renshu`, `qishu`,`maxqishu`,`thumb`, `picarr`, `content`,`codes_table`,`xsjx_time`,`renqi`,`pos`, `time`)
					VALUES
					('$goods[sid]','$goods[cateid]','$goods[brandid]','$goods[title]','$goods[title_style]','$goods[title2]','$goods[keywords]','$goods[description]','$goods[money]','$goods[yunjiage]','$goods[zongrenshu]','$goods[def_renshu]','$shenyurenshu','$goods[def_renshu]','$qishu','$goods[maxqishu]','$goods[thumb]','$goods[picarr]','$goods[content]','$query_table','0','$goods[renqi]','$goods[pos]','$time')
					");
			$id = $this->db->insert_id();
			$q_2 = content_get_go_codes($goods['zongrenshu'],3000,$id);
			if($q_1 && $q_2){
				return true;
			}else{
				return false;
			}
		}
		return true;
	}
}
?>