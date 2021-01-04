<?php

    $id_user = $_POST['id_user'];
    $errors = "L'utilisateur a été supprimé";

    erase_contact_utilisateur($id_user);
    erase_equipe_utilisateur($id_user);
    erase_groupe_utilisateur($id_user);
    erase_messages($id_user);
    erase_utilisateur($id_user);

    $req = select_users_eleves();

    include('../view/profil_views/delete_utilisateurs.php');

?>