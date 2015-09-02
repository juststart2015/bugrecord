//$(function ()����ҳ�������Ϻ�ʼִ�����º���
$(function () {
    InitLeftMenu();
    $('body').layout();//������body�ڴ���һ��layout
})

function InitLeftMenu() {
    $('.easyui-accordion li a').click(function () {//accordionչ�����ڵ�li�б��µ�a���ӱ����ʱִ�����º���
        var tabTitle = $(this).text();//�������tabTitle��ֵΪ���Ŀ���ڵ��ı�ֵ
        var url = $(this).attr("href");//�������url��ֵΪ���Ŀ���ڵ�href��ַ
        addTab(tabTitle, url);//ִ�к���addTab��������һ����ǩҳ����ֵΪtabTitle��url
		//���º�������������������б��Ӧ�����ϵı仯��ʾ��ʽ
        $('.easyui-accordion li div').removeClass("selected");//removeClass()�﷨���Ƴ�accordionչ�����ڵ�li�б��µ�ѡ�е�div�����
        $(this).parent().addClass("selected");//parent()����ѡ��Ŀ��ĸ�Ԫ�أ���������selected
    }).hover(function () {
        $(this).parent().addClass("hover");
    }, function () {
        $(this).parent().removeClass("hover");
    });
}

function addTab(subtitle, url) {
    if (!$('#tabs').tabs('exists', subtitle)) {//exists����֤һ���ض���ѡ��Ƿ����,�ӣ���ʾ�������ڣ�ִ�����溯��������ִ��else
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