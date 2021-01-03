<?php	
	
    $new_ip = $_POST['ip'];
    $id_machine = $_POST['id_machine'];
    $old_ip = $_POST['old_ip'];
    $interface = $_POST['interface'];

    require('../ssh/ssh_controller.php');
   
    
    main_ssh($id_machine, 'edit_ip');
    $actual_ip = main_ssh($id_machine, 'get_ip');

    //partie après exécution de la tache

    $req = get_hostname($id_machine);

    $_SESSION['errors'] = "";
    $_SESSION['errors_2'] = "L'ip a bien été modifiée";
        
    require('../view/profil_views/begin_modif.php'); // redirect to the main app page with a message of confirmation 
       
?>
