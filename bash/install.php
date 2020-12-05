<?php 

    function install($app) {
        $command = "sudo apt install -y $app";
        return $command;
    }

?>
