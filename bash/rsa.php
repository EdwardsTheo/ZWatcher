<?php 

function create_rsa($username, $hash) {
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
    $command = "sudo rm -rf /home/$username/.ssh";
    return $command;
}

function bash_active_rsa_login() {
    $command = "sudo sed -i '/PasswordAuthentication yes/c\PasswordAuthentication no' /etc/ssh/sshd_config";
    return $command;
}

function bash_desactivate_rsa_login() {
    $command = "sudo sed -i '/PasswordAuthentication no/c\PasswordAuthentication yes' /etc/ssh/sshd_config";
    return $command;
}

function restart_ssh() {
    $command = "sudo systemctl restart ssh";
    return $command;
}

?>