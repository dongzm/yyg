<?php
/**
 * page.class.php	分页类
 *
 * @copyright			(C) 2005-2010 战线
 * @license				V3.1.2
 * @lastmodify			2014-05-21
 */

class  page {

	private $total;					//总条数
	private $num;					//显示条数
	private $url;					//没有&page的URL
	private $limit;					//限制显示条数
	private $page;					//当前页数
	private $pagetotal;				//一共多少页数	
	private $pageurl;				//外部定义分页url

	public function config($total,$num,$page,$pageurl=''){		
		$this->total=$total;		
		$this->num=$num;
		$this->pageurl=$pageurl;		
		$this->pagetotal=ceil($this->total/$this->num);
		$this->page=$this->get_url_page($page);
		$this->url=$this->geturl();
		$this->limit=$this->setlimit();
	}	
	
	//主入口
	public  function show($style='',$ret=''){
		$style=strtolower(trim($style));		
		switch($style){		
			case "one" :				//普通的样式			
				return $this->ordinary($ret);			
				break;			
			case "two" :
				return $this->pagelist($ret);
				break;				
			default:			
				return $this->pagelist($ret);
				break;		
		}		
	}
	
	
	// 普通的样式
	private function ordinary($ret){
		$Prev=$this->page-1;
		$next=$this->page+1;
		$html_l="<ul id='Page_Ul'>";
		$html='';				
		if($Prev!=0){
			$html.="<li id='Page_Prev'><a href=\"{$this->url[0]}{$Prev}{$this->url[1]}\">上一页</a></li>";	
		}else{
			$html.="<li id='Page_Prev'><a href=\"javascript:void(0);\">上一页</a></li>";	
		}	
		if($next<=$this->pagetotal){
			$html.="<li id='Page_Next'><a href=\"{$this->url[0]}{$next}{$this->url[1]}\">下一页</a></li>";
		}else{
			$html.="<li id='Page_Next'><a href=\"javascript:void(0);\">下一页</a></li>";	
		}
		$html.="<li id='Page_One'><a href=\"{$this->url[0]}1{$this->url[1]}\">首页</a></li>";	
		$html.="<li id='Page_End'><a href=\"{$this->url[0]}{$this->pagetotal}{$this->url[1]}\">尾页</a></li>";	
		$html_r="</ul>";
		if($this->total==0){
			return;
		}else{
			if($ret=='li'){
				return $html;
			}else{
				return $html_l.$html.$html_r;
			}
		}
	}
	
	// 默认的样式-列表样式
	private function pagelist($ret){	
		
		$listnum=floor(7/2);		
		$html_l="<ul id='Page_Ul'>";
		$html='';
		$html.="<li id='Page_Total'>{$this->total}条";
		$html.="<li id='Page_One'><a href=\"{$this->url[0]}1{$this->url[1]}\">首页</a></li>";
		if($this->page==1){
			$html.="<li id='Page_Prev'><a href=\"{$this->url[0]}".($this->page).$this->url[1]."\">上一页</a></li>";
		}else{
			$html.="<li id='Page_Prev'><a href=\"{$this->url[0]}".($this->page-1).$this->url[1]."\">上一页</a></li>";
		}
		for($i=$listnum;$i>=1;$i--){
			$page=$this->page-$i;
			
			if($page<1){
				continue;			
			}else{
				$html.="<li class='Page_Num'><a href=\"{$this->url[0]}{$page}{$this->url[1]}\">{$page}</a></li>";
			}
			
		}
		
		$html.="<li class='Page_This'>{$this->page}</li>";
		
		for($i=1;$i<=$listnum;$i++){
			
			$page=$this->page+$i;
			if($page<=$this->pagetotal){
				$html.="<li class='Page_Num'><a href=\"{$this->url[0]}{$page}{$this->url[1]}\">{$page}</a></li>";
			}else{
				continue;	
			}
		}
		if($this->page==$this->pagetotal){
			$html.="<li id='Page_Next'><a href=\"{$this->url[0]}".($this->page).$this->url[1]."\">下一页</a></li>";
		}else{
			$html.="<li id='Page_Next'><a href=\"{$this->url[0]}".($this->page+1).$this->url[1]."\">下一页</a></li>";
		}	
		$html.="<li id='Page_End'><a href=\"{$this->url[0]}{$this->pagetotal}{$this->url[1]}\">尾页</a></li>";
		$html_r="</ul>";
		
		if($this->total==0){
			return;
		}else{
			if($ret=='li'){
				return $html;
			}else{
				return $html_l.$html.$html_r;
			}
		}
	
	}
	
	
	//获取URL
	private function geturl(){	
		$url=array(0=>'',1=>'');	
		$urls=get_web_url();
		global $_cfg;
		$urls = WEB_PATH.'/'.$_cfg['param_arr']['url'];
		//$urls = str_ireplace("/index.php/","/",$urls);
		
		$urls=trim($urls,'/');
		$parse=parse_url($urls);
		if(isset($parse['query'])){		
			parse_str($parse['query'],$parses);		
			unset($parses['p']);			
			if(empty($parses)){
				$urls=$parse['path']."?";
			}else{				
				$urls=$parse['path']."?".http_build_query($parses).'&';				
				$urls = str_ireplace("%2f",'/',$urls);
				$urls = str_ireplace("=&",'/&',$urls);
			}	
		}else{
			$urls=$parse['path']."?";
		}		
		$urls  =   preg_replace("#\/\/#","/",$urls);
	 	$url[0]=$urls.'p=';	
		return $url;
	}
	
	
	private function get_url_page($page=1){
			/*
			global $_cfg;			
			$param = end($_cfg['param_arr']);
			if(empty($param)){				
				$_cfg['param_arr']['url']=$_cfg['param_arr']['url'].'/p1q';
				$page = 1;
			}else{
				preg_match_all("/p(.*)q/i", $param,$matches,PREG_SET_ORDER);
				if(isset($matches[0][1])){
					$page = abs(intval($matches[0][1]));					
				}else{					
					$_cfg['param_arr']['url']=$_cfg['param_arr']['url'].'/p1q';
					$page = 1;
				}				
			}
			*/
			$page = abs(intval($page));
			if(!$page)$page=1;
			if($page>$this->pagetotal){
				$page=$this->pagetotal;
			}		
			return $page;
			
	}
	
	private function get_this_url(){
		global $_cfg;				
		$urls = WEB_PATH.'/'.$_cfg['param_arr']['url'];
		$urls = explode('/',$urls);	
		array_pop($urls);		
		$urls = implode('/',$urls);
		return array($urls.'/p',"q");
	}
	
	//设置LIMIT
	private function setlimit(){
		return "LIMIT ".($this->page-1)*$this->num.",".$this->num;
	}
	
	
	//使外部能访问limit
	public function __get($value){
		return $this->$value;		
	}

}