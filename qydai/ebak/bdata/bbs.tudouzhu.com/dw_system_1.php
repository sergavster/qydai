<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `dw_system`;");
E_C("CREATE TABLE `dw_system` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `nid` varchar(50) DEFAULT NULL,
  `value` varchar(250) DEFAULT NULL,
  `type` int(11) DEFAULT '0',
  `style` int(2) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=gbk");
E_D("replace into `dw_system` values('1','�ر�վ�㣨����̨ʹ�ã�','con_webopen','0','1','1','0');");
E_D("replace into `dw_system` values('2','��վ�ر���Ϣ','con_closemsg','ϵͳά��,ά���ڼ���û��������㣬���½⣬���������벦��ͷ�����15018226680','2','1','0');");
E_D("replace into `dw_system` values('3','��վ����','con_webname','XXͶ�����޹�˾','0','1','0');");
E_D("replace into `dw_system` values('4','��վ��ַ','con_weburl','http://bbs.gope.cn','0','1','0');");
E_D("replace into `dw_system` values('5','��վ·��','con_webpath','','0','1','0');");
E_D("replace into `dw_system` values('6','��վlogo','con_logo','','3','1','0');");
E_D("replace into `dw_system` values('7','��վ�ؼ���','con_keywords','XX�и����������� �޵�Ѻ���� �޵�Ѻ �޵��� С����� Ͷ����� ��ҵ����','0','1','0');");
E_D("replace into `dw_system` values('8','��վ����','con_description','xx������XX��xxͶ�����޹�˾Ͷ�ʽ����ı������ϴ���ƽ̨�������ڽ��������С�������Ҫ��ԸXXȫ��������Ǯ������ҵ�����гɡ�','0','1','0');");
E_D("replace into `dw_system` values('9','��վλ�÷ָ���','con_position',' ->','0','1','0');");
E_D("replace into `dw_system` values('10','��վ������','con_beian','��ICP��xxxxx��','0','1','0');");
E_D("replace into `dw_system` values('11','��վͳ��','con_tongji','��վͳ��','2','1','0');");
E_D("replace into `dw_system` values('12','��վ��̬����Ŀ¼','con_htmldir','html','0','1','0');");
E_D("replace into `dw_system` values('13','ģ����','con_template','ruizhict','0','1','0');");
E_D("replace into `dw_system` values('14','��վ��ҳ��ĿID','con_indexID','1','0','1','0');");
E_D("replace into `dw_system` values('15','ϵͳ��ʱʱ��(Сʱ)','con_session_time','1','0','1','0');");
E_D("replace into `dw_system` values('16','�Ƿ�ʹ�����ֵ�ַ����?1_2.html��','con_rewrite','1','1','1','0');");
E_D("replace into `dw_system` values('17','Ĭ���Ƿ�����html','con_autohtml','0','1','1','0');");
E_D("replace into `dw_system` values('18','�ϴ���ͼƬ�Ƿ�ʹ��ͼƬˮӡ����','con_watermark_pic','0','0','2','1');");
E_D("replace into `dw_system` values('19','�ɼ���ͼƬ�Ƿ�ʹ��ͼƬˮӡ����','con_watermark_caijipic','0','0','2','1');");
E_D("replace into `dw_system` values('20','ѡ��ˮӡ���ļ�����','con_watermark_type','0','0','2','1');");
E_D("replace into `dw_system` values('21','ˮӡ������','con_watermark_font','50','0','2','1');");
E_D("replace into `dw_system` values('22','ˮӡͼƬ�ļ���','con_watermark_file','/data/upfiles/litpics/201111031320335926.jpg','0','2','1');");
E_D("replace into `dw_system` values('23','ˮӡͼƬ���������С','con_watermark_size','','0','2','1');");
E_D("replace into `dw_system` values('24','ˮӡͼƬ������ɫ','con_watermark_color','#FF0000','0','2','1');");
E_D("replace into `dw_system` values('25','ˮӡ����','con_watermark_word','�����н�����Ͷ�����޹�˾','0','2','1');");
E_D("replace into `dw_system` values('26','ˮӡλ��','con_watermark_position','4','0','2','1');");
E_D("replace into `dw_system` values('27','���ͼƬˮӡ����������','con_watermark_imgpct','0','0','2','1');");
E_D("replace into `dw_system` values('28','�������ˮӡ����������','con_watermark_txtpct','0','0','2','1');");
E_D("replace into `dw_system` values('29','����ͼĬ�Ͽ��','con_fujian_imgwidth','80','0','3','1');");
E_D("replace into `dw_system` values('30','����ͼĬ�ϸ߶�','con_fujian_imgheight','80','0','3','1');");
E_D("replace into `dw_system` values('31','�����ϴ���ͼƬ����','con_fujian_imgtype','gif|jpg|png','0','3','1');");
E_D("replace into `dw_system` values('32','�����ϴ����������','con_fujian_annextype','','0','3','1');");
E_D("replace into `dw_system` values('33','����Ķ�ý���ļ�����','con_fujian_mediatype','','0','3','1');");
E_D("replace into `dw_system` values('34','��Աע���Ƿ���Ҫ������֤','con_member_reg_mail','','0','3','1');");
E_D("replace into `dw_system` values('35','�����Ƿ���Ҫ���','con_comment_verify','','0','3','0');");
E_D("replace into `dw_system` values('36','���õȼ�ͼƬ��ַ','con_credit_picurl','/data/images/credit/','0','1','1');");
E_D("replace into `dw_system` values('37','SMTP������','con_email_host','smtp.qq.com','0','4','0');");
E_D("replace into `dw_system` values('38','SMTP�������Ƿ���Ҫ��֤','con_email_auth','1','1','4','0');");
E_D("replace into `dw_system` values('39','�����ַ','con_email_email','xxxx@qq.com','0','4','0');");
E_D("replace into `dw_system` values('40','��������','con_email_pwd','xxxx','0','4','0');");
E_D("replace into `dw_system` values('41','������Email','con_email_from','xxxx@qq.com','0','4','0');");
E_D("replace into `dw_system` values('42','�������ǳƻ�����','con_email_from_name','xxxxͶ�ʽ��ƽ̨','0','4','0');");
E_D("replace into `dw_system` values('43','�����߶��','con_borrow_maxaccount','500000','0','1','0');");
E_D("replace into `dw_system` values('44','�ͻ���������','con_fuwutel','0663-8791118','0','1','1');");
E_D("replace into `dw_system` values('45','����','con_fax','0663-8791119','0','1','1');");
E_D("replace into `dw_system` values('46','��ϵ��ַ','con_address','�㶫ʡxx��xx���º��϶����ؽְ˴�xx��','0','1','1');");
E_D("replace into `dw_system` values('47','�ͷ�QQ1','con_qq1','<a target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=676668697&site=qq&menu=yes\"><img border=\"0\" src=\"http://wpa.qq.com/pa?p=2:676668697:41\" alt=\"���������ҷ���Ϣ\" title=\"���������ҷ���Ϣ\"></a>','2','1','1');");
E_D("replace into `dw_system` values('48','�ͷ�QQ2','con_qq2','<a target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=149296621&site=qq&menu=yes\"><img border=\"0\" src=\"http://wpa.qq.com/pa?p=2:149296621:41\" alt=\"���������ҷ���Ϣ\" title=\"���������ҷ���Ϣ\"></a>','2','1','1');");
E_D("replace into `dw_system` values('49','�ͷ�QQ3','con_qq3','<a target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=104749323&site=qq&menu=yes\"><img border=\"0\" src=\"http://wpa.qq.com/pa?p=2:104749323:41\" alt=\"���������ҷ���Ϣ\" title=\"���������ҷ���Ϣ\"></a>','2','1','1');");
E_D("replace into `dw_system` values('50','�ͷ�QQ4','con_qq4','<a target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=2454314662&site=qq&menu=yes\"><img border=\"0\" src=\"http://wpa.qq.com/pa?p=2:676664627:41\" alt=\"���������ҷ���Ϣ\" title=\"���������ҷ���Ϣ\"></a>','2','1','1');");
E_D("replace into `dw_system` values('51','�ͷ�QQ5','con_qq5','','2','1','1');");
E_D("replace into `dw_system` values('52','�ͷ�QQ6','con_qq6','','2','1','1');");
E_D("replace into `dw_system` values('53','ҵ��֧������','con_tel','0663-8791118','2','1','1');");
E_D("replace into `dw_system` values('54','�ͻ���������','con_kefutext','��ӭ����xxxͶ�ʿͷ����ģ�<br />\r\n���κ���������ϵ���ר���ͷ�!','2','1','1');");
E_D("replace into `dw_system` values('55','��Ա��','con_vip_money','180','0','1','1');");
E_D("replace into `dw_system` values('56','Ҫ��ע�����','con_vip_ticheng','30','0','1','1');");
E_D("replace into `dw_system` values('57','�û���ʼ��͵Ķ��','con_user_amount','2000','0','1','1');");
E_D("replace into `dw_system` values('58','�������','con_borrow_apr','28.2','0','1','1');");
E_D("replace into `dw_system` values('59','�Ƿ����cookie��¼','con_cookie','1','1','1','0');");
E_D("replace into `dw_system` values('60','��������','con_late_rate','0.008','0','1','1');");
E_D("replace into `dw_system` values('61','���ʽ��Ϣ','con_msg_repayment','0','2','1','1');");
E_D("replace into `dw_system` values('62','��̨��ַ����','con_houtai','gope','0','1','1');");
E_D("replace into `dw_system` values('63','�Ƿ��������䷢����Ϣ','con_emailsend','1','1','1','1');");
E_D("replace into `dw_system` values('64','����˽���������','con_borrow_fee','0.03','0','1','1');");
E_D("replace into `dw_system` values('65','ʵ����֤����','con_realname_fee','5','0','1','1');");
E_D("replace into `dw_system` values('66','�Ƿ�����Ƶ��֤�շ�','con_video_feestatus','0','1','1','1');");

require("../../inc/footer.php");
?>