<?php	
	

    require('../ssh/ssh_controller.php');
   
    main_ssh($_POST['id_machine'], 'edit_hostname');     



    $machine_name = 4;
    $req = get_hostname($machine_name);

    $_SESSION['errors'] = "";
    $_SESSION['errors_2'] = "";
    $_SESSION['errors_3'] = "";
        
    require('../view/profil_views/begin_modif.php'); // redirect to the main app page with a message of confirmation 
       
?>
