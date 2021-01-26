<?php 

require('ssh_connection.php'); // The file to have the right connection information
require('ssh_exec.php'); // The file that execute the request
    
// File that contains the bash command to execute
require('../bash/install.php');
require('../bash/edit_machine.php');
require('../bash/observ_machine.php');
require('../bash/user_group.php');
require('../bash/rsa.php');

function main_ssh($machine_ip, $order, $opt1 = NULL, $opt2 = NULL) {
    $login_info = info_login($machine_ip);  // Put the connection informations inside an array
    return $output = ssh_execute($order, $login_info, $opt1, $opt2, ); // Get the ouput of the command you executed
}

function ssh_execute($order, $login_info, $opt1 = NULL, $opt2 = NULL) {
    // order = the command you want to execute
    switch($order) {
        // Modifications
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
        // Observation
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
        // Applications
        case "Installer" :  
            $command = install($opt1);
        break;
        case "check_install" :
            $command = check_install($opt1);
        break;
        case "Désinstaller" :  
            $command = uninstall($opt1);
        break;
        case "check_uninstall" :
            $command = check_uninstall($opt1);
        break;
	    case "check_package" :
            $command = check_package($opt1);
        break;
        case "update_upgrade" :
            $command = bash_upgrade_update();
        break;
        // User and Group
        case "add_user" :
            $command = bash_add_user($opt1, $opt2);
        break;
        case "change_password" :
            $command = bash_change_password($opt1, $opt2);
        break;
        case "change_bash" :
            $command = change_bash($opt1);
        break;
        case "bash_user_exist" :
            $command = bash_user_exist($opt1);
        break;
        case "delete_users" :
            $command = delete_users($opt1);
        break;
        case "change_username" :
            $command = change_username($opt1, $opt2);
        break;
        case "change_home_dir" :
            $command = change_home_dir($opt1, $opt2);
        break;
        case "create_home" :
            $command = create_home($opt1);
        break;
        case "delete_home" :
            $command = delete_home($opt1);
        break;
        case "add_groups" :
            $command = add_groups($opt1);
        break;
        case "check_groups" :
            $command = check_groups($opt1);
        break;
        case "add_groups_sudo" : 
            $command = add_groups_sudo($opt1);
        break;
        case "change_group_name" :
            $command = change_group_name($opt1, $opt2);
        break;
        case "add_user_to_groups" :
            $command = add_user_to_groups($opt1, $opt2);
        break;
        case "remove_from_groups" :
            $command = remove_from_groups($opt1, $opt2);
        break;
        case 'delete_groups' :
            $command = bash_delete_groups($opt1);
        break;
        case "add_groups_sudo" : 
            $command = add_groups_sudo($opt1);
        break; 
        case "retire_sudo_groups" : 
            $command = del_groups_sudo($opt1);
        break; 
        case 'restart ssh' :
            $command = restart_ssh();
        break;
        case 'add_admin_sudo' :
            $command = add_admin_sudo($opt1);
        break;
        // RSA KEY 
        case 'cat_rsa_key' :
            $command = cat_rsa_key($opt1, $opt2);
        break;
        case "delete rsa dir" : 
            $command = delete_rsa_dir($opt1);
        break;
        case "activer rsa login" :
           $command = bash_password_auth_ssh();
        break;
        case 'desactiver rsa login' :
            $command = bash_password_auth_ssh_second();
        break;
        case 'openssh' :
            $command = openssh($opt2, $opt1);
        break;
        case "create_rsa" : 
            $command = create_rsa($opt1, $opt2);
        break;
        case "authorise key" : 
            $command = authorise_key($opt1);
        break;
        case "create_ssh_dir" :
            $command = create_ssh_dir($opt1);
        break;
        //Default
        default :
            "error";
        break;
    }
    return $output = ssh_launch($login_info['ip'], $login_info['port'], $login_info['name'], $login_info['password'], $command);
}
    
?>
