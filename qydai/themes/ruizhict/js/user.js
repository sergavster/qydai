/* ��鳤�� */
function str_length(str){
	sl1=str.length;
	strLen=0;
	for(i=0;i<sl1;i++){
		if(str.charCodeAt(i)>255) strLen+=3;
	 else strLen++;
	}
	return strLen;
}

/* ����Ƿ������� */
function str_chinese(name) {
	if(name.length == 0)
	return "";
	for(i = 0; i < name.length; i++){
	if(name.charCodeAt(i) > 128)
	return true;
	}
	return false;
}


//�����ʵ�ټ���
/*
function str_xing(aname){
	var xing = new Array(		
	'��','Ǯ','��','��','��','��','֣','��','��','��','��','��','��','��','��','��',
	'��','��','��','��','��','��','ʩ','��','��','��','��','��','��','κ','��','��',
	'��','л','��','��','��','ˮ','�','��','��','��','��','��','��','��','��','��',
	'³','Τ','��','��','��','��','��','��','��','��','Ԭ','��','ۺ','��','ʷ','��',
	'��','��','�','Ѧ','��','��','��','��','��','��','��','��','��','��','��','��',
	'��','��','ʱ','��','Ƥ','��','��','��','��','��','Ԫ','��','��','��','ƽ','��',
	'��','��','��','��','Ҧ','��','��','��','��','ë','��','��','��','��','��','�',
	'��','��','��','��','̸','��','é','��','��','��','��','��','��','ף','��','��',
	'��','��','��','��','ϯ','��','��','ǿ','��','·','¦','Σ','��','ͯ','��','��',
	'÷','ʢ','��','��','��','��','��','��','��','��','��','��','��','��','��','��',
	'��','��','֧','��','��','��','¬','Ī','��','��','��','��','��','��','Ӧ','��',
	'��','��','��','��','��','��','��','��','��','��','��','ʯ','��','��','ť','��',
	'��','��','��','��','��','½','��','��','��','��','�','��','��','κ','��','��',
	'��','��','��','��','��','��','��','��','��','��','��','��','��','��','��','��',
	'��','��','ɽ','��','��','��','�','��','ȫ','ۭ','��','��','��','��','��','��',
	'��','��','��','��','��','��','��','��','��','��','��','��','��','ղ','��','��',
	'Ҷ','��','˾','��','۬','��','��','��','ӡ','��','��','��','��','̨','��','��',
	'��','��','��','��','׿','��','��','��','��','��','��','��','��','��','��','˫',
	'��','ݷ','��','��','̷','��','��','��','��','��','��','��','Ƚ','��','۪','Ӻ',
	'�S','�','ɣ','��','�','ţ','��','ͨ','��','��','��','��','ۣ','��','��','ũ',
	'��','��','ׯ','��','��','��','��','��','Ľ','��','��','ϰ','��','��','��','��',
	'��','��','��','��','��','��','��','��','��','��','��','��','��','��','��','��',
	'��','��','��','��','��','»','��','��','Ź','�','��','��','ε','Խ','��','¡',
	'ʦ','��','��','��','��','��','��','��','��','��','��','��','��','��','��','��',
	'��','ɳ','ؿ','��','��','��','��','��','��','��','��','��','��','��','��','��',
	'��','Ȩ','��','��','��','��','��','��','ٹ','˾','��','��','��','ŷ','��','��',
	'��','��','��','��','��','��','��','��','��','��','��','ξ','��','��','��','�',
	'̨','��','ұ','��','��','�','��','��','��','��','��','̫','��','��','��','��',
	'��','��','��','��','ԯ','��','��','��','��','��','��','��','��','Ľ','��','��',
	'��','��','��','˾','ͽ','˾','��');	
	if(!in_array(aname.substr(0,1),xing)){
		return false;
	}
	return true;
}

*/
function str_xing(aname){
	return true;	
}
/* ������� */
function checkEmail(email){
	var submit_disabled = false;
	var reg1 = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)/;
	
	if (email == ''){
		document.getElementById('email_notice').innerHTML = email_msg_blank;
		submit_disabled = true;
	}
	else if (!reg1.test(email)){
		document.getElementById('email_notice').innerHTML =email_msg_format;
		submit_disabled = true;
	}else{
		$.get("index.php?user", { q: "action/check_email", email: email},function (result){
			if ( result == true ){
				document.getElementById('email_notice').innerHTML = msg_can_reg;
				submit_disabled = false;
			}
			else{
				document.getElementById('email_notice').innerHTML = email_msg_exist;
				submit_disabled = true;
			}																			
		}); 
	}
 
	if( submit_disabled ){
		document.forms['formUser'].elements['Submit'].disabled = 'disabled';
		return false;
	}else{
		document.forms['formUser'].elements['Submit'].disabled = '';
		return true;
	}
}

/* ����û��� */
function checkUsername(username){
	var submit_disabled = false;
	if (username!=""){
		var str_len = str_length(username);
	}
	var patrn=/^([a-zA-Z0-9_]|[\u4E00-\u9FA5]){2,15}$/;
	if (username == ""){
		document.getElementById('username_notice').innerHTML = username_msg;
		submit_disabled = true;
	}
	else  if (!patrn.exec(username)) {
		document.getElementById('username_notice').innerHTML = username_msg;
		submit_disabled = true;
	}
	
	else if (str_len <4){
		document.getElementById('username_notice').innerHTML = username_msg;
		submit_disabled = true;
	}
 	else if (str_len >15){
		document.getElementById('username_notice').innerHTML = username_msg;
		submit_disabled = true;
	}else{
		$.get("index.php?user", { q: "action/check_username", username: username},function (result){
			if ( result == true ){
				document.getElementById('username_notice').innerHTML = msg_can_reg;
				submit_disabled = false;
			}
			else{
				document.getElementById('username_notice').innerHTML = username_msg_exist;
				submit_disabled = true;
			}																			
		}); 	
	}
	
	if( submit_disabled ){
		document.forms['formUser'].elements['Submit'].disabled = 'disabled';
		return false;
	}else{
		document.forms['formUser'].elements['Submit'].disabled = '';
		return true;
	}
	
}

//�������
function checkPassword( password ){
	var submit_disabled = false;
    if ( password.length < 6 ||  password.length > 20 ){
        document.getElementById('password_notice').innerHTML = password_msg_shorter;
		submit_disabled = true;
    }
    else{
        document.getElementById('password_notice').innerHTML = msg_can_reg;
    }
	
	if( submit_disabled ){
		document.forms['formUser'].elements['Submit'].disabled = 'disabled';
		return false;
	}else{
		document.forms['formUser'].elements['Submit'].disabled = '';
		return true;
	}
}
//��֤����
function checkConformPassword( conform_password ){
	var submit_disabled = false;
    password = document.getElementById('password').value;
    if ( conform_password.length < 6 ){
        document.getElementById('conform_password_notice').innerHTML = password_msg_shorter;
        submit_disabled =  true;
    }
	else   if ( conform_password != password ){
        document.getElementById('conform_password_notice').innerHTML = password_msg_confirm_invalid;
		 submit_disabled =  true;
    }
    else {
        document.getElementById('conform_password_notice').innerHTML = msg_can_reg;
    }
	if( submit_disabled ){
		document.forms['formUser'].elements['Submit'].disabled = 'disabled';
		return false;
	}else{
		document.forms['formUser'].elements['Submit'].disabled = '';
		return true;
	}
}

//�����ʵ����
function checkRealname(realname){
	var submit_disabled = false;
	if (realname == '') {
		document.getElementById('realname_notice').innerHTML = realname_msg_empty;
		submit_disabled = true;
	}
	else if (realname.length <2 || realname.length >6 ){
		document.getElementById('realname_notice').innerHTML = realname_msg_len;
		submit_disabled = true;
	}
	else  if (str_chinese(realname)==false){
		document.getElementById('realname_notice').innerHTML = realname_msg_chn;
		submit_disabled = true;
	}
	else  if (str_xing(realname)==false)	{
		document.getElementById('realname_notice').innerHTML = realname_msg_war;
		submit_disabled = true;
	}else{
		document.getElementById('realname_notice').innerHTML = msg_can_reg;
	}
	if( submit_disabled ){
		document.forms['formUser'].elements['Submit'].disabled = 'disabled';
		return false;
	} 
	else{
		document.forms['formUser'].elements['Submit'].disabled = '';
		return true;
	}		
}

//����ע��
function userReg(){
    if (checkEmail($("#email").val())  && checkUsername($("#username").val()) && checkPassword($("#password").val())&&checkConformPassword($("#conform_password").val())  && checkRealname($("#realname").val())){
		$("#submit").display='display';
		return true;
	}
	$("#submit").display='display';
   	return false;
}

var msg_can_reg = "<font color=blue># ����ע��</font>";
var username_msg = '* ������4-15λ�ַ�(����5��).Ӣ��,����,"_"����ϡ�';
var username_msg_exist = "* �û����Ѿ�����,����������";
var email_msg_empty = "* Email Ϊ��";
var email_msg_invalid = "* Email ���ǺϷ��ĵ�ַ";
var email_msg_blank = "* �ʼ���ַ����Ϊ��";
var email_msg_exist = "* �����Ѵ���,����������";
var email_msg_format = "* �ʼ���ַ���Ϸ�";
var password_msg_shorter = "* ��¼���벻������ 6 ���ַ���";
var password_msg_confirm_invalid = "* �����������벻һ��";
var realname_msg_empty = "* ��ʵ��������Ϊ��";
var realname_msg_len = "* ��ʵ������������2������,��ʵ�������ܶ���6������";
var realname_msg_chn = "* ��ʵ����ֻ��Ϊ����";
var realname_msg_war = "* ��������Ǵ����,����д��ʵ������"; 

/* ��Ա�޸����� */
function editPassword()
{
  var frm              = document.forms['formPassword'];
  var old_password     = frm.elements['old_password'].value;
  var new_password     = frm.elements['new_password'].value;
  var confirm_password = frm.elements['comfirm_password'].value;

  var msg = '';
  var reg = null;

  if (old_password.length == 0)
  {
    msg += old_password_empty + '\n';
  }

  if (new_password.length == 0)
  {
    msg += new_password_empty + '\n';
  }
 if (new_password.length <6)
  {
    msg += new_password_length + '\n';
  }
  
  if (confirm_password.length == 0)
  {
    msg += confirm_password_empty + '\n';
  }

  if (new_password.length > 0 && confirm_password.length > 0)
  {
    if (new_password != confirm_password)
    {
      msg += confirm_password_invalid + '\n';
    }
  }

  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}

/* *
 * �Ի�Ա����������������
 */
function userEditMessage()
{
  var frm         = document.forms['formEdit'];
  var msg_title   = frm.elements['title'].value;
  var msg_content = frm.elements['content'].value;
  var msg = '';

  if (msg_title.length == 0)
  {
    msg += title_empty + '\n';
  }
  if (msg_content.length == 0)
  {
    msg += content_empty + '\n'
  }

  if (msg_title.length > 200)
  {
    msg += title_limit + '\n';
  }

  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}

/* *
 * ��Ա�һ�����ʱ��������������
 */
function submitPwdInfo()
{
  var frm = document.forms['getPassword'];
  var user_name = frm.elements['username'].value;
  var email     = frm.elements['email'].value;

  var errorMsg = '';
  if (user_name.length == 0)
  {
    errorMsg += user_name_empty + '\n';
  }

  if (email.length == 0)
  {
    errorMsg += email_address_empty + '\n';
  }
  else
  {
    if ( ! (Utils.isEmail(email)))
    {
      errorMsg += email_address_error + '\n';
    }
  }

  if (errorMsg.length > 0)
  {
    alert(errorMsg);
    return false;
  }

  return true;
}

/* *
 * ��Ա�һ�����ʱ��������������
 */
function submitPwd()
{
  var frm = document.forms['getPassword2'];
  var password = frm.elements['new_password'].value;
  var confirm_password = frm.elements['confirm_password'].value;

  var errorMsg = '';
  if (password.length == 0)
  {
    errorMsg += new_password_empty + '\n';
  }

  if (confirm_password.length == 0)
  {
    errorMsg += confirm_password_empty + '\n';
  }

  if (confirm_password != password)
  {
    errorMsg += both_password_error + '\n';
  }

  if (errorMsg.length > 0)
  {
    alert(errorMsg);
    return false;
  }
  else
  {
    return true;
  }
}



/* *
 * ��Ա��¼
 */
function userLogin()
{
  var frm      = document.forms['formLogin'];
  var username = frm.elements['username'].value;
  var password = frm.elements['password'].value;
  var msg = '';

  if (username.length == 0)
  {
    msg += username_empty + '\n';
  }

  if (password.length == 0)
  {
    msg += password_empty + '\n';
  }

  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}

function chkstr(str)
{
  for (var i = 0; i < str.length; i++)
  {
    if (str.charCodeAt(i) < 127 && !str.substr(i,1).match(/^\w+$/ig))
    {
      return false;
    }
  }
  return true;
}


/* *
 * �Ի�Ա����ѯ����
 */
function submitAsk()
{
  var frm         = document.forms['formAsk'];
  var msg_title   = frm.elements['title'].value;
  var msg_content = frm.elements['content'].value;
  var email = frm.elements['email'].value;
  var phone = frm.elements['phone'].value;
  var qq = frm.elements['qq'].value;
  var msg = '';

  if (msg_title.length == 0)
  {
    msg += title_empty + '\n';
  }
  if (msg_content.length == 0)
  {
    msg += content_empty + '\n'
  }

  if (msg_title.length > 200)
  {
    msg += title_limit + '\n';
  }
 if (email.length == 0)
  {
    msg += email_empty + '\n';
  }
  else
  {
    if ( ! (Utils.isEmail(email)))
    {
      msg += email_invalid + '\n';
    }
  }
  
	 if (qq.length == 0 || (qq.length > 0 && (!Utils.isNumber(qq))))
  {
    msg += qq_invalid + '\n';
  }
  
   if (phone.length>0 || phone.length == 0 )
  {
    var reg = /^[\d|\-|\s]+$/;
    if (!reg.test(phone))
    {
      msg += mobile_phone_invalid + '\n';
    }
  }
  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}




/* *
 * �Ź�
 */
function submitGroup()
{
 var frm      = document.forms['formGroup'];
  var msg_title = frm.elements['title'].value;
  var msg_content = frm.elements['content'].value;
   var remark = frm.elements['remark'].value;
  var price = frm.elements['price'].value;
  var account = frm.elements['account'].value;
  var amount = frm.elements['amount'].value;
  var endtime = frm.elements['endtime'].value;
  var msg = '';
  var reg = null;

  if (msg_title.length == 0)
  {
    msg += title_empty + '\n';
  }
  if (msg_content.length == 0)
  {
    msg += content_empty + '\n'
  }

  if (msg_title.length > 200)
  {
    msg += title_limit + '\n';
  }
if (endtime.length == 0 || (endtime.length > 0 && (!Utils.isNumber(endtime))))
  {
    msg += endtime_invalid + '\n';
  }
  if (endtime.length == 0 || (price.length > 0 && (!Utils.isNumber(price))))
  {
    msg += price_invalid + '\n';
  }
  
  if (amount.length == 0 || (amount.length > 0 && (!Utils.isNumber(amount))))
  {
    msg += amount_invalid + '\n';
  }
	 if (account.length == 0 || (account.length > 0 && (!Utils.isNumber(account))))
  {
    msg += account_invalid + '\n';
  }
  
   
  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}


/* *
 * ����
 */
function submitpaotui()
{
 var frm      = document.forms['formpaotui'];
  var msg_title = frm.elements['title'].value;
  var msg_content = frm.elements['content'].value;
   var realname = frm.elements['realname'].value;
  var email = frm.elements['email'].value;
  var address = frm.elements['address'].value;
  var qq = frm.elements['qq'].value;
  var phone = frm.elements['phone'].value;
  var msg = '';
  var reg = null;

  if (msg_title.length == 0)
  {
    msg += title_empty + '\n';
  }
  if (msg_content.length == 0)
  {
    msg += content_empty + '\n'
  }

  if (msg_title.length > 200)
  {
    msg += title_limit + '\n';
  }

	if (realname.length == 0)
  {
    msg += realname_empty + '\n';
  }
  if (email.length == 0)
  {
    msg += email_empty + '\n';
  }
  else
  {
    if ( ! (Utils.isEmail(email)))
    {
      msg += email_invalid + '\n';
    }
  }
  
  if (address.length == 0)
  {
    msg += address_empty + '\n';
  }
  
	 if (qq.length == 0 || (qq.length > 0 && (!Utils.isNumber(qq))))
  {
    msg += qq_invalid + '\n';
  }
  
   if (phone.length>0 || phone.length == 0 )
  {
    var reg = /^[\d|\-|\s]+$/;
    if (!reg.test(phone))
    {
      msg += mobile_phone_invalid + '\n';
    }
  }
  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}
function address_o(id){
	Ajax.call( '?s=address&t=get_address', 'address_id=' + id, address_callback , 'GET', 'TEXT', true, true );	
	
}
function address_callback(result)
{
	var strs= new Array(); //����һ����
	strs=result.split("|@*"); 
	var frm      = document.forms[0];
	frm.elements['realname'].value =strs[5];
  frm.elements['email'].value =strs[6];
  frm.elements['address'].value =strs[11];
  frm.elements['postcode'].value =strs[12];
  frm.elements['qq'].value =strs[9];
  frm.elements['wangwang'].value =strs[10];
  frm.elements['phone'].value =strs[8];
  frm.elements['tel'].value =strs[7];
  frm.elements['building'].value =strs[13];
  frm.elements['besttime'].value =strs[14];
  ProvinceCity(strs[2],strs[3],strs[4]);
}
function registed_callback(result){
		
  if (result == true)
  {
    document.getElementById('username_notice').innerHTML = msg_can_rg;
    document.forms['formUser'].elements['Submit'].disabled = '';
  }
  else
  {
    document.getElementById('username_notice').innerHTML = msg_un_registered;
    document.forms['formUser'].elements['Submit'].disabled = 'disabled';
  }
}

function check_email_callback(result)
{
  if ( result == true )
  {
    document.getElementById('email_notice').innerHTML = msg_can_rg;
    document.forms['formUser'].elements['Submit'].disabled = '';
  }
  else
  {
    document.getElementById('email_notice').innerHTML = msg_email_registered;
    document.forms['formUser'].elements['Submit'].disabled = 'disabled';
  }
}

/* *
 * ����ע���û�
 */
function register()
{
  var frm  = document.forms['formUser'];
///  var username  = Utils.trim(frm.elements['username'].value);
  var email  = frm.elements['email'].value;
  var password  = Utils.trim(frm.elements['password'].value);
  var confirm_password = Utils.trim(frm.elements['confirm_password'].value);
  var realname = Utils.trim(frm.elements['realname'].value);
 var school = Utils.trim(frm.elements['school'].value);
  var start_university = Utils.trim(frm.elements['start_university'].value);
   var middle_school = Utils.trim(frm.elements['middle_school'].value);
    var start_middle_school = Utils.trim(frm.elements['start_middle_school'].value);
  var msg = "";
  // �������
  /*
  if (username.length == 0)
  {
    msg += username_empty + '\n';
  }
  else if (username.match(/^\s*$|^c:\\con\\con$|[%,\'\*\"\s\t\<\>\&\\]/))
  {
    msg += username_invalid + '\n';
  }
  else if (username.length < 3)
  {
    //msg += username_shorter + '\n';
  }
*/
  if (email.length == 0)
  {
    msg += email_empty + '\n';
  }
  else
  {
    if ( ! (Utils.isEmail(email)))
    {
      msg += email_invalid + '\n';
    }
  }
  if (password.length == 0)
  {
    msg += password_empty + '\n';
  }
  else if (password.length < 6)
  {
    msg += password_shorter + '\n';
  }
  if (confirm_password != password )
  {
    msg += confirm_password_invalid + '\n';
  }
 
  if (school.length == "")
  {
    msg += school_empty + '\n';
  }
 if (start_university.length == "")
  {
    msg += start_university_empty + '\n';
  }
  if (middle_school.length == "")
  {
    msg += middle_school_empty + '\n';
  }
  if (start_middle_school.length == "")
  {
    msg += start_middle_school_empty + '\n';
  }
  if (realname=="")
  {
    msg += realname_empty + '\n';
  }else if (realname.length <2 || realname.length >6 )
  {
     msg += realname_len + '\n';
  }else  if (isChinese(realname)==false)
  {
    msg += realname_chn + '\n';
  }else  if (check_Realname(realname)==false)
  {
    msg += realname_war + '\n';
  }
  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}

function in_array(needle, haystack) {
	if(typeof needle == 'string' || typeof needle == 'number') {
	for(var i in haystack) {
	if(haystack[i] == needle) {
	return true;
	}
	}
	}
	return false;
}
function saveOrderAddress(id)
{
  var frm           = document.forms['formAddress'];
  var consignee     = frm.elements['consignee'].value;
  var email         = frm.elements['email'].value;
  var address       = frm.elements['address'].value;
  var zipcode       = frm.elements['zipcode'].value;
  var tel           = frm.elements['tel'].value;
  var mobile        = frm.elements['mobile'].value;
  var sign_building = frm.elements['sign_building'].value;
  var best_time     = frm.elements['best_time'].value;

  if (id == 0)
  {
    alert(current_ss_not_unshipped);
    return false;
  }
  var msg = '';
  if (address.length == 0)
  {
    msg += address_name_not_null + "\n";
  }
  if (consignee.length == 0)
  {
    msg += consignee_not_null + "\n";
  }

  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}

/* *
 * ��Ա�������
 */
function submitSurplus()
{
  var frm            = document.forms['formSurplus'];
  var amount = frm.elements['money'].value;
  var remark  = frm.elements['remark'].value;
   var type  = frm.elements['type'].value;
  var pay_id     = 0;
  var msg = '';

  if (amount.length == 0 )
  {
    msg += surplus_amount_empty + "\n";
  }
  else
  {
    var reg = /^[\.0-9]+/;
    if ( isNaN(amount))
    {
      msg += surplus_amount_error + '\n';
    }
  }

  if (remark.length == 0)
  {
    msg += process_desc + "\n";
  }

  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }

  if (type == 0)
  {
    for (i = 0; i < frm.elements.length ; i ++)
    {
      if (frm.elements[i].name=="pay_id" && frm.elements[i].checked)
      {
        pay_id = frm.elements[i].value;
        break;
      }
    }

    if (pay_id == 0)
    {
      alert(pay_empty);
      return false;
    }
  }

  return true;
}

/* *
 *  �����û����һ�����
 */
function addBonus()
{
  var frm      = document.forms['addBouns'];
  var bonus_sn = frm.elements['bonus_sn'].value;

  if (bonus_sn.length == 0)
  {
    alert(bonus_sn_empty);
    return false;
  }
  else
  {
    var reg = /^[0-9]{10}$/;
    if ( ! reg.test(bonus_sn))
    {
      alert(bonus_sn_error);
      return false;
    }
  }

  return true;
}

/* *
 *  �ϲ��������
 */
function mergeOrder()
{
  if (!confirm(confirm_merge))
  {
    return false;
  }

  var frm        = document.forms['formOrder'];
  var from_order = frm.elements['from_order'].value;
  var to_order   = frm.elements['to_order'].value;
  var msg = '';

  if (from_order == 0)
  {
    msg += from_order_empty + '\n';
  }
  if (to_order == 0)
  {
    msg += to_order_empty + '\n';
  }
  else if (to_order == from_order)
  {
    msg += order_same + '\n';
  }
  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}

/* *
 * �����е���Ʒ���ع��ﳵ
 * @param       int     orderId     ������
 */
function returnToCart(orderId)
{
  Ajax.call('?act=return_to_cart', 'order_id=' + orderId, returnToCartResponse, 'POST', 'JSON');
}

function returnToCartResponse(result)
{
  alert(result.message);
}

/* *
 * �������ǿ��
 * @param       string     pwd     ����
 */
function checkIntensity(pwd)
{
  var Mcolor = "#FFF",Lcolor = "#FFF",Hcolor = "#FFF";
  var m=0;

  var Modes = 0;
  for (i=0; i<pwd.length; i++)
  {
    var charType = 0;
    var t = pwd.charCodeAt(i);
    if (t>=48 && t <=57)
    {
      charType = 1;
    }
    else if (t>=65 && t <=90)
    {
      charType = 2;
    }
    else if (t>=97 && t <=122)
      charType = 4;
    else
      charType = 4;
    Modes |= charType;
  }

  for (i=0;i<4;i++)
  {
    if (Modes & 1) m++;
      Modes>>>=1;
  }

  if (pwd.length<=4)
  {
    m = 1;
  }

  switch(m)
  {
    case 1 :
      Lcolor = "2px solid red";
      Mcolor = Hcolor = "2px solid #DADADA";
    break;
    case 2 :
      Mcolor = "2px solid #f90";
      Lcolor = Hcolor = "2px solid #DADADA";
    break;
    case 3 :
      Hcolor = "2px solid #3c0";
      Lcolor = Mcolor = "2px solid #DADADA";
    break;
    case 4 :
      Hcolor = "2px solid #3c0";
      Lcolor = Mcolor = "2px solid #DADADA";
    break;
    default :
      Hcolor = Mcolor = Lcolor = "";
    break;
  }
  //document.getElementById("pwd_lower").style.borderBottom  = Lcolor;
  //document.getElementById("pwd_middle").style.borderBottom = Mcolor;
  //document.getElementById("pwd_high").style.borderBottom   = Hcolor;

}

function changeType(obj)
{
  if (obj.getAttribute("min") && document.getElementById("ECS_AMOUNT"))
  {
    document.getElementById("ECS_AMOUNT").disabled = false;
    document.getElementById("ECS_AMOUNT").value = obj.getAttribute("min");
    if (document.getElementById("ECS_NOTICE") && obj.getAttribute("to") && obj.getAttribute('fee'))
    {
      var fee = parseInt(obj.getAttribute("fee"));
      var to = parseInt(obj.getAttribute("to"));
      if (fee < 0)
      {
        to = to + fee * 2;
      }
      document.getElementById("ECS_NOTICE").innerHTML = notice_result + to;
    }
  }
}

function calResult()
{
  var amount = document.getElementById("ECS_AMOUNT").value;
  var notice = document.getElementById("ECS_NOTICE");

  reg = /^\d+$/;
  if (!reg.test(amount))
  {
    notice.innerHTML = notice_not_int;
    return;
  }
  amount = parseInt(amount);
  var frm = document.forms['transform'];
  for(i=0; i < frm.elements['type'].length; i++)
  {
    if (frm.elements['type'][i].checked)
    {
      var min = parseInt(frm.elements['type'][i].getAttribute("min"));
      var to = parseInt(frm.elements['type'][i].getAttribute("to"));
      var fee = parseInt(frm.elements['type'][i].getAttribute("fee"));
      var result = 0;
      if (amount < min)
      {
        notice.innerHTML = notice_overflow + min;
        return;
      }

      if (fee > 0)
      {
        result = (amount - fee) * to / (min -fee);
      }
      else
      {
        //result = (amount + fee* min /(to+fee)) * (to + fee) / min ;
        result = amount * (to + fee) / min + fee;
      }

      notice.innerHTML = notice_result + parseInt(result + 0.5);
    }
  }
}
//�ջ���ַ�༭
function submitQgou()
{
  var frm = document.forms['formQgou'];
  var realname = frm.elements['realname'].value;
  var email = frm.elements['email'].value;
  var address = frm.elements['address'].value;
  var qq = frm.elements['qq'].value;
  var phone = frm.elements['phone'].value;
  var msg = '';
  var reg = null;

	if (realname.length == 0)
  {
    msg += realname_empty + '\n';
  }
  if (email.length == 0)
  {
    msg += email_empty + '\n';
  }
  else
  {
    if ( ! (Utils.isEmail(email)))
    {
      msg += email_invalid + '\n';
    }
  }
  
  if (address.length == 0)
  {
    msg += address_empty + '\n';
  }
  
	 if (qq.length == 0 || (qq.length > 0 && (!Utils.isNumber(qq))))
  {
    msg += qq_invalid + '\n';
  }
  
   if (phone.length>0 || phone.length == 0 )
  {
    var reg = /^[\d|\-|\s]+$/;
    if (!reg.test(phone))
    {
      msg += mobile_phone_invalid + '\n';
    }
  }
  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}
function changeDisplay(id){
						var aa = document.getElementById(id).style.display;
						if (aa==""){
							document.getElementById(id).style.display="none";
						}else{
							document.getElementById(id).style.display="";
						}
					}



var process_request = "���ڴ�����������...";
var username_empty = "- �û�������Ϊ�ա�";
var username_shorter = "- �û������Ȳ������� 3 ���ַ���";
var username_invalid = "- �û���ֻ��������ĸ�����Լ��»�����ɡ�";
var password_empty = "- ��¼���벻��Ϊ�ա�";
var paypwd_empty = "- ֧�����벻��Ϊ�ա�";
var password_shorter = "- ��¼���벻������ 6 ���ַ���";
var confirm_password_invalid = "- �����������벻һ��";
var email_empty = "- Email Ϊ��";
var email_invalid = "- Email ���ǺϷ��ĵ�ַ";
var agreement = "- ��û�н���Э��";
var msn_invalid = "- msn��ַ����һ����Ч���ʼ���ַ";
var qq_invalid = "- QQ���벻��һ����Ч�ĺ���";
var home_phone_invalid = "- ��ͥ�绰����һ����Ч����";
var office_phone_invalid = "- �칫�绰����һ����Ч����";
var mobile_phone_invalid = "- �ֻ����벻��һ����Ч����";
var msg_un_blank = "* �û�������Ϊ��";
var msg_un_length = "* �û�������ó���7������";
var msg_un_format = "* �û������зǷ��ַ�";
var msg_un_registered = "* �û����Ѿ�����,����������";
var msg_can_rg = "<font color=blue>����ע��</font>";

var msg_blank = "����Ϊ��";
var no_select_question = "- ��û�����������ʾ����Ĳ���";
var passwd_balnk = "- �����в��ܰ����ո�";
var username_exist = "�û��� %s �Ѿ�����";
var valicode_empty = "- ��֤�벻��Ϊ��";
var old_password_empty = "- �����벻��Ϊ��";
var new_password_empty = '- �����벻��Ϊ��';
var confirm_password_empty = '- �������벻һ��';
var new_password_length = '- �����볤�Ȳ���С��6λ';
var birthday_error = "- �������ڲ���ȷ";;
var realname_empty = "- ��������Ϊ��";
var address_empty = "- �û���ַ����Ϊ��";
var title_empty = "- ���ⲻ��Ϊ��";
var content_empty = "- ���ݲ���Ϊ��";
var title_limit = "- ���ⲻ�ܴ���200��";
var surplus_amount_empty = "- ��������Ҫ�����Ľ��������";
var surplus_amount_error = "- ������Ľ��������ʽ����ȷ��";
var process_desc = "- ���������˴β����ı�ע��Ϣ��";
var pay_empty = "- ��ѡ��֧����ʽ��";
var price_invalid = "- �Ź��۸���ȷ";
var account_invalid = "- �г��۸���ȷ";
var amount_invalid = "- ��������ȷ";
var endtime_invalid = "- ʱ�䲻��ȷ";
var alipay_empty = "- ֧�����˺Ų���Ϊ��";
var valicode_empty = "- ��֤�벻��Ϊ��";

var school_empty = "- ��ѧ����Ϊ��";
var start_university_empty = "- ��ѧ��ѧ��ݲ���Ϊ��";
var middle_school_empty = "- ���в���Ϊ��";
var start_middle_school_empty = "- ������ѧ��ݲ���Ϊ��";
