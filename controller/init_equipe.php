<?php
    
    $titre = $_POST['titre'];
    $associated = $_POST['associated'];

    $cpt = 0;
    if(strlen($titre) == 0){
        $cpt = 1;
    }

    if($cpt == 0){
        insert_equipe($titre, $associated);
        $errors = "L'équipe a bien été crée";
        $req = get_listes();
        require('../view/profil_views/create_equipe.php');
    }else{
        $errors = "Veuillez saisir un titre valide";
        $req = get_listes();
        require('../view/profil_views/create_equipe.php');
    }

?>