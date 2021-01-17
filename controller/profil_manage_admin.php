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
            $output = main_ssh($_SESSION['id_machine'], 'cat_rsa_key', $_POST['old_username'][$i]);
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
            $output = main_ssh($_SESSION['id_machine'], 'cat_rsa_key', $_POST['old_username'][$i], 'id_rsa.pem');
            file_put_contents("../rsa_admin/id_rsa.pem", $output);
                
            $output = main_ssh($_SESSION['id_machine'], 'cat_rsa_key', $_POST['old_username'][$i], 'id_rsa.pub');
            file_put_contents("../rsa_admin/id_rsa.pub", $output);

            // Change the right so the website can read the file
            shell_exec('sudo chown www-data:www-data ../rsa_admin/id_rsa.pem');
            shell_exec('sudo chown www-data:www-data ../rsa_admin/id_rsa.pub');

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
            unlink("../rsa_admin/id_rsa.pub");
            unlink("../rsa_admin/id_rsa.pem");

            //Put the status back to 0 
            $rsa = 0;
            update_admin_rsa($_SESSION['id_machine'], $rsa);
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
}

function desactivate_rsa_login() {
    $connect = 0;
    main_ssh($_SESSION['id_machine'], 'desactiver rsa login');
    main_ssh($_SESSION['id_machine'], 'restart ssh');
    update_admin_connect($_SESSION['id_machine'], $connect);
    
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

header('location: ../view/profil.php?action=modif_admin_listes'); // redirect to the main app page with a message of confirmation 

?>
