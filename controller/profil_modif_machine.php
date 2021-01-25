<?php

    if(isset($_SESSION['id_machine'])){
        unset($_SESSION['id_machine']);
    }
    $_SESSION['id_machine'] = $_POST['id'];
    $machine_id = $_POST['id'];
    $req = get_hostname($machine_id);

    require('../ssh/ssh_controller.php');
   
    $actual_hostname = main_ssh($machine_id, 'get_machine_hostname');
    $actual_ip = main_ssh($machine_id, 'get_ip');
    $interface = main_ssh($machine_id, 'get_interface');
   
    $_SESSION['errors'] = "";
    $_SESSION['errors_2'] = "";

    require('../view/profil_views/begin_modif.php');

?>