<?php require_once "upload.php";

header("Pragma: no-cache");
header("Cache: no-cahce");
header( "Expires: Mon, 08 Oct 1997 03:00:00 GMT" );
header( "Cache-Control: no-store,no-cache, must-revalidate" );
header( "Cache-Control: post-check=0, pre-check=0", FALSE);
header( "Pragma: no-cache" );

ClearStatCache();



set_time_limit(5);
error_reporting(0);

$host_ip = $_REQUEST["host_ip"];
$db_name=$_REQUEST["db_name"];
$db_user=$_REQUEST["db_user"];
$db_pwd=$_REQUEST["db_pwd"];
$login=$_REQUEST["login"];
$filename=getcwd() .DIR_SEPERATOR. "connection".DIR_SEPERATOR."$login".DIR_SEPERATOR. "connection.php";

$conn_mysql = mysql_connect("$host_ip","$db_user","$db_pwd");

if (!$conn_mysql) {
	//echo"Could Not Connect to MySQL with host ip:$host_ip, User Name: $db_user and User password:$db_pwd.";
	echo"Could Not Connect to MySQL with host ip:$host_ip.";
	if(is_file($filename)) unlink($filename);
	die();
}

$flag=mysql_select_db($db_name,$conn_mysql);

if (!$flag) {
	echo"Could Not Open $db_name Database.";
	die();
}

$filetext="<?\n";
$filetext = $filetext . '$location = "' . $host_ip . '";' . "\n";
$filetext = $filetext . '$database = "' . $db_name . '";' . "\n";
$filetext = $filetext . '$username = "' . $db_user . '";' . "\n";
$filetext = $filetext . '$password = "' . $db_pwd . '";' . "\n";

$filetext = $filetext . '$conn_mysql = mysql_connect("$location","$username","$password");' . "\n";
$filetext = $filetext . 'if (!$conn_mysql) die ("Could not connect MySQL");' . "\n";;

$filetext = $filetext . 'mysql_select_db($database,$conn_mysql) or die ("Could not open database");' . "\n";
$filetext = $filetext . '?>';



$path=DIR_SEPERATOR."connection".DIR_SEPERATOR."$login".DIR_SEPERATOR;
if(!is_dir($path)){
	create_folder($path);
}
$fp=fopen($filename,"w");
fwrite($fp,$filetext,strlen($filetext));
fclose($fp);

echo "ok|Successfully Connected to $db_name";
?>