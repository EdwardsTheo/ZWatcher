<?php

function ssh_launch($ip, $port, $username, $password, $command) {
    
    $req =  get_liste_data($_SESSION['id_machine']);
    while($data = $req->fetch()) {
        // Get inside the db, which connection to make (RSA (1) or standard login username/password (0))
        $connect_rsa = $data['connexion_rsa'];
    }
   
    //echo $command; // The command you will execute  
    //echo $ip; // ip of the machine 
    //echo $port; // port of the machine
    //echo $username; // username for login
    //echo $password; // password for the username

    if($connect_rsa == 0) { // 0 => login username/password
        // If connect_rsa is set to 0, use username/password to connect via ssh
        $connection = ssh2_connect($ip, $port);
        ssh2_auth_password($connection, $username, $password); 
    }
    
    else { // 1 => login with rsa key
        // else, use the file id_rsa.pub and id_rsa.pem of the admin to connect via ssh with rsa keys
	    $id_pub = "id_rsa_" . $_SESSION['id_machine'] . ".pub";
	    $id_pem = "id_rsa_" . $_SESSION['id_machine'] . ".pem";

	    $connection = ssh2_connect($ip, $port, array('hostkey' => 'ssh-rsa'));
        ssh2_auth_pubkey_file($connection, 'zwadmin',
                    "../rsa_admin/$id_pub",
                    "../rsa_admin/$id_pem", '');
    }

    // After the connection is set, execute the command 
    $stream = ssh2_exec($connection, $command);
    stream_set_blocking($stream, true);
    $output = stream_get_contents($stream);
    //echo nl2br ("$output \n"); // To the the output of the executed command
    unset($connection);

    return $output; // Return the result of the command
}

?>
