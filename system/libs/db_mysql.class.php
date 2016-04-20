<?php 

/**
 *  mysql.class.php 数据库实现类
 *
 * @copyright			(C) 2005-2010 BUSY
 * @license				
 * @lastmodify			2012-6-1
 */

final class db_mysql {

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
	
	
	private function mysql($configs){
		$this->config=$configs;
		$this->connect();	
	}	
	
	private function __clone(){
	}
	
	private function connect(){

		$func = $this->config['pconnect'] == 1 ? 'mysql_pconnect' : 'mysql_connect';
		if(!$this->link = $func($this->config['hostname'], $this->config['username'], $this->config['password'], 1)) {
			$this->DisplayError('Can not Connect to MySQL server',"hook_mysql_install");
		}		
		if($this->GetVersion(true) > '4.1') {
			$charset = isset($this->config['charset']) ? $this->config['charset'] : '';
			$serverset = $charset ? "character_set_connection='$charset',character_set_results='$charset',character_set_client=binary" : '';
			$serverset .= $this->GetVersion() > '5.0.1' ? ((empty($serverset) ? '' : ',')." sql_mode='' ") : '';
			$serverset && mysql_query("SET $serverset", $this->link);		
		}		
		if($this->config['database'] && !@mysql_select_db($this->config['database'], $this->link)) {
			$this->DisplayError('Cannot use database "'.$this->config['database'].'"');
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
		if (is_resource($this->link)) {
			@mysql_close($this->link);
		}
	}
	
	public function GetVersion($version=false) {
		if(!is_resource($this->link)) {
			$this->connect();
		}
		$mysql_version= mysql_get_server_info($this->link);
		$mysql_version = explode(".",trim($mysql_version));
		if($version){
			return $mysql_version[0].'.'.$mysql_version[1];
		}else{
			return $mysql_version[0].'.'.$mysql_version[1].'.'.$mysql_version[2];
		}

	}	
	public function GetError(){
		return @mysql_error($this->link);
	}
	public function GetErrno(){
		return intval(@mysql_errno($this->link));
	}
	
	/**
	 * 获取最后一次添加记录的主键号
	 * @return int 
	 */
	public function insert_id() {
		return mysql_insert_id($this->link);
	}
		
	
	/**
	 * 数据库查询执行方法
	 * @param $sql 要执行的sql语句
	 * @return 查询资源句柄
	 */
	public function execute($sql) {
		if(!is_resource($this->link)) {
			$this->Connect();
		}		
		$this->lastresult = mysql_query($sql,$this->link) or $this->displayerror($sql);
		$this->querycount++;
		return $this->lastresult;
	}	
	

	/**
	 * 释放查询资源
	 * @return void
	 */
	public function free_result() {
		if(is_resource($this->lastresult)) {
			mysql_free_result($this->lastresult);
			$this->lastresult = null;
		}
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
		while($r = mysql_fetch_assoc($this->lastresult)) {
			$tables[] = $r['Tables_in_'.$this->config['database']];
		}
		return $tables;
	}
	
	//数据总数查询，需要一个结果集
	public function num_rows($lastresult)
	{	
		return mysql_num_rows($lastresult);			
	}
	
	//数据总数查询
	
	public function num_count($lastresult){
		$data=$this->get_one($lastresult,MYSQL_NUM);
		return $data[0];
	}
	
	/**
	 * 获取最后数据库操作影响到的条数
	 * @return int
	 */
	 
	public function affected_rows(){
		return mysql_affected_rows($this->link);
	}
	
	/**
	 * 返回一条查询结果集
	 * $lastresult      外部的结果集，如果没有就调用内部的结果集
	 * @param $type		返回结果集类型	
	 * 					MYSQL_ASSOC，MYSQL_NUM 和 MYSQL_BOTH
	 * @return array
	 */
	final public function get_one($lastresult=null,$type=MYSQL_ASSOC){
		if(!$type)$type=MYSQL_ASSOC;
		if(is_resource($lastresult)){		
			$datalist=mysql_fetch_array($lastresult,$type);
			$this->free_result();
			return $datalist;
		}
		if(!is_resource($this->lastresult)){
			$this->free_result();
			return false;
		}		
		$datalist=mysql_fetch_array($this->lastresult,$type);
		$this->free_result();
		return $datalist;
		
	}
	
	/**
	 * 遍历查询结果集
	 * @param $type		返回结果集类型	
	 * 					MYSQL_ASSOC，MYSQL_NUM 和 MYSQL_BOTH
	 * @param $type		按照键名排序	
	 * @return array
	 */
	final public function &get_fetch_type($type=1,$key=''){		
	
		if(!is_resource($this->lastresult)){
			$this->free_result();
			return false;
		}			
		$datalist = $data = array();
		if(!$key){
			while($data=mysql_fetch_array($this->lastresult,$type)){				
				$datalist[]=$data;
			}	
		}else{
			while($data=mysql_fetch_array($this->lastresult,$type)){				
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