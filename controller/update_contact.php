<?php
    
    session_start();

    require('../model/config.php');
    require('../model/insert.php');
    require('../model/select.php');
    require('../model/update.php');

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

    $error_exists = true;
    $data = get_contacts();
    while($donnees = $data->fetch()){
        if(isset($target)){
            if($donnees['idf'] == $target){
                $error_exists = false;
            }
        }
    }

    if(strlen($qualite) > 20){
        $_SESSION['errors'] = "La qualité renseignée est trop longue";
    }else{
        if($cpt == 1 && $error_exists == false){
            update_contact($user, $target, $qualite);
            $_SESSION['errors'] = "Le contact a bien été modifié";
        }else if($cpt == 1 && $error_exists == true){
            $_SESSION['errors'] = "Ce contact n'est pas dans votre liste de contacts";
        }else{
            $_SESSION['errors'] = "Ce pseudo n'existe pas";
        }
    }
    header('location: ../view/profil.php?action=par_contacts');

?>