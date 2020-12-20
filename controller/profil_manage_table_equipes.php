<?php

print_r($_POST);

switch($_POST['choice']) {
    case 'Valider la nouvelle équipe' :  main_table_equipe();
    break;
    case 'Voir les details de cette équipe' : details_equipe();
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
    $req = simple_select_equipes();
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
    $_SESSION['id_equipe'] = $_POST['id_groupe'][0];
}

header('location: ../view/profil.php?action=modif_table_equipe'); // redirect to the main app page with a message of confirmation 

?>