<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_attestation`;");
E_C("CREATE TABLE `dw_attestation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0' COMMENT '�û�����',
  `type_id` int(11) DEFAULT '0' COMMENT '�ϴ�������',
  `name` varchar(255) DEFAULT NULL,
  `status` int(2) DEFAULT '0' COMMENT '��֤��״̬',
  `litpic` varchar(255) DEFAULT NULL COMMENT '��֤��ͼƬ',
  `content` varchar(255) DEFAULT NULL COMMENT '��֤�ļ��',
  `jifen` int(20) DEFAULT '0' COMMENT '��֤�Ļ���',
  `pic` text,
  `pic2` varchar(100) DEFAULT NULL,
  `pic3` varchar(100) DEFAULT NULL,
  `verify_time` varchar(32) DEFAULT NULL COMMENT '���ʱ��',
  `verify_user` int(11) DEFAULT NULL COMMENT '�����',
  `verify_remark` varchar(250) DEFAULT NULL COMMENT '��˱�ע',
  `addtime` varchar(50) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=273 DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>