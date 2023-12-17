<?
$location = "localhost";
$database = "nfmenerg_smsdb";
$username = "nfmenerg_smsu";
$password = "Ag754ffgrtre";
$conn_mysql = mysql_connect("$location","$username","$password");
if (!$conn_mysql) die ("Could not connect MySQL");
mysql_select_db($database,$conn_mysql) or die ("Could not open database");
?>