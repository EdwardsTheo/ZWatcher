<?php 

function bash_add_user($username) {
    // Add an user 
    $command = "sudo useradd $username";
    return $command;
}

function bash_change_password($username, $password) {
    // Change the password of the user
    $command = "echo '$username:$password' | sudo chpasswd";
    return $command;
}

function change_bash($username) {
    // Change the bash used by the user
    $command = "sudo chsh -s /bin/bash $username";
    return $command;
}

function create_home($username) {
    // Create the home directory and set the right for the new created user
    $command = "sudo mkdir /home/$username && sudo chown $username:$username /home/$username";
    return $command;
}

function bash_user_exist($username) {
    // Check if a bash user with this username exist
    $command = "getent passwd $username";
    return $command;
}

function delete_users($username) {
    // Delete an user
    $command = "sudo userdel $username";
    return $command;
}

function delete_home($username) {
    // Delete the home directory of the user
    $command = "sudo rm -rf /home/$username";
    return $command;
}

function change_username($old_username, $new_username) {
    // Change the username of an user
    $command = "sudo usermod -l $old_username $new_username";
    return $command;
}

function change_home_dir($username) {
    // When the username is changed, it changes is home directory with keeping the file inside
    $command = "sudo usermod -m -d /home/$username $username";
    return $command;
}

function add_groups($name_group) {
    // Add a new group 
    $command = "sudo groupadd $name_group";
    return $command;
}

function check_groups($name_group) {
    // Check if the group exist 
    $command = "sudo getent group $name_group";
    return $command;
}

function add_groups_sudo($name_group) {
    // Grant sudo right to a group 
    $command = "echo '%$name_group ALL=(ALL:ALL) ALL' | sudo EDITOR='tee -a' visudo";
    return $command;
}

function del_groups_sudo($name_group) {
    // Deactivate the sudo right of a group
    $command = "sudo sed -i '/%$name_group ALL=(ALL:ALL) ALL/d' /etc/sudoers";
    return $command;
}

function add_admin_sudo($user) {
    // Add the admin into sudoers file 
    $command = "echo '$user ALL=(ALL) NOPASSWD:ALL' | sudo EDITOR='tee -a' visudo";
    return $command;
}

function change_group_name($name_group, $old_name) {
    // Change the name of a group
    $command = "sudo groupmod -n $name_group $old_name";
    return $command;
}

function add_user_to_groups($username, $group_name) {
    // Add user to a group
    $command = "sudo usermod -a -G $username $group_name";
    return $command;
}

function remove_from_groups($username, $groupname) {
    // Remove user from a group
    $command = "sudo deluser $groupname $username";
    return $command;
}

function bash_delete_groups($groupname) {
    // Delete a group
    $command = "sudo groupdel $groupname";
    return $command;
}

?>
