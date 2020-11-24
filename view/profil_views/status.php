<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Mon profil</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=compte"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=infos"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="?action=status"><button class="w3-button w3-black"><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="?action=parameters"><button class="w3-button w3-white"><i class="fas fa-tools w3-margin-right"></i>Paramètres</button></a>
                    <a href="?action=graphismes"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-paint-brush w3-margin-right"></i>Graphismes</button></a>
                    </div>
                    </div>
                    </div>    
                </header>

<!-- encode nécessaire quand modif faite a la main dans la bdd -->

<div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <div id="centre">


                <!-- Formulaire 1 : changer le statut de connexion -->
                <div class="w3-container w3-padding-large w3-grey">
                <?php
                $donnees = $req->fetch();
                if($donnees[0] == "connecte"){
                    $_SESSION['status'] = "connecte";
                    echo"<h4 id='contact'><b>Passez en mode Ne pas déranger :</b></h4>";
                }else{
                    $_SESSION['status'] = "occupe";
                    echo"<h4 id='contact'><b>Passez en mode Connecté :</b></h4>";
                }
                ?>

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
                <form action="../controller/update_status.php" method = "POST">
                <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Valider</button>
                </form>
                </div>

                </p>
                <!-- Formulaire 1 : changer le statut écrit -->
                <div class="w3-container w3-padding-large w3-grey">
                <h4 id="contact"><b>Actualisez votre statut :</b></h4>
                <div style="display: inline" class="errors">
                    <?php
                    if(isset($_SESSION['errors_2'])){ 
                        echo $_SESSION['errors_2'];
                        unset($_SESSION['errors_2']);
                    }else{
                        echo "";
                    }
                    ?>
                </div>

                <hr class="w3-opacity">
                <form action="../controller/update_displayer.php" method = "POST">
                <div class="w3-section">
                    <label>Statut</label>
                    <input class="w3-input w3-border" type="text" name="statut" value="<?php echo $_SESSION['displayer']?>">
                </div>

                <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Actualiser</button>
                </form>
                </div>

                </div>
                </div>
    </html>