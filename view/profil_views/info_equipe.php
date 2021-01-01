<!DOCTYPE HTML>
<html>
    <div id="haut">
    <h1><b>Equipes</b></h1>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
        if($_SESSION['graph'] == "normal"){
            echo"<link rel='stylesheet' href='../assets/css/contacts.css'>";
        }else if($_SESSION['graph'] == "dark"){
            echo"<link rel='stylesheet' href='../assets/css/contacts_dark.css'>";
        }else if($_SESSION['graph'] == "ocean"){
            echo"<link rel='stylesheet' href='../assets/css/contacts_ocean.css'>";
        }
    ?>
                <div class="w3-section w3-bottombar w3-padding-16">
            <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=equipe"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=display_equipes"><button class="w3-button w3-white"><i class="fas fa-book-open w3-margin-right"></i>Affichage</button></a>
                    <a href="#"><button class="w3-button w3-black"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="?action=create_equipe"><button class="w3-button w3-white"><i class="fas fa-plus w3-margin-right"></i>Créer</button></a>
                    <a href="?action=delete_equipe"><button class="w3-button w3-white"><i class="fas fa-minus w3-margin-right"></i>Supprimer</button></a>
                </div>
                </div>
                </div>
            </header>
                <div class="w3-container w3-padding-large" style="margin-bottom: -10rm">
                <div id="centre">
                <h4><b></b></h4>

                <?php

                echo"<div class='w3-container w3-padding-large w3-grey'>";
                echo "<h4><b>Membres de l'équipe</b></h4>";
                    echo " <form action='../view/profil.php?action=add_table_equipes' method='POST'>";
                    echo"<div style='display: inline' class='errors'>";
                    if(isset($_SESSION['errors'])){ 
                        echo $_SESSION['errors'];
                        unset($_SESSION['errors']);
                    }else{
                        echo "";
                    }

                    echo "</div><hr class='w3-opacity'>";
                $i = 0;
                while($donnees2 = $req2->fetch()) {
                    $nom_equipe = $donnees2['name'];
                    $id_equipe = $donnees2['id'];
                }

                while($donnees = $req->fetch()) {
                    
                    echo "<section class='discussions'>
                    <div class='discussion message-active'>";
                    
                    $tmp_id = $donnees[1];
                    $req_img = get_image_user($tmp_id);
                    $data_img = $req_img->fetch();
                    $img_url = $data_img[0];
                    if($img_url == "none"){
                        echo "<div class='photo' style='background-image: url(../images/graphismes/avatar.png);'>";
                    }else{
                        echo "<div class='photo' style='background-image: url(../images/uploads/$img_url);'>";
                    }

                    if($donnees[3] == "connecte"){
                        echo "<div class='online'></div></div>";
                    }else if($donnees[3] == "occupe"){
                        echo "<div class='offline'></div></div>";
                    }else{
                        echo "</div>";
                    }
                    echo "<div class='desc-contact'>
                        <p class='name'> $donnees[0] </p>
                        <p class='message'> $donnees[2] </p>
                    </div>
                    <input type='checkbox' id='scales' name='scales[$i]'>
                    <div class='timer'>Membre</div></div></section>";
                    echo "<input type='hidden' name='id_equipe' value='$id_equipe'>
                    <input type='hidden' name='id_users[$i]' value='$donnees[id]'>";
                    if($i%2 == 0){
                        echo "&nbsp&nbsp";
                    }
                    $i = $i + 1;
                }
                echo "<input type='submit' class='w3-button w3-black' name='choice' value='Supprimer le ou les membres de cette équipe'>";

                echo"</section>";
                echo"</form></div>";



                echo "</p>
                <div class='w3-container w3-padding-large w3-grey'>
                
                    <h4><b>Nom de l'équipe</b></h4>
                    <form action='../view/profil.php?action=edit_equipe' method='POST'>
                    <div style='display: inline' class='errors'>";
                    if(isset($_SESSION['errors2'])){ 
                        echo $_SESSION['errors2'];
                        unset($_SESSION['errors2']);
                    }else{
                        echo "";
                    }
                    echo"</div>
                    <hr class='w3-opacity'>
                    <input class='w3-input w3-border' type='text' name='nom_equipe' value='$nom_equipe' required></br>
                    <input type='hidden' name='id_equipe' value='$id_equipe'>
                                    
                    
                    <input type='submit' class='w3-button w3-black' name='choice' value='Changer le nom'>
                    </form></div>";
                
                echo "</p><div class='w3-container w3-padding-large w3-grey'>
                <form action='../view/profil.php?action=add_member_equipe' method='POST'>
                <h4><b>Ajouter des membres</b></h4>
                <div style='display: inline' class='errors'>";
                if(isset($_SESSION['errors3'])){ 
                    echo $_SESSION['errors3'];
                    unset($_SESSION['errors3']);
                }else{
                    echo "";
                }
                echo"</div>
                <hr class='w3-opacity'>
                <div class='w3-section'>
                <label>Nom</label>
                <input class='w3-input w3-border' type='text' name='pseudo' value='Pseudo'>
                </div>
                    <input type='submit' class='w3-button w3-black' name='choice' value='Ajouter à cette équipe'>
                    <input type='hidden' name='id_equipe' value='$id_equipe'></div><hr class='w3-opacity'>";
            
            ?>
                
        </div>
    </div>
</html>