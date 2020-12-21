<?php

print_r($_POST);

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
        $string = $_POST['nom_eleve'][$i];
        $string = strtolower($string[0]);
        $prenom = $_POST['prenom_eleve'][$i];
        $prenom = strtolower($prenom);
        $user = "$string"."$prenom";
        $test_user = test_user_new($user);
        echo $test_user;
        if($test_user == true) $new_id[$i] = insert_new_account($user, $_POST['nom_eleve'][$i], $_POST['prenom_eleve'][$i], $_POST['mail_eleve'][$i], $_POST['password_eleve'][$i]);
        else break;
        $i++;
    }
}

function test_user_new($user) {
    $req = select_users();
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
        if($_POST['password_eleve'][$i] == "") {
            $req = select_users();
            while($donnees = $req->fetch()) {
                $hashed_password = $donnees['password'];
            }
        }
        else {
            $options = array('cost' => 11);
            $hashed_password = password_hash($_POST['password_eleve'][$i], PASSWORD_BCRYPT, $options);
        }
        $req1 = update_utilisateurs($_POST['prenom_eleve'][$i], $_POST['nom_eleve'][$i], $_POST['mail_eleve'][$i], $hashed_password,  $_POST['id_profil'][$i]); 
        $i++;
    }
}

header('location: ../view/profil.php?action=user'); // redirect to the main app page with a message of confirmation 

?>