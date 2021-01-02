<?php

function edit_hostname($new_hostname, $old_name) {
	
	$fixed = trim($old_name);
	$command = "sudo sed -i 's/$fixed/$new_hostname/g' /etc/hosts | sudo hostnamectl set-hostname $new_hostname";
		return $command;
}

function get_machine_hostname() {
	
	$command = "hostname";
		return $command;
}

?>