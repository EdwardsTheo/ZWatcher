<?php

session_start();

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>ZWatcher</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../../assets/css/main.css" />
		<script src="https://kit.fontawesome.com/44bec37701.js"></script>
	</head>
	<body>

		<!-- Header -->
			<header id="header" class="alt">
				<div class="logo"><a href="../../index.php">ZWatcher<span> by ZTeam</span></a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="../../index.php">Accueil</a></li>
					<li><a href="../../view/main_views/presentation.php">Présentation</a></li>
					<li><a href="../../view/main_views/zteam.php">Notre équipe</a></li>
					<li><a href="../../view/main_views/contact.php">Contact</a></li>
					<?php
					if(isset($_SESSION['username'])){
						echo"<li><a href='../../view/profil.php'><i class='fa fa-user fa-fw'></i> Profil</li>";
					}else{
						echo"<li><a href='../../controller/connect.php'><i class='fas fa-address-card'></i> Se connecter</li>";
					}
					?>
				</ul>
			</nav>

		<!-- Banner -->
		<section class="banner full">
				<article>
					<img src="../../images/bank/an04.jfif" alt="" />
					<div class="inner">
						<header>
							<a href="../../index.php"></a>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="../../demo/demo_log_in.png"  alt="" />
					<div class="inner">
						<header>
							<p><a href="../../view/main_views/presentation.php">Gestionnaire d'administration à distance</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="../../demo/demo_parc.png"  alt="" />
					<div class="inner">
						<header>
							<p><a href="../../view/main_views/presentation.php">Suivi d'un parc d'équipements LINUX</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="../../demo/modif2.png"  alt="" />
					<div class="inner">
						<header>
							<p><a href="../../view/main_views/presentation.php">Modifications à distance</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="../../demo/appli1.png"  alt="" />
					<div class="inner">
						<header>
							<p><a href="../../view/main_views/presentation.php">Gestionnaire d'applications</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="../../demo/log.png"  alt="" />
					<div class="inner">
						<header>
							<p><a href="../../view/main_views/presentation.php">Tracing des activités</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="../../demo/demo_message.png"  alt="" />
					<div class="inner">
						<header>
							<p><a href="../../view/main_views/presentation.php">Interface sociale incorporée</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>

			</section>


				<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>Qui sommes-nous ? </p>
						<h2>ZTeam</h2>
					</header>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style2">
				<div class="inner">
					<div class="box">
						<div class="content">
							<header class="align-center">
								<p>A propos</p>
								<h2>Notre équipe</h2>
							</header>

							<p>Nous sommes deux étudiants, Thomas et Baptiste, en 2e année au sein d'un cursus BAC+5 en Ingéniérie des Systèmes et Réseaux.</p>

							<p>Retrouvez nous sur nos réseaux : en construction ...</p>

						</div>
					</div>	
					
				</div>
			</section>


		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="https://twitter.com" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="https://www.facebook.com" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="https://www.instagram.com" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="https://www.google.com/gmail/about" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					</ul>
				</div>
				<a href="../../view/main_views/contact.php">Assistance</a>
				<a href="../../view/main_views/zteam.php">Qui sommes-nous ?</a>
				<a href="../../view/main_views/contact.php">Nous contacter</a>
				<div class="brand">
					<img src="../../images/graphismes/logo.png"/>
				</div>
				<div class="copyright">
					&copy; ZWatcher 2020. Tous droits réservés - All rights reserved.
				</div>
			</footer>

		<!-- Scripts -->
			<script src="../../assets/js/jquery.min.js"></script>
			<script src="../../assets/js/jquery.scrollex.min.js"></script>
			<script src="../../assets/js/skel.min.js"></script>
			<script src="../../assets/js/util.js"></script>
			<script src="../../assets/js/main.js"></script>

	</body>
</html>