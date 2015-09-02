<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统使用维护问题汇总</title>
	<?php
		session_start();
	?>
	<link rel="stylesheet" type="text/css" href="jquery-easyui-1.4.2/themes/default/easyui.css" />
	<link rel="stylesheet" type="text/css" href="jquery-easyui-1.4.2/themes/icon.css" />
    <link rel="stylesheet" type="text/css" href="jquery-easyui-1.4.2/demo/demo.css" />
    <script type="text/javascript" src="jquery-easyui-1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="Default.js"></script>
	<script type="text/javascript">
		//userset()函数用于判断登录用户是否为管理员，若不是管理员，则无法看到用户管理模块
		function userset()
		{
			var userpolicy = document.getElementById("userset").value;
			if(userpolicy !== "管理员")
			{
				document.getElementById("userset_li").style.display = "none";
			}
		}
	</script>
    <style type="text/css">
        .easyui-accordion ul
        {
            list-style-type: none;
            margin: 0px;
            padding: 10px;
        }
        .easyui-accordion ul li
        {
            padding: 0px;
        }
        .easyui-accordion ul li a
        {
            line-height: 24px;
			color:#00F;
			text-decoration:none;
        }
        .easyui-accordion ul li div
        {
            margin: 2px 0px;
            padding-left: 10px;
            padding-top: 2px;
        }
        .easyui-accordion ul li div.hover
        {
            border: 1px dashed #99BBE8;
            background: #E0ECFF;
            cursor: pointer;
			/*
			1、cursor指定不同的光标样式
			2、div.hover，指鼠标放到div上时触发事件
			*/
        }
        .easyui-accordion ul li div.hover a
        {
            color: #416AA3;
        }
        .easyui-accordion ul li div.selected
        {
            border: 1px solid #99BBE8;
            background: #E0ECFF;
            cursor: default;
        }
        .easyui-accordion ul li div.selected a
        {
            color: #416AA3;
            font-weight: bold;
        }
		a:link    {color:blue; text-decoration:none}
		a:visited {color:blue; text-decoration:none}
		a:hover   {color:blue; text-decoration:none}
		a:active  {color:blue; text-decoration:none}
    </style>
</head>

<body class="easyui-layout" style="overflow-y: hidden" scroll="no" onload="userset()">
    <noscript>
        <div style="position: absolute; z-index: 100000; height: 2046px; top: 0px; left: 0px;
            width: 100%; background: white; text-align: center;">
            <img src="image/blackground.jpg" alt='抱歉，请开启脚本支持！' />
        </div>
    </noscript>
	
	<div style="display:none">
		<input type="text" id="userset" value="<?php echo $_SESSION['policy'] ?>" />
	</div>

    <div region="north" split="true" style="overflow: hidden; height: 30px; background: #D2E0F2;line-height: 20px; color:#009;">
        欢迎使用
		<!--这里的if语句用于判断用户是否登录，登录则输出用户名及权限，未登录，则跳转到登录页面-->
		<?php
		if(isset($_SESSION['username'])){
		echo $_SESSION['policy'];
		echo '&nbsp;';
    	echo $_SESSION['username'];
    	echo '<a href="loginOut.php"> 注销</a>';
		}
		else{
 		echo '<script>location.href="login.php";</script>';
		}
		?>
		<a href="" style="float:right;" onclick="javascript:window.open('Product/user_tanc.php','','width=350,height=200,toolbar=no, status=no, menubar=no, resizable=yes, scrollbars=yes');return false;">| 密码修改</a>
        <a href="http://10.10.203.30/login.aspx" style="float:right;" target="_blank">| OA内部邮箱</a>
        <a href="http://10.10.203.30/login.aspx" style="float:right;" target="_blank">| 通讯录</a>
        <a href="http://58.210.67.165:8050/Account/Login1" style="float:right;" target="_blank">| 供应链</a>
        <a href="http://10.10.10.18:8080/NEWMIS/login.jsp;jsessionid=3CBEF897BF2213392B4CB20066BD42D4" style="float:right;" target="_blank">中银查询</a>
    </div>
    
    <div region="south" style="height: 20px; background: #D2E0F2;">
        <div style="text-align: center; font-weight: bold">ver 1.0</div>
    </div>
    
    <div region="west" split="true" title="导航菜单" style="width:180px; overflow:hidden;" iconCls="icon-redo">
        <div class="easyui-accordion" fit="true" border="false">
            <div title="问题查询" style="overflow:auto; padding: 10px;" iconCls="icon-edit">
                <div title="问题查询">
                    <ul>
                        <li>
                            <div><a href="#" onclick="addTab('超市','Product/system_cs.php')">超市</a></div>
                            <!--target属性定义被连接的文档在何处显示-->
                        </li>
                        <li>
                            <div><a href="#" onclick="addTab('百货','Product/system_bh.php')">百货</a></div>
                        </li>
                        <li>
                            <div><a href="#" onclick="addTab('财务','Product/system_cw.php')">财务</a></div>
                        </li>
                        <li>
                            <div><a href="#" onclick="addTab('会员','Product/system_hy.php')">会员</a></div>
                        </li>
                        <li>
                            <div><a href="#" onclick="addTab('POS插件','Product/system_poscj.php')">POS插件</a></div>
                        </li>
                        <li>
                            <div><a href="#" onclick="addTab('网络','Product/system_wl.php')">网络</a></div>
                        </li>
                        <li>
                            <div><a href="#" onclick="addTab('硬件','Product/system_yj.php')">硬件</a></div>
                        </li>
                        <li>
                            <div><a href="#" onclick="addTab('供应链','Product/system_gyl.php')">供应链</a></div>
                        </li>
                        <li>
                            <div><a href="#" onclick="addTab('OA办公','Product/system_oa.php')">OA办公</a></div>
                        </li>
                        <li>
                            <div><a href="#" onclick="addTab('其他','Product/system_qt.php')">其他</a></div>
                        </li>
                    </ul>
                </div>
            </div>
			
			<div title="需求管理" style="padding:10px;" iconCls="icon-edit">
                <div title="需求管理">
                    <ul>
                        <li>
                            <div><a href="#" onclick="addTab('提交齐扬','Product/system_tjqy.php')">提交齐扬</a></div>
                        </li>
                        <li>
                            <div><a href="#" onclick="addTab('业务部门提交','Product/system_bmtj.php')">业务部门提交</a></div>
                        </li>
                    </ul>
                </div>
            </div>
			
            <div title="其他" style="padding:10px;" iconCls="icon-edit">
                <div title="快速链接">
                    <ul>
                        <li>
                            <div>
                            	<a href="#" onclick="addTab('OA邮箱','http://10.10.203.30/login.aspx')">OA邮箱</a>
                            </div>
                        </li>
                        <li>
                            <div>
                            	<a href="#" onclick="addTab('中银查询','http://10.10.10.18:8080/NEWMIS/login.jsp;jsessionid=3CBEF897BF2213392B4CB20066BD42D4')">中银查询</a>
                            </div>
                        </li>
                        <li>
                            <div>
                            	<a href="#" onclick="addTab('供应链','http://58.210.67.165:8050/Account/Login1')">供应链</a>
                            </div>
                        </li>
						<li>
                            <div>
                            	<a href="#" onclick="addTab('通讯录','Product/txl.php')">通讯录</a>
                            </div>
                        </li>
						<li id="userset_li">
							<div>
								<a href="#" onclick="addTab('用户管理','Product/userset.php')">用户管理</a>
							</div>
						</li>
                    </ul>
                </div>
            </div>
            <!--
            <div title="关于" iconCls="icon-help">
                <h4>Ver 1.0</h4>
            </div>
            -->
        </div>
    </div>
    
    <div region="center" id="mainPanle" style="background: #eee;overflow:hidden;">
        <div id="tabs" class="easyui-tabs" fit="true" border="false">
            <div title="主页" style="padding: 20px;">
            <div class="easyui-panel" title="通知公告" collapsible="true" style="width:100%;height:30%;padding:10px;">
				
			</div>
            <p></p>
            <div class="easyui-panel" title="最新更新" collapsible="true" style="width:100%;height:65%;padding:10px;">
				
			</div>
            </div>
        </div>
    </div>
</body>
</html>
