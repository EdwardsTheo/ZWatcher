<?php

    require('../ssh/ssh_controller.php');
    main_ssh($_POST['id_machine'], 'install');

?>