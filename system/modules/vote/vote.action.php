<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_fun('user','go');
System::load_sys_fun('user');
class vote extends SystemAction{
    
	private $userid;
	public function __construct() {	
			$this->userid=intval(_encrypt(_getcookie("uid"),'DECODE'));
	}	
	
	public function init(){
		$mysql_model=System::load_sys_class('model');
		$title="投票";
		$curtime=time();
		$vote_subjects=$mysql_model->GetList("select * from `@#_vote_subject` where `vote_enabled`=1 and vote_endtime>=$curtime");
      
		for($i=0;$i<count($vote_subjects);$i++){
          $vote_option[$vote_subjects[$i]['vote_id']]=$mysql_model->GetList("select * from `@#_vote_option` where  `vote_id`=".$vote_subjects[$i]['vote_id']);
		}
		include templates("vote","vote");	
	}



	public function show_option(){
	      
		 $vote_id=abs(intval($this->segment(4)));
		 $mysql_model=System::load_sys_class('model');
		 $title="投票";
		 $vote_options=$mysql_model->GetList("select * from `@#_vote_option` where `vote_id`=".$vote_id);	
		 $vote_subjects=$mysql_model->GetOne("select `vote_title` from `@#_vote_subject` where `vote_id`=".$vote_id);	
		 $vote_title=$vote_subjects['vote_title'];
         		 
		 
		 //查看统计
		   $total=0;
			for($i=0;$i<count($vote_options);$i++){
			   $total+=$vote_options[$i]['option_number'];
			
			}		
			
			 for($i=0;$i<count($vote_options);$i++){
				 if($total!=0){
				   $vote_number_total[$vote_options[$i]['option_id']]=round(($vote_options[$i]['option_number']/$total)*100,2);
				 }else{
				   $vote_number_total[$vote_options[$i]['option_id']]=0;
				 
				 }
			 }
		 
		include templates("vote","show");
	
	
	}

	public function checked_option(){
			  
		 $mysql_model=System::load_sys_class('model');
		 $title="投票";	 
	     $curtime=time();
		 $option_id=abs(intval($_POST['radio'])); 
		 $vote_id= abs(intval($_POST['vote_id']));
		 $clientip=_get_ip();
		 $sqlallowguest='';
		 $sqlinterval=0;		  
		 
		//查询投票项的规则和规定时间
		 $vote_subjects=$mysql_model->GetOne("select * from `@#_vote_subject` where `vote_id`='$vote_id'");         
		 $sqlallowguest=$vote_subjects['vote_allowguest'];//1允许游客投票 0不允许游客投票
		 $sqlinterval=$vote_subjects['vote_interval'];  //N天后可再次投票，0 表示此IP地址只能投一次
		 if(1==$sqlallowguest){//判断是否允许游客投票		 		      		 
			  $vote_activer=$mysql_model->GetOne("select * from `@#_vote_activer` where `vote_id`='$vote_id' and `ip`='$clientip' order by subtime desc"); 
			 if(!empty($vote_activer)){//判断该ip用户已经投过票			    
				 //上次投票间隔天数
			       $datenum=($curtime-$vote_activer['subtime'])/(60*60*24);				
			    if($sqlinterval==0 || $datenum<=$sqlinterval){ //0 表示此IP地址只能投一次
				   _message("您已参加此次投票活动",null,3);
				}else{			
					 //查出新增加的票数		 
					$vote_option=$mysql_model->GetList("select * from `@#_vote_option` where  `option_id`='$option_id' ");					  
					$option_number=$vote_option[0]['option_number']+1;					  

					 $mysql_model->Query("UPDATE `@#_vote_option` SET option_number='$option_number' where `vote_id`='$vote_id' and `option_id`='$option_id' ");
					 
		 
			        $mysql_model->Query("INSERT INTO `@#_vote_activer`(option_id,vote_id,userid,ip,subtime) VALUES('$option_id','$vote_id','$this->userid','$clientip','$curtime') ");
			     _message("投票成功，感谢您的参与",null,3); 
				}		       
			}else{			 
				 //查出新增加的票数		 
				$vote_option=$mysql_model->GetList("select * from `@#_vote_option` where  `option_id`='$option_id' ");	
				  
				  $option_number=$vote_option[0]['option_number']+1;					  

				 $mysql_model->Query("UPDATE `@#_vote_option` SET option_number='$option_number' where `vote_id`='$vote_id' and `option_id`='$option_id' ");
					 
					 
			    $mysql_model->Query("INSERT INTO `@#_vote_activer`(option_id,vote_id,userid,ip,subtime) VALUES('$option_id','$vote_id','$this->userid','$clientip','$curtime') ");
			     _message("投票成功，感谢您的参与",null,3); 
			 }
			 
		 
		 }else{	    
			 if($this->userid==''){
			    _message("您没有投票权限，请登录后投票！",null,3); 
				exit();
			 }
			 $vote_activer=$mysql_model->GetOne("select * from `@#_vote_activer` where `vote_id`='$vote_id' and `userid`='$this->userid'");
			 if(!empty($vote_activer)){//判断该用户已经投过票
			    
				 //上次投票间隔天数
			       $datenum=($curtime-$vote_activer['subtime'])/(60*60*24);
				  
				
			    if($sqlinterval==0 || $datenum<=$sqlinterval){ //0 表示此IP地址只能投一次
				   _message("您已参加此次投票活动",null,3);
				}else{
				//查出新增加的票数		 
				$vote_option=$mysql_model->GetList("select * from `@#_vote_option` where  `option_id`='$option_id' ");	
				  
				  $option_number=$vote_option[0]['option_number']+1;					  

				 $mysql_model->Query("UPDATE `@#_vote_option` SET option_number='$option_number' where `vote_id`='$vote_id' and `option_id`='$option_id' ");
				 
			     $mysql_model->Query("INSERT INTO `@#_vote_activer`(option_id,vote_id,userid,ip,subtime) VALUES('$option_id','$vote_id','$this->userid','$clientip','$curtime') ");
			     _message("投票成功，感谢您的参与",null,3); 
				}
			       
			 }else{
			 	 //查出新增加的票数		 
				$vote_option=$mysql_model->GetList("select * from `@#_vote_option` where  `option_id`='$option_id' ");	
				  
				  $option_number=$vote_option[0]['option_number']+1;					  

				 $mysql_model->Query("UPDATE `@#_vote_option` SET option_number='$option_number' where `vote_id`='$vote_id' and `option_id`='$option_id' ");
				 
			    $mysql_model->Query("INSERT INTO `@#_vote_activer`(option_id,vote_id,userid,ip,subtime) VALUES('$option_id','$vote_id','$this->userid','$clientip','$curtime') ");
			     _message("投票成功，感谢您的参与",null,3); 
			 }
		 }        

		}

       public function show_total(){

	     $mysql_model=System::load_sys_class('model');
		 $title="投票";  
		 $vote_id=abs(intval($this->segment(4)));
		 if(!$vote_id){
			_message("参数错误!");
		 }
         //调用票数统计页面
        $vote_options=$mysql_model->GetList("select * from `@#_vote_option` where `vote_id`='$vote_id' ");	
		$total=0;
		for($i=0;$i<count($vote_options);$i++){
			  $total+=$vote_options[$i]['option_number'];
			
		}
		for($i=0;$i<count($vote_options);$i++){
				 if($total!=0){
				   $vote_number_total[$vote_options[$i]['option_id']]=round(($vote_options[$i]['option_number']/$total)*100,2);
				 }else{
				   $vote_number_total[$vote_options[$i]['option_id']]=0;
				 
				 }
		}		 
		include templates("vote","show_total"); 
 
 
 }

}

?>