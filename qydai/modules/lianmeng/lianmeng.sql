DROP TABLE IF EXISTS `{lianmeng}`;
CREATE TABLE `{lianmeng}` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL COMMENT '����',
  `site_id` int(11) NOT NULL COMMENT '��ĿID',
  `flag` varchar(30) NOT NULL COMMENT '��������',
  `status` int(2)  NULL COMMENT '״̬',
  `order` varchar(10) NOT NULL COMMENT '����',
	
`litpic` varchar(250) default NULL COMMENT '��Ƭ',
  `school` varchar(50) NOT NULL COMMENT '����ְλ',
 `intime` varchar(250) default NULL COMMENT '����ʱ��',
`xuanyan` varchar(250) default NULL COMMENT '����ʱ��',

  `province` varchar(20) default NULL COMMENT 'ʡ��',
  `city` varchar(20) default NULL COMMENT '����',
  `area` varchar(20) default NULL COMMENT '��',
  `hits` int(11)  NULL default '0' COMMENT '�������',
  `addtime` varchar(30) default NULL COMMENT '���ʱ��',
  `addip` varchar(30) default NULL COMMENT '���ip',
  `updatetime` varchar(30) default NULL COMMENT '�޸�ʱ��',
  `updateip` varchar(30) default NULL COMMENT '�޸�ip',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM ;
