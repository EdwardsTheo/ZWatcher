<?php
    
    session_start();

    require('../model/config.php');
    require('../model/insert.php');
    require('../model/select.php');

    $name = $_POST['pseudo'];
    $qualite = $_POST['qualite'];
    $user = $_SESSION['id'];

    if(isset($_SESSION['errors'])){ 
        unset($_SESSION['errors']);
    }

    $req = select_users();
    $cpt = 0;
    while($donnees = $req->fetch()){
        $tmp = $donnees['username'];
        $tmp_id = $donnees['id'];
        $tmp2 = $name;
        if($tmp == $tmp2){
            $cpt = $cpt + 1;
            $target = $tmp_id;
        }
    }

    $error_duplicate = false;
    $data = get_contacts();
    while($donnees = $data->fetch()){
        if(isset($target)){
            if($donnees['idf'] == $target){
                $error_duplicate = true;
            }
        }
    }

    if($cpt == 1 && $error_duplicate == false){
        insert_contact($user, $target, $qualite);
        $_SESSION['errors'] = "Le contact a bien été ajouté";
    }else if($cpt == 1 && $error_duplicate == true){
        $_SESSION['errors'] = "Ce contact est déjà ajouté";
    }else{
        $_SESSION['errors'] = "Ce pseudo n'existe pas";
    }
    header('location: ../view/profil.php?action=add_contact');

?>