<?php

    session_start();

    if ( $_SERVER['REQUEST_METHOD']!=='POST' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
 
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        die( header( 'location: ../view/error.php' ) );

    }

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
                $power = $donnees['power'];
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
        $_SESSION['power'] = $power;
    }else{
        $errors = "Identifiants incorrects";
        $_SESSION = array();
        session_destroy();
        require('../view/connect_view.php');
    }

?>