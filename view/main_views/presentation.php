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
					<img src="../../images/slide03.jpg"  alt="" />
					<div class="inner">
						<header>
							<p><a href="../../view/main_views/presentation.php">Gestionnaire d'administration à distance</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="../../images/slide04.jpg"  alt="" />
					<div class="inner">
						<header>
							<p><a href="../../view/main_views/presentation.php">Suivi d'un parc d'équipements LINUX</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="../../images/slide05.jpg"  alt="" />
					<div class="inner">
						<header>
							<p><a href="../../view/main_views/presentation.php">Modifications à distance</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="../../images/slide06.jpg"  alt="" />
					<div class="inner">
						<header>
							<p><a href="../../view/main_views/presentation.php">Gestionnaire d'applications</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="../../images/slide07.jpg"  alt="" />
					<div class="inner">
						<header>
							<p><a href="../../view/main_views/presentation.php">Tracing des activités</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="../../images/slide09.jfif"  alt="" />
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
						<p>A propos de l'outil</p>
						<h2>ZWatcher</h2>
					</header>
				</div>
			</section>

		<!-- Main -->
		<div id="main" class="container">

	<!-- Elements -->
	<div class="row 200%">
		<div class="6u 12u$(medium)">

			<!-- Text stuff 1-->
				<h2>Gestionnaire d'administration</h2>
				<p>Notre outil, intitulé ZWatcher, doit répondre à un besoin qui est l'impossibilité de pouvoir administrer à distance un parc d'équipements. L'administrateur veut ainsi effacer des contraintes pratiques de temps, de logistique, de sécurité, ou encore d'efficacité. 
				Il doit pouvoir à distance via l'outil effectuer l'intégralité du travail qu'il faisait directement au contact des machines.</p>
				<hr />

				<div class="row">
					<div class="6u 12u$(small)">
						<h4>Caractéristiques</h4>
							<ul>
								<li>Gestionnaire de parc d'équipements LINUX</li>
								<li>Suivi, modifications, administration, gestion</li>
								<li>Connexions sécurisées</li>
							</ul>
					</div>
				</div>
				
				<hr />

			<!-- Text stuff 2-->
			<h2>Suivi d'un parc d'équipements</h2>
				<p>A travers l'outil, l'administrateur doit pouvoir effectuer diverses tâches nécessaires au bon suivi d'un parc d'équipements. En particulier, il veut pouvoir modifier directement des informations système, gérer des applications à distance, que 
				ce soit leur installation ou leur gestion dans le temps, ou encore suivre l'activité des utilisateurs sur l'ensemble du parc.</p>
				<hr />

				<div class="row">
					<div class="6u 12u$(small)">
						<h4>Besoins</h4>
							<ul>
								<li>Gérer des machines à distance</li>
								<li>Conserver toutes les fonctionnalités qui peuvent être réalisées en présentiel</li>
								<li>Avoir accès à une interface intuitive et sécurisée</li>
							</ul>
					</div>
				</div>

				<hr />

				
			<!-- Text stuff 3-->
			<h2>Modifications à distance</h2>
				<p>A travers une première interface de modifications, l'administrateur doit être capable de gérer facilement et rapidement à distance diverses informations système, comme les noms des machines, leur adresse IP ou adresse MAC entre autres. 
				Il peut également être amené à modifier d'autres informations nécessaires à l'administration de son parc.</p>
				<hr />

				<div class="row">
					<div class="6u 12u$(small)">
						<h4>Paramètres concernés</h4>
							<ul>
								<li>Hostnames</li>
								<li>Adresses IP ou MAC</li>
								<li>Diverses modifications additionnelles</li>
							</ul>
					</div>
				</div>

				<hr />

				<!-- Text stuff 4-->
			<h2>Gestionnaire d'applications</h2>
				<p>Une gestion complète des applications des diverses machines administrables est possible. Il est alors possible d'installer, de mettre à jour, ou encore de supprimer des applications à distance. 
				L'administrateur aura accès à un écosystème d'applications configurables en quelques clics, et adaptable au cas par cas.</p>
				<hr />

				<div class="row">
					<div class="6u 12u$(small)">
						<h4>Actions possibles</h4>
							<ul>
								<li>Acccéder à des listes pré-établies</li>
								<li>Installer</li>
								<li>Mettre à jour</li>
								<li>Gérer, désinstaller ...</li>
							</ul>
					</div>
				</div>

				<hr />

				<!-- Text stuff 5-->
			<h2>Tracing des activités</h2>
				<p>L'administrateur pourra suivre les activités des utilisateurs au sein de son parc de machines, et récupérer directement sur son équipement l'historique des évênements de manière intuitive et 
				accessible en quelques clics. Il pourra garder une vue d'ensemble et un journal sur les actions volontaires ou non des utilisateurs.</p>
				<hr />

				<div class="row">
					<div class="6u 12u$(small)">
						<h4>Suivi possible</h4>
							<ul>
								<li>Journal d'évênements</li>
								<li>Traçage des actions administrateur</li>
								<li>Téléchargement direct des fichiers de logs</li>
							</ul>
					</div>
				</div>

				<hr />

				<!-- Text stuff 6-->
			<h2>Interface sociale</h2>
				<p>Une interface sociale incorporée permet aux différents membres, utilisateurs ou administrateurs, d'intéragir et d'échanger directement. 
				Une liste de contacts permet d'enregistrer ses interlocuteurs, puis d'échanger avec eux au sein d'une interface de messagerie.</p>
				<hr />

				<div class="row">
					<div class="6u 12u$(small)">
						<h4>Intéractions possibles</h4>
							<ul>
								<li>Gestion de listes de contacts</li>
								<li>Messagerie directe</li>
								<li>Gestionnaire de parc de machines et d'utilisateurs</li>
							</ul>
					</div>
				</div>

				<hr />

		</div>
		<div class="6u$ 12u$(medium)">

			<!-- Image -->
				<h2>Image 1</h2>

				<span class="image fit"><img src="../../images/listes/l25.jfif" alt="" /></span>
				<hr />

			<!-- Image -->
				<h2>Image 2</h2>

				<span class="image fit"><img src="../../images/listes/l25.jfif" alt="" /></span>
				<hr />

			<!-- Image -->
				<h2>Image 3</h2>

				<span class="image fit"><img src="../../images/listes/l25.jfif" alt="" /></span>
				<hr />

			<!-- Image -->
				<h2>Image 4</h2>

				<span class="image fit"><img src="../../images/listes/l25.jfif" alt="" /></span>
				<hr />

			<!-- Image -->
				<h2>Image 5</h2>

				<span class="image fit"><img src="../../images/listes/l25.jfif" alt="" /></span>
				<hr />

			<!-- Image -->
				<h2>Image 6</h2>

				<span class="image fit"><img src="../../images/listes/l25.jfif" alt="" /></span>
				<hr />
				
		</div>
	</div>

</div>


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
				<a href="../../view/main_views/contact_us.php">Nous contacter</a>
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