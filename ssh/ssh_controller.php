<?php 

    require('ssh_connection.php');
    require('ssh_exec.php');
    require('../bash/install.php');
    require('../bash/check_install.php');
    require('../bash/check_package.php');
    require('../bash/edit_hostname.php');

function main_ssh($machine_ip, $order, $app_name = NULL) {
    $login_info = info_login($machine_ip);  // give the information of the machine you want to connect
    return $output = ssh_execute($order, $login_info, $app_name); // output to check is the execution went well
}

function ssh_execute($order, $login_info, $app_name = NULL) {
    switch($order) {
        //Modifications
        case "edit_hostname" :
            $command =  edit_hostname($_POST['hostname']);
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
        //Default
        default :
            "error";
        break;
    }
    return $output = ssh_launch($login_info['ip'], $login_info['port'], $login_info['name'], $login_info['password'], $command);
}
    
?>
