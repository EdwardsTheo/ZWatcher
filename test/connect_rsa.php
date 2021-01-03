<?php

$prv_key = file_get_contents('/home/keyuser/id_rsa');
$prv_key_pub = file_get_contents('/home/keyuser/id_rsa.pub');

print "<pre>";
var_export($prv_key_pub);
print "</pre>";


$connection = ssh2_connect('82.64.225.10', 2020, array('hostkey' => 'ssh-rsa'));

if (ssh2_auth_pubkey_file($connection, 'bob',
                          '/home/tbaptiste/id_rsa.pub',
                          '/home/tbaptiste/id_rsa', "")) {
  echo "Identification réussie en utilisant une clé publique\n";
} else {
  die('Echec de l\'identification en utilisant une clé publique');
}
?>
