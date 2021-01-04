<?php

    $i=0;
    foreach ($_POST['id_users'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                delete_user_team($_POST['id_users'][$i], $_POST['id_equipe']);
            }
        }
        $i++;
    }
    $_SESSION['errors'] = "La suppression a bien été prise en compte";
    $_SESSION['errors2'] = "";
    $_SESSION['errors3'] = "";

    $id_equipe = $_POST['id_equipe'];
    $req = select_group_details($id_equipe);
    $req2 = select_group_name($id_equipe);
    require("../view/profil_views/info_equipe.php");

?>
