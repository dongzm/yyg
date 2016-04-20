<?php 


class checkcodeimg {
	
	private $width;
	private $height;
	private $color;
	private $bgcolor;
	private $lenght;
	private $type;		//1 数字, 2 字母,  3 混合, 4 汉字
	public $code;
	private $bgimg;
	
	public function config($width,$height,$color,$bgcolor,$lenght,$type){
		$this->width=!empty($width) ? intval($width) : 80;		
		$this->height=!empty($height) ? intval($height) : 30;
		$this->color=!empty($color) ? $color : 'ff6600';
		$this->bgcolor=!empty($bgcolor) ? $bgcolor : 'ffffff';
		$this->lenght=!empty($lenght) ? intval($lenght) : 6;
		$this->type=!empty($type) ? intval($type) : 3;
		$this->createimg();
	}
	
	private function createimg(){
		$this->bgimg=imagecreatetruecolor($this->width,$this->height);
		$R = hexdec(substr($this->bgcolor, 0, 2));
		$G = hexdec(substr($this->bgcolor, 2, 2));
		$B = hexdec(substr($this->bgcolor, 4));	
		$color_bg=imagecolorallocate($this->bgimg,$R,$G,$B);	
		
		$R = hexdec(substr($this->color, 0, 2));
		$G = hexdec(substr($this->color, 2, 2));
		$B = hexdec(substr($this->color,4));
		$color_qg=imagecolorallocate($this->bgimg,$R,$G,$B);		
		
		//填充图片
		imagefilledrectangle($this->bgimg,$this->width,$this->height,0,0,$color_bg);
		
		$font=dirname(__FILE__).'/arial.ttf';
		$this->getcode();
		$temp = imagettfbbox(15,0,$font,$this->code); //取得使用 TrueType 字体的文本的范围		
		$markwidth  = $temp[2] - $temp[6];
		$markheight = $temp[3] - $temp[7];
		//imagestring($bgimg,6,10,10,'ABVFD',$color_qg);
		imagettftext($this->bgimg,15,0,3,$markheight+6,$color_qg,$font,$this->code);		
		
	}
	public function image(){	
		header("content-type:image/png\r\n");
		imagepng($this->bgimg);
		imagedestroy($this->bgimg);
	}
	
	public function dian($num=10,$color){
		if(empty($color))$color=$this->color;
		$R = hexdec(substr($color, 0, 2));
		$G = hexdec(substr($color, 2, 2));
		$B = hexdec(substr($color,4));
		$color=imagecolorallocate($this->bgimg,$R,$G,$B);
		for($i=0;$i<$num;$i++){
			imagesetpixel($this->bgimg,rand(0,$this->width),rand(0,$this->height),$color);
		}
	}
	private function getcode(){
		switch($this->type){
			case 1:	//数字
				$this->code='';
				for($i=0;$i<$this->lenght;$i++){
					$this->code.=rand(0,9);
				}			
			break;
			case 2:	//字母
				$this->code='';
				$str='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				for($i=0;$i<$this->lenght;$i++){
					$this->code.=$str{rand(0,9)};
				}
			break;
			case 3:	//数字与字母
				$this->code=substr(md5(time()),0,$this->lenght);
				$this->code=strtoupper($this->code);
			break;
			case 4:	//汉字,字体太大的问题暂不支持
				$this->code=substr(md5(time()),0,$this->lenght);
				$this->code=strtoupper($this->code);
			break;
			default://默认
				$this->code='';
				$str='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				for($i=0;$i<$this->lenght;$i++){
					$this->code.=$str{rand(0,9)};
				}
			break;
		}
		
		return $this->code;
	
	}

}

?>