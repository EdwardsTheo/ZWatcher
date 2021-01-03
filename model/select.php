<?php

    function get_hash($name){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT U.password FROM user U WHERE U.username = $name"))) {
                    throw new Exception("No access to the table");  
                }   
                return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function check_contact($id2, $id1){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT C.id FROM contact C WHERE C.user_1 = $id2 AND C.user_2 = $id1"))) {
                    throw new Exception("No access to the table");  
                }   
                return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function get_admin_id(){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT U.id FROM user U WHERE U.power = 'admin'"))) {
                    throw new Exception("No access to the table");  
                }   
                return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function get_listes(){
        $link = NULL;
        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT id, titre, description, date_liste FROM listes"))) {
                    throw new Exception("No access to the table");  
                }   
                return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function get_liste_data($id){
        $link = NULL;
        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT * FROM listes WHERE id = $id"))) {
                    throw new Exception("No access to the table");  
                }   
                return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function get_liste_data_id_admin($id, $id_machine){
        $link = NULL;
        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT * FROM listes WHERE id = $id_machine"))) {
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


    function get_back_username($username){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT U.id FROM user U WHERE U.username = '$username'"))) {
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

    function get_back_id($id){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

                if (!($result = $link->query("SELECT U.id FROM user U WHERE U.id = $id"))) {
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

    function fetch_user($id){
        $link=NULL;   

        try {
            if (!($link = connect_start())) {
                throw new Exception("DataBase load failed !");
            }
            if (!($result = $link->query("SELECT id, username, password, code, exp_date, mail, displayer, graphismes, power FROM user WHERE user.id = $id"))) {
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
            if (!($result = $link->query("SELECT id, username, password, code, exp_date, mail, displayer, graphismes, power FROM user"))) {
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

    function select_users_eleves(){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("SELECT U.username AS ctct, U.id AS idf, U.displayer AS dis, U.status FROM user U WHERE power='utilisateur'ORDER BY U.username"))) {
                throw new Exception("No access to the table");  
            }   
            return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function get_app($id_machine, $status) {
	    $db = connect_start();
        $request = $db->query("SELECT am.id_appli, ap.nom_appli, am.status_install, am.id_machine
        FROM app_machine AS am
        LEFT JOIN applis as ap 
        ON am.id_appli = ap.id
        WHERE am.id_machine = $id_machine 
        AND am.status_dispo = '1'
        AND am.status_install = $status");

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
        WHERE list.id = $_SESSION[id_machine]
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

    function simple_select_team() {
        $db = connect_start();
        $request = $db->query("SELECT * FROM equipes");
        return $request;
    }

    function simple_select_teambl() {
        $db = connect_start();
        $request = $db->query("SELECT * FROM equipes_bl");
        return $request;
    }


    function select_group_details($id_groupe) {
        $db = connect_start();
        $request = $db->query("SELECT user.username AS ctct, user.id AS idf, user.displayer AS dis, user.status, e.name, user.username, e.id as id_equipe, user.id
        FROM equipes as e
        INNER JOIN equipes_bl AS ebl ON e.id = ebl.id_equipe
        INNER JOIN user AS user ON ebl.id_eleve = user.id 
        WHERE e.id = $id_groupe");
        return $request;
    }

    function select_group_name($id_groupe) {
        $db = connect_start();
        $request = $db->query("SELECT e.id, e.name, e.id_listes FROM equipes as e WHERE e.id = $id_groupe");
        return $request;
    }

    function select_users_eleves_team($id_groupe) {
        $db = connect_start();
        $request = $db->query("SELECT u.id
        FROM user AS u
        INNER JOIN equipes_bl AS ebl ON u.id = ebl.id_eleve  WHERE ebl.id_equipe != $id_groupe");
        return $request;
    }

    function get_equipe_members($id_equipe) {
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("SELECT u.username AS member_name
            FROM user AS u
            INNER JOIN equipes_bl AS ebl ON u.id = ebl.id_eleve WHERE ebl.id_equipe = $id_equipe"))) {
                throw new Exception("No access to the table");  
            }   
            return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function select_users_id($id_profil) {
        $link = NULL;
        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("SELECT id, username, Nom, Prenom, mail, password FROM user WHERE `id` != $id_profil"))) {
                throw new Exception("No access to the table");  
            }   
            return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    function select_users_id2($id_profil) {
        $link = NULL;
        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("SELECT id, username, mail, password FROM user WHERE `id` = $id_profil"))) {
                throw new Exception("No access to the table");  
            }   
            return $result; 
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }

    
    function select_users_listes($id_machine) {
        $db = connect_start();
        $request = $db->query("SELECT * FROM user_listes WHERE `id_listes` = $id_machine");
        return $request;
    }

    function select_users_listes_id($id_machine, $id) {
        $db = connect_start();
        $request = $db->query("SELECT * FROM user_listes WHERE `id_listes` = $id_machine AND `id` = $id");
        return $request;
    }

    function select_groups_listes($id_machine) {
        $db = connect_start();
        $request = $db->query("SELECT * FROM groupe_listes WHERE `id_listes` = $id_machine");
        return $request;
    }

    function select_group_listes_details($id_group, $id_machine) {
        $db = connect_start();
        $request = $db->query("SELECT * FROM groupe_listes WHERE `id_listes` = $id_machine AND `id` = $id_group");
        return $request;
    }

    function select_groups_listes_id($id_machine, $id_groupe) {
        $db = connect_start();
        $request = $db->query("SELECT * FROM groupe_listes WHERE `id_listes` = $id_machine AND `id` != $id_groupe");
        return $request;
    }

    function select_user_avaible($id_machine, $id_groupe) {
        $db = connect_start();
        echo $id_groupe;
        $request = $db->query("SELECT ul.id, ul.username
        FROM user_listes AS ul 
        LEFT OUTER JOIN groupe_bl AS bl
        ON ul.id = bl.id_user_listes
        WHERE bl.id_groupe != $id_groupe
        AND ul.id_listes = $id_machine");
        return $request;
    }

    function select_user_bl_group($id_groupe) {
        $db = connect_start();
        $request = $db->query("SELECT u.username, gl.id, gl.id_groupe, gli.nom
        FROM user_listes AS u 
        LEFT OUTER JOIN groupe_bl AS gl 
        ON u.id = gl.id_user_listes 
        LEFT OUTER JOIN groupe_listes AS gli
        ON gli.id = gl.id_groupe 
        WHERE gl.id_groupe = $id_groupe");
        return $request;
    }

    function select_user_bl_group2($id_groupe) {
        $db = connect_start();
        $request = $db->query("SELECT * FROM groupe_bl WHERE `id_groupe` = $id_groupe");
        return $request;
    }

    function select_equipe_idmachine($id_machine) {
        $db = connect_start();
        $request = $db->query("SELECT * FROM equipes WHERE `id_listes` = $id_machine");
        return $request;
    }

    function select_id_team($nom_equipe, $id_machine) {
        $db = connect_start();
        $request = $db->query("SELECT * FROM equipes WHERE `name` = '$nom_equipe' AND `id_listes` = $id_machine");
        return $request;
    }

    function select_user_team() {
        $db = connect_start();
        $request = $db->query("SELECT * 
        FROM groupe_bl 
        WHERE `id_groupe` = $id_groupe");
        return $request;
    }

    function select_get_app() {
        $db = connect_start();
        $request = $db->query("SELECT * FROM applis");
        return $request;
    }

?>
