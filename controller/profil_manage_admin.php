<?php

require('../ssh/ssh_controller.php');
profil_manage_admin_main();

function main_update_admin_list() {
    //update machine
    $i=1;
    foreach ($_POST['id_profil'] as $key => $value) {
        $from = $_POST['id_profil'][$i];
        if($_POST['psswd'][$i] == "") {
            $req = get_liste_data_id_admin($_POST['id_profil'][$i], $_SESSION['id_machine']);
            while($donnees = $req->fetch()) {
                $password = $donnees['pwd_machine'];
            }
        }
        else {
            $password = $_POST['psswd'][$i];
            $update = true;
        }
        if(isset($update)) main_ssh($_SESSION['id_machine'], 'change_password', $_POST['old_username'][$i], $_POST['psswd'][$i]);
        update_id_pswd_machine($_SESSION['id_machine'], $_POST['old_username'][$i], $password);
        $_SESSION['message'] = "Les informations de l'admin ont bien été mis à jour";
        $i++;
    }
}
  


function generate_rsa_key_admin() {
    foreach ($_POST['id_profil'] as $key => $value) { 
        $i = $key;
    }
    foreach ($_POST['id_profil'] as $key => $value) { 
        $test_password_bash = test_password_admin($_POST['id_profil'][$i], $_POST['password'][$i]);
        if($test_password_bash == true) {
            $hash = bin2hex(random_bytes(16));
            $_SESSION['hash'][1] = $hash;
            $tmp_pass = $_SESSION['hash'][1];
            $hash = 'zwadmin';
            
            main_ssh($_SESSION['id_machine'], 'create_ssh_dir', $_POST['old_username'][$i]); 
            main_ssh($_SESSION['id_machine'], 'create_rsa', $_POST['old_username'][$i], $hash);
            main_ssh($_SESSION['id_machine'], 'authorise key', $_POST['old_username'][$i]);
            
            // Create a php file with the name of the user and the id of the machine
            $output = main_ssh($_SESSION['id_machine'], 'cat_rsa_key', $_POST['old_username'][$i], 'id_rsa');
            $file = $_POST['old_username'][$i] . "_" . $_SESSION['id_machine'];
            file_put_contents("../rsa/$file.txt", $output);
                
            // Same but for the public key
            $output = main_ssh($_SESSION['id_machine'], 'cat_rsa_key', $_POST['old_username'][$i], 'id_rsa.pub');
            $file = $_POST['old_username'][$i] . "_" . $_SESSION['id_machine'];
            file_put_contents("../rsa/$file.pub", $output);

            // Update status inside the db
            $rsa = 1;
            update_admin_rsa($_SESSION['id_machine'], $rsa);

                
            // Create the .pem key to use it for the ssh_auth_public_key
            main_ssh($_SESSION['id_machine'], 'openssh', $_POST['old_username'][$i], $hash);
            $file = "id_rsa_" . $_SESSION['id_machine'] . ".pem";
            $output = main_ssh($_SESSION['id_machine'], 'cat_rsa_key', $_POST['old_username'][$i], $file);
            
            file_put_contents("../rsa_admin/$file", $output);
                
            $output = main_ssh($_SESSION['id_machine'], 'cat_rsa_key', $_POST['old_username'][$i], 'id_rsa.pub');
            $file = "id_rsa_" . $_SESSION['id_machine'] . ".pub";
            file_put_contents("../rsa_admin/$file", $output);

            // Change the right so the website can read the file
            shell_exec('sh ../bash/www-data.bash');

            //Send mail with passphrase
            
            $mail = get_admin_mail('1');
            send_mail_passphrase ($mail, $hash);
            $_SESSION['message'] = "La clé RSA a bien été générée";
        }
        else $_SESSION['error'][$i] = "Mot de passe incorrect";
        $i++;
    }
}

function get_admin_mail($id_user) {
    $req = fetch_user($id_user); 
    while($donnees = $req->fetch()) {
        $mail = $donnees['mail'];
    }
    return $mail;
}

function delete_rsa_keys_admin() {
    foreach ($_POST['id_profil'] as $key => $value) { 
        $i = $key;
    }
    foreach ($_POST['id_profil'] as $key => $value) { 
        $test_password_bash = test_password_admin($_POST['id_profil'][$i], $_POST['password'][$i]);
            if($test_password_bash == true) {
            // Delete the .ssh directory
            main_ssh($_SESSION['id_machine'], 'delete rsa dir', $_POST['old_username'][$i]);
            
            // Delete all keys file 
            $file = $_POST['old_username'][$i] . "_" . $_SESSION['id_machine'];
            unlink("../rsa/$file.txt");
            unlink("../rsa/$file.pub");
            $file_pub = "id_rsa_" . $_SESSION['id_machine'] . ".pub";
            unlink("../rsa_admin/$file_pub");
            $file_pem = "id_rsa_" . $_SESSION['id_machine'] . ".pem";
            unlink("../rsa_admin/$file_pem");
            shell_exec("sudo rm /rsa_admin/$file_pem");
            shell_exec("sudo rm /rsa_admin/$file_pub");

            //Put the status back to 0 
            $rsa = 0;
            update_admin_rsa($_SESSION['id_machine'], $rsa);
            $_SESSION['message'] = "La clé RSA a bien été supprimée";
        }
        else $_SESSION['error'][$i] = "Mot de passe incorrect";
    }
}



function test_password_admin($id_user, $password) {
    $req = get_liste_data_id_admin($id_user, $_SESSION['id_machine']);
    $bool = false;
    while($donnees = $req->fetch()) {
        if($_SESSION['id_machine'] == $donnees['id']){
            $password = $donnees['pwd_machine'];
            $bool = true;
        }
    }
    return $bool;
}

function activate_rsa_login() {
    main_ssh($_SESSION['id_machine'], 'activer rsa login');
    main_ssh($_SESSION['id_machine'], 'restart ssh');
    $connect = 1;
    update_admin_connect($_SESSION['id_machine'], $connect);
    $_SESSION['message'] = "La connexion par mot de passe a été désactivée";
}

function desactivate_rsa_login() {
    $connect = 0;
    main_ssh($_SESSION['id_machine'], 'desactiver rsa login');
    main_ssh($_SESSION['id_machine'], 'restart ssh');
    update_admin_connect($_SESSION['id_machine'], $connect);
    $_SESSION['message'] = "La connexion par mot de passe a été réactivée";
    
}

function profil_manage_admin_main() {
    switch($_POST['choice']) {
        case 'Modifier les informations' : main_update_admin_list();
        break;
        case "Créer une clé rsa pour cet user" : generate_rsa_key_admin();
        break;
        case "Supprimer la clé RSA" : delete_rsa_keys_admin();
        break;
        case 'Activer la connexion par clé rsa uniquement' : activate_rsa_login();
        break;
        case 'Reactiver la connexion sans clé' : desactivate_rsa_login();
        break;
    }
}

//header('location: ../view/profil.php?action=modif_admin_listes'); // redirect to the main app page with a message of confirmation 

?>
