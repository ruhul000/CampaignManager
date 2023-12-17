<?php require("upload.php");
require("gui_common.php");
header("Pragma: no-cache");
header("Cache: no-cahce");
header( "Expires: Mon, 08 Oct 1997 03:00:00 GMT" );
header( "Cache-Control: no-store,no-cache, must-revalidate" );
header( "Cache-Control: post-check=0, pre-check=0", FALSE);
header( "Pragma: no-cache" );

ClearStatCache();

set_time_limit(10);
error_reporting(0);

$login_form=$_REQUEST['login'];
$sess_id=$_REQUEST["sess_id"];
$trgt_name=$_REQUEST['trgt_name'];
$grp_id=$_REQUEST['cbo_group'];
$sgrp_id=$_REQUEST['cbo_sgroup'];

$table_fld=$_REQUEST['table_fld'];
$msisdn=$_REQUEST["msisdn"];
$clause=$_REQUEST["clause"];

$circlequery = "select circle_id from access_detail where login='".$login_form."' limit 1";
$result = mysql_query($circlequery);
$row=mysql_fetch_row($result);
$circle_id=$row[0];


$date_field=$_REQUEST['date_field'];

$host_ip = $_REQUEST["host_ip"];
$db_name=$_REQUEST["db_name"];
$db_user=$_REQUEST["db_user"];
$db_pwd=$_REQUEST["db_pwd"];
$login=$_REQUEST["login"];
$daily_target=$_REQUEST["dailytarget"];
$cron_start_date='';

if ($daily_target=="false"){
	$daily_target=0;
}else{
	$daily_target=1;
	if($_REQUEST["s_date"]!=null)
	//$cron_start_date=$_REQUEST["s_date"]." ".$_REQUEST["s_hour"].":".$_REQUEST["s_minute"];
	$cron_start_date = preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', '$3-$1-$2', $_REQUEST["s_date"]) . " " . $_REQUEST["s_hour"] . ":" . $_REQUEST["s_minute"];
}

//$daily_target=($_REQUEST["dailytarget"]!="")?'1':'0';


if($clause){
	$conds="";
	$temp=array();
	$temp=explode("|",$clause);


	for($i=0;$i<count($temp);$i++){
		$temp1=array();
		$temp1=explode(":",$temp[$i]);
		$temp1[2]="\"" . $temp1[2] . "\"";

		if(!$conds){
			$conds=$temp1[0] . $temp1[1] . $temp1[2];
		}else{
			$conds=$conds . " and " . $temp1[0] . $temp1[1] . $temp1[2];
		}
	}
	$clause=$conds;
}

$retval=1;
$destn="uploads/" . $login_form . "/" . getfolder($grp_id,$sgrp_id) . "/" . $trgt_name;

if (!$trgt_name && $retval){
	$retval=0;
	echo "Enter Target Name";
}else if (check_target_availability ($trgt_name) && $retval) {
	$retval=0;
	echo "Target Name Already Exist, Choose Another Name";
	die();
}else if (!$grp_id && $retval){
	$retval=0;
	echo "Select Group Name";
}else if (!$sgrp_id && $retval) {
	$retval=0;
	echo "Select Sub Group Name";
}else if(is_file("connection/$login_form/connection.php") && $retval){
	require_once("connection/$login_form/connection.php");

	$mon = date("m");

	$yr = date("Y");
	$da = date("d");
	$hor = date("H");
	$min = date("i");
	$ss = date("s");
	$temp_path=create_folder($destn);

	copy ("connection/$login_form/connection.php","$temp_path/connection.php");

	$path=$temp_path . "/" . $yr . $mon . $da . $hor . $min . $ss . '.csv';


	try {

		$sqlquery="select distinct " . $msisdn . " from " . $table_fld;
		$query = "select * from ". $table_fld." limit 1";
		$result = mysql_query($query);
		$fields = mysql_num_fields($result);

		if($clause)
		{
			$sqlquery=$sqlquery . " where " . $clause;
			for($count=0;$count<$fields;$count++) {
				$field = mysql_fetch_field($result,$count);
				if($field->name=='circle_id')
				{
					$sqlquery=$sqlquery . " and circle_id=".$circle_id;
				}
			}
		}else
		{

			for($count=0;$count<$fields;$count++) {
				$field = mysql_fetch_field($result,$count);
				if($field->name=='circle_id')
				{
					$sqlquery=$sqlquery . " where circle_id=".$circle_id;
				}

			}
		}
//		echo $sqlquery;
		$sqlquery=$sqlquery . " " . " limit 400000";

		$temp="mysql -h" . $location . " -u" . $username . " -p" . $password . " " . $database . " -e '" . $sqlquery . ";'>" . $path;
		$output = exec($temp);

		$handle = fopen($path, "r");
		$contents = fread($handle,filesize($path));
		fclose($handle);

		if(!$contents){
			delete_dir($temp_path);
			$msg_alert = 'Null Record Set';
			echo "Sorry, No Record Set Found!";
		}else{
			$tar_id=insert_target_detail($trgt_name,$path,$grp_id,$sgrp_id,$daily_target,$sqlquery);
			$msg_alert = 'Target Successfully Created';
			echo "Traget Successfully Created";
		}
		user_session($login_form,$sess_id,"Traget Success Fully Created");
	} catch(Exception $e){
		$retval=0;
		echo "Sorry, Database Server Not Accessible";
	}
}else{
	echo "Sorry,Active Database Server Not Found";
}

function check_target_availability($target_name)
{
	$sqlquery = "select target_id from target_detail where target_name='" . $target_name . "' limit 1";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$trg_avail = 0;
	while($row = mysql_fetch_row($result)){
		$trg_avail = 1;
	}
	return $trg_avail;
}


function insert_target_detail($trgt_name,$path,$grp_id,$sgrp_id,$daily_target,$sqlquery)
{
	global $login_form,$host_ip,$cron_start_date,$date_field;

	include("connection_mmc.php");
	//$sqlquery = "insert into target_detail (target_name,file_path,group_id,subgroup_id,target_status,login,daily_new_target,target_query,host_ip,cron_start_date) values ('" . $trgt_name . "','" . $path . "','" . $grp_id . "','" . $sgrp_id . "','1','" . $login_form . "','" . $daily_target . "','" . $sqlquery . "','" . $host_ip ."','" . $cron_start_date . "')";
	//echo $sqlquery;
	$sqlquery = "insert into target_detail (target_name,file_path,group_id,subgroup_id,target_status,login,daily_new_target,target_query,date_field,cron_start_date,target_date) values ('" . $trgt_name . "','" . $path . "','" . $grp_id . "','" . $sgrp_id . "','1','" . $login_form . "','" . $daily_target . "','" . $sqlquery . "','". $date_field . "','".$cron_start_date."',now())";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	return mysql_insert_id();
}
?>