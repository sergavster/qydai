<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_credit_type`;");
E_C("CREATE TABLE `dw_credit_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '��������',
  `nid` varchar(50) DEFAULT NULL COMMENT '���ִ���',
  `value` int(11) DEFAULT '0' COMMENT '������ֵ',
  `cycle` tinyint(1) DEFAULT '2' COMMENT '�������ڣ�1:һ��,2:ÿ��,3:�������,4:����',
  `award_times` tinyint(4) DEFAULT NULL COMMENT '��������,0:����',
  `interval` int(11) DEFAULT '1' COMMENT 'ʱ��������λ����',
  `remark` text COMMENT '��ע',
  `op_user` int(11) DEFAULT NULL COMMENT '������',
  `addtime` int(11) DEFAULT NULL COMMENT '���ʱ��',
  `addip` varchar(30) DEFAULT NULL COMMENT '���IP',
  `updatetime` int(11) DEFAULT NULL COMMENT '������ʱ��',
  `updateip` varchar(30) DEFAULT NULL COMMENT '������ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_ct_nid` (`nid`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=gbk COMMENT='��������'");
E_D("replace into `dw_credit_type` values('1','������֤','email','10','1','1','0','','0','1282347586','127.0.0.1','0','');");
E_D("replace into `dw_credit_type` values('2','ʵ����֤','realname','10','1','1','0','','0','1282347805','127.0.0.1','0','');");
E_D("replace into `dw_credit_type` values('3','�ֻ���֤','phone','10','1','1','0','','0','1285002118','127.0.0.1','0','');");
E_D("replace into `dw_credit_type` values('4','��Ƶ��֤','video','5','1','0','0','','0','1285002132','127.0.0.1','0','');");
E_D("replace into `dw_credit_type` values('5','�ֳ���֤','scene','20','1','0','0','','0','1285002198','127.0.0.1','0','');");
E_D("replace into `dw_credit_type` values('6','֤������','zhengjian','0','4','0','0','','0','1285002255','127.0.0.1','0','');");
E_D("replace into `dw_credit_type` values('7','Ͷ��ɹ�','invest_success','2','4','0','0','','0','1287675813','119.233.164.154','0','');");
E_D("replace into `dw_credit_type` values('8','���ɹ�','borrow_success','1','4','0','0','','0','1287675904','119.233.164.154','0','');");
E_D("replace into `dw_credit_type` values('9','��̳����','bbs_topics','1','4','0','0','','0','1287676784','119.233.164.154','0','');");
E_D("replace into `dw_credit_type` values('10','��ǰ��ʱ����','borrow_paymengt','2','4','0','0','','0','1287676875','119.233.164.154','0','');");
E_D("replace into `dw_credit_type` values('11','���ڻ���','borrow_paymentover','-5','4','0','0','','0','1287677063','119.233.164.154','0','');");
E_D("replace into `dw_credit_type` values('12','��ǰ3�����ϻ���','advance_3day','5','4',NULL,NULL,NULL,NULL,'1291940289','221.175.17.200',NULL,NULL);");
E_D("replace into `dw_credit_type` values('13','��ǰ1��3�컹��','advance_1day','2','4',NULL,NULL,NULL,NULL,'1291940336','221.175.17.200',NULL,NULL);");
E_D("replace into `dw_credit_type` values('14','��������','advance_day','1','4',NULL,NULL,NULL,NULL,'1291940391','221.175.17.200',NULL,NULL);");

require("../../inc/footer.php");
?>