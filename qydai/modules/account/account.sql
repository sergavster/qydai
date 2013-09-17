DROP TABLE IF EXISTS `{account}`;
CREATE TABLE IF NOT EXISTS `{account}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '�û�����',
  `total` varchar(11) NOT NULL COMMENT '�ʽ��ܶ�',
  `use_money` varchar(11) NOT NULL,
  `no_use_money` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM   ;




CREATE TABLE IF NOT EXISTS `{account_bank}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '�û�ID',
  `account` varchar(100) NOT NULL COMMENT '�˺�',
  `bank` varchar(10) NOT NULL COMMENT '��������',
  `branch` varchar(100) NOT NULL DEFAULT '' COMMENT '֧��',
  `province` varchar(20) DEFAULT NULL COMMENT 'ʡ��',
  `city` varchar(20) DEFAULT NULL COMMENT '����',
  `area` varchar(20) DEFAULT NULL COMMENT '��',
  `addtime` varchar(50) NOT NULL DEFAULT '',
  `addip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  COMMENT='�����ʻ�';



DROP TABLE IF EXISTS `{account_cash}`;
CREATE TABLE IF NOT EXISTS `{account_cash}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '�û�ID',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '״̬',
  `account` varchar(100) NOT NULL COMMENT '�˺�',
  `bank` varchar(302) NOT NULL COMMENT '��������',
  `branch` varchar(100) NOT NULL DEFAULT '' COMMENT '֧��',
  `total` varchar(20) DEFAULT '0' COMMENT '�ܶ�',
  `credited` varchar(20) DEFAULT '0' COMMENT '�����ܶ�',
  `fee` varchar(20) DEFAULT '0' COMMENT '������',
  `verify_userid` int(11) NOT NULL,
  `verify_time` varchar(50) NOT NULL,
  `verify_remark` varchar(250) NOT NULL,
  `addtime` varchar(50) NOT NULL DEFAULT '',
  `addip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM   COMMENT='���ּ�¼';



DROP TABLE IF EXISTS `{account_log}`;
CREATE TABLE IF NOT EXISTS `{account_log}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '�û�ID',
  `type` varchar(100) NOT NULL COMMENT '����',
  `money` varchar(100) NOT NULL DEFAULT '' COMMENT '���',
  `use_money` varchar(100) NOT NULL DEFAULT '' COMMENT '���ý��',
  `no_use_money` varchar(100) NOT NULL DEFAULT '' COMMENT '������',
  `to_user` varchar(2) NOT NULL DEFAULT '' COMMENT '���׶Է�',
  `remark` varchar(250) DEFAULT '0' COMMENT '��ע',
  `addtime` varchar(50) NOT NULL DEFAULT '',
  `addip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM   COMMENT='�ʽ��¼';



DROP TABLE IF EXISTS `{dw_account_payment}`;
CREATE TABLE IF NOT EXISTS `{account_payment}` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `nid` varchar(100) DEFAULT NULL,
  `status` smallint(3) unsigned NOT NULL DEFAULT '0',
  `style` int(2) NOT NULL,
  `config` longtext,
  `fee` int(10) NOT NULL DEFAULT '0',
  `fee_type` int(2) NOT NULL,
  `max_money` int(10) NOT NULL,
  `max_fee` int(10) NOT NULL,
  `description` longtext,
  `order` smallint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  ;


DROP TABLE IF EXISTS `{account_recharge}`;
CREATE TABLE IF NOT EXISTS `{account_recharge}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '�û�ID',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '״̬',
  `money` varchar(100) NOT NULL DEFAULT '' COMMENT '���',
  `payment` varchar(100) NOT NULL COMMENT '��������',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '����',
  `remark` varchar(250) DEFAULT '0' COMMENT '��ע',
  `fee` varchar(10) NOT NULL,
  `verify_userid` int(11) DEFAULT '0' COMMENT '�����',
  `verify_time` varchar(50) DEFAULT '' COMMENT '���ʱ��',
  `verify_remark` varchar(250) DEFAULT '' COMMENT '��˱�ע',
  `addtime` varchar(50) NOT NULL DEFAULT '',
  `addip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM COMMENT='��ֵ��¼';



ALTER TABLE {account} ADD INDEX user_id (user_id);
ALTER TABLE {account_bank} ADD INDEX user_id (user_id);
ALTER TABLE {account_log} ADD INDEX user_id (user_id);
ALTER TABLE {account_recharge} ADD INDEX user_id (user_id);
ALTER TABLE {account_recharge} ADD INDEX user_id (user_id,status);
ALTER TABLE {account_recharge} ADD INDEX user_id (user_id,payment);
ALTER TABLE {account_recharge} ADD INDEX user_id (user_id,payment,verify_userid);
ALTER TABLE {account_cash} ADD INDEX user_id (user_id);
ALTER TABLE {account_cash} ADD INDEX user_id (user_id,status);
ALTER TABLE {account_cash} ADD INDEX user_id (user_id,status,verify_userid);
