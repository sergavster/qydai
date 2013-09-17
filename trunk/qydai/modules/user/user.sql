


DROP TABLE IF EXISTS `{user}`;
CREATE TABLE IF NOT EXISTS `{user}` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `purview` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `paypassword` varchar(50) DEFAULT NULL,
  `invite_userid` int(11) NOT NULL COMMENT '�������',
  `invite_money` varchar(10) NOT NULL DEFAULT '0' COMMENT '����ע�����',
  `real_status` int(2) NOT NULL,
  `card_type` varchar(10) NOT NULL,
  `card_id` varchar(50) NOT NULL,
  `card_pic1` varchar(150) NOT NULL,
  `card_pic2` varchar(150) NOT NULL,
  `nation` varchar(10) NOT NULL,
  `realname` varchar(20) NOT NULL DEFAULT '',
  `integral` int(10) DEFAULT NULL,
  `status` int(2) NOT NULL,
  `isvip` int(11) NOT NULL,
  `vip_time` varchar(15) NOT NULL,
  `avatar_status` int(2) NOT NULL DEFAULT '0',
  `email_status` varchar(50) NOT NULL DEFAULT '0',
  `phone_status` varchar(50) NOT NULL DEFAULT '0',
  `video_status` int(2) NOT NULL DEFAULT '0' COMMENT '��Ƶ��֤',
  `scene_status` int(2) NOT NULL DEFAULT '0' COMMENT '�ֳ���֤',
  `email` varchar(30) NOT NULL DEFAULT '',
  `sex` varchar(10) NOT NULL,
  `litpic` varchar(250) NOT NULL DEFAULT '',
  `tel` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(50) NOT NULL DEFAULT '',
  `qq` varchar(50) NOT NULL DEFAULT '',
  `wangwang` varchar(100) NOT NULL DEFAULT '',
  `question` varchar(10) DEFAULT NULL,
  `answer` varchar(100) DEFAULT NULL,
  `birthday` int(11) DEFAULT NULL,
  `province` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `area` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `postid` varchar(10) DEFAULT NULL COMMENT '�ʱ�',
  `remind` text NOT NULL COMMENT '��������',
  `privacy` text NOT NULL COMMENT '��˽����',
  `logintime` int(11) NOT NULL DEFAULT '0',
  `addtime` varchar(50) NOT NULL,
  `addip` varchar(50) NOT NULL,
  `uptime` varchar(50) NOT NULL,
  `upip` varchar(50) NOT NULL,
  `lasttime` varchar(50) NOT NULL,
  `lastip` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  FULLTEXT KEY `purview` (`purview`)
) ENGINE=MyISAM  ;

-
DROP TABLE IF EXISTS `{user_cache}`;
CREATE TABLE IF NOT EXISTS `{user_cache}` (
  `user_id` int(11) NOT NULL,
  `bbs_topics_num` int(11) NOT NULL DEFAULT '0',
  `bbs_posts_num` int(11) NOT NULL DEFAULT '0',
  `credit` int(11) NOT NULL DEFAULT '0' COMMENT '����',
  `account` int(11) NOT NULL DEFAULT '0' COMMENT '�ʻ��ܶ�',
  `account_use` int(11) NOT NULL DEFAULT '0' COMMENT '���ý��',
  `account_nouse` int(11) NOT NULL DEFAULT '0' COMMENT '������',
  `account_waitin` int(11) NOT NULL DEFAULT '0' COMMENT '�����ܶ�',
  `account_waitintrest` int(11) NOT NULL DEFAULT '0' COMMENT '������Ϣ',
  `account_intrest` int(11) NOT NULL DEFAULT '0' COMMENT '��׬��Ϣ',
  `account_award` int(11) NOT NULL DEFAULT '0' COMMENT 'Ͷ�꽱��',
  `account_payment` int(11) NOT NULL DEFAULT '0' COMMENT '�����ܶ�',
  `account_expired` int(11) NOT NULL DEFAULT '0' COMMENT '�����ܶ�',
  `account_waitvip` int(11) NOT NULL DEFAULT '0' COMMENT 'vip���',
  `borrow_amount` int(11) NOT NULL DEFAULT '3000' COMMENT '�����',
  `borrow_loan` int(11) NOT NULL DEFAULT '0' COMMENT '�ɹ����',
  `borrow_success` int(11) NOT NULL DEFAULT '0' COMMENT '�ɹ����',
  `borrow_wait` int(11) NOT NULL DEFAULT '0' COMMENT '�ȴ�����',
  `borrow_paymeng` int(11) NOT NULL DEFAULT '0' COMMENT '�������',
  `friends_apply` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM ;


DROP TABLE IF EXISTS `{user_log}`;
CREATE TABLE IF NOT EXISTS `{user_log}` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `query` varchar(50) NOT NULL,
  `url` varchar(200) NOT NULL,
  `result` varchar(100) NOT NULL,
  `addtime` varchar(50) NOT NULL,
  `addip` varchar(50) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM   ;



DROP TABLE IF EXISTS `{user_sendemail_log}`;
CREATE TABLE IF NOT EXISTS `{user_sendemail_log}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(2) NOT NULL,
  `title` varchar(250) NOT NULL,
  `type` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `addtime` varchar(50) NOT NULL,
  `addip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  ;



DROP TABLE IF EXISTS `{user_trend}`;
CREATE TABLE IF NOT EXISTS `{user_trend}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `addtime` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  COMMENT = '�û�������¼'  ;


DROP TABLE IF EXISTS `{user_type}`;
CREATE TABLE IF NOT EXISTS `{user_type}` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `purview` text NOT NULL,
  `order` varchar(10) NOT NULL,
  `status` int(2) NOT NULL,
  `type` int(2) NOT NULL,
  `summary` varchar(200) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `addtime` varchar(50) NOT NULL,
  `addip` varchar(50) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM   ;


CREATE TABLE IF NOT EXISTS `{user_visit}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `visit_userid` int(11) DEFAULT NULL,
  `addip` varchar(30) DEFAULT NULL,
  `addtime` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `{user_typechange}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `status` int(2) NOT NULL,
  `old_type` varchar(10) NOT NULL,
  `new_type` varchar(10) NOT NULL,
  `content` varchar(255) NOT NULL,
  `addtime` varchar(20) NOT NULL,
  `addip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM