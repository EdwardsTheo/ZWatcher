<?php

print_r($_POST);

switch($_POST['choice']) {
    case 'Valider la nouvelle équipe' :  main_table_equipe();
    break;
    case 'Voir les details de cette équipe' : details_equipe();
    break;
    case 'Changer le nom' : change_team_name();
    break;
    case 'Supprimer les ou le membres de cette équipe' : delete_members_team();
    break;
    case 'Supprimer' : delete_teams();
    break;
    case 'Valider les nouveaux membres' : add_new_members();
    break;
}

function main_table_equipe() {
    $final_test = false; 
    $i = 1;
    foreach($_POST['user'] as $key => $value) {
        $test = check_double($value, $i);
        if($test == false) {
            $_SESSION['message'] = 'vous ne pouvez pas selectionner deux fois la même personne';
            break;
        }
        elseif($test != false && $final_test == false) {
            $test = check_team_name($_POST['nom_equipe']);
            if($test == false) {
                $_SESSION['message'] = 'Le nom de votre équipe est déjà pris !';
                break;
            }
            else {
                $id_team = insert_create_team($_POST['nom_equipe']);
                $final_test = true;
            }
        }
        if($final_test == true) {        
            insert_user_team($id_team, $_POST['id_eleve'][$i]);
            $_SESSION['message'] = 'Votre équipe à bien été créée';
        }
        $i++;
    }
}

function check_double($value, $i) {
    $test = true;
    for($j=1; $j != count($_POST['user']); $j++) {
        if(isset($_POST['user'][$i+1])) {
            if($_POST['user'][$i+1] == $_POST['user'][$j]) {
                $test = false;
                break;
            }
        }
    }
    return $test;
}

function check_team_name($team_name) {
    $req = simple_select_team();
    $test = true;
    while($donnnes = $req->fetch()) {
        if($donnnes['name'] == $team_name) {
            $test = false;
            break;
        }
    }
    return $test;
}

function details_equipe() {
    $i=0;
    foreach($_POST['scales'] as $key => $value) {
        $i++;
    }
    if($i > 1) $_SESSION['message'] = "Vous ne pouvez voir les détails que d'une seule équipe à la fois";
    else {
        $i=1;
        foreach ($_POST['id_groupe'] as $key => $value) {
            if(isset($_POST['scales'][$i])) {
                if($_POST['scales'][$i] == "on") {
                    $_SESSION['id_equipe'] = $_POST['id_groupe'][$i];
                }
            }
            $i++;
        }
    }
}

function change_team_name() {
    $test = check_team_name($_POST['nom_equipe']);
    if($test == true) {
        update_team_name($_POST['nom_equipe'], $_POST['id_equipe']);
    }
    else {
        $_SESSION['message'] = 'Le nom de votre équipe est déjà pris !';
    }
}

function delete_members_team() {
    $i=1;
    foreach ($_POST['id_users'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                delete_user_team($_POST['id_users'][$i], $_POST['id_equipe']);
            }
        }
        $i++;
    }
}

function delete_teams() {
    $i=1;
    foreach ($_POST['id_groupe'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                delete_user_team_idteam($_POST['id_groupe'][$i]);
                delete_user_teambl($_POST['id_groupe'][$i]);
            }
        }
        $i++;
    }
}

function add_new_members() {
    $i=1;
    foreach($_POST['id_eleve'] as $key => $value) {
        insert_user_team($_POST['id_equipe'], $_POST['id_eleve'][$i]);
        $i++;
    }
    $_SESSION['id_equipe'] = $_POST['id_equipe'];
}

header('location: ../view/profil.php?action=modif_table_equipe'); // redirect to the main app page with a message of confirmation 

?>
