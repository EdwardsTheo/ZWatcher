<?php

function ssh_launch($ip, $port, $username, $password, $command) {
    
    $req =  get_liste_data($_SESSION['id_machine']);
    while($data = $req->fetch()) {
        $connect_rsa = $data['connexion_rsa'];
    }
   
    //echo $command; 
    //echo $ip;
    //echo $port;
    //echo $username;
    //echo $password;
    
    $command = "ls -la";

    if($connect_rsa == 0) {
        
        $con = ssh2_connect($ip, $port);
        ssh2_auth_password($con, $username, $password); 
        $stream = ssh2_exec($con, $command);
        stream_set_blocking($stream, true);
        $output = stream_get_contents($stream);
        echo nl2br ("$output \n");
        unset($con);

    }
    
    else {
       /* $connection = ssh2_connect('82.64.225.10', 2020, array('hostkey' => 'ssh-rsa'));

        ssh2_auth_pubkey_file($connection, 'zwadmin',
                    '/home/tbaptiste/id_rsa.pub',
                    '/home/tbaptiste/id_rsa.pem', '');
        $stream = ssh2_exec($connection, $command);
        stream_set_blocking($stream, true);
        $output = stream_get_contents($stream);
        echo nl2br ("$output \n");
        unset($con);
        */
    }

    /*
    $con = ssh2_connect(, $port);
    ssh2_auth_password($con, $username, $password); 
    $stream = ssh2_exec($con, $command);
    stream_set_blocking($stream, true);
    $output = stream_get_contents($stream);
    echo nl2br ("$output \n");
    unset($con);
    */

    return $output;
}

?>
