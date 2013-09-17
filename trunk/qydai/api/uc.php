<?php
/**
 * @author Tissot.Cai
 * @copyright �����н�����Ͷ�����޹�˾
 * @version 1.0
 */
 
require_once ROOT_PATH . '/modules/ucenter/config.inc.php';
require_once ROOT_PATH . '/modules/ucenter/uc_client/client.php';

class UcenterClient {

    public static $msg;
    
    /**
     * ע���û�
     * @param $user_name �û���
     * @param $password ����
     * @param $email ����
     */
    public static function regUser($user_name, $password, $email) {
        global $db_config;
		ob_start();
        mysql_select_db(UC_DBNAME);
        $u_id = uc_user_register($user_name, $password, $email);
        mysql_select_db($db_config['name']);
        if($u_id <= 0) {
            if($u_id == -1) {
                self::$msg = '�û������Ϸ�';
            }
            elseif($u_id == -2) {
                self::$msg = '����Ҫ����ע��Ĵ���';
            }
            elseif($u_id == -3) {
               self::$msg = '�û����Ѿ�����';
            }
            elseif($u_id == -4) {
                self::$msg = 'Email ��ʽ����';
            }
            elseif($u_id == -5) {
                self::$msg = 'Email ������ע��';
            }
            elseif($u_id == -6) {
                self::$msg = '�� Email �Ѿ���ע��';
            }
            else {
                self::$msg = $u_id;
            }
            return self::$msg ;
        }

        return $u_id;
    }
	
    /**
     * �û���¼
     * @param $user �û���
     * @param $password ����
     */
    public static function login ($user_name, $password) {
        global $db_config;
		ob_start();
        mysql_select_db(UC_DBNAME);
        list($u_id, $a, $b, $c) = uc_user_login($user_name, $password);
        mysql_select_db($db_config['name']);
        if($u_id <= 0) {
            if($u_id == -1) {
                self::$msg = '�û�������,���߱�ɾ��';
            } elseif($u_id == -2) {
                self::$msg = '�������';
            } else {
                self::$msg = 'δ����';
            }
            return false;
        }
		ob_end_flush();
		echo str_repeat(' ',256);
		set_time_limit(0);
		$result =  uc_user_synlogin($u_id);
		//var_dump($_COOKIE);
		//echo $u_id;
		//exit;
		flush();
			
        return array("cookie"=>$result,"uc_user_id"=>$u_id);
    }

	/**
	 * �Ƴ���¼
	 */
	public static function LogOut ($uc_user_id="") {
		ob_start();
		ob_end_flush();
		echo str_repeat(' ',256);
		set_time_limit(0);
		if ($uc_user_id!=""){
			echo uc_user_synlogout($uc_user_id);
		}
		
		flush();
	}
    /**
     * �޸��û���Ϣ
     * @param $user_name �û���
     * @param $old_pw ������
     * @param $new_pw ������
     * @param $email ����
     *
     */
    public static function updateUser ($user_name, $old_pw='', $new_pw='', $email='') {
        global $db_config;
        
        if (!$new_pw && !$email) {
            return false;
        }
        $result = uc_user_edit($user_name, $old_pw, $new_pw, $email, 1);
        
        mysql_select_db($db_config['name']);
        if ($result <0) {
            switch ($result) {
                case -1:
                    self::$msg = '�����벻��ȷ';
                    break;
                case -4:
                    self::$msg = 'Email ��ʽ����';
                    break;
                case -5:
                    self::$msg = 'Email ������ע��';
                    break;
                case -6:
                    self::$msg = '�� Email �Ѿ���ע��';
                    break;
                case -7:
                    self::$msg = 'û�����κ��޸�';
                    break;
                case -8:
                    self::$msg = '���û��ܱ�����Ȩ�޸���';
                    break;
            }
            if (-7 == $result) {
                return true;
            }
            return false;
        }
        
        return true;
    }

    /**
     * ɾ���û�
     * @param $u_id �û�ID
     */
    public static function deleteUser ($u_id) {
        global $db_config;
        
        $result = uc_user_delete(array($u_id));
        if ($result <= 0) {
            return false;
        }
        mysql_select_db($db_config['name']);
        
        return true;
    }

    /**
     * ucenter ͷ��
     */
    public static function avatar ($user_id) {

        $user = new User();
        $user_id = $user->getUserIdInUCenter($user_id);

        return uc_avatar($user_id);
    }

	/**
	 * ucenter ͬ������
	 * @param $user_id ��Աucenter ID
	 * @param $value ������ֵ
	 */
	public static function UpdateCredit ($user_id, $value) {

		return uc_credit_exchange_request($user_id, 0, 5, 1, $value)?true:false;
	}

	/**
	 * ��ȡ����
	 */
	public static function GetCredit ($user_id) {

		return uc_user_getcredit(1, $user_id, 4);
	}
}
?>
