<?php

$order = " order by `order` desc,id asc ";
if (isset($_GET['area_id'])){
	$city = $_GET["area_id"];
	$sql = "select * from {area} where pid=".$city.$order;
	$result = $mysql->db_fetch_arrays($sql);
	$category['id'] = "";
	$category['name'] = gbk2utf8("��ѡ��");
	$categorys[0] = $category;
	if ($result!=false){
		foreach ($result as $key => $row){
			$category = array();
			$category['id'] = $row['id'];
			$category['name'] = gbk2utf8($row['name']);
			$categorys[$key+1] = $category;
		}
	}
	
	$json = json_encode($categorys);
	echo $json;
	exit;
}

if (isset($_REQUEST['value'])){
$_REQUEST['area'] = $_REQUEST['value'];
}

$name = isset($_REQUEST['name'])?$_REQUEST['name']:"";

$type = !isset($_REQUEST['type'])?"":$_REQUEST['type'];

if($type!=""){
	$_type = explode(",",$type);
}else{
	$_type= array("p","c","a");
}


$province_id ="";
$city_id = "";
$area_id = "";
if (isset($_REQUEST['area'])  && $_REQUEST['area']!=""){
	$id = $_REQUEST['area'];
	$sql = "select pid from {area} where id=$id ".$order;
	$result1 = $mysql->db_fetch_array($sql);
	if ($result1=="") $result1['pid'] =0;
	if ($result1['pid']==0){
		$province_id = $id;
	}else{
		$sql = "select pid from {area} where id=".$result1['pid'].$order;
		$result2 = $mysql->db_fetch_array($sql);
		if ($result2['pid']==0){
			$province_id = $result1['pid'];
			$city_id = $id;
		}else{
			$province_id = $result2['pid'];
			$city_id = $result1['pid'];
			$area_id = $id;
		}
	}
}

$_city = "";
if ($province_id!=""){
	$sql = "select * from {area} where pid=".$province_id.$order;
	$city_res = $mysql->db_fetch_arrays($sql);
	foreach ($city_res as $key => $value){
		$sel = "";
		if ($value['id'] === $city_id){ $sel = "selected";}
		$_city .= "<option value=".$value['id']." $sel>".$value['name']."</option>";
	}
}

$_area = "";
if ($city_id!=""){
	$sql = "select * from {area} where pid=".$city_id.$order;
		$area_res = $mysql->db_fetch_arrays($sql);
		foreach ($area_res as $key => $value){
			$sel = "";
			if ($value['id'] === $area_id){ $sel = "selected";}
			$_area .= "<option value=".$value['id']." $sel>".$value['name']."</option>";
		}
}


$sql = "select * from {area} where pid=0".$order;
$result = $mysql->db_fetch_arrays($sql);
$_province ="";

foreach ($result as $key => $value){
	$sel = "";
	if ($value['id'] === $province_id){ $sel = "selected";}
	$_province .= "<option value=".$value['id']." $sel>".$value['name']."</option>";
}

?>

$(document).ready(function (){
	$("#<? echo $name;?>province").change(function(){
		var province = $(this).val();
		var count = 0;
		$.ajax({
			url:"/plugins/index.php",
			dataType:'json', 
			data:"q=area&area_id="+province,
			success:function(json){
				$("#<? echo $name;?>city option").each(function(){
					$(this).remove();				 
				});
				$(json).each(function(){
					$("<option value='"+json[count].id+"'>"+json[count].name+"</option>").appendTo("#<? echo $name;?>city");
					count++;
				});
				
			}
		});
	});
	$("#<? echo $name;?>city").change(function(){
		var province = $(this).val();
		var count = 0;
		$.ajax({
			url:"/plugins/index.php",
			dataType:'json', 
			data:"q=area&area_id="+province,
			success:function(json){
				$("#<? echo $name;?>area option").each(function(){
					$(this).remove();				 
				});
				$(json).each(function(){					
					$("<option value='"+json[count].id+"'>"+json[count].name+"</option>").appendTo("#<? echo $name;?>area");
					count++;
				});
				if(count>0)
				{
					$("#<? echo $name;?>area").show();
				}else
				{
					$("#<? echo $name;?>area").hide();
				}
			}
		});
	});
	$("#<? echo $name;?>area").change(function(){
		
	});
});
<?
$p = "<select id='{$name}province' name='{$name}province'><option value=''>��ѡ��</option>{$_province}</select>&nbsp;";
$c = "<select id='{$name}city' name='{$name}city'><option value=''>��ѡ��</option>{$_city}</select>&nbsp;";
$a = "<select id='{$name}area' name='{$name}area'><option value=''>��ѡ��</option>{$_area}</select>&nbsp;";
$display= "";
foreach ($_type as $key => $value){
	$display .= $$value;
}

?>
document.write("<? echo $display;?>");
