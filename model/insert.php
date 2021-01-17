<?php

    function add_admin_new($user, $target){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query('INSERT INTO `contact` (`id`, `user_1`, `user_2`, `type`) 
            VALUES (NULL, 
            '.$link -> quote($user).', 
            '.$link -> quote($target).',
            '.$link -> quote("Nouveau").' 
            );'))) {
                throw new Exception("No access to the table");  
            }   
            
            return $result;
        } catch (Exception $th) {
            echo "Internal error : ".$th->getMessage();
        }
        connect_end($link);
    }

    function add_admin_contact($user, $target){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query('INSERT INTO `contact` (`id`, `user_1`, `user_2`, `type`) 
            VALUES (NULL, 
            '.$link -> quote($user).', 
            '.$link -> quote($target).',
            '.$link -> quote("Admin").' 
            );'))) {
                throw new Exception("No access to the table");  
            }   
            
            return $result;
        } catch (Exception $th) {
            echo "Internal error : ".$th->getMessage();
        }
        connect_end($link);
    }

    function insert_liste($titre, $desc, $date, $ip, $mac, $port, $iden, $pwd, $rsa, $connex){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query('INSERT INTO `listes` (`id`, `titre`, `description`, `date_liste`, `ip`, `mac`, `port`, `id_machine`, `pwd_machine`, `rsa`, `connexion_rsa`) 
            VALUES (NULL, 
            '.$link -> quote($titre).', 
            '.$link -> quote($desc).',
            '.$link -> quote($date).',
            '.$link -> quote($ip).',
            '.$link -> quote($mac).',
            '.$link -> quote($port).',
            '.$link -> quote($iden).',
            '.$link -> quote($pwd).',
            '.$link -> quote($rsa).',
            '.$link -> quote($connex).'
    
            );'))) {
                throw new Exception("No access to the table");  
            }
          return $link->lastInsertId();
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function insert_equipe($titre, $associated){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query('INSERT INTO `equipes` (`id`, `name`, `id_listes`) 
            VALUES (NULL, 
            '.$link -> quote($titre).', 
            '.$link -> quote($associated).');'))) {
                throw new Exception("No access to the table");  
            }
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function insert_message_user($id1, $id2, $req){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query('INSERT INTO `message_user` (`id`, `user_send`, `user_receive`, `message_id`) 
            VALUES (NULL, 
            '.$link -> quote($id1).', 
            '.$link -> quote($id2).', 
            '.$link -> quote($req).');'))) {
                throw new Exception("No access to the table");  
            }
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function insert_message($content, $date){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query('INSERT INTO `message` (`id`, `content`, `date`) 
            VALUES (NULL, 
            '.$link -> quote($content).', 
            '.$link -> quote($date).');'))) {
                throw new Exception("No access to the table");  
            }
            //return l'id de l'insert au dessus
            return $link->lastInsertId();
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function insert_new_account($user, $password, $mail){
        $link = NULL;
        echo $password;
        $options = array('cost' => 11);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query('INSERT INTO `user` (`id`, `username`, `password`, `mail`, `status`) 
            VALUES (NULL, 
            '.$link -> quote($user).', 
            '.$link -> quote($hashed_password).', 
            '.$link -> quote($mail).',
            '.$link -> quote("disconnecte").');'))) {
                throw new Exception("No access to the table");  
            }
            //return l'id de l'insert au dessus
            return $link->lastInsertId();
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function insert_status($user){
        $link = NULL;

        $options = array('cost' => 11);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query('INSERT INTO `user` (`id`, `username`, `password`, `mail`,`status`) 
            VALUES (NULL, 
            '.$link -> quote($user).', 
            '.$link -> quote($hashed_password).', 
            '.$link -> quote($mail).',
            '.$link -> quote("connecte").');'))) {
                throw new Exception("No access to the table");  
            }
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function insert_contact($user, $target, $qualite){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query('INSERT INTO `contact` (`id`, `user_1`, `user_2`, `type`) 
            VALUES (NULL, 
            '.$link -> quote($user).', 
            '.$link -> quote($target).',
            '.$link -> quote($qualite).' 
            );'))) {
                throw new Exception("No access to the table");  
            }   
            
            return $result;
        } catch (Exception $th) {
            echo "Internal error : ".$th->getMessage();
        }
        connect_end($link);
    }

    function insert_app($nom_app) {  
	    $nb = 0;
	    $link = NULL; 
	    $link = connect_start();
	    $link->query('INSERT INTO `applis` (`id`,`nom_appli`)
		VALUES (NULL, 
		'.$link -> quote($nom_app).'
        )');
        return $link->lastInsertId();
	    connect_end($link);
    }

    function insert_app_dispo($id_app, $id_machine) {
        echo $id_app;
        $status_dispo = 1;
        $status_install = 0;

        $link = NULL; 
        $link = connect_start();
        $link->query('INSERT INTO `app_machine` (`id`,`id_machine`, `id_appli`, `status_dispo`, `status_install`)
            VALUES (NULL, 
        '.$link -> quote($id_machine).',
        '.$link -> quote($id_app).',
        '.$link -> quote($status_dispo).',
        '.$link -> quote($status_install).'        
        )');
        connect_end($link);
    }

    function insert_create_team($nom_team) {
	    $link = NULL; 
	    $link = connect_start();
	    $link->query('INSERT INTO `equipes` (`id`,`name`)
		VALUES (NULL, 
        '.$link -> quote($nom_team).'
        )');
        return $link->lastInsertId();
        connect_end($link);
    }

    function insert_user_team($id_team, $id_eleve) {
        $link = NULL; 
	    $link = connect_start();
	    $link->query('INSERT INTO `equipes_bl` (`id`,`id_eleve`, `id_equipe`)
		VALUES (NULL, 
        '.$link -> quote($id_eleve).',
        '.$link -> quote($id_team).'
		)');
        connect_end($link);
    }

    function  insert_new_user_listes($username, $password, $id_machine, $rsa, $id_team = NULL) {
        $options = array('cost' => 11);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
        
        $link = NULL; 
	    $link = connect_start();
	    $link->query('INSERT INTO `user_listes` (`id`,`username`, `pswd`, `id_listes`, `rsa`, `id_equipe`)
		VALUES (NULL, 
        '.$link -> quote($username).',
        '.$link -> quote($hashed_password).',
        '.$link -> quote($id_machine).',
        '.$link -> quote($rsa).',
        '.$link -> quote($id_team).'
        )');
        return $link->lastInsertId();
        connect_end($link);
    }

    function  insert_new_user_listesnull($username, $password, $id_machine, $rsa, $id_team = NULL) {
        $options = array('cost' => 11);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
        
        $link = NULL; 
	    $link = connect_start();
	    $link->query('INSERT INTO `user_listes` (`id`,`username`, `pswd`, `id_listes`, `rsa`, `id_equipe`)
		VALUES (NULL, 
        '.$link -> quote($username).',
        '.$link -> quote($hashed_password).',
        '.$link -> quote($id_machine).',
        '.$link -> quote($rsa).',
        NULL        
        )');
        return $link->lastInsertId();
        connect_end($link);
    }

    function  insert_new_groups_listes($grp_name, $id_machine, $sudo, $id_equipe = NULL) {
        $link = NULL; 
	    $link = connect_start();
	    $link->query('INSERT INTO `groupe_listes` (`id`,`nom`, `id_listes`, `sudo`, `id_equipe`)
		VALUES (NULL, 
        '.$link -> quote($grp_name).',
        '.$link -> quote($id_machine).',
        '.$link -> quote($sudo).',
        '.$link -> quote($id_equipe).'
        )');
        return $link->lastInsertId();
        connect_end($link);
    }

    function insert_new_groups_listes_nullteam($grp_name, $id_machine, $sudo, $id_equipe = NULL) {
        $link = NULL; 
	    $link = connect_start();
	    $link->query('INSERT INTO `groupe_listes` (`id`,`nom`, `id_listes`, `sudo`, `id_equipe`)
		VALUES (NULL, 
        '.$link -> quote($grp_name).',
        '.$link -> quote($id_machine).',
        '.$link -> quote($sudo).',
        NULL
        )');
        return $link->lastInsertId();
        connect_end($link);
    }

    function  insert_user_to_group($id_user, $id_group) {
        $link = NULL; 
	    $link = connect_start();
	    $link->query('INSERT INTO `groupe_bl` (`id`,`id_groupe`, `id_user_listes`)
		VALUES (NULL, 
        '.$link -> quote($id_group).',
        '.$link -> quote($id_user).'
		)');
        connect_end($link);
    }

    function  insert_user_link($id_user, $id_user_listes) {
        $link = NULL; 
	    $link = connect_start();
	    $link->query('INSERT INTO `user_bl_listes` (`id`,`id_user_listes`, `id_user`)
		VALUES (NULL, 
        '.$link -> quote($id_user_listes).',
        '.$link -> quote($id_user).'
		)');
        connect_end($link);
    }

?>
