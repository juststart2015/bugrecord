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
			$('#tt').datagrid({
				rowStyler:function(index,row){
					if (row.zt == '处理中'){
						return 'color:red;';
					}
				}
			});
		});
	
		//以下函数执行搜索任务
		function doSearch(){
			var a = $('#ksrq').datebox('getValue');
			var b = $('#jsrq').datebox('getValue');
			//if..else..函数，用于判断当日期控件内值为空时，执行什么查询条件，当不为空时，执行什么查询条件；
			if(a =='' & b ==''){
				$('#tt').datagrid('load',{
				id: $('#id').val(),
				zt: $('#zt').val(),
				tcr: $('#tcr').val(),
				wtms: $('#wtms').val(),
				cljg: $('#cljg').val()
			});
				}
			else{
			$('#tt').datagrid('load',{
				//datebox获取值：var starttime=$('#starttime').datebox('getValue');
				ksrq: $('#ksrq').datebox('getValue'),
				jsrq: $('#jsrq').datebox('getValue'),
				id: $('#id').val(),
				zt: $('#zt').val(),
				tcr: $('#tcr').val(),
				wtms: $('#wtms').val(),
				cljg: $('#cljg').val()
			});
			}
		}
		
		//以下函数获取选择的数据并进行编辑
		function getSelected(){
			//该语句获取id为tt的所有的值，并赋在一个数组row里
			var row = $('#tt').datagrid('getSelected');
				//以下语句用于把数组row里的值显示到fm表格里
				if (row){
                $('#win_edit').dialog('open').dialog('setTitle','查询处理过程');//dialog('setTitle','编辑')用于给dialog窗口设置显示名称
                $('#fm').form('load',row);
            	}
				//该语句用于判断状态，若是已完成且用户不是管理员，则不显示编辑按钮，若是处理中或用户为管理员，则显示编辑按钮
				var val;
				var val1;
				val = document.form_edit.zt.value;
				val1 = document.getElementById("poli_name").value;
				if(val == "已完成" & val1 !== "管理员")
				{
					document.getElementById("bj").style.display = "none";
				}
				else
				{
					document.getElementById("bj").style.display = "block";
				}
				
				//以下语句用于根据选中行的问题描述的值来进行数据库查询并显示相应的处理过程值
				var wtms_select = row.wtms;//此句获取wtms框的值
				document.getElementById("wtms_value").value = wtms_select;//此句把wtms的值赋给一个隐藏的input
				//以下代码会自动提交表单，但不能有type、id和name等的值为关键字submit，否则不执行，
				document.getElementById("wtms_tj").submit();
				
				var wtms_select_a = wtms_select.replace("<br>","\r\n");
				document.getElementById("wtms_b").value = wtms_select_a;
				/*
				$('#win_edit').window('open');
				$("#zt_edit").val(row.zt);
				$("#tcr_edit").val(row.tcr);
				$("#djrq_edit").val(row.djrq);
				$("#wtms_edit").val(row.wtms);
				$("#cljg_edit").val(row.cljg);
				$("#clr_edit").val(row.clr);
				$("#wcrq_edit").val(row.wcrq);
				$("#bz_edit").val(row.bz);
				*/
				}
		
		function zj_bt(){
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
			<table id="tt" class="easyui-datagrid" style="height:100%" fitColumns="true" title="搜索" iconCls="icon-search" toolbar="#tb" rownumbers="true" pagination="true" url="system_wl_select.php" nowrap="false" singleselect="true">
    			<thead>
                    <tr>
						<th field="wt_id" width="13" sortable="true">ID</th>
                        <th field="zt" width="23" sortable="true">状态</th>
                        <th field="tcr" width="26" sortable="true">提出人</th>
                        <th field="djrq" width="35" sortable="true">登记日期</th>
                        <th field="wtms" width="200">问题描述</th>
                        <th field="cljg" width="200">处理结果</th>
                        <th field="clr" width="25" sortable="true">处理人</th>
                        <th field="wcrq" width="35" sortable="true">完成日期</th>
                    </tr>
                </thead>
            </table>
			
            <!--以下函数为增加工具栏工具按钮-->
            <div id="tb" style="padding:3px;">
            	<p>
                	时间：<input id="ksrq" class="easyui-datebox" style="width:95px" />
                    至:<input id="jsrq" class="easyui-datebox" style="width:95px" />
                    <span>问题描述:</span>
                    <input id="wtms" style="border:1px solid #ccc"  />
                    <span>处理过程、结果:</span>
                    <input id="cljg" style="border:1px solid #ccc"  />
                </p>
                <p>
					<span>ID:</span><input id="id" style="width:50px" />
					<span>状态:</span>
					<select id="zt" style="width:70px">
						<option value="">全部</option>
                        <option value="处理中">处理中</option>
            			<option value="已完成">已完成</option>
					</select>
                    <!--<input id="zt" style="border:1px solid #ccc; width:80px"  />-->
                    <span>提出人:</span>
                    <input id="tcr" style="border:1px solid #ccc; width:80px"  />
                    <a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" onClick="doSearch()">查询</a>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" 
					onClick="javascript:$('#win_add').window('open')">增加</a>
					<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="getSelected()">查看处理过程</a>
					<!--
                    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="getSelected()">编辑</a>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onClick="getSelected()">Save</a>
                    -->
                </p>
            </div>
            
            <!--以下函数为内容增加框-->
            <div class="easyui-window" id="win_add" title="增加" style="width:95%;height:95%;" closed="true">
            	<form id="zj" style="padding:10px 20px 10px 40px;" action="system_wl_insert.php" method="post">
                	<p>
                    	状态：<select name="zt" style="width:70px">
                        <option value="处理中">处理中</option>
            			<option value="已完成">已完成</option>
            			</select>
                    	提出人：<input type="text" name="tcr" id="zj_tcr" required="required" />
                        <!--登记日期被设置为数据库默认为当前操作时间
						登记日期：<input id="djrq_date" class="easyui-datebox" name="djrq" style="width:95px" />
						-->
                    </p>
                    <div style="float:left; padding-right:5px">
                    <p>
                    	问题描述：
                    </p>
                    <p>
                        <textarea name="wtms" id="zj_wtms" rows="16" cols="60" required="true"></textarea>
                    </p>
                    </div>
                    <div style="float:left">
                    <p>
                        处理过程、结果：
                    </p>
                    <p>	
                        <textarea name="cljg" id="zj_cljg" rows="16" cols="60" required="true"></textarea>
                    </p>
                    </div>
                    <div style="float:left; clear:left">
                    <p>
                    	记录人：<?php echo $_SESSION['username']; ?>
                        处理人：<input type="text" name="clr" id="zj_clr" required="true" />
                        完成日期：<input id="wcrq_date" class="easyui-datebox" name="wcrq" style="width:95px" />
                    </p>
                    <p>
                    	备&nbsp;注：<input type="text" name="bz"></textarea>
                    </p>
                    </div>
                    <div style="padding:5px;text-align:center; float:none; clear:left">
                    	<input class="easyui-linkbutton" name="submit_zj" value="保存" style="width:80px; height:30px" onclick="zj_bt()" />
                    </div>
                </form>
            </div>
			
            <!--以下函数为内容查询编辑框-->
            <div class="easyui-dialog" id="win_edit" title="编辑" style="width:95%;height:95%;" closed="true">
				<div style="display:none">
					<form id="wtms_tj" method="post" target="myiframe" action="cljg_show.php" >
					<input type="text" id="wtms_value" name="wtms_value" />
					<input type="text" name="tablename" value="system_wl_clgc" />
					<input name="submit_zd" />
					</form>
				</div>
				
            	<form style="padding:10px 20px 10px 40px;" action="system_wl_edit.php" method="post" id="fm" name="form_edit">
				
					<!--以下div块用于获取当前用户的权限，以供函数getSelect()调用-->
					<div style="display:none">
						<input type="text" id="poli_name" value="<?php echo $_SESSION['policy'] ?>" />
					</div>
					
					<div id="bj" style="display:block">
						<input class="easyui-linkbutton" value="编辑" style="width:80px; height:30px" 
						onclick="javascript:
						document.getElementById('gx').style.display='block';
						document.getElementById('clr').readOnly='';
						document.getElementById('clr').style.border=''" />
						<span style="font-size:20px">ID:<input name="wt_id" style="font-size:20px; width:60px; border:none" readonly="readonly" /></span>
					</div>
					
					<fieldset style="width:86.5%; height:auto">
					<legend>信息</legend>
                    <p>
                    	状态：<select name="zt" id="zt" style="width:70px;">
            			<option value="已完成">已完成</option>
                		<option value="处理中">处理中</option>
            			</select>
                    	提出人：<input type="text" name="tcr" readonly="readonly" style="border:hidden; width:100px" />
                        登记日期：<input name="djrq" readonly="readonly" style="width:120px; border:hidden" />
                    </p>
					
                    <div style="float:left; clear:left">
                    <p>
                    	处理人：<input type="text" name="clr" id="clr" style="width:80px; border:hidden" readonly="readonly" />
                        完成日期：<input class="easyui-datebox" name="wcrq" style="width:95px" />
                        备注：<input type="text" name="bz" readonly="readonly" style="border:hidden"></textarea>
                    </p>
                    </div>
					</fieldset>
					
                    <div style="float:left; clear:left">
                    <fieldset style="width:auto; height:auto">
                    	<legend>问题描述</legend>
                            <textarea name="wtms" id="wtms_a" readonly="readonly" cols="60" rows="10" style="display:none"></textarea>
							<textarea name="wtms_b" id="wtms_b" readonly="readonly" cols="60" rows="10" style="border:none"></textarea>
                    </fieldset>
                    </div>
                    <div style="float:left;">
                    <fieldset style="width:auto; height:auto">
                    	<legend>处理过程、结果</legend>
							<div id="cljg_show">
								<iframe name="myiframe" style="border:none; width:441px; height:154px;">
									
								</iframe>
							</div>
                    </fieldset>
                    </div>
					
					<div id="gx" style="display:none">
                    <div style="float:left; clear:left">
					<fieldset style="width:auto; height:auto">
                    	<legend>编辑更新</legend>
                            <textarea name="gx" cols="60" rows="10" style="border:hidden"></textarea>
                    </fieldset>
                    </div>
					
                    <div style="float:left; clear:left">
                    <p>
                        更新人：<?php echo $_SESSION['username']; ?>
                    </p>
                    </div>
					
					<div style="padding:5px; float:left; clear:left">
						<input class="easyui-linkbutton" value="取消" style="width:80px; height:30px" onclick="javascript:document.getElementById('gx').style.display='none';document.getElementById('clr').readOnly='readnoly';document.getElementById('clr').style.border='hidden'" />
					</div>
                    <div style="padding:5px; float:left;">
                    	<input class="easyui-linkbutton" type="submit" name="submit" value="保存" style="width:80px; height:30px" />
                    </div>
					</div>
					
                </form>
            </div>
    	</div>
    </div>
</body>
</html>