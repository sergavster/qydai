CREATE TABLE IF NOT EXISTS `{limitapp}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '�û�����',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '״̬',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '����',

  `account` varchar(255) NOT NULL DEFAULT '' COMMENT 'Ҫ���ӵĶ��',
  `recommend_userid` varchar(255) NOT NULL DEFAULT '' COMMENT '�Ƽ���',
 `content` text default NULL COMMENT '��ϸ˵��',
  `other_content` text default NULL COMMENT '�����ط���ϸ˵��',

  `verify_userid` int(11)  NULL  COMMENT '�����',
  `verify_time` varchar(50) NOT NULL DEFAULT '' COMMENT '���ʱ��',
  `verify_remark` varchar(50) NOT NULL DEFAULT '' COMMENT '��ע',

  `addtime` varchar(50) NOT NULL DEFAULT '',
  `addip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

