<?php

    session_start();

    require('../model/config.php');
    require('../model/insert.php');
    require('../model/select.php');
    require('../model/update.php');
    
    $i=1;
    foreach ($_POST['nom_appli'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                echo $_POST['action'];
                if($_POST["action"] == 'Désactiver') $id = "0";
                else $id = "1";
                update_status_app($_POST['id_appli'][$i], $id);
            }
        } 
        $i++;
    }

    header('location: ../view/profil.php?action=gestion_app');

?>