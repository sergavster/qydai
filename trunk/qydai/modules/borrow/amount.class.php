<?
/*
1,�û�����ҳ�棬��Ҫ��ȡ���еĶ�ȣ�������borrow.class.php function GetUserLog

2,�û����� -�������ҳ��
*/
class amountClass{


	
	//��Ӷ�ȵļ�¼��user_amountlog��
	//user_id �û�id
	//type ���������� 
	//amount_type ��ȵ����� ��credit ���ö��  borrow_vouch �����  tender Ͷ�ʶ��
	//account  ��Ȳ����Ľ��
	//account_all �ܵĶ��
	//account_use ���ö��
	//account_nouse �����ö��
	//remark ��ȵļ�¼
	function  AddAmountLog($data){
		global $mysql;
		$user_id = $data['user_id'];
		if (!isset($user_id)) return -1;//����û������ڣ��򷵻�
		$sql = "insert into `{user_amountlog}` set `addtime` = '".time()."',`addip` = '".ip_address()."'";
		foreach($data as $key => $value){
			$sql .= ",`$key` = '$value'";
		}
        $result = $mysql->db_query($sql);
    	 
		//�����¼��ӳɹ�������Ӧ�ĸı���Ϣ
		if ($result == true){
			$_data["user_id"] = $user_id;
			if ($data['amount_type'] == "credit"){
				$_data["credit"] = $data['account_all'];
				$_data["credit_use"] = $data['account_use'];
				$_data["credit_nouse"] = $data['account_nouse'];
			}
			elseif ($data['amount_type'] == "borrow_vouch"){
				$_data["borrow_vouch"] = $data['account_all'];
				$_data["borrow_vouch_use"] = $data['account_use'];
				$_data["borrow_vouch_nouse"] = $data['account_nouse'];
			}
			elseif ($data['amount_type'] == "tender_vouch"){
				$_data["tender_vouch"] = $data['account_all'];
				$_data["tender_vouch_use"] = $data['account_use'];
				$_data["tender_vouch_nouse"] = $data['account_nouse'];
			}
			self::UpdateAmount($_data);
			return 1;
		}
	}
	
	//����û��Ķ�ȣ�user_amount��
	//user_id �û�id 
	function GetAmountOne($user_id,$type = ""){
		global $mysql;
		if (!isset($user_id)) return -1;//����û������ڣ��򷵻�
		$sql = "select * from `{user_amount}` where user_id={$user_id}";
		$result = $mysql ->db_fetch_array($sql);
		if ($result == false){
			self::AddAmount($user_id);//��Ӽ�¼
			return self::GetAmountOne($user_id);
		}
		if ($type!=""){
			if ($type == "credit"){
				$result['account_all'] = $result["credit"];
				$result['account_use'] = $result["credit_use"];
				$result['account_nouse'] = $result["credit_nouse"];
			}
			elseif ($type == "borrow_vouch"){
				$result['account_all'] = $result["borrow_vouch"];
				$result['account_use'] = $result["borrow_vouch_use"];
				$result['account_nouse'] = $result["borrow_vouch_nouse"];
			}
			elseif ($type == "tender_vouch"){
				$result['account_all'] = $result["tender_vouch"];
				$result['account_use'] = $result["tender_vouch_use"];
				$result['account_nouse'] = $result["tender_vouch_nouse"];
			}
		}
		return $result;
	}
	
	//�����û��Ķ����Ϣ��user_amount��
	//user_id �û�id 
	function  UpdateAmount($data){
		global $mysql;
		$user_id = $data['user_id'];
		if (!isset($user_id)) return -1;//����û������ڣ��򷵻�
		
		self::AddAmount($user_id);//��Ӽ�¼
		
		$sql = "update `{user_amount}` set user_id={$user_id}";
		foreach($data as $key => $value){
			$sql .= ",`$key` = '$value'";
		}
		$sql .= " where user_id = {$user_id}";
        return $mysql->db_query($sql);
	}
	
	
	
	//����û��Ķ����Ϣ��user_amount��
	//user_id �û�id 
	function  AddAmount($user_id){
		global $mysql,$_G;
		if (!isset($user_id)) return -1;//����û������ڣ��򷵻�
		
		$credit = isset($_G['system']['con_user_amount'])?$_G['system']['con_user_amount']:2000;//��ʼ����Ͷ��
		$sql = "select * from `{user_amount}` where user_id={$user_id}";
		$result = $mysql ->db_fetch_array($sql);
		if ($result == false){
		$sql = "insert into `{user_amount}` set  user_id = {$user_id},credit ={$credit},credit_use ={$credit} ";
        return $mysql->db_query($sql);
		}
		return 1;
	}
	
	
	 /**
	 * ����û��Ķ�����루user_amountapply��
	 *
	 * @param Array $data
	 * @return Boolen
	 */
	function AddAmountApply($data = array()){
		global $mysql;
        $user_id = $data['user_id'];
		if (!isset($user_id)) return -1;//����û������ڣ��򷵻�
		
		//��ȡ������
		$result = self::GetAmountOne($user_id);
		if ($data['type'] == "credit"){
			$data["account_old"] = $result['credit'];
		}
		elseif ($data['type'] == "borrow_vouch"){
			$data["account_old"] = $result['borrow_vouch'];
		}
		elseif ($data['type'] == "tender_vouch"){
			$data["account_old"] = $result['tender_vouch'];
		}
		$sql = "insert into `{user_amountapply}` set `addtime` = '".time()."',`addip` = '".ip_address()."'";
		foreach($data as $key => $value){
			$sql .= ",`$key` = '$value'";
		}
        return $mysql->db_query($sql);
	}
	
	//����û��������¼��user_amountapply��
	//id id 
	//user_id �û�id 
	function GetAmountApplyOne($data){
		global $mysql;
		$sql = " where 1=1 ";
		if (isset($data['user_id'])){
			$sql .= " and p1.user_id={$data['user_id']}  ";
		}
		if (isset($data['id'])){
			$sql .= " and p1.id={$data['id']} ";
		}
		if (isset($data['type'])){
			$sql .= " and p1.type='{$data['type']}' ";
		}
		$sql = "select p1.*,p2.username from `{user_amountapply}` as  p1 left join `{user}` as p2 on p1.user_id=p2.user_id " . $sql ." order by p1.id desc";
		$result = $mysql ->db_fetch_array($sql);
		
		return $result;
	}
	
	/**
	 * �б�
	 *
	 * @return Array
	 */
	function GetAmountList($data = array()){
		global $mysql;
		
		$page = empty($data['page'])?1:$data['page'];
		$epage = empty($data['epage'])?10:$data['epage'];
		
		$_sql = "where 1=1 ";		 
		
		if (isset($data['status']) && $data['status']!=""){
			$_sql .= " and p1.status = {$data['status']}";
		}
		if (isset($data['user_id']) && $data['user_id']!=""){
			$_sql .= " and p1.user_id = {$data['user_id']}";
		}
		if (isset($data['username']) && $data['username']!=""){
			$_sql .= " and p2.username like '%{$data['username']}%' ";
		}
		if (isset($data['type']) && $data['type']!=""){
			$_sql .= " and p1.type like '%{$data['type']}%' ";
		}
		$_select = 'p1.*,p2.username';
		$sql = "select SELECT from {user_amount} as p1 
				left join {user} as p2 on p1.user_id=p2.user_id
				$_sql ORDER LIMIT";
				 
		//�Ƿ���ʾȫ������Ϣ
		if (isset($data['limit']) ){
			$_limit = "";
			if ($data['limit'] != "all"){
				$_limit = "  limit ".$data['limit'];
			}
			return $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,  'order by p1.`order` desc,p1.id desc', $_limit), $sql));
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
	
	
	
	function CheckAmountApply($data){
		global $mysql,$_G;
		
		$user_id = $data['user_id'];
		if (!isset($user_id)) return -1;//����û������ڣ��򷵻�
		
		$result = self::GetAmountApplyOne(array("id",$data['id']));//��ȡ��ȵ���Ϣ�����Ƿ��Ѿ�������
		
		/*
		if ($result['status']!=2){
			return "�˶���Ѿ�ͨ����ˣ��벻Ҫ�ظ�����";
		}
		*/
		
		if ($data['status']==1){
		
			//��Ӷ�ȼ�¼
			$_result = self::GetAmountOne($user_id,$data["type"]);
			$_data["user_id"] = $user_id;
			$_data["type"] = "apply_add";
			$_data["amount_type"] = $data['type'];
			$_data["account"] = $data['account'];
			$_data["account_all"] = $data['account'];
			$_data["account_use"] = $data['account'] - $_result['account_nouse'];
			$_data["account_nouse"] = $_result['account_nouse'];//type ���������� 
			$_data["remark"] = "���������ͨ��";//type ���������� 
			self::AddAmountLog($_data);
		}
		
		//������Ϣ
		$sql = "update `{user_amountapply}` set status={$data['status']},verify_time='".time()."',verify_user=".$_G['user_id'].",verify_remark='{$data['verify_remark']}',account_new='{$data['account']}' where id = {$data['id']}";
		$mysql ->db_query($sql);
		return 1;
	
	}
	
	
	/**
	 * �б�
	 *
	 * @return Array
	 */
	function GetAmountApplyList($data = array()){
		global $mysql;
		
		$page = empty($data['page'])?1:$data['page'];
		$epage = empty($data['epage'])?10:$data['epage'];
		
		$_sql = "where 1=1 ";		 
		
		if (isset($data['status']) && $data['status']!=""){
			$_sql .= " and p1.status = {$data['status']}";
		}
		if (isset($data['user_id']) && $data['user_id']!=""){
			$_sql .= " and p1.user_id = {$data['user_id']}";
		}
		if (isset($data['username']) && $data['username']!=""){
			$_sql .= " and p2.username like '%{$data['username']}%' ";
		}
		if (isset($data['type']) && $data['type']!=""){
			$_sql .= " and p1.type like '%{$data['type']}%' ";
		}
		$_select = 'p1.*,p2.username';
		$sql = "select SELECT from {user_amountapply} as p1 
				left join {user} as p2 on p1.user_id=p2.user_id
				$_sql ORDER LIMIT";
				 
		//�Ƿ���ʾȫ������Ϣ
		if (isset($data['limit']) ){
			$_limit = "";
			if ($data['limit'] != "all"){
				$_limit = "  limit ".$data['limit'];
			}
			return $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,  'order by p1.`order` desc,p1.id desc', $_limit), $sql));
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
}
?>