<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
	session_start();
	error_reporting (E_ALL & ~E_DEPRECATED);
?>
	<form style="padding:10px 20px 10px 40px;" action="user_edit.php" method="post" id="user_fm" name="user_edit">
	<div style="position:absolute; left:30%">
		<p>
			用户名：<input id="user_name_edit" name="user_name_edit" type="text" readonly="readonly" style="border:none" value="<?php echo $_SESSION['username'] ?>" />
		</p>
		<p>
			<!--新密码：<input id="user_pasw_edit" name="user_pasw_edit" type="text" />-->
			<label for="user_pasw_edit">新密码：</label>
            <input type="password" id="user_pasw_edit" name="user_pasw_edit" />
		</p>
		<p>
			<input type="submit" name="submit_edit" value="修改密码" />
		</p>
	</div>
    </form>
</body>
</html>