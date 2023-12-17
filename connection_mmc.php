<?
$location = "172.16.16.6";
$database = "campaign";
$username = "pramod";
$password = "pramod";

$conn = mysql_connect("$location","$username","$password");
if (!$conn) die ("Could not connect MySQL");

mysql_select_db($database,$conn) or die ("Could not open database");
mysql_query("SET NAMES 'utf8'");
?>
