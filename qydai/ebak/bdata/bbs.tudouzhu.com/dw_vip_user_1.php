<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_vip_user`;");
E_C("CREATE TABLE `dw_vip_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `card_number` varchar(15) DEFAULT NULL COMMENT 'VIP����',
  `flag` varchar(30) DEFAULT NULL COMMENT '��������',
  `order` varchar(10) DEFAULT NULL COMMENT '����',
  `hits` int(11) DEFAULT NULL COMMENT '�������',
  `addtime` varchar(30) DEFAULT NULL COMMENT '���ʱ��',
  `addip` varchar(30) DEFAULT NULL COMMENT '���ip',
  `updatetime` varchar(30) DEFAULT NULL COMMENT '�޸�ʱ��',
  `updateip` varchar(30) DEFAULT NULL COMMENT '�޸�ip',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_vipu_u` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk COMMENT='VIP���û�'");

require("../../inc/footer.php");
?>