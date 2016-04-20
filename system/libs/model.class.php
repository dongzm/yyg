<?php
/**
 * model.class.php	基础数据操作类
 *
 * @copyright			(C) 2005-2010 BUSY
 * @license				
 * @lastmodify			2012-6-1
 */

class model {
	//数据库配置
	protected $db_config = '';
	//数据库连接
	protected $db = '';
	//调用数据库的配置项
	protected $db_setting = 'default';
	//数据表名
	protected $tablename = '';
	//表前缀
	public  static $db_tablepre = '';	
	public  static $strtablepre = '';	
	public $Autocommit = '';
	public $sql_log = array();
	
	public function __construct() {
		
		if(empty($this->db_config)){
			$this->db_config = System::load_sys_config('database');
		}
		if (!isset($this->db_config[$this->db_setting])) {	
			$this->db_setting = 'default';
		}
		$DBTYPE = $this->db_config[$this->db_setting]['type'];
		
		System::load_sys_class($DBTYPE,'sys','no');	
		self::$strtablepre=System::load_sys_config('system','tablepre');
		self::$strtablepre=base64_decode(self::$strtablepre);
		self::$db_tablepre = $this->db_config[$this->db_setting]['tablepre'];
		$this->table_name=$this->db_config[$this->db_setting]['database'];
		//PHP5.2
		$this->db = call_user_func_array("$DBTYPE::GetObject", array($this->db_config[$this->db_setting]));
		//PHP5.3
		//$this->db = $DBTYPE::GetObject($this->db_config[$this->db_setting]);
		
		
	}
	

	
	//获取数据列表
	final public function GetList($sql,$info=array('type'=>1,'key'=>'')){
		if(empty($sql))return false;
		if(!is_array($info))return false;		
		$sql=self::replacesql($sql);
		$this->db->execute($sql);
		$type=isset($info['type']) ? $info['type'] : 1;
		$key=isset($info['key']) ? $info['key'] : '';		
		return $this->db->get_fetch_type($type,$key);
	
	}
	
	//获取单条数据
	final public function GetOne($sql,$info=array('type'=>1)){	
		
		if(empty($sql))return false;
		if(!is_array($info))return false;	
		$type=isset($info['type']) ? $info['type'] : 1;
		$sql=self::replacesql($sql);	
		return $this->db->get_one($this->db->execute($sql),$type);		
	}	
	
	//获取分页数据
	final public function GetPage($sql,$info=array('type'=>1,'key'=>'')){
		if(empty($sql))return false;
		if(!is_array($info))return false;		
		$page=intval($info['page']) ? intval($info['page']) : 1;
		if($page<=0){$page=1;}
		$sql=self::replacesql($sql);
		$num=(!empty($info['num'])) ? intval($info['num']) : 20;		
		$sql=str_ireplace('limit','limit',$sql);
		$sql=explode('limit',$sql);
		$sql=trim($sql[0]);		
		$limit=" LIMIT ".($page-1)*$num.",".$num;
		$sql=$sql.$limit;			
		$this->db->execute($sql);
		$type=isset($info['type']) ? $info['type'] : 1;
		$key=isset($info['key']) ? $info['key'] : '';	
		return $this->db->get_fetch_type($type,$key);
	}
	//获取数据总数1
	final public function GetCount($sql){	
		if(empty($sql))return false;		
		$sql=self::replacesql($sql);
		$sql = preg_replace ("/^SELECT (.*) FROM/i", "SELECT COUNT(*) FROM",$sql);		
		$lastresult=$this->db->execute($sql);
		return $this->db->num_count($lastresult);
	}
	//获取数据总数2
	final public function GetNum($sql){
		if(empty($sql))return false;
		$sql=self::replacesql($sql);
		$lastresult=$this->db->execute($sql);
		return $this->db->num_rows($lastresult);
	}


	
	final static private function replacesql($sql){		
		static $sqllist=array();		
		$key=md5($sql);
		if(isset($sqllist[$key])){
			return $sqllist[$key];
		}
		$sqllist[$key]=str_ireplace(self::$strtablepre,self::$db_tablepre,trim($sql));
		$sqllist[$key]=preg_replace("/\s(?=\s)/","\\1",$sqllist[$key]);
		return $sqllist[$key];
	} 
	
	
	//返回查询资源结果集
	public function Query($sql){
		if(empty($sql))return false;
		$sql=self::replacesql($sql);
		$this->db->execute($sql);	
		if(defined("G_IN_ADMIN")){
			preg_match("/^UPDATE|^DELETE/i",$sql,$matches,PREG_OFFSET_CAPTURE);
			if(isset($matches[0][0])){
				$this->sql_log[] = $sql;
			}
		}
		return $this->db->lastresult;
	}
	
	//返回插入最后一次的ID
	public function insert_id(){	
		return $this->db->insert_id();
	}
	
	//影响的行数
	final public function affected_rows($link=null){		
		return $this->db->affected_rows();		
	}
	/*
	*	bool 为真,返回段版本号
	*/
	public function GetVersion($bool=false){
		return $this->db->GetVersion($bool);
	}
	
	public function __destruct(){
		//mysql_close();
	}
	/**
	 *
	 *	组合查询条件  and   参数键值对数组  返回 拼接后字符串
	 *	@where  array  
	 *	@return  string
	**/
	public function sql_and($where){
		if(empty($where))return fasle;
		if(!is_array($where)){ return false; }
		$str = '';
		foreach($where as $k=>$v){
			$str .= "`".$k."`"." = "."'".$v."'"." and ";			
		}
		return rtrim($str," and ");

	}
	/**
	 *
	 *	组合查询条件  or  参数键值对数组  返回 拼接后字符串
	 *	@where  array    
	 *	@return  string
	**/
	public function sql_or($where){
		if(empty($where))return fasle;
		if(!is_array($where)){ return false; }
		$str = '';
		foreach($where as $k=>$v){
			$str .= "`".$k."`"." = "."'".$v."'"." or ";			
		}
		return rtrim($str," or ");
	}



	final public function Autocommit_off(){		
		$this->Query('SET AUTOCOMMIT=1');
	}
	final public function Autocommit_no(){		
		$this->Query('SET AUTOCOMMIT=0');
	}	
	//开启事务
	final public function Autocommit_start(){		
		$this->Query('START TRANSACTION');
		$this->Autocommit = 'start';
	}
	//成功执行
	final public function Autocommit_commit(){		
		$this->Query('COMMIT');
		$this->Autocommit = 'commit';
	}	
	//回滚事务
	final public function Autocommit_rollback(){
		$this->Query('ROLLBACK');
		$this->Autocommit = 'rollback';
	}

}
?>