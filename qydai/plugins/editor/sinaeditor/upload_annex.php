<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>插入附件</title>
		<style type="text/css">
			body, td, span, div, input {
				font-size: 12px;
				font-family: "宋体", "Courier New", Courier, monospace;
				margin: 0px;
			}
		</style>
		<script language="JavaScript">
		<!--
		window.isIE = (navigator.appName == "Microsoft Internet Explorer");
		if(window.isIE) {
			if(navigator.userAgent.indexOf("Opera")>-1) window.isIE = null;
		}
		else {
			if(navigator.userAgent.indexOf("Gecko")==-1) window.isIE = null;
		}
		function $(sID) {
			return document.getElementById(sID);
		}
		function adjustDialog(){
			var w = $("tabDialogSize").offsetWidth + 6;
			var h = $("tabDialogSize").offsetHeight + 25;
			window.dialogLeft = (screen.availWidth - w) / 2;
			window.dialogTop = (screen.availHeight - h) / 2;
		}
		window.onload = init;
		function init () {
			adjustDialog();
			//$("imgpath").select();
		}
		function LoadIMG(imgpath){
		   oRTE = window.dialogArguments.document.getElementById('<? echo $_REQUEST['id'];?>');
			if(window.isIE) {
				try{
					oRTE.value =imgpath;
				}
				catch(e){}
			}
			else {
				oRTE.value =imgpath;
			}
			window.close();
		}
		function chk_imgpath () {
		  if($('radio1').checked==true){
			if($("imgpath").value == "http://" || $("imgpath").value == "") {
				window.close();
				return;
			}
			LoadIMG($("imgpath").value);
		  }else{
		    if($("file1").value == "") {
			   window.close();
			   return;
		    }
		    $('form1').submit();
			$('divProcessing').style.display='';
		  }
		}
		document.onkeydown = function (el) {
			var event = window.event || el;
			if(event.keyCode == 13) {
			    chk_imgpath();
			}  
		}
		//-->
		</script>
	</head>
	<body>
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" id="tabDialogSize">
    <form name="form1" id="form1" method="post" action="upload.php?action=annex" enctype="multipart/form-data" target="myiframe">
    <tr>
      <td height="24" bgcolor="#DDE7EE" style="padding-left: 10px;">插入附件</td>
    </tr>
    <tr>
      <td height="50"><input type="radio" name="picurl" id="radio1" hidefocus="true" onClick="if(this.checked==true){$('imgpath').disabled='';$('file1').disabled='disabled';}">&nbsp;附件地址:
      <input type="text" value="http://" style="border: 1px solid #999999; width: 235px;" id="imgpath" name="imgpath" disabled="disabled"></td>
    </tr>
    <tr height="30"> 
      <td align="left" id="upid" width="400"><input type="radio" id="radio2" name="picurl" hidefocus="true" onClick="if(this.checked==true){$('imgpath').disabled='disabled';$('file1').disabled='';}" checked>&nbsp;上传附件: 
        <input type="file" name="file1" id="file1" style="width:300px; border:#999999 1px solid">
      </td>
    </tr>
    <tr>
      <td style="padding: 10px;">&nbsp;</td>
    </tr>
    <tr>
      <td height="40" align="center" style="padding-bottom: 10px;"><input type="button" value=" 确 认 " onClick="chk_imgpath()"> <input type="button" value= " 取 消 " onClick="window.close();"></td>
    </tr><tr><td bgcolor="#DDE7EE" height="5"></td>
    </tr></form>
	</table>
<div id=divProcessing style="width:200px;height:30px;position:absolute;left:85px;top:75px;display:none">
<table border="0" cellpadding="0" cellspacing="1" bgcolor="#333333" width="100%" height="100%">
  <tr>
    <td bgcolor="#3A6EA5" align="center"><font color=#FFFFFF>附件上传中,请等待...</font></td>
  </tr>
</table>
</div>
<iframe src="../upload.php" width="0" height="0" name="myiframe" id="myiframe" frameborder="0" scrolling="no"></iframe>
	</body>
</html>