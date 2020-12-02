<?php
    ?>
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
    <?php
    

    $machine_name = $_SESSION['machine_name'];

    ?>
    <div class="w3-container w3-padding-large" style="margin-bottom:32px">
        <div id="centre">
            <div class="w3-container w3-padding-large w3-grey">
            <!-- Formulaire 1 : Installer une application -->
            <div class="w3-container w3-padding-large w3-grey">
                <h4 id='contact'><b>Installez Apache 2</b></h4>

                <hr class="w3-opacity">
                <form action="../controller/install_app.php" method = "POST">
                <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Valider</button>
                <input class='w3-input w3-border' type='hidden' name='machine_name' value='1'>
                <input class='w3-input w3-border' type='hidden' name='apache2' value='1'>
                </form>
                </div>

                </p>
                </div>

            </div>
        </div>
    </div>
    <?php
?>