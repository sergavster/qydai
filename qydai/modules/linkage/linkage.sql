DROP TABLE IF EXISTS `{linkage}`;
CREATE TABLE IF NOT EXISTS `{linkage}` (
 `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `status` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '״̬',
  `order` smallint(6) NOT NULL DEFAULT '0' COMMENT '����',

  `type_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '����',
  `pid` char(30) NOT NULL DEFAULT '' COMMENT '��������',
  `name` varchar(250) NOT NULL DEFAULT '' COMMENT '��������',
  `value` varchar(250) NOT NULL DEFAULT '' COMMENT '������ֵ',

  `addtime` int(10)  NOT NULL DEFAULT '0',
  `addip` char(20)  NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `{linkage_type}`;
CREATE TABLE IF NOT EXISTS `{linkage_type}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `nid` varchar(50) NOT NULL,
  `addtime` int(10)  NOT NULL DEFAULT '0',
  `addip` char(20)  NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM ;