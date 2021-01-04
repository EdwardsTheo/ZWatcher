<?php
    
    session_start();

    require('../model/config.php');
    require('../model/insert.php');
    require('../model/select.php');
    require('../model/update.php');

    $display = $_POST['statut'];
    $user = $_SESSION['id'];

    if(isset($_SESSION['errors_2'])){ 
        unset($_SESSION['errors_2']);
    }
    
    if(strlen($display) > 60){
        $_SESSION['errors_2'] = "Ce statut est trop long";
    }else{
        update_displayer($display, $user);
        $_SESSION['errors_2'] = "Votre statut a bien été modifié";
        $_SESSION['displayer'] = $display;
    }

    header('location: ../view/profil.php?action=status');

?>