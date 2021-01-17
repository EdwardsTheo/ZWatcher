<!DOCTYPE HTML>
    <html>
        <div id="haut">
        <h1><b>Mon profil</b></h1>
                    <div class="w3-section w3-bottombar w3-padding-16">
                <!--      <span class="w3-margin-right">Filter:</span> -->
                    <a href="?action=compte"><button class="w3-button w3-white"><i class="fas fa-home w3-margin-right"></i>Accueil</button></a>
                    <a href="?action=infos"><button class="w3-button w3-black"><i class="fas fa-info w3-margin-right"></i>Informations</button></a>
                    <a href="?action=status"><button class="w3-button w3-white"><i class="fas fa-globe-asia w3-margin-right"></i>Profil</button></a>
                    <a href="?action=parameters"><button class="w3-button w3-white"><i class="fas fa-tools w3-margin-right"></i>Paramètres</button></a>
                    <a href="?action=graphismes"><button class="w3-button w3-white w3-hide-small"><i class="fas fa-paint-brush w3-margin-right"></i>Graphismes</button></a>
                    </div>
                    </div>
                    </div>    
                </header>

<!-- encode nécessaire quand modif faite a la main dans la bdd -->

                <div class="w3-container w3-padding-large" style="margin-bottom:32px">
                <div id="centre">
                <h4><b>Vos informations</b></h4>
                Votre pseudo : <?php echo htmlspecialchars(htmlspecialchars($_SESSION['username']))?> </br>
                Votre mail : <?php echo htmlspecialchars(htmlspecialchars($_SESSION['mail']))?> </br>
                Votre statut : <?php echo htmlspecialchars(htmlspecialchars($_SESSION['displayer']))?>
                </div>
                </div>

                <?php

                    function show_team($id_user) {
                        $req = utilisateur_in_team($id_user);
                        $i=0;
                        while($data = $req->fetch()) {
                            $team[$i] = $data['name'];
                            $i++;
                        }
                        return $team;
                    }
                    
                    function show_user($id_user) {
                        $req = select_user_bl_listes2($id_user);
                        $i = 0;
                        while($data = $req->fetch()) {
                            $user['username'][$i] = $data['username'];
                            $user['id_listes'][$i] = $data['id_listes'];
                            $user['ip'][$i] = $data['ip'];
                            $user['port'][$i] = $data['port'];
                            $user['rsa'][$i] = $data['rsa'];
                            $user['id_machine'][$i] = $data['id'];
                            $i++;
                        }
                        return $user;
                    }
                    
                    if($_SESSION['power'] == 'utilisateur') {
                        $team = show_team($_SESSION['id']);
                        echo "
                        <div class='w3-container w3-padding-large' style='margin-bottom:32px'>
                        <div class='w3-section w3-bottombar w3-padding-16'>
                        <h4><b>Equipes : </b></h4>
                        ";
                        for($i = 0; $i < count($team); $i++) {
                            echo "
                            <h4><b>Vous faites partie de l'equipe $team[$i]</b></h4>
                            ";
                        }
                        echo "
                        </div>
                        </div>
                        <div class='w3-container w3-padding-large' style='margin-bottom:32px'>
                        <h4><b>Users : </b></h4>
                        ";
                        
                        $user = show_user($_SESSION['id']);

                        $i = 0;
                        foreach ($user['username'] as $key => $value) {
                            $ip = $user['ip'][$i];
                            $port = $user['port'][$i];
                            $rsa = $user['rsa'][$i];
                            $id_machine = $user['id_machine'][$i];
                            $username = $user['username'][$i];
                            echo "
                            <div class='w3-section w3-bottombar w3-padding-16'>
                            <h4><b>Vous avez un utilisateur associé à votre compte</b></h4>
                            <hr class='w3-opacity'>
                            
                            <h5>Informations de la machine : </h5>
                            <label>IP : $ip</label></br>
                            <label>PORT : $port</label>
                            
                            <hr class='w3-opacity'>
                            <h5>Identifiants de connexion : </h5>
                            <label>Username : $username</label></br>
                            </div>";
                            
                            if($rsa == 1) {
                                $file = $username . "_" . $id_machine;
                                echo "
                                <hr class='w3-opacity'>
                                <h5>Vous pouvez vous connecter en SSH avec la clé rsa</h5>
                                <a href='../rsa/$file.txt' download>Télécharger la clé RSA privée</a></br>
                                <a href='../rsa/$file.pub' download>Télécharger la clé RSA publique</a></br>
                                <hr class='w3-opacity'>
                                ";
                            }
                            else {
                                echo "
                                <hr class='w3-opacity'>
                                <h5>Vous pouvez vous connecter en renseignant un mot de passe car il n'y a pas encore de clé RSA disponible</h5>
                                <hr class='w3-opacity'>
                                ";
                            }
                          
                           
                            $i++;
                        }
                    }
                ?>
    </html>