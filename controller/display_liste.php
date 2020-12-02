<?php 

    session_start();

    $machine_name = $_POST['machine_name'];
    $_SESSION['machine_name'] = $machine_name;
    
    header('location: ../view/profil.php?action=appli_machine_liste');

?>