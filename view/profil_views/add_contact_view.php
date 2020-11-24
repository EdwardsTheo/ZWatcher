<!DOCTYPE html>
<html>
    <div id="haut">
    <h1><b>Mes contacts</b></h1>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=contacts"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=add_contact"><button class="w3-button w3-black"><i class="fas fa-user-plus w3-margin-right"></i>Ajouter</button></a>
                    <a href="?action=delete_contact"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-user-minus w3-margin-right"></i>Supprimer</button></a>
                    <a href="?action=par_contacts"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Paramètres</button></a>
                    </div>
                    </div>
                    </div>
                </header>

                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <div id="centre">
                <div class="w3-container w3-padding-large w3-grey">
                <h4 id="contact"><b>Ajouter un contact :</b></h4>
                Saisissez le pseudo du contact que vous souhaitez ajouter.
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
                <form action="../controller/add_contact.php" method = "POST">
                <div class="w3-section">
                    <label>Nom</label>
                    <input class="w3-input w3-border" type="text" name="pseudo">
                </div>
                <div class="w3-section">
                    <label>Qualité</label>
                    <input class="w3-input w3-border" type="text" name="qualite">
                </div>

                <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Ajouter</button>
                </form>
                </div>

                </div>
                </div>
</html>