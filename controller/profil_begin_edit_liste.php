<?php

    $id_liste = $_POST['id_machine'];

    $req = get_liste_data($id_liste);

    $_SESSION['errors'] = "";
    
    require('../view/profil_views/begin_edit_liste.php');

?>