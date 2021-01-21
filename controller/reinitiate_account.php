<?php

//send mail to user to reinitiate password

    session_start();

    require('../model/config.php');
    require('../model/select.php');
    require('../model/insert.php');
    require('../model/update.php');

    $user = $_POST['user'];
    $mail = $_POST['mail'];

    $req = fetch_ids();
    $reset = false;

    $errors = "";

    while ($donnees = $req->fetch()){
        if($donnees['username'] == $user && $donnees['mail'] == $mail){
            $reset = true;

            function randomNumber($length) {
                $result = '';
                for($i = 0; $i < $length; $i++) {
                    $result .= mt_rand(0, 9);
                }
                return $result;
            }

            $code = randomNumber(8);
            $options = array('cost' => 11);
            $hashed_code = password_hash($code, PASSWORD_BCRYPT, $options);
            $exp_format = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
            $exp_date = date("Y-m-d H:i:s",$exp_format);
            update_code($user, $hashed_code, $exp_date);
            
            $hash = $donnees['password'];

            //récupérer le mail de l'user

            // Important ! empecher les doublons de pseudos

            $to      = $mail;
            $subject = 'Réinitialisation de votre mot de passe';

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
                                    <h1>Réinitialisation de votre mot de passe</h1>
                                    <p> Vous avez effectué une demande pour réinitialiser votre mot de passe.</p>
                                    <p>Cliquez sur le lien ci-dessous pour compléter votre démarche :</p>

                                    <p><a href='http://zwa.2nd-itinet.fr/controller/redem_init.php?user=$user&hash=$hash&code=$hashed_code' target='_blank' class='article'><h3 class='underline'>Réinitialiser mon mot de passe</a>    </p>
                                    <!--<p><a href='http://etudes:8080/ZWatcher/controller/redem_init.php?user=$user&hash=$hash&code=$hashed_code' target='_blank' class='article'><h3 class='underline'>Réinitialiser mon mot de passe</a>    </p>
                                    -->
                                    <p>Munissez-vous du code suivant : $code </p>
                                    <p>Ce code et ce lien ne sont valables que pour une durée de 24h pour des raisons de sécurité. </p>
                                    <p> Si vous n'êtes pas à l'origine de cette action, nous vous conseillons de sécuriser votre compte en actualisant votre mot de passe.</p>
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

            mail($to, $subject, $message, $headers);

            //$errors = "Un message a été envoyé sur votre adresse email pour réinitialiser votre mot de passe.";
            
            header('location: ../view/forgot_confirm.php');
        }
    }

    if($reset == false){
        $errors = "Ces informations ne correspondent à aucun compte";
        require('../view/forgotten_view.php');
    }

?>