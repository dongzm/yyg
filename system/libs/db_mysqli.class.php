<?php 

/**
 *  mysqli.class.php 数据库实现类
 *
 * @copyright			(C) 2005-2010 BUSY
 * @license				
 * @lastmodify			2012-6-1
 */
 
 /**
	修改了 model.class.php   mysql.class.php,  mysqli.class.php   database.inc.php 
 **/

final class db_mysqli {

	 /**
	  * 数据库配置信息
	  */
	 private $config;
	 
	 /**
	  * 数据库连接资源句柄
	  */
	 private $link;
	 
	 /**
	  *	最后一次查询的资源句柄
	  */
	 public $lastresult;
	 
	/**
	 *  统计数据库查询次数
	 */
	public $querycount = 0;
	
	/**
	 * 数据类实例
	 */
	static private $mysqlobj=array();
	 
	private function __construct($configs){
		
		$this->config=$configs;	
		$this->connect();	
	}
	
	public function __destruct(){	
		$this->close();
	}
	
	/* 兼容同名函数实例化*/
	/*
	private function db_mysqli($configs){
		$this->config=$configs;
		$this->connect();	
	}	
	*/
	private function __clone(){
	}
	
	private function connect(){

		$this->link = new mysqli($this->config['hostname'], $this->config['username'], $this->config['password'],$this->config['database']);
		if($this->GetErrno()){
			$this->DisplayError('Can not Connect to MySQL server',"hook_mysql_install");		
		}

		if($this->GetVersion(true) > '4.1') {
			$charset = isset($this->config['charset']) ? $this->config['charset'] : '';
			$serverset = $charset ? "character_set_connection='$charset',character_set_results='$charset',character_set_client=binary" : '';
			$serverset .= $this->GetVersion() > '5.0.1' ? ((empty($serverset) ? '' : ',')." sql_mode='' ") : '';
			$serverset && $this->link->query("SET $serverset");		
		}		
	}	
	public function DisplayError($message='',$hook=''){
		if(!empty($hook)){$hook($message);}
		if($this->config['debug']){
			$html ='<b>MySQL Error: </b>'.$this->GetError().'<br/>';
			$html.='<b>MySQL Errno: </b>'.$this->GetErrno().'<br/>';
			$html.='<b>MySQL Message: </b>'.$message;
			echo "<div style='border:1px dotted #ccc; padding:5px; font-size:12px; clear:both;width:100%;height:auto;'>".$html."</div>";
			return false;
		}else{
			return false;
		}	
	}
	
	

	final static public function GetObject($configs=array('hostname'=>'','database'=>'')){
			$db=$configs['hostname'].$configs['database'];		
			
			if(!isset(self::$mysqlobj[$db])){				
				if(!is_array($configs)){
					$this->DisplayError("The configuration file is not an array");
				}	
				$C=__CLASS__;					
				self::$mysqlobj[$db]=new $C($configs);				
			}
			return self::$mysqlobj[$db];
	}
	
	public function close() {
		$this->link->close();		
	}
	
	public function GetVersion($version=false) {
		
		$mysql_version= $this->link->server_info;
		$mysql_version = explode(".",trim($mysql_version));
		if($version){
			return $mysql_version[0].'.'.$mysql_version[1];
		}else{
			return $mysql_version[0].'.'.$mysql_version[1].'.'.$mysql_version[2];
		}

	}	
	
	public function GetError(){
		return $this->link->error;
	}
	public function GetErrno(){
		return $this->link->errno;
		//return $this->link->connect_errno;
	}
	
	/**
	 * 获取最后一次添加记录的主键号
	 * @return int 
	 */
	public function insert_id() {
		return $this->link->insert_id;
	}
		
	
	/**
	 * 数据库查询执行方法
	 * @param $sql 要执行的sql语句
	 * @return 查询资源句柄
	 */
	public function execute($sql) {
		$this->lastresult = $this->link->query($sql) or $this->displayerror($sql);		
		$this->querycount++;		
		return $this->lastresult;
	}	
	

	/**
	 * 释放查询资源
	 * @return void
	 */
	public function free_result() {	
		if($this->lastresult)$this->lastresult->free();	
	}
	
	/**
	 * 检查表是否存在
	 * @param $table 表名
	 * @return boolean
	 */
	public function table_exists($table) {
		$tables = $this->list_tables();
		return in_array($table, $tables) ? 1 : 0;
	}
	/*
	* 列表
	*/
	public function list_tables() {
		$tables = array();
		$this->execute("SHOW TABLES");	
		while($r = mysqli_fetch_assoc($this->lastresult)) {
			$tables[] = $r['Tables_in_'.$this->config['database']];
		}
		return $tables;
	}
	
	//数据总数查询，需要一个结果集
	public function num_rows($lastresult){	
		$lastresult->num_rows;	
	}
	
	//数据总数查询
	
	public function num_count($lastresult){
		$data=$this->get_one($lastresult,MYSQLI_NUM);
		return $data[0];
	}
	
	/**
	 * 获取最后数据库操作影响到的条数
	 * @return int
	 */
	 
	public function affected_rows(){
		return $this->link->affected_rows;
	}
	
	/**
	 * 返回一条查询结果集
	 * $lastresult      外部的结果集，如果没有就调用内部的结果集
	 * @param $type		返回结果集类型	
	 * 					MYSQL_ASSOC，MYSQL_NUM 和 MYSQL_BOTH
	 * @return array
	 */
	final public function get_one($lastresult=null,$type=1){
		if(!$type)$type=1;
		$type = intval($type);		
		if(gettype($lastresult) === "object"){
			$list =  $lastresult->fetch_array($type);
		}else{
			$list = $this->lastresult->fetch_array($type);			
		}
		$this->free_result();	
		return $list;
		
	}
	
	/**
	 * 遍历查询结果集
	 * @param $type		返回结果集类型	
	 * 					MYSQL_ASSOC，MYSQL_NUM 和 MYSQL_BOTH
	 * @param $type		按照键名排序	
	 * @return array
	 */
	final public function get_fetch_type($type=1,$key=''){		
	
		if(gettype($this->lastresult) !== "object"){
			$this->free_result();
			return false;
		}			
		$datalist = $data = array();
		if(!$key){
			while($data = $this->lastresult->fetch_array($type)){				
				$datalist[]=$data;
			}	
		}else{
			while($data = $this->lastresult->fetch_array($type)){				
					$datalist[$data[$key]]=$data;
			}
		}
		$this->free_result();
		return $datalist;
	}	

	

 	final public  function sqls($where, $font = ' AND ',$op='=') {
		if (is_array($where)) {
			$sql = '';
			foreach ($where as $key=>$val){
				$sql .= $sql ? " $font `$key` $op '$val' " : " `$key` $op '$val'";
			}
			return $sql;
		} else {
			return $where;
		}
	}
}