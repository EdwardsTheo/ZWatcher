<?php

session_start();
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>ZWatcher</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script src="https://kit.fontawesome.com/44bec37701.js"></script>
	</head>
	<body>

		<!-- Header -->
			<header id="header" class="alt">
				<div class="logo"><a href="index.php">ZWatcher<span> by ZTeam</span></a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.php">Accueil</a></li>
					<li><a href="./view/main_views/presentation.php">Présentation</a></li>
					<li><a href="./view/main_views/zteam.php">Notre équipe</a></li>
					<li><a href="./view/main_views/contact.php">Contact</a></li>
					<?php
					if(isset($_SESSION['username'])){
						echo"<li><a href='./view/profil.php'><i class='fa fa-user fa-fw'></i> Profil</li>";
					}else{
						echo"<li><a href='./controller/connect.php'><i class='fas fa-address-card'></i> Se connecter</li>";
					}
					?>
				</ul>
			</nav>

		<!-- Banner -->
			<section class="banner full">
				<article>
					<img src="images/bank/an04.jfif" alt="" />
					<div class="inner">
						<header>
							<a href="index.php"></a>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="demo/demo_log_in.png"  alt="" />
					<div class="inner">
						<header>
							<p><a href="./view/main_views/presentation.php">Gestionnaire d'administration à distance</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="demo/demo_parc.png"  alt="" />
					<div class="inner">
						<header>
							<p><a href="./view/main_views/presentation.php">Suivi d'un parc d'équipements LINUX</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="demo/modif2.png"  alt="" />
					<div class="inner">
						<header>
							<p><a href="./view/main_views/presentation.php">Modifications à distance</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="demo/appli1.png"  alt="" />
					<div class="inner">
						<header>
							<p><a href="./view/main_views/presentation.php">Gestionnaire d'applications</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="demo/log.png"  alt="" />
					<div class="inner">
						<header>
							<p><a href="./view/main_views/presentation.php">Tracing des activités</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="demo/demo_message.png"  alt="" />
					<div class="inner">
						<header>
							<p><a href="./view/main_views/presentation.php">Interface sociale incorporée</a></p>
							<h2>ZWatcher</h2>
						</header>
					</div>
				</article>

			</section>

		<!-- One -->
			<section id="one" class="wrapper style2">
				<div class="inner">
					<div class="grid-style">
						<div>
							<div class="box">
								<div class="image fit">
									<img src="demo/home_menu_demo.png" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>Qui sommes-nous ?</p>
										<h2>Notre équipe</h2>
									</header>
									<p>Nous sommes deux étudiants, Thomas et Baptiste, en Bac+2 d'informatique en parcours Systèmes et Réseaux. Ce projet vise à mettre en application nos connaissances 
									théoriques sur les interpréteurs de commandes, la gestion de machines à distance, les interfaces web, les connexions sécurisées au niveau machines 
									et interfaces, et notre bagage sur le réseau en général.</p>
									<footer class="align-center">
										<a href="./view/main_views/zteam.php" class="button alt">Découvrir</a>
									</footer>
								</div>
							</div>
						</div>

						<div>
							<div class="box">
								<div class="image fit">
									<img src="demo/demo_accueil.png" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>Gestionnaire d'administration à distance</p>
										<h2>L'outil ZWatcher</h2>
									</header>
									<p> Notre outil, intitulé ZWatcher, doit répondre à un besoin qui est l'impossibilité de pouvoir administrer à distance un parc d'équipements. 
									L'administrateur veut ainsi effacer des contraintes pratiques de temps, de logistique, de sécurité, ou encore d'efficacité. Il doit pouvoir à distance 
									via l'outil effectuer l'intégralité du travail qu'il faisait directement au contact des machines.</p>
									<footer class="align-center">
										<a href="./view/main_views/presentation.php" class="button alt">Découvrir</a>
									</footer>
								</div>
							</div>
						</div>

						<div>
							<div class="box">
								<div class="image fit">
									<img src="demo/demo_parc.png" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>Suivi d'un parc d'équipements LINUX</p>
										<h2>Administrer</h2>
									</header>
									<p> A travers l'outil, l'administrateur doit pouvoir effectuer diverses tâches nécessaires au bon suivi d'un parc d'équipements. En particulier, 
									il veut pouvoir modifier directement des informations système, gérer des applications à distance, que ce soit leur installation ou leur gestion dans 
									le temps, ou encore suivre l'activité des utilisateurs sur l'ensemble du parc. Il peut gérer les écosystèmes utilisateurs et groupes, en faisant 
									le lien avec la plateforme, notamment via la création de clés RSA.</p>
									<footer class="align-center">
										<a href="./view/main_views/presentation.php" class="button alt">Découvrir</a>
									</footer>
								</div>
							</div>
						</div>

						<div>
							<div class="box">
								<div class="image fit">
									<img src="demo/modif2.png" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>Modifications à distance</p>
										<h2>Remanier</h2>
									</header>
									<p>A travers une première interface de modifications, l'administrateur doit être capable de gérer facilement et rapidement à distance diverses 
									informations système, comme les noms des machines, leur adresse IP ou adresse MAC entre autres. Il peut également être amené à modifier d'autres 
									informations nécessaires à l'administration de son parc. Il peut remanier l'intégralité de l'écosystème d'une machine avec ses groupes, utilisateurs, 
									ou encore accès.	</p>
									<footer class="align-center">
										<a href="./view/main_views/presentation.php" class="button alt">Découvrir</a>
									</footer>
								</div>
							</div>
						</div>
						<div>
							<div class="box">
								<div class="image fit">
									<img src="demo/appli1.png" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>Gestionnaire d'applications</p>
										<h2>Gérer</h2>
									</header>
									<p>Une gestion complète des applications des diverses machines administrables est possible. Il est alors possible d'installer, de mettre à jour, ou encore 
									de supprimer des applications à distance. L'administrateur aura accès à un écosystème d'applications configurables en quelques clics, et adaptable au cas par cas. 
									</p>
									<footer class="align-center">
										<a href="./view/main_views/presentation.php" class="button alt">Découvrir</a>
									</footer>
								</div>
							</div>
						</div>
						<div>
							<div class="box">
								<div class="image fit">
									<img src="demo/log.png" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>Tracing des activités</p>
										<h2>Suivre</h2>
									</header>
									<p>L'administrateur pourra suivre les activités des utilisateurs au sein de son parc de machines, et récupérer directement sur son équipement l'historique des 
									évênements de manière intuitive et accessible en quelques clics. Il pourra garder une vue d'ensemble et un journal sur les actions volontaires ou non des utilisateurs.</p>
									<footer class="align-center">
										<a href="./view/main_views/presentation.php" class="button alt">Découvrir</a>
									</footer>
								</div>
							</div>
						</div><div>
							<div class="box">
								<div class="image fit">
									<img src="demo/demo_message.png" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>Interface sociale incorporée</p>
										<h2>Intéragir</h2>
									</header>
									<p>Une interface sociale incorporée permet aux différents membres, utilisateurs ou administrateurs, d'intéragir et d'échanger directement. Une liste de 
									contacts permet d'enregistrer ses interlocuteurs, puis d'échanger avec eux au sein d'une interface de messagerie.</p>
									<footer class="align-center">
										<a href="./view/main_views/presentation.php" class="button alt">Découvrir</a>
									</footer>
								</div>
							</div>
						</div>
						<div>
							<div class="box">
								<div class="image fit">
									<img src="demo/contact.png" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>Comment nous joindre ?</p>
										<h2>Contact</h2>
									</header>
									<p>Si vous souhaitez nous joindre, vous pourrez accéder aux informations liées au contact dans la page suivante. Cliquer sur le bouton ci-dessous 
									pour y accéder. Pour nous joindre sur un sujet directement lié à l'utilisation de l'outil, utilisez l'aide directe de l'outil.</p>
									<footer class="align-center">
										<a href="./view/main_views/contact.php" class="button alt">Découvrir</a>
									</footer>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>ZWatcher veille. L'ensemble des connexions, à notre interface ou aux machines administrables, est sécurisé. Vos informations sont chiffrées et ne sont transmises à aucun tiers. </p>
						<h2>Connexions sécurisées</h2>
					</header>
				</div>
			</section>

		<!-- Three -->
			<section id="three" class="wrapper style2">
				<div class="inner">
					<header class="align-center">
						<p class="special">De nombreux paramètres de personnalisation sont disponibles : adaptez l'outil à votre utilisation.</p>
						<h2>Personnalisez votre expérience</h2>
					</header>
					<div class="gallery">
						<div>
							<div class="image fit">
<!-- afficher l'image dans un nouvel onglet
								<a href="images/slide01.jpg" target="_blank"><img src="images/slide01.jpg" alt="" /></a>
-->								<a href="./view/main_views/presentation.php"><img src="./demo/demo_log_in.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/demo_accueil.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/demo_compte.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/demo_contacts.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/demo_message.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/demo_parc.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/demo_create_machine.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/demo_equipe.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/demo_equipe_info.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/demo_equipe_create.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/demo_utilisateurs.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/modif1.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/modif2.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/appli1.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/appli2.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/log.png" alt="" /></a>
							</div>
						</div>
						<div>	
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/console1.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="./view/main_views/presentation.php"><img src="./demo/console2.png" alt="" /></a>
							</div>
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
				<a href="./view/main_views/contact.php">Assistance</a>
				<a href="./view/main_views/zteam.php">Qui sommes-nous ?</a>
				<a href="./view/main_views/contact.php">Nous contacter</a>
				<div class="brand">
					<img src="./images/graphismes/logo.png"/>
				</div>
				<div class="copyright">
					&copy; ZWatcher 2021. Tous droits réservés - All rights reserved.
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>

</html>
