<?php
    
    session_start();

    require('../model/config.php');
    require('../model/update.php');

    
    $user = $_SESSION['id'];

    if(isset($_SESSION['errors_3'])){ 
        unset($_SESSION['errors_3']);
    }

    delete_picture($user);

    $_SESSION['errors_3'] = "La photo de profil a bien été supprimée";
   
    header('location: ../view/profil.php?action=parameters');

?>