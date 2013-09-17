<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_bbs_forums`;");
E_C("CREATE TABLE `dw_bbs_forums` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `content` varchar(200) DEFAULT NULL,
  `rules` text,
  `picurl` varchar(100) DEFAULT NULL,
  `admins` varchar(255) DEFAULT NULL,
  `today_num` int(10) unsigned DEFAULT '0',
  `topics_num` int(10) unsigned DEFAULT '0',
  `posts_num` int(10) unsigned DEFAULT '0',
  `last_postname` varchar(45) DEFAULT NULL,
  `last_postuser` varchar(45) DEFAULT NULL,
  `last_postusername` varchar(30) DEFAULT NULL,
  `last_posttime` int(10) unsigned DEFAULT '0',
  `last_postid` int(10) unsigned DEFAULT '0',
  `isverify` tinyint(1) unsigned DEFAULT '0',
  `forumpass` varchar(45) DEFAULT NULL,
  `forumusers` text,
  `forumgroups` text,
  `showtype` tinyint(1) unsigned DEFAULT '0',
  `ishidden` tinyint(1) unsigned DEFAULT '0',
  `order` int(10) unsigned DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=gbk ROW_FORMAT=FIXED");
E_D("replace into `dw_bbs_forums` values('1','0','��̳����',NULL,NULL,NULL,NULL,'0','0','0',NULL,NULL,NULL,'0','0',NULL,NULL,NULL,NULL,'1','0','1',NULL);");
E_D("replace into `dw_bbs_forums` values('2','1','��̳��������',NULL,NULL,NULL,'|lotaies','0','32','5','������������ε���','98','lotaies','1321515513','83','0',NULL,NULL,'0','1','0','1',NULL);");
E_D("replace into `dw_bbs_forums` values('3','0','������',NULL,NULL,NULL,NULL,'0','0','0',NULL,NULL,NULL,'0','0',NULL,NULL,NULL,NULL,'0','0','3',NULL);");
E_D("replace into `dw_bbs_forums` values('4','3','�����Լ�꽻����',NULL,NULL,NULL,NULL,'0','0','0','���Ƕ��������й�','80','jiedai','1317908011','12','0',NULL,NULL,'0','0','0','1',NULL);");
E_D("replace into `dw_bbs_forums` values('5','0','��Ա�����ƹ������',NULL,NULL,NULL,NULL,'0','0','0',NULL,NULL,NULL,'0','0',NULL,NULL,NULL,NULL,'0','0','4',NULL);");
E_D("replace into `dw_bbs_forums` values('6','5','��Ա����ע�����',NULL,NULL,NULL,NULL,'0','0','0','���Ƕ��������й�','80','666666','1317908118','21','0',NULL,NULL,NULL,'0','0','1',NULL);");
E_D("replace into `dw_bbs_forums` values('7','3','�������',NULL,NULL,NULL,NULL,'0','1','1','RE:���У�������кϷ��� ���ʲ��ø�������4��','86','lotaies','1320933809','54',NULL,NULL,NULL,NULL,'0','0','2','�������');");
E_D("replace into `dw_bbs_forums` values('8','3','�������',NULL,NULL,NULL,NULL,'0','0','0',NULL,NULL,NULL,'0','0',NULL,NULL,NULL,NULL,'0','0','3','�������');");
E_D("replace into `dw_bbs_forums` values('9','0','��˾ҵ��',NULL,NULL,NULL,NULL,'0','0','0',NULL,NULL,NULL,'0','0',NULL,NULL,NULL,NULL,'1','0','1','�����ҹ�˾ҵ��,������ע�ṫ˾����˾ע�ᣬ��������');");
E_D("replace into `dw_bbs_forums` values('10','9','��˾ע��',NULL,NULL,NULL,NULL,'0','5','11','RE:��˾ ��˾�� ��˾��ȫ��','86','lotaies','1321109648','76',NULL,NULL,NULL,NULL,'0','0','1','�����й�˾ע�ᣬ������ע�ṫ˾��������ע�ṫ˾���������ʣ��������ʣ��������ʡ�');");
E_D("replace into `dw_bbs_forums` values('11','9','�жһ�Ʊ',NULL,NULL,NULL,NULL,'0','0','0',NULL,NULL,NULL,'0','0',NULL,NULL,NULL,NULL,'0','0','2','�����гжһ�Ʊ���֣��������չ��жһ�Ʊ�������гжһ�Ʊ���֡�');");
E_D("replace into `dw_bbs_forums` values('12','9','��Ѻ����',NULL,NULL,NULL,NULL,'0','0','0',NULL,NULL,NULL,'0','0',NULL,NULL,NULL,NULL,'0','0','3','�����е�Ѻ����,�����ж��ֳ����������С�������������ʣ������п��ٴ�������������������˽�˴��');");

require("../../inc/footer.php");
?>