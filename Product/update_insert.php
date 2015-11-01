<?php
	session_start();
	error_reporting (E_ALL & ~E_DEPRECATED & ~E_NOTICE);
	mysql_connect("localhost","root","sa");
	mysql_select_db("my_db");
	mysql_query("set names 'utf8'");
	
	$gxgs = $_POST['gxgs'];
	$gxr = $_POST['gxr'];
	$gxrq = $_POST['gxrq'];
	$gxnr_a = $_POST['gxnr'];
	$gxnr = str_replace("\r\n","<br>","$gxnr_a");
	if($gxgs != '' & $gxrq != '' & $gxnr != '' & $gxr != ''){
		$sql = "insert into update_list (update_time,gxgs,gxnr,gxr) values ('".$gxrq."','".$gxgs."','".$gxnr."','".$gxr."')";
		$result = mysql_query($sql);
		if($result){
			echo "<p>添加成功!</p><a href='update_list.php'>查看更新列表</a>";
		}else{
			echo "<p>添加失败!</p><a href='update_list.php'>查看更新列表</a>";
		}
	}else{
		echo "<script>alert('请填写完整');location.href='update_list.php'</script>";
	}
?>