<?php



class ajaxcount extends SystemAction {



	//ajax

	public function buy_count(){

		$db = System::load_sys_class('model');

		$info = $db->GetOne("select sum(gonumber) as count from `@#_member_go_record`");

		$arr['state'] = 0;

		$arr['count'] = $info['count'] ? $info['count']+100000000 : 100000000;

		$arr['fundTotal'] = $info['count'] ? $info['count']/100 : '1000010.00';

		$fun = $this->segment(4);

		$fun = explode('=', $fun);

		$fun = $fun[1];

		$fun = explode('&', $fun);

		$fun = $fun[0];

		echo $fun.'('.json_encode($arr).')';die;

	}



}



?>