<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Console</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                <a href="?action=modification"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=modif_liste"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="#"><button class="w3-button w3-white"><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="?action=modif_users"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gérer les users</button></a>
                    <a href="?action=modif_groups"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gérer les groupes</button></a>
                    <a href="?action=modif_admin_listes"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Compte Admin</button></a>
                    <a href="?action=console"><button class="w3-button w3-black w3-hide-small"><i class="fas fa-desktop w3-margin-right"></i>Console</button></a>
                    </div>
                    </div>
                    </div>
                </header>

                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <div id="centre">

                <h4><b>Accédez directement à la console</b></h4>

                <?php
                while($donnees = $req->fetch()){
                    $ip = $donnees[4];
                    $port = $donnees[6];
                }

                if(($ip == '82.64.225.10' && $port == 2020)){
                    echo "<a href='https://zw1.2nd-itinet.fr/' target='_blank'><button class='w3-button w3-white w3-hide-small'>Ouvrir une console</button></a>";
                }else if(($ip == '82.64.225.10' && $port == 3009)){
                    echo "<a href='https://zw2.2nd-itinet.fr/' target='_blank'><button class='w3-button w3-white w3-hide-small'>Ouvrir une console</button></a>";  
                }else{
                    echo "Cette machine n'est pas disponible pour cette fonctionnalité";
                }
                ?>

                </div>
                </div>
        </html>