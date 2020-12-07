<?php 

    function install($app) {
        $command = "sudo apt install -y $app";
        return $command;
    }

    function uninstall($app) {
    	$command = "sudo apt autoremove -y $app";
	    return $command;
    }

?>
