<?php 

function create_rsa($username, $hash) { 
    $command = "ssh-keygen -m PEM -t rsa -N '$hash' -f ~/.ssh/id_rsa";
    return $command;
}

function authorise_key($username) {
    $command = "cat /home/$username/.ssh/id_rsa.pub > /home/$username/.ssh/authorized_keys";
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

function openssh($hash) {
    $command = "openssl rsa -in /home/zwadmin/.ssh/id_rsa -out /home/zwadmin/.ssh/id_rsa.pem -passin pass:$hash";
    return $command; 
}

function cat_rsa_key_pem() {
    $command = "sudo cat /home/zwadmin/id_rsa.pem";
    return $command; 
}

function cat_rsa_key_pub() {
    $command = "sudo cat /home/zwadmin/id_rsa.pub";
    return $command; 
}



?>
