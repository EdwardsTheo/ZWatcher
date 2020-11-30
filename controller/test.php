<?php $connection = ssh2_connect('82.64.225.10', 2020);
ssh2_auth_password($connection, 'barney', 'stinson');
$stream = ssh2_exec($connection, 'mkdir /home/barney/test');
?>