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
	if(isset($_POST["submit_edit"]) && $_POST["submit_edit"] == "保存")
		{
			$username = $_POST["user_name_edit"];
			$pasw = $_POST["user_pasw_edit"];
			$bjr = $_SESSION['username'];
			$cznr = "修改密码";
			if($pasw == "")
				{
					echo "<script>alert('未修改');location.href='userset.php'</script>";
				}
			else
				{
					mysql_connect("localhost","root","sa");
					mysql_select_db("my_db");
					mysql_query("set names 'utf8'");
					$sql = "update users set password ='$pasw' where username='$username'";
					$sql_gx = "insert into user_add (username,zjr,cznr) values ('$username','$bjr','$cznr')";
					$result_gx = mysql_query($sql_gx);
					$result = mysql_query($sql);
					if(!$result)
						{
							echo "<script>alert('未保存，请重试');location.href='userset.php'</script>";
						}
					else
						{
							echo "<script>alert('保存成功,点击刷新');location.href='userset.php'</script>";
						}
				}
		}
	else
		{
			if(isset($_POST["submit_edit"]) && $_POST["submit_edit"] == "修改密码")
			{
			$username = $_POST["user_name_edit"];
			$pasw = $_POST["user_pasw_edit"];
			$bjr = $_SESSION['username'];
			$cznr = "修改密码";
			if($pasw == "")
				{
					echo "<script>alert('密码不许为空，此次未修改');window.close();</script>";
				}
			else
				{
					mysql_connect("localhost","root","sa");
					mysql_select_db("my_db");
					mysql_query("set names 'utf8'");
					$sql = "update users set password ='$pasw' where username='$username'";
					$sql_gx = "insert into user_add (username,zjr,cznr) values ('$username','$bjr','$cznr')";
					$result_gx = mysql_query($sql_gx);
					$result = mysql_query($sql);
					if(!$result)
						{
							echo "<script>alert('未保存，请重试');window.close();</script>";
						}
					else
						{
							echo "<script>alert('保存成功,点击关闭本页');window.close();</script>";
						}
				}
			}
			else{
				echo "<script>alert('请保存');location.href='userset.php'</script>";
			}
		}
?>

</body>
</html>