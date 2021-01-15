<?php

$prv_key = file_get_contents('/home/tbaptiste/id_rsa.pem');
$prv_key_pub = file_get_contents('/home/tbaptiste/id_rsa.pub');

print "<pre>";
var_export($prv_key);
print "</pre>";

print "<pre>";
var_export($prv_key_pub);
print "</pre>";

$connection = ssh2_connect('82.64.225.10', 2020, array('hostkey' => 'ssh-rsa'));

ssh2_auth_pubkey_file($connection, 'zwadmin',
			  '/home/tbaptiste/id_rsa.pub',
			  '/home/tbaptiste/id_rsa.pem', '');
$stream = ssh2_exec($connection, 'ls -la /home/zwadmin');
stream_set_blocking($stream, true);
$output = stream_get_contents($stream);
echo nl2br ("$output \n");
unset($con);

?>
