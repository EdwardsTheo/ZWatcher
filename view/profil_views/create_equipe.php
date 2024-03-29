<!DOCTYPE HTML>
<html>
    <div id="haut">
    <h1><b>Equipes</b></h1>
                <div class="w3-section w3-bottombar w3-padding-16">
            <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=equipe"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=display_equipes"><button class="w3-button w3-white"><i class="fas fa-book-open w3-margin-right"></i>Affichage</button></a>
                    <a href="#"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="?action=create_equipe"><button class="w3-button w3-black"><i class="fas fa-plus w3-margin-right"></i>Créer</button></a>
                    <a href="?action=delete_equipe"><button class="w3-button w3-white"><i class="fas fa-minus w3-margin-right"></i>Supprimer</button></a>
                </div>
                </div>
                </div>
            </header>
                <div class="w3-container w3-padding-large" style="margin-bottom: -10rm">
                <div id="centre">
                <h4><b></b></h4>
                
                <h4><b>Création d'équipe</b></h4>

                <?php
                    if($_SESSION['power'] == "admin"){

                ?>
                    </p>
                    <div class="w3-row-padding">
                        <a href = "?action=create_equipe">
                        <div class="w3-third w3-container w3-margin-bottom">
                            <img src="../images/bank/en01_ter.png" alt="" style="width:100%; border-radius:10px 10px 0px 0px;" class="w3-hover-opacity">
                            <div class="w3-container w3-white2">
                                <p><b>Titre</b></p>
                                <p>Machine associée</p>
                            </div>
                        </div>
                        </a>
                        <!-- 2e item -->
                        
                        <div class="w3-third w3-container w3-margin-bottom">
                            <form action="?action=init_equipe" method = "POST">
                            Choisissez un titre, et associez une machine à l'équipe.
                            <div style="display: inline" class="errors">
                            <?php
                            echo $errors;
                            ?>
                            </div>
                            <div class="w3-section">
                                <label>Titre</label>
                                <input class="w3-input w3-border" type="text" name="titre">
                            </div>
                            <div class="w3-section">
                                <label>Machine associée</label>
                                <select name="associated" id="associated-select">
                                    <?php
                                        while($donnees = $req->fetch()){
                                            echo"<option value=$donnees[0]>$donnees[1]</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                          
                            <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Créer</button>
                            </form>
                        </div>
                        
                    </div>

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