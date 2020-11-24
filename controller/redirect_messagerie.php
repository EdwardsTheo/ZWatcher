<?php

    session_start();
    include("../model/config.php");
    include("../model/select.php");
    include("../model/update.php");

    if (!isset($_GET['user'])) {
        $_SESSION['receive'] = "no one";
    }else{
        $tmp = $_GET['user'];
        $_SESSION['receive'] = $tmp;
    }

    $id = $_SESSION['id'];

    header('Location: ../view/profil.php?action=messages');

?>