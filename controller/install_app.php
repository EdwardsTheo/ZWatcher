<?php	
	
    ob_start();  
    session_start();
    require('../ssh/ssh_controller.php');
   
    if($_POST['status_install'] == 0) {
		install_and_check();
		return_status(); 
    }
    else {
		unistall_and_check();
		return_status_uni();
    }
    
    
    function install_and_check() { 
    
    	main_ssh($_POST['id_machine'], 'install'); // Install the package
    	$output = main_ssh($_POST['id_machine'], 'check_install'); // Check is the package is installed 
     
    }

    function return_status() {

		$_SESSION['check_install'] = (trim($output) == "Status: install ok installed") ? "true" : "false"; // returns true if install ok
		
		if($_SESSION['check_install'] == true) {
			$_SESSION['message'] = "L'applications a bien été installée";
			update_status_install('1', $_POST['id_machine'], $_POST['id_app']);
		}
		else {
			$_SESSION['message'] = "il y'a eu une erreur dans l'installion veuillez réssayer ou changer certaines configurations dans la partie gestion en cas de nouvelles erreurs"; 
		}
		
		$_SESSION['id_machine'] = $_POST['id_machine'];
    }
	

    function unistall_and_check() {
	    
		main_ssh($_POST['id_machine'], 'uninstall'); // Uninstall the package
    	$output = main_ssh($_POST['id_machine'], 'check_uninstall'); // Check is the package is uninstalled 
    }

    function return_status_uni() {
	
		if(trim($output) == "") {
			$_SESSION['message'] = "L'applications a bien été desinstallée";
			update_status_install('0', $_POST['id_machine'], $_POST['id_app']);
		}
		else {
			$_SESSION['message'] = "il y'a eu une erreur dans la desinstallation veuillez réssayer ou changer certaines configurations dans la partie gestion en cas de nouvelles erreurs"; 
		
		}
    }

    header('location: ../view/profil.php?action=appli_machine'); // redirect to the main app page with a message of confirmation 
       
?>
