<?php

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

?>
