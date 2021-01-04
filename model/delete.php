<?php

    function erase_contact_utilisateur($id_utilisateur){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("DELETE FROM contact WHERE user_1='$id_utilisateur' OR user_2='$id_utilisateur'"))) {
                throw new Exception("No access to the table");  
            }
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function erase_equipe_utilisateur($id_utilisateur){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("DELETE FROM equipes_bl WHERE id_eleve='$id_utilisateur'"))) {
                throw new Exception("No access to the table");  
            }
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function erase_groupe_utilisateur($id_utilisateur){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("DELETE FROM groupe_bl WHERE id_user_listes='$id_utilisateur'"))) {
                throw new Exception("No access to the table");  
            }
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function erase_messages($id_utilisateur){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("DELETE message_user, message FROM message INNER JOIN message_user ON message_user.message_id = message.id
            WHERE (message_user.user_send='$id_utilisateur') || (message_user.user_receive='$id_utilisateur')"))) {
                throw new Exception("No access to the table");  
            }
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function erase_utilisateur($id_utilisateur){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("DELETE FROM user WHERE id='$id_utilisateur'"))) {
                throw new Exception("No access to the table");  
            }
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function erase_liste($id_machine){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("DELETE FROM listes WHERE id='$id_machine'"))) {
                throw new Exception("No access to the table");  
            }
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function erase_app_liste($id_machine){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("DELETE FROM app_machine WHERE id_machine='$id_machine'"))) {
                throw new Exception("No access to the table");  
            }
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function erase_equipes_liste($id_machine){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("DELETE FROM equipes WHERE id_listes='$id_machine'"))) {
                throw new Exception("No access to the table");  
            }
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function erase_groupes_liste($id_machine){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("DELETE FROM groupe_listes WHERE id_listes='$id_machine'"))) {
                throw new Exception("No access to the table");  
            }
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }




    function delete_contact($user, $target){
        $link = NULL;

        try {
            if (!($link = connect_start()))
                throw new Exception("Could not connect to database");

            if (!($result = $link->query("DELETE FROM contact WHERE user_1 = '$user' && user_2 = '$target'"))) {
                throw new Exception("No access to the table");  
            }
        } catch (Exception $th) {
            echo "Internal error Devis: ".$th->getMessage();
        }
        connect_end($link);
    }

    function delete_utilisateurs($id_profil) {
        $db = connect_start();
        $request = $db->query("DELETE FROM user WHERE id='$id_profil'");
        return $request;
    }

    function delete_user_team($id_user, $id_equipe) {
        $db = connect_start();
        $request = $db->query("DELETE FROM equipes_bl WHERE id_eleve='$id_user' AND id_equipe='$id_equipe'");
        return $request;
    }

    function delete_user_teambl($id_team) {
        $db = connect_start();
        $request = $db->query("DELETE FROM equipes_bl WHERE id_equipe='$id_team'");
        return $request;
    }

    function delete_user_team_idteam($id_team) {
        $db = connect_start();
        $request = $db->query("DELETE FROM equipes WHERE id='$id_team'");
        return $request;
    }

    function delete_user_listes($id) {
        $db = connect_start();
        $request = $db->query("DELETE FROM user_listes WHERE id='$id'");
        return $request;
    }

    function delete_user_from_group($id_table) {
        $db = connect_start();
        $request = $db->query("DELETE FROM groupe_bl WHERE id='$id_table'");
        return $request;
    }

    function  delete_groups_bl($id_group) {
        $db = connect_start();
        $request = $db->query("DELETE FROM groupe_bl WHERE id_groupe='$id_group'");
        return $request;
    }

    function delete_groups($id_group) {
        $db = connect_start();
        $request = $db->query("DELETE FROM groupe_listes WHERE id='$id_group'");
        return $request;
    }

?>