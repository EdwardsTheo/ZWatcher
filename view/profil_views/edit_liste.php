<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Mon parc</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=listes"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=display_listes"><button class="w3-button w3-white"><i class="fas fa-book-open w3-margin-right"></i>Affichage</button></a>
                    <a href="?action=create_liste"><button class="w3-button w3-white"><i class="fas fa-plus w3-margin-right"></i>Création</button></a>
                    <a href="?action=delete_liste"><button class="w3-button w3-white"><i class="fas fa-minus w3-margin-right"></i>Suppression</button></a>
                    <a href="?action=edit_liste"><button class="w3-button w3-black w3-hide-small"><i class="fas fa-pen w3-margin-right"></i>Modifier</button></a>
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
                
                <?php
                
                $i = 1;
                while($donnees = $req->fetch()){
                    if($i % 3 == 1){
                        echo "<div class='w3-row-padding'>";
                    }
                    $nb = rand(1, 32);
                    echo "<div class='w3-third w3-container w3-margin-bottom'>
                        <img src='../images/listes/l$nb.jfif' alt='' style='width:100%; border-radius:10px 10px 0px 0px;'>
                        <form action='?action=begin_edit_liste' method = 'POST'>
                        <div class='w3-container w3-white2'>
                            <p><b>$donnees[1]</b></p>
                            <p>$donnees[2]</p>
                            $donnees[3]</br> </br>
                            <input class='w3-input w3-border' type='hidden' name='id_machine' value='$donnees[0]'>
                            <button type='submit' class='w3-button w3-black w3-margin-bottom'><i class='fas fa-check w3-margin-right'></i>Modifier sur ZWatcher</button>
                        </div>
                        </form>
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