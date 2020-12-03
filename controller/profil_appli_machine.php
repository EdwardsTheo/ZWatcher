<?php

    $_SESSION['id_machine'] = $_POST['id_machine'];
    $req =  get_app($_SESSION['id_machine']);

    require('../view/profil_views/begin_appli.php');

?>