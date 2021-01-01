<?php

    function check_team_name($team_name) {
        $req = simple_select_team();
        $test = true;
        while($donnnes = $req->fetch()) {
            if($donnnes['name'] == $team_name) {
                $test = false;
                break;
            }
        }
        return $test;
    }

    $test = check_team_name($_POST['nom_equipe']);
    if($test == true) {
        update_team_name($_POST['nom_equipe'], $_POST['id_equipe']);
        $_SESSION['errors2'] = "Le nom de l'équipe a bien été modifié";
    }
    else {
        $_SESSION['errors2'] = 'Le nom de votre équipe est déjà pris !';
    }

    $_SESSION['errors'] = "";
    $_SESSION['errors3'] = "";
    $id_equipe = $_POST['id_equipe'];
    $req = select_group_details($id_equipe);
    require("../view/profil_views/info_equipe.php");

?>