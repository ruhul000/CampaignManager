<?php require("connection_mmc.php"); //adding connection file
set_time_limit(0);
/*********HEADER OF PG*********/

/****'*****FOR REDIRECTION TO PREV PG*********/

function check_blank ($param){
	$varbool = 0;
	if ($param==''){
		$varbool=1;
	}
	return $varbool;
}

function current_datetime(){
	global $curr_year, $curr_month, $curr_date, $curr_hour, $curr_min, $curr_second;
	$curr_year = date("Y");
	$curr_month = date("m");
	$curr_date = date("d");
	$curr_hour = date("H");
	$curr_min = date("i");
	$curr_second = date("s");
}

function hour_display($hr){
	$tmp1="";
	for ($i=0;$i<24;$i++){
		if(strlen($i)==1){
			$tmp1="0" . $i;
		}else{
			$tmp1=$i;
		}

		$curr_hour = date("H");

		if ($tmp1==$curr_hour){?>
<Option value="<? echo $tmp1; ?>" selected="selected"><? echo $tmp1; ?></Option>
		<?}else{?>
<Option value="<? echo $tmp1; ?>"><? echo $tmp1; ?></Option>
		<?}
	}
}
function hour_display1($hr){
	$tmp1="";
	for ($i=0;$i<24;$i++){
		if(strlen($i)==1){
			$tmp1="0" . $i;
		}else{
			$tmp1=$i;
		}

		//$curr_hour = date("H");

		if ($tmp1==$hr){?>
<Option value="<? echo $tmp1; ?>" selected="selected"><? echo $tmp1; ?></Option>
		<?}else{?>
<Option value="<? echo $tmp1; ?>"><? echo $tmp1; ?></Option>
		<?}
	}
}

function minute_display($mn){
	$tmp2="";
	for ($i=0;$i<60;$i+=10){
		if(strlen($i)==1){$tmp2="0" . $i;}
		else{$tmp2=$i;}

		if ($tmp2==$mn){?>
<Option value='<? echo $tmp2; ?>' selected='selected'><? echo $tmp2; ?></Option>
		<?}else{?>
<Option value='<? echo $tmp2; ?>'><? echo $tmp2; ?></Option>
		<?}
	}
}

function fnd_ext ($file_name){
	if ($file_name != ''){
		$file_format = substr($file_name, stripos($file_name, "."));
	}
	return $file_format;
}

/****'*****MAKE TARGET BASE*********/

function request_entry($tab_name, $file_name_upload, $grp_id, $subgrp_id){
	global $conn;
	//echo "file_name_upload=" . $file_name_upload;
	$fp = fopen(strtolower($file_name_upload), "r") or exit("Unable to open file!");

	if ($subgrp_id == ""){
		$deletestr = "delete from " . $tab_name . " where group_id='" . $grp_id . "' and subgroup_id='0'";
	}else{
		$deletestr = "delete from " . $tab_name . " where group_id='" . $grp_id . "' and subgroup_id='" . $subgrp_id . "'";
	}

	$result = mysql_query($deletestr,$conn);
	while(!feof($fp)){
		$msisdn = fgets($fp);
		$msisdn = trim($msisdn);
		$insertstr = "insert into " . $tab_name . " (mobile_no, group_id, subgroup_id, active_status) values ('" . $msisdn ."', '" . $grp_id . "', '" . $subgrp_id . "', '1')";

		//echo $insertstr;

		if ($msisdn != ""){
			//echo "<br>dsss=" . $insertstr;
			$result = mysql_query($insertstr,$conn);
		}
	}
	fclose($fp);
}

function contest_qestion_detail ($cnts_id){
	global $conn;
	$sqlquery = "select if(max(ques_no)>0,max(ques_no)+1,1) cnt from contest_questions where contest_id='" . $cnts_id . "'";
	$result = mysql_query($sqlquery,$conn) or die('mysql error:' . mysql_error());
	while($row = mysql_fetch_row($result)){
		$ques_no = $row[0];
	}
	return $ques_no;
}

function voting_qestion_detail ($cnts_id){
	global $conn;
	$sqlquery = "select if(max(ques_no)>0,max(ques_no)+1,1) cnt from voting_questions where voting_id='" . $cnts_id . "'";
	$result = mysql_query($sqlquery,$conn) or die('mysql error:' . mysql_error());
	while($row = mysql_fetch_row($result)){
		$ques_no = $row[0];
	}
	return $ques_no;
}


function user_session($lg,$sess_id,$msg){
	global $conn;

	if(strlen($lg)<1){
		$msg_alert = "!!!!!!!!!!!!!!!Login Here Again!!!!!!!!!!!!!!!!!!!!!!";
		header("Location: index.php?msg_alert=" . $msg_alert ."");
		die();
	}else{
		$mon = date("m");
		$yr = date("Y");
		$da = date("d");
		$hor = date("H");
		$min = date("i");
		$ss = date("s");
		$duration_min=30;
		$new_date = date("Y-m-d H:i:s",mktime($hor-1,$min-$duration_min,$ss,$mon,$da,$yr));

		if($msg=="newuser"){
			$msg = "Login Success!!!";
			$sqlquery = "select id from access_detail where login = '" . $lg . "'";
		}else{
			$sqlquery="select id from mmc_session where timestamp>'" . $new_date ."' and timestamp < now() and sess_id='" . $sess_id . "' and login_created='" . $lg . "' order by id desc limit 1";
		}
		$result=mysql_query($sqlquery,$conn);

		while($row=mysql_fetch_row($result)){
			$id=$row[0];
		}
		//echo $sqlquery."<br>and id is: $id ";

		if($id){
			$sqlquery = "insert into mmc_session (login_created, login_history, timestamp, sess_id) values ('" . $lg . "', '" . $msg . "', now(),'" . $sess_id ."')";
			$result = mysql_query($sqlquery,$conn) or die('mysql error:' . mysql_error());
			//			echo $sqlquery;
			$msg = "";
		}else{
			$msg_alert = "Login Here Again!!!";
			header("Location: index.php?msg_alert=" . $msg_alert ."");
			die();
		}
	}
}

function check_login(){
	global $conn;
	$login_form = $_REQUEST["login"];
	$password_form = $_REQUEST["password"];

	if(strlen($login_form)<1 || strlen($password_form)<1){
		$msg_alert = "Either login or password is not correct!!!";
		header("Location: index.php?msg_alert=" . $msg_alert ."");
	}else{
		$sqlquery = "select login from access_detail where login = '" . $login_form . "' and password = '" . $password_form . "'";
		$result = mysql_query($sqlquery,$conn) or die('mysql error in check_login:' . mysql_error());

		$test = 0;
		while($row = mysql_fetch_row($result)){
			$test = 1;
		}

		if($test == 1){
			header("Location: plain.php?login=" . $login_form . "");
		}else{
			$msg_alert = "Enther login or password is not correct!!!";
			header("Location: index.php?msg_alert=" . $msg_alert ."");
		}
	}
}

function contest_available1 ($cnts_name){
	global $conn;

	$sqlquery = "select * from contest_detail where contest_name='" . $cnts_name . "' and contest_id!='" . $cnts_id . "' limit 1";
	$result = mysql_query($sqlquery,$conn) or die('mysql error:' . mysql_error());
	$cnts_avail = 0;
	while($row = mysql_fetch_row($result)){
		$cnts_avail = 1;
	}
	return $cnts_avail;
}

function valid_db($query_str,$conn_mysql){
	if($query_str=="table detail"){
		$result = mysql_query("show tables",$conn_mysql) or die('mysql error:' . mysql_error());

		while($row=mysql_fetch_row($result)){
			$table_name = $table_name . "," . $row[0];
		}
	}else if($query_str!=""){
		$result = mysql_query("desc $query_str",$conn_mysql) or die('mysql error:' . mysql_error());
		while($row=mysql_fetch_row($result)){
			$table_name = $table_name . "," . $row[0];
		}
	}

	$table_name=trim($table_name,',');
	return $table_name;
}

function getfolder($grp_id,$sgrp_id){
	$sqlquery = "select grp.group_name,sgrp.subgroup_name from group_detail grp,subgroup_detail sgrp where grp.group_id=sgrp.group_id and grp.group_id='" . $grp_id . "' and sgrp.subgroup_id='" . $sgrp_id . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$temp="";
	while($row = mysql_fetch_row($result)){
		$temp=$row[0] . "/" . $row[1];
	}
	return $temp;
}

function check_upload_msisdn($fileloc,$filename){
	$handle = fopen($filename, "r");
	$contents = fread($handle,filesize($filename));
	fclose($handle);
	$bufstr = str_replace("\n","",$contents);
	$bufstr = str_replace("\r","",$bufstr);

	/** For number checking in file */
	$bufstr1 = str_replace("\n"," ",$contents);
	$bufstr1 = str_replace("\r","",$bufstr1);
	$bufstr1=explode(" ",$bufstr1);
	//print_r ($bufstr);
	$bufstr1=array_unique($bufstr1);
	//print_r ($bufstr1);

	if (ctype_digit($bufstr)) {
		if($fileloc){
			// If New Line Exist
			$handle1 = fopen($fileloc, "r");
			$contents1 = fread($handle1,filesize($fileloc));

			$contents1 = trim($contents1,"\n");
			$handle1 = fopen($fileloc, "w");
			fwrite($handle1,$contents1,strlen($contents1));
			fclose($handle1);

			$handle1 = fopen($fileloc, "r");
			$contents1 = fread($handle1,filesize($fileloc));


			//echo $contents1;

			//print_r ($bufstr1);
			$contents2="";
			for($i=0;$i<count($bufstr1);$i++)
			{
				//echo $bufstr1[$i] . "<br/>";
				if($bufstr1[$i]!=""){
					if(strpos($contents1,$bufstr1[$i])===false){
						//$contents2=$contents2.$bufstr1[$i]."\n";
						$contents2=$contents2."\n".$bufstr1[$i];

					}
				}
			}

			$handle = fopen($fileloc, "a");
			fwrite($handle,$contents2,strlen($contents2));
			fclose($handle);

			//fwrite($handle,$contents2,strlen($contents2));

		}
		return 1;
	}else{
		return 0;
	}
}


function month_display (){
	$mon = date("m");
	if ($mon == 1){?>
<Option value="01" selected="selected">Jan</Option>
	<?}else{?>
<Option value="01">Jan</Option>
	<?}
	if ($mon == 2){?>
<Option value="02" selected="selected">Feb</Option>
	<?}else{?>
<Option value="02">Feb</Option>
	<?}
	if ($mon == 3){?>
<Option value="03" selected="selected">Mar</Option>
	<?}else{?>
<Option value="03">Mar</Option>
	<?}
	if ($mon == 4){?>
<Option value="04" selected="selected">April</Option>
	<?}else{?>
<Option value="04">April</Option>
	<?}
	if ($mon == 5){?>
<Option value="05" selected="selected">May</Option>
	<?}else{?>
<Option value="05">May</Option>
	<?}
	if ($mon == 6){?>
<Option value="06" selected="selected">June</Option>
	<?}else{?>
<Option value="06">June</Option>
	<?}
	if ($mon == 7){?>
<Option value="07" selected="selected">July</Option>
	<?}else{?>
<Option value="07">July</Option>
	<?}
	if ($mon == 8){?>
<Option value="08" selected="selected">Aug</Option>
	<?}else{?>
<Option value="08">Aug</Option>
	<?}
	if ($mon == 9){?>
<Option value="09" selected="selected">Sep</Option>
	<?}else{?>
<Option value="09">Sep</Option>
	<?}
	if ($mon == 10){?>
<Option value="10" selected="selected">Oct</Option>
	<?}else{?>
<Option value="10">Oct</Option>
	<?}
	if ($mon == 11){?>
<Option value="11" selected="selected">Nov</Option>
	<?}else{?>
<Option value="11">Nov</Option>
	<?}
	if ($mon == 12){?>
<Option value="12" selected="selected">Dec</Option>
	<?}else{?>
<Option value="12">Dec</Option>
	<?}
}

function get_month ($month) {
	if ($month == 01){
		$sh_month = "Jan";
	}elseif ($month == 02){
		$sh_month = "Feb";
	}elseif ($month == 03){
		$sh_month = "March";
	}elseif ($month == 04){
		$sh_month = "April";
	}elseif ($month == 05){
		$sh_month = "May";
	}elseif ($month == 06){
		$sh_month = "June";
	}elseif ($month == 07){
		$sh_month = "July";
	}elseif ($month == 08){
		$sh_month = "Aug";
	}elseif ($month == "09"){
		$sh_month = "Sep";
	}elseif ($month == 10){
		$sh_month = "Oct";
	}elseif ($month == 11){
		$sh_month = "Nov";
	}elseif ($month == 12){
		$sh_month = "Dec";
	}

	return $sh_month;
}

function day_display ($month)
{
	if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
		$lsmth = 31;
	}elseif ($month == 2){
		$lsmth = 28;
	}else{
		$lsmth = 30;
	}
	return $lsmth;
}

function year_display (){
	$yr = date("Y");
	if ($yr == 2008){?>
<Option value="2008" selected="selected">2008</Option>
	<?}else{?>
<Option value="2008">2008</Option>
	<?}
}

function hexToStr($hex)
{
	/*	$string='';
	 for ($i=0; $i < strlen($hex)-1; $i+=2)
	 {
		$string .= chr(hexdec($hex[$i].$hex[$i+1]));
		}
		return $string;
		*/
	//	return utf8_decode($hex);
	return $hex;
}

function strToHex($string)
{
	/*	$hex='';
	 for ($i=0; $i < strlen($string); $i++)
	 {
		$hex .= dechex(ord($string[$i]));
		}
		return $hex;
		*/
	return $string;
}

function strToHexNew($str)
{
	for ($i=0;$i<strlen($str);$i+=2)
	{
		$substring1 = $str[$i].$str[$i+1];
		$substring2 = $str[$i+2].$str[$i+3];

		if (hexdec($substring1) < 127){
			$results = "00".$str[$i].$str[$i+1];
		}
		else
		{
			$results = dechex((hexdec($substring1)-192)*64 + (hexdec($substring2)-128));
			if ($results < 1000) $results = "0".$results;
			$i+=2;
		}
		$ucs2 .= $results;
	}
	return $ucs2;
}

function get_service(){
	$sqlquery = "select service_id,service_name from service_detail where active_status=1";
	$result = mysql_query($sqlquery) or die('Mysql Error Service:' . mysql_error());
	$msg = '';

	while($row = mysql_fetch_row($result)){
		$ser_value = get_service_name($row[0]);
		if($msg == ''){
			$msg = "<option value='".$ser_value."'>$row[1]</option>";
		}else{
			$msg = $msg."<option value='".$ser_value."'>$row[1]</option>";
		}
	}

	return $msg;
}

function get_service_name($service_id){
	$sqlquery = "select keyword from service_detail where service_id='".$service_id."'";
	$result = mysql_query($sqlquery) or die('Mysql Error Service:' . mysql_error());
	$row = mysql_fetch_row($result);
	$keyword = $row[0];


	$sqlquery = "select alias_keyword from service_detail_alias where service_id='".$service_id."'";
	$result = mysql_query($sqlquery) or die('Mysql Error Service:' . mysql_error());
	$msg = '';
	while($row = mysql_fetch_row($result)){
		if($msg == ''){
			$msg = $row[0];
		}else{
			$msg = $msg.",".$row[0];
		}
	}
	$keyword = $keyword.",".$msg;
	return $keyword;
}
?>
