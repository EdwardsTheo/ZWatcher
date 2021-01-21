<?php

    $id_equipe = $_POST['id_equipe'];
    
    $req = select_group_details($id_equipe);
    $req2 = select_group_name($id_equipe);
    $_SESSION['errors'] = "";
    $_SESSION['errors2'] = "";
    $_SESSION['errors3'] = "";
    require("../view/profil_views/info_equipe.php");

?>