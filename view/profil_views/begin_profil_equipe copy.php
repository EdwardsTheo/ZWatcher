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