<?
require("connection_mmc.php");
$login_form = $_REQUEST["login"];
$msg_alert = $_REQUEST["msg_alert"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$host_ip = $_REQUEST["host_ip"];
$db_name = $_REQUEST["db_name"];
$db_user = $_REQUEST["db_user"];
$db_pwd = $_REQUEST["db_pwd"];
$db_table = $_REQUEST["table_fld"];
$table_field=$_REQUEST['msisdn'];
$value_ToMap=$_REQUEST['vmaptxt'];
$maplnk=$_REQUEST['maplnk'];
$vmap_id='';
$v=count($value_ToMap);
$m=count($maplnk);


$vmap='';
$mapl='';
for($cnt=0,$max=count($value_ToMap);$cnt<$max;$cnt++){
	if($vmap==''){
		$vmap=$value_ToMap[$cnt];
	}else{
		$vmap=$vmap."','".$value_ToMap[$cnt];
	}

}
for($cnt=0,$max=count($maplnk);$cnt<$max;$cnt++){
	if($mapl==''){
		$mapl=$maplnk[$cnt];
	}else{
		$mapl=$mapl."','".$maplnk[$cnt];
	}

}

$sqlquery="select id from value_map_host_detail where host='".$host_ip."' and db_name='".$db_name."' and db_table='".$db_table."' and table_field='".$table_field."' limit 1";
$result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());
$rowCount=mysql_num_rows($result);

if($rowCount>0){
	$row=mysql_fetch_row($result);
	$inserted_id=$row[0];
	$vmap_id=$inserted_id;

}else{
	$sqlquery="insert into value_map_host_detail(host,db_name,db_table,table_field,login) values ('".$host_ip."','".$db_name."','".$db_table."','".$table_field."','".$login_form."')";
	$result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());;
	$vmap_id=mysql_insert_id();
}

// For Insertion in value_map_info table...

$query="select id,vmap_value from value_map_info where vmap_id='".$vmap_id."' and vmap_value in('".$vmap."')";
$result = mysql_query($query) or die('mysql error:' . mysql_error());
$valueCount=mysql_num_rows($result);
$cnt1=0;
while($cnt1<$valueCount){
	$row=mysql_fetch_row($result);
	$v_id[$cnt1]=$row[0];
	$v_map[$cnt1]=$row[1];
	$cnt1++;
}


if($valueCount>0){
	
	for($cnt=0,$max=count($value_ToMap);$cnt<$max;$cnt++){
		$temp = $value_ToMap[$cnt];
		$f=0;
		$cnt1=0;
		while($cnt1<$valueCount){
			if($temp==$v_map[$cnt1])
			{
				$query="update value_map_info set map_with='".$maplnk[$cnt]."' where vmap_id='".$vmap_id."' and vmap_value='".$v_map[$cnt1]."' and id='".$v_id[$cnt1]."'";
				$result=mysql_query($query) or die('mysql error:' . mysql_error());
				$f=1;
			}
			$cnt1++;
		}
		if($f==0){
			$query="insert into value_map_info(vmap_id,vmap_value,map_with) values('".$vmap_id."','".$value_ToMap[$cnt]."','".$maplnk[$cnt]."')";
			$result=mysql_query($query) or die('mysql error:' . mysql_error());
		}

	}

		$msg_alert="Data Successfully Saved...";
		header("Location: ValueMap.php?login=" . $login_form . "&sess_id=" . $sess_id."&msg_alert=" . $msg_alert . "&smenu=" . $smenu);
		die();



}else{
	for($cnt=0;$cnt<$v;$cnt++){
		$query="insert into value_map_info(vmap_id,vmap_value,map_with) values('".$vmap_id."','".$value_ToMap[$cnt]."','".$maplnk[$cnt]."')";
		$result=mysql_query($query) or die('mysql error:' . mysql_error());
	}
	$msg_alert="Data Successfully Saved...";
	header("Location: ValueMap.php?login=" . $login_form . "&sess_id=" . $sess_id."&msg_alert=" . $msg_alert . "&smenu=" . $smenu);
	die();

}


?>