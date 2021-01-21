<?php

    session_start();

    require('../model/config.php');
    require('../model/insert.php');
    require('../model/select.php');
    require('../model/update.php');

    $user = $_SESSION['id'];

    if(isset($_SESSION['errors_2'])){ 
        unset($_SESSION['errors_2']);
    }

    $targetDir = "./../images/uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    shell_exec("sudo chown www-data:www-data ../images/uploads/$fileName");
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
        $allowTypes = array('jpg','png','jpeg','gif','jfif');
        if(in_array($fileType, $allowTypes)){
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                update_picture($user, $fileName);
                $_SESSION['errors_2'] = "Votre photo de profil a bien été mise à jour";
            }else{
                $_SESSION['errors_2'] = "Une erreur est intervenue lors du téléchargement";
            }
        }else{
            $_SESSION['errors_2'] = "Ce format de fichier n'est pas valide";
        }
    }else{
        $_SESSION['errors_2'] = "Vous n'avez sélectionné aucun fichier, ou le fichier est trop volumineux";
    }

    header('location: ../view/profil.php?action=parameters');

?>