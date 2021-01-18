<?php

    $user = $_SESSION['id'];
    if($_SESSION['power'] == 'utilisateur') {
        $req = select_user_bl_listes_second($_SESSION['id']);
    }
    else $req = get_listes($user);
    require('../view/profil_views/appli_liste.php');

?>