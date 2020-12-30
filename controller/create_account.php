<?php
    
    require('../model/config.php');
    require('../model/select.php');
    require('../model/insert.php');

    $user = $_POST['user'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $errors = "";
    $error_user = 0;
    $error_mail = 0;
    $error_pwd = 0;

    if(strpos($mail, '@') == false) {
        $error_mail = 1;
    }
    if(strlen($user) < 3 || strlen($user) > 40){
        $error_user = 1;
    }
    if(strlen($password) < 8){
        $error_pwd = 1;
    }

    if($error_mail == 0 && $error_user == 0 && $error_pwd == 0){
        $req = fetch_ids();
        $cpt = 0;
        while($donnees = $req->fetch()){
            $tmp = strtolower($donnees['username']);
            $tmp2 = strtolower($user);
            if($tmp == $tmp2){
                $cpt = $cpt + 1;
            }
        }
        if($cpt == 0){
            $new_id = insert_new_account($user, $mail, $password);
            $req2 = get_admin_id();
            while($donnees2 = $req2->fetch()){
                $id_admin = $donnees2['id'];
            }
            add_admin_contact($new_id, $id_admin);
            add_admin_new($id_admin, $new_id);
            $errors = "Votre compte a bien été créé";
            require('../view/connect_view.php');
        }else{
            $errors = "Ce pseudo existe déjà";
            require('../view/register_view.php');
        }

    }else if($error_mail == 1){
        $errors = "Adresse mail non valide";
        require('../view/register_view.php');
    }else if($error_mail == 0 && $error_user == 1){
        $errors = "Nom d'utilisateur trop court ou long";
        require('../view/register_view.php');
    }else if($error_mail == 0 && $error_user == 0 && $error_pwd == 1){
        $errors = "Mot de passe trop court";
        require('../view/register_view.php');
    }

?>