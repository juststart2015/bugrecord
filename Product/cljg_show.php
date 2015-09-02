<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
									error_reporting (E_ALL & ~E_DEPRECATED);
									if(isset($_POST["submit_zd"])){
									$link=mysql_connect('localhost','root','sa')or die("数据库连接失败");
									mysql_select_db('my_db',$link);//选择数据库
									mysql_query("set names utf8");//设置编码格式
									$b = mysql_real_escape_string($_POST["wtms_value"]);
									$c = mysql_real_escape_string($_POST["tablename"]);
									if($b == ""){
										echo "值为空";
										}
									else{
									$result=mysql_query("select clgc,bjsj,bjr from $c where wtms like '$b'") or die(mysql_error());//执行查询
									while($row = mysql_fetch_array($result))//将result结果集中查询结果取出
									{
									 echo $row["clgc"];
									 echo "<br>";
									 echo $row["bjr"];
									 echo " 编辑于 ";
									 echo $row["bjsj"];
									 echo "<br>";
									 echo "<br>";
									}
									mysql_close($link);
									}
									}
								?>
</body>
</html>