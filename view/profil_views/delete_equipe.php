<!DOCTYPE HTML>
<html>
    <div id="haut">
    <h1><b>Equipes</b></h1>
                <div class="w3-section w3-bottombar w3-padding-16">
            <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=equipe"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=display_equipes"><button class="w3-button w3-white"><i class="fas fa-book-open w3-margin-right"></i>Affichage</button></a>
                    <a href="#"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="?action=create_equipe"><button class="w3-button w3-white"><i class="fas fa-plus w3-margin-right"></i>Créer</button></a>
                    <a href="?action=delete_equipe"><button class="w3-button w3-black"><i class="fas fa-minus w3-margin-right"></i>Supprimer</button></a>
                </div>
                </div>
                </div>
            </header>
                <div class="w3-container w3-padding-large" style="margin-bottom: -10rm">
                <div id="centre">
                <h4><b>Suppression d'équipe</b></h4>

                <?php
                    if($_SESSION['power'] == "admin"){

                ?>
                
                <?php

                $i = 1;
                $exist = false;
                while($donnees = $req->fetch()) {
                    $exist = true;
                    if($i % 3 == 1){
                        echo "<div class='w3-row-padding'>";
                    }
                    $nb = rand(1, 32);
                    echo "<div class='w3-third w3-container w3-margin-bottom'>
                        <img src='../images/listes/l$nb.jfif' alt='' style='width:100%; border-radius:10px 10px 0px 0px;'>
                        <form action='?action=erase_equipe' method = 'POST'>
                        <div class='w3-container w3-white2'>
                            <input class='w3-input w3-border' type='hidden' name='id_equipe' value='$donnees[0]'>
                            <p><b>Groupe $donnees[1]</b></p>
                            <button type='submit' class='w3-button w3-black w3-margin-bottom'><i class='fas fa-check w3-margin-right'></i>Supprimer</button>   
                        </div>
                        </form>
                    </div>";
                    if($i % 3 == 0){
                        echo "</div>";
                    }
                    $i = $i + 1;
                }
                if($exist == false) {
                    echo "<h4><b>Il n'y a actuellement aucune équipe.</b></h4>";
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