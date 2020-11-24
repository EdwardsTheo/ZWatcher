<?php

    session_start();
    include("../model/config.php");
    include("../model/select.php");
    include("../model/insert.php");
    include("../model/update.php");

    $id1 = $_SESSION['id'];
    $id2 = $_SESSION['receive'];

    $content = $_POST['message'];
    $date = date('Y-m-d');
    $req = insert_message($content, $date);
    insert_message_user($id1, $id2, $req);
    update_checkpoint($id1, $id2, $date);

    header("Location: ../controller/redirect_messagerie.php?user=$id2");

?>