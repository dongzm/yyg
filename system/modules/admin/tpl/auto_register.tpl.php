<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">

</head>
<body>

			
	<form action="<?php echo G_ADMIN_PATH; ?>/auto_register/fileaction" method="post" enctype="multipart/form-data" >

		<input id="file" name="file" type="file"  />
		<input type="submit" value="上传并批量注册"/>
	</form>

	
	<br/>
	<hr/>
	
	<pre style="color:red;">
	注：
上传txt文本

用户名,密码,邮箱,手机
用户名和密码可以不填写
邮箱和手机必须填写其中一个，也可以两个都填写
这四个值 都必须用  英文输入法下的   ，   逗号 分割
一条记录完后必须换行
密码不写默认为  111111   六个1
例子1
	我是用户名,111111,12345678@qq.com,13354545875
例子2
	,,12345678@qq.com,13354545875
例子3
	,,12345678@qq.com,

例子4
	,,,13354545875
例子6

	我是用户名,,12345678@qq.com,13354545875

	</pre>
</body>
</html> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script>

</script>