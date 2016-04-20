<?php 

System::load_sys_fun("user");
System::load_app_fun("user");
System::load_app_fun("my");


class qq_qun extends SystemAction {
			
	public function __construct() {			
		$this->db=System::load_sys_class('model');				
	}

	public function init(){
	   $lists=$this->db->GetList("SELECT * FROM `@#_qqset` where 1");	 
	   $lists1=array();
	   $lists2=array();

	   $title = "官方QQ群" . _cfg("web_name");
	   if(!empty($lists)){
	     foreach($lists as $key=>$val){
		   if($val['type']=='地方群'){
		     $lists1[$key]=$val;		   
		   }else{
		     $lists2[$key]=$val;		   
		   }
		 }	   
	   }
	
	  include templates("index","qq");
	}

	//ajax 获取地方代理的qq群信息 
	//获取市/县
	public function get_cityqq(){

		 $prov=urldecode(trim($this->segment(4)));	  
		 $cityv=urldecode(trim($this->segment(5)));	
		 $couv=urldecode(trim($this->segment(6)));
		 $prov = safe_replace($prov);
		 $cityv = safe_replace($cityv);
		 $couv = safe_replace($couv);
		 
		if(!_is_utf8($prov)){
			$prov =  iconv("GBK", "UTF-8", $prov); 
		}
		if(!_is_utf8($cityv)){
			$cityv =  iconv("GBK", "UTF-8", $cityv); 
		}
		if(!_is_utf8($couv)){
			$couv =  iconv("GBK", "UTF-8", $couv); 
		}
	
		 $str='----请选择----';
		 if($prov!=$str && $cityv==$str && $couv==$str){
			$res=$this->db->GetList("SELECT * FROM `@#_qqset` where `province`='$prov'");
		 }
		 if($prov!=$str && $cityv!=$str  && $couv==$str){
			$res=$this->db->GetList("SELECT * FROM `@#_qqset` where `province`='$prov' and `city`='$cityv'");
		 }
		 if($prov!=$str && $cityv!=$str && $couv!=$str){
			$res=$this->db->GetList("SELECT * FROM `@#_qqset` where `province`='$prov' and `city`='$cityv' and `county`='$couv'");
		 }
		 if(!empty($res)){
			 $str='<ul>';		 
			 foreach($res as $v){		
				$str.='<li><dt><img border="0" alt="'.$v['name'].'" src="'.G_TEMPLATES_IMAGE.'/logo.jpg"></dt><dt>'.$v['name'];
				if($v['full']=='已满'){
				 $str.='<img src="'.G_TEMPLATES_IMAGE.'/qqhot.gif"/>';
				}
				 $str.='</dt><dd><a href="'.$v['qqurl'].'">'.$v['qq'].'</a></dd></li>';
			 }
			 $str.='</ul>';
		 }else{
		   $str="<div class='nothing'>该地区暂无QQ群加盟，"._cfg("web_name_two")."诚邀您加盟，详情请咨询客服</div>"; 
		 }
		 
		 echo $str;		 
	}


}