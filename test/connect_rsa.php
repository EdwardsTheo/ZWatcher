<?php


$prv_key = file_get_contents("../rsa/id_rsa.pub");

$prv_key_rsa = file_get_contents("../rsa/id_rsa");

$connection = ssh2_connect("82.64.225.10", 2020, array('hostkey' => 'ssh-rsa'));
ssh2_auth_pubkey_file($connection, 'zwadmin', $prv_key, $prv_key_rsa, '5e79131f2619bbe32070550b1b9ce45d')



?>
