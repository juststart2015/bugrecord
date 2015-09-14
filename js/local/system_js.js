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
		yxj: $('#yxj').val(),
		lx: $('#lx').val(),
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
		yxj: $('#yxj').val(),
		lx: $('#lx').val(),
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
		//以下语句用于替换获取wtms值的第一个testarea，值为获取第一个testarea里的值并替换掉<br>，变为\r\n，以供testarea识别，并正确美观的显示在页面
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