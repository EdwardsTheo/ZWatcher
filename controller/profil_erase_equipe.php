<?php

    $id_equipe = $_POST['id_equipe'];

    delete_user_teambl($id_equipe);
    delete_user_team_idteam($id_equipe);
    
    $req = simple_select_team();
    require('../view/profil_views/delete_equipe.php');

?>