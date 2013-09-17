<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_userinfo`;");
E_C("CREATE TABLE `dw_userinfo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT '0' COMMENT '����վ��',
  `user_id` int(11) DEFAULT '0' COMMENT '�û�����',
  `name` varchar(255) DEFAULT NULL COMMENT '����',
  `status` int(2) DEFAULT '0' COMMENT '״̬',
  `order` int(11) DEFAULT '0' COMMENT '����',
  `hits` int(11) DEFAULT '0' COMMENT '�������',
  `litpic` varchar(255) DEFAULT NULL COMMENT '����ͼ',
  `flag` varchar(50) DEFAULT NULL COMMENT '����',
  `source` varchar(50) DEFAULT NULL COMMENT '��Դ',
  `publish` varchar(50) DEFAULT NULL COMMENT '����ʱ��',
  `marry` varchar(50) DEFAULT NULL COMMENT '����',
  `child` varchar(10) DEFAULT NULL COMMENT '��Ů',
  `education` varchar(10) DEFAULT NULL COMMENT 'ѧ��',
  `income` varchar(10) DEFAULT NULL COMMENT '����',
  `shebao` varchar(10) DEFAULT NULL COMMENT '�籣',
  `shebaoid` varchar(50) DEFAULT NULL COMMENT '�籣��',
  `housing` varchar(10) DEFAULT NULL COMMENT 'ס������',
  `car` varchar(10) DEFAULT NULL COMMENT '��',
  `late` varchar(10) DEFAULT NULL COMMENT '����',
  `house_address` varchar(10) DEFAULT NULL COMMENT '������ַ',
  `house_area` varchar(10) DEFAULT NULL COMMENT '�������',
  `house_year` varchar(10) DEFAULT NULL COMMENT '�������',
  `house_status` varchar(10) DEFAULT NULL COMMENT '����',
  `house_holder1` varchar(10) DEFAULT NULL COMMENT '��������Ȩ1',
  `house_holder2` varchar(10) DEFAULT NULL COMMENT '��������Ȩ1',
  `house_right1` varchar(10) DEFAULT NULL COMMENT '���ӷݶ�1',
  `house_right2` varchar(10) DEFAULT NULL COMMENT '���ӷݶ�2',
  `house_loanyear` varchar(10) DEFAULT NULL COMMENT '��������',
  `house_loanprice` varchar(10) DEFAULT NULL COMMENT 'ÿ�¹���',
  `house_balance` varchar(10) DEFAULT NULL COMMENT '�������',
  `house_bank` varchar(10) DEFAULT NULL COMMENT '����',
  `company_name` varchar(10) DEFAULT NULL COMMENT '��˾����',
  `company_type` varchar(10) DEFAULT NULL COMMENT '��˾����',
  `company_industry` varchar(10) DEFAULT NULL COMMENT '��˾��ҵ',
  `company_office` varchar(10) DEFAULT NULL COMMENT '����ְλ',
  `company_jibie` varchar(10) DEFAULT NULL COMMENT '��������',
  `company_worktime1` varchar(10) DEFAULT NULL COMMENT '����ʱ��1',
  `company_worktime2` varchar(10) DEFAULT NULL COMMENT '����ʱ��2',
  `company_workyear` varchar(10) DEFAULT NULL COMMENT '��������',
  `company_tel` varchar(50) DEFAULT NULL COMMENT '��˾�绰',
  `company_address` varchar(100) DEFAULT NULL COMMENT '��˾��ַ',
  `company_weburl` varchar(100) DEFAULT NULL COMMENT '��˾��վ',
  `company_reamrk` varchar(250) DEFAULT NULL COMMENT '��˾��ע',
  `private_type` varchar(10) DEFAULT NULL COMMENT '���',
  `private_date` varchar(10) DEFAULT NULL COMMENT '����',
  `private_place` varchar(10) DEFAULT NULL COMMENT '����',
  `private_rent` varchar(10) DEFAULT NULL COMMENT '���',
  `private_term` varchar(10) DEFAULT NULL COMMENT '����',
  `private_taxid` varchar(30) DEFAULT NULL COMMENT '����˰��',
  `private_commerceid` varchar(50) DEFAULT NULL COMMENT '���̵ǼǺ�',
  `private_income` varchar(100) DEFAULT NULL COMMENT '����',
  `private_employee` varchar(100) DEFAULT NULL COMMENT '��Ա',
  `finance_repayment` varchar(100) DEFAULT NULL COMMENT 'ÿ���޵�Ѻ������',
  `finance_property` varchar(100) DEFAULT NULL COMMENT '���з���',
  `finance_amount` varchar(100) DEFAULT NULL COMMENT 'ÿ�·��ݰ��ҽ��',
  `finance_car` varchar(10) DEFAULT NULL COMMENT '��������',
  `finance_caramount` varchar(100) DEFAULT NULL COMMENT 'ÿ���������ҽ��',
  `finance_creditcard` varchar(100) DEFAULT NULL COMMENT '���ÿ����',
  `mate_name` varchar(100) DEFAULT NULL COMMENT '��ż����',
  `mate_salary` varchar(10) DEFAULT NULL COMMENT 'н��',
  `mate_phone` varchar(100) DEFAULT NULL COMMENT '�ֻ�',
  `mate_tel` varchar(100) DEFAULT NULL COMMENT '�绰',
  `mate_type` varchar(10) DEFAULT NULL COMMENT '��������',
  `mate_office` varchar(10) DEFAULT NULL COMMENT '����ְλ',
  `mate_address` varchar(250) DEFAULT NULL COMMENT '��ַ',
  `mate_income` varchar(100) DEFAULT NULL COMMENT '����',
  `education_record` varchar(100) DEFAULT NULL COMMENT 'ѧ��',
  `education_school` varchar(200) DEFAULT NULL COMMENT 'ѧУ',
  `education_study` varchar(200) DEFAULT NULL COMMENT 'רҵ',
  `education_time1` varchar(20) DEFAULT NULL COMMENT 'ʱ��1',
  `education_time2` varchar(20) DEFAULT NULL COMMENT 'ʱ��2',
  `tel` varchar(50) DEFAULT NULL COMMENT '�绰',
  `phone` varchar(50) DEFAULT NULL COMMENT '�ֻ�',
  `post` varchar(50) DEFAULT NULL COMMENT '�ʱ�',
  `address` varchar(50) DEFAULT NULL COMMENT '�ʱ�',
  `province` varchar(20) DEFAULT NULL COMMENT 'ʡ��',
  `city` varchar(20) DEFAULT NULL COMMENT '����',
  `area` varchar(20) DEFAULT NULL COMMENT '��',
  `linkman1` varchar(50) DEFAULT NULL COMMENT '��ϵ��1',
  `relation1` varchar(50) DEFAULT NULL COMMENT '��ϵ1',
  `tel1` varchar(50) DEFAULT NULL COMMENT '�绰1',
  `phone1` varchar(50) DEFAULT NULL COMMENT '�ֻ�1',
  `linkman2` varchar(50) DEFAULT NULL COMMENT '��ϵ��2',
  `relation2` varchar(50) DEFAULT NULL COMMENT '��ϵ2',
  `tel2` varchar(50) DEFAULT NULL COMMENT '�绰2',
  `phone2` varchar(50) DEFAULT NULL COMMENT '�ֻ�2',
  `linkman3` varchar(50) DEFAULT NULL COMMENT '��ϵ��3',
  `relation3` varchar(50) DEFAULT NULL COMMENT '��ϵ3',
  `tel3` varchar(50) DEFAULT NULL COMMENT '�绰3',
  `phone3` varchar(50) DEFAULT NULL COMMENT '�ֻ�3',
  `msn` varchar(50) DEFAULT NULL COMMENT 'MSN',
  `qq` varchar(50) DEFAULT NULL COMMENT 'QQ',
  `wangwang` varchar(50) DEFAULT NULL COMMENT 'WANGWANG',
  `ability` varchar(250) DEFAULT NULL COMMENT '��������',
  `interest` varchar(250) DEFAULT NULL COMMENT '���˰���',
  `others` varchar(250) DEFAULT NULL COMMENT '����˵��',
  `experience` text COMMENT '��������',
  `addtime` varchar(50) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  `updatetime` varchar(50) DEFAULT NULL,
  `updateip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=gbk");
E_D("replace into `dw_userinfo` values('1','0','28',NULL,'0','0','0',NULL,NULL,NULL,NULL,'1','5','14','24','31','','34','37','39','����ʡˮ����','64','2002-02-02','72000','����','����','50%','50%','5','1310','56000','������','����ʡˮ���ص�һ��ѧ','53','68','221','73','2005-08-01','2011-08-25','230','0870-8635320','����ˮ��','����','ѧУ��Ǩ','54','2011-09-10','��','0','0','0','0','0','0','0','237','1310','235','0','300','����','2500','13578099338','','69','219','����ˮ��','','15','������Ϫʦ��ѧԺ','����','2001-09-01','2005-07-01','0870-4571216','13638810629','657800','����ˮ���Ͼ���԰','2892','2938','2950','����','239','0870-4571216','13578099338','','240','','','','240','','','','','','','','','','1314284133','123.87.181.158','1315627781','123.87.177.3');");
E_D("replace into `dw_userinfo` values('2','0','33',NULL,'0','0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'����ʡ����������','203.22','1992-01-01','��','���Ⱦ�','���ܽ�','��','��','��','��','��','��','���ϳ�ɳ���潨������','48','57','224','74','2010-03-01','2013-03-03','227','073189788347','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'������','3000','18773192207','','54','77','','','11','','','','','073189788347','18774913439','410327','��ɳ���°�С��11��2��Ԫ5¥�ұ�','2034','2035','2042','���ı�','242','13908452599','','������','239','18773192207','','','240','','','','','','','','','','1314680730','113.246.41.133','1314754186','118.249.159.199');");
E_D("replace into `dw_userinfo` values('3','0','38',NULL,'0','0','0',NULL,NULL,NULL,NULL,'1','6','12','26','32','','34','36','39','�㶫ʡ�����л�������','144','2018-09-15','','�Ϲ�','','100','','','','','','�̵�','52','60','83','74','2008-08-09','','228','0663-6250188','','','','60','2018-09-02','���з���','','','','445224','70000','2','0','237','0','235','0','0','��','5500','13729329866','','60','77','','','12','��̶����ѧУ','','','','0663-6251361','13502518630','515239','���֤��ַ','2184','','','���','239','0663-6250188','13729329866','','242','','','','242','','','','','','�Ƚϱ�����Ӧ������Ц��','�����~~~~~~~','','','1314682093','113.117.116.229','1314742050','113.117.119.136');");
E_D("replace into `dw_userinfo` values('4','0','53',NULL,'0','0','0',NULL,NULL,NULL,NULL,'3','5','13','23','31','D68944707','33','37','38','������','210','2010-09-30','0','��Ӧʽ','','','','0','0','0','0','��ݸ�����������޹�˾','52','55','222','74','2010-09-16','2013-09-10','227','076988786698','�߲���������','0','0','54','2005-04-21','�·�','20000','1','0','0','0','500','0','237','0','235','0','0','0','0','0','0','54','77','0','0','13','���¼�У','��ͼ','2006-08-08','2009-09-07','05937376535','15959230221','355213','�㶫ʡ��ݸ�и߲�','1310','1403','1413','��Ӧʽ','240','0','13423209364','0','240','0','0','0','240','0','0','0','421831480','0','','','','','1315651784','125.93.183.3','1315652809','125.93.183.3');");
E_D("replace into `dw_userinfo` values('5','0','37',NULL,'0','0','0',NULL,NULL,NULL,NULL,'3','5','13','24','32','','33','37','39',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0358-4069606','15536471474','033000','','297','424','426','','240','','','','240','','','','240','','','','284638101','yun526419682',NULL,NULL,NULL,NULL,'1316331671','124.165.237.94','1316331738','124.165.237.94');");
E_D("replace into `dw_userinfo` values('6','0','52',NULL,'0','0','0',NULL,NULL,NULL,NULL,'1','5','11','21','31','','33','36','38','','','','','','','','','','','','','','47','54','165','73','','','227','','','','','60','2007-10-30','д��¥','600','12','','','','3','0','237','0','235','0','0','��־Ⱥ','2000','15155227312','0552-2040464','60','81','','2000','13','����ʡ�����з�֯��ר','��е','1992-09-01','1995-09-01','0552-2040464','13955290732','233000','����ʡ�����а�ɽ�������·48��7��һ��Ԫ6��','1170','1189','1192','��־Ⱥ','239','0552-2040464','','','240','','','','240','','','','84245841','','','','','','1316335793','117.65.27.112','1317637180','123.8.24.23');");
E_D("replace into `dw_userinfo` values('7','0','86',NULL,'0','0','0',NULL,NULL,NULL,NULL,'1','5','14','28','32','','34','36','39',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'�����н�����Ͷ������','475','61','91','74','2008-09-01','2011-11-03','227','0663-8277577','�㶫ʡ�����ж�ɽ���º��϶����ؽְ˴�201','http://www.jinlanfen.com','�Լ�����һ�¡�',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1500','237','','235','','20000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'14','��ͷְҵ����ѧԺ','���Ӽ���Ӧ��','2000-09-01','2003-09-01','0663-8575174','15914948451','522000','�����ж�ɽ������·�º��϶���B��104��','2184','2389','2392','ׯ����','239','8330989','15219636266','��ӳ��','240','0663-8330989','15018226680','������','242','0663-8822223','15915600271','lotaies@163.com','104749323','lotaies',NULL,NULL,NULL,NULL,'1320317291','127.0.0.1','1320320679','127.0.0.1');");
E_D("replace into `dw_userinfo` values('8','0','1',NULL,'0','0','0',NULL,NULL,NULL,NULL,'1','5','11','24','32','','34','36','38',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1320385534','127.0.0.1',NULL,NULL);");
E_D("replace into `dw_userinfo` values('9','0','90',NULL,'0','0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','240','','','','240','','','','240','','','','104548758','lotaies',NULL,NULL,NULL,NULL,'1320849539','27.47.118.133','1320849665','27.47.118.133');");
E_D("replace into `dw_userinfo` values('10','0','102',NULL,'0','0','0',NULL,NULL,NULL,NULL,'3','5','13','23','32','','33','37','39',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'��˼ά������','52','59','103','76','2011-11-04','2011-11-11','225','0663-8684391','�������ų����Ŷ���լ��6�ŵ�','','','59','2011-11-04','��˼ά������','800','36','��','��','��Լ1-2��֮��','�λ���4�ˣ������Ա2�ˣ���ʱû�У�',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'13','�й����������ѧԺ��������У��','ƽ�����/�������','2003-11-06','2007-11-06','8684391','13380594091','522031','�������ų����Ŷ���լ��6�ŵ�','2184','2389','2391','������','242','15915657420','15915657420','�´���','242','13539272245','13539272245','','240','','','','1056765934','','רҵ�����Ƽ��г��߻���ʱ���гн�����װ����ơ�','�������鶼�ܸɴ࣬˵һ��һ������������֮�<br /><br />\r\n��ʲô���Ƚ�����������ηη������<br /><br />\r\n˵�����Ӳ��������Ƚ�ֱ�ӡ�<br /><br />\r\nϲ���㽻���ѣ�����������','��Ǯ�ã������飬���黹�ڡ�','','1320993977','183.9.30.73','1320996260','183.9.30.73');");

require("../../inc/footer.php");
?>