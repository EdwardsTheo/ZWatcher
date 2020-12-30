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
                    <a href="?action=modif_users"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gérer les users</button></a>
                    <a href="?action=modif_groups"><button class="w3-button w3-black w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Gérer les groupes</button></a>
                </div>
                </div>
                </div>
            </header>
                <div class="w3-container w3-padding-large" style="margin-bottom: -10rm">
                <div id="centre">
                <h4><b>Informations</b></h4>
                    Sur cette page, vous pouvez ajouter ou retirer des utilisateur qui sont sur votre machine</br>
                <?php
    
        if(isset($_SESSION['message'])) {
            echo "<h4><b>$_SESSION[message]</b></h4>";
            unset($_SESSION['message']);
        }			 

        if(isset($_SESSION['id_groupe'][1])) {
            $_POST['choice'] = 'Détails du groupe'; 
            $id_groupe = $_SESSION['id_groupe'][1];
            //unset($_SESSION['id_groupe'][[1]]);
        }

        ?>

        <?php
            print_r($_POST);
            print_r($_SESSION);
            echo "
            <div class='w3-section w3-bottombar w3-padding-16'>
                <form action='../view/profil.php?action=modif_groups' method='POST'>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Groupes présents sur la machine'>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Ajouter un ou des groupes'>
                </form>
            </div>
            ";
            
            if(isset($_POST['choice'])) {
                switch($_POST['choice']) {
                    case 'Groupes présents sur la machine' : show_groupe($_SESSION['id_machine']);
                    break;
                    case 'Ajouter un ou des groupes' : form_add_groups();
                    break;
                    case 'Valider le nombre' : form_add_groups();
                    break;
                    case 'Détails du groupe' : groups_details($id_groupe);
                    break;
                }
            }

            function show_groupe($id_machine) {
                $empty = false;
                $req = select_groups_listes($id_machine);
                $i = 1;
                echo " <form action='../view/profil.php?action=manage_groups' method='POST'>";
                while($donnees = $req->fetch()) {
                        $empty = true;
                        if($i % 3 == 1){
                            echo "<div class='w3-row-padding'>";
                        }
                        $nb = rand(1, 32);
                        echo "<div class='w3-third w3-container w3-margin-bottom'>
                            <div class='w3-container w3-white2'>
                                <p><b> Groupe : $donnees[1]</b></p>
                                <input type='checkbox' id='scales' name='scales[$i]'>
                                <input type='hidden' id='scales' name='id_groupe[$i]' value='$donnees[id]'>
                                <input type='hidden' id='scales' name='group_name[$i]' value='$donnees[nom]'>
                               
                                
                            </div>
                        </div>";
                        if($i % 3 == 0){
                            echo "</div>";
                        }
                        $i = $i + 1;
                }
                echo "<div class='w3-container w3-padding-large' style='margin-bottom:32px'>";
                if($empty == true) {
                    echo "
                        <hr class='w3-opacity'>
                        <input type='submit' class='w3-button w3-black' name='choice' value='Détails du groupe'>
                        <input type='submit' class='w3-button w3-black' name='choice' value='Supprimer le groupe'>
                    </form>
                    ";
                }
                else {
                    echo "<h4><b>Il n'y a actuellement aucun groupe sur cette machine !</b></h4>";
                }
            }

            function form_add_groups() {
                if($_POST['choice'] == 'Ajouter un ou des groupes') {
                    echo " 
                    <div class='w3-container w3-padding-large w3-grey'>
                        <h4><b>Premièrement, sélectionnez le nombre de groupe que vous voulez créer (max 50)</b></h4>
                        <form action='../view/profil.php?action=modif_groups' method='POST'>
                            <input class='w3-input w3-border' type='number' name='eleves' min='1' max='50'></br>
                            <hr class='w3-opacity'>
                            <input type='submit' class='w3-button w3-black' name='choice' value='Valider le nombre'>
                        </form>
                    </div>
                    ";
                }
                else if($_POST['choice'] == "Valider le nombre") {
                    echo "<div class='w3-section w3-bottombar w3-padding-16'>
                    <form action='../view/profil.php?action=manage_groups' method='POST'>";
                     for($i=1; $i != $_POST['eleves'] + 1; $i++) {
                         echo "
                         <div class='w3-container w3-padding-large w3-grey'>
                             <h4><b>Nom du groupe $i</b></h4>
                                 <input class='w3-input w3-border' type='text'  pattern='^[A-Z][a-z]+[\ \t][A-Z][a-z]+$' name='groupe_name[$i]' value='' required></br>
                                 <hr class='w3-opacity'>
                                 <input type='checkbox' id='scales' name='sudo_right[$i]'
                                 checked>
                                <label for='scales'>Accorder le droit sudo à ce groupe</label>
                         </div>
                         <hr class='w3-opacity'>
                         ";
                     }
                     echo "
                     <input type='submit' class='w3-button w3-black' name='choice' value='Ajouter les ou le groupe'>
                     </form>";
                 }
            }

            function groups_details($id_groupe) {
                echo "<h4><b>Details du groupe</b></h4>";
                echo " <form action='../view/profil.php?action=manage_groups' method='POST'>";
            }
        ?>
        </div>
    </div>
</html>