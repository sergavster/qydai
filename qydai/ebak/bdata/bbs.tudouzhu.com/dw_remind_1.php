<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_remind`;");
E_C("CREATE TABLE `dw_remind` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `nid` varchar(50) DEFAULT NULL,
  `status` smallint(2) unsigned DEFAULT '0' COMMENT '״̬',
  `order` smallint(6) DEFAULT '0' COMMENT '����',
  `type_id` smallint(5) unsigned DEFAULT '0' COMMENT '����',
  `message` smallint(2) unsigned DEFAULT '0' COMMENT '����Ϣ',
  `email` smallint(2) unsigned DEFAULT '0' COMMENT '����',
  `phone` smallint(2) unsigned DEFAULT '0' COMMENT '�ֻ�',
  `addtime` int(10) DEFAULT '0',
  `addip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=gbk");
E_D("replace into `dw_remind` values('1','�����Ϊ����','friend_request','0','10','4','1','4','4','1284123091','127.0.0.1');");
E_D("replace into `dw_remind` values('2','��Ϊ���ѹ�ϵ','friend_yes','0','12','4','3','4','4','1284123281','127.0.0.1');");
E_D("replace into `dw_remind` values('3','�������ͨ��','withdraw_yes','0','10','1','1','4','2','0','');");
E_D("replace into `dw_remind` values('4','������˲�ͨ��','withdraw_no','0','10','1','1','4','2','0','');");
E_D("replace into `dw_remind` values('5','��վ��ֵ','recharge','0','10','1','1','4','2','0','');");
E_D("replace into `dw_remind` values('6','��֤��ⶳ','margin_thaw','0','10','1','1','4','2','0','');");
E_D("replace into `dw_remind` values('7','���³�ֵ','recharge_down','0','10','1','1','4','2','0','');");
E_D("replace into `dw_remind` values('8','VIP���ͨ��','vip_yes','0','10','1','1','4','2','0','');");
E_D("replace into `dw_remind` values('9','VIP��˲�ͨ��','vip_no','0','10','1','1','4','2','0','');");
E_D("replace into `dw_remind` values('10','�������ͨ��','borrow_yes','0','10','2','1','4','2','0','');");
E_D("replace into `dw_remind` values('11','�������ͨ��','borrow_no','0','10','2','1','4','2','0','');");
E_D("replace into `dw_remind` values('12','��������Ͷ��ʱ','borrow_join','0','10','2','1','4','2','0','');");
E_D("replace into `dw_remind` values('13','���긴��ͨ��','borrow_review_yes','0','10','2','1','4','2','0','');");
E_D("replace into `dw_remind` values('14','���긴��ͨ��','borrow_review_no','0','10','2','1','4','2','0','');");
E_D("replace into `dw_remind` values('15','��������','borrow_end','0','10','2','1','4','2','0','');");
E_D("replace into `dw_remind` values('16','��������','borrow_msg','0','10','2','1','4','2','0','');");
E_D("replace into `dw_remind` values('17','Ͷ��Ľ����޸�����','loan_update','0','10','3','1','4','2','0','');");
E_D("replace into `dw_remind` values('18','Ͷ��Ľ�������','loan_end','0','10','3','1','4','2','0','');");
E_D("replace into `dw_remind` values('19','����ɹ����۳������','loan_yes_account','0','10','3','1','4','2','0','');");
E_D("replace into `dw_remind` values('20','���ʧ�ܣ��ⶳ�����','loan_no_account','0','10','3','1','4','2','0','');");
E_D("replace into `dw_remind` values('21','�յ�����','loan_pay','0','10','3','1','4','2','0','');");
E_D("replace into `dw_remind` values('22','��վ�渶','loan_advanced','0','10','3','1','4','2','0','');");
E_D("replace into `dw_remind` values('23','��������','loan_assess','0','10','3','1','4','2','0','');");
E_D("replace into `dw_remind` values('24','�ܾ���������','friend_pass','0','10','4','1','4','4','0','');");
E_D("replace into `dw_remind` values('25','������ѹ�ϵ','friend_end','0','10','4','1','4','4','0','');");
E_D("replace into `dw_remind` values('26','�������ͨ��','info_yes','0','10','4','1','4','4','0','');");
E_D("replace into `dw_remind` values('27','������˲�ͨ��','info_no','0','10','4','1','4','4','0','');");

require("../../inc/footer.php");
?>