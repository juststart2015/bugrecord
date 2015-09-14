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
	if(isset($_POST["submit_zj"]) && $_POST["submit_zj"] == "保存")
	{
		$system_name = $_POST["system_insert_name"];
		$system_record = $system_name."_clgc";
		$system_address = $system_name.".php";
		if($system_name == "system_poscj")
		{
			$zt = $_POST["zt"];
			$lx = $_POST["lx"];
			$jlr = $_SESSION['username'];
			$tcr = $_POST["tcr"];
			//$djrq = $_POST["djrq"];
			$wtms_a = $_POST["wtms"];
			$wtms = str_replace("\r\n","<br>","$wtms_a");
			$cljg_a = $_POST["cljg"];
			$cljg = str_replace("\r\n","<br>","$cljg_a");
			$clr = $_POST["clr"];
			$wcrq = $_POST["wcrq"];
			$bz = $_POST["bz"];
			if($tcr == "" || $wtms == "" || $cljg == "" || $clr == "")
			{
				echo "<script>alert('请填写完整');location.href='$system_address'</script>";
			}
			else
			{
				mysql_connect("localhost","root","sa");
				mysql_select_db("my_db");
				mysql_query("set names 'utf8'");
				$sql = "insert into $system_name (zt,lx,jlr,tcr,wtms,cljg,clr,wcrq,bz) values ('$zt','$lx','$jlr','$tcr','$wtms','$cljg','$clr','$wcrq','$bz')";
				$sql_clgc = "insert into $system_record (wtms,clgc,bjr) values ('$wtms','$cljg','$jlr')";
				$result = mysql_query($sql);
				$result_clgc = mysql_query($sql_clgc);
				if(!$result || !$result_clgc)
				{
					echo "<script>alert('未保存，请重试');location.href='$system_address'</script>";
				}
				else
				{
					echo "<script>alert('保存成功,点击刷新');location.href='$system_address'</script>";
				}
			}
		}
		else
		{
			if ($system_name == "system_bmtj" || $system_name == "system_tjqy")
			{
				$zt = $_POST["zt"];
				$yxj = $_POST["yxj"];
				$jlr = $_SESSION['username'];
				$tcr = $_POST["tcr"];
				//$djrq = $_POST["djrq"];
				$wtms_a = $_POST["wtms"];
				$wtms = str_replace("\r\n","<br>","$wtms_a");
				$cljg_a = $_POST["cljg"];
				$cljg = str_replace("\r\n","<br>","$cljg_a");
				$clr = $_POST["clr"];
				$wcrq = $_POST["wcrq"];
				$bz = $_POST["bz"];
				if($tcr == "" || $wtms == "" || $cljg == "" || $clr == "")
				{
					echo "<script>alert('请填写完整');location.href='$system_address'</script>";
				}
				else
				{
					mysql_connect("localhost","root","sa");
					mysql_select_db("my_db");
					mysql_query("set names 'utf8'");
					$sql = "insert into $system_name (zt,yxj,jlr,tcr,wtms,cljg,clr,wcrq,bz) values ('$zt','$yxj','$jlr','$tcr','$wtms','$cljg','$clr','$wcrq','$bz')";
					$sql_clgc = "insert into $system_record (wtms,clgc,bjr) values ('$wtms','$cljg','$jlr')";
					$result = mysql_query($sql);
					$result_clgc = mysql_query($sql_clgc);
					if(!$result || !$result_clgc)
					{
						echo "<script>alert('未保存，请重试');location.href='$system_address'</script>";
					}
					else
					{
						echo "<script>alert('保存成功,点击刷新');location.href='$system_address'</script>";
					}
				}
			}
			else
			{
				$zt = $_POST["zt"];
				$jlr = $_SESSION['username'];
				$tcr = $_POST["tcr"];
				//$djrq = $_POST["djrq"];
				$wtms_a = $_POST["wtms"];
				$wtms = str_replace("\r\n","<br>","$wtms_a");
				$cljg_a = $_POST["cljg"];
				$cljg = str_replace("\r\n","<br>","$cljg_a");
				$clr = $_POST["clr"];
				$wcrq = $_POST["wcrq"];
				$bz = $_POST["bz"];
				if($tcr == "" || $wtms == "" || $cljg == "" || $clr == "")
				{
					echo "<script>alert('请填写完整');location.href='$system_address'</script>";
				}
				else
				{
					mysql_connect("localhost","root","sa");
					mysql_select_db("my_db");
					mysql_query("set names 'utf8'");
					$sql = "insert into $system_name (zt,jlr,tcr,wtms,cljg,clr,wcrq,bz) values ('$zt','$jlr','$tcr','$wtms','$cljg','$clr','$wcrq','$bz')";
					$sql_clgc = "insert into $system_record (wtms,clgc,bjr) values ('$wtms','$cljg','$jlr')";
					$result = mysql_query($sql);
					$result_clgc = mysql_query($sql_clgc);
					if(!$result || !$result_clgc)
					{
						echo "<script>alert('未保存，请重试');location.href='$system_address'</script>";
					}
					else
					{
						echo "<script>alert('保存成功,点击刷新');location.href='$system_address'</script>";
					}
				}
			}
		}
	}
	else
	{
		echo "<script>alert('请保存');location.href='$system_address'</script>";
	}
?>

</body>
</html>