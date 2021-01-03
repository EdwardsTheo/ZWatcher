<?php

    function update_liste($id_liste, $titre, $description, $port, $iden, $pwd) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `listes` SET `titre` = :new_titre, `description` = :new_desc, `port` = :new_port, `id_machine` = :new_iden, `pwd_machine` = :new_pwd WHERE `listes`.`id` = :id_machine;");
        $req -> execute(array(":id_machine"=>$id_liste, ':new_titre' => $titre, ':new_desc' => $description, ':new_port' => $port, ':new_iden' => $iden, ':new_pwd' => $pwd));
        connect_end($link);
    }

    function update_password($password, $user) {
        $link = NULL;

        $options = array('cost' => 11);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

        $link = connect_start();
        $req = $link -> prepare("UPDATE `user` SET `password` = :pwd WHERE `user`.`id` = :iduser;");
        $req -> execute(array(':pwd' => $hashed_password, ":iduser"=>$user));
        connect_end($link);
    }

    function update_code($user, $code, $exp_date) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `user` SET `code` = :newcode, `exp_date` = :new_date WHERE `user`.`username` = :name_user;");
        $req -> execute(array(":name_user"=>$user, ':newcode' => $code, ':new_date' => $exp_date));
        connect_end($link);
    }

    function update_graphismes($user, $mode) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `user` SET `graphismes` = :graph WHERE `user`.`id` = :iduser;");
        $req -> execute(array(":iduser"=>$user, ':graph' => $mode));
        connect_end($link);
    }

    function delete_picture($user) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `user` SET `image` = :uimg WHERE `user`.`id` = :iduser;");
        $req -> execute(array(':uimg' => "none", ":iduser"=>$user));
        connect_end($link);
    }

    function update_picture($user, $fileName) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `user` SET `image` = :uimg WHERE `user`.`id` = :iduser;");
        $req -> execute(array(':uimg' => $fileName, ":iduser"=>$user));
        connect_end($link);
    }

    function update_checkpoint($user, $target, $date) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `contact` SET `checkpoint` = :cpt WHERE `contact`.`user_1` = :cuser1 && `contact`.`user_2` = :cuser2;");
        $req -> execute(array(':cpt' => $date, ":cuser1"=>$user, ":cuser2"=>$target));
        connect_end($link);
    }

    function update_contact($user, $target, $qualite) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `contact` SET `type` = :ctype WHERE `contact`.`user_1` = :cuser1 && `contact`.`user_2` = :cuser2;");
        $req -> execute(array(':ctype' => $qualite, ":cuser1"=>$user, ":cuser2"=>$target));
        connect_end($link);
    }

    function update_displayer($display, $user) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `user` SET `displayer` = :udisplay WHERE `user`.`id` = :iduser;");
        $req -> execute(array(':udisplay' => $display, ":iduser"=>$user));
        connect_end($link);
    }

    function update_infos($name, $mail, $password, $user) {
        $link = NULL;

        $options = array('cost' => 11);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

        $link = connect_start();
        $req = $link -> prepare("UPDATE `user` SET `username` = :uname, `mail` = :umail, `password` = :pwd WHERE `user`.`id` = :iduser;");
        $req -> execute(array(':uname' => $name, ':umail' => $mail, ':pwd' => $hashed_password, ":iduser"=>$user));
        connect_end($link);
    }

    function disconnecte_status($user) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `user` SET `status` = :sts WHERE `user`.`username` = :uname;");
        $req -> execute(array(':sts' => "disconnecte", ":uname"=>$user));
        connect_end($link);
    }

    function set_not_disturbed_status($user) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `user` SET `status` = :sts WHERE `user`.`id` = :uid;");
        $req -> execute(array(':sts' => "occupe", ":uid"=>$user));
        connect_end($link);
    }

    function set_online($user) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `user` SET `status` = :sts WHERE `user`.`id` = :uid;");
        $req -> execute(array(':sts' => "connecte", ":uid"=>$user));
        connect_end($link);
    }

    function connecte_status($user) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `user` SET `status` = :sts WHERE `user`.`username` = :uname;");
        $req -> execute(array(':sts' => "connecte", ":uname"=>$user));
        connect_end($link);
    }
    
    function update_status_install($status, $id_machine, $id_app) {
    	$link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `app_machine` SET `status_install` = :status WHERE `id_machine` = :id_machine AND `id_appli` = :id_appli;");
        $req -> execute(array(':status'=>$status,
            ':id_machine'=>$id_machine,
            ':id_appli'=>$id_app));
        connect_end($link);
    }

    function update_status_app($id_app, $nb) { 
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `app_machine` SET `status_dispo` =  :status WHERE `id_appli` = :id_appli;");
        $req -> execute(array(':status'=>$nb,
            ':id_appli'=>$id_app));
        connect_end($link);
    }

    function update_utilisateurs($prenom, $nom, $mail, $hashed_password, $id_profil, $username) {
        $link = connect_start();
        $req = $link -> prepare("UPDATE `user` SET `Nom` = :unom, `Prenom` = :uprenom, `mail` = :umail, `username` = :username, `password` = :pwd WHERE `user`.`id` = :iduser;");
        $req -> execute(array(':unom' => $nom, ':uprenom' => $prenom, ':umail' => $mail, ':username' => $username,':pwd' => $hashed_password, ":iduser"=>$id_profil));
        connect_end($link);
    }

    function  update_team_name($nom_equipe, $id_equipe) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `equipes` SET `name` =  :name WHERE `id` = :id;");
        $req -> execute(array(':id' => $id_equipe,
            ':name'=>$nom_equipe
            ));
        connect_end($link);
    }

    function update_users_listes($username, $password, $id_user) {
        $link = connect_start();
        $req = $link -> prepare("UPDATE `user_listes` 
        SET `username` = :user, `pswd` = :upswd 
        WHERE `id` = :id;");
        $req -> execute(array(':user' => $username, 
        ':upswd' => $password, 
        ':id'=>$id_user
        ));
        connect_end($link);
    }

    function update_group_name($id_groupe, $group_name) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `groupe_listes` SET `nom` =  :name WHERE `id` = :id;");
        $req -> execute(array(':id' => $id_groupe,
            ':name'=>$group_name
            ));
        connect_end($link);
    }

    function  update_group_sudo($id_groupe, $sudo) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `groupe_listes` SET `sudo` =  :sudo WHERE `id` = :id;");
        $req -> execute(array(':id' => $id_groupe,
            ':sudo'=>$sudo
            ));
        connect_end($link);
    }

    function update_users_rsa($id_user, $rsa) {
        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `user_listes` SET `rsa` =  :rsa WHERE `id` = :id;");
        $req -> execute(array(':id' => $id_user,
            ':rsa'=>$rsa
            ));
        connect_end($link);
    }
?>
