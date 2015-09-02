//$(function ()）：页面加载完毕后开始执行以下函数
$(function () {
    InitLeftMenu();
    $('body').layout();//在整个body内创建一个layout
})

function InitLeftMenu() {
    $('.easyui-accordion li a').click(function () {//accordion展开列内的li列表下的a连接被点击时执行以下函数
        var tabTitle = $(this).text();//定义变量tabTitle，值为点击目标内的文本值
        var url = $(this).attr("href");//定义变量url，值为点击目标内的href地址
        addTab(tabTitle, url);//执行函数addTab：“增加一个标签页”，值为tabTitle和url
		//以下函数增加鼠标放置在左侧列表对应内容上的变化显示方式
        $('.easyui-accordion li div').removeClass("selected");//removeClass()语法，移除accordion展开列内的li列表下的选中的div块的类
        $(this).parent().addClass("selected");//parent()查找选中目标的父元素，并增加类selected
    }).hover(function () {
        $(this).parent().addClass("hover");
    }, function () {
        $(this).parent().removeClass("hover");
    });
}

function addTab(subtitle, url) {
    if (!$('#tabs').tabs('exists', subtitle)) {//exists，验证一个特定的选项卡是否存在,加！表示若不存在，执行下面函数，否则执行else
        $('#tabs').tabs('add', {
            title: subtitle,
            content: createFrame(url),
            closable: true,
            width: $('#mainPanle').width() - 10,
            height: $('#mainPanle').height() - 26
        });
    } else {
        $('#tabs').tabs('select', subtitle);
    }
}

function createFrame(url) {
    var s = '<iframe scrolling="no" frameborder="0"  src="' + url + '" style="width:100%;height:100%;"></iframe>';
    return s;
}