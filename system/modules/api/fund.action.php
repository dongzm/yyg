<?php 


class fund extends SystemAction {

	//ajax
	public function get(){
		$db = System::load_sys_class('model');
		$fund=$db->GetOne("select * from `@#_fund` where `id`='1'");
		if($fund && $fund['fund_off'] == 1){
			echo $fund['fund_count_money'];
		}else{
			echo 0.00;
		}
	}

}

?>