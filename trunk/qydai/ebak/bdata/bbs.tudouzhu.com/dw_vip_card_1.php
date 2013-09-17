<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_vip_card`;");
E_C("CREATE TABLE `dw_vip_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flag` varchar(30) DEFAULT NULL COMMENT '��������',
  `order` varchar(10) DEFAULT NULL COMMENT '����',
  `city` varchar(50) DEFAULT NULL COMMENT '����',
  `serial_number` varchar(15) DEFAULT NULL COMMENT 'VIP����',
  `batch` int(11) DEFAULT NULL COMMENT '��������',
  `password` varchar(50) DEFAULT NULL COMMENT '����',
  `create_time` int(11) DEFAULT NULL COMMENT '����ʱ��',
  `start_date` int(11) DEFAULT NULL COMMENT '��Ч�ڿ�ʼ����',
  `end_date` int(11) DEFAULT NULL COMMENT '��Ч�ڽ�������',
  `is_up_end_date` tinyint(1) DEFAULT '0' COMMENT '�Ƿ�����',
  `vct_name` varchar(40) DEFAULT NULL COMMENT '��ֵ������',
  `month_num` tinyint(4) DEFAULT NULL COMMENT '��Ч����',
  `open_time` int(11) DEFAULT NULL COMMENT '����ʱ��',
  `status` tinyint(1) DEFAULT '0' COMMENT '״̬:0:δ���1������2���ᣬ3ͣ��, 4���',
  `freeze_time` int(11) DEFAULT NULL COMMENT '����ʱ��',
  `freeze_day` int(11) DEFAULT NULL COMMENT '��������',
  `freeze_times` tinyint(4) DEFAULT '0' COMMENT '�������',
  `stop_time` int(11) DEFAULT NULL COMMENT 'ͣ��ʱ��',
  `stop_day` int(11) DEFAULT NULL COMMENT 'ͣ������',
  `stop_times` tinyint(4) DEFAULT '0' COMMENT 'ͣ������',
  `create_user` varchar(20) DEFAULT NULL COMMENT '������',
  `remark` text COMMENT '��ע',
  `hits` int(11) DEFAULT NULL COMMENT '�������',
  `addtime` varchar(30) DEFAULT NULL COMMENT '���ʱ��',
  `addip` varchar(30) DEFAULT NULL COMMENT '���ip',
  `updatetime` varchar(30) DEFAULT NULL COMMENT '�޸�ʱ��',
  `updateip` varchar(30) DEFAULT NULL COMMENT '�޸�ip',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_vip_sn` (`serial_number`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk COMMENT='VIP��'");

require("../../inc/footer.php");
?>