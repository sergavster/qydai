<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_home`;");
E_C("CREATE TABLE `dw_home` (
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
  `xiaoqu` varchar(50) DEFAULT NULL COMMENT 'С��',
  `shi` varchar(10) DEFAULT NULL COMMENT '��',
  `ting` varchar(10) DEFAULT NULL COMMENT '��',
  `wei` varchar(10) DEFAULT NULL COMMENT '��',
  `louceng` varchar(10) DEFAULT NULL COMMENT '¥��',
  `zonglouceng` varchar(10) DEFAULT NULL COMMENT '��¥��',
  `loupan` varchar(10) DEFAULT NULL COMMENT '¥��',
  `zhucegongsi` varchar(10) DEFAULT NULL COMMENT '�Ƿ�ע�ṫ˾',
  `mianji` varchar(10) DEFAULT NULL COMMENT '���',
  `mianji1` varchar(10) DEFAULT NULL COMMENT '�������1',
  `mianji2` varchar(10) DEFAULT NULL COMMENT '�������2',
  `fangshi` varchar(10) DEFAULT NULL COMMENT '���ⷽʽ',
  `leixing` varchar(10) DEFAULT NULL COMMENT '����',
  `zhuangxiu` varchar(10) DEFAULT NULL COMMENT 'װ��',
  `chaoxiang` varchar(10) DEFAULT NULL COMMENT '����',
  `zujin` varchar(10) DEFAULT NULL COMMENT '���',
  `jiage` varchar(10) DEFAULT NULL COMMENT '�ۼ�',
  `jiage1` varchar(10) DEFAULT NULL COMMENT '�����ۼ�1',
  `jiage2` varchar(10) DEFAULT NULL COMMENT '�����ۼ�2',
  `jiageleixing` varchar(10) DEFAULT NULL COMMENT '�۸�����',
  `lishijingying` varchar(10) DEFAULT NULL COMMENT '��ʷ��Ӫ',
  `jibenqingkuang` varchar(10) DEFAULT NULL COMMENT '�������',
  `diduan` varchar(10) DEFAULT NULL COMMENT '�ض�',
  `diduan1` varchar(10) DEFAULT NULL COMMENT '�ض�1',
  `diduan2` varchar(10) DEFAULT NULL COMMENT '�ض�2',
  `fukuan` varchar(10) DEFAULT NULL COMMENT '���ʽ',
  `linjin` varchar(10) DEFAULT NULL COMMENT '�ٽ�',
  `peizhi` varchar(50) DEFAULT NULL COMMENT '����',
  `tupian` varchar(250) DEFAULT NULL COMMENT 'ͼƬ',
  `xianxingbie` varchar(250) DEFAULT NULL COMMENT '�����Ա�',
  `chuzufangjian` varchar(250) DEFAULT NULL COMMENT '���ⷿ��',
  `chuzuleixing` varchar(250) DEFAULT NULL COMMENT '��������',
  `content` varchar(255) DEFAULT NULL COMMENT '����˵��',
  `lianxiren` varchar(50) DEFAULT NULL COMMENT '��ϵ��',
  `dianhua` varchar(50) DEFAULT NULL COMMENT '�绰',
  `qq` varchar(50) DEFAULT NULL COMMENT 'qq',
  `province` varchar(20) DEFAULT NULL COMMENT 'ʡ��',
  `city` varchar(20) DEFAULT NULL COMMENT '����',
  `area` varchar(20) DEFAULT NULL COMMENT '��',
  `addtime` varchar(50) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  `updatetime` varchar(50) DEFAULT NULL,
  `updateip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>