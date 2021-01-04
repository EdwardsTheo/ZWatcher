<?php 

    function install($app) {
        $command = "sudo apt install -y $app";
        return $command;
    }

    function uninstall($app) {
    	$command = "sudo apt autoremove -y $app";
	    return $command;
    }

    function bash_upgrade_update() {
        $command = "sudo apt update -y && sudo apt upgrade -y";
        return $command;
    }

?>
