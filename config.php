<?php
/*
OS specify for platform configuration 
0- Linux/Unix, 1- Win
*/
#define OS 1
if(!defined('DIR_SEPERATOR')){
	define('DIR_SEPERATOR','/');
	define('APP_CONTEXT','');
	define('PORT','80');
	define('MYSQL','/usr/bin/mysql');
}
?>