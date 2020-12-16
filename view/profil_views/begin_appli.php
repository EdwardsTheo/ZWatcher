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
                echo "
                <div class='w3-section w3-bottombar w3-padding-16'>
                    <form action='../view/profil.php?action=appli_machine' method='POST'>
                        <input type='submit' class='w3-button w3-black' name='choice' value='Applications Installées'>
                        <input type='submit' class='w3-button w3-black' name='choice' value='Applications Non Installées'>
                    </form>
                </div>
                <div class='w3-section w3-bottombar w3-padding-16'>
                    <form action='../view/profil.php?action=install_app' method='POST'>
                        <input type='submit' class='w3-button w3-black' name='choice' value='Effectuer un apt update et upgrade'>
                    </form>
                </div>
                ";
                
                if(isset($_POST['choice'])) {
                    switch($_POST['choice']) {
                        case 'Applications Installées' : show_app_installed('1', "Désinstaller les applications");
                        break;
                        case 'Applications Non Installées' : show_app_installed('0', "Installer les applications");
                        break;
                        case 'Effectuer un apt update et upgrade' : call_update_upgrade();
                        break;
                    }
                }

                 
                function show_app_installed($status, $button) {
                    $i = 1;
                    $req1 = get_app($_SESSION['id_machine'], $status);
                    echo " <form action='../view/profil.php?action=install_app' method='POST'>";
                    while($donnees = $req1->fetch()){
                        if($i % 3 == 1){
                            echo "<div class='w3-row-padding'>";
                           
                        }
                        $nb = rand(1, 32);
                        
                        echo "
                        <div class='w3-third w3-container w3-margin-bottom'>
                            <img src='../images/listes/l$nb.jfif' alt='' style='width:100%; border-radius:10px 10px 0px 0px;'>
                            <div class='w3-container w3-white2'>
                                <input class='w3-input w3-border' type='hidden' name='nom_appli[$i]' value=".$donnees['nom_appli'].">
                                <input class='w3-input w3-border' type='hidden' name='id_appli[$i]' value=".$donnees['id_appli'].">
                                <input class='w3-input w3-border' type='hidden' name='action' value=".$button.">
                                <input class='w3-input w3-border' type='hidden' name='is' value='not_upgrade'>
                                <p><b>".strtoupper($donnees['nom_appli'])."</b></p>
                                <input type='checkbox' id='scales' name='scales[$i]'>
                            </div>
                        </div>";
                        
                       
                        
                        if($i % 3 == 0){
                            echo "</div>";
                        }
                        $i = $i + 1;
                       }
                       echo " 
                       </div>
                       <div class='w3-container w3-padding-large' style='margin-bottom:32px'>
                       <button type='submit' class='w3-button w3-black w3-margin-bottom'><i class='fas fa-check w3-margin-left'></i>".$button."</button>
                       </form>
                       </div>";
                }
            ?>
                    </div>
                    </div>
              
              
            </html>
