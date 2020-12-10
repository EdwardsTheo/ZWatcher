<?php

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
        echo $id_app;
        echo $nb;

        $link = NULL;
        $link = connect_start();
        $req = $link -> prepare("UPDATE `app_machine` SET `status_dispo` =  :status WHERE `id_appli` = :id_appli;");
        $req -> execute(array(':status'=>$nb,
            ':id_appli'=>$id_app));
        connect_end($link);
    }

?>
