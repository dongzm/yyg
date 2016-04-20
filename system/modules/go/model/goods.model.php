<?php 

System::load_sys_class('model','sys','no');
class goods extends model {
	public function __construct() {		
		parent::__construct();
	}
	
	/*
		获取商品期数
		gid 	@商品ID
		order   @排序
		num     @显示数量
	*/
	public function get_qishu($gid=0,$order="DESC",$num=27){
		$info = $this->GetOne("SELECT sid FROM `@#_shoplist` WHERE `id` = '$gid' LIMIT 1");
		if(!$info){
			return '0';
		}
		$glist = $this->GetList("SELECT id,qishu FROM `@#_shoplist` WHERE `sid` = '$info[sid]' order by `qishu` $order LIMIT $num");
		return json_encode($glist);
	}
	
}