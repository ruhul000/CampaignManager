<?
$location = "172.16.16.6";
$database = "campaign";
$username = "pramod";
$password = "pramod";
$conn_mysql = mysql_connect("$location","$username","$password");
if (!$conn_mysql) die ("Could not connect MySQL");
mysql_select_db($database,$conn_mysql) or die ("Could not open database");
?>