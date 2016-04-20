<?php
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_fun('my');
System::load_app_fun('user');
System::load_sys_fun('user');
class index extends base {
	public function __construct() {
		parent::__construct();
		$this->db=System::load_sys_class('model');
	}
	public function init(){
		///最新商品
		$new_shop=$this->db->GetOne("select * from `@#_shoplist` where `pos` = '1' and `q_uid` is null ORDER BY `id` DESC LIMIT 1");
		//即将揭晓
		$shoplist=$this->db->GetList("select * from `@#_shoplist` where `q_uid` is null ORDER BY `shenyurenshu` ASC LIMIT 8");
		$shoplist1=$this->db->GetList("select * from `@#_shoplist` where `q_uid` is null ORDER BY `shenyurenshu` DESC LIMIT 8");
		$shoplistone=$this->db->GetList("select * from `@#_shoplist` where `q_uid` is null ORDER BY `shenyurenshu` DESC LIMIT 2");
		//人气商品
		$shoplistrenqi=$this->db->GetList("select * from `@#_shoplist` where `renqi`='1' and `q_uid` is null ORDER BY id DESC LIMIT 8");
		$MM=$this->db->GetList("select * from `@#_shoplist` where `q_end_time` is not null and `q_showtime` = 'N' ORDER BY `q_end_time` DESC");
		$NN=count($MM);


		$max_renqi_qishu = 1;
		$max_renqi_qishu_id = 1;

		if(!empty($shoplistrenqi)){
			foreach ($shoplistrenqi as $renqikey =>$renqiinfo){
				if($renqiinfo['qishu'] >= $max_renqi_qishu){
					$max_renqi_qishu = $renqiinfo['qishu'];
					$max_renqi_qishu_id = $renqikey;
				}
			}
			$shoplistrenqi[$max_renqi_qishu_id]['t_max_qishu'] = 1;
		}
		$this_time = time();
		if(count($shoplistrenqi) > 1){
					if($shoplistrenqi[0]['time'] > $this_time - 86400*3)
					$shoplistrenqi[0]['t_new_goods'] = 1;
		}



		//他们正在云购
		$go_record=$this->db->GetList("select `@#_member`.uid,`@#_member`.username,`@#_member`.email,`@#_member`.mobile,`@#_member`.img,`@#_member_go_record`.shopname,`@#_member_go_record`.shopid from `@#_member_go_record`,`@#_member` where `@#_member`.uid = `@#_member_go_record`.uid and `@#_member_go_record`.`status` LIKE '%已付款%'  ORDER BY `@#_member_go_record`.time DESC LIMIT 0,9");
		//最新揭晓
		$shopqishu=$this->db->GetList("select qishu,id,sid,thumb,title,q_uid,q_user from `@#_shoplist` where `q_end_time` is not null and `q_showtime` = 'N' ORDER BY `q_end_time` DESC LIMIT 5");
		//云购动态
		$tiezi=$this->db->GetList("select * from `@#_quanzi_tiezi` where `qzid` = '1' order by `time` DESC LIMIT 5");
		//晒单分享
		$shaidan=$this->db->GetList("select * from `@#_shaidan` a left join `@#_member` b on  a.sd_userid=b.uid order by `sd_id` DESC LIMIT 1");
		$shaidan_two=$this->db->GetList("select * from `@#_shaidan` a left join `@#_member` b on  a.sd_userid=b.uid order by `sd_id` DESC LIMIT 1,6");
		 
		 
		 //晒单回复
	    $shaidan_huifu=$this->db->GetList("select * from `@#_shaidan_hueifu` a left join `@#_member` b on  a.sdhf_userid=b.uid order by `sdhf_id` DESC LIMIT 16");
		 
		 
		$member=$this->userinfo;
		include templates("index","index");
	}

	/*
		商品列表
	*/
	public function glist(){

		$select = ($this->segment(4)) ?  ($this->segment(4)) : '0_0_0';
		$select = explode("_",$select);
		$select[] = '0';
		$select[] = '0';

		$cid   = abs(intval($select[0]));
		$bid   = abs(intval($select[1]));
		$order = abs(intval($select[2]));


		$orders = '';
		switch($order){
			case  '1':
				$orders = 'order by `shenyurenshu` ASC';
			break;
			case  '2':
				$orders = "and `renqi` = '1'";
			break;
			case  '3':
				$orders = 'order by `shenyurenshu` ASC';
			break;
			case  '4':
				$orders = 'order by `time` DESC';
			break;
			case  '5':
				$orders = 'order by `money` DESC';
			break;
			case  '6':
				$orders = 'order by `money` ASC';
			break;
			default:
				$orders = 'order by `shenyurenshu` ASC';

		}


		/* 设置了查询分类ID 和品牌ID*/

		if(!$cid){
				$brand=$this->db->GetList("select id,cateid,name from `@#_brand` where 1 order by `order` DESC");

				$daohang_title = '所有分类';
		}else{

				$brand=$this->db->GetList("select id,cateid,name from `@#_brand` where `cateid` LIKE '%$cid%' order by `order` DESC");
				$daohang=$this->db->GetOne("select cateid,name,parentid,info from `@#_category` where `cateid` = '$cid' LIMIT 1");
				$daohang['info'] = unserialize($daohang['info']);

				$daohang_title = empty($daohang['info']['meta_title']) ? $daohang['name'] : $daohang['info']['meta_title'];
				$keywords = $daohang['info']['meta_keywords'];
				$description = $daohang['info']['meta_description'];
		}



		$title=$daohang_title . "_商品列表_"._cfg("web_name");


		//分页
		$num=20;
		/* 设置了查询分类ID 和品牌ID*/
		if($cid && $bid){
			$sun_id_str = "'".$cid."'";
			$sun_cate = $this->db->GetList("SELECT cateid from `@#_category` where `parentid` = '$daohang[cateid]'");
			foreach($sun_cate as $v){
				$sun_id_str .= ","."'".$v['cateid']."'";
			}
			$total=$this->db->GetCount("select id from `@#_shoplist` WHERE `q_uid` is null and `brandid`='$bid'  and `cateid` in ($sun_id_str)");

		}else{
			if($bid){
				$total=$this->db->GetCount("select id from `@#_shoplist` WHERE `q_uid` is null and `brandid`='$bid'");
			}elseif($cid){
				$sun_id_str = "'".$cid."'";
				$sun_cate = $this->db->GetList("SELECT cateid from `@#_category` where `parentid` = '$daohang[cateid]'");
				foreach($sun_cate as $v){
					$sun_id_str .= ","."'".$v['cateid']."'";
				}
				$total=$this->db->GetCount("select id from `@#_shoplist` WHERE `q_uid` is null and `cateid` in ($sun_id_str)");
			}else{
				$total=$this->db->GetCount("select id from `@#_shoplist` WHERE `q_uid` is null");
			}
		}


		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}
		$page->config($total,$num,$pagenum,"0");
		if($pagenum>$page->page){$pagenum=$page->page;}

		if($cid && $bid){
			$shoplist=$this->db->GetPage("select * from `@#_shoplist` where `q_uid` is null and `brandid`='$bid' and `cateid` in ($sun_id_str) $orders",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
		}else{
			if($bid){
				$shoplist=$this->db->GetPage("select * from `@#_shoplist` where `q_uid` is null and `brandid`='$bid' $orders",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
			}elseif($cid){
				$shoplist=$this->db->GetPage("select * from `@#_shoplist` where `q_uid` is null and `cateid` in ($sun_id_str) $orders",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
			}else{
				$shoplist=$this->db->GetPage("select * from `@#_shoplist` where `q_uid` is null $orders",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
			}
		}

		$this_time = time();
		include templates("index","glist");
	}

	//商品详细
	public function item(){
		$mysql_model=System::load_sys_class('model');
		$itemid=abs(intval(safe_replace($this->segment(4))));
		$item=$mysql_model->GetOne("select * from `@#_shoplist` where `id`='".$itemid."' LIMIT 1");
		if(!$item)_message("没有这个商品！",WEB_PATH,3);
		$q_showtime = (isset($item['q_showtime']) && $item['q_showtime'] == 'N') ? 'N' : 'Y';

		if($item['q_end_time'] && $q_showtime == 'N'){
			header("location: ".WEB_PATH."/dataserver/".$item['id']);
			exit;
		}



		$sid=$item['sid'];
		$sid_code=$mysql_model->GetOne("select * from `@#_shoplist` where `sid`='$sid' order by `id` DESC LIMIT 1,1");
		if($item['id'] == $sid_code['id']){
			$sid_code = null;
		}

		$sid_go_record=$mysql_model->GetOne("select * from `@#_member_go_record` where `shopid`='$sid_code[id]' and `uid`='$sid_code[q_uid]' and `huode`!=0 order by `id` DESC LIMIT 1");

		$category=$mysql_model->GetOne("select * from `@#_category` where `cateid` = '$item[cateid]' LIMIT 1");
		$brand=$mysql_model->GetOne("select * from `@#_brand` where `id`='$item[brandid]' LIMIT 1");

		$title=$item['title'].' ('.$item['title2'].')';

		$keywords = $item['keywords'];
		$description = $item['description'];

		$syrs=$item['zongrenshu']-$item['canyurenshu'];
		$item['picarr'] = unserialize($item['picarr']);


		$us=$mysql_model->GetList("select * from `@#_member_go_record` where `shopid`='".$itemid."' AND `shopqishu`='".$item['qishu']."'ORDER BY id DESC LIMIT 6");
		$us2=$mysql_model->GetList("select * from `@#_member_go_record` where `shopid`='".$itemid."' AND `shopqishu`='".$item['qishu']."'ORDER BY id DESC limit 50");


		//期数显示
		$itemlist = $this->db->GetList("select id,qishu,q_uid from `@#_shoplist` where `sid`='$item[sid]' order by `qishu` DESC");

		$loopqishu='<ul class="Period_list">';
		if(!$itemlist[0]['q_uid']){
			if($itemlist[0]['id'] == $item['id'])
				$loopqishu.='<li><a href="'.WEB_PATH.'/goods/'.$itemlist[0]['id'].'"><b class="period_Ongoing period_ArrowCur" style="padding-left:0px;">'."第".$itemlist[0]['qishu']."期<i></i></b></a></li>";
			else
				$loopqishu.='<li><a href="'.WEB_PATH.'/goods/'.$itemlist[0]['id'].'"><b class="period_Ongoing">'."第".$itemlist[0]['qishu']."期<i></i></b></a></li>";
		}else{
			if($itemlist[0]['id'] == $item['id'])
				$loopqishu.='<li><a href="'.WEB_PATH.'/goods/'.$itemlist[0]['id'].'"><b class="period_ArrowCur">'."第".$itemlist[0]['qishu']."期<i></i></b></a></li>";
			else
				$loopqishu.='<li><a href="'.WEB_PATH.'/dataserver/'.$itemlist[0]['id'].'" class="gray02">第'.$itemlist[0]['qishu'].'期</a></li>';
		}
		unset($itemlist[0]);
		foreach($itemlist as $key=>$qitem){
			if($key%9==0){
				$loopqishu.='</ul><ul class="Period_list">';
			}
			if($qitem['id'] == $item['id'])
				$loopqishu.='<li><b class="period_ArrowCur">第'.$qitem['qishu'].'期</b></li>';
			else
				$loopqishu.='<li><a href="'.WEB_PATH.'/dataserver/'.$qitem['id'].'" class="gray02">第'.$qitem['qishu'].'期</a></li>';
		}
		$loopqishu.='</ul>';


		include templates("index","item");
	}

	//往期商品查看
	public function dataserver(){

		$itemid=abs(intval($this->segment(4)));
		$item=$this->db->GetOne("select * from `@#_shoplist` where `id`='$itemid' LIMIT 1");
		if(!$item){
			_message("没有这个商品!");
		}
		if(empty($item['q_end_time']) && $item['q_showtime'] == 'Y'){
			header("location: ".WEB_PATH."/goods/".$item['id']);
			exit;
		}

		if(empty($item['q_user_code'])){
			_message("该商品正在进行中...",WEB_PATH.'/goods/'.$itemid);
		}
		if(isset($item['q_showtime']) && $item['q_showtime'] == 'Y'){
			header("location: ".WEB_PATH."/goods/".$item['id']);
			exit;
		}
		$category=$this->db->GetOne("select * from `@#_category` where `cateid` = '$item[cateid]' LIMIT 1");
		$brand=$this->db->GetOne("select * from `@#_brand` where `id` = '$item[brandid]' LIMIT 1");

		//云购中奖码
		$q_user = unserialize($item['q_user']);
		$q_user_code_len = strlen($item['q_user_code']);
		$q_user_code_arr = array();
		for($q_i=0;$q_i < $q_user_code_len;$q_i++){
			$q_user_code_arr[$q_i] = substr($item['q_user_code'],$q_i,1);
		}

		//总云购次数
		$user_shop_number = $this->db->GetOne("select sum(gonumber) as gonumber from `@#_member_go_record` where `uid`= '$item[q_uid]' and `shopid` = '$itemid' and `shopqishu` = '$item[qishu]'");
		$user_shop_number = $user_shop_number['gonumber'];
		//用户云购时间
		$user_shop_time = $this->db->GetOne("select time from `@#_member_go_record` where `uid`= '$item[q_uid]' and `shopid` = '$itemid' and `shopqishu` = '$item[qishu]' and `huode` = '$item[q_user_code]'");
		$user_shop_time = $user_shop_time['time'];

		//得到云购码
		$user_shop_codes_arr = $this->db->GetList("select goucode from `@#_member_go_record` where `uid`= '$item[q_uid]' and `shopid` = '$itemid' and `shopqishu` = '$item[qishu]'");
		$user_shop_codes = '';
		foreach($user_shop_codes_arr as $v){
			$user_shop_codes .= $v['goucode'].',';
		}

		$user_shop_codes = rtrim($user_shop_codes,',');

		$h=abs(date("H",$item['q_end_time']));
		$i=date("i",$item['q_end_time']);
		$s=date("s",$item['q_end_time']);
		$w=substr($item['q_end_time'],11,3);
		$user_shop_time_add = $h.$i.$s.$w;
		$user_shop_fmod = fmod($user_shop_time_add*100,$item['canyurenshu']);

		if($item['q_content']){
			$item_q_content = unserialize($item['q_content']);
			$keysvalue = $new_array = array();
			foreach($item_q_content as $k=>$v){
				$keysvalue[$k] = $v['time'];
				$h=date("H",$v['time']);
			    $i=date("i",$v['time']);
			    $s=date("s",$v['time']);
			    list($timesss,$msss) = explode(".",$v['time']);
				$item_q_content[$k]['timeadd'] = $h.$i.$s.$msss;

			}
			arsort($keysvalue);	//asort($keysvalue);正序
			reset($keysvalue);
			foreach ($keysvalue as $k=>$v){
				$new_array[$k] = $item_q_content[$k];
			}
			$item['q_content'] = $new_array;
		}



		$title=$item['title'].' ('.$item['title2'].')';
		$keywords = $item['keywords'];
		$description = $item['description'];

		$go_record_list = $this->db->GetList("select * from `@#_member_go_record` where `shopid` = '$item[id]' and `shopqishu` = '$item[qishu]' order by `id` DESC limit 50");
		$itemzx=$this->db->GetOne("select * from `@#_shoplist` where `sid`='$item[sid]' and `qishu`>'$item[qishu]' order by `qishu` DESC LIMIT 1");

		//期数显示
		$itemlist = $this->db->GetList("select id,sid,q_uid,qishu from `@#_shoplist` where `sid`='$item[sid]' order by `qishu` DESC");
		$loopqishu='<ul class="Period_list">';
		if(empty($itemlist[0]['q_uid'])){
			$loopqishu.='<li><a href="'.WEB_PATH.'/goods/'.$itemlist[0]['id'].'"><b class="period_Ongoing">'."第".$itemlist[0]['qishu']."期<i></i></b></a></li>";
			unset($itemlist[0]);
		}else{
			$loopqishu.='<li><a href="'.WEB_PATH.'/goods/'.$itemlist[0]['id'].'"><b class="period_ArrowCur">'."第".$itemlist[0]['qishu']."期<i></i></b></a></li>";
			unset($itemlist[0]);
		}
		if(empty($itemlist)){
			$loopqishu.='</ul>';
		}

		foreach($itemlist as $key=>$qitem){
			if($key%9==0){
				$loopqishu.='</ul><ul class="Period_list">';
			}
			if($qitem['id'] == $itemid){
				$loopqishu.='<li><b class="period_ArrowCur">第'.$qitem['qishu'].'期</b></li>';
			}else{
				$loopqishu.='<li><a href="'.WEB_PATH.'/dataserver/'.$qitem['id'].'" class="gray02">第'.$qitem['qishu'].'期</a></li>';
			}
		}

		// hyu-modify
		$num_big_add = 10000001;
		if ( empty($item['q_uid_a']) ) {
		  $user_shop_time_add_final = $user_shop_time_add;
		  $user_shop_fmod_final = $user_shop_fmod;
		} else {
		  $num_q = sprintf('%.0f',($user_shop_time_add*100/$item['canyurenshu']));
		  $user_shop_fmod_final = $item['q_user_assign'] - $num_big_add;
		  $user_shop_time_add_final = ($num_q*$item['canyurenshu']+$user_shop_fmod_final)/100;
		}

		include templates("index","dataserver");
	}

	//最新揭晓
	public function lottery(){
		//最新揭晓
		$page=System::load_sys_class('page');
		$total=$this->db->GetCount("select id from `@#_shoplist` where `q_uid` is not null and `q_showtime` = 'N'");

		if(isset($_GET['p'])){
			$pagenum=$_GET['p'];
		}else{
			$pagenum=1;
		}
		$num=20;
		$page->config($total,$num,$pagenum,"0");
		$shopqishu=$this->db->GetPage("select * from `@#_shoplist` where `q_uid` is not null and `q_showtime` = 'N' ORDER BY `q_end_time` DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));

		$shoplist=$this->db->GetList("select * from `@#_shoplist` where `q_uid` is null  ORDER BY `canyurenshu` DESC LIMIT 4");
		$member_record=$this->db->GetList("select * from `@#_member_go_record` order by id DESC limit 6");
		include templates("index","lottery");
	}


	
		//认证资质
		public function qualification (){	
		
		
			include templates("index","qualification");
	}
	
	//android下载
		public function android (){	
		
		
			include templates("single_web","android");
	}
//iPhone下载
		public function iPhone (){	
		
		
			include templates("single_web","iPhone");
	}
	//微信扫描
		public function weixin (){	
		
		
			include templates("single_web","weixin");
			}
	//动态app
		public function app (){	
		
		
			include templates("single_web","app");
				}
	//桌面版
		public function desktop (){	
		
		
			include templates("single_web","desktop");
					}
	//触屏版
		public function touch (){	
		
		
			include templates("single_web","touch");
						}
	//app2
		public function app2 (){	
		
		
			include templates("single_web","app2");
	}
	//intro
		public function intro(){	
		
		
			include templates("single_web","intro");
	}
	}
?>