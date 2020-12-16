<?php	

	print_r($_POST);
	print_r($_SESSION);
    require('../ssh/ssh_controller.php');
   

	if(isset($_POST['nom_appli'])) main_install();
	else update_upgrade();

	function main_install() {
		$i=1;
		foreach ($_POST['nom_appli'] as $key => $value) {
			if(isset($_POST['scales'][$i])) {
				if($_POST['scales'][$i] == "on") {
					if($_POST["action"] == 'Installer') {
						$output = install_and_check($_SESSION['id_machine'], $_POST['action'], $_POST['nom_appli'][$i]);
						return_status($output, $_SESSION['id_machine'], $_POST['id_appli'][$i]); 
					}
					else {
						$output = unistall_and_check($_SESSION['id_machine'], $_POST['action'], $_POST['nom_appli'][$i]);
						return_status_uni($output, $_SESSION['id_machine'], $_POST['id_appli'][$i]);
					}
				}
			}
			$i++;
		}
	}
    
    function install_and_check($id_machine, $action, $app_name) { 
    	main_ssh($id_machine, $action, $app_name); // Install the package
		$output = main_ssh($id_machine, 'check_install', $app_name); // Check is the package is installed 
		return $output;
    }

    function return_status($output, $id_machine, $id_appli) {

		$_SESSION['check_install'] = (trim($output) == "Status: install ok installed") ? "true" : "false"; // returns true if install ok
		
		if($_SESSION['check_install'] == true) {
			$_SESSION['message'] = "L'installation n'a pas rencontrée de problème";
			update_status_install('1', $id_machine, $id_appli);
		}
		else {
			$_SESSION['message'] = "il y'a eu une erreur dans l'installion veuillez réssayer ou changer certaines configurations dans la partie gestion en cas de nouvelles erreurs"; 
		}
		
		$_SESSION['id_machine'] = $id_machine;
    }
	

    function unistall_and_check($id_machine, $action, $app_name) {
	    
		main_ssh($id_machine, $action, $app_name); // Uninstall the package
		$output = main_ssh($id_machine, 'check_uninstall', $app_name); // Check is the package is uninstalled 
		return $output;
    }

    function return_status_uni($output, $id_machine, $id_appli) {
		if(trim($output) == "Installé : (aucun)") {
			$_SESSION['message'] = "La désinstallation n'a pas rencontrée de problème";
			update_status_install('0', $id_machine, $id_appli);
		}
		else {
			$_SESSION['message'] = "il y'a eu une erreur dans la desinstallation veuillez réssayer ou changer certaines configurations dans la partie gestion en cas de nouvelles erreurs"; 
		
		}
	}
	
	function update_upgrade() {
		echo "oui";
		main_ssh($_SESSION['id_machine'], 'update_upgrade');
		$_SESSION['message'] = "Les paquets de la machine ont bien été mis à jour";
	}

    header('location: ../view/profil.php?action=appli_machine'); // redirect to the main app page with a message of confirmation 
       
?>
