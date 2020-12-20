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
    
        if(isset($_SESSION['message'])) {
            echo "<h4><b>$_SESSION[message]</b></h4>";
            unset($_SESSION['message']);
        }			 
        ?>

        <?php
            echo "
            <div class='w3-section w3-bottombar w3-padding-16'>
                <form action='../view/profil.php?action=modif_users' method='POST'>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Utilisateurs présents sur la machine'>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Ajouter un ou des utilisateurs'>
                </form>
            </div>
            ";
            
            if(isset($_POST['choice'])) {
                switch($_POST['choice']) {
                    case 'Utilisateurs présents sur la machine' : show_users($_SESSION['id_machine']);
                    break;
                    case 'Ajouter un ou des utilisateurs' : form_add_users();
                    break;
                }
            }

            function show_users($id_machine) {
                echo $id_machine;
            }
        ?>
        </div>
    </div>
</html>