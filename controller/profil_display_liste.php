<?php

    $user = $_SESSION['id'];
    if($_SESSION['power'] == "admin"){
        $req = get_listes($user);
    }else{
        $req = select_user_bl_listes3($user);
    }

    require('../view/profil_views/display_liste.php');

?>