<?php

    function insert_liste($user, $titre, $desc, $date){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query('INSERT INTO `listes` (`id`, `titre`, `description`, `date_liste`, `user_id`) 
            VALUES (NULL, 
            '.$link -> quote($titre).', 
            '.$link -> quote($desc).',
            '.$link -> quote($date).',
            '.$link -> quote($user).');'))) {
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

    function insert_new_account($user, $mail, $password){
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

?>