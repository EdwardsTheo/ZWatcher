<?php

    $machine_name = $_POST['machine_name'];
    $_SESSION['machine_name'] = $machine_name;

    require('../view/profil_views/begin_appli.php');

?>