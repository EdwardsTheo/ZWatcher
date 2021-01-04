<?php

    $id_liste = $_POST['id_machine'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $port = $_POST['port'];
    $iden = $_POST['iden'];
    $pwd = $_POST['password'];

    update_liste($id_liste, $titre, $description, $port, $iden, $pwd);


    $req = get_liste_data($id_liste);

    $_SESSION['errors'] = "La machine a bien été modifiée";
    
    require('../view/profil_views/begin_edit_liste.php');

?>