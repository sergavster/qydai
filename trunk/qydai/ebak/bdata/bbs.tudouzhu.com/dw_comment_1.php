<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_comment`;");
E_C("CREATE TABLE `dw_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `module_code` varchar(50) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `comment` text,
  `flag` varchar(30) DEFAULT NULL COMMENT '��������',
  `order` varchar(10) DEFAULT NULL COMMENT '����',
  `status` int(2) DEFAULT NULL COMMENT '״̬',
  `addtime` varchar(30) DEFAULT NULL COMMENT '���ʱ��',
  `addip` varchar(30) DEFAULT NULL COMMENT '���ip',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=gbk");
E_D("replace into `dw_comment` values('24','0','86','borrow','48','pin lun chisi','1',NULL,'1','1320318650','127.0.0.1');");
E_D("replace into `dw_comment` values('25','0','90','borrow','62','�ֵܿ���һ����Ҳ�治�˼���Ǯ��!�ٷ�Ҫ����˺ϸ��ҿ��Զ��Щ�ġ������Ǵ򹤵����ر����Ȥ����׬��Ǯ�٣������ٲ����һ�Ǯ����֧���㡣','1',NULL,'1','1321005825','27.47.118.133');");
E_D("replace into `dw_comment` values('26','0','90','borrow','51','���ܰ����ٸ�����50�鰡��','1',NULL,'1','1321006251','27.47.118.133');");
E_D("replace into `dw_comment` values('27','0','102','borrow','62','�¸磬лл���������֮�֡�����׬�ˣ����������㡣','1',NULL,'1','1321014985','183.9.30.73');");
E_D("replace into `dw_comment` values('28','0','102','borrow','62','����Ͷ��ȥ��������²��ܴ���5000Ԫѽ�������ˡ�','1',NULL,'1','1321085888','119.140.37.79');");
E_D("replace into `dw_comment` values('29','0','86','borrow','58','������ֱ�Ӹ������ϰɡ�','1',NULL,'1','1321111442','120.84.98.127');");
E_D("replace into `dw_comment` values('30','0','86','article','111','�Ǻǣ��š�','1',NULL,'1','1321680815','120.84.100.162');");

require("../../inc/footer.php");
?>