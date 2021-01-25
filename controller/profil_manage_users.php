<?php

require('../ssh/ssh_controller.php');
require('profil_manage_table_equipes_copy.php');

function main_add_users() {
    $i = 1;
    foreach ($_POST['username'] as $key => $value) { 
        $test_username = test_username($_POST['username'][$i]);
        if($test_username == true) {
            $username = $_POST['username'][$i];
            $password = $_POST['pswd'][$i];
            main_ssh($_SESSION['id_machine'], 'add_user', $username, $password);
            $output = main_ssh($_SESSION['id_machine'], 'bash_user_exist', $username, $password);
            if($output != "") {
                main_ssh($_SESSION['id_machine'], 'change_password', $username, $password);
                main_ssh($_SESSION['id_machine'], 'change_bash', $username, $password);
                main_ssh($_SESSION['id_machine'], 'create_home', $username, $password);
                $rsa = 0;
                insert_new_user_listesnull($username, $password, $_SESSION['id_machine'], $rsa);
            }
            else $_SESSION['error'][$i] = "une erreur est survenue";
            
        }
        else $_SESSION['error'][$i] = "Le nom d'utilisateur ". $_POST['username'][$i] ." est déjà prit";
        $i++;
    }
}

function test_username($username, $id = NULL) {
    if($id == NULL) $req = select_users_listes($_SESSION['id_machine']);
    else $req = select_users_listes_id($_SESSION['id_machine'], $id);
    $test = true;
    while($donnees = $req->fetch()) {
        if($donnees['username'] == $username) {
            $test = false;
        }
    }
    return $test;
}

function main_delete_users() {
    $i = 1;
    foreach ($_POST['username'] as $key => $value) { 
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                $username = $_POST['username'][$i];
                $output = main_ssh($_SESSION['id_machine'], 'delete_users', $username, NULL);
                main_ssh($_SESSION['id_machine'], 'delete_home', $username, NULL);
                $req = delete_user_listes($_POST['id_user'][$i]);
                $_SESSION['message'] = "L'user a bien été supprimé";
            }
        }
    $i++;
    } 
}

function set_session_user() {
    $i=1;
    foreach ($_POST['id_user'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
                $_SESSION['id_user'][$i] = $_POST['id_user'][$i];
            }
        }
        $i++;
    }
}

function main_update_users_list() {
    $i=1;
    foreach ($_POST['id_profil'] as $key => $value) {
        $from = $_POST['id_profil'][$i];
        if($_POST['psswd'][$i] == "") {
            $req = select_users_listes($_SESSION['id_machine']);
            while($donnees = $req->fetch()) {
                $hashed_password = $donnees['pswd'];
            }
        }
        else {
            $options = array('cost' => 11);
            $hashed_password = password_hash($_POST['psswd'][$i], PASSWORD_BCRYPT, $options);
            $update = true;
        }
        $test_username = test_username($_POST['username'][$i], $from);
        $test_username = true;
        if($test_username == true) {
            update_users_listes($_POST['username'][$i], $hashed_password, $_POST['id_profil'][$i]);
            
            main_ssh($_SESSION['id_machine'], 'change_username', $_POST['username'][$i], $_POST['old_username'][$i]);
            main_ssh($_SESSION['id_machine'], 'change_group_name', $_POST['username'][$i], $_POST['old_username'][$i]);
            main_ssh($_SESSION['id_machine'], 'change_home_dir', $_POST['username'][$i], $_POST['old_username'][$i]);
            
            change_file_rsa($_POST['username'][$i], $_POST['old_username'][$i]);
            if(isset($update)) {
                main_ssh($_SESSION['id_machine'], 'change_password', $_POST['username'][$i], $_POST['psswd'][$i]);
                //Send mail 
                $info =  get_user_mail($_POST['id_profil'][$i]);
                $mail = $info['mail'];
                send_mail_account ($mail, $_POST['psswd'][$i]);
                
            }
            $_SESSION['message'] = "Les informations de l'user ont bien été mis à jour";
        }
        else $_SESSION['error'][$i] = "Le nom d'utilisateur ". $_POST['username'][$i] ." est déjà prit";
        $i++;
    }
}

function change_file_rsa($username, $old_username) {
    
    $file = $old_username . "_" . $_SESSION['id_machine'];
    if (file_exists("../rsa/$file.txt")) {
        $output = file_get_contents("../rsa/$file.txt");
        unlink("../rsa/$file.txt");
        $file = $username . "_" . $_SESSION['id_machine'];
        file_put_contents("../rsa/$file.txt", $output);
    }

    $file = $old_username . "_" . $_SESSION['id_machine'];
    if (file_exists("../rsa/$file.pub")) {
        $output = file_get_contents("../rsa/$file.pub");
        unlink("../rsa/$file.pub");
        $file = $username . "_" . $_SESSION['id_machine'];
        file_put_contents("../rsa/$file.pub", $output);
    }

}

function add_team_grp() {
    $i = 1;
    foreach ($_POST['nom_equipe'] as $key => $value) {
        //TEST SI L'EQUIPE EXISTE
        $test = check_team_name($_POST['nom_equipe'][$i], $_SESSION['id_machine']);
        $id_team = get_id_team($_POST['nom_equipe'][$i], $_SESSION['id_machine']);
        if($test == true) {
            // Ajoute de l'equipe en groupe dans la machine;
            main_ssh($_SESSION['id_machine'], 'add_groups', $_POST['nom_equipe'][$i]);
            $output = main_ssh($_SESSION['id_machine'], 'check_groups', $_POST['nom_equipe'][$i]);
            $output = "o";
            if($output != "") {
                if(isset($_POST['sudo'][$i])) {
                    main_ssh($_SESSION['id_machine'], 'add_groups_sudo', $_POST['nom_equipe'][$i]);
                    $sudo = 1;  
                }
                else $sudo = 0;
                // Ajout du groupe dans BDD 
                $id_grp = insert_new_groups_listes($_POST['nom_equipe'][$i], $_SESSION['id_machine'], $sudo, $id_team);
                add_team_to_grpbl($id_grp, $id_team, $_POST['nom_equipe'][$i]);
                $_SESSION['message'] = "Le groupe à " .$_POST['nom_equipe'][$i]. " bien été ajouté";
            }
            else $_SESSION['error'][$i] = "une erreur est survenue";
        }
        else $_SESSION['error'][$i] = "Le nom de l'équipe n'existe pas";
        //Ajout des users dans l'equipe avec l'id equipe pas null
        $i++;
    }
}

function get_id_team($nom_equipe, $id_machine) {
    $req = select_id_team($nom_equipe, $id_machine);
    while($donnees = $req->fetch()) {
        $id = $donnees['id'];
    }
    return $id;
}

function add_team_to_grpbl($id_grp, $id_team, $nom_equipe) {
    $req = simple_select_teambl(); 
    $i = 0;
    while($donnees = $req->fetch()) {
        if($donnees['id_equipe'] == $id_team) {
            $rsa = 0;
            $username = get_username($donnees['id_eleve']);
            $password = "secret";
            $id_user = insert_new_user_listes($username, $password, $_SESSION['id_machine'], $rsa, $id_team);
            // Creation des users avec username élèves.
            main_ssh($_SESSION['id_machine'], 'add_user', $username, $password);
            main_ssh($_SESSION['id_machine'], 'create_home', $username, $password);
            insert_user_to_group($id_user, $id_grp);
            main_ssh($_SESSION['id_machine'], 'change_bash', $username, $password);
            main_ssh($_SESSION['id_machine'], 'add_user_to_groups',  $nom_equipe,  $username);
            insert_user_link($donnees['id_eleve'], $id_user);

            $info =  get_user_mail($id_user);
            $mail = $info['mail'];
            send_mail_account ($mail, $password);
        }
        $i++;
    }
}

function get_username($id_eleve) {
    $req = select_users_id2($id_eleve);
    while($donnees = $req->fetch()) {
        if($id_eleve == $donnees['id']) {
            $username = $donnees['username'];
        }
    }
    return $username;
}

function generate_rsa_key() {
    foreach ($_POST['id_profil'] as $key => $value) { 
        $i = $key;
    }
    foreach ($_POST['id_profil'] as $key => $value) { 
        // Test if the password given is ok
        $test_password_bash = test_password_bash($_POST['id_profil'][$i], $_POST['password'][$i]);
        if($test_password_bash == true) {
            
            // Create a rsa key with a random passphrase  
            $hash = bin2hex(random_bytes(16));
            $_SESSION['hash'][1] = $hash;
            $tmp_pass = $_SESSION['hash'][1];
            main_ssh($_SESSION['id_machine'], 'create_ssh_dir', $_POST['old_username'][$i]);
            main_ssh($_SESSION['id_machine'], 'create_rsa', $_POST['old_username'][$i], $hash);
                
            
            main_ssh($_SESSION['id_machine'], 'authorise key', $_POST['old_username'][$i]);
                
           
            $output = main_ssh($_SESSION['id_machine'], 'cat_rsa_key', $_POST['old_username'][$i], 'id_rsa');
            $file = $_POST['old_username'][$i] . "_" . $_SESSION['id_machine'];
            file_put_contents("../rsa/$file.txt", $output);

            
            $output = main_ssh($_SESSION['id_machine'], 'cat_rsa_key', $_POST['old_username'][$i], 'id_rsa.pub');
            $file = $_POST['old_username'][$i] . "_" . $_SESSION['id_machine'];
            file_put_contents("../rsa/$file.pub", $output);
                
           
            $rsa = 1;
            $req = update_users_rsa($_POST['id_profil'][$i], $rsa);
            
            
            //Send mail with passphrase
            $info =  get_user_mail($_POST['id_profil'][$i]);
            $mail = $info['mail'];
            send_mail_passphrase ($mail, $tmp_pass);
            $_SESSION['message'] = "La clé RSA a bien été générée";
        }
        else $_SESSION['error'][$i] = "Mot de passe incorrect";
        $i++;
    }
}

function test_password_bash($id_user, $password) {
    $req = select_users_listes($_SESSION['id_machine']);
    $bool = false;
    while($donnees = $req->fetch()) {
        if($donnees['id'] == $id_user){
            $hashed_password = $donnees['pswd'];
            $bool = password_verify($password, $hashed_password);
   
        }
    }
   return $bool;
}

function delete_rsa_keys() {
    foreach ($_POST['id_profil'] as $key => $value) { 
        $i = $key;
    }
    foreach ($_POST['id_profil'] as $key => $value) { 
        $test_password_bash = test_password_bash($_POST['id_profil'][$i], $_POST['password'][$i]);
            if($test_password_bash == true) {
            main_ssh($_SESSION['id_machine'], 'delete rsa dir', $_POST['old_username'][$i]);
            
            $file = $_POST['old_username'][$i] . "_" . $_SESSION['id_machine'];
            unlink("../rsa/$file.txt");
            unlink("../rsa/$file.pub");
            $rsa = 0;
            update_users_rsa($_POST['id_profil'][$i], $rsa);
            $_SESSION['message'] = "La clé RSA a bien été supprimée";
        }
        else $_SESSION['error'][$i] = "Mot de passe incorrect";
    }
}

function delete_user_link() {
    $i=1;
    foreach ($_POST['id_table'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
               delete_user_link_table($_POST['id_table'][$i]);
               $info = get_user_listes($_POST['username'][$i]);
               main_ssh($_SESSION['id_machine'], 'delete rsa dir', $info['username']);
               $file = $info['username'] . "_" . $_SESSION['id_machine'];
               unlink("../rsa/$file.txt");
               unlink("../rsa/$file.pub");
               $rsa = 0;
               update_users_rsa($_POST['username'][$i], $rsa);
               $_SESSION['message'] = "Le lien entre l'user linux " .$info['username']. " et l'utilisateurs a bien été retiré";
            }
        }
        $i++;
    }
}

function get_user_listes($id_user) {
    $req = select_users_listes_id($_SESSION['id_machine'], $id_user);
    while($donnees = $req->fetch()) {
        $info['id'] = $donnees['id'];
        $info['username'] = $donnees['username'];
        $info['rsa'] = $donnees['rsa'];
    }
    return $info;
}

function get_user_mail($id_user) {
    $req = select_user_bl_listes($id_user);
    while($donnees = $req->fetch()) {
        $info['mail'] = $donnees['mail'];
    }
    return $info;
}

function add_user_link() {
$j = 0;	
    foreach ($_POST['id_user'] as $key => $value) { 
        if($j == 0) $i = $key;
    	$j++;
    }
    foreach ($_POST['id_user'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
               insert_user_link($_POST['id_user'][$i], $_POST['id_user_listes'][$i]);
               $info = get_user_listes($_POST['id_user_listes'][$i]);
               print_r($info);
               if($info['rsa'] == 0) {
                   $password = 'secret';
                   main_ssh($_SESSION['id_machine'], 'change_password', $info['username'], $password);
                   $options = array('cost' => 11);
                   $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
                   update_users_listes($info['username'], $hashed_password, $info['id']);
                   $info =  get_user_mail($info['id']);
                   $mail = $info['mail'];
                   send_mail_account ($mail, $password);
               } 
               else {
                   $password = 'secret';
                   main_ssh($_SESSION['id_machine'], 'delete rsa dir', $info['username']);
                   main_ssh($_SESSION['id_machine'], 'create_ssh_dir', $info['username']);
                   main_ssh($_SESSION['id_machine'], 'create_rsa', $info['username'], $password);
                       
                   
                   main_ssh($_SESSION['id_machine'], 'authorise key', $info['username']);
                       
                  
                   $output = main_ssh($_SESSION['id_machine'], 'cat_rsa_key', $info['username'], 'id_rsa');
                   $file = $info['username'] . "_" . $_SESSION['id_machine'];
                   file_put_contents("../rsa/$file.txt", $output);
       
                   
                   $output = main_ssh($_SESSION['id_machine'], 'cat_rsa_key', $info['username'], 'id_rsa.pub');
                   $file = $info['username'] . "_" . $_SESSION['id_machine'];
                   file_put_contents("../rsa/$file.pub", $output);

                   $info =  get_user_mail($info['id']);
                   $mail = $info['mail'];
                   send_mail_passphrase ($mail, $password);
                }  
                $_SESSION['message'] = "Le lien entre l'user linux " .$info['username']. " et l'utilisateurs a bien été ajouté";
            }
            
        }
        $i++;
    }
}

switch($_POST['choice']) {
    case 'Ajouter les users' :  main_add_users();
    break;
    case 'Supprimer les users' : main_delete_users();
    break;
    case 'Modifier les informations' : main_update_users_list();
    break;
    case 'Détails du profil' :  set_session_user();
    break;
    case "Ajouter cette équipe" : add_team_grp();
    break;
    case "Créer une clé rsa pour cet user" : generate_rsa_key();
    break;
    case "Supprimer la clé RSA" : delete_rsa_keys();
    break;
    case 'Supprimer le lien avec un ou des utilisateurs' : delete_user_link();
    break;
    case "Ajouter l'utilisateur à cette user linux" : add_user_link();
    break; 
}

header('location: ../view/profil.php?action=modif_users'); // redirect to the main app page with a message of confirmation 
