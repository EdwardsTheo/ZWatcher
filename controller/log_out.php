<?php

session_start();

require("../model/config.php");
require("../model/update.php");
disconnecte_status($_SESSION['username']);

$_SESSION = array();
session_destroy();

header('location: ../index.php');
exit();
?>