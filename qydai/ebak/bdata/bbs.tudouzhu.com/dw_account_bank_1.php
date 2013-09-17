<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_account_bank`;");
E_C("CREATE TABLE `dw_account_bank` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0' COMMENT '�û�ID',
  `account` varchar(100) DEFAULT NULL COMMENT '�˺�',
  `bank` varchar(50) DEFAULT NULL COMMENT '��������',
  `branch` varchar(100) DEFAULT NULL COMMENT '֧��',
  `province` int(5) DEFAULT '0' COMMENT 'ʡ��',
  `city` int(5) DEFAULT '0' COMMENT '����',
  `area` int(5) DEFAULT '0' COMMENT '��',
  `addtime` varchar(11) DEFAULT NULL,
  `addip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=gbk COMMENT='�����ʻ�'");
E_D("replace into `dw_account_bank` values('1','4','6222021914000106774','300','��������','0','0','0','1314065321','58.46.172.103');");
E_D("replace into `dw_account_bank` values('2','22','622909396311227313','468','��ҵ���й��ݷ��к���֧��','0','0','0','1314294687','113.65.152.212');");
E_D("replace into `dw_account_bank` values('3','14','39660240941','468','��ҵ���й��ݷ��к���֧��','0','0','0','1314294789','113.65.152.212');");
E_D("replace into `dw_account_bank` values('4','18','622909396560735412','468','��ҵ���й��ݷ��ж���֧��','0','0','0','1314294969','113.65.152.212');");
E_D("replace into `dw_account_bank` values('5','16','622909336540185619','468','��ҵ�������ڷ���Ӫҵ��','0','0','0','1314295055','113.65.152.212');");
E_D("replace into `dw_account_bank` values('6','23','622909396140686614','468','��ҵ���й��ݷ��к���֧��','0','0','0','1314295116','113.65.152.212');");
E_D("replace into `dw_account_bank` values('7','19','622909396154454016','468','��ҵ���й��ݷ�������֧��','0','0','0','1314295207','113.65.152.212');");
E_D("replace into `dw_account_bank` values('8','26','6222022017005426731','300','�������й㶫����Ƕ�֧��','0','0','0','1314295391','113.65.152.212');");
E_D("replace into `dw_account_bank` values('9','24','6222022017005426723','300','�������й㶫����Ƕ�֧��','0','0','0','1314295438','113.65.152.212');");
E_D("replace into `dw_account_bank` values('10','25','6228480220326456815','303','�����д�����֧��','0','0','0','1314676439','219.144.108.192');");
E_D("replace into `dw_account_bank` values('11','45','6226622001181102','473','�Ͼ����н���֧����Ԫ��ַ���','0','0','0','1315715931','183.209.42.217');");
E_D("replace into `dw_account_bank` values('12','46','6226622000816807','473','�Ͼ����н���֧��','0','0','0','1314793431','112.4.63.146');");
E_D("replace into `dw_account_bank` values('13','27','6226682000370791','473','�Ͼ����н���֧��','0','0','0','1314793477','112.4.63.146');");
E_D("replace into `dw_account_bank` values('14','53','6228480070069830712','303','����ʡ�����к���������·����֧��','0','0','0','1315651507','125.93.183.3');");
E_D("replace into `dw_account_bank` values('15','13','6222021914000106777','300','��������','0','0','0','1315715638','113.218.4.79');");
E_D("replace into `dw_account_bank` values('16','28','13638810629','300','֧����','0','0','0','1315978021','123.87.177.95');");
E_D("replace into `dw_account_bank` values('17','86','6228411390219721114','303','�������ж�ɽ֧��','0','0','0','1320317669','127.0.0.1');");
E_D("replace into `dw_account_bank` values('18','102','6228481394163129212','303','������������֧�в��нַ���','0','0','0','1320992459','183.9.30.73');");
E_D("replace into `dw_account_bank` values('19','99','6222082019000107297','300','������������֧��','0','0','0','1321082598','113.117.25.62');");

require("../../inc/footer.php");
?>