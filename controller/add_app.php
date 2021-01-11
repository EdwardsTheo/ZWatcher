<?php

    require("../ssh/ssh_controller.php");
    
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
        $output = main_ssh($_SESSION['id_machine'], "check_package", $_POST['nom_app']);
	    $message = ($output != "") ? "true" : "false";
	    if($message == "false") $messsage = "le nom du paquet est invalide, veuillez réessayer"; 
	    else $message = "";	

	    return $message;
    }

    function add_app($nom_app) {
        $id = insert_app($nom_app);
        $req = get_listes();
        while($donnees = $req->fetch()) {
            $id_machine = $donnees['id'];
            $req = insert_app_dispo($id, $id_machine);
      
        return $message = "L'application à bien été ajoutée";
        }
    }

    
    header('location: ../view/profil.php?action=gestion_app');
?>
 
