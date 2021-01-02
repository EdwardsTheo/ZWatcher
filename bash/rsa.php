<?php 

function create_rsa($username, $hash) {
    echo $hash;
    $command = "ssh-keygen -t rsa -b 4096 -N '$hash' -f ~/.ssh/id_rsa";
    return $command;
}

function authorise_key() {
    $command = "cat ~/.ssh/id_rsa.pub > ~/.ssh/authorized_keys";
    return $command;
}

function cat_rsa_key($username) {
    $command = "sudo cat /home/$username/.ssh/id_rsa";
    return $command;
}

function delete_rsa_dir($username) {
    echo $username;
    $command = "sudo rm -rf /home/$username/.ssh";
    return $command;
}

?>