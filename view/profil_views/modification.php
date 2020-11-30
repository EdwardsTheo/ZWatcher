<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Modifications</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=modification"><button class="w3-button w3-black"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=modif_liste"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="?action=modif_machine"><button class="w3-button w3-white"><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="#"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Paramètres</button></a>
                    </div>
                    </div>
                    </div>
                </header>

                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <div id="centre">
                <h4><b>Accueil</b></h4>
                Bienvenue <?php echo htmlspecialchars(htmlspecialchars($_SESSION['username'])) ?> dans la section Modifications.
                <p>Sélectionnez une machine de votre parc et modifiez ses informations système à l'aide des sous-menus correspondants.
                <hr class="w3-opacity">
                <form action="?action=modif_liste" method = "POST">
                <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Commencer</button>
                </form>
                </div>
                </div>
    </html>