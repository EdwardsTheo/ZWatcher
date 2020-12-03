<?php 

    function install($app) {
        $command = "yes | sudo apt install $app";
        return $command;
    }

?>