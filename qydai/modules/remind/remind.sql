DROP TABLE IF EXISTS `{remind}`;
CREATE TABLE IF NOT EXISTS `{remind}` (
	`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
	`nid` varchar(50) NOT NULL,
	`status` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '״̬',
	`order` smallint(6) NOT NULL DEFAULT '0' COMMENT '����',
	`type_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '����',
	`message` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '����Ϣ',
	`email` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '����',
	`phone` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '�ֻ�',
	
	`addtime` int(10)  NOT NULL DEFAULT '0',
	`addip` char(20)  NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `{remind_user}`;
CREATE TABLE IF NOT EXISTS `{remind_user}` (
 	`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` smallint(11) unsigned NOT NULL,
	`remind_id` smallint(5) unsigned NOT NULL,
	`message` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '����Ϣ',
	`email` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '����',
	`phone` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '�ֻ�',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `{remind_type}`;
CREATE TABLE IF NOT EXISTS `{remind_type}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `nid` varchar(50) NOT NULL,
  `addtime` int(10)  NOT NULL DEFAULT '0',
  `addip` char(20)  NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM ;