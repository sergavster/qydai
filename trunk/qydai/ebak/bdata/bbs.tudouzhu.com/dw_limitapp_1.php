<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_limitapp`;");
E_C("CREATE TABLE `dw_limitapp` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0' COMMENT '�û�����',
  `status` int(2) DEFAULT '0' COMMENT '״̬',
  `order` int(11) DEFAULT '0' COMMENT '����',
  `account` varchar(255) DEFAULT NULL COMMENT 'Ҫ���ӵĶ��',
  `recommend_userid` varchar(255) DEFAULT NULL COMMENT '�Ƽ���',
  `content` text COMMENT '��ϸ˵��',
  `other_content` text COMMENT '�����ط���ϸ˵��',
  `verify_userid` int(11) DEFAULT NULL COMMENT '�����',
  `verify_time` varchar(50) DEFAULT NULL COMMENT '���ʱ��',
  `verify_remark` varchar(50) DEFAULT NULL COMMENT '��ע',
  `addtime` varchar(50) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `dw_limitapp` values('1','4','1','0','180000','','','',NULL,'1302304027','k','1302303994','58.46.161.117');");

require("../../inc/footer.php");
?>