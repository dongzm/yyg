<?php
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_sys_fun('send');
System::load_sys_fun('user');
class shopajax extends base {
     private $Mcartlist;

	public function __construct(){
		parent::__construct();
/* 		if(ROUTE_A!='userphotoup' and ROUTE_A!='singphotoup'){
			if(!$this->userinfo)_message("请登录",WEB_PATH."/mobile/user/login",3);
		}	 */
		$this->db = System::load_sys_class('model');


		//查询购物车的信息
		$Mcartlist=_getcookie("Mcartlist");
		$this->Mcartlist=json_decode(stripslashes($Mcartlist),true);
	}

	//个人中心首页
	public function init(){
	     $pagetime=safe_replace($this->segment(4));
	    if(ROUTE_A!='userphotoup' and ROUTE_A!='singphotoup'){
			if(!$this->userinfo)_message("请登录",WEB_PATH."/mobile/user/login",3);
		}

		$member=$this->userinfo;
		$title="我的云购中心";

		 $user['code']=1;
		 $user['username']=get_user_name($member['uid']);
		 $user['uid']=$member['uid'];
		 if(!empty($member)){
		   $user['code']=0;
		 }

		echo json_encode($user);

	}
	//我的云购记录
	public function getUserBuyList(){
	   $member=$this->userinfo;
	   $FIdx=safe_replace($this->segment(4));
	   $EIdx=10;//safe_replace($this->segment(5));
	   $isCount=safe_replace($this->segment(6));
	   $state=safe_replace($this->segment(7));

	   if($state==-1){
	     //参与云购的商品 全部...
		  $shoplist=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$member[uid]' GROUP BY shopid ");


		  $shoplistall['listItems']=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$member[uid]' GROUP BY shopid order by a.time desc limit $FIdx,$EIdx " );
		}elseif($state==1){
		  //参与云购的商品 进行中...
		  $shoplist=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$member[uid]' and b.q_end_time is null GROUP BY shopid  " );


		  $shoplistall['listItems']=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$member[uid]' and b.q_end_time is null GROUP BY shopid order by a.time desc limit $FIdx,$EIdx " );
		}else{
		  //参与云购的商品 已揭晓...
		  $shoplist=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$member[uid]' and b.q_end_time is not null GROUP BY shopid " );


		  $shoplistall['listItems']=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$member[uid]' and b.q_end_time is not null GROUP BY shopid order by a.time desc limit $FIdx,$EIdx " );
		}

		if(!empty($shoplistall['listItems'])){
		   $shoplistall['code']=0;
		   $shoplistall['count']=count($shoplistall['listItems']);

		   foreach($shoplistall['listItems'] as $key=>$val){

			  $shoplistall['listItems'][$key]['q_user']=get_user_name($val['q_uid']);
			  $shoplistall['listItems'][$key]['q_end_time']=microt($val['q_end_time']);


			 if($val['q_end_time']!=''){
			   //商品已揭晓
			    $shoplistall['listItems'][$key]['codeState']=3;
				continue;

			 }elseif($val['shenyurenshu']==0){
			 //商品购买次数已满
			   $shoplistall['listItems'][$key]['codeState']=2;
			    continue;
			 }else{
			 //进行中
			    $shoplistall['listItems'][$key]['codeState']=1;

			 }
		   }
		}else{
		  $shoplistall['code']=1;
		}
        $shoplistall['count']=count($shoplist);
		echo json_encode($shoplistall);

	}

	//获得的商品
	public function getUserOrderList(){
	   $FIdx=safe_replace($this->segment(4));
	   $EIdx=10;//safe_replace($this->segment(5));

	   $member=$this->userinfo;
	   $order=$this->db->GetList("select * from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where b.q_uid='$member[uid]' " );

	   $orderlist['listItems']=$this->db->GetList("select * from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where b.q_uid='$member[uid]' and a.huode!=0 order by a.time desc limit $FIdx,$EIdx " );

		if(empty($orderlist['listItems'])){
		  $orderlist['code']=1;
		}else{
		foreach($orderlist['listItems'] as $key=>$val){
	        $orderlist['listItems'][$key]['q_end_time']=microt($val['q_end_time']);
	    }
		   $orderlist['code']=0;

		}
		$orderlist['count']=count($order);
	 // echo "<pre>";
	 // print_r($orderlist);

	  echo json_encode($orderlist);
	}

	//获取晒单
	public function getUserPostList(){
	   $FIdx=safe_replace($this->segment(4));
	   $EIdx=10;//safe_replace($this->segment(5));

	   $member=$this->userinfo;
	   $post=$this->db->GetList("select * from `@#_shaidan` a left join `@#_shoplist` b on a.sd_shopid=b.id where a.sd_userid='$member[uid]' order by a.sd_time desc" );

	   $postlist['listItems']=$this->db->GetList("select * from `@#_shaidan` a left join `@#_shoplist` b on a.sd_shopid=b.id where a.sd_userid='$member[uid]' order by a.sd_time desc limit $FIdx,$EIdx" );

		if(empty($postlist['listItems'])){
		  $postlist['code']=1;
		}else{

		  foreach($postlist['listItems'] as $key=>$val){
	        $postlist['listItems'][$key]['sd_time']=date('Y-m-d H:i',$val['sd_time']);
	      }

		   $postlist['code']=0;
		}
		$postlist['postCount']=count($post);

	  //echo "<pre>";
	  //print_r($postlist);

	  echo json_encode($postlist);
	}

	//获取未晒单
	public function getUserUnPostList(){
	   $FIdx=safe_replace($this->segment(4));
	   $EIdx=10;//safe_replace($this->segment(5));

	   $member=$this->userinfo;
	    //获得的商品
	    $orderlist=$this->db->GetList("select * from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where b.q_uid='$member[uid]' order by a.time desc" );

		//获取晒单
		$postlist=$this->db->GetList("select * from `@#_shaidan` a left join `@#_shoplist` b on a.sd_shopid=b.id where a.sd_userid='$member[uid]' order by a.sd_time desc" );
		$huoid='';

		$sd_id = $r_id = array();
		foreach($postlist as $sd){
			$sd_id[]=$sd['sd_shopid'];
		}

		foreach($orderlist as $rd){
			if(!in_array($rd['shopid'],$sd_id)){
				$r_id[]=$rd['shopid'];
			}
		}
		if(!empty($r_id)){
			$rd_id=implode(",",$r_id);
			$rd_id = trim($rd_id,',');
		}else{
			$rd_id="0";
		}

		//未晒单
	   $unpost=$this->db->GetList("select * from  `@#_shoplist`  where id in($rd_id) order by id" );

	   $unpostlist['listItems']=$this->db->GetList("select * from  `@#_shoplist`  where id in($rd_id) order by id limit  $FIdx, $EIdx" );

		if(empty($unpostlist['listItems'])){
		   $unpostlist['code']=1;
		}else{
		  foreach($unpostlist['listItems'] as $key=>$val){
	        $unpostlist['listItems'][$key]['q_end_time']=microt($val['q_end_time']);
	      }
		   $unpostlist['code']=0;
		}
	    $unpostlist['unPostCount']=count($unpost);

	  echo json_encode($unpostlist);

	}

	//充值记录
	public function getUserRecharge(){
	   $member=$this->userinfo;

	   $FIdx=safe_replace($this->segment(4));
	   $EIdx=10;//safe_replace($this->segment(5));

	    $Rechargelist=$this->db->GetList("select * from `@#_member_account` where `uid`='$member[uid]' and `pay` = '账户' and `type`='1'  ORDER BY time DESC");

	    $Recharge['listItems']=$this->db->GetList("select * from `@#_member_account` where `uid`='$member[uid]' and `pay` = '账户' and `type`='1'  ORDER BY time DESC limit $FIdx,$EIdx ");

        if(empty($Recharge['listItems'])){
		    $Recharge['code']=1;
		}else{
		  foreach($Recharge['listItems'] as $key=>$val){
		    $Recharge['listItems'][$key]['time']=date("Y-m-d H:i:s",$val['time']);
		  }
		    $Recharge['code']=0;
		}
 		$Recharge['count']=count($Rechargelist);

		echo json_encode($Recharge);

	}

	//消费记录
	public function getUserConsumption(){
	   $member=$this->userinfo;
	   $FIdx=safe_replace($this->segment(4));
	   $EIdx=10;//safe_replace($this->segment(5));

	   $Consumptionlist=$this->db->GetList("select * from `@#_member_account` where `uid`='$member[uid]' and `pay` = '账户' and `type`='-1' ");

	   $Consumption['listItems']=$this->db->GetList("select * from `@#_member_account` where `uid`='$member[uid]' and `pay` = '账户' and `type`='-1'  ORDER BY time DESC limit $FIdx,$EIdx ");
       	file_put_contents("D:/test.txt","select * from `@#_member_account` where `uid`='$member[uid]' and `pay` = '账户' and `type`='-1'  ORDER BY time DESC limit $FIdx,$EIdx ");
        if(empty($Consumption['listItems'])){
		    $Consumption['code']=1;
		}else{

		  foreach($Consumption['listItems'] as $key=>$val){
		    $Consumption['listItems'][$key]['time']=date("Y-m-d H:i:s",$val['time']);
		  }
		    $Consumption['code']=0;
		}
 		$Consumption['count']=count($Consumptionlist);

		echo json_encode($Consumption);

	}


}

?>