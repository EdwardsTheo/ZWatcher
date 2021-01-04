<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Applications</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=application"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=appli_liste"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Selection de la machine</button></a>
                    <a href="?action=appli_machine"><button class="w3-button w3-white"><i class="fas fa-globe-asia w3-margin-right"></i>Installation</button></a>
                    <a href="?action=gestion_app"><button class="w3-button w3-black w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gestion des applications</button></a>
                    </div>
                    </div>
                </header>
                    <div class="w3-container w3-padding-large" style="margin-bottom: -10rm">
                    <div id="centre">
                    <h4><b>Informations</b></h4>
                    <?php
                    if($_SESSION['power'] == "admin"){

                ?>
                        Sur cette page, vous décidez des applications que vous voulez rendre disponible pour vos machines. </br>
                        Vous pouvez également proposer de nouvelles applications avec le formulaire</br>
                    
                    <?php
                    
                        if(isset($_SESSION['message'])) {
                            echo "<h4><b>$_SESSION[message]</b></h4>";
                            unset($_SESSION['message']);
                        }		
                  
                        echo "
                        <div class='w3-section w3-bottombar w3-padding-16'>
                            <form action='../view/profil.php?action=gestion_app' method='POST'>
                            <input type='submit' class='w3-button w3-black' name='choice' value='Applications activées'>
                            <input type='submit' class='w3-button w3-black' name='choice' value='Applications disponibles'>
                            <input type='submit' class='w3-button w3-black' name='choice' value='Ajouter une applications'>
                            </form>
                        </div>";
                        
                        function show_app_activate($status, $button) {
                            $i = 1;
                            $req1 = get_app_avaible($_SESSION['id'], $status);
                            $empty = true;
                            echo " <form action='../view/profil.php?action=update_app' method='POST'>";
                            while($donnees = $req1->fetch()){
                                $empty = false;
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
                                        <p><b>".strtoupper($donnees['nom_appli'])."</b></p>
                                        <input type='checkbox' id='scales' name='scales[$i]'>
                                    </div>
                                </div>";
                                
                               
                                
                                if($i % 3 == 0){
                                    echo "</div>";
                                }
                                $i = $i + 1;
                               }
                               if($empty == false) {
                                    echo " 
                                    </div>
                                    <div class='w3-container w3-padding-large' style='margin-bottom:32px'>
                                    <button type='submit' class='w3-button w3-black '><i class='fas fa-check w3-margin-left'></i>".$button."</button>
                                    </form>
                                    </div>";
                               }
                        }
                        
                        function show_add_app() {
                            echo "
                            
                            <div class='w3-container w3-padding-large' style='margin-bottom:32px'>
                           
                            <div class='w3-container w3-padding-large w3-grey'>
                            <h4 id='contact'><b>Ajouter une nouvelle application</b></h4>
                            <hr class='w3-opacity'>
                            <form action='../view/profil.php?action=add_app' method = 'POST'>
                            <div class='w3-section'>
                                <label>Nom de l'application</label>
                                <input class='w3-input w3-border' type='text' name='nom_app' value=''>
                            </div>  
                                <button type='submit' name='submit' value='add_app' class='w3-button w3-black w3-margin-bottom'><i class='fas fa-check w3-margin-right'></i>Ajouter</button>         
                            </form>   
                            <hr class='w3-opacity'> 
                            </div>
                            "; 
                        }

                           //PARTIE APPLICATIONS 
                           if(isset($_POST['choice'])) {
                            switch($_POST['choice']) {
                                case 'Applications activées' : show_app_activate('1', "Désactiver les applications pour vos machines");
                                break;
                                case 'Applications disponibles' : show_app_activate('0', "Activer les applications pour vos machines");
                                break;
                                case 'Ajouter une applications' : show_add_app();
                                break;
                            }
                        }
                        
                    ?>

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