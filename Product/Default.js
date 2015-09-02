$(function () {

    dlg_Edit = $('#Dlg-Edit').dialog({
        closed: true,
        modal: true,
        toolbar: [{
            text: '保存',
            iconCls: 'icon-save',
            handler: saveData
        }, '-', {
            text: '关闭',
            iconCls: 'icon-no',
            handler: function () {
                dlg_Edit.dialog('close');
            }
        }]
    });
    dlg_Edit_form = dlg_Edit.find('form');

    $('#btn-search,#btn-search-cancel').linkbutton();
    searchWin = $('#search-window').window({
        closed: true,
        modal: true
    });
    searchForm = searchWin.find('form');


		tree = $('#tree').tree({
        checkbox: false,
        methord:'get',
        url: 'GetClassJsonByPid.ashx?pid=0&ran='+Math.random(),
        onBeforeExpand: function (node, param) {
            //alert(node.id);
            $('#tree').tree('options').url = "GetClassJsonByPid.ashx?pid=" + node.id; // change the url                       
            //param.myattr = 'test';    // or change request parameter
        },
        onClick: function (node) {
            clickTree(node.id);
        }
    });


    grid = $('#grid').datagrid({
        title: '产品管理',
        iconCls: 'icon-save',
        methord: 'get',
        url: 'Handler.ashx?action=list&ran='+Math.random(),
        sortName: 'ID',
        sortOrder: 'desc',
        idField: 'ID',
        pageSize: 30,
        frozenColumns: [[
	                { field: 'ck', checkbox: true }
        //,{ title: 'ID', field: 'ID', width: 80, sortable: true }
				]],
        columns: [[
					{ field: 'title', title: '名称', width: 150 },
					{ field: 'addTime', title: '添加日期', width: 150, sortable: true }
				]],
        fit:true,
        pagination: true,
        rownumbers: true,
        fitColumns: true,
        singleSelect: false,
        toolbar: [{
            text: '新增',
            iconCls: 'icon-add',
            handler: add
        }, '-', {
            text: '修改',
            iconCls: 'icon-edit',
            handler: edit
        }, '-', {
            text: '删除',
            iconCls: 'icon-remove',
            handler: del
        }, '-', {
            text: '查找',
            iconCls: 'icon-search',
            handler: OpensearchWin
        }, '-', {
            text: '所有',
            iconCls: 'icon-search',
            handler: showAll
        }],
        onHeaderContextMenu: function (e, field) {
            e.preventDefault();
            if (!$('#tmenu').length) {
                createColumnMenu();
            }
            $('#tmenu').menu('show', {
                left: e.pageX,
                top: e.pageY
            });
        }
    });
    $('body').layout();
});

function createColumnMenu() {
    var tmenu = $('<div id="tmenu" style="width:100px;"></div>').appendTo('body');
    var fields = grid.datagrid('getColumnFields');
    for (var i = 0; i < fields.length; i++) {
        $('<div iconCls="icon-ok"/>').html(fields[i]).appendTo(tmenu);
    }
    tmenu.menu({
        onClick: function (item) {
            if (item.iconCls == 'icon-ok') {
                grid.datagrid('hideColumn', item.text);
                tmenu.menu('setIcon', {
                    target: item.target,
                    iconCls: 'icon-empty'
                });
            } else {
                grid.datagrid('showColumn', item.text);
                tmenu.menu('setIcon', {
                    target: item.target,
                    iconCls: 'icon-ok'
                });
            }
        }
    });
}

var tree;
var grid;
var dlg_Edit;
var dlg_Edit_form;
var searchWin;
var searchForm;

function clickTree(nodeid) {
    grid.datagrid({ url: 'Handler.ashx?action=list&PID=' + nodeid });
    grid.datagrid('clearSelections');
}

function getSelectedArr() {
    var ids = [];
    var rows = grid.datagrid('getSelections');
    for (var i = 0; i < rows.length; i++) {
        ids.push(rows[i].ID);
    }
    return ids;
}
function getSelectedID() {
    var ids = getSelectedArr();
    return ids.join(',');
}
function arr2str(arr) {
    return arr.join(',');
}

function add() {
    dlg_Edit.dialog('open');
    dlg_Edit_form.form('clear');
    dlg_Edit_form.url = 'Handler.ashx?action=save';
}
function edit() {
    var rows = grid.datagrid('getSelections');
    var num = rows.length;
    if (num == 0) {
        Msgslide('请选择一条记录进行操作!'); //$.messager.alert('提示', '请选择一条记录进行操作!', 'info');
        return;
    }
    else if (num > 1) {
        Msgfade('您选择了多条记录,只能选择一条记录进行修改!'); //$.messager.alert('提示', '您选择了多条记录,只能选择一条记录进行修改!', 'info');
        return;
    }
    else {
        dlg_Edit.dialog('open');
        dlg_Edit_form.form('load', 'Handler.ashx?action=get&id=' + rows[0].ID);
        dlg_Edit_form.url = 'Handler.ashx?action=save&id=' + rows[0].ID;
    }
}
function del() {
    var arr = getSelectedArr();
    if (arr.length > 0) {
        $.messager.confirm('提示信息', '您确认要删除吗?', function (data) {
            if (data) {
                $.ajax({
                    url: 'Handler.ashx?action=del&id=' + arr2str(arr),
                    type: 'GET',
                    timeout: 1000,
                    error: function () {
                        $.messager.alert('错误', '删除失败!', 'error');
                    },
                    success: function (data) {
                        eval('data=' + data);
                        if (data.success) {
                            grid.datagrid('reload');
                            grid.datagrid('clearSelections');
                        } else {
                            $.messager.alert('错误', data.msg, 'error');
                        }
                    }
                });
            }
        });
    } else {
        Msgshow('请先选择要删除的记录。');
    }
}

function Msgshow(msg) {
    $.messager.show({
        title: '提示',
        msg: msg,
        showType: 'show'
    });
}
function Msgslide(msg) {
    $.messager.show({
        title: '提示',
        msg: msg,
        timeout: 3000,
        showType: 'slide'
    });
}
function Msgfade(msg) {
    $.messager.show({
        title: '提示',
        msg: msg,
        timeout: 3000,
        showType: 'fade'
    });
}

function showAll() {
    grid.datagrid({ url: 'Handler.ashx?action=list' });
}
function OpensearchWin() {
    searchWin.window('open');
    searchForm.form('clear');
}

function saveData() {
    dlg_Edit_form.form('submit', {
        url: dlg_Edit_form.url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (data) {
            //alert(data);
            eval('data=' + data);
            if (data.success) {
                grid.datagrid('reload');
                dlg_Edit.dialog('close');
            } else {
                $.messager.alert('错误', data.msg, 'error');
            }
        }
    });
}

function SearchOK() {
    var s_title = $("#s_title").val();
    searchWin.window('close');
    grid.datagrid({ url: 'Handler.ashx?action=query', queryParams: { title: s_title} });
}
function closeSearchWindow() {
    searchWin.window('close');
}
 