<?php

//session_start();

?>

<!DOCTYPE HTML>
<html>
    <head>
		    <title>ZWatcher</title>
		    <meta charset="utf-8" />
        <link rel="stylesheet" href="../assets/css/connect_view.css" />
        <script src="https://kit.fontawesome.com/44bec37701.js"></script>
	  </head>
	  <body>

        <div class="brand">
            <img src="../images/graphismes/logo_transparent_centre.png"/>
            </a>
        </div>

        <div class="login">
            <div class="login_title">
                <span>Connectez-vous à votre compte</span>
                <div class="errors">
                    <?php echo "$errors"; ?>
                </div>
            </div>
            <div class="login_fields">
                <form action = "../controller/login.php" method = "POST">
                <div class="login_fields__user">
                    <div class="icon">
                        <i class="far fa-user"></i>
                    </div>
                    <input placeholder="Nom d'utilisateur" type="text" name="user">
                        <div class="validation">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/tick.png"/>
                        </div>
                    </input>
                </div>
                <div class="login_fields__password">
                    <div class="icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input placeholder="Mot de passe" type="password" name = "password">
                    </input>
                    <div class="validation">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/tick.png"/>
                    </div>
                </div>
                <div class="login_fields__submit">
                    <input type="submit" value="Connexion">
                    </input>
                </div>
                </form>
                <form action = "../index.php" method = "POST">
                <div class="login_fields__submit2">
                    <input type="submit" value="Retour au site">
                    </input>
                    </form>
                    <div class="forgot">
                        <a href="./forgotten.php">Mot de passe oublié ?</a>
                    </div>
                </div>
            </div>

            <div class="disclaimer">
                <center>ZWatcher 2020-2021. </center> </br>
                <center>Tous droits réservés - All rights reserved. </center>
            </div>
        </div>
    </body>
</html>
