<?php 

defined('G_IN_SYSTEM')or exit('no');

System::load_app_class('admin',G_ADMIN_DIR,'no');
class category extends admin {
	private $db;
	public function __construct(){		
		parent::__construct();
		System::load_app_fun('global',G_ADMIN_DIR);
		$this->db=$this->DB('category_model',ROUTE_M);
		$this->ment=array(
						array("lists","栏目管理",ROUTE_M.'/'.ROUTE_C."/lists"),
						array("addcate","添加栏目",ROUTE_M.'/'.ROUTE_C."/addcate/def"),
						array("addcate","添加单网页",ROUTE_M.'/'.ROUTE_C."/addcate/danweb"),
						array("addcate","添加外部链接",ROUTE_M.'/'.ROUTE_C."/addcate/link"),
		);
	}

	//栏目列表
	public function lists(){
		$cate_type=$this->segment(4);
		if(!$cate_type){
			$cate_where='1';
		}
		if($cate_type=='article'){
			$cate_where="`model` = '2'";
		}
		if($cate_type=='goods'){
			$cate_where="`model` = '1'";
		}
		if($cate_type=='single'){
			$cate_where="`model` = '-1'";
		}			
	
		$categorys=$this->db->GetList("SELECT * FROM `@#_category` WHERE $cate_where order by `parentid` ASC,`order` DESC",array('key'=>'cateid'));
		$models=$this->db->GetList("SELECT * FROM `@#_model` WHERE 1",array('key'=>'modelid'));
		$tree=System::load_sys_class('tree');
		$tree->icon = array('│ ','├─ ','└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		foreach($categorys as $v){
			$v['typename']=cattype($v['model']);		
			if($v['model']==-1){
				$v['addsun']=G_ADMIN_PATH.'/'.ROUTE_C.'/addcate/danweb/';
			}
			if($v['model']==-2){
				$v['addsun']=G_ADMIN_PATH.'/'.ROUTE_C.'/addcate/link/';
			}
			if($v['model']>0){
				$v['addsun']=G_ADMIN_PATH.'/'.ROUTE_C.'/addcate/def/';
				$v['model']=$models[$v['model']]['name'];
			}else{
				$v['model']='';
			}		
			$v['editcate']=G_ADMIN_PATH.'/'.ROUTE_C.'/editcate/';
			$v['delcate']=G_ADMIN_PATH.'/'.ROUTE_C.'/delcate/';			
			$categorys[$v['cateid']]=$v;
		}	
		$html=<<<HTML
			<tr>
            <td align='center'><input name='listorders[\$cateid]' type='text' size='3' value='\$order' class='input-text-c'></td>
			<td align='center'>\$cateid</td>
            <td align='left'>\$spacer\$name</th>
            <td align='center'>\$typename</td>
            <td align='center'>\$model</td>
            <td align='center'></td>
			<td align='center'>
                <a href='\$addsun\$cateid'>添加子栏目</a><span class='span_fenge lr5'>|</span>   
				<a href='\$editcate\$cateid'>修改</a><span class='span_fenge lr5'>|</span>
				<a href=\"javascript:window.parent.Del('\$delcate\$cateid', '确认删除『 \$name 』栏目？');\">删除</a>
            </td>
          </tr>
HTML;

		$tree->init($categorys);
		$html=$tree->get_tree(0,$html);		
		include $this->tpl(ROUTE_M,'category.list');		
	}



	//添加栏目
	public function addcate(){	
			
		$catetype=$this->segment(4);			//类型	
		$categorys=$this->db->GetList("SELECT * FROM `@#_category` WHERE 1 order by `parentid` ASC,`cateid` ASC",array('key'=>'cateid'));
		$models=$this->db->GetList("SELECT * FROM `@#_model` WHERE 1",array('key'=>'modelid'));
		$tree=System::load_sys_class('tree');
		$tree->icon = array('│ ','├─ ','└─ ');
		$tree->nbsp = '&nbsp;';
		$categoryshtml="<option value='\$cateid'>\$spacer\$name</option>";
		$tree->init($categorys);
		$categoryshtml=$tree->get_tree(0,$categoryshtml);
		$topmodel='';
		if($topcat=intval($this->segment(5))){
			$topcat=$this->db->GetOne("SELECT * FROM `@#_category` WHERE `cateid` = '$topcat' LIMIT 1");
			if(!$topcat)_message("参数错误");		
			$categoryshtml.="<option value='$topcat[cateid]' selected>≡ $topcat[name] ≡</option>";
			if($topcat['model']>0){
				$modelname=$models[$topcat['model']]['name'];
				$topmodel="<option value=\"$topcat[model]\" selected>≡ $modelname ≡</option>";
			}
		}
		$info=array();
		$mesage=NULL;
		if(isset($_POST['info'])){	
		
		
			switch($catetype){
				case 'def':
				$info['modelid']=($topcat!=0) ? $topcat['model'] : intval($_POST['info']['modelid']);
				$info['parentid']=intval($_POST['info']['parentid']);
				$info['name']=htmlspecialchars($_POST['info']['name']);
				$info['catdir']=htmlspecialchars($_POST['info']['catdir']);

				if($info['modelid']==0){$mesage='请选择数据模型';}				
				if(empty($info['name'])){$mesage='栏目名不能为空';}
				if(empty($info['catdir'])){$mesage='英文名不能为空';}				
				if(!empty($mesage))_message($mesage,null,3);					
				
				$setting=array (				
				'thumb' =>htmlspecialchars($_POST['thumb']),
				'des' =>'',
				'template' =>'',
				'content' =>'',
				'meta_title' => htmlspecialchars($_POST['setting']['meta_title']),
				'meta_keywords' =>htmlspecialchars($_POST['setting']['meta_keywords']),
				'meta_description' => htmlspecialchars($_POST['setting']['meta_description']),
				);				
						
				$setting['template_list'] = $_POST['info']['template_list'];
				$setting['template_show'] = $_POST['info']['template_show'];
				$setting['des']=htmlspecialchars($_POST['info']['description']);
				$setting=serialize($setting);
	
				$sql="INSERT INTO `@#_category` 
				 (`parentid`, `channel`,`model`,`name`, `catdir`, `url`, `info`, `order`) 
				  VALUES 
				 ('$info[parentid]','0', '$info[modelid]','$info[name]', '$info[catdir]', '','$setting','1')";
				
				$this->db->Query($sql);			
				if($this->db->affected_rows()){				
					_message("栏目添加成功!",WEB_PATH.'/'.ROUTE_M.'/category/lists');
				}else{
					_message("栏目添加失败!");
				}
				break;
				case 'danweb':					
				
				$info['modelid']=-1;
				$info['parentid']=intval($_POST['info']['parentid']);
				$info['name']=htmlspecialchars($_POST['info']['name']);
				$info['catdir']=htmlspecialchars($_POST['info']['catdir']);					
				
				if(empty($info['name'])){$mesage='栏目名不能为空';}
				if(empty($info['catdir'])){$mesage='英文名不能为空';}				
				if(!empty($mesage))_message($mesage,null,3);					
				
				$setting=array (
				'thumb' =>htmlspecialchars($_POST['thumb']),
				'des' =>'',
				'template' =>'',
				'content' =>'',
				'meta_title' => $_POST['setting']['meta_title'],
				'meta_keywords' => $_POST['setting']['meta_keywords'],
				'meta_description' => $_POST['setting']['meta_description'],
				);				
					
				$setting['des']=htmlspecialchars($_POST['info']['description']);
				$setting['template']=$_POST['info']['template'];
				$setting['content']=base64_encode(editor_safe_replace(stripslashes($_POST['setting']['content'])));
				$setting=serialize($setting);	
				$sql="INSERT INTO `@#_category` 
						(`parentid`,`channel`,`model`,`name`, `catdir`, `url`, `info`, `order`) 
						VALUES 
						('$info[parentid]','0', '$info[modelid]','$info[name]', '$info[catdir]', '','$setting','1')
					";				
				$this->db->Query($sql);			
				if($this->db->affected_rows()){
					_message("栏目添加成功!",WEB_PATH.'/'.ROUTE_M.'/category/lists');
				}else{
					_message("栏目添加失败!");
				}
				break;
				case 'link':	
					$info['modelid']=-2;
					$info['parentid']=intval($_POST['info']['parentid']);
					$info['name']=htmlspecialchars($_POST['info']['name']);
					$info['url']=htmlspecialchars($_POST['info']['url']);
					if(empty($info['name'])){_message('栏目名不能为空');}
					if(empty($info['url'])){_message("地址不能为空");}				
					$sql="INSERT INTO `@#_category` 
					(`parentid`,`channel`, `model`,`name`, `url`, `order`) 
					VALUES 
					('$info[parentid]', '0','$info[modelid]','$info[name]', '$info[url]','1')";				
					$this->db->Query($sql);			
					if($this->db->affected_rows()){
						_message("栏目添加成功!",WEB_PATH.'/'.ROUTE_M.'/category/lists');
					}else{
						_message("栏目添加失败!");
					}
					
				break;
			}//switch END			
			
		}//$_POST END
		
		include $this->tpl(ROUTE_M,'category.add');
	}//FUN END
	
	
	//编辑
	public function editcate(){
			$cateid=$this->segment(4);		
			if(!intval($cateid)){_message("参数错误");exit;}			
			$cateinfo=$this->db->GetOne("SELECT * FROM `@#_category` WHERE `cateid` = '$cateid' LIMIT 1");
			if(!$cateinfo)_message("没有这个栏目");	
			$cateinfo['info']=unserialize($cateinfo['info']);	
			$categorys=$this->db->GetList("SELECT * FROM `@#_category` WHERE 1 order by `parentid` ASC,`cateid` ASC",array('key'=>'cateid'));
			$models=$this->db->GetList("SELECT * FROM `@#_model` WHERE 1",array('key'=>'modelid'));
			$tree=System::load_sys_class('tree');
			$tree->icon = array('│ ','├─ ','└─ ');
			$tree->nbsp = '&nbsp;';					
			$categoryshtml="<option value='\$cateid'>\$spacer\$name</option>";
			$tree->init($categorys);			
			$categoryshtml=$tree->get_tree(0,$categoryshtml);
			$catetype='def';						//类型
			if($cateinfo['model']>0)$catetype='def';
			if($cateinfo['model']==-1)$catetype='danweb';
			if($cateinfo['model']==-2)$catetype='link';	
			$topinfo=$this->db->GetOne("SELECT * FROM `@#_category` WHERE `cateid` = '$cateinfo[parentid]' LIMIT 1");
			if($topinfo){
				$categoryshtml.="<option value='$topinfo[cateid]' selected>≡ $topinfo[name] ≡</option>";
			}else{
				$categoryshtml.="<option value='0' selected>≡ 作为一级栏目 ≡</option>";
			}	
			$info=array();
			
			if(isset($_POST['info'])){
				switch($catetype){
					case 'def':						
						$info['parentid']=intval($_POST['info']['parentid']);
						$info['name']=htmlspecialchars($_POST['info']['name']);
						$info['catdir']=htmlspecialchars($_POST['info']['catdir']);	
						if(empty($info['name'])){_message('栏目名不能为空');}
						if(empty($info['catdir'])){_message("地址不能为空");}							
						$setting=array (
						'thumb' =>htmlspecialchars($_POST['thumb']),
						'des' =>htmlspecialchars($_POST['info']['description']),
						'template' =>'',
						'content' =>'',				
						'meta_title' => htmlspecialchars($_POST['setting']['meta_title']),
						'meta_keywords' => htmlspecialchars($_POST['setting']['meta_keywords']),
						'meta_description' => htmlspecialchars($_POST['setting']['meta_description']),
						);
						$setting['template_list']=$_POST['info']['template_list'];
						$setting['template_show']=$_POST['info']['template_show'];
						$setting=serialize($setting);	
						$sql="UPDATE `@#_category` SET `parentid`='$info[parentid]',
													   `name`='$info[name]', 
													   `catdir`='$info[catdir]',
													   `info`='$setting' 
													   WHERE (`cateid`='$cateid')
						 ";		
						$this->db->Query($sql);			
						if($this->db->affected_rows()){
							_message("操作成功!",WEB_PATH.'/'.ROUTE_M.'/category/lists/');
						}else{
							_message("操作失败!");
						}
						
					break;
					case 'danweb':
						$info['parentid']=intval($_POST['info']['parentid']);
						$info['name']=$_POST['info']['name'];
						$info['catdir']=$_POST['info']['catdir'];	
						if(empty($info['name'])){_message('栏目名不能为空');}
						if(empty($info['catdir'])){_message("地址不能为空");}							
						$setting=array (
						'thumb' =>htmlspecialchars($_POST['thumb']),
						'des' =>htmlspecialchars($_POST['info']['description']),
						'template' =>$_POST['info']['template'],
						'content' =>base64_encode(editor_safe_replace(stripslashes($_POST['setting']['content']))),
						'meta_title' => htmlspecialchars($_POST['setting']['meta_title']),
						'meta_keywords' => htmlspecialchars($_POST['setting']['meta_keywords']),
						'meta_description' => htmlspecialchars($_POST['setting']['meta_description']),
						);
						
						$setting=serialize($setting);	
						$sql="UPDATE `@#_category` SET `parentid`='$info[parentid]',
													   `name`='$info[name]', 
													   `catdir`='$info[catdir]',
													   `info`='$setting' 
													   WHERE (`cateid`='$cateid')
						 ";		
						$this->db->Query($sql);			
						if($this->db->affected_rows()){
							_message("操作成功!",WEB_PATH.'/'.ROUTE_M.'/category/lists/');
						}else{
							_message("操作失败!");
						}					
					break;
				
					case 'link':
						$info['parentid']=intval($_POST['info']['parentid']);
						$info['name']=htmlspecialchars($_POST['info']['name']);
						$info['url']=htmlspecialchars($_POST['info']['url']);
						if(empty($info['name'])){_message('栏目名不能为空');}
						if(empty($info['url'])){_message("地址不能为空");}	
						$sql="UPDATE `@#_category` SET `parentid`='$info[parentid]',`name`='$info[name]', `url`='$info[url]' WHERE (`cateid`='$cateid')";				
						$this->db->Query($sql);			
						if($this->db->affected_rows()){
							_message("操作成功!",WEB_PATH.'/'.ROUTE_M.'/category/lists/');
						}else{
							_message("操作失败!");
						}
					
					break;
				}//SWITCH END				
			}//IF POST END			
			
			include $this->tpl(ROUTE_M,'category.edit');
			
	}

	/*
	*	栏目排序
	*/
	
	public function listorder(){		
		if($this->segment(4)=='dosubmit'){
			foreach($_POST['listorders'] as $id => $listorder){
				$this->db->Query("UPDATE `@#_category` SET `order` = '$listorder' where `cateid` = '$id'");		
			}				
			_message("排序更新成功");
		}else{
			_message("请排序");
		}		
	}//
		
	//ajax删除栏目
	public function delcate(){			
			$cateid=$this->segment(4);		
			if(!intval($cateid)){echo "no";exit;}
			$this->db->Query("DELETE FROM `@#_category` WHERE (`cateid`='$cateid') LIMIT 1");
			if($this->db->affected_rows()){			
				echo WEB_PATH.'/'.ROUTE_M.'/category/lists/';
			}else{
				echo "no";	
			}	
			
	}
}
?>
