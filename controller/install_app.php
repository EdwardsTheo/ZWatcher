<?php

    print_r($_POST);
    phpinfo();


    $con = ssh2_connect("82.64.225.10", 2020);
    ssh2_auth_password($con, 'barney', 'stinson'); 
    $stream = ssh2_exec($con, 'ls -la');
    stream_set_blocking($stream, true);
    $output = stream_get_contents($stream);
    echo nl2br ("$output \n");
    
    unset($con);

?>