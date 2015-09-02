<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
//即使是注销时，也必须首先开始会话才能访问会话变量
session_start();
//使用一个会话变量检查登录状态
if(isset($_SESSION['user_id'])){
    //要清除会话变量，将$_SESSION超级全局变量设置为一个空数组
    $_SESSION = array();
    //如果存在一个会话cookie，通过将到期时间设置为之前1个小时从而将其删除
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),'',time()-3600);
    }
    //使用内置session_destroy()函数调用撤销会话
    session_destroy();
}
//location首部使浏览器重定向到另一个页面
$home_url = 'logIn.php';
header('Location:'.$home_url);
?>
</body>
</html>