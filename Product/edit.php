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
	$system_name = $_POST["system_edit_name"];
	$system_record = $system_name."_clgc";
	$system_address = $system_name.".php";
	if($system_name == "system_poscj")
	{
		if(isset($_POST["submit"]) && $_POST["submit"] == "保存")
		{
			$zt = $_POST["zt"];
			$lx = $_POST["lx"];
			$tcr = $_POST["tcr"];
			$djrq = $_POST["djrq"];
			$wtms = $_POST["wtms"];
			$cljg_a = $_POST["gx"];
			$cljg = str_replace("\r\n","<br>","$cljg_a");
			$clr = $_POST["clr"];
			$wcrq = $_POST["wcrq"];
			$bz = $_POST["bz"];
			$bjr = $_SESSION['username'];
			$wt_lx = $_POST["wt_lx"];
			$wt_id = $_POST["wt_id"];
			$assigned_name = $_POST["assigned_name"];
			if($cljg == "" || $clr == "")
			{
				echo "<script>alert('请填写更新内容');location.href='$system_address'</script>";
			}
			else
			{
				mysql_connect("localhost","root","sa");
				mysql_select_db("my_db");
				mysql_query("set names 'utf8'");
				$sql = "update $system_name set zt='$zt',tcr='$tcr',djrq='$djrq',wtms='$wtms',cljg='$cljg',clr='$clr',wcrq='$wcrq',bz='$bz' where tcr='$tcr' and wtms='$wtms'";
				$sql_gx = "insert into $system_record (wtms,clgc,bjr) values ('$wtms','$cljg','$bjr')";
				$sql_gx_assign = "update system_assign_user set wt_zt = '$zt' where wt_id = '$wt_id' and wt_lx = '$wt_lx'";
				
				if($zt == "已完成")
				{
					$sql_assign_insert = "insert system_assign_record (wt_lx,wt_id,wt_zt,assign_name,assigned_name,cljg) value('$wt_lx','$wt_id','$zt','$bjr','$assigned_name','$cljg')";
					$result_assign_insert = mysql_query($sql_assign_insert);
				}
				$result_gx = mysql_query($sql_gx);
				$result = mysql_query($sql);
				$result_gx_assign = mysql_query($sql_gx_assign);
				if(!$result)
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
			if(isset($_POST["submit"]) && $_POST["submit"] == "确认")
			{
				$zt = $_POST["zt"];
				$tcr = $_POST["tcr"];
				$djrq = $_POST["djrq"];
				$wtms = $_POST["wtms"];
				$cljg_a = $_POST["gx"];
				$cljg = str_replace("\r\n","<br>","$cljg_a");
				$clr = $_POST["clr"];
				$wcrq = $_POST["wcrq"];
				$bz = $_POST["bz"];
				$bjr = $_SESSION['username'];
				$wt_lx = $_POST["wt_lx"];
				$wt_id = $_POST["wt_id"];
				$wt_zt = $_POST["zt"];
				$assign_name = $_SESSION["username"];
				$assigned_name = $_POST["assigned_name"];
				
				mysql_connect("localhost","root","sa");
				mysql_select_db("my_db");
				mysql_query("set names 'utf8'");
				
				$sql = "update $system_name set zt='$zt',tcr='$tcr',djrq='$djrq',wtms='$wtms',cljg='$cljg',clr='$clr',wcrq='$wcrq',bz='$bz' where tcr='$tcr' and wtms='$wtms'";
				$sql_gx = "insert into $system_record (wtms,clgc,bjr) values ('$wtms','$cljg','$bjr')";
				$sql_assign = "insert into system_assign_user (wt_lx,wt_id,wt_zt,assign_name,assigned_name,cljg) value ('$wt_lx','$wt_id','$wt_zt','$assign_name','$assigned_name','$cljg')";
				$sql_record = "insert into system_assign_record (wt_lx,wt_id,wt_zt,assign_name,assigned_name,cljg) value ('$wt_lx','$wt_id','$wt_zt','$assign_name','$assigned_name','$cljg')";
				if($assigned_name == "默认")
				{
					echo "<script>alert('分配失败，请选择分配对象');location.href='$system_address'</script>";
				} 
				else
				{
					$result = mysql_query($sql);
					$result_gx = mysql_query($sql_gx);
					$result_a = mysql_query($sql_assign);
					$result_record = mysql_query($sql_record);
					echo "<script>alert('分配成功，点击刷新');location.href='$system_address'</script>";
				}
			}
			else
			{
				$zt = $_POST["zt"];
				$tcr = $_POST["tcr"];
				$djrq = $_POST["djrq"];
				$wtms = $_POST["wtms"];
				$cljg_a = $_POST["gx"];
				$cljg = str_replace("\r\n","<br>","$cljg_a");
				$clr = $_POST["clr"];
				$wcrq = $_POST["wcrq"];
				$bz = $_POST["bz"];
				$bjr = $_SESSION['username'];
				$wt_lx = $_POST["wt_lx"];
				$wt_id = $_POST["wt_id"];
				$wt_zt = $_POST["zt"];
				$assign_name = $_SESSION["username"];
				$assigned_name = $_POST["assigned_name"];
				
				mysql_connect("localhost","root","sa");
				mysql_select_db("my_db");
				mysql_query("set names 'utf8'");
				
				$sql_gb_a = "update $system_name set zt = '已完成' where wt_id = '$wt_id'";
				$sql_gb = "insert into $system_record (wtms,clgc,bjr) values ('$wtms','关闭此问题','$bjr')";
				$sql_gb_assign = "update system_assign_user set wt_zt = '已完成' where wt_id = '$wt_id' and wt_lx = '$wt_lx'";
				$sql_gb_assigned = "insert into system_assign_record (wt_lx,wt_id,wt_zt,assign_name,assigned_name,cljg) value ('$wt_lx','$wt_id','已完成','$assign_name','$assigned_name','关闭此问题')";
				
				$result_gb_a = mysql_query($sql_gb_a);
				$result_gb = mysql_query($sql_gb);
				$result_gb_assign = mysql_query($sql_gb_assign);
				$result_gb_assigned = mysql_query($sql_gb_assigned);
				
				echo "<script>alert('问题已关闭');location.href='$system_address'</script>";
			}
		}
	}
	else
	{
		if($system_name == "system_bmtj" || $system_name == "system_tjqy")
		{
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
				$wt_lx = $_POST["wt_lx"];
				$wt_id = $_POST["wt_id"];
				$assigned_name = $_POST["assigned_name"];
				if($cljg == "" || $clr == "")
				{
					echo "<script>alert('请填写更新内容');location.href='$system_address'</script>";
				}
				else
				{
					mysql_connect("localhost","root","sa");
					mysql_select_db("my_db");
					mysql_query("set names 'utf8'");
					$sql = "update $system_name set zt='$zt',yxj='$yxj',tcr='$tcr',djrq='$djrq',wtms='$wtms',cljg='$cljg',clr='$clr',wcrq='$wcrq',bz='$bz' where tcr='$tcr' and wtms='$wtms'";
					$sql_gx = "insert into $system_record (wtms,clgc,bjr) values ('$wtms','$cljg','$bjr')";
					$sql_gx_assign = "update system_assign_user set wt_zt = '$zt' where wt_id = '$wt_id' and wt_lx = '$wt_lx'";
					
					if($zt == "已完成")
					{
						$sql_assign_insert = "insert system_assign_record (wt_lx,wt_id,wt_zt,assign_name,assigned_name,cljg) value('$wt_lx','$wt_id','$zt','$bjr','$assigned_name','$cljg')";
						$result_assign_insert = mysql_query($sql_assign_insert);
					}
					$result_gx = mysql_query($sql_gx);
					$result = mysql_query($sql);
					$result_gx_assign = mysql_query($sql_gx_assign);
					if(!$result)
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
				if(isset($_POST["submit"]) && $_POST["submit"] == "确认")
				{
					$zt = $_POST["zt"];
					$tcr = $_POST["tcr"];
					$djrq = $_POST["djrq"];
					$wtms = $_POST["wtms"];
					$cljg_a = $_POST["gx"];
					$cljg = str_replace("\r\n","<br>","$cljg_a");
					$clr = $_POST["clr"];
					$wcrq = $_POST["wcrq"];
					$bz = $_POST["bz"];
					$bjr = $_SESSION['username'];
					$wt_lx = $_POST["wt_lx"];
					$wt_id = $_POST["wt_id"];
					$wt_zt = $_POST["zt"];
					$assign_name = $_SESSION["username"];
					$assigned_name = $_POST["assigned_name"];
					
					mysql_connect("localhost","root","sa");
					mysql_select_db("my_db");
					mysql_query("set names 'utf8'");
					
					$sql = "update $system_name set zt='$zt',tcr='$tcr',djrq='$djrq',wtms='$wtms',cljg='$cljg',clr='$clr',wcrq='$wcrq',bz='$bz' where tcr='$tcr' and wtms='$wtms'";
					$sql_gx = "insert into $system_record (wtms,clgc,bjr) values ('$wtms','$cljg','$bjr')";
					$sql_assign = "insert into system_assign_user (wt_lx,wt_id,wt_zt,assign_name,assigned_name,cljg) value ('$wt_lx','$wt_id','$wt_zt','$assign_name','$assigned_name','$cljg')";
					$sql_record = "insert into system_assign_record (wt_lx,wt_id,wt_zt,assign_name,assigned_name,cljg) value ('$wt_lx','$wt_id','$wt_zt','$assign_name','$assigned_name','$cljg')";
					if($assigned_name == "默认")
					{
						echo "<script>alert('指派失败，请选择指派对象');location.href='$system_address'</script>";
					} 
					else
					{
						$result = mysql_query($sql);
						$result_gx = mysql_query($sql_gx);
						$result_a = mysql_query($sql_assign);
						$result_record = mysql_query($sql_record);
						echo "<script>alert('分配成功，点击刷新');location.href='$system_address'</script>";
					}
				}
				else
				{
					$zt = $_POST["zt"];
					$tcr = $_POST["tcr"];
					$djrq = $_POST["djrq"];
					$wtms = $_POST["wtms"];
					$cljg_a = $_POST["gx"];
					$cljg = str_replace("\r\n","<br>","$cljg_a");
					$clr = $_POST["clr"];
					$wcrq = $_POST["wcrq"];
					$bz = $_POST["bz"];
					$bjr = $_SESSION['username'];
					$wt_lx = $_POST["wt_lx"];
					$wt_id = $_POST["wt_id"];
					$wt_zt = $_POST["zt"];
					$assign_name = $_SESSION["username"];
					$assigned_name = $_POST["assigned_name"];
					
					mysql_connect("localhost","root","sa");
					mysql_select_db("my_db");
					mysql_query("set names 'utf8'");
					
					$sql_gb_a = "update $system_name set zt = '已完成' where wt_id = '$wt_id'";
					$sql_gb = "insert into $system_record (wtms,clgc,bjr) values ('$wtms','关闭此问题','$bjr')";
					$sql_gb_assign = "update system_assign_user set wt_zt = '已完成' where wt_id = '$wt_id' and wt_lx = '$wt_lx'";
					$sql_gb_assigned = "insert into system_assign_record (wt_lx,wt_id,wt_zt,assign_name,assigned_name,cljg) value ('$wt_lx','$wt_id','已完成','$assign_name','$assigned_name','关闭此问题')";
					
					$result_gb_a = mysql_query($sql_gb_a);
					$result_gb = mysql_query($sql_gb);
					$result_gb_assign = mysql_query($sql_gb_assign);
					$result_gb_assigned = mysql_query($sql_gb_assigned);
					
					echo "<script>alert('问题已关闭');location.href='$system_address'</script>";
				}
			}
		}
		else
		{
			if(isset($_POST["submit"]) && $_POST["submit"] == "保存")
			{
				$zt = $_POST["zt"];
				$tcr = $_POST["tcr"];
				$djrq = $_POST["djrq"];
				$wtms = $_POST["wtms"];
				$cljg_a = $_POST["gx"];
				$cljg = str_replace("\r\n","<br>","$cljg_a");
				$clr = $_POST["clr"];
				$wcrq = $_POST["wcrq"];
				$bz = $_POST["bz"];
				$bjr = $_SESSION['username'];
				$wt_lx = $_POST["wt_lx"];
				$wt_id = $_POST["wt_id"];
				$assigned_name = $_POST["assigned_name"];
				if($cljg == "" || $clr == "")
				{
					echo "<script>alert('请填写更新内容及处理人');location.href='$system_address'</script>";
				}
				else
				{
					mysql_connect("localhost","root","sa");
					mysql_select_db("my_db");
					mysql_query("set names 'utf8'");
					//此语句更新system_cs表，显示该问题当前最新状态
					$sql = "update $system_name set zt='$zt',tcr='$tcr',djrq='$djrq',wtms='$wtms',cljg='$cljg',clr='$clr',wcrq='$wcrq',bz='$bz' where tcr='$tcr' and wtms='$wtms'";
					//此语句，记录该问题所有的处理过程记录
					$sql_gx = "insert into $system_record (wtms,clgc,bjr) values ('$wtms','$cljg','$bjr')";
					//此语句更新当前指派问题的处理情况，若为已完成，则更新表内zt为已完成，就不再在用于首页显示
					$sql_gx_assign = "update system_assign_user set wt_zt = '$zt' where wt_id = '$wt_id' and wt_lx = '$wt_lx'";
					//此语句，记录被指派问题的处理过程，在第一次指派时记录一次，之后保存时，若一直是“处理中”状态，则不在重复记录，若变成“已完成”状态，则记录一次完成的时间及相关内容。
					if($zt == "已完成")
					{
						$sql_assign_insert = "insert system_assign_record (wt_lx,wt_id,wt_zt,assign_name,assigned_name,cljg) value('$wt_lx','$wt_id','$zt','$bjr','$assigned_name','$cljg')";
						$result_assign_insert = mysql_query($sql_assign_insert);
					}
					
					$result_gx = mysql_query($sql_gx);
					$result = mysql_query($sql);
					$result_gx_assign = mysql_query($sql_gx_assign);
					if(!$result)
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
				if(isset($_POST["submit"]) && $_POST["submit"] == "确认")
				{
					$zt = $_POST["zt"];
					$tcr = $_POST["tcr"];
					$djrq = $_POST["djrq"];
					$wtms = $_POST["wtms"];
					$cljg_a = $_POST["gx"];
					$cljg = str_replace("\r\n","<br>","$cljg_a");
					$clr = $_POST["clr"];
					$wcrq = $_POST["wcrq"];
					$bz = $_POST["bz"];
					$bjr = $_SESSION['username'];
					$wt_lx = $_POST["wt_lx"];
					$wt_id = $_POST["wt_id"];
					$wt_zt = $_POST["zt"];
					$assign_name = $_SESSION["username"];
					$assigned_name = $_POST["assigned_name"];
					
					mysql_connect("localhost","root","sa");
					mysql_select_db("my_db");
					mysql_query("set names 'utf8'");
					//此语句更新system_cs表，显示该问题当前最新状态
					$sql = "update $system_name set zt='$zt',tcr='$tcr',djrq='$djrq',wtms='$wtms',cljg='$cljg',clr='$clr',wcrq='$wcrq',bz='$bz' where tcr='$tcr' and wtms='$wtms'";
					//此语句，记录该问题所有的处理过程记录
					$sql_gx = "insert into $system_record (wtms,clgc,bjr) values ('$wtms','$cljg','$bjr')";
					
					
					//此语句，把指派对象及相关信息，存入指派表内，
					$sql_assign = "insert into system_assign_user (wt_lx,wt_id,wt_zt,assign_name,assigned_name,cljg) value ('$wt_lx','$wt_id','$wt_zt','$assign_name','$assigned_name','$cljg')";
					//此语句，记录第一次的指派及之后的处理过程，过程只记录从“处理中”变成“已完成”的那次，这个判断在上面的语句中进行。
					$sql_record = "insert into system_assign_record (wt_lx,wt_id,wt_zt,assign_name,assigned_name,cljg) value ('$wt_lx','$wt_id','$wt_zt','$assign_name','$assigned_name','$cljg')";
					if($assigned_name == "默认")
					{
						echo "<script>alert('分配失败，请选择分配对象');location.href='$system_address'</script>";
					} 
					else
					{
						$result = mysql_query($sql);
						$result_gx = mysql_query($sql_gx);
						$result_a = mysql_query($sql_assign);
						$result_record = mysql_query($sql_record);
						echo "<script>alert('分配成功，点击刷新');location.href='$system_address'</script>";
					}
				}
				else
				{
					$zt = $_POST["zt"];
					$tcr = $_POST["tcr"];
					$djrq = $_POST["djrq"];
					$wtms = $_POST["wtms"];
					$cljg_a = $_POST["gx"];
					$cljg = str_replace("\r\n","<br>","$cljg_a");
					$clr = $_POST["clr"];
					$wcrq = $_POST["wcrq"];
					$bz = $_POST["bz"];
					$bjr = $_SESSION['username'];
					$wt_lx = $_POST["wt_lx"];
					$wt_id = $_POST["wt_id"];
					$wt_zt = $_POST["zt"];
					$assign_name = $_SESSION["username"];
					$assigned_name = $_POST["assigned_name"];
					
					mysql_connect("localhost","root","sa");
					mysql_select_db("my_db");
					mysql_query("set names 'utf8'");
					
					$sql_gb_a = "update $system_name set zt = '已完成' where wt_id = '$wt_id'";
					$sql_gb = "insert into $system_record (wtms,clgc,bjr) values ('$wtms','我关闭了此问题','$bjr')";
					$sql_gb_assign = "update system_assign_user set wt_zt = '已完成' where wt_id = '$wt_id' and wt_lx = '$wt_lx'";
					$sql_gb_assigned = "insert into system_assign_record (wt_lx,wt_id,wt_zt,assign_name,assigned_name,cljg) value ('$wt_lx','$wt_id','已完成','$assign_name','$assigned_name','我关闭了此问题')";
					
					$result_gb_a = mysql_query($sql_gb_a);
					$result_gb = mysql_query($sql_gb);
					$result_gb_assign = mysql_query($sql_gb_assign);
					$result_gb_assigned = mysql_query($sql_gb_assigned);
					
					echo "<script>alert('问题已关闭，点击刷新');location.href='$system_address'</script>";
				}
			}
		}
	}
?>

</body>
</html>