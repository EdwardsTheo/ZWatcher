<?php

    $user = $_SESSION['id'];
    $req = get_listes($user);

    require('../view/profil_views/observ_liste.php');

?>