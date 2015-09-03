<?php
	include 'conn.php';
	
	//三元操作符?,语法：条件 ? 结果1 : 结果2,问号前面的位置是判断的条件，如果满足条件时结果1，不满足时结果2
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	//isset()判断变量是否已配置，?为三元操作符，若已配置变量，则把变量转换成int型，若没配置变量，则赋值1
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	//同理，若配置变量rows则转换为int型，若没有，则赋值10
	
	//以下函数取搜索开始日期及结束日期
	$ksrq = isset($_POST['ksrq']) ? mysql_real_escape_string($_POST['ksrq']) : '1899-11-30';
	//以下语句通过strtotime把时间戳转换为unix格式，再通过date转换为带时分秒的日期，以便查询使用
	$jsrq = isset($_POST['jsrq']) ? date("Y-m-d 23:59:59",strtotime($_POST['jsrq'])) : '2999-12-31';
	
	$id = isset($_POST['id']) ? mysql_real_escape_string($_POST['id']) : '';
	$zt = isset($_POST['zt']) ? mysql_real_escape_string($_POST['zt']) : '';
	//同理，是否配置变量zt，若没有则空，若有则把值转换为string型
	$tcr = isset($_POST['tcr']) ? mysql_real_escape_string($_POST['tcr']) : '';
	//同理，是否配置变量tcr，若没有则为空，若有则把值转换为string型
	$wtms = isset($_POST['wtms']) ? mysql_real_escape_string($_POST['wtms']) : '';
	$cljg = isset($_POST['cljg']) ? mysql_real_escape_string($_POST['cljg']) : '';
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'zt';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	//sort和order参数用于设置排序
	$offset = ($page-1)*$rows;
	//page为设置的页数，rows为设置的列数（即显示的列）
	$result = array();//新建一个result数组
	
	$where = "djrq between '$ksrq' and '$jsrq' and wt_id like '$id%' and zt like '$zt%' and tcr like '$tcr%' and wtms like '%$wtms%' and cljg like '%$cljg%'";//模糊查询语句like
	$rs = mysql_query("select count(*) from system_cw where " . $where);
	//select count(*) from item指从item表中查询出总记录条数，并返回给rs
	$row = mysql_fetch_row($rs);
	//从rs里获取的变成数组赋给row
	$result["total"] = $row[0];
	//把row数组里的第一条赋给result
	
	$rs = mysql_query("select * from system_cw where " . $where . " order by $sort $order limit $offset,$rows");
	//执行查询语句，查询item表中满足模糊语句的条件且只查询offset、rows内的数量限制的记录
	$items = array();
	//创建一个items数组
	while($row = mysql_fetch_object($rs))
	//把rs里获取的内容变成数组赋给row，并遍历该数组
	{
		array_push($items, $row);
		//push() 方法可向数组的末尾添加一个或多个元素，并返回新的长度。
		//这里给吧items和row的值添加到数组里去，并返回添加后数组的长度值
	}
	$result["rows"] = $items;
	//把items的值赋给result
	
	echo json_encode($result);
	//把result的值转换为json数据
?>