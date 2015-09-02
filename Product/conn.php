<?php

$conn = @mysql_connect('localhost','root','sa');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('my_db', $conn);
mysql_query("SET NAMES UTF8");

?>