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
		/*
		$(function(){
			$('#md_list').datagrid({
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
		*/
	
		//以下函数执行搜索任务
		function doSearch(){
			var a = document.getElementById("dh").value;
			var b = document.getElementById("dm").value;
			var c = document.getElementById("dzu").value;
			//if..else..函数，用于判断值为空时，执行什么查询条件，当不为空时，执行什么查询条件；
			if(a =='' & b =='' & c ==''){
				$('#md_list').datagrid('load',{
				dh: $('#dh').val(),
				dm: $('#dm').val(),
				dzu: $('#dzu').val()
			});
				}
			else{
			$('#md_list').datagrid('load',{
				dh: $('#dh').val(),
				dm: $('#dm').val(),
				dzu: $('#dzu').val()
			});
			}
		}
		
		//以下函数获取选择的数据并进行编辑
		function getSelected(){
			//该语句获取id为tt的所有的值，并赋在一个数组row里
			var row = $('#md_list').datagrid('getSelected');
				//以下语句用于把数组row里的值显示到fm表格里
				if (row){
                $('#md_edit').dialog('open').dialog('setTitle','信息修改');//dialog('setTitle','编辑')用于给dialog窗口设置显示名称
                $('#txl_fm').form('load',row);
				//$('#user_name_edit').val(row.username);
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
			<table id="md_list" class="easyui-datagrid" style="height:100%" fitColumns="true" title="搜索" iconCls="icon-search" toolbar="#tb" rownumbers="true" pagination="true" url="txl_select.php" nowrap="false" singleselect="true">
    			<thead>
                    <tr>
                        <th field="dh" width="10" sortable="true">店号</th>
                        <th field="dm" width="26" sortable="true">店名</th>
                        <th field="dz" width="35" sortable="true">店长</th>
						<th field="bgdh" width="35" sortable="true">办公电话</th>
						<th field="yddh" width="35" sortable="true">移动电话</th>
						<th field="dzu" width="35" sortable="true">店组</th>
                    </tr>
                </thead>
            </table>
			
            <!--以下函数为增加工具栏工具按钮-->
            <div id="tb" style="padding:3px;">
            	<p>
					店号：<input type="text" id="dh" style="width:95px" />
                	店名：<input type="text" id="dm" style="width:95px" />
                    店组：	<select id="dzu">
								<option value="">全部</option>
								<option value="组一">组一</option>
								<option value="组二">组二</option>
								<option value="组三">组三</option>
								<option value="组四">组四</option>
								<option value="特殊">特殊</option>
								<option value="标超">标超</option>
								<option value="卖场">卖场</option>
							</select>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" onClick="doSearch()">查询</a>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" 
					onClick="javascript:$('#md_add').window('open')">增加</a>
					<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="getSelected()">信息修改</a>
					<!--
                    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="getSelected()">编辑</a>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onClick="getSelected()">Save</a>
                    -->
                </p>
            </div>
            
            <!--以下函数为内容增加框-->
            <div class="easyui-window" id="md_add" title="门店增加" style="width:38%;height:55%;" closed="true">
            	<form id="md_zj" style="padding:10px 20px 10px 40px;" action="txl_insert.php" method="post">
					<div style="position:absolute; left:30%">
                	<p>
						店号：	<input name="dh_name" type="text" />
					</p>
					<p>
						<!--<span style="letter-spacing:4px">密码：</span>	<input name="user_pasw" type="text" />-->
						店名：	<input name="dm_name" type="text" />
					</p>
					<p>
						店长：	<input name="dz_name" type="text" />
					</p>
					<p>
						办公：	<input name="bgdh_name" type="text" />
					</p>
					<p>
						移动：	<input name="yddh_name" type="text" />
					</p>
					<p>
						店组：	<select name="dzu_name">
									<option value="组一">组一</option>
									<option value="组二">组二</option>
									<option value="组三">组三</option>
									<option value="组四">组四</option>
									<option value="特殊">特殊</option>
									<option value="标超">标超</option>
									<option value="卖场">卖场</option>
								</select>
					</p>
					<p>
						<input type="submit" name="submit" value="保存" />
					</p>
					</div>
                </form>
            </div>
			
            <!--以下函数为内容查询编辑框-->
            <div class="easyui-dialog" id="md_edit" title="信息修改" style="width:38%;height:55%;" closed="true">
            	<form style="padding:10px 20px 10px 40px;" action="txl_edit.php" method="post" id="txl_fm" name="md_edit">
					<div style="position:absolute; left:30%">
						<p>
							店号：<input id="dh_name_edit" name="dh" type="text" readonly="readonly" style="border:none" />
						</p>
						<p>
							店名：<input id="dm_name_edit" name="dm" type="text" />
						</p>
						<p>
							店长：<input id="dz_name_edit" name="dz" type="text" />
						</p>
						<p>
							办公：<input id="bgdh_name_edit" name="bgdh" type="text" />
						</p>
						<p>
							移动：<input id="yddh_name_edit" name="yddh" type="text" />
						</p>
						<p>
						店组：	<select id="dzu_name_edit" name="dzu">
									<option value="组一">组一</option>
									<option value="组二">组二</option>
									<option value="组三">组三</option>
									<option value="组四">组四</option>
									<option value="特殊">特殊</option>
									<option value="标超">标超</option>
									<option value="卖场">卖场</option>
								</select>
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