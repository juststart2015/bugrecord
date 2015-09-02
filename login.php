<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
//数据库的位置
define('DB_HOST', 'localhost');
//用户名
define('DB_USER', 'root');
//口令
define('DB_PASSWORD', 'sa');
//数据库名
define('DB_NAME','my_db') ;

//开启一个会话
session_start();

$error_msg = "";
//如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
if(!isset($_SESSION['user_id'])){
    if(isset($_POST['submit'])){//用户提交登录表单时执行如下代码
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		mysqli_query($dbc,"set names 'utf8'");
        $user_username = mysqli_real_escape_string($dbc,trim($_POST['username']));
        $user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));
        if(!empty($user_username)&&!empty($user_password)){
            $query = "SELECT user_id, username, policy FROM users WHERE username = '$user_username' AND password = '$user_password'";
            //用用户名和密码进行查询
            $data = mysqli_query($dbc,$query);
            //若查到的记录正好为一条，则设置SESSION，同时进行页面重定向
            if(mysqli_num_rows($data)==1){
                $row = mysqli_fetch_array($data);
                $_SESSION['user_id']=$row['user_id'];
                $_SESSION['username']=$row['username'];
				$_SESSION['policy']=$row['policy'];
                $home_url = 'Default.php';
                header('Location: '.$home_url);
            }else{//若查到的记录不对，则设置错误信息
                $error_msg = '请正确输入用户名和密码.';
            }
        }else{
            $error_msg = '请正确输入用户名和密码.';
        }
    	}
		}else{//如果用户已经登录，则直接跳转到已经登录页面
    		$home_url = 'Default.php';
    		header('Location: '.$home_url);
		}
?>

<html>
    <head>
        <title>登录</title>
    </head>
    <body style="background-image:url(image/blackground.jpg)">
	<div style="width:300px; position:absolute; left:38%; top:30%; color:#FFFFFF">
        <h3>信息部系统维护记录</h3>
        <!--通过$_SESSION['user_id']进行判断，如果用户未登录，则显示登录表单，让用户输入用户名和密码-->
        <?php
        if(!isset($_SESSION['user_id'])){
            echo '<p>'.$error_msg.'</p>';
        ?>
        <!-- $_SERVER['PHP_SELF']代表用户提交表单时，调用自身php文件 -->
        <form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<div style="width:100%">
            <fieldset>
                <legend>登录</legend>

                <label for="username">用户名：</label>
                <!-- 如果用户已输过用户名，则回显用户名 -->
                <input type="text" id="username" name="username"
                value="<?php if(!empty($user_username)) echo $user_username; ?>" /><!--此处判断username框内是否有值，有的话就显示该值-->

                <br />
				<br />
                <label for="password" style="letter-spacing:5.5px">密码：</label>
                <input type="password" id="password" name="password"/>
            </fieldset>
			</div>
			<br />
			<div style="width:100%">
			<div style="text-align:center">
            <input type="submit" value="登录" name="submit" style="width:30%; height:30px;"/>
			</div>
			</div>
        </form>
        <?php
        }
        ?>
	</div>
    </body>
</html>