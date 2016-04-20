<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_sys_fun('send');
System::load_sys_fun('user');
class invite extends base {
	public function __construct(){ 
		parent::__construct();
		if(ROUTE_A!='userphotoup' and ROUTE_A!='singphotoup'){
			if(!$this->userinfo)_message("请登录",WEB_PATH."/mobile/user/login",3);
		}		
		$this->db = System::load_sys_class('model');
	}

	function friends(){
        $webname=$this->_cfg['web_name'];
        $member=$this->userinfo;
        $title="我的会员中心";
        $memberdj=$this->db->GetList("select * from `@#_member_group`");
        $jingyan=$member['jingyan'];
        if(!empty($memberdj)){
            foreach($memberdj as $key=>$val){
                if($jingyan>=$val['jingyan_start'] && $jingyan<=$val['jingyan_end']){
                    $member['yungoudj']=$val['name'];
                }
            }
        }

        $mysql_model=System::load_sys_class('model');
        $member=$this->userinfo;
        $uid=_getcookie('uid');
        $notinvolvednum=0;  //未参加云购的人数
        $involvednum=0;     //参加预购的人数
        $involvedtotal=0;   //邀请人数


        //查询邀请好友信息
        $invifriends=$mysql_model->GetList("select * from `@#_member` where `yaoqing`='$member[uid]' ORDER BY `time` DESC");
        $involvedtotal=count($invifriends);


        //var_dump($invifriends);

        for($i=0;$i<count($invifriends);$i++){
            $sqluid=$invifriends[$i]['uid'];
            $sqname=get_user_name($invifriends[$i]);
            $invifriends[$i]['sqlname']=	 $sqname;

            //查询邀请好友的消费明细
            $accounts[$sqluid]=$mysql_model->GetList("select * from `@#_member_account` where `uid`='$sqluid'  ORDER BY `time` DESC");


            //判断哪个好友有消费
            if(empty($accounts[$sqluid])){
                $notinvolvednum +=1;
                $records[$sqluid]='未参与';
            }else{
                $involvednum +=1;
                $records[$sqluid]='已参与';
            }


        }
        include templates("mobile/invite","friends");
    }
    function commissions(){
        $webname=$this->_cfg['web_name'];
        $member=$this->userinfo;
        $title="我的会员中心";
        $memberdj=$this->db->GetList("select * from `@#_member_group`");
        $jingyan=$member['jingyan'];
        if(!empty($memberdj)){
            foreach($memberdj as $key=>$val){
                if($jingyan>=$val['jingyan_start'] && $jingyan<=$val['jingyan_end']){
                    $member['yungoudj']=$val['name'];
                }
            }
        }

        $mysql_model=System::load_sys_class('model');
        $member=$this->userinfo;
        $uid = $member['uid'];
        $recodetotal=0;   // 判断是否为空
        $shourutotal=0;
        $zhichutotal=0;

        $invifriends=$mysql_model->GetList("select * from `@#_member` where `yaoqing`='$member[uid]' ORDER BY `time` DESC");


        //查询佣金表
        for($i=0;$i<count($invifriends);$i++){
            $sqluid=$invifriends[$i]['uid'];

            //查询邀请好友给我反馈的佣金
            $recodes[$sqluid]=$mysql_model->GetList("select * from `@#_member_recodes` where `uid`='$sqluid' and `type`=1 ORDER BY `time` DESC");

            $user[$sqluid]['username']=	get_user_name($invifriends[$i]);

        }
        //自己提现或充值
        $recodes[$uid]=$mysql_model->GetList("select * from `@#_member_recodes` where `uid`='$uid' and `type`!=1 ORDER BY `time` DESC");
        $user[$uid]['username']= get_user_name($member);


        $recodearr='';
        $i=0;
        if(!empty($recodes)){
            foreach($recodes as $key=>$val){
                $username[$key]=$user[$key]['username'];
                foreach($val as $key2=>$val2){
                    $recodearr[$i]=$val2;
                    $i++;
                }
            }
        }

        $recodetotal=count($recodes);


        //查询   累计收入：元    累计(提现/充值)：元    佣金余额：元

        if(!empty($recodes)){
            foreach($recodes as $key=>$val){
                if($uid==$key){
                    foreach($val as $key2=>$val2){

                        $zhichutotal+=$val2['money'];	 //总佣金支出

                    }
                }else{
                    foreach($val as $key3=>$val3){

                        $shourutotal+=$val3['money'];	 //总佣金收入
                    }

                }
            }

        }


        $total=$shourutotal-$zhichutotal;  //计算佣金余额

        include templates("mobile/invite","commissions");
    }
    function cashout(){

        $webname=$this->_cfg['web_name'];
        $member=$this->userinfo;
        $title="我的会员中心";
        $memberdj=$this->db->GetList("select * from `@#_member_group`");
        $jingyan=$member['jingyan'];
        if(!empty($memberdj)){
            foreach($memberdj as $key=>$val){
                if($jingyan>=$val['jingyan_start'] && $jingyan<=$val['jingyan_end']){
                    $member['yungoudj']=$val['name'];
                }
            }
        }

        $mysql_model=System::load_sys_class('model');
        $member=$this->userinfo;
        $uid = $member['uid'];
        $total=0;
        $shourutotal=0;
        $zhichutotal=0;
        $cashoutdjtotal=0;
        $cashouthdtotal=0;
        //查询邀请好友id
        $invifriends=$mysql_model->GetList("select * from `@#_member` where `yaoqing`='$member[uid]' ORDER BY `time` DESC");

        //查询佣金收入
        for($i=0;$i<count($invifriends);$i++){
            $sqluid=$invifriends[$i]['uid'];
            //查询邀请好友给我反馈的佣金
            $recodes[$sqluid]=$mysql_model->GetList("select * from `@#_member_recodes` where `uid`='$sqluid' and `type`=1 ORDER BY `time` DESC");
        }

        //查询佣金消费(提现,充值)
        $zhichu=$mysql_model->GetList("select * from `@#_member_recodes` where `uid`='$uid' and `type`!=1 ORDER BY `time` DESC");

        //查询被冻结金额
        $cashoutdj=$mysql_model->GetOne("select SUM(money) as summoney  from `@#_member_cashout` where `uid`='$uid' and `auditstatus`!='1' ORDER BY `time` DESC");

        if(!empty($recodes)){
            foreach($recodes as $key=>$val){
                foreach($val as $key2=>$val2){
                    $shourutotal+=$val2['money'];	 //总佣金收入
                }
            }
        }
        if(!empty($zhichu)){
            foreach($zhichu as $key=>$val3){
                $zhichutotal+=$val3['money'];	//总支出的佣金
            }
        }


        $total=$shourutotal-$zhichutotal;  //计算佣金余额
        $cashoutdjtotal= $cashoutdj['summoney'];  //冻结佣金余额
        $cashouthdtotal= $total-$cashoutdj['summoney'];  //活动佣金余额


        if(isset($_POST['submit1'])){ //提现
            $money      = abs(intval($_POST['money']));
            $username   =htmlspecialchars($_POST['txtUserName']);
            $bankname   =htmlspecialchars($_POST['txtBankName']);
            $branch     =htmlspecialchars($_POST['txtSubBank']);
            $banknumber =htmlspecialchars($_POST['txtBankNo']);
            $linkphone  =htmlspecialchars($_POST['txtPhone']);
            $time       =time();
            $type       = -3;  //收取1/消费-1/充值-2/提现-3

            if($total<100){
                _message("佣金金额大于100元才能提现！");exit;
            }elseif($cashouthdtotal<$money){
                _message("输入额超出活动佣金金额！");exit;
            }elseif($total<$money ){
                _message("输入额超出总佣金金额！");exit;
            }else{

                //插入提现申请表  这里不用在佣金表中插入记录 等后台审核才插入
                $this->db->Query("INSERT INTO `@#_member_cashout`(`uid`,`money`,`username`,`bankname`,`branch`,`banknumber`,`linkphone`,`time`)VALUES
			('$uid','$money','$username','$bankname','$branch','$banknumber','$linkphone','$time')");
                _message("申请成功！请等待审核！",WEB_PATH.'/mobile/invite/cashout');
            }
        }

        if(isset($_POST['submit2'])){//充值
            $money      = abs(intval($_POST['txtCZMoney']));
            $type       = 1;
            $pay        ="佣金";
            $time       =time();
            $content    ="使用佣金充值到账户";

            if($money <= 0 || $money > $total){
                _message("佣金金额输入不正确！");exit;
            }
            if($cashouthdtotal<$money){
                _message("输入额超出活动佣金金额！");exit;
            }

            //插入记录
            $account=$this->db->Query("INSERT INTO `@#_member_account`(`uid`,`type`,`pay`,`content`,`money`,`time`)VALUES
			('$uid','$type','$pay','$content','$money','$time')");

            // 查询是否有该记录
            if($account){
                //修改剩余金额
                $leavemoney=$member['money']+$money;
                $mrecode=$this->db->Query("UPDATE `@#_member` SET `money`='$leavemoney' WHERE `uid`='$uid' ");
                //在佣金表中插入记录
                $recode=$this->db->Query("INSERT INTO `@#_member_recodes`(`uid`,`type`,`content`,`money`,`time`)VALUES
			('$uid','-2','$content','$money','$time')");

                _message("充值成功！",WEB_PATH.'/mobile/invite/cashout');
            }else{
                _message("充值失败！");
            }
        }

        include templates("mobile/invite","cashout");
    }
    function record(){
        $webname=$this->_cfg['web_name'];
        $member=$this->userinfo;
        $title="我的会员中心";
        $memberdj=$this->db->GetList("select * from `@#_member_group`");
        $jingyan=$member['jingyan'];
        if(!empty($memberdj)){
            foreach($memberdj as $key=>$val){
                if($jingyan>=$val['jingyan_start'] && $jingyan<=$val['jingyan_end']){
                    $member['yungoudj']=$val['name'];
                }
            }
        }

        $mysql_model=System::load_sys_class('model');
        $member=$this->userinfo;
        $uid = $member['uid'];
        $recount=0;
        $fufen = System::load_app_config("user_fufen",'','member');
        //查询提现记录
        //$recordarr=$mysql_model->GetList("select * from `@#_member_recodes` a left join `@#_member_cashout` b on a.cashoutid=b.id where a.`uid`='$uid' and a.`type`='-3' ORDER BY a.`time` DESC");		$recordarr=

        $recordarr=$mysql_model->GetList("select * from  `@#_member_cashout`  where `uid`='$uid' ORDER BY `time` DESC limit 0,30");

        if(!empty($recordarr)){
            $recount=1;
        }
        include templates("mobile/invite","record");
    }

	//云购记录
	public function userbuylist(){
	   $webname=$this->_cfg['web_name'];
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$uid = $member['uid'];
		$title="购买记录";					
		//$record=$mysql_model->GetList("select * from `@#_member_go_record` where `uid`='$uid' ORDER BY `time` DESC");				
		include templates("mobile/user","userbuylist");
	}
	//云购记录详细
	public function userbuydetail(){
	    $webname=$this->_cfg['web_name'];
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$title="购买详情";
		$crodid=intval($this->segment(4));
		$record=$mysql_model->GetOne("select * from `@#_member_go_record` where `id`='$crodid' and `uid`='$member[uid]' LIMIT 1");		
		if($crodid>0){
			include templates("member","userbuydetail");
		}else{
			echo _message("页面错误",WEB_PATH."/member/home/userbuylist",3);
		}
	}
	//获得的商品
	public function orderlist(){
	    $webname=$this->_cfg['web_name'];
		$member=$this->userinfo;
		$title="获得的商品";
		//$record=$this->db->GetList("select * from `@#_member_go_record` where `uid`='".$member['uid']."' and `huode`>'10000000' ORDER BY id DESC");				
		include templates("mobile/user","orderlist");
	}
	//账户管理
	public function userbalance(){
	    $webname=$this->_cfg['web_name'];
		$member=$this->userinfo;
		$title="账户记录";
		$account=$this->db->GetList("select * from `@#_member_account` where `uid`='$member[uid]' and `pay` = '账户' ORDER BY time DESC");
         $czsum=0;
         $xfsum=0;
		if(!empty($account)){ 
			foreach($account as $key=>$val){
			  if($val['type']==1){
				$czsum+=$val['money'];		  
			  }else{
				$xfsum+=$val['money'];		  
			  }		
			} 		
		}
		
		include templates("mobile/user","userbalance");
	}
	
	 
	public function userrecharge(){
	    $webname=$this->_cfg['web_name'];
		$member=$this->userinfo;
		$title="账户充值";
		//$paylist = $this->db->GetList("SELECT * FROM `@#_pay` where `pay_start` = '1'");
 	
		include templates("mobile/user","recharge");
	}	

	//晒单
	public function singlelist(){
		 $webname=$this->_cfg['web_name'];
		include templates("mobile/user","singlelist");
	}	

	 
}

?>