<?php
if (!defined('ROOT_PATH'))  die('���ܷ���');//��ֱֹ�ӷ���
include_once("message.class.php");
$_U['epage'] = 20;
$valicode = isset($_POST['valicode'])?$_POST['valicode']:"";

$url = $_U['query_url']."/{$_U['query_type']}";

if (isset($_POST['valicode']) && $valicode!=$_SESSION['valicode']){
		$msg = array("��֤�����","",$url);
}else{
	if ($_U['query_type'] == "list"){	
		if (isset($_POST['type']) && $_POST['type']==1){
			$data['id'] = $_POST['id'];
			$data['receive_user'] = $_G['user_id'];
			$data['deltype'] = 1;
			$result = messageClass::update($data);
			if ($result!==true){
				$msg = array($result,"",$_U['query_url']);
			}else{
				$msg = array("ɾ���ɹ�");
			}
		}elseif (isset($_POST['type']) && $_POST['type']==2){
			$data['id'] = $_POST['id'];
			$data['receive_user'] = $_G['user_id'];
			$data['status'] = 1;
			$result = messageClass::update($data);
			if ($result!==true){
				$msg = array($result,"",$_U['query_url']);
			}else{
				$msg = array("�ѱ���Ѷ�");
			}
		}elseif (isset($_POST['type']) && $_POST['type']==3){
			$data['id'] = $_POST['id'];
			$data['receive_user'] = $_G['user_id'];
			$data['status'] = 0;
			$result = messageClass::update($data);
			if ($result!==true){
				$msg = array($result,"",$_U['query_url']);
			}else{
				$msg = array("�ѱ��δ��");
			}
		}else{
			$data['receive_user'] = $_G['user_id'];
			$data['page'] = $_U['page'];
			$data['epage'] = $_U['epage'];
			$data['deltype'] = "0";
			$result = messageClass::GetList($data);
			if (is_array($result)){
				$pages->set_data($result);
				$_U['message_list'] = $result['list'];
				$_U['show_page'] = $pages->show(3);
			}else{
				$msg = array($result,"",$_U['query_url']);
			}
		}
	}
	
	elseif ($_U['query_type'] == "sented"){	
		if (isset($_POST['type']) && $_POST['type']==1){
			$data['id'] = $_POST['id'];
			$data['sent_user'] = $_G['user_id'];
			$data['sented'] = 0;
			$result = messageClass::update($data);
			if ($result!==true){
				$msg = array($result,"",$_U['query_url']);
			}else{
				$msg = array("ɾ���ɹ�");
			}
			
		}else{
			$data['sent_user'] = $_G['user_id'];
			$data['page'] = $_U['page'];
			$data['epage'] = $_U['epage'];
			$data['sented'] = 1;
			$result = messageClass::GetList($data);
			if (is_array($result)){
				$pages->set_data($result);
				$_U['message_list'] = $result['list'];
				$_U['show_page'] = $pages->show(3);
			}else{
				$msg = array($result,"",$_U['query_url']);
			}
		}
	}
	
	elseif($_U['query_type'] == "sent"){
		if(isset($_POST['content'])){
			if ($_POST['receive_user']==""){
				$msg = array("���͵��ռ��˲���Ϊ��");
			}elseif (trim($_POST['name'])==""){
				$msg = array("���ⲻ��Ϊ��");
			}elseif (trim($_POST['content'])==""){
				$msg = array("���ݲ���Ϊ��");
			}else{
				$var = array("receive_user","content","sented","name");
				$data = post_var($var);
				$data['sent_user'] = $_G['user_id'];
				$data['type'] = "friend";  
				$data['status'] = 0; 
				$result = messageClass::Add($data);
				if ($result!==true){
					$msg = array($result,"",$_U['query_url']);
				}else{
					$msg = array("���ͳɹ�","",$_U['query_url']."/sented");
				}
			}
		}
	}	
	
	//�鿴���ظ�
	elseif ($_U['query_type'] == "view"){	
		if (isset($_POST['content'])){
			$data['id'] = $_POST['id'];
			$result = messageClass::GetOne($data);
			$data = post_var(array("content"));
			$data['name'] = "Re:".$result['name'];
			$data['content'] .= "<br>------------------ ԭʼ��Ϣ ------------------<br>".$result['content'];
			$data['sent_user'] = $_G['user_id'];
			$data['receive_user'] = $result['sent_user'];
			$data['type'] = "friend";  
			$data['status'] = 0; 
			$data['sented'] = 1; 
			$result = messageClass::Add($data);
			if ($result!==true){
				$msg = array($result,"",$_U['query_url']);
			}else{
				$msg = array("���ͳɹ�");
			}
		}else{
			$data['receive_user'] = $_G['user_id'];
			$data['id'] = $_REQUEST['id'];
			$data['deltype'] = 0;
			$result = messageClass::GetOne($data);
			if (is_array($result)){
				$_U['message_result'] = $result;
			}else{
				$msg = array($result,"",$_U['query_url']);
			}
		}
	}
	
	//�鿴���ظ�
	elseif ($_U['query_type'] == "viewed"){	
		$data['sent_user'] = $_G['user_id'];
		$data['id'] = $_REQUEST['id'];
		$data['deltype'] = 0;
		$result = messageClass::GetOne($data);
		if (is_array($result)){
			$_U['message_result'] = $result;
		}else{
			$msg = array($result,"",$_U['query_url']);
		}
	}
	
	elseif ($_U['query_type'] == "deled"){	
		if (isset($_REQUEST['id']) ){
			$data['id'] = $_REQUEST['id'];
			$data['sent_user'] = $_G['user_id'];
			$data['sented'] = 0;
			$result = messageClass::update($data);
			
			if ($result!==true){
				$msg = array($result,"",$_U['query_url']);
			}else{
				$msg = array("ɾ���ɹ�");
			}
		}else{
			$msg = array("��������");
		}
	}
	
	elseif ($_U['query_type'] == "del"){
		if (isset($_REQUEST['id']) ){
			$data['id'] = $_REQUEST['id'];
			$data['receive_user'] = $_G['user_id'];
			$data['deltype'] = 1;
			$result = messageClass::update($data);
			if ($result!==true){
				$msg = array($result,"",$_U['query_url']);
			}else{
				$msg = array("ɾ���ɹ�");
			}
		}else{
			$msg = array("��������");
		}
	}
}
$template = "user_message.html";
?>
