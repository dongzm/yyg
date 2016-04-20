<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin',G_ADMIN_DIR,'no');
System::load_app_fun('global',G_ADMIN_DIR);

class setting extends admin {	
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class("model");
		$this->ment=array(
						array("webcfg","SEO设置",ROUTE_M.'/'.ROUTE_C."/webcfg"),
						array("config","基本配置",ROUTE_M.'/'.ROUTE_C."/config"),
						array("upload","上传配置",ROUTE_M.'/'.ROUTE_C."/upload"),
						array("watermark","水印配置",ROUTE_M.'/'.ROUTE_C."/watermark"),
						array("email","邮箱配置",ROUTE_M.'/'.ROUTE_C."/email"),
						array("mobile","短信配置",ROUTE_M.'/'.ROUTE_C."/mobile"),
						array("payset","支付方式","pay/pay/pay_list"),						
						array("empower","授权查询",ROUTE_M.'/'.ROUTE_C."/empower"),
						array("domain","模块域名绑定",ROUTE_M.'/'.ROUTE_C."/domain"),
						array("send","<b>中奖通知设置</b>",ROUTE_M.'/'.ROUTE_C."/sendconfig")
		);
	
	}
	
	public function supper_ments(){
	
		/*
		
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `mid` int(10) unsigned NOT NULL,
			  `mtype` tinyint(1) NOT NULL,
			  `mids` varchar(100) NOT NULL,
			  `mname` char(20) NOT NULL,
			  `route_m` char(20) NOT NULL,
			  `route_c` char(20) DEFAULT NULL,
			  `route_a` char(20) DEFAULT NULL,
			  `route_data` varchar(250) DEFAULT NULL,
			  `posttime` int(10) unsigned NOT NULL,
		
		*/
		//$this->db->Query("INSERT INTO `@#_supper_ments` (`mid`,`mtype`,`mids`,`mname`,`route_m`,`route_c`,`route_a`,`route_data`,`posttime`) VALUES ($values)");
	
	}
	

	
	/**
	*	中奖通知设置
	*/
	public function sendconfig(){
	
	  $type = System::load_sys_config("send","type");
	  if(isset($_POST['s_type'])){	  
		$s_type = abs($_POST['s_type']);
		if(($s_type == $type) || $s_type > 3){
			_message("更新完成!");
		}
		$html = "<?php return array('type'=>'$s_type'); ?>";
		if(!is_writable(G_CONFIG.'send.inc.php')) exit('send.inc.php 没有写入权限!');
			file_put_contents(G_CONFIG.'send.inc.php',$html);
			_message("更新完成!");
		}
	  include $this->tpl(ROUTE_M,'config.send');
	}
	
	public function domain(){	
		$domain_cfg = System::load_sys_config("domain");
		if(empty($domain_cfg))$domain_cfg = array();
		if(isset($_POST['dosubmit']) && $_POST['dosubmit'] != 'del'){
			//插入或者修改
			$domain  = isset($_POST['domain']) ? trim(htmlspecialchars($_POST['domain'])) : null;
			$module  = isset($_POST['module']) ? trim(htmlspecialchars($_POST['module'])) : null;
			$action  = isset($_POST['action']) ? trim(htmlspecialchars($_POST['action'])) : null;
			$func    = isset($_POST['func']) ? trim(htmlspecialchars($_POST['func'])) : null;
			
			if(!$domain || !$module){
				exit("请正确填写绑定参数!");				
			}
			if($_POST['dosubmit'] == 'install'){
				if(array_key_exists($domain,$domain_cfg)){
					exit("绑定的域名已经被使用!");//array_keys
				}			
			}
			
			$domain =  str_ireplace("http://",'',trim($domain,'/'));		
			$domain_cfg[$domain] = array("m"=>$module,"c"=>$action,"a"=>$func);
			$html  = "<?php \n\n";
			$html .= "return ";
			$html .= var_export($domain_cfg,true).';';	
			$html .= "\n\n?>";
			if(!is_writable(G_CONFIG.'domain.inc.php')) exit('domain.inc.php 没有写入权限!');
			file_put_contents(G_CONFIG.'domain.inc.php',$html);
			exit("ok");
		}
		
		if(isset($_POST['dosubmit']) && $_POST['dosubmit'] == 'del'){
			$domain  = isset($_POST['domain']) ? trim(htmlspecialchars($_POST['domain'])) : null;
			if(!$domain){
				exit("操作失败1!");			
			}
			if(isset($domain_cfg[$domain])){
				unset($domain_cfg[$domain]);
				$html  = "<?php \n\n";
				$html .= "return ";
				$html .= var_export($domain_cfg,true).';';	
				$html .= "\n\n?>";
				if(!is_writable(G_CONFIG.'domain.inc.php')) exit('domain.inc.php 没有写入权限!');
				file_put_contents(G_CONFIG.'domain.inc.php',$html);
				exit("ok");
			}else{
				exit("操作失败2!");	
			}
		}
		

		 

		
		
		include $this->tpl(ROUTE_M,'config.domain');
	}
	
	//写入文件
	public function cfgPut(){
		$cfg=$this->db->GetList("select * from `@#_config` where 1");		
		$html="<?php \n defined('G_IN_SYSTEM') or exit('No permission resources.'); \n";
		$html.="return array( \n";
		foreach ($cfg as $v){
			$v['value'] = addslashes($v['value']);
			$html.="'$v[name]' => '$v[value]',//$v[zhushi]";
			$html.="\n";		
		}
		$html.="); \n ?>";
		if(!is_writable(G_CONFIG.'system.inc.php')) _message('Please chmod  system  to 0777 !');
		return $ok=file_put_contents(G_CONFIG.'system.inc.php',$html);		
	}
	//基本设置
	public function config(){
	
		if(isset($_POST['dosubmit'])){		
			$charset=htmlspecialchars($_POST['charset']);
			$timezone=htmlspecialchars($_POST['timezone']);
			$error=htmlspecialchars($_POST['error']);
			$gzip=htmlspecialchars($_POST['gzip']);
			$index_name=htmlspecialchars($_POST['index_name']);
			$expstr=htmlspecialchars($_POST['expstr']);
			$admindir=htmlspecialchars($_POST['admindir']);
			$web_off=htmlspecialchars($_POST['web_off']);
			$web_off_text=$_POST['web_off_text'];
			$qq=htmlspecialchars($_POST['qq']);
			$qq_qun=htmlspecialchars($_POST['qq_qun']);
			$cell=htmlspecialchars($_POST['cell']);
			$goods_end_time = intval($_POST['goods_end_time']);
			if($goods_end_time < 30 && $goods_end_time != 0){
				$goods_end_time = 180;
			}
			if($goods_end_time >= 300){
				$goods_end_time = 180;
			}	
			
			$this->db->Query("UPDATE `@#_config` SET `value`='$charset' WHERE (`name`='charset')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$timezone' WHERE (`name`='timezone')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$error' WHERE (`name`='error')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$gzip' WHERE (`name`='gzip')");			
			$this->db->Query("UPDATE `@#_config` SET `value`='$index_name' WHERE (`name`='index_name')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$expstr' WHERE (`name`='expstr')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$admindir' WHERE (`name`='admindir')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$web_off' WHERE (`name`='web_off')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$web_off_text' WHERE (`name`='web_off_text')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$qq' WHERE (`name`='qq')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$qq_qun' WHERE (`name`='qq_qun')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$cell' WHERE (`name`='cell')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$goods_end_time' WHERE (`name`='goods_end_time')");
			
			
			$admindir_one = dirname(__FILE__);	
			$admindir_two = dirname($admindir_one).DIRECTORY_SEPARATOR.$admindir;
			if($admindir_one !== $admindir_two){			
				rename($admindir_one,$admindir_two);
			}			
			$ok=$this->cfgPut();
			if($this->db->affected_rows() && $ok){				
				_message("修改成功");
			}else{
				_message("修改失败");
			}
		}
	
		
		$web=System::load_sys_config('system');
		include $this->tpl(ROUTE_M,'config.system');
	}
	
	public function webcfg(){
		if(isset($_POST['dosubmit'])){
		
			
			$web_name=htmlspecialchars($_POST['web_name']);
			$web_name_two=htmlspecialchars($_POST['web_name_two']);
			$web_path=htmlspecialchars($_POST['web_path']);
			$web_key=htmlspecialchars($_POST['web_key']);
			$web_des=htmlspecialchars($_POST['web_des']);
			$web_logo=htmlspecialchars($_POST['web_logo']);			
			$web_copyright=$_POST['web_copyright'];
			$this->db->Query("UPDATE `@#_config` SET `value`='$web_name' WHERE (`name`='web_name')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$web_name_two' WHERE (`name`='web_name_two')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$web_key' WHERE (`name`='web_key')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$web_des' WHERE (`name`='web_des')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$web_path' WHERE (`name`='web_path')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$web_logo' WHERE (`name`='web_logo')");
			$this->db->Query("UPDATE `@#_config` SET `value`='$web_copyright' WHERE (`name`='web_copyright')");
			
			$ok=$this->cfgPut();
			if($this->db->affected_rows() && $ok){
				_message("修改成功");
			}else{
				_message("修改失败");
			}
		}
		
		$web=System::load_sys_config('system');
		include $this->tpl(ROUTE_M,'config.webcfg');
	}	
	public function email(){
		$cesi=$this->segment(4);
		if($cesi=='cesi'){
			$youxiang=$this->segment(5);		
			$youxiang=str_replace("|",".",$youxiang);
			$ok=_sendemail($youxiang,'',"后台邮箱配置测试成功","<b>恭喜你邮箱测试成功</b>","1","0");
			if($ok=='1'){
				echo "邮件测试成功";
			}else{
				echo "邮件测试失败";
			}
			exit;
		}
		
		if(isset($_POST['dosubmit'])){
			$stmp_host=htmlspecialchars($_POST['server']);
			$email=htmlspecialchars($_POST['email']);
			$user=htmlspecialchars($_POST['user']);
			$pass=htmlspecialchars($_POST['pass']);
			$big=htmlspecialchars($_POST['big']);
			$fromName=htmlspecialchars($_POST['name']);
			$html=<<<HTML
			<?php 
			return array (	
				'stmp_host' => '{$stmp_host}',	//stmp服务器
				'user' => '{$user}',//账号
				'pass' => '{$pass}',		//密码
				'big' => '{$big}',				//发送编码
				'from' => "{$email}",//发件人
				'fromName' => "{$fromName}",  		//发件人名
				'nohtml' => "不支持HTML格式"  	//不支持HTML
			);
			?>
HTML;
			if(!is_writable(G_CONFIG.'email.inc.php')) _message('Please chmod  email  to 0777 !');
			$ok=file_put_contents(G_CONFIG.'email.inc.php',$html);
			if($ok){
				_message("操作成功");
			}
		}
		
		$info=System::load_sys_config("email");			
		include $this->tpl(ROUTE_M,'config.email');
	}
	
	
	/*短信配置与测试*/
	public function mobile(){
		
		$mobiles = System::load_sys_config("mobile");
		$sendobj = System::load_sys_class("sendmobile");
		
		/*发送测试开始*/
		/*
		  $sendobj -> init(array("mobile"=>"18306084563","content"=>"..."));
		  $ok = $sendobj -> send();
		  var_dump($ok);
		 */
		/*发送测试完成*/
		
		/*修改和启用短信接口*/
		if(isset($_POST['dosubmit'])){
					
			$cfg_id= trim($_POST['mid']);			
			$cfg_pass = trim($_POST['mpass']);	
			$cfg_qianming = trim(isset($_POST['mqianming']) ? $_POST['mqianming'] : '');
			$cfg_type  = abs(intval($_POST['interface']));
			
			$mobiles['cfg_mobile_on'] = $cfg_type;			
			$key = "cfg_mobile_".$cfg_type;
			
			$mobiles[$key]['mid'] =  $cfg_id;
			$mobiles[$key]['mpass'] =  $cfg_pass;
			$mobiles[$key]['mqianming'] =  $cfg_qianming;
			
			if($cfg_pass=='******'){
				_message("保存需要在输入一次短信密码!!!");
			}
			
			if(!is_writable(G_CONFIG.'mobile.inc.php')) _message('Please chmod  mobile.ini.php  to 0777 !');
				
			$html  = var_export($mobiles,true);
			$html  = "<?php \n return ".$html."; \n?>";
			$ok=file_put_contents(G_CONFIG.'mobile.inc.php',$html);
			if($ok){
				_message("短信配置更新成功!");
			}
				
		}
		
		
		/*短信测试*/
		if(isset($_POST['ceshi_submit'])){
			$_POST['ceshi_haoma'] = trim($_POST['ceshi_haoma']);
			$_POST['ceshi_con'] = trim($_POST['ceshi_con']);
			
			if(empty($_POST['ceshi_con']) || empty($_POST['ceshi_haoma'])){
				echo json_encode(array("-1","内容或者手机号不能为空!"));
				return;
			}			

			if(!is_numeric($_POST['ceshi_haoma'])){
				echo json_encode(array("-1","手机号不正确!"));
				return;
			}
			$sendok=_sendmobile($_POST['ceshi_haoma'],$_POST['ceshi_con']);
			echo json_encode($sendok);
			return;	
		}
		
		
		
		
		/************************************/
		/*短信条数*/
		foreach($mobiles as $k=>$v){
			if(is_array($v)){
				$k_t = explode("_",$k);
				$k_t = array_pop($k_t);
				$k_t_fun = "cfg_getdata_".$k_t;
				$sendobj -> $k_t_fun();

				if($sendobj->v){
					$mobiles[$k]['mobile_text'] = "<b style='color:#0c0'>短信功能正常</b>,短信还剩余 ".$sendobj->v." 条";
				}else{
					$mobiles[$k]['mobile_text'] = "<b style='color:#ff0000'>短信测试失败</b>,失败原因:".$sendobj->error;
				}
				
			}
		}
		$mobiles['cfg_mobile_'.count($mobiles)] = array("mid"=>"","mpass"=>"","mobile_text"=>"");
				
		include $this->tpl(ROUTE_M,'config.mobile');
	}
	
	
	public function mobiles(){
		$mobile=array('mid'=>'','mpass'=>'');
		$mobile=System::load_sys_config("mobile");
				
		$cesi=$this->segment(4);		
		
		if(isset($_POST['dosubmit_ceshi'])){
			$sendobj = System::load_sys_class("sendmobile");
						
			$_POST['ceshi_haoma'] = trim($_POST['ceshi_haoma']);
			$_POST['ceshi_con'] = trim($_POST['ceshi_con']);
			
			if(empty($_POST['ceshi_con']) || empty($_POST['ceshi_haoma'])){
				echo json_encode(array("-1","内容或者手机号不能为空!"));
				return;
			}			
			$ret = $sendobj->mobile_con_check($_POST['ceshi_con']);
			
			//内容检测不合法返回
			if($ret[0]==-1){
				echo json_encode($ret);
				return;
			}
			if(!is_numeric($_POST['ceshi_haoma'])){
				echo json_encode(array("-1","手机号不正确!"));
				return;
			}
			$sendok=_sendmobile($_POST['ceshi_haoma'],$_POST['ceshi_con']);
			echo json_encode($sendok);
			return;			
		}/*if end*/
		
		if(isset($_POST['dosubmit'])){
		
				$cfg_id= trim($_POST['mid']);			
				$cfg_pass = trim($_POST['mpass']);	
				$cfg_qianming = trim(isset($_POST['mqianming']) ? $_POST['mqianming'] : '');
				$cfg_type  = abs(intval($_POST['interface']));		

						
				if($cfg_type == 1){
					$mobile['cfg_mobile_1']['mid']    		= $cfg_id;
					$mobile['cfg_mobile_1']['mpass']  		= $cfg_pass;
					$mobile['cfg_mobile_1']['mqianming']   	= $cfg_qianming;	
					$mobile['cfg_mobile_2']['mid'] 			= $mobile['cfg_mobile_2']['mid'];
					$mobile['cfg_mobile_2']['mpass'] 		= $mobile['cfg_mobile_2']['mpass'];
					$mobile['cfg_mobile_2']['mqianming']	= $mobile['cfg_mobile_2']['mqianming'];
				}
				
				if($cfg_type == 2){
					$mobile['cfg_mobile_1']['mid'] 			= $mobile['cfg_mobile_1']['mid'];
					$mobile['cfg_mobile_1']['mpass'] 		= $mobile['cfg_mobile_1']['mpass'];
					$mobile['cfg_mobile_1']['mqianming']	= $mobile['cfg_mobile_1']['mqianming'];
					$mobile['cfg_mobile_2']['mid'] 			= $cfg_id;
					$mobile['cfg_mobile_2']['mpass'] 		= $cfg_pass;
					$mobile['cfg_mobile_2']['mqianming']	= $cfg_qianming;				
				}		
				
				$mobile['cfg_mobile_on'] = $cfg_type;
						
				if(!is_writable(G_CONFIG.'mobile.inc.php')) _message('Please chmod  mobile.ini.php  to 0777 !');
				
				$html  = var_export($mobile,true);
				$html  = "<?php \n return ".$html."; \n?>";
				$ok=file_put_contents(G_CONFIG.'mobile.inc.php',$html);
				if($ok){
					_message("短信配置更新成功!");
				}
		}
		
		$sendmobile=System::load_sys_class("sendmobile");
		
		$sendmobile->GetBalance();			
		if($sendmobile->error==1){
			$text2="<b style='color:#0c0'>短信功能正常</b>,短信还剩余 ".$sendmobile->v." 条";
		}else{
			$text2="<b style='color:#ff0000'>短信测试失败</b>,失败原因:".$sendmobile->v;
		}
		
		$new_mbl = $sendmobile->GetBalance_new();
		if($new_mbl['id']){
			$text1= "<b style='color:#0c0'>短信功能正常</b>,短信还剩余 ".$new_mbl['id']." 条";
		}else{
			$text1= "<b style='color:#ff0000'>短信测试失败</b>,失败原因:".$new_mbl['err'];
		}
		
		
		if(!isset($mobile['cfg_mobile_2'])){
			$mobile['cfg_mobile_1'] = $mobile['cfg_mobile_2'] = array(); 
			$mobile['cfg_mobile_2']['mid'] 			= $mobile['mid'];
			$mobile['cfg_mobile_2']['mpass'] 		= $mobile['mpass'];;
			$mobile['cfg_mobile_2']['mqianming']	= $mobile['mqianming'];		
			$mobile['cfg_mobile_1'] = array(); 
			$mobile['cfg_mobile_1']['mid'] 			= '';
			$mobile['cfg_mobile_1']['mpass'] 		= '';
			$mobile['cfg_mobile_1']['mqianming']	= '';
			
		}
				
				
		include $this->tpl(ROUTE_M,'config.mobile');
	}
	
	//上传配置
	public function upload(){	
	
		if(isset($_POST['dosubmit'])){
				$up_image_type = htmlspecialchars($_POST['up_image_type']);	
				$up_soft_type = htmlspecialchars($_POST['up_soft_type']);	
				$up_media_type = htmlspecialchars($_POST['up_media_type']);	
				$upsize = intval($_POST['upsize']);
				$up_image_type = trim($up_image_type,',');
				$up_soft_type = trim($up_soft_type,',');
				$up_media_type = trim($up_media_type,',');
								
				EditConfig("upload","upsize",$upsize,'xiao');
				EditConfig("upload","up_image_type",$up_image_type,'xiao');
				EditConfig("upload","up_soft_type",$up_soft_type,'xiao');
				EditConfig("upload","up_media_type",$up_media_type,'xiao');				
		
				_message("操作成功!");				
				
		}
	
		$web=System::load_sys_config('upload');
		/*	
			$up_image_type = implode(',',$web['up_image_type']);
			$up_soft_type = implode(',',$web['up_soft_type']);
			$up_media_type = implode(',',$web['up_media_type']);
		*/
		$up_image_type = $web['up_image_type'];
		$up_soft_type = $web['up_soft_type'];
		$up_media_type = $web['up_media_type'];
		include $this->tpl(ROUTE_M,'config.upload');
	}
	//水印配置
	public function watermark(){
		$upload_set = System::load_sys_config("upload");
		if(isset($_POST['dosubmit'])){
		
			$watermark_off = $_POST['watermark_off'];
			$watermark_type = $_POST['watermark_type'];
			
			$text = htmlspecialchars($_POST['text']);
			$color = htmlspecialchars($_POST['color']);
			$size = intval($_POST['size']);
			
			$width = intval($_POST['width']);
			$height = intval($_POST['height']);
			$image = htmlspecialchars($_POST['image']);
			$apache = intval($_POST['apache']);
			$good = intval($_POST['good']);
			$sel = htmlspecialchars($_POST['sel']);
			$html =<<<HTML
			<?php 
			/*
				上传和水印配置
				@up_image_type 		上传图片类型
				@up_soft_type		上传附件类型
				@up_media_type		上传媒体类型
				@upsize				允许单文件最大大小
				@watermark_off		水印开启
				@watermark_type		水印类型
				@watermark_condition
				@watermark_text		文本水印配置
				@watermark_image	图片水印地址
				@watermark_position 水印位置
			*/
			return array(
				'up_image_type' => '$upload_set[up_image_type]',
				'up_soft_type' => '$upload_set[up_soft_type]',
				'up_media_type' => '$upload_set[up_media_type]',
				'upsize' => '$upload_set[upsize]',
				'watermark_off' => '$watermark_off',
				'watermark_condition' => array('width'=>'$width','height'=>"$height"),
				'watermark_type' => '$watermark_type',
				'watermark_text' => array('text'=>"$text",'color'=>"$color",'size'=>"$size",'font'=>'C:\WINDOWS\Fonts\simhei.ttf'),
				'watermark_image' => '$image',
				'watermark_position' => '$sel',
				'watermark_apache' => '$apache',
				'watermark_good' => '$good',
			);
			?>
HTML;

			$path = G_CONFIG.'/'.'upload.inc.php';
			file_put_contents($path,$html);
			_message("修改成功");
		}
				
		include $this->tpl(ROUTE_M,'config.watermark');
	}
	
	
	//授权
	public function empower(){
		if(isset($_POST['dosubmit'])){
			$code=isset($_POST['code']) ? $_POST['code'] : null;
			if($code==null){
				_message('您输入的授权码格式不正确!');
			}
			$code = strtoupper($code);		
			$check = @fopen("http://www.yungoucms.com/get.php?set_code=$code","r");  
			if(!$check){  
				_message('您输入的授权码不正确!'); 
			}   
			$html="
				<?php 
					return array('code' => '$code');
				?>
			";
			$path = G_CONFIG.'/'.'code.inc.php';
			file_put_contents($path,$html);
			_message("绑定成功");
			
		}
		$code = System::load_sys_config("code","code");		
		if($code){
			echo <<<HTML
			<iframe src="http://www.yungoucms.com/get.php?code=$code" width="100%" height="100%" scrolling="no"  style=" border:0px;background:#fff; text-align:center"></iframe>
HTML;
		}else{
			include $this->tpl(ROUTE_M,'config.empower');	
		}		
	}
	
	//验证码配置
	public function checkcode(){
			if(isset($_POST['type'])){
			$info= array();
			$info['width']=$_POST['width'];
			$info['height']=$_POST['height'];
			$info['color']=$_POST['color'];
			$info['bgcolor']=$_POST['bgcolor'];
			$info['lenght']=$_POST['lenght'];
			$info['type']=$_POST['type'];
			
			$html_a=var_export($info,true);
			$html="
				<?php 
					return {$html_a};
				?>
			";
			$path = G_CONFIG.'/'.'checkcode.inc.php';
			file_put_contents($path,$html);
			}
			include $this->tpl(ROUTE_M,'config.checkcode');
	}
	
}//

?>