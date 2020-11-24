<?php
    $req = get_contacts_messagerie();

    $_SESSION['messagerie_tmp'] = false;
    
    require('../view/profil_views/messagerie_home.php');

?>