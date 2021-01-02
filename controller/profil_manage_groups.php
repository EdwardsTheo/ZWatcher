<?php

print_r($_POST);
require('../ssh/ssh_controller.php');

switch($_POST['choice']) {
    case 'Ajouter les ou le groupe' :  main_add_groups();
    break;
    case 'Supprimer les membres' : main_delete_utilisateurs();
    break;
    case 'Modifier les informations' : main_update_utilisateurs();
    break;
    case 'Détails du groupe' :  set_session_groups();
    break;
    case 'Changer le nom' : change_grp_name();
    break;
    case 'Retirer les droits sudo' : manage_sudo_right();
    break;
    case 'Donner a ce groupe les droits sudo' : manage_sudo_right();
    break;
    case 'Ajouter' : add_user_to_group();
    break;
    case 'Supprimer les utilisateurs de ce groupe' : delete_user_bl();
    break;
    case 'Supprimer le groupe' : main_delete_group();
    break;
}

function main_add_groups() {
    $i = 1;
    foreach ($_POST['groupe_name'] as $key => $value) {
        //Test nom du groupe BDD 
        $test_name_group = test_name_groups($_POST['groupe_name'][$i]);
        if($test_name_group == true) {
            //TEST groupe bien crée dans la machine
            main_ssh($_SESSION['id_machine'], 'add_groups', NULL, $_POST['groupe_name'][$i]);
            $output = main_ssh($_SESSION['id_machine'], 'check_groups', NULL, $_POST['groupe_name'][$i]);
            if($output != "") {
                if(isset($_POST['sudo_right'][$i])) {
                    if($_POST['sudo_right'][$i] == 'on') {
                    special_sudo($_SESSION['id_machine'], 'add_groups_sudo', $_POST['groupe_name'][$i]);
                    $sudo = 1;
                    }
                    else $sudo = 0;
                }
                else $sudo = 0;
                insert_new_groups_listes_nullteam($_POST['groupe_name'][$i], $_SESSION['id_machine'], $sudo);
            }
            else $_SESSION['error'][$i] = "une erreur est survenue";
        }
        else $_SESSION['error'][$i] = "Le nom de groupe ". $_POST['groupe_name'][$i] ." est déjà prit";
        $i++;
    }
}

function test_name_groups($group_name, $id = NULL) {
    if($id == NULL) $req = select_groups_listes($_SESSION['id_machine']);
    else $req = select_groups_listes_id($_SESSION['id_machine'], $id);
    $test = true;
    while($donnees = $req->fetch()) {
        if($donnees['nom'] == $group_name) {
            $test = false;
        }
    }
    return $test;
}

function set_session_groups() {
    $i=1;
    unset($_SESSION['id_groupe']);
    foreach ($_POST['id_groupe'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                $_SESSION['id_groupe'][1] = $_POST['id_groupe'][$i];
            }
        }
        $i++;
    }
    print_r($_SESSION['id_groupe']);
}

function change_grp_name() {
    $i=1;
    foreach ($_POST['nom_groupe'] as $key => $value) {
        $test_name_group = test_name_groups($_POST['nom_groupe'][$i], $_POST['id_equipe'][$i]);
        if($test_name_group == true) {
            echo "oui";
            update_group_name($_POST['id_equipe'][$i], $_POST['nom_groupe'][$i]);
            main_ssh($_SESSION['id_machine'], 'change_group_name', NULL, $_POST['nom_groupe'][$i], $_POST['old_groupe'][$i]);
        }
        else $_SESSION['error'][$i] = "Le nom de groupe ". $_POST['nom_groupe'][$i] ." est déjà prit";
        $i++;
    }
}

function manage_sudo_right() {
    $i = 1;
    $test = 0;
    foreach ($_POST['id_group'] as $key => $value) {
        if($test == 0) $i = $key;
        if($_POST['choice'] == 'Retirer les droits sudo') {
            $sudo = 0;
            special_sudo($_SESSION['id_machine'], 'retire_sudo_groups', $_POST['nom_groupe'][$i]);
        }
        else {
            special_sudo($_SESSION['id_machine'], 'add_groups_sudo', $_POST['nom_groupe'][$i]);
            $sudo = 1;
        }
        update_group_sudo($_POST['id_group'][$i], $sudo);
        $test = 1;
        $i++;
    }
}

function add_user_to_group() {
    $i = 1;
    foreach ($_POST['id_group'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                insert_user_to_group($_POST['id_user'][$i], $_POST['id_group'][$i]);
                main_ssh($_SESSION['id_machine'], 'add_user_to_groups', NULL, $_POST['nom_groupe'][$i], $_POST['nom_user'][$i]);
            }
        }
        $i++;
    }
}

function delete_user_bl() {
    $i = 1;
    foreach ($_POST['nom_groupe'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                delete_user_from_group($_POST['id_table'][$i]);
                main_ssh($_SESSION['id_machine'], 'remove_from_groups', NULL, $_POST['nom_groupe'][$i], $_POST['nom_user'][$i]);
            }
        }
        $i++;
    }
}

function main_delete_group() {
    $i = 1;
    foreach ($_POST['id_groupe'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                delete_groups_bl($_POST['id_groupe'][$i]);
                delete_groups($_POST['id_groupe'][$i]);
                special_sudo($_SESSION['id_machine'], 'retire_sudo_groups', $_POST['nom_groupe'][$i]);
                main_ssh($_SESSION['id_machine'], 'delete_groups', NULL, $_POST['group_name'][$i]);               
            }
        }
        $i++;
    }
}


header('location: ../view/profil.php?action=modif_groups'); // redirect to the main app page with a message of confirmation 

?>