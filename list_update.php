<?php
require("gui_common.php");

$login_form = $_REQUEST["login"];
$msg_alert = $_REQUEST["msg_alert"];
$treeview_cod = $_REQUEST["treeview_cod"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$action = $_REQUEST["action"];

$schlr_name = $_REQUEST["schlr_name"];
$target_id = $_REQUEST["target_id"];
$s_date=$_REQUEST["s_date"];
$e_date=$_REQUEST["e_date"];
$s_hour=$_REQUEST["s_hour"];
$s_minute=$_REQUEST["s_minute"];
$e_hour=$_REQUEST["e_hour"];
$e_minute=$_REQUEST["e_minute"];

$msgln = $_REQUEST["msgln"];
$list_id = $_REQUEST["list_id"];
$sender_id = $_REQUEST["sender_id"];

$sms_type = $_REQUEST["sms_type"];
if($sms_type==1){
	$rule_id = $_REQUEST["sms_msg_id"];
}else if($sms_type==2){
	$rule_id = $_REQUEST["wap_title_id"];
}
//echo "Rules = " . $rule_id;

$active_status = $_REQUEST["active_status"];
$sqlquery = "select daily_new_target from target_detail where target_id=".$target_id;
//echo $sqlquery;
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
$row = mysql_fetch_row($result);
$daily_new_target=$row[0];

if(strlen($s_hour)==1){
	$s_hour=$s_hour;
}else{
	$s_hour = substr($s_hour,2);
}

if(strlen($e_hour)==1){
	$e_hour=$e_hour;
}else{
	$e_hour = substr($e_hour,2);
}

if(strlen($s_minute)==1){
	$s_minute=$s_minute;
}else{
	$s_minute = substr($s_minute,2);
}

if(strlen($e_minute)==1){
	$e_minute=$e_minute;
}else{
	$e_minute = substr($e_minute,2);
}


$url="login=" . $login_form . "&sess_id=" . $sess_id ."&smenu=" . $smenu ."&treeview_cod=" . $treeview_cod ."&schlr_name=" . $schlr_name ."&target_id=" . $target_id ."&s_date=" . $s_date ."&e_date=" . $e_date ."&s_hour=" . $s_hour ."&s_minute=" . $s_minute ."&e_hour=" . $e_hour ."&e_minute=" . $e_minute ."&rule_id=" . $rule_id ."&msgln=" . $msgln ."&list_id=" . $list_id ."&sms_type=" . $sms_type ."&sender_id=" . $sender_id;

if ($action=="3" && $list_id){
	$valid_delete = delete_list ($list_id);

	if($valid_delete){
		$next_id=next_list_id();
		$msg_alert = "$schlr_name Scheduler Successfully Deleted";
	}else{
		$next_id = $list_id;
		$msg_alert = "$schlr_name Scheduler End Date or Status Are Not Valid for Deletion";
	}

	header("Location: list_view.php?login=" . $login_form . "&sess_id=" . $sess_id ."&list_id=" . $next_id . "&msg_alert=" . $msg_alert . "&smenu=" . $smenu);
	die();
}

if($action==1){
	$urlstr="Location: list_create.php?" . $url;
}else if($action==2){
	$urlstr="Location: list_modify.php?" . $url;
}

if(!$schlr_name){
	$msg_alert = "Please Enter Unique Scheduler Name";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($action==1 && list_available($schlr_name)){
	$msg_alert = "Scheduler With This Name Already Exist, Choose Another Name";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if(!$target_id){
	$msg_alert = "Please Select Target Name";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if(!$s_date || !$e_date || !$s_hour || !$e_hour || !$e_minute || !$e_minute){

	$msg_alert = "Please select valid Date Time!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}

//$start_date = preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', '$3-$1-$2', $s_date);
//$end_date =  preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', '$3-$1-$2', $e_date);

$start_date = preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', '$3-$1-$2', $s_date) . " " . $s_hour . ":" . $s_minute;
$end_date =  preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', '$3-$1-$2', $e_date) . " " . $e_hour . ":" . $e_minute;

//echo $start_date . "<br/>";
//echo $end_date . "<br/>";

$temp1=explode('/',$s_date);
$temp_dt1=mktime($s_hour,$s_minute,'00',$temp1[0],$temp1[1],$temp1[2]);
$temp2=explode('/',$e_date);
$temp_dt2=mktime($e_hour,$e_minute,'00',$temp2[0],$temp2[1],$temp2[2]);
$temp_dt0=mktime();

if(!$rule_id){
	$msg_alert = "Please Select SMS Message";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if(!$msgln){
	$msg_alert = "Please Enter Number of Messages";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}


$message="";
$footer_url="";
$sms_mode="";
$target_path="";
$dnd_id="";
$dnd_path="";

if ($action==1) {
	getBaseDetail($target_id);
	getSmsDetail($rule_id);
	$list_id = insert_list_detail ();
	$msg_alert = "$schlr_name Scheduler Successfully Created";
	header("Location: list_view.php?login=" . $login_form . "&sess_id=" . $sess_id ."&list_id=" . $list_id . "&msg_alert=" . $msg_alert . "&smenu=" . $smenu);
	die();
}else if ($action==2) {
	getBaseDetail($target_id);
	getSmsDetail($rule_id);
	update_list_detail ($list_id);
	$url="login=" . $login_form . "&sess_id=" . $sess_id ."&smenu=" . $smenu ."&treeview_cod=" . $treeview_cod ."&schlr_name=" . $schlr_name ."&target_id=" . $target_id ."&s_date=" . $s_date ."&e_date=" . $e_date ."&s_hour=" . $s_hour ."&s_minute=" . $s_minute ."&e_hour=" . $e_hour ."&e_minute=" . $e_minute ."&rule_id=" . $rule_id ."&msgln=" . $msgln ."&list_id=" . $list_id;
	//echo $urlstr;
	$msg_alert = "$schlr_name Scheduler Successfully Updated";
	$urlstr="Location: list_modify.php?" . $url;
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}


function insert_list_detail ()
{
	global $message,$footer_url,$sms_mode,$target_path,$dnd_id,$dnd_path,$sms_type,$login_form, $schlr_name, $target_id, $start_date, $end_date, $rule_id, $msgln, $s_hour, $s_minute, $e_hour, $e_minute, $daily_new_target, $sender_id;

	global $e_hour, $e_minute, $s_hour, $s_minute;

	$active_status=1;

	$schlr_name = strtolower($schlr_name);

	$s_time = $s_hour . ":" . $s_minute . ":00";
	$e_time = $e_hour . ":" . $e_minute . ":00";



	$sqlquery = "insert into list_detail (date_created,login_created,scheduler_name,target_id,target_path,dnd_id,dnd_path,sms_id,message,footer_url,sms_mode,no_of_sms,start_date,start_time,end_date,end_time,active_status,rule_id,status,sms_type,daily_new_target,sender_id) values (now(),'" . $login_form . "','" . $schlr_name . "','" . $target_id . "','" . $target_path . "','" . $dnd_id . "','" . $dnd_path . "','" . $rule_id . "','" . $message . "','" . $footer_url . "','" . $sms_mode . "','" . $msgln . "','" . $start_date . "','" . $s_time . "','" . $end_date . "','" . $e_time . "','" . $active_status . "','" . $rule_id . "','" . $active_status . "','" . $sms_type ."','". $daily_new_target ."','". $sender_id ."')";
	//echo "Sqlquery = " . $sqlquery;

	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$list_id = mysql_insert_id();

	return $list_id;
}

function update_list_detail ($list_id)
{
	global $sms_type,$login_form, $schlr_name, $target_id, $start_date, $end_date, $rule_id, $msgln,$active_status,$daily_new_target, $sender_id;

	global $e_hour, $e_minute, $s_hour, $s_minute, $message,$footer_url,$sms_mode,$target_path,$dnd_id,$dnd_path;


	$s_time = $s_hour . ":" . $s_minute;
	$e_time = $e_hour . ":" . $e_minute;


	$schlr_name = strtolower($schlr_name);
	//$sqlquery = "update list_detail set target_id='" . $target_id . "',start_date='" . $start_date . "',end_date='" . $end_date . "',sms_id='" . $rule_id . "',no_of_sms='" . $msgln . "',active_status='" . $active_status . "', start_time='" . $s_time . "', sms_type='" . $sms_type . "',rule_id='" . $rule_id . "',status='" . $active_status . "', end_time='" . $e_time . "', send_status='0',daily_new_target='".$daily_new_target."' where id='" .$list_id . "' and login_created='" . $login_form . "'";
	$sqlquery = "update list_detail set target_id='" . $target_id . "',start_date='" . $start_date . "',end_date='" . $end_date . "',sms_id='" . $rule_id. "',no_of_sms='" . $msgln . "',active_status='" . $active_status . "', start_time='" . $s_time . "', sms_type='" . $sms_type . "',rule_id='" . $rule_id . "',status='" . $active_status . "', end_time='" . $e_time . "', send_status='0',daily_new_target='".$daily_new_target."',message='".str_ireplace("'","''",$message)."', footer_url='". str_ireplace("'","''",$footer_url)."',sms_mode='" . $sms_mode . "',target_id='".$target_id."', target_path='".$target_path."', dnd_id='".$dnd_id."', dnd_path='".$dnd_path."', sender_id='" . $sender_id . "' where id='" .$list_id . "' and login_created='" . $login_form . "'";
	//echo $sqlquery;
	//echo $sqlquery;

	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
}


function delete_list ($list_id)
{
	global $login_form;

	$sqlquery = "select id from list_detail where date(end_date)<now() and  id='" . $list_id . "' and login_created='" . $login_form . "'";
	//echo "sqlquery = " . $sqlquery . "<br>";


	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());



	$valid_delete = 0;
	while($row = mysql_fetch_row($result)){
		$valid_delete=$row[0];
	}

	//echo "valid_delete = " . $valid_delete . "<br>";


	if($valid_delete){

		$sqlquery = "delete from list_detail where id='" . $list_id . "' and login_created='" . $login_form . "'";
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
		return 1;
	}else{
		return 0;
	}
}

function next_list_id()
{
	global $login_form;

	$sqlquery = "select id from list_detail order by id desc limit 1";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$next_avail = 0;
	while($row = mysql_fetch_row($result)){
		$next_avail=$row[0];
	}
	return $next_avail;
}



function list_available ($lst_name)
{
	global $login_form;

	$sqlquery = "select id from list_detail where scheduler_name='" . $lst_name . "' order by id limit 1";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$lst_avail = 0;
	while($row = mysql_fetch_row($result)){
		$lst_avail = 1;
	}
	return $lst_avail;
}

function getBaseDetail($trg_id){


	global $target_path,$dnd_id,$dnd_path,$login_form;

	$sqlquery = "select file_path,group_id,subgroup_id from  target_detail where target_id='" . $trg_id . "' and login='" . $login_form . "' limit 1";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());


	while($row = mysql_fetch_row($result)){
		$target_path=$row[0];
		$group_id=$row[1];
		$subgroup_id=$row[2];
	}

	$sqlquery = "select dnd_id,file_path from dnd_detail where group_id='" . $group_id . "' and subgroup_id='" . $subgroup_id . "' and login='" . $login_form . "' limit 1";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	while($row = mysql_fetch_row($result)){
		$dnd_id=$row[0];
		$dnd_path=$row[1];
	}
}

function getSmsDetail($sms_id){

	global $message,$footer_url,$sms_mode,$login_form;

	$sqlquery = " select message,footer_url,sms_mode from rules_detail where sms_id='" . $sms_id . "' and login='" . $login_form . "' limit 1";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	while($row = mysql_fetch_row($result)){
		$message=$row[0];
		$footer_url=$row[1];
		$sms_mode=$row[2];
	}
}

?>