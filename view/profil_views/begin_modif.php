<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Modifications</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                <a href="?action=modification"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=modif_liste"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="#"><button class="w3-button w3-black"><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="?action=modif_users"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gérer les users</button></a>
                    <a href="?action=modif_groups"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gérer les groupes</button></a>
                    </div>
                    </div>
                    </div>
                </header>

                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                    <div id="centre">

                    <?php
                    if($_SESSION['power'] == "admin"){

                ?>
                    
                    <?php

                    echo "<div class='w3-container w3-padding-large w3-grey'>";
                    while($donnees = $req->fetch()){
                        echo "<h4 id='contact'><b>Modifier le hostname :</b></h4>
                        Saisissez un nouveau nom.
                        <div style='display: inline' class='errors'>";
                            if(isset($_SESSION['errors'])){ 
                                echo $_SESSION['errors'];
                                unset($_SESSION['errors']);
                            }else{
                                echo "";
                            }
                        echo "</div>

                        <!-- Actualiser le controller du formulaire -->

                        <hr class='w3-opacity'>
                        <form action='?action=modif_hostname' method = 'POST'>
                        <div class='w3-section'>
                            <label>Hostname</label>
                            <input class='w3-input w3-border' type='text' name='hostname' value='$actual_hostname'>
                            <input class='w3-input w3-border' type='hidden' name='id_machine' value='$donnees[0]'>
                            <input class='w3-input w3-border' type='hidden' name='old_name' value='$actual_hostname'>
                        </div>

                        <button type='submit' class='w3-button w3-black w3-margin-bottom'><i class='fas fa-check w3-margin-right'></i>Modifier</button>
                        </form>
                        </div>
                        </p>";
                    


                        echo"<div class='w3-container w3-padding-large w3-grey'>
                        <h4 id='contact'><b>Modifier l'adresse IP :</b></h4>
                        Saisissez une nouvelle adresse IP.
                        <div style='display: inline' class='errors'>";
                            if(isset($_SESSION['errors_2'])){ 
                                echo $_SESSION['errors_2'];
                                unset($_SESSION['errors_2']);
                            }else{
                                echo "";
                            }
                        echo"</div>

                        <!-- Actualiser le controller du formulaire -->

                        <hr class='w3-opacity'>
                        <form action='?action=modif_ip' method = 'POST'>
                        <div class='w3-section'>
                            <label>Adresse IP</label>
                            <input class='w3-input w3-border' type='text' name='ip' value='$actual_ip'>
                            <input class='w3-input w3-border' type='hidden' name='id_machine' value='$donnees[0]'>
                            <input class='w3-input w3-border' type='hidden' name='old_ip' value='$actual_ip'>
                            <input class='w3-input w3-border' type='hidden' name='interface' value='$interface'>
                        </div>

                        <button type='submit' class='w3-button w3-black w3-margin-bottom'><i class='fas fa-check w3-margin-right'></i>Modifier</button>
                        </form>
                        </div>
                        </p>";
                        
                    }
                    $req->closeCursor();
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