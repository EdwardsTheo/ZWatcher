<?php 

define('HOST', 'mysql');
define('DB_NAME', "zwatcher");
define('USER', 'root');
define('PASS', 'password');

function connect_start()
{

	//$link = new PDO("mysql:host=".HOST.";port=".PORT.";dbname=".DB_NAME, USER, PASS);
	$link = new PDO("mysql:host=".HOST.";dbname=".DB_NAME, USER, PASS);
	if($link)
		$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $link;
}

function connect_end(&$link)
{
	$link = NULL;
}
?>
