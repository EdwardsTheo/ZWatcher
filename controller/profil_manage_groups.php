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
                if($_POST['sudo_right'][$i] == 'on') {
                    //special_sudo($_SESSION['id_machine'], 'add_groups_sudo', $_POST['groupe_name'][$i]);
                    $sudo = 1;
                }
                else $sudo = 0;
                insert_new_groups_listes($_POST['groupe_name'][$i], $_SESSION['id_machine'], $sudo);
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
    foreach ($_POST['id_groupe'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                $_SESSION['id_groupe'][$i] = $_POST['id_groupe'][$i];
            }
        }
        $i++;
    }
    print_r($_SESSION['id_groupe']);
}

header('location: ../view/profil.php?action=modif_groups'); // redirect to the main app page with a message of confirmation 

?>