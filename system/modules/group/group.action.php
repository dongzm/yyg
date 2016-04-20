<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');

System::load_app_class('base','member','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');


class group extends base {
	public function __construct() {	
			parent::__construct();
			$this->db = system::load_sys_class("model");
	}	
	
	/*会员是否加入该圈子*/
	private function user_add_group($qzid=0){
		if(!$this->userinfo)return false;		
		$addids = trim($this->userinfo['addgroup'],",").',';		
		if(strpos($addids,$qzid.',') === false){				
			return false;
		}
		return true;
	}
	
	public function init() {
		$member=$this->userinfo;		
		$title='圈子列表_'._cfg("web_name");	
		$quanzi=$this->db->GetList("select * from `@#_quanzi`");
		$tiezi=$this->db->GetList("select * from `@#_quanzi_tiezi` LIMIT 5");
		include templates("group","index");
	}
	public function show() {
		$id=abs(intval($this->segment(4)));
		if(!$id){
			_message("还没有建立改圈子");
		}
		$quanzi=$this->db->GetOne("select * from `@#_quanzi` where `id` = '$id'");		
		if(!$quanzi){
			_message("还没有建立改圈子");
		}
		$title=$quanzi['title']."_"._cfg("web_name");
		$keywords = $quanzi['jianjie'];
		$description = $quanzi['gongao'];
		
		$uid = $this->userinfo['uid'];	

		/*是否加入圈子*/
		  if(!$this->user_add_group($id)){				
			$addgroup = false;
		}else{
			$addgroup = true;
		}		
		/*是否加入圈子*/
			
		$num=10;
		$total=$this->db->GetCount("select * from `@#_quanzi_tiezi` WHERE qzid='$id'"); 
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){
			$pagenum=$_GET['p'];
		}else{$pagenum=1;}		
		$page->config($total,$num,$pagenum,"0"); 
		if($pagenum>$page->page){
			$pagenum=$page->page;
		}	
		$qz=$this->db->GetPage("select * from `@#_quanzi_tiezi` WHERE qzid='$id' and `tiezi`='0' and `shenhe` = 'Y' order by zhiding DESC,id DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));		
		
		include templates("group","list");
	}
	
	/*加入圈子与退出*/
	public function goqz(){
	
		$uid = $this->userinfo['uid'];
		if(!$uid)exit;
		$qzid=intval($_POST['id']);		
		$text=$_POST['text'];
		
		$chengyuan=$this->db->GetOne("select * from `@#_quanzi` where `id` = '$qzid'");
		if(!$chengyuan)return;
		
		if($text=="退出"){
		    if(!$this->user_add_group($qzid)){				
				return;
			}
			$iqroup = str_ireplace($qzid.",","",$this->userinfo['addgroup']);
			$cy = $chengyuan['chengyuan']-1;	
				
		}else{		
			if($this->user_add_group($qzid)){				
				return;
			}
			$iqroup = $this->userinfo['addgroup'].$qzid.',';
			$cy = $chengyuan['chengyuan']+1;
		}
				
		$this->db->Query("UPDATE `@#_member` SET `addgroup`='$iqroup' where `uid`='$uid'");
		$this->db->Query("UPDATE `@#_quanzi` SET `chengyuan`='$cy' where `id`='$qzid'");
	}
	
	/*发表圈子帖子*/
	public function showinsert(){	
		if(!$this->userinfo)_message("未登录",WEB_PATH);		
		if(isset($_POST['submit'])){		
			$uid = $this->userinfo['uid'];
			$title = htmlspecialchars($_POST['title']);
			$neirong=$_POST['neirong'];
			$qzid=intval($_POST['qzid']);	
			
			/*是否加入圈子*/				
		    if(!$this->user_add_group($qzid)){				
				_message("您还未加入该圈子");
			}		
			/*是否加入圈子*/
						
			/*验证码*/			
			$group_syzm = _getcookie("checkcode");			
			$group_pyzm = isset($_POST['group_code']) ? strtoupper($_POST['group_code']) : '';			
			if(empty($group_pyzm)){
				_message("请输入验证码");
			}
			if($group_syzm != md5($group_pyzm)){
				_message("验证码不正确");
			}
			/*验证码*/
											
		
			$quanzi = $this->db->GetOne("select * from `@#_quanzi` where `id` = '$qzid' LIMIT 1");
			if(!$quanzi)_message("该圈子不存在");
			
			
			if($quanzi['glfatie'] == 'N' && $quanzi['guanli'] != $uid){			
					_message($quanzi['title'].": 会员不能发帖!");
			}			
			if($title==null || $neirong==null)_message("不能为空");
			$time=time();
			
			$tiezi=$this->db->GetOne("select * from `@#_quanzi_tiezi` where `hueiyuan` = '$uid' and `qzid` = '$qzid' and `title` = '$title' and `neirong` = '$neirong'");
			if($tiezi)_message("不能重复提交");
						
			if($quanzi['shenhe'] == 'Y'){
				$shenhe = 'N';
			}else{
				$shenhe = 'Y';
			}
			$this->db->Query("INSERT INTO `@#_quanzi_tiezi`(`qzid`,`hueiyuan`,`title`,`neirong`,`zuihou`,`shenhe`,`time`)VALUES('$qzid','$uid','$title','$neirong','$uid','$shenhe','$time')");
			$tiez=$this->db->GetOne("select * from `@#_quanzi` where `id` = '$qzid'");
			$tznum=$tiez['tiezi']+1;
			$this->db->Query("UPDATE `@#_quanzi` SET `tiezi`='$tznum' where `id`='$qzid'");

			_message("添加成功",$_SERVER['HTTP_REFERER']);
		}
	}
	
	/*帖子回复显示页*/
	public function nei(){
		$uid = $this->userinfo['uid'];
		$id=abs(intval($this->segment(4)));
		if(!$id)_message("页面错误");
		$tiezi=$this->db->GetOne("select * from `@#_quanzi_tiezi` where `id`='$id'");
		if(!$tiezi)_message("页面错误");
		
		$dianji=$tiezi['dianji']+1;
		$this->db->Query("UPDATE `@#_quanzi_tiezi` SET `dianji`='$dianji' where `id`='$id'");
	
		$title=$tiezi['title']."_"._cfg("web_name");
		$keywords =$tiezi['title'];
		$description = _htmtocode(_strcut($tiezi['neirong'],0,250));
		
		$member=$this->db->GetOne("select * from `@#_member` where `uid`='$tiezi[hueiyuan]'");		
		$quanzi=$this->db->GetOne("select * from `@#_quanzi` where `id` = '$tiezi[qzid]'");
		
		$num=10;
		$total=$this->db->GetCount("select * from `@#_quanzi_tiezi` where `tiezi` = '$id'"); 
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){
			$pagenum=$_GET['p'];
		}else{$pagenum=1;}		
		$page->config($total,$num,$pagenum,"0"); 
		if($pagenum>$page->page){
			$pagenum=$page->page;
		}	
		$hueifu=$this->db->GetPage("select * from `@#_quanzi_tiezi` WHERE tiezi='$id' and `shenhe` = 'Y' order by id DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
		include templates("group","nei");
	}
	
	
	/*发表帖子回复*/
	public function hueifuinsert(){	
		$uid = $this->userinfo['uid'];
		if($uid==null)_message("未登录");		
		if(!isset($_POST['submit'])){exit;}
		$group_syzm = _getcookie("checkcode");			
		$group_pyzm = isset($_POST['group_code']) ? strtoupper($_POST['group_code']) : '';			
		if(empty($group_pyzm)){
			_message("请输入验证码");
		}
		if($group_syzm != md5($group_pyzm)){
			_message("验证码不正确");
		}
		$qzid=intval($_POST['qzid']);
		$qzinfo = $this->db->GetOne("SELECT * FROM `@#_quanzi` WHERE `id` = '$qzid'");
		if(!$qzinfo || $qzinfo['huifu']=='N'){
			_message("该圈子禁用回复!");
		}
		
		
		$hueifu=_htmtocode($_POST['hueifu']);		
		
		if($hueifu==null)_message("内容不能为空");
		$tzid=intval($_POST['tzid']);
		if($tzid<=0)_message("错误");
		$hftime=time();
		if($qzinfo['shenhe'] == 'Y'){
			$shenhe = 'N';
		}else{
			$shenhe = 'Y';
		}
		$this->db->Query("INSERT INTO `@#_quanzi_tiezi`(`qzid`,`tiezi`,`hueiyuan`,`neirong`,`shenhe`,`time`)VALUES('$qzid','$tzid','$uid','$hueifu','$shenhe','$hftime')");
		
		$tiezi=$this->db->GetOne("select * from `@#_quanzi_tiezi` where `id`='$tzid'");
		$hfnum=$tiezi['hueifu']+1;
		$this->db->Query("UPDATE `@#_quanzi_tiezi` SET `hueifu`='$hfnum' where `id`='$tzid'");
		
		
		if($qzinfo['shenhe'] == 'Y'){
			_message("添加成功,需要管理员审核");
		}
		_message("添加成功");
	
	}

}

?>