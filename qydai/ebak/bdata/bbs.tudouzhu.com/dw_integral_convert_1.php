<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_integral_convert`;");
E_C("CREATE TABLE `dw_integral_convert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `integral_id` int(11) DEFAULT NULL COMMENT '�һ���ƷID',
  `user_id` int(11) DEFAULT NULL COMMENT '��ԱID',
  `number` int(11) DEFAULT NULL COMMENT '����',
  `need` int(11) DEFAULT NULL COMMENT '����Ҫ�Ļ���',
  `integral` int(11) DEFAULT NULL COMMENT '�ܻ���',
  `status` int(2) DEFAULT '0' COMMENT '״̬',
  `remark` varchar(200) DEFAULT '' COMMENT '��ע',
  `addtime` varchar(30) DEFAULT NULL COMMENT '���ʱ��',
  `addip` varchar(30) DEFAULT NULL COMMENT '���ip',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `dw_integral_convert` values('1','1','1','1','12','12','1','�µ����� ���Ȱ��϶Է�','','');");

require("../../inc/footer.php");
?>