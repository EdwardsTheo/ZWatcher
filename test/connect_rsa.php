<?php

$connection = ssh2_connect("82.64.225.10", 2020, array('hostkey' => 'ssh-rsa'));

if (ssh2_auth_pubkey_file($connection, 'zwadmin',
                          '../rsa/id_rsa.pub',
                          '../rsa/zwadmin_4.txt', '5e79131f2619bbe32070550b1b9ce45d')) {
  echo "Identification réussie en utilisant une clé publique\n";
} else {
  die('Echec de l\'identification en utilisant une clé publique');
}

?>
