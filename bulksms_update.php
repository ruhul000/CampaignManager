<?php	

ob_start();

require("gui_common.php");

global $compName;
echo "cpname : ".$compName=$_REQUEST["cpName"];
//die();

$page = $_REQUEST["page"];
$treeview_cod = $_REQUEST["treeview_cod"];
$login_form = $_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];

$sms_type=(!$_REQUEST["sms_type"])?$_REQUEST["sms_mode_tmp"]:$_REQUEST["sms_type"];
$sms_id = $_REQUEST["sms_id"];
$sms_msg=$_REQUEST["sms_msg"];
$sms_footer=$_REQUEST["sms_footer"];
$wap_title=$_REQUEST["wap_title"];
$wap_url=$_REQUEST["wap_url"];
$lang_sms=$_REQUEST["lang_sms"];

$baseurl="login=" . $login_form . "&sess_id=" . $sess_id ."&smenu=" . $smenu . "&treeview_cod=" . $treeview_cod  . "&cpName=" . $compName;
if($sms_type==1){
	$chkurl="&sms_msg=" . $sms_msg . "&sms_footer=" . $sms_footer."&lang_sms=".$lang_sms . "&cpName=" . $compName;
}else if($sms_type==2){
	$chkurl="&wap_url=" . $wap_url . "&wap_title=" . $wap_title . "&cpName=" . $compName;
}

if ($page==1){
	$strurl = "Location: bulksms_create.php?";
}else if ($page==2){
	$strurl = "Location: bulksms_modify.php?";
}else if ($page==3){
	$strurl = "Location: bulksms_view.php?";
}

$loc=$strurl . $baseurl . $chkurl;

if ($page == 3){
    if (!check_schedular($sms_id)){
    	$msg_alert = "SMS Message Successfully Deleted";
    	$next_id=delete_sms($sms_id);
    }else{
		$msg_alert = "SMS Message exist in Schedular. You cannot delete it!";
		$next_id=$sms_id;
		//header($loc . "&msg_alert=" . $msg_alert);
		//die();
    }


    header($strurl . $baseurl . "&sms_id=" . $next_id . "&msg_alert=" . $msg_alert . "&cpName=" . $compName);
	die();
}

if (!$sms_type){
    $msg_alert = "Please Choose SMS Message Type!";
    header($loc . "&msg_alert=" . $msg_alert . "&cpName=" . $compName);
    die();
}else if ($sms_type==1 && !$lang_sms){
    $msg_alert = "Please Select Language Type Of SMS Message!";
    header($loc . "&msg_alert=" . $msg_alert . "&cpName=" . $compName);
    die();
}else if ($sms_type==1 && !$sms_msg){
    $msg_alert = "Please Enter Text SMS Message!";
    header($loc . "&msg_alert=" . $msg_alert . "&cpName=" . $compName);
    die();
}else if ($sms_type==2 && !$wap_title){
    $msg_alert = "Please Enter WAP Push SMS Title!";
    header($loc . "&msg_alert=" . $msg_alert . "&cpName=" . $compName);
    die();
}else if ($sms_type==2 && !$wap_url){
    $msg_alert = "Please Enter WAP Push SMS Url!";
    header($loc . "&msg_alert=" . $msg_alert . "&cpName=" . $compName);
    die();
}

if ($page==1){


	if($sms_type==1){
		if($lang_sms == 'Thai'){
		//echo "Thai: ".$compName;
			$sms_id=insert_sms($sms_msg,$sms_footer,'3');// 3 FOR OTHER LANGUAGE
		}else{
		//echo "English: ".$compName;
		//die();
			$sms_id=insert_sms($sms_msg,$sms_footer,$sms_type);
		}

	}else if($sms_type==2){
		$wap_title = strToHex($wap_title);
		$sms_id=insert_sms($wap_title,$wap_url,$sms_type);
	}

	$msg_alert = "Message Successfully Created";
	header($strurl . $baseurl . "&msg_alert=" . $msg_alert . "&cpName=" . $compName);
	die();
}else if ($page==2){


	if($sms_type==1){
		if($lang_sms == 'Thai'){
			modify_sms($sms_msg,$sms_footer,'3',$sms_id);
		}else{
			modify_sms($sms_msg,$sms_footer,$sms_type,$sms_id);
		}
	}else if($sms_type==2){
		$wap_title = strToHex($wap_title);
		modify_sms($wap_title,$wap_url,$sms_type,$sms_id);
	}

	$msg_alert = "Message Successfully Updated";
    header($loc . "&sms_id=" . $sms_id . "&msg_alert=" . $msg_alert. "&cpName=" . $compName);
	die();
}

function insert_sms($strmsg1,$strmsg2,$mode)
{
	global $login_form,$lang_sms,$compName;

	$strmsg1 = str_replace("'","''",$strmsg1);
	$strmsg2 = str_replace("'","''",$strmsg2);
	if($lang_sms=='Thai'){
		$strmsg1 = strToHex($strmsg1);
		$strmsg2 = strToHex($strmsg2);
	}
	//$engstring = hexToStr($hexstring);



	$sqlquery = "insert into rules_detail(message,footer_url,sms_mode,login,language,companyName) values('" . $strmsg1 . "','" . $strmsg2 . "','" . $mode . "', '" . $login_form . "','".$lang_sms."','".$compName."')";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	return mysql_insert_id();
}


function modify_sms($strmsg1,$strmsg2,$mode,$sms_id)
{
	global $login_form,$lang_sms,$compName;
	echo "mod: ".$compName;
	
	$strmsg1 = str_replace("'","''",$strmsg1);
	$strmsg2 = str_replace("'","''",$strmsg2);
	if($lang_sms=='Thai'){
		$strmsg1 = strToHex($strmsg1);
		$strmsg2 = strToHex($strmsg2);
	}

	$sqlquery = "update rules_detail set message='" . $strmsg1 . "',footer_url='" . $strmsg2 . "',sms_mode='" . $mode . "',language='".$lang_sms."' where sms_id='" . $sms_id . "' and companyName='" . $compName . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
}


function delete_sms($sms_id)
{
    global $login_form,$compName;
    $sqlquery = "delete from rules_detail where sms_id='" . $sms_id . "'";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    $sqlquery = "select sms_id from rules_detail where companyName='" . $compName . "' order by sms_id desc limit 1";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$next_avail=0;
	while($row = mysql_fetch_row($result)){
		$next_avail=$row[0];
	}
	return $next_avail;
}

function sms_available ($sms_name)
{
    global $login_form;

    $sqlquery = "select id from rules_detail where sms_id='" . $sms_id . "' order by id limit 1";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    $sms_avail = 0;
    while($row = mysql_fetch_row($result)){
        $sms_avail = 1;
    }
    return $sms_avail;
}

function check_schedular ($sms_id)
{
    global $login_form;

    $sqlquery = "select id from list_detail where sms_id ='" . $sms_id . "'";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    $trid = 0;
    while($row = mysql_fetch_row($result)){
    	$trid = 1;
    }
    return $trid;
}
?>
