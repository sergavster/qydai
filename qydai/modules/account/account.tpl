{if $_A.query_type == "new" || $_A.query_type == "edit"}


{elseif $_A.query_type=="list"}
<table  border="0"  cellspacing="1" bgcolor="#CCCCCC" width="100%">
	  <form action="" method="post">
		<tr >
			<td width="" class="main_td">ID</td>
			<td width="*" class="main_td">�û���</td>
			<td width="" class="main_td">��ʵ����</td>
			<td width="" class="main_td">�����</td>
			<td width="" class="main_td">�������</td>
			<td width="" class="main_td">������</td>
			<td width="" class="main_td">���ս��</td>
		</tr>
		{ foreach  from=$_A.account_list key=key item=item}
		<tr  {if $key%2==1} class="tr2"{/if}>
			<td >{ $item.user_id}</td>
			<td><a href="javascript:void(0)" onclick='tipsWindown("�û���ϸ��Ϣ�鿴","url:get?index.php?admin&q=module/user/view&user_id={$item.user_id}&type=scene",500,230,"true","","true","text");'>{$item.username}</a></td>
			<td >{$item.realname}</td>
			<td >{$item.total|default:0}Ԫ</td>
			<td >{$item.use_money|default:0}Ԫ</td>
			<td >{$item.no_use_money|default:0}Ԫ</td>
			<td >{$item.collection|default:0}Ԫ</td>
		</tr>
		{ /foreach}
		<tr>
		<td colspan="10" class="action">
		<div class="floatl">
		
		</div>
		<div class="floatr">
			�û�����<input type="text" name="username" id="username" value="{$magic.request.username}"/> <input type="button" value="����" / onclick="sousuo()">
		</div>
		</td>
	</tr>
		<tr>
			<td colspan="9" class="page">
			{$_A.showpage} 
			</td>
		</tr>
	</form>	
</table>

<!--���ּ�¼�б� ��ʼ-->
{elseif $_A.query_type=="cash"}
<table  border="0"  cellspacing="1" bgcolor="#CCCCCC" width="100%">
	  <form action="" method="post">
		<tr >
			<td width="" class="main_td">ID</td>
			<td width="*" class="main_td">�û�����</td>
			<td width="*" class="main_td">��ʵ����</td>
			<td width="" class="main_td">�����˺�</td>
			<td width="" class="main_td">��������</td>
			<td width="" class="main_td">֧��</td>
			<td width="" class="main_td">�����ܶ�</td>
			<td width="" class="main_td">���˽��</td>
			<td width="" class="main_td">������</td>
			<td width="" class="main_td">����ʱ��</td>
			<td width="" class="main_td">״̬</td>
			<td width="" class="main_td">����</td>
		</tr>
		{ foreach  from=$_A.account_cash_list key=key item=item}
		<tr  {if $key%2==1} class="tr2"{/if}>
			<td >{ $item.id}</td>
			<td><a href="{$_A.query_url}/cash&username={$item.username}">{$item.username}</a></td>
			<td >{ $item.realname}</td>
			<td >{ $item.account}</td>
			<td >{ $item.bank_name}</td>
			<td >{ $item.branch}</td>
			<td >{ $item.total}</td>
			<td >{ $item.credited}</td>
			<td >{ $item.fee}</td>	
			<td >{ $item.addtime|date_format:"Y-m-d H:i"}</td>
			<td >{if $item.status==0}�����{elseif  $item.status==1} ��ͨ�� {elseif $item.status==2}���ܾ�{/if}</td>
			<td ><a href="{$_A.query_url}/cash_view{$_A.site_url}&id={$item.id}">���/�鿴</a></td>
		</tr>
		{ /foreach}
		<tr>
		<td colspan="11" class="action">
		<div class="floatl">
		<input type="button" onclick="javascript:location.href='{$_A.query_url}/cash&status={$magic.request.status}&type=excel'" value="�����б�" />
		</div>
		<div class="floatr">
			�û�����<input type="text" name="username" id="username" value="{$magic.request.username}"/> ״̬<select id="status" ><option value="">ȫ��</option><option value="1" {if $magic.request.status==1} selected="selected"{/if}>��ͨ��</option><option value="0" {if $magic.request.status=="0"} selected="selected"{/if}>δͨ��</option></select> <input type="button" value="����" / onclick="sousuo()">
		</div>
		</td>
	</tr>
		<tr>
			<td colspan="11" class="page">
			{$_A.showpage} 
			</td>
		</tr>
	</form>	
</table>
<!--���ּ�¼�б� ����-->


<!--������� ��ʼ-->
{elseif $_A.query_type == "cash_view"}
<div class="module_add">
	
	<form name="form1" method="post" action="" onsubmit="return check_form();" enctype="multipart/form-data" >
	<div class="module_title"><strong>�������/�鿴</strong></div>

	<div class="module_border">
		<div class="l">�û�����</div>
		<div class="c">
			{ $_A.account_cash_result.username}
		</div>
	</div>

	<div class="module_border">
		<div class="l">�������У�</div>
		<div class="c">
			{ $_A.account_cash_result.bank_name }
		</div>
	</div>

	<div class="module_border">
		<div class="l">����֧�У�</div>
		<div class="c">
			{ $_A.account_cash_result.branch }
		</div>
	</div>

	<div class="module_border">
		<div class="l">�����˺ţ�</div>
		<div class="c">
			{ $_A.account_cash_result.account }
		</div>
	</div>
	
	<div class="module_border">
		<div class="l">�����ܶ</div>
		<div class="c">
			{ $_A.account_cash_result.total }
		</div>
	</div>
	
	<div class="module_border">
		<div class="l">���˽�</div>
		<div class="c">
			{ $_A.account_cash_result.credited }
		</div>
	</div>
	
	<div class="module_border">
		<div class="l">���ʣ�</div>
		<div class="c">
			{ $_A.account_cash_result.fee }
		</div>
	</div>
	
	<div class="module_border">
		<div class="l">״̬��</div>
		<div class="c">
		{if $item.status==0}���������{elseif  $item.status==1} ������ͨ�� {elseif $item.status==2}���ֱ��ܾ�{/if}
		</div>
	</div>
	
	<div class="module_border">
		<div class="l">���ʱ��/IP:</div>
		<div class="c">
			{ $_A.account_cash_result.addtime|date_format:'Y-m-d H:i:s'}/{ $_A.account_cash_result.addip}</div>
	</div>
	
	{if $_A.account_cash_result.status==0}
	<div class="module_title"><strong>��˴�������Ϣ</strong></div>
	
	<div class="module_border">
		<div class="l">״̬:</div>
		<div class="c">
		<input type="radio" name="status" value="0" {if $_A.account_cash_result.status==0} checked="checked"{/if} />�ȴ����  <input type="radio" name="status" value="1" {if $_A.account_cash_result.status==1} checked="checked"{/if}/>���ͨ�� <input type="radio" name="status" value="2" {if $_A.account_cash_result.status==2} checked="checked"{/if}/>��˲�ͨ�� </div>
	</div>
	
	<div class="module_border" >
		<div class="l">���˽��:</div>
		<div class="c">
			<input type="text" name="credited" value="{ $_A.account_cash_result.credited}" size="10">��һ�����ͨ���������ٽ����޸ģ�
		</div>
	</div>
	
	<div class="module_border" >
		<div class="l">����:</div>
		<div class="c">
			<input type="text" name="fee" value="{ $_A.account_cash_result.fee}" size="5">
		</div>
	</div>
	
	<div class="module_border" >
		<div class="l">��˱�ע:</div>
		<div class="c">
			<textarea name="verify_remark" cols="45" rows="5">{ $_A.account_result.verify_remark}</textarea>
		</div>
	</div>

	<div class="module_submit" >
		<input type="hidden" name="id" value="{ $_A.account_cash_result.id }" />
		<input type="hidden" name="user_id" value="{ $_A.account_cash_result.user_id }" />
		<input type="submit"  name="reset" value="��˴�������Ϣ" />
	</div>
	{else}
	<div class="module_border">
		<div class="l">�����Ϣ��</div>
		<div class="c">
			����ˣ�{ $_A.account_cash_result.verify_username },���ʱ�䣺{ $_A.account_cash_result.verify_time|date_format:"Y-m-d H:i" },��˱�ע��{ $_A.account_cash_result.verify_remark}
		</div>
	</div>
	{/if}
	</form>
</div>
{literal}
<script>
function check_form(){
	 var frm = document.forms['form1'];
	 var verify_remark = frm.elements['verify_remark'].value;
	 var errorMsg = '';
	  if (verify_remark.length == 0 ) {
		errorMsg += '��ע������д' + '\n';
	  }
	  
	  if (errorMsg.length > 0){
		alert(errorMsg); return false;
	  } else{  
		return true;
	  }
}
</script>
{/literal}


<!--��ֵ��¼�б� ��ʼ-->
{elseif $_A.query_type=="recharge"}
<table  border="0"  cellspacing="1" bgcolor="#CCCCCC" width="100%">
	  <form action="" method="post">
		<tr >
			<td width="" class="main_td">ID</td>
			<td width="*" class="main_td">�û�����</td>
			<td width="" class="main_td">����</td>
			<td width="" class="main_td">��������</td>
			<td width="" class="main_td">��ֵ���</td>
			<td width="" class="main_td">����</td>
			<td width="" class="main_td">���˽��</td>
			<td width="" class="main_td">��ֵʱ��</td>
			<td width="" class="main_td">״̬</td>
			<td width="" class="main_td">����</td>
		</tr>
		{ foreach  from=$_A.account_recharge_list key=key item=item}
		<tr  {if $key%2==1} class="tr2"{/if}>
			<td >{ $item.id}</td>
			<td><a href="{$_A.query_url}/recharge&username={$item.username}">{$item.username}</a></td>
			<td >{ if $item.type==1}���ϳ�ֵ{else}���³�ֵ{/if}</td>
			<td >{if $item.payment==0}�ֶ���ֵ{else}{ $item.payment_name}{/if}</td>
			<td >{ $item.money}Ԫ</td>
			<td >{ $item.fee}Ԫ</td>
			<td ><font color="#FF0000">{$item.total}Ԫ</font></td>
			<td >{ $item.addtime|date_format:"Y-m-d H:i"}</td>
			<td >{if $item.status==0}<font color="#6699CC">���</font>{elseif  $item.status==1} �ɹ� {else}<font color="#FF0000">ʧ��</font>{/if}</td>
			<td ><a href="{$_A.query_url}/recharge_view{$_A.site_url}&id={$item.id}">���/�鿴</a></td>
		</tr>
		{ /foreach}
		<tr>
		<td colspan="11" class="action">
		<div class="floatl">
		 <A href="?{$_A.query_string}&type=excel">������ǰ����</A>
		</div>
		<div class="floatr">
			�û�����<input type="text" name="username" id="username" value="{$magic.request.username}"/> ״̬<select id="status" ><option value="">ȫ��</option><option value="1" {if $magic.request.status==1} selected="selected"{/if}>��ͨ��</option><option value="0" {if $magic.request.status=="0"} selected="selected"{/if}>δͨ��</option></select> <input type="button" value="����" / onclick="sousuo()">
		</div>
		</td>
	</tr>
		<tr>
			<td colspan="11" class="page">
			{$_A.showpage} 
			</td>
		</tr>
	</form>	
</table>
<!--��ֵ��¼�б� ����-->
<!--������� ��ʼ-->
{elseif $_A.query_type == "recharge_view"}
<div class="module_add">
	
	<form name="form1" method="post" action="" onsubmit="return check_form();" enctype="multipart/form-data" >
	<div class="module_title"><strong>��ֵ�鿴</strong></div>

	<div class="module_border">
		<div class="l">�û�����</div>
		<div class="c">
			<a href="javascript:void(0)" onclick='tipsWindown("�û���ϸ��Ϣ�鿴","url:get?index.php?admin&q=module/user/view&user_id={$_A.account_recharge_result.user_id}&type=scene",500,230,"true","","true","text");'>{ $_A.account_recharge_result.username}</a>
		</div>
	</div>

	<div class="module_border">
		<div class="l">��ֵ���ͣ�</div>
		<div class="c">
			{if $_A.account_recharge_result.type==1}���ϳ�ֵ{else}���³�ֵ{/if}
		</div>
	</div>

	<div class="module_border">
		<div class="l">֧����ʽ��</div>
		<div class="c">
			{ $_A.account_recharge_result.payment_name}
		</div>
	</div>
	
	<div class="module_border">
		<div class="l">��ֵ�ܶ</div>
		<div class="c">
			{ $_A.account_recharge_result.money }Ԫ
		</div>
	</div>
	
	
	<div class="module_border">
		<div class="l">���ã�</div>
		<div class="c">
			{ $_A.account_recharge_result.fee }Ԫ
		</div>
	</div>
	
	<div class="module_border">
		<div class="l">ʵ�ʵ��ˣ�</div>
		<div class="c">
			{ $_A.account_recharge_result.total }Ԫ
		</div>
	</div>
	
	<div class="module_border">
		<div class="l">�û���ע��</div>
		<div class="c">
		{ $_A.account_recharge_result.remark }
		</div>
	</div>
	
	
	<div class="module_border">
		<div class="l">��ˮ�ţ�</div>
		<div class="c">
		{ $_A.account_recharge_result.remark }
		</div>
	</div>
	
	<div class="module_border">
		<div class="l">״̬��</div>
		<div class="c">
		{if $_A.account_recharge_result.status==0}�ȴ����{elseif  $_A.account_recharge_result.status==1} ��ֵ�ɹ� {elseif $_A.account_recharge_result.status==2}��ֵʧ��{/if}
		</div>
	</div>
	
	<div class="module_border">
		<div class="l">���ʱ��/IP:</div>
		<div class="c">
			{ $_A.account_recharge_result.addtime|date_format:'Y-m-d H:i:s'}/{ $_A.account_recharge_result.addip}</div>
	</div>
	
	{if $_A.account_recharge_result.status==0  }
	<div class="module_title"><strong>��˴˳�ֵ��Ϣ</strong></div>
	
	<div class="module_border">
		<div class="l">״̬:</div>
		<div class="c">
	<input type="radio" name="status" value="1"/>��ֵ�ɹ�   <input type="radio" name="status" value="2"  checked="checked"/>��ֵʧ�� </div>
	</div>
	
	<div class="module_border" >
		<div class="l">���˽��:</div>
		<div class="c">
			<input type="text" name="total" value="{ $_A.account_recharge_result.total }" size="15" readonly="">��һ�����ͨ���������ٽ����޸ģ�
		</div>
	</div>
	
	<div class="module_border" >
		<div class="l">��˱�ע:</div>
		<div class="c">
			<textarea name="verify_remark" cols="45" rows="5">{ $_A.account_recharge_result.verify_remark}</textarea>
		</div>
	</div>

	<div class="module_submit" >
		<input type="hidden" name="id" value="{ $_A.account_recharge_result.id }" />
		
		<input type="submit"  name="reset" value="��˴˳�ֵ��Ϣ" />
	</div>
	{else}
		{if $_A.account_recharge_result.type==2 }
	<div class="module_border">
		<div class="l">�����Ϣ��</div>
		<div class="c">
			����ˣ�{ $_A.account_result.verify_username },���ʱ�䣺{ $_A.account_result.verify_time|date_format:"Y-m-d H:i" },��˱�ע��{ $_A.account_result.verify_remark}
		</div>
	</div>
	{/if}
	{/if}
	</form>
</div>
{literal}
<script>
function check_form(){
	 var frm = document.forms['form1'];
	 var verify_remark = frm.elements['verify_remark'].value;
	 var errorMsg = '';
	  if (verify_remark.length == 0 ) {
		errorMsg += '��ע������д' + '\n';
	  }
	  
	  if (errorMsg.length > 0){
		alert(errorMsg); return false;
	  } else{  
		return true;
	  }
}
</script>
{/literal}



<!--��ӳ�ֵ��¼ ��ʼ-->
{elseif $_A.query_type == "recharge_new"}

<div class="module_add">
	
	<form name="form1" method="post" action="" onsubmit="return check_form();" enctype="multipart/form-data" >
	<div class="module_title"><strong>��ӳ�ֵ</strong></div>

	<div class="module_border">
		<div class="l">�û�����</div>
		<div class="c">
			<input type="text" name="username" />
		</div>
	</div>
	<div class="module_border">
		<div class="l">���ͣ�</div>
		<div class="c">
			���³�ֵ<input type="hidden" name="type" />
		</div>
	</div>
	<div class="module_border">
		<div class="l">��</div>
		<div class="c">
			<input type="text" name="money" />
		</div>
	</div>
	
	<div class="module_border">
		<div class="l">��ע��</div>
		<div class="c">
			<input type="text" name="remark" />
		</div>
	</div>
	
	<div class="module_submit" >
		
		<input type="submit"  name="reset" value="ȷ�ϳ�ֵ" />
	</div>
</form>
</div>

<!--��ӳ�ֵ��¼ ����-->




<!--��ӳ�ֵ��¼ ��ʼ-->
{elseif $_A.query_type == "deduct"}

<div class="module_add">
	
	<form name="form1" method="post" action="" onsubmit="return check_form();" enctype="multipart/form-data" >
	<div class="module_title"><strong>���ÿ۳�</strong></div>

	<div class="module_border">
		<div class="l">�û�����</div>
		<div class="c">
			<input type="text" name="username" />
		</div>
	</div>
	<div class="module_border">
		<div class="l">���ͣ�</div>
		<div class="c">
			<select name="type">
				<option value="scene_account">�ֳ���֤����</option>
				<option value="vouch_advanced">�����渶�۷�</option>
				<option value="borrow_kouhui">����˷���ۻ�</option>
				<option value="account_other">����</option>
			</select>
		</div>
	</div>
	<div class="module_border">
		<div class="l">��</div>
		<div class="c">
			<input type="text" name="money" />
		</div>
	</div>
	
	<div class="module_border">
		<div class="l">��ע��</div>
		<div class="c">
			<input type="text" name="remark" />���磬�ֳ����ÿ۳�200Ԫ
		</div>
	</div>
	<div class="module_border">
		<div class="l">��֤�룺</div>
		<div class="c"><input  class="user_aciton_input"  name="valicode" type="text" size="8" maxlength="4" style=" padding-top:4px; height:16px; width:70px;"/>&nbsp;<img src="/plugins/index.php?q=imgcode" alt="���ˢ��" onClick="this.src='/plugins/index.php?q=imgcode&t=' + Math.random();" align="absmiddle" style="cursor:pointer" />
		</div>
	</div>
	<div class="module_submit" >
		
		<input type="submit"  name="reset" value="ȷ���۳�" />
	</div>
</form>
</div>

<!--��ӳ�ֵ��¼ ����-->

<!--�ʽ�ʹ�ü�¼�б� ��ʼ-->
{elseif $_A.query_type=="log"}
<table  border="0"  cellspacing="1" bgcolor="#CCCCCC" width="100%">
	  <form action="" method="post">
		<tr >
			<td width="" class="main_td">ID</td>
			<td width="*" class="main_td">�û�����</td>
			<td width="" class="main_td">����</td>
			<td width="" class="main_td">�ܽ��</td>
			<td width="" class="main_td">�������</td>
			<td width="" class="main_td">���ý��</td>
			<td width="" class="main_td">������</td>
			<td width="" class="main_td">���ս��</td>
			<td width="" class="main_td">���׶Է�</td>
			<td width="" class="main_td">��¼ʱ��</td>
			<td width="" class="main_td">����</td>
		</tr>
		{ foreach  from=$_A.account_log_list key=key item=item}
		<tr  {if $key%2==1} class="tr2"{/if}>
			<td >{ $item.id}</td>
			<td><a href="{$_A.query_url}/recharge&username={$item.username}">{$item.username}</a></td>
			<td >{ $item.type|linkage:"account_type"}</td>
			<td >{ $item.total}</td>
			<td >{ $item.money}</td>
			<td >{ $item.use_money}</td>
			<td >{ $item.no_use_money|default:0}</td>
			<td >{ $item.collection|default:0}</td>
			<td >{ $item.to_username|default:admin}</td>
			<td >{ $item.addtime|date_format:"Y-m-d H:i"}</td>
			<td ><a href="{$_A.query_url}/cash_view{$_A.site_url}&id={$item.id}">���/�鿴</a></td>
		</tr>
		{ /foreach}
		<tr>
		<td colspan="11" class="action">
		<div class="floatl">
		
		</div>
		<div class="floatr">
			ʱ�䣺<input type="text" name="dotime1" id="dotime1" value="{$magic.request.dotime1|default:"$day7"|date_format:"Y-m-d"}" size="15" onclick="change_picktime()"/> �� <input type="text"  name="dotime2" value="{$magic.request.dotime2|default:"$nowtime"|date_format:"Y-m-d"}" id="dotime2" size="15" onclick="change_picktime()"/>   
		{linkages nid="account_type" value="$magic.request.type" name="type" type="value" default="ȫ��" } �û�����<input type="text" name="username" id="username" value="{$magic.request.username}"/> ״̬<select id="status" ><option value="">ȫ��</option><option value="1" {if $magic.request.status==1} selected="selected"{/if}>��ͨ��</option><option value="0" {if $magic.request.status=="0"} selected="selected"{/if}>δͨ��</option></select> <input type="button" value="����" / onclick="sousuo()">
		</div>
		</td>
	</tr>
		<tr>
			<td colspan="11" class="page">
			{$_A.showpage} 
			</td>
		</tr>
	</form>	
</table>
<!--�ʽ�ʹ�ü�¼�б� ����-->


{/if}
<script>
var url = '{$_A.query_url}/{$_A.query_type}';
{literal}
function sousuo(){
	var sou = "";
	var username = $("#username").val();
	if (username!=""){
		sou += "&username="+username;
	}
	var status = $("#status").val();
	if (status!="" && status!=null){
		sou += "&status="+status;
	}
	var dotime1 = $("#dotime1").val();
	var keywords = $("#keywords").val();
	var username = $("#username").val();
	var dotime2 = $("#dotime2").val();
	var type = $("#type").val();
	if (username!=null){
		 sou += "&username="+username;
	}
	if (keywords!=null){
		 sou += "&keywords="+keywords;
	}
	if (dotime1!=null){
		 sou += "&dotime1="+dotime1;
	}
	if (dotime2!=null){
		 sou += "&dotime2="+dotime2;
	}
	if (type!=null){
		 sou += "&type="+type;
	}
	
	if (sou!=""){
	location.href=url+sou;
	}
}

</script>
{/literal}