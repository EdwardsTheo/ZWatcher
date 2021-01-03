<?php

    $id_liste = $_POST['id_machine'];

    erase_app_liste($id_liste);
    erase_equipes_liste($id_liste);
    erase_groupes_liste($id_liste);
    erase_liste($id_liste);

    $_SESSION['errors'] = "La machine a été supprimée de votre parc";
    $req = get_listes();

    require('../view/profil_views/delete_liste.php');

?>