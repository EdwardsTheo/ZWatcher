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
                </div>
                </div>
                </div>
            </header>
                <div class="w3-container w3-padding-large" style="margin-bottom: -10rm">
                <div id="centre">
                <h4><b>Informations</b></h4>
                    Sur cette page, vous pouvez gèrer les Utilisateurs présents sur le site</br>
                <?php
        
        if(isset($_SESSION['message'])) {
            echo "<h4><b>$_SESSION[message]</b></h4>";
            unset($_SESSION['message']);
        }	
        if(isset($_SESSION['id_user'])) {
            $_POST['choice'] = 'info_utilisateur'; 
            $id_user = $_SESSION['id_user'];
            unset($_SESSION['id_user']);
        }

        echo "
        <div class='w3-section w3-bottombar w3-padding-16'>
            <form action='../view/profil.php?action=user' method='POST'>
                <input type='submit' class='w3-button w3-black' name='choice' value='Montrer les utilisateurs existants'>
                <input type='submit' class='w3-button w3-black' name='choice' value='Ajouter de nouveaux utilisateurs'>
            </form>
        </div>
        ";

        if(isset($_POST['choice'])) {
            switch($_POST['choice']) {
                case 'Montrer les utilisateurs existants' : show_utilisateurs();
                break;
                case 'Ajouter de nouveaux utilisateurs' : form_add_utilisateurs();
                break;
                case 'Valider le nombre' :  form_add_utilisateurs();
                break;
                case 'info_utilisateur' : form_modifiy_user($id_user);
                break;
            }
        }

        function form_add_utilisateurs() {
            if($_POST['choice'] == 'Ajouter de nouveaux utilisateurs') {
                echo " 
                <div class='w3-container w3-padding-large w3-grey'>
                    <h4><b>Premièrement, sélectionnez le nombre d'élèves que vous voulez ajouter (max 50)</b></h4>
                    <form action='../view/profil.php?action=user' method='POST'>
                        <input class='w3-input w3-border' type='number' name='eleves' min='1' max='50'></br>
                        <hr class='w3-opacity'>
                        <input type='submit' class='w3-button w3-black' name='choice' value='Valider le nombre'>
                    </form>
                </div>
                ";
            }
            else if($_POST['choice'] == "Valider le nombre") {
               echo "<div class='w3-section w3-bottombar w3-padding-16'>
               <form action='../view/profil.php?action=add_utilisateurs' method='POST'>";
                for($i=1; $i != $_POST['eleves'] + 1; $i++) {
                    echo "
                    <div class='w3-container w3-padding-large w3-grey'>
                        <h4><b>Nom de l'élève $i</b></h4>
                            <input class='w3-input w3-border' type='text' name='nom_eleve[$i]' value='' required></br>
                            <hr class='w3-opacity'>
                        <h4><b>Prénom de l'élève $i</b></h4>
                            <input class='w3-input w3-border' type='text' name='prenom_eleve[$i]' value='' required></br>
                            <hr class='w3-opacity'>
                        <h4><b>Email de l'élève $i</b></h4>
                            <input class='w3-input w3-border' type='text' name='mail_eleve[$i]' value='' required></br>
                            <hr class='w3-opacity'>
                        <h4><b>Attribuez un mot de passe temporaire</b></h4>
                            <input class='w3-input w3-border' type='text' name='password_eleve[$i]' value='' required></br>
                            <hr class='w3-opacity'>
                    </div>
                    <hr class='w3-opacity'>
                    ";
                }
                echo "
                <input type='submit' class='w3-button w3-black' name='choice' value='Ajouter les utilisateurs'>
                </form>";
            }
        }

        function show_utilisateurs() {
            $req = select_users();
            $i = 1;
            echo " <form action='../view/profil.php?action=add_utilisateurs' method='POST'>";
            while($donnees = $req->fetch()) {
                if($donnees['id'] != 1) {
                    if($i % 3 == 1){
                        echo "<div class='w3-row-padding'>";
                    }
                    $nb = rand(1, 32);
                    echo "<div class='w3-third w3-container w3-margin-bottom'>
                        <img src='../images/listes/l$nb.jfif' alt='' style='width:100%; border-radius:10px 10px 0px 0px;'>
                        <div class='w3-container w3-white2'>
                            <p><b> Utilisateur : $donnees[1]</b></p>
                            <input type='checkbox' id='scales' name='scales[$i]'>
                            <input type='hidden' id='scales' name='id_profil[$i]' value='$donnees[id]'>
                            <input type='submit' class='w3-button w3-black' name='choice' value='Details'>
                        </div>
                    </div>";
                    if($i % 3 == 0){
                        echo "</div>";
                    }
                    $i = $i + 1;
                }
            }
            echo "
            <div class='w3-container w3-padding-large' style='margin-bottom:32px'>
                <hr class='w3-opacity'>
                <input type='submit' class='w3-button w3-black' name='choice' value='Supprimer les membres'>
            </form>
            ";
        }

        function form_modifiy_user($id_user) {
            $req = select_users();
            while($donnees = $req->fetch()) {
                if($donnees['id'] == $id_user) {
                    echo "<div class='w3-section w3-bottombar w3-padding-16'>
                    <form action='../view/profil.php?action=add_utilisateurs' method='POST'>
                        <div class='w3-container w3-padding-large w3-grey'>
                            <h4><b>Nom de l'élève </b></h4>
                                <input class='w3-input w3-border' type='text' name='nom_eleve[1]' value='$donnees[Nom]' required></br>
                                <hr class='w3-opacity'>
                            <h4><b>Prénom de l'élève </b></h4>
                                <input class='w3-input w3-border' type='text' name='prenom_eleve[1]' value='$donnees[Prenom]' required></br>
                                <hr class='w3-opacity'>
                            <h4><b>Email de l'élève </b></h4>
                                <input class='w3-input w3-border' type='text' name='mail_eleve[1]' value='$donnees[mail]' required></br>
                                <hr class='w3-opacity'>
                            <h4><b>Changez son mot de passe</b></h4>
                                <input class='w3-input w3-border' type='password' name='password_eleve[1]' value=''></br>
                                <hr class='w3-opacity'>
                        </div>
                        <hr class='w3-opacity'>
                        ";
                    echo "
                    <input type='submit' class='w3-button w3-black' name='choice' value='Modifier les informations'>
                    <input type='hidden' id='scales' name='id_profil[1]' value='$donnees[id]'>
                    </form>";
                }
            }
        }

        ?>
        </div>
    </div>
</html>