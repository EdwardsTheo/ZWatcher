<?php

require('../ssh/ssh_controller.php');
profil_manage_admin_main();

function main_update_admin_list() {
    //update machine
    $i=1;
    foreach ($_POST['id_profil'] as $key => $value) {
        $from = $_POST['id_profil'][$i];
        if($_POST['psswd'][$i] == "") {
            $req = get_liste_data_id_admin($_POST['id_profil'][$i], $_SESSION['id_machine']);
            while($donnees = $req->fetch()) {
                $password = $donnees['pwd_machine'];
            }
        }
        else {
            $password = $_POST['psswd'][$i];
            $update = true;
        }
        if(isset($update)) main_ssh($_SESSION['id_machine'], 'change_password', NULL, $_POST['old_username'][$i], $_POST['psswd'][$i]);
        update_id_pswd_machine($_SESSION['id_machine'], $_POST['old_username'][$i], $password);
        $i++;
    }
}
  


function generate_rsa_key_admin() {
    foreach ($_POST['id_profil'] as $key => $value) { 
        $i = $key;
    }
    foreach ($_POST['id_profil'] as $key => $value) { 
        $test_password_bash = test_password_admin($_POST['id_profil'][$i], $_POST['password'][$i]);
        if($test_password_bash == true) {
            $hash = bin2hex(random_bytes(16));
            $_SESSION['hash'][1] = $hash;
            rsa_controller($_SESSION['id_machine'], 'create_rsa', $_POST['old_username'][$i], $_POST['password'][$i], $hash);
             //Mis dans le fichier ~/.ssh/authorized key s
            rsa_controller($_SESSION['id_machine'], 'authorise key', $_POST['old_username'][$i], $_POST['password'][$i], $hash = NULL);
        
            // Creation du fichier php au nom de l'user 
            $output = main_ssh($_SESSION['id_machine'], 'cat_rsa_key', NULL, $_POST['old_username'][$i]);
            $file = $_POST['old_username'][$i] . "_" . $_SESSION['id_machine'];
            file_put_contents("../rsa/$file.txt", $output);
            
            //Update du statut rsa 0 => 1
            $rsa = 1;
            update_admin_rsa($_SESSION['id_machine'], $rsa);
        }
        else $_SESSION['error'][$i] = "Mot de passe incorrect";
        $i++;
    }
}

function delete_rsa_keys_admin() {
    foreach ($_POST['id_profil'] as $key => $value) { 
        $i = $key;
    }
    foreach ($_POST['id_profil'] as $key => $value) { 
        $test_password_bash = test_password_admin($_POST['id_profil'][$i], $_POST['password'][$i]);
            if($test_password_bash == true) {
            //Supprime le dossier rsa de l'utilisateur /home/$user/.ssh
            main_ssh($_SESSION['id_machine'], 'delete rsa dir', NULL, $_POST['old_username'][$i]);
            
            //Supprime le fichier dans le dossier rsa du projet 
            $file = $_POST['old_username'][$i] . "_" . $_SESSION['id_machine'];
            unlink("../rsa/$file.txt");

            //Met le status rsa à 0 
            $rsa = 0;
            update_admin_rsa($_SESSION['id_machine'], $rsa);
        }
        else $_SESSION['error'][$i] = "Mot de passe incorrect";
    }
}



function test_password_admin($id_user, $password) {
    $req = get_liste_data_id_admin($id_user, $_SESSION['id_machine']);
    $bool = false;
    while($donnees = $req->fetch()) {
        if($_SESSION['id_machine'] == $donnees['id']){
            $password = $donnees['pwd_machine'];
            $bool = true;
        }
    }
    return $bool;
}

function activate_rsa_login() {
    main_ssh($_SESSION['id_machine'], 'activer rsa login');
    main_ssh($_SESSION['id_machine'], 'restart ssh');
    $connect = 1;
    update_admin_connect($_SESSION['id_machine'], $connect);
}

function desactivate_rsa_login() {
    $connect = 0;
    main_ssh($_SESSION['id_machine'], 'desactiver rsa login');
    main_ssh($_SESSION['id_machine'], 'restart ssh');
    update_admin_connect($_SESSION['id_machine'], $connect);
    
}

function profil_manage_admin_main() {
    switch($_POST['choice']) {
        case 'Modifier les informations' : main_update_admin_list();
        break;
        case "créer une clé rsa pour cet user" : generate_rsa_key_admin();
        break;
        case "Supprimer la clé RSA" : delete_rsa_keys_admin();
        break;
        case 'Activer la connexion par clé rsa uniquement' : activate_rsa_login();
        break;
        case 'Reactiver la connexion sans clé' : desactivate_rsa_login();
        break;
    }
}

header('location: ../view/profil.php?action=modif_admin_listes'); // redirect to the main app page with a message of confirmation 

?>
