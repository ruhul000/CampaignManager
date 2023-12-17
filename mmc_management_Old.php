<?php
header("Cache-Control: no-cache, must-revalidate");
require("./gui_common.php");
require("./template.php");

$login_form =$_REQUEST["login"];
$smenu =$_REQUEST["smenu"];
$sess_id=$_REQUEST["sess_id"];

if($sess_id==""){
	$sess_id=md5(microtime());
	$msg = "newuser";
}elseif($login_form=='admin'){
	if ($smenu==1) {
		$msg = "Group Management Choose";
	}else if ($smenu==2) {
		$msg = "Target Buildup Choose";
	}else if ($smenu==3) {
		$msg = "Contest Management Choose";
	}else if ($smenu==4) {
		$msg = "Bulk SMS Broadcast Choose";
	}else if ($smenu==5) {
		$msg = "Scheduler Choose";
	}else if ($smenu==8) {
		$msg = "Map Field Choose";
	}else if($smenu==9){
		$msg = "Login Field Choose";
	}
}else{
	if ($smenu==1) {
		$msg = "Group Management Choose";
	}else if ($smenu==2) {
		$msg = "Target Buildup Choose";
	}else if ($smenu==3) {
		$msg = "Contest Management Choose";
	}else if ($smenu==4) {
		$msg = "Bulk SMS Broadcast Choose";
	}else if ($smenu==5) {
		$msg = "Scheduler Choose";
	}else if ($smenu==8) {
		$msg = "Map Field Choose";
	}
}

user_session($login_form,$sess_id,$msg);
hheader($smenu);
tree_code ();
ffooter();
?>
