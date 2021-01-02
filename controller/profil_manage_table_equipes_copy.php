<?php

switch($_POST['choice']) {
    case 'Valider la nouvelle équipe' :  main_table_equipe();
    break;
    case 'Supprimer' : delete_teams();
    break;
    case 'Valider les nouveaux membres' : add_new_members();
    break;
    case 'Créer une équipe avec des membres' : form_add_table_team();
    break;
    case "Valider le nombre" : form_add_table_team();
    break;
    case 'Ajouter de nouveaux membres à cette équipe' : form_add_exist_team();
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
            $test = check_team_name($_POST['nom_equipe'], $_SESSION['id_machine']);
            if($test == true) {
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

function check_team_name($nom_team, $id_machine) {
    $req =  select_equipe_idmachine($id_machine);
    $test = false;
    while($donnees = $req->fetch()) {
        if($nom_team == $donnees['name']) {
            $test = true;
        }
    }
    return $test;
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

?>
