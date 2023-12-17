<?php
 $conn = null;
 $sess_id = null;
 $login_form = null;
 $questions_cnt = null;
 $question_id = null;
 $login_type = null;
 $companyName = null;
 $user_type = null;
 
$_REQUEST["login"]=null;
$_REQUEST["smenu"]=null;
$_REQUEST["sess_id"]=null;
//$_REQUEST["msg_alert"]=null;
$_REQUEST["param"]=null;


session_start();
session_destroy();
header('location:index.php');


?>

