<?
/******************************
 * $File: borrow.class.php
 * $Description: ���ݿ⴦���ļ�
 * $Author: QQ134716
 * $Time:2012-03-09
 * $Update:None 
 * $UpdateDate:None 
******************************/
include_once(ROOT_PATH."modules/account/account.class.php");
include_once("amount.class.php");
include_once(ROOT_PATH."modules/credit/credit.class.php");
require_once("modules/remind/remind.class.php");
class borrowClass extends amountClass{
	
	const ERROR = '���������벻Ҫ�Ҳ���';
	const BORROW_NAME_NO_EMPTY = '���ı��ⲻ��Ϊ��';
	const BORROW_ACCOUNT_NO_EMPTY = '������Ϊ��';
	const BORROW_APR_NO_EMPTY = '������ʲ���Ϊ��';
	const BORROW_ACCOUNT_NO_MAX = '���ܸ�����߶��';
	const BORROW_ACCOUNT_NO_MIN = '���ܵ�������޶�';
	const BORROW_APR_NO_MAX = '������ʲ��ܸ�������޶�';
	const BORROW_REPAYMENT_NOT_ENOUGH = '�ʻ������������Ҫ����Ľ��';
	const BORROW_ACCOUNT_MAZ_ACC = '����Ȳ��ܴ��������';
	const NO_LOGIN = '��û�е�¼';
	/**
	 * �б�
	 *
	 * @return Array
	 */
	function GetList($data = array()){
		global $mysql;
		$user_id = empty($data['user_id'])?"":$data['user_id'];
		$username = empty($data['username'])?"":$data['username'];
	
		$page = empty($data['page'])?1:$data['page'];
		$epage = empty($data['epage'])?10:$data['epage'];
		
		$_sql = "where 1=1 ";		 
		if (isset($data['user_id'])  && $data['user_id']!=""){
			$_sql .= " and p2.user_id = {$data['user_id']}";
		}
		if (isset($data['username'])  && $data['username']!=""){
			$_sql .= " and p2.username = '{$data['username']}'";
		}
		if (isset($data['type'])){
			$type = $data['type'];
			if ($type==""){
				$_sql .= "  and p1.status=1 ";
			}elseif ($type=="review"){
				$_sql .= " and p1.account=p1.account_yes ";
			}elseif ($type=="reviews"){
				$_sql .= " and p1.account=p1.account_yes ";
				$_sql .= " and p1.status=1";
			}elseif ($type=="success"){
				$_sql .= " and p1.status=3";
			}elseif ($type=="vouch"){
				$_sql .= " and p1.is_vouch=1 and p1.status=1";
			}elseif ($type=="now"){//���ڻ�
				$_sql .= " and p1.repayment_account!=p1.repayment_yesaccount";
			}elseif ($type=="yes"){//�ѻ�
				$_sql .= " and p1.repayment_account=p1.repayment_yesaccount";
			}elseif ($type=="late"){//����
				$_sql .= " and p1.verify_time+p1.valid_time*24*60*60<".time();
			}
			
		}
		if (isset($data['dotime2'])  && $data['dotime2']!=""){
			$dotime2 = ($data['dotime2']=="request")?$_REQUEST['dotime2']:$data['dotime2'];
			if ($dotime2!=""){
				$_sql .= " and p1.addtime < ".get_mktime($dotime2);
			}
		}
		if (isset($data['dotime1']) && $data['dotime1']!=""){
			$dotime1 = ($data['dotime1']=="request")?$_REQUEST['dotime1']:$data['dotime1'];
			if ($dotime2!=""){
				$_sql .= " and p1.addtime > ".get_mktime($dotime1);
			}
		}
		
		if (isset($data['status']) && $data['status']!=""){
			$_sql .= " and p1.status in ({$data['status']})";
		}
		if (isset($data['is_vouch']) && $data['is_vouch']!=""){
			$_sql .= " and p1.is_vouch in ({$data['is_vouch']})";
		}
		
		if (isset($data['limittime']) && $data['limittime']!=""){
			$_sql .= " and p1.time_limit = {$data['limittime']}";
		}
		
		if (isset($data['use']) && $data['use']!=""){
			$_sql .= " and p1.use in ({$data['use']})";
		}
		if (isset($data['award']) && $data['award']!=""){
			if($data['award']==1){
			$_sql .= " and p1.award >0";
			}else{
			$_sql .= " and p1.award = 0";
			}
		}
		
		if (isset($data['style']) && $data['style']!=""){
			$_sql .= " and p1.style in ({$data['style']})";
		}
		
		if (isset($data['keywords']) && $data['keywords']!=""){
			$_sql .= " and (p1.name like '%".urldecode($data['keywords'])."%' or u.username like '%".urldecode($data['keywords'])."%')";
			
		}
		
		if (isset($data['province']) && $data['province']!=""){
			$_sql .= " and p2.province ={$data['province']}";
		}
		
		if (isset($data['city']) && $data['city']!=""){
			$_sql .= " and p2.city ={$data['city']}";
		}
		
		if (isset($data['use']) && $data['use']!=""){
			$_sql .= " and p1.use in ({$data['use']})";
		}
		
		if (isset($data['account1']) && $data['account1']!=""){
			$_sql .= " and p1.account >= {$data['account1']}";
		}
		
		if (isset($data['account2']) && $data['account2']!=""){
			$_sql .= " and p1.account <= {$data['account2']}";
		}
		$_order = " order by p1.`order` desc,p1.id desc ";
		
		if (isset($data['order']) && $data['order']!=""){
			$order = $data['order'];
			if ($order == "account_up"){
				$_order = " order by p1.`account` desc ";
			}else if ($order == "account_down"){
				$_order = " order by p1.`account` asc";
			}
			if ($order == "credit_up"){
				$_order = " order by p3.`value` desc,p1.id desc ";
			}else if ($order == "credit_down"){
				$_order = " order by p3.`value` asc,p1.id desc ";
			}
			
			if ($order == "apr_up"){
				$_order = " order by p1.`apr` desc,p1.id desc ";
			}else if ($order == "apr_down"){
				$_order = " order by p1.`apr` asc,p1.id desc ";
			}
			
			if ($order == "jindu_up"){
				$_order = " order by `scales` desc,p1.id desc ";
				
			}else if ($order == "jindu_down"){
				$_order = " order by `scales` asc,p1.id desc ";
			}
			if ($order == "flag"){
				$_order = " order by p1.is_vouch desc,p1.`flag` desc,p1.id desc ";
			}
			if ($order == "index"){
				$_order = " order by p1.`flag` desc,p1.id desc ";
			}
			
		}
	
		$_select = " p1.*,p2.username,p2.area as user_area ,u.username as kefu_username,p2.qq,p3.value as credit_jifen,p4.pic as credit_pic,p5.area as add_area,p1.account_yes/p1.account as scales";
		$sql = "select SELECT from `{borrow}` as p1 
				 left join `{user}` as p2 on p1.user_id=p2.user_id
				 left join `{user_cache}` as uca on uca.user_id=p1.user_id
				 left join `{user}` as u on u.user_id=uca.kefu_userid
				 left join `{credit}` as p3 on p1.user_id=p3.user_id 
				left join `{credit_rank}` as p4 on p3.value<=p4.point2  and p3.value>=p4.point1
				 left join `{userinfo}` as p5 on p1.user_id=p5.user_id 
				$_sql ORDER LIMIT";
		//�Ƿ���ʾȫ������Ϣ
		if (isset($data['limit']) ){
			$_limit = "";
			if ($data['limit'] != "all"){
				$_limit = "  limit ".$data['limit'];
			}
			$list =  $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select, $_order, $_limit), $sql));
			
			foreach($list as $key => $value){
				//��ȡ����
				$list[$key]['other'] = $value['account'] - $value['account_yes'];
				$list[$key]['scale'] = round(100*$value['account_yes']/$value['account'],1);
				$list[$key]['scale_width'] = round((20*$value['account_yes']/$value['account']))*7;
				$list[$key]['repayment_noaccount'] = $value['repayment_account'] - $value['repayment_yesaccount'];

				//��ȡ��������
				$list[$key]['vouch_scale'] = round(100*$value['vouch_account']/$value['account'],1);
				$list[$key]['vouch_other'] = $value['account'] - $value['vouch_account'];
				$list[$key]['vouchscale_width'] = round((20*$value['vouch_account']/$value['account']))*7;
			}
			return $list;
		}
		$row = $mysql->db_fetch_array(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array('count(1) as num', '', ''), $sql));
		
		$total = $row['num'];
		$total_page = ceil($total / $epage);
		$index = $epage * ($page - 1);
		$limit = " limit {$index}, {$epage}";
			
		
		$_list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select, $_order, $limit), $sql));		
		$_list = $_list?$_list:array();
		$result = array();
		$list = array();
		foreach($_list as $key => $value){
			//��ȡ����
			$list[$key]['scale'] = round(100*$value['account_yes']/$value['account'],1);
			$list[$key]['other'] = $value['account'] - $value['account_yes'];
			$list[$key]['scale_width'] = round((20*$value['account_yes']/$value['account']))*7;
			$list[$key]['repayment_noaccount'] = $value['repayment_account'] - $value['repayment_yesaccount'];
			//��ȡ��������
			$list[$key]['vouch_scale'] = round(100*$value['vouch_account']/$value['account'],1);
			$list[$key]['vouch_other'] = $value['account'] - $value['vouch_account'];
			$list[$key]['vouchscale_width'] = round((20*$value['vouch_account']/$value['account']))*7;
			foreach ($value as $_key => $_value){
				$list[$key][$_key] = $_value;
			}
			
		}
		return array(
            'list' => $list,
            'total' => $total,
            'page' => $page,
            'epage' => $epage,
            'total_page' => $total_page
        );
		
	}
	
	/**
	 * �鿴
	 *
	 * @param Array $data
	 * @return Array
	 */
	public static function GetOne($data = array()){
		global $mysql;
		$_sql = "where 1=1 ";
		if (isset($data['user_id']) && $data['user_id']!=""){
			$_sql .= " and  p1.user_id = '{$data['user_id']}' ";
		}
		if (isset($data['id']) && $data['id']!=""){
			$_sql .= " and  p1.id = '{$data['id']}' ";
		}
		$sql = "select p1.* ,p2.username,p2.realname,p3.username as verify_username from `{borrow}` as p1 
				  left join `{user}` as p2 on p1.user_id=p2.user_id 
				  left join `{user}` as p3 on p1.verify_user = p3.user_id 
				  $_sql
				";
		$result = $mysql->db_fetch_array($sql);
		
		if (isset($data['tender_userid']) && $data['tender_userid']!=""){
			$sql = "select sum(account) as num from `{borrow_tender}` where user_id='{$data['tender_userid']}' and borrow_id={$data['id']}";
			$_result = $mysql->db_fetch_array($sql);
			$result['tender_yes'] = !empty($_result['num'])?$_result['num']:0;
		}
		return $result;
	}
	public static function GetUserLog($data = array()){
		global $mysql;
		include_once(ROOT_PATH."modules/account/account.inc.php");
		$_result = accountClass::GetUserLog($data);
		$user_id = $data['user_id'];
		$_result['borrow_account'] = 0;
		$sql = "select sum(account) as num from `{borrow}` where user_id = '{$user_id}' and (status=3)  ";
		$result = $mysql->db_fetch_array($sql);
		if ($result!=false){
			$_result['borrow_account'] = $result['num'];//����ܶ�
		}
		
		$_result['payment_times'] = 0;
		$sql = "select count(account) as num from `{borrow}` where user_id = '{$user_id}' and status=3  ";
		$result = $mysql->db_fetch_array($sql);
		if ($result!=false){
			$_result['payment_times'] = $result['num'];//����ܶ�
		}
		
		$sql = "select count(*) as num from `{borrow}` where user_id = '{$user_id}' ";
		$result = $mysql->db_fetch_array($sql);
		$_result['borrow_times'] =$result['num'];
		$_result['max_account'] =$_result['amount'] - $_result['borrow_account'];//�����
		
		//Ͷ������
		$sql = "select status,sum(account) as total_account  from `{borrow_tender}`  where user_id = '{$user_id}' group by status ";
		$result = $mysql->db_fetch_arrays($sql);
		foreach ($result as  $key =>$value){
			$_result['invest_account'] += $value['total_account'];//Ͷ���ܶ�
			if ($value['status']==1){
				//$_result['success_account'] = $value['total_account'];
			}
		}
		
		//��Ϣ
		$sql = "select p1.status ,sum(p1.repay_account) as total_repay_account ,sum(p1.interest) as total_interest_account,sum(p1.capital) as total_capital_account  from `{borrow_collection}` as p1 left join `{borrow_tender}` as p2  on p1.tender_id = p2.id  where p2.status=1  and  p2.user_id = '{$user_id}' and p2.borrow_id in (select id from `{borrow}` where status=3)  group by p1.status ";
		$result = $mysql->db_fetch_arrays($sql);
		foreach ($result as  $key =>$value){
			$_result['success_account'] += $value['total_capital_account'];//Ͷ���ܶ�
			if ($value['status']==1){
				$_result['collection_account1'] += $value['total_repay_account'];
				$_result['collection_interest1'] += $value['total_interest_account'];
				$_result['collection_capital1'] += $value['total_capital_account'];
			}
			if ($value['status']==0){
				$_result['collection_account0'] += $value['total_repay_account'];
				$_result['collection_interest0'] += $value['total_interest_account'];
				$_result['collection_capital0'] += $value['total_capital_account'];
			}
			if ($value['status']==2){
				$_result['collection_account2'] += $value['total_repay_account'];
				$_result['collection_interest2'] += $value['total_interest_account'];
				$_result['collection_capital2'] += $value['total_capital_account'];
			}
		}
		$_result['collection_wait'] = 	$_result['collection_capital0'] + $_result['collection_interest0'];//������
		$_result['collection_yes'] = 	$_result['collection_capital1'] + $_result['collection_interest1']+$_result['collection_capital2'] + $_result['collection_interest2'];//�ѻ���
		$_result['collection_capital1'] = $_result['collection_capital1']+$_result['collection_capital2'];
		//$_result['success_account'] = $_result['collection_capital0'] + $_result['collection_capital1'] + $_result['collection_capital2'];//����ܶ�
		//����տ�����
		$sql = "select p1.repay_time  from `{borrow_collection}` as p1 left join `{borrow_tender}` as p2  on p1.tender_id = p2.id  where p2.status=1 and p1.status=0  and  p2.user_id = '{$user_id}' and p1.repay_time>".time()." order by p1.repay_time asc";
		$result = $mysql->db_fetch_array($sql);
		$_result['collection_repaytime'] = $result['repay_time'];
		
		//�����ܶ�
		$_result_wait = self::GetWaitPayment(array("user_id"=>$user_id));
		$_result = array_merge ($_result, $_result_wait);

		
		//��ȹ���
		$_result_amount = amountClass::GetAmountOne($user_id);
		$_result = array_merge ($_result, $_result_amount);
		
		//���õ������Ӧ���ǽ�Ҫ����ĵ�������Ѿ��ɹ�����ĵ�����
		
		//$sql = "select * from `{borrow_amountlog}` where user_id='{$user_id}' and type ='vouch' order by id desc";
		//$result = $mysql->db_fetch_array($sql);
		/*
		$result = self::GetAmountLogOne(array("user_id"=>$user_id,"amount_type"=>"credit"));
		if ($result!=""){
			$_result['credit_amount_total'] = $result['account_total'];//���ö��
			$_result['credit_amount_use'] = $result['account_use'];//���ö��
		}
		
		$result = self::GetAmountLogOne(array("user_id"=>$user_id,"amount_type"=>"vouch"));
		if ($result!=""){
			$_result['vouch_amount_total'] = $result['account_total'];//����Ͷ�ʵ������
			$_result['vouch_amount_use'] = $result['account_use'];//����Ͷ�ʵ������
		}
		
		$result = self::GetAmountLogOne(array("user_id"=>$user_id,"amount_type"=>"borrowvouch"));
		if ($result!=""){
			$_result['borrowvouch_amount_total'] = $result['account_total'];//���ý������
			$_result['borrowvouch_amount_use'] = $result['account_use'];//���ý������
		}
		
		*/
		
		//�������ʱ����ܶ�
		$sql = "select repayment_time,repayment_account from `{borrow_repayment}` where status !=1 and borrow_id in (select id from `{borrow}` where user_id = {$user_id} and status=3) order by repayment_time ";
		$result = $mysql->db_fetch_array($sql);
		$_result['new_repay_time'] = $result['repayment_time'];
		$_result['new_repay_account'] = $result['repayment_account'];
		
		//����տ�ʱ���ʱ��
		$sql = "select repay_time,repay_account  from `{borrow_collection}` where tender_id in ( select p2.id from `{borrow_tender}`  as p2 left join `{borrow}` as p3 on p2.borrow_id=p3.id where p3.status=3 and p2.user_id = '{$user_id}' and p2.status=1) and repay_time > ".time()." and status=0 order by repay_time asc";
		$result = $mysql->db_fetch_array($sql);
		$_result['new_collection_time'] = $result['repay_time'];
		$_result['new_collection_account'] = $result['repay_account'];
		
		//��վ�渶�ܶ�
			//����տ�ʱ���ʱ��
		$sql = "select sum(repay_account) as num_late_repay_account ,sum(interest) as num_late_interes from `{borrow_collection}` where tender_id in ( select id from `{borrow_tender}` where user_id = '{$user_id}' and status=1)  and status=2 order by repay_time asc";
		$result = $mysql->db_fetch_array($sql);
		$_result['num_late_repay_account'] = $result['num_late_repay_account'];
		$_result['num_late_interes'] = $result['num_late_interes'];
		return $_result;
		
	}
	/**
	 * �鿴
	 *
	 * @param Array $data
	 * @return Array
	 */
	public static function GetOnes($data = array()){
		global $mysql,$_G;
		$user_id = $data['user_id'];
		$id = $data['id'];
		if ($id=="") {
			$sql = "select * from {credit} where user_id='{$user_id}'";
			$result = $mysql->db_fetch_array($sql);
			
			if ($result==false || $result['value']<30){
				echo "<script>alert('�������û��ֻ�δ��30�֣������ϴ�������֤');location.href='/index.php?user&q=code/user/realname';</script>";
					exit;
			}else{
				$sql = "select * from {borrow} where status<2 and user_id='{$user_id}'";
				$result = $mysql->db_fetch_array($sql);
				if ($result != false){
					echo "<script>alert('���Ѿ���һ�����꣬�봦��ý����ٽ��н��');location.href='/index.php?user&q=code/borrow/publish';</script>";
					exit;
				}
			}
		}else{
			$sql = "select p1.* ,p2.username,p2.realname from {borrow} as p1 
					  left join {user} as p2 on p1.user_id=p2.user_id 
					  where p1.user_id=$user_id and p1.id=$id and (p1.status=0 or p1.status=-1)
					";
			$result = $mysql->db_fetch_array($sql);
			if ($result == false){
				echo "<script>alert('�����������벻Ҫ�Ҳ���');location.href='/index.php?user&q=code/borrow/publish';</script>";
				exit;
			}else{
				return $result;
			}
		}
	}
	
	/**
	 * �鿴
	 *
	 * @param Array $data
	 * @return Array
	 */
	public static function GetInvest($data = array()){
		global $mysql,$_G;


		$id = $data['id'];
		//��ȡ�������Ӧ��Ϣ
		$sql = "select * from `{borrow}`  where  id = $id";
		$result['borrow'] = $mysql->db_fetch_array($sql);
		if ($result['borrow']==false){
			return self::ERROR;
		}
		$user_id = $result['borrow']['user_id'];
		
		//��ȡ�û���Ϣ�Լ��û��Ļ���
		$sql = "select p1.*,p2.value as credit_jifen,p3.pic as credit_pic from `{user}` as p1 
				left join {credit} as p2 on p1.user_id=p2.user_id 
				left join {credit_rank} as p3 on p2.value<=p3.point2  and p2.value>=p3.point1
								 where  p1.user_id=$user_id";
		$result['user'] = $mysql->db_fetch_array($sql);
		
		//��ȡ�û��Ļ�������
		$sql = "select * from `{userinfo}`  where  user_id=$user_id";
		$result['userinfo'] = $mysql->db_fetch_array($sql);
		
		//��ȡ����
		$result['borrow']['other'] = $result['borrow']['account'] - $result['borrow']['account_yes'];
		$result['borrow']['scale'] = round(100*$result['borrow']['account_yes']/$result['borrow']['account'],1);
		$result['borrow']['scale_width'] = round((20*$result['borrow']['account_yes']/$result['borrow']['account']))*7;
		$result['borrow']['lave_time'] = $result['borrow']['verify_time'] + $result['borrow']['valid_time']*24*60*60-time();
		$result['borrow']['rep_time'] = $result['borrow']['end_time'] - time();
		$_interest = self::EqualInterest(array("account"=>100,"year_apr"=> $result['borrow']['apr'],"month_times"=> $result['borrow']['time_limit'],"type"=>"all","borrow_style"=>$result['borrow']['borrow_style']));
		$result['borrow']['interest'] = $_interest['repayment_account']-100;
		
		//��ȡ�û����ʽ��˺���Ϣ
		$sql = "select * from `{account}`  where  user_id={$user_id}";
		$result['account'] = $mysql->db_fetch_array($sql);
		
		//��ȡ�û����ʽ��˺���Ϣ
		$sql = "select * from `{account}`  where  user_id={$_G['user_id']}";
		$result['user_account'] = $mysql->db_fetch_array($sql);
		
		//��ȡ�û����ʽ��˺���Ϣ
		$sql = "select p1.*,p2.username as kefu_username,p2.wangwang as kefu_wangwang,p2.qq as kefu_qq from `{user_cache}` as  p1 left join `{user}` as p2 on p2.user_id=p1.kefu_userid  where  p1.user_id={$user_id}";
		$result['user_cache'] = $mysql->db_fetch_array($sql);
		
		$result['borrow_all'] = self::GetBorrowAll(array("user_id"=>$user_id));
		
		//��ȡͶ�ʵĵ������
		$result['amount'] =  self::GetAmountOne($_G['user_id']);
		
		//��ȡ��������
		$result['borrow']['vouch_other'] = $result['borrow']['account'] - $result['borrow']['vouch_account'];
		$result['borrow']['vouch_scale'] = round(100*$result['borrow']['vouch_account']/$result['borrow']['account'],1);
		$result['borrow']['vouchscale_width'] = round((20*$result['borrow']['vouch_account']/$result['borrow']['account']))*7;
		
		return $result;
	}
	
	
	/**
	 * �鿴
	 *
	 * @param Array $data
	 * @return Array
	 */
	public static function GetU($data = array()){
		global $mysql,$_G;

		$user_id = $_G['U_uid'];
		
		//��ȡ�û���Ϣ�Լ��û��Ļ���
		$sql = "select p1.*,p2.value as credit_jifen,p3.pic as credit_pic from `{user}` as p1 
				left join {credit} as p2 on p1.user_id=p2.user_id 
				left join {credit_rank} as p3 on p2.value<=p3.point2  and p2.value>=p3.point1
								 where  p1.user_id=$user_id";
		$result['user'] = $mysql->db_fetch_array($sql);
		
		//��ȡ�û��Ļ�������
		$sql = "select * from `{userinfo}`  where  user_id=$user_id";
		$result['userinfo'] = $mysql->db_fetch_array($sql);
		
		
		//��ȡ�û����ʽ��˺���Ϣ
		$sql = "select * from `{account}`  where  user_id={$user_id}";
		$result['account'] = $mysql->db_fetch_array($sql);
		
		//��ȡ�û����ʽ��˺���Ϣ
		$sql = "select * from `{account}`  where  user_id={$_G['U_uid']}";
		$result['user_account'] = $mysql->db_fetch_array($sql);
		
		//��ȡ�û����ʽ��˺���Ϣ
		$sql = "select p1.*,p2.username as kefu_username,p2.wangwang as kefu_wangwang,p2.qq as kefu_qq from `{user_cache}` as  p1 left join `{user}` as p2 on p2.user_id=p1.kefu_userid  where  p1.user_id={$user_id}";
		$result['user_cache'] = $mysql->db_fetch_array($sql);
		
		$result['borrow_all'] = self::GetBorrowAll(array("user_id"=>$user_id));
		
		//��ȡͶ�ʵĵ������
		$result['amount'] =  self::GetAmountOne($_G['U_uid']);
		
		
		return $result;
	}
	
	
	
	/**
	 * ���
	 *
	 * @param Array $data
	 * @return Boolen
	 */
	function Add($data = array()){
		global $mysql;global $_G;
		$max = isset($_G['system']['con_borrow_maxaccount'])?$_G['system']['con_borrow_maxaccount']:"50000";
		$min = isset($_G['system']['con_borrow_minaccount'])?$_G['system']['con_borrow_minaccount']:"500";
		$apr = isset($_G['system']['con_borrow_apr'])?$_G['system']['con_borrow_apr']:"22.18";
        if (!isset($data['user_id']) && trim($data['user_id'])==""){
			return self::NO_LOGIN;
		}
		if (!isset($data['name']) && trim($data['name'])==""){
			return self::BORROW_NAME_NO_EMPTY;
		}
		if (!isset($data['account']) || trim($data['account'])==""){
			return self::BORROW_ACCOUNT_NO_EMPTY;
		}
		if ($data['is_vouch']!=1){
			$result = self::GetAmountOne($data['user_id'],"credit");
		}else{
			$result = self::GetAmountOne($data['user_id'],"borrow_vouch");
		}
		
		if (isset($data['account']) && $data['account']>$result['account_use']){
			return BORROW_ACCOUNT_MAZ_ACC;
		}
		
		if($data['account'] > $max){
			return self::BORROW_ACCOUNT_NO_MAX;
		}
		if($data['account'] < $min){
			return self::BORROW_ACCOUNT_NO_MIN;
		}
		if (!isset($data['apr']) || trim($data['apr'])==""){
			return self::BORROW_APR_NO_EMPTY;
		}
		if ($data['apr']>$apr){
			return self::BORROW_APR_NO_MAX;
		}
		$eq['account'] = $data['account'];
		$eq['year_apr'] = $data['apr'];
		$eq['month_times'] = $data['time_limit'];
		$eq['type'] = "all";
		$eq['borrow_style'] = $data['style'];
		$result = self::EqualInterest($eq);
		$data['repayment_account'] = $result['repayment_account'];
		$data['monthly_repayment'] = $result['monthly_repayment'];
		$sql = "insert into `{borrow}` set `addtime` = '".time()."',`addip` = '".ip_address()."'";
		foreach($data as $key => $value){
			$sql .= ",`$key` = '$value'";
		}
        return $mysql->db_query($sql);
	}
	
	
	/**
	 * �޸�
	 *
	 * @param Array $data
	 * @return Boolen
	 */
	function Update($data = array()){
		global $mysql;
		$user_id = $data['user_id'];
        if ($data['user_id'] == "") {
            return self::ERROR;
        }
		
		$_sql = "";
		$sql = "update `{borrow}` set ";
		foreach($data as $key => $value){
			$_sql[] .= "`$key` = '$value'";
		}
		$sql .= join(",",$_sql)." where user_id = '$user_id' and id='{$data['id']}' and (status=0 or status=-1)";
		
        return $mysql->db_query($sql);
	}
	
	/**
	 * �޸�
	 *
	 * @param Array $data
	 * @return Boolen
	 */
	function Action($data = array()){
		global $mysql;
		$id = $data['id'];
        if ($data['id'] == "") {
            return self::ERROR;
        }
		
		foreach($data['id'] as $key => $value){
			$sql = "update `{borrow}` set ";
			$sql .= "`flag` = '{$data['flag'][$key]}',`view_type` = '{$data['view'][$key]}' where id = '{$value}'";
			 $mysql->db_query($sql);
		}
		 return true;
       
	}
	
	/**
	 * �޸�
	 *
	 * @param Array $data
	 * @return Boolen
	 */
	function Verify($data = array()){
		global $mysql;
		
		$sql = "update `{borrow}` set verify_time='".time()."',verify_user='{$data['verify_user']}',verify_remark='{$data['verify_remark']}',status='{$data['status']}' where  id='{$data['id']}' ";
		$result = $mysql->db_query($sql);
		
        return $result;
	}
	
	
	/**
	 * ɾ��
	 *
	 * @param Array $data
	 * @return Boolen
	 */
	public static function Delete($data = array()){
		global $mysql;
		$id = $data['id'];
		if (!is_array($id)){
			$id = array($id);
		}
		if (isset($data['status']) && $data['status']!=""){
			$_sql .= " and status ='".$data['status']."'";
		}
		if (isset($data['user_id'])  && $data['user_id']!=""){
			$_sql = " and user_id={$data['user_id']} ";
		}
		$sql = "delete from {borrow}  where id in (".join(",",$id).") $_sql";
		return $mysql->db_query($sql);
	}
	
	
	/**
	 * ɾ��
	 *
	 * @param Array $data
	 * @return Boolen
	 */
	public static function Cancel($data = array()){
		global $mysql;
		$_sql = " where 1=1 ";
		if (isset($data['id']) && $data['id']!=""){
			$_sql .= " and id={$data['id']} ";
		}else{
			return self::ERROR;
		}
		if (isset($data['user_id'])  && $data['user_id']!=""){
			$_sql .= " and user_id={$data['user_id']} ";
		}
		
		$sql = "update  {borrow}  set status=5  $_sql";
		$mysql->db_query($sql);
		//��������Ͷ���ߵĽ�Ǯ��
		$sql = "select p1.*,p2.status as borrow_status,p2.name as borrow_name from {borrow_tender} as p1 left join `{borrow}` as p2 on p1.borrow_id=p2.id where p1.borrow_id={$data['id']}";
		$result = $mysql->db_fetch_arrays($sql);
		foreach ($result as $key => $value){
			if ($value['borrow_status']!=5) return false;
			if ($value['status']!=2){
				$account_result =  accountClass::GetOne(array("user_id"=>$value['user_id']));
				$log['user_id'] = $value['user_id'];
				$log['type'] = "invest_false";
				$log['money'] = $value['account'];
				$log['total'] = $account_result['total'];
				$log['use_money'] = $account_result['use_money']+$log['money'];
				$log['no_use_money'] = $account_result['no_use_money']-$log['money'];
				$log['collection'] = $account_result['collection'];
				$log['to_user'] = $data['user_id'];
				$log['remark'] = "�б�[<a href=\'/invest/a{$data['id']}.html\' target=_blank>{$value['borrow_name']}</a>]ʧ�ܷ��ص�Ͷ���";
				accountClass::AddLog($log);
				
				
				//��������
				$remind['nid'] = "loan_no_account";
				$remind['sent_user'] = "0";
				$remind['receive_user'] = $value['user_id'];
				$remind['title'] = "Ͷ�ʵı�[<font color=red>{$value['borrow_name']}</font>]ʧ��";
				$remind['content'] = "����Ͷ�ʵı�[<a href=\'/invest/a{$data['id']}.html\' target=_blank><font color=red>{$value['borrow_name']}</font></a>]��".date("Y-m-d",time())."���ʧ��";
				$remind['type'] = "system";
				remindClass::sendRemind($remind);
				
					
				
				$sql = "update `{borrow_tender}` set status=2 where id = '{$value['id']}'";
				$mysql->db_query($sql);
			}
		}
		
		$sql = "select is_vouch from `{borrow}` where id = {$data['id']}";
		$result = $mysql->db_fetch_array($sql);
		if ($result['is_vouch']==1){
			//Ͷ����Ͷ�ʵ�����ȵ�����
			$result = self::GetVouchList(array("limit"=>"all","borrow_id"=>$data['id']));
			if ($result!=""){
				foreach ($result as $key => $value){
					//��Ӷ�ȼ�¼
					$amountlog_result = self::GetAmountOne($value['user_id'],"tender_vouch");
					$amountlog["user_id"] = $value['user_id'];
					$amountlog["type"] = "tender_vouch_false";
					$amountlog["amount_type"] = "tender_vouch";
					$amountlog["account"] = $value['vouch_account'];
					$amountlog["account_all"] = $amountlog_result['account_all'];
					$amountlog["account_use"] = $amountlog_result['account_use'] + $amountlog['account'];
					$amountlog["account_nouse"] = $amountlog_result['account_nouse'] - $amountlog['account']; 
					$amountlog["remark"] = "������ʧ�ܣ�Ͷ�ʵ�����ȷ���";
					self::AddAmountLog($amountlog);
					
					$sql = "update `{borrow_vouch}` set status=2 where id = {$value['id']}";
					$mysql->db_query($sql);
				}
			}
		}
		
		
		return true;
	}
	
	/**
	 * �б�
	 *
	 * @return Array
	 */
		function GetTenderList($data = array()){
		global $mysql;
		$user_id = empty($data['user_id'])?"":$data['user_id'];
		$username = empty($data['username'])?"":$data['username'];
	
		$page = empty($data['page'])?1:$data['page'];
		$epage = empty($data['epage'])?10:$data['epage'];
		
		$_sql = "where 1=1";		 
		if (!empty($user_id)){
			$_sql .= " and p1.user_id = $user_id";
		}
		if (!empty($username)){
			$_sql .= " and p2.username = '$username'";
		}
		if (isset($data['borrow_id']) && $data['borrow_id']!=""){
			$_sql .= " and p1.borrow_id = '{$data['borrow_id']}'";
		}
	
		if (isset($data['dotime2'])){
			$dotime2 = ($data['dotime2']=="request")?$_REQUEST['dotime2']:$data['dotime2'];
			if ($dotime2!=""){
				$_sql .= " and p1.addtime < ".get_mktime($dotime2);
			}
		}
		if (isset($data['dotime1'])){
			$dotime1 = ($data['dotime1']=="request")?$_REQUEST['dotime1']:$data['dotime1'];
			if ($dotime2!=""){
				$_sql .= " and p1.addtime > ".get_mktime($dotime1);
			}
		}
		if (isset($data['status']) && $data['status']!=""){
			$_sql .= " and p1.status in ({$data['status']})";
		}
		if (isset($data['borrow_status']) && $data['borrow_status']!=""){
			$_sql .= " and p3.status in ({$data['borrow_status']})";
		}
		
		if (isset($data['keywords']) && $data['keywords']!=""){
			$_sql .= " and p1.name like '%".urldecode($data['keywords'])."%'";
		}
	
		/*
		$_select = " p1.*,p1.account as tender_account,p1.repayment_account - p1.repayment_yesaccount - p1.repayment_yesinterest as wait,
		p1.repayment_account - p1.account as wait_in,p2.username,p3.account ,p3.account_yes,p3.apr,p3.time_limit,p3.name as borrow_name,p4.username as op_username,p5.value as credit_jifen,p6.pic as credit_pic";
		$sql = "select SELECT from {borrow_tender} as p1 
					left join {borrow} as p3 on p3.id=p1.borrow_id
				 left join {user} as p2 on p1.user_id=p2.user_id
				 left join {user} as p4 on p3.user_id=p4.user_id
				 left join {credit} as p5 on p3.user_id=p5.user_id 
				left join {credit_rank} as p6 on p5.value<=p6.point2  and p5.value>=p6.point1
				$_sql ORDER LIMIT";
		*/
		$_select = "p1.*,p1.account as tender_account,p1.money as tender_money,p2.user_id as borrow_userid,p2.username as op_username,p4.username as username,p3.apr,p3.time_limit,p3.name as borrow_name,p3.id as borrow_id,p3.account ,p3.account_yes,p5.value as credit_jifen,p6.pic as credit_pic";
		$sql = "select SELECT from `{borrow_tender}` as p1
				left join `{borrow}` as p3 on p1.borrow_id=p3.id 
				left join `{user}` as p2 on p3.user_id = p2.user_id
				left join `{user}` as p4 on p4.user_id = p1.user_id
				 left join {credit} as p5 on p1.user_id=p5.user_id 
				left join {credit_rank} as p6 on p5.value<=p6.point2  and p5.value>=p6.point1
		 {$_sql}  order by p1.addtime desc LIMIT";
				
		//�Ƿ���ʾȫ������Ϣ
		if (isset($data['limit']) ){
			$_limit = "";
			if ($data['limit'] != "all"){
				$_limit = "  limit ".$data['limit'];
			}
			$result= $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,  'order by p1.id desc', $_limit), $sql));

			foreach($result as $key => $value){
				//��ȡ����
				//��ȡ����
				$result[$key]['other'] = $value['account'] - $value['account_yes'];
				$result[$key]['scale'] = round(100*$value['account_yes']/$value['account'],1);
				$result[$key]['scale_width'] = round((20*$value['account_yes']/$value['account']))*7;
				$result[$key]['repayment_noaccount'] = $value['repayment_account'] - $value['repayment_yesaccount'];
				$_data['year_apr'] = $value['apr'];
				$_data['account'] = $value['tender_account'];
				$_data['month_times'] = $value['time_limit'];
				$_data['borrow_style'] = $value['style'];
				$_data['type'] = "all";
				$result[$key]['equal'] = self::EqualInterest($_data);
			}
			return $result;
		}			 
		
		$row = $mysql->db_fetch_array(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array('count(1) as num', '', ''), $sql));
		
		$total = $row['num'];
		$total_page = ceil($total / $epage);
		$index = $epage * ($page - 1);
		$limit = " limit {$index}, {$epage}";
		
		$list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select, 'order by p1.id desc', $limit), $sql));		
		$list = $list?$list:array();
		foreach($list as $key => $value){
			//��ȡ����
			if(empty($value['account'])) $value['account']=1;
			$_data['year_apr'] = $value['apr'];
			$_data['account'] = $value['account'];
			$_data['month_times'] = $value['time_limit'];
			$_data['borrow_style'] = $value['style'];
			$list[$key]['equal'] = self::EqualInterest($_data);
			$list[$key]['other'] = $value['account'] - $value['account_yes'];
			$list[$key]['scale'] = round(100*$value['account_yes']/$value['account'],1);
			$list[$key]['scale_width'] = round((20*$value['account_yes']/$value['account']))*7;
			$list[$key]['repayment_noaccount'] = $value['repayment_account'] - $value['repayment_yesaccount'];
		}
		
		return array(
            'list' => $list,
            'total' => $total,
            'page' => $page,
            'epage' => $epage,
            'total_page' => $total_page
        );
		
	}
	
	
	//�����ϸ��
	function GetTenderCollection($data){
		global $mysql;
		
		$page = empty($data['page'])?1:$data['page'];
		$epage = empty($data['epage'])?10:$data['epage'];
		
		$_sql = "where 1=1 ";		 
		if (!empty($data['user_id'])){
			$_sql .= " and p2.user_id = {$data['user_id']}";
		}
		if (isset($data['dotime2'])){
			$dotime2 = ($data['dotime2']=="request")?$_REQUEST['dotime2']:$data['dotime2'];
			if ($dotime2!=""){
				$_sql .= " and p1.addtime < ".get_mktime($dotime2);
			}
		}
		if (isset($data['dotime1'])){
			$dotime1 = ($data['dotime1']=="request")?$_REQUEST['dotime1']:$data['dotime1'];
			if ($dotime2!=""){
				$_sql .= " and p1.addtime > ".get_mktime($dotime1);
			}
		}
		$_select = "p1.*,p3.username";
		$sql = "select SELECT from {borrow_tender} as p1 
					left join {borrow} as p2 on p2.id=p1.borrow_id
					left join {user} as p3 on p1.user_id=p3.user_id
					$_sql
					";
	
	
	}
	
	
	/**
	 * �����б�
	 *
	 * @return Array
	 */
	function GetVouchList($data = array()){
		global $mysql;
		$user_id = empty($data['user_id'])?"":$data['user_id'];
		$username = empty($data['username'])?"":$data['username'];
	
		$page = empty($data['page'])?1:$data['page'];
		$epage = empty($data['epage'])?10:$data['epage'];
		
		$_sql = "where 1=1";		 
		if (!empty($user_id)){
			$_sql .= " and p1.user_id = $user_id";
		}
		if (!empty($username)){
			$_sql .= " and p2.username = '$username'";
		}
		if (isset($data['borrow_id']) && $data['borrow_id']!=""){
			$_sql .= " and p1.borrow_id = '{$data['borrow_id']}'";
		}
	
		if (isset($data['dotime2'])){
			$dotime2 = ($data['dotime2']=="request")?$_REQUEST['dotime2']:$data['dotime2'];
			if ($dotime2!=""){
				$_sql .= " and p1.addtime < ".get_mktime($dotime2);
			}
		}
		if (isset($data['dotime1'])){
			$dotime1 = ($data['dotime1']=="request")?$_REQUEST['dotime1']:$data['dotime1'];
			if ($dotime2!=""){
				$_sql .= " and p1.addtime > ".get_mktime($dotime1);
			}
		}
		if (isset($data['status']) && $data['status']!=""){
			$_sql .= " and p1.status in ({$data['status']})";
		}
		if (isset($data['borrow_status']) && $data['borrow_status']!=""){
			$_sql .= " and p3.status in ({$data['borrow_status']})";
		}
		
	
		$_select = "p1.*,p2.username,p3.name as borrow_name,p3.time_limit as borrow_period,p3.account as borrow_account,p4.username as borrow_username";
		$sql = "select SELECT from `{borrow_vouch}` as p1
				left join `{user}` as p2 on p2.user_id = p1.user_id
				left join `{borrow}` as p3 on p1.borrow_id = p3.id
				left join `{user}` as p4 on p4.user_id = p3.user_id
		 {$_sql}  order by p1.addtime desc LIMIT";
				
		//�Ƿ���ʾȫ������Ϣ
		if (isset($data['limit']) ){
			$_limit = "";
			if ($data['limit'] != "all"){
				$_limit = "  limit ".$data['limit'];
			}
			$result= $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,  'order by p1.id desc', $_limit), $sql));
			return $result;
		}			 
		
		$row = $mysql->db_fetch_array(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array('count(1) as num', '', ''), $sql));
		
		$total = $row['num'];
		$total_page = ceil($total / $epage);
		$index = $epage * ($page - 1);
		$limit = " limit {$index}, {$epage}";
		
		$list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select, 'order by p1.id desc', $limit), $sql));		
		$list = $list?$list:array();
		return array(
            'list' => $list,
            'total' => $total,
            'page' => $page,
            'epage' => $epage,
            'total_page' => $total_page
        );
		
	}
	
	/**
	 * ֻ��Ͷ����б�
	 *
	 * @return Array
	 */
	function GetTenderUserList($data = array()){
		global $mysql;
		
		$page = empty($data['page'])?1:$data['page'];
		$epage = empty($data['epage'])?10:$data['epage'];
		
		$_sql = "where 1=1 ";		 
		if (!empty($data['user_id'])){
			$_sql .= " and p2.user_id = {$data['user_id']}";
		}
		if (isset($data['username'])){
			if ($data['username']=="request"){
				$_sql .= " and p3.username like '%{$_REQUEST['username']}%'";
			}
		}
		if (isset($data['borrow_id']) && $data['borrow_id']!=""){
			$_sql .= " and p1.borrow_id = '{$data['borrow_id']}'";
		}
		if (isset($data['borrow_status']) && $data['borrow_status']!=""){
			$_sql .= " and p2.status = '{$data['borrow_status']}'";
		}
		if (isset($data['dotime2'])){
			$dotime2 = ($data['dotime2']=="request")?$_REQUEST['dotime2']:$data['dotime2'];
			if ($dotime2!=""){
				$_sql .= " and p1.addtime < ".get_mktime($dotime2);
			}
		}
		if (isset($data['dotime1'])){
			$dotime1 = ($data['dotime1']=="request")?$_REQUEST['dotime1']:$data['dotime1'];
			if ($dotime2!=""){
				$_sql .= " and p1.addtime > ".get_mktime($dotime1);
			}
		}
		$_select = "p1.*,p2.name as borrow_name,p3.username";
		$sql = "select SELECT from {borrow_tender} as p1 
					left join {borrow} as p2 on p2.id=p1.borrow_id
					left join {user} as p3 on p1.user_id=p3.user_id
					$_sql order by p1.id desc
					";
		//�Ƿ���ʾȫ������Ϣ
		if (isset($data['limit']) ){
			$_limit = "";
			if ($data['limit'] != "all"){
				$_limit = "  limit ".$data['limit'];
			}
			$result= $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,  'order by p1.addtime desc', $_limit), $sql));
			return $result;
		}	
				
		$row = $mysql->db_fetch_array(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array('count(1) as num', '', ''), $sql));
		$total = $row['num'];
		$total_page = ceil($total / $epage);
		$index = $epage * ($page - 1);
		$limit = " limit {$index}, {$epage}";
		
		
		$list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select, 'order by p1.id desc', $limit), $sql));		
		$list = $list?$list:array();
		foreach ($list as $key => $value){
			$list[$key]['repayment_noaccount'] = $value['repayment_account']-$value['repayment_yesaccount'];
			$list[$key]['repayment_nointerest'] = $value['repayment_account']-$value['repayment_yesaccount']-$value['account'];
		}
		
		return array(
            'list' => $list,
            'total' => $total,
            'page' => $page,
            'epage' => $epage,
            'total_page' => $total_page
        );
	}
		
	/**
	 * �鿴Ͷ�����Ϣ
	 *
	 * @param Array $data
	 * @return Array
	 */
	public static function GetTenderOne($data = array()){
		global $mysql;
		$id = $data['id'];
		$sql = "select * from {borrow_tender}  where id=$id";
		$result = $mysql->db_fetch_array($sql);
		//��ȡ�û��Ļ�������
		$sql = "select sum(money) as total from {borrow_tender}  where  borrow_id=$id";
		$_result = $mysql->db_fetch_array($sql);
		$result['other'] = $result['borrow']['account'] - $_result['total'];
		$result['scale'] = round(100*$_result['total']/$result['borrow']['account'],1);
		$result['scale_width'] = round((20*$_result['total']/$result['borrow']['account']))*7;
		return $result;
	}
	
	/**
	 * ���Ͷ��
	 *
	 * @param Array $data
	 * @return Boolen
	 */
	public static function AddTender($data = array()){
		global $mysql,$_G;
		if (!isset($data['borrow_id']) || $data['borrow_id']==""){
			return self::ERROR;
		}		
		
		if ($_G['user_result']['islock']==1){
			return "���˺��Ѿ������������ܽ���Ͷ�꣬�������Ա��ϵ";
		}
		$sql = "update  {borrow}  set account_yes=account_yes+{$data['account']},tender_times=tender_times+1  where id='{$data['borrow_id']}'";
		$mysql->db_query($sql);//�����Ѿ�Ͷ���Ǯ
		
		$sql = "insert into `{borrow_tender}` set `addtime` = '".time()."',`addip` = '".ip_address()."'";
		foreach($data as $key => $value){
			$sql .= ",`$key` = '$value'";
		}
		$mysql->db_query($sql);
		$tender_id = $mysql->db_insert_id();
		
		if ($tender_id>0){
			//����ɹ����򽫻�����Ϣ���������ȥ
			$result = self::GetOne(array("id"=>$data['borrow_id']));
			$eq['account'] = $data['account'];
			$eq['year_apr'] = $result['apr'];
			$eq['month_times'] = $result['time_limit'];
			$eq['borrow_time'] = $result['repayment_time'];
			$eq['borrow_style'] = $result['style'];
			$result = self::EqualInterest($eq);
			$repayment_account = 0;
			foreach ($result as $key => $value){
				$repayment_account += $value['repayment_account'];
				//���黹��Ϣд��ȥ
				$sql = "insert into {borrow_collection} set `addtime` = '".time()."',`addip` = '".ip_address()."',`tender_id`='{$tender_id}',`order`='{$key}',`repay_time`='{$value['repayment_time']}',
						`repay_account`='{$value['repayment_account']}',`interest`='{$value['interest']}',`capital`='{$value['capital']}'
						";
				$mysql ->db_query($sql);
			}
			$_interest = $repayment_account-$data['account'];
			$sql = " update {borrow_tender} set repayment_account='{$repayment_account}',wait_account ='{$repayment_account}',interest = '{$_interest}',wait_interest = '{$_interest}' where id={$tender_id}";
			$mysql ->db_query($sql);
			return true;
		}else{
			return false;
		}
	}
	
	
	
	/**
	 * ��ӵ���
	 *
	 * @param Array $data
	 * @return Boolen
	 */
	public static function AddVouch($data = array()){
		global $mysql,$_G;
		if (!isset($data['borrow_id']) || $data['borrow_id']==""){
			return self::ERROR;
		}		
		
		if ($_G['user_result']['islock']==1){
			return "���˺��Ѿ������������ܽ���Ͷ�꣬�������Ա��ϵ";
		}
		
		
		$sql = "insert into `{borrow_vouch}` set `addtime` = '".time()."',`addip` = '".ip_address()."'";
		foreach($data as $key => $value){
			$sql .= ",`$key` = '$value'";
		}
		$mysql->db_query($sql);
		$vouch_id = $mysql->db_insert_id();
		
		if ($vouch_id>0){
			$sql = "update  {borrow}  set vouch_account=vouch_account+{$data['account']},vouch_times=vouch_times+1  where id='{$data['borrow_id']}'";
			$mysql->db_query($sql);//�����Ѿ�������Ǯ
			
			//��Ӷ�ȼ�¼
			$amountlog_result = self::GetAmountOne($data['user_id'],"tender_vouch");
			$amountlog["user_id"] = $data['user_id'];
			$amountlog["type"] = "tender_vouch_sucess";
			$amountlog["amount_type"] = "tender_vouch";
			$amountlog["account"] = $data['account'];
			$amountlog["account_all"] = $amountlog_result['account_all'];
			$amountlog["account_use"] = $amountlog_result['account_use'] - $amountlog['account'];
			$amountlog["account_nouse"] = $amountlog_result['account_nouse'] + $amountlog['account']; 
			$amountlog["remark"] = "�����ɹ�";
			self::AddAmountLog($amountlog);
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * �鿴Ͷ�����Ϣ
	 *
	 * @param Array $data
	 * @return Array
	 */
	public static function Repay($data = array()){
		global $mysql,$_G;
		$id = $data['id'];
		if ($id == "request"){
			$id = $_REQUEST['id'];
		}
		$_sql = "";
		if (isset($data['user_id']) && $data['user_id']!=""){
			$_sql .= " and p2.user_id = '{$data['user_id']}'";
		}else{
			return self::ERROR;
		}
		$sql = "select p1.*,p2.name as borrow_name,p2.repayment_account as all_repayment_account,p2.repayment_yesaccount as all_repayment_yesaccount,p2.user_id as borrow_userid,p2.repayment_yesinterest ,p2.time_limit,p2.forst_account,p2.account as borrow_account,p2.is_vouch,p2.success_time from {borrow_repayment} as p1,{borrow} as p2   where (p1.status=0 or p1.status=2) and p1.id=$id and p1.borrow_id=p2.id $_sql";
		$borrow_repayment_result = $mysql->db_fetch_array($sql);
		$borrow_id = $borrow_repayment_result["borrow_id"];
		$success_time = $borrow_repayment_result["success_time"];
		$borrow_userid = $borrow_repayment_result["borrow_userid"];
		
		if ($borrow_repayment_result==false){
			return self::ERROR;
		}
		if ($borrow_repayment_result['status']==1){
			return "�����Ѿ�����벻Ҫ�Ҳ���";
		}
		//�ж���һ���Ƿ��ѻ�
		if ($borrow_repayment_result['order']!=0){
			$_order = $borrow_repayment_result['order']-1;
			$sql = "select status from `{borrow_repayment}` where `order`=$_order and borrow_id={$borrow_repayment_result['borrow_id']}";
			$result = $mysql->db_fetch_array($sql);
			if ($result!=false && $result['status']!=1){
				return "�����ڵĽ�û�������Ȼ����ڵ�";
			}
		}
		$late_result = self::LateInterest(array("account"=>$borrow_repayment_result['capital'],"repayment_time"=>$borrow_repayment_result['repayment_time']));
		
		//�жϿ�������Ƿ񹻻���
		$sql = "select * from {account} where user_id = '{$data['user_id']}'";
		$account_result = $mysql->db_fetch_array($sql);
		if ($account_result['use_money']<$borrow_repayment_result['repayment_account']+$late_result['late_interest']){
			return self::BORROW_REPAYMENT_NOT_ENOUGH;
		}
		
		//�۳����������
		$account_result =  accountClass::GetOne(array("user_id"=>$data['user_id']));
		$account_log['user_id'] =$data['user_id'];
		$account_log['type'] = "repayment";
		$account_log['money'] = $borrow_repayment_result['repayment_account'];
		$account_log['total'] =$account_result['total']-$account_log['money'];
		$account_log['use_money'] = $account_result['use_money']-$account_log['money'];
		$account_log['no_use_money'] = $account_result['no_use_money'];
		$account_log['collection'] = $account_result['collection'];
		$account_log['to_user'] = "0";
		$account_log['remark'] = "��[<a href=\'/invest/a{$borrow_repayment_result['borrow_id']}.html\' target=_blank>{$borrow_repayment_result['borrow_name']}</a>]����";
		accountClass::AddLog($account_log);
		
		
		$_repay_time = $borrow_repayment_result['repayment_time']; 
		$re_time = (strtotime(date("Y-m-d",$_repay_time))-strtotime(date("Y-m-d",time())))/(60*60*24);
		if($re_time>4){
			$credit['nid'] = "advance_3day";
		}elseif ($re_time>2 && $re_time<=4){
			$credit['nid'] = "advance_1day";
		}else{
			$credit['nid'] = "advance_day";
		}
		$result = creditClass::GetTypeOne(array("nid"=>$credit['nid']));
		$credit['user_id'] = $data['user_id'];
		$credit['value'] = $result['value'];
		$credit['op_user'] = $_G['user_id'];
		$credit['op'] = 1;//����
		$credit['type_id'] = $result['id'];
		$credit['remark'] = "����ɹ���{$credit['value']}��";
		creditClass::UpdateCredit($credit);//���»���
		
		
		
		
		
		//�ж��Ƿ������Ļ������ⶳ������
		if ($borrow_repayment_result['order']+1 == $borrow_repayment_result['time_limit']){
			
			$account_result =  accountClass::GetOne(array("user_id"=>$data['user_id']));
			$account_log['user_id'] =$data['user_id'];
			$account_log['type'] = "borrow_frost";
			$account_log['money'] = $borrow_repayment_result['forst_account'];
			$account_log['total'] =$account_result['total'];
			$account_log['use_money'] = $account_result['use_money']+$account_log['money'];
			$account_log['no_use_money'] = $account_result['no_use_money']-$account_log['money'];
			$account_log['collection'] = $account_result['collection'];
			$account_log['to_user'] = "0";
			$account_log['remark'] = "��[<a href=\'/invest/a{$borrow_repayment_result['borrow_id']}.html\' target=_blank>{$borrow_repayment_result['borrow_name']}</a>]���Ľⶳ";
			accountClass::AddLog($account_log);
	
			$credit['nid'] = "borrow_success";
			$result = creditClass::GetTypeOne(array("nid"=>$credit['nid']));
			$credit['user_id'] = $data['user_id'];
			$credit['value'] = round($borrow_repayment_result['borrow_account']/100);
			$credit['op_user'] = $_G['user_id'];
			$credit['op'] = 1;//����
			$credit['type_id'] = $result['id'];
			$credit['remark'] = "���ɹ���{$credit['value']}��";
			creditClass::UpdateCredit($credit);//���»���
			
			
		}
		
		
		//�ж��Ƿ��ǵ�����
		if ($borrow_repayment_result['is_vouch']==1){
			//Ͷ����Ͷ�ʵ�����ȵ�����
			$sql = "select * from `{borrow_vouch_collection}` where borrow_id=$borrow_id and `order`={$borrow_repayment_result['order']}";
			$result = $mysql->db_fetch_arrays($sql);
			if ($result!=""){
				foreach ($result as $key => $value){
					//��Ӷ�ȼ�¼
					$amountlog_result = self::GetAmountOne($value['user_id'],"tender_vouch");
					$amountlog["user_id"] = $value['user_id'];
					$amountlog["type"] = "tender_vouch_repay";
					$amountlog["amount_type"] = "tender_vouch";
					$amountlog["account"] = $value['repay_account'];
					$amountlog["account_all"] = $amountlog_result['account_all'];
					$amountlog["account_use"] = $amountlog_result['account_use'] + $amountlog['account'];
					$amountlog["account_nouse"] = $amountlog_result['account_nouse'] - $amountlog['account']; 
					$amountlog["remark"] = "�����껹��ɹ���Ͷ�ʵ�����ȷ���";
					self::AddAmountLog($amountlog);
					
					$sql = "update `{borrow_vouch_collection}` set repay_yestime = ".time().",repay_yesaccount = {$amountlog['account']},status=1 where id = {$value['id']}";
					$mysql->db_fetch_array($sql);
					
				}
			}
			
			
			//����˵�����ȵ�����
			//��Ӷ�ȼ�¼
			$sql = "select * from `{borrow_vouch_repayment}` where borrow_id=$borrow_id and `order`={$borrow_repayment_result['order']}";
			$result = $mysql->db_fetch_array($sql);
			$amountlog_result = self::GetAmountOne($data['user_id'],"borrow_vouch");
			$amountlog["user_id"] = $data['user_id'];
			$amountlog["type"] = "borrow_vouch_repay";
			$amountlog["amount_type"] = "borrow_vouch";
			$amountlog["account"] = $result['repay_account'];
			$amountlog["account_all"] = $amountlog_result['account_all'];
			$amountlog["account_use"] = $amountlog_result['account_use'] + $amountlog['account'];
			$amountlog["account_nouse"] = $amountlog_result['account_nouse'] - $amountlog['account']; 
			$amountlog["remark"] = "����������ɣ�������ȷ���";
			self::AddAmountLog($amountlog);
						
			$sql = "update `{borrow_vouch_repayment}` set repay_yestime = ".time().",repay_yesaccount = {$amountlog['account']},status=1 where id = {$result['id']}";
			$mysql->db_fetch_array($sql);
		}
		
		////���ö�ȵ�����
		if ($borrow_repayment_result['is_vouch']!=1){
			//��Ӷ�ȼ�¼
			$amountlog_result = self::GetAmountOne($borrow_userid,"credit");
			$amountlog["user_id"] = $borrow_userid;
			$amountlog["type"] = "borrrow_repay";
			$amountlog["amount_type"] = "credit";
			$amountlog["account"] = $borrow_repayment_result['repayment_account'];
			$amountlog["account_all"] = $amountlog_result['account_all'];
			$amountlog["account_use"] = $amountlog_result['account_use'] + $amountlog['account'];
			$amountlog["account_nouse"] = $amountlog_result['account_nouse'] - $amountlog['account']; 
			$amountlog["remark"] = "�ɹ�����������";
			self::AddAmountLog($amountlog);
			
			
		}
		$_order = $borrow_repayment_result['order'];
		
		//�����վ�Ѿ��������Ͳ��û�
		if ($borrow_repayment_result['status']!=2){
			$sql = "select p1.*,p2.user_id from `{borrow_collection}` as p1 left join  `{borrow_tender}` as p2 on p1.tender_id = p2.id where p1.`order` = '{$_order}' and p2.borrow_id='{$borrow_repayment_result['borrow_id']}'";
			$result = $mysql->db_fetch_arrays($sql);
			foreach ($result as $key => $value){
				//����Ͷ���˵ķ�����Ϣ
				$sql = "update  `{borrow_collection}` set repay_yestime='".time()."',repay_yesaccount = repay_account ,status=1   where id = '{$value['id']}'";
				$mysql->db_query($sql);
				//����Ͷ�ʵ���Ϣ
				$sql = "update  `{borrow_tender}` set repayment_yesaccount= repayment_yesaccount + {$value['repay_account']},wait_account = wait_account  - {$value['repay_account']} ,wait_interest = wait_interest - {$value['interest']},repayment_yesinterest  = repayment_yesinterest  + {$value['interest']}  where id = '{$value['tender_id']}'";
				$mysql->db_query($sql);
				$account_result =  accountClass::GetOne(array("user_id"=>$value['user_id']));
				$account_log['user_id'] =$value['user_id'];
				$account_log['type'] = "invest_repayment";
				$account_log['money'] = $value['repay_account'];
				$account_log['total'] = $account_result['total'];
				$account_log['use_money'] = $account_result['use_money']+$account_log['money'];
				$account_log['no_use_money'] = $account_result['no_use_money'];
				$account_log['collection'] =$account_result['collection'] -$account_log['money'];
				$account_log['to_user'] = $borrow_userid;
				$account_log['remark'] = "�ͻ���[<a href=\'/invest/a{$borrow_repayment_result['borrow_id']}.html\' target=_blank>{$borrow_repayment_result['borrow_name']}</a>]���Ļ���";
				accountClass::AddLog($account_log);
				
				
				
				//�۳�Ͷ�ʵĹ����
				if (isset($_G['system']['con_fee_time']) && $_G['system']['con_fee_time']!=""){
					$yes_ti = strtotime($_G['system']['con_fee_time']);
					if ($success_time>$yes_ti){
						$account_result =  accountClass::GetOne(array("user_id"=>$value['user_id']));
						$log['user_id'] = $value['user_id'];
						$log['type'] = "tender_mange";//
						$_fee = (isset($_G['system']['con_integral_fee']) && $_G['system']['con_integral_fee'] !="")?$_G['system']['con_integral_fee']:0.1;
						$log['money'] = $value['interest']*$_fee;
						$log['total'] = $account_result['total']-$log['money'];
						$log['use_money'] = $account_result['use_money']-$log['money'];
						$log['no_use_money'] = $account_result['no_use_money'];
						$log['collection'] = $account_result['collection'];
						$log['to_user'] = 0;
						$log['remark'] = "�û��ɹ�����۳���Ϣ�Ĺ����";
						accountClass::AddLog($log);
					}
				}else{
					$account_result =  accountClass::GetOne(array("user_id"=>$value['user_id']));
					$log['user_id'] = $value['user_id'];
					$log['type'] = "tender_mange";//
					$_fee = (isset($_G['system']['con_integral_fee']) && $_G['system']['con_integral_fee'] !="")?$_G['system']['con_integral_fee']:0.1;
					$log['money'] = $value['interest']*$_fee;
					$log['total'] = $account_result['total']-$log['money'];
					$log['use_money'] = $account_result['use_money']-$log['money'];
					$log['no_use_money'] = $account_result['no_use_money'];
					$log['collection'] = $account_result['collection'];
					$log['to_user'] = 0;
					$log['remark'] = "�û��ɹ�����۳���Ϣ�Ĺ����";
					accountClass::AddLog($log);
				}
				
				
				//��������
				$remind['nid'] = "loan_pay";
				$remind['sent_user'] = "0";
				$remind['receive_user'] = $value['user_id'];
				$remind['title'] = "�ͻ���[<a href=\'/invest/a{$borrow_repayment_result['borrow_id']}.html\' target=_blank>{$borrow_repayment_result['borrow_name']}</a>]���Ļ���";
				$remind['content'] = "�ͻ���".date("Y-m-d H:i:s")."��[<a href=\'/invest/a{$borrow_repayment_result['borrow_id']}.html\' target=_blank>{$borrow_repayment_result['borrow_name']}</a>]���Ļ���,������Ϊ{$value['repay_account']}";
				$remind['type'] = "system";
				remindClass::sendRemind($remind);
				
			}
		}
		
		//���ڻ���
		if ($late_result['late_days']>0 ){
			
			$account_result =  accountClass::GetOne(array("user_id"=>$data['user_id']));
			$account_log['user_id'] =$data['user_id'];
			$account_log['type'] = "late_repayment";
			$account_log['money'] = $late_result['late_interest'];
			$account_log['total'] =$account_result['total']-$account_log['money'];
			$account_log['use_money'] = $account_result['use_money']-$account_log['money'];
			$account_log['no_use_money'] = $account_result['no_use_money'];
			$account_log['collection'] = $account_result['collection'];
			$account_log['to_user'] = "0";
			$account_log['remark'] = "��[<a href=\'/invest/a{$borrow_repayment_result['borrow_id']}.html\' target=_blank>{$borrow_repayment_result['borrow_name']}</a>]�������ڽ��Ŀ۳�";
			accountClass::AddLog($account_log);
			
			//�������ڵ���Ϣ
			$sql = "update`{borrow_repayment}` set late_days = '{$late_result['late_days']}',late_interest = '{$late_result['late_interest']}' where id = {$id}";
			$mysql->db_query($sql);
			
			
			
		    if ($late_result['late_days']<=30){
				$sql = "select p1.*,p2.user_id from `{borrow_collection}` as p1 left join  `{borrow_tender}` as p2 on p1.tender_id = p2.id where p1.`order` = '{$_order}' and p2.borrow_id='{$borrow_repayment_result['borrow_id']}'";
				$result = $mysql->db_fetch_arrays($sql);
				$late_rate = isset($_G['system']['con_late_rate'])?$_G['system']['con_late_rate']:0.008;
				foreach ($result as $key => $value){
					//����Ͷ�ʵ���Ϣ
					$account_result =  accountClass::GetOne(array("user_id"=>$value['user_id']));
					$account_log['user_id'] =$value['user_id'];
					$account_log['type'] = "late_collection";
					$account_log['money'] = round((($value['capital']*$late_rate*$late_result['late_days'])/2),2);
					$account_log['total'] = $account_result['total']+$account_log['money'];
					$account_log['use_money'] = $account_result['use_money']+$account_log['money'];
					$account_log['no_use_money'] = $account_result['no_use_money'];
					$account_log['collection'] =$account_result['collection'];
					$account_log['to_user'] = $data['user_id'];
					$account_log['remark'] = "[<a href=\'/invest/a{$borrow_repayment_result['borrow_id']}.html\' target=_blank>{$borrow_repayment_result['borrow_name']}</a>]�������ڲ�����30���������Ϣ����";
					accountClass::AddLog($account_log);
					
					//�������ڵ���Ϣ
					$sql = "update`{borrow_collection}` set late_days = '{$late_result['late_days']}',late_interest = '{$account_log['money']}' where id = {$value['id']}";
					$mysql->db_query($sql);
				}
			}
		}
		
		
		//������Ļ�����
		$sql = "update {borrow} set repayment_yesaccount= repayment_yesaccount + {$borrow_repayment_result['repayment_account']} where id={$borrow_repayment_result['borrow_id']}";
		$result = $mysql -> db_query($sql);
		
		//���»�����״̬
		$sql = "update {borrow_repayment} set status=1,repayment_yesaccount='{$borrow_repayment_result['repayment_account']}',repayment_yestime='".time()."' where id=$id";
		$result = $mysql -> db_query($sql);
		
		//���������Ļ�����
		$sql = "update {borrow_tender} set interest=interest+{$borrow_repayment_result['interest']},repayment_yesaccount=repayment_yesaccount+{$borrow_repayment_result['capital']} where id={$borrow_repayment_result['borrow_id']}";
		$result = $mysql -> db_query($sql);
		
		return $result;
	}
	
	/**
	 * �鿴Ͷ�����Ϣ
	 *
	 * @param Array $data
	 * @return Array
	 */
	
	function GetRepaymentList($data = array()){
		global $mysql;
	
		$page = empty($data['page'])?1:$data['page'];
		$epage = empty($data['epage'])?10:$data['epage'];
		
		$_sql = " where p1.borrow_id=p2.id and p2.user_id=p3.user_id and p2.status=3 ";
		if (isset($data['id']) && $data['id']!=""){
			if ($data['id'] == "request"){
				$_sql .= " and p1.borrow_id= '{$_REQUEST['id']}'";
			}else{
				$_sql .= " and p1.borrow_id= '{$data['id']}'";
			}
		}
		if (isset($data['user_id']) && $data['user_id']!=""){
			$_sql .= " and p2.user_id = '{$data['user_id']}'";
		}	 
		if (isset($data['username']) && $data['username']!=""){
			$_sql .= " and p3.username like '%{$data['username']}%'";
		}	 
		if (isset($data['repayment_time']) && $data['repayment_time']!=""){
			if ($date['repayment_time']==0) $data['repayment_time'] = time();
			$_repayment_time = get_mktime(date("Y-m-d",$data['repayment_time']));
			$_sql .= " and p1.repayment_time < '{$_repayment_time}'";
		}	 
		
		if (isset($data['dotime2'])){
			$dotime2 = ($data['dotime2']=="request")?$_REQUEST['dotime2']:$data['dotime2'];
			if ($dotime2!=""){
				$_sql .= " and p2.addtime < ".get_mktime($dotime2);
			}
		}
		if (isset($data['dotime1'])){
			$dotime1 = ($data['dotime1']=="request")?$_REQUEST['dotime1']:$data['dotime1'];
			if ($dotime2!=""){
				$_sql .= " and p2.addtime > ".get_mktime($dotime1);
			}
		}
		
		if (isset($data['status'])){
			$_sql .= " and p1.status in ({$data['status']})";
		}
		if (isset($data['kefu_userid']) && $data['kefu_userid']!=""){
			$sql = "select 1 from `{user_cache}` where kefu_userid={$data['kefu_userid']} and user_id='{$data['user_id']}'";
			$result  = $mysql->db_fetch_array($sql);
			if($result=="" || $result==false){
				return "���Ĳ�������";
			}
		} 
		$keywords = empty($data['keywords'])?"":$data['keywords'];
		if ((!empty($keywords)  ) ){
		    if ($keywords=="request"){
				if (isset($_REQUEST['keywords']) && $_REQUEST['keywords']!=""){
					$_sql .= " and p2.name like '%".urldecode($_REQUEST['keywords'])."%'";
				}
			}else{
				$_sql .= " and p2.name like '%".$keywords."%'";
			}
			
		}
		
		$_order = " order by p1.id desc";
		if (isset($data['order']) && $data['order']!="" ){
			if ($data['order'] == "repayment_time"){
				$_order = " order by p1.repayment_time asc ";
			}elseif ($data['order'] == "order"){
				$_order = " order by p1.order asc ,p1.id desc";
			}
		}
		
		$_select = " p1.*,p2.name as borrow_name,p2.time_limit,p3.username,p3.user_id,p3.phone,p3.area";
		$sql = "select SELECT from `{borrow_repayment}` as p1,`{borrow}` as p2 ,`{user}` as p3  {$_sql} ORDER LIMIT";
		
		//�Ƿ���ʾȫ������Ϣ
		if (isset($data['limit']) ){
			$_limit = "";
			if ($data['limit'] != "all"){
				$_limit = "  limit ".$data['limit'];
			}
			$list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,  $_order, $_limit), $sql));
			foreach ($list as $key => $value){
				$late = self::LateInterest(array("repayment_time"=>$value['repayment_time'],"account"=>$value['capital']));
				if ($value['status']!=1){
					$list[$key]['late_days'] = $late['late_days'];
					$list[$key]['late_interest'] = $late['late_interest'];
				}
			}
			return $list;
		}			 
		
		$row = $mysql->db_fetch_array(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array('count(1) as num', '', ''), $sql));
		
		$total = $row['num'];
		$total_page = ceil($total / $epage);
		$index = $epage * ($page - 1);
		$limit = " limit {$index}, {$epage}";
		$list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,$_order, $limit), $sql));		
		$list = $list?$list:array();
		foreach ($list as $key => $value){
			$late = self::LateInterest(array("repayment_time"=>$value['repayment_time'],"account"=>$value['capital']));
			if ($value['status']!=1){
				$list[$key]['late_days'] = $late['late_days'];
				$list[$key]['late_interest'] = $late['late_interest'];
			}
		}
		return array(
            'list' => $list,
            'total' => $total,
            'page' => $page,
            'epage' => $epage,
            'total_page' => $total_page
        );
		
	}
	
	
	function GetVouchRepayList($data = array()){
		global $mysql;
	
		$page = empty($data['page'])?1:$data['page'];
		$epage = empty($data['epage'])?10:$data['epage'];
		
		$_sql = " where p1.borrow_id=p2.id and p2.user_id=p3.user_id ";
		if (isset($data['id']) && $data['id']!=""){
			if ($data['id'] == "request"){
				$_sql .= " and p1.borrow_id= '{$_REQUEST['id']}'";
			}else{
				$_sql .= " and p1.borrow_id= '{$data['id']}'";
			}
		}
		if (isset($data['user_id']) && $data['user_id']!=""){
			$_sql .= " and p2.user_id = '{$data['user_id']}'";
		}	 
		if (isset($data['vouch_userid']) && $data['vouch_userid']!=""){
			$_sql .= " and p2.id in (select borrow_id from `{borrow_vouch}` where user_id={$data['vouch_userid']})";
		}	 
		if (isset($data['username']) && $data['username']!=""){
			$_sql .= " and p3.username like '%{$data['username']}%'";
		}	 
		if (isset($data['repayment_time']) && $data['repayment_time']!=""){
			if ($date['repayment_time']==0) $data['repayment_time'] = time();
			$_repayment_time = get_mktime(date("Y-m-d",$data['repayment_time']));
			$_sql .= " and p1.repayment_time < '{$_repayment_time}'";
		}	 
		
		if (isset($data['dotime2'])){
			$dotime2 = ($data['dotime2']=="request")?$_REQUEST['dotime2']:$data['dotime2'];
			if ($dotime2!=""){
				$_sql .= " and p2.addtime < ".get_mktime($dotime2);
			}
		}
		if (isset($data['dotime1'])){
			$dotime1 = ($data['dotime1']=="request")?$_REQUEST['dotime1']:$data['dotime1'];
			if ($dotime2!=""){
				$_sql .= " and p2.addtime > ".get_mktime($dotime1);
			}
		}
		if (isset($data['status'])){
			$_sql .= " and p1.status in ({$data['status']})";
		}
		$keywords = empty($data['keywords'])?"":$data['keywords'];
		if ((!empty($keywords)  ) ){
		    if ($keywords=="request"){
				if (isset($_REQUEST['keywords']) && $_REQUEST['keywords']!=""){
					$_sql .= " and p2.name like '%".urldecode($_REQUEST['keywords'])."%'";
				}
			}else{
				$_sql .= " and p2.name like '%".$keywords."%'";
			}
			
		}
		
		$_order = " order by p1.id desc";
		if (isset($data['order']) && $data['order']!="" ){
			if ($data['order'] == "repayment_time"){
				$_order = " order by p1.repayment_time asc ";
			}elseif ($data['order'] == "order"){
				$_order = " order by p1.order asc ,p1.id desc";
			}
		}
		
		$_select = " p1.*,p2.name as borrow_name,p2.time_limit,p3.username as borrow_username";
		$sql = "select SELECT from `{borrow_repayment}` as p1 left join `{borrow}` as p2 on p1.borrow_id = p2.id left join `{user}` as p3 on p3.user_id=p2.user_id {$_sql} ORDER LIMIT";
		
		//�Ƿ���ʾȫ������Ϣ
		if (isset($data['limit']) ){
			$_limit = "";
			if ($data['limit'] != "all"){
				$_limit = "  limit ".$data['limit'];
			}
			$list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,  $_order, $_limit), $sql));
			foreach ($list as $key => $value){
				$late = self::LateInterest(array("repayment_time"=>$value['repayment_time'],"account"=>$value['capital']));
				if ($value['status']!=1){
					$list[$key]['late_days'] = $late['late_days'];
					$list[$key]['late_interest'] = $late['late_interest'];
				}
			}
			return $list;
		}			 
		
		$row = $mysql->db_fetch_array(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array('count(1) as num', '', ''), $sql));
		
		$total = $row['num'];
		$total_page = ceil($total / $epage);
		$index = $epage * ($page - 1);
		$limit = " limit {$index}, {$epage}";
		$list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,$_order, $limit), $sql));		
		$list = $list?$list:array();
		foreach ($list as $key => $value){
			$late = self::LateInterest(array("repayment_time"=>$value['repayment_time'],"account"=>$value['capital']));
			if ($value['status']!=1){
				$list[$key]['late_days'] = $late['late_days'];
				$list[$key]['late_interest'] = $late['late_interest'];
			}
		}
		return array(
            'list' => $list,
            'total' => $total,
            'page' => $page,
            'epage' => $epage,
            'total_page' => $total_page
        );
		
	}
	
	//������Ϣ����
	//account ��� repayment_time ����ʱ��
	function LateInterest($data){
		global $mysql,$_G;
		$late_rate = isset($_G['system']['con_late_rate'])?$_G['system']['con_late_rate']:0.008;
		$now_time = get_mktime(date("Y-m-d",time()));
		$repayment_time = get_mktime(date("Y-m-d",$data['repayment_time']));
		$late_days = ($now_time - $repayment_time)/(60*60*24);
		$_late_days = explode(".",$late_days);
		$late_days = ($_late_days[0]<0)?0:$_late_days[0];
		$late_interest = round($data['account']*$late_rate*$late_days,2);
		if ($late_days==0) $late_interest=0;
		return array("late_days"=>$late_days,"late_interest"=>$late_interest );
	}
	
	function LateRepay($data){
		global $mysql,$_G;
		$sql = "select p1.*,p2.name as borrow_name from `{borrow_repayment}` as p1 left join `{borrow}` as p2 on p1.borrow_id = p2.id where p1.id = {$data['id']}";
		$result = $mysql->db_fetch_array($sql);
		if ($result['status']==1){
			return ;
		}elseif ($result['status']==2){
		
		}elseif ($result['status']==0){
			$late_result = self::LateInterest(array("account"=>$result['capital'],"repayment_time"=>$result['repayment_time']));
			if ($late_result['late_days']<30){
				$msg = array("�˱���δ����30��");
			}else{
				//���»����״̬Ϊ2����ʾ��վ�Ѿ�����
				
				$sql = "update `{borrow_repayment}` set status=2,webstatus=1 where id = {$data['id']}";
				$mysql -> db_query($sql);
				
				$order = $result['order'];
				$borrow_id = $result['borrow_id'];
				$borrow_name = $result['borrow_name'];
				
				
				$sql = "select p1.*,p2.user_id from `{borrow_collection}` as p1 left join  `{borrow_tender}` as p2 on p1.tender_id = p2.id where p1.`order` = '{$order}' and p2.borrow_id='{$borrow_id}'";
				$result = $mysql->db_fetch_arrays($sql);
				foreach ($result as $key => $value){
					//����Ͷ���˵ķ�����Ϣ
					$sql = "update  `{borrow_collection}` set repay_yestime='".time()."',repay_yesaccount = repay_account ,status=2   where id = '{$value['id']}'";
					$mysql->db_query($sql);
					//����Ͷ�ʵ���Ϣ
					$sql = "update  `{borrow_tender}` set repayment_yesaccount= repayment_yesaccount + {$value['repay_account']},wait_account = wait_account  - {$value['repay_account']} ,wait_interest = wait_interest - {$value['interest']},repayment_yesinterest  = repayment_yesinterest  + {$value['interest']}  where id = '{$value['tender_id']}'";
					$mysql->db_query($sql);
					$account_result =  accountClass::GetOne(array("user_id"=>$value['user_id']));
					$account_log['user_id'] =$value['user_id'];
					$account_log['type'] = "system_repayment";
					$account_log['money'] = $value['repay_account'];
					$account_log['total'] = $account_result['total'];
					$account_log['use_money'] = $account_result['use_money']+$account_log['money'];
					$account_log['no_use_money'] = $account_result['no_use_money'];
					$account_log['collection'] =$account_result['collection'] -$account_log['money'];
					$account_log['to_user'] = "0";
					$account_log['remark'] = "�ͻ����ڳ���30�죬ϵͳ�Զ���[<a href=\'/invest/a{$borrow_id}.html\' target=_blank>{$borrow_name}</a>]���Ļ���";
					accountClass::AddLog($account_log);
					
					
					$account_result =  accountClass::GetOne(array("user_id"=>$value['user_id']));
					$account_log['user_id'] =$value['user_id'];
					$account_log['type'] = "late_rate";
					$account_log['money'] = $value['interest'];
					$account_log['total'] = $account_result['total'] -$account_log['money'];
					$account_log['use_money'] = $account_result['use_money']-$account_log['money'];
					$account_log['no_use_money'] = $account_result['no_use_money'];
					$account_log['collection'] =$account_result['collection'] ;
					$account_log['to_user'] = "0";
					$account_log['remark'] = "�ͻ����ڳ���30���[<a href=\'/invest/a{$borrow_id}.html\' target=_blank>{$borrow_name}</a>]�������Ϣ�۳�";
					accountClass::AddLog($account_log);
				}
				
			}
		}
	}
	
	/**
	 * �鿴Ͷ�����Ϣ
	 *
	 * @param Array $data
	 * @return Array
	 */
	public static function GetRepayment($data = array()){
		global $mysql;
		$id = $data['id'];
		$sql = "select * from {borrow}  where id=$id";
		$result = $mysql->db_fetch_array($sql);
		$data['account'] = $result['account'];
		$data['year_apr'] = $result['apr'];
		$data['month_times'] = $result['time_limit'];
		$data['borrow_time'] = $result['success_time'];
		$data['borrow_style'] = $result['style'];
		
		return self::EqualInterest($data);
	}
	
	/**
	 * �鿴Ͷ�����Ϣ
	 *
	 * @param Array $data(user_id,id,status,remark)
	 * @return Array
	 */
	public static function AddRepayment($data = array()){
		global $mysql,$_G;
		$id = $data['id'];
		if ($id  =="") return self::ERROR;
		$status = $data['status'];
		
		$sql = "select * from {borrow}  where id=$id";
		$result = $mysql->db_fetch_array($sql);
		if ($result['status']!=1){
			return "�˱��Ѿ���˹������������";
		}
		$user_id = $result['user_id'];
		$borrow_name = $result['name'];
		$borrow_account = $result['account'];
		$style = $result['style'];
		$award =$result['award'];
		$funds = $result['funds'];
		$is_vouch = $result['is_vouch'];//�Ƿ��ǵ�����
		$vouch_award = $result['vouch_award'];//�����Ľ���
		$part_account = $result['part_account'];
		$tender_times = $result['tender_times'];
		$month_times = $result['time_limit'];
		$repayment_account  = $result['repayment_account'];
		$_data['account'] = $borrow_account;
		$_data['year_apr'] = $result['apr'];
		$_data['month_times'] = $month_times;
		$_data['borrow_time'] = $result['success_time'];
		$_data['borrow_style'] = $result['style'];
		$result = self::EqualInterest($_data);
		$total_account = 0;
		$borrow_url = "<a href=\'/invest/a{$id}.html\' target=_blank>{$borrow_name}</a>";
		if ($status == 3){
			//����ɹ����򽫻�����Ϣ���������ȥ
			foreach ($result as $key => $value){
				$total_account = $total_account+$value['repayment_account'];//�ܻ����
				$sql = "insert into {borrow_repayment} set `addtime` = '".time()."',`addip` = '".ip_address()."',`borrow_id`='{$id}',`order`='{$key}',`repayment_time`='{$value['repayment_time']}',
						`repayment_account`='{$value['repayment_account']}',`interest`='{$value['interest']}',`capital`='{$value['capital']}'
						";
				$mysql ->db_query($sql);
				$repayment_account = $value['repayment_account'];
			}
			
			//�۳�����Ͷ���ߵĽ�Ǯ��
			$sql = "select * from `{borrow_tender}`  where borrow_id=$id";
			$result = $mysql->db_fetch_arrays($sql);
			foreach ($result as $key => $value){
				$account_result =  accountClass::GetOne(array("user_id"=>$value['user_id']));
				$log['user_id'] = $value['user_id'];
				$log['type'] = "invest";
				$log['money'] = $value['account'];
				$log['total'] = $account_result['total']-$log['money'];
				$log['use_money'] = $account_result['use_money'];
				$log['no_use_money'] = $account_result['no_use_money']-$log['money'];
				$log['collection'] = $account_result['collection'];
				$log['to_user'] = $user_id;
				$log['remark'] = "Ͷ��ɹ����ÿ۳�";
				accountClass::AddLog($log);
				
				//��Ӵ��յĽ��
				$account_result =  accountClass::GetOne(array("user_id"=>$value['user_id']));
				$log['user_id'] = $value['user_id'];
				$log['type'] = "collection";
				$log['money'] = $value['repayment_account'];
				$log['total'] = $account_result['total']+$log['money'];
				$log['use_money'] = $account_result['use_money'];
				$log['no_use_money'] = $account_result['no_use_money'];
				$log['collection'] = $account_result['collection']+$log['money'];
				$log['to_user'] = $user_id;
				$log['remark'] = "���ս��";
				accountClass::AddLog($log);
				
				
				
				//��������
				$remind['nid'] = "loan_yes_account";
				$remind['sent_user'] = "0";
				$remind['receive_user'] = $value['user_id'];
				$remind['title'] = "Ͷ�ʵı�[<font color=red>{$borrow_name}</font>]������˳ɹ�";
				$remind['content'] = "����Ͷ�ʵı�[<a href=\'/invest/a{$data['id']}.html\' target=_blank><font color=red>{$borrow_name}</font></a>]��".date("Y-m-d",time())."�Ѿ����ͨ��";
				$remind['type'] = "system";
				remindClass::sendRemind($remind);
				
				
				
				$credit['nid'] = "invest_success";
				$result = creditClass::GetTypeOne(array("nid"=>$credit['nid']));
				$credit['user_id'] = $value['user_id'];
				$credit['value'] = round($value['account']/100);
				$credit['op_user'] = $_G['user_id'];;
				$credit['op'] = 1;//����
				$credit['type_id'] = $result['id'];
				$credit['remark'] = "Ͷ�ʳɹ���{$credit['value']}��";
				creditClass::UpdateCredit($credit);//���»���
				
				//����Ͷ���˵�Ͷ���Ļ�������
				$co_time = time()-$value['addtime'];
				$sql = " update `{borrow_collection}` set repay_time=repay_time+{$co_time} where tender_id='{$value['id']}'";
				$mysql ->db_query($sql);
			}
			
			//������ܽ�����ӡ�
			$account_result =  accountClass::GetOne(array("user_id"=>$user_id));
			$borrow_log['user_id'] = $user_id;
			$borrow_log['type'] = "borrow_success";
			$borrow_log['money'] = $borrow_account;
			$borrow_log['total'] =$account_result['total']+$borrow_log['money'];
			$borrow_log['use_money'] = $account_result['use_money']+$borrow_log['money'];
			$borrow_log['no_use_money'] = $account_result['no_use_money'];
			$borrow_log['collection'] = $account_result['collection'];
			$borrow_log['to_user'] = "0";
			$borrow_log['remark'] = "ͨ��[{$borrow_url}]�赽�Ŀ�";
			accountClass::AddLog($borrow_log);
			
			
			//�������ı�֤��10%��
			$account_result =  accountClass::GetOne(array("user_id"=>$user_id));
			$margin_log['user_id'] = $user_id;
			$margin_log['type'] = "margin";
			if ($is_vouch==1){
				$margin_log['money'] =$borrow_account*0.05;
			}else{
				$margin_log['money'] =$borrow_account*0.1;
			}
			$margin_log['total'] = $account_result['total'];
			$margin_log['use_money'] = $account_result['use_money']-$margin_log['money'];
			$margin_log['no_use_money'] = $account_result['no_use_money']+$margin_log['money'];
			$margin_log['collection'] = $account_result['collection'];
			$margin_log['to_user'] = "0";
			$margin_log['remark'] = "��������[{$borrow_url}]�ı�֤��";
			accountClass::AddLog($margin_log);
			//���±�֤��
			$sql = "update `{borrow}` set forst_account='{$margin_log['money']}' where id='{$id}'";
			$mysql -> db_query($sql);
			
			//�۳�2%��������
			if (isset($_G['system']["con_borrow_fee"]) && $_G['system']["con_borrow_fee"]!=""){
				$borrow_fee = $_G['system']["con_borrow_fee"];
			}else{
				$borrow_fee = 0.02;
			}
			if ($month_times>2){
				$money = round($borrow_account*$borrow_fee+($month_times-2)*0.002*$borrow_account,2);
			}else{
				$money = round($borrow_account*$borrow_fee,2);
			}
			$account_result =  accountClass::GetOne(array("user_id"=>$user_id));
			$fee_log['user_id'] = $user_id;
			$fee_log['type'] = "borrow_fee";
			$fee_log['money'] = $money;
			$fee_log['total'] = $account_result['total']-$fee_log['money'];
			$fee_log['use_money'] = $account_result['use_money']-$fee_log['money'];
			$fee_log['no_use_money'] = $account_result['no_use_money'];
			$fee_log['collection'] = $account_result['collection'];
			$fee_log['to_user'] = "0";
			$fee_log['remark'] = "���[{$borrow_url}]��������";
			accountClass::AddLog($fee_log);
			
			//���ɹ���1��
			
			
			/*
			
			$credit['nid'] = "borrow_success";
			$result = creditClass::GetTypeOne(array("nid"=>$credit['nid']));
			$credit['user_id'] = $user_id;
			$credit['value'] = 1;
			$credit['op_user'] = $_G['user_id'];
			$credit['op'] = 1;//����
			$credit['type_id'] = $result['id'];
			$credit['remark'] = "���ɹ���1��";
			creditClass::UpdateCredit($credit);//���»���
			*/
			
			
			//�ж�vip��Ա���Ƿ�۳�
		    accountClass::AccountVip(array("user_id"=>$user_id));
			
			//ֻ�е�һ�ν���ʱ��ſ۳�
			$sql = "select p1.invite_userid,p1.invite_money,p2.username  from `{user}` as p1 left join `{user}` as p2 on p1.invite_userid = p2.user_id where p1.user_id = '{$user_id}' ";
			$result = $mysql ->db_fetch_array($sql);
			if ($result['invite_userid']!="" && $result['invite_money']!="" && $result['invite_money']<=0){	
				//�����������
				$vip_ticheng = (!isset($_G['system']['con_vip_ticheng']) || $_G['system']['con_vip_ticheng']=="")?20:$_G['system']['con_vip_ticheng'];
				$account_result =  accountClass::GetOne(array("user_id"=>$result['invite_userid']));
				$ticheng_log['user_id'] = $result['invite_userid'];
				$ticheng_log['type'] = "ticheng";
				$ticheng_log['money'] = $vip_ticheng;
				$ticheng_log['total'] = $account_result['total']+$ticheng_log['money'];
				$ticheng_log['use_money'] = $account_result['use_money']+$ticheng_log['money'];
				$ticheng_log['no_use_money'] = $account_result['no_use_money'];
				$ticheng_log['collection'] = $account_result['collection'];
				$ticheng_log['to_user'] = "0";
				$ticheng_log['remark'] = "�����û�ע��(<a href=\'/u/{$result['invite_userid']}\' target=_blank>{$result['username']}</a>)��ΪVIP�����";
				accountClass::AddLog($ticheng_log);
				$sql = "update `{user}` set invite_money=$vip_ticheng where user_id='{$user_id}'";
				$mysql -> db_query($sql);
			}
			
			//��������ʱ�Ĳ�����
			$nowtime = time();
			$endtime = get_times(array("num"=>$month_times,"time"=>$nowtime));
			if ($style==1){
				$_each_time = "ÿ�����º�".date("d",$nowtime)."��";
			}else{
				$_each_time = "ÿ��".date("d",$nowtime)."��";
			}
			$sql = " update {borrow} set success_time='{$nowtime}',end_time='{$endtime}',each_time='{$_each_time}',payment_account='{$repayment_account}' where id='{$id}'";
			$mysql ->db_query($sql);
			
			
			
			//�ж��Ƿ��ǵ�����
			if ($is_vouch==1){
				
				$result = self::GetVouchList(array("limit"=>"all","borrow_id"=>$id));
				if ($result!=""){
					foreach ($result as $key => $value){
						$vouch_account = $value['account'];
						$vouch_userid = $value['user_id'];
						$vouch_id = $value['id'];
						$vouch_awa = round(($vouch_award*$value['account'])/100,2);
						$sql = "update `{borrow_vouch}` set status=1,award_fund='{$vouch_award}',award_account={$vouch_awa} where id = {$value['id']}";
						$mysql -> db_query($sql);
						
						//���ɹ��Ľ���5%��
						$account_result =  accountClass::GetOne(array("user_id"=>$value['user_id']));
						$vouch_log['user_id'] = $value['user_id'];
						$vouch_log['type'] = "vouch_award";
						$vouch_log['money'] = $vouch_awa;
						$vouch_log['total'] = $account_result['total']+$vouch_log['money'];
						$vouch_log['use_money'] = $account_result['use_money']+$vouch_log['money'];
						$vouch_log['no_use_money'] = $account_result['no_use_money'];
						$vouch_log['collection'] = $account_result['collection'];
						$vouch_log['to_user'] = "0";
						$vouch_log['remark'] = "���������[{$borrow_url}]���ɹ��Ľ���";
						accountClass::AddLog($vouch_log);
						
						//���ɹ��Ľ���֧����
						$account_result =  accountClass::GetOne(array("user_id"=>$user_id));
						$vouch_log['user_id'] = $user_id;
						$vouch_log['type'] = "vouch_awardpay";
						$vouch_log['money'] = $vouch_awa;
						$vouch_log['total'] = $account_result['total']-$vouch_log['money'];
						$vouch_log['use_money'] = $account_result['use_money']-$vouch_log['money'];
						$vouch_log['no_use_money'] = $account_result['no_use_money'];
						$vouch_log['collection'] = $account_result['collection'];
						$vouch_log['to_user'] = $value['user_id'];
						$vouch_log['remark'] = "���������[{$borrow_url}]���ɹ��Ľ���֧��";
						accountClass::AddLog($vouch_log);
						
						//�۳�Ͷ�ʵ����˵ĵ������
						//��Ӷ�ȼ�¼
						$amountlog_result = self::GetAmountOne($value["vouch_user"],"tender_vouch");
						$amountlog["user_id"] = $value["vouch_user"];
						$amountlog["type"] = "tender_vouch_add";
						$amountlog["amount_type"] = "tender_vouch";
						$amountlog["account"] = $value['vouch_account'];
						$amountlog["account_all"] = $amountlog_result['account_all'];
						$amountlog["account_use"] = $amountlog_result['account_use'] - $amountlog['account'];
						$amountlog["account_nouse"] = $amountlog_result['account_nouse'] + $amountlog['account']; 
						$amountlog["remark"] = "����������ͨ��";
						self::AddAmountLog($amountlog);
						
						
						//������������ӵ�vouch_collection������ȥ
						$_data['account'] = $vouch_account;
						$_data['year_apr'] = $month_times;
						$_vouch_account = round($vouch_account/$month_times,2);
						
						for ($i=0;$i<$month_times;$i++){
							if ($i==$month_times-1){
								$_vouch_account = $vouch_account - $_vouch_account*$i;
							}
							$repay_time = get_times(array("time"=>time(),"num"=>$i+1));
							$sql = "insert into `{borrow_vouch_collection}` set borrow_id={$value['borrow_id']},`addtime` = '".time()."',`addip` = '".ip_address()."',user_id=$vouch_userid ,`order` = {$i},vouch_id={$vouch_id},status=0,repay_account = '{$_vouch_account}',repay_time='{$repay_time}'";	
							$mysql->db_query($sql);
						}
					}
					
					$_borrow_account = round($borrow_account/$month_times,2);
					for ($i=0;$i<$month_times;$i++){
						if ($i==$month_times-1){
							$_borrow_account = $borrow_account - $_borrow_account*$i;
						}
						$repay_time = get_times(array("time"=>time(),"num"=>$i+1));
						$sql = "insert into `{borrow_vouch_repayment}` set borrow_id={$id},`addtime` = '".time()."',`addip` = '".ip_address()."',user_id=$user_id ,`order` = {$i},status=0,repay_account = '{$_borrow_account}',repay_time='{$repay_time}'";	
						$mysql->db_query($sql);
					}
				}
				//�۳��������
				//��Ӷ�ȼ�¼
				$amountlog_result = self::GetAmountOne($user_id,"borrow_vouch");
				$amountlog["user_id"] = $user_id;
				$amountlog["type"] = "borrow_vouch_success";
				$amountlog["amount_type"] = "borrow_vouch";
				$amountlog["account"] = $borrow_account;
				$amountlog["account_all"] = $amountlog_result['account_all'];
				$amountlog["account_use"] = $amountlog_result['account_use'] - $amountlog['account'];
				$amountlog["account_nouse"] = $amountlog_result['account_nouse'] + $amountlog['account']; 
				$amountlog["remark"] = "����������ͨ����ȥ�������";
				self::AddAmountLog($amountlog);
				
			}else{
				//�۳�������ö��
				
				//��Ӷ�ȼ�¼
				$amountlog_result = self::GetAmountOne($user_id,"credit");
				$amountlog["user_id"] = $user_id;
				$amountlog["type"] = "borrow_success";
				$amountlog["amount_type"] = "credit";
				$amountlog["account"] = $borrow_account;
				$amountlog["account_all"] = $amountlog_result['account_all'];
				$amountlog["account_use"] = $amountlog_result['account_use'] - $amountlog['account'];
				$amountlog["account_nouse"] = $amountlog_result['account_nouse'] + $amountlog['account']; 
				$amountlog["remark"] = "�����������ͨ����������ö�ȼ���";
				self::AddAmountLog($amountlog);
			}
			
			//��������
			$remind['nid'] = "borrow_review_yes";
			$remind['sent_user'] = "0";
			$remind['receive_user'] = $user_id;
			$remind['title'] = "�б�[{$borrow_name}]������˳ɹ�";
			$remind['content'] = "��Ľ���[{$borrow_url}]��".date("Y-m-d",time())."�Ѿ����ͨ��";
			$remind['type'] = "system";
			remindClass::sendRemind($remind);
			
		}
		
		//�������ʧ��
		elseif ($status == 4){
			//��������Ͷ���ߵĽ�Ǯ��
			
			
			$sql = "select * from {borrow_tender}  where borrow_id=$id";
			$result = $mysql->db_fetch_arrays($sql);
			foreach ($result as $key => $value){
				$account_result =  accountClass::GetOne(array("user_id"=>$value['user_id']));
				$log['user_id'] = $value['user_id'];
				$log['type'] = "invest_false";
				$log['money'] = $value['account'];
				$log['total'] = $account_result['total'];
				$log['use_money'] = $account_result['use_money']+$log['money'];
				$log['no_use_money'] = $account_result['no_use_money']-$log['money'];
				$log['collection'] = $account_result['collection'];
				$log['to_user'] = $user_id;
				$log['remark'] = "�б�[{$borrow_url}]ʧ�ܷ��ص�Ͷ���";
				accountClass::AddLog($log);
				
				
				//��������
				$remind['nid'] = "loan_no_account";
				$remind['sent_user'] = "0";
				$remind['receive_user'] = $value['user_id'];
				$remind['title'] = "Ͷ�ʵı�[<font color=red>{$borrow_name}</font>]�������ʧ��";
				$remind['content'] = "����Ͷ�ʵı�[<a href=\'/invest/a{$data['id']}.html\' target=_blank><font color=red>{$borrow_name}</font></a>]��".date("Y-m-d",time())."���ʧ��,ʧ��ԭ��{$data['repayment_remark']}";
				$remind['type'] = "system";
				remindClass::sendRemind($remind);
				
				
			}
			
			//��������
			$remind['nid'] = "borrow_review_no";
			$remind['sent_user'] = "0";
			$remind['receive_user'] = $user_id;
			$remind['title'] = "��������ı�[<font color=red>{$borrow_name}</font>]�������ʧ��";
			$remind['content'] = "��������ı�[<a href=\'/invest/a{$data['id']}.html\' target=_blank><font color=red>{$borrow_name}</font></a>]��".date("Y-m-d",time())."���ʧ��,ʧ��ԭ��{$data['repayment_remark']}";
			$remind['type'] = "system";
			remindClass::sendRemind($remind);
			
			
			
		}
		
		//��������ý��������б�ɹ�������ʧ��Ҳ����
		if ($award==1 || $award==2){
			if ($status == 3 || $is_false==1){
				$sql = "select * from {borrow_tender}  where borrow_id=$id";
				$result = $mysql->db_fetch_arrays($sql);
				foreach ($result as $key => $value){
					//Ͷ�꽱���۳������ӡ�
					if ($award==1){
						$money = round(($value['account']/$borrow_account)*$part_account,2);
					}elseif ($award==2){
						$money = round((($funds/100)*$value['account']),2);
					}
					
					$account_result =  accountClass::GetOne(array("user_id"=>$value['user_id']));
					$log['user_id'] = $value['user_id'];
					$log['type'] = "award_add";
					$log['money'] = $money;
					$log['total'] = $account_result['total']+$money;
					$log['use_money'] = $account_result['use_money']+$money;
					$log['no_use_money'] = $account_result['no_use_money'];
					$log['collection'] = $account_result['collection'];
					$log['to_user'] = $user_id;
					$log['remark'] = "���[{$borrow_url}]�Ľ���";
					accountClass::AddLog($log);
					
					$account_result =  accountClass::GetOne(array("user_id"=>$user_id));
					$log['user_id'] = $user_id;
					$log['type'] = "award_lower";
					$log['money'] = $money;
					$log['total'] = $account_result['total']-$money;
					$log['use_money'] = $account_result['use_money']-$money;
					$log['no_use_money'] = $account_result['no_use_money'];
					$log['collection'] = $account_result['collection'];
					$log['to_user'] = $value['user_id'];
					$log['remark'] = "�۳����[{$borrow_url}]�Ľ���";
					accountClass::AddLog($log);
				}
			}
		}
		//��������ʱ�Ĳ�����
		$sql = " update {borrow} set repayment_user='{$data['repayment_user']}',repayment_account='{$total_account}',repayment_remark='{$data['repayment_remark']}',repayment_time='".time()."',status='{$data['status']}' where id='{$id}'";
		return $mysql ->db_query($sql);
	}
	
	
	public static function EqualInterest ($data = array()){	
		if (isset($data['borrow_style']) && $data['borrow_style']!=""){
			$borrow_style = $data['borrow_style'];
		}else{
			$borrow_style = 0;
		}
		
		if ($borrow_style==0){
			return self::EqualMonth($data);
		}elseif ($borrow_style==1){
			return self::EqualSeason($data);
		}elseif ($borrow_style==2){
			return self::EqualEnd($data);
		}elseif ($borrow_style==3){
			return self::EqualEndMonth($data);
		}
	
	}
	
	//�ȶϢ��
	//�����������ʡ���1+�����ʣ���������/[��1+�����ʣ���������-1] 
	//a*[i*(1+i)^n]/[(1+I)^n-1] 
	//��a��i��b������1��i��
	public static function EqualMonth ($data = array()){
		if (isset($data['account']) && $data['account']>0){
			$account = $data['account'];
		}else{
			return "";
		}
		
		if (isset($data['year_apr']) && $data['year_apr']>0){
			$year_apr = $data['year_apr'];
		}else{
			return "";
		}
		
		if (isset($data['month_times']) && $data['month_times']>0){
			$month_times = $data['month_times'];
		}
		if (isset($data['borrow_time']) && $data['borrow_time']>0){
			$borrow_time = $data['borrow_time'];
		}else{
			$borrow_time = time();
		}
		$month_apr = $year_apr/(12*100);
		$_li = pow((1+$month_apr),$month_times);
		$repayment = round($account * ($month_apr * $_li)/($_li-1),2);
		$_result = array();
		if (isset($data['type']) && $data['type']=="all"){
			$_result['repayment_account'] = $repayment*$month_times;
			$_result['monthly_repayment'] = $repayment;
			$_result['month_apr'] = round($month_apr*100,2);
		}else{
			//$re_month = date("n",$borrow_time);
			for($i=0;$i<$month_times;$i++){
				if ($i==0){
					$interest = round($account*$month_apr,2);
				}else{
					$_lu = pow((1+$month_apr),$i);
					$interest = round(($account*$month_apr - $repayment)*$_lu + $repayment,2);
				}
				$_result[$i]['repayment_account'] = $repayment;
				$_result[$i]['repayment_time'] = get_times(array("time"=>$borrow_time,"num"=>$i+1));
				$_result[$i]['interest'] = $interest;
				$_result[$i]['capital'] = $repayment-$interest;
			}
		}
		return $_result;
	}
	
	//�����ȶϢ��
	 function EqualSeason ($data = array()){
	 	
		//��������
		if (isset($data['month_times']) && $data['month_times']>0){
			$month_times = $data['month_times'];
		}
		
		//������������Ǽ��ı���
		if ($month_times%3!=0){
			return false;
		}
	 
	 	//�����ܽ��
		if (isset($data['account']) && $data['account']>0){
			$account = $data['account'];
		}else{
			return "";
		}
		
		//����������
		if (isset($data['year_apr']) && $data['year_apr']>0){
			$year_apr = $data['year_apr'];
		}else{
			return "";
		}
		
		
		//����ʱ��
		if (isset($data['borrow_time']) && $data['borrow_time']>0){
			$borrow_time = $data['borrow_time'];
		}else{
			$borrow_time = time();
		}
		
		//������
		$month_apr = $year_apr/(12*100);
		
		//�õ��ܼ���
		$_season = $month_times/3;
		
		//ÿ��Ӧ���ı���
		$_season_money = round($account/$_season,2);
		
		//$re_month = date("n",$borrow_time);
		$_yes_account = 0 ;
		$repayment_account = 0;//�ܻ����
		for($i=0;$i<$month_times;$i++){
			$repay = $account - $_yes_account;//Ӧ���Ľ��
			
			$interest = round($repay*$month_apr,2);//��Ϣ����Ӧ������������
			$repayment_account = $repayment_account+$interest;//�ܻ����+��Ϣ
			$capital = 0;
			if ($i%3==2){
				$capital = $_season_money;//����ֻ�ڵ������»���������ڽ���������
				$_yes_account = $_yes_account+$capital;
				$repay = $account - $_yes_account;
				$repayment_account = $repayment_account+$capital;//�ܻ����+����
			}
			
			$_result[$i]['repayment_account'] = $interest+$capital;
			$_result[$i]['repayment_time'] = get_times(array("time"=>$borrow_time,"num"=>$i+1));
			$_result[$i]['interest'] = $interest;
			$_result[$i]['capital'] = $capital;
		}
		if (isset($data['type']) && $data['type']=="all"){
			$_resul['repayment_account'] = $repayment_account;
			$_resul['monthly_repayment'] = round($repayment_account/$_season,2);
			$_resul['month_apr'] = round($month_apr*100,2);
			return $_resul;
		}else{
			return $_result;
		}
	}
	
	
	//���ڸ���
	 function EqualEnd ($data = array()){
	 	
		//��������
		if (isset($data['month_times']) && $data['month_times']>0){
			$month_times = $data['month_times'];
		}
		
	 
	 	//�����ܽ��
		if (isset($data['account']) && $data['account']>0){
			$account = $data['account'];
		}else{
			return "";
		}
		
		//����������
		if (isset($data['year_apr']) && $data['year_apr']>0){
			$year_apr = $data['year_apr'];
		}else{
			return "";
		}
		
		
		//����ʱ��
		if (isset($data['borrow_time']) && $data['borrow_time']>0){
			$borrow_time = $data['borrow_time'];
		}else{
			$borrow_time = time();
		}
		
		//������
		$month_apr = $year_apr/(12*100);
		
		$interest = $month_apr*$month_times*$account;
		if (isset($data['type']) && $data['type']=="all"){
			$_resul['repayment_account'] = $account+$interest;
			$_resul['monthly_repayment'] = $account+$interest;
			$_resul['month_apr'] = $month_apr;
			return $_resul;
		}else{
			$_result[0]['repayment_account'] = $account+$interest;
			$_result[0]['repayment_time'] = get_times(array("time"=>$borrow_time,"num"=>$month_times));
			$_result[0]['interest'] = $interest;
			$_result[0]['capital'] = $account;
			return $_result;
		}
	}
	
	
	//���ڻ��������¸�Ϣ
	 function EqualEndMonth ($data = array()){
	 	
		//��������
		if (isset($data['month_times']) && $data['month_times']>0){
			$month_times = $data['month_times'];
		}
	 
	 	//�����ܽ��
		if (isset($data['account']) && $data['account']>0){
			$account = $data['account'];
		}else{
			return "";
		}
		
		//����������
		if (isset($data['year_apr']) && $data['year_apr']>0){
			$year_apr = $data['year_apr'];
		}else{
			return "";
		}
		
		
		//����ʱ��
		if (isset($data['borrow_time']) && $data['borrow_time']>0){
			$borrow_time = $data['borrow_time'];
		}else{
			$borrow_time = time();
		}
		
		//������
		$month_apr = $year_apr/(12*100);
		
		
		
		//$re_month = date("n",$borrow_time);
		$_yes_account = 0 ;
		$repayment_account = 0;//�ܻ����
		
		$interest = round($account*$month_apr,2);//��Ϣ����Ӧ������������
		for($i=0;$i<$month_times;$i++){
			$capital = 0;
			if ($i+1 == $month_times){
				$capital = $account;//����ֻ�ڵ������»���������ڽ���������
			}
			
			$_result[$i]['repayment_account'] = $interest+$capital;
			$_result[$i]['repayment_time'] = get_times(array("time"=>$borrow_time,"num"=>$i+1));
			$_result[$i]['interest'] = $interest;
			$_result[$i]['capital'] = $capital;
		}
		if (isset($data['type']) && $data['type']=="all"){
			$_resul['repayment_account'] = $account + $interest*$month_times;
			$_resul['monthly_repayment'] = $interest;
			$_resul['month_apr'] = round($month_apr*100,2);
			return $_resul;
		}else{
			return $_result;
		}
	}
	
	
	//��ȡ�����ܶ�
	//�û�id
	function GetWaitPayment($data){
		global $mysql;
		//�����ܶ�
		$user_id= $data['user_id'];
		$sql = "select status,count(1) as repay_num,sum(repayment_account) as borrow_num ,sum(capital) as capital_num ,sum(repayment_yesaccount) as borrow_yesnum from `{borrow_repayment}` where borrow_id in (select id from `{borrow}` where user_id = {$user_id} and status=3) group by status ";
		$result = $mysql -> db_fetch_arrays($sql);
		$_result['wait_payment'] = $_result['borrow_yesnum'] = 0;
		foreach ($result as $key => $value){
			if ($value['status']==0 ){
				$_result['borrow_num0'] = $value['borrow_num'];
				$_result['borrow_capital_num0'] +=$value['capital_num'];//���Ľ��
				$_result['borrow_repay0'] = $value['repay_num'];
			}elseif ($value['status']==2){//��վ����
				$_result['borrow_yesnum'] = $value['borrow_yesnum'];
				$_result['borrow_num2'] = $value['borrow_num'];
			}elseif ($value['status']==1){
				$_result['borrow_yesnum'] = $value['borrow_yesnum'];
				$_result['borrow_num1'] = $value['borrow_num'];
			}
			$_result['borrow_capital_num'] +=$value['capital_num'];//���Ľ��
		}
		$_result['wait_payment'] = $_result['borrow_num0']+$_result['borrow_num2'];//�������
		$_result['borrow_num'] =$_result['borrow_num0']+$_result['borrow_num1']+$_result['borrow_num2'];//����ܶ�
		$_result['use_amount'] = $_result['amount']-$_result['wait_payment'];//���ö��
		return $_result;
		
	}
	
	
	//�ѳɹ��Ľ��
	function GetBorrowSucces($data){
		global $mysql,$_G;
		$user_id =$data['user_id'];
		$page = empty($data['page'])?1:$data['page'];
		$epage = empty($data['epage'])?10:$data['epage'];
		$_sql = "";
		if (isset($data['type']) && $data['type']!=""){
			if ($data['type']=="wait"){
				$_sql = " and bt.repayment_yesaccount!=bt.repayment_account";
			}elseif ($data['type']=="yes"){
				$_sql = " and bt.repayment_yesaccount=bt.repayment_account ";
			}
		}
		$_select  = "bt.repayment_yesaccount,bt.repayment_account,bt.addtime as tender_time,bt.account as anum,bt.repayment_account  - bt.account as inter,bo.name as borrow_name,bo.account,bo.time_limit,bo.apr,u.username,cr.value as credit,bo.id ";
		$sql = "select SELECT from `{borrow_tender}` as bt,`{borrow}` as bo,`{user}` as u,`{credit}` as cr where bt.user_id={$user_id} and bo.user_id=u.user_id  and cr.user_id=bo.user_id and bt.borrow_id=bo.id and bo.status=3 {$_sql} ";		 
		//�Ƿ���ʾȫ������Ϣ
		if (isset($data['limit']) ){
			$_limit = "";
			if ($data['limit'] != "all"){
				$_limit = "  limit ".$data['limit'];
			}
			return $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,  'order by p1.`order` desc,p1.id desc', $_limit), $sql));
		}	
		
		$row = $mysql->db_fetch_array(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array("count(*) as  num","",""),$sql));
		
		$total = $row['num'];
		$total_page = ceil($total / $epage);
		$index = $epage * ($page - 1);
		$limit = " limit {$index}, {$epage}";
		
		$list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select, 'order by p1.id desc', $limit), $sql));		
		$list = $list?$list:array();
		return array(
            'list' => $list,
            'total' => $total,
            'page' => $page,
            'epage' => $epage,
            'total_page' => $total_page
        );
	}
	
	//�տ���ϸ
	function GetCollectionList($data){
		global $mysql,$_G;
		$_sql = " ";
		$__sql = " ";
		if (isset($data['user_id']) && $data['user_id']!="" ){
			$__sql .= " where user_id={$data['user_id']}";
		}
		if (isset($data['status']) && $data['status']!="" ){
			$_sql .= " and p1.status={$data['status']}";
		}
		if (isset($data['borrow_status']) && $data['borrow_status']!="" ){
			$_sql .= " and p3.status={$data['borrow_status']}";
		}
		if (isset($data['username']) && $data['username']!="" ){
			$_sql .= " and p4.username like '%{$data['username']}%' ";
		}
		$page = empty($data['page'])?1:$data['page'];
		$epage = empty($data['epage'])?10:$data['epage'];
		/*
		$_select = 'p1.*,p3.name as borrow_name,p3.id as borrow_id,p3.time_limit,p4.username ';
		$sql = "select SELECT from `{borrow_collection}` as p1 
				left join `{borrow_tender}` as p2 on  p1.tender_id = p2.id
				left join `{borrow}` as p3 on  p3.id = p2.borrow_id
				left join `{user}` as p4 on  p4.user_id = p3.user_id
				where p3.status=3  and p3.id in (select borrow_id from `{borrow_tender}` {$__sql})
				$_sql ORDER LIMIT";
			*/
		$_select = 'p1.*,p3.name as borrow_name,p3.id as borrow_id,p3.time_limit,p4.username ';
		$_order = " order by p1.id ";
		if (isset($data['order']) && $data['order']!="" ){
			if ($data['order'] == "repay_time"){
				$_order = " order by p1.repay_time asc ";
			}elseif ($data['order'] == "order"){
				$_order = " order by p1.`order` desc,p1.id desc ";
			}
		}
		$sql = "select SELECT from `{borrow_collection}` as p1 
				left join `{borrow_tender}` as p2 on  p1.tender_id = p2.id
				left join `{borrow}` as p3 on  p3.id = p2.borrow_id
				left join `{user}` as p4 on  p4.user_id = p3.user_id
				where p1.tender_id in (select id from `{borrow_tender}`{$__sql})
			   {$_sql} ORDER LIMIT";
				 
		//�Ƿ���ʾȫ������Ϣ
		if (isset($data['limit']) ){
			$_limit = "";
			if ($data['limit'] != "all"){
				$_limit = "  limit ".$data['limit'];
			}
			$list  = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,  $_order, $_limit), $sql));
			foreach ($list as $key => $value){
				$late = self::LateInterest(array("repayment_time"=>$value['repay_time'],"account"=>$value['capital']));
				if ($value['status']!=1){
					$list[$key]['late_days'] = $late['late_days'];
					if ($late['late_days']>30){
						$list[$key]['late_interest'] = 0;
					}else{
						$list[$key]['late_interest'] = round($late['late_interest']/2,2);
					}
				}else{
					$list[$key]['late_interest'] = 0;
					$list[$key]['late_days'] = 0;
				}
			}
			return $list;
		}	
		
		$row = $mysql->db_fetch_array(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array(" count(*) as num ","",""),$sql));
		
		$total = $row['num'];
		$total_page = ceil($total / $epage);
		$index = $epage * ($page - 1);
		$limit = " limit {$index}, {$epage}";
		
		$list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select, $_order , $limit), $sql));		
		$list = $list?$list:array();
		foreach ($list as $key => $value){
			$late = self::LateInterest(array("repayment_time"=>$value['repay_time'],"account"=>$value['capital']));
			if ($value['status']!=1){
				$list[$key]['late_days'] = $late['late_days'];
				if ($late['late_days']>30){
					$list[$key]['late_interest'] = 0;
				}else{
					$list[$key]['late_interest'] = round($late['late_interest']/2,2);
				}
			}else{
				$list[$key]['late_interest'] = 0;
				$list[$key]['late_days'] = 0;
			}
		}
		return array(
            'list' => $list,
            'total' => $total,
            'page' => $page,
            'epage' => $epage,
            'total_page' => $total_page
        );
	}
	
	
	function GetBorrowAll($data=array()){
		global $mysql;
		$user_id = $data['user_id'];
		$sql = "select * from `{borrow}` where user_id = {$user_id}";
		$result = $mysql->db_fetch_arrays($sql);
		$_result['success'] = $_result['false'] =  $_result['wait'] = $_result['pay_success'] = $_result['pay_advance'] = $_result['pay_expired'] = 0; 
		foreach ($result as $key => $value){
			if ($value['status']==3){
				$_result['success'] ++;
			}
			if ($value['status']==3 && $value['repayment_account']!=$value['repayment_yesaccount']){
				$_result['wait'] ++;
			}
			if ($value['status']==0 || $value['status']==4){
				$_result['false'] ++;
			}
		}
		$sql = "select * from `{borrow_repayment}` where borrow_id in (select id from `{borrow}` where user_id = {$user_id} and status=3)";
		$result = $mysql->db_fetch_arrays($sql);
		foreach ($result as $key => $value){
			//�ѻ���δ����
			if ($value['status']==1 && $value['repayment_time']<$value['repayment_yestime']){
				$_result['pay_success'] ++;
			}
			//�ѻ������
			if ($value['status']==1 && $value['repayment_time']>$value['repayment_yestime']){
				$_result['pay_expired'] ++;
			}
			//����δ��
			if (($value['status']==0 || $value['status']==2 ) &&  date("Ymd",$value['repayment_time'])<date("Ymd",time())){
				$_result['pay_expiredno'] ++;
			}
			//�����ѻ�
			if ($value['status']==1 && date("Ymd",$value['repayment_time'])<date("Ymd",$value['repayment_yestime'])){
				$_result['pay_expiredyes'] ++;
			}
			//��ǰ����
			if ($value['status']==1 && $value['repayment_time']-$value['repayment_yestime']>60*60*24*15){
				$_result['pay_advance'] ++;
			}
			//30��֮�ڵ����ڻ���
			if ($value['status']==1 && $value['repayment_yestime']-$value['repayment_time']>60*60*24*30){
				$_result['pay_expired30'] ++;
			}
			//30��֮�ڵ����ڻ��� 
			if ($value['status']==1 && $value['repayment_yestime']-$value['repayment_time']>60*60*24*15 && $value['repayment_yestime']-$value['repayment_time']<60*60*24*30){
				$_result['pay_expired30in'] ++;
			}
		}
		return $_result;	
	}
	
	function GetAll($data=array()){
		global $mysql;
		$sql = "select sum(account) as sum from `{borrow}`";
		$result = $mysql->db_fetch_array($sql);
		$_result['borrow_all'] = $result['sum'];
		
		$sql = "select sum(account) as sum from `{borrow}` where status=3";
		$result = $mysql->db_fetch_array($sql);
		$_result['borrow_yesall'] = $result['sum'];
		
		
		$sql = "select count(account) as num from `{borrow}`";
		$result = $mysql->db_fetch_array($sql);
		$_result['borrow_times'] = $result['num'];
		
		$sql = "select count(account) as num from `{borrow}` where status=3";
		$result = $mysql->db_fetch_array($sql);
		$_result['borrow_yestimes'] = $result['num'];
		
		return $_result;
	}
	
	function ActionLiubiao($data){
		global $mysql;
		$status= $data['status'];
		if ($status==1){
			$result = self::Cancel($data);
		}elseif($status==2){
			$valid_time = $data['days'];
			$sql = "update `{borrow}` set valid_time=valid_time +{$valid_time} where id={$data['id']}";
			$mysql->db_query($sql);
		}
		return true;
	}
	
	
	//���ڻ����б�
	function GetLateList($data = array()){
		global $mysql,$_G;
		
		$page = (!isset($data['page']) || $data['page']=="")?1:$data['page'];
		$epage = (!isset($data['epage']) || $data['epage']=="")?10:$data['epage'];
		
		$_select = 'p1.*,p3.*';
		$_order = " order by p1.id ";
		if (isset($data['late_day']) && $data['late_day']!=""){
			$_repayment_time = time()-60*60*24*$data['late_day'];
		}else{
			$_repayment_time = time();
		}
		
		$_sql = " where p1.repayment_time < '{$_repayment_time}' and p1.status!=1 and p1.borrow_id>0";
		$sql = "select SELECT from `{borrow_repayment}` as p1 
				left join `{borrow}` as p2 on p1.borrow_id=p2.id
				left join `{user}` as p3 on p2.user_id=p3.user_id
			   {$_sql} ORDER LIMIT";
				 
		
		$_list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select, $_order , ""), $sql));	
			
		foreach ($_list as $key => $value){
			$late = self::LateInterest(array("repayment_time"=>$value['repayment_time'],"account"=>$value['capital']));
			$list[$value['user_id']]['realname'] = $value['realname'];
			$list[$value['user_id']]['phone'] = $value['phone'];
			$list[$value['user_id']]['user_id'] = $value['user_id'];
			$list[$value['user_id']]['email'] = $value['email'];
			$list[$value['user_id']]['qq'] = $value['qq'];
			$list[$value['user_id']]['sex'] = $value['sex'];
			$list[$value['user_id']]['card_id'] = $value['card_id'];
			$list[$value['user_id']]['area'] = $value['area'];
			$list[$value['user_id']]['late_days'] += $late['late_days'];//����������
			if ($list[$value['user_id']]['late_numdays']<$late['late_days']){
				$list[$value['user_id']]['late_numdays'] =  $late['late_days'];
			}
			$list[$value['user_id']]['late_interest'] += round($late['late_interest']/2,2);
			$list[$value['user_id']]['late_account'] +=  $value['repayment_account'];//�����ܽ��
			$list[$value['user_id']]['late_num'] ++;//���ڱ���
			if ($value['webstatus']==1){
				$list[$value['user_id']]['late_webnum'] +=1;//���ڱ���
			}
			
		}
		//�Ƿ���ʾȫ������Ϣ
		if (isset($data['limit']) ){
			if (count($list)>0){
			return array_slice ($list,0,$data['limit']);
			}else{
			return array();
			}
		}	
		
		$total = count($list);
		$total_page = ceil($total / $epage);
		$index = $epage * ($page - 1);
		if (is_array($list)){
		$list = array_slice ($list,$index,$epage);
		}
		return array(
            'list' => $list,
            'total' => $total,
            'page' => $page,
            'epage' => $epage,
            'total_page' => $total_page
        );
	
	}
	
	
	//�ҵĿͻ��б�
	function GetMyuserList($data = array()){
		global $mysql,$_G;
		
		$page = (!isset($data['page']) || $data['page']=="")?1:$data['page'];
		$epage = (!isset($data['epage']) || $data['epage']=="")?10:$data['epage'];
		
		$_select = 'p1.*,p2.realname,p2.username';
		$_order = " order by p1.id ";
		$_sql = "";
		if (isset($data['suser_id']) && $data['suser_id']!=""){
			$_sql .= " and p1.user_id='{$data['suser_id']}'";
		}
		$sql = "select SELECT from `{borrow}` as p1 left join `{user}` as p2 on p1.user_id=p2.user_id where p1.user_id in (select user_id from `{user_cache}` where kefu_userid = '{$data['user_id']}')   {$_sql} ORDER LIMIT";
				 
		//�Ƿ���ʾȫ������Ϣ
		if (isset($data['limit']) && $data['limit']!="" ){
			$_limit = "";
			if ($data['limit'] != "all"){
				$_limit = "  limit ".$data['limit'];
			}
			return $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,  'order by p1.`order` desc,p1.id desc', $_limit), $sql));
		}	
		
		$row = $mysql->db_fetch_array(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array("count(*) as  num","",""),$sql));
		
		$total = $row['num'];
		$total_page = ceil($total / $epage);
		$index = $epage * ($page - 1);
		$limit = " limit {$index}, {$epage}";
		
		$list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select, 'order by p1.id desc', $limit), $sql));		
		$list = $list?$list:array();
		return array(
            'list' => $list,
            'total' => $total,
            'page' => $page,
            'epage' => $epage,
            'total_page' => $total_page
        );
	
	}
	
	//ͳ��
	function GetMyuserAcount($data = array()){
		global $mysql,$_G;
		$user_id = $data['user_id'];
		
		//��һ�����ȶ�ȡ���ͷ�������û�
		$sql = "select user_id from `{user_cache}` where kefu_userid = {$user_id}";
		$result = $mysql->db_fetch_arrays($sql);
		if ($result!=""){
			foreach ($result as $key => $value){
				$_result[] = $value["user_id"];
			}
			$_fuserid = join(",",$_result);
		}
		$_first_month = strtotime("2010-08-01");
		$_now_year = date("Y",time());
		$_now_month = date("n",time());
		$month = ($_now_year-2011)*12 + 5+$_now_month;//���ڵ�����
		
		//�ɹ����
		for ($i=1;$i<=$month;$i++){
			$up_month = strtotime("$i month",$_first_month);
			$now_month = strtotime("-1 month",$up_month);
			$nowlast_day = strtotime("-1 day",$up_month);
			
			$sql = "select sum(money) as num_money from `{account_log}` where user_id in ($_fuserid) and type='borrow_success' and addtime >= {$now_month} and addtime < {$nowlast_day}";
			$result = $mysql->db_fetch_array($sql);
			if ($result["num_money"]!=""){
				$_resul[date("Y-n",$now_month)]["borrow"] = $result["num_money"];
			}
			
			$sql = "select sum(money) as num_money from `{account_log}` where user_id in ($_fuserid) and type='invest' and addtime >= {$now_month} and addtime < {$nowlast_day}";
			$result = $mysql->db_fetch_array($sql);
			if ($result["num_money"]!=""){
				$_resul[date("Y-n",$now_month)]["tender"] = $result["num_money"];
			}
			
			$sql = "select count(1) as num_vip from `{account_log}` where user_id in ($_fuserid) and type='vip' and addtime >= {$now_month} and addtime < {$nowlast_day}";
			$result = $mysql->db_fetch_array($sql);
			if ($result["num_vip"]>0){
				$_resul[date("Y-n",$now_month)]["vip"] = $result["num_vip"];
			}
			
		}
		
		arsort($_resul);
		
		return $_resul;
	}
	
	//ͳ��
	function Tongji($data = array()){
		global $mysql;
		
		//�ɹ����
		$sql = " select sum(account) as num from `{borrow}` where status=3 ";
		$result = $mysql->db_fetch_array($sql);
		$_result['success_num'] = $result['num'];
		
		//����δ����
		$_repayment_time = time();;
		$sql = " select p1.capital,p1.repayment_yestime,p1.repayment_time,p1.status  from  `{borrow_repayment}` as p1 left join `{borrow}` as p2 on p1.borrow_id=p2.id where p2.status=3 ";
		$result = $mysql->db_fetch_arrays($sql);
		foreach ($result as $key => $value){
			$_result['success_sum'] += $value['capital'];//����ܶ�
			if ($value['status']==1){
				$_result['success_num1'] += $value['capital'];//�ɹ������ܶ�
				if (date("Ymd",$value['repayment_time']) < date("Ymd",$value['repayment_yestime'])){	
					$_result['success_laterepay'] += $value['capital'];
				}
			}
			if ($value['status']==0){
				$_result['success_num0'] += $value['capital'];//δ�����ܶ�
				if (date("Ymd",$value['repayment_time']) < date("Ymd",time())){	
					$_result['false_laterepay'] += $value['capital'];
				}
			}
		}
		$_result['laterepay'] = $_result['success_laterepay'] + $_result['false_laterepay'];
		
		return $_result;
	}
	
	
	
}
?>