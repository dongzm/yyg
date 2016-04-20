<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_fun('global',G_ADMIN_DIR);

class auto_p extends SystemAction {
	private $db;
	private $categorys;
	private $pay;
	private $autodir = "auto";#模块文件名
	public function __construct(){	
		$this->db = System::load_sys_class("model");
		$this->categorys=$this->db->GetList("SELECT * FROM `@#_category` WHERE 1 order by `parentid` ASC,`cateid` ASC",array('key'=>'cateid'));		
		$this->pay = System::load_app_class("pay","pay");
	}
	#操作界面显示
	public function show(){
		$p = $this->segment(4);
		if($p == null ){
			$p = 1;
		}
		$num=20;
		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_shoplist` WHERE `q_uid` is null  order by `id` DESC"); 
		$page=System::load_sys_class('page');
		#if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,$num,1,"0");
		$shoplist=$this->db->GetPage("SELECT * FROM `@#_shoplist` WHERE `q_uid` is null  order by `id` DESC ",array("num"=>$num,"page"=>$p,"type"=>1,"cache"=>0));
		#获取配置文件信息
		$xml = $this->getxml();
		$times = $xml->times;//时间
		$endtimes = intval($xml->endtimes);
		$userid  = explode("-",$xml->userid);//用户ID段
		$shopid = $xml->shopid;//商品ID 以“-” 分割
		$shopidarray = explode("-",$shopid);
		$oo = $xml->oo;//开启或关闭状态
		$runtime = $xml->runtime;//运行时间
		$autoadd = $xml->autoadd;//是否自动进入下一期
		$mshop = $xml->mshop;//是否购买多个商品
		$timeperiod = $xml->timeperiod;//时间段
		$tp = explode("-",$timeperiod);
		//线程是否异常停止
		$isstop = -1;
		//页码
		if($p == 1){
			$o_p =1;
			$n_p = 2;
		}else{
			$o_p = $p-1;
			$n_p = $p+1;
		}
		/*----------判断线程是否死掉----------*/
		if($oo == "on" && ($runtime+$endtimes+30) < time() ){
			$isstop = 0;//已经停止
		}else{
			$isstop = 1;//还在运行
		}
		include $this->tpl($this->autodir,'auto_p');
	}
	//获取配置文件信息
	public function getxml(){
	   $xml = simplexml_load_file(G_APP_PATH.'system/modules/'.$this->autodir.'/auto_p.xml');
	   return $xml->children();
	}
	/**
	 *更新xml 配置文件信息
	 * $xml  array  
	**/
	public function updatexml($xml){
		$newxml = '<?xml version="1.0" encoding="utf-8"?>
<note>
<oo>'.$xml['oo'].'</oo>
<runtime>'.$xml['runtime'].'</runtime>
<times>'.$xml['times'].'</times>
<userid>'.$xml['userid'].'</userid>
<shopid>'.$xml['shopid'].'</shopid>
<autoadd>'.$xml['autoadd'].'</autoadd>
<endtimes>'.$xml['endtimes'].'</endtimes>
<mshop>'.$xml['mshop'].'</mshop>
<timeperiod>'.$xml['timeperiod'].'</timeperiod>
</note>';
		file_put_contents(G_APP_PATH.'system/modules/'.$this->autodir.'/auto_p.xml',$newxml);
	}
	//功能开启
	public function start($xmlarray){
		//获取配置文件信息
		$xml = $this->getxml();
		if($xml->oo =="on"){//开启状态  只更新配置文件
			$this->updatexml($xmlarray);
			echo "更新配置文件成功";
		}else {//非开启状态    
			$this->updatexml($xmlarray);
			$this ->xhaction();
		}
	}
	//功能关闭
	public function stop(){
		$xml = $this->getxml();
		$xmlarray = array("oo"=>"off","runtime"=>$xml->runtime,"times"=>$xml->times,"userid"=>$xml->userid,"shopid"=>$xml->shopid,"autoadd"=>$xml->autoadd,'endtimes'=>$xml->endtimes,"mshop"=>$xml->mshop,"timeperiod"=>$xml->timeperiod);
		$this->updatexml($xmlarray);
	}	
	//保存配置----并开起
	public function ajaxaction(){
		$neichun = memory_get_usage();
		file_put_contents("test.txt","开始内存：".$neichun."\r\n",FILE_APPEND);
		$m_shop_value = isset($_POST['m_shop_value'])?$_POST['m_shop_value']:-1;//随机购买多个商品
		$times = isset($_POST['times'])?intval($_POST['times']):-1;//最小间隔时间
		$endtimes = isset($_POST['endtimes'])?intval($_POST['endtimes']):-1;//最大间隔时间
		$f_userid = isset($_POST['f_userid'])?intval($_POST['f_userid']):-1;//用户段---开始IP  （包含此IP） 
		$l_userid = isset($_POST['l_userid'])?intval($_POST['l_userid']):-1;//用户段----结束IP （包含此IP） 
		$autoadd = isset($_POST['autoadd'])?intval($_POST['autoadd']):-1;//是否自动进入下一期
		$shopid = isset($_POST['shopid'])?$_POST['shopid']:-1;//商品ID群	
		$timeperiod = isset($_POST['timeperiod'])?$_POST['timeperiod']:0;
		if((!@eregi('^[0-9]*$',$times)) || $times <= 0 || $endtimes <=0 || $endtimes <= $times ){
			echo  '时间参数错误';
			return;
		} 
		if($f_userid <= 0 || $l_userid <= 0 ||  $l_userid <= $f_userid){
			echo "用户段参数错误";
			return;
		}
		if($shopid <= 0){
			echo "商品信息错误";
			return;
		}
		#------时间区间
		$tp = explode("-",$timeperiod);
		if(count($tp) != 0){
			foreach($tp as $k=>$v){
				if(intval($v)>23 && intval($v)<0){
					echo "时间区间错误";
					exit;
				}
			}
		}else{
			echo "时间区间错误";
			exit;
		}
		$userid = $f_userid.'-'.$l_userid;
		//更新配置文件xml
		$xml = $this->getxml();
		$xmlarray = array("oo"=>"on","runtime"=>$xml->runtime,"times"=>$times,"userid"=>$userid,"shopid"=>$shopid,"autoadd"=>$autoadd,"endtimes"=>$endtimes,"mshop"=>$m_shop_value,"timeperiod"=>$timeperiod);
		$this->start($xmlarray);
	}
	
	//购买商品
	public function buyshop($xml,$shopinfo,$member){
		//购买商品数量
		$shopnum = rand(-100,10);
		if($shopnum <= -40){
			$shopnum = 1;
		}else if($shopnum > -40 & $shopnum < 1){
			$shopnum = rand(1,3);
		}
		$shopidarray = explode("-",$xml->shopid);//配置文件商品ID    数组
		$user_id = $member['uid'];
		$shopid = $shopinfo['id'];
		$time = time();
		//判断商品是否购买完
		if($shopinfo['zongrenshu'] != $shopinfo['canyurenshu']){
			if((intval($shopinfo['yunjiage'])*$shopnum) > $member['money']){//商品价格大于用户金钱---给用户充值
				$m = intval($shopinfo['yunjiage'])*$shopnum;
				$this->db->Query(" UPDATE `@#_member` SET  `money` = '$m' WHERE `uid` = '$user_id' ");
			}
			//设置IP
			$_SERVER['HTTP_CLIENT_IP'] = $this->randip($member);
			//调用购买商品接口
			$this->pay->pay_user_go_shop($user_id,$shopid,$shopnum);
		}else{#如果已经购买完，就删除配置
			#implode(', ',$tags);
			$t = array();
			$x = -1;
			for($i = 0; $i<count($shopidarray);$i++){
				$x++;
				if($shopid != $shopidarray[$i]){
					$t[$x] = $shopidarray[$i];
				}
			}
			if(count($shopidarray) == 1){
				$xml->shopid = '';
			}else{
				$xml->shopid = implode('-',$t);
			}
			$autoadd = intval($xml->autoadd);
			#判断是否进入下一期数
			if($autoadd == 1 ){
				#需要进入下一期
				#添加下一期的商品ID值
				$shoptem  = $this->db->GetOne("SELECT * FROM `@#_shoplist` WHERE `id` = '$shopid'  LIMIT 1");
				$nextshopsid = $shoptem['sid'];
				
				$nextshopinfo  = $this->db->GetOne("SELECT * FROM `@#_shoplist` WHERE `sid` = '$nextshopsid' ORDER BY  `qishu` DESC LIMIT 1");
				if($nextshopinfo['qishu'] < $nextshopinfo['maxqishu']){
					if($xml->shopid == null || $xml->shopid == ""){
						$xml->shopid = $nextshopinfo['id'];
					}else{
						$xml->shopid = ($xml->shopid).'-'.$nextshopinfo['id'];
					}
				}
			}
		}
		$this->updatexml(array("oo"=>$xml->oo,"runtime"=>$time,"times"=>$xml->times,"userid"=>$xml->userid,"shopid"=>$xml->shopid,"autoadd"=>$xml->autoadd,'endtimes'=>$xml->endtimes,"mshop"=>$xml->mshop,"timeperiod"=>$xml->timeperiod));
	}
	#线程主体
	public function xcaction(){
		set_time_limit(0);
		ignore_user_abort(true);
		$xml = $this->getxml();
		if($xml->oo == "off"){exit;}
		$t = -1;
		$timeperiod = $xml->timeperiod;
		$timeperiod_arr = explode("-",$xml->timeperiod);
		$tp_tmp = -1;
		#时间判断
		foreach($timeperiod_arr as $k=>$v){
			if(intval($v) == date("G")){
				$tp_tmp = 1;
				break;
			}
		}
		$times = intval($xml->times);#最小间隔时间
		$endtimes =  intval($xml->endtimes);#最大间隔时间
		if($tp_tmp == 1){
			#生成一个用户  $user_id
			$useridarray = explode("-",$xml->userid);#用户ID段   数组  只有0  和1 下标
			$user_id = rand(intval($useridarray[0]),intval($useridarray[1]));
			//$user_id = $this->getuser();
			#查询用户是否是批量注册的用户
			$member = $this->db->GetOne("SELECT * FROM `@#_member` WHERE `uid` = '$user_id' and `auto_user` = '1' LIMIT 1");
			if(is_array($member)){
				#是否购买多个商品
				$mshop = intval($xml->mshop);
				if($mshop == 1){
					#是购买多个商品
					#生成商品ID数组
					$shopid = $this->getshopid($xml);
					for($i=0;$i<count($shopid);$i++){
						$id = $shopid[$i];
						#查询商品信息
						$shopinfo = $this->db->GetOne("SELECT * FROM `@#_shoplist` WHERE `id` = '$id' LIMIT 1");
						$this->buyshop($xml,$shopinfo,$member);
					}
				}else{
					$shopid = $this->getshopid($xml,0);
					$id = $shopid[0];
					$shopinfo = $this->db->GetOne("SELECT * FROM `@#_shoplist` WHERE `id` = '$id' LIMIT 1");
					$this->buyshop($xml,$shopinfo,$member);
				}
			}else{
				$t = 1;
			}
		}else{
			$t = 1;
		}
		if($t == 1){
			$this->updatexml(array("oo"=>$xml->oo,"runtime"=>time(),"times"=>$xml->times,"userid"=>$xml->userid,"shopid"=>$xml->shopid,"autoadd"=>$xml->autoadd,'endtimes'=>$xml->endtimes,"mshop"=>$xml->mshop,"timeperiod"=>$xml->timeperiod));
		}
	}
	/*
		获取商品id
		返回商品id一维数组
	*/	
	public function getshopid($xml,$mshop=1){
		$shopidarray = explode("-",$xml->shopid);#配置文件商品ID    数组
		$shopid = array();
		#生成商品ID数组
		#随机生成购买商品个数  多少个不同商品
		$shopnum = rand(-100,count($shopidarray));
		
		if($mshop == 0){
			$shopnum = 1;
		}else{
			if(count($shopidarray) >50){
				if($shopnum <= -60){
					$shopnum = 1;
				}else if($shopnum > -60 & $shopnum <= -20){
						$shopnum = rand(1,2);
				}else if($shopnum < 1 & $shopnum > -20){
					$shopnum = rand(2,3);
				}
			}else{
				if($shopnum <= -40){
					$shopnum = 1;
				}else {
					$shopnum =rand(1,count($shopidarray)); 
				}
			}
		}
		$x = 0;
		while($x < $shopnum){
			$t = $shopidarray[rand(0,count($shopidarray)-1)];
			if($x == 0){
				$shopid[$x] = $t;
				$x++;
			}else{
				$z = -1;
				for($y=0;$y<count($shopid);$y++){
					if($t == $shopid[$y]){
						$z = 1;
					}
				}
				if($z != 1){
					$shopid[$x] = $t;
					$x++;
				}
			}
		}
		return $shopid;
	}
	#程序异常时重启
	public function  errorrestart(){
		$xml = $this->getxml();
		$this->updatexml(array("oo"=>"off","runtime"=>$xml->runtime,"times"=>$xml->times,"userid"=>$xml->userid,"shopid"=>$xml->shopid,"autoadd"=>$xml->autoadd,'endtimes'=>$xml->endtimes,'mshop'=>$xml->mshop,"timeperiod"=>$xml->timeperiod));
		$this->start(array("oo"=>"on","runtime"=>$xml->runtime,"times"=>$xml->times,"userid"=>$xml->userid,"shopid"=>$xml->shopid,"autoadd"=>$xml->autoadd,'endtimes'=>$xml->endtimes,'mshop'=>$xml->mshop,"timeperiod"=>$xml->timeperiod));
	}
	
	#随机生成IP 中国区
	public function randip($member){
		if($member['user_ip']){
			$ip = explode(',',$member['user_ip']); 
			return $ip[1];
		}else{
			$ip_1 = -1;
			$ip_2 = -1;
			$ip_3 = rand(0,255);
			$ip_4 = rand(0,255);
			$ipall = array(
							array(array(58,14),array(58,25)),
							array(array(58,30),array(58,63)),
							array(array(58,66),array(58,67)),
							array(array(60,200),array(60,204)),
							array(array(60,160),array(60,191)),
							array(array(60,208),array(60,223)),
							array(array(117,48),array(117,51)),
							array(array(117,57),array(117,57)),
							array(array(121,8),array(121,29)),
							array(array(121,192),array(121,199)),
							array(array(123,144),array(123,149)),
							array(array(124,112),array(124,119)),
							array(array(125,64),array(125,98)),
							array(array(222,128),array(222,143)),
							array(array(222,160),array(222,163)),
							array(array(220,248),array(220,252)),
							array(array(211,163),array(211,163)),
							array(array(210,21),array(210,22)),
							array(array(125,32),array(125,47))		
			);
			$ip_p = rand(0,count($ipall)-1);#随机生成需要IP段
			$ip_1 = $ipall[$ip_p][0][0];
			if($ipall[$ip_p][0][1] == $ipall[$ip_p][1][1]){
				$ip_2 = $ipall[$ip_p][0][1];
			}else{
				$ip_2 = rand(intval($ipall[$ip_p][0][1]),intval($ipall[$ip_p][1][1]));
			}
			return $ip_1.'.'.$ip_2.'.'.$ip_3.'.'.$ip_4;
		}
	
	}
	public function xhaction(){
		ignore_user_abort(true);
		set_time_limit(0);
		#设定从新开起
		while(true){
			#获取配置文件信息判断是否退出
			#判断此时段是否购买
			$xml = $this->getxml();
			if($xml->oo == "off"){exit;}
			#是否购买了
			$t = -1;
			$timeperiod = $xml->timeperiod;
			$timeperiod_arr = explode("-",$xml->timeperiod);
			$tp_tmp = -1;
			foreach($timeperiod_arr as $k=>$v){
				if(intval($v) == date("G")){
					$tp_tmp = 1;
					break;
				}
			}
			#最小间隔时间
			$times = intval($xml->times);
			#最大间隔时间
			$endtimes =  intval($xml->endtimes);
			if($tp_tmp == 1){
				#调用购买
				$this->g_triggerRequest(WEB_PATH.'/'.$this->autodir.'/auto_p/xcaction');
			}else{#此时段不购买
				$t = 1;
			}
			#不购买时只更新配置文件的时间
			if($t == 1){
				$this->updatexml(array("oo"=>$xml->oo,"runtime"=>time(),"times"=>$xml->times,"userid"=>$xml->userid,"shopid"=>$xml->shopid,"autoadd"=>$xml->autoadd,'endtimes'=>$xml->endtimes,"mshop"=>$xml->mshop,"timeperiod"=>$xml->timeperiod));
			}
			#休眠时间
			sleep(rand($times,$endtimes));
		}
	}
	/* 网络操作函数 */
	public function g_triggerRequest($url,$io=false,$post_data = array(), $cookie = array()){
		$method = empty($post_data) ? 'GET' : 'POST';
        $url_array = parse_url($url);		
        $port = isset($url_array['port'])? $url_array['port'] : 80; 
		if(function_exists('fsockopen')){
			$fp = @fsockopen($url_array['host'], $port, $errno, $errstr, 30);
		}elseif(function_exists('pfsockopen')){
			$fp = @pfsockopen($url_array['host'], $port, $errno, $errstr, 30);
		}elseif(function_exists('stream_socket_client')){
			$fp = @stream_socket_client($url_array['host'].':'.$port,$errno,$errstr,30);
		} else {
			$fp = false;
		}
        if(!$fp){
             return false;
        }
        $getPath = $url_array['path'] ."?". $url_array['query'];
		
        $header  = $method . " " . $getPath." ";
        $header .= "HTTP/1.1\r\n";
        $header .= "Host: ".$url_array['host']."\r\n"; #HTTP 1.1 Host域不能省略
		$header .= "Pragma: no-cache\r\n";
		
        /*
			//以下头信息域可以省略
			$header .= "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13 \r\n";
			$header .= "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,q=0.5 \r\n";
			$header .= "Accept-Language: en-us,en;q=0.5 ";
			$header .= "Accept-Encoding: gzip,deflate\r\n";
        */	
        if(!empty($cookie)){
                $_cookie_s = strval(NULL);
                foreach($cookie as $k => $v){
                        $_cookie_s .= $k."=".$v."; ";
                }
				$_cookie_s = rtrim($_cookie_s,"; ");
                $cookie_str =  "Cookie: " . base64_encode($_cookie_s) ." \r\n";	#传递Cookie
                $header .= $cookie_str;
        }
		$post_str = '';
         if(!empty($post_data)){
                $_post = strval(NULL);
                foreach($post_data as $k => $v){
                        $_post .= $k."=".urlencode($v)."&";
                }
				$_post = rtrim($_post,"&");
                $header .= "Content-Type: application/x-www-form-urlencoded\r\n";#POST数据
                $header .= "Content-Length: ". strlen($_post) ." \r\n";#POST数据的长度	
				
                $post_str = $_post."\r\n"; #传递POST数据
        }
		$header .= "Connection: Close\r\n\r\n";
		$header .= $post_str;
		
        fwrite($fp,$header);
		if($io){		
			 while (!feof($fp)){ 
                   echo fgets($fp,1024);
			 }
		}   
        fclose($fp);
		#echo $header;
        return true;
	}
	
	public function getuser(){
			$xml = $this->getxml();
			$useridarray = explode("-",$xml->userid);
			$s = intval($useridarray[0]);
			$n = intval($useridarray[1]);
			$a = $n-$s;
			$member = $this->db->GetList("SELECT `uid` FROM `@#_member` WHERE  `auto_user` = '1' LIMIT $s,$a");
			#生成购买用户
			$uid = rand(0,count($member));
			return $member[$uid]['uid'];
	}
	
}
?>