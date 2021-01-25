<?php

    session_start();

    require('../model/config.php');
    require('../model/select.php');
    require('../model/insert.php');
    require('../model/update.php');

    $_SESSION['id_machine'] = $_POST['id_machine'];
    $machine_id = $_POST['id_machine'];
    $log = $_POST['log'];

    require('../ssh/ssh_controller.php');
   
    if (!isset($_POST['log'])) {
        $machine_name = $_POST['id_machine'];
        require('../view/profil_views/begin_observ.php');
    }else{
        switch ($log) {
            case "auth" :
                $fetch_log = main_ssh($machine_id, 'dwl_auth');  
            break;
            case "kern" :
                $fetch_log = main_ssh($machine_id, 'dwl_kern');
            break;
            case "messages" :
                $fetch_log = main_ssh($machine_id, 'dwl_messages');;
            break;
            case "syslog" :
                $fetch_log = main_ssh($machine_id, 'dwl_syslog');
            break;
        }

        $handle = fopen("$log.log", "w");
        fwrite($handle, "$fetch_log");
        fclose($handle);

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename("$log.log"));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize("$log.log"));
        readfile("$log.log");
        exit;

        $machine_name = $_POST['id_machine'];
        require('../view/profil_views/begin_observ.php');
    }

?>