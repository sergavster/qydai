{include file="header.html"}
 
 
<div class="con_box t10">
     <div>
	     <div class="title sdf">
		      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="12" align="left"><img src="{$tpldir}/images/t_left.gif" width="12" height="30" /></td>
    <td align="left" background="{$tpldir}/images/t_bg.gif"><h1 class="dd">��Ϣ����</h1></td>
    <td width="12" align="right"><img src="{$tpldir}/images/t_right.gif" width="12" height="30" /></td>
  </tr>
</table>
          </div>
</div>
{literal}
<div class="m_l_bor" style="padding:10px;">
		<font color="#FF0000">��Ϣ������,�������з�����ͨ�õ�"�ȶϢ���",�������ÿ������ȵĽ������Ϣ��</font> <br />
		<div style="margin-top:10px">
			<form action="/lixi/index.html" method="get">����<input type="text" name="account" size="10"  value="<? echo isset($_REQUEST['account'])?$_REQUEST['account']:""; ?>" value="<? echo $_REQUEST['account'];?>" /> �����ʣ�<input type="text" name="lilv"  size="10"  value="<? echo isset($_REQUEST['lilv'])?$_REQUEST['lilv']:""; ?>"/>%  ������ޣ�<input type="text" name="times"  size="10"  value="<? echo isset($_REQUEST['times'])?$_REQUEST['times']:""; ?>" />���� ���ʽ��<select name="type"><option value="month" >���»���</option></select>  <input type="submit" value="��ʼ����" /></form>
		</div>
</div>
</div>
</div>
{/literal}
<div class="con_box t10">
     <div>
	    <div class="title sdf">
		      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="12" align="left"><img src="{$tpldir}/images/t_left.gif" width="12" height="30" /></td>
    <td align="left" background="{$tpldir}/images/t_bg.gif"><h1 class="dd">�ֻ������ѯ</h1></td>
    <td width="12" align="right"><img src="{$tpldir}/images/t_right.gif" width="12" height="30" /></td>
  </tr>
</table>
          </div>
</div>
{literal}
<div class="m_l_bor" style="padding:10px;">
		<font color="#FF0000">�������������������Ҫ��ѯ���ֻ�����,�����ѯ��ť���ɲ�ѯ���ֻ������ڵ�����</font> <br />
		<div style="margin-top:10px">
			<form action="/phone/index.html" method="get" onsubmit="return chk()">	�ֻ����룺<input type="text" name="phone"  id="phone" size="20" value="<? echo $_REQUEST['phone'];?>" />   <input type="submit" value="�� ѯ" /></form>
		</div>
	</div>
<script> 
function chk()
{
var tel = document.all("phone").value;
 
if(/^13\d{9}$/g.test(tel)|| (/^18\d{9}$/g.test(tel)) || (/^15\d{9}$/g.test(tel)))
        {;
		      return true;
         }
else
        {
           alert("�ֻ��Ŵ���");
		   return false;
         }
}
</script>
		</div>
</div>
</div>
</div>
{/literal}
<div class="con_box t10">
     <div>
	 <div class="title sdf">
		      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="12" align="left"><img src="{$tpldir}/images/t_left.gif" width="12" height="30" /></td>
    <td align="left" background="{$tpldir}/images/t_bg.gif"><h1 class="dd">ip��ַ��ѯ</h1></td>
    <td width="12" align="right"><img src="{$tpldir}/images/t_right.gif" width="12" height="30" /></td>
  </tr>
</table>
          </div>
	   
</div>
{literal}
<div class="m_l_bor" style="padding:10px;">
		<font color="#FF0000">�������������������Ҫ��ѯ��IP��ַ,�����ѯ��ť���ɲ�ѯ��IP���ڵ�����</font> <br />
		<div style="margin-top:10px">
			<form action="/ip/index.html" method="get">IP��ַ��<input type="text" name="ip" size="20" {literal}value="<?echo $_ip;?>"{/literal} />   <input type="submit" value="�� ѯ" /></form>
		</div>
</div>
</div>
</div>
{/literal}
{include file="footer.html"}