<?php
	session_start();
	error_reporting (E_ALL & ~E_DEPRECATED & ~E_NOTICE);
	mysql_connect("localhost","root","sa");
	mysql_select_db("my_db");
	mysql_query("set names 'utf8'");
	
	$act = $_REQUEST['act'];
	$sql = "select * from update_list where id = ".$act;
	$result = mysql_query($sql);
	while($row=mysql_fetch_array($result)){
		$rows[]=$row;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主页</title>
	<link rel="stylesheet" type="text/css" href="../jquery-easyui-1.4.2/themes/default/easyui.css" />
	<link rel="stylesheet" type="text/css" href="../jquery-easyui-1.4.2/themes/icon.css" />
    <!--<link rel="stylesheet" type="text/css" href="../jquery-easyui-1.4.2/demo/demo.css" />-->
    <script type="text/javascript" src="../jquery-easyui-1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="../jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../jquery-easyui-1.4.2/locale/easyui-lang-zh_CN.js"></script>
	<style>
		table,table td,table th{border:1px solid #000000;border-collapse:collapse;}
	</style>
</head>

<body>
	<h3><a href="update_list.php">返回</a></h3>
	<?php foreach($rows as $row): ?>
		<table width="90%" bgcolor="#D2E0F2">
				<tr>
					<td width="10%" align="right">更新概述:</td>
					<td width="80%"><?php echo $row['gxgs']; ?></td>
				</tr>
				<tr>
					<td align="right">更新时间:</td>
					<td><?php echo $row['update_time']; ?></td>
				</tr>
				<tr>
					<td align="right">更新人:</td>
					<td><?php echo $row['gxr']; ?></td>
				</tr>
				<tr>
					<td align="right">更新内容:</td>
					<td><?php echo $row['gxnr']; ?></td>
				</tr>
		</table>
	<?php endforeach; ?>
</body>
</html>