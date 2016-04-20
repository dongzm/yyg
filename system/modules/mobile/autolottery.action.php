<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_sys_fun('user');
System::load_app_fun('my');
System::load_app_fun('user');
class autolottery extends SystemAction {
	
	public function __construct() {	
		$this->db=System::load_sys_class('model');
	}
	//限时揭晓
	public function init(){
	    $webname=$this->_cfg['web_name'];
		//header("location: ".WEB_PATH);

		System::load_sys_fun('user');
		$title="限时揭晓"."_".$this->_cfg["web_name"];
		$jinri_time=abs(date("m")).'月'.date("d")."日";		
		$minri_time=abs(date("m",strtotime("+1 day"))).'月'.date("d",strtotime("+1 day"))."日";
		
		$w_jinri_time = strtotime(date('Y-m-d'));
		$w_minri_time = strtotime(date('Y-m-d',strtotime("+1 day")));		 
		
		$shoplist = $this->db->GetList("select * from `@#_shoplist` where `xsjx_time` > '$w_jinri_time' and `xsjx_time` < '$w_minri_time' order by `xsjx_time`  limit 0,3");	
		
			//获奖者本次总云购次数
		$user_shop_number = array();
	    if(!empty($shoplist)){
	      
        foreach($shoplist as $key=>$val){
		  
	     if($val['xsjx_time'] < time()){             	 
		   $uid=$val['q_uid'];	
           $qishu=$val['qishu'];	 
           $shopid=$val['id'];	 
           $user_shop_list = $this->db->GetList("select * from `@#_member_go_record` where `uid`= '$uid' and `shopid` = '$shopid' and `shopqishu` = '$qishu'");
		   $user_shop_number[$uid][$shopid]=0;
			foreach($user_shop_list as $user_shop_n){
				$user_shop_number[$uid][$shopid] += $user_shop_n['gonumber']; 
			}	    
		 } 
	    }	
	  }
	 
	 $count=count($shoplist);
	 $titlets='抱歉，今日没有发布限时揭晓商品！';
		 $date='today';
         $key="限时";
		 
		 //echo "<pre>";
		// print_r($shoplist);
		include templates("mobile/index","autolottery");
	}
	
   //限时揭晓 明日
	public function next(){
	    $webname=$this->_cfg['web_name'];
		//header("location: ".WEB_PATH);
		System::load_sys_fun('user'); 
		 
		$w_minri_time = strtotime(date('Y-m-d',strtotime("+1 day")));
		$w_hinri_time = strtotime(date('Y-m-d',strtotime("+2 day")));		
		
		 
		$shoplist = $this->db->GetList("select * from `@#_shoplist` where `xsjx_time` > '$w_minri_time' and `xsjx_time` < '$w_hinri_time' order by `xsjx_time` limit 0,3");
        	$count=count($shoplist);
            $titlets='抱歉，明日还没有发布限时揭晓商品！';			
		 $date='next'; 
         $key="限时";
		include templates("mobile/index","autolottery");
	}
	
		
	//ajax 商品揭晓
	public function autolottery_ret_install(){	
	    $webname=$this->_cfg['web_name'];
		if(isset($_POST['shopid'])){
			$id = intval($_POST['shopid']);
			$shop_info = $this->db->GetOne("select * from `@#_shoplist` where `id` = '$id' LIMIT 1");
			if(!$shop_info){
				echo '-1';
				exit;
			}
			
			if($shop_info['xsjx_time'] > time()){
				echo "-4";
				exit;	
			}
			
			
			$shop_info['xsjx_time']=$shop_info['xsjx_time'].'.000';
			if($shop_info['q_user_code']){
				echo $shop_info['q_user_code']; 
				exit;
			}		
			if($shop_info['canyurenshu']==0){
				//$shop_info['canyurenshu'] = rand(1,$shop_info['zongrenshu']);			
				echo '-3';
				exit;
			}
			$tocode = System::load_app_class("tocode","pay");
			# 我的修改
			$tocode->run_tocode($shop_info['xsjx_time'],100,$shop_info['canyurenshu'],$shop_info);
			$code =$tocode->go_code;
					
			$content =$tocode->go_content;
			$counttime = $tocode->count_time;
			$u_go_info = $this->db->GetOne("select * from `@#_member_go_record` where `shopid` = '$shop_info[id]' and `shopqishu` = '$shop_info[qishu]' and `goucode` LIKE  '%$code%'");	
			if($u_go_info){			
				$u_info = $this->db->GetOne("select * from `@#_member` where `uid` = '$u_go_info[uid]'");
				$q_user = serialize($u_info);
				$q_uid = $u_info['uid'];				
			}else{
				$u_go_info = $this->db->GetOne("select * from `@#_member_go_record` where `shopid` = '$shop_info[id]' and `shopqishu` = '$shop_info[qishu]' order by `gonumber` DESC");
				$u_info = $this->db->GetOne("select * from `@#_member` where `uid` = '$u_go_info[uid]'");
				$q_user = serialize($u_info);
				$q_uid = $u_info['uid'];
			}
			
			$this->db->Autocommit_start();
			
				$q_1 = $this->db->Query("UPDATE `@#_shoplist` SET								
								`q_uid` = '$q_uid',
								`q_user` = '$q_user',
								`q_user_code` = '$code',
								`q_content`	= '$content',
								`q_counttime` ='$counttime',
								`q_end_time` = '$shop_info[xsjx_time]'
								 where `id` = '$id'");
				if($u_go_info){
					$q_2 = $this->db->Query("UPDATE `@#_member_go_record` SET `huode` = '$code' where `code` = '$u_go_info[code]' and `uid` = '$u_go_info[uid]' and `shopid` = '$id' and `shopqishu` = '$shop_info[qishu]'");
				}else{
					$q_2 = true;
				}
				$q_3 = $this->autolottery_install($shop_info);
				if($q_1 && $q_2 && $q_3){					
					$this->db->Autocommit_commit();	
					echo $code."云购码";
					exit;
				}else{					
					$this->db->Autocommit_rollback();					
					echo '-2';
					exit;				
				}
					
			
		}
		echo '-1';
		exit;
	}//
	
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