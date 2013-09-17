<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_attestation_type`;");
E_C("CREATE TABLE `dw_attestation_type` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '��������',
  `order` varchar(10) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `jifen` int(20) DEFAULT '0' COMMENT '����',
  `summary` varchar(200) DEFAULT NULL COMMENT '���',
  `remark` varchar(200) DEFAULT NULL COMMENT '��ע',
  `addtime` varchar(50) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=gbk");
E_D("replace into `dw_attestation_type` values('1','������˵�������롢�ʲ���ְ������ʵ���Ч���ϣ����������������ݵĶ����ڴˣ�','10','1','0','','','1290221365','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('2','�������˵��','10','1','0','','','1290221472','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('3','���ñ���','10','1','0','','','1290221481','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('4','����ŵ��','10','1','0','','','1290221508','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('5','�ֻ�ͨ����¼�嵥�����2���£�','10','1','0','','','1290221519','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('6','�̶��绰ͨ����¼�嵥�����2���£�','10','1','0','','','1290221528','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('7','�������֤����','10','1','0','','','1290221554','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('8','�������֤����','10','1','0','','','1290221611','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('9','���֤','10','1','0','','','1290221625','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('10','���ڱ�','10','1','0','','','1290221635','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('11','ѧλ֤����ҵ֤��','10','1','0','','','1290221648','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('12','��3�������д������ʼ�¼�����ת�˴���¼','10','1','0','','','1290221670','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('13','�Ͷ���ͬ��λ֤������֤','10','1','0','','','1290221680','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('14','��˾������ˮ���������£�','10','1','0','','','1290221692','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('15','��������֤','10','1','0','','','1290221702','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('16','Ӫҵִ�ո�������Ҫ��ɫ��','10','1','0','','','1290221717','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('17','ˮ�ѷ�Ʊ���ѷ�Ʊ��ú����Ʊ�����2���£�','10','1','0','','','1290221765','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('18','��ס�����޺�ͬ','10','1','0','','','1290221780','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('19','����֤','10','1','25','','','1290221790','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('20','������','10','1','0','','','1290221809','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('21','��˰֤','10','1','0','','','1290224402','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('22','��˰֤','10','1','0','','','1290224413','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('23','��ʻ֤','10','1','0','','','1290224431','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('24','��ʻ֤','10','1','20','','','1290224442','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('25','�籣','10','1','0','','','1290247374','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('26','ס��������','10','1','0','','','1290247387','113.83.212.28');");
E_D("replace into `dw_attestation_type` values('27','��ס֤(��ס֤)','10','1','5','','','1291959716','113.83.210.89');");

require("../../inc/footer.php");
?>