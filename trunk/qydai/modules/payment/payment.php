<?
if (!defined('ROOT_PATH'))  die('���ܷ���');//��ֱֹ�ӷ���
check_rank("payment_".$_A['query_type']);//���Ȩ��

require_once 'payment.class.php';


$_A['list_purview'] = array("payment"=>array("֧����ʽ"=>array("payment_list"=>"֧����ʽ����")));//Ȩ��
$_A['list_name'] = $_A['module_result']['name'];
$_A['list_menu'] = "<a href='{$_A['query_url']}{$_A['site_url']}'>��ʹ��</a> - <a href='{$_A['query_url']}/all{$_A['site_url']}'>֧���б�</a> ";


/**
 * �������Ϊ�յĻ�����ʾ���е��ļ��б�
**/
if ($_A['query_type'] == "list"){
	$_A['list_title'] = "�б�";
	//�޸�״̬
	if (isset($_REQUEST['id']) && isset($_REQUEST['status'])){
		$sql = "update {payment} set status='".$_REQUEST['status']."' where id = ".$_REQUEST['id'];
		$mysql->db_query($sql);	
	}
	
	$result = paymentClass::GetList();
	
	if (is_array($result)){
		$_A['payment_list'] = $result;
	}else{
		$msg = array($result);
	}
}


/**
 * �������Ϊ�յĻ�����ʾ���е��ļ��б�
**/
elseif ($_A['query_type'] == "all"){
	$_A['list_title'] = "���е�֧���б�";
	//�޸�״̬
	
	$result = paymentClass::GetListAll();
	
	if (is_array($result)){
		$_A['payment_list'] = $result;
	}else{
		$msg = array($result);
	}
}
/**
 * ���
**/
elseif ($_A['query_type'] == "new"  || $_A['query_type'] == "edit" || $_A['query_type'] == "start" ){
	
	$_A['list_title'] = "����";
	if (isset($_POST['name'])){
		$var = array("name","nid","order","status","description","fee_type","max_fee","max_money");
		$data = post_var($var);
		$config = isset($_POST['config'])?$_POST['config']:"";
		$data['config'] = serialize($config);
		$data['type'] = $_A['query_type'];
		if ($_A['query_type'] == "edit"){
			$data['id'] = isset($_POST['id'])?$_POST['id']:"";
		}
		$result = paymentClass::Action($data);
		
		
		if ($result !== true){
			$msg = array($result);
		}else{
			$msg = array("�����ɹ�","",$_A['query_url']);
		}
		$user->add_log($_log,$result);//��¼����
	}
	
	elseif ($_A['query_type'] == "edit" || $_A['query_type'] == "new" || $_A['query_type'] == "start" ){
		$data['nid'] = $_REQUEST['nid'];
		$data['id'] = isset($_REQUEST['id'])?$_REQUEST['id']:"";
		$result = paymentClass::GetOne($data);
		
		if (is_array($result)){
			$result['nid'] = $data['nid'];
			$_A['payment_result'] = $result;
			
		}else{
			$msg = array($result);
		}
		
	}
	
}			

	
/**
 * ɾ��
**/
elseif ($_A['query_type'] == "del"){
	$data['id'] = $_REQUEST['id'];
	$result = paymentClass::Delete($data);
	if ($result !== true){
		$msg = array($result);
	}else{
		$msg = array("ɾ���ɹ�","",$_A['query_url']);
	}
	$user->add_log($_log,$result);//��¼����
}
	
?>