<?php
	include 'conn.php';
	
	//��Ԫ������?,�﷨������ ? ���1 : ���2,�ʺ�ǰ���λ�����жϵ������������������ʱ���1��������ʱ���2
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	//isset()�жϱ����Ƿ������ã�?Ϊ��Ԫ���������������ñ�������ѱ���ת����int�ͣ���û���ñ�������ֵ1
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	//ͬ�������ñ���rows��ת��Ϊint�ͣ���û�У���ֵ10
	
	//���º���ȡ������ʼ���ڼ���������
	$ksrq = isset($_POST['ksrq']) ? mysql_real_escape_string($_POST['ksrq']) : '1899-11-30';
	//�������ͨ��strtotime��ʱ���ת��Ϊunix��ʽ����ͨ��dateת��Ϊ��ʱ��������ڣ��Ա��ѯʹ��
	$jsrq = isset($_POST['jsrq']) ? date("Y-m-d 23:59:59",strtotime($_POST['jsrq'])) : '2999-12-31';
	
	$id = isset($_POST['id']) ? mysql_real_escape_string($_POST['id']) : '';
	$zt = isset($_POST['zt']) ? mysql_real_escape_string($_POST['zt']) : '';
	$yxj = isset($_POST['yxj']) ? mysql_real_escape_string($_POST['yxj']) : '';
	//ͬ���Ƿ����ñ���zt����û����գ��������ֵת��Ϊstring��
	$tcr = isset($_POST['tcr']) ? mysql_real_escape_string($_POST['tcr']) : '';
	//ͬ���Ƿ����ñ���tcr����û����Ϊ�գ��������ֵת��Ϊstring��
	$wtms = isset($_POST['wtms']) ? mysql_real_escape_string($_POST['wtms']) : '';
	$cljg = isset($_POST['cljg']) ? mysql_real_escape_string($_POST['cljg']) : '';
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'zt';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	//sort��order����������������
	$offset = ($page-1)*$rows;
	//pageΪ���õ�ҳ����rowsΪ���õ�����������ʾ���У�
	$result = array();//�½�һ��result����
	
	$where = "djrq between '$ksrq' and '$jsrq' and wt_id like '$id%' and zt like '$zt%'and yxj like '$yxj%' and tcr like '$tcr%' and wtms like '%$wtms%' and cljg like '%$cljg%'";//ģ����ѯ���like
	$rs = mysql_query("select count(*) from system_bmtj where " . $where);
	//select count(*) from itemָ��item���в�ѯ���ܼ�¼�����������ظ�rs
	$row = mysql_fetch_row($rs);
	//��rs���ȡ�ı�����鸳��row
	$result["total"] = $row[0];
	//��row������ĵ�һ������result
	
	$rs = mysql_query("select * from system_bmtj where " . $where . " order by $sort $order limit $offset,$rows");
	//ִ�в�ѯ��䣬��ѯitem��������ģ������������ֻ��ѯoffset��rows�ڵ��������Ƶļ�¼
	$items = array();
	//����һ��items����
	while($row = mysql_fetch_object($rs))
	//��rs���ȡ�����ݱ�����鸳��row��������������
	{
		array_push($items, $row);
		//push() �������������ĩβ���һ������Ԫ�أ��������µĳ��ȡ�
		//�������items��row��ֵ��ӵ�������ȥ����������Ӻ�����ĳ���ֵ
	}
	$result["rows"] = $items;
	//��items��ֵ����result
	
	echo json_encode($result);
	//��result��ֵת��Ϊjson����
?>