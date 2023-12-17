<?php
require("connection_mmc.php");

$login= $_REQUEST["login"];
$password= $_REQUEST["password"];

$msg_alert = "Either login or password is not correct!!!";

if(strlen($login)<1 || strlen($password)<1){
		$msg_alert = "Either login or password is not correct!!!";
}else{
	$sqlquery = "select id,login from access_detail where login='" . $login . "' and password = '" . $password . "'";
	$result = mysql_query($sqlquery) or die('mysql error in check_login:' . mysql_error());

	while($row = mysql_fetch_row($result)){
		$user_id = $row[0];
		$user_name = $row[1];
		$login_history="Login success : " . $user_name;
	}
	if($user_id){
		$msg_alert=$user_id . "|" . $user_name . "|" . $login_history;
	}
}
echo $msg_alert;
mysql_close($conn);
?>
