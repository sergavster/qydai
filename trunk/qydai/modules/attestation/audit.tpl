<div class="module_add">
	<form name="form1" method="post" action="{$_A.query_url}/audit&a=site" onsubmit="return check_form();" enctype="multipart/form-data" >
	
	<div class="module_border">
		<div class="l">״̬:</div>
		<div class="c">
		 <input type="radio" name="status" value="1" checked="checked"/>���ͨ�� <input type="radio" name="status" value="2" />��˲�ͨ�� </div>
	</div>
	
	<div class="module_border" >
		<div class="l">ͨ���������û���:</div>
		<div class="c">
			<input type="text" name="jifen" value="20" size="5"> ��
		</div>
	</div>
	
	<div class="module_border" >
		<div class="l">��֤��:</div>
		<div class="c">
			<input name="valicode" type="text" size="11" maxlength="4"  tabindex="3"/>&nbsp;<img src="/plugins/index.php?q=imgcode" alt="���ˢ��" onClick="this.src='/plugins/index.php?q=imgcode&t=' + Math.random();" align="absmiddle" style="cursor:pointer" />
		</div>
	</div>
		<!--
	<div class="module_border" >
		<div class="l">���ͼƬ1:</div>
		<div class="c">
			<input type="file" name="pic[]" > 
		</div>
	</div>
	

	<div class="module_border" >
		<div class="l">���ͼƬ2:</div>
		<div class="c">
			<input type="file" name="pic[]" > 
		</div>
	</div>
	
	
	<div class="module_border" >
		<div class="l">���ͼƬ3:</div>
		<div class="c">
			<input type="file" name="pic[]" > 
		</div>
	</div>
	-->
	<div class="module_border" >
		<div class="l">��˱�ע:</div>
		<div class="c">
			<textarea name="content" cols="35" rows="5"></textarea>
		</div>
	</div>

	<div class="module_submit" >
		<input type="hidden" name="user_id" value="{ $magic.request.user_id }" />
		<input type="hidden" name="nid" value="{ $magic.request.type }" />
		<input type="submit"  name="reset" value="ȷ���ύ" />
	</div>
	</form>
</div>