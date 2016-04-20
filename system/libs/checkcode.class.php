<?php

/*
	生成验证码类
*/

class checkcode {
	static $width=120;
	static $height=40;
	static $code_len=4;
	static $code;
	static $res_img;
	
	//得到图片
	public static function checkcode_init($width='',$height='',$len=4){
		if($width&&$height){
			self::$width=$width;
			self::$height=$height;
		}
		self::$code_len=$len;
		self::set_code();	
		self::set_img();
		self::set_font();
		self::output_img();	
	}
	
	//得到图片
	private static function set_img(){
		self::$res_img=imagecreatetruecolor(self::$width,self::$height);
		$color_bg=imagecolorallocate(self::$res_img,255,255,255);		
		//填充图片
		imagefilledrectangle(self::$res_img,0,self::$height,self::$width,0,$color_bg);
	
	}
	//设置验证码
	private static function set_code(){
		self::$code=substr(md5(time()),0,self::$code_len);
	}
	//外部得到验证码
	public static function get_code(){		
		return md5(self::$code);
	}
	
	//设置文字
	private static function set_font(){
		$x = self::$width/(self::$code_len);
		$color_qg=imagecolorallocate(self::$res_img,mt_rand(0,255), rand(0,255), rand(0,255));
		//imagestring(self::$res_img,6,10,10,'ABVFD',$color_qg);	//写一串字符，不能写中文		
		imagettftext(self::$res_img,20,rand(-20,20),5,self::$height/1.1,$color_qg,LIBS."GrinchedRegular.ttf",self::$code[0]);
		for($i=1;$i!=self::$code_len;$i++){
			imagettftext(self::$res_img,20,rand(-20,20),$x*$i,self::$height/1.1,$color_qg,LIBS."GrinchedRegular.ttf",self::$code[$i]);	
		}
	}
	private static function output_img() {
		header("content-type:image/png\r\n");
		imagepng(self::$res_img);
		imagedestroy(self::$res_img);				
	}
}
//checkcode::CheckCode_init(120,40,4);
?>