<?php

function gopay($member,$shopu,$shoprc,$shopid){
	if(!$shopu){
		_message("页面错误",WEB_PATH,3);
		exit;
	}
	$mysql_model=System::load_sys_class('model');		
	$uid=$member['uid'];
	//echo "<pre>";
	//print_r($member);
	//echo "</pre>";
	//exit;
	$username=$member['email'];
	// if($member['username']==null){
		// $username=$member['email'];
	// }elseif($member['email']==null){
		// $username=$member['mobile'];
	// }else{
		// $username=$member['username'];
	// }
	$shoprc=explode(",",$shoprc);
	$shopid=explode(",",$shopid);
	$countid=count($shopid);
	//echo $countid;exit;
	if($member['money']>=$shopu){
		$money=$member['money']-$shopu;
		for($i=1;$i<$countid;$i++){
			$goucode="";
			$code="";
			$shoptitle=$mysql_model->GetOne("select * from `@#_shoplist` where `id`='".$shopid[$i]."'");
			$recordx=$mysql_model->GetList("select * from `@#_member_go_record` where `shopid`='".$shopid[$i]."' and `shopqishu`='".$shoptitle['qishu']."'");								
			$recordxuid=$mysql_model->GetOne("select * from `@#_member_go_record` where `shopid`='".$shopid[$i]."' and `shopqishu`='".$shoptitle['qishu']."' and `uid`='".$uid."'");								
			foreach($recordx as $recordx2){
				$code.=$recordx2['goucode'];
			}
			$shopname=$shoptitle['title'];
			$shopqishu=$shoptitle['qishu'];
			$time=microtime();
			$syurc=$shoptitle['zongrenshu'];
			if($recordx){			
				$codes=explode(",",$code);
				$imp=implode(",",$codes).",";
				$arr=array();
				while(count($arr)<$shoprc[$i]){
					$rand=10000000+rand(1,$syurc);
					$str=strpos($imp,$rand);
					if($str<0 or $codes[0]!=$rand){
						if(!in_array($rand,$arr)){
							$arr[]=$rand;
						}
					}
				}
				for($n=0;$n<count($arr);$n++){
				  $goucode.=$arr[$n].",";
				}				
				//echo $recordxuid['uid']."???".$uid."<br>";						
				//echo $uid."<br>";
				$tjia=$recordxuid['goucode'].$goucode;
				//if($recordxuid){						
				//	$mysql_model->Query("UPDATE `@#_member_go_record` SET goucode='".$tjia."',time='".$time."' where shopid='".$shopid[$i]."'");
				//}else{
					$mysql_model->Query("INSERT INTO `@#_member_go_record`(`uid`,`username`,`shopid`,`shopname`,`shopqishu`,`goucode`,`time`)VALUES('$uid','$username','$shopid[$i]','$shopname','$shopqishu','$goucode','$time')");
				//}
			}else{
				$ma=array();
				while(count($ma)<$shoprc[$i]){
					$su=rand(1,$syurc)-1;
					if(!in_array($su,$ma)){
						$ma[]=$su;
					}
				}
				for($c=0;$c<count($ma);$c++){
					$goucode.=10000000+$ma[$c].","; 						
				}
				$mysql_model->Query("INSERT INTO `@#_member_go_record`(`uid`,`username`,`shopid`,`shopname`,`shopqishu`,`goucode`,`time`)VALUES('$uid','$username','$shopid[$i]','$shopname','$shopqishu','$goucode','$time')");
			}
			$canyurenshu=$shoptitle['canyurenshu']+$shoprc[$i];
			//$mysql_model->Query("UPDATE `@#_shoplist` SET canyurenshu='".$canyurenshu."' where id='".$shopid[$i]."'");
			if($shoptitle['zongrenshu']==$canyurenshu){
				//$mysql_model->Query("INSERT INTO `@#_shopqishu`(`shopid`,`shopqishu`,`shoptitle`,`goucode`,`time`)VALUES
//('$shopid[$i]','$shopqishu','$shopname','$goucode','$time')");
				//$time=microtime();
				//$time="0.51658000 1374227375";
				$num=$shoptitle['zongrenshu'];
				if(isset($num)){
					tencord($time,$num);
				}
				
			}
		}
		//$mysql_model->Query("UPDATE `@#_member` SET money='".$money."' where uid='".$member['uid']."'");
		//_setcookie("CODE","",time()-3600);
		//_setcookie("NUM","",time()-3600);
		
		//echo _message("支付成功",WEB_PATH.'home/index/cartlist3',3);			
	}else{
		echo _message("余额不足",WEB_PATH.'home/member/userrecharge',3);
	}	
} 
function tencord($time,$num){
	$mysql_model=System::load_sys_class('model');
	$record=$mysql_model->GetOne("select * from `@#_member_go_record` where `time`='".$time."'");
	$recordm=$mysql_model->GetList("select * from `@#_member_go_record` where `id`<='".$record['id']."' limit 4");
	//$record=$mysql_model->GetOne("select * from `@#_member_go_record` where `time`='".$time."'");
	//$recordm=$mysql_model->GetList("select * from `@#_member_go_record` ");
	$s=0;
	echo $time;
	foreach($recordm as $record){
		$list=explode(" ",$record['time']);
		$dat=date("His",$list[1]).substr($list[0],2,2);
		
		//$s=$s+$dat;
		echo $dat."<br>";
		echo date("Y:m:d H:i:s",$list[1]).substr($list[0],2,2)."<br>";
	}
	//echo 10000000+$s;
	//echo 10000000+$s%$num;
	
}
?>