
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
	<h3>添加更新|<a href="update_list.php">返回</a></h3>
	<form action="update_insert.php" method="post">
		<table width="90%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
			<tr>
				<td align="right" width="10%">更新概述</td>
				<td><input type="text" size="80" name="gxgs"  placeholder="请输入更新概述"/></td>
			</tr>
			<tr>
				<td align="right">更新人</td>
				<td><input type="text" name="gxr"  placeholder="请输入更新人"/></td>
			</tr>
			<tr>
				<td align="right">更新日期</td>
				<td><input class="easyui-datebox" name="gxrq" style="width:95px" /></td>
			</tr>
			<tr>
				<td align="right">更新内容</td>
				<td>
					<textarea name="gxnr" id="editor_id" style="width:100%;height:150px;"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit"  value="发布更新"/></td>
			</tr>
		</table>
	</form>
</body>
</html>