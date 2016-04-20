<?php 

defined('G_IN_SYSTEM')or exit('');
System::load_app_class('admin',G_ADMIN_DIR,'no');
class htmlcustom extends admin{

	public function __construct(){
		parent::__construct();
		if($this->checkchmod()){
			$this->AddNewFile();			
		}else{
			exit("caches/caches_codes 不可写");
		}
	
	}

	/* 标签列表 */
	public function lists(){	
		include  G_CACHES.'caches_codes/tag.sys.package.php';	
		if(empty($TAG))$TAG = array("没有任何标签"=>"...");		
		include $this->tpl(ROUTE_M,'htmlcustom.lists');
	}
	
	private function AddNewFile(){
		
		if(!file_exists(G_CACHES.'caches_codes/tag.sys.package.php')){
				file_put_contents(G_CACHES.'caches_codes/tag.package.php','<?php defined(\'G_IN_SYSTEM\') or exit(\'No permission resources.\'); $TAG = Array(); ?><?php ');
		}
	}
	
	
	/* 解析TAG变量 */
	private function TagParse($text=null){
		if(empty($text)) return "";
		/*解析的变量*/
		$tag = array(
			"{tag:time}" => '{$TAGVAL[\'time\']}'
		);
		$text = str_ireplace('$','\$',$text);
		foreach($tag as $key => $val){
			$text = str_ireplace($key,$val,$text);
		}		
		return $text;
	}
	
	
	/* 新建标签 */
	public function create(){
		/*新建*/
		if(isset($_POST['submit'])){	
			$tag_name = $_POST['tag_name'];
			$tag_val = $this->TagParse(stripslashes($_POST['tag_val']));		
			$tag_des = _strcut(htmlentities($_POST['tag_des'],ENT_NOQUOTES,"utf-8"),30);
		
			if(empty($tag_name)){
				_message("标签名不能为空");
			}
			$this->AddNewFile();
			include  G_CACHES.'caches_codes/tag.sys.package.php';
			$header = '<?php defined(\'G_IN_SYSTEM\') or exit(\'No permission resources.\'); $TAG = Array(); ?><?php '.PHP_EOL;
			$TAG[$tag_name] = $tag_des;
			$con = '$TAG = '.var_export($TAG,true);
			$end = ";".PHP_EOL;			
			$val1 = file_put_contents(G_CACHES.'caches_codes/tag.sys.package.php',$header.$con.$end);
			
		
			$str = "QWERTYUIOPLKJHGFDSAZXCVBNM";
			$qz = $str{rand(0,25)}.$str{rand(0,25)}.$str{rand(0,25)}.$str{rand(0,25)};
			$qz.= $str{rand(0,25)}.$str{rand(0,25)}.$str{rand(0,25)}.$str{rand(0,25)};		
			$header  = '<?php defined(\'G_IN_SYSTEM\') or exit(\'No permission resources.\'); ?>'.PHP_EOL;
			$header .= '<?php '."return <<<".$qz.PHP_EOL;
			$con = $tag_val;
			$end = PHP_EOL.$qz.";".PHP_EOL;			
			$val2 =  file_put_contents(G_CACHES.'caches_codes/tag.'.$tag_name.'.php',$header.$con.$end);

			if(gettype($val1)!='integer' || gettype($val2)!='integer'){
				_message("失败");
			}else{
				_message("完成",G_ADMIN_PATH."/htmlcustom/lists");
			}
			
		}		
				
		$this->checkchmod();
		if(empty($_POST)){		
			include $this->tpl(ROUTE_M,'htmlcustom.create');
		}
	}
	
	/* 编辑标签 */
	public function edit(){
		$upkey = $this->segment(4);
		include  G_CACHES.'caches_codes/tag.sys.package.php';
		if(!isset($TAG[$upkey])){
			_message("没有这个标签");
		}
		
		$TAG = array("key"=>$upkey,"des"=>$TAG[$upkey]);
		$TAG['content'] = htmlentities(include G_CACHES.'caches_codes/tag.'.$TAG['key'].'.php',ENT_NOQUOTES,"utf-8");			
		if(isset($_POST['submit'])){
			$this->create();	
		}

		if(empty($_POST)){		
			include $this->tpl(ROUTE_M,'htmlcustom.create');
		}
	}
	
	/* 删除标签 */
	public function del(){
		include  G_CACHES.'caches_codes/tag.sys.package.php';
		$key = isset($_POST['key']) ? $_POST['key'] : "";
		$key = empty($key) ? exit("no") : $key;
		
		$header = '<?php defined(\'G_IN_SYSTEM\') or exit(\'No permission resources.\'); $TAG = Array(); ?><?php '.PHP_EOL;
		if(isset($TAG[$key])){
			unset($TAG[$key]);
			
		}
		$con = '$TAG = '.var_export($TAG,true);
		$end = ";".PHP_EOL;
		$val = file_put_contents(G_CACHES.'caches_codes/tag.sys.package.php',$header.$con.$end);
		if(gettype($val)!='integer'){			
				exit("删除失败");
		}else{
				unlink(G_CACHES.'caches_codes/tag.'.$key.'.php');
				echo "yes";
		}		
	}
	

	/*文件或者目录权限检测*/
	private function checkchmod($file=null){
		if(empty($file)){
			$file = G_CACHES.'caches_codes';
		}
		if (is_dir($file)){
			$dir = $file;
			if ($fp = @fopen("$dir/test.txt", 'w')) {
				@fclose($fp);
				@unlink("$dir/test.txt");
				$writeable = 1;
			} else {
				$writeable = 0;
			}
		} else {
			if ($fp = @fopen($file, 'a+')) {
				@fclose($fp);
				$writeable = 1;
			} else {
				$writeable = 0;
			}
		}
		return $writeable;	
	}

}