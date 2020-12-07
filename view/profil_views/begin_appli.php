<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Applications</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=application"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=appli_liste"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Selection de la machine</button></a>
                    <a href="#"><button class="w3-button w3-black"><i class="fas fa-globe-asia w3-margin-right"></i>Installation</button></a>
                    <a href="?action=gestion_app"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gestion des applications</button></a>
                    </div>
                    </div>
                    </div>
                </header>
                    <div class="w3-container w3-padding-large" style="margin-bottom: -10rm">
                    <div id="centre">
                    <h4><b>Informations</b></h4>
                        Sur cette page, vous pouvez installer ou desinstaller les applications que vous avez choisis, </br>
                        Pour ajouter de nouvelles applications, accèdez à l'onglet "Gestions des applications" </br>
                    <?php
		
			if(isset($_SESSION['message'])) {
				echo "<h4><b>$_SESSION[message]</b></h4>";
				unset($_SESSION['message']);
			}			 
		    ?>

		    <?php

			    $i = 0;
                            while($donnees = $req->fetch()){
                               echo " 
                               <div class='w3-container w3-padding-large' style='margin-bottom:32px'>
                               <div id='centre'>
                                   <div class='w3-container w3-padding-large w3-grey'>
                                   <!-- Formulaire 1 : Installer une application -->
                                       <h4 id='contact'><b>Gestion de ".strtoupper($donnees['nom_appli'])."</b></h4>
                                       <hr class='w3-opacity'>
                                       <form action='../controller/install_app.php' method = 'POST'>
                                ";
                               if($donnees['status_install'] == 0) {
                                    echo "<button type='submit' class='w3-button w3-black w3-margin-bottom'><i class='fas fa-check w3-margin-right'></i>Installation</button>";
                               }
                               else {
                                    echo "<button type='submit' class='w3-button w3-black w3-margin-bottom'><i class='fas fa-check w3-margin-right'></i>Desinstallation</button>";
                                }
                                echo "
                                    <input class='w3-input w3-border' type='hidden' name='status_install' value='".$donnees['status_install']."'>
                                    <input class='w3-input w3-border' type='hidden' name='id_machine' value='".$donnees['id_machine']."'>
                                    <input class='w3-input w3-border' type='hidden' name='id_app' value='".$donnees['id_appli']."'>
                                    <input class='w3-input w3-border' type='hidden' name='nom_appli' value='".$donnees['nom_appli']."'>
                                    </form>
                                    </div>
           
                                    </p>
                                    </div>
                               </div>
                               ";
                            }

                            ?>
                    </div>
                    </div>
              
              
            </html>
