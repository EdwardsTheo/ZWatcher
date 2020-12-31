<?php
    
    session_start();

    require('../model/config.php');
    require('../model/insert.php');
    require('../model/select.php');

    $titre = $_POST['titre'];
    $desc = $_POST['description'];
    $ip = $_POST['ip'];
    $mac = $_POST['mac'];
    $port = $_POST['port'];
    $iden = $_POST['iden'];
    $pwd = $_POST['password'];

    $user = $_SESSION['id'];
    $date = date('Y-m-d');

    if(isset($_SESSION['errors'])){ 
        unset($_SESSION['errors']);
    }

    $cpt = 0;
    if(strlen($titre) == 0 || strlen($desc) == 0){
        $cpt = 1;
    }

    if($cpt == 0){
        insert_liste($titre, $desc, $date, $ip, $mac, $port, $iden, $pwd);
        $_SESSION['errors'] = "La liste a bien été crée";
        header('location: ../view/profil.php?action=create_liste');
    }else{
        $_SESSION['errors'] = "Veuillez saisir un titre et une description valide";
        header('location: ../view/profil.php?action=create_liste');
    }

?>