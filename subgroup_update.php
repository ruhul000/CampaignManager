<?php
require("gui_common.php");

$login_form = $_REQUEST["login"];
$action = $_REQUEST["action"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];

$grp_name = $_REQUEST["grp_name"];
$sgrp_name = $_REQUEST["sgrp_name"];
$sgrp_desc = $_REQUEST["sgrp_desc"];
$grp_id = $_REQUEST["grp_id"];
$sgrp_id = $_REQUEST["sgrp_id"];
$active_status=$_REQUEST["active_status"];

$url = "login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&grp_name=" . $grp_name ."&grp_desc=" . $grp_desc . "&grp_id=" . $grp_id . "&sgrp_name=" . $sgrp_name ."&sgrp_desc=" . $sgrp_desc . "&sgrp_id=" . $sgrp_id;
if ($action == 1){
    $active_status=1;
    $strurl = "Location: subgroup_create.php?" . $url;
}elseif ($action == 2){
    $strurl = "Location: subgroup_modify.php?" . $url;
}elseif ($action == 3){
    $group_exist = check_schedular ($sgrp_id);
    if ($group_exist == 0){
    	delete_subgroup ();
    }elseif ($group_exist == 2){
		$msg_alert = "$grp_name Sub Group exists in Target. You cannot delete it!";
		$strurl = "Location: group_view.php?login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&grp_id=" . $grp_id;
		header($strurl . "&msg_alert=" . $msg_alert);
		die();
    }else{
		$msg_alert = "$sgrp_name Sub Group exists in Schedular. You cannot delete it!";
		$strurl = "Location: subgroup_view.php?login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&sgrp_id=" . $sgrp_id . "&grp_id=" . $grp_id;
		header($strurl . "&msg_alert=" . $msg_alert);
		die();
    }

    $sgrp_id = next_subgroup_id($grp_id);
    $msg_alert = "$sgrp_name Group Successfully Deleted!";
    $strurl = "Location: subgroup_view.php?login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&grp_id=" . $grp_id . "&sgrp_id=" . $sgrp_id;

    header($strurl . "&msg_alert=" . $msg_alert);
    die();
}

if (!$grp_id){
    $msg_alert = "Please Select Group Name!";
    header($strurl . "&msg_alert=" . $msg_alert);
    die();
}

if (!$sgrp_name){
    $msg_alert = "Please Enter Sub Group Name!";
    header($strurl . "&msg_alert=" . $msg_alert);
    die();
}else if ($action==1 && check_subgroup_availability($subgrp_name)){
    $msg_alert = "Sub Group With This Name Already Exist, Choose Another Name!";
    header($strurl . "&msg_alert=" . $msg_alert);
    die();
}

if (!$sgrp_desc){
    $msg_alert = "Please Enter Sub Group Description!";
    header($strurl . "&msg_alert=" . $msg_alert);
    die();
}

if ($action == 1){
    $sgrp_id = insert_subgroup ();
    $msg_alert = "$sgrp_name Sub Group Successfully Created!";
    header("Location: subgroup_view.php?login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&grp_id=" . $grp_id . "&sgrp_id=" . $sgrp_id . "&msg_alert=" . $msg_alert);
    die();
}elseif ($action == 2){
    $status = modify_subgroup ();
    $msg_alert = 'Sub Group Successfully Updated!';
    header($strurl . "&msg_alert=" . $msg_alert);
    die();
}

function insert_subgroup ()
{
    global $login_form, $sess_id, $sgrp_name, $sgrp_desc, $grp_id,$active_status;

    $sgrp_desc = str_replace("'","''",$sgrp_desc);

    $sgrp_name = strtolower($sgrp_name);
    $sqlquery = "insert into subgroup_detail(login, group_id, subgroup_name, description, active_status) values('" . $login_form . "', '" . $grp_id. "', '" . $sgrp_name . "', '" . $sgrp_desc . "', '" . $active_status . "')";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
    return mysql_insert_id();
}

function modify_subgroup ()
{
    global $login_form, $sess_id, $sgrp_desc, $grp_id, $sgrp_id, $active_status;

    $sgrp_desc = str_replace("'","''",$sgrp_desc);

    $sgrp_name = strtolower($sgrp_name);
    $sqlquery = "update subgroup_detail set description='" . $sgrp_desc . "', active_status='" . $active_status . "' where subgroup_id='" . $sgrp_id . "' and login='" . $login_form . "'";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
    return 1;
}

function delete_subgroup ()
{
    global $login_form,$grp_id,$sgrp_id,$sess_id;

    $sqlquery = "delete from subgroup_detail where subgroup_id='" . $sgrp_id . "' and login='" . $login_form . "'";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
    return $grp_id;
}

function check_subgroup_availability ($subgrp_name)
{
    $sqlquery = "select * from subgroup_detail where subgroup_name='" . $subgrp_name . "' limit 1";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    $grp_avail = 0;
    while($row = mysql_fetch_row($result)){
        $grp_avail = 1;
    }
    return $grp_avail;
}

function next_subgroup_id ($grp_id)
{
    $sqlquery = "select subgroup_id from subgroup_detail where group_id='" . $grp_id . "' order by subgroup_id desc limit 1";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    $next_sgrp="";
    while($row = mysql_fetch_row($result)){
        $next_sgrp = $row[0];
    }
    return $next_sgrp;
}

function check_schedular ($subgrp_id)
{

    $sqlquery = "select group_id from subgroup_detail where subgroup_id='" . $subgrp_id . "'";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
    while($row = mysql_fetch_row($result)){
        $grpid = $row[0];
    }

    $sqlquery = "select target_id from target_detail where group_id='" . $grpid . "'";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    $trid1 = 0;
    while($row = mysql_fetch_row($result)){
    	$trid1 = 2;
        if ($targetid == ""){
        	$targetid = $row[0];
        }else{
        	$targetid = $targetid . "," . $row[0];
        }
    }

    $sqlquery = "select target_id from list_detail where target_id in ('" . $targetid . "')";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    $trid = 0;
    while($row = mysql_fetch_row($result)){
    	$trid = 1;
    }

    if ($trid == 0){
    	$trid = $trid1;
    }
    return $trid;
}
?>
