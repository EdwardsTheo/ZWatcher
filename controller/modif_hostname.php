<?php	
	
    $new_hostname = $_POST['hostname'];
    $id_machine = $_POST['id_machine'];
    $old_name = $_POST['old_name'];

    require('../ssh/ssh_controller.php');
   
    main_ssh($id_machine, 'edit_hostname');
    $actual_hostname = main_ssh($id_machine, 'get_machine_hostname');
    $actual_ip = main_ssh($id_machine, 'get_ip');
    $interface = main_ssh($id_machine, 'get_interface');

    //partie après exécution de la tache

    $req = get_hostname($id_machine);

    $_SESSION['errors'] = "Le hostname a bien été changé";
    $_SESSION['errors_2'] = "";
        
    require('../view/profil_views/begin_modif.php'); // redirect to the main app page with a message of confirmation 
       
?>
