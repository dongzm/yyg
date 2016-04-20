<?php 
System::load_sys_class('model','sys','no');
class category_model extends model {

	public function __construct() {		
		parent::__construct();
	}
	
	public function addcategory($sql=''){
		
		//MYSQL 事务代码
		mysql_query('SET AUTOCOMMIT=0');
		mysql_query("START TRANSACTION");	//开启事务	
		$que=true;
		
		
		
		
		mysql_query("ROLLBACK");//失败回滚
		mysql_query('SET AUTOCOMMIT=1');
		return false;
	
	}
}

?>