<?php 

function create_ssh_dir($username) {
    // Create the ~/.ssh directory for the user and give the right to the user:usergroup (instead of sudo)
    $command = "sudo mkdir /home/$username/.ssh && sudo chown $username:$username /home/$username/.ssh/";
    return $command;
}

function create_rsa($username, $hash) { 
    // Create an rsa key compatible with SSL inside the user home directory, then give the right of all the file inside for the user
    $command = "sudo ssh-keygen -m PEM -t rsa -N '$hash' -f /home/$username/.ssh/id_rsa && sudo chown $username:$username /home/$username/.ssh/*";
    return $command;
}

function authorise_key($username) {
    // Move the public key to the authorized_keys file, make ssh connection avaible with rsa keys
    $command = "sudo cat /home/$username/.ssh/id_rsa.pub > /home/$username/.ssh/authorized_keys";
    return $command;
}

function cat_rsa_key($username, $type) {
    // Cat the content of the needed key (id_rsa, id_rsa.pub, id_rsa.pem)
    $command = "sudo cat /home/$username/.ssh/$type";
    return $command;
}

function delete_rsa_dir($username) {
    // Delete the directory where the keys are stored
    $command = "sudo rm -rf /home/$username/.ssh";
    return $command;
}

function bash_password_auth_ssh() {
    // Deactivate password login for ssh
    $command = "sudo sed -i '/PasswordAuthentication yes/c\PasswordAuthentication no' /etc/ssh/sshd_config";
    return $command;
}

function bash_password_auth_ssh_second() {
    // Activate password login for ssh
    $command = "sudo sed -i '/PasswordAuthentication no/c\PasswordAuthentication yes' /etc/ssh/sshd_config";
    return $command;
}

function restart_ssh() {
    // Restart the ssh service
    $command = "sudo systemctl restart ssh";
    return $command;
}

function openssh($hash) {
    // Create a id_rsa.pem to use the ssh2_auth_pubkey_file function
    $command = "openssl rsa -in /home/zwadmin/.ssh/id_rsa -out /home/zwadmin/.ssh/id_rsa.pem -passin pass:$hash";
    return $command; 
}



?>
