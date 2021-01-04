<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Mon profil</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=compte"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=infos"><button class="w3-button w3-black"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="?action=status"><button class="w3-button w3-white"><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="?action=parameters"><button class="w3-button w3-white"><i class="fas fa-tools w3-margin-right"></i>Paramètres</button></a>
                    <a href="?action=graphismes"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-paint-brush w3-margin-right"></i>Graphismes</button></a>
                    </div>
                    </div>
                    </div>    
                </header>

<!-- encode nécessaire quand modif faite a la main dans la bdd -->

                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <div id="centre">
                <h4><b>Vos informations</b></h4>
                Votre pseudo : <?php echo htmlspecialchars(htmlspecialchars($_SESSION['username']))?> </br>
                Votre mail : <?php echo htmlspecialchars(htmlspecialchars($_SESSION['mail']))?> </br>
                Votre statut : <?php echo htmlspecialchars(htmlspecialchars($_SESSION['displayer']))?>
                </div>
                </div>

                <?php
                    if($_SESSION['power'] == 'utilisateur') {
                        // EQUIPES 
                        // UTILISATEUR SUR UNE MACHINE ?
                        // SI OUI => CLE RSA ?
                    }
                ?>
    </html>