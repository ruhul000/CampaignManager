<?php

ob_start();
require("upload.php");
require("gui_common.php");
require("template.php");

echo "<br>Voting engine update: ".$compName = $_REQUEST["cpName"];
$action=$_REQUEST["action"];			//1-new,2-update,3-delete
$treeview_cod=$_REQUEST["treeview_cod"];
$smenu=$_REQUEST["smenu"];

$login_form=$_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$cnts_id=$_REQUEST["cnts_id"];
$msg_alert=$_REQUEST["msg_alert"];
$cnts_name=$_REQUEST["voting_name"];
$welcome_msg=$_REQUEST["welcome_msg"];
$cnts_type=isset($_REQUEST["voting_type"]) && $_REQUEST["voting_type"]!='' ? $_REQUEST["voting_type"] : '0' ;
$s_date=$_REQUEST["s_date"];
$e_date=$_REQUEST["e_date"];
$s_hour=$_REQUEST["s_hour"];
$e_hour=$_REQUEST["e_hour"];
$s_minute=$_REQUEST["s_minute"];
$e_minute=$_REQUEST["e_minute"];
$score=isset($_REQUEST["score"]) && $_REQUEST["score"]!='' ? $_REQUEST["score"] : '0';
$checkscore=($_REQUEST["checkscore"]!="")?'1':'0';
if($checkscore){
	$negscore=$_REQUEST["negscore"];
}else{
	$negscore="";
}
$c_score=($_REQUEST["c_score"]!="")?'1':'0';
$t_score=($_REQUEST["t_score"]!="")?'1':'0';
$w_score=($_REQUEST["w_score"]!="")?'1':'0';

$checkkey=($_REQUEST["checkkey"]!="")?'1':'0';
if($checkkey){
	$keyword=$_REQUEST["keyword"];
	$alischk=($_REQUEST["alischk"]!="")?'1':'0';

	if($alischk){

		$aliastxt=$_REQUEST["aliastxt"];
	}else{
		$aliastxt="";
	}
	$shortcode=$_REQUEST["shortcode"];
}else{
	$keyword="";
	$alischk='0';
	$aliastxt="";
	$shortcode="0";
}

//echo $keyword . $alischk . $aliastxt;
//die();


$checkbill=($_REQUEST["checkbill"]!="")?'1':'0';

if($checkbill){
	$app_id=$_REQUEST["app_id"];
	$price_pt=isset($_REQUEST["price_pt"]) && $_REQUEST["price_pt"]!='' ? $_REQUEST["price_pt"]:'0';
	$bill_type=isset($_REQUEST["bill_type"]) && $_REQUEST["bill_type"]!='' ? $_REQUEST["bill_type"]:'0';
}else{
	$app_id="";
	$price_pt="0";
	$bill_type="0";
}

$ques_type=isset($_REQUEST["ques_type"]) && $_REQUEST["ques_type"]!='' ? $_REQUEST["ques_type"]:'0';
if($ques_type==1){
	$quetsno=$_REQUEST["quetsno"];
}else{
	$quetsno=0;
}

$score_type=($_REQUEST["score_type"]!="")?'1':'0';
$max_option=$_REQUEST["max_option"];
$fut_msg=$_REQUEST["fut_msg"];
$futchk=($_REQUEST["futchk"]!="")?'1':'0';
$futtxt=$_REQUEST["futtxt"];
$futlnk=$_REQUEST["futlnk"];
$futsep=$_REQUEST["futsep"];
$add_type=($_REQUEST["add_type"]!="")?'1':'0';
$off_msg=$_REQUEST["off_msg"];
$over_msg=$_REQUEST["over_msg"];
$act_status=$_REQUEST["act_status"];

$question_type=$_REQUEST["questiontype"];

/***'*** Add for upload zip file ***'***/

$banner_type = array();
$banner_label = array();
$banner_size = array();
$errflinefeed=0;
$tag1="header";
$tag2="footer";
$tmpfolder_name = date("dmyGi");

/*
$destn1="uploads/" . $login_form . "/" . $tmpfolder_name . "/" . $tag1;
$destn2="uploads/" . $login_form . "/" . $tmpfolder_name . "/" . $tag2;
$delpath=getcwd() ."/uploads/" . $login_form . "/" . $tmpfolder_name;
$mvpath=getcwd() ."/uploads/" . $login_form . "/" . $cnts_name;
$zippath1=getcwd() ."/" . $destn1 . "/";
$zippath2=getcwd() ."/" . $destn2 . "/";
$sqlquery_banner_header="";
$sqlquery_banner_footer="";

*/

$delpath=getcwd() .DIR_SEPERATOR."uploads" .DIR_SEPERATOR. $login_form . DIR_SEPERATOR . $tmpfolder_name;
$mvpath=getcwd() .DIR_SEPERATOR."uploads" .DIR_SEPERATOR. $login_form . DIR_SEPERATOR . $cnts_name;

$destn1= "uploads" .DIR_SEPERATOR. $login_form . DIR_SEPERATOR . $cnts_name . DIR_SEPERATOR . $tag1;
$destn2= "uploads" .DIR_SEPERATOR. $login_form . DIR_SEPERATOR . $cnts_name . DIR_SEPERATOR . $tag2;

$zippath1=getcwd() .DIR_SEPERATOR . $destn1 . DIR_SEPERATOR;
$zippath2=getcwd() .DIR_SEPERATOR . $destn2 . DIR_SEPERATOR;

$sqlquery_banner_header="";
$sqlquery_banner_footer="";




$ziperror=1;

/***'*** Add for upload zip file ***'***/

if($action==3 && $cnts_id){
	delete_voting();
	$cnts_id=last_voting_id();


	if(is_dir($mvpath)){
		delete_dir($mvpath);
	}

	$msg_alert = 'Voting successfully deleted!!!';
	header("Location: voting_view.php?login=" . $login_form . "&sess_id=" . $sess_id ."&msg_alert=" . $msg_alert ."&action=" . $action ."&treeview_cod=" . $treeview_cod ."&cnts_id=" . $cnts_id . "&smenu=" . $smenu . "&cpName=" . $compName);
	die();
}

if($action==1){
	$urlstr="Location: voting_engine.php?";
}else if($action==2){
		$urlstr="Location: voting_modify.php?";
}
$urlstr=$urlstr . "action=" . $action . "&treeview_cod=" . $treeview_cod . "&login=" . $login_form . "&voting_name=" . $cnts_name . "&cnts_id=" . $cnts_id . "&welcome_msg=" . $welcome_msg . "&voting_type=" . $cnts_type . "&s_date=" . $s_date . "&e_date=" . $e_date . "&s_hour=" . $s_hour . "&e_hour=" . $e_hour . "&s_minute=" . $s_minute . "&e_minute=" . $e_minute . "&score=" . $score . "&negscore=" . $negscore . "&c_score=" . $c_score . "&t_score=" . $t_score . "&w_score=" . $w_score . "&checkbill=" . $checkbill . "&app_id=" . $app_id . "&price_pt=" . $price_pt . "&bill_type=" . $bill_type . "&ques_type=" . $ques_type . "&quetsno=" . $quetsno . "&score_type=" . $score_type . "&max_option=" . $max_option . "&off_msg=" . $off_msg . "&over_msg=" . $over_msg . "&fut_msg=" . $fut_msg . "&checkscore=" . $checkscore . "&act_status=" . $act_status . "&futsep=" . $futsep . "&sess_id=" . $sess_id . "&futchk=" . $futchk . "&smenu=" . $smenu . "&keyword=" . $keyword . "&shortcode=" . $shortcode . "&checkkey=" . $checkkey . "&questiontype=" . $question_type . "&alischk=" . $alischk . "&cpName=" . $compName;

if(gettype($futtxt)=='array')  $temptxt=implode("|",$futtxt);
if(gettype($futlnk)=='array')  $templnk=implode("|",$futlnk);

$urlstr=$urlstr . "&futtxt=" . $temptxt . "&futlnk=" . $templnk;
$temptxt="";
$templnk="";

if(gettype($aliastxt)=='array')  $tempalias=implode("|",$aliastxt);
$urlstr=$urlstr . "&aliastxt=" . $tempalias;
$tempalias="";


if(check_blank($cnts_name)){
	$msg_alert = "Please enter the voting name!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($action==1 && voting_available($cnts_name)){
	$msg_alert = "voting with this name already exist. Choose another voting!!!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if(check_blank($welcome_msg)){
	$msg_alert = "Please enter the introduction message!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($s_date=='' || $e_date=='' || $s_hour == '' || $e_hour == '' || $e_minute=='' || $e_minute==''){
	$msg_alert = "Please select valid DateTime!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($checkkey){
	if(($action==1 || $action==2) && keyword_available ($keyword, $shortcode, $action)){
		$msg_alert = "Keyword with this name already exist. Choose another Keyword!!!";
		header($urlstr . "&msg_alert=" . $msg_alert);
		die();
	}
}


if($alischk){
	for($i=0;$i<count($aliastxt);$i++){
		$repchk = $aliastxt[$i];
		if(!$alias){
			$alias=$aliastxt[$i];
		}else{
			$alias=$alias . "','" . $aliastxt[$i];
		}
		for ($j=$i+1;$j<count($aliastxt);$j++){
			if ($repchk == $aliastxt[$j]){
				$repfound = "nok";
				$msg_alert = "Please enter unique Keyword Alias.!!!";
				header($urlstr . "&msg_alert=" . $msg_alert);
				die();
			}
		}
	}

	$sqlquery="select count(*) from keyword_detail where keyword_alias in ('" . $alias . "') and shortcode='" . $shortcode . "' and type_id <> '" . $cnts_id . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$aliasrep=0;
	while($row=mysql_fetch_row($result)){
		$aliasrep=$row[0];
	}


	if ($aliasrep > 0){

		//echo "<br/>Alias = " . $sqlquery . "<br/>";
		$msg_alert = "You entered repeated Alias. Enter unique Alias!!!";
		header($urlstr . "&msg_alert=" . $msg_alert);
		die();
	}
}




$start_date = preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', '$3-$1-$2', $s_date) . " " . $s_hour . ":" . $s_minute;
$end_date =  preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', '$3-$1-$2', $e_date) . " " . $e_hour . ":" . $e_minute;
$temp1=explode('/',$s_date);
$temp_dt1=mktime($s_hour,$s_minute,'00',$temp1[0],$temp1[1],$temp1[2]);
$temp2=explode('/',$e_date);
$temp_dt2=mktime($e_hour,$e_minute,'00',$temp2[0],$temp2[1],$temp2[2]);
$temp_dt0=time();


if ($action==2 && $act_status ==1){
	$qstexist = question_exist($cnts_id);
	if ($qstexist == 0){
		$urlstr=$urlstr . "action=" . $action . "&treeview_cod=" . $treeview_cod . "&login=" . $login_form . "&voting_name=" . $cnts_name . "&cnts_id=" . $cnts_id . "&welcome_msg=" . $welcome_msg . "&voting_type=" . $cnts_type . "&s_date=" . $s_date . "&e_date=" . $e_date . "&s_hour=" . $s_hour . "&e_hour=" . $e_hour . "&s_minute=" . $s_minute . "&e_minute=" . $e_minute . "&score=" . $score . "&negscore=" . $negscore . "&c_score=" . $c_score . "&t_score=" . $t_score . "&w_score=" . $w_score . "&checkbill=" . $checkbill . "&app_id=" . $app_id . "&price_pt=" . $price_pt . "&bill_type=" . $bill_type . "&ques_type=" . $ques_type . "&quetsno=" . $quetsno . "&score_type=" . $score_type . "&max_option=" . $max_option . "&off_msg=" . $off_msg . "&over_msg=" . $over_msg . "&fut_msg=" . $fut_msg . "&checkscore=" . $checkscore . "&act_status=0&futsep=" . $futsep . "&sess_id=" . $sess_id . "&futchk=" . $futchk . "&smenu=" . $smenu . "&cpName=" . $compName;
		$msg_alert = "You cannot on this voting without adding question!";
		header($urlstr . "&msg_alert=" . $msg_alert);
		die();
	}
}

if ($action==1 && ($temp_dt1 < $temp_dt0)){
	$msg_alert = "Please Change Start Datetime Greater Than Current Datetime!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if ($temp_dt1 > $temp_dt2){
	$msg_alert = "Please Change Start Datetime Less Than End Datetime!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($checkbill && check_blank($app_id)){
	$msg_alert = "Please enter the Voting Application Id!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($checkbill && check_blank($price_pt)){
	$msg_alert = "Please enter the Voting Price Point!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if (check_blank($max_option)){
	$msg_alert = "Please enter the voting max option!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if (check_blank($fut_msg)){
	$msg_alert = "Please enter the voting footer message!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if ($futchk && empty($futtxt) && gettype($futtxt)=='array'){
	$msg_alert = "Please enter the voting footer text!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if ($futchk && empty($futlnk) && gettype($futlnk)=='array'){
	$msg_alert = "Please enter the voting footer Link!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if (check_blank($over_msg)){
	$msg_alert = "Please enter the end of voting message!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if (check_blank($off_msg)){
	$msg_alert = "Please enter the voting expiry message!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}

/***'*** Zip File Process ***'***/

if($action==1 || $action==2){

	if($_FILES[$tag1]["name"]!=""){

		$zipfile1=upload_banner ($tag1,$destn1);	//return path or upload error
		if(strrpos($zipfile1,DIR_SEPERATOR)===false){
			$ziperror=0;
			$msg_alert=$zipfile1;
			header($urlstr . "&msg_alert=" . $msg_alert);
			die();
		}else if(unzip_bulk_file($zipfile1, $zippath1)) {
			$banner_size=config_parser('header');
			
			if(validator($zippath1,$banner_size,$sqlquery_banner_header,'header')){
				$errflinefeed=1;
				delete_dir($delpath);
				$msg_alert="ERR Nazara Quiz Header Banner size do not matches with available banner sizes " . $file;
				//header($urlstr . "&msg_alert=" . $msg_alert . "&errorlog=1"); //----------------------------------------------
				//die();
			}
		}
		if($action==2 && is_dir($mvpath .DIR_SEPERATOR . $tag1)){
			delete_dir($mvpath .DIR_SEPERATOR . $tag1);
		}

		copy_dir($delpath, $mvpath);
		delete_dir($delpath);
	}

	if($_FILES[$tag2]["name"]!=""){

		$zipfile2=upload_banner ($tag2,$destn2);	//return path or upload error
		if(strrpos($zipfile2,DIR_SEPERATOR)===false){
			$ziperror=0;
			$msg_alert=$zipfile2;
			header($urlstr . "&msg_alert=" . $msg_alert);
			die();
		}else if(unzip_bulk_file($zipfile2,$zippath2)){
			$banner_size=config_parser('footer');
			if(validator($zippath2,$banner_size,$sqlquery_banner_footer,'footer')){
				$errflinefeed=1;
				delete_dir($delpath);

				if($_FILES[$tag1]["name"]!="" && is_dir($mvpath .DIR_SEPERATOR . $tag1)){
					delete_dir($mvpath);
				}
				$msg_alert="ERR Nazara Quiz Footer Banner size do not matches with available banner sizes " . $file;
				//header($urlstr . "&msg_alert=" . $msg_alert . "&errorlog=1");	//---------------------------------
				//die();
			}
		}

		if($action==2 && is_dir($mvpath .DIR_SEPERATOR . $tag2)){
			delete_dir($mvpath .DIR_SEPERATOR . $tag2);
		}

		copy_dir($delpath, $mvpath);
		delete_dir($delpath);
	}
}

/***'*** Zip File Process ***'***/

if($action==1 && $ziperror){
	$cnts_id = insert_voting();
	$temp="('" . $cnts_id . "',";

	$sqlquery_banner="insert into voting_banner(voting_id,label,format,width,height,path,type,login) values ";

	$sqlquery_banner_header=$sqlquery_banner . str_replace("(",$temp,$sqlquery_banner_header); 	
	$sqlquery_banner_footer=$sqlquery_banner . str_replace("(",$temp,$sqlquery_banner_footer);	


	//echo $sqlquery_banner_header . "<br>";


	//echo $sqlquery_banner_footer;


	//$result = mysql_query($sqlquery_banner_header) or die('mysql error:' . mysql_error());//------------ Insert Banner Header
	//$result = mysql_query($sqlquery_banner_footer) or die('mysql error:' . mysql_error());//------------ Insert Banner Footer

	$msg_alert = 'voting successfully created!!!';
	header("Location: voting_view.php?login=" . $login_form . "&sess_id=" . $sess_id ."&cnts_id=" . $cnts_id . "&msg_alert=" . $msg_alert . "&smenu=" . $smenu. "&cpName=" . $compName);
	die();
}else if($action==2 && $ziperror){
	update_voting();

	$sqlquery_banner_sub="insert into voting_banner(voting_id,label,format,width,height,path,type,login) values ";
	$temp="('" . $cnts_id . "',";

	if($_FILES[$tag1]["name"]!=""){
		$sqlquery="delete from voting_banner where voting_id='" . $cnts_id . "' and type='" . $tag1 . "' and login='" . $login_form . "'";
		//$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());	//-------------------------------------------------------------
		$sqlquery_banner_header=$sqlquery_banner_sub . str_replace("(",$temp,$sqlquery_banner_header);
		//$result = mysql_query($sqlquery_banner_header) or die('mysql error:' . mysql_error()); //----------------------------------------------------
	}


	if($_FILES[$tag2]["name"]!=""){
		$sqlquery="delete from voting_banner where voting_id='" . $cnts_id . "' and type='" . $tag2 . "' and login='" . $login_form . "'";
		//$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());	//---------------------------------------------------
		$sqlquery_banner_footer=$sqlquery_banner_sub . str_replace("(",$temp,$sqlquery_banner_footer);
		//$result = mysql_query($sqlquery_banner_footer) or die('mysql error:' . mysql_error());	//-----------------------------------
	}


	$msg_alert = 'voting successfully Updated!!!';
	$url= "Location: voting_modify.php?login=" . $login_form . "&sess_id=" . $sess_id ."&flag=1&cnts_id=" . $cnts_id . "&msg_alert=" . $msg_alert . "&action=2&smenu=" . $smenu. "&cpName=" . $compName;
 	header($url);
	die();
}

function insert_voting(){

	global $compName,$smenu,$futsep,$futchk,$futtxt,$futlnk,$add_type,$cnts_id,$login_form,$sess_id,$cnts_name,$welcome_msg,$cnts_type,$start_date,$end_date,$score,$checkscore,$negscore,$c_score,$t_score,$w_score,$checkbill,$app_id,$bill_type,$price_pt,$ques_type,$quetsno,$score_type,$max_option,$off_msg,$over_msg,$fut_msg,$tag1,$tag2,$keyword,$shortcode,$checkkey,$alischk,$aliastxt,$question_type;

	$active_status=0;	//default
	$sqlquery="insert into voting_detail(companyName,voting_name,welcome_message,voting_type,start_date,end_date,score,score_neg_status,today_score,weekly_score,bill_status,application_id,price_status,price_pt,question_status,question_size,score_type,max_options,off_message,voting_over_message,voting_footer_message,active_status,footer_link,footer_sept,diplay_add,header_upload,footer_upload,key_status,keyword,key_alias_status,short_code,login,voting_question_type) values ";
	$values="('" . $compName . "','" . $cnts_name . "','" . str_replace("'", "''", $welcome_msg) . "','" . $cnts_type . "','" . $start_date . "','" . $end_date . "','" . $score . "','" . $checkscore . "','" . $t_score . "','" . $w_score . "','" . $checkbill . "','" . $app_id . "','" . $bill_type . "','" . $price_pt . "','" . $ques_type . "','" . $quetsno . "','" . $score_type . "','" . $max_option . "','" . str_replace("'", "''", $off_msg) . "','" . str_replace("'", "''", $over_msg) . "','" . str_replace("'", "''", $fut_msg) . "','" . $active_status . "','" . $futchk . "','" . $futsep . "','" . $add_type . "','" . $_FILES[$tag1]['name'] . "','" . $_FILES[$tag2]['name'] . "','" . $checkkey . "','" . $keyword . "','" . $alischk . "','" . $shortcode . "','" . $login_form . "','" . $question_type . "')";
	$sqlquery=$sqlquery . $values;

	//echo "<br>" . $sqlquery . "<br/>";

	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$cnts_id = mysql_insert_id();


	if($checkkey && $cnts_id){
		$sqlquery="insert into keyword(keyword,type,shortcode,type_id,login) values ";
		$values="('" . $keyword . "','2','" . $shortcode . "','" . $cnts_id . "','" . $login_form . "')";
		$sqlquery=$sqlquery . $values;

		//echo $sqlquery . "<br/>";
		//die();

		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
		$keyword_id = mysql_insert_id();
	}


	if($alischk && $keyword_id){
		$sqlquery="insert into keyword_detail (type_id,keyword_id,keyword_alias,shortcode,login) values ";
		$values="";

		for($i=0;$i<count($aliastxt);$i++){
			if(!$values){
				$values="('" . $cnts_id . "','" . $keyword_id . "','" . $aliastxt[$i] . "','" . $shortcode . "','" . $login_form . "')";
			}else{
				$values=$values . ",('" . $cnts_id . "','" . $keyword_id . "','" . $aliastxt[$i] . "','" . $shortcode . "','" . $login_form . "')";
			}
		}
		$sqlquery=$sqlquery . $values;

		//echo "<br/>Alias = " . $sqlquery . "<br/>";
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	}


	if($futchk && $cnts_id){
		$sqlquery="insert into voting_flink (voting_id,footer_text,footer_link,login) values ";
		$values="";

		for($i=0;$i<count($futtxt);$i++){
			if(!$values){
				$values="('" . $cnts_id . "','" . $futtxt[$i] . "','" . $futlnk[$i] . "','" . $login_form . "')";
			}else{
				$values=$values . ",('" . $cnts_id . "','" . $futtxt[$i] . "','" . $futlnk[$i] . "','" . $login_form . "')";
			}
		}
		$sqlquery=$sqlquery . $values;
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	}

	if ($result == 0){
		$msg_alert = "There is some problem at server";
		user_session($login_form,$sess_id,$msg_alert,$compName);
		header("Location: voting_engine.php?login=" . $login_form . "&sess_id=" . $sess_id ."&cnts_id=" . $cnts_id . "&msg_alert=" . $msg_alert . "&smenu=" . $smenu. "&cpName=" . $compName);
		die();
	}else{
		$login_history = $cnts_name . " voting successfully Created!!!";
		user_session($login_form,$sess_id,$login_history,$compName);
	}
	return $cnts_id;
}

function update_voting(){

	global $compName,$futsep,$futchk,$futtxt,$futlnk,$add_type,$act_status,$cnts_id,$login_form,$sess_id,$cnts_name,$welcome_msg,$cnts_type,$start_date,$end_date,$score,$checkscore,$negscore,$c_score,$t_score,$w_score,$checkbill,$app_id,$bill_type,$price_pt,$ques_type,$quetsno,$score_type,$max_option,$off_msg,$over_msg,$fut_msg,$tag1,$tag2,$keyword,$shortcode,$checkkey,$alischk,$aliastxt,$question_type;

	if($_FILES[$tag1]["name"]!="" && $_FILES[$tag2]["name"]!=""){ $temp=",header_upload='" . $_FILES[$tag1]["name"] . "',footer_upload='" . $_FILES[$tag2]["name"] . "'";}
	else if($_FILES[$tag1]["name"]!="" && $_FILES[$tag2]["name"]=="" ){ $temp=",header_upload='" . $_FILES[$tag1]["name"] . "'";}
	else if($_FILES[$tag2]["name"]!="" && $_FILES[$tag1]["name"]=="" ){ $temp=",footer_upload='" . $_FILES[$tag2]["name"] . "'";}

 	//$sqlquery="update voting_detail set keyword='" . $keyword. "',key_status='" . $checkkey . "',key_alias_status='" . $alischk . "',short_code='" . $shortcode ."',welcome_message='" . str_replace("'", "''", $welcome_msg) . "',voting_type='" . $cnts_type . "',start_date='" . $start_date . "',end_date='" . $end_date . "',score='" . $score . "',score_neg_status='" . $checkscore . "',today_score='" . $t_score . "',weekly_score='" . $w_score . "',bill_status='" . $checkbill . "',application_id='" . $app_id . "',price_status='" . $bill_type . "',price_pt='" . $price_pt . "',question_status='" . $ques_type . "',question_size='" . $quetsno . "',score_type='" . $score_type . "',max_options='" . $max_option . "',off_message='" . str_replace("'", "''", $off_msg) . "',footer_link='" . $futchk . "',footer_sept='" . $futsep . "',diplay_add='" . $add_type . "',voting_over_message='" . str_replace("'", "''", $over_msg) . "',voting_footer_message='" . str_replace("'", "''", $fut_msg) . "',active_status='" . $act_status . "'" . $temp . " where voting_name='" . $cnts_name . "' and voting_id='" . $cnts_id . "' and login='" . $login_form . "'";
 	$sqlquery="update voting_detail set welcome_message='" . str_replace("'", "''", $welcome_msg) . "',voting_type='" . $cnts_type . "',start_date='" . $start_date . "',end_date='" . $end_date . "',score='" . $score . "',score_neg_status='" . $checkscore . "',today_score='" . $t_score . "',weekly_score='" . $w_score . "',bill_status='" . $checkbill . "',application_id='" . $app_id . "',price_status='" . $bill_type . "',price_pt='" . $price_pt . "',question_status='" . $ques_type . "',question_size='" . $quetsno . "',score_type='" . $score_type . "',max_options='" . $max_option . "',off_message='" . str_replace("'", "''", $off_msg) . "',footer_link='" . $futchk . "',footer_sept='" . $futsep . "',diplay_add='" . $add_type . "',voting_over_message='" . str_replace("'", "''", $over_msg) . "',voting_footer_message='" . str_replace("'", "''", $fut_msg) . "',active_status='" . $act_status . "'" . $temp . ",voting_question_type='" . $question_type . "' where voting_name='" . $cnts_name . "' and voting_id='" . $cnts_id . "' and companyName='" . $compName. "'";

	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	if($checkkey && $cnts_id){


		$sqlquery="update keyword set keyword='" . $keyword . "',shortcode='" . $shortcode . "' where  type_id='" . $cnts_id . "' and login='" . $login_form . "'";
		//echo $sqlquery;

		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());


		/*
		$sqlquery="delete from keyword where type_id='" . $cnts_id . "' and login='" . $login_form . "'";
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

		$sqlquery="insert into keyword(keyword,type,shortcode,type_id,login) values ";
		$values="('" . $keyword . "','2','" . $shortcode . "','" . $cnts_id . "','" . $login_form . "')";
		$sqlquery=$sqlquery . $values;
		*/

		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
		$keyword_id = mysql_insert_id();
	}


	if($alischk && $keyword_id){
		$sqlquery="delete from keyword_detail where type_id='" . $cnts_id . "' and shortcode='" . $shortcode . "' and login='" . $login_form . "'";
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

		$sqlquery="insert into keyword_detail (type_id,keyword_id,keyword_alias,shortcode,login) values ";
		$values="";

		for($i=0;$i<count($aliastxt);$i++){
			if(!$values){
				$values="('" . $cnts_id . "','" . $keyword_id . "','" . $aliastxt[$i] . "','" . $shortcode . "','" . $login_form . "')";
			}else{
				$values=$values . ",('" . $cnts_id . "','" . $keyword_id . "','" . $aliastxt[$i] . "','" . $shortcode . "','" . $login_form . "')";
			}
		}
		$sqlquery=$sqlquery . $values;

		//echo "<br/>Alias = " . $sqlquery . "<br/>";
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	}


	$sqlquery="delete from voting_flink where voting_id='" . $cnts_id . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	if($futchk && $cnts_id){
		$sqlquery="insert into voting_flink (voting_id,footer_text,footer_link) values ";
		$values="";

		for($i=0;$i<count($futtxt);$i++){
			if(!$values){
				$values="('" . $cnts_id . "','" . $futtxt[$i] . "','" . $futlnk[$i] . "')";
			}else{
				$values=$values . ",('" . $cnts_id . "','" . $futtxt[$i] . "','" . $futlnk[$i] . "')";
			}
		}
		$sqlquery=$sqlquery . $values;
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	}

	$login_history = $cnts_name . " voting successfully Updated!!!";
	user_session($login_form,$sess_id,$login_history,$compName);
}

function delete_voting (){
	global $login_form, $cnts_id, $sess_id,$compName;

	$sqlquery = "delete from voting_detail where voting_id='" . $cnts_id . "' and companyName='" . $compName. "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());


	$sqlquery = "delete from voting_questions where voting_id='" . $cnts_id . "' and companyName='" . $compName. "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());


	$sqlquery = "delete from voting_flink where voting_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$sqlquery="delete from voting_banner where voting_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$sqlquery="delete from keyword where type_id='" . $cnts_id . "' and login='" . $login_form . "'";
	//echo $sqlquery;

	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$sqlquery="delete from keyword_detail where type_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$login_history = $cnts_name . " voting successfully Deleted!!!";
	user_session($login_form,$sess_id,$login_history);
}

function voting_available ($cnts_name){
	global $login_form,$compName;

	$sqlquery = "select * from voting_detail where voting_name='" . $cnts_name . "' and companyName='" . $compName. "' limit 1";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$cnts_avail=0;
	while($row=mysql_fetch_row($result)){
		$cnts_avail=1;
	}
	return $cnts_avail;
}

function keyword_available ($keyword, $shortcode, $action){
	global $cnts_id,$login_form;

	if ($action == 2){
		$sqlquery = "select * from keyword where keyword='" . $keyword . "' and shortcode='" . $shortcode . "' and type_id <>'" . $cnts_id . "' limit 1";
	}else{
		$sqlquery = "select * from keyword where keyword='" . $keyword . "' and shortcode='" . $shortcode . "' limit 1";
	}
	//echo "<br/>" . $sqlquery . "<br/>";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$keyd_avail=0;
	while($row=mysql_fetch_row($result)){
		$keyd_avail=1;
	}
	return $keyd_avail;
}

function last_voting_id(){
	global $login_form;

	$sqlquery = "select voting_id from voting_detail where archive!=1 order by voting_id desc limit 1";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$cnts_avail=0;
	while($row=mysql_fetch_row($result)){
		$cnts_avail=$row[0];
	}
	return $cnts_avail;
}

function question_exist($qid){

	global $login_form;

	$sqlquery = "select * from voting_questions where voting_id='" . $qid . "'";
	//echo $sqlquery;
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$q_avail=0;
	while($row=mysql_fetch_row($result)){
		$q_avail=1;
	}
	return $q_avail;
}

?>