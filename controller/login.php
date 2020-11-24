<?php

    session_start();

    require('../model/config.php');
    require('../model/select.php');
    require("../model/update.php");

    $user = $_POST['user'];
    $password = $_POST['password'];

    $req = fetch_ids();
    $connexion = false;

    while ($donnees = $req->fetch()){
        $hashed_password = $donnees['password'];
        if($donnees['username'] == $user){
            $bool = password_verify($password, $hashed_password);
            if($bool == true){
                $connexion = true;
                $mail = $donnees['mail'];
                $id = $donnees['id'];
                $displayer = $donnees['displayer'];
                $graphs = $donnees['graphismes'];
                connecte_status($user);
            }
        }
    }

    if($connexion == true){
//        require('../view/profil.php');
        header('location: ../view/profil.php');
        $_SESSION['username'] = $user;
        $_SESSION['mail'] = $mail;
        $_SESSION['id'] = $id;
        $_SESSION['displayer'] = $displayer;
        $_SESSION['status'] = "connecte";
        $_SESSION['messagerie_tmp'] = false;
        $_SESSION['graph'] = $graphs;
    }else{
        $errors = "Identifiants incorrects";
        $_SESSION = array();
        session_destroy();
        require('../view/connect_view.php');
    }

?>