<?php 

defined('G_IN_SYSTEM')or exit("no");
class member extends SystemAction {
	
	public function __construct(){		
		$this->db=System::load_sys_class('model');
	}

	public function get_user_json(){
		$return_info = array();
		if(isset($_POST['value'])){
			$user_asc = $_POST['value'];
		}else{
			$return_info['error'] = -1;
			$return_info['text']  = "参数不正确";	
			echo json_encode($return_info);
			exit;
		}
		if(_checkemail($user_asc)){
			$info = $this->db->GetOne("select * from `@#_member` where `email` = '$user_asc' and `emailcode` = '1'");
		}elseif(_checkmobile($user_asc)){
			$info = $this->db->GetOne("select * from `@#_member` where `mobile` = '$user_asc' and `mobilecode` = '1'");
		}else{
			$info = $this->db->GetOne("select * from `@#_member` where `uid` = '$user_asc'");
		}
		if(!$info){
			$return_info['error'] = -1;
			$return_info['text']  = "参数不正确";			
		}else{
			$return_info['error'] = 1;
		}
		if($return_info['error'] == -1){
			echo json_encode($return_info);exit;
		}
		
		
		$return_info['error'] = 1;
		$return_info['text']  = $info;
		echo json_encode($return_info);
	}
}

?>