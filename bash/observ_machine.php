<?php

function dwl_auth() {
	
    $command = "sudo tail -n 100 /var/log/auth.log";
		return $command;
}

function dwl_kern() {
	
	$command = "sudo tail -n 100 /var/log/kern.log";
		return $command;
}

function dwl_messages() {
	
	$command = "sudo tail -n 100 /var/log/messages";
		return $command;
}

function dwl_syslog() {
	
	$command = "sudo tail -n 100 /var/log/syslog";
		return $command;
}


?>