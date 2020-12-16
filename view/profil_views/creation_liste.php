<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Mon parc</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=listes"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=display_listes"><button class="w3-button w3-white"><i class="fas fa-book-open w3-margin-right"></i>Affichage</button></a>
                    <a href="?action=create_liste"><button class="w3-button w3-black"><i class="fas fa-plus w3-margin-right"></i>Création</button></a>
                    <a href="#"><button class="w3-button w3-white"><i class="fas fa-minus w3-margin-right"></i>Suppression</button></a>
                    <a href="#"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-pen w3-margin-right"></i>Modifier</button></a>
                    </div>
                    </div>
                    </div>
                </header>
                
                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <div id="centre">
                    <h4><b>Ajout d'un équipement</b></h4>
                    </p>
                    <div class="w3-row-padding">
                        <a href = "?action=home_creation_liste">
                        <div class="w3-third w3-container w3-margin-bottom">
                            <img src="../images/bank/en01_ter.png" alt="" style="width:100%; border-radius:10px 10px 0px 0px;" class="w3-hover-opacity">
                            <div class="w3-container w3-white2">
                                <p><b>Titre</b></p>
                                <p>Description de l'équipement</p>
                                Paragraphe 1</br> </br>
                                Paragraphe 2 ...</br> </br>
                            </div>
                        </div>
                        </a>
                        <!-- 2e item -->
                        
                        <div class="w3-third w3-container w3-margin-bottom">
                            <form action="../controller/create_liste.php" method = "POST">
                            Choisissez un titre, une description et complétez les informations demandées.
                            <div style="display: inline" class="errors">
                            <?php
                            if(isset($_SESSION['errors'])){ 
                                echo $_SESSION['errors'];
                                unset($_SESSION['errors']);
                            }else{
                                echo "";
                            }
                            ?>
                            </div>
                            <div class="w3-section">
                                <label>Titre</label>
                                <input class="w3-input w3-border" type="text" name="titre">
                            </div>
                            <div class="w3-section">
                                <label>Description</label>
                                <input class="w3-input w3-border" type="text" name="description">
                            </div>

                            <!-- Trouver un moyen, dans la requete d'avant, de upload :
                            - ses users si on est admin
                            - ses admins si on est user 
                            
                            - ou alors ajout de machine dispo que si admin ? Bof
                            - ou alors un admin crée un groupe (nouvelle table)
                            avec dedans de quoi créer des équipes
                            
                            et donc partie votre équipe : liste d'équipes et users/admins de l'équipe
                            et dans environnement listes de vms à soi + celles administrables si admin-->

                            <div class="w3-section">
                                <label>Propriétaire</label> </br>
                                <select name="owner" id="owner">
                                    <option value="normal">Mode ZWatcher</option>
                                    <option value="dark">Mode Sombre</option>
                                    <option value="ocean">Mode Océanique</option>
                                </select>
                            </div>
                            <div class="w3-section">
                                <label>Administrateur</label> </br>
                                <select name="admin" id="admin">
                                    <option value="normal">Mode ZWatcher</option>
                                    <option value="dark">Mode Sombre</option>
                                    <option value="ocean">Mode Océanique</option>
                                </select>
                            </div>
                            <div class="w3-section">
                                <label>Adresse IP</label>
                                <input class="w3-input w3-border" type="text" name="ip">
                            </div>
                            <div class="w3-section">
                                <label>Adresse MAC</label>
                                <input class="w3-input w3-border" type="text" name="mac">
                            </div>
                            <div class="w3-section">
                                <label>Port</label>
                                <input class="w3-input w3-border" type="text" name="port">
                            </div>
                            <div class="w3-section">
                                <label>Identifiant</label>
                                <input class="w3-input w3-border" type="text" name="port">
                            </div>
                            <div class="w3-section">
                                <label>Mot de passe</label>
                                <input class="w3-input w3-border" type="password" name="port">
                            </div>
                            

                            <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fas fa-check w3-margin-right"></i>Créer</button>
                            </form>
                        </div>
                        
                    </div>

                   

                </div>
                </div>
    </html>