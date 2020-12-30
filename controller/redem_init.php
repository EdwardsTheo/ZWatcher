<?php

    session_start();

    require('../model/config.php');
    require('../model/select.php');
    require('../model/insert.php');
    require('../model/update.php');

    if(isset($_GET['user']) && !empty($_GET['user']) AND isset($_GET['hash']) && !empty($_GET['hash']) AND isset($_GET['code']) && !empty($_GET['code'])){
        $user = $_GET['user'];
        $hash = $_GET['hash'];
        $code = $_GET['code'];

        $req = fetch_ids();
        $allow = false;

        while ($donnees = $req->fetch()){
            if($donnees['username'] == $user && $donnees['password'] == $hash && $donnees['code'] == $code){
                $cur_date = date("Y-m-d H:i:s");
                if($cur_date <= $donnees['exp_date']){
                    $allow = true;
                    $tmp = $donnees['id'];
                }
                //si oui on affiche la page pour reset avec comme value l'id de l'user qui effectue l'action
            }
        }
        if($allow == true){
            $errors = "";
            $user_id = $tmp;
            require('../view/insert_new.php');
        }else{
            $errors = "Une erreur est survenue lors de la procédure.";
            require('../view/connect_view.php');
        }
    }else{
        $errors = "Une erreur est survenue lors de la procédure.";
        require('../view/connect_view.php');
    }
?>