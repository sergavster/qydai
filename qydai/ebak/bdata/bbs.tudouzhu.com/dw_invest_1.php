<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_invest`;");
E_C("CREATE TABLE `dw_invest` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT '0' COMMENT '����վ��',
  `user_id` int(11) DEFAULT '0' COMMENT '�û�����',
  `name` varchar(255) DEFAULT NULL COMMENT '����',
  `status` int(2) DEFAULT '0' COMMENT '״̬',
  `order` int(11) DEFAULT '0' COMMENT '����',
  `hits` int(11) DEFAULT '0' COMMENT '�������',
  `litpic` varchar(255) DEFAULT NULL COMMENT '����ͼ',
  `flag` varchar(50) DEFAULT NULL COMMENT '����',
  `source` varchar(50) DEFAULT NULL COMMENT '��Դ',
  `publish` varchar(50) DEFAULT NULL COMMENT '����ʱ��',
  `customer` int(11) DEFAULT NULL COMMENT '�ͷ�',
  `verify_userid` int(11) DEFAULT NULL COMMENT '�����',
  `verify_time` varchar(50) DEFAULT NULL COMMENT '���ʱ��',
  `use` varchar(50) DEFAULT NULL COMMENT '��;',
  `time_limit` varchar(50) DEFAULT NULL COMMENT '�������',
  `style` varchar(50) DEFAULT NULL COMMENT '���ʽ',
  `account` varchar(50) DEFAULT NULL COMMENT '����ܽ��',
  `apr` varchar(50) DEFAULT NULL COMMENT '������',
  `lowest_account` varchar(50) DEFAULT NULL COMMENT '���Ͷ����',
  `most_account` varchar(50) DEFAULT NULL COMMENT '���Ͷ���ܶ�',
  `valid_time` varchar(50) DEFAULT NULL COMMENT '��Чʱ��',
  `award` varchar(50) DEFAULT NULL COMMENT 'Ͷ�꽱��',
  `part_account` varchar(50) DEFAULT NULL COMMENT '��̯�������',
  `funds` varchar(50) DEFAULT NULL COMMENT '���������ı���',
  `is_false` varchar(50) DEFAULT NULL COMMENT '���ʧ��ʱҲͬ������ ',
  `open_account` varchar(50) DEFAULT NULL COMMENT '�����ҵ��ʻ��ʽ����',
  `open_borrow` varchar(50) DEFAULT NULL COMMENT '�����ҵĽ���ʽ����',
  `open_tender` varchar(50) DEFAULT NULL COMMENT '�����ҵ�Ͷ���ʽ����',
  `open_credit` varchar(50) DEFAULT NULL COMMENT '�����ҵ����ö�����',
  `content` text COMMENT '��ϸ˵��',
  `addtime` varchar(50) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>