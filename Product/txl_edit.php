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
			$dh = $_POST["dh"];
			$dm = $_POST["dm"];
			$dz = $_POST["dz"];
			$bgdh = $_POST["bgdh"];
			$yddh = $_POST["yddh"];
			$dzu = $_POST["dzu"];
			mysql_connect("localhost","root","sa");
			mysql_select_db("my_db");
			mysql_query("set names 'utf8'");
			$sql = "update txl set dm = '$dm',dz = '$dz',bgdh = '$bgdh',yddh = '$yddh',dzu = '$dzu' where dh='$dh'";
			$result = mysql_query($sql);
			if(!$result)
			{
				echo "<script>alert('未保存，请重试');location.href='txl.php'</script>";
			}
			else
			{
				echo "<script>alert('保存成功,点击刷新');location.href='txl.php'</script>";
			}
		}
		else{
				echo "<script>alert('请保存');location.href='txl.php'</script>";
			}
?>

</body>
</html>