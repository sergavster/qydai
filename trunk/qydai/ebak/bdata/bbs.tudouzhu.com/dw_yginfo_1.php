<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_yginfo`;");
E_C("CREATE TABLE `dw_yginfo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0' COMMENT '�û�ID',
  `status` int(2) DEFAULT '0' COMMENT '״̬',
  `height` varchar(255) DEFAULT NULL COMMENT '���',
  `minzu` varchar(255) DEFAULT NULL COMMENT '����',
  `jiguan` varchar(255) DEFAULT NULL COMMENT '����',
  `zhengzhi` varchar(255) DEFAULT NULL COMMENT '������ò',
  `techang` varchar(255) DEFAULT NULL COMMENT '�س�',
  `marray` varchar(255) DEFAULT NULL COMMENT '���',
  `zhuanye` varchar(255) DEFAULT NULL COMMENT 'רҵ',
  `xueli` varchar(255) DEFAULT NULL COMMENT 'ѧ��',
  `idcard` varchar(255) DEFAULT NULL COMMENT '���֤����',
  `zhiye` varchar(255) DEFAULT NULL COMMENT 'ְҵ',
  `school` varchar(255) DEFAULT NULL COMMENT 'ѧУ',
  `danwei` varchar(255) DEFAULT NULL COMMENT '��λ',
  `dizhi` varchar(255) DEFAULT NULL COMMENT '��ַ',
  `linkman` varchar(255) DEFAULT NULL COMMENT '��ϵ��',
  `linktel` varchar(255) DEFAULT NULL COMMENT '��ϵ�绰',
  `fuwu` text,
  `jianli` text,
  `liyou` varchar(255) DEFAULT NULL COMMENT '��������',
  `verify_userid` int(11) DEFAULT NULL COMMENT '�����',
  `verify_time` varchar(50) DEFAULT NULL COMMENT '���ʱ��',
  `verify_remark` varchar(250) DEFAULT NULL COMMENT '��˱�ע',
  `addtime` varchar(50) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk COMMENT='�幤��Ϣ'");

require("../../inc/footer.php");
?>