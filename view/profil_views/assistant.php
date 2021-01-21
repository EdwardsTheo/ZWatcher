<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Mon assistant</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=assistant"><button class="w3-button w3-black"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="#"><button class="w3-button w3-white"><i class="fas fa-folder-open w3-margin-right"></i>Afficher</button></a>
                    <a href="#"><button class="w3-button w3-white"><i class="fas fa-folder-plus w3-margin-right"></i>Créer</button></a>
                    <a href="#"><button class="w3-button w3-white"><i class="fas fa-folder-minus w3-margin-right"></i>Supprimer</button></a>
                    <a href="#"><button class="w3-button w3-white"><i class="fas fa-pen w3-margin-right"></i>Modifier</button></a>
                    <a href="#"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Paramètres</button></a>
                    </div>
                    </div>
                    </div>
                </header>

                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <div id="centre">
                <h4><b>Accueil</b></h4>
                Bienvenue <?php echo htmlspecialchars(htmlspecialchars($_SESSION['username'])) ?> dans la partie Assistance.
                <p>En cours de construction ...
                </div>
                </div>
    </html>