<?php
session_start();

require_once "../database/deconnexionBDD.php";

// Assurer la suppression de session
if (isset($_SESSION["user"])) {
    unset($_SESSION["user"]);
    header("Location: formConnexion.php");
    die();
}

header("Location: formConnexion.php");
