<?
if (!defined('ROOT_PATH'))  die('���ܷ���');//��ֱֹ�ӷ���
check_rank("ucenter_".$_t);//���Ȩ��

$result = $module->get_module("ucenter");
if ($result == false && $t!="install"){
	$msg = array("��ģ����δ��װ���벻Ҫ�Ҳ���","",$url);
}else{


	
	/**
	 * ��װ��ģ��
	**/
	if ($t == "install"){
	
		/**���ģ��info����Ϣ
		**/
		$result = $module->get_module("ucenter");
		if ($result != false){
			$msg = array("���Ѿ���װ�˴�ģ�飬�����ظ���ӡ�","",$url);
		}
		if ($msg== "" && isset($_POST['submit'])){
			$var = array("uc_dbhost","uc_dbuser","uc_dbpw","uc_dbname","uc_charset","uc_dbtablepre","uc_key","uc_api","uc_charset","uc_ip","uc_appid");
			$index = post_var($var);
			$content = "<? define('UC_CONNECT', 'mysql');
						define('UC_DBHOST', '".$index['uc_dbhost']."');
						define('UC_DBUSER', '".$index['uc_dbuser']."');
						define('UC_DBPW', '".$index['uc_dbpw']."');
						define('UC_DBNAME', '".$index['uc_dbname']."');
						define('UC_DBCHARSET', '".$index['uc_charset']."');
						define('UC_DBTABLEPRE', '".$index['uc_dbtablepre']."');
						define('UC_DBCONNECT', '0');
						define('UC_KEY', '".$index['uc_key']."');
						define('UC_API', '".$index['uc_api']."');
						define('UC_CHARSET', '".$index['uc_charset']."');
						define('UC_IP', '".$index['uc_ip']."');
						define('UC_APPID', '".$index['uc_appid']."');
						define('UC_PPP', '20'); ?>";
			$info = get_module_info("ucenter");
			$info = array_merge($info,array("status"=>0,"remark"=>serialize($index)));
			$module->add_module($info);
			mk_file("modules/ucenter/config.inc.php",$content);
			$msg = array("��װ�ɹ���","",$url);
		}
	}
	
	/**
	 * ж�ش�ģ��
	**/
	elseif ($t == "unstall"){
		$_result = $module -> unstall_module("ucenter","ucenter_type");
		$msg = array("���Ѿ��ɹ�ж����ģ��");
		unlink("modules/ucenter/config.inc.php");
		$user->add_log($_log,$_result);//��¼����
		
	}
	
	/**
	 * �رմ�ģ��
	**/
	elseif ($t == "close"){
		$result = $module -> close_module("ucenter");
		$msg = array("���Ѿ��ɹ��ر��˴�ģ�飬�رպ���������ӵ�ʱ�򽫲��ῴ����ģ�顣");
		$user->add_log($_log,$result);//��¼����
	}
	
	/**
	 * �򿪴�ģ��
	**/
	elseif ($t == "open"){
		$msg = array("��ģ��Ϊ����ģ�飬���ܿ�����");
		$user->add_log($_log,$result);//��¼����
	}
	
	
	/**
	 * ɾ��
	**/
	elseif ($t == ""){
		$result = $module->get_module("ucenter");
		$_result = unserialize(html_entity_decode($result['remark']));
		
	}
}


if ($msg!=""){
	$template_tpl = show_msg($msg,$msg_tpl);//�������Ϣ����ֱ�Ӷ�ȡϵͳ����Ϣģ��
}else{
	$template_tpl = "ucenter.tpl";//����������ģ���ֱ�Ӷ�ȡģ�����ڵ���Ӧģ��
	$magic->assign("template_dir","modules/ucenter/");
}

$magic->assign("module_tpl",$template_tpl);
?>