<?php
    
    session_start();

    require('../model/config.php');
    require('../model/insert.php');
    require('../model/select.php');
    require('../model/update.php');

    $mode = $_POST['mode'];
    $user = $_SESSION['id'];

    if(isset($_SESSION['errors'])){ 
        unset($_SESSION['errors']);
    }

    update_graphismes($user, $mode);
    $_SESSION['graph'] = $mode;

    $_SESSION['errors'] = "Les graphismes ont bien été actualisés";


    header('location: ../view/profil.php?action=graphismes');

?>