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

    function get_app($id_machine) {
        //$id_machine = 4;
	    $db = connect_start();
        $request = $db->query("SELECT am.id_appli, ap.nom_appli, am.status_install, am.id_machine
        FROM app_machine AS am
        LEFT JOIN applis as ap 
        ON am.id_appli = ap.id
        WHERE id_machine = $id_machine 
        AND status_dispo = '1'");

        return $request;
    }

    function get_listes_machine($id_machine) {
        $db = connect_start();
        $request = $db->query("SELECT * FROM listes WHERE id = $id_machine");
        return $request;
    }

    function simple_get_app() {
        $db = connect_start();
        $request = $db->query("SELECT * FROM applis");
        return $request;
    }

    function get_app_avaible($id_admin, $status_dispo) {
        $db = connect_start();
        $request = $db->query("SELECT ap.nom_appli, am.status_install, am.id_machine, am.id_appli
        FROM app_machine as am 
        INNER JOIN applis AS ap ON am.id_appli = ap.id
        INNER JOIN listes AS list ON am.id_machine = list.id
        WHERE list.user_admin = $id_admin
        AND am.status_dispo = $status_dispo");
        return $request;
    }

    function get_hostname($id_machine){
        $link = NULL;
        $id = $_SESSION['id'];

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT id, titre, ip, mac FROM listes WHERE id = $id_machine"))) {
                    throw new Exception("No access to the table");  
                }   
                return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

?>
