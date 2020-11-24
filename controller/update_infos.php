<?php
    
    session_start();

    require('../model/config.php');
    require('../model/insert.php');
    require('../model/select.php');
    require('../model/update.php');

    $name = $_POST['pseudo'];
    $mail = $_POST['mail'];
    $newpassword = $_POST['password'];
    $user = $_SESSION['id'];

    $error_name = 0;
    $error_mail = 0;
    $error_pwd = 0;

    if(isset($_SESSION['errors'])){ 
        unset($_SESSION['errors']);
    }

    if(strpos($mail, '@') == false) {
        $error_mail = 1;
    }
    if(strlen($name) < 3 || strlen($name) > 40){
        $error_name = 1;
    }
    if(strlen($newpassword) < 8){
        $error_pwd = 1;
    }

    if($error_mail == 0 && $error_name == 0 && $error_pwd == 0){
        $_SESSION['username'] = $name;
        $_SESSION['mail'] = $mail;
        update_infos($name, $mail, $newpassword, $user);
    }else if($error_mail == 1){
        $_SESSION['errors'] = "Adresse mail non valide";
    }else if($error_mail == 0 && $error_name == 1){
        $_SESSION['errors'] = "Nom d'utilisateur trop court ou long";
    }else if($error_mail == 0 && $error_name == 0 && $error_pwd == 1){
        $_SESSION['errors'] = "Mot de passe trop court";
    }

    header('location: ../view/profil.php?action=parameters');

?>