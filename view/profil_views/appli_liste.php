<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Applications</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                <a href="?action=application"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=appli_liste"><button class="w3-button w3-black"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="#"><button class="w3-button w3-white"><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="#"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Paramètres</button></a>
                    </div>
                    </div>
                    </div>
                </header>

                <div class="w3-container w3-padding-large" style="">
                <div id="centre">
                <h4><b>Vos machines</b></h4>
                
                <?php
                
                $i = 1;
                while($donnees = $req->fetch()){
                    if($i % 3 == 1){
                        echo "<div class='w3-row-padding'>";
                    }
                    $nb = rand(1, 32);
                    echo "<div class='w3-third w3-container w3-margin-bottom'>
                        <img src='../images/listes/l$nb.jfif' alt='' style='width:100%; border-radius:10px 10px 0px 0px;'>
                        <div class='w3-container w3-white2'>
                            <p><b>$donnees[1]</b></p>
                            <p>$donnees[2]</p>
                            $donnees[3]</br> </br>
                        </div>
                    </div>";
                    if($i % 3 == 0){
                        echo "</div>";
                    }
                    $i = $i + 1;
                }
                
                ?>
                </div>

                </div>
                </div>
    </html>