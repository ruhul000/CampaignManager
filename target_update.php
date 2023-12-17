<?php 

ob_start();
require("config.php");
require("upload.php");
require("gui_common.php");



$trgt_name=$_REQUEST['trgt_name'];
$trgt_selctn=$_REQUEST['trgt_selctn'];

$grp_id=$_REQUEST['cbo_group'];
$sgrp_id=$_REQUEST['cbo_sgroup'];

$login_form=$_REQUEST['login'];
$sess_id=$_REQUEST['sess_id'];
$page=$_REQUEST['page'];
$smenu=$_REQUEST['smenu'];

$compName=$_REQUEST['cpName'];
$location=$_REQUEST["host_ip"];
$database=$_REQUEST["db_name"];
$username=$_REQUEST["db_user"];
$password=$_REQUEST["db_pwd"];
$dbsatus=$_REQUEST["dbsatus"];

$table_fld=$_REQUEST["table_fld"];
$msisdn=$_REQUEST["msisdn"];
$tarcbo=$_REQUEST["tarcbo"];
$opt=$_REQUEST["opt"];
$tartxt=$_REQUEST["tartxt"];
$daily_target=$_REQUEST["dailytarget"];

//echo $daily_target;
//die();

$baseurl="Location: target.php?login=" . $login_form . "&sess_id=" . $sess_id . "&page=" . $page . "&smenu=" . $smenu . "&trgt_name=" . $trgt_name . "&trgt_selctn=" . $trgt_selctn . "&cbo_group=" . $grp_id . "&cbo_sgroup=" . $sgrp_id . "&dailytarget=" . $daily_target . "&cbo_sgroup=" . $sgrp_id. "&cpName=" . $compName;

if($trgt_selctn==2){
	$urlstr="&host_ip=" . $location . "&db_name=" . $database . "&db_user=" . $username . "&db_pwd=" . $password . "&dbsatus=" . $dbsatus. "&cpName=" . $compName;
}

echo $revert=$baseurl . $urlstr;

if (!$trgt_name){
    $msg_alert = "Please Enter Unique Target Name";
    header($revert . "&msg_alert=" . $msg_alert);
    die();
}else if (check_target_availability ($trgt_name)) {
    $msg_alert = "Target Name Already Exist, Choose Another Name";
    header($revert . "&msg_alert=" . $msg_alert);
    die();
}else if (!$trgt_selctn) {
    $msg_alert = "Please Choose Selection Criteria";
    header($revert . "&msg_alert=" . $msg_alert);
    die();
}else if ($trgt_selctn==1 && !$grp_id){
    $msg_alert = "Please Choose Group Name";
    header($revert . "&msg_alert=" . $msg_alert);
    die();
}else if ($trgt_selctn==1 && !$sgrp_id) {
    $msg_alert = "Please Choose Sub Group Name";
    header($revert . "&msg_alert=" . $msg_alert);
    die();
}else if ($trgt_selctn==2 && !$location) {
    $msg_alert = "IP Address must be filled out";
    header($revert . "&msg_alert=" . $msg_alert);
    die();
}else if ($trgt_selctn==2 && !$database) {
    $msg_alert = "Database name must be filled out";
    header($revert . "&msg_alert=" . $msg_alert);
    die();
}else if ($trgt_selctn==2 && !$username) {
    $msg_alert = "User name must be filled out";
    header($revert . "&msg_alert=" . $msg_alert);
    die();
}else if ($trgt_selctn==2 && !$password) {
    $msg_alert = "DataBase Password must be filled out";
    header($revert . "&msg_alert=" . $msg_alert);
    die();
}

$destn="uploads" .DIR_SEPERATOR. $login_form . DIR_SEPERATOR . getfolder($grp_id,$sgrp_id) . DIR_SEPERATOR . $trgt_name;


if($trgt_selctn==1){
	$tag="file";
	$flag=1;
	$path=upload_files ($tag,$destn);

	if(strrpos($path,DIR_SEPERATOR)===false){
		$flag=0;
		header($revert . "&msg_alert=" . $path);
		die();
	}else{
		$response=check_upload_msisdn("",$path);

		if(!$response){
			$msg_alert="MSISDN File Is Not Valid";
			//unlink($path);
			header($revert . "&msg_alert=" . $msg_alert);
			die();
		}else{
			$tar_id=insert_target_detail($trgt_name,$path,$grp_id,$sgrp_id,$daily_target,$compName);
			$msg_alert = 'Target Successfully Created';
			$pop=1;

			//die();

			header($revert . "&msg_alert=" . $msg_alert."&pop=1");
			die();
		}
	}
}
else if($trgt_selctn==2){
	$mon = date("m");
	$yr = date("Y");
	$da = date("d");
	$hor = date("H");
    $min = date("i");
    $ss = date("s");


	$path=create_folder($destn);

	$path=$path . DIR_SEPERATOR . $yr . $mon . $da . $hor . $min . $ss . '.csv';
	$tar_id=insert_target_detail($trgt_name,$path,$grp_id,$sgrp_id,$daily_target,$compName);
	
	$msg_alert = 'Target Successfully Created';
	$pop=1;
	//$baseurl="Location: target.php?login=" . $login_form . "&sess_id=" . $sess_id . "&page=2&smenu=" . $smenu . "&trgt_name=" . $trgt_name . "&trgt_selctn=" . $trgt_selctn . "&cbo_group=" . $grp_id . "&cbo_sgroup=" . $sgrp_id . "&dailytarget=" . $daily_target . "&cbo_sgroup=" . $sgrp_id;

	//$revert=$baseurl . $urlstr;

	header($revert . "&msg_alert=" . $msg_alert."&pop=1");
	die();

}


function check_target_availability($target_name)
{
    global $login_form;

    $sqlquery = "select target_id from target_detail where target_name='" . $target_name . "' limit 1";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    $trg_avail = 0;
    while($row = mysql_fetch_row($result)){
        $trg_avail = 1;
    }
    return $trg_avail;
}


function insert_target_detail($trgt_name,$path,$grp_id,$sgrp_id,$daily_target,$compName)
{
   global $login_form,$compName;

   if ($daily_target==""){
   	$daily_target = 0;
   }
   $sqlquery = "insert into target_detail (target_name,file_path,group_id,subgroup_id,target_status,login,daily_new_target,target_date,companyName) values ('" . $trgt_name . "','" . addslashes($path) . "','" . $grp_id . "','" . $sgrp_id . "','1', '" . $login_form . "', '0', now(),'".$compName."')";

   $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
   return mysql_insert_id();
}
?>
