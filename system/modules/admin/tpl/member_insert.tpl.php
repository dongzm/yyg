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
<script language=JavaScript>
function InputCheck(LoginForm)
{
  if (LoginForm.email.value == "")
  {
    alert("请输入用户名!");
    LoginForm.email.focus();
    return (false);
  }
  if (LoginForm.password.value == "")
  {
    alert("请输入密码!");
    LoginForm.password.focus();
    return (false);
  }
}
</script>
<div class="dialog_content">
<form name="LoginForm" action="insert_sql" method="post" enctype="multipart/form-data"  onSubmit="return InputCheck(this)">
	<ul>
		<li>
			<em>邮箱或手机号：<br><font>注：在英文状态下以逗号隔开,如：xx,xx</font></em>
			<textarea name="email" class="textarea"></textarea>
		</li>
		<li>
			<em>密码：</em>
			<input style="width:100px;" type="text"  name="password"  class="input_text"  value="">
		</li>
		<li><em></em>
			<input class="submit" type="submit" name="submit" value="确认" />
		</li>
	</ul>
</form>
</div>

</body>
</html> 
