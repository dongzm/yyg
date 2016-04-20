<?php
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_sys_fun('send');
System::load_sys_fun('user');
class ajax extends base {
     private $Mcartlist;

	public function __construct(){
		parent::__construct();
/* 		if(ROUTE_A!='userphotoup' and ROUTE_A!='singphotoup'){
			if(!$this->userinfo)_message("请登录",WEB_PATH."/mobile/user/login",3);
		}	 */
		$this->db = System::load_sys_class('model');


		//查询购物车的信息
		$Mcartlist=_getcookie("Cartlist");
		$this->Mcartlist=json_decode(stripslashes($Mcartlist),true);
	}
	public function init(){
	    if(ROUTE_A!='userphotoup' and ROUTE_A!='singphotoup'){
			if(!$this->userinfo)_message("请登录",WEB_PATH."/mobile/user/login",3);
		}

		$member=$this->userinfo;
		$title="我的会员中心";

		 $user['code']=1;
		 $user['username']=get_user_name($member['uid']);
		 $user['uid']=$member['uid'];
		 if(!empty($member)){
		   $user['code']=0;
		 }

		echo json_encode($user);


	}
	//幻灯
	public function slides(){
	  $sql="select * from `@#_wap` where 1";
	  $SlideList=$this->db->GetList($sql);
	  if(empty($SlideList)){
	    $slides['state']=1;
	  }else{
	   $slides['state']=0;
	    foreach($SlideList as $key=>$val){
		   $shopid = ereg_replace('[^0-9]','',$val['link']);
		  // $shopid=explode("/",$val['link']);
		   $slides['listItems'][$key]['alt']=$val['color'];
		   $slides['listItems'][$key]['url']=WEB_PATH."/mobile/mobile/item/".$shopid;
		   $slides['listItems'][$key]['src']=G_WEB_PATH."/statics/uploads/".$val['img'];
		   $slides['listItems'][$key]['width']='614PX';
		   $slides['listItems'][$key]['height']='110PX';

		}

	  }
	   echo json_encode($slides);
	}

   // 今日揭晓商品
    public function show_jrjxshop(){
		$pagetime=safe_replace($this->segment(4));


		$w_jinri_time = strtotime(date('Y-m-d'));
		$w_minri_time = strtotime(date('Y-m-d',strtotime("+1 day")));


		$jinri_shoplist = $this->db->GetList("select * from `@#_shoplist` where `xsjx_time` > '$w_jinri_time' and `xsjx_time` < '$w_minri_time' order by xsjx_time limit 0,3 ");

		if(!empty($jinri_shoplist)){
		   $m['errorCode']=0;
		}else{
		   $m['errorCode']=1;
		}
		//echo $pagetime;
		echo json_encode($m);

	}
	//最新揭晓商品
	public function show_newjxshop(){

		//最新揭晓
		$shopqishu=$this->db->GetList("select * from `@#_shoplist` where `q_end_time` !='' ORDER BY `q_end_time` DESC LIMIT 4");

		echo json_encode($shopqishu);

	}

	//即将揭晓商品
	public function show_msjxshop(){
	      //暂时没做



		//即将揭晓商品
	    $shoplist['listItems'][0]['codeID']=14;  //商品id
	    $shoplist['listItems'][0]['period']=3;  //商品期数
	    $shoplist['listItems'][0]['goodsSName']='苹果';  //商品名称
	    $shoplist['listItems'][0]['seconds']=10;  //商品名称

		$shoplist['errorCode']=0;
		//echo json_encode($shoplist);

	}

    //购物车数量
	public function cartnum(){
	  $Mcartlist=$this->Mcartlist;
	  if(is_array($Mcartlist)){
	  	  $cartnum['code']=0;
	      $cartnum['num']=count($Mcartlist);
	  }else{
	  	  $cartnum['code']=1;
	      $cartnum['num']=0;
	  }
      //var_dump($Mcartlist);
	  echo json_encode($cartnum);
	}

	//添加购物车
	public function addShopCart(){
	  $ShopId=safe_replace($this->segment(4));
	  $ShopNum=safe_replace($this->segment(5));

	  $cartbs=safe_replace($this->segment(6));//标识从哪里加的购物车

	  $shopis=0;          //0表示不存在  1表示存在
	  $Mcartlist=$this->Mcartlist;
	if($ShopId==0 || $ShopNum==0){

	  $cart['code']=1;   //表示添加失败

	}else{
		  if(is_array($Mcartlist)){
			foreach($Mcartlist as $key=>$val){
			   if($key==$ShopId){
			      if(isset($cartbs) && $cartbs=='cart'){
	                $Mcartlist[$ShopId]['num']=$ShopNum;
				  }else{
				    $Mcartlist[$ShopId]['num']=$val['num']+$ShopNum;
				  }
				  $shopis=1;
			   }else{
				  $Mcartlist[$key]['num']=$val['num'];
			   }
			}

		  }else{
			  $Mcartlist =array();
			  $Mcartlist[$ShopId]['num']=$ShopNum;
		  }


           if($shopis==0){
		     $Mcartlist[$ShopId]['num']=$ShopNum;
		   }

       _setcookie('Cartlist',json_encode($Mcartlist),'');
	  $cart['code']=0;   //表示添加成功
	}

	  $cart['num']=count($Mcartlist);    //表示现在购物车有多少条记录

	  echo json_encode($cart);

	}

	public function delCartItem(){
	   $ShopId=safe_replace($this->segment(4));

	   $cartlist=$this->Mcartlist;

		if($ShopId==0){

		  $cart['code']=1;   //删除失败

		}else{
			   if(is_array($cartlist)){
			      if(count($cartlist)==1){
				     foreach($cartlist as $key=>$val){
					   if($key==$ShopId){
					     $cart['code']=0;
						    _setcookie('Cartlist','','');
						}else{
					     $cart['code']=1;
					   }
					 }

				  }else{
					   foreach($cartlist as $key=>$val){
							if($key==$ShopId){
							  $cart['code']=0;
							}else{
							  $Mcartlist[$key]['num']=$val['num'];
							}
						}

						   _setcookie('Cartlist',json_encode($Mcartlist),'');

					}

				}else{
				   $cart['code']=1;   //删除失败
				}

		}
		echo json_encode($cart);
	}

	public function getCodeState(){
	  $itemid=safe_replace($this->segment(4));
	  $item=$mysql_model->GetOne("select * from `@#_shoplist` where `id`='".$itemid."' LIMIT 1");

	  $a['Code']=1;
	  if(!$item){
	     $a['Code']=0;
	  }

	 echo json_encode($a);
	}


	//login
	public function userlogin(){
	    $username=safe_replace($this->segment(4));
	    $pwd = base64_decode($this->segment(5));
	    $password=md5(safe_replace($pwd));

		$logintype='';
		if(strpos($username,'@')==false){
			//手机
			$logintype='mobile';
		}else{
			//邮箱
			$logintype='email';
		}

		$member=$this->db->GetOne("select * from `@#_member` where `$logintype`='$username' and `password`='$password'");
		if(!$member){
			//帐号不存在错误
			$user['state']=1;
			$user['num']=-2;
			echo json_encode($user);die;
		}

		if($member[$logintype.'code'] != 1){
			$user['state']=2; //未验证
			echo json_encode($user);die;
		}

		if(!is_array($member)){
			//帐号或密码错误
			$user['state']=1;
			$user['num']=-1;
		}else{
		   //登录成功
			_setcookie("uid",_encrypt($member['uid']),60*60*24*7);
			_setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])),60*60*24*7);

			$user['state']=0;

		}
		echo json_encode($user);
	}

	//登录成功后
	public function loginok(){

	  $user['Code']=0;
	  echo json_encode($user);
	}
	/***********************************注册*********************************/

	//检测用户是否已注册
	public function checkname(){
	    $config_email = System::load_sys_config("email");
		$config_mobile = System::load_sys_config("mobile");


		$name= $this->segment(4);

		$regtype=null;
		if(_checkmobile($name)){
			$regtype='mobile';
			$cfg_mobile_type  = 'cfg_mobile_'.$config_mobile['cfg_mobile_on'];
			$config_mobile = $config_mobile[$cfg_mobile_type];
			if(empty($config_mobile['mid']) && empty($config_email['mpass'])){

				 $user['state']=2;//_message("系统短息配置不正确!");
				 echo json_encode($user);
				 exit;
			}
		}
		$member=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `mobile` = '$name' LIMIT 1");
		if(is_array($member)){
			if($member['mobilecode']==1 || $member['emailcode']==1){
			  $user['state']=1;//_message("该账号已被注册");
			}else{
			  $sql="DELETE from`@#_member` WHERE `mobile` = '$name'";
			  $this->db->Query($sql);
			  $user['state']=0;
			}
		}else{
		    $user['state']=0;//表示数据库里没有该帐号
		}

	    echo json_encode($user);
	}

	//将数据注册到数据库
	public function userMobile(){
# 我的修改
		$name= isset($_GET['username'])? $_GET['username']: $this->segment(4);
		$pass= isset($_GET['password'])? md5($_GET['password']): md5(base64_decode($this->segment(5)));
		$time=time();
		$decode = 0;
		//邮箱验证 -1 代表未验证， 1 验证成功 都不等代表等待验证
		$sql="INSERT INTO `@#_member`(`mobile`,password,img,emailcode,mobilecode,yaoqing,time)VALUES('$name','$pass','photo/member.jpg','-1','-1','$decode','$time')";
		if(!$name || $this->db->Query($sql)){
			//header("location:".WEB_PATH."/mobile/user/".$regtype."check"."/"._encrypt($name));
			//exit;
			$userMobile['state']=0;
		}else{
			//_message("注册失败！");
			$userMobile['state']=1;
		}
	  echo json_encode($userMobile);
	}

	//验证输入的手机验证码
	public function mobileregsn(){
	    $mobile= $this->segment(4);
	    $checkcodes= $this->segment(5);

		$member=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `mobile` = '$mobile' LIMIT 1");

			if(strlen($checkcodes)!=6){
			    //_message("验证码输入不正确!");
				$mobileregsn['state']=1;
				echo json_encode($mobileregsn);
				exit;
			}
			$usercode=explode("|",$member['mobilecode']);
			if($checkcodes!=$usercode[0]){
			   //_message("验证码输入不正确!");
				$mobileregsn['state']=1;
				echo json_encode($mobileregsn);
				exit;
			}


			$this->db->Query("UPDATE `@#_member` SET mobilecode='1' where `uid`='$member[uid]'");

			_setcookie("uid",_encrypt($member['uid']),60*60*24*7);
			_setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])),60*60*24*7);

			 $mobileregsn['state']=0;
			 $mobileregsn['str']=1;

	        echo json_encode($mobileregsn);
	}

	//重新发送验证码
	public function sendmobile(){

	  		$name=$this->segment(4);
			$member=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `mobile` = '$name' LIMIT 1");
			if(!$member){
			    //_message("参数不正确!");
				$sendmobile['state']=1;
				echo json_encode($sendmobile);
				exit;
		    }
			$checkcode=explode("|",$member['mobilecode']);
			$times=time()-$checkcode[1];
			if($times > 120){

				$sendok = send_mobile_reg_code($name,$member['uid']);
				if($sendok[0]!=1){
					//_message($sendok[1]);exit;
                   	$sendmobile['state']=1;
					echo json_encode($sendmobile);
					exit;
				}
				//成功
				    $sendmobile['state']=0;
					echo json_encode($sendmobile);
					exit;
			}else{
				    $sendmobile['state']=1;
					echo json_encode($sendmobile);
					exit;
			}

	}
	//最新揭晓
	public function getLotteryList(){
	   $FIdx=$this->segment(4);
	   $EIdx=10;//$this->segment(5);
	   $isCount=$this->segment(6);

	   $shopsum=$this->db->GetList("select * from `@#_shoplist` where `q_end_time` !='' ");

	   //最新揭晓
		$shoplist['listItems']=$this->db->GetList("select * from `@#_shoplist` where `q_end_time` !='' ORDER BY `q_end_time` DESC limit $FIdx,$EIdx");

		if(empty($shoplist['listItems'])){
		  $shoplist['code']=1;
		}else{
		 foreach($shoplist['listItems'] as $key=>$val){
		 //查询出购买次数
		   $recodeinfo=$this->db->GetOne("select `gonumber` from `@#_member_go_record` where `uid` ='$val[q_uid]'  and `shopid`='$val[id]' ");
		   //echo "select `gonumber` from `@#_member_go_record` where `uid` !='$val[q_uid]'  and `shopid`='$val[id]' ";
		   $shoplist['listItems'][$key]['q_user']=get_user_name($val['q_uid']);
		   $shoplist['listItems'][$key]['userphoto']=get_user_key($val['q_uid'],'img');
		   $shoplist['listItems'][$key]['q_end_time']=microt($val['q_end_time']);
		   $shoplist['listItems'][$key]['gonumber']=$recodeinfo['gonumber'];
		 }
		  $shoplist['code']=0;
		  $shoplist['count']=count($shopsum);
		}

		echo json_encode($shoplist);

	}

	//访问他人购买记录
	public function getUserBuyList(){
	   $type=$this->segment(4);
	   $uid=$this->segment(5);
	   $FIdx=$this->segment(6);
	   $EIdx=10;//$this->segment(7);
	   $isCount=$this->segment(8);

		 if($type==0){
          //参与云购的商品 全部...
		  $shoplist=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$uid' GROUP BY shopid ");

		  $shop['listItems']=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$uid' GROUP BY shopid order by a.time desc limit $FIdx,$EIdx " );
		 }elseif($type==1){
		   //获得奖品
		    $shoplist=$this->db->GetList("select * from  `@#_shoplist`  where q_uid='$uid' " );

		    $shop['listItems']=$this->db->GetList("select * from  `@#_shoplist`  where q_uid='$uid' order by q_end_time desc limit $FIdx,$EIdx" );
		 }elseif($type==2){
		   //晒单记录
		    $shoplist=$this->db->GetList("select * from `@#_shaidan` a left join `@#_shoplist` b on a.sd_shopid=b.id where a.sd_userid='$uid' " );

		    $shop['listItems']=$this->db->GetList("select * from `@#_shaidan` a left join `@#_shoplist` b on a.sd_shopid=b.id where a.sd_userid='$uid' order by a.sd_time desc limit $FIdx,$EIdx" );

		 }

		 if(empty($shop['listItems'])){
		   $shop['code']=4;

		 }else{
		   foreach($shop['listItems'] as $key=>$val){
		      if($val['q_end_time']!=''){
			    $shop['listItems'][$key]['codeState']=3;
			    $shop['listItems'][$key]['q_user']=get_user_name($val['q_uid']);
                $shop['listItems'][$key]['q_end_time']=microt($val['q_end_time']);

			  }
			  if(isset($val['sd_time'])){
			   $shop['listItems'][$key]['sd_time']=date('m月d日 H:i',$val['sd_time']);
			  }
		   }
		   $shop['code']=0;
		   $shop['count']=count($shoplist);
		 }
		 //ECHO "<PRE>";
	     //PRINT_R($shop);

	   echo json_encode($shop);
	}

	 //查看计算结果
	 public function getCalResult(){
	     $itemid=$this->segment(4);
		 $curtime=time();

		 $item=$this->db->GetOne("select * from `@#_shoplist` where `id`='$itemid' and `q_end_time` is not null LIMIT 1");

		if($item['q_content']){
		    $item['contcode']=0;
			$item['itemlist'] = unserialize($item['q_content']);

			foreach($item['itemlist'] as $key=>$val){
			  	$item['itemlist'][$key]['time']	=microt($val['time']);
				$h=date("H",$val['time']);
			    $i=date("i",$val['time']);
			    $s=date("s",$val['time']);
			    list($timesss,$msss) = explode(".",$val['time']);

				$item['itemlist'][$key]['timecode']=$h.$i.$s.$msss;
			}

		}else{
		    $item['contcode']=1;
		}

		if(!empty($item)){
		  $item['code']=0;

		}else{
		  $item['code']=1;
		}

    //echo "<pre>";
	//print_r($item);
	//print_r($record_time);
	   echo json_encode($item);


	 }


	 //付款
	public function UserPay(){


	}

	//显示两分钟内 马上揭晓的商品
	public function GetStartRaffleAllList(){

	   //暂时没有该功能。。。。。
	}


}

?>