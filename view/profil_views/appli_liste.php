<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Applications</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                <a href="?action=application"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=appli_liste"><button class="w3-button w3-black"><i class="fas fa-info w3-margin-right"></i>Selection de la machine</button></a>
                    <a href="#"><button class="w3-button w3-white" disabled><i class="fas fa-globe-asia w3-margin-right"></i>Installation</button></a>
                    <a href="#"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gestion des applications</button></a>
                    </div>
                    </div>
                    </div>
                </header>

                <div class="w3-container w3-padding-large" style="">
                <div id="centre">
                <h4><b>Vos machines</b></h4>
                <?php
                    if($_SESSION['power'] == "admin"){

                ?>
                
                Sélectionnez une machine :</p>

                <?php
                
                $i = 1;
                while($donnees = $req->fetch()){
                    if($i % 3 == 1){
                        echo "<div class='w3-row-padding'>";
                    }
                    $nb = rand(1, 32);

                    //modifier les print de echo donnes qui ne renvoient rien en les uplodant dans le fichier controller precedant a l'aide de la modif du ficher select
                    
                    echo "<div class='w3-third w3-container w3-margin-bottom'>
                        <img src='../images/listes/l$nb.jfif' alt='' style='width:100%; border-radius:10px 10px 0px 0px;'>
                        <form action='?action=appli_machine' method = 'POST'>
                        <div class='w3-container w3-white2'>
                            <input class='w3-input w3-border' type='hidden' name='id_machine' value=".$donnees['id'].">
                            <p><b>$donnees[1]</b></p>
                            <p>$donnees[2]</p>
                            $donnees[3]</br> </br>
                            <button type='submit' class='w3-button w3-black w3-margin-bottom'><i class='fas fa-check w3-margin-right'></i>Accèder à la machine</button>
                        </div>
                        </form>
                    </div>
                    <div>
                   
                    </div>";
                    if($i % 3 == 0){
                        echo "</div>";
                    }
                    $i = $i + 1;
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