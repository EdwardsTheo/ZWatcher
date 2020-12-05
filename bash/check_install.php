<?php

	function check_install($app) {
    		$command = "dpkg -s $app | sed -n 2p";
    		return $command;
	}

	function check_uninstall($app) {
		$command = "dpkg -l $app";
		return $command;	
	}

?>
