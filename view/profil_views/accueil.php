<!DOCTYPE html>
<html>
    <div id="haut">
    <h1><b>Accueil</b></h1>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
        if($_SESSION['graph'] == "normal"){
            echo"<link rel='stylesheet' href='../assets/css/accueil.css'>";
        }else if($_SESSION['graph'] == "dark"){
            echo"<link rel='stylesheet' href='../assets/css/accueil_dark.css'>";
        }else if($_SESSION['graph'] == "ocean"){
            echo"<link rel='stylesheet' href='../assets/css/accueil_ocean.css'>";
        }
    ?>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=accueil"><button class="w3-button w3-black"><i class="fas fa-address-book w3-margin-right"></i>Accueil</button></a>
                    </div>
                    </div>
                    </div>
                </header>

                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <div id="centre">

                <div id="left-box">
                <h4><b>Accueil</b></h4>
                Bienvenue sur ZWatcher <?php echo htmlspecialchars(htmlspecialchars($_SESSION['username'])) ?>.

                <?php
                    if($_SESSION['power'] == "admin"){

                ?>
                <p>Administrez et gérez vos équipes et vos environnements informatiques de manière sécurisée et intuitive. Naviguez et opérez à l'aide des menus suivants :

                <ul>
					<li>Accueil : gardez une vue d'ensemble sur vos équipes et vos environnements et retrouvez l'arborescence détaillée de l'outil</li></p>
					<li>Mon compte : modifiez vos informations personnelles et personnalisez votre expérience utilisateur</li></p>
					<li>Mes contacts : créez et gérez votre liste d'interlocuteurs, personnalisable</li></p>
                    <li>Messagerie : dialoguez directement avec d'autres utilisateurs de la plateforme grâce à cette interface incorporée</li></p>
                    <li>Mon parc : visualisez votre parc d'équipements, personnalisez et configurez les éléments qui le composent</li></p>
                    <li>Modification : modifiez des informations système sur l'un des équipements de votre parc</li></p>
                    <li>Applications : configurez, installez, gérez voire supprimez des applications sur l'ensemble de votre parc</li></p>
                    <li>Observation : surveillez l'activité de vos équipements, et téléchargez des fichiers de logs</li></p>
                    <li>Assistant : bénéficiez de l'aide directe de notre assistant qui vous répondra en temps réel à vos demandes (en cours de construction ...).</li>
				</ul>

                <?php
                }else{
                ?>
                <p>Gardez le contact avec vos équipes et votre administrateur système. Naviguez et opérez à l'aide des menus suivants :
                <ul>
					<li>Accueil : gardez une vue d'ensemble sur vos équipes et vos environnements et retrouvez l'arborescence détaillée de l'outil</li></p>
					<li>Mon compte : modifiez vos informations personnelles et personnalisez votre expérience utilisateur</li></p>
					<li>Mes contacts : créez et gérez votre liste d'interlocuteurs, personnalisable</li></p>
                    <li>Messagerie : dialoguez directement avec d'autres utilisateurs de la plateforme grâce à cette interface incorporée</li></p>
                    <li>Mon parc, Modification, Applications et Observation : cette interface de gestion n'est accessible qu'aux administrateurs</li></p>
                    <li>Assistant : bénéficiez de l'aide directe de notre assistant qui vous répondra en temps réel à vos demandes (en cours de construction ...).</li>
				</ul>
                <?php
                }
                ?>


                </p>
            </div>
            <div id="ctn">
            <div id="attach">
            <section class="discussionsscr">
                        <div class="discussion search">
                            <div class="searchbar">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <form action="#" method = "POST"><input type="text" placeholder="Rechercher ..."></input></form>
                            </div>
                        </div>
            </section>
            <section class="contacts">
                <div class='contact message-active'>
                    <div class='photo2' style='background-image: url(../images/bank/en01_bis.jfif);'>
                    </div>
                    <div class='desc-ct'>
                        <p class='name'> Vos équipes </p>
                        <p class='message'>  </p>
                    </div>
                </div>
            </section>
            <section class='contacts'>
                <div class='contact message-active'>
                    <div class='photo2' style='background-image: url(../images/bank/an04.jfif);'>
                    </div>
                    <div class='desc-ct'>
                        <p class='name'> Vos environnements </p>
                        <p class='message'>  </p>
                    </div>
                </div>
            </section>
            </div>
            <div id="contact-list">
            
            <?php
            while($data = $req2->fetch()){
                echo"<section class='contacts'>
                    <div class='contact message-active'>";

                    $tmp_id_img = $data[1];
                    $req_img = get_image_user($tmp_id_img);
                    $data_img = $req_img->fetch();
                    $img_url = $data_img[0];
                    if($img_url == "none"){
                        echo "<div class='photo' style='background-image: url(../images/graphismes/avatar.png);'>";
                    }else{
                        echo "<div class='photo' style='background-image: url(../images/uploads/$img_url);'>";
                    }

                    if($data[4] == "connecte"){
                        echo "<div class='online'></div></div>";
                    }else if($data[4] == "occupe"){
                        echo "<div class='offline'></div></div>";
                    }else{
                        echo "</div>";
                    }
                    echo"<div class='desc-ct'>
                            <p class='name'> $data[0] </p>
                            <p class='message'> $data[2] </p>
                        </div>
                    </div>
                </section>";
            }
            ?>
            </div>
            </div>

            </div>
            </div>
 
</html>