<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_borrow_vouch_collection`;");
E_C("CREATE TABLE `dw_borrow_vouch_collection` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(2) DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `borrow_id` int(11) NOT NULL DEFAULT '0',
  `order` int(2) DEFAULT NULL,
  `vouch_id` int(11) DEFAULT '0' COMMENT '���id',
  `repay_time` varchar(50) DEFAULT NULL COMMENT '���ƻ���ʱ��',
  `repay_yestime` varchar(50) DEFAULT NULL COMMENT '�Ѿ�����ʱ��',
  `repay_account` varchar(50) DEFAULT '0' COMMENT 'Ԥ�����',
  `repay_yesaccount` varchar(50) DEFAULT '0' COMMENT 'ʵ�����',
  `addtime` varchar(50) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>