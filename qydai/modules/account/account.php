<?
if (!defined('ROOT_PATH'))  die('���ܷ���');//��ֱֹ�ӷ���
check_rank("account_".$_A['query_type']);//���Ȩ��

include_once("account.class.php");

$_A['list_purview'] =  array("account"=>array("�˺��ʽ����"=>array("account_list"=>"��Ϣ�б�","account_bank"=>"�����ʻ�","account_cash"=>"���ּ�¼","account_recharge"=>"��ֵ��¼","account_log"=>"�ʽ��¼")));//Ȩ��
$_A['list_name'] = $_A['module_result']['name'];
$_A['list_menu'] = "<a href='{$_A['query_url']}{$_A['site_url']}'>�ʻ���Ϣ�б�</a> - <a href='{$_A['query_url']}/cash&status=0{$_A['site_url']}'>��������</a> - <a href='{$_A['query_url']}/cash&status=1{$_A['site_url']}'>���ֳɹ�</a> -  - <a href='{$_A['query_url']}/cash&status=2{$_A['site_url']}'>����ʧ��</a> - <a href='{$_A['query_url']}/recharge{$_A['site_url']}'>��ֵ��¼</a>  - <a href='{$_A['query_url']}/log{$_A['site_url']}'>�ʽ��¼</a> - <a href='{$_A['query_url']}/recharge_new{$_A['site_url']}'>��ӳ�ֵ</a> - <a href='{$_A['query_url']}/deduct{$_A['site_url']}'>�۳�����</a>";


/**
 * �������Ϊ�յĻ�����ʾ���е��ļ��б�
**/
if ($_A['query_type'] == "list"){
	$_A['list_title'] = "�ʻ���Ϣ�б�";
	
	if (isset($_REQUEST['user_id']) && $_REQUEST['user_id']!=""){
		$data['user_id'] = $_REQUEST['user_id'];
	}
	
	if (isset($_REQUEST['username']) && $_REQUEST['username']!=""){
		$data['username'] = $_REQUEST['username'];
	}
	
	$data['page'] = $_A['page'];
	$data['epage'] = $_A['epage'];
	$result = accountClass::GetList($data);
	
	if (is_array($result)){
		$pages->set_data($result);
		$_A['account_list'] = $result['list'];
		$_A['showpage'] = $pages->show(3);
	
	}else{
		$msg = array($result);
	}
}

	
/**
 * ���ּ�¼
**/
elseif ($_A['query_type'] == "cash"){
	$_A['list_title'] = "���ּ�¼";
	
	if (isset($_REQUEST['user_id'])){
		$data['user_id'] = $_REQUEST['user_id'];
	}
	
	if (isset($_REQUEST['username'])){
		$data['username'] = $_REQUEST['username'];
	}
	if (isset($_REQUEST['status']) && $_REQUEST['status']!=""){
		$data['status'] = $_REQUEST['status'];
	}
	if (isset($_REQUEST['type']) && $_REQUEST['type']=="excel"){
		$title = array("Id","�û�����","��ʵ����","�����˺�","��������","֧��","�����ܶ�","���˽��","������","����ʱ��","״̬");
		$data['limit'] = "all";
		$result = accountClass::GetCashList($data);
		foreach ($result as $key => $value){
			 if ($value["status"]==1){
			 	$state  = "���ͨ��";
			 }elseif ($value["status"]==0){
			 	$state  = "������";
			 }elseif ($value["status"]==2){
			 	$state  = "����ܾ�";
			 }
			
			$_data[$key] = array($key+1,$value['username'],$value['realname'],"[".$value['account']."]",$value['bank_name'],$value['branch'],$value['total'],$value['credited'],$value['fee'],date("Y-m-d",$value['addtime']),$state);
		}
		exportData("�����б�",$title,$_data);
		exit;
	}
	$data['page'] = $_A['page'];
	$data['epage'] = $_A['epage'];
	$result = accountClass::GetCashList($data);
	
	if (is_array($result)){
		$pages->set_data($result);
		$_A['account_cash_list'] = $result['list'];
		$_A['showpage'] = $pages->show(3);
	
	}else{
		$msg = array($result);
	}
}
/**
 * ������˲鿴
**/
elseif ($_A['query_type'] == "cash_view"){
	$_A['list_title'] = "������˲鿴";
	if (isset($_POST['id'])){
		$var = array("id","status","credited","fee","verify_remark");
		$data = post_var($var);
		$result = accountClass::GetCashOne(array("id"=>$data['id'],"user_id"=>$_POST['user_id']));
		if ($data['status']==1){
			$account_result =  accountClass::GetOne(array("user_id"=>$_POST['user_id']));
			$log['user_id'] = $_POST['user_id'];
			$log['type'] = "recharge_success";
			$log['money'] = $result['total'];
			$log['total'] = $account_result['total'] - $log['money'];
			$log['use_money'] = $account_result['use_money'] ;
			$log['no_use_money'] = $account_result['no_use_money'] - $log['money'];
			$log['collection'] = $account_result['collection'];
			$log['to_user'] = "0";
			$log['remark'] = "���ֳɹ�";
			$result = accountClass::AddLog($log);
			
			//��������
			$remind['nid'] = "cash_yes";
			$remind['sent_user'] = "0";
			$remind['receive_user'] = $_POST['user_id'];
			$remind['title'] = "����{$log['total']}Ԫ�ѳɹ�";
			$remind['content'] = "���Ѿ���".date("Y-m-d",time())."�ɹ�������{$log['total']}Ԫ";
			$remind['type'] = "cash";
			remindClass::sendRemind($remind);
		}elseif ($data['status']==2){
			$account_result =  accountClass::GetOne(array("user_id"=>$_POST['user_id']));
			$log['user_id'] = $_POST['user_id'];
			$log['type'] = "recharge_false";
			$log['money'] = $result['total'];
			$log['total'] = $account_result['total'];
			$log['use_money'] = $account_result['use_money'] + $log['money'];
			$log['no_use_money'] = $account_result['no_use_money']- $log['money'];
			$log['collection'] = $account_result['collection'];
			$log['to_user'] = "0";
			$log['remark'] = "����ʧ��";
			$result = accountClass::AddLog($log);
			
			
			//��������
			$remind['nid'] = "cash_no";
			$remind['sent_user'] = "0";
			$remind['receive_user'] = $_POST['user_id'];
			$remind['title'] = "����{$log['total']}Ԫʧ��";
			$remind['content'] = date("Y-m-d",time())."����{$log['total']}Ԫʧ��";
			$remind['type'] = "cash";
			remindClass::sendRemind($remind);
		}
		$data['verify_userid'] = $_G['user_id'];
		$data['verify_time'] = time();
		$data['user_id'] = $_POST['user_id'];
		$result = accountClass::UpdateCash($data);
		if ($result !== true){
			$msg = array($result);
		}else{
			$msg = array("�����ɹ�","",$_A['query_url']."/cash".$_A['site_url']);
		}

		$user->add_log($_log,$result);//��¼����
	}else{
		$data['id'] = $_REQUEST['id'];
		$_A['account_cash_result'] = accountClass::GetCashOne($data);
	}
}

/**
 * �˺ų�ֵ
**/
elseif ($_A['query_type'] == "recharge_view"){
	$_A['list_title'] = "��ֵ�鿴";
	if (isset($_POST['id'])){
		$var = array("id","status","verify_remark");
		$data = post_var($var);
		$result = accountClass::GetRechargeOne(array("id"=>$_POST['id']));
		if ($result['status']!=0){
			$msg = array("�˳�ֵ�Ѿ���ˣ��벻Ҫ�ظ���ˡ�");
		}else{
			if ($data['status']==1){
				
				$account_result =  accountClass::GetOne(array("user_id"=>$result['user_id']));
				$log['user_id'] = $result['user_id'];
				$log['type'] = "recharge";
				$log['money'] = $result['money'];
				$log['total'] = $account_result['total']+$result['money'];
				$log['use_money'] =  $account_result['use_money']+$result['money'];
				$log['no_use_money'] =  $account_result['no_use_money'];
				$log['collection'] = $account_result['collection'];
				$log['to_user'] = "0";
				$log['remark'] = "�˺ų�ֵ";
				accountClass::AddLog($log);
				
				if($result['fee']!=0){
					$account_result =  accountClass::GetOne(array("user_id"=>$result['user_id']));
					$log['user_id'] = $result['user_id'];
					$log['type'] = "fee";
					$log['money'] = $result['fee'];
					$log['total'] =$account_result['total']-$log['money'];
					$log['use_money'] = $account_result['use_money']-$log['money'];
					$log['no_use_money'] = $account_result['no_use_money'];
					$log['collection'] = $account_result['collection'];
					$log['to_user'] = "0";
					$log['remark'] = "��ֵ�����ѿ۳�";
					accountClass::AddLog($log);
				}
				
				//�ж�vip��Ա���Ƿ�۳�
				accountClass::AccountVip(array("user_id"=>$result['user_id']));
				
				
				//��������
				$remind['nid'] = "recharge";
				$remind['sent_user'] = "0";
				$remind['receive_user'] = $result['user_id'];
				$remind['title'] = "��ֵ{$result['money']}Ԫ�ѳɹ�";
				$remind['content'] = "���Ѿ���".date("Y-m-d",time())."�ɹ���ֵ{$result['money']}Ԫ";
				$remind['type'] = "recharge";
				remindClass::sendRemind($remind);
				
			}elseif ($data['status']==2){
				
				//��������
				$remind['nid'] = "recharge";
				$remind['sent_user'] = "0";
				$remind['receive_user'] = $result['user_id'];
				$remind['title'] = "��ֵ{$result['money']}Ԫʧ��";
				$remind['content'] = date("Y-m-d",time())."��ֵ{$result['money']}Ԫ���ʧ��";
				$remind['type'] = "recharge";
				remindClass::sendRemind($remind);
			
			}
			
			$data['verify_userid'] = $_G['user_id'];
			$data['verify_time'] = time();
			$result = accountClass::UpdateRecharge($data);
		
			if ($result !== true){
				$msg = array($result);
			}else{
				$msg = array("�����ɹ�","",$_A['query_url']."/recharge".$_A['site_url']);
			}
		}
		$user->add_log($_log,$result);//��¼����
	}else{
		$data['id'] = $_REQUEST['id'];
		$_A['account_recharge_result'] = accountClass::GetRechargeOne($data);
	}
}
	
/**
 * ��ֵ��¼
**/
elseif ($_A['query_type'] == "recharge"){
	$_A['list_title'] = "��ֵ��¼";
	
	if (isset($_REQUEST['user_id'])){
		$data['user_id'] = $_REQUEST['user_id'];
	}
	
	if (isset($_REQUEST['username'])){
		$data['username'] = $_REQUEST['username'];
	}
	
	$data['page'] = $_A['page'];
	$data['epage'] = $_A['epage'];
	$result = accountClass::GetRechargeList($data);
	
	if (is_array($result)){
		$pages->set_data($result);
		$_A['account_recharge_list'] = $result['list'];
		$_A['showpage'] = $pages->show(3);
		if (isset($_REQUEST['type']) && $_REQUEST['type']=="excel"){
			$title = array("���","�û�����","����","��������","��ֵ���","����","���˽��","��ֵʱ��","״̬");
			$data['limit'] = "all";
			$result = accountClass::GetRechargeList($data);
			foreach ($result as $key => $value){
				 if ($value['type']==1){ $type = "���ϳ�ֵ";}else{ $type = "���³�ֵ";}
				 if ($value['payment']==0){ $payment = "�ֶ���ֵ";}else{ $payment_name = "���³�ֵ";}
				 if ($value['status']==0){ $status = "���";}elseif ($value['status']==1){ $status = "�ɹ�";}else{ $status = "ʧ��";}
				
				$_data[$key] = array($key+1,$value['username'],$type,$payment,$value['money'],$value['fee'],$value['total'],date("Y-m-d H:i",$value['addtime']),$status);
			}
			exportData("��ֵ�б�",$title,$_data);
			exit;
		}
	}else{
		$msg = array($result);
	}
}

/**
 * ��ֵ��¼
**/
elseif ($_A['query_type'] == "recharge_new"){
	if(isset($_POST['username']) && $_POST['username']!=""){
		$_data['username'] = $_POST['username'];
		$result = userClass::GetOnes($_data);
		if ($result==false){
			$msg = array("�û���������");
		}else{
			$data['user_id'] = $result['user_id'];
			$data['status'] = 0;
			$data['money'] = $_POST['money'];
			$data['type']==2;
			$data['payment'] = 0;
			$data['fee'] = 0;
			$data['trade_no'] = time().$result['user_id'].rand(1,9);
			$result = accountClass::AddRecharge($data);
			if ($result !== true){
				$msg = array($result);
			}else{
				$msg = array("�����ɹ�");
			}
		}
	}
}

/**
 * �۳�����
**/
elseif ($_A['query_type'] == "deduct"){
	if(isset($_POST['username']) && $_POST['username']!=""){
		$_data['username'] = $_POST['username'];
		$result = userClass::GetOnes($_data);
		if ($result==false){
			$msg = array("�û���������");
		}elseif ($_POST['valicode']!=$_SESSION['valicode']){
			$msg = array("��֤�벻��ȷ");
		}else{
			$data['user_id'] = $result['user_id'];
			$data['money'] = $_POST['money'];
			$data['type'] = $_POST['type'];
			$data['remark'] = $_POST['remark'];
			$result = accountClass::Deduct($data);
			if ($result !== true){
				$msg = array($result);
			}else{
				$msg = array("�����ѳɹ��۳�","",$_A['query_url']."/deduct");
				$_SESSION['valicode'] = "";
			}
		}
	}
}


/**
 * �ʽ�ʹ�ü�¼
**/
elseif ($_A['query_type'] == "log"){
	$_A['list_title'] = "�ʽ�ʹ�ü�¼";
	
	if (isset($_REQUEST['user_id'])){
		$data['user_id'] = $_REQUEST['user_id'];
	}
	
	if (isset($_REQUEST['username'])){
		$data['username'] = $_REQUEST['username'];
	}
	
	if (isset($_REQUEST['type'])){
		$data['type'] = $_REQUEST['type'];
	}
	
	if (isset($_REQUEST['dotime1'])){
		$data['dotime1'] = $_REQUEST['dotime1'];
	}
	
	if (isset($_REQUEST['dotime2'])){
		$data['dotime2'] = $_REQUEST['dotime2'];
	}
	
	$data['page'] = $_A['page'];
	$data['epage'] = $_A['epage'];
	$result = accountClass::GetLogList($data);
	
	if (is_array($result)){
		$pages->set_data($result);
		$_A['account_log_list'] = $result['list'];
		$_A['showpage'] = $pages->show(3);
	
	}else{
		$msg = array($result);
	}
}


/**
 * �鿴
**/
elseif ($_A['query_type'] == "view"){
	$_A['list_title'] = "�鿴��֤";
	if (isset($_POST['id'])){
		$var = array("id","status","verify_remark","jifen");
		$data = post_var($var);
		$data['verify_user'] = $_SESSION['user_id'];
		$result = accountClass::Update($data);
		
		if ($result !== true){
			$msg = array($result);
		}else{
			$msg = array("�����ɹ�");
		}
		$user->add_log($_log,$result);//��¼����
	}else{
		$data['id'] = $_REQUEST['id'];
		$_A['account_result'] = accountClass::GetOne($data);
	}
}



//��ֹ�Ҳ���
else{
	$msg = array("���������벻Ҫ�Ҳ���");
}
?>