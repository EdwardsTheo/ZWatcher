<?php 

    require('ssh_connection.php');
    require('ssh_exec.php');
    require('../bash/install.php');
    require('../bash/check_install.php');

function main_ssh($machine_ip, $order) {
    $login_info = info_login($machine_ip);
    return $output = ssh_execute($order, $login_info);
}

function ssh_execute($order, $login_info) {
    switch($order) {
        case "install" :  
            $command = install($_POST['nom_appli']);
        break;
        case "check_install" :
            $command = check_install($_POST['nom_appli']);
        break;
        default :
            "error";
        break;
    }
    return $output = ssh_launch($login_info['ip'], $login_info['port'], $login_info['name'], $login_info['password'], $command);
}
    
    
?>
