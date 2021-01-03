<?php

require('../ssh/ssh_controller.php');
require('profil_manage_table_equipes_copy.php');



function main_add_users() {
    $i = 1;
    foreach ($_POST['username'] as $key => $value) { 
        //TEST username dans la BDD 
        $test_username = test_username($_POST['username'][$i]);
        if($test_username == true) {
            //TEST username à bien été crée dans la machine 
            $username = $_POST['username'][$i];
            $password = $_POST['pswd'][$i];
            main_ssh($_SESSION['id_machine'], 'add_user', NULL, $username, $password);
            $output = main_ssh($_SESSION['id_machine'], 'bash_user_exist', NULL, $username, $password);
            if($output != "") {
                main_ssh($_SESSION['id_machine'], 'change_password', NULL, $username, $password);
                main_ssh($_SESSION['id_machine'], 'change_bash', NULL, $username, $password);
                main_ssh($_SESSION['id_machine'], 'create_home', NULL, $username, $password);
                //Alors ajout dans la BDD
                $rsa = 0;
                insert_new_user_listesnull($username, $password, $_SESSION['id_machine'], $rsa);
            }
            else $_SESSION['error'][$i] = "une erreur est survenue";
            
        }
        else $_SESSION['error'][$i] = "Le nom d'utilisateur ". $_POST['username'][$i] ." est déjà prit";
        $i++;
    }
}

function test_username($username, $id = NULL) {
    if($id == NULL) $req = select_users_listes($_SESSION['id_machine']);
    else $req = select_users_listes_id($_SESSION['id_machine'], $id);
    $test = true;
    while($donnees = $req->fetch()) {
        if($donnees['username'] == $username) {
            $test = false;
        }
    }
    return $test;
}

function main_delete_users() {
    $i = 1;
    foreach ($_POST['username'] as $key => $value) { 
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                $username = $_POST['username'][$i];
                $output = main_ssh($_SESSION['id_machine'], 'delete_users', NULL, $username, NULL);
                main_ssh($_SESSION['id_machine'], 'delete_home', NULL, $username, NULL);
                $req = delete_user_listes($_POST['id_user'][$i]);
            }
        }
    $i++;
    } 
}

function set_session_user() {
    $i=1;
    foreach ($_POST['id_user'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                $_SESSION['id_user'][$i] = $_POST['id_user'][$i];
            }
        }
        $i++;
    }
    print_r($_SESSION['id_user']);
}

function main_update_users_list() {
    $i=1;
    foreach ($_POST['id_profil'] as $key => $value) {
        $from = $_POST['id_profil'][$i];
        if($_POST['psswd'][$i] == "") {
            $req = select_users_listes($_SESSION['id_machine']);
            while($donnees = $req->fetch()) {
                $hashed_password = $donnees['pswd'];
            }
        }
        else {
            $options = array('cost' => 11);
            $hashed_password = password_hash($_POST['psswd'][$i], PASSWORD_BCRYPT, $options);
            $update = true;
        }
        $test_username = test_username($_POST['username'][$i], $from);
        $test_username = true;
        if($test_username == true) {
            update_users_listes($_POST['username'][$i], $hashed_password, $_POST['id_profil'][$i]);
            main_ssh($_SESSION['id_machine'], 'change_username', NULL, $_POST['username'][$i], $_POST['old_username'][$i]);
            if(isset($update)) main_ssh($_SESSION['id_machine'], 'change_password', NULL, $_POST['username'][$i], $_POST['psswd'][$i]);
        }
        else $_SESSION['error'][$i] = "Le nom d'utilisateur ". $_POST['username'][$i] ." est déjà prit";
        $i++;
    }
}

function add_team_grp() {
    $i = 1;
    foreach ($_POST['nom_equipe'] as $key => $value) {
        //TEST SI L'EQUIPE EXISTE
        $test = check_team_name($_POST['nom_equipe'][$i], $_SESSION['id_machine']);
        $id_team = get_id_team($_POST['nom_equipe'][$i], $_SESSION['id_machine']);
        echo $id_team;
        if($test == true) {
            // Ajoute de l'equipe en groupe dans la machine;
            main_ssh($_SESSION['id_machine'], 'add_groups', NULL, $_POST['nom_equipe'][$i]);
            $output = main_ssh($_SESSION['id_machine'], 'check_groups', NULL, $_POST['nom_equipe'][$i]);
            $output = "o";
            if($output != "") {
                if($_POST['sudo'][$i] == 'on') {
                    main_ssh($_SESSION['id_machine'], 'add_groups_sudo', $_POST['nom_equipe'][$i]);
                    $sudo = 1;  
                }
                else $sudo = 0;
                // Ajout du groupe dans BDD 
                $id_grp = insert_new_groups_listes($_POST['nom_equipe'][$i], $_SESSION['id_machine'], $sudo, $id_team);
                add_team_to_grpbl($id_grp, $id_team, $_POST['nom_equipe'][$i]);
            }
            else $_SESSION['error'][$i] = "une erreur est survenue";
        }
        else $_SESSION['error'][$i] = "Le nom de l'équipe n'existe pas";
        //Ajout des users dans l'equipe avec l'id equipe pas null
        $i++;
    }
}

function get_id_team($nom_equipe, $id_machine) {
    $req = select_id_team($nom_equipe, $id_machine);
    while($donnees = $req->fetch()) {
        $id = $donnees['id'];
    }
    return $id;
}

function add_team_to_grpbl($id_grp, $id_team, $nom_equipe) {
    $req = simple_select_teambl(); 
    while($donnees = $req->fetch()) {
        if($donnees['id_equipe'] == $id_team) {
            $rsa = 0;
            $username = get_username($donnees['id_eleve']);
            $password = "ghghghgh";
            $id_user = insert_new_user_listes($username, $password, $_SESSION['id_machine'], $rsa, $id_team);
              // Creation des users avec username élèves.
            main_ssh($_SESSION['id_machine'], 'add_user', NULL, $username, $password);
            main_ssh($_SESSION['id_machine'], 'create_home', NULL, $username, $password);
            insert_user_to_group($id_user, $id_grp);
            main_ssh($_SESSION['id_machine'], 'change_bash', NULL, $username, $password);
            main_ssh($_SESSION['id_machine'], 'add_user_to_groups', NULL,  $nom_equipe,  $username);
        }
    }
}

function get_username($id_eleve) {
    $req = select_users_id2($id_eleve);
    print_r($req);
    while($donnees = $req->fetch()) {
        if($id_eleve == $donnees['id']) {
            $username = $donnees['username'];
        }
    }
    return $username;
}


// Partie création clé RSA 

function generate_rsa_key() {
    foreach ($_POST['id_profil'] as $key => $value) { 
        $i = $key;
    }
    foreach ($_POST['id_profil'] as $key => $value) { 
        //TEST PASSWORD 
        $test_password_bash = test_password_bash($_POST['id_profil'][$i], $_POST['password'][$i]);
        if($test_password_bash == true) {
            
            //CREATION DE LA CLE RSA passphrase RANDOM 
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
             update_users_rsa($_POST['id_profil'][$i], $rsa);


        }
        else $_SESSION['error'][$i] = "Mot de passe incorrect";
        $i++;
    }
}

function test_password_bash($id_user, $password) {
    $req = select_users_listes($_SESSION['id_machine']);
    $bool = false;
    while($donnees = $req->fetch()) {
        if($donnees['id'] == $id_user){
            $hashed_password = $donnees['pswd'];
            $bool = password_verify($password, $hashed_password);
            echo "oui";
        }
    }
   return $bool;
}

function delete_rsa_keys() {
    foreach ($_POST['id_profil'] as $key => $value) { 
        $i = $key;
    }
    foreach ($_POST['id_profil'] as $key => $value) { 
        $test_password_bash = test_password_bash($_POST['id_profil'][$i], $_POST['password'][$i]);
            if($test_password_bash == true) {
            //Supprime le dossier rsa de l'utilisateur /home/$user/.ssh
            main_ssh($_SESSION['id_machine'], 'delete rsa dir', NULL, $_POST['old_username'][$i]);
            
            //Supprime le fichier dans le dossier rsa du projet 
            $file = $_POST['old_username'][$i] . "_" . $_SESSION['id_machine'];
            unlink("../rsa/$file.txt");

            //Met le status rsa à 0 
            $rsa = 0;
            update_users_rsa($_POST['id_profil'][$i], $rsa);
        }
        else $_SESSION['error'][$i] = "Mot de passe incorrect";
    }
}

switch($_POST['choice']) {
    case 'Ajouter les users' :  main_add_users();
    break;
    case 'Supprimer les users' : main_delete_users();
    break;
    case 'Modifier les informations' : main_update_users_list();
    break;
    case 'Détails du profil' :  set_session_user();
    break;
    case "Ajouter cette équipe" : add_team_grp();
    break;
    case "créer une clé rsa pour cet user" : generate_rsa_key();
    break;
    case "Supprimer la clé RSA" : delete_rsa_keys();
    break;
}


header('location: ../view/profil.php?action=modif_users'); // redirect to the main app page with a message of confirmation 

?>