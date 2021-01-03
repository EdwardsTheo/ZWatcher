<?php 

    require('ssh_connection.php');
    require('ssh_exec.php');
    require('../bash/install.php');
    require('../bash/check_install.php');
    require('../bash/check_package.php');
    require('../bash/edit_machine.php');
    require('../bash/observ_machine.php');
    require('../bash/user_group.php');
    require('../bash/rsa.php');

function main_ssh($machine_ip, $order, $app_name = NULL, $username = NULL, $password = NULL) {
    $login_info = info_login($machine_ip);  // give the information of the machine you want to connect
    return $output = ssh_execute($order, $login_info, $app_name, $username, $password); // output to check is the execution went well
}

function ssh_execute($order, $login_info, $app_name = NULL, $username = NULL, $password = NULL) {
    switch($order) {
        //Modifications
        case "get_machine_hostname" :
            $command =  get_machine_hostname();
        break;
        case "edit_hostname" :
            $command =  edit_hostname($_POST['hostname'], $_POST['old_name']);
        break;
        case "get_ip" :
            $command =  get_ip();
        break;
        case "edit_ip" :
            $command =  edit_ip($_POST['ip'], $_POST['interface']);
        break;
        case "get_interface" :
            $command =  get_interface();
        break;
        //Observation
        case "dwl_auth" :
            $command =  dwl_auth();
        break;
        case "dwl_kern" :
            $command =  dwl_kern();
        break;
        case "dwl_messages" :
            $command =  dwl_messages();
        break;
        case "dwl_syslog" :
            $command =  dwl_syslog();
        break;
        //Applications
        case "Installer" :  
            $command = install($app_name);
        break;
        case "check_install" :
            $command = check_install($app_name);
        break;
        case "Désinstaller" :  
            $command = uninstall($app_name);
        break;
        case "check_uninstall" :
            $command = check_uninstall($app_name);
        break;
	    case "check_package" :
            $command = check_package($app_name);
        break;
        case "update_upgrade" :
            $command = bash_upgrade_update();
        break;
        case "add_user" :
            $command = bash_add_user($username, $password);
        break;
        case "change_password" :
            $command = bash_change_password($username, $password);
        break;
        case "change_bash" :
            $command = change_bash($username);
        break;
        case "bash_user_exist" :
            $command = bash_user_exist($username);
        break;
        case "delete_users" :
            $command = delete_users($username);
        break;
        case "change_username" :
            $command = change_username($username, $password);
        break;
        case "create_home" :
            $command = create_home($username);
        break;
        case "delete_home" :
            $command = delete_home($username);
        break;
        // USERNAME == GROUPS NAME 
        case "add_groups" :
            $command = add_groups($username);
        break;
        case "check_groups" :
            $command = check_groups($username);
        break;
        case "add_groups_sudo" : 
            $command = add_groups_sudo($username);
        break;
        case "change_group_name" :
            $command = change_group_name($username, $password);
        break;
        case "add_user_to_groups" :
            $command = add_user_to_groups($username, $password);
        break;
        case "remove_from_groups" :
            $command = remove_from_groups($username, $password);
        break;
        case 'delete_groups' :
            $command = bash_delete_groups($username);
        break;
        case 'cat_rsa_key' :
            $command = cat_rsa_key($username);
        break;
        case "delete rsa dir" : 
            $command = delete_rsa_dir($username);
        break;
        //Default
        default :
            "error";
        break;
    }
    return $output = ssh_launch($login_info['ip'], $login_info['port'], $login_info['name'], $login_info['password'], $command);
}

function special_sudo($machine_id, $order, $username) {
    //THIS IS PAS TRES PROPRE
    if($order == 'add_groups_sudo') $command = add_groups_sudo($username);
    elseif($order == "retire_sudo_groups") $command = del_groups_sudo($username);
    $req = get_listes_machine($machine_id);
    while($donnees = $req->fetch()){
        $login['name'] = "root";
        $login['password'] = "ghghghgh";
        $login['ip'] = $donnees['ip'];
        $login['port'] = $donnees['port'];
    }
    return $output = ssh_launch($login['ip'], $login['port'], $login['name'], $login['password'], $command);
}

function rsa_controller($machine_id, $order, $username, $password, $hash = NULL) {
    switch($order) {
        case "create_rsa" : 
            $command = create_rsa($username, $hash);
        break;
        case "authorise key" : 
            $command = authorise_key();
        break;
    }
    $req = get_listes_machine($machine_id);
    while($donnees = $req->fetch()){
        $login['name'] = $username;
        $login['password'] = $password;
        $login['ip'] = $donnees['ip'];
        $login['port'] = $donnees['port'];
    }
    return $output = ssh_launch($login['ip'], $login['port'], $login['name'], $login['password'], $command);
}
    
?>
