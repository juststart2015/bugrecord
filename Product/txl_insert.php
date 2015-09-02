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
	if(isset($_POST["submit"]) && $_POST["submit"] == "保存")
		{
			$dh = $_POST["dh_name"];
			$dm = $_POST["dm_name"];
			$dz = $_POST["dz_name"];
			$bgdh = $_POST["bgdh_name"];
			$yddh = $_POST["yddh_name"];
			$dzu = $_POST["dzu_name"];
			//$zjr = $_SESSION['username'];
			//$cznr = "新增用户";
			if($dh == "" || $dm == "" || $dz == "" || $bgdh == "" || $yddh == "" || $dzu == "")
				{
					echo "<script>alert('请填写完整');location.href='txl.php'</script>";
				}
			else
				{
					mysql_connect("localhost","root","sa");
					mysql_select_db("my_db");
					mysql_query("set names 'utf8'");
					$sql = "insert into txl (dh,dm,dz,bgdh,yddh,dzu) values ('$dh','$dm','$dz','$bgdh','$yddh','$dzu')";
					//$sql_useradd = "insert into user_add (username,zjr,cznr) values ('$yhm','$zjr','$cznr')";
					$result = mysql_query($sql);
					//$result_useradd = mysql_query($sql_useradd);
					if(!$result)
						{
							echo "<script>alert('未保存，请重试');location.href='txl.php'</script>";
						}
					else
						{
							echo "<script>alert('保存成功,点击刷新');location.href='txl.php'</script>";
						}
				}
		}
	else
		{
			echo "<script>alert('请保存');location.href='txl.php'</script>";
		}
?>

</body>
</html>