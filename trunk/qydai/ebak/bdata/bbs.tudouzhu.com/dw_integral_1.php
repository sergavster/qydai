<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_integral`;");
E_C("CREATE TABLE `dw_integral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL COMMENT '��Ʒ����',
  `need` double DEFAULT NULL COMMENT '�������',
  `number` int(11) DEFAULT NULL COMMENT '����',
  `ex_number` int(11) DEFAULT '0' COMMENT '�Ѷһ�����',
  `province` int(11) DEFAULT NULL COMMENT '�ɶһ�ʡ��',
  `city` int(11) DEFAULT NULL COMMENT '�ɶһ�����',
  `area` int(11) DEFAULT NULL COMMENT '��',
  `litpic` varchar(100) DEFAULT NULL COMMENT 'ͼƬ',
  `content` text COMMENT '��ϸ��Ϣ',
  `hits` int(11) DEFAULT '0' COMMENT '�������',
  `top` int(11) DEFAULT '0' COMMENT '������',
  `flag` varchar(30) DEFAULT NULL COMMENT '��������',
  `order` varchar(10) DEFAULT NULL COMMENT '����',
  `status` int(2) DEFAULT NULL COMMENT '״̬',
  `addtime` varchar(30) DEFAULT NULL COMMENT '���ʱ��',
  `addip` varchar(30) DEFAULT NULL COMMENT '���ip',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>