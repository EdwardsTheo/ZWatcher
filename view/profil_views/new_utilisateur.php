<!DOCTYPE HTML>
<html>
    <div id="haut">
    <h1><b>Utilisateurs</b></h1>
                <div class="w3-section w3-bottombar w3-padding-16">
            <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=user"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=display_utilisateurs"><button class="w3-button w3-white"><i class="fas fa-book-open w3-margin-right"></i>Affichage</button></a>
                    <a href="?action=new_utilisateur"><button class="w3-button w3-black"><i class="fas fa-plus w3-margin-right"></i>Ajouter</button></a>
                    <a href="?action=delete_utilisateur"><button class="w3-button w3-white"><i class="fas fa-minus w3-margin-right"></i>Supprimer</button></a>
                </div>
                </div>
                </div>
            </header>
                
            <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <div id="centre">

                <?php
                    if($_SESSION['power'] == "admin"){

                ?>
                <div class="w3-container w3-padding-large w3-grey">
                <h4 id="contact"><b>Ajouter un utilisateur :</b></h4>
                Saisissez les informations de l'utilisateur que vous souhaitez ajouter. Celui-ci recevra ses identifiants par mail.
                <div style="display: inline" class="errors">
                    <?php
                    if(isset($_SESSION['errors'])){ 
                        echo $_SESSION['errors'];
                        unset($_SESSION['errors']);
                    }else{
                        echo "";
                    }
                    ?>
                </div>

                <hr class="w3-opacity">
                <form action="../controller/create_account.php" method = "POST">
                <div class="w3-section">
                    <label>Nom d'utilisateur</label>
                    <input class="w3-input w3-border" type="text" name="user"">
                </div>
                <div class="w3-section">
                    <label>Mail</label>
                    <input class="w3-input w3-border" type="text" name="mail">
                </div>

                <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Créer le compte</button>
                </form>
                </div>

                <?php
                    }else{
                ?>
                    Vous n'avez pas les droits pour accéder à ces fonctions.
                <?php
                    }
                ?>
                
        </div>
    </div>
</html>