<!DOCTYPE html>
<html>
    <div id="haut">
    <h1><b>Mes contacts</b></h1>
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
                    <a href="?action=contacts"><button class="w3-button w3-black"><i class="fas fa-address-book w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=add_contact"><button class="w3-button w3-white"><i class="fas fa-user-plus w3-margin-right"></i>Ajouter</button></a>
                    <a href="?action=delete_contact"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-user-minus w3-margin-right"></i>Supprimer</button></a>
                    <a href="?action=par_contacts"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-user-edit w3-margin-right"></i>Modifier</button></a>
                    </div>
                    </div>
                    </div>
                </header>

                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <div id="centre">
                <h4><b>Vos contacts</b></h4>

                <?php
//encode nécessaire quand modif faite a la main dans la bdd

                $i = 0;
                while($donnees = $req->fetch()){
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

                    if($donnees[4] == "connecte"){
                        echo "<div class='online'></div></div>";
                    }else if($donnees[4] == "occupe"){
                        echo "<div class='offline'></div></div>";
                    }else{
                        echo "</div>";
                    }
                    echo "<div class='desc-contact'>
                        <p class='name'> $donnees[0] </p>
                        <p class='message'> $donnees[2] </p>
                    </div>
                    <div class='timer'>$donnees[3]</div></div></section>";
                    if($i%2 == 0){
                        echo "&nbsp&nbsp";
                    }
                    $i = $i + 1;
                
                }
                
                $req->closeCursor();
                ?>

                </div>
                </div>
</html>