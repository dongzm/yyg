			<?php 
			/*
				上传和水印配置
				@up_image_type 		上传图片类型
				@up_soft_type		上传附件类型
				@up_media_type		上传媒体类型
				@upsize				允许单文件最大大小
				@watermark_off		水印开启
				@watermark_type		水印类型
				@watermark_condition
				@watermark_text		文本水印配置
				@watermark_image	图片水印地址
				@watermark_position 水印位置
			*/
			return array(
				'up_image_type' => 'png,jpg,gif,jpeg',
				'up_soft_type' => 'zip,gz,rar,iso,doc,ppt,wps,xls',
				'up_media_type' => 'swf,flv,mp3,wav,wma,rmvb',
				'upsize' => '1024000',
				'watermark_off' => '0',
				'watermark_condition' => array('width'=>'100','height'=>"100"),
				'watermark_type' => 'text',
				'watermark_text' => array('text'=>"",'color'=>"#ff0000",'size'=>"15",'font'=>"/www/web/sell_yuanma_me/public_html/system/modules/api/lib/"),
				'watermark_image' => 'banner/20141205/93445116772218.jpg',
				'watermark_position' => 'c',
				'watermark_apache' => '50',
				'watermark_good' => '80',
			);
			?>