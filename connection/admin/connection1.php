<?
$location = "203.122.58.120";
$database = "campaign";
$username = "sa";
$password = "ring2001";
$conn_mysql = mysql_connect("$location","$username","$password");
if (!$conn_mysql) die ("Could not connect MySQL");
mysql_select_db($database,$conn_mysql) or die ("Could not open database");
?>