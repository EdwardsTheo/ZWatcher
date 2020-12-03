<?php 

    require('ssh_connection.php');
    require('ssh_exec.php');
    require('install.bash');

    $login_info = info_login(1); 
    $command = file_get_contents('install.bash');
    ssh_execute('install', $login_info);

    function ssh_execute($order, $login_info) {
        switch($order) {
            case "install" :  
                $command = file_get_contents('install.bash');
            break;
            default :
                "error";
            break;
        }
        ssh_launch($login_info['ip'], $login_info['port'], $login_info['name'], $login_info['password'], $command);
    }    
        
    
    
?>
