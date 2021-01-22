<?php

// Function used to get the informations of connection you need to execute a bash script

function info_login($machine_id) {
    $req = get_listes_machine($machine_id);
    while($donnees = $req->fetch()){
        if(isset($_POST['admin_add'])) {
            $login['name'] = 'root';
            $login['password'] = $_POST['root_password'];
        }
        else {
            $login['name'] = $donnees['id_machine'];
            $login['password'] = $donnees['pwd_machine'];
        }
        
	$login['id'] = $donnees['id'];
	$login['ip'] = $donnees['ip'];
        $login['port'] = $donnees['port'];
    
    }
    return $login; 
}

?>
