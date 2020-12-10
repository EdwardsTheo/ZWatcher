<?php

    print_r($_POST);
    $req = get_app($_POST['id_machine']);
    require('../view/profil_views/begin_appli.php');

?>
