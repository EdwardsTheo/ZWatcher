<?php

    session_start();

    require('../model/config.php');
    require('../model/insert.php');
    require('../model/select.php');
    require('../model/update.php');

    if(isset($_SESSION['errors'])){ 
        unset($_SESSION['errors']);
    }

    $user = $_SESSION['id'];

    if($_SESSION['status'] == "connecte"){
        set_not_disturbed_status($user);
    }else{
        set_online($user);
    }
    $_SESSION['errors'] = "Le mode a bien été modifié";

    header('location: ../view/profil.php?action=status');

?>