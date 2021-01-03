<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Observation</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=observation"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=observ_liste"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="#"><button class="w3-button w3-black"><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="#"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Paramètres</button></a>
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
                
                //Log 1

                echo "<div class='w3-row-padding'>";
                $nb = rand(1, 32);
                echo "<div class='w3-third w3-container w3-margin-bottom'>
                    <img src='../images/listes/l$nb.jfif' alt='' style='width:100%; border-radius:10px 10px 0px 0px;'>
                    <form action='../controller/download_log.php' method = 'POST'>
                    <div class='w3-container w3-white2'>
                        <p><b>auth.log</b></p>
                        <p>Autorisations système</p></br>
                        <input class='w3-input w3-border' type='hidden' name='log' value='auth'>
                        <input class='w3-input w3-border' type='hidden' name='id_machine' value='$machine_name'>
                        <button type='submit' class='w3-button w3-black w3-margin-bottom'><i class='fas fa-check w3-margin-right'></i>Télécharger</button>
                    </form>
                    </div>
                </div>";

                //Log 2

                $nb = rand(1, 32);
                echo "<div class='w3-third w3-container w3-margin-bottom'>
                    <img src='../images/listes/l$nb.jfif' alt='' style='width:100%; border-radius:10px 10px 0px 0px;'>
                    <form action='../controller/download_log.php' method = 'POST'>
                    <div class='w3-container w3-white2'>
                        <p><b>kern.log</b></p>
                        <p>Informations noyau</p></br>
                        <input class='w3-input w3-border' type='hidden' name='log' value='kern'>
                        <input class='w3-input w3-border' type='hidden' name='id_machine' value='$machine_name'>
                        <button type='submit' class='w3-button w3-black w3-margin-bottom'><i class='fas fa-check w3-margin-right'></i>Télécharger</button>
                    </form>
                    </div>
                </div>";

                //Log 3

                $nb = rand(1, 32);
                echo "<div class='w3-third w3-container w3-margin-bottom'>
                    <img src='../images/listes/l$nb.jfif' alt='' style='width:100%; border-radius:10px 10px 0px 0px;'>
                    <form action='../controller/download_log.php' method = 'POST'>
                    <div class='w3-container w3-white2'>
                        <p><b>messages</b></p>
                        <p>Messages système</p></br>
                        <input class='w3-input w3-border' type='hidden' name='log' value='messages'>
                        <input class='w3-input w3-border' type='hidden' name='id_machine' value='$machine_name'>
                        <button type='submit' class='w3-button w3-black w3-margin-bottom'><i class='fas fa-check w3-margin-right'></i>Télécharger</button>
                    </form>
                    </div>
                </div>";
                echo "</div>";

                //Log 4

                echo "<div class='w3-row-padding'>";
                $nb = rand(1, 32);
                echo "<div class='w3-third w3-container w3-margin-bottom'>
                    <img src='../images/listes/l$nb.jfif' alt='' style='width:100%; border-radius:10px 10px 0px 0px;'>
                    <form action='../controller/download_log.php' method = 'POST'>
                    <div class='w3-container w3-white2'>
                        <p><b>syslog</b></p>
                        <p>Activité système</p></br>
                        <input class='w3-input w3-border' type='hidden' name='log' value='syslog'>
                        <input class='w3-input w3-border' type='hidden' name='id_machine' value='$machine_name'>
                        <button type='submit' class='w3-button w3-black w3-margin-bottom'><i class='fas fa-check w3-margin-right'></i>Télécharger</button>
                    </form>
                    </div>
                </div>";
                echo "</div>";


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