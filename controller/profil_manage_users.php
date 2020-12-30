<?php

require('../ssh/ssh_controller.php');

switch($_POST['choice']) {
    case 'Ajouter les users' :  main_add_users();
    break;
    case 'Supprimer les users' : main_delete_users();
    break;
    case 'Modifier les informations' : main_update_users_list();
    break;
    case 'Détails du profil' :  set_session_user();
    break;
}

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
                //Alors ajout dans la BDD
                insert_new_user_listes($username, $password, $_SESSION['id_machine']);
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
        if($test_username == true) {
            update_users_listes($_POST['username'][$i], $hashed_password, $_POST['id_profil'][$i]);
            main_ssh($_SESSION['id_machine'], 'change_username', NULL, $_POST['username'][$i], $_POST['old_username'][$i]);
            if(isset($update)) main_ssh($_SESSION['id_machine'], 'change_password', NULL, $_POST['username'][$i], $_POST['psswd'][$i]);
        }
        else $_SESSION['error'][$i] = "Le nom d'utilisateur ". $_POST['username'][$i] ." est déjà prit";
        $i++;
    }
}

header('location: ../view/profil.php?action=modif_users'); // redirect to the main app page with a message of confirmation 

?>