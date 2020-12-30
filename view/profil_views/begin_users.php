<!DOCTYPE HTML>
<html>
    <div id="haut">
    <h1><b>Applications</b></h1>
                <div class="w3-section w3-bottombar w3-padding-16">
            <!--      <span class="w3-margin-right">Filter:</span> -->
            <a href="?action=modification"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=modif_liste"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="#"><button class="w3-button w3-white"><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="#"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Paramètres</button></a>
                    <a href="?action=modif_users"><button class="w3-button w3-black w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gérer les users</button></a>
                    <a href="?action=modif_groups"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gérer les groupes</button></a>
                </div>
                </div>
                </div>
            </header>
                <div class="w3-container w3-padding-large" style="margin-bottom: -10rm">
                <div id="centre">
                <h4><b>Informations</b></h4>
                    Sur cette page, vous pouvez ajouter ou retirer des utilisateur qui sont sur votre machine</br>
                <?php
        print_r($_POST);
        if(isset($_SESSION['message'])) {
            echo "<h4><b>$_SESSION[message]</b></h4>";
            unset($_SESSION['message']);
        }			 

        if(isset($_SESSION['id_user'])) {
            $_POST['choice'] = 'info_utilisateur'; 
            $id_user = $_SESSION['id_user'];
            unset($_SESSION['id_user']);
        }

        if(isset($_SESSION['error'][1])) error();

        ?>

        <?php
            echo "
            <div class='w3-section w3-bottombar w3-padding-16'>
                <form action='../view/profil.php?action=modif_users' method='POST'>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Users présents sur la machine'>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Ajouter un ou des users'>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Ajouter une équipe'>
                </form>
            </div>
            ";
            
            if(isset($_POST['choice'])) {
                switch($_POST['choice']) {
                    case 'Users présents sur la machine' : show_users($_SESSION['id_machine']);
                    break;
                    case 'Ajouter un ou des users' : form_add_users();
                    break;
                    case 'Valider le nombre' : form_add_users();
                    break;
                    case 'info_utilisateur' : form_modifiy_user_listes($id_user);
                    break;
                }
            }

            function show_users($id_machine) {
                $empty = false;
                $req = select_users_listes($_SESSION['id_machine']);
                $i = 1;
                echo " <form action='../view/profil.php?action=manage_users' method='POST'>";
                while($donnees = $req->fetch()) {
                    if($donnees['id'] != 1) {
                        $empty = true;
                        if($i % 3 == 1){
                            echo "<div class='w3-row-padding'>";
                        }
                        $nb = rand(1, 32);
                        echo "<div class='w3-third w3-container w3-margin-bottom'>
                            <div class='w3-container w3-white2'>
                                <p><b> Utilisateur : $donnees[1]</b></p>
                                <input type='checkbox' id='scales' name='scales[$i]'>
                                <input type='hidden' id='scales' name='id_user[$i]' value='$donnees[id]'>
                                <input type='hidden' id='scales' name='username[$i]' value='$donnees[username]'>
                                
                            </div>
                        </div>";
                        if($i % 3 == 0){
                            echo "</div>";
                        }
                        $i = $i + 1;
                    }
                }
                echo "<div class='w3-container w3-padding-large' style='margin-bottom:32px'>";
                if($empty == true) {
                    echo "
                        <hr class='w3-opacity'>
                        <input type='submit' class='w3-button w3-black' name='choice' value='Détails du profil'>
                        <input type='submit' class='w3-button w3-black' name='choice' value='Supprimer les users'>
                    </form>
                    ";
                }
                else {
                    echo "<h4><b>Il n'y a actuellement aucun users sur cette machine !</b></h4>";
                }
            }

            function form_add_users() {
                if($_POST['choice'] == 'Ajouter un ou des users') {
                    echo " 
                    <div class='w3-container w3-padding-large w3-grey'>
                        <h4><b>Premièrement, sélectionnez le nombre d'utilisateur que vous voulez ajouter (max 50)</b></h4>
                        <form action='../view/profil.php?action=modif_users' method='POST'>
                            <input class='w3-input w3-border' type='number' name='eleves' min='1' max='50'></br>
                            <hr class='w3-opacity'>
                            <input type='submit' class='w3-button w3-black' name='choice' value='Valider le nombre'>
                        </form>
                    </div>
                    ";
                }
                else if($_POST['choice'] == "Valider le nombre") {
                   echo "<div class='w3-section w3-bottombar w3-padding-16'>
                   <form action='../view/profil.php?action=manage_users' method='POST'>";
                    for($i=1; $i != $_POST['eleves'] + 1; $i++) {
                        echo "
                        <div class='w3-container w3-padding-large w3-grey'>
                            <h4><b>Nom d'utilisateur $i</b></h4>
                                <input class='w3-input w3-border' type='text'  pattern='[a-z]+' name='username[$i]' value='' required></br>
                                <hr class='w3-opacity'>
                            <h4><b>Mot de passe $i</b></h4>
                                <input class='w3-input w3-border' type='password' name='pswd[$i]' value='' required></br>
                                <hr class='w3-opacity'>
                        </div>
                        <hr class='w3-opacity'>
                        ";
                    }
                    echo "
                    <input type='submit' class='w3-button w3-black' name='choice' value='Ajouter les users'>
                    </form>";
                }
            }

            function form_modifiy_user_listes($id_user) {
                $req = select_users_listes($_SESSION['id_machine']);
                $i=1;
                while($donnees = $req->fetch()) {
                    if(isset($id_user[$i])) {
                        if($donnees['id'] == $id_user[$i]) {
                            echo "<div class='w3-section w3-bottombar w3-padding-16'>
                            <form action='../view/profil.php?action=manage_users' method='POST'>
                                <div class='w3-container w3-padding-large w3-grey'>
                                    <h4><b>Modifier l'Username de l'user $i </b></h4>
                                        <input class='w3-input w3-border' type='text'  pattern='[a-zA-Z]+' name='username[$i]' value='$donnees[username]' required></br>
                                        <hr class='w3-opacity'>
                                    <h4><b>Modifier le mot de passe de l'user $i</b></h4>
                                        <input class='w3-input w3-border' type='password' name='psswd[$i]' value=''></br>
                                        <hr class='w3-opacity'>
                                </div>
                                <hr class='w3-opacity'>
                                <input type='hidden' id='scales' name='id_profil[$i]' value='$donnees[id]'>
                                <input type='hidden' id='scales' name='old_username[$i]' value='$donnees[username]'>
                                ";
                        $i++;
                        }
                    }
                    
                }
                echo "
                <input type='submit' class='w3-button w3-black' name='choice' value='Modifier les informations'>
                
                </form>";
            }

            function error() {
                for($i = 1; $i < count($_SESSION['error']) + 1; $i++) {
                    ?>
                    <h4><b><?php echo "Problème lors de la création du compte $i"; ?></b></h4>
                    <h4><b><?php print_r($_SESSION['error'][$i]); ?></b></h4>
                    <?php
                    unset($_SESSION['error'][$i]);
                    unset($_SESSION[$i]);
                }
            }
    
        ?>
        </div>
    </div>
</html>