<?php require("upload.php");
require("gui_common.php");

$trgt_name=$_REQUEST['trgt_name'];
$trgt_selctn=$_REQUEST['trgt_selctn'];
$grp_id=$_REQUEST['cbo_group'];
$sgrp_id=$_REQUEST['cbo_sgroup'];
$host_ip=$_REQUEST['host_ip'];
$db_name=$_REQUEST['db_name'];
$db_user=$_REQUEST['db_user'];
$db_pwd=$_REQUEST['db_pwd'];
$login_form=$_REQUEST['login'];
$sess_id=$_REQUEST['sess_id'];
$smenu=$_REQUEST['smenu'];
$checkValue=$_REQUEST['checkValue'];
//echo $checkValue;

$strurl = "Location: dnd.php?login=" . $login_form ."&smenu=" . $smenu ."&sess_id=" . $sess_id;
if (!$grp_id){
    $msg_alert = "Please Choose Group Name";
    header($strurl . "&msg_alert=" . $msg_alert);
    die();
}else if (!$sgrp_id) {
    $msg_alert = "Please Choose Sub Group Name";
    header($strurl . "&msg_alert=" . $msg_alert);
    die();
}
$fileloc=check_dnd_availability($grp_id,$sgrp_id);
 
if($fileloc!="" && $checkValue==1){
	$destn="uploads/" . $login_form . "/" . getfolder($grp_id,$sgrp_id) . "/dnd";
}else if($fileloc!=""){
	$destn="uploads/" . $login_form . "/" . getfolder($grp_id,$sgrp_id);
}else{
	$destn="uploads/" . $login_form . "/" . getfolder($grp_id,$sgrp_id) . "/dnd";
}

$tag="file";
$flag=1;
$path=upload_files ($tag,$destn);	//return path or upload error

if(strrpos($path,"/")===false){
	$flag=0;
	header($strurl . "&msg_alert=" . $path);
	die();
}else{
	$response=check_upload_msisdn($fileloc,$path);

	if(!$response){
		$msg_alert="Base file is not valid";
		unlink($path);
		header($strurl . "&msg_alert=" . $msg_alert);
		die();
	}else{
		if($fileloc!="" && $checkValue==1){

			 //$sqlquery = "select file_path from dnd_detail where group_id='" . $grp_id . "' and subgroup_id='" . $sgrp_id . "' limit 1";
			 $sqlquery="delete from dnd_detail where group_id='" . $grp_id . "' and subgroup_id='" . $sgrp_id . "'";
    		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
    		if($result){
    			if($fileloc != $path){
    				unlink($fileloc);
    			}    				
    			$tar_id=insert_dnd_detail($path,$grp_id,$sgrp_id);
				$msg_alert = 'DND Successfully Created';
			}			
		}else if($fileloc!=""){
			//echo $fileloc;
			$msg_alert = 'DND Successfully Updated';
			unlink($path);
		}else{
			$tar_id=insert_dnd_detail($path,$grp_id,$sgrp_id);
			$msg_alert = 'DND Successfully Created';
		}
		if($fileloc!="" && $checkValue==1){
			header($strurl . "&msg_alert=" . $msg_alert."&display=1&path=".$path);
		}else if($fileloc!=""){
		header($strurl . "&msg_alert=" . $msg_alert."&display=1&path=".$fileloc);
		}else{
			header($strurl . "&msg_alert=" . $msg_alert."&display=1&path=".$path);
		}
		die();
	}
}

function check_dnd_availability($grp_id,$sgrp_id)
{
    global $login_form;

    $sqlquery = "select file_path from dnd_detail where group_id='" . $grp_id . "' and subgroup_id='" . $sgrp_id . "' limit 1";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    $trg_avail=0;
    while($row = mysql_fetch_row($result)){
        $trg_avail=$row[0];
    }
    return $trg_avail;
}

function insert_dnd_detail($path,$grp_id,$sgrp_id)
{
   global $login_form;

   $sqlquery = "insert into dnd_detail (group_id,subgroup_id,file_path,login) values ('" . $grp_id . "','" . $sgrp_id . "','" . $path . "','" . $login_form . "')";
   $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
   return mysql_insert_id();
}

?>