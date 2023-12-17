<?php require("gui_common.php");


$compName = $_REQUEST["cpName"];
$action=$_REQUEST["action"];			//1-new,2-update,3-delete
$treeview_cod=$_REQUEST["treeview_cod"];
$login_form=$_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];

$cntsid=$_REQUEST["cnts_id"];
$cnts_question = $_REQUEST["question"];
$opt_a = $_REQUEST["opt_a"];
$opt_b = $_REQUEST["opt_b"];
$opt_c = $_REQUEST["opt_c"];
$opt_d = $_REQUEST["opt_d"];
$cnts_ans = $_REQUEST["cnts_ans"];
$max_option = $_REQUEST["max_option"];
$act_status = $_REQUEST["act_status"];

$qutn_id= $_REQUEST["question_id"];	//check id

if($action==3 && $cntsid){
	delete_contest_question();
	$qutn_id=last_question_id($cntsid);
	$msg_alert = 'Contest Question Successfully Deleted!';
	header("Location: question_view.php?login=" . $login_form . "&sess_id=" . $sess_id ."&msg_alert=" . $msg_alert ."&action=1&treeview_cod=" . $treeview_cod ."&cnts_id=" . $cntsid . "&question_id=" . $qutn_id . "&smenu=" . $smenu . "&cpName" . $compName);
	die();
}

if($action==1){
	$urlstr="Location: contest_question.php?";
}else if($action==2){
		$urlstr="Location: question_modify.php?";
}
$urlstr=$urlstr . "action=" . $action . "&treeview_cod=" . $treeview_cod . "&login=" . $login_form . "&sess_id=" . $sess_id . "&cnts_id=" . $cntsid . "&question=" . $cnts_question . "&opt_a=" . $opt_a . "&opt_b=" . $opt_b . "&opt_c=" . $opt_c . "&opt_d=" . $opt_d . "&cnts_ans=" . $cnts_ans . "&max_option=" . $max_option . "&act_status=" . $act_status . "&smenu=" . $smenu . "&cpName=" . $compName;

if (check_blank($cntsid)){
	$msg_alert = "Please enter the contest name!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}

if (check_blank($cnts_question)){
	$msg_alert = "Please enter the contest question!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}

if (check_blank($opt_a)){
	$msg_alert = "Please enter the option A!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}

if (check_blank($opt_b)){
	$msg_alert = "Please enter the option B!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}

if ($max_option>2 && check_blank($opt_c)){
	$msg_alert = "Please enter the option C!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}

if ($max_option > 3 && check_blank($opt_d)){
	$msg_alert = "Please enter the option D!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}

if ($max_option && check_blank($cnts_ans)){
	$msg_alert = "Please enter the Answer!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}

if ($action==1 && check_ques($cnts_question,$cntsid)){
	$msg_alert = "Contest Question Already exit!";
	header($urlstr . "&msg_alert=" . $msg_alert);
	die();
}

if($action==1){
	$q_id=insert_contest_question ();
	$msg_alert = "Contest Question Successfully Inserted!";
	header("Location: contest_question.php?login=" . $login_form . "&sess_id=" . $sess_id . "&msg_alert=" . $msg_alert ."&cnts_id=" . $cntsid ."&question_id=" . $q_id . "&smenu=" . $smenu. "&cpName=" . $compName);
	die();
}else if($action==2){
	update_contest_question ();
	$msg_alert = "Contest Question Successfully Updated!";
	header("Location: question_modify.php?login=" . $login_form . "&sess_id=" . $sess_id . "&msg_alert=" . $msg_alert ."&cnts_id=" . $cntsid ."&question_id=" . $qutn_id ."&flag=1&smenu=" . $smenu . "&cpName=" . $compName);
	die();
}

function insert_contest_question (){
	global $smenu,$sess_id,$act_status,$login_form, $cntsid, $cnts_question, $opt_a, $opt_b, $opt_c, $opt_d, $cnts_ans, $max_option, $selected_seq, $hdr1,$qid, $compName;

	$qno = contest_qestion_detail($cntsid);

	$sqlquery = "insert into contest_questions(contest_id, question, a, b, c, d, ans, active_status,ques_no,max_options,contest_seq,login) values('" . $cntsid . "', '" . str_replace("'", "''", $cnts_question) . "', '" . str_replace("'", "''", $opt_a) . "', '" . str_replace("'", "''", $opt_b) . "', '" . str_replace("'", "''", $opt_c) . "', '" . str_replace("'", "''", $opt_d) . "', '" . $cnts_ans . "', '1', '" . $qno . "', '" . $max_option . "', '" . $selected_seq . "','" . $login_form . "')";
	
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	if ($result == 0){
		$msg_alert = "There is some problem at server";
		header("Location: contest_question.php?login=" . $login_form . "&sess_id=" . $sess_id ."&msg_alert=" . $msg_alert ."&action=" . $action ."&treeview_cod=" . $treeview_cod ."&header1=" . $hdr1 . "&cnt=1&smenu=" . $smenu. "&cpName=" . $compName);
		die();
	}else{
		$login_history = $cnts_name . "Contest Question Successfully Added!";
		user_session($login_form,$sess_id,$login_history,$compName);
	}
	return $qno;
}

function update_contest_question(){
	global $smenu,$sess_id,$login_form, $qutn_id, $cnts_question, $opt_a, $opt_b, $opt_c, $opt_d, $cnts_ans, $act_status, $cntsid, $compName;

	$sqlquery = "update contest_questions set question='" . str_replace("'", "''", $cnts_question) . "', a='" . str_replace("'", "''", $opt_a) . "', b='" . str_replace("'", "''", $opt_b) . "', c='" . str_replace("'", "''", $opt_c) . "', d='" . str_replace("'", "''", $opt_d) . "', active_status='" . $act_status . "', ans='" . $cnts_ans . "' where id='" . $qutn_id . "' and contest_id='" . $cntsid . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	if ($result == 0){
		$msg_alert = "There is some problem at server";
		user_session($login_form,$sess_id,$msg_alert);
		header("Location: question_modify.php?login=" . $login_form . "&sess_id=" . $sess_id . "&msg_alert=" . $msg_alert ."&action=2&treeview_cod=" . $treeview_cod . "&smenu=" . $smenu. "&cpName=" . $compName);
		die();
	}else{
		$login_history ="Contest successfully Modified in $cntsid!";
		user_session($login_form,$sess_id,$login_history,$compName);
	}
}

function delete_contest_question(){
	global $smenu,$sess_id,$login_form, $qutn_id, $cntsid,$treeview_cod,$compName;

	$sqlquery = "delete from contest_questions where id='" . $qutn_id . "' and contest_id='" . $cntsid . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());


	if ($result==0){
		$msg_alert = "There is some problem at server";
		header("Location: question_delete.php?login=" . $login_form . "&sess_id=" . $sess_id ."&msg_alert=" . $msg_alert ."&action=1&treeview_cod=" . $treeview_cod . "&smenu=" . $smenu. "&cpName=" . $compName);
		die();
	}else{
		/**********HISTORY MAINTENANCE*********/
		/*************************************/
		$login_history ="Contest id $cntsid Question id $qutn_id successfully Deleted!";
		user_session($login_form,$sess_id,$login_history,$compName);
	}
}


function q_no ($cntsid){
	global $login_form;

	$sqlquery = "select ques_no from contest_questions where contest_id='" . $cntsid . "' order by ques_no  desc limit 1";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$q_no = "";
	while($row = mysql_fetch_row($result)){
		$q_no = $row[0];
	}
	return $q_no;
}

/************CHECK QUESTION DETAIL***********/
function check_ques($ques, $cntsid){
	global $login_form;

	$sqlquery = "select id from contest_questions where question='" . str_replace("'", "''",$ques) . "' and contest_id='" . $cntsid . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$ques_flag = 0;
	while($row = mysql_fetch_row($result)){
		$ques_flag = 1;
	}
	return $ques_flag;
}

function last_question_id($cntsid){
	$sqlquery = "select id from contest_questions where contest_id='" . $cntsid ."' order by id desc limit 1";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$cnts_avail=0;
	while($row=mysql_fetch_row($result)){
		$cnts_avail=$row[0];
	}
	return $cnts_avail;
}

?>