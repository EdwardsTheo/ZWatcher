<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Mon parc</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=listes"><button class="w3-button w3-black"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=display_listes"><button class="w3-button w3-white"><i class="fas fa-book-open w3-margin-right"></i>Affichage</button></a>
                    <a href="?action=create_liste"><button class="w3-button w3-white"><i class="fas fa-plus w3-margin-right"></i>Création</button></a>
                    <a href="?action=delete_liste"><button class="w3-button w3-white"><i class="fas fa-minus w3-margin-right"></i>Suppression</button></a>
                    <a href="?action=edit_liste"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-pen w3-margin-right"></i>Modifier</button></a>
                    </div>
                    </div>
                    </div>
                </header>

                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <div id="centre">
                <h4><b>Accueil</b></h4>

                Bienvenue <?php echo htmlspecialchars(htmlspecialchars($_SESSION['username'])) ?> dans le système de gestion de votre parc d'équipements.
                <p>Visualisez, ajoutez, modifiez, supprimez et configurez votre parc à l'aide des sous-menus correspondants. 
                </br></br>Attention, les modifications sont uniquement des modifications 
                sur notre base de données propre à l'outil ZWatcher. Pour modifier les informations système de votre machine, rendez-vous dans la section <a href="?action=modification">Modification</a>.
        
                </div>
                </div>
    </html>