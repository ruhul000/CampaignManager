<?php require("upload.php");
require("gui_common.php");

$login_form = $_REQUEST["login"];
$sess_id = $_REQUEST["sess_id"];
$cnts_id = $_REQUEST["cnts_id"];
$smenu = $_REQUEST["smenu"];
$qstn_type = $_REQUEST["qstn_type"];

if (check_blank($cnts_id)){
	$msg_alert = "Please select contest name!";
	header("Location: question_import.php?login=" . $login_form . "&sess_id=" . $sess_id . "&cnts_id=" . $cnts_id . "&qstn_type=" . $qstn_type . "&msg_alert=" . $msg_alert ."&question_id=" . $qstn_id ."&smenu=" . $smenu);
	die();
}

if (check_blank($qstn_type)){
	$msg_alert = "Please select question type!";
	header("Location: question_import.php?login=" . $login_form . "&sess_id=" . $sess_id . "&cnts_id=" . $cnts_id . "&qstn_type=" . $qstn_type . "&msg_alert=" . $msg_alert ."&question_id=" . $qstn_id . "&smenu=" . $smenu);
	die();
}
$tag="file";
$delema='|';
$destn="uploads/" . $login_form;
$flag=1;


$path=upload_files ($tag,$destn);	//return path or upload error
if(strrpos($path,"/")===false){
	$flag=0;
	$msg_alert=$path;
	header("Location: question_import.php?login=" . $login_form . "&sess_id=" . $sess_id . "&cnts_id=" . $cnts_id . "&qstn_type=" . $qstn_type . "&msg_alert=" . $msg_alert ."&question_id=" . $qstn_id . "&smenu=" . $smenu);
	die();

}

if($flag){
	$fquest=file_parse($path,$delema);	//	return content array or nok
	if(gettype($fquest)!="array" || $fquest=="nok"){
		$flag=0;
		$msg_alert="Either file is empity or mandatory field is not found!";
		header("Location: question_import.php?login=" . $login_form . "&sess_id=" . $sess_id . "&cnts_id=" . $cnts_id . "&qstn_type=" . $qstn_type . "&msg_alert=" . $msg_alert ."&question_id=" . $qstn_id . "&smenu=" . $smenu);
		die();
	}
}

if($flag){
	$rept_content=find_repeat($fquest,"question");	//	return unique array index base on field
	if(empty($rept_content) || $file_content=="nok"){
		$flag=0;
		$msg_alert="Search field is not found in content!";
		header("Location: question_import.php?login=" . $login_form . "&sess_id=" . $sess_id . "&cnts_id=" . $cnts_id . "&qstn_type=" . $qstn_type . "&msg_alert=" . $msg_alert ."&question_id=" . $qstn_id . "&smenu=" . $smenu);
		die();
	}
}

$cntfq=count($fquest);
$cntrq=count($rept_content);

$final_questn=array();
$ind=0;

$final_questn[0]=$fquest[0];

for($cnt1=1,$cnt=0;$cnt<$cntrq;$cnt++,$cnt1++){
	$final_questn[$cnt1]=$fquest[$rept_content[$cnt]];
}

if($flag){
	$cnt_id['contest_id']=$cnts_id;
	$ques_id['ques_no']=contest_qestion_detail($cnts_id);
	arr_insert($final_questn,"contest_questions",$cnt_id,$ques_id);
	$msg_alert = 'Contest Question successfully inserted!!!';
	header("Location: question_import.php?login=" . $login_form . "&sess_id=" . $sess_id . "&msg_alert=" . $msg_alert ."&question_id=" . $qstn_id ."&cnts_id=" . $cnts_id . "&smenu=" . $smenu);
	die();
}
?>