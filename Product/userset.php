<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主页</title>
	<?php
		session_start();
	?>
	<link rel="stylesheet" type="text/css" href="../jquery-easyui-1.4.2/themes/default/easyui.css" />
	<link rel="stylesheet" type="text/css" href="../jquery-easyui-1.4.2/themes/icon.css" />
    <!--<link rel="stylesheet" type="text/css" href="../jquery-easyui-1.4.2/demo/demo.css" />-->
    <script type="text/javascript" src="../jquery-easyui-1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="../jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../jquery-easyui-1.4.2/locale/easyui-lang-zh_CN.js"></script>
    <script>
		//以下函数当zt列为空时，显示背景色为粉色，字体颜色为蓝色
		$(function(){
			$('#user_list').datagrid({
				rowStyler:function(index,row){
					if (row.policy == '管理员'){
						return 'color:red;';
					}
					else
					{
						return 'color:blue;';
					}
				}
			});
		});
	
		//以下函数执行搜索任务
		function doSearch(){
			var a = document.getElementById("yhm").value;
			var b = document.getElementById("yhz").value;
			//if..else..函数，用于判断值为空时，执行什么查询条件，当不为空时，执行什么查询条件；
			if(a =='' & b ==''){
				$('#user_list').datagrid('load',{
				//yhm和yhz是load方法的参数，其值为#yhm和#yhz对应的值
				yhm: $('#yhm').val(),
				yhz: $('#yhz').val()
			});
				}
			else{
			$('#user_list').datagrid('load',{
				yhm: $('#yhm').val(),
				yhz: $('#yhz').val()
			});
			}
		}
		
		//以下函数获取选择的数据并进行编辑
		function getSelected(){
			//该语句获取id为tt的所有的值，并赋在一个数组row里
			var row = $('#user_list').datagrid('getSelected');
				//以下语句用于把数组row里的值显示到fm表格里
				if (row){
                $('#user_edit').dialog('open').dialog('setTitle','密码修改');//dialog('setTitle','编辑')用于给dialog窗口设置显示名称
                //$('#user_fm').form('load',row);
				$('#user_name_edit').val(row.username);
            	}
				}
		
		function required(){
			var zj_tcr = document.getElementById("zj_tcr").value;
			if(zj_tcr == "")
			{
				alert ("提出人必填");
				return false;
			}
			else
			{
				var zj_wtms = document.getElementById("zj_wtms").value;
				if(zj_wtms == "")
				{
					alert ("问题描述必填");
					return false;
				}
				else
				{
					var zj_cljg = document.getElementById("zj_cljg").value;
					if (zj_cljg == "")
					{
						alert ("处理结果必填");
						return false;
					}
					else
					{
						var zj_clr = document.getElementById("zj_clr").value;
						if (zj_clr == "")
						{
							alert ("处理人必填");
							return false;
						}
						else
						{
							document.getElementById("zj").submit();
						}
					}
				}
			}
		}
				
	</script>
</head>

<body>
    <div class="easyui-layout" fit="true">
    	<div region="center" fit="true">
			<table id="user_list" class="easyui-datagrid" style="height:100%" fitColumns="true" title="搜索" iconCls="icon-search" toolbar="#tb" rownumbers="true" pagination="true" url="user_select.php" nowrap="false" singleselect="true">
    			<thead>
                    <tr>
                        <th field="user_id" width="23" sortable="true">用户ID</th>
                        <th field="username" width="26" sortable="true">用户名</th>
                        <th field="policy" width="35" sortable="true">用户组</th>
                    </tr>
                </thead>
            </table>
			
            <!--以下函数为增加工具栏工具按钮-->
            <div id="tb" style="padding:3px;">
            	<p>
                	用户名：<input type="text" id="yhm" style="width:95px" />
                    用户组：	<select id="yhz">
								<option value="">全部</option>
								<option value="管理员">管理员</option>
								<option value="用户">普通用户</option>
							</select>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" onClick="doSearch()">查询</a>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" 
					onClick="javascript:$('#user_add').window('open')">增加</a>
					<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="getSelected()">密码修改</a>
					<!--
                    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="getSelected()">编辑</a>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onClick="getSelected()">Save</a>
                    -->
                </p>
            </div>
            
            <!--以下函数为内容增加框-->
            <div class="easyui-window" id="user_add" title="用户增加" style="width:30%;height:35%;" closed="true">
            	<form id="user_zj" style="padding:10px 20px 10px 40px;" action="user_insert.php" method="post">
					<div style="position:absolute; left:30%">
                	<p>
						用户名：	<input name="user_name" type="text" />
					</p>
					<p>
						<!--<span style="letter-spacing:4px">密码：</span>	<input name="user_pasw" type="text" />-->
						<label for="user_pasw" style="letter-spacing:4.2px">密码：</label>
                		<input type="password" id="user_pasw" name="user_pasw"/>
					</p>
					<p>
						用户组：	<select name="user_policy">
									<option value="用户">普通用户</option>
									<option value="管理员">管理员</option>
								</select>
					</p>
					<p>
						<input type="submit" name="submit" value="保存" />
					</p>
					</div>
                </form>
            </div>
			
            <!--以下函数为内容查询编辑框-->
            <div class="easyui-dialog" id="user_edit" title="修改密码" style="width:30%;height:30%;" closed="true">
            	<form style="padding:10px 20px 10px 40px;" action="user_edit.php" method="post" id="user_fm" name="user_edit">
					<div style="position:absolute; left:30%">
						<p>
							用户名：<input id="user_name_edit" name="user_name_edit" type="text" readonly="readonly" style="border:none" />
						</p>
						<p>
							<!--新密码：<input id="user_pasw_edit" name="user_pasw_edit" type="text" />-->
							<label for="user_pasw_edit">新密码：</label>
                			<input type="password" id="user_pasw_edit" name="user_pasw_edit"/>
						</p>
						<p>
							<input type="submit" name="submit_edit" value="保存" />
						</p>
					</div>
                </form>
            </div>
    	</div>
    </div>
</body>
</html>