<?php

function check_install($app) {
    $command = "apt-cache policy $app";
    return $command;
}

?>