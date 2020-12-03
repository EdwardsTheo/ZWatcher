<?php

    $machine_name = $_POST['id'];
    $_SESSION['machine_name'] = $machine_name;
    $_SESSION['errors'] = "";
    $_SESSION['errors_2'] = "";
    $_SESSION['errors_3'] = "";

    require('../view/profil_views/begin_modif.php');

?>