<?php
if (!defined('ROOT_PATH'))  die('���ܷ���');//��ֱֹ�ӷ���
include_once("borrow.class.php");

if ($_U['query_type'] == "add" || $_U['query_type'] == "update"){	
	if (!isset($_POST['name'])){
		$msg = array("�벻Ҫ�Ҳ���","","/publish/index.html");
	}elseif ($_POST['valicode']!=$_SESSION['valicode']){
		$msg = array("��֤�벻��ȷ");
	}elseif($_POST['style']==1 && $_POST['time_limit']%3!=0){
		$msg = array("��ѡ����ǰ�����������������д3�ı���");
	}else{	
		
		$var = array("name","use","time_limit","style","account","apr","lowest_account","most_account","valid_time","award","part_account","funds","is_false","open_account","open_borrow","open_tender","open_credit","content","is_vouch","vouch_award","vouch_user");
		$data = post_var($var);
		$data['open_account'] = 1;
		$data['open_borrow'] = 1;
		$data['open_credit'] = 1;
		if ($_POST['submit']=="����ݸ�"){
			$data['status'] = -1;
		}else{
			$data['status'] =0;
		}
		$data['user_id'] = $_G['user_id'];
		if ($_U['query_type'] == "add"){
			$result = borrowClass::Add($data);
			//�������˶�ȵ�
		}else{
			$data['id'] = $_POST['id'];
			$data['user_id'] = $_G['user_id'];
			$result = borrowClass::Update($data);
		}
		if ($result===true){
			$msg = array("�������ɹ�,��ȴ���ˡ�","","/index.php?user&q=code/borrow/publish");
		}else{
			$msg = array($result);
		}
		
	}
	
}elseif ($_U['query_type'] == "cancel"){
	$data['id'] = $_REQUEST['id'];
	$data['user_id'] = $_G['user_id'];
	$result = borrowClass::Cancel($data);
	if ($result==false){
		$msg = array($result);
	}else{
		
		$msg = array("�����ɹ�","","index.php?user&q=code/borrow/publish");
	}
}

//ɾ��
elseif ($_U['query_type'] == "del"){
	$data['id'] = $_REQUEST['id'];
	$data['user_id'] = $_G['user_id'];
	$data['status'] = -1;
	$result = borrowClass::Delete($data);
	if ($result==false){
		$msg = array($result);
	}else{
		$msg = array("�б�ɾ���ɹ�!");
	}
}

//�û�Ͷ��
elseif ($_U['query_type'] == "tender"){
	if ($_SESSION['valicode']!=$_POST['valicode']){
		$msg = array("��֤�����");
	}else{
		include_once(ROOT_PATH."modules/account/account.class.php");
		$borrow_result = borrowClass::GetOne(array("id"=>$_POST['id'],"tender_userid"=>$_G['user_id']));//��ȡ����ĵ�����Ϣ
		$account_money = $_POST['money'];
		if ($_G['user_result']['islock']==1){
			$msg = array("���˺��Ѿ������������ܽ���Ͷ�꣬�������Ա��ϵ");
		}elseif (!is_array($borrow_result)){
			$msg = array($borrow_result);
		}elseif ($borrow_result['account_yes']>=$borrow_result['account']){
			$msg = array("�˱�������������Ͷ");
		}elseif ($borrow_result['verify_time'] == "" || $borrow_result['status'] != 1){
			$msg = array("�˱���δͨ�����");
		}elseif ($borrow_result['verify_time'] + $borrow_result['valid_time']>time()){
			$msg = array("�˱��ѹ���");
		}elseif(!is_numeric($account_money)){
			$msg = array("��������ȷ�Ľ��");
		}elseif ($borrow_result['most_account']>0 && ($borrow_result['tender_yes'] > $borrow_result['most_account'] || $borrow_result['tender_yes']+$account_money>$borrow_result['most_account'])){
			$msg = array("�����Ͷ����".($borrow_result['tender_yes']+$account_money)."�Ѿ�������߽��{$borrow_result['most_account']}");
		}elseif (md5($_POST['paypassword'])!=$_G['user_result']['paypassword']){
			$msg = array("֧���������벻��ȷ");
		}else{
			$account_result =  accountClass::GetOne(array("user_id"=>$_G['user_id']));//��ȡ��ǰ�û������
			
			if (($borrow_result['account']-$borrow_result['account_yes'])<$account_money){
				$account_money = $borrow_result['account']-$borrow_result['account_yes'];
			}
			if ($account_result['use_money']<$account_money){
				$msg = array("��������");
			}else{
				$data['borrow_id'] = $_POST['id'];
				$data['money'] = $_POST['money'];
				
				$data['account'] = $account_money;
				$data['user_id'] = $_G['user_id'];
				$data['status'] = 1;
				
				$result = borrowClass::AddTender($data);//��ӽ���
				
				//Ͷ�����
				
				$log['user_id'] = $_G['user_id'];
				$log['type'] = "tender";
				$log['money'] = $account_money;
				$log['total'] = $account_result['total'];
				$log['use_money'] =  $account_result['use_money']-$log['money'];
				$log['no_use_money'] =  $account_result['no_use_money']+$log['money'];
				$log['collection'] =  $account_result['collection'];
				$log['to_user'] = $borrow_result['user_id'];
				$log['remark'] = "Ͷ�궳���ʽ�";
				accountClass::AddLog($log);//��Ӽ�¼
				
				if ($result==false){
					$msg = array($result);
				}else{
					$msg = array("Ͷ��ɹ�","","/index.php?user&q=code/borrow/bid");
				}
			}
		}
	}
}



//������Ͷ��
elseif ($_U['query_type'] == "vouch"){
	$msg = "";
	if ($_SESSION['valicode']!=$_POST['valicode']){
		$msg = array("��֤�����");
	}else{
		include_once(ROOT_PATH."modules/account/account.class.php");
		$borrow_result = borrowClass::GetOne(array("id"=>$_POST['id'],"tender_userid"=>$_G['user_id']));//��ȡ����ĵ�����Ϣ
		
		$vouch_account = $_POST['money'];
		if (($borrow_result['account']-$borrow_result['vouch_account'])<$vouch_account){
			$account_money = $borrow_result['account']-$borrow_result['vouch_account'];
		}else{
			$account_money = $vouch_account;
		}
		if ($_G['user_result']['islock']==1){
			$msg = array("���˺��Ѿ������������ܽ��е������������Ա��ϵ");
		}elseif (!is_array($borrow_result)){
			$msg = array($borrow_result);
		}elseif ($borrow_result['vouch_account']>=$borrow_result['account']){
			$msg = array("�˵����굣����������������ٵ���");
		}elseif ($borrow_result['verify_time'] == "" || $borrow_result['status'] != 1){
			$msg = array("�˱���δͨ�����");
		}elseif ($borrow_result['verify_time'] + $borrow_result['valid_time']>time()){
			$msg = array("�˱��ѹ���");
		}elseif (md5($_POST['paypassword'])!=$_G['user_result']['paypassword']){
			$msg = array("֧���������벻��ȷ");
		}else{
			//��ȡͶ�ʵĵ������
			$vouch_amount =  borrowClass::GetAmountOne($_G['user_id'],"tender_vouch");
			
			if ($vouch_amount['account_use']<$account_money){
				$msg = array("���ĵ�������");
			}else{
				$data['borrow_id'] = $_POST['id'];
				$data['vouch_account'] = $vouch_account;
				$data['account'] = $account_money;
				$data['user_id'] = $_G['user_id'];
				$data['content'] = $_POST['content'];
				$data['status'] = 0;
				
				//�ж��Ƿ��ǵ�����
				if ($borrow_result['vouch_user']!=""){
					$_vouch_user = explode("|",$borrow_result['vouch_user']);
					if (!in_array($_G['user_result']['username'],$_vouch_user)){
						$msg = array("�˵������Ѿ�ָ���˵����ˣ��㲻�Ǵ˵����ˣ����ܽ��е���");
					}
				}
				if ($msg==""){
					$result = borrowClass::AddVouch($data);//��ӵ�����
					if ($result==false){
						$msg = array($result);
					}else{
						$msg = array("�����ɹ�","","/index.php?user&q=code/borrow/bid");
						$_SESSION['valicode'] = "";
						
					}
				}
			}
		}
	}
}


//�鿴Ͷ��
elseif ($_U['query_type'] == "repayment_view"){
	$data['id'] = $_REQUEST['id'];
	if ($data['id']==""){
		$msg = array("������������");
	}
	$data['user_id'] = $_G['user_id'];
	$result =  borrowClass::GetOne($data);//��ȡ��ǰ�û������
	if ($result==false){
		$msg = array("���Ĳ�������");
	}else{
		$_U['borrow_result'] = $result;
	}
}

//����
elseif ($_U['query_type'] == "repay"){
	$data['id'] = $_REQUEST['id'];
	if ($data['id']==""){
		$msg = array("������������");
	}
	$data['user_id'] = $_G['user_id'];
	$result =  borrowClass::Repay($data);//��ȡ��ǰ�û������
	if ($result!==true){
		$msg = array($result);
	}else{
		$msg = array("����ɹ�","","/index.php?user&q=code/borrow/repayment");
	}
}
//����
elseif ($_U['query_type'] == "limitapp"){
	if (isset($_POST['account']) && $_POST['account']>0){
		$var = array("account","content","type","remark");
		$data = post_var($var);
		$data['user_id'] = $_G['user_id'];
		$result = borrowClass::GetAmountApplyOne(array("user_id"=>$data['user_id'],"type"=>$data['type']));
		if ($result!=false && $result['verify_time']+60*60*24*30 >time()){
			$msg = array("��һ���º�������");
		}elseif ($result!=false && $result['addtime']+60*60*24*30 >time() && $result['status']==2){
			$msg = array("���Ѿ��ύ�����룬��ȴ����");
		}else{
			$data['status'] = 2;
			$result =  borrowClass::AddAmountApply($data);//��ȡ��ǰ�û������
			if ($result!==true){
				$msg = array($result);
			}else{
				$msg = array("�������ɹ�����ȴ�����Ա���","","/index.php?user&q=code/borrow/limitapp");
			}
		}
	}else{
	
	
	}


}

$template = "user_borrow.html";
?>
