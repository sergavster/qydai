<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_user_trend`;");
E_C("CREATE TABLE `dw_user_trend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `content` text,
  `addtime` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=gbk COMMENT='�û�������¼'");
E_D("replace into `dw_user_trend` values('1','4',NULL,'�ɹ�������\"<a href=''/invest/a1.html'' target=''_blank''>�뻻  �����¹���</a>\"����','1314064098');");
E_D("replace into `dw_user_trend` values('2','4',NULL,'�ɹ�������\"<a href=''/invest/a2.html'' target=''_blank''>��������</a>\"����','1314099000');");
E_D("replace into `dw_user_trend` values('3','12',NULL,'�ɹ�������\"<a href=''/invest/a3.html'' target=''_blank''>�뻹  ��������</a>\"����','1314249713');");
E_D("replace into `dw_user_trend` values('4','13',NULL,'�ɹ�������\"<a href=''/invest/a4.html'' target=''_blank''>��������  �뻹</a>\"����','1314255213');");
E_D("replace into `dw_user_trend` values('5','15',NULL,'�ɹ�������\"<a href=''/invest/a5.html'' target=''_blank''>������ ����  ����ͨ�� �ͻ�</a>\"����','1314256814');");
E_D("replace into `dw_user_trend` values('6','4',NULL,'�ɹ�������\"<a href=''/invest/a6.html'' target=''_blank''>��л�������Ѷ���վ��֧�� ��������</a>\"����','1314262926');");
E_D("replace into `dw_user_trend` values('7','13',NULL,'�ɹ�������\"<a href=''/invest/a7.html'' target=''_blank''>��վ������ٶȿ찡  �������� ���������</a>\"����','1314268585');");
E_D("replace into `dw_user_trend` values('8','20',NULL,'�ɹ�������\"<a href=''/invest/a8.html'' target=''_blank''>������վ�����ٶȡ����ͨ���ͻ�</a>\"����','1314269005');");
E_D("replace into `dw_user_trend` values('9','12',NULL,'�ɹ�������\"<a href=''/invest/a9.html'' target=''_blank''>������ô���Ͷ���˸�����������</a>\"����','1314272540');");
E_D("replace into `dw_user_trend` values('10','4',NULL,'�ɹ�������\"<a href=''/invest/a10.html'' target=''_blank''>��л����Ͷ�����ѵ�֧�� �������һ��</a>\"����','1314325961');");
E_D("replace into `dw_user_trend` values('11','15',NULL,'�ɹ�������\"<a href=''/invest/a13.html'' target=''_blank''>����2 ��Ͷ������Ͷ����˵���Բ���</a>\"����','1314596378');");
E_D("replace into `dw_user_trend` values('12','25',NULL,'�ɹ�������\"<a href=''/invest/a14.html'' target=''_blank''>��һ�ν�������ö�ȣ�лл֧��</a>\"����','1314596604');");
E_D("replace into `dw_user_trend` values('13','13',NULL,'�ɹ�������\"<a href=''/invest/a15.html'' target=''_blank''>�����ʽ���ת ����2</a>\"����','1314681190');");
E_D("replace into `dw_user_trend` values('14','38',NULL,'�ɹ�������\"<a href=''/invest/a16.html'' target=''_blank''>����꣬������Ϥ��Ϥ</a>\"����','1314684710');");
E_D("replace into `dw_user_trend` values('15','39',NULL,'�ɹ�������\"<a href=''/invest/a17.html'' target=''_blank''>���£�������վʵ��</a>\"����','1314717039');");
E_D("replace into `dw_user_trend` values('16','20',NULL,'�ɹ�������\"<a href=''/invest/a18.html'' target=''_blank''>�����ʽ���ת����������֧��</a>\"����','1314717687');");
E_D("replace into `dw_user_trend` values('17','33',NULL,'�ɹ�������\"<a href=''/invest/a20.html'' target=''_blank''>��һ�� лл </a>\"����','1314758135');");
E_D("replace into `dw_user_trend` values('18','44',NULL,'�ɹ�������\"<a href=''/invest/a21.html'' target=''_blank''>�뻹 ��һ�������ƽ̨ ������վʵ�� </a>\"����','1314759095');");
E_D("replace into `dw_user_trend` values('19','38',NULL,'�ɹ�������\"<a href=''/invest/a22.html'' target=''_blank''>��2��~~~~�ٴ����飡��</a>\"����','1314839992');");
E_D("replace into `dw_user_trend` values('20','4',NULL,'�ɹ�������\"<a href=''/invest/a24.html'' target=''_blank''>��վ��û������ ����С���</a>\"����','1314867685');");
E_D("replace into `dw_user_trend` values('21','49',NULL,'�ɹ�������\"<a href=''/invest/a23.html'' target=''_blank''>¶����  ����</a>\"����','1314867718');");
E_D("replace into `dw_user_trend` values('22','50',NULL,'�ɹ�������\"<a href=''/invest/a25.html'' target=''_blank''>������ ���� Ը��վ����������</a>\"����','1314868055');");
E_D("replace into `dw_user_trend` values('23','39',NULL,'�ɹ�������\"<a href=''/invest/a27.html'' target=''_blank''>Ϊ������׼��  лл֧�� ͨ������</a>\"����','1314872767');");
E_D("replace into `dw_user_trend` values('24','12',NULL,'�ɹ�������\"<a href=''/invest/a28.html'' target=''_blank''>��л��վ�Ľ���  ��������������</a>\"����','1314872777');");
E_D("replace into `dw_user_trend` values('25','28',NULL,'�ɹ�������\"<a href=''/invest/a26.html'' target=''_blank''>������</a>\"����','1314872787');");
E_D("replace into `dw_user_trend` values('26','33',NULL,'�ɹ�������\"<a href=''/invest/a29.html'' target=''_blank''>����3���֧��</a>\"����','1314942602');");
E_D("replace into `dw_user_trend` values('27','38',NULL,'�ɹ�������\"<a href=''/invest/a30.html'' target=''_blank''>��2����ϣ�����~�����ò�ͷ</a>\"����','1315441729');");
E_D("replace into `dw_user_trend` values('28','25',NULL,'�ɹ�������\"<a href=''/invest/a31.html'' target=''_blank''>�����ã����ν�����������ʵ���</a>\"����','1315469184');");
E_D("replace into `dw_user_trend` values('29','4',NULL,'�ɹ�������\"<a href=''/invest/a32.html'' target=''_blank''>�ֲ���վʧ�� Ͷ����ʧ ��</a>\"����','1315487030');");
E_D("replace into `dw_user_trend` values('30','49',NULL,'�ɹ�������\"<a href=''/invest/a33.html'' target=''_blank''>�ֳ���֤�û�  ����2</a>\"����','1315613061');");
E_D("replace into `dw_user_trend` values('31','13',NULL,'�ɹ�������\"<a href=''/invest/a34.html'' target=''_blank''>��Ͷ����Լ��</a>\"����','1315613085');");
E_D("replace into `dw_user_trend` values('32','44',NULL,'�ɹ�������\"<a href=''/invest/a35.html'' target=''_blank''>�����е㳤 6����</a>\"����','1315614559');");
E_D("replace into `dw_user_trend` values('33','50',NULL,'�ɹ�������\"<a href=''/invest/a36.html'' target=''_blank''>ϣ��Ͷ����֧��</a>\"����','1315614572');");
E_D("replace into `dw_user_trend` values('34','28',NULL,'�ɹ�������\"<a href=''/invest/a37.html'' target=''_blank''>Ϊ������ȣ����뻹</a>\"����','1315620090');");
E_D("replace into `dw_user_trend` values('35','28',NULL,'�ɹ�������\"<a href=''/invest/a38.html'' target=''_blank''>�����֣�֧����վ����Ͷ������ӡ��</a>\"����','1315629134');");
E_D("replace into `dw_user_trend` values('36','4',NULL,'�ɹ�������\"<a href=''/invest/a39.html'' target=''_blank''>���Ե�����</a>\"����','1315630256');");
E_D("replace into `dw_user_trend` values('37','39',NULL,'�ɹ�������\"<a href=''/invest/a40.html'' target=''_blank''>���������  3����</a>\"����','1315651652');");
E_D("replace into `dw_user_trend` values('38','4',NULL,'�ɹ�������\"<a href=''/invest/a41.html'' target=''_blank''>��ǰף����ͨ��Ա����ڿ��֣�</a>\"����','1315701402');");
E_D("replace into `dw_user_trend` values('39','28',NULL,'�ɹ�������\"<a href=''/invest/a43.html'' target=''_blank''>������ת���</a>\"����','1316585273');");
E_D("replace into `dw_user_trend` values('40','25',NULL,'�ɹ�������\"<a href=''/invest/a42.html'' target=''_blank''>���ý��ڴη���</a>\"����','1316585291');");
E_D("replace into `dw_user_trend` values('41','68',NULL,'�ɹ�������\"<a href=''/invest/a44.html'' target=''_blank''>��������</a>\"����','1316926695');");
E_D("replace into `dw_user_trend` values('42','62',NULL,'�ɹ�������\"<a href=''/invest/a45.html'' target=''_blank''>������������������������ </a>\"����','1317631450');");
E_D("replace into `dw_user_trend` values('43','25',NULL,'�ɹ�������\"<a href=''/invest/a46.html'' target=''_blank''>��Ҫ��Ǯ</a>\"����','1317906518');");
E_D("replace into `dw_user_trend` values('44','80',NULL,'�ɹ�������\"<a href=''/invest/a47.html'' target=''_blank''>���Ƕ���һ����</a>\"����','1317907896');");
E_D("replace into `dw_user_trend` values('45','86',NULL,'�ɹ�������\"<a href=''/invest/a48.html'' target=''_blank''>�������Դ���Դ�</a>\"����','1320318426');");
E_D("replace into `dw_user_trend` values('46','86',NULL,'�ɹ�������\"<a href=''/invest/a49.html'' target=''_blank''>���Դ���һǧ��</a>\"����','1320328947');");
E_D("replace into `dw_user_trend` values('47','86',NULL,'�ɹ�������\"<a href=''/invest/a50.html'' target=''_blank''>�ٸ���ҽ�һǧ���ٿ顣�ոտ���ʻ֤��һ��Ǯ��</a>\"����','1320386606');");
E_D("replace into `dw_user_trend` values('48','86',NULL,'�ɹ�������\"<a href=''/invest/a51.html'' target=''_blank''>����Ҫ���ˣ����Ǯ׼���̷��ȡ�</a>\"����','1320502991');");
E_D("replace into `dw_user_trend` values('49','90',NULL,'�ɹ�������\"<a href=''/invest/a52.html'' target=''_blank''>лл���ܸ���������ᡣ�һᰴʱ����ҵġ�</a>\"����','1320555145');");
E_D("replace into `dw_user_trend` values('50','92',NULL,'�ɹ�������\"<a href=''/invest/a53.html'' target=''_blank''>�뻹���н��л��ϵ���</a>\"����','1320555722');");
E_D("replace into `dw_user_trend` values('51','94',NULL,'�ɹ�������\"<a href=''/invest/a55.html'' target=''_blank''>���ֻ��һǧ�飬ֻ��һǧ�顣</a>\"����','1320811013');");
E_D("replace into `dw_user_trend` values('52','95',NULL,'�ɹ�������\"<a href=''/invest/a56.html'' target=''_blank''>վ�ڽ����֣��ŵù���λ</a>\"����','1320811519');");
E_D("replace into `dw_user_trend` values('53','96',NULL,'�ɹ�������\"<a href=''/invest/a57.html'' target=''_blank''>���꼱�ٷ�չ�����ʽ�֧��</a>\"����','1320812180');");
E_D("replace into `dw_user_trend` values('54','97',NULL,'�ɹ�������\"<a href=''/invest/a58.html'' target=''_blank''>��󹤳���Ҫ��������ǧ�飬ֻ�ж�ǧ�Ķ��</a>\"����','1320813022');");
E_D("replace into `dw_user_trend` values('55','98',NULL,'�ɹ�������\"<a href=''/invest/a59.html'' target=''_blank''>����,���Ҷ��ָ��.</a>\"����','1320896503');");
E_D("replace into `dw_user_trend` values('56','99',NULL,'�ɹ�������\"<a href=''/invest/a60.html'' target=''_blank''>���̫�ͣ�ˢһˢ�ɡ����뻹��</a>\"����','1320897344');");
E_D("replace into `dw_user_trend` values('57','88',NULL,'�ɹ�������\"<a href=''/invest/a61.html'' target=''_blank''>�뻹,�Դ���.��Ҷ��֧�ְ�.</a>\"����','1320897601');");
E_D("replace into `dw_user_trend` values('58','102',NULL,'�ɹ�������\"<a href=''/invest/a62.html'' target=''_blank''>�������ʽ���ת�����Ǯ������</a>\"����','1321003476');");
E_D("replace into `dw_user_trend` values('59','99',NULL,'�ɹ�������\"<a href=''/invest/a63.html'' target=''_blank''>������ת</a>\"����','1321108410');");
E_D("replace into `dw_user_trend` values('60','100',NULL,'�ɹ�������\"<a href=''/invest/a64.html'' target=''_blank''>Ƿ����ǧ����������</a>\"����','1321435650');");

require("../../inc/footer.php");
?>