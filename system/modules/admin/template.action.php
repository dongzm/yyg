<?php 
defined('G_IN_SYSTEM')or exit('');
System::load_app_class('admin',G_ADMIN_DIR,'no');
System::load_app_fun('global',G_ADMIN_DIR);

class template extends admin {

	private $templates=array();
	private $thistemp='';
	

	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class('model');
		$this->ment=array(
						array("init","模板管理",ROUTE_M.'/'.ROUTE_C."/init"),
		);
		$this->templates=System::load_sys_config("templates");
		$this->thistemp=System::load_sys_config("system","templates_name");
	}
	public function init(){
	
		/*当前模板配置*/
		$templates=array();		
		$templates=$this->templates;
		/*当前模板*/
		$thistemp=$this->thistemp;
		

		$dir = opendir(G_TEMPLATES);	
		$new_temp = false;
		$del_temp = false;
		while (($file = readdir($dir)) !== false){
			if($file != '.' && $file != '..'){		
				/*未添加的模板*/
			
				if(is_dir(G_TEMPLATES.$file) && !isset($templates[$file])){	
				
					$templates[$file] = array("name"=>"未填写","dir"=>$file,"html"=>"未填写","author"=>"未填写");
					$new_temp = true;
				}
				/*未删除的模板*/
				if(isset($templates[$file]) && !file_exists(G_TEMPLATES.$file)){
					unset($templates[$file]);		
					$del_temp = true;
				}
			}				
		}		
		
		
	
		closedir($dir);
	
		
		if($del_temp || $new_temp){		
			$html="<?php \n defined('G_IN_SYSTEM') or exit('No permission resources.');";
			$html.="\n return ".var_export($templates,true).";";
			$html.="\n ?>";			
			$ok=file_put_contents(G_CONFIG.'templates.inc.php',$html);
		}

		include $this->tpl(ROUTE_M,'template.lists');
	}
	public function off(){
		$temp=$this->segment(4);
		if(!isset($this->templates[$temp]))_message("没有这个模板");
		if($this->templates[$temp]['html']=='未填写'){
			_message("该模板还未添加进系统!");
		}
		$this->db->Query("update `@#_config` SET `value` = '$temp' WHERE `name` = 'templates_name'");
		EditConfig("system","templates_name",$temp);
			echo "<script>
				alert('修改成功');
				window.location.href='".G_MODULE_PATH.'/template/init'."';
				</script>";
	}
	
	
	
	public function edit(){
		$temp=$this->segment(4);
		if(!isset($this->templates[$temp]))_message("没有这个模板");
		$template=$this->templates[$temp];
		if(!is_writable(G_CONFIG.'templates.inc.php')) _message('Please chmod  templates  to 0777 !');
		if(isset($_POST['dosubmit'])){			
			$new_template['name']=htmlspecialchars($_POST['name']);
			$new_template['dir']=htmlspecialchars($_POST['dir']);
			$new_template['html']=htmlspecialchars($_POST['html']);
			$new_template['author']=htmlspecialchars($_POST['author']);
			
			unset($this->templates[$temp]);
			
			$this->templates[$new_template['dir']]=$new_template;
			$html="<?php \n defined('G_IN_SYSTEM') or exit('No permission resources.');";
			$html.="\n return ".var_export($this->templates,true);
			$html.="\n ?>";			
			$ok=file_put_contents(G_CONFIG.'templates.inc.php',$html);
			
			if($template['html'] != $new_template['html']){				
				$rename_html = @rename(G_TEMPLATES.$template['dir'].DIRECTORY_SEPARATOR.$template['html'],G_TEMPLATES.$template['dir'].DIRECTORY_SEPARATOR.$new_template['html']);
				if(!$rename_html){
					_message("没有权限重命名:".$template['html']);
				}
			}
			if($template['dir'] != $new_template['dir']){				
				$rename_dir = @rename(G_TEMPLATES.$template['dir'],G_TEMPLATES.$new_template['dir']);
				if(!$rename_dir){
					_message("没有权限重命名:".$template['dir']);
				}
			}
			if($this->thistemp == $temp){
					EditConfig("system","templates_name",$new_template['dir']);
			}
				
			if($ok){

				echo "<script>
				alert('修改成功');
				window.location.href='".G_MODULE_PATH.'/template/init'."';
				</script>";			
			}
		}
		include $this->tpl(ROUTE_M,'template.edit');
	}
	
	/*模板列表*/
	public function see(){
	
		$temp_dir = safe_replace($this->segment(4));
		$temp_htm = safe_replace($this->segment(5));		
		if($temp_dir){			
			$path=G_TEMPLATES.$temp_dir.DIRECTORY_SEPARATOR.$temp_htm.DIRECTORY_SEPARATOR;		
		}else{
			$path=G_TEMPLATES.G_STYLE.DIRECTORY_SEPARATOR.G_STYLE_HTML.DIRECTORY_SEPARATOR;	
			$temp_dir = G_STYLE;
		}	

		$html_arr = file_exists($path) ? scandir($path) : false;
		if(!$html_arr){
			$temps = array();			
		}else{		
			array_Shift($html_arr);
			array_Shift($html_arr);
			$thistemplate = $temp_dir;
			$temps=$this->db->GetList("SELECT * FROM `@#_template` where `template` = '$thistemplate'",array('key'=>'template_name'));
			if(count($temps) != count($html_arr)){
				foreach($html_arr as $html){
					if(!isset($temps[$html])){
						if(is_dir($path.$html)){
							$html = "<a style=\"color:#0c0;font-size:14px;\" href=\"#\">".$html."</a>";
						}
						$temps[$html]['template_name']= $html;
						$temps[$html]['des']='';
						$temps[$html]['template']=$thistemplate;
					}
				}
				}
			unset($thistemplate);
		}			
		include $this->tpl(ROUTE_M,'template.see');
	}
	
	/*更新模板简介*/
	public function updatades(){
		if(isset($_POST['submit'])){			
			array_pop($_POST);		
			$thistemplate=G_STYLE;
			$temps=$this->db->GetList("SELECT * FROM `@#_template` where `template` = '$thistemplate'",array('key'=>'template_name'));
			foreach($_POST as $key=>$val){
				/*替换POST name*/
				$key=base64_decode($key);
				$val=htmlspecialchars($val);
				if(isset($temps[$key])){
					$this->db->Query("UPDATE `@#_template` SET `des` = '$val' where `template` = '$thistemplate' AND `template_name` = '$key'");
				}else{					
					$this->db->Query("INSERT INTO `@#_template` (`template_name`, `template`, `des`) VALUES ('$key', '$thistemplate', '$val')");
				}
			}
			_message("更新成功");
		}
	}
	/*修改模板内容*/
	public function update(){
		$path = G_TEMPLATES.G_STYLE.DIRECTORY_SEPARATOR.G_STYLE_HTML.DIRECTORY_SEPARATOR;	
		$name = base64_decode($this->segment(4));
		$path = $path.$name;
		$pathz = explode(".",$name);		
		if(end($pathz) !== 'html'){
			exit("不是一个HTML文件");			
		}	
		if(isset($_POST['submit'])){
			$content=stripslashes($_POST['content']);
			$ok=file_put_contents($path,$content);		
			if(gettype(file_put_contents($path,$content))!='integer'){			
				_message("模板修改不成功,请检查模板目录是否具有写入权限!");
			}
			_message("模板修改成功!",WEB_PATH.'/'.ROUTE_M.'/template/see');
		}
		if(file_exists($path)){
			$files=file_get_contents($path);
			$files=htmlspecialchars($files);
		}else{
			_message("模板不存在");
		}
		include $this->tpl(ROUTE_M,'template.update');
	}
	
	/*新建模板*/
	public function insert(){
		$path=G_TEMPLATES.G_STYLE.DIRECTORY_SEPARATOR.G_STYLE_HTML.DIRECTORY_SEPARATOR;
		$htmlcontent=<<<HTML
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
     <body>
        	<h1>模板内容</h1>
     </body>       
</html>
HTML;
		$htmlcontent=htmlspecialchars($htmlcontent);
		include $this->tpl(ROUTE_M,'template.update');
	}
    public function temp(){
        /*注册验证*/
        $temp_m_reg = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_mobile_reg' LIMIT 1");
        $temp_e_reg = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_email_reg' LIMIT 1");
        /*获奖*/
        $temp_m_shop = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_mobile_shop' LIMIT 1");
        $temp_e_shop = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_email_shop' LIMIT 1");
        /*找回密码*/
        $temp_m_pwd = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_mobile_pwd' LIMIT 1");
        $temp_e_pwd = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_email_pwd' LIMIT 1");

        if(isset($_POST['dosubmit'])){

            $q_1 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[e_reg_temp]' WHERE (`key`='template_email_reg')");
            $q_2 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[e_shop_temp]' WHERE (`key`='template_email_shop')");
            $q_3 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[e_pwd_temp]' WHERE (`key`='template_email_pwd')");
            $q_4 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[m_shop_temp]' WHERE (`key`='template_mobile_shop')");
            $q_5 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[m_reg_temp]' WHERE (`key`='template_mobile_reg')");
            $q_6 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[m_pwd_temp]' WHERE (`key`='template_mobile_pwd')");

            if($q_1 && $q_2 && $q_3 && $q_4 && $q_5 && $q_6){
                _message("邮件模板更新成功！");
            }else{
                _message("邮件模板更新失败！");
            }
        }


        $temp_m_reg['value']=htmlspecialchars($temp_m_reg['value']);
        $temp_e_reg['value']=htmlspecialchars($temp_e_reg['value']);
        $temp_m_shop['value']=htmlspecialchars($temp_m_shop['value']);
        $temp_e_shop['value']=htmlspecialchars($temp_e_shop['value']);
        $temp_m_pwd['value']=htmlspecialchars($temp_m_pwd['value']);
        $temp_e_pwd['value']=htmlspecialchars($temp_e_pwd['value']);
        include $this->tpl(ROUTE_M,'template.temp');
    }
	
	public function email_temp(){	
		/*注册验资*/
		$temp_reg = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_email_reg' LIMIT 1");	
	    /*获奖*/
		$temp_shop = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_email_shop' LIMIT 1");
		
		if(isset($_POST['dosubmit'])){
			$m_reg_temp = $_POST['m_reg_temp'];
			$m_shop_temp = $_POST['m_shop_temp'];
			$q_1 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[m_reg_temp]' WHERE (`key`='template_email_reg')");
			$q_2 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[m_shop_temp]' WHERE (`key`='template_email_shop')");
			if($q_1 && $q_2){
				_message("邮件模板更新成功！");
			}else{
				_message("邮件模板更新失败！");
			}
		}
		
		
		$temp_reg['value']=htmlspecialchars($temp_reg['value']);
		$temp_shop['value']=htmlspecialchars($temp_shop['value']);
		include $this->tpl(ROUTE_M,'template.email');	
	}
	
	public function mobile_temp(){
		$config = System::load_sys_config("mobile");
		/*注册验资*/
		$temp_reg = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_mobile_reg' LIMIT 1");	
	    /*获奖*/
		$temp_shop = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_mobile_shop' LIMIT 1");
		
		if(isset($_POST['dosubmit'])){
			$m_reg_temp = $_POST['m_reg_temp'];
			$m_shop_temp = $_POST['m_shop_temp'];
			
			preg_match_all("/./us", $m_reg_temp, $match_reg);
			if(count($match_reg[0]) >=75){
				_message("注册验资短信模板不能超过75个字,请检查!");
			}
			preg_match_all("/./us", $m_shop_temp, $match_shop);
			if(count($match_shop[0]) >=75){
				_message("用户获奖短信模板不能超过75个字,请检查!");
			}
			
			$q_1 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[m_reg_temp]' WHERE (`key`='template_mobile_reg')");
			$q_2 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[m_shop_temp]' WHERE (`key`='template_mobile_shop')");
			if($q_1 && $q_2){
				_message("短信模板更新成功！");
			}else{
				_message("短信模板更新失败！");
			}
		}		

	
		include $this->tpl(ROUTE_M,'template.mobile');
	}
	
}
?>