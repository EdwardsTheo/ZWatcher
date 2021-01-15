<?php
    
    print_r($_POST);

    $i=1;
    foreach ($_POST['nom_appli'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                if($_POST["choice"] == 'Supprimer l\'application') $id = "0";
                else $id = "1";
                //update_status_app($_POST['id_appli'][$i], $id);
                delete_applis($_POST['id_appli'][$i]); 
                delete_applis_machine($_POST['id_appli'][$i]);
            }
        } 
        $i++;
    }

    //header('location: ../view/profil.php?action=gestion_app');

?>