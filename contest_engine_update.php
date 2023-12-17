<?php
require("upload.php");
require("gui_common.php");
require("template.php");

$action=$_REQUEST["action"];			//1-new,2-update,3-delete
$treeview_cod=$_REQUEST["treeview_cod"];
$smenu=$_REQUEST["smenu"];

$login_form=$_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$cnts_id=$_REQUEST["cnts_id"];
$msg_alert=$_REQUEST["msg_alert"];
$cnts_name=$_REQUEST["contest_name"];
$welcome_msg=$_REQUEST["welcome_msg"];
$cnts_type=$_REQUEST["contest_type"];
$s_date=$_REQUEST["s_date"];
$e_date=$_REQUEST["e_date"];
$s_hour=$_REQUEST["s_hour"];
$e_hour=$_REQUEST["e_hour"];
$s_minute=$_REQUEST["s_minute"];
$e_minute=$_REQUEST["e_minute"];
$score=$_REQUEST["score"];
$checkscore=($_REQUEST["checkscore"]!="")?'1':'0';
if($checkscore){
	$negscore=$_REQUEST["negscore"];
}else{
	$negscore="";
}
$c_score=($_REQUEST["c_score"]!="")?'1':'0';
$t_score=($_REQUEST["t_score"]!="")?'1':'0';
$w_score=($_REQUEST["w_score"]!="")?'1':'0';

$checkbill=($_REQUEST["checkbill"]!="")?'1':'0';

if($checkbill){
	$app_id=$_REQUEST["app_id"];
	$price_pt=$_REQUEST["price_pt"];
	$bill_type=$_REQUEST["bill_type"];
}else{
	$app_id="";
	$price_pt="";
	$bill_type="";
}

$checksmskey=($_REQUEST["checksmskey"]!="")?'1':'0';

if($checksmskey){
	$shortcode=$_REQUEST["shortcode"];
	$keyword=$_REQUEST["keyword"];
	$checksmsalias=($_REQUEST["checksmsalias"]!="")?'1':'0';
}else{
	$shortcode="";
	$keyword="";
	$checksmsalias=0;
}

$aliastxt = array();

if($checksmsalias){
	$aliastxt=$_REQUEST["aliastxt"];
}
if(gettype($aliastxt)=='array')  $tempalaiskey=implode("|",$aliastxt);

$ques_type=$_REQUEST["ques_type"];
if($ques_type==1){
	$quetsno=$_REQUEST["quetsno"];
}else{
	$quetsno="";
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

$delpath=getcwd() ."/uploads/" . $login_form . "/" . $tmpfolder_name;
$mvpath=getcwd() ."/uploads/" . $login_form . "/" . $cnts_name;

$destn1= "uploads/" . $login_form . "/" . $cnts_name . "/" . $tag1;
$destn2= "uploads/" . $login_form . "/" . $cnts_name . "/" . $tag2;

$zippath1=getcwd() ."/" . $destn1 . "/";
$zippath2=getcwd() ."/" . $destn2 . "/";

$sqlquery_banner_header="";
$sqlquery_banner_footer="";



$ziperror=1;

/***'*** Add for upload zip file ***'***/

if($action==3 && $cnts_id){
	delete_contest();
	$cnts_id=last_contest_id();


	if(is_dir($mvpath)){
		delete_dir($mvpath);
	}

	$msg_alert = 'Contest Successfully Deleted!';
	header("Location: contest_view.php?login=" . $login_form . "&sess_id=" . $sess_id ."&msg_alert=" . $msg_alert ."&action=" . $action ."&treeview_cod=" . $treeview_cod ."&cnts_id=" . $cnts_id . "&smenu=" . $smenu);
	die();
}

if($action==1){
	$urlstr="Location: contest_engine.php?";
}else if($action==2){
		$urlstr="Location: contest_modify.php?";
}
$urlstr=$urlstr . "action=" . $action . "&treeview_cod=" . $treeview_cod . "&login=" . $login_form . "&contest_name=" . $cnts_name . "&cnts_id=" . $cnts_id . "&welcome_msg=" . $welcome_msg . "&contest_type=" . $cnts_type . "&s_date=" . $s_date . "&e_date=" . $e_date . "&s_hour=" . $s_hour . "&e_hour=" . $e_hour . "&s_minute=" . $s_minute . "&e_minute=" . $e_minute . "&score=" . $score . "&negscore=" . $negscore . "&c_score=" . $c_score . "&t_score=" . $t_score . "&w_score=" . $w_score . "&checkbill=" . $checkbill . "&app_id=" . $app_id . "&price_pt=" . $price_pt . "&bill_type=" . $bill_type . "&ques_type=" . $ques_type . "&quetsno=" . $quetsno . "&score_type=" . $score_type . "&max_option=" . $max_option . "&off_msg=" . $off_msg . "&over_msg=" . $over_msg . "&fut_msg=" . $fut_msg . "&checkscore=" . $checkscore . "&act_status=" . $act_status . "&futsep=" . $futsep . "&sess_id=" . $sess_id . "&futchk=" . $futchk . "&smenu=" . $smenu . "&checksmskey=" . $checksmskey . "&shortcode=" . $shortcode . "&keyword=" . $keyword . "&checksmsalias=" . $checksmsalias;

if(gettype($futtxt)=='array')  $temptxt=implode("|",$futtxt);
if(gettype($futlnk)=='array')  $templnk=implode("|",$futlnk);

$urlstr=$urlstr . "&futtxt=" . $temptxt . "&futlnk=" . $templnk . "&aliastxt=" . $tempalaiskey;
$temptxt="";
$templnk="";
$tempalaiskey= "";

if(check_blank($cnts_name)){
	$msg_alert = "Please enter the contest name!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($action==1 && contest_available($cnts_name)){
	$msg_alert = "Contest with this name already exist. Choose another contest!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if(check_blank($welcome_msg)){
	$msg_alert = "Please enter the introduction message!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if(check_blank($cnts_type)){
	$msg_alert = "Please enter the contest type!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($s_date=='' || $e_date=='' || $s_hour == '' || $e_hour == '' || $e_minute=='' || $e_minute==''){
	$msg_alert = "Please select valid DateTime!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}

$start_date = preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', '$3-$1-$2', $s_date) . " " . $s_hour . ":" . $s_minute;
$end_date =  preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', '$3-$1-$2', $e_date) . " " . $e_hour . ":" . $e_minute;
$temp1=explode('/',$s_date);
$temp_dt1=mktime($s_hour,$s_minute,'00',$temp1[0],$temp1[1],$temp1[2]);
$temp2=explode('/',$e_date);
$temp_dt2=mktime($e_hour,$e_minute,'00',$temp2[0],$temp2[1],$temp2[2]);
$temp_dt0=mktime();

if ($action==1 && ($temp_dt1 < $temp_dt0)){
	$msg_alert = "Please Change Start Datetime Greater Than Current Datetime!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if ($temp_dt1 > $temp_dt2){
	$msg_alert = "Please Change Start Datetime Less Than End Datetime!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if (check_blank($score)){
	$msg_alert = "Please enter the Score per correct Answer!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($checkscore && check_blank($negscore)){
	$msg_alert = "Please enter the Score Dedection per Wrong Answer!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($checkbill && check_blank($app_id)){
	$msg_alert = "Please enter the Contest Application Id!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($checkbill && check_blank($price_pt)){
	$msg_alert = "Please enter the Contest Price Point!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($checkbill && check_blank($bill_type)){
	$msg_alert = "Please Choose the Contest Payment Mode!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($checksmskey && check_blank($shortcode)){
	$msg_alert = "Please enter the shortcode!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($checksmskey && check_blank($keyword)){
	$msg_alert = "Please enter the keyword!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($checksmskey && valid_contest_key($keyword,$shortcode)){
	$msg_alert = "Please enter the unique keyword!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($checksmskey && $checksmsalias && valid_contest_aliaskey($aliastxt,$shortcode)){
	$msg_alert = "Please enter the unique alias keyword!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if($ques_type==1 && check_blank($quetsno)){
	$msg_alert = "Please Choose the Contest Questions limit!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if (check_blank($max_option)){
	$msg_alert = "Please enter the contest max option!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if (check_blank($fut_msg)){
	$msg_alert = "Please enter the contest footer message!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if ($futchk && empty($futtxt) && gettype($futtxt)=='array'){
	$msg_alert = "Please enter the contest footer text!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if ($futchk && empty($futlnk) && gettype($futlnk)=='array'){
	$msg_alert = "Please enter the contest footer Link!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if (check_blank($over_msg)){
	$msg_alert = "Please enter the end of contest message!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}else if (check_blank($off_msg)){
	$msg_alert = "Please enter the contest expiry message!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}

/***'*** Zip File Process ***'***/

if($action==1 || $action==2){

	if($_FILES[$tag1]["name"]!=""){

		$zipfile1=upload_banner ($tag1,$destn1);	//return path or upload error
		if(strrpos($zipfile1,"/")===false){
			$ziperror=0;
			$msg_alert=$zipfile1;
			header($urlstr . "&msg_alert=" . $msg_alert);
			die();
		}else if(unzip_bulk_file($zipfile1, $zippath1)) {
			$banner_size=config_parser('header');
			if(validator($zippath1,$banner_size,&$sqlquery_banner_header,'header')){
				$errflinefeed=1;
				delete_dir($delpath);
				$msg_alert="Nazara Quiz Header Banner size doesn’t matches with available banner sizes " . $file;
				header($urlstr . "&msg_alert=" . $msg_alert . "&errorlog=1");
				die();
			}
		}
		if($action==2 && is_dir($mvpath .'/' . $tag1)){
			delete_dir($mvpath .'/' . $tag1);
		}

		copy_dir($delpath, $mvpath);
		delete_dir($delpath);
	}

	if($_FILES[$tag2]["name"]!=""){

		$zipfile2=upload_banner ($tag2,$destn2);	//return path or upload error
		if(strrpos($zipfile2,"/")===false){
			$ziperror=0;
			$msg_alert=$zipfile2;
			header($urlstr . "&msg_alert=" . $msg_alert);
			die();
		}else if(unzip_bulk_file($zipfile2,$zippath2)){
			$banner_size=config_parser('footer');
			if(validator($zippath2,$banner_size,&$sqlquery_banner_footer,'footer')){
				$errflinefeed=1;
				delete_dir($delpath);

				if($_FILES[$tag1]["name"]!="" && is_dir($mvpath .'/' . $tag1)){
					delete_dir($mvpath);
				}
				$msg_alert="ERR Nazara Quiz Footer Banner size do not matches with available banner sizes " . $file;
				header($urlstr . "&msg_alert=" . $msg_alert . "&errorlog=1");
				die();
			}
		}

		if($action==2 && is_dir($mvpath .'/' . $tag2)){
			delete_dir($mvpath .'/' . $tag2);
		}

		copy_dir($delpath, $mvpath);
		delete_dir($delpath);
	}
}

/***'*** Zip File Process ***'***/
if($action==1 && $ziperror){
	$cnts_id = insert_contest();
	$temp="('" . $cnts_id . "',";

	$sqlquery_banner="insert into contest_banner(contest_id,label,format,width,height,path,type,login) values ";


	$sqlquery_banner_header=$sqlquery_banner . str_replace("(",$temp,$sqlquery_banner_header);
	$sqlquery_banner_footer=$sqlquery_banner . str_replace("(",$temp,$sqlquery_banner_footer);

	$result = mysql_query($sqlquery_banner_header) or die('mysql error:' . mysql_error());

	$result = mysql_query($sqlquery_banner_footer) or die('mysql error:' . mysql_error());

	$msg_alert = 'Contest Successfully Created!';
	header("Location: contest_view.php?login=" . $login_form . "&sess_id=" . $sess_id ."&cnts_id=" . $cnts_id . "&msg_alert=" . $msg_alert . "&smenu=" . $smenu);
	die();
}else if($action==2 && $ziperror){
	update_contest();

	$sqlquery_banner_sub="insert into contest_banner(contest_id,label,format,width,height,path,type,login) values ";
	$temp="('" . $cnts_id . "',";

	if($_FILES[$tag1]["name"]!=""){
		$sqlquery="delete from contest_banner where contest_id='" . $cnts_id . "' and type='" . $tag1 . "'";
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
		$sqlquery_banner_header=$sqlquery_banner_sub . str_replace("(",$temp,$sqlquery_banner_header);
		$result = mysql_query($sqlquery_banner_header) or die('mysql error:' . mysql_error());
	}


	if($_FILES[$tag2]["name"]!=""){
		$sqlquery="delete from contest_banner where contest_id='" . $cnts_id . "' and type='" . $tag2 . "'";
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
		$sqlquery_banner_footer=$sqlquery_banner_sub . str_replace("(",$temp,$sqlquery_banner_footer);
		$result = mysql_query($sqlquery_banner_footer) or die('mysql error:' . mysql_error());
	}


	$msg_alert = 'Contest Successfully Updated!';
	$url= "Location: contest_modify.php?login=" . $login_form . "&sess_id=" . $sess_id ."&flag=1&cnts_id=" . $cnts_id . "&msg_alert=" . $msg_alert . "&action=2&smenu=" . $smenu;
 	header($url);
	die();
}

function insert_contest(){

	global $checksmskey,$shortcode,$keyword,$checksmsalias,$aliastxt,$smenu,$futsep,$futchk,$futtxt,$futlnk,$add_type,$cnts_id,$login_form,$sess_id,$cnts_name,$welcome_msg,$cnts_type,$start_date,$end_date,$score,$checkscore,$negscore,$c_score,$t_score,$w_score,$checkbill,$app_id,$bill_type,$price_pt,$ques_type,$quetsno,$score_type,$max_option,$off_msg,$over_msg,$fut_msg,$tag1,$tag2;

	$active_status=0;	//default
	$sqlquery="insert into contest_detail(contest_name,welcome_message,contest_type,start_date,end_date,score,score_neg_status,negative_marking,cummulative_score,today_score,weekly_score,bill_status,application_id,price_status,price_pt,smskey_status,key_alias_status,question_status,question_size,score_type,max_options,off_message,contest_over_message,contest_footer_message,active_status,footer_link,footer_sept,diplay_add,header_upload,footer_upload,login) values ";
	$values="('" . $cnts_name . "','" . str_replace("'", "''", $welcome_msg) . "','" . $cnts_type . "','" . $start_date . "','" . $end_date . "','" . $score . "','" . $checkscore . "','" . $negscore . "','" . $c_score . "','" . $t_score . "','" . $w_score . "','" . $checkbill . "','" . $app_id . "','" . $bill_type . "','" . $price_pt . "','" . $checksmskey . "','" . $checksmsalias . "','" . $ques_type . "','" . $quetsno . "','" . $score_type . "','" . $max_option . "','" . str_replace("'", "''", $off_msg) . "','" . str_replace("'", "''", $over_msg) . "','" . str_replace("'", "''", $fut_msg) . "','" . $active_status . "','" . $futchk . "','" . $futsep . "','" . $add_type . "','" . $_FILES[$tag1]['name'] . "','" . $_FILES[$tag2]['name'] . "','" . $login_form . "')";
	$sqlquery=$sqlquery . $values;

	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$cnts_id = mysql_insert_id();

	if($futchk && $cnts_id){
		$sqlquery="insert into contest_flink (contest_id,footer_text,footer_link,login) values ";
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


	if (strlen($keyword) > 0){
		$sqlquery="insert into keyword(keyword,type,shortcode,type_id,login) values ('" . $keyword . "','1','" . $shortcode . "','" . $cnts_id . "','" . $login_form . "')";
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
		$keyword_id = mysql_insert_id();


		$sqlquery="insert ignore into keyword_detail(keyword_id,type_id,keyword_alias,shortcode,login) values ";
		$tempsql = "";

		for($cnt=0,$max=count($aliastxt);$cnt<$max;$cnt++){

			if(!$tempsql){
				$tempsql = "('" . $keyword_id . "','" . $cnts_id . "','" . $aliastxt[$cnt] . "','" . $shortcode . "','" . $login_form . "')";
			}else{
				$tempsql = $tempsql . ",('" . $keyword_id . "','" . $cnts_id . "','" . $aliastxt[$cnt] . "','" . $shortcode . "','" . $login_form . "')";
			}
		}

		if($checksmsalias && $tempsql){
			$sqlquery = $sqlquery . $tempsql;
			$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
		}
	}

	if ($result == 0){
		$msg_alert = "There is some problem at server";
		user_session($login_form,$sess_id,$msg_alert);
		header("Location: contest_engine.php?login=" . $login_form . "&sess_id=" . $sess_id ."&cnts_id=" . $cnts_id . "&msg_alert=" . $msg_alert . "&smenu=" . $smenu);
		die();
	}else{
		$login_history = $cnts_name . " Contest successfully Created!";
		user_session($login_form,$sess_id,$login_history);
	}
	return $cnts_id;
}

function update_contest(){

	global $checksmskey,$shortcode,$keyword,$checksmsalias,$aliastxt,$futsep,$futchk,$futtxt,$futlnk,$add_type,$act_status,$cnts_id,$login_form,$sess_id,$cnts_name,$welcome_msg,$cnts_type,$start_date,$end_date,$score,$checkscore,$negscore,$c_score,$t_score,$w_score,$checkbill,$app_id,$bill_type,$price_pt,$ques_type,$quetsno,$score_type,$max_option,$off_msg,$over_msg,$fut_msg,$tag1,$tag2;

	if($_FILES[$tag1]["name"]!="" && $_FILES[$tag2]["name"]!=""){ $temp=",header_upload='" . $_FILES[$tag1]["name"] . "',footer_upload='" . $_FILES[$tag2]["name"] . "'";}
	else if($_FILES[$tag1]["name"]!="" && $_FILES[$tag2]["name"]=="" ){ $temp=",header_upload='" . $_FILES[$tag1]["name"] . "'";}
	else if($_FILES[$tag2]["name"]!="" && $_FILES[$tag1]["name"]=="" ){ $temp=",footer_upload='" . $_FILES[$tag2]["name"] . "'";}

 	$sqlquery="update contest_detail set welcome_message='" . str_replace("'", "''", $welcome_msg) . "',contest_type='" . $cnts_type . "',start_date='" . $start_date . "',end_date='" . $end_date . "',score='" . $score . "',score_neg_status='" . $checkscore . "',negative_marking='" . $negscore . "',cummulative_score='" . $c_score . "',today_score='" . $t_score . "',weekly_score='" . $w_score . "',bill_status='" . $checkbill . "',application_id='" . $app_id . "',price_status='" . $bill_type . "',price_pt='" . $price_pt . "',smskey_status='" . $checksmskey . "',key_alias_status='" . $checksmsalias . "',question_status='" . $ques_type . "',question_size='" . $quetsno . "',score_type='" . $score_type . "',max_options='" . $max_option . "',off_message='" . str_replace("'", "''", $off_msg) . "',footer_link='" . $futchk . "',footer_sept='" . $futsep . "',diplay_add='" . $add_type . "',contest_over_message='" . str_replace("'", "''", $over_msg) . "',contest_footer_message='" . str_replace("'", "''", $fut_msg) . "',active_status='" . $act_status . "'" . $temp . " where contest_name='" . $cnts_name . "' and contest_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$sqlquery="select id from keyword where type='1' and type_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());


	while($row=mysql_fetch_row($result)){

		$keyword_id = $row[0];
	}

	$sqlquery="update keyword set keyword='" . $keyword . "',shortcode='" . $shortcode . "' where  id='" . $keyword_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$sqlquery="delete from keyword_detail where  keyword_id='" . $keyword_id . "' and type_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());


	$sqlquery="insert ignore into keyword_detail(keyword_id,type_id,keyword_alias,shortcode,login) values ";
	$tempsql = "";

	for($cnt=0,$max=count($aliastxt);$cnt<$max;$cnt++){
		if(!$tempsql){
			$tempsql = "('" . $keyword_id . "','" . $cnts_id . "','" . $aliastxt[$cnt] . "','" . $shortcode . "','" . $login_form . "')";
		}else{
			$tempsql = $tempsql . ",('" . $keyword_id . "','" . $cnts_id . "','" . $aliastxt[$cnt] . "','" . $shortcode . "','" . $login_form . "')";
		}
	}

	if($checksmsalias && $tempsql){
		$sqlquery = $sqlquery . $tempsql;
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	}

	$sqlquery="delete from contest_flink where contest_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	if($futchk && $cnts_id){
		$sqlquery="insert into contest_flink (contest_id,footer_text,footer_link,login) values ";
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

	$login_history = $cnts_name . " Contest successfully Updated!";
	user_session($login_form,$sess_id,$login_history);
}

function delete_contest (){
	global $login_form, $cnts_id, $sess_id;

	$sqlquery = "delete from contest_detail where contest_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$sqlquery="select id from keyword where type='1' and type_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	while($row=mysql_fetch_row($result)){
		$keyword_id = $row[0];
	}

	$sqlquery = "delete from keyword where type='1' and type_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$sqlquery="delete from keyword_detail where  keyword_id='" . $keyword_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$sqlquery = "delete from contest_questions where contest_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());


	$sqlquery = "delete from contest_flink where contest_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$sqlquery="delete from contest_banner where contest_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$login_history = $cnts_name . " Contest successfully Deleted!";
	user_session($login_form,$sess_id,$login_history);
}

function contest_available ($cnts_name){
	global $login_form;

	$sqlquery = "select * from contest_detail where contest_name='" . $cnts_name . "' limit 1";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$cnts_avail=0;
	while($row=mysql_fetch_row($result)){
		$cnts_avail=1;
	}
	return $cnts_avail;
}

function last_contest_id(){
	global $login_form;

	$sqlquery = "select contest_id from contest_detail where archive!=1 order by contest_id desc limit 1";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$cnts_avail=0;
	while($row=mysql_fetch_row($result)){
		$cnts_avail=$row[0];
	}
	return $cnts_avail;
}

function valid_contest_key($keyword,$shortcode){
	global $cnts_id,$login_form;

	if(!$cnts_id){
		$sqlquery = "select id from keyword where keyword='" . $keyword . "' and shortcode='" . $shortcode . "'";
	}else{
		$sqlquery = "select id from keyword where keyword='" . $keyword . "' and shortcode='" . $shortcode . "' and type_id!='" . $cnts_id . "'";
	}

	//echo $sqlquery;
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$key_avail=0;
	while($row=mysql_fetch_row($result)){
		$key_avail=1;
	}
	return $key_avail;
}

function valid_contest_aliaskey($arralias,$shortcode){
	global $cnts_id,$login_form;

	$tmpalias="";

	for($cnt=0;$cnt<count($arralias);$cnt++){
		if(!$tmpalias){
			$tmpalias = "'" . $arralias[$cnt] . "'";
		}else{
			$tmpalias = $tmpalias . ",'" . $arralias[$cnt] . "'";
		}
	}


	if(!$cnts_id){
		$sqlquery = "select count(*) from keyword_detail where keyword_alias in (" . $tmpalias . ") and shortcode='" . $shortcode . "'";
	}else{
		$sqlquery = "select count(*) from keyword_detail where keyword_alias in (" . $tmpalias . ") and shortcode='" . $shortcode . "' and type_id!='" . $cnts_id . "'";
	}
	//echo "<br>Hello" . $sqlquery;

	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$key_avail=0;
	while($row=mysql_fetch_row($result)){
		$key_avail=$row[0];
	}
	return $key_avail;
}

?>