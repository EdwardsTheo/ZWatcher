<?php

$host="mysql";
$user="root";
$pass="password";
$db="zwatcher";

$con=mysqli_connect($host,$user,$pass,$db);

if(!$con)
{
	print("Not Connected<br>".mysql_error());

}
else
{
	echo("Connected");
}






?>
