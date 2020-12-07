<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Applications</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=application"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=appli_liste"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Selection de la machine</button></a>
                    <a href="#"><button class="w3-button w3-white"><i class="fas fa-globe-asia w3-margin-right"></i>Installation</button></a>
                    <a href="?action=gestion_app"><button class="w3-button w3-black w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gestion des applications</button></a>
                    </div>
                    </div>
                    </div>
                </header>
                    <div class="w3-container w3-padding-large" style="margin-bottom: -10rm">
                    <div id="centre">
                    <h4><b>Informations</b></h4>
                        Sur cette page, vous décidez des applications que vous voulez rendre disponible pour vos machines. </br>
                        Vous pouvez également proposer de nouvelles applications avec le formulaire en bas de page</br>
                    <?php
                        //PARTIE APPLICATIONS 

                        //PARTIE AJOUTER APPLICATIONS
                        ?>
                        <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                        <div id="centre">
                        <div class="w3-container w3-padding-large w3-grey">
                        <h4 id="contact"><b>Ajouter une nouvelle application</b></h4>
                        <hr class="w3-opacity">
                        <form action="../controller/add_app.php" method = "POST">
                        <div class="w3-section">
                            <label>Nom de l'application</label>
                            <input class="w3-input w3-border" type="text" name="nom_app" value="">
                        </div>  
                            <button type="submit" name="submit" value="add_app" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Ajouter</button>         
                        </form>    
                        <?php
                        
             

		            ?>

                </div>
                </div>
                </div>
</html>