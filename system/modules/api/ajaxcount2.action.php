<?php

class ajaxcount2 extends SystemAction {

	//ajax
	public function buy_count(){
		$db = System::load_sys_class('model');
		$info = $db->GetOne("select sum(gonumber) as count from `@#_member_go_record`");
		if(empty($info)){
			echo json_encode(array("status"=>0,"count"=>12345));die;
		}
		echo json_encode(array("status"=>0,"count"=>$info['count']));die;
	}

}

?>