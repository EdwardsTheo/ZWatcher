<?php 

    require('ssh_connection.php');
    require('ssh_exec.php');
    require('../bash/install.php');
    require('../bash/check_install.php');
    require('../bash/check_package.php');
    require('../bash/edit_hostname.php');

function main_ssh($machine_ip, $order) {
    $login_info = info_login($machine_ip);  // give the information of the machine you want to connect
    return $output = ssh_execute($order, $login_info); // output to check is the execution went well
}

function ssh_execute($order, $login_info) {
    switch($order) {
        //Modifications
        case "edit_hostname" :
            $command =  edit_hostname($_POST['hostname']);
        break;
        //Applications
        case "install" :  
            $command = install($_POST['nom_appli']);
        break;
        case "check_install" :
            $command = check_install($_POST['nom_appli']);
        break;
        case "uninstall" :  
            $command = uninstall($_POST['nom_appli']);
        break;
        case "check_uninstall" :
            $command = check_uninstall($_POST['nom_appli']);
        break;
	    case "check_package" :
            $command = check_package($_POST['nom_app']);
        break;
        //Default
        default :
            "error";
        break;
    }
    return $output = ssh_launch($login_info['ip'], $login_info['port'], $login_info['name'], $login_info['password'], $command);
}
    
?>
