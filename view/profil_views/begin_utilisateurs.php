<!DOCTYPE HTML>
<html>
    <div id="haut">
    <h1><b>Utilisateurs</b></h1>
                <div class="w3-section w3-bottombar w3-padding-16">
            <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=user"><button class="w3-button w3-black"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=display_utilisateurs"><button class="w3-button w3-white"><i class="fas fa-book-open w3-margin-right"></i>Affichage</button></a>
                    <a href="?action=new_utilisateur"><button class="w3-button w3-white"><i class="fas fa-plus w3-margin-right"></i>Ajouter</button></a>
                </div>
                </div>
                </div>
            </header>
                <div class="w3-container w3-padding-large" style="margin-bottom: -10rm">
                <div id="centre">
                <h4><b>Accueil</b></h4>
                Bienvenue <?php echo htmlspecialchars(htmlspecialchars($_SESSION['username'])) ?> dans le système de gestion d'utilisateurs.
                <p>Affichez la liste d'utilisateurs du site, et créez de nouveaux utilisateurs à l'aide des sous-menus correspondants.
    
        </div>
    </div>
</html>