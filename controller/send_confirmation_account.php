<?php

    session_start();

    include('./mail/confirmation_account.php');

    
    header('location: ../view/profil.php?action=status');

?>