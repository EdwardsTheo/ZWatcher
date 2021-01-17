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
            if(isset($update)) main_ssh($_SESSION['id_machine'], 'change_password', $_POST['username'][$i], $_POST['psswd'][$i]);
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
                if($_POST['sudo'][$i] == 'on') {
                    main_ssh($_SESSION['id_machine'], 'add_groups_sudo', $_POST['nom_equipe'][$i]);
                    $sudo = 1;  
                }
                else $sudo = 0;
                // Ajout du groupe dans BDD 
                $id_grp = insert_new_groups_listes($_POST['nom_equipe'][$i], $_SESSION['id_machine'], $sudo, $id_team);
                add_team_to_grpbl($id_grp, $id_team, $_POST['nom_equipe'][$i]);
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
    while($donnees = $req->fetch()) {
        if($donnees['id_equipe'] == $id_team) {
            $rsa = 0;
            $username = get_username($donnees['id_eleve']);
            $password = "ghghghgh";
            $id_user = insert_new_user_listes($username, $password, $_SESSION['id_machine'], $rsa, $id_team);
              // Creation des users avec username élèves.
            main_ssh($_SESSION['id_machine'], 'add_user', $username, $password);
            main_ssh($_SESSION['id_machine'], 'create_home', $username, $password);
            insert_user_to_group($id_user, $id_grp);
            main_ssh($_SESSION['id_machine'], 'change_bash', $username, $password);
            main_ssh($_SESSION['id_machine'], 'add_user_to_groups',  $nom_equipe,  $username);
        }
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
            update_users_rsa($_POST['id_profil'][$i], $rsa);

            
            
            //Send mail with passphrase
            $mail = $_SESSION['mail'];

            $to      = $mail;
            $subject = 'Création de votre clé RSA';

            $message = "<html>
            <head>
            <meta name='viewport' content='width=device-width' />
            <meta http-equiv='content-type' charset='utf-8' content='text/html' />
            <title>ZWatcher</title>
            <style>
                @import url('https://fonts.googleapis.com/css?family=Noto+Sans|Poppins:400,600,700|Thasadith');
                body {
                width: 100%;
                background-color: #fff !important;
                margin: 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
                -firefox-text-size-adjust: 100%;
                font-family: 'Thasadith', sans-serif;
                }
                
                table {
                width: 100%;
                border-collapse: collapse;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                margin: 0;
                }
                table td {
                vertical-align: top;
                margin: 0;
                }
                
                /* -------------------------------------
                    CONTAINER AND CONTENT
                ------------------------------------- */
                
                .container {
                display: block;
                margin: 0 auto !important;
                width-max: 580px;
                width: 100%;
                padding: 10px;
                }
                .content {
                display: block;
                margin: 0 auto !important;
                box-sizing: border-box;
                padding: 10px;
                max-width: 580px;
                width: 100%;
                background-color: #fff;
                }
                
                /* -------------------------------------
                    HEADER MAIN AND FOOTER
                ------------------------------------- */
                .main_logo {
                display: block;
                margin: 0 auto !important;
                max-width: 160px;
                width: 80%;
                }
                
                .main_logo+p {
                text-align: center;
                font-size: .8em;
                margin-top: -10px;
                margin-bottom: 20px;
                }
                
                .hero_image {
                max-width: 580px;
                width: 100%;
                background-color: #fff;
                }

                .hero_image1 {
                    max-width: 580px;
                    width: 100%;
                    margin-bottom: -4px ;
                    background-color: #fff;
                }
                
                .offer_image {
                max-width: 580px;
                width: 90%;
                background: #fff;
                display: block;
                margin: 10px auto;
                }
                
                .wrapper {
                box-sizing: border-box;
                padding: 20px; 
                }
                
                .message {
                text-align: left;
                padding: 30px;
                background-color: #f2f2f2;
                margin-top: -10px;
                }
                
                .message h1 {
                font-size: 1.5em;
                color: #000;
                font-family: 'Noto Sans', sans-serif;
                }
                
                .message p {
                color: #333;
                line-height: 1.4em;
                word-spacing: 2px;
                }
                
                .offer {
                margin-bottom: 35px;
                }
                
                .body_bottom {
                background-color: #f2f2f2;
                padding: 30px;
                }
                
                .social {
                margin-bottom: 30px;
                }
                
                .social tr {
                text-align: center;
                font-size: 1.333em;
                }
                
                .social_icon a img {
                width: 2em;
                }
                
                .footer, .footer_content {
                padding: 0px;
                background-color: #fff;
                }
                
                .footer_content {
                text-align: center;
                font-size: .7em;
                opacity: .6;
                }
                
                /* -------------------------------------
                    BUTTON
                ------------------------------------- */
                .btn {
                box-sizing: border-box;
                width: 100%;
                }
                
                .btn tbody tr td {
                display: block;
                margin: 0 auto !important;
                text-align: center;
                }
                
                .btn tr td table tbody tr td {
                text-align:center;
                display: block;
                margin: 0 auto;
                width: 100%;
                }
                
                .btn a {
                display: inline-block;
                text-decoration: none;
                background-color: #88b5bf;
                padding: 10px 50px;
                margin: 0 auto;
                color: #fff;
                font-size: 1.333em;
                font-weight: bold;
                box-sizing: border-box;
                transition: background-color .3s, padding 1s;
                }
                
                .btn a:hover {
                background-color: #69cce0;
                padding: 10px 70px;
                }
                
                /* -------------------------------------
                    OTHER STYLE
                ------------------------------------- */
                .preheader {
                color: transparent;
                visibility: hidden;
                mso-hide: all;
                display: none;
                overflow: hidden;
                opacity: 0;
                width: 0;
                height: 0;       
                }
                
                .hyperlink, .article {
                color: #88b5bf;
                font-weight: bold;
                text-decoration: none;
                transition: color .3s linear;
                }
                
                .underline {
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #88b5bf;
                width: 200px;
                transition: color .3s linear;
                }
                
                .hyperlink:hover, .article:hover, .underline:hover {
                color: #69cce0;
                border-bottom-color: #69cce0;
                }
                
                /* -------------------------------------
                    RESPONSIVE AND MOBILE FRIENDLY STYLES
                ------------------------------------- */
                @media only screen and (max-width: 620px) {
                table[class=body] h1 {
                    font-size: 28px !important;
                    margin-bottom: 10px !important; 
                }
                table[class=body] p,
                table[class=body] ul,
                table[class=body] ol,
                table[class=body] td,
                table[class=body] span,
                table[class=body] a {
                    font-size: 16px !important; 
                }
                table[class=body] .wrapper,
                table[class=body] .article {
                    padding: 10px !important; 
                }
                table[class=body] .content {
                    padding: 0 !important; 
                }
                table[class=body] .container {
                    padding: 0 !important;
                    width: 100% !important; 
                }
                table[class=body] .main {
                    border-left-width: 0 !important;
                    border-radius: 0 !important;
                    border-right-width: 0 !important; 
                }
                table[class=body] .btn table {
                    width: 100% !important; 
                }
                table[class=body] .btn a {
                    width: 100% !important; 
                }
                table[class=body] .hero_image {
                    height: auto !important;
                    max-width: 100% !important;
                    width: auto !important; 
                }
                table[class=body] .hero_image1 {
                    height: auto !important;
                    max-width: 100% !important;
                    width: auto !important; 
                }
                }
        
                /* -------------------------------------
                    PRESERVE THESE STYLES IN THE HEAD
                ------------------------------------- */
                @media all {
                .ExternalClass {
                    width: 100%; 
                }
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                    line-height: 100%; 
                }
                .apple-link a {
                    color: inherit !important;
                    font-family: inherit !important;
                    font-size: inherit !important;
                    font-weight: inherit !important;
                    line-height: inherit !important;
                    text-decoration: none !important; 
                }
                .btn-primary table td:hover {
                    background-color: #34495e !important; 
                }
                .btn-primary a:hover {
                    background-color: #34495e !important;
                    border-color: #34495e !important; 
                } 
                }
            </style>
            
            </head>
            
            <body role='presentation' border='0' cellspacing='0' cellpadding='0'>
            <tr>
                <td>&nbsp;</td>
                <td class='container'>
                <div class='content'>
                    
                    <!-- EMAIL CONTAINER -->
                    <!-- PREVIEW TEXT FROM CLIENT -->
                    <span class='preheader'>Email text preview from client.</span>
                    
                    <!-- EMAIL BODY -->
                    <table role='presentation' border='0' cellspacing='0' cellpadding='0' class='main'>
                    <tbody>
                        <tr>
                        <td>
                            <!-- MAIN AREA -->
                            <table role='presentation' border='0' cellspacing='0' cellpadding='0'>
                            <td>
                                <tr>
                                    <img src='http://zwa.2nd-itinet.fr/images/graphismes/mail_ban.png' alt='img' style='display:block' class='hero_image1'/>
                                </tr>
                                <tr>
                                <table role='presentation' border='0' cellspacing='0' cellpadding='0'>
                                    <div class='message'>
                                    <h1Création de votre clé RSA</h1>
                                    <p> Une clé RSA a été créée pour vous sur la plateforme ZWatcher.</p>
                                    <p>Vous pourrez la retrouver en vous connectant grâce au lien situé en bas de ce message.</p>

                                    <p>Votre <em>passphrase</em> est la suivante : $tmp_pass </p>
                                    <p>Contactez l'administrateur en cas de problème avec la création de votre clé RSA. </p>
                                    <p> Si vous n'êtes pas le destinataire de ce message, merci de l'ignorer et de le supprimer.</p>
                                    </p> Si vous rencontrez des problèmes avec votre compte ou si vous souhaitez le récupérer, contactez nos équipes via notre section <a href='http://zwa.2nd-itinet.fr/view/main_views/contact.php' class='hyperlink'>assistance</a>. </p>
                                    <table style='background-color:#f2f2f2;margin-top:-45px;'>
                                        <th>
                                        <td style='padding-left: 23px;padding-bottom: 20px;'>
                                            <a href='http://zwa.2nd-itinet.fr/controller/connect.php' target='_blank' class='article'><h3 class='underline'>Interface de connexion</a>
                                        </td>
                                        </th>
                                    </table>
                                    </div>
                                </table>
                                


                                <table role='presentation' border='0' cellspacing='0' cellpadding='0' class='body_bottom'>
                                <tr>
                                <td>
                                    <table role='presentation' border='0' cellspacing='0' cellpadding='0'>
                                    <tr>
                                        <td>
                                        <img src='http://zwa.2nd-itinet.fr/images/bank/en01_bis.jfif' class='hero_image' />
                                        </td>
                                    </tr>
                                    </table>
                                    <table role='presentation' border='0' cellspacing='0' cellpadding='0' class='social'>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>FIND US ON</td><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr class='social_icon'>
                                        <td>
                                        <a href='https://www.facebook.com/'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/373860/FB.png'/></a>
                                        </td>
                                        <td>
                                        <a href='https://www.instagram.com/'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/373860/IG-B.png'/></a>
                                        </td>
                                        <td>
                                        <a href='https://www.twitter.com/'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/373860/TW-B.png'/></a>
                                        </td>
                                    </tr>
                                    </table>
                                </td>
                                </tr>
                            </table>


                            <table role='presentation' border='0' cellspacing='0' cellpadding='0' class='offer'>
                            <tr>
                                <td>
                                <table role='presentation' border='0' cellspacing='0' cellpadding='0' class='btn'>
                                    <tr>
                                    <td>
                                        <table role='presentation' border='0' cellspacing='0' cellpadding='0'>
                                        <tbody>
                                            <tr>
                                            <td>
                                                <a href='http://zwa.2nd-itinet.fr' target='_blank'>ZWatcher</a>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </td>
                                    </tr>
                                </table>
                                </td>
                            </tr>
                        </table>
                        <table role='presentation' border='0' cellspacing='0' cellpadding='0' class='footer'>
                            <tr>
                                <a href='http://zwa.2nd-itinet.fr' target='_blank' class='main_logo'><img src='http://zwa.2nd-itinet.fr/images/graphismes/logo_normal_bis.png' class='main_logo'/></a>
                                <p>ZWatcher by ZTeam</p>
                            </tr>
                        </table>
                            <table role='presentation' border='0' cellspacing='0' cellpadding='0' class='footer'>
                                <tr>
                                <td>
                                    <div class='footer_content'>
                                    <p>ZWatcher by ZTeam - Tous droits réservés - All Rights Reserved.<br>
                                    Ceci est un message automatique. Merci de ne pas y répondre.
                                    Aucune réponse directe<br> à ce message ne sera prise en compte.
                                    Pour nous contacter, utilisez la section d' <a href='http://zwa.2nd-itinet.fr/view/main_views/contact.php' style='text-decoration: none color: black'>assistance</a> prévue à cet effet.
                                    <br> Toute utilisation de ce message non conforme à sa destination, sa diffusion ou publication<br> est interdite sauf autorisation expresse.
                                    
                                    
                                    <br>ZWatcher &copy; 2021</p>
                                        
                                    </div>
                                </td>
                                </tr>
                            </table>
                                </tr>
                            </td>
                            </table>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            </body>
        </html>";

            $headers = 'From: "ZWatcher"<noreply@zwatcher.com>' . "\r\n" .
            'Reply-To: noreply@zwatcher.com' . "\r\n" .
            $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n".
            'X-Mailer: PHP/' . phpversion();

           // mail($to, $subject, $message, $headers);

            //End mail


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
            }
        }
        $i++;
    }
}

function add_user_link() {
    foreach ($_POST['id_user'] as $key => $value) { 
        $i = $key;
    }
    foreach ($_POST['id_user'] as $key => $value) {
        if(isset($_POST['scales'][$i])) {
            if($_POST['scales'][$i] == "on") {
               insert_user_link($_POST['id_user'][$i], $_POST['id_user_listes'][$i]);
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
