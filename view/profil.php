<?php

ob_start();
session_start();

require("../model/config.php");
require("../model/delete.php");
require("../model/insert.php");
require("../model/select.php");
require("../model/update.php");
require("../mail/mail.php");
require("../controller/alert.php");

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>ZWatcher</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <?php
            if($_SESSION['graph'] == "normal"){
                echo"<link rel='stylesheet' href='../assets/css/profil_1.css'>
                <link rel='stylesheet' href='../assets/css/profil_2.css'>";
            }else if($_SESSION['graph'] == "dark"){
                echo "<link rel='stylesheet' href='../assets/css/profil_dark.css'>
                <link rel='stylesheet' href='../assets/css/profil_2_dark.css'>";
            }else if($_SESSION['graph'] == "ocean"){
                echo "<link rel='stylesheet' href='../assets/css/profil_ocean.css'>
                <link rel='stylesheet' href='../assets/css/profil_2_ocean.css'>";
            }
        ?>
        <link rel="stylesheet" href="../assets/css/profil_3.css">
        <script src="https://kit.fontawesome.com/44bec37701.js"></script>
        <style>body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}</style>
        </head>

        <body class="w3-light-grey w3-content" style="max-width:3600px">
    

<!-- Sidebar/menu -->
        <?php
        if (!isset($_GET['action'])) {
            echo "<nav class='w3-sidebar w3-collapse w3-white2 w3-animate-left' style='z-index:3;width:300px;'' id='mySidebar'><br>";
        }else{
            echo "<nav class='w3-sidebar w3-collapse w3-white2' style='z-index:3;width:300px;'' id='mySidebar'><br>";
        }
        ?>
            <div class="w3-container">
            <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
            <i class="fa fa-remove"></i></a>

            <?php
                //select l'image de l'user en cours
                // si le chemin est NULL, on met l'avatar par défault
                //du coup rajouter un moyen de supprimer l'image
                $tmp_id = $_SESSION['id'];
                $req_img = get_image_user($tmp_id);
                $data_img = $req_img->fetch();
                $img_url = $data_img[0];
                
                if($img_url == "none"){
                    echo "<img src='../images/graphismes/avatar.png' style='width:35%;' class='w3-round'><br><br>";
                }else{
                    echo "<img src='../images/uploads/$img_url' style='width:100px;' class='w3-round'><br><br>";
                }

            ?>
            
            <?php
            if($_SESSION['graph'] == "normal"){
                echo"<h4><b><a style='text-decoration:none; color:#DC6180' href='../index.php'>ZWatcher</a></b></h4>";
            }else if($_SESSION['graph'] == "dark"){
                echo"<h4><b><a style='text-decoration:none; color:#5d82ff' href='../index.php'>ZWatcher</a></b></h4>";
            }else if($_SESSION['graph'] == "ocean"){
                echo"<h4><b><a style='text-decoration:none; color:#6078ea' href='../index.php'>ZWatcher</a></b></h4>";
            }
            ?>
            <class="w3-text-grey">
            <?php 
            if(isset($_SESSION['username'])){
                echo "<b>";
                echo htmlspecialchars(htmlspecialchars($_SESSION['username']));
                echo "</b>";
            }else{
            echo "";
            }
            ?>
        </div>

<!-- ajouter un if action pour mettre en couleur l'action selectionne en cours -->
        <div class="w3-bar-block">

            <!-- <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding w3-text-teal'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a> 
            <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
            <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
            <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Groupes</a>
            <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateur</a>
            <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mes listes</a>
            <a href='?action=assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>
		-->
        
        <?php
        if (!isset($_GET['action'])){
            echo "<a href='?action=accueil' onclick='w3_close()' class='w3-bar-item w3-button w3-padding w3-text-teal'><i class='fas fa-home fa-fw w3-margin-right'></i>Accueil</a>
            <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a> 
            <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
            <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
            <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mon parc</a>
            <a href='?action=equipe' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-users fa-fw w3-margin-right'></i>Equipes</a>
            <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateurs</a>
            <a href='?action=modification' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-pencil-alt fa-fw w3-margin-right'></i>Modification</a>
            <a href='?action=application' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-map fa-fw w3-margin-right'></i>Applications</a>
            <a href='?action=observation' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-user-secret fa-fw w3-margin-right'></i>Observation</a>
            <a href='?action=assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>";
		}else{
            if($_GET['action'] == "accueil"){
                echo "<a href='?action=accueil' onclick='w3_close()' class='w3-bar-item w3-button w3-padding w3-text-teal'><i class='fas fa-home fa-fw w3-margin-right'></i>Accueil</a>
                <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a> 
                <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
                <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
                <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mon parc</a>
                <a href='?action=equipe' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-users fa-fw w3-margin-right'></i>Equipes</a>
                <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateurs</a>
                <a href='?action=modification' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-pencil-alt fa-fw w3-margin-right'></i>Modification</a>
                <a href='?action=application' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-map fa-fw w3-margin-right'></i>Applications</a>
                <a href='?action=observation' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-user-secret fa-fw w3-margin-right'></i>Observation</a>
                <a href='?action=assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>";
			}else if($_GET['action'] == "compte" || $_GET['action'] == "infos" || $_GET['action'] == "status" || $_GET['action'] == "parameters" || $_GET['action'] == "graphismes"){
                echo "<a href='?action=accueil' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-home fa-fw w3-margin-right'></i>Accueil</a>
                <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding  w3-text-teal'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a> 
                <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
                <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
                <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mon parc</a>
                <a href='?action=equipe' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-users fa-fw w3-margin-right'></i>Equipes</a>
                <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateurs</a>
                <a href='?action=modification' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-pencil-alt fa-fw w3-margin-right'></i>Modification</a>
                <a href='?action=application' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-map fa-fw w3-margin-right'></i>Applications</a>
                <a href='?action=observation' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-user-secret fa-fw w3-margin-right'></i>Observation</a>
                <a href='?action=assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>";
            }else if($_GET['action'] == "contacts" || $_GET['action'] == "add_contact" ||$_GET['action'] == "delete_contact" || $_GET['action'] == "par_contacts"){
                echo "<a href='?action=accueil' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-home fa-fw w3-margin-right'></i>Accueil</a>
                <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a>
                <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding w3-text-teal'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
                <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
                <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mon parc</a>
                <a href='?action=equipe' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-users fa-fw w3-margin-right'></i>Equipes</a>
                <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateurs</a>
                <a href='?action=modification' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-pencil-alt fa-fw w3-margin-right'></i>Modification</a>
                <a href='?action=application' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-map fa-fw w3-margin-right'></i>Applications</a>
                <a href='?action=observation' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-user-secret fa-fw w3-margin-right'></i>Observation</a>
                <a href='?action=assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>";
            }else if($_GET['action'] == "messagerie" || $_GET['action'] == "messages"){
                echo "<a href='?action=accueil' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-home fa-fw w3-margin-right'></i>Accueil</a>
                <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a> 
                <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
                <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding w3-text-teal'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
                <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mon parc</a>
                <a href='?action=equipe' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-users fa-fw w3-margin-right'></i>Equipes</a>
                <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateurs</a>
                <a href='?action=modification' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-pencil-alt fa-fw w3-margin-right'></i>Modification</a>
                <a href='?action=application' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-map fa-fw w3-margin-right'></i>Applications</a>
                <a href='?action=observation' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-user-secret fa-fw w3-margin-right'></i>Observation</a>
                <a href='?action=assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>";
            }else if($_GET['action'] == "listes" || $_GET['action'] == "display_listes" || $_GET['action'] == "create_liste" || $_GET['action'] == "delete_liste" || $_GET['action'] == "edit_liste"
            || $_GET['action'] == "erase_liste" || $_GET['action'] == "begin_edit_liste" || $_GET['action'] == "confirm_edit_liste"){
                echo "<a href='?action=accueil' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-home fa-fw w3-margin-right'></i>Accueil</a>
                <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a> 
                <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
                <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
                <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding w3-text-teal'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mon parc</a>
                <a href='?action=equipe' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-users fa-fw w3-margin-right'></i>Equipes</a>
                <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateurs</a>
                <a href='?action=modification' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-pencil-alt fa-fw w3-margin-right'></i>Modification</a>
                <a href='?action=application' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-map fa-fw w3-margin-right'></i>Applications</a>
                <a href='?action=observation' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-user-secret fa-fw w3-margin-right'></i>Observation</a>
                <a href='?action=assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>";
            }else if($_GET['action'] == "equipe" || $_GET['action'] == "display_equipes" || $_GET['action'] == "info_equipe" || $_GET['action'] == "add_table_equipes" || $_GET['action'] == "edit_equipe" || $_GET['action'] == "add_member_equipe"
            || $_GET['action'] == "create_equipe" || $_GET['action'] == "init_equipe" || $_GET['action'] == "delete_equipe" || $_GET['action'] == "erase_equipe"){
                echo "<a href='?action=accueil' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-home fa-fw w3-margin-right'></i>Accueil</a>
                <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a> 
                <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
                <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
                <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mon parc</a>
                <a href='?action=equipe' onclick='w3_close()' class='w3-bar-item w3-button w3-padding w3-text-teal'><i class='fa fa-users fa-fw w3-margin-right'></i>Equipes</a>
                <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateurs</a>
                <a href='?action=modification' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-pencil-alt fa-fw w3-margin-right'></i>Modification</a>
                <a href='?action=application' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-map fa-fw w3-margin-right'></i>Applications</a>
                <a href='?action=observation' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-user-secret fa-fw w3-margin-right'></i>Observation</a>
                <a href='?action=assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>";
            }else if($_GET['action'] == "user" || $_GET['action'] == "display_utilisateurs" || $_GET['action'] == "add_utilisateurs" || $_GET['action'] == "new_utilisateur"
             || $_GET['action'] == "delete_utilisateur" || $_GET['action'] == "erase_utilisateur"){
                echo "<a href='?action=accueil' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-home fa-fw w3-margin-right'></i>Accueil</a>
                <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a> 
                <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
                <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
                <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mon parc</a>
                <a href='?action=equipe' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-users fa-fw w3-margin-right'></i>Equipes</a>
                <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding w3-text-teal'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateurs</a>
                <a href='?action=modification' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-pencil-alt fa-fw w3-margin-right'></i>Modification</a>
                <a href='?action=application' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-map fa-fw w3-margin-right'></i>Applications</a>
                <a href='?action=observation' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-user-secret fa-fw w3-margin-right'></i>Observation</a>
                <a href='?action=assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>";
            }else if($_GET['action'] == "modification" || $_GET['action'] == "modif_liste" || $_GET['action'] == "modif_machine" || $_GET['action'] == "modif_hostname" || $_GET['action'] == "modif_ip"
            || $_GET['action'] == "modif_users" || $_GET['action'] == "manage_users" || $_GET['action'] == "manage_groups" || $_GET['action'] == "modif_groups"
            || $_GET['action'] == "modif_admin_listes" || $_GET['action'] == "manage_admin" || $_GET['action'] == "console"){
                echo "<a href='?action=accueil' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-home fa-fw w3-margin-right'></i>Accueil</a>
                <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a> 
                <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
                <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
                <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mon parc</a>
                <a href='?action=equipe' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-users fa-fw w3-margin-right'></i>Equipes</a>
                <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateurs</a>
                <a href='?action=modification' onclick='w3_close()' class='w3-bar-item w3-button w3-padding w3-text-teal'><i class='fas fa-pencil-alt fa-fw w3-margin-right'></i>Modification</a>
                <a href='?action=application' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-map fa-fw w3-margin-right'></i>Applications</a>
                <a href='?action=observation' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-user-secret fa-fw w3-margin-right'></i>Observation</a>
                <a href='?action=assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>";
            }else if($_GET['action'] == "application" || $_GET['action'] == "appli_liste" || $_GET['action'] == "appli_machine" || $_GET['action'] == "gestion_app" || $_GET['action'] == "install_app"
            || $_GET['action'] == "update_app" || $_GET['action'] == "add_app"){
                echo "<a href='?action=accueil' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-home fa-fw w3-margin-right'></i>Accueil</a>
                <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a> 
                <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
                <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
                <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mon parc</a>
                <a href='?action=equipe' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-users fa-fw w3-margin-right'></i>Equipes</a>
                <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateurs</a>
                <a href='?action=modification' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-pencil-alt fa-fw w3-margin-right'></i>Modification</a>
                <a href='?action=application' onclick='w3_close()' class='w3-bar-item w3-button w3-padding w3-text-teal'><i class='fas fa-map fa-fw w3-margin-right'></i>Applications</a>
                <a href='?action=observation' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-user-secret fa-fw w3-margin-right'></i>Observation</a>
                <a href='?action=assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>";
            }else if($_GET['action'] == "observation" || $_GET['action'] == "observ_liste" || $_GET['action'] == "observ_machine"){
                echo "<a href='?action=accueil' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-home fa-fw w3-margin-right'></i>Accueil</a>
                <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a> 
                <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
                <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
                <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mon parc</a>
                <a href='?action=equipe' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-users fa-fw w3-margin-right'></i>Equipes</a>
                <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateurs</a>
                <a href='?action=modification' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-pencil-alt fa-fw w3-margin-right'></i>Modification</a>
                <a href='?action=application' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-map fa-fw w3-margin-right'></i>Applications</a>
                <a href='?action=observation' onclick='w3_close()' class='w3-bar-item w3-button w3-padding w3-text-teal'><i class='fas fa-user-secret fa-fw w3-margin-right'></i>Observation</a>
                <a href='?action=assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>";
            }else if($_GET['action'] == "assistant"){
                echo "<a href='?action=accueil' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-home fa-fw w3-margin-right'></i>Accueil</a>
                <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a> 
                <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
                <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
                <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mon parc</a>
                <a href='?action=equipe' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-users fa-fw w3-margin-right'></i>Equipes</a>
                <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateurs</a>
                <a href='?action=modification' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-pencil-alt fa-fw w3-margin-right'></i>Modification</a>
                <a href='?action=application' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-map fa-fw w3-margin-right'></i>Applications</a>
                <a href='?action=observation' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-user-secret fa-fw w3-margin-right'></i>Observation</a>
                <a href='?action=assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding w3-text-teal'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>";
            }else{
                echo "<a href='?action=accueil' onclick='w3_close()' class='w3-bar-item w3-button w3-padding w3-text-teal'><i class='fas fa-home fa-fw w3-margin-right'></i>Accueil</a>
                <a href='?action=compte' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-address-card fa-fw w3-margin-right'></i>Mon compte</a> 
                <a href='?action=contacts' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user fa-fw w3-margin-right'></i>Mes contacts</a> 
                <a href='?action=messagerie' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-envelope fa-fw w3-margin-right'></i>Messagerie</a>
                <a href='?action=listes' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-book-open fa-fw w3-margin-right'></i>Mon parc</a>
                <a href='?action=equipe' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-users fa-fw w3-margin-right'></i>Equipes</a>
                <a href='?action=user' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fa fa-user-plus fa-fw w3-margin-right'></i>Utilisateurs</a>
                <a href='?action=modification' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-pencil-alt fa-fw w3-margin-right'></i>Modification</a>
                <a href='?action=application' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-map fa-fw w3-margin-right'></i>Applications</a>
                <a href='?action=observation' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-user-secret fa-fw w3-margin-right'></i>Observation</a>
                <a href='#assistant' onclick='w3_close()' class='w3-bar-item w3-button w3-padding'><i class='fas fa-chalkboard-teacher fa-fw w3-margin-right'></i>Assistant</a>";
			}
		}
        ?>
            
            <a href="../controller/log_out.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fas fa-power-off fa-fw w3-margin-right"></i>Déconnexion</a>
        </div>

        <div class="w3-panel w3-large">
            <a href="https://www.facebook.com"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
            <a href="https://www.instagram.com/"><i class="fa fa-instagram w3-hover-opacity"></i></a>
            <a href="https://www.snapchat.com/"><i class="fa fa-snapchat w3-hover-opacity"></i></a>
            <a href="https://www.pinterest.com"><i class="fa fa-pinterest-p w3-hover-opacity"></i></a>
            <a href="https://twitter.com/"><i class="fa fa-twitter w3-hover-opacity"></i></a>
            <a href="https://linkedin.com/"><i class="fa fa-linkedin w3-hover-opacity"></i></a>
        </div>
        <div class="brand">
                <a href="https://twitter.com">
                <?php
                if($_SESSION['graph'] == "normal"){
                    echo"<img src='../images/graphismes/logo_normal_ter.png' width=70%/>";
                }else if($_SESSION['graph'] == "dark"){
                    echo"<img src='../images/graphismes/logo_dark_2.png' width=45%/>";
                }else if($_SESSION['graph'] == "ocean"){
                    echo"<img src='../images/graphismes/logo_transparent_centre_2.png' width=50%/>";
                }
                ?>
                </a>
            </div>
        </nav>

        <!-- Overlay effect when opening sidebar on small screens -->
        <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:300px">

        <!-- Header -->
        <header id="portfolio">
            <a href="#"><img style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
            <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
            <?php
                if($_SESSION['graph'] == "normal"){
                    echo"<div class='w3-container'>";
                }else if($_SESSION['graph'] == "dark"){
                    echo"<div>";
                }else if($_SESSION['graph'] == "ocean"){
                    echo"<div class='w3-container'>";
                }
            ?>

        <!-- Caler un if isset + le nom de l'action et afficher ensuite l'action corresponante :
        Profil si profil, mes messages etc ... -->

        <?php
        if (!isset($_GET['action'])) {
			require('../controller/profil_accueil.php');
		} else {
			switch ($_GET['action']) {
                //Partie Accueil
                case 'accueil':
					require('../controller/profil_accueil.php');
				break;
                //Partie Compte
                case 'compte':
					require('../controller/profil_home.php');
				break;
                case 'infos':
                    require('../controller/profil_infos.php');
                break;
                case 'status':
                    require('../controller/profil_status.php');
                break;
                case 'parameters':
                    require('../controller/profil_parameters.php');
                break;
                case 'graphismes':
                    require('../controller/profil_graphismes.php');
                break;
                //Partie Contacts
				case 'contacts':
					require('../controller/display_contacts.php');
				break;
                case 'add_contact':
					require('../controller/profil_add_contact.php');
                break;
                case 'delete_contact':
					require('../controller/profil_delete_contact.php');
                break;
                case 'par_contacts':
					require('../controller/profil_par_contacts.php');
                break;
                //Partie Messagerie
                case 'messagerie':
					require('../controller/profil_messagerie.php');
                break;
                case 'messages':
					require('../controller/profil_messages.php');
                break;
                //Partie Listes
                case 'listes':
					require('../controller/profil_listes.php');
                break;
                case 'display_listes':
					require('../controller/profil_display_liste.php');
                break;
                case 'create_liste':
					require('../controller/profil_create_liste.php');
                break;
                case 'delete_liste':
					require('../controller/profil_delete_liste.php');
                break;
                case 'edit_liste':
					require('../controller/profil_edit_liste.php');
                break;
                case 'erase_liste':
					require('../controller/profil_erase_liste.php');
                break;
                case 'begin_edit_liste':
					require('../controller/profil_begin_edit_liste.php');
                break;
                case 'confirm_edit_liste':
					require('../controller/profil_confirm_edit_liste.php');
                break;


                // Partie Equipe
                case 'equipe' :
                    require('../controller/profil_equipe.php');
                break;
                case 'display_equipes' :
                    require('../controller/display_equipes.php');
                break;
                case 'info_equipe' :
                    require('../controller/profil_info_equipe.php');
                break;
                case 'add_table_equipes' :
                    require('../controller/profil_manage_table_equipes.php');
                break;
                case 'edit_equipe' :
                    require('../controller/profil_edit_equipe.php');
                break;
                case 'add_member_equipe' :
                    require('../controller/profil_add_member_equipe.php');
                break;
                case 'create_equipe' :
                    require('../controller/profil_create_equipe.php');
                break;
                case 'init_equipe' :
                    require('../controller/init_equipe.php');
                break;
                case 'delete_equipe' :
                    require('../controller/profil_delete_equipe.php');
                break;
                case 'erase_equipe' :
                    require('../controller/profil_erase_equipe.php');
                break;
                // Partie Utilisateur 
                case 'user' :
                    require('../controller/profil_main_users.php');
                break;
                case 'display_utilisateurs' :
                    require('../controller/profil_display_utilisateurs.php');
                break;
                case 'new_utilisateur' :
                    require('../controller/profil_new_utilisateur.php');
                break;
                case 'delete_utilisateur' :
                    require('../controller/profil_delete_utilisateur.php');
                break;
                case 'erase_utilisateur' :
                    require('../controller/profil_erase_utilisateur.php');
                break;
                //Utilisateur : gestion ?
                case 'add_utilisateurs' :
                    require('../controller/profil_manage_utilisateurs.php');
                break;


                //Partie Modifications
                case 'modification':
					require('../controller/profil_modification.php');
                break;
                case 'modif_liste':
					require('../controller/profil_modif_liste.php');
                break;
                case 'modif_machine':
                    require('../controller/profil_modif_machine.php');
                break;
                case 'modif_hostname':
                    require('../controller/modif_hostname.php');
                break;
                case 'modif_ip':
                    require('../controller/modif_ip.php');
                break;
                //Partie Modifications Users et Groupes
                case 'modif_users':
                    require('../controller/profil_modif_users.php');
                break;
                case 'manage_users':
                    require('../controller/profil_manage_users.php');
                break;
                case 'manage_groups':
                    require('../controller/profil_manage_groups.php');
                break;
                case 'modif_groups':
                    require('../controller/profil_modif_groups.php');
                break;
                //Partie Admin
                case 'modif_admin_listes' :
                    require('../controller/profil_modif_admin_listes.php');
                break;
                case 'manage_admin' :
                    require('../controller/profil_manage_admin.php');
                break;
                //Console;
                case 'console' :
                    require('../controller/profil_console.php');
                break;
                //Partie Applications
                case 'application':
					require('../controller/profil_application.php');
                break;
                case 'appli_liste':
					require('../controller/profil_appli_liste.php');
                break;
                case 'appli_machine':
                    require('../controller/profil_appli_machine.php');
                break; 
                case 'gestion_app':
                    require('../controller/profil_appli_gestion_app.php');
                break; 
                case 'install_app':
                    require('../controller/install_app.php');
                break;
                case 'update_app' :
                    require('../controller/update_app.php');
                break;
                case 'add_app' : 
                    require('../controller/add_app.php');
                break;
                //Partie Observation
                case 'observation':
					require('../controller/profil_observation.php');
                break;
                case 'observ_liste':
					require('../controller/profil_observ_liste.php');
                break;
                case 'observ_machine':
					require('../controller/profil_observ_machine.php');
                break;
                //Partie Assistant
                case 'assistant':
					require('../controller/profil_assistant.php');
                break;
                //Par défault
				default:
                    require('../controller/profil_accueil.php');
				break;
			}
        }

          
        ?>

        <!-- Footer -->
        <div id="bas">
        <footer class="w3-container w3-padding-32 w3-dark-grey">
        <div class="w3-row-padding">
            <div class="w3-third">
            <h3>Administrer</h3>
            <p>Gérez vos équipes et vos environnements de manière sécurisée et intuitive. Modifiez, configurez, installez, tracez et gérez vos équipements. Dialoguez, managez, visualisez vos équipes.</p>
            <p>From <a href="../view/main_views/zteam.php" target="_blank">ZTeam</a></p>
            </div>
        
            <div class="w3-third">
            <h3>Fonctionnalités avancées</h3>
            <ul class="w3-ul w3-hoverable">
                <li class="w3-padding-16">
                <img src="../images/bank/en01_bis.jfif" class="w3-left w3-margin-right" style="width:60px; border-radius: 5px;">
                <span class="w3-large"><a href="?action=equipe" style="text-decoration:none;">Gérer votre équipe</a></span><br>
                <span>Visualisez et gérez vos équipes</span>
                </li>
                <li class="w3-padding-16">
                <img src="../images/bank/an04.jfif" class="w3-left w3-margin-right" style="width:60px; border-radius: 5px;">
                <span class="w3-large"><a href="?action=display_listes" style="text-decoration:none;">Gestionnaire d'environnements</a></span><br>
                <span>Tour d'horizon de votre parc</span>
                </li> 
            </ul>
            </div>

            <div class="w3-third">
            <h3>Catégories</h3>
            <p>
                <span class="w3-tag w3-black w3-margin-bottom"> <a style="text-decoration:none" href="../index.php">Accueil</span></a> 
                <span class="w3-tag w3-grey w3-small w3-margin-bottom"> <a style="text-decoration:none" href="../view/main_views/presentation.php">Notre outil</span></a> 
                <span class="w3-tag w3-grey w3-small w3-margin-bottom"> <a style="text-decoration:none" href="../view/main_views/zteam.php">Notre équipe</span></a>
                <span class="w3-tag w3-grey w3-small w3-margin-bottom"> <a style="text-decoration:none" href="../view/main_views/contact.php">Contactez-nous</span></a> 
                <span class="w3-tag w3-grey w3-small w3-margin-bottom"> <a style="text-decoration:none" href="../view/main_views/contact.php">Assistance</span></a> 

            </p>
            </div>

        </div>
        </footer>   
                
        <div class="w3-black2 w3-center w3-padding-24">Powered by <a href="../view/main_views/contact.php" title="ZTeam" target="_blank" class="w3-hover-opacity">ZTeam</a></div>

        <!-- End page content -->
        </div>

        <script>
        // Script to open and close sidebar
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("myOverlay").style.display = "block";
        }
        
        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("myOverlay").style.display = "none";
        }

        
        </script>
        </div>
        </body>
        </html>
