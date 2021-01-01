<?php

    $member = $_POST['pseudo'];
    $duplicate = "none";
    $cpt = 0;

    $req = fetch_ids();
    while($donnees = $req->fetch()){
        $tmp = $donnees['username'];
        if($tmp == $member){
            $cpt = $cpt + 1;
        }
    }

    if($cpt == 1){
        $data = get_equipe_members($_POST['id_equipe']);
        while($donnees = $data->fetch()){
            $tmp = $donnees['member_name'];
            if($tmp == $member){
                $duplicate = "yes";
            }  
        }
    
        if($duplicate == "yes"){
            $_SESSION['errors3'] = "Cet utilisateur fait déjà partie de l'équipe";
        }else{
            $data2 = get_back_username($member);
            while($donnees2 = $data2->fetch()){
                $new_member = $donnees2[0];
            }

            insert_user_team($_POST['id_equipe'], $new_member);
            $_SESSION['errors3'] = "L'utilisateur a bien été ajouté à l'équipe";
        }
    }else{
        $_SESSION['errors3'] = "Cet utilisateur n'existe pas";
    }

    $_SESSION['errors'] = "";
    $_SESSION['errors2'] = "";

    $id_equipe = $_POST['id_equipe'];
    $req = select_group_details($id_equipe);
    require("../view/profil_views/info_equipe.php");

?>