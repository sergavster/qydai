
{if $t == "install"}

<form name="form1" method="post" action="{$url}/install"  >
<table width="100%" border="0"  cellspacing="1" bgcolor="#CCCCCC">
	<tr>
		<td colspan="2" bgcolor="#ffffff" class="tr">
			<div class="fl"><strong>Ucenter��װ</strong></div>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right" bgcolor="#ffffff">UCenter ���ݿ�������</td>
		<td align="left"  class="main_td1" >
			<input type="text" name="uc_dbhost"  value="localhost" class="input_border" size="30" />  
		</td>
	</tr>
	<tr>
		<td align="right" bgcolor="#ffffff">UCenter ���ݿ��û�����</td>
		<td align="left"  class="main_td1" >
			<input type="text" name="uc_dbuser" value="root"  class="input_border" size="30" />  
		</td>
	</tr>
	<tr>
		<td align="right" bgcolor="#ffffff">UCenter ���ݿ����룺</td>
		<td align="left"  class="main_td1" >
			<input type="text" name="uc_dbpw" value="" class="input_border" size="30" />  
		</td>
	</tr>
	<tr>
		<td align="right" bgcolor="#ffffff">UCenter ���ݿ����ƣ�</td>
		<td align="left"  class="main_td1" >
			<input type="text" name="uc_dbname" value="hycms"  class="input_border" size="30" />  
		</td>
	</tr>
	<tr>
		<td align="right" bgcolor="#ffffff">UCenter ���ݿ��ַ�����</td>
		<td align="left"  class="main_td1" >
			<input type="text" name="uc_charset" value="gbk"  class="input_border" size="30" />  
		</td>
	</tr>
	<tr>
		<td align="right" bgcolor="#ffffff">UCenter ���ݿ��ǰ׺��</td>
		<td align="left"  class="main_td1" >
			<input type="text" name="uc_dbtablepre" value="hycms_uc_"  class="input_border" size="30" />  
		</td>
	</tr>
	<tr>
		<td align="right" bgcolor="#ffffff">UCenter ͨ����Կ��</td>
		<td align="left"  class="main_td1" >
			<input type="text" name="uc_key" value="123456"  class="input_border" size="30" />  
		</td>
	</tr>
	<tr>
		<td align="right" bgcolor="#ffffff">UCenter ��װ��ַ��</td>
		<td align="left"  class="main_td1" >
			<input type="text" name="uc_api"  class="input_border" size="30" />  
		</td>
	</tr>
	<tr>
		<td align="right" bgcolor="#ffffff">UCenter �ַ�����</td>
		<td align="left"  class="main_td1" >
			<input type="text" name="uc_charset" value="gbk"  class="input_border" size="30" />  
		</td>
	</tr>
	<tr>
		<td align="right" bgcolor="#ffffff">UCenter IP��</td>
		<td align="left"  class="main_td1" >
			<input type="text" name="uc_ip"  class="input_border" size="30" />  
		</td>
	</tr>
	<tr>
		<td align="right" bgcolor="#ffffff">UCenter ��ǰӦ�õ�ID��</td>
		<td align="left"  class="main_td1" >
			<input type="text" name="uc_appid" value=""  class="input_border" size="30" />  
		</td>
	</tr>
	<tr>
		<td bgcolor="#ffffff" colspan="3"  align="center">
		<input type="submit"  name="submit" value="ȷ���ύ" />
		</td>
	</tr>
</table>
</form>
{else}
<table width="100%" border="0"  cellspacing="1" bgcolor="#CCCCCC">
	<tr>
		<td bgcolor="#ffffff" class="main_td">
			<div class="fl"><strong>Ucenter����</strong></div>
		</td>
	</tr>
	<tr>
		<td width="25%" align="center" bgcolor="#ffffff"><br /><br />

���ѳɹ���װ�˴�ģ�飬Ҫ�޸����� <a href="{$url}/unstall">ж��</a><br /><br />

<br />
</td>
	</tr>
	
</table>
{/if}