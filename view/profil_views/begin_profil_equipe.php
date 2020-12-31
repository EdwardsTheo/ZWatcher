<!DOCTYPE HTML>
<html>
    <div id="haut">
    <h1><b>Utilisateurs</b></h1>
                <div class="w3-section w3-bottombar w3-padding-16">
            <!--      <span class="w3-margin-right">Filter:</span> -->
            <a href="?action=modification"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=modif_liste"><button class="w3-button w3-white"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="#"><button class="w3-button w3-white"><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="#"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Paramètres</button></a>
                </div>
                </div>
                </div>
            </header>
                <div class="w3-container w3-padding-large" style="margin-bottom: -10rm">
                <div id="centre">
                <h4><b>Informations</b></h4>
                    Sur cette page, vous pouvez gèrer les groupes d'élèves</br>
                <?php
    
        if(isset($_SESSION['message'])) {
            echo "<h4><b>$_SESSION[message]</b></h4>";
            unset($_SESSION['message']);
        }	
        if(isset($_SESSION['id_equipe'])) {
            $_POST['choice'] = 'details équipe'; 
            $id_equipe = $_SESSION['id_equipe'];
            unset($_SESSION['id_equipe']);
        }

        function stop_session() {
            if(isset($_SESSION['id_equipe'])) {
            unset($_SESSION['id_equipe']);
            }
        }
        print_r($_POST);
        ?>

        <?php
            echo "
            <div class='w3-section w3-bottombar w3-padding-16'>
                <form action='../view/profil.php?action=modif_table_equipe' method='POST'>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Montrer les équipes existantes'>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Créer une équipe avec des membres'>
                </form>
            </div>
            ";
            
            if(isset($_POST['choice'])) {
                switch($_POST['choice']) {
                    case 'Montrer les équipes existantes' : show_table_team();
                    break;
                    case 'Créer une équipe avec des membres' : form_add_table_team();
                    break;
                    case "Valider le nombre" : form_add_table_team();
                    break;
                    case "details équipe" : show_detail_team($id_equipe);
                    break;
                    case 'Ajouter de nouveaux membres à cette équipe' : form_add_exist_team();
                    break;
                }
            }

            function show_table_team() {
                stop_session();
                $req = simple_select_team();
                $i = 1;
                $exist = false;
                echo " <form action='../view/profil.php?action=add_table_equipes' method='POST'>";
                while($donnees = $req->fetch()) {
                    echo $exist = true;
                    if($i % 3 == 1){
                        echo "<div class='w3-row-padding'>";
                    }
                    $nb = rand(1, 32);
                    echo "<div class='w3-third w3-container w3-margin-bottom'>
                        <img src='../images/listes/l$nb.jfif' alt='' style='width:100%; border-radius:10px 10px 0px 0px;'>
                        <div class='w3-container w3-white2'>
                            <p><b>Groupe $donnees[1]</b></p>
                            <input type='checkbox' id='scales' name='scales[$i]'>
                            <input type='hidden' name='id_groupe[$i]' value='$donnees[id]'>
                            
                        </div>
                    </div>";
                    if($i % 3 == 0){
                        echo "</div>";
                    }
                    $i = $i + 1;
                }
                if($exist == true) {
                    echo "
                    <div class='w3-container w3-padding-large' style='margin-bottom:32px'>
                        <hr class='w3-opacity'>
                        <input type='submit' class='w3-button w3-black' name='choice' value='Voir les details de cette équipe'>
                        <input type='submit' class='w3-button w3-black' name='choice' value='Supprimer'>
                    </form>
                    ";
                }
                else {
                    echo "<h4><b>Il n'y a actuellement aucune équipe !</b></h4>";
                }
            }

            function form_add_table_team() {
                stop_session();
                $j = count_users_eleves();
                if($_POST['choice'] == 'Créer une équipe avec des membres') {
                    echo " 
                    <div class='w3-container w3-padding-large w3-grey'>
                        <h4><b>Premièrement, sélectionnez le nombre d'élèves que vous voulez ajouter à l'équipe (min 1 - max $j)</b></h4>
                        <form action='../view/profil.php?action=modif_table_equipe' method='POST'>
                            <input class='w3-input w3-border' type='number' name='eleves' min='1' max='$j' required></br>
                            <hr class='w3-opacity'>
                            <input type='submit' class='w3-button w3-black' name='choice' value='Valider le nombre'>
                        </form>
                    </div>
                    ";
                }
                else if($_POST['choice'] == "Valider le nombre") {
                   $h = 1;
                   $check = 'first';
                   echo "<div class='w3-section w3-bottombar w3-padding-16'>
                   <form action='../view/profil.php?action=add_table_equipes' method='POST'>";
                    for($i=1; $i != $_POST['eleves'] + 1; $i++) {
                        $req = select_users_eleves();
                        echo "<label for='choice'>Utilisateurs disponibles : </label>";
                        echo  "<select name='user[$i]'>";
                        while($donnees = $req->fetch()) {
                            $username= $donnees['username'];
                            $id = $donnees['id'];
                            if($check == 'first') {
                                $id_array[$h] = $id;
                                $h++;
                            }
                            ?>
                            <option name="id_user[$i]" value="<?php echo $username ?>"><?php echo $username ?></option>
                            <?php
                            
                        }
                        $check = 'two';
                        echo "</select>";
                    }
                        for($k=1; $k != count($id_array) + 1; $k++) {
                            echo "<input type='hidden' name='id_eleve[$k]' value='$id_array[$k]'>";
                        }
                    echo "</div>
                    <div class='w3-container w3-padding-large w3-grey'>
                        <h4><b>Nom de l'équipe</b></h4>
                            <input class='w3-input w3-border' type='text' name='nom_equipe' value='' required></br>
                    </div>
                    <hr class='w3-opacity'>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Valider la nouvelle équipe'>
                    </form>";
                }
            }

            
            function count_users_eleves() {
                $req = select_users_eleves();
                $i = 0;
                while($donnees = $req->fetch()) {
                    $i++;
                }
                return $i;
            }

            function count_users_eleves_spe() {
                $req = select_users_eleves_team($_POST['id_equipe']);
                $i = 0;
                while($donnees = $req->fetch()) {
                    $i++;
                }
                return $i;
            }

            function show_detail_team($id_equipe) {
                $req = select_group_details($id_equipe);
                $i = 1;
                echo "<h4><b>Details de l'équipe</b></h4>";
                echo " <form action='../view/profil.php?action=add_table_equipes' method='POST'>";
                while($donnees = $req->fetch()) {
                    $nom_equipe = $donnees['name'];
                    $id_equipe = $donnees['id_equipe'];
                    if($i % 3 == 1){
                        echo "<div class='w3-row-padding'>";
                    }
                    $nb = rand(1, 32);
                    echo "<div class='w3-third w3-container w3-margin-bottom'>

                        <div class='w3-container w3-white2'>
                            <p><b>Eleve $donnees[username]</b></p>
                            <input type='checkbox' id='scales' name='scales[$i]'>
                            <input type='hidden' name='id_users[$i]' value='$donnees[id]'>";
                            if(isset($_POST['id_equipe'])) echo "<input type='hidden' name='id_equipe' value='$_POST[id_equipe]'>";
                            if(isset($_SESSION['id_equipe'])) echo "<input type='hidden' name='id_equipe' value='$_SESSION[id_equipe]'>";

                    echo "
                        </div>
                    </div>";
                    if($i % 3 == 0){
                        echo "</div>";
                    }
                    $i = $i + 1;
                }
                echo "
                <hr class='w3-opacity'>
                </div>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Supprimer les ou le membres de cette équipe'>
                    <input type='hidden' name='id_equipe' value='$id_equipe'>
                </form>
                </div>
                ";
                echo "
                <form action='../view/profil.php?action=add_table_equipes' method='POST'>
                <hr class='w3-opacity'>
                <div class='w3-container w3-padding-large w3-grey'>
                    <h4><b>Nom de l'équipe</b></h4>
                    <hr class='w3-opacity'>
                    <input class='w3-input w3-border' type='text' name='nom_equipe' value='$nom_equipe' required></br>
                    <input type='hidden' name='id_equipe' value='$id_equipe'>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Changer le nom'>
                </div>
                </form>";
                
                echo "
                <hr class='w3-opacity'>
                <form action='../view/profil.php?action=modif_table_equipe' method='POST'>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Ajouter de nouveaux membres à cette équipe'>
                    <input type='hidden' name='id_equipe' value='$id_equipe'>
                </form>";
            }


            // The thing I'm gonna do is not right 

            function form_add_exist_team() {
                $id_equipe = $_POST['id_equipe'];
                $j = count_users_eleves_spe();
                $h = count_users_eleves();
                $j = $h - $j;
                if($_POST['choice'] == 'Ajouter de nouveaux membres à cette équipe' && !isset($_POST['choice_special'])) {
                echo " 
                <div class='w3-container w3-padding-large w3-grey'>
                    <h4><b>Premièrement, sélectionnez le nombre d'élèves que vous voulez rajouter à l'équipe (min 1 - max $j)</b></h4>
                    <form action='../view/profil.php?action=modif_table_equipe' method='POST'>
                        <input class='w3-input w3-border' type='number' name='eleves' min='1' max='$j' required></br>
                        <hr class='w3-opacity'>
                        <input type='submit' class='w3-button w3-black' name='choice_special' value='Valider le nombre'>
                        <input type='hidden' name='choice' value='Ajouter de nouveaux membres à cette équipe'>
                        <input type='hidden' name='id_equipe' value='$_POST[id_equipe]'>
                    </form>
                </div>
                ";
                }
                
                if(isset($_POST['choice_special'])) {
                    if($_POST['choice_special'] == 'Valider le nombre') {
                        $h = 1;
                        $check = 'first';
                        $test_smn = true;
                        echo "<div class='w3-section w3-bottombar w3-padding-16'>
                        <form action='../view/profil.php?action=add_table_equipes' method='POST'>";
                            for($i=1; $i != $_POST['eleves'] + 1; $i++) {
                                $req1 = select_users_eleves_team($_POST['id_equipe']);
                                echo "<label for='choice'>Utilisateurs disponibles : </label>";
                                echo  "<select name='user[$i]'>";
                                    while($data = $req1->fetch()) {
                                        $test_smn = false;
                                        $req = select_users_eleves();
                                        while($donnees = $req->fetch()) {
                                            if($data['id'] == $donnees['id']) {
                                                $username= $donnees['username'];
                                                $id = $donnees['id'];
                                                if($check == 'first') {
                                                    $id_array[$h] = $id;
                                                    $h++;
                                                }
                                                ?>
                                                <option name="id_user[$i]" value="<?php echo $username ?>"><?php echo $username ?></option>
                                                <?php
                                            }
                                    }
                                   
                                }
                                if($test_smn == true) {
                                    echo "oui";
                                    $req = select_users_eleves();
                                    while($donnees = $req->fetch()) {
                                        $username= $donnees['username'];
                                        $id = $donnees['id'];
                                        ?>
                                        <option name="id_user[$i]" value="<?php echo $username ?>"><?php echo $username ?></option>
                                        <?php
                                        if($check == 'first') {
                                            $id_array[$h] = $id;
                                            $h++;
                                        }
                                    }
                                }
                                $check = 'two';
                                echo "</select>";
                            }
                                if(isset($id_array)) {
                                    for($k=1; $k != count($id_array) + 1; $k++) {
                                        echo "<input type='hidden' name='id_eleve[$k]' value='$id_array[$k]'>";
                                        echo "<input type='hidden' name='id_equipe' value='$_POST[id_equipe]'>";
                                    }
                                }
                                echo "</div>
                                <input type='submit' class='w3-button w3-black' name='choice' value='Valider les nouveaux membres'>
                                </form>";
                        }
                    }
                }
            

        ?>
        </div>
    </div>
</html>