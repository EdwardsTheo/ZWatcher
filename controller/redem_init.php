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
            if($donnees['username'] == $user && $donnees['hash'] == $hash && $donnees['code'] == $code){
                $allow = true;

                //check si les données correspondent
                //code valable que 24h dans reinitiate_account.php ?
                //dans ce cas rajouter une case dans la bdd après code
                
                //on check si current time correspond à exptime dans la bdd
                //si oui on affiche la page pour reset avec comme value l'id de l'user qui effectue l'action

            }
        }
        if($allow == true){
            require('../view/insert_new.php');
        }else{
            $errors = "Une erreur est survenue lors de la procédure.";
            require('../view/connect_view.php');
        }
    }else{
        //rediriger vers une page random
    }
?>