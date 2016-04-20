<?php 

class tocode {

	private $go_list;
	public $go_code;
	public $go_content;
	public $cyrs;
	public $shop;
	public $count_time='';
	
	
	public function __construct() {
		$this->db = System::load_sys_class("model");
	}	

	public function config($shop=null,$type=null){
		$this->shop = $shop;		
	}
	
	public function get_run_tocode(){
		
	}
	
	public function returns(){
	
	
	}
	
	
	public function run_tocode(&$time='',$num=100,$cyrs='233'){
		if(empty($time))return false;
		if(empty($num))return false;
		if(empty($cyrs))return false;
		$this->times = $time;
		$this->num = $num;
		$this->cyrs = $cyrs;
		$this->get_code_user_html();
		$this->get_user_go_code();
	}

	private function get_code_dabai(){
		$go_list = $this->go_list;
		$html=array();
		$count_time = 0;
		foreach($go_list as $key=>$v){
			$html[$key]['time'] = $v['time'];	
			$html[$key]['username'] = $v['username'];	
			$html[$key]['uid'] = $v['uid'];
			$html[$key]['shopid'] = $v['shopid'];	
			$html[$key]['shopname'] = $v['shopname'];	
			$html[$key]['shopqishu'] = $v['shopqishu'];
			$html[$key]['gonumber'] = $v['gonumber'];			
			$h=abs(date("H",$v['time']));
			$i=date("i",$v['time']);
			$s=date("s",$v['time']);	
			list($time,$ms) = explode(".",$v['time']);
			$time = $h.$i.$s.$ms;
			$html[$key]['time_add'] = $time;
			$count_time += $time;			
		}
		$this->go_content = serialize($html);
		$this->count_time=$count_time;
		$this->go_code = 10000001+fmod($count_time,$this->cyrs);			
	}
	
	private function get_code_yibai(){		
		$time = $this->times;
		$cyrs = $this->cyrs;		
		$h=abs(date("H",$time));
		$i=date("i",$time);
		$s=date("s",$time);		
		$w=substr($time,11,3);
		$num= $h.$i.$s.$w;
		if(!$cyrs)$cyrs=1;
		$this->go_code = 10000001+fmod($num*100,$cyrs);
		$this->go_content = false;
	}
	
	private function get_user_go_code(){
		
		if(file_exists(G_SYSTEM.'modules/goodspecify/lib/'.'itocode.class.php')):
			$itocode = System::load_app_class("itocode","goodspecify");
			$itocode->go_itocode($this->shop,$this->go_code,$this->go_content,$this->count_time);
		endif;
		$this->get_code_user_html();
	}
		
	private function get_code_user_html(){		
		$time = $this->times;
		$num  = $this->num;
		$this->go_list = $this->db->GetList("select * from `@#_member_go_record` where `time` < '$time' order by `id` DESC limit 0,$num");
		if($this->go_list  && count($this->go_list) >= $this->num){
			$this->get_code_dabai();
		}else{
			$this->get_code_yibai();
		}
	}
	
}