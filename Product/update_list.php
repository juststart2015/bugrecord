<?php
	session_start();
	error_reporting (E_ALL & ~E_DEPRECATED & ~E_NOTICE);
	mysql_connect("localhost","root","sa");
	mysql_select_db("my_db");
	mysql_query("set names 'utf8'");
	//$sql = 'select * from update_list';
	//$result = mysql_query($sql);
	//while($row=mysql_fetch_array($result)){
		//$rows[] = $row;	
	//}
	
	$sql = "select * from update_list";
	$totalRows = mysql_num_rows(mysql_query($sql));
	$pageSize = 5;
	$totalPage = ceil($totalRows / $pageSize);
	$page = $_REQUEST['page']?(int)$_REQUEST['page']:1;
	if($page<1 || $page ==null || !is_numeric($page)){
		$page = 1;
	}
	if($page>=$totalPage){
		$page=$totalPage;
	}
	$offset = ($page-1)*$pageSize;
	$sql = "select * from update_list order by id desc limit ".$offset.",".$pageSize; 
	$result = mysql_query($sql);
	while($row=mysql_fetch_array($result)){
		$rows[] = $row;	
	}
	
	//分页函数
	function showPage($page,$totalPage,$sep="&nbsp;"){
		$url = $_SERVER['PHP_SELF'];
		$index =($page ==1)?"首页":"<a href='{$url}?page=1'>首页</a>";
		$last = ($page == $totalPage)?"尾页":"<a href = '{$url}?page={$totalPage}'>尾页</a>";
		$prev = ($page ==1)?"上一页":"<a href = '{$url}?page =".($page-1)."'>上一页</a>";
		$next = ($page == $totalPage)?"下一页":"<a href='{$url}?page=".($page+1)."'>下一页</a>";
		$str = "总共{$totalPage}页/当前是第{$page}页";
		for($i=1;$i<=$totalPage;$i++){
			if($page ==$i){
				$p.="[{$i}]";
			}else{
				$p.="<a href='{$url}?page={$i}'>[{$i}]</a>";
			}
		}
		$pageStr = $str.$sep.$index.$sep.$prev.$sep.$p.$sep.$next.$sep.$last;
		return $pageStr;
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
	<div>
		<h3><a href="update_add.php">添加</a></h3>
	</div>
	<table bgcolor="#D2E0F2">
		<thead>
			<tr>
				<th width="2%">ID</th>
				<th width="10%">更新时间</th>
				<th width="10%">更新人</th>
				<th width="65%">更新概述</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($rows as $row): ?>
			<tr>
				<td align="center"><?php echo $row['id']; ?></td>
				<td align="center"><?php echo $row['update_time']; ?></td>
				<td align="center"><?php echo $row['gxr']; ?></td>
				<td><?php echo "<a href='update_content.php?act=".$row['id']."'>".$row['gxgs']."</a><br>"; ?></td>
			</tr>
			<?php endforeach; ?>
			<!-- 显示分页 -->
			<?php if($totalRows>=$pageSize): ?>
		   		<tr>
					<td colspan="7"><?php echo showPage($page,$totalPage); ?>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</body>
<script type="text/javascript">
	function add_update(){
		window.location = "update_add.php";
	}
</script>
</html>