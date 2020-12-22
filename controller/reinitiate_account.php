<?php

//send mail to user to reinitiate password

    require('../model/config.php');
    require('../model/select.php');
    require('../model/insert.php');

    $user = $_POST['user'];
    $mail = $_POST['mail'];

    $errors = "";

    //récupérer les infos dans la bdd
    //si ça correspond pas ça dégage
    //si ça correspond en avant

?>