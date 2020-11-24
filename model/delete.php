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
?>