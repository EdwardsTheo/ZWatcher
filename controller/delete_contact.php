<?php
    
    session_start();

    require('../model/config.php');
    require('../model/insert.php');
    require('../model/select.php');
    require('../model/delete.php');

    $name = $_POST['pseudo'];
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

    if($cpt == 1 && $error_exists == false){
        delete_contact($user, $target);
        $_SESSION['errors'] = "Le contact a bien été supprimé";
    }else if($cpt == 1 && $error_exists == true){
        $_SESSION['errors'] = "Ce contact n'est pas dans votre liste de contacts";
    }else{
        $_SESSION['errors'] = "Ce pseudo n'existe pas";
    }
    header('location: ../view/profil.php?action=delete_contact');

?>