  DROP TABLE IF EXISTS `{integral}`;
  CREATE TABLE IF NOT EXISTS `{integral}` (
  `id` int(11) NOT NULL auto_increment,
  `site_id` int(11) NOT NULL ,
  `name` VARCHAR(100) NOT NULL COMMENT '��Ʒ����',
  `need` DOUBLE NOT NULL COMMENT '�������',
  `number` INT  NOT NULL COMMENT '����',
  `ex_number` INT  NOT NULL DEFAULT 0 COMMENT '�Ѷһ�����',
  `province` INT NULL COMMENT '�ɶһ�ʡ��',
  `city` INT NULL COMMENT '�ɶһ�����',
  `area` INT NULL COMMENT '��',
  `litpic` VARCHAR(100) NULL COMMENT 'ͼƬ',
  `content` TEXT NULL COMMENT '��ϸ��Ϣ',
  `hits` INT NULL DEFAULT 0 COMMENT '�������',
  `top` INT NULL DEFAULT 0 COMMENT '������',
  `flag` varchar(30) NULL COMMENT '��������',
  `order` varchar(10) NULL COMMENT '����',
  `status` int(2)  NULL COMMENT '״̬',
  `addtime` varchar(30) default NULL COMMENT '���ʱ��',
  `addip` varchar(30) default NULL COMMENT '���ip',
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;

  DROP TABLE IF EXISTS `{integral_convert}`;
  CREATE TABLE IF NOT EXISTS `{integral_convert}` (
  `id` int(11) NOT NULL auto_increment,
  `integral_id` int(11) NOT NULL COMMENT '�һ���ƷID',
  `user_id` int(11) NOT NULL COMMENT '��ԱID',
  `number` INT(11) NOT NULL COMMENT '����',
  `need` INT(11) NOT NULL COMMENT '����Ҫ�Ļ���',
  `integral` INT(11) NOT NULL COMMENT '�ܻ���',
  `status` int(2)  NULL DEFAULT 0 COMMENT '״̬',
`remark` varchar(200) NULL DEFAULT '' COMMENT '��ע',
  `addtime` varchar(30) default NULL COMMENT '���ʱ��',
  `addip` varchar(30) default NULL COMMENT '���ip',
  PRIMARY KEY (`id`) )
 ENGINE = MyISAM;