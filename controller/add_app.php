<?php
    
    require("../model/config.php");
    require("../model/delete.php");
    require("../model/insert.php");
    require("../model/select.php");
    require("../model/update.php");

    print_r($_POST);
    function main_add_app() {
        $message = check_if_exist($_POST['nom_app']);
        echo $message;
        if($message == "") $message = paquet_exist($_POST['nom_app']);

        return $message;
    }
    main_add_app();

    function check_if_exist($app) {
        $req = simple_get_app();
        while($donnees = $req->fetch()) {
            $message = ($app == $donnees['nom_appli']) ? "true" : "false"; // returns true if the package doesn't exist in the database
        }
        if($message == "true") $message = "l'application existe déjà dans la base de données.";
        else $message = "";
        
        return $message;
    }

    function paquet_exist() {
        $output = main_ssh(4, "check_package");
    }

    function add_app() {

    }


?>