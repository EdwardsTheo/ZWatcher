<?php

    session_start();

    require('../model/config.php');
    require('../model/select.php');
    require('../model/insert.php');
    require('../model/update.php');

    if(isset($_GET['user']) && !empty($_GET['user']) AND isset($_GET['hash']) && !empty($_GET['hash']) AND isset($_GET['code']) && !empty($_GET['code'])){
        $user = $_GET['user'];
        $hash = $_POST['hash'];

        $req = fetch_ids();
        $allow = false;

        while ($donnees = $req->fetch()){
            if($donnees['username'] == $user && $donnees['hash'] == $hash && $donnees['code'] == $code){
                $allow = true;

            }
    }
?>