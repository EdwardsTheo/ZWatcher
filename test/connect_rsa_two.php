<?php

$host   = '82.64.225.10';
$port   = '2020';
$user   = 'zwadmin';
$pass   = 'zwadmin';
$pubkey = '/home/tbaptiste/id_rsa.pub';
$prikey = '/home/tbaptiste/id_rsa';

$conn   = ssh2_connect( $host, $port );
$auth   = ssh2_auth_pubkey_file( $conn, $user, $pubkey, $prikey, $pass );

if ( $auth )
{
    echo 'Public Key Authentication Successful.' . PHP_EOL;
}
else
{
    echo 'Public Key Authentication Failed.' . PHP_EOL;
}

?>
