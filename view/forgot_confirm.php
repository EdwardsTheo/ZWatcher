<?php

session_start();

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
    <span>Un message a été envoyé sur votre adresse email pour réinitialiser votre mot de passe.</span>
  </div>
  <div class="login_fields">
    <form action = "../controller/connect.php" method = "POST">
    <div class="login_fields__submit2">
      <input type="submit" value="Retour connexion"></input>
      </form>
      <div class="forgot">
        <a href="../view/main_views/contact.php">Section assistance</a>
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
