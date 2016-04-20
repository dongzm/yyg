<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo G_ADMIN_STYLE; ?>/css/style.css" type="text/css">
<style>
body{ background-color:#fff}
</style>
</head>
<body>
<div class="dialog_content">
<form name="LoginForm" action="modify_sql?uid=<?php echo $member['uid']; ?>" method="post" enctype="multipart/form-data" >
	<ul>
		<li>
			<em>用户名：</em>
			<input  type="text"  name="username"  class="input_text"  value="<?php echo $member['username']; ?>">
		</li>
		<li>
			<em>邮箱名：</em>
			<input  type="text"  name="email"  class="input_text"  value="<?php echo $member['email']; ?>">
		</li>
		<li>
			<em>手机号：</em>
			<input  type="text"  name="mobile"  class="input_text"  value="<?php echo $member['mobile']; ?>">
		</li>		
		<li>
			<em>密码：</em>
			<input  type="text"  name="password"  class="input_text"  value="">
		</li>
		<li><em></em>
			<input class="submit" type="submit" name="submit" value="确认" />
		</li>
	</ul>
</form>
</div>

</body>
</html> 
