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
                        $team[150] = 'empty';
                        while($data = $req->fetch()) {
                            $team[150] = 'false';
                            $team[$i] = $data['name'];
                            $i++;
                        }
                        return $team;
                    }
                    
                    function show_user($id_user) {
                        $req = select_user_bl_listes2($id_user);
                        $i = 0;
                        $user['info'][0] = "empty";
                        while($data = $req->fetch()) {
                            $user['info'][0] = "full";
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
                        $empty = false;
                        if($team[150] != 'empty') { 
                            echo "
                            <div class='w3-container w3-padding-large' style='margin-bottom:32px'>
                            <h4><b>Equipes dont vous faites partie  : </b></h4>
                            ";
                            for($i = 0; $i < count($team); $i++) {
                                $empty = true;
                                if($i % 3 == 1){
                                    echo "<div class='w3-row-padding'>";
                                }
                                $nb = rand(1, 32);
                                echo "
                                <div class='w3-third w3-container w3-margin-bottom'>
                                    <div class='w3-container w3-white2'>
                                        <h4><b>Equipe $team[$i]</b></h4>
                                    </div>
                                </div>
                                ";
                                
                                if($i % 3 == 0){
                                    echo "</div>";
                                }
                            }
                        }
                        if($empty == false) {
                            echo "
                            <div class='w3-container w3-padding-large' style='margin-bottom:32px'>
                            <h4><b>Vous ne faites partie d'aucune équipe...</b></h4>
                            </div>";
                        }
                        echo "
                        <div class='w3-container w3-padding-large' style='margin-bottom:32px'>
                        <h4><b>Users : </b></h4>
                        ";

                      
                        $user = show_user($_SESSION['id']);
                        if($user['info'][0] == "full") {
                            $i = 0;
                            foreach ($user['username'] as $key => $value) {
                                $ip = $user['ip'][$i];
                                $port = $user['port'][$i];
                                $rsa = $user['rsa'][$i];
                                $id_machine = $user['id_machine'][$i];
                                $username = $user['username'][$i];
                                echo "
                                <div class='w3-section w3-bottombar w3-padding-16'>
                                <div class='w3-container w3-white2'>
                                <hr class='w3-opacity'>
                                
                                <b>Informations de la machine : </b></br>
                                <label>IP : $ip</label></br>
                                <label>PORT : $port</label>
                                
                                <hr class='w3-opacity'>
                                <b>Identifiants de connexion : </b></br>
                                <label>Username : $username</label></br>
                                
                              
                                ";
                                
                                if($rsa == 1) {
                                    $file = $username . "_" . $id_machine;
                                    echo "
                                    <hr class='w3-opacity'>
                                    <b>Vous pouvez vous connecter en SSH avec la clé rsa privée</b></br>
                                    <a href='../rsa/$file.txt' download>Télécharger la clé RSA privée</a></br>
                                    <a href='../rsa/$file.pub' download>Télécharger la clé RSA publique</a></br>
                                    <hr class='w3-opacity'>
                                    <b>Commande pour se connecter depuis une machine linux: </b></br>
                                    <label>ssh $username@$ip -p $port -i id_rsa</label></br>
                                    <I>N'oubliez pas de donner la bonne authorisation à votre clé !</I>
                                    <hr class='w3-opacity'>
                                    </div>
                                    </div>
                                    ";
                                }
                                else {
                                    echo "
                                    <hr class='w3-opacity'>
                                    <b>Vous pouvez vous connecter en renseignant un mot de passe car il n'y a pas encore de clé RSA disponible</b></br>
                                    <hr class='w3-opacity'>
                                    <b>Commande pour se connecter depuis une machine linux: </b></br>
                                    <label>ssh $username@$ip -p $port</label>
                                   
                                    <hr class='w3-opacity'>
                                    </div>
                                    </div>
                                    ";
                                }
                            
                            
                                $i++;
                            }
                        }
                        else echo "Vous n'avez pas encore d'user associés à votre compte, attendez que l'admin vous ajoute !
                        <hr class='w3-opacity'>";
                        
                     }
                ?>
    </html>