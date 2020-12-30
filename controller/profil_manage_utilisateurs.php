<?php

switch($_POST['choice']) {
    case 'Ajouter les utilisateurs' :  main_add_utilisateurs();
    break;
    case 'Supprimer les membres' : main_delete_utilisateurs();
    break;
    case 'Modifier les informations' : main_update_utilisateurs();
    break;
    case 'Détails du profil' :  set_session();
    break;
}

function main_add_utilisateurs() {
    $i = 1;
    foreach ($_POST['nom_eleve'] as $key => $value) {
        // TEST NOM + PRENOM 
        $test_name_surname = test_name_surname($_POST['nom_eleve'][$i],  $_POST['prenom_eleve'][$i]);
        if($test_name_surname == true) {
            //TEST MAIL
            $test_mail = test_mail($_POST['mail_eleve'][$i]);
            if($test_mail == true) {
                //Test username
                $test_user = test_user_new($_POST['username'][$i]);
                if($test_user == true) $new_id[$i] = insert_new_account($_POST['username'][$i], $_POST['nom_eleve'][$i], $_POST['prenom_eleve'][$i], $_POST['mail_eleve'][$i], $_POST['password_eleve'][$i], 'eleves');
                else $_SESSION['error'][$i] = "Le nom d'utilisateur ". $_POST['username'][$i] ." est déjà prit";
            }
            else $_SESSION['error'][$i] = "Il y'a déjà un compte existant avec l'email " . $_POST['mail_eleve'][$i]; 
           
        
         
        }
        else $_SESSION['error'][$i] = "Il y'a déjà un utilisateur au nom de " . $_POST['nom_eleve'][$i] . " et au prénom de " . $_POST['prenom_eleve'][$i];
       
        $i++;
    }
}

function test_mail($mail, $id = NULL) {
    if($id == NULL) $req = select_users_eleves();
    else $req = select_users_id($id);
    $test = true;
    while($donnees = $req->fetch()) {
        if($donnees['mail'] == $mail) {
            $test = false;
        }
    }
    return $test;
}

function test_name_surname($name, $surname, $id = NULL) { 
    if($id == NULL) $req = select_users_eleves();
    else $req = select_users_id($id);
    $test = true;  
    while($donnees = $req->fetch()) {
        if($donnees['Nom'] == $name && $donnees['Prenom'] == $surname) {
            $test = false;
        }
    }
    return $test;
}

function test_user_new($user, $id = NULL) {
    if($id == NULL) $req = select_users_eleves();
    else $req = select_users_id($id);
    $test = true;
    while($donnees = $req->fetch()) {
        if($donnees['username'] == $user) {
            $test = false;
        }
    }
    return $test;
}       

function main_delete_utilisateurs() {
    $i=1;
    foreach ($_POST['id_profil'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                delete_utilisateurs($_POST['id_profil'][$i]);
            }
        }
        $i++;
    }
}

function set_session() {
    $i=1;
    foreach ($_POST['id_profil'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                $_SESSION['id_eleve'][$i] = $_POST['id_profil'][$i];
            }
        }
        $i++;
    }
    print_r($_SESSION['id_eleve']);
}

function main_update_utilisateurs() {
    $i=1;
    foreach ($_POST['id_profil'] as $key => $value) {
        $from = $_POST['id_profil'][$i];
        if($_POST['password_eleve'][$i] == "") {
            $req = select_users_eleves();
            while($donnees = $req->fetch()) {
                $hashed_password = $donnees['password'];
            }
        }
        else {
            $options = array('cost' => 11);
            $hashed_password = password_hash($_POST['password_eleve'][$i], PASSWORD_BCRYPT, $options);
        }
        $test_name_surname = test_name_surname($_POST['nom_eleve'][$i],  $_POST['prenom_eleve'][$i], $from);
        if($test_name_surname == true) {
            //TEST MAIL
            $test_mail = test_mail($_POST['mail_eleve'][$i], $from);
            if($test_mail == true) {
                //Test username
                $test_user = test_user_new($_POST['username'][$i], $from);
                if($test_user == true) $req1 = update_utilisateurs($_POST['prenom_eleve'][$i], $_POST['nom_eleve'][$i], $_POST['mail_eleve'][$i], $hashed_password,  $_POST['id_profil'][$i], $_POST['username'][$i]); 
                else $_SESSION['error'][$i] = "Le nom d'utilisateur ". $_POST['username'][$i] ." est déjà prit";
            }
            else $_SESSION['error'][$i] = "Il y'a déjà un compte existant avec l'email " . $_POST['mail_eleve'][$i]; 
        }
        else $_SESSION['error'][$i] = "Il y'a déjà un utilisateur au nom de " . $_POST['nom_eleve'][$i] . " et au prénom de " . $_POST['prenom_eleve'][$i];
       
       
        $i++;
    }
}

header('location: ../view/profil.php?action=user'); // redirect to the main app page with a message of confirmation 

?>