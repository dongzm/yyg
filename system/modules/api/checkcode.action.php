<?php

defined('G_IN_SYSTEM')or exit("no");
class checkcode extends SystemAction {

	public function image(){	
		$style = $this->segment(4);
		$cun_type = $this->segment(5);		
		if($cun_type == 'cookie' || $cun_type == 'session'){
			$cun_type = $this->segment(5);
		}else{
			$cun_type = 'cookie';
		}
		$style = explode("_",$style);		
		$width = isset($style[0]) ? intval($style[0]) : '';
		$height = isset($style[1]) ? intval($style[1]) : '';
		$color = isset($style[2]) ? $style[2] : '';
		$bgcolor = isset($style[3]) ? $style[3] : '';
		$lenght = isset($style[4]) ? intval($style[4]) : 6;
		$type = isset($style[5]) ? intval($style[5]) : 3;
		
		$checkcode=System::load_app_class("checkcodeimg");
		$checkcode->config($width,$height,$color,$bgcolor,$lenght,$type);
		if(isset($_GET['dian'])){
			$checkcode->dian(50,$color);
		}
		
		if($cun_type == 'cookie'){
			_setcookie("checkcode",md5($checkcode->code));
		}
		if($cun_type == 'session'){
			_session_start();
			$_SESSION['checkcode'] = md5($checkcode->code);		
		}
		$checkcode->image();
	}

}

?>