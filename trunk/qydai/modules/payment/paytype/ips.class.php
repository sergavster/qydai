<?php

class ipsPayment {

	var $name = '��ѶIPS����֧��3.0';//��ѶIPS����֧��3.0
	var $description = "��ѶIPS����֧��3.0";
	var $type = 1;//1->ֻ��������2->�������
    var $logo = 'IPS3';
    var $version = 20070615;
    var $charset = 'gb2312';
	
	
    public static function ToSubmit($payment){
   		$submitUrl = 'http://pay.ips.com.cn/ipayment.aspx?';
   		//$submitUrl = 'http://pay.ips.net.cn/ipayment.aspx?';
		$Date = date("Ymd",time());
		$Currency_Type = "RMB";
		$Mer_key = $payment['PrivateKey'];
		$Amount = number_format($payment['money'], 2, '.', '');
		$SignMD5 = md5($payment['trade_no']. $Amount . $Date . $Currency_Type . $Mer_key);
		$url = $submitUrl;
		$url .= "Mer_code={$payment['member_id']}&";//�û���
		$url .= "Billno={$payment['trade_no']}&";//˽Կ
		$url .= "Amount={$Amount}&";//���׽��
		$url .= "Date={$Date}&";//��������
		$url .= "Currency_Type={$Currency_Type}&";//����
		$url .= "Gateway_Type=01&";//��������
		$url .= "Lang=GB&";//����
		$url .= "Merchanturl={$payment['return_url']}&";//���ص�ַ
		$url .= "FailUrl=&";//ʧ�ܵ�ַ
		$url .= "ErrorUrl=&";//�����ַ
		$url .= "DispAmount={$Amount}&";//���
		$url .= "OrderEncodeType=2&";//���
		$url .= "RetEncodeType=12&";//
		$url .= "Rettype=1&";//
		$url .= "SignMD5={$SignMD5}";//
		//$url .= "Mer_code=000015&Billno=20101202034558653693&Amount=0.10&Date=20101202&Currency_Type=RMB&Gateway_Type=01&Lang=GB&Merchanturl=http%3A%2F%2Frz.com%2Fdemo%2FOrderReturn.php&FailUrl=&ErrorUrl=&Attach=&DispAmount=0.10&OrderEncodeType=2&RetEncodeType=12&Rettype=1&ServerUrl=&SignMD5=381dbff2840de7aa914ac251191fb6aa";
        return $url;
		
    }

    function callback($in,&$paymentId,&$money,&$message,&$tradeno){
        $merId = $this->getConf($in['out_trade_no'],'member_id'); //�ʺ�
        $pKey = $this->getConf($in['out_trade_no'],'PrivateKey');
        $key = $pKey==''?'afsvq2mqwc7j0i69uzvukqexrzd0jq6h':$pKey;//˽Կֵ
        ksort($in);
        //�������Ϸ���
        $temp = array();
        foreach($in as $k=>$v){
            if($k!='sign'&&$k!='sign_type'){
                $temp[] = $k.'='.$v;
            }
        }
        $testStr = implode('&',$temp).$key;
        if($in['sign']==md5($testStr)){
            $paymentId = $in['out_trade_no'];    //֧������
            $money = $in['total_fee'];
            $message = $in['body'];
            $tradeno = $in['trade_no'];
            switch($in['trade_status']){
                case 'TRADE_FINISHED':
                    if($in['is_success']=='T'){                        
                        return PAY_SUCCESS;
                    }else{                        
                        return PAY_FAILED;
                    }
                    break;
                case 'TRADE_SUCCESS':
                    if($in['is_success']=='T'){                        
                        return PAY_SUCCESS;
                    }else{                        
                        return PAY_FAILED;
                    }
                    break;
                case 'WAIT_SELLER_SEND_GOODS':
                    if($in['is_success']=='T'){                        
                        return PAY_PROGRESS;
                    }else{                        
                        return PAY_FAILED;
                    }
                    break;
                case 'TRADE_SUCCES':    //�߼��û�
                    if($in['is_success']=='T'){
                        return PAY_SUCCESS;
                    }else{
                        return PAY_FAILED;
                    }
                    break;
            }

        }else{
            $message = 'Invalid Sign';            
            return PAY_ERROR;
        }
    }

    function serverCallback($in,&$paymentId,&$money,&$message){
        exit('reserved');
    }

    function applyForm($agentfield){
      $tmp_form='<a href="javascript:void(0)" onclick="document.applyForm.submit();">��������֧����</a>';
      $tmp_form.="<form name='applyForm' method='".$agentfield['postmethod']."' action='http://top.shopex.cn/recordpayagent.php' target='_blank'>";
      foreach($agentfield as $key => $val){
            $tmp_form.="<input type='hidden' name='".$key."' value='".$val."'>";
      }
      $tmp_form.="</form>";
      return $tmp_form;
    }
 	function pay_IPS_relay($status){
        switch ($status){
            case PAY_FAILED:
                $aTemp = 'failed';
                break;
            case PAY_TIMEOUT:
                $aTemp = 'timeout';
                break;
            case PAY_SUCCESS:
                $aTemp = 'succ';
                break;
            case PAY_CANCEL:
                $aTemp = 'cancel';
                break;
            case PAY_ERROR:
                $aTemp = 'status';
                break;
            case PAY_PROGRESS:
                $aTemp = 'progress';
                break;
        }
    }
    function GetFields(){
         return array(
                'member_id'=>array(
                        'label'=>'�ͻ���',
                        'type'=>'string'
                    ),
                'PrivateKey'=>array(
                        'label'=>'˽Կ',
                        'type'=>'string'
                )
            );
    }
}
?>
