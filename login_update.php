<?php
ob_start();

require("gui_common.php");

$login_form = $_REQUEST["login"];
$action = $_REQUEST["action"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$login_type = $_REQUEST["login_type"];

//$grp_name = $_REQUEST["cp_name"];

$grp_desc = $_REQUEST["login_name"];

$password = $_REQUEST["password"];

$name = $_REQUEST["name"];

$comname = $_REQUEST["company_name"];

$address = $_REQUEST["address"];

$contactnum = $_REQUEST["contact_no"];

$eml =$_REQUEST["email"];

$grp_id = $_REQUEST["grp_id"];

if($login_type==2)
{
	$uType =  $_REQUEST["userType"];
} 

echo $login_form." | ".$action." | ".$smenu." | ".$login_type." | ".$grp_desc." | ".$password." | ".$name." | ".$comname." | ".$address." | ".$contactnum." | ".$eml." | ".$grp_id." | ".$userType;


$active_status=$_REQUEST["active_status"];


$url = "login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&cp_name=" . $grp_name ."&login_name=" . $grp_desc."&grp_id=" . $grp_id ;

if ($action == 1)
{
	$active_status=1;
	$strurl = "Location: login_create.php?" . $url;
}
else if ($action == 2)
{
	$strurl = "Location: login_modify.php?" . $url;
}
else if ($action == 3)
{
	delete_group ();
	
	//$grp_id = next_groupid();
	
	$msg_alert = "Login Successfully Deleted";
	
	header("Location: login_view.php?login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&grp_id=" . $grp_id."&msg_alert=" . $msg_alert."&param=1");
	
	die();
	
	
}

/*else if ($action==1) {
// $msg_alert = "Group With This Name Already Exist, Choose Another Name!";
//header($strurl . "&msg_alert=" . $msg_alert);
// die();
}*/

if (!$grp_desc){
	$msg_alert = "Please Enter Login Name!";
	header($strurl . "&msg_alert=" . $msg_alert);
	die();
}

if (!$comname){
	$msg_alert = "Please Enter Company Name!";
	header($strurl . "&msg_alert=" . $msg_alert);
	die();
}

$cp_avail=check_cp_login($grp_desc);


if ($action == 1 && $cp_avail==1){
	$msg_alert = "Login Name Already Exists!";
	header("Location: login_view.php?login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&msg_alert=" . $msg_alert);
	die();
}
else if ($action == 1 && $cp_avail==0)
{
	$grp_id= insert_group ();
	$msg_alert = "$grp_desc Login Successfully Created!";
	header("Location: login_view.php?login=".$login_form."&smenu=".$smenu."&sess_id=".$sess_id."&grp_id=".$grp_id."&msg_alert=".$msg_alert);
	die();
}
/*else if ($action == 2 && $cp_avail==1)
{
	$msg_alert = "Login Name Already Exists!";
	
	header("Location: login_view.php?login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&grp_id=" . $grp_id."&msg_alert=" . $msg_alert."&param=1");
	die();
}*/
else if ($action == 2)
{
	$mod_done=modify_group ();
	if($mod_done==1){
		$msg_alert = "Login Name Successfully Updated!";
	}
	header("Location: login_view.php?login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id . "&grp_id=" . $grp_id."&msg_alert=" . $msg_alert."&param=1");
	die();
}
		// --------------------------------------------------- LOGIN INSERT QUERY--------------------------------------------------------
function insert_group ()
{
	//
	global $strurl,$login_form,$sess_id,$grp_name,$grp_desc,$active_status,$password,$name,$comname,$address,$contactnum,$eml;
	$grp_desc = str_replace("'","''",$grp_desc);

	$grp_name = strtolower($grp_name);
	$sqlquery = "insert  into access_detail
	(date_created,login,password,login_type,access_service,active_status,cp_name,name,companyName,address,email,contactNo, user_type) values
	(now(),'$grp_desc','$password','2','1,2,3,4,5,6,7','1','$grp_name','$name','$comname','$address','$eml', '$contactnum','Company Admin')";
			          
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
			
	return mysql_insert_id();
}

function modify_group ()
{
global $strurl,$login_form,$sess_id,$grp_name,$grp_desc,$active_status,$password,$name,$comname,$address,$contactnum,$eml,$login_type,$uType,$grp_id;

	// --------------------------------------------------- LOGIN UPDATE QUERY--------------------------------------------------------
	if($login_type==2)
	{
		
	$sqlquery = "update access_detail set login='" . $grp_desc. "', password='" . $password . "', name='" . $name. "', address='" . $address. "', 		companyName='" . $comname. "', contactNo='" . $contactnum. "', email='" . $eml. "',user_type='" . $uType. "' where id='" .$grp_id. "' ";
	}
	else
	{
	$sqlquery = "update access_detail set login='" . $grp_desc. "', password='" . $password . "', name='" . $name. "', address='" . $address. "', companyName='" . $comname. "', contactNo='" . $contactnum. "', email='" . $eml. "' where id=$grp_id";
	}	
			
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	
		
	return $result;	
}
		// --------------------------------------------------- LOGIN DELETE QUERY--------------------------------------------------------
function delete_group ()
{
	global $login_form,$group_desc,$grp_id,$action,$sess_id,$active_status;

	$sqlquery = "delete from access_detail where id='" . $grp_id . "' ";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

}
		// --------------------------------------------------- CHECK LOGIN QUERY--------------------------------------------------------
function check_cp_login($grp_desc)
{
	global $login_form;

	$sqlquery = "select * from access_detail where  login= '" . $grp_desc . "' limit 1";
	//echo "CP".$sqlquery;
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$grp_avail = 0;
	while($row = mysql_fetch_row($result)){
		$grp_avail = 1;
	}
	return $grp_avail;
}


function check_cp_mod($login_mod)
{
	global $login_form;

	$sqlquery = "select * from access_detail where  login= '" . $login_mod . "' limit 1";
	//echo "CP".$sqlquery;
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

	$sqlquery = "select id from access_detail order by id desc limit 1";
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