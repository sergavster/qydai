CREATE TABLE IF NOT EXISTS `{account}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '�û�����',
  `total` varchar(20) NOT NULL DEFAULT '' COMMENT '�ʽ��ܶ�',
  `use_money` int(11) NOT NULL DEFAULT '0' COMMENT '��Ҫ���',
  `no_use_money` int(11) NOT NULL DEFAULT '' COMMENT '�ʽ��ܶ�',
  PRIMARY KEY (`id`)
) ;


CREATE TABLE IF NOT EXISTS `{account_bank}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '�û�ID',
  `account` varchar(100) NOT NULL DEFAULT '' COMMENT '�˺�',
  `bank` varchar(10) NOT NULL DEFAULT '' COMMENT '��������',
  `branch` varchar(100) NOT NULL DEFAULT '' COMMENT '֧��',
  `province` varchar(20) default NULL COMMENT 'ʡ��',
  `city` varchar(20) default NULL COMMENT '����',
  `area` varchar(20) default NULL COMMENT '��',
  `addtime` varchar(50) NOT NULL DEFAULT '',
  `addip` varchar(50) NOT NULL DEFAULT '',
   PRIMARY KEY (`id`)
) COMMENT='�����ʻ�';


CREATE TABLE IF NOT EXISTS `{account_cash}`  (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '�û�ID',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '״̬',
  `account` varchar(100) NOT NULL DEFAULT '' COMMENT '�˺�',
  `bank` varchar(2) NOT NULL DEFAULT '' COMMENT '��������',
  `branch` varchar(100) NOT NULL DEFAULT '' COMMENT '֧��',
  `total` varchar(20) default '0' COMMENT '�ܶ�',
  `credited` varchar(20) default  '0' COMMENT '�����ܶ�',
  `fee` varchar(20) default  '0' COMMENT '������',
  `verify_userid` int(11) default  '' COMMENT '�����',
  `verify_time` varchar(50) default  '' COMMENT '���ʱ��',
  `verify_remark` varchar(250) default  '' COMMENT '��˱�ע',
  `addtime` varchar(50) NOT NULL DEFAULT '',
  `addip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
)COMMENT='���ּ�¼';


CREATE TABLE IF NOT EXISTS `{account_recharge}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '�û�ID',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '״̬',
  `money` varchar(100) NOT NULL DEFAULT '' COMMENT '���',
  `fee` varchar(100) NOT NULL DEFAULT '' COMMENT '����',
  `payment` varchar(100) NOT NULL DEFAULT '' COMMENT '��������',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '����',
  `remark` varchar(250) default '0' COMMENT '��ע',
  `verify_userid` int(11) default  '' COMMENT '�����',
  `verify_time` varchar(50) default  '' COMMENT '���ʱ��',
  `verify_remark` varchar(250) default  '' COMMENT '��˱�ע',
  `addtime` varchar(50) NOT NULL DEFAULT '',
  `addip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
)COMMENT='��ֵ��¼';




CREATE TABLE IF NOT EXISTS `{account_log}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '�û�ID',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '����',
  `money` varchar(100) NOT NULL DEFAULT '' COMMENT '���',
  `use_money` varchar(100) NOT NULL DEFAULT '' COMMENT '���ý��',
  `no_use_money` varchar(100) NOT NULL DEFAULT '' COMMENT '������',
  `to_user` varchar(2) NOT NULL DEFAULT '' COMMENT '���׶Է�',
  `remark` varchar(250) default '0' COMMENT '��ע',
  `addtime` varchar(50) NOT NULL DEFAULT '',
  `addip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
)COMMENT='�ʽ��¼';


CREATE TABLE IF NOT EXISTS `{account_payment}` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `nid` varchar(100) DEFAULT NULL,
  `status` smallint(3) unsigned NOT NULL DEFAULT '0',
  `style` int(100) NOT NULL,
  `config` longtext,
  `fee` int(10) NOT NULL DEFAULT '0',
  `fee_type` int(2) NOT NULL,
  `max_money` int(10) NOT NULL,
  `max_fee` int(10) NOT NULL,
  `description` longtext,
  `order` smallint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM   ;
