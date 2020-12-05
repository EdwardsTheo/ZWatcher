<?php
    
    require('../ssh/ssh_controller.php');
    main_ssh($_POST['id_machine'], 'install'); // Install the package
    $output = main_ssh($_POST['id_machine'], 'install'); // Check is the package is installed 
    echo $output;
    
?>

