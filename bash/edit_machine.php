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

function get_ip() {
	
	//$command = "ifconfig | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*' | grep -v '127.0.0.1'";
	$command = "hostname -I | cut -d' ' -f1";
		return $command;
}

function edit_ip($new_ip, $interface) {
	
	$fixed = trim($interface);
	$command = "sudo ip address add $new_ip dev $fixed";
		return $command;
}

function get_interface() {
	
	$command = "ip link | awk -F: '$0 !~ 'lo|vir|wl|^[^0-9]'{print $2;getline}'";
		return $command;
}

?>