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
			$zt = $_POST["zt"];
			$yxj = $_POST["yxj"];
			$tcr = $_POST["tcr"];
			$djrq = $_POST["djrq"];
			$wtms = $_POST["wtms"];
			$cljg_a = $_POST["gx"];
			$cljg = str_replace("\r\n","<br>","$cljg_a");
			$clr = $_POST["clr"];
			$wcrq = $_POST["wcrq"];
			$bz = $_POST["bz"];
			$bjr = $_SESSION['username'];
			if($cljg == "" || $clr == "")
				{
					echo "<script>alert('请填写更新内容');location.href='system_bmtj.php'</script>";
				}
			else
				{
					mysql_connect("localhost","root","sa");
					mysql_select_db("my_db");
					mysql_query("set names 'utf8'");
					$sql = "update system_bmtj set zt='$zt',yxj='$yxj',tcr='$tcr',djrq='$djrq',wtms='$wtms',cljg='$cljg',clr='$clr',wcrq='$wcrq',bz='$bz' where tcr='$tcr' and wtms='$wtms'";
					$sql_gx = "insert into system_bmtj_clgc (wtms,clgc,bjr) values ('$wtms','$cljg','$bjr')";
					$result_gx = mysql_query($sql_gx);
					$result = mysql_query($sql);
					if(!$result)
						{
							echo "<script>alert('未保存，请重试');location.href='system_bmtj.php'</script>";
						}
					else
						{
							echo "<script>alert('保存成功,点击刷新');location.href='system_bmtj.php'</script>";
						}
				}
		}
	else
		{
			echo "<script>alert('请保存');location.href='system_bmtj.php'</script>";
		}
?>

</body>
</html>