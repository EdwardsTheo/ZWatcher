<!DOCTYPE html>
<html>
    <div id="haut">
    <h1><b>Mes messages</b></h1>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
        if($_SESSION['graph'] == "normal"){
            echo"<link rel='stylesheet' href='../assets/css/messagerie.css'>";
        }else if($_SESSION['graph'] == "dark"){
            echo"<link rel='stylesheet' href='../assets/css/messagerie_dark.css'>";
        }else if($_SESSION['graph'] == "ocean"){
            echo"<link rel='stylesheet' href='../assets/css/messagerie_ocean.css'>";
        }
    ?>

                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=messagerie"><button class="w3-button w3-black"><i class="fas fa-comment-dots w3-margin-right"></i>Accueil</button></a>
                    <a href=#><button class="w3-button w3-white"><i class="fas fa-comment-alt w3-margin-right"></i>Nouveau message</button></a>
                    <a href=#><button class="w3-button w3-white w3-hide-small"><i class="fas fa-edit w3-margin-right"></i>Gestion messages</button></a>
                    <a href="#"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-tools w3-margin-right"></i>Paramètres</button></a>
                    </div>
                    </div>
                    </div>
                </header>


                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <h4><b>Vos discussions :</b></h4>

                <div class="container">
                        

                    <section class="discussions">
                        <div class="discussion search">
                            <div class="searchbar">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <form action="#" method = "POST"><input type="text" placeholder="Rechercher ..."></input></form>
                            </div>
                        </div>

                        <div id="contact-list">

                        <?php

//on met temporairement le truc actif au premier user pour ne pas le faire disparaitre sous la barre de recherche

// chaque contact a un bouton qui crée une variable temporaire à son nom
// si la variable est def, on envoie les messages correspondants sinon on met ceux du plus récent
// puis on vide la mémoire de la variable

                        $i = 0;
                        while($donnees = $req->fetch()){
                            
                            if($i == 0){
                                //echo"<div class='discussion message-active'>";
                                $tmp_title = $donnees[0];
                                $tmp_id = $donnees[1];
                                $tmp_id_img = $tmp_id;
                            //}else{
                                //echo"<div class='discussion message'>";
                            }else{
                                $tmp_id_img = $donnees[1];
                            }

                            if($_SESSION['messagerie_tmp'] == false){
                                if($i == 0){
                                    $_SESSION['receive'] = $tmp_id;
                                    echo"<div class='discussion message-active'>";
                                }else{
                                    echo"<div class='discussion message'>";
                                }
                            }else{
                                if($donnees[0] == $_SESSION['messagerie_tmp_user'] && $i !==0){
                                    echo"<div class='discussion message-active-other'>";
                                }else if($donnees[0] == $_SESSION['messagerie_tmp_user'] && $i == 0){
                                    echo"<div class='discussion message-active'>";
                                }else if($donnees[0] !== $_SESSION['messagerie_tmp_user'] && $i == 0){
                                    echo"<div class='discussion message-active-no'>";
                                }else{
                                    echo"<div class='discussion message'>";
                                }
                            }

                            $req_img = get_image_user($tmp_id_img);
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
                            echo "<div class='desc-contact'><a style='text-decoration:none' href='../controller/redirect_messagerie.php?user=$donnees[1]'>
                                <p class='name'> $donnees[0] </p>
                                <p class='message'> $donnees[2] </p></a>
                            </div>
                            <div class='timer'>$donnees[5]</div>
                            </div>";
                        
                        $i = $i + 1;

                        }
                        $req->closeCursor();
                        ?>
                        
                    </div>
        
                    </section>

                    <section class="chat">
                    <div class="header-chat">
                        <i class="icon fa fa-user-o" aria-hidden="true"></i>
                        <p class="name">
                        <?php
                        if($_SESSION['messagerie_tmp'] == true){
                            echo htmlspecialchars(htmlspecialchars($_SESSION['messagerie_tmp_user']));
                        }else{
                            echo htmlspecialchars(htmlspecialchars($tmp_title));
                        } 
                        ?>
                        </p>
                    </div>

                    <div id="message-list">

                    <div class="messages-chat">
                        
                        <?php
                        
                        if($_SESSION['messagerie_tmp'] == true){
                            $_SESSION['messagerie_tmp'] = false;
                            
                            while ($donnees = $req2->fetch()){
                                if($donnees['shipper'] == $_SESSION['id']){
                                    echo"<div class='message text-only'>
                                        <div class='response'>
                                        <p class='text'> $donnees[msg]</p>
                                        </div>
                                        </div>";
                                }else{
                                    echo"<div class='message text-only'>
                                        <p class='text'> $donnees[msg]</p>
                                        </div>";
                                }
                            }
                        }else{
                            $req2 = get_messages($_SESSION['id'], $tmp_id);
                            while ($donnees = $req2->fetch()){
                                if($donnees['shipper'] == $_SESSION['id']){
                                    echo"<div class='message text-only'>
                                        <div class='response'>
                                        <p class='text'> $donnees[msg]</p>
                                        </div>
                                        </div>";
                                }else{
                                    echo"<div class='message text-only'>
                                        <p class='text'> $donnees[msg]</p>
                                        </div>";
                                }
                            }
                        }

                        ?>                    
                        
                        </div>
                    </div>

                    <div class="footer-chat">
                    <form action="../controller/send_message.php" method = "POST">
                        <textarea class="write-message" name="message" placeholder="Saisissez votre message ..." autocomplete="off"></textarea>
                        <button type="submit" class="btn"><i class="fas fa-paper-plane w3-margin-right"></i>Envoyer</button>
                    </form>
                    </div>
                    </div>
                    </section>

                
                </div>

</html>