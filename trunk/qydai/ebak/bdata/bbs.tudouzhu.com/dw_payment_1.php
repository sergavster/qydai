<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_payment`;");
E_C("CREATE TABLE `dw_payment` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `nid` varchar(100) DEFAULT NULL,
  `status` smallint(3) unsigned DEFAULT '0',
  `style` int(2) DEFAULT NULL,
  `config` longtext,
  `fee_type` int(2) DEFAULT NULL,
  `max_money` int(10) DEFAULT NULL,
  `max_fee` int(10) DEFAULT NULL,
  `description` longtext,
  `order` smallint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=gbk");
E_D("replace into `dw_payment` values('1','֧����','alipay','1','0','a:4:{s:9:\"alipay_id\";s:16:\"2088002506667295\";s:10:\"alipay_key\";s:32:\"jd4tmmwnuzavag933i0n1qyblgkjs3jc\";s:12:\"alipay_email\";s:15:\"lotaies@163.com\";s:11:\"alipay_type\";s:1:\"2\";}','0','0','1','֧������ʱ���ʣ��ǹ����Ƚ�������֧����ʽ��','1');");
E_D("replace into `dw_payment` values('9','��Ѷ�Ƹ�ͨ[��ʱ����]','tenpay','1','0','a:3:{s:9:\"member_id\";s:10:\"1212153501\";s:10:\"PrivateKey\";s:32:\"324bb56c466d30a2a40a6e1593967139\";s:8:\"authtype\";s:1:\"1\";}','1','0','0','��Ѷ�Ƹ�ͨ��ʱ����','10');");
E_D("replace into `dw_payment` values('10','��ѶIPS����֧��3.0','ips','0',NULL,'a:2:{s:9:\"member_id\";s:6:\"015312\";s:10:\"PrivateKey\";s:128:\"yXkD9pT4wfsBm08D9Ua3JPA05tXkNTmtz5ajV2T7QZyNbFkwxxH6w2Z8wJiqsJG2TYmH0yHga3DK0NyQiAM0mFXW51NmuCphsWTd33WZFA6SPpi8uriHXpqnaplYB5Mx\";}','0','0','0','<FONT face=����>֧��30����������֧��</FONT>','10');");
E_D("replace into `dw_payment` values('32','����֧��','offline','1',NULL,'s:0:\"\";','1','0','0','<P>����֧��ͬ��Ҫ��1%�Ĺ������.������վ��Ӫ�ɱ�����Ͷ�����½⡣</P><BR><br />\r\n<P>�й�ũҵ���� �����н����з��ж�ɽ֧��; ���ţ�6228 4113 9021 9721 114 </P><BR><br />\r\n<P>������������</P><BR><br />\r\n<P>�й��������� �����н����з����ų�֧��; ���ţ�<FONT face=����>6222 8032 6307 1003 047</FONT></P><BR><br />\r\n<P>������������</P><BR><br />\r\n<P>�й��������� �����н����з�������֧��; ���ţ�<FONT face=����>6222 0220 1900 0944 205</FONT></P><BR><br />\r\n<P>������������</P><BR><br />\r\n<P>�й��������� �����н����з���; ���ţ�4563 5170 1500 9101 368</P><BR><br />\r\n<P>������������</P><BR><br />\r\n<P>��ͨ���� �����н����з���; ���ţ�6222 6007 4000 0715 655</P><BR><br />\r\n<P>������������</P><BR><br />\r\n<P>�㷢���� �����н����з���; ���ţ�6225 6826 2100 0246 871</P><BR><br />\r\n<P>������������</P><BR><br />\r\n<P>�㶫ʡũ�����ÿ�(����ũ����ҵ����) �����н����Ͷ�֧��; </P><BR><br />\r\n<P>���ţ�6210 1888 0000 4907 107&nbsp; ������������</P><br />\r\n<P>ͬʱ��������Ͷ����Ҳ����ֱ�ӵ�����˾�������.��ַ����ɽ���º��϶����ؽְ˴�201(�����н�����Ͷ�����޹�˾)��ϵ�ˣ�������&nbsp; ��ϵ�绰��8277577</P>','10');");

require("../../inc/footer.php");
?>