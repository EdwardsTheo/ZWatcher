<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Modifications</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                <a href="?action=modification"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=modif_liste"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="#"><button class="w3-button w3-black"><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="#"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Paramètres</button></a>
                    </div>
                    </div>
                    </div>
                </header>

                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                    <div id="centre">
                        
                        <div class="w3-container w3-padding-large w3-grey">
                        <h4 id="contact"><b>Modifier le hostname :</b></h4>
                        Saisissez un nouveau nom.
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

                        <!-- Actualiser le controller du formulaire -->

                        <hr class="w3-opacity">
                        <form action="../controller/.php" method = "POST">
                        <div class="w3-section">
                            <label>Hostname</label>
                            <input class="w3-input w3-border" type="text" name="hostname">
                        </div>

                        <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Modifier</button>
                        </form>
                        </div>
                        </p>

                        <div class="w3-container w3-padding-large w3-grey">
                        <h4 id="contact"><b>Modifier l'adresse IP :</b></h4>
                        Saisissez une nouvelle adresse IP.
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

                        <!-- Actualiser le controller du formulaire -->

                        <hr class="w3-opacity">
                        <form action="../controller/.php" method = "POST">
                        <div class="w3-section">
                            <label>Adresse IP</label>
                            <input class="w3-input w3-border" type="text" name="ip">
                        </div>

                        <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Modifier</button>
                        </form>
                        </div>
                        </p>

                        <div class="w3-container w3-padding-large w3-grey">
                        <h4 id="contact"><b>Modifier l'adresse MAC :</b></h4>
                        Saisissez une nouvelle adresse MAC.
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

                        <!-- Actualiser le controller du formulaire -->

                        <hr class="w3-opacity">
                        <form action="../controller/.php" method = "POST">
                        <div class="w3-section">
                            <label>Adresse MAC</label>
                            <input class="w3-input w3-border" type="text" name="mac">
                        </div>

                        <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Modifier</button>
                        </form>
                        </div>
                        </p>

                    </div>
                </div>
        </html>