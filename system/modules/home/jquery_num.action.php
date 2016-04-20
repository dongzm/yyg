<?php
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_fun('global',G_ADMIN_DIR);
	
class jquery_num{
	public function init(){
    $this->db=System::load_sys_class('model');
	
		#获取全站点赞次数&已购买人次  
		//$go_hits = $this->db->GetOne("select sum(hits) as hits from `@#_praise`");
		$go_count_renci = $this->db->GetOne("select value from `@#_caches` where `key` = 'goods_count_num'");
		//$go_count_renci
		$go_num = array("n"=>$go_count_renci['value']);
		echo $go_num=json_encode($go_num);		
	}
}
 ?>