<?php 

function bash_add_user($username, $password) {
    $command = "sudo useradd $username";
    return $command;
}

function bash_change_password($username, $password) {
    $command = "echo '$username:$password' | sudo chpasswd";
    return $command;
}

function change_bash($username) {
    $command = "sudo chsh -s /bin/bash $username";
    return $command;
}

function bash_user_exist($username) {
    $command = "getent passwd $username";
    return $command;
}

function delete_users($username) {
    $command = "sudo userdel $username";
    return $command;
}

function change_username($old_username, $new_username) {
    $command = "sudo usermod -l $old_username $new_username";
    return $command;
}

function add_groups($name_group) {
    $command = "sudo groupadd $name_group";
    return $command;
}

function check_groups($name_group) {
    $command = "sudo getent group $name_group";
    return $command;
}

function add_groups_sudo($name_group) {
    $command = "echo '%$name_group ALL=(ALL:ALL) ALL' >> /etc/sudoers";
    return $command;
}

function del_groups_sudo($name_group) {
    $command = "sudo sed -i '/%$name_group ALL=(ALL:ALL) ALL/d' /etc/sudoers";
    return $command;
}

function change_group_name($name_group, $old_name) {
    $command = "sudo groupmod -n $name_group $old_name";
    return $command;
}

function add_user_to_groups($username, $group_name) {
    $command = "sudo usermod -a -G $username $group_name";
    return $command;
}

function remove_from_groups($username, $groupname) {
    $command = "sudo deluser $groupname $username";
    return $command;
}

function bash_delete_groups($groupname) {
    $command = "sudo groupdel $groupname";
    return $command;
}

?>