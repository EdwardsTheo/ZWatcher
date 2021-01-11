<?php

function check_package($app) {
	$command = "apt-cache policy $app";
    	return $command;
}

?>
