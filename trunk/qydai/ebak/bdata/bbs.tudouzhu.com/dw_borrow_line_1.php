<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_borrow_line`;");
E_C("CREATE TABLE `dw_borrow_line` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT '0' COMMENT '����վ��',
  `user_id` int(11) DEFAULT '0' COMMENT '�û�����',
  `name` varchar(255) DEFAULT NULL COMMENT '����',
  `status` int(2) DEFAULT '0' COMMENT '״̬',
  `order` int(11) DEFAULT '0' COMMENT '����',
  `hits` int(11) DEFAULT '0' COMMENT '�������',
  `litpic` varchar(255) DEFAULT NULL COMMENT '����ͼ',
  `flag` varchar(50) DEFAULT NULL COMMENT '����',
  `type` int(2) DEFAULT '0' COMMENT '�������',
  `borrow_use` int(10) DEFAULT '0' COMMENT '������;',
  `borrow_qixian` int(10) DEFAULT '0' COMMENT '��������',
  `province` int(10) DEFAULT '0' COMMENT 'ʡ��',
  `city` int(10) DEFAULT '0' COMMENT '����',
  `area` int(10) DEFAULT '0' COMMENT '����',
  `account` varchar(11) DEFAULT NULL COMMENT '������',
  `content` text COMMENT '��ϸ˵��',
  `pawn` varchar(2) DEFAULT NULL COMMENT '���޵�Ѻ',
  `tel` varchar(15) DEFAULT NULL COMMENT '�绰',
  `sex` varchar(2) DEFAULT NULL COMMENT '�Ա�',
  `xing` varchar(11) DEFAULT NULL COMMENT '��',
  `verify_user` int(11) DEFAULT NULL COMMENT '�����',
  `verify_time` varchar(50) DEFAULT NULL COMMENT '���ʱ��',
  `verify_remark` varchar(255) DEFAULT NULL,
  `addtime` varchar(50) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>