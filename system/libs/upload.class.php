<?php

//上传类 与 图片处理类


class upload {
	static private $uptype = null;		//可以上传的类型
	static public $filedir 	= null;		//上传后的文件夹
	static public $uploadpath = null; 	//上传的文件路径
	static public $filesize = null;		//可以上传的文件大小	
	static public $filename = null;		//成功后的文件名
	static public $files = null;		//要上传的数据
	static public $error = null; 		//错误信息
	static public $ok = null; 			//上传成功还是失败
	
	//设置上传配置参数
	static public function upload_config($type=null,$size=null,$uploadpath=null){
		if(empty($uploadpath)){
			self::$uploadpath=G_UPLOAD;
		}else{
			self::$uploadpath=G_UPLOAD.$uploadpath.'/';
		}
		self::$uptype = (!empty($type)) ? $type : System::load_sys_config('upload','uptype');
		self::$filesize=(!empty($size)) ? $size : System::load_sys_config('upload','upsize');
			
	}

	/**
	*	上传
	*	file 	   @上传的文件
	*	watermark  @加水印 为false是按照配置文件默认
	**/
	static public function go_upload($file,$watermark=false){	
			if(!$file){self::$ok=0;return false;};
			if(!self::$uptype){self::upload_config();}
			self::$files=$file;
			if(!self::set_error()){				
				self::$ok=0;
				return false;
			}
			
			$filetype=explode('.',self::$files['name']);		
			$filetype=strtolower(array_pop($filetype));
			
			$filetype=trim($filetype,";");
			if($filetype == 'php' || $filetype == 'asp' || $filetype == 'jsp'){
				self::$error="注意:上传文件类型不正确!";
				self::$ok=0;		
				return self::$ok;
			}
			
			if($filetype=='jpeg')$filetype='jpg';
			if(in_array($filetype,self::$uptype)){

				if(is_uploaded_file(self::$files['tmp_name'])){	
					
						self::$filedir=date("Ymd");
						self::$uploadpath=self::$uploadpath.self::$filedir.'/';
						if(!is_dir(self::$uploadpath)){
						 if(!mkdir(self::$uploadpath,0777)){
							self::$error="上传失败,请检查文件夹权限mkdir";
							self::$ok=0;
							return self::$ok;
						 }
						 if(!chmod(self::$uploadpath,0777)){
							self::$error="上传失败,请检查文件夹权限chmod";
							self::$ok=0;
							return self::$ok;
						 }						
						}
							
					
					$rand=rand(10,99).substr(microtime(),2,6).substr(time(),4,6);										
					self::$filename=$rand.".".$filetype;
					
					$error=move_uploaded_file(self::$files['tmp_name'],self::$uploadpath.self::$filename);
					if($error){
						self::$error="上传成功";
						self::$ok=1;	
						
						if(System::load_sys_config('upload','watermark_off')){						
							if($watermark == "yes"){
								self::watermark();
							}							
							if($watermark === false){
								self::watermark();
							}
						}						
						
					}else{
						self::$error="上传失败,请检查文件夹权限";
						self::$ok=0;
					}
					
				}else{
					self::$error="不是上传文件";
					self::$ok=0;
				}
			}else{
				self::$error="上传文件类型不正确";
				self::$ok=0;
			}
			
			return self::$ok;
	}
	
	
	//设置错误信息
	static private function set_error(){
		/*
			0——没有错误发生，文件上传成功。 
			1——上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。
			2——上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。 
			3——文件只有部分被上传。 
			4——没有文件被上传。  
		*/
		if(self::$files['size']>self::$filesize){
			self::$error="文件大小超过了允许上传大小";
			return false;
		}
		switch(self::$files['error']){
			case 0:
				self::$error="上传成功没有错误";
				return true;
				break;		
			case 1:
				self::$error="文件大小超过了ini大小";
				return false;
				break;
			case 2:
				self::$error="文件大小超过了HTML大小";
				return false;
				break;
			case 3:
				self::$error="文件只有部分被上传";
				return false;
				break;
			case 4:
				self::$error="文件没有被上传";
				return false;
				break;
			default:
				return false;
				break;			
		}
		return true;
			
	}
	
	
	//生成图片的缩略图，30*30,50*50,100*100
	//是否覆盖 0不覆盖 ，1覆盖
	//$path 外部指定文件
	public static function thumbs($width=null,$height=null,$fugai=false,$path=null,$point=null){

		if(empty($width))$width=50;
		if(empty($height))$height=50;
		$width = intval($width);
		$height = intval($height);
		
		if(!$path){
			$path=self::$uploadpath.self::$filename;
		}

		if(!file_exists($path)){
			return false;
		}
	
		$imgSize = GetImageSize($path);
		$houzhui = explode('.',$path);
		$houzhui = array_pop($houzhui);
        $imgType = $imgSize[2];
		
		if(!is_array($point)){
			$point = array("x"=>0,"y"=>0,"w"=>$imgSize[0],"h"=>$imgSize[1]);
		}

         switch ($imgType)
        {
            case 1:
                $srcImg = @ImageCreateFromGIF($path);
                break;
            case 2:
                $srcImg = @ImageCreateFromJpeg($path);
                break;
            case 3:
                $srcImg = @ImageCreateFromPNG($path);
                break;
			case 6:
				$srcImg = self::ImageCreateFromBMP($path);
                break;
			default:				
			;
        }
		
		//缩略图片资源
		$targetImg=ImageCreateTrueColor($width,$height);
		$white = ImageColorAllocate($targetImg, 255,255,255);        
		imagefill($targetImg,0,0,$white); // 从左上角开始填充背景
		ImageCopyResampled($targetImg,$srcImg,0,0,$point['x'],$point['y'],$width,$height,$point['w'],$point['h']);//缩放
		if($fugai){
			$tag_name = '';			
		}else{
			$tag_name = '_'.$width.$height.'.'.$houzhui;		
		}
		
		switch ($imgType) {
                case 1:
                    ImageGIF($targetImg,$path.$tag_name);
                    break;
                case 2:
                    ImageJpeg($targetImg,$path.$tag_name);
                    break;
                case 3:
                    ImagePNG($targetImg,$path.$tag_name);
                    break;
				default:
					ImageJpeg($targetImg,$path.$tag_name);
                    break;
				;
        }
            ImageDestroy($srcImg);
            ImageDestroy($targetImg);
		
		
		return $houzhui;	
		
	}
	
	//添加水印
	//$bgimg 背景图片
	//$type  水印类型
	//$content 附加参数,文本型水印是一个数组
	//$minsize 添加水印图片的宽高条件
	//$pos     水印位置
	static public function watermark($bgimg=null,$type=null,$content=null,$minsize=null,$pos=null){
		$bgimg = !empty($bgimg) ? $bgimg : self::$uploadpath.self::$filename;
		$type= !empty($type) ? $type : System::load_sys_config('upload','watermark_type');
		$minsize= !empty($minsize) ? $minsize : System::load_sys_config('upload','watermark_condition');
		$pos= !empty($pos) ? $pos : System::load_sys_config('upload','watermark_position');
		
		if(file_exists(!$bgimg)){
			return false;
		}
				
		//获得背景图片
		$bgimg_info   = getimagesize($bgimg);
		list($bg_width,$bg_height) = $bgimg_info;
		
		switch($bgimg_info[2])
		{
			case 1:
				$from_bgimg = imagecreatefromgif($bgimg);
				break;
			case 2:
				$from_bgimg = imagecreatefromjpeg($bgimg);
				break;
			case 3:
				$from_bgimg = imagecreatefrompng($bgimg);
				break;
			case 4:
				$from_bgimg = self::ImageCreateFromBMP($bgimg);//imagecreatefromwbmp
				break;
			default:
				break;
		}
		
		if($bg_width<$minsize['width'] || $bg_height<$minsize['height']){
			//背景图尺寸不够
			return false;
		}
		
		
		//设定图像的混色模式		
		imagealphablending($from_bgimg,true);

		
		//文字水印
		if($type=='text'){
			if(!is_array($content))$content=System::load_sys_config('upload','watermark_text');		
			$content['text'] = iconv("utf-8","utf-8",$content['text']);
			$temp = imagettfbbox($content['size'], 0, $content['font'], $content['text']); //取得使用 TrueType 字体的文本的范围		
			$markwidth  = $temp[2] - $temp[6];
			$markheight = $temp[3] - $temp[7];
			unset($temp);//释放内存			
			switch($pos){				
				case 'lt':	//左上
					$pos_x = 10;
					$pos_y = $markheight;
				break;
				case 't':	//上
					$pos_x = ($bg_width-$markwidth)/2;	
					$pos_y = $markheight;
				break;
				case 'rt':	//右上
					$pos_x = ($bg_width-$markwidth)-10;	
					$pos_y = $markheight;
				break;
				case 'r':	//右
					$pos_x = ($bg_width-$markwidth)-10;
					$pos_y = ($bg_height+($markheight / 2))/2;
				break;
				case 'rb':	//右下
					$pos_x = $bg_width-$markwidth-10;
					$pos_y = $bg_height-10;
				break;
				case 'b':	//下
					$pos_x = ($bg_width-$markwidth)/2;
					$pos_y = $bg_height-10;
				break;
				case 'lb':	//左下
					$pos_x = 10;
					$pos_y = ($bg_height-$markheight)-10;
				break;
				case 'l':	//左
					$pos_x = 10;
					$pos_y = ($bg_height+($markheight / 2))/2;
				break;
				case 'c':	//中
					$pos_x = ($bg_width-$markwidth)/2;	
					$pos_y = ($bg_height+($markheight / 2))/2;
				break;
				case 's':	//随机
					$pos_x = rand(0,($bg_width - $markwidth - 10));
					$pos_y = rand($markheight,($bg_height - 10));
				break;
				default://默认随机
					$pos_x = rand(0,($bg_width - $markwidth - 10));
					$pos_y = rand($markheight,($bg_height - 10));
					break; 
			}
			
			//转换编码防止中文乱码
			//$content['text'] = mb_convert_encoding($content['text'], 'UTF-8', 'GB2312');
			//获取水印文字颜色
			if(!empty($content['color']) && (strlen($content['color']) == 7))
			{
				$R = hexdec(substr($content['color'], 1, 2));
				$G = hexdec(substr($content['color'], 3, 2));
				$B = hexdec(substr($content['color'], 5));
			}
			else if(!empty($content['color']) && (strlen($content['color']) == 3))
			{
				$R = hexdec(substr($content['color'], 1, 1));
				$G = hexdec(substr($content['color'], 2, 2));
				$B = hexdec(substr($content['color'], 3, 3));
			}
			else
			{
				$R = '00';
				$G = '00';
				$B = '00';
			}
			//把生成的文字区域写入到图片文件里		
			$color_qg=imagecolorallocate($from_bgimg,$R, $G, $B);
			imagettftext($from_bgimg, $content['size'], 0 , $pos_x, $pos_y,$color_qg,$content['font'],$content['text']);
		}
		
		
		if($type=='image'){
			if(empty($content))$content=G_UPLOAD.System::load_sys_config('upload','watermark_image');
			$markimg_info   = getimagesize($content);
			list($markwidth,$markheight) = $markimg_info;
			
			switch($markimg_info[2])
			{
				case 1:
					$from_markimg = imagecreatefromgif($content);
					break;
				case 2:
					$from_markimg = imagecreatefromjpeg($content);
					break;
				case 3:
					$from_markimg = imagecreatefrompng($content);
					break;
				case 4:
					$from_markimg = self::ImageCreateFromBMP($content);//imagecreatefromwbmp
					break;
				default:
					break;
			}		
			switch($pos){				
				case 'lt':	//左上
					$pos_x = 0;
					$pos_y = 0;
				break;
				case 't':	//上
					$pos_x = ($bg_width-$markwidth)/2;	
					$pos_y = 0;
				break;
				case 'rt':	//右上
					$pos_x = $bg_width-$markwidth;	
					$pos_y = 0;
				break;
				case 'r':	//右
					$pos_x = $bg_width-$markwidth;
					$pos_y = ($bg_height-$markheight)/2;
				break;
				case 'rb':	//右下
					$pos_x = $bg_width-$markwidth;
					$pos_y = $bg_height-$markheight;
				break;
				case 'b':	//下
					$pos_x = ($bg_width-$markwidth)/2;
					$pos_y = $bg_height-$markheight;
				break;
				case 'lb':	//左下
					$pos_x = 0;
					$pos_y = $bg_height-$markheight;
				break;
				case 'l':	//左
					$pos_x = 0;
					$pos_y = ($bg_height-$markheight)/2;
				break;
				case 'c':	//中
					$pos_x = ($bg_width-$markwidth)/2;	
					$pos_y = ($bg_height-$markheight)/2;
				break;
				case 's':	//随机
					$pos_x = rand(0,($bg_width - $markwidth));
					$pos_y = rand(0,($bg_height-$markheight));
				break;
				default://默认随机
					$pos_x = rand(0,($bg_width - $markwidth));
					$pos_y = rand(0,($bg_height-$markheight));
					break; 
			}
			//imagecopymerge可以设置透明度，但是不支持透明图片
			imagecopy($from_bgimg, $from_markimg, $pos_x, $pos_y, 0, 0, $markwidth, $markheight); //拷贝水印到目标文件
		}
		
	
		//取得背景图片的格式
		switch($bgimg_info[2])
		{
			case 1:
				//header('Content-type: image/gif');
				imagegif($from_bgimg, $bgimg); //第三个参数为生成带水印的图像质量 100 为最高
				break;
			case 2:
				//header('Content-type: image/jpeg');
				imagejpeg($from_bgimg, $bgimg, 100);
				break;
			case 3:
				//header('Content-type: image/png');
				imagepng($from_bgimg, $bgimg);
				break;
			case 4:
				//header('Content-type: image/vnd.wap.wbmp');
				imagewbmp($from_bgimg, $bgimg);
				break;
			default:
				break;
		}
		imagedestroy($from_bgimg);	
		return $bgimg;		
		
	}
	
	//BMP图片解析
	static private function ImageCreateFromBMP($filename=null){
		if (!$f1 = fopen( $filename, "rb" ))
			return FALSE;
		
		$FILE = unpack( "vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread( $f1, 14 ) );
		if ( $FILE['file_type'] != 19778 )
			return FALSE;
		
		$BMP = unpack( 'Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel' . '/Vcompression/Vsize_bitmap/Vhoriz_resolution' . '/Vvert_resolution/Vcolors_used/Vcolors_important', fread( $f1, 40 ) );
		$BMP['colors'] = pow( 2, $BMP['bits_per_pixel'] );
		if ( $BMP['size_bitmap'] == 0 )
			$BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];
		$BMP['bytes_per_pixel'] = $BMP['bits_per_pixel'] / 8;
		$BMP['bytes_per_pixel2'] = ceil( $BMP['bytes_per_pixel'] );
		$BMP['decal'] = ($BMP['width'] * $BMP['bytes_per_pixel'] / 4);
		$BMP['decal'] -= floor( $BMP['width'] * $BMP['bytes_per_pixel'] / 4 );
		$BMP['decal'] = 4 - (4 * $BMP['decal']);
		if ( $BMP['decal'] == 4 )
			$BMP['decal'] = 0;
		
		$PALETTE = array();
		if ( $BMP['colors'] < 16777216 ){
			$PALETTE = unpack('V'.$BMP['colors'],fread( $f1,$BMP['colors'] * 4 ) );
		}
		
		$IMG = fread( $f1, $BMP['size_bitmap'] );
		$VIDE = chr(0);
		
		$res = imagecreatetruecolor( $BMP['width'], $BMP['height'] );
		$P = 0;
		$Y = $BMP['height'] - 1;
		while( $Y >= 0 ){
			$X = 0;
			while( $X < $BMP['width'] ){
				if ( $BMP['bits_per_pixel'] == 32 ){
					$COLOR = unpack( "V", substr( $IMG,$P,3));
					$B = ord(substr($IMG, $P,1));
					$G = ord(substr($IMG, $P+1,1));
					$R = ord(substr($IMG, $P+2,1));
					$color = imagecolorexact( $res, $R, $G, $B );
					if ( $color == -1 )
						$color = imagecolorallocate( $res, $R, $G, $B );
					$COLOR[0] = $R*256*256+$G*256+$B;
					$COLOR[1] = $color;
				}elseif ( $BMP['bits_per_pixel'] == 24 )
					$COLOR = unpack( "V", substr( $IMG, $P, 3 ) . $VIDE );
				elseif ( $BMP['bits_per_pixel'] == 16 ){
					$COLOR = unpack( "n", substr( $IMG, $P, 2 ) );
					$COLOR[1] = $PALETTE[$COLOR[1] + 1];
				}elseif ( $BMP['bits_per_pixel'] == 8 ){
					$COLOR = unpack( "n", $VIDE . substr( $IMG, $P, 1 ) );
					$COLOR[1] = $PALETTE[$COLOR[1] + 1];
				}elseif ( $BMP['bits_per_pixel'] == 4 ){
					$COLOR = unpack("n",$VIDE . substr($IMG, floor( $P ),1));
					if ( ($P * 2) % 2 == 0 )
						$COLOR[1] = ($COLOR[1] >> 4);
					else
						$COLOR[1] = ($COLOR[1] & 0x0F);
					$COLOR[1] = $PALETTE[$COLOR[1] + 1];
				}elseif ( $BMP['bits_per_pixel'] == 1 ){
					$COLOR = unpack( "n", $VIDE . substr( $IMG, floor( $P ), 1 ) );
					if ( ($P * 8) % 8 == 0 )
						$COLOR[1] = $COLOR[1] >> 7;
					elseif ( ($P * 8) % 8 == 1 )
						$COLOR[1] = ($COLOR[1] & 0x40) >> 6;
					elseif ( ($P * 8) % 8 == 2 )
						$COLOR[1] = ($COLOR[1] & 0x20) >> 5;
					elseif ( ($P * 8) % 8 == 3 )
						$COLOR[1] = ($COLOR[1] & 0x10) >> 4;
					elseif ( ($P * 8) % 8 == 4 )
						$COLOR[1] = ($COLOR[1] & 0x8) >> 3;
					elseif ( ($P * 8) % 8 == 5 )
						$COLOR[1] = ($COLOR[1] & 0x4) >> 2;
					elseif ( ($P * 8) % 8 == 6 )
						$COLOR[1] = ($COLOR[1] & 0x2) >> 1;
					elseif ( ($P * 8) % 8 == 7 )
						$COLOR[1] = ($COLOR[1] & 0x1);
					$COLOR[1] = $PALETTE[$COLOR[1] + 1];
				}else
					return FALSE;
				imagesetpixel( $res, $X, $Y, $COLOR[1]);
				$X++;
				$P+= $BMP['bytes_per_pixel'];
			}
			$Y--;
			$P+= $BMP['decal'];
		}
		fclose($f1);		
		return $res;
	}
	
}

/*
	if(ini_get("file_uploads")){
		echo "可以上传"."<br>";
	}
	upload::upload_config(array("jpg","png","gif"),204800);
	upload::go_upload($_FILES);
	echo image::$error;
	echo image::$filename;
*/
?>