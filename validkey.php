<?
require("connection_mmc.php");

$shortcode = intval($_REQUEST["shortcode"]);
$keyword = $_REQUEST["keyword"];
$chkflag = $_REQUEST["chkflag"];

if($chkflag==1){
	$sqlquery = "select id from keyword where shortcode='" . $shortcode . "' and keyword='" . $keyword . "'";
}else if($chkflag==2){
	$sqlquery = "select id from keyword_detail where shortcode='" . $shortcode . "' and keyword_alias='" . $keyword . "'";
}
$user_id = 0;
if($sqlquery){
	$result = mysql_query($sqlquery) or die('mysql error : ' . mysql_error());
	while($row = mysql_fetch_row($result)){
		$user_id = 1;
	}

}
echo $user_id;
mysql_close($conn);
?>