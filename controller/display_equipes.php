<?php

    $user = $_SESSION['id'];
    if($_SESSION['power'] == "admin"){
        $req = simple_select_team();
    }else{
        $req = utilisateur_in_team($user);
    }
    
    require("../view/profil_views/display_equipes.php");

?>