<?php

/**
 * template_cache.class.php	模板解析缓存类
 *
 * @copyright			(C) 2005-2010 战线
 * @license				
 * @lastmodify			2012-6-1
 */
 
 
	
	
final class template_cache {
	
	private $content;
	private $module;
	private $template;
	/**
	*	模板解析入口	
	*	返回解析了的模板地址
	*/
	public function template_init($FileTpl,$FileHtml,$ModuleName='',$TemplateName=''){
			$this->module=$ModuleName;
			$this->template=$TemplateName;
			$this->content = file_get_contents($FileHtml);
			$this->template_parse();		
			if(gettype(file_put_contents($FileTpl,$this->content))!='integer'){			
				return false;
			}		
			return true;
	}

	private function template_parse(){	
		$stag=base64_decode('d2M=');
		$etag=base64_decode('ZW5k');
		$foreach=base64_decode('bG9vcA==');
		$this->content = preg_replace ( "/<\\?php(.*)/i", "&lt;?php\\1",$this->content);
		$this->content = preg_replace ( "/<\\?=(.*)\\?>/is", "&lt;?=\\1&gt;",$this->content);
		$this->content = preg_replace ( "/<script\s+language\s*=\s*php\s*>/is", "<script>",$this->content);
		$this->content = preg_replace ( "/<script\s+language\s*=\s*[\'|\"]php\s*[\'|\"]\s*>/is", "<script>",$this->content);
		
		$this->content = preg_replace ("/\{$stag:templates\s+(.+)\}/", "<?php include templates(\\1);?>",$this->content);
		$this->content = preg_replace ( "/\{$stag:if\s+(.+?)\}/", "<?php if(\\1): ?>",$this->content);
		$this->content = preg_replace ( "/\{$stag:else\}/", "<?php  else: ?>",$this->content);
		$this->content = preg_replace ( "/\{$stag:elseif\s+(.+?)\}/", "<?php elseif (\\1): ?>",$this->content);
		$this->content = preg_replace ( "/\{$stag:if:$etag\}/", "<?php endif; ?>",$this->content);
		
		//page分页
		$this->content = preg_replace ( "/\{$stag:page:(\w+)\}/","<?php echo \$page->show('\\1'); ?>",$this->content);
		$this->content = preg_replace ( "/\{$stag:page:\\$(\w+)\}/", "<?php echo \$page->\\1; ?>",$this->content);
		

		$this->content = preg_replace ( "/\{$stag:$foreach\s+(\S+)\s+(\S+)\}/",
										"<?php \$ln=1;if(is_array(\\1)) foreach(\\1 AS \\2): ?>",$this->content);										
		$this->content = preg_replace ( "/\{$stag:$foreach\s+(\S+)\s+(\S+)\s+(\S+)\}/",
										"<?php \$ln=1; if(is_array(\\1)) foreach(\\1 AS \\2 => \\3): ?>",$this->content);										
		$this->content = preg_replace ( "/\{$stag:$foreach:$etag\}/", "<?php  endforeach; \$ln++; unset(\$ln); ?>",$this->content);		
		
		
		$this->content = preg_replace ( "/\{$stag:fun:([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/",
										"<?php echo \\1; ?>", $this->content );
		
		//变量标签
				
		$this->content = preg_replace ( "/\{$stag:(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/",
										"<?php echo \\1; ?>", $this->content );		
		$this->content = preg_replace ( "/\{$stag:(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\s*([\+\-\*\/])\s*(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/",
										"<?php echo \\1\\2\\3; ?>", $this->content );										
		$this->content = preg_replace ("/\{$stag:(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)([\$a-zA-Z_0-9\[\]\'\"\$\x7f-\xff]+)\}/es",
										"\$this->addquote('<?php echo \\1\\2; ?>')",$this->content);
		$this->content = preg_replace ("/\{$stag:([a-zA-Z_0-9\[\]\'\"\$\x7f-\xff\+\-\*\/]+)\}/es",
										"\$this->addquote('<?php echo \\1; ?>')",$this->content);
										
		$this->content = preg_replace ( "/\{$stag:(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)--\}/",
										"<?php echo \\1--; ?>", $this->content);	
		$this->content = preg_replace ( "/\{$stag:(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)++\}/",
										"<?php echo \\1++; ?>", $this->content);
		
		
		$this->content = preg_replace ( "/\{$stag:php:start\}/","<?php ", $this->content);
		$this->content = preg_replace ( "/\{$stag:php:$etag\}/"," ?>", $this->content);
		
			
		//全局变量标签
		$this->content = preg_replace ( "/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s", "<?php echo \\1; ?>", $this->content);
		
		
		//保留标签标签
		$this->content = preg_replace ( "/\{$stag:(\w+)\s+([^}]+)\}/ie", "self::pc_tag_html('$1','$2', '$0')", $this->content);
		$this->content = preg_replace ( "/\{$stag:(\w+):$etag\}/ie", "self::end_html_tag('$1','$0')",$this->content);
		
		
		//模块调用标签		
		//$this->content = preg_replace ( "/\{$stag:m=(\w+) mod=[\"|\'](\w+)[\"|\']([^}]+)\}/ie", "self::pc_module_tag('$1','$2', '$3')", $this->content);		
		$this->content = preg_replace ( "/\{$stag:m=(\w+\.\w+) mod=(\w+\((.*)\))([^}]*)\}/ie", "self::pc_module_tag('$1','$2','$3','$4')", $this->content);
			
		$this->content = preg_replace ( "/\{$stag:m=(\w+):$etag\}/ie", "self::end_module_tag('$1','$0')",$this->content);		
		$this->content='<?php defined(\'G_IN_SYSTEM\')or exit(\'No permission resources.\'); ?>'.$this->content;
		
	}
	
	
	/**
	*	模块标签解析
	*	@op 	调用的模块model
	*	@mod	操作的model模块函数
    *   @htmls  附加参数	
	*/
	private static function pc_module_tag($op,$mod,$key,$htmls) {
			/*
				{wc:m=member.member_dd mod=xxxx("1")}
			*/		
			$mod = stripslashes($mod);
			$htmls = stripslashes($htmls);
			$op = explode(".",$op);
			$module = $op[0];
			$model = $op[1];
			$module_file = "mod_".$op[0]."_".$op[1];			
			$html=<<<HTML
			<?php \$$module_file = System::load_app_model('$model','$module');\$datas = \$$module_file->$mod; ?>	
HTML;
			return $html;
			
	}
	
	
	/*
	private static function pc_module_tag($op,$data,$htmls) {	
	
			preg_match_all("/[\"|\'](.*)[\"|\']/i", stripslashes($htmls),$matches,PREG_SET_ORDER);				
			$htmls=$matches[0][0];
			$htmls=str_ireplace(" ","",$htmls);	
			$htmls=trim($htmls,',');
			preg_match_all("/return:(\w+)[\"|\']/i", $htmls,$return,PREG_SET_ORDER);			
			if(isset($return[0][1])){
				$return='$'.$return[0][1];				
			}else{
				$return='$data';
			}			
			$html=<<<HTML
			<?php \$get_$op = System::load_app_model('get_$op','$op');$return = \$get_$op->$data($htmls); ?>	
HTML;
			
			return $html;
	}
	*/
	
	private static function end_module_tag($op,$htmls) {		
		$op=trim($op);	
		return '';
	}
	
	/**
	 * 解析系统保留标签
	 * @param string $op 操作方式
	 * @param string $data 参数
	 * @param string $html 匹配到的所有的HTML代码
	 */
	private static function pc_tag_html($op,$data,$htmls) {
	
		static $display=array("get"=>false,"page"=>false);
		$oparr=array('getpage','getlist','getcount','getone','htmlcache','block');
		$modarr=array('sql','cache','mod','name','return','num','page','type','pageurl','key','func');	
		$datas = array();		
		$op=trim($op);
		$html='';
		
		preg_match_all("/([a-z]+)\=[\"]?([^\"]+)[\"]?/i", stripslashes($data),$matches,PREG_SET_ORDER);	
		
		foreach($matches as $v){
			$datas[$v[1]] = $v[2];
			if(in_array($v[1],$modarr)) {
				$$v[1] = $v[2];
				continue;
			}
		}
		
	
		$datas['mod']=$mod=isset($mod) && trim($mod) ? trim($mod) : 'get';
		$datas['sql']=$sql=isset($sql) && trim($sql) ? trim($sql) : '';		
		$datas['num']=$num=isset($num) ? intval($num) : 20;
		if($num<=0){$datas['num']=$num=20;}			
		
		//$datas['page']=$page=isset($page) ? $page : '$_GET[\'p\']';			
		//$datas['pageurl']=$pageurl=isset($pageurl) ? $pageurl : 0;
		
		$datas['page']=$page='$_GET[\'p\']';			
		$datas['pageurl']=$pageurl=0;
		$datas['key']=$key=isset($key) ? trim($key) : "''";
		
		$datas['cache']=$cache = isset($cache) && intval($cache) ? intval($cache) : 0;
		$datas['return']=$return = isset($return) && trim($return) ? trim($return) : 'data';
		$datas['name']=$name = isset($name) && trim($name) ? trim($name) : 0;
		$datas['type']=$type = isset($type) ? trim($type) : 1;
		
		if(!in_array($type,array('MYSQL_ASSOC','MYSQL_NUM','MYSQL_BOTH'))){
			$type=1;
		}		
		if(!in_array($op,$oparr)){
			return stripslashes($htmls);
		}
		switch($op){			
			case 'getlist':		
				if(empty($sql)){return stripslashes($htmls);}		
				$html.='<?php '.'$'.$return.'='.'$this->DB()->GetList("'.$sql.'",array("type"=>'.$type.',"key"=>'.$key.',"cache"=>'.$cache.')); ?>';
				break;
			case 'getpage':
				if(empty($sql)){return stripslashes($htmls);}
				$html.='<?php $num='.$num.';$total=$this->DB()->GetCount("'.$sql.'"); ?>';		
				$html.='<?php $page=System::load_sys_class(\'page\');if(isset('.$page.')){$pagenum='.$page.';}else{$pagenum=1;} $page->config($total,$num,$pagenum,"'.$pageurl.'"); ?>';	
				$html.='<?php '.'$'.$return.'='.'$this->DB()->GetPage("'.$sql.'",array("num"=>$num,"page"=>$pagenum,"type"=>'.$type.',"key"=>'.$key.',"cache"=>'.$cache.')); ?>';
				break;
			case 'getone':
				if(empty($sql)){return stripslashes($htmls);}
				$html.='<?php $mysql_model=System::load_sys_class(\'model\'); ?>';
				$html.='<?php '.'$'.$return.'='.'$this->DB()->GetOne("'.$sql.'",array("cache"=>'.$cache.')); ?>';
			break;	
			case 'block':
				$html = "<?php echo include '".G_CACHES."caches_codes/tag.{$name}.php'; ?>";
			break;
		}
		return $html;
		
	}
	private static function end_html_tag($op,$htmls) {		
		$op=trim($op);
		$oparr=array('getpage','getlist','getcount','getone','htmlcache','block');
		if(!in_array($op,$oparr)){
			return stripslashes($htmls);	
		}	
		return '<?php if(defined(\'G_IN_ADMIN\')) {echo \'<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>\';}?>';
	}
	
	
	
	/**
	 * 解析PC标签
	 * @param string $op 操作方式
	 * @param string $data 参数
	 * @param string $html 匹配到的所有的HTML代码
	 */
	private static function pc_tag($op,$data,$html) {
		static $display=array("op"=>false,"page"=>false);		
		$datas = array();
		$html = '';
	    $modarr=array("mod","sql","page","cache","return","one");
		preg_match_all("/([a-z]+)\=[\"]?([^\"]+)[\"]?/i", stripslashes($data),$matches,PREG_SET_ORDER);		
		foreach($matches as $v){
			$datas[$v[1]] = $v[2];
			if(in_array($v[1],$modarr)) {
				$$v[1] = $v[2];
				continue;				 
			}
		}	

		$CacheTime=System::load_sys_config("system","cache");		
		$datas['mod']=$mod=isset($mod) && trim($mod) ? trim($mod) : 'get';
		$datas['sql']=$sql=isset($sql) && trim($sql) ? trim($sql) : '';		
		$datas['page']=$page=isset($page) ? true : false;
		$datas['cache']=$cache = isset($cache) && intval($cache) ? intval($cache) : intval($CacheTime);
		$datas['return']=$return = isset($return) && trim($return) ? trim($return) : 'data';
		$datas['one']=$one = isset($one) && trim($one) ? true : false;
	
	
		if(!file_exists(G_SYSTEM.'model'.
					   DIRECTORY_SEPARATOR.$op.'_tag.class.php')){
			exit('Model File Error:'.' File Not Found');
		}

		if(($page) && !($display['page'])){		
			$display['page']=true;
			$html.='<?php $page=System::load_sys_class("page"); ?>';
		}	
		$html.='<?php ';	
		if(($op) && !($display['op'])){		
			$display['op']=true;
			$html.='$'.$op.'_tag';
			$html.='=System::load_app_model("'.$op.'_tag");';		
		}
		if($op){		
			$html.='if(method_exists($'.$op.'_tag,"'.$mod.'")){';
			$html.='$'.$return.'=$'.$op.'_tag->'.$mod.'('.self::arr_to_html($datas).');} ?>';
		}
		return $html;
		
	}
	
	
	/**
	 * PC标签结束
	 */
	private static function end_pc_tag() {
		return '<?php if(defined(\'G_IN_ADMIN\')) {echo \'<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>\';}?>';
	}
	/**
	 * 转义 // 为 /
	 * @param $var	转义的字符
	 * @return 转义后的字符
	 */
	public function addquote($var) {
		return str_replace ( "\\\"", "\"", preg_replace ( "/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']",$var));
	}
	
		/**
	 * 转换数据为HTML代码
	 * @param array $data 数组
	 */
	private static function arr_to_html($data) {
		if (is_array($data)) {
			$str = 'array(';
			foreach ($data as $key=>$val) {
				if (is_array($val)) {
					$str .= "'$key'=>".self::arr_to_html($val).",";
				} else {		
					if (strpos($val, '$')===0) {
						$str .= "'$key'=>$val,";
					} else {
						if($key=='sql'){
							$str .= "'$key'=>".'"'.$val.'",';
						}else{
							$str .= "'$key'=>'".new_addslashes($val)."',";
						}
					}
					
				}
			}
			return $str.')';
		}
		return false;
	}
}

?>