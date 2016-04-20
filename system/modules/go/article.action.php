<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_fun('user');
System::load_sys_fun('user');
class article extends SystemAction {
	private $db;
	public function __construct(){
		$this->db=System::load_sys_class('model');
	}
	public function init(){}	
	
	/*显示单篇文章*/
	public function show(){	
		$articleid = safe_replace($this->segment(4));
		$article=$this->db->GetOne("SELECT * FROM `@#_article` where `id` = '$articleid' LIMIT 1");
		if($article){
			$cateinfo = $this->db->GetOne("SELECT * FROM `@#_category` where `cateid` = '$article[cateid]' LIMIT 1");
		}else{
			$cateinfo = array("info"=>null);
		}		
		$info=unserialize($cateinfo['info']);		
		$title = $article['title']."_"._cfg("web_name");
		$keywords=$article['keywords'];
		$description=$article['description'];
		if(!isset($info['template_show'])){
			$info['template_show'] = "article_show.show.html";
		}
		$template=explode('.',$info['template_show']);
		include templates($template[0],$template[1]);
	}

	/*列表页面*/
	public function lists(){
		$single= safe_replace($this->segment(4));
		if(intval($single)){			
			$article=$this->db->GetOne("SELECT * FROM `@#_category` where `cateid` = '$single' LIMIT 1");
		}else{		
			$article=$this->db->GetOne("SELECT * FROM `@#_category` where `catdir` = '$single' LIMIT 1");
		}
		if(!$article){_message("参数错误!");}
		
		$cid = $cateinfo['cateid'];
		$cids = "'$cid',";
		$cateinfos = $this->db->GetList("SELECT cateid,parentid,cids,name FROM `@#_category` where `cids` LIKE '%$cid,%'",array("key"=>"cateid"));
		$cateinfos[$cid]=$cateinfo;
		foreach($cateinfos as $v){
			$cids .= "'".$v['cateid']."',";
		}
		$cids = rtrim($cids,",");
		
		$info=unserialize($article['info']);
		if(!isset($info['template_list'])){
			$info['template_list'] = "article_list.list.html";
		}

		$article['thumb']=$info['thumb'];
		$article['des']=$info['des'];
		$article['content']= base64_decode($info['content']);
		$title=empty($info['meta_title']) ? $article['name'] : $info['meta_title'];
		$keywords=$info['meta_keywords'];
		$description=$info['meta_description'];
		$template=explode('.',$info['template_list']);
		include templates($template[0],$template[1]);
	}
	
	/*显示单网页和列表页面*/
	public function single(){
		$single = safe_replace($this->segment(4));
		if(intval($single)){			
			$article=$this->db->GetOne("SELECT * FROM `@#_category` where `cateid` = '$single' LIMIT 1");
		}else{		
			$article=$this->db->GetOne("SELECT * FROM `@#_category` where `catdir` = '$single' LIMIT 1");
		}
		if(!$article){_message("参数错误!");}		
		
		$info=unserialize($article['info']);

		$article['thumb']=$info['thumb'];
		$article['des']=$info['des'];
		$article['content']= base64_decode($info['content']);
		$title=empty($info['meta_title']) ? $article['name'] : $info['meta_title'];
		$keywords=$info['meta_keywords'];
		$description=$info['meta_description'];
		$template=explode('.',$info['template']);
		include templates($template[0],$template[1]);
	}
}


?>