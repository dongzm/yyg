<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_fun('user');
System::load_sys_fun('user');
class databuyrecord extends SystemAction {
	
	//云购历史记录
	public function buyrecord(){	
			
		$this_time_h =  date("H");
		$this_time_i =  date("i");
		$this->db = System::load_sys_class("model");
		if(isset($_POST['dosubmit'])){
			$start_time = $_POST['start_time_data'].' '.$_POST['start_time_h'].':'.$_POST['start_time_i'].':00';
			$end_time   = $_POST['end_time_data'].' '.$_POST['end_time_h'].':'.$_POST['end_time_i'].':00';
			
			$start_time = strtotime($start_time);		
			$end_time = strtotime($end_time);		

			if(strlen($start_time)!=10 && strlen($end_time)!=10){
				_message("参数不正确!");
			}
			if($end_time < $start_time){
				_message("对不起！查询开始时间不得大于结束时间");
			}			
			if(($end_time - 7200) > $start_time){
				_message("对不起！查询时间跨度不得超过2小时");
			}
			$start_time.='.000';
			$end_time  .='.000';			
			$RecordList = $this->db->GetList("select username,uid,shopid,shopname,shopqishu,gonumber,time from `@#_member_go_record` where `time` > '$start_time' and `time` < '$end_time' limit 0,20");
		}else{		
			$time = time();
			$start_time = ($time-7200).'.000';
			$end_time = $time.'.000';
			$RecordList = $this->db->GetList("select username,uid,shopid,shopname,shopqishu,gonumber,time from `@#_member_go_record` where `time` > '$start_time' and `time` < '$end_time' limit 0,20");
		}
				
		include templates("index","buyrecord");
	}
	
	public function buyrecordbai(){
		$this->db = System::load_sys_class("model");
		$res=$this->db->GetOne("select sum(gonumber) gonumber from `@#_member_go_record`");
		$this->db->query("update `@#_caches` set value='$res[gonumber]' where `key`='goods_count_num'");
		$RecordList = $this->db->GetList("select username,uid,shopid,shopname,shopqishu,gonumber,time from `@#_member_go_record` where 1 order by id desc limit 0,100");
		include templates("index","buyrecordbai");
	
	}
	
}

?>