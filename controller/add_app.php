<?php

    require("../ssh/ssh_controller.php");
    
    print_r($_POST);
    function main_add_app() {
        $message = check_if_exist($_POST['nom_app']);
        if($message == "") $message = paquet_exist();
	if($message == "") $message = add_app($_POST['nom_app']);
        return $_SESSION['message'] = $message;
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
	$message = ($output != "") ? "true" : "false";
	if($message == "false") $messsage = "le nom du paquet est invalide, veuillez réessayer"; 
	else $message = "";	

	return $message;
    }

    function add_app($nom_app) {
	$req = insert_app($nom_app);
	return $message = "L'application à bien été ajoutée";
    }

    header('location: ../view/profil.php?action=gestion_app');
?>
