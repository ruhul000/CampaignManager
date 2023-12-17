<?
require("connection_mmc.php");
$login_form = $_REQUEST["login"];
$msg_alert = $_REQUEST["msg_alert"];
$page=$_REQUEST["page"];            //1-for NEW,2-for MODIFY,3-for DELETE
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$host_ip = $_REQUEST["host_ip"];
$db_name = $_REQUEST["db_name"];
//$db_user = $_REQUEST["db_user"];
$db_pwd = $_REQUEST["db_pwd"];
$dbsatus = $_REQUEST["dbsatus"];
$db_table = $_REQUEST["table_fld"];
$table_field=$_REQUEST['msisdn'];
$value_ToMap=$_REQUEST['vmaptxt'];
$maplnk=$_REQUEST['maplnk'];
$tarcbo=$_REQUEST['tarcbo'];
print_r($tarcbo);
$vmap_id='';
$v=count($value_ToMap);
$m=count($maplnk);
if(!$table_field)
die();

$query="select h.id,v.map_with, v.vmap_value from value_map_host_detail h,value_map_info v where h.host='".$host_ip."' and h.db_name='".$db_name."' and h.db_table='".$db_table."' and h.table_field='".$table_field."' and v.vmap_id=h.id";
$result=mysql_query($query) or die();

$rowCount=mysql_num_rows($result);
if($rowCount==0){	
	echo "&nbsp;&nbsp;&nbsp;&nbsp;Value:&nbsp;&nbsp;<input type='text' name='tartxt[]' class='input' value=''/>";
}else{
	echo "&nbsp;&nbsp;&nbsp;&nbsp;Value:&nbsp;&nbsp;<select name='tartxt[]' class='input'>";
	while($row = mysql_fetch_row($result)){
		$map_name=$row[1];
		$map_value=$row[2];
		echo "<option value='".$map_value."'>$map_name</option>";
	}
echo "</select>";
}
?>