<?php

    function get_listes($user){
        $link = NULL;
        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT id, titre, description, date_liste FROM listes WHERE user_id = $user"))) {
                    throw new Exception("No access to the table");  
                }   
                return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function get_image_user($id){
        $link = NULL;
        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT U.image FROM user U WHERE U.id = $id"))) {
                    throw new Exception("No access to the table");  
                }   
                return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function get_back_user($id){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT U.username FROM user U WHERE U.id = $id"))) {
                    throw new Exception("No access to the table");  
                }   
                return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function get_messages($id1, $id2){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT M.content AS msg, U.user_send AS shipper FROM message M JOIN message_user U 
                ON (U.message_id = M.id && '$id1' = U.user_send && '$id2'= U.user_receive) || (U.message_id = M.id && '$id2' = U.user_send && '$id1'= U.user_receive)"))) {
                    throw new Exception("No access to the table");
                }   
                return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function get_user_status(){
        $link = NULL;
        $id = $_SESSION['id'];

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT status FROM user WHERE user.id = $id"))) {
                    throw new Exception("No access to the table");  
                }   
                return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function select_users(){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("SELECT id, username FROM user"))) {
                throw new Exception("No access to the table");  
            }   
            return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function fetch_ids(){
        $link=NULL;   

        try {
            if (!($link = connect_start())) {
                throw new Exception("DataBase load failed !");
            }
            if (!($result = $link->query("SELECT id, username, password, mail, displayer, graphismes FROM user"))) {
                throw new Exception("No access to the table");  
            } 
            return $result;           
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        } 
        connect_end($link);
    }

    function get_contacts_messagerie(){
        $link = NULL;
        $id = $_SESSION['id'];

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT U.username AS ctct, U.id AS idf, U.displayer AS dis, C.type AS type, U.status, C.checkpoint FROM user U JOIN contact C ON C.user_1 = '$id' && C.user_2 = U.id ORDER BY C.checkpoint DESC"))) {
                    throw new Exception("No access to the table");  
                }   
                return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function get_contacts(){
        $link = NULL;
        $id = $_SESSION['id'];

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT U.username AS ctct, U.id AS idf, U.displayer AS dis, C.type AS type, U.status FROM user U JOIN contact C ON C.user_1 = '$id' && C.user_2 = U.id ORDER BY U.username"))) {
                    throw new Exception("No access to the table");  
                }   
                return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

?>