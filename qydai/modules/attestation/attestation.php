<?
if (!defined('ROOT_PATH'))  die('���ܷ���');//��ֱֹ�ӷ���
check_rank("attestation_".$_A['query_type']);//���Ȩ��

include_once("attestation.class.php");

$_A['list_purview'] =  array("attestation"=>array("֤������"=>array("attestation_list"=>"֤���б�",
"attestation_new"=>"���֤��",
"attestation_edit"=>"�༭֤��",
"attestation_del"=>"ɾ��֤��",
"attestation_view"=>"���֤��",
"attestation_type_list"=>"�����б�",
"attestation_type_new"=>"�������",
"attestation_type_edit"=>"�༭����",
"attestation_type_del"=>"ɾ������",
"attestation_realname"=>"ʵ����֤",
"attestation_all"=>"�û���֤��Ϣ",
"attestation_vip"=>"vip��֤",
"attestation_vipview"=>"vip���",
"attestation_viewall"=>"�û���֤�б�",
"attestation_audit"=>"�û���֤����",
"attestation_view_all"=>"�û���֤�鿴")));//Ȩ��
$_A['list_name'] = $_A['module_result']['name'];
if($_G['user_result']['type_id']==3){
	$_A['list_menu'] = " <a href='{$_A['query_url']}/viewall{$_A['site_url']}'>�鿴���е��û�</a>  - <a href='{$_A['query_url']}/vip{$_A['site_url']}'>vip���</a>";
}elseif($_G['user_result']['type_id']==4){
	$_A['list_menu'] = " <a href='{$_A['query_url']}/viewall{$_A['site_url']}'>�鿴���е��û�</a> -  <a href='{$_A['query_url']}/vip{$_A['site_url']}'>vip���</a>   - <a href='{$_A['query_url']}/vip{$_A['site_url']}&type=1'>vip��֤</a>  - <a href='{$_A['query_url']}/all{$_A['site_url']}'>�û���֤��Ϣ</a> - <a href='{$_A['query_url']}/viewall{$_A['site_url']}'>�鿴���е��û�</a>";
}else{
$_A['list_menu'] = "<a href='{$_A['query_url']}{$_A['site_url']}'>֤���б�</a> - <a href='{$_A['query_url']}/new{$_A['site_url']}'>���֤��</a> - <a href='{$_A['query_url']}/type_list{$_A['site_url']}'>�����б�</a> - <a href='{$_A['query_url']}/type_new{$_A['site_url']}'>�������</a> - <a href='{$_A['query_url']}/realname{$_A['site_url']}'>ʵ����֤</a>  - <a href='{$_A['query_url']}/vip{$_A['site_url']}'>vip���</a>  - <a href='{$_A['query_url']}/vip{$_A['site_url']}&type=1'>vip��֤</a>  - <a href='{$_A['query_url']}/all{$_A['site_url']}'>�û���֤��Ϣ</a> - <a href='{$_A['query_url']}/viewall{$_A['site_url']}'>�鿴���е��û�</a> ";
}

/**
 * �������Ϊ�յĻ�����ʾ���е��ļ��б�
**/
if ($_A['query_type'] == "list"){
	$_A['list_title'] = "֤���б�";
	
	if (isset($_REQUEST['user_id']) && $_REQUEST['user_id']!=""){
		$data['user_id'] = $_REQUEST['user_id'];
	}
	if (isset($_REQUEST['type_id'])  && $_REQUEST['type_id']!=""){
		$data['type_id'] = $_REQUEST['type_id'];
	}
	if (isset($_REQUEST['username']) && $_REQUEST['username']!=""){
		$data['username'] = $_REQUEST['username'];
	}
	if (isset($_REQUEST['realname']) && $_REQUEST['realname']!=""){
		$data['realname'] = $_REQUEST['realname'];
	}
	if (isset($_REQUEST['status']) && $_REQUEST['status']!=""){
		$data['status'] = $_REQUEST['status'];
	}
	
	$data['page'] = $_A['page'];
	$data['epage'] = $_A['epage'];
	$result = attestationClass::GetList($data);
	
	if (is_array($result)){
		$pages->set_data($result);
		$_A['attestation_list'] = $result['list'];
		$_A['showpage'] = $pages->show(3);
	
	}else{
		$msg = array($result);
	}
}

/**
 * �������Ϊ�յĻ�����ʾ���е��ļ��б�
**/
elseif ($_A['query_type'] == "viewall"){
	$_A['list_title'] = "�鿴���е���Ϣ";
	
	if($_G['user_result']['type_id']==3){
		$data['kefu_userid'] = $_G['user_id'];
	}
	if (isset($_REQUEST['username']) && $_REQUEST['username']!=""){
		$data['username'] = $_REQUEST['username'];
	}
	if (isset($_REQUEST['realname']) && $_REQUEST['realname']!=""){
		$data['realname'] = $_REQUEST['realname'];
	}
	if (isset($_REQUEST['keywords']) && $_REQUEST['keywords']!=""){
		$data['username'] = $_REQUEST['keywords'];
	}
	$data['page'] = $_A['page'];
	$data['epage'] = $_A['epage'];
	$result = userClass::GetList($data);
	
	if (is_array($result)){
		$pages->set_data($result);
		$_A['viewall_list'] = $result['list'];
		$_A['showpage'] = $pages->show(3);
	
	}else{
		$msg = array($result);
	}
}
	/**
 * VIP��˲鿴
**/
elseif ($_A['query_type'] == "view_all"){
	if (isset($_POST['vip_status'])){
		
	}else{
		$_A['user_result'] = userClass::GetOne(array("user_id"=>$_REQUEST['user_id']));
		if ($_A['user_result']['kefu_userid']!=$_G['user_id'] && $_G['user_result']['type_id']==3){
			$msg = array("�벻Ҫ�Ҳ���");
		}
		include_once(ROOT_PATH."modules/userinfo/userinfo.class.php");
		$_A['userinfo_result'] = userinfoClass::GetOne(array("user_id"=>$_REQUEST['user_id']));
	}
}
/**
 * ���
**/
elseif ($_A['query_type'] == "new" || $_A['query_type'] == "edit" ){
	if ($_A['query_type'] == "new"){
		$_A['list_title'] = "���֤��";
	}else{
		$_A['list_title'] = "�޸�֤��";
	}
	if (isset($_POST['type_id'])){
		$var = array("type_id","content","litpic","user_id","litpic","status","jifen");
		$data = post_var($var);
		
		
		if ($_A['query_type'] == "new"){
			$result = attestationClass::Add($data);
		}else{
			$data['id'] = $_POST['id'];
			$result = attestationClass::Update($data);
		}
		
		if ($result !== true){
			$msg = array($result);
		}else{
			$msg = array("�����ɹ�");
		}
		$user->add_log($_log,$result);//��¼����
	}elseif ($_A['query_type'] == "edit" ){
		
		$_A['attestation_type_list'] = attestationClass::GetTypeList(array("limit"=>"all"));
		
		$data['id'] = $_REQUEST['id'];
		$result = attestationClass::GetOne($data);
		if (is_array($result)){
			$_A['attestation_result'] = $result;
		}else{
			$msg = array($result);
		}
		
		
	}else{
		$_A['attestation_type_list'] = attestationClass::GetTypeList(array("limit"=>"all"));
	}
}

/**
 * �鿴
**/
elseif ($_A['query_type'] == "view"){
	require_once("modules/credit/credit.class.php");
	require_once("modules/message/message.class.php");
	$_A['list_title'] = "�鿴��֤";
	$result = creditClass::GetTypeOne(array("nid"=>"zhengjian"));
	$_A['arrestation_value'] = $result['value'];
	$_A['credit_type_id'] = $result['id'];
	$_A['credit_type_name'] = $result['name'];
	if (isset($_POST['id'])){
		if($_SESSION['valicode']!=$_POST['valicode']){
			$msg = array("��֤�벻��ȷ");
		}else{
			$var = array("id","status","verify_remark","jifen");
			$data = post_var($var);
			$data['verify_user'] = $_G['user_id'];
			$data['verify_time'] = time();
			if ($data['status']!=1){
				$data['jifen'] = 0;
			}
			$attestation_result = attestationClass::GetOne(array("id"=>$data['id']));
			if ($attestation_result['status']==1){
				$msg = array("��֤���Ѿ����ͨ�����벻Ҫ�ظ���ˡ�");
			}elseif ($data['status']==1){
				$result = attestationClass::Update($data);//��������״̬
				$credit['nid'] = "zhengjian";
				$credit['user_id'] = $_POST['user_id'];
				$credit['value'] = $data['jifen'];
				$credit['op_user'] = $_G['user_id'];
				$credit['op'] = 1;//����
				$credit['type_id'] = $_A['credit_type_id'];
				$credit['remark'] = $data['verify_remark'];
				creditClass::UpdateCredit($credit);//���»���
				
				$message['sent_user'] = $_G['user_id'];
				$message['receive_user'] = $_POST['user_id'];
				$message['name'] = "{$_POST['type_name']}���ͨ������{$data['jifen']}��";
				$message['content'] = $data['verify_remark'];
				$message['type'] = "system";
				$message['status'] = 0;
				messageClass::Add($message);//���Ͷ���Ϣ
				$msg = array("�����ɹ�","",$_A['query_url'].$_A['query_site']);
			}elseif ($data['status']==2){
				$message['sent_user'] = $_G['user_id'];
				$message['receive_user'] = $_POST['user_id'];
				$message['name'] = "{$_POST['type_name']}���δͨ��";
				$message['content'] = $data['verify_remark'];
				$message['type'] = "system";
				$message['status'] = 0;
				messageClass::Add($message);//���Ͷ���Ϣ
				$result = attestationClass::Update($data);//��������״̬
				$msg = array("�����ɹ�","",$_A['query_url'].$_A['query_site']);
			}
			$_SESSION['valicode'] = "";
		}
		$user->add_log($_log,$result);//��¼����
	}else{
		$data['id'] = $_REQUEST['id'];
		$_A['attestation_result'] = attestationClass::GetOne($data);
		if ($_A['attestation_result']['status']==1){
			$msg = array("����Ϣ��ͨ����֤���벻Ҫ������֤");
		}
	}
}


/**
 * ɾ��
**/
elseif ($_A['query_type'] == "del"){
	$data['id'] = $_REQUEST['id'];
	$result = attestationClass::Delete($data);
	if ($result !== true){
		$msg = array($result);
	}else{
		$msg = array("ɾ���ɹ�");
	}
	$user->add_log($_log,$result);//��¼����
}

/**
 * �������Ϊ�յĻ�����ʾ���е��ļ��б�
**/
elseif ($_A['query_type'] == "type_list"){
	$_A['list_title'] = "֤���б�";
	
	if (isset($_REQUEST['user_id'])){
		$data['user_id'] = $_REQUEST['user_id'];
	}
	if (isset($_REQUEST['type_id'])){
		$data['type_id'] = $_REQUEST['type_id'];
	}
	if (isset($_REQUEST['username'])){
		$data['username'] = $_REQUEST['username'];
	}
	
	$data['limit'] = "all";
	$result = attestationClass::GetTypeList($data);
	if (is_array($result)){
		$_A['attestation_type_list'] = $result;
	}else{
		$msg = array($result);
	}
}

	
/**
 * ���
**/
elseif ($_A['query_type'] == "type_new" || $_A['query_type'] == "type_edit" ){
	if ($_A['query_type'] == "type_new"){
		$_A['list_title'] = "���֤��";
	}else{
		$_A['list_title'] = "�޸�֤��";
	}
	if (isset($_POST['name'])){
		$var = array("name","order","summary","remark","status","jifen");
		$data = post_var($var);
		
		if ($_A['query_type'] == "type_new"){
			$result = attestationClass::AddType($data);
		}else{
			$data['type_id'] = $_POST['type_id'];
			$result = attestationClass::UpdateType($data);
		}
		
		if ($result !== true){
			$msg = array($result);
		}else{
			$msg = array("�����ɹ�");
		}
		$user->add_log($_log,$result);//��¼����
	}elseif ($_A['query_type'] == "type_edit" ){
		$data['type_id'] = $_REQUEST['type_id'];
		$result = attestationClass::GetTypeOne($data);
		if (is_array($result)){
			$_A['attestation_type_result'] = $result;
		}else{
			$msg = array($result);
		}
	}
}



/**
 * ɾ��
**/
elseif ($_A['query_type'] == "type_del"){
	$data['type_id'] = $_REQUEST['type_id'];
	$result = attestationClass::DeleteType($data);
	if ($result !== true){
		$msg = array($result);
	}else{
		$msg = array("ɾ���ɹ�");
	}
	$user->add_log($_log,$result);//��¼����
}

/**
 * �޸��û���������
**/
elseif ($_A['query_type'] == "type_order"){
	$data['order'] = $_POST['order'];
	$data['type_id'] = $_POST['type_id'];
	$result = attestationClass::OrderType($data);
	if ($result == false){
		$msg = array("���������������Ա��ϵ");
	}else{
		$msg = array("�����޸ĳɹ�");
	}
	$user->add_log($_log,$result);//��¼����
}

/**
 * �������Ϊ�յĻ�����ʾ���е��ļ��б�
**/
elseif ($_A['query_type'] == "realname"){
	$_A['list_title'] = "ʵ����֤";
	
	$data['page'] = $_A['page'];
	$data['epage'] = $_A['epage'];
	if (isset($_REQUEST['real_status'])){
		if ($_REQUEST['real_status']==1){
			$data['real_status'] = "1";
		}else{
			$data['real_status'] = "2";
		}
	}else{
		$data['real_status'] = "1,2";
	}
	if (isset($_REQUEST['username'])){
		$data['username'] = $_REQUEST['username'];
	}
	$data['order'] = "real_status";
	$result = userClass::GetList($data);
	
	if (is_array($result)){
		
		$pages->set_data($result);
		$_A['user_real_list'] = $result['list'];
		$_A['showpage'] = $pages->show(3);
	
	}else{
		$msg = array($result);
	}
}

/**
 * �û����е������Ϣ
**/
elseif ($_A['query_type'] == "all"){
	$_A['list_title'] = "�û���ص���֤��Ϣ";
	
	$data['page'] = $_A['page'];
	$data['epage'] = $_A['epage'];
	if (isset($_REQUEST['username'])){
		$data['username'] = $_REQUEST['username'];
	}
	if (isset($_REQUEST['realname'])){
		$data['realname'] = $_REQUEST['realname'];
	}
	if (isset($_REQUEST['type'])){
		if ($_REQUEST['type']=="phone"){
			$data['phone_status'] = 1;
		}elseif ($_REQUEST['type']=="video"){
			$data['video_status'] = 1;
		}elseif ($_REQUEST['type']=="email"){
			$data['email_status'] = 1;
		}elseif ($_REQUEST['type']=="scene"){
			$data['scene_status'] = 1;
		}elseif ($_REQUEST['type']=="realname"){
			$data['real_status'] = 1;
		}
	}
	$result = userClass::GetList($data);
	
	if (is_array($result)){
		$pages->set_data($result);
		$_A['user_all_list'] = $result['list'];
		$_A['showpage'] = $pages->show(3);
	
	}else{
		$msg = array($result);
	}
}


/**
 * ���
**/
elseif ($_A['query_type'] == "audit"){
	require_once("modules/credit/credit.class.php");
	require_once("modules/message/message.class.php");
	
	if (isset($_POST['status'])){
		if($_SESSION['valicode']!=$_POST['valicode']){
				$msg = array("��֤�벻��ȷ");
		}else{
			$_name = array("realname"=>"ʵ����֤","email"=>"������֤","phone"=>"�ֻ���֤","video"=>"��Ƶ��֤","scene"=>"�ֳ���֤");
			if ($_POST['status']==2){
				$data['name'] = $_name[$_POST['nid']]."���ûͨ��";
				$user->UpdateUser(array("user_id"=>$_POST['user_id'],"real_status"=>0));//�û�����֤״̬��Ϊ0
			}elseif ($_POST['status']==1){
				$_res = true;
				$_data['user_id'] = $_POST['user_id'];
				$user_result = userClass::GetOne($_data);
				if ($_POST['nid']=="realname"){
					if ($user_result['real_status']!=1){
						include_once(ROOT_PATH."/modules/account/account.class.php");
						$account_result =  accountClass::GetOne($_data);
						$log['user_id'] = $_data['user_id'];
						$log['type'] = "realname";
						$realname_money = (isset($_G["system"]["con_realname_fee"])  && $_G["system"]["con_realname_fee"] >0 )?$_G["system"]["con_realname_fee"]:5;
						$log['money'] = $realname_money;
						$log['total'] = $account_result['total']-$log['money'];
						$log['use_money'] = $account_result['use_money']-$log['money'];
						$log['no_use_money'] = $account_result['no_use_money'];
						$log['collection'] = $account_result['collection'];
						$log['to_user'] = 0;
						$log['remark'] = "ʵ����֤�۳�����";
						accountClass::AddLog($log);
						$user->UpdateUser(array("user_id"=>$_POST['user_id'],"real_status"=>1));//�û�����ʵ����״̬
					}else{
						$_res = false;
					}
				}elseif($_POST['nid']=="phone"){
					if ($user_result['phone_status']==1){
						$_res = false;
					}else{
						if ($user_result['phone_status']>1){
							$phone = $user_result['phone_status'];
							$user->UpdateUser(array("user_id"=>$_POST['user_id'],"phone"=>$phone,"phone_status"=>1));
						}else{
							$user->UpdateUser(array("user_id"=>$_POST['user_id'],"phone_status"=>1));
						}
					}
				}elseif ($_POST['nid']=="video"){
					if ($user_result['video_status']==1){
						
						$_res = false;
					}else{
						if ($_G['system']["con_video_feestatus"]==1){
							include_once(ROOT_PATH."/modules/account/account.class.php");
							$account_result =  accountClass::GetOne($_data);
							$log['user_id'] = $_data['user_id'];
							$log['type'] = "video";
							$log['money'] = 10;
							$log['total'] = $account_result['total']-$log['money'];
							$log['use_money'] = $account_result['use_money']-$log['money'];
							$log['no_use_money'] = $account_result['no_use_money'];
							$log['collection'] = $account_result['collection'];
							$log['to_user'] = 0;
							$log['remark'] = "��Ƶ��֤�۳�����";
							accountClass::AddLog($log);
						}
						$user->UpdateUser(array("user_id"=>$_POST['user_id'],"video_status"=>1));//��Ƶ��֤
					}
				}elseif ($_POST['nid']=="scene"){
					if ($user_result['scene_status']==1){
						$_res = false;
					}else{
						$user->UpdateUser(array("user_id"=>$_POST['user_id'],"scene_status"=>1));//��Ƶ��֤
					}
				}
				if ($_res==true){
					$credit['nid'] = $_POST['nid'];
					$credit['user_id'] = $_POST['user_id'];
					$credit['value'] = $_POST['jifen'];
					$credit['op_user'] = $_G['user_id'];
					$credit['op'] = 1;//����
					$credit['remark'] = nl2br($_POST['content']);
					creditClass::UpdateCredit($credit);//���»���
					$data['name'] = $_name[$_POST['nid']]."���ͨ���������û���{$_POST['jifen']}�֡�";
				}
				$_SESSION['valicode'] = "";
			}
		}
		if ($_res==true){
			$data['sent_user'] = "admin";
			$data['receive_user'] = $_POST['user_id'];
			$data['content'] = nl2br($_POST['content']);
			$data['type'] = "system";
			$data['status'] = 0;
			messageClass::Add($data);//���Ͷ���Ϣ
			$msg = array("�޸ĳɹ�","",$_A['query_url']."/all".$_A['site_url']);
		}else{
			$msg = array("����Ϣ�Ѿ���˹����벻Ҫ�ظ���ˡ�");
		}
	}else{
		$type = $_REQUEST['type'];
		$result = creditClass::GetTypeOne(array("nid"=>$type));
		$_A['arrestation_value'] = $result['value'];
		$_A['credit_type_id'] = $result['id'];
		$magic->assign("_A",$_A);
		$magic->display("audit.tpl","modules/attestation");exit;
	}
	
	
}


/**
 * VIP�û�
**/
elseif ($_A['query_type'] == "vip"){
	$data['page'] = $_A['page'];
	$data['epage'] = $_A['epage'];
	$data['vip_status'] = isset($_REQUEST['type'])?$_REQUEST['type']:"2";
	if($_G['user_result']['type_id']==3){
		$data['kefu_userid'] = $_G['user_id'];
	}
	if (isset($_REQUEST['username']) && $_REQUEST['username']!=""){
		$data['username'] = $_REQUEST['username'];
	}
	if (isset($_REQUEST['realname']) && $_REQUEST['realname']!=""){
		$data['realname'] = $_REQUEST['realname'];
	}
	if (isset($_REQUEST['keywords']) && $_REQUEST['keywords']!=""){
		$data['username'] = $_REQUEST['keywords'];
	}
	if (isset($_REQUEST['kefu']) && $_REQUEST['kefu']!=""){
		$data['kefu_username'] = $_REQUEST['kefu'];
	}
	$result = userClass::GetList($data);//0��ʾ�û�������1��ʾ�����������
	$pages->set_data($result);
	
	$_A['user_vip_list'] = $result['list'];
	$_A['showpage'] = $pages->show(3);
	
}



/**
 * VIP�û�
**/
elseif ($_A['query_type'] == "jifen"){
	if ($_POST['id']!=""){
		$_val = 0;
		foreach ($_POST['id'] as $key => $_value){
			$sql = "update `{credit_log}` set value='{$_POST['val'][$key]}' where id='{$_value}'";
			$mysql->db_query($sql);
			$_val +=$_POST['val'][$key];
		}
		$sql = "update  `{credit}` set value = {$_val}  where user_id='{$_POST['user_id']}'";
		$mysql->db_query($sql);
		$sql = "update  `{user_cache}` set credit = {$_val}  where user_id='{$_POST['user_id']}'";
		$mysql->db_query($sql);
		$msg = array("�޸ĳɹ�");
	}else{
		$sql = "select p1.*,p2.username,p2.realname,p3.name as typename from `{credit_log}` as p1 
		left join `{user}` as p2 on p1.user_id=p2.user_id 
		left join `{credit_type}` as p3 on p1.type_id=p3.id
		where p1.user_id='{$_REQUEST['user_id']}'";
		$result = $mysql->db_fetch_arrays($sql);
		$_A['jifen_result'] = $result;
	}
	
}

/**
 * VIP��˲鿴
**/
elseif ($_A['query_type'] == "vipview"){
	if (isset($_POST['vip_status'])){
		$var = array("vip_status","vip_verify_remark","user_id");
		$data = post_var($var);
		if ($data['vip_status']==1){
			$data['vip_verify_time'] = time();
		}
		$user_id=$_REQUEST['user_id'];
		$data['user_id'] = $user_id;
		$result = userClass::GetOne($data);
		if($result['vip_status']==1){
			$msg = array("vip�Ѿ����ͨ�����벻Ҫ�ظ����");
		}else{
			$result = userClass::UpdateUserCache($data);//����
			include_once(ROOT_PATH."/modules/account/account.class.php");
			include_once(ROOT_PATH."/modules/message/message.class.php");
			if ($data['vip_status']==1){
				//ulk
				$sqls="update `{user_amount}` set credit=credit+50000,credit_use=credit_use+50000,borrow_vouch=borrow_vouch+50000,borrow_vouch_use=borrow_vouch_use+50000 where user_id='$user_id'";
				attestationClass::Updatesql($sqls);
				
				//�۳�vip�Ļ�Ա�ѡ�
				accountClass::AccountVip(array("user_id"=>$user_id));
				
				$message['sent_user'] = 0;
				$message['receive_user'] = $user_id;
				$message['name'] = "VIP���ͨ��";
				$message['content'] = "����vip��".date("Y-m-d",time())."ͨ����ˡ�";
				$message['type'] = "system";
				$message['status'] = 0;
				messageClass::Add($message);//���Ͷ���Ϣ
				$msg = array("VIP�û���˳ɹ�","","{$_A['query_url']}/vip");
				
				//��������
				$remind['nid'] = "vip_yes";
				$remind['sent_user'] = "0";
				$remind['receive_user'] = $user_id;
				$remind['title'] = "VIP���ͨ��";
				$remind['content'] = "����vip��".date("Y-m-d",time())."ͨ����ˡ�";
				$remind['type'] = "system";
				remindClass::sendRemind($remind);
			}else{
				$msg = array("VIP�û���˳ɹ�","","{$_A['query_url']}/vip");
				
				//��������
				$remind['nid'] = "vip_no";
				$remind['sent_user'] = "0";
				$remind['receive_user'] = $user_id;
				$remind['title'] = "VIP��˲�ͨ��";
				$remind['content'] = "����vip��".date("Y-m-d",time())."û��ͨ����ˡ�";
				$remind['type'] = "system";
				remindClass::sendRemind($remind);
			}
		}
		
		$user->add_log($_log,$result);//��¼����
	}else{
		$_A['user_result'] = userClass::GetOne(array("user_id"=>$_REQUEST['user_id']));
	}
}

//��ֹ�Ҳ���
else{
	$msg = array("���������벻Ҫ�Ҳ���","",$url);
}
?>