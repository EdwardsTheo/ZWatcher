<?php

function ssh_launch($ip, $port, $username, $password, $command) {

    $con = ssh2_connect($ip, $port);
    ssh2_auth_password($con, $username, $password); 
    $stream = ssh2_exec($con, $command);
    stream_set_blocking($stream, true);
    $output = stream_get_contents($stream);
    echo nl2br ("$output \n");
    unset($con);
}

?>
