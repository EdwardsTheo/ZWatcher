<?php 

    $id1 = $_SESSION['id'];
    $id2 = $_SESSION['receive'];

    $req = get_contacts_messagerie();
    $req2 = get_messages($id1, $id2);

    $_SESSION['messagerie_tmp'] = true;

    $req3 = get_back_user($id2);
    $dns = $req3->fetch();
    $_SESSION['messagerie_tmp_user'] = $dns[0];

    require('../view/profil_views/messagerie_home.php');

?>