<?php
$location = "197.156.64.6";
$database = "campaign";
$username = "sms";
$password = "s@m#s123";

$conn = mysql_connect("$location","$username","$password");
if (!$conn) die ("Could not connect MySQL");

mysql_select_db($database,$conn) or die ("Could not open database");
mysql_query("SET NAMES 'utf8'");
?>
