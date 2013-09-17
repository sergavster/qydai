DROP TABLE IF EXISTS `{credit}`;
CREATE TABLE IF NOT EXISTS `{credit}` (
	`user_id` INT NOT NULL COMMENT '��ԱID',
	`value` INT NULL DEFAULT 0 COMMENT '������ֵ',
	`op_user` INT DEFAULT NULL COMMENT '������',
	`addtime` INT DEFAULT NULL COMMENT '���ʱ��',
	`addip` VARCHAR(30) DEFAULT NULL COMMENT '���IP',
	`updatetime` INT DEFAULT NULL COMMENT '������ʱ��',
	`updateip` VARCHAR(30) DEFAULT NULL COMMENT '������ID',
	PRIMARY KEY  (`user_id`)
)
ENGINE = MyISAM
COMMENT = '��Ա����';

DROP TABLE IF EXISTS `{credit_type}`;
CREATE TABLE IF NOT EXISTS `{credit_type}` (
	`id` INT NOT NULL auto_increment,
	`name` VARCHAR(50) NULL NOT NULL COMMENT '��������',
	`nid` VARCHAR(50) NOT NULL COMMENT '���ִ���',
	`value` INT NULL DEFAULT 0 COMMENT '������ֵ',
	`cycle` TINYINT(1) NOT NULL DEFAULT 2 COMMENT '�������ڣ�1:һ��,2:ÿ��,3:�������,4:����',
	`award_times` TINYINT DEFAULT 0 COMMENT '��������,0:����',
	`interval` INT DEFAULT 1 COMMENT 'ʱ��������λ����',
	`remark` VARCHAR(256) DEFAULT NULL COMMENT '��ע',
	`op_user` INT DEFAULT NULL COMMENT '������',
	`addtime` INT DEFAULT NULL COMMENT '���ʱ��',
	`addip` VARCHAR(30) DEFAULT NULL COMMENT '���IP',
	`updatetime` INT DEFAULT NULL COMMENT '������ʱ��',
	`updateip` VARCHAR(30)  DEFAULT NULL COMMENT '������ID',
	PRIMARY KEY  (`id`),
	UNIQUE KEY `idx_ct_nid` (`nid`)
)
ENGINE = MyISAM
COMMENT = '��������';



DROP TABLE IF EXISTS `{credit_log}`;
CREATE TABLE IF NOT EXISTS `{credit_log}` (
	`id` INT NOT NULL auto_increment,
	`user_id` INT NOT NULL COMMENT '��ԱID',
	`type_id` INT DEFAULT 0 COMMENT '��������ID',
	`op` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '�䶯����,1:����,2:����',
	`value` INT NULL DEFAULT 0 COMMENT '�䶯������ֵ',
	`remark` VARCHAR(256) DEFAULT NULL COMMENT '��ע',
	`op_user` INT DEFAULT NULL COMMENT '������',
	`addtime` INT DEFAULT NULL COMMENT '���ʱ��',
	`addip` VARCHAR(30) DEFAULT NULL COMMENT '���IP',
	PRIMARY KEY  (`id`)
)
ENGINE = MyISAM
COMMENT = '��Ա������־';

DROP TABLE IF EXISTS `{credit_rank}`;
CREATE TABLE IF NOT EXISTS `{credit_rank}` (
	`id` INT NOT NULL auto_increment,
        `name` VARCHAR(50) NULL NOT NULL COMMENT '�ȼ�����',
	`rank` INT DEFAULT 0 COMMENT '�ȼ�',
	`point1` INT DEFAULT 0 COMMENT '��ʼ��ֵ',
	`point2` INT  DEFAULT 0 COMMENT '����ֵ',
        `pic` VARCHAR(100) DEFAULT NULL COMMENT 'ͼƬ',
	`remark` VARCHAR(256) DEFAULT NULL COMMENT '��ע',
	`addtime` INT DEFAULT NULL COMMENT '���ʱ��',
	`addip` VARCHAR(30) DEFAULT NULL COMMENT '���IP',
	PRIMARY KEY  (`id`)
)
ENGINE = MyISAM
COMMENT = '��Ա������־';