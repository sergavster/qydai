<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_liuyan_set`;");
E_C("CREATE TABLE `dw_liuyan_set` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `nid` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=gbk");
E_D("replace into `dw_liuyan_set` values('1','���ݱ���','name','234');");
E_D("replace into `dw_liuyan_set` values('2','��������','type','����|�ٱ�|Ͷ��|����');");
E_D("replace into `dw_liuyan_set` values('3','����״̬','status','1');");
E_D("replace into `dw_liuyan_set` values('4','��ʾҳ��','page','10');");

require("../../inc/footer.php");
?>