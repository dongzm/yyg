<?php

defined('G_IN_SYSTEM')or exit("no");
//AJAX
class checkform extends SystemAction {

	function init(){
		
	}
	
	//后台用户名验证
	public function musername(){
		if(isset($_POST['ajax'])){
			$usernamelen=15;
			$pusername=isset($_POST['username']) ? $_POST['username'] : '';
			$len=_strlen($pusername);
			if($len>$usernamelen || $len<=0){
				echo 'no';
			}else{
				echo 'yes';
			}
		}	
	}
	
	
	//邮箱格式验证
	public function email(){
		if(isset($_POST['ajax'])){
			$pemail=isset($_POST['email']) ? $_POST['email'] : '';
			if(_checkemail($pemail)){
				echo 'yes';
			}else{
				echo 'no';
			}
		}		
	}

	
}

?>