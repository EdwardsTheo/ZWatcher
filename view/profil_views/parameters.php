<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Mon profil</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=compte"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=infos"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="?action=status"><button class="w3-button w3-white"><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="?action=parameters"><button class="w3-button w3-black"><i class="fas fa-tools w3-margin-right"></i>Paramètres</button></a>
                    <a href="?action=graphismes"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-paint-brush w3-margin-right"></i>Graphismes</button></a>
                    </div>
                    </div>
                    </div>    
                </header>

<!-- encode nécessaire quand modif faite a la main dans la bdd -->

            <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <div id="centre">
                <div class="w3-container w3-padding-large w3-grey">
                <h4 id="contact"><b>Modifier vos informations :</b></h4>
                Saisissez vos nouvelles informations.
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
                <form action="../controller/update_infos.php" method = "POST">
                <div class="w3-section">
                    <label>Nom</label>
                    <input class="w3-input w3-border" type="text" name="pseudo" value="<?php echo $_SESSION['username']?>">
                </div>
                <div class="w3-section">
                    <label>Mail</label>
                    <input class="w3-input w3-border" type="text" name="mail" value="<?php echo $_SESSION['mail']?>">
                </div>
                <div class="w3-section">
                    <label>Mot de passe</label>
                    <input class="w3-input w3-border" type="text" name="password">
                </div>

                <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Mettre à jour</button>
                </form>
                </div>
                </p>

                <div class="w3-container w3-padding-large w3-grey">
                <h4 id="contact"><b>Modifier votre photo de profil :</b></h4>
                Téléchargez la nouvelle photo localement.
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
                <form action="../controller/update_picture.php" method = "POST" enctype="multipart/form-data">
                <div class="w3-section">
                    <input type="file" name="file" style="">
                </div>
                <button type="submit" name="submit" value="Upload" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Télécharger</button>
                </form>

                </div>
                </p>

                <div class="w3-container w3-padding-large w3-grey">
                <h4 id="contact"><b>Supprimer votre photo de profil :</b></h4>
                Votre photo sera remplacée par un avatar neutre.
                <div style="display: inline" class="errors">
                    <?php
                    if(isset($_SESSION['errors_3'])){ 
                        echo $_SESSION['errors_3'];
                        unset($_SESSION['errors_3']);
                    }else{
                        echo "";
                    }
                    ?>
                </div>

                <hr class="w3-opacity">
                <!-- <form action="../controller/delete_picture.php" method = "POST">
                <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Supprimer</button>
                </form> -->

                <button onclick="confirm_function()" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Supprimer</button>
        
                <script>
                function confirm_function() {
                    let answer = confirm("Voulez-vous vraiment supprimer votre photo de profil ?");

                    if(answer == true) {
                        document.location.href="../controller/delete_picture.php"; 
                    }else{
                       
                    }
                }
                </script>

                </div>
                </div>
                </div>
    </html>