<?php
require("gui_common.php");

$login_form = $_REQUEST["login"];
$action = $_REQUEST["action"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];

$grp_name = $_REQUEST["grp_name"];
$grp_desc = $_REQUEST["grp_desc"];
$sgrp_name = $_REQUEST["sgrp_name"];
$sgrp_desc = $_REQUEST["sgrp_desc"];
$grp_id = $_REQUEST["grp_id"];
$sgrp_id = $_REQUEST["sgrp_id"];

$active_status=$_REQUEST["active_status"];

$url = "login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&grp_name=" . $grp_name ."&grp_desc=" . $grp_desc ."&grp_id=" . $grp_id . "&sgrp_name=" . $sgrp_name ."&sgrp_desc=" . $sgrp_desc ."&sgrp_id=" . $sgrp_id;
if ($action == 1){
    $active_status=1;
    $strurl = "Location: group_create.php?" . $url;
}elseif ($action == 2){
    $strurl = "Location: group_modify.php?" . $url;
}elseif ($action == 3){
    $group_exist = check_schedular ($grp_id);
    if ($group_exist == 0){
    	delete_group ();
    }elseif ($group_exist == 2){
		$msg_alert = "$grp_name Group exist in Target.You cannot delete it!";
		$strurl = "Location: group_view.php?login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&grp_id=" . $grp_id;
		header($strurl . "&msg_alert=" . $msg_alert);
		die();
    }else{
		$msg_alert = "$grp_name Group exist in Schedular.You cannot delete it!";
		$strurl = "Location: group_view.php?login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&grp_id=" . $grp_id;
		header($strurl . "&msg_alert=" . $msg_alert);
		die();
    }

    $grp_id = next_groupid();

    $msg_alert = "$grp_name Group Successfully Deleted";
    $strurl = "Location: group_view.php?login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&grp_id=" . $grp_id;
    header($strurl . "&msg_alert=" . $msg_alert);
    die();
}

if (!$grp_name){
    $msg_alert = "Please Enter Group Name!";
    header($strurl . "&msg_alert=" . $msg_alert);
    die();
}else if ($action==1 && check_group_availability ($grp_name)) {
    $msg_alert = "Group With This Name Already Exist, Choose Another Name!";
    header($strurl . "&msg_alert=" . $msg_alert);
    die();
}

if (!$grp_desc){
    $msg_alert = "Please Enter Group Description!";
    header($strurl . "&msg_alert=" . $msg_alert);
    die();
}

if ($action == 1){
    $grp_id = insert_group ();
    $msg_alert = "$grp_name Group Successfully Created!";
    header("Location: group_view.php?login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&grp_id=" . $grp_id . "&msg_alert=" . $msg_alert);
    die();
}else if ($action == 2){
    modify_group ();
    $msg_alert = "Group Successfully Updated!";
    header($strurl . "&msg_alert=" . $msg_alert);
    die();
}

function insert_group ()
{
    global $strurl,$login_form,$sess_id,$grp_name,$grp_desc,$active_status;

    $grp_desc = str_replace("'","''",$grp_desc);

    $grp_name = strtolower($grp_name);
    $sqlquery = "insert into group_detail(login, group_name, description, active_status) values('" . $login_form . "', '" . $grp_name . "', '" . $grp_desc . "', '" . $active_status . "')";
    //echo $sqlquery;
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
    return mysql_insert_id();
}

function modify_group ()
{
    global $strurl,$login_form,$sess_id,$grp_name,$grp_desc,$active_status;

    $grp_desc = str_replace("'","''",$grp_desc);
    $grp_name = strtolower($grp_name);

    $sqlquery = "update group_detail set description='" . $grp_desc. "', active_status='" . $active_status . "' where group_name='" . $grp_name . "' and login='" . $login_form . "'";
   // echo $sqlquery;
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    return 1;
}

function delete_group ()
{
    global $login_form,$group_desc,$grp_id,$action,$sess_id,$active_status;

    $sqlquery = "delete from group_detail where group_id='" . $grp_id . "' and login='" . $login_form . "'";
       $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    $sqlquery = "delete from subgroup_detail where group_id='" . $grp_id . "' and login='" . $login_form . "'";
       $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
}

function check_group_availability($group_name)
{
    global $login_form;

    $sqlquery = "select * from group_detail where group_name='" . $group_name . "' limit 1";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    $grp_avail = 0;
    while($row = mysql_fetch_row($result)){
        $grp_avail = 1;
    }
    return $grp_avail;
}

function next_groupid()
{
    global $login_form;

    $sqlquery = "select group_id from group_detail order by group_id desc limit 1";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    $nextid = 0;
    while($row = mysql_fetch_row($result)){
        $nextid = $row[0];
    }
    return $nextid;
}

function check_schedular ($grp_id)
{
    global $login_form;

    $sqlquery = "select target_id from target_detail where group_id='" . $grp_id . "'";
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