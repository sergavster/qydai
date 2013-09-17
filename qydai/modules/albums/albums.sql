CREATE TABLE if not  EXISTS `{albums}` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '����',
  `site_id` int(11) NOT NULL COMMENT '��ĿID',
  `type_id` int(11) NOT NULL COMMENT '����',
  `user_id` int(11) NOT NULL COMMENT '�û�ID',
  `flag` varchar(30) NOT NULL COMMENT '��������',
  `status` int(2) DEFAULT NULL COMMENT '״̬',
  `order` varchar(10) NOT NULL COMMENT '����',
  `rank` int(11) NOT NULL COMMENT 'Ȩ��',
  `code` varchar(10) DEFAULT NULL COMMENT '����ģ��',
  `aid` int(11) NOT NULL COMMENT '����ģ��ID',
  `content` text COMMENT '����',
  `hits` int(11) DEFAULT NULL COMMENT '�������',
  `addtime` varchar(30) DEFAULT NULL COMMENT '���ʱ��',
  `addip` varchar(30) DEFAULT NULL COMMENT '���ip',
  `updatetime` varchar(30) DEFAULT NULL COMMENT '�޸�ʱ��',
  `updateip` varchar(30) DEFAULT NULL COMMENT '�޸�ip',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM ;

CREATE TABLE if not  EXISTS `{albums_type}` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '����',
  `addtime` varchar(30) DEFAULT NULL COMMENT '���ʱ��',
  `addip` varchar(30) DEFAULT NULL COMMENT '���ip',
  `updatetime` varchar(30) DEFAULT NULL COMMENT '�޸�ʱ��',
  `updateip` varchar(30) DEFAULT NULL COMMENT '�޸�ip',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM ;

CREATE TABLE if not  EXISTS `{upfiles}` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL COMMENT '����',
  `code` varchar(50) DEFAULT NULL COMMENT 'ģ��',
  `aid` varchar(50) DEFAULT NULL COMMENT '����ģ��id',
  `status` int(2) DEFAULT '0' COMMENT '״̬',
  `user_id` int(11) NOT NULL,
  `filetype` varchar(50) DEFAULT NULL COMMENT '�ļ�����',
  `filename` varchar(100) DEFAULT NULL COMMENT '�ļ�����',
  `filesize` int(10) DEFAULT '0' COMMENT '�ļ���С',
  `fileurl` varchar(200) DEFAULT NULL COMMENT '�ļ���ַ',
  `if_cover` int(2) DEFAULT '0' COMMENT '�Ƿ����',
  `order` int(10) DEFAULT '0' COMMENT '����',
  `hits` int(11) DEFAULT '0' COMMENT '�������',
  `addtime` varchar(30) DEFAULT NULL COMMENT '���ʱ��',
  `addip` varchar(30) DEFAULT NULL COMMENT '���ip',
  `updatetime` varchar(30) DEFAULT NULL COMMENT '�޸�ʱ��',
  `updateip` varchar(30) DEFAULT NULL COMMENT '�޸�ip',

  PRIMARY KEY  (`id`)
) ENGINE=MyISAM ;
