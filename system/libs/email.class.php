<?php

//发送邮件类

class email {

	static private $mail;
	static private $config;
	//配置邮件参数
	static public function config($config=array()){
		if(!is_array($config)){return false;}	
		self::$config=$config;
		self::$mail=System::load_sys_class("phpmailer");
		
		self::$mail->IsSMTP();                 		      // 启用SMTP
		self::$mail->Host = $config['stmp_host'];           //SMTP服务器
		self::$mail->SMTPAuth = true;                  	  //开启SMTP认证
		self::$mail->Username =$config['user'];            // SMTP用户名
		self::$mail->Password = $config['pass'];            // SMTP密码

		self::$mail->From = $config['from'];            	//发件人地址
		self::$mail->FromName = $config['fromName'];          //发件人
	
		self::$mail->AddReplyTo($config['from'], $config['fromName']);    //回复地址
		self::$mail->WordWrap = 50; 					  //设置每行字符长度 
	
	}
	

	
	//添加收件人
	//$userpath 邮件地址 可以是二维数组
	//$username 收件人名
	static public function adduser($userpath,$username=''){
		//$user 是二维数组
		if(!is_array($userpath)){
			self::$mail->AddAddress($userpath,$username); //添加收件人		
		}else{		
			$len=count($userpath);
			foreach($userpath as $v){
				self::$mail->AddAddress($v['email'], $v['name']); //添加收件人
			}
		}	
	}

	//添加附件
	static public function addfile($filepath,$filename=''){
		
		if(empty($filename)){
			self::$mail->AddAttachment($filepath);        // 添加附件
		}else{
			self::$mail->AddAttachment($filepath,$filename);   // 添加附件,并指定名称
		}
		
	}
	//发送邮件
	//$title   邮件标题
	//$content 邮件内容
	//$type    是否用HTML格式
	//$nohtml  不支持HTML格式显示的内容
	static public function send($title='',$content='',$type=true,$nohtml=''){
	
			
			self::$mail->IsHTML($type);    				// 是否HTML格式邮件
			self::$mail->CharSet = self::$config['big'];// 这里指定字符集！
			self::$mail->Encoding = "base64";
			
			self::$mail->Subject = $title;       //邮件主题
			self::$mail->Body = $content;        //邮件内容
			
			if(empty($nohtml)){
				$nohtml=self::$config['nohtml'];
			}			
			self::$mail->AltBody = $nohtml; //邮件正文不支持HTML的备用显示

			
			if(!self::$mail->Send())
			{
			 return false;
			//self::$mail->ErrorInfo;
			}else{
				return true;
			}
	}
}


?>
