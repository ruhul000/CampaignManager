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

$daily_target=$_REQUEST["dailytarget"];

if ($daily_target=="false"){
	$daily_target=0;
}else{
	$daily_target=1;
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


global $trg_query,$target_arr,$target_file_path,$target_query,$target_date,$target_date_field,$target_cron_date,$target_cron_flag,$target_day,$target_month,$target_year;

//******************************************
get_target_id();

for ($i1=0;$i1<count($target_arr);$i1++){
	//echo "<br>test_Cron for loop";
	$trgt_file_path = $target_file_path[$i1];

	echo "<br><br>1.File PAth = " . $trgt_file_path;
	$trgt_pos = strrpos($trgt_file_path,"/");
	$final_file_name = substr($trgt_file_path,$trgt_pos+1);

	$final_file_name1 = substr($trgt_file_path,0,$trgt_pos+1);

	chdir($final_file_name1);
	//unlink($final_file_name);

	$final_conn_file = $final_file_name1 . "connection.php";
	echo "<br><br>2.final_file_name1" . $final_file_name1;
	echo "<br><br>3.final_conn_file" . $final_conn_file;

	if(is_file("$final_conn_file") && $retval){
		require_once("$final_conn_file");
		$mon = date("m");

		$yr = date("Y");
		$da = date("d");
		$hor = date("H");
		$min = date("i");
		$ss = date("s");
		$temp_path=create_folder($destn);
		$path=$trgt_file_path;

		try {
			$sqlquery="select distinct " . $msisdn . " from " . $table_fld;

			if($clause)
			$sqlquery=$sqlquery . " where " . $clause;
			$sqlquery=$sqlquery . " " . " limit 400000";

			$yr = date("Y");
			$da = date("d");

			$sqlquery = str_replace("limit 400000","",$target_query[$i1]);

			$pos1 = stripos(strtolower($target_query[$i1]), "where");

			if ($target_cron_flag[$i1]==0){
				if ($pos1>0){
					$sqlquery = $sqlquery . " and " . $target_date_field[$i1] . ">=" .  "'" . $target_date[$i1] . "'" . " and day(" . $target_date_field[$i1] . ")<" .  "'" . $target_day[$i1] . "' and month(" . $target_date_field[$i1] . ")<=" .  "'" . $target_month[$i1] . "' and year(" . $target_date_field[$i1] . ")<=" .  "'" . $target_year[$i1] . "' limit 400000";
				}else{
					$sqlquery = $sqlquery . " where " . $target_date_field[$i1] . ">=" .  "'" . $target_date[$i1] . "'" . " and day(" . $target_date_field[$i1] . ")<" .  "'" . $target_day[$i1] . "' and month(" . $target_date_field[$i1] . ")<=" .  "'" . $target_month[$i1] . "' and year(" . $target_date_field[$i1] . ")<=" .  "'" . $target_year[$i1] . "' limit 400000";
				}
			}elseif ($target_cron_flag[$i1]==1){
				$t_day = $target_day[$i1]-1;
				$yr = date("Y");
				$da = date("d");
				$mo = date("m");
				$t_day = $da-1;

				if ($pos1>0){
					$sqlquery = $sqlquery . " and day(" . $target_date_field[$i1] . ")=" .  "'" . $t_day . "'" . " and month(" . $target_date_field[$i1] . ")=" .  "'" . $mo . "'" . " and year(" . $target_date_field[$i1] . ")=" .  "'" . $yr . "' limit 400000";
				}else{
					$sqlquery = $sqlquery . " where day(" . $target_date_field[$i1] . ")=" .  "'" . $t_day . "'" . " and month(" . $target_date_field[$i1] . ")=" .  "'" . $mo . "'" . " and year(" . $target_date_field[$i1] . ")=" .  "'" . $yr . "' limit 400000";
				}

			}

			echo "<br><br>5.SqlQuery = " . $sqlquery;
			$temp='mysql -h' . $location . ' -u' . $username . ' -p' . $password . ' ' . $database . ' -e "' . $sqlquery . '">' . $path.';';
			echo "<br><br>6.Temp New= " . $temp . "<br><br>";
			$output = exec($temp);
			$handle = fopen($path, "r");
			$contents = fread($handle,filesize($path));
			fclose($handle);

			if(!$contents){
				delete_dir($temp_path);
				$msg_alert = 'Null Record Set';
				echo "Sorry, No Record Set Found!";
			}else{
				$msg_alert = 'Target Successfully Created';
				update_cron_flag($target_arr[$i1]);
				echo "<br><br>Target Successfully Created";
			}
		} catch(Exception $e){
			$retval=0;
			echo "Sorry, Database Server Not Accessible";
		}
	}else{
		echo "Sorry,Active Database Server Not Found";
	}
}

//******************************************

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

function get_target_path($target_id)
{
    global $trg_query;

    $sqlquery = "select file_path,target_query from target_detail where target_id='" . $target_id . "' limit 1";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
    while($row = mysql_fetch_row($result)){
        $trg_file_path = $row[0];
        $trg_query = $row[1];
    }
    return $trg_file_path;
}

function get_target_id()
{
    global $trg_query,$target_arr,$target_file_path,$target_query,$target_date,$target_date_field,$target_cron_date,$target_cron_flag,$target_day,$target_month,$target_year;

    $sqlquery = "select target_id,file_path,target_query,target_date,date_field,cron_start_date,cron_flag,day(cron_start_date),month(cron_start_date),year(cron_start_date) from target_detail where daily_new_target=1 and day(cron_start_date)<=day(now())";
    echo "<br>" . $sqlquery;
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
    $j = 0;
    while($row = mysql_fetch_row($result)){
        $target_arr[$j]= $row[0];
        $target_file_path[$j]= $row[1];
        $target_query[$j]= $row[2];
        $target_date[$j]= $row[3];
        $target_date_field[$j]= $row[4];
        $target_cron_date[$j]= $row[5];
        $target_cron_flag[$j]= $row[6];
        $target_day[$j]= $row[7];
        $target_month[$j]= $row[8];
        $target_year[$j]= $row[9];
    	$j = $j + 1;
    }
}


function insert_target_detail($trgt_name,$path,$grp_id,$sgrp_id,$daily_target,$sqlquery)
{
   global $login_form;

   include("connection_mmc.php");
   $sqlquery = "insert into target_detail (target_name,file_path,group_id,subgroup_id,target_status,login,daily_new_target,target_query) values ('" . $trgt_name . "','" . $path . "','" . $grp_id . "','" . $sgrp_id . "','1','" . $login_form . "','" . $daily_target . "','" . $sqlquery . "')";
   //echo $sqlquery;

   $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
   return mysql_insert_id();
}

function update_cron_flag($trgt_id)
{
   include("connection_mmc.php");
   $sqlquery = "update target_detail set cron_flag='1' where target_id='" . $trgt_id . "'";
   //echo $sqlquery;

   $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
   return mysql_insert_id();
}

function check_target_date($target_name)
{
    $sqlquery = "select target_id from target_detail where target_name='" . $target_name . "' limit 1";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
    $trg_avail = 0;
    while($row = mysql_fetch_row($result)){
        $trg_avail = 1;
    }
    return $trg_avail;
}

?>