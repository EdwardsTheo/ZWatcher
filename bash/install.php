<?php 

function install($app) {
    // Install the app, -y => pass the y/n prompt
    $command = "sudo apt install -y $app";
    return $command;
}

function uninstall($app) {
    // Unistall the app, -y => pass the y/n prompt
    $command = "sudo apt autoremove -y $app";
    return $command;
}

function bash_upgrade_update() {
    // Update and upgrade, -y => pass the y/n prompt
    $command = "sudo apt update -y && sudo apt upgrade -y";
    return $command;
}

function check_package($app) {
    // Check if the package exist
    $command = "apt-cache policy $app";
        return $command;
}

function check_install($app) {
    // Check if the package is installed in the machine 
    $command = "dpkg -s $app | sed -n 2p";
    return $command;
}

function check_uninstall($app) {
    // Check if the package is not installed in the machine
    $command = "apt-cache policy $app | sed -n 2p";
    return $command;	
}

?>
