<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_linkage_type`;");
E_C("CREATE TABLE `dw_linkage_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` smallint(6) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `nid` varchar(50) DEFAULT NULL,
  `addtime` int(10) DEFAULT '0',
  `addip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nid` (`nid`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=gbk");
E_D("replace into `dw_linkage_type` values('1','10','����״��','user_marry','0','');");
E_D("replace into `dw_linkage_type` values('2','10','�û�-��Ů','user_child','0','');");
E_D("replace into `dw_linkage_type` values('3','10','�û�-ѧ��','user_education','0','');");
E_D("replace into `dw_linkage_type` values('4','10','�û�-����','user_income','0','');");
E_D("replace into `dw_linkage_type` values('5','10','�û�-�籣','user_shebao','0','');");
E_D("replace into `dw_linkage_type` values('6','10','�û�-ס������','user_housing','0','');");
E_D("replace into `dw_linkage_type` values('7','10','�û�-�Ƿ��г�','user_car','0','');");
E_D("replace into `dw_linkage_type` values('8','10','�û�-�Ƿ�����','user_late','0','');");
E_D("replace into `dw_linkage_type` values('9','10','�û�-����״��','user_status','0','');");
E_D("replace into `dw_linkage_type` values('10','10','�û�-��˾����','user_company_type','0','');");
E_D("replace into `dw_linkage_type` values('11','10','�û�-��˾��ҵ','user_company_industry','0','');");
E_D("replace into `dw_linkage_type` values('12','10','�û�-��������','user_company_jibie','0','');");
E_D("replace into `dw_linkage_type` values('13','10','�û�-ְ λ','user_company_office','0','');");
E_D("replace into `dw_linkage_type` values('14','10','�û�-��������','user_company_workyear','0','');");
E_D("replace into `dw_linkage_type` values('15','10','�û�-��Ӫ����','user_private_place','0','');");
E_D("replace into `dw_linkage_type` values('16','10','�û�-���з���','user_finance_property','0','');");
E_D("replace into `dw_linkage_type` values('17','10','�û�-��������','user_finance_car','0','');");
E_D("replace into `dw_linkage_type` values('18','10','�û�-��ϵ�˹�ϵ','user_relation','0','');");
E_D("replace into `dw_linkage_type` values('19','10','�����;','borrow_use','0','');");
E_D("replace into `dw_linkage_type` values('20','10','�������','borrow_time_limit','0','');");
E_D("replace into `dw_linkage_type` values('21','10','���ʽ','borrow_style','0','');");
E_D("replace into `dw_linkage_type` values('22','10','���Ͷ����','borrow_lowest_account','0','');");
E_D("replace into `dw_linkage_type` values('23','10','���Ͷ���ܶ�','borrow_most_account','0','');");
E_D("replace into `dw_linkage_type` values('24','10','��Чʱ��','borrow_valid_time','0','');");
E_D("replace into `dw_linkage_type` values('25','10','�ʻ�����','account_bank','0','');");
E_D("replace into `dw_linkage_type` values('26','10','����Ϣ����','message_type','0','');");
E_D("replace into `dw_linkage_type` values('27','10','��˽��������','yinsi','0','');");
E_D("replace into `dw_linkage_type` values('28','10','���뱣������','pwd_protection','0','');");
E_D("replace into `dw_linkage_type` values('29','10','��������','friends_type','0','');");
E_D("replace into `dw_linkage_type` values('30','10','�û��ʽ����','account_type','0','');");
E_D("replace into `dw_linkage_type` values('31','10','56������','nation','0','');");
E_D("replace into `dw_linkage_type` values('32','10','֤�����','card_type','0','');");
E_D("replace into `dw_linkage_type` values('33','10','�б��״̬','borrow_type','0','');");
E_D("replace into `dw_linkage_type` values('34','10','������;','borrow_yongtu','0','');");
E_D("replace into `dw_linkage_type` values('35','10','��������','borrow_qixian','0','');");
E_D("replace into `dw_linkage_type` values('36','10','��Χ','account_amange','0','');");

require("../../inc/footer.php");
?>