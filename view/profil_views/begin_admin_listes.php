<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Modifications</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                <a href="?action=modification"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=modif_liste"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="#"><button class="w3-button w3-white"><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="?action=modif_users"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gérer les users</button></a>
                    <a href="?action=modif_groups"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gérer les groupes</button></a>
                    <a href="?action=modif_admin_listes"><button class="w3-button w3-black w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Compte Admin</button></a>
                    </div>
                    </div>
                    </div>
                </header>

                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                    <div id="centre">

                    <?php
                    if($_SESSION['power'] == "admin"){

                ?>
                    <h4 id='contact'><b>Gérer vos accèes pour cette machine</b></h4>

<?php
                    function form_modifiy_user_listes($id_user) {
                        $req = get_liste_data_id_admin($id_user, $_SESSION['id_machine']);
                        $i=1;
                        while($donnees = $req->fetch()) {

                            $username = $donnees['id_machine'];
                            if($donnees['rsa'] == 0) $button = "créer une clé rsa pour cet user";
                            else $button = "Supprimer la clé RSA";

                            if($donnees['connexion_rsa'] == 0) $button1 = "Activer la connexion par clé rsa uniquement";
                            else $button1= 'Reactiver la connexion sans clé';

                            echo "<div class='w3-section w3-bottombar w3-padding-16'>
                                <form action='../view/profil.php?action=manage_admin' method='POST'>
                                    <div class='w3-container w3-padding-large w3-grey'>
                                        <h4><b>Modifier le mot de passe de l'admin $donnees[id_machine]</b></h4>
                                            <input class='w3-input w3-border' type='password' name='psswd[$i]' value=''></br>
                                            <hr class='w3-opacity'>
                                    </div>
                                    <hr class='w3-opacity'>
                                    <input type='hidden' id='scales' name='id_profil[$i]' value='$id_user'>
                                    <input type='hidden' id='scales' name='old_username[$i]' value='$username'>
                                    <input type='hidden' id='scales' name='from_admin' value='yes'>
                                    ";
                                $i++;
                               
                        }
                        echo "
                        <input type='submit' class='w3-button w3-black' name='choice' value='Modifier les informations'>
                        
                        </form>";
                        if($button == "Supprimer la clé RSA") {
                            //AFFICHAGE DE LA clé rsa à dl
                        }
                        echo "
                        <form action='../view/profil.php?action=manage_admin' method='POST'>
                            <hr class='w3-opacity'> 
                        ";
                        if($button == "créer une clé rsa pour cet user") {
                            echo "
                                <h4><b>Veuillez rentrer le mot de passe de l'user pour créer une clé rsa </b></h4>
                                <input class='w3-input w3-border' type='password'  name='password[$i]' value='' required></br>
                            ";
                        }
                        elseif($button == 'Supprimer la clé RSA') {
                            $file = $username . "_" . $_SESSION['id_machine'];
                            echo "
                                <a href='../rsa/$file.txt' download>Télécharger la clé RSA de l'utilisateur</a></br>
                                <hr class='w3-opacity'> 
                                <h4><b>Veuillez rentrer le mot de passe de l'user pour supprimer la clé rsa </b></h4>
                                <input class='w3-input w3-border' type='password'  name='password[$i]' value='' required></br>
                            ";
                        }
                        echo "
                            <input type='submit' class='w3-button w3-black' name='choice' value='$button'>
                            <hr class='w3-opacity'>
                            <input type='hidden' id='scales' name='id_profil[$i]' value='$id_user'>
                            <input type='hidden' id='scales' name='old_username[$i]' value='$username'>
                            <input type='hidden' id='scales' name='from_admin' value='yes'>
                        </form>
                        ";
                        if($button == 'Supprimer la clé RSA') {
                            echo "
                            <form action='../view/profil.php?action=manage_admin' method='POST'>
                                <input type='submit' class='w3-button w3-black' name='choice' value='$button1'>
                            </form>
                            ";
                        }
                    }    
                    form_modifiy_user_listes($_SESSION['id']);

                    }else{
                ?>
                    Vous n'avez pas les droits pour accéder à ces fonctions.
                <?php
                    }
                ?>

                    </div>
                </div>
        </html>