<?php

    $_SESSION['id_machine'] = $_POST['id'];
    $machine_id = $_POST['id'];
    $req = get_hostname($machine_id);

    require('../ssh/ssh_controller.php');
   
    $actual_hostname = main_ssh($machine_id, 'get_machine_hostname');

    $_SESSION['errors'] = "";
    $_SESSION['errors_2'] = "";

    require('../view/profil_views/begin_modif.php');

?>