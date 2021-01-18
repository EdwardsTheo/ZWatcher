<!DOCTYPE HTML>
<html>
    <div id="haut">
    <h1><b>Modifications</b></h1>
                <div class="w3-section w3-bottombar w3-padding-16">
            <!--      <span class="w3-margin-right">Filter:</span> -->
            <a href="?action=modification"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=modif_liste"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="?action=modif_machine"><button class="w3-button w3-white" disabled><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="?action=modif_users"><button class="w3-button w3-black w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gérer les users</button></a>
                    <a href="?action=modif_groups"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gérer les groupes</button></a>
                    <a href="?action=modif_admin_listes"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Compte Admin</button></a>
                </div>
                </div>
                </div>
            </header>
                <div class="w3-container w3-padding-large" style="margin-bottom: -10rm">
                <div id="centre">
                <h4><b>Informations</b></h4>

                <?php
                    if($_SESSION['power'] == "admin"){

                ?>
                    Sur cette page, vous pouvez ajouter ou retirer des utilisateur qui sont sur votre machine</br>
                <?php
     
		if(isset($_SESSION['id_user'])) {
			
			$_POST['choice'] = 'info_utilisateur'; 
            		$id_user = $_SESSION['id_user'];
            		
        }
        
        if(isset($_POST['choice_details'])) {
            if($_POST['choice_details'] == 'Revenir au menu principal') {
                unset($_SESSION['id_user']);
                unset($_POST['choice']);
            }
        }

        if(isset($id_user[2])) $id_user[1] = $id_user[2];

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
                    </div></form>
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
                    </form></div>";
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
                $i=1;
                $req = select_users_listes($_SESSION['id_machine']);
                while($donnees = $req->fetch()) {
                    if(isset($id_user[$i])) {
                        if($donnees['id'] == $id_user[$i]) {
                            $username = $donnees['username'];
                            $id_user_string = $donnees['id'];
                            if($donnees['rsa'] == 0) $button = "Créer une clé rsa pour cet user";
                            else $button = "Supprimer la clé RSA";
                        }
                    }
                    $i++;
                }
                echo "
                <form action='../view/profil.php?action=manage_users' method='POST'>
                    <hr class='w3-opacity'> 
                ";
                if($button == "Créer une clé rsa pour cet user") {
                    echo "
                        <h4><b>Veuillez rentrer le mot de passe de l'user pour créer une clé rsa </b></h4>
                        <input class='w3-input w3-border' type='password'  name='password[$i]' value='' required></br>
                    ";
                }
                elseif($button == 'Supprimer la clé RSA') {
                    $file = $username . "_" . $_SESSION['id_machine'];
                    echo "
                        <a href='../rsa/$file.txt' download>Télécharger la clé RSA Privée de l'utilisateur</a></br>
                        <a href='../rsa/$file.pub' download>Télécharger la clé RSA Publique de l'utilisateur</a></br>
                        <hr class='w3-opacity'> 
                        <h4><b>Veuillez rentrer le mot de passe de l'user pour supprimer la clé rsa </b></h4>
                        <input class='w3-input w3-border' type='password'  name='password[$i]' value='' required></br>
                    ";
                }
                echo "
                    <input type='submit' class='w3-button w3-black' name='choice' value='$button'>
                    <hr class='w3-opacity'>
                    <input type='hidden' id='scales' name='id_profil[$i]' value=' $id_user_string'>
                    <input type='hidden' id='scales' name='old_username[$i]' value='$username'>
                </form>
                ";
                users_details($id_user[1]);
                echo "
                <hr class='w3-opacity'>
                <form action='../view/profil.php?action=modif_users' method='POST'>
                    <input type='submit' class='w3-button w3-black' name='choice_details' value='Revenir au menu principal'>
                </form>
                </div>";
            }

            function form_add_team_listes() {
                for($i=1; $i < 2 ; $i++) {
                    echo "<div class='w3-section w3-bottombar w3-padding-16'>";
                    echo " <form action='../view/profil.php?action=manage_users' method='POST'>
                    <div class='w3-container w3-padding-large w3-grey'>
                        <h4><b>Ajouter une équipe dans la machine </b></h4>
                        <hr class='w3-opacity'>
                        <h5><b>Nom de l'équipe</b></h5>
                        <input class='w3-input w3-border' type='text'  pattern='[a-zA-Z]+' name='nom_equipe[$i]' value='' required></br>
                        <label for='input'>Donner droit sudo à l'équipe</label> <input type='checkbox' name='sudo[$i] '>
                        <hr class='w3-opacity'>
                        <input type='submit' class='w3-button w3-black' name='choice' value='Ajouter cette équipe'>
                    </div>
                    </form>
                    </div>";
                $i++;
                }
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

            function users_details($id_user) {
                $i=1;
                $req1 = select_user_bl_listes($id_user);
                $empty = false;
                $check_user = 0;
                echo " <form action='../view/profil.php?action=manage_users' method='POST'>";
                echo "<h4><b>Utilisateurs associés à cette user linux : </b></h4>";
                while($donnees = $req1->fetch()) {
                    $check_user = 1;
                    $empty = true;
                    if($i % 3 == 1){
                        echo "<div class='w3-row-padding'>";
                    }
                    $nb = rand(1, 32);
                    echo "<div class='w3-third w3-container w3-margin-bottom'>

                        <div class='w3-container w3-white2'>
                            <p><b>Eleve $donnees[username]</b></p>
                            <input type='checkbox' id='scales' name='scales[$i]'>
                            <input type='hidden' name='id_table[$i]' value='$donnees[id]'>
                            <input type='hidden' name='username[$i]' value='$donnees[id_user_listes]'>";

                    echo "
                        </div>
                    </div>";
                    if($i % 3 == 0){
                        echo "</div>";
                    }
                    $i = $i + 1;
                }

                if($empty == true) {
                    echo "
                        <hr class='w3-opacity'></div>
                        <input type='submit' class='w3-button w3-black' name='choice' value='Supprimer le lien avec un ou des utilisateurs'>
                        </div>
                        </form>
                        <hr class='w3-opacity'>";
                }
                else {
                    echo "il n'y a pas d'utilisateurs associés à cette user linux !
                    </div>
                    </form>";
                }

                if($check_user == 0) {
                    echo " 
                    <hr class='w3-opacity'>
                    <div class='w3-section w3-bottombar w3-padding-16'>
                    <hr class='w3-opacity'>
                    <form action='../view/profil.php?action=modif_users' method='POST'>
                        <input type='submit' class='w3-button w3-black' name='choice_details' value='Associer des utilisateurs à cette user linux'>
                    <hr class='w3-opacity'>
                    </form>
                    ";
                }
            
                if(isset($_POST['choice_details'])) {
                    if($_POST['choice_details'] == 'Associer des utilisateurs à cette user linux') {
                        $j = 1;
                        $empty = false;
                        $req2 = simple_select_users_eleves();
                        echo " <form action='../view/profil.php?action=manage_users' method='POST'>";
                        while($donnees = $req2->fetch()) {
                            $username = $donnees['username'];
                            $empty = true;

                            $test = already_linked($donnees['id'], $id_user);
                            if($donnees['id'] == '1') $test = true;
                            if($test == false) {
                                if($j % 3 == 1){
                                    echo "<div class='w3-row-padding'>";
                                }
                                $nb = rand(1, 32);
                                echo "<div class='w3-third w3-container w3-margin-bottom'>
                                    <div class='w3-container w3-white2'>
                                    <p><b>Utilisateur $username</b></p>
                                        <input type='checkbox' id='scales' name='scales[$j]'>
                                        <input type='hidden' name='id_user[$j]' value='$donnees[id]'>
                                        <input type='hidden' name='username[$j]' value='$username'>
                                        <input type='hidden' name='id_user_listes[$j]' value='$id_user'>";                       
                                    echo "
                                        </div>
                                    </div>";
                                    if($j % 3 == 0){
                                        echo "</div>";
                                    }
                                    echo "<hr class='w3-opacity'>";
                                    }
                                $j++;
                            }
                            if($empty == true && $test == false) {
                                echo '
                                <input type="submit" class="w3-button w3-black" name="choice" value="Ajouter l\'utilisateur à cette user linux">
                                </form>';
                            }
                            else {
                                echo "Les users sont déjà tous dans ce groupe";
                            }
                    }
                }   
                
            }

            function already_linked($id_user, $id_user_machine) {
                    $req = select_user_bl_listes_id($id_user, $id_user_machine); 
                    $test = false;
                    while($donnees = $req->fetch()) {
                        if($id_user_machine == $donnees['id_user_listes']) {
                            $test = true;
                        }
                    }
                    return $test;
                
            }

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
                    case 'Ajouter une équipe' : form_add_team_listes();
                    break;
                }
            }
        if(isset($_SESSION['message'])) {
            echo "<h4><b>$_SESSION[message]</b></h4>";
            unset($_SESSION['message']);
        }			 


        if(isset($_SESSION['error'][1])) error();
        
    
        ?>

                <?php
                    }else{
                ?>
                    Vous n'avez pas les droits pour accéder à ces fonctions.
                <?php
                    }
                ?>
        
    </div>
</html>
