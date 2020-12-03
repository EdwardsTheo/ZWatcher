<?php 

    require('ssh_connection.php');
    require('ssh_exec.php');
    require('list.bash');

function main_ssh($machine_ip, $order) {
    $login_info = info_login($machine_ip); 
    ssh_execute($order, $login_info);    
}

function ssh_execute($order, $login_info) {
    switch($order) {
        case "list" :  
            $command = file_get_contents('../bash/list.bash');
        break;
        default :
            "error";
        break;
    }
    ssh_launch($login_info['ip'], $login_info['port'], $login_info['name'], $login_info['password'], $command);
}
    
    
?>
